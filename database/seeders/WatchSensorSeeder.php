<?php

namespace Database\Seeders;

use App\Models\WatchSensor;
use App\Models\Company;
use Illuminate\Database\Seeder;

class WatchSensorSeeder extends Seeder
{
    public function run()
    {
        $companies = Company::limit(3)->get();

        if ($companies->isEmpty()) {
            $this->call([CompanySeeder::class]);
            $companies = Company::limit(3)->get();
        }

        $sensors = [
            [
                'sensor_name' => 'الساعة الذكية 01',
                'sensor_type' => 'حساسات نبض القلب',
                'company_id' => $companies[0]->id
            ],
            [
                'sensor_name' => 'الساعة الذكية 02',
                'sensor_type' => 'حساسات ضغط الدم',
                'company_id' => $companies[1]->id
            ],
            [
                'sensor_name' => 'الساعة الذكية 03',
                'sensor_type' => 'حساسات نبض القلب',
                'company_id' => $companies[2]->id
            ]
        ];

        foreach ($sensors as $sensor) {
            WatchSensor::create($sensor);
        }
    }
}
