<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\Maintenance;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run()
    {
        $maintenances = Maintenance::limit(3)->get();
        $companies = Company::limit(3)->get();

        if ($maintenances->isEmpty() || $companies->isEmpty()) {
            $this->call([CompanySeeder::class, MaintenanceSeeder::class]);
            $maintenances = Maintenance::limit(3)->get();
            $companies = Company::limit(3)->get();
        }

        $reports = [
            [
                'title' => 'تقرير الصيانة الدورية للشاحنة 1',
                'report_type' => 'تقني',
                'details' => 1,
                'status' => 'معتمد',
                'maintenance_id' => $maintenances[0]->id,
                'company_id' => $companies[0]->id
            ],
            [
                'title' => 'تقرير إصلاح الفرامل الطارئ',
                'report_type' => 'سلامة',
                'details' => 2,
                'status' => 'معلق',
                'maintenance_id' => $maintenances[1]->id,
                'company_id' => $companies[1]->id
            ],
            [
                'title' => 'تقرير المصروفات الشهرية للصيانة',
                'report_type' => 'مالي',
                'details' => 3,
                'status' => 'معتمد',
                'maintenance_id' => $maintenances[2]->id,
                'company_id' => $companies[2]->id
            ]
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }
    }
}
