<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SensorData;
use App\Models\Truck;
use App\Models\Task;
use App\Models\Destination;
use App\Models\Order;

class SensorDataController extends Controller
{
    public function fetchFromGpsAndStore(Request $request)
    {
        $sensorId = $request->input('sensor_id', 1); // يمكنك إرسال sensor_id من الواجهة أو تحديده هنا
        $gpsUrl = "http://192.168.8.26/data"; // رابط بيانات JSON من ESP32

        try {
            $response = Http::timeout(5)->get($gpsUrl);

            if (!$response->successful()) {
                return response()->json(['error' => 'فشل الاتصال بالجهاز'], 500);
            }

            $data = $response->json();

            // التحقق من وجود البيانات الأساسية
            if (
                isset($data['lat'], $data['lng'], $data['date'], $data['time']) &&
                is_numeric($data['lat']) && is_numeric($data['lng']) &&
                !empty($data['date']) && strtolower($data['date']) !== 'غير معروف' &&
                !empty($data['time']) && strtolower($data['time']) !== 'غير معروف'
            ) {
                $timestamp = $data['date'] . ' ' . $data['time'];
                $location = $data['lat'] . ',' . $data['lng'];

                $sensorData = SensorData::create([
                    'sensor_id' => $sensorId,
                    'timestamp' => $timestamp,
                    'value' => $data, // حفظ كل البيانات كـ JSON
                    'location' => $location,
                    'weather_type' => null,
                    'obd_code' => null,
                    'heart_rate' => null,
                    'blood_pressure' => null,
                    'is_alerted' => false,
                ]);

                // تحقق وإنشاء تنبيه إذا لزم الأمر
                $sensorData->createAlertIfCritical();
                \App\Services\SensorAlertService::checkAndNotify($sensorData);

                return response()->json([
                    'message' => '✅ تم حفظ بيانات GPS بنجاح',
                    'data' => $sensorData
                ]);
            } else {
                return response()->json([
                    'error' => '⚠️ البيانات المستلمة غير مكتملة أو غير صالحة',
                    'received' => $data
                ], 422);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => '❌ خطأ أثناء الاتصال: ' . $e->getMessage()], 500);
        }
    }



    public function fetchWeatherAndStore(Request $request)
{
    $sensorId = $request->input('sensor_id', 2); // يمكن تغييره أو إرساله من الواجهة
    $weatherUrl = "http://192.168.8.26/weather"; // رابط جهاز ESP32 لحساس الطقس

    try {
        $response = Http::timeout(5)->get($weatherUrl);

        if (!$response->successful()) {
            return response()->json(['error' => 'فشل الاتصال بالجهاز'], 500);
        }

        $data = $response->json();

        if (
            isset($data['temperature'], $data['humidity']) &&
            is_numeric($data['temperature']) && is_numeric($data['humidity'])
        ) {
            $sensorData = SensorData::create([
                'sensor_id' => $sensorId,
                'timestamp' => now(),
                'value' => $data,
                'location' => null,
                'weather_type' => "weather",
                'obd_code' => null,
                'heart_rate' => null,
                'blood_pressure' => null,
                'is_alerted' => false,
            ]);

            return response()->json([
                'message' => '✅ تم حفظ بيانات الطقس بنجاح',
                'data' => $sensorData

            ]);
        } else {
            return response()->json([
                'error' => '⚠️ بيانات الطقس غير صالحة أو ناقصة',
                'received' => $data
            ], 422);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => '❌ خطأ أثناء الاتصال: ' . $e->getMessage()], 500);
    }
}




public function fetchHeartRateAndStore(Request $request)
{
    $sensorId = $request->input('sensor_id', 3);
    $pulseUrl = "http://192.168.8.26/pulse"; // استبدل بالـ IP الخاص بجهاز ESP32

    try {
        $response = Http::timeout(5)->get($pulseUrl);

        if (!$response->successful()) {
            return response()->json(['error' => 'فشل الاتصال بحساس نبض القلب'], 500);
        }

        $data = $response->json();

        if (isset($data['heart_rate']) && is_numeric($data['heart_rate'])) {
            $sensorData = SensorData::create([
                'sensor_id' => $sensorId,
                'timestamp' => now(),
                'value' => $data,
                'location' => null,
                'weather_type' => null,
                'obd_code' => null,
                'heart_rate' => $data['heart_rate'],
                'blood_pressure' => null,
                'is_alerted' => false,
            ]);

            return response()->json([
                'message' => '✅ تم حفظ بيانات نبض القلب بنجاح',
                'data' => $sensorData
            ]);
        } else {
            return response()->json([
                'error' => '⚠️ بيانات نبض القلب غير صالحة',
                'received' => $data
            ], 422);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => '❌ خطأ أثناء الاتصال: ' . $e->getMessage()], 500);
    }
}


public function checkArrivalForAllTasks()
{
    $tasks = Task::with(['driver.truck', 'destination', 'destination.order'])
        ->where('status', '!=', 'تم الوصول إلى نقطة النهاية')
        ->get();

    foreach ($tasks as $task) {
        $truck = $task->driver->truck;
        $destination = $task->destination;

        if (!$truck || !$destination) continue;

        $gpsSensor = $truck->sensors()->where('name', 'gps')->first();
        if (!$gpsSensor) continue;

        $lastGps = $gpsSensor->sensorData()->latest('timestamp')->first();
        if (!$lastGps) continue;

        $gps = is_array($lastGps->value) ? $lastGps->value : json_decode($lastGps->value, true);
        if (!isset($gps['lat'], $gps['lng'])) continue;

        // اطبع اسم المحافظة في اللوج
        $governorate = $this->getGovernorateFromCoordinates($gps['lat'], $gps['lng']);
        info('Governorate from GPS: ' . $governorate);

        $distance = $this->calculateDistance(
            $gps['lat'], $gps['lng'],
            $destination->end_latitude, $destination->end_longitude
        );

        if ($distance < 0.1) {
            $task->update(['status' => 'تم الوصول إلى نقطة النهاية']);
            if ($destination->order) {
                $destination->order->update(['status' => 'تم الوصول إلى نقطة النهاية']);
            }
        }
    }
}

private function calculateDistance($lat1, $lon1, $lat2, $lon2)
{
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $km = $dist * 60 * 1.1515 * 1.609344;
    return $km;
}

private function getGovernorateFromCoordinates($lat, $lng)
{
    $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}&zoom=10&addressdetails=1";
    $response = @file_get_contents($url);
    if ($response) {
        $data = json_decode($response, true);
        return $data['address']['state'] ?? $data['address']['county'] ?? $data['address']['city'] ?? null;
    }
    return null;
}

public function store(Request $request)
{
    // ... تحقق من البيانات

    $sensorData = \App\Models\SensorData::create([
        'sensor_id' => $request->sensor_id,
        'value'     => $request->value,
        'obd_code'  => $request->obd_code ?? null,
        // ... باقي الحقول
    ]);

    // استدعاء خدمة التنبيهات بعد الحفظ
    \App\Services\SensorAlertService::checkAndNotify($sensorData);

    // ... باقي الكود (رد أو تحويل)
    return back()->with('success', 'تم حفظ بيانات الحساس.');
}
}
