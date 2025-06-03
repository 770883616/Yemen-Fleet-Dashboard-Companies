<?php

// namespace App\Console\Commands;

// use Illuminate\Console\Command;
// use App\Models\Task;

// class CheckArrivalTasks extends Command
// {
//     protected $signature = 'tasks:check-arrival';
//     protected $description = 'تحديث حالة المهام والطلبات عند وصول الشاحنة لنقطة النهاية';

//     public function handle()
//     {
//         $tasks = Task::with(['driver.truck', 'destination', 'destination.order'])
//             ->where('status', '!=', 'تم الوصول إلى نقطة النهاية')
//             ->get();

//         foreach ($tasks as $task) {
//             $truck = $task->driver->truck ?? null;
//             $destination = $task->destination ?? null;

//             if (!$truck || !$destination) continue;

//             $gpsSensor = $truck->sensors()->where('name', 'gps')->first();
//             if (!$gpsSensor) continue;

//             $lastGps = $gpsSensor->sensorData()->latest('timestamp')->first();
//             if (!$lastGps) continue;

//             $gps = is_array($lastGps->value) ? $lastGps->value : json_decode($lastGps->value, true);
//             if (!isset($gps['lat'], $gps['lng'])) continue;

//             $distance = $this->calculateDistance(
//                 $gps['lat'], $gps['lng'],
//                 $destination->start_latitude, $destination->start_longitude
//             );

//             if ($distance < 0.1) {
//                 $task->update(['status' => 'تم الوصول إلى نقطة النهاية']);
//                 if ($destination->order) {
//                     $destination->order->update(['status' => 'تم الوصول إلى نقطة النهاية']);
//                 }
//             }
//         }

//         $this->info('تم فحص جميع المهام وتحديث الحالات.');
//     }

//     private function calculateDistance($lat1, $lon1, $lat2, $lon2)
//     {
//         $theta = $lon1 - $lon2;
//         $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
//                 cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
//         $dist = acos($dist);
//         $dist = rad2deg($dist);
//         $km = $dist * 60 * 1.1515 * 1.609344;
//         return $km;
//     }
// }
