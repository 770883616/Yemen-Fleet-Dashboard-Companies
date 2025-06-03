<?php

namespace Database\Seeders;

use App\Models\Alert;
use App\Models\Driver;
use App\Models\Report;
use App\Models\Company;
use App\Models\Accident;
use Illuminate\Database\Seeder;

class AlertSeeder extends Seeder
{
    public function run()
    {
        $drivers = Driver::limit(3)->get();
        $reports = Report::limit(3)->get();
        $companies = Company::limit(3)->get();
        $accidents = Accident::limit(3)->get();

        if ($drivers->isEmpty() || $reports->isEmpty() || $companies->isEmpty() || $accidents->isEmpty()) {
            $this->call([
                CompanySeeder::class,
                DriverSeeder::class,
                ReportSeeder::class,
                AccidentSeeder::class
            ]);
            $drivers = Driver::limit(3)->get();
            $reports = Report::limit(3)->get();
            $companies = Company::limit(3)->get();
            $accidents = Accident::limit(3)->get();
        }

        $alerts = [
            [
                'alert_type' => 'تنبيه عطل ميكايكي',
                'message' => 'تم اكتشاف عطل في نظام الفرامل، يرجى الصيانة الفورية',
                'severity' => 'مرتفع',
                'driver_id' => $drivers[0]->id,
                'report_id' => $reports[0]->id,
                'company_id' => $companies[0]->id,
                'accident_id' => $accidents[0]->id
            ],
            [
                'alert_type' => 'تنبيه تم الدفع',
                'message' => 'تم استلام دفعة الاشتراك الشهري بنجاح',
                'severity' => 'منخفض',
                'driver_id' => $drivers[1]->id,
                'report_id' => $reports[1]->id,
                'company_id' => $companies[1]->id,
                'accident_id' => $accidents[1]->id
            ],
            [
                'alert_type' => 'تنبيه طقس',
                'message' => 'تحذير من عاصفة رملية على طريق الشحن',
                'severity' => 'متوسط',
                'driver_id' => $drivers[2]->id,
                'report_id' => $reports[2]->id,
                'company_id' => $companies[2]->id,
                'accident_id' => $accidents[2]->id
            ]
        ];

        foreach ($alerts as $alert) {
            Alert::create($alert);
        }
    }
}
