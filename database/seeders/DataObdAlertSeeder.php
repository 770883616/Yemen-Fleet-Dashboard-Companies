<?php

// namespace Database\Seeders;

// use App\Models\DataObdAlert;
// use App\Models\Alert;
// use App\Models\ObdData;
// use Illuminate\Database\Seeder;

// class DataObdAlertSeeder extends Seeder
// {
//     public function run()
//     {
//         $alerts = Alert::limit(3)->get();
//         $obdData = ObdData::limit(3)->get();

//         if ($alerts->isEmpty() || $obdData->isEmpty()) {
//             $this->call([AlertSeeder::class, ObdDataSeeder::class]);
//             $alerts = Alert::limit(3)->get();
//             $obdData = ObdData::limit(3)->get();
//         }

//         foreach ($alerts as $index => $alert) {
//             DataObdAlert::create([
//                 'alert_id' => $alert->id,
//                 'data_id' => $obdData[$index]->id
//             ]);
//         }
//     }
// }
