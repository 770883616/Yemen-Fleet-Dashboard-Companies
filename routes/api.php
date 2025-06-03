<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\TaskController;
use App\Models\Task;

Route::get('/trucks', [TruckController::class, 'apiIndex']);
Route::get('/truck-location/{taskId}', function ($taskId) {
    $task = \App\Models\Task::with('truck.sensor')->find($taskId);

    if (!$task || !$task->truck || !$task->truck->sensor) {
        return response()->json(['error' => 'No truck or sensor found'], 404);
    }

    $latestGps = DB::table('sensor_data')
        ->where('sensor_id', $task->truck->sensor->id)
        ->whereNotNull('location')
        ->orderByDesc('timestamp')
        ->first();

    if (!$latestGps) {
        return response()->json(['error' => 'No location data found'], 404);
    }

    return response()->json([
        'location' => $latestGps->location,
        'location_name' => \App\Models\Destination::getLocationNameFromCoords($latestGps->location)
    ]);
});

// routes/api.php
// Route::get('/admin/tasks/{task}/location', [TaskController::class, 'getLocation']);


// Route::get('/tasks/{task}/location', function(Task $task) {
//     try {
//         if (!$task->truck) {
//             return response()->json([
//                 'error' => 'No truck assigned to this task',
//                 'details' => 'Task ID: ' . $task->id
//             ], 400);
//         }

//         if (!$task->truck->gpsSensor) {
//             return response()->json([
//                 'error' => 'No GPS sensor installed on this truck',
//                 'truck' => $task->truck->only(['id', 'truck_name'])
//             ], 400);
//         }

//         $latestLocation = DB::table('sensor_data')
//             ->where('sensor_id', $task->truck->gpsSensor->id)
//             ->where('timestamp', '>', now()->subHours(2)) // بيانات خلال آخر ساعتين
//             ->orderByDesc('timestamp')
//             ->first();

//         if (!$latestLocation) {
//             return response()->json([
//                 'error' => 'No recent GPS data found',
//                 'last_update' => DB::table('sensor_data')
//                     ->where('sensor_id', $task->truck->gpsSensor->id)
//                     ->max('timestamp')
//             ], 404);
//         }

//         return response()->json([
//             'coordinates' => $latestLocation->location,
//             'timestamp' => $latestLocation->timestamp,
//             'sensor_id' => $task->truck->gpsSensor->id,
//             'truck' => $task->truck->truck_name
//         ]);

//     } catch (Exception $e) {
//         return response()->json([
//             'error' => 'Server error',
//             'message' => $e->getMessage()
//         ], 500);
//     }
// });
