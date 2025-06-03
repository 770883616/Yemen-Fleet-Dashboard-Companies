<?php

namespace Database\Seeders;

use App\Models\TruckSensor;
use App\Models\Truck;
use App\Models\Company;
use Illuminate\Database\Seeder;

class TruckSensorSeeder extends Seeder
{
    public function run()
    {
        $trucks = Truck::limit(3)->get();
        $companies = Company::limit(3)->get();

        if ($trucks->isEmpty() || $companies->isEmpty()) {
            $this->call([CompanySeeder::class, TruckSeeder::class]);
            $trucks = Truck::limit(3)->get();
            $companies = Company::limit(3)->get();
        }

        $sensors = [
            [
                'sensor_name' => 'GPS Tracker 01',
                'sensor_type' => 'حساسات التتبع',
                'truck_id' => $trucks[0]->id,
                'company_id' => $companies[0]->id
            ],
            [
                'sensor_name' => 'Weather Sensor 01',
                'sensor_type' => 'حساسات الطقس',
                'truck_id' => $trucks[1]->id,
                'company_id' => $companies[1]->id
            ],
            [
                'sensor_name' => 'GPS Tracker 02',
                'sensor_type' => 'حساسات التتبع',
                'truck_id' => $trucks[2]->id,
                'company_id' => $companies[2]->id
            ]
        ];

        foreach ($sensors as $sensor) {
            TruckSensor::create($sensor);
        }
    }
}
