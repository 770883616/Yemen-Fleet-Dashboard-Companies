<?php

// namespace Database\Seeders;


// use App\Models\Alert;
// use App\Models\Report;
// use App\Models\ReportsAlret;
// use Illuminate\Database\Seeder;

// class ReportAlertSeeder extends Seeder
// {
//     public function run()
//     {
//         $reports = Report::limit(3)->get();
//         $alerts = Alert::limit(3)->get();

//         if ($reports->isEmpty() || $alerts->isEmpty()) {
//             $this->call([ReportSeeder::class, AlertSeeder::class]);
//             $reports = Report::limit(3)->get();
//             $alerts = Alert::limit(3)->get();
//         }

//         foreach ($reports as $index => $report) {
//             ReportsAlret::create([
//                 'report_id' => $report->id,
//                 'alert_id' => $alerts[$index]->id
//             ]);
//         }
//     }
// }
