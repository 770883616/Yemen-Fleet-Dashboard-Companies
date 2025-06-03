<?php

namespace Database\Seeders;

use App\Models\TruckSensorData;
use Illuminate\Database\Seeder;

class TruckSensorDataSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'location_data' => json_encode([
                    'latitude' => 24.7136,
                    'longitude' => 46.6753,
                    'speed' => 80,
                    'direction' => 'NE'
                ]),
                'weather_data' => json_encode([
                    'temperature' => 32,
                    'humidity' => 45,
                    'wind_speed' => 15
                ])
            ],
            [
                'location_data' => json_encode([
                    'latitude' => 21.5433,
                    'longitude' => 39.1728,
                    'speed' => 65,
                    'direction' => 'NW'
                ]),
                'weather_data' => json_encode([
                    'temperature' => 38,
                    'humidity' => 30,
                    'wind_speed' => 20
                ])
            ],
            [
                'location_data' => json_encode([
                    'latitude' => 26.4207,
                    'longitude' => 50.0888,
                    'speed' => 0,
                    'direction' => 'N'
                ]),
                'weather_data' => json_encode([
                    'temperature' => 28,
                    'humidity' => 60,
                    'wind_speed' => 10
                ])
            ]
        ];

        foreach ($data as $item) {
            TruckSensorData::create($item);
        }
    }
}
