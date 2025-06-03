<?php

namespace Database\Seeders;

use App\Models\ObdData;
use App\Models\ObdDevice;
use Illuminate\Database\Seeder;

class ObdDataSeeder extends Seeder
{
    public function run()
    {
        $devices = ObdDevice::limit(3)->get();

        if ($devices->isEmpty()) {
            $this->call([CompanySeeder::class, TruckSeeder::class, ObdDeviceSeeder::class]);
            $devices = ObdDevice::limit(3)->get();
        }

        $data = [
            [
                'rpm' => 2500,
                'engine_temp' => 85.5,
                'error_codes' => json_encode(['P0172', 'P0300']),
                'device_id' => $devices[0]->id
            ],
            [
                'rpm' => 1800,
                'engine_temp' => 78.2,
                'error_codes' => json_encode([]),
                'device_id' => $devices[1]->id
            ],
            [
                'rpm' => 3000,
                'engine_temp' => 92.0,
                'error_codes' => json_encode(['P0420']),
                'device_id' => $devices[2]->id
            ]
        ];

        foreach ($data as $record) {
            ObdData::create($record);
        }
    }
}
