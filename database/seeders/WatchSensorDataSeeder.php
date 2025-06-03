<?php

namespace Database\Seeders;

use App\Models\WatchSensorData;
use Illuminate\Database\Seeder;

class WatchSensorDataSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'heart_rate' => 72,
                'blood_pressure' => '120/80'
            ],
            [
                'heart_rate' => 85,
                'blood_pressure' => '130/85'
            ],
            [
                'heart_rate' => 68,
                'blood_pressure' => '115/75'
            ]
        ];

        foreach ($data as $item) {
            WatchSensorData::create($item);
        }
    }
}
