<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Truck;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DriverSeeder extends Seeder
{
    public function run()
    {
        $trucks = Truck::limit(3)->get();

        if ($trucks->isEmpty()) {
            $this->call([CompanySeeder::class, TruckSeeder::class]);
            $trucks = Truck::limit(3)->get();
        }

        $drivers = [
            [
                'driver_name' => 'محمد أحمد',
                'address' => 'الرياض، حي النخيل',
                'email' => 'mohamed@example.com',
                'phone' => '0501111222',
                'password' => Hash::make('driver123'),
                'truck_id' => $trucks[0]->id
            ],
            [
                'driver_name' => 'علي خالد',
                'address' => 'جدة، حي الصفا',
                'email' => 'ali@example.com',
                'phone' => '0502222333',
                'password' => Hash::make('driver123'),
                'truck_id' => $trucks[1]->id
            ],
            [
                'driver_name' => 'سعود عبدالله',
                'address' => 'الدمام، حي الخليج',
                'email' => 'saud@example.com',
                'phone' => '0503333444',
                'password' => Hash::make('driver123'),
                'truck_id' => $trucks[2]->id
            ]
        ];

        foreach ($drivers as $driver) {
            Driver::create($driver);
        }
    }
}
