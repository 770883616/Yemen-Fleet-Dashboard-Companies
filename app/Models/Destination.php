<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Destination extends Model
{
    use HasFactory;


    protected $fillable = [
        'start_point',
        'end_point',
        'date',
        'task_id',
        'order_id',
        'end_address',
    ];

    protected $casts = [
        'date' => 'date', // تغيير من datetime إلى date

    ];

    // العلاقات
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }


    public function shipments()
    {
        return $this->hasMany(Shipment::class, 'destination_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'destination_id');
    }

    public function truck()
    {
        // إذا كان لديك عمود truck_id في جدول الوجهات
        return $this->belongsTo(\App\Models\Truck::class, 'truck_id');
    }

    public function driver()
    {
        // إذا كان لديك عمود driver_id في جدول الوجهات
        return $this->belongsTo(\App\Models\Driver::class, 'driver_id');
    }

    // الوظائف
    public function getRoute()
    {
        $coords = $this->start_coordinates
            ? array_map('trim', explode(',', $this->start_coordinates))
            : [null, null];

        return [
            'start' => [
                'address' => $this->start_point,
                'coordinates' => [
                    'lat' => $coords[0],
                    'lng' => $coords[1]
                ]
            ],
            'end' => $this->end_point
        ];
    }

    public function assignToTask(Task $task)
    {
        $this->task()->associate($task);
        return $this->save();
    }

   public static function createDestination($data)
{
    // جلب عنوان التسليم من الطلب إذا لم يتم توفيره
    if (empty($data['end_point']) && !empty($data['order_id'])) {
        $order = Order::find($data['order_id']);
        if ($order) {
            $data['end_point'] = $order->delivery_address;
            $data['end_address'] = $order->delivery_address;
        }
    }

    return self::create([
        'start_point'     => $data['start_point'],
        'start_coordinates' => $data['start_coordinates'] ?? null,
        'end_point'       => $data['end_point'] ?? null,
        'date'            => $data['date'] ?? null,
        'task_id'         => $data['task_id'] ?? null,
        'order_id'        => $data['order_id'] ?? null,
        'end_address'     => $data['end_address'] ?? null,
    ]);
}
    public static function fromSensorData($sensor)
    {
        // جلب آخر قراءة GPS من sensor_data
        $lastSensor = null;
        if ($sensor) {
            $lastSensor = DB::table('sensor_data')
                ->where('sensor_id', $sensor->id)
                ->orderByDesc('timestamp')
                ->first();
        }

        $start_coordinates = null;
        $start_point = 'غير متوفر';

        if ($lastSensor && $lastSensor->location) {
            $start_coordinates = trim($lastSensor->location); // مثال: "13.577137994665447,44.01779136141505"
            [$lat, $lng] = array_map('trim', explode(',', $start_coordinates));
            // جلب اسم الموقع من Nominatim (اختياري)
            $locationName = null;
            try {
                $response = @file_get_contents("https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat={$lat}&lon={$lng}");
                if ($response) {
                    $json = json_decode($response, true);
                    $locationName = $json['display_name'] ?? null;
                }
            } catch (\Exception $e) {
                $locationName = null;
            }
            $start_point = $locationName ?: $start_coordinates;
        }

        return [
            'start_point' => $start_point,
            'start_coordinates' => $start_coordinates,
        ];
    }
// public static function getTruckLocation($taskId)
// {
//        $task = Task::with('truck.gpsSensor')->find($taskId);
//     if (!$task || !$task->truck || !$task->truck->gpsSensor) {
//         return null;
//     }

//     $latestGps = DB::table('sensor_data')
//         ->where('sensor_id', $task->truck->sensor->id)
//         ->whereNotNull('location')
//         ->orderByDesc('timestamp')
//         ->first();

//     if (!$latestGps) {
//         return null;
//     }

//     return [
//         'coordinates' => $latestGps->location,
//         'location_name' => self::getLocationNameFromCoords($latestGps->location)
//     ];
// }

// protected static function getLocationNameFromCoords($coords)
// {
//     try {
//         [$lat, $lng] = array_map('trim', explode(',', $coords));
//         $response = @file_get_contents("https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat={$lat}&lon={$lng}");
//         if ($response) {
//             $json = json_decode($response, true);
//             return $json['display_name'] ?? $coords;
//         }
//     } catch (\Exception $e) {
//         return $coords;
//     }
//     return $coords;
// }

public static function getTruckLocation($taskId)
{
    $task = Task::with('truck.gpsSensor')->find($taskId);
    if (!$task || !$task->truck || !$task->truck->gpsSensor) return null;

    $latestGps = DB::table('sensor_data')
        ->where('sensor_id', $task->truck->gpsSensor->id)
        ->whereNotNull('location')
        ->orderByDesc('timestamp')
        ->first();

    if (!$latestGps) return null;

    return [
        'coordinates' => $latestGps->location,
        'location_name' => self::getLocationNameFromCoords($latestGps->location)
    ];
}


public static function getLocationNameFromCoords($coords)
{
    try {
        [$lat, $lng] = array_map('trim', explode(',', $coords));

        $response = Http::timeout(3)->get("https://nominatim.openstreetmap.org/reverse", [
            'format' => 'json',
            'lat' => $lat,
            'lon' => $lng,
            'zoom' => 18,
            'addressdetails' => 1
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['display_name'] ?? $coords;
        }
    } catch (Exception $e) {
        Log::error("Failed to get location name: " . $e->getMessage());
    }

    return $coords;
}
}
