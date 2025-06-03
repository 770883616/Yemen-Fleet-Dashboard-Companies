<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Truck;
use App\Models\Task;
use App\Models\Driver;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        $trucks = Truck::limit(3)->get();
        $tasks = Task::limit(3)->get();
        $drivers = Driver::limit(3)->get();

        if ($trucks->isEmpty() || $tasks->isEmpty() || $drivers->isEmpty()) {
            $this->call([CompanySeeder::class, TruckSeeder::class, DriverSeeder::class, TaskSeeder::class]);
            $trucks = Truck::limit(3)->get();
            $tasks = Task::limit(3)->get();
            $drivers = Driver::limit(3)->get();
        }

        $destinations = [
            [
                'start_point' => 'الرياض، المستودع الرئيسي',
                'end_point' => 'جدة، ميناء جدة الإسلامي',
                'estimated_time' => 10,
                'date' => now()->addDays(2)->format('Y-m-d'),
                'truck_id' => $trucks[0]->id,
                'task_id' => $tasks[0]->id,
                'driver_id' => $drivers[0]->id
            ],
            [
                'start_point' => 'الدمام، منطقة الصناعات',
                'end_point' => 'الرياض، منطقة السلي',
                'estimated_time' => 8,
                'date' => now()->addDays(3)->format('Y-m-d'),
                'truck_id' => $trucks[1]->id,
                'task_id' => $tasks[1]->id,
                'driver_id' => $drivers[1]->id
            ],
            [
                'start_point' => 'جدة، مستودع الشركة',
                'end_point' => 'تبوك، منطقة التجارة',
                'estimated_time' => 15,
                'date' => now()->addDays(5)->format('Y-m-d'),
                'truck_id' => $trucks[2]->id,
                'task_id' => $tasks[2]->id,
                'driver_id' => $drivers[2]->id
            ]
        ];

        foreach ($destinations as $destination) {
            Destination::create($destination);
        }
    }
}
