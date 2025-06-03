<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use App\Models\Truck;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    public function run()
    {
        $trucks = Truck::limit(3)->get();

        if ($trucks->isEmpty()) {
            $this->call([CompanySeeder::class, TruckSeeder::class]);
            $trucks = Truck::limit(3)->get();
        }

        $maintenances = [
            [
                'maintenance_type' => 'روتيني',
                'cost' => 1500.00,
                'date' => now()->subDays(10)->format('Y-m-d'),
                'description' => 'صيانة دورية للشاحنة وتغيير الزيوت والفلاتر',
                'truck_id' => $trucks[0]->id
            ],
            [
                'maintenance_type' => 'طوارئ',
                'cost' => 3500.00,
                'date' => now()->subDays(5)->format('Y-m-d'),
                'description' => 'إصلاح نظام الفرامل بعد الحادث',
                'truck_id' => $trucks[1]->id
            ],
            [
                'maintenance_type' => 'روتيني',
                'cost' => 2000.00,
                'date' => now()->subDays(20)->format('Y-m-d'),
                'description' => 'فحص شامل للشاحنة واستبدال بعض القطع',
                'truck_id' => $trucks[2]->id
            ]
        ];

        foreach ($maintenances as $maintenance) {
            Maintenance::create($maintenance);
        }
    }
}
