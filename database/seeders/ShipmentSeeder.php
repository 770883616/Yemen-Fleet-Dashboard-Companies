<?php

namespace Database\Seeders;

use App\Models\Shipment;
use App\Models\Truck;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    public function run()
    {
        $trucks = Truck::limit(3)->get();

        if ($trucks->isEmpty()) {
            $this->call([CompanySeeder::class, TruckSeeder::class]);
            $trucks = Truck::limit(3)->get();
        }

        $shipments = [
            [
                'shipment_type' => 'قياسي',
                'status' => 'جاري الشحن',
                'destination' => 'الرياض - حي المروج',
                'truck_id' => $trucks[0]->id
            ],
            [
                'shipment_type' => 'صريح',
                'status' => 'معلق',
                'destination' => 'جدة - ميناء جدة الإسلامي',
                'truck_id' => $trucks[1]->id
            ],
            [
                'shipment_type' => 'قياسي',
                'status' => 'متأخر بسبب عطل',
                'destination' => 'الدمام - المنطقة الصناعية',
                'truck_id' => $trucks[2]->id
            ]
        ];

        foreach ($shipments as $shipment) {
            Shipment::create($shipment);
        }
    }
}
