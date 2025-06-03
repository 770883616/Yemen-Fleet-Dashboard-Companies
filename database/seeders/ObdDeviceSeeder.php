<?php

namespace Database\Seeders;

use App\Models\ObdDevice;
use App\Models\Truck;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ObdDeviceSeeder extends Seeder
{
    public function run()
    {
        $trucks = Truck::with('company')->limit(3)->get();

        if ($trucks->isEmpty()) {
            $this->call([CompanySeeder::class, TruckSeeder::class]);
            $trucks = Truck::with('company')->limit(3)->get();
        }

        $devices = [
            [
                'device_name' => 'جهاز OBD-1',
                'device_type' => 'OBD-II',
                'truck_id' => $trucks[0]->id,
                'company_id' => $trucks[0]->company->id
            ],
            [
                'device_name' => 'جهاز ELM-1',
                'device_type' => 'ELM327',
                'truck_id' => $trucks[1]->id,
                'company_id' => $trucks[1]->company->id
            ],
            [
                'device_name' => 'جهاز MCP-1',
                'device_type' => 'MCP2515',
                'truck_id' => $trucks[2]->id,
                'company_id' => $trucks[2]->company->id
            ]
        ];

        foreach ($devices as $device) {
            ObdDevice::create($device);
        }
    }
}
