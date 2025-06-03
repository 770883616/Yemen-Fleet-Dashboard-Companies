<?php

namespace Database\Seeders;

use App\Models\Accident;
use App\Models\Truck;
use Illuminate\Database\Seeder;

class AccidentSeeder extends Seeder
{
    public function run()
    {
        $trucks = Truck::limit(3)->get();

        if ($trucks->isEmpty()) {
            $this->call([CompanySeeder::class, TruckSeeder::class]);
            $trucks = Truck::limit(3)->get();
        }

        $accidents = [
            [
                'location' => 'طريق الرياض - الدمام، كم 120',
                'accident_type' => 'الاصطدام',
                'description' => 'اصطدام بالحاجز الأيمن بسبب انزلاق',
                'truck_id' => $trucks[0]->id
            ],
            [
                'location' => 'طريق مكة - جدة، كم 15',
                'accident_type' => 'الانهيار',
                'description' => 'انهيار في الإطار الخلفي الأيسر',
                'truck_id' => $trucks[1]->id
            ],
            [
                'location' => 'طريق المدينة - تبوك، كم 200',
                'accident_type' => 'اخرى',
                'description' => 'عطل مفاجئ في نظام الفرامل',
                'truck_id' => $trucks[2]->id
            ]
        ];

        foreach ($accidents as $accident) {
            Accident::create($accident);
        }
    }
}
