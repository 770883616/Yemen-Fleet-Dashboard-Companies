<?php
namespace App\Services;

use App\Models\Notification;
use App\Models\SensorData;
use App\Models\Sensor;
use App\Models\Driver;
use App\Models\Truck;

class SensorAlertService
{
    public static function checkAndNotify(SensorData $data)
    {
        $sensor = $data->sensor ?? Sensor::find($data->sensor_id);
        if (!$sensor) return;

        $type = $sensor->name;
        $value = is_array($data->value) ? $data->value : json_decode($data->value, true);

        // 1. heart_rate
        if ($type === 'heart_rate' && is_array($value) && isset($value['rate'])) {
            if ($value['rate'] > 120 || $value['rate'] < 50) {
                Notification::create([
                    'message' => 'معدل نبض القلب غير طبيعي: ' . $value['rate'] . ' نبضة/دقيقة',
                    'notifiable_id' => $sensor->driver_id,
                    'notifiable_type' => Driver::class,
                    'is_read' => false,
                    'is_group_message' => false,
                    'sender_id' => null,
                    'sender_type' => null,
                ]);
            }
        }

        // 2. blood_pressure
        if ($type === 'blood_pressure' && is_array($value) && isset($value['reading'])) {
            [$sys, $dia] = explode('/', $value['reading']);
            if ($sys > 140 || $dia > 90 || $sys < 90 || $dia < 60) {
                Notification::create([
                    'message' => 'ضغط الدم غير طبيعي: ' . $value['reading'],
                    'notifiable_id' => $sensor->driver_id,
                    'notifiable_type' => Driver::class,
                    'is_read' => false,
                    'is_group_message' => false,
                    'sender_id' => null,
                    'sender_type' => null,
                ]);
            }
        }

        // 3. gps
        if ($type === 'gps' && is_array($value)) {
            if ((isset($value['speed']) && isset($value['speed_limit']) && $value['speed'] > $value['speed_limit'])
                || (!empty($value['is_off_route']))) {
                Notification::create([
                    'message' => 'تنبيه GPS: سرعة زائدة أو خروج عن المسار',
                    'notifiable_id' => $sensor->truck_id,
                    'notifiable_type' => Truck::class,
                    'is_read' => false,
                    'is_group_message' => false,
                    'sender_id' => null,
                    'sender_type' => null,
                ]);
            }
        }

        // 4. obd
        if ($type === 'obd') {
            if (!empty($data->obd_code) && (str_starts_with($data->obd_code, 'P0') || str_starts_with($data->obd_code, 'P1'))) {
                Notification::create([
                    'message' => 'عطل خطير في المحرك: ' . $data->obd_code,
                    'notifiable_id' => $sensor->truck_id,
                    'notifiable_type' => Truck::class,
                    'is_read' => false,
                    'is_group_message' => false,
                    'sender_id' => null,
                    'sender_type' => null,
                ]);
            }
            if (is_array($value) && isset($value['engine_temp']) && $value['engine_temp'] > 110) {
                Notification::create([
                    'message' => 'درجة حرارة المحرك مرتفعة: ' . $value['engine_temp'] . '°م',
                    'notifiable_id' => $sensor->truck_id,
                    'notifiable_type' => Truck::class,
                    'is_read' => false,
                    'is_group_message' => false,
                    'sender_id' => null,
                    'sender_type' => null,
                ]);
            }
        }

        // 5. weather
        if ($type === 'weather' && is_array($value)) {
            if ((isset($value['temp']) && $value['temp'] > 45)
                || (isset($value['wind_speed']) && $value['wind_speed'] > 80)
                || (isset($value['humidity']) && $value['humidity'] > 90)) {
                Notification::create([
                    'message' => 'تنبيه طقس: درجة حرارة أو رياح أو رطوبة مرتفعة',
                    'notifiable_id' => $sensor->truck_id,
                    'notifiable_type' => Truck::class,
                    'is_read' => false,
                    'is_group_message' => false,
                    'sender_id' => null,
                    'sender_type' => null,
                ]);
            }
        }
    }
}
