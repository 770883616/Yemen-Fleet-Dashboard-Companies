<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Driver;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $drivers = Driver::limit(3)->get();

        if ($drivers->isEmpty()) {
            $this->call([CompanySeeder::class, TruckSeeder::class, DriverSeeder::class]);
            $drivers = Driver::limit(3)->get();
        }

        $tasks = [
            [
                'task_name' => 'توصيل البضاعة إلى المستودع',
                'deadline' => now()->addDays(2),
                'description' => 'توصيل الشحنة إلى مستودع الشركة في الرياض',
                'status' => 'قيد التنفيذ',
                'driver_id' => $drivers[0]->id
            ],
            [
                'task_name' => 'صيانة دورية',
                'deadline' => now()->addDays(5),
                'description' => 'إجراء الصيانة الدورية للشاحنة في الورشة المعتمدة',
                'status' => 'معلق',
                'driver_id' => $drivers[1]->id
            ],
            [
                'task_name' => 'تسليم الشحنة للعميل',
                'deadline' => now()->addDays(1),
                'description' => 'تسليم الشحنة لعميلنا في جدة والتوقيع على الاستلام',
                'status' => 'معلق',
                'driver_id' => $drivers[2]->id
            ]
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
