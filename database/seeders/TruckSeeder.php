<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Truck;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // الحصول على أول ثلاث شركات من قاعدة البيانات
        $companies = Company::limit(3)->get();

        // إذا لم تكن هناك شركات، يمكنك إنشاؤها هنا أو تشغيل CompanySeeder أولاً
        if ($companies->isEmpty()) {
            $this->call(CompanySeeder::class);
            $companies = Company::limit(3)->get();
        }

        $trucks = [
            [
                'truck_name' => 'الشاحنة الثقيلة 1',
                'plate_number' => 'أ ب ج 1234',
                'chassis_number' => 'CHS12345678901234',
                'latitude' => 24.7136,
                'longitude' => 46.6753,
                'vehicle_status' => 'متوقفة'
            ],
            [
                'truck_name' => 'الشاحنة المتوسطة 1',
                'plate_number' => 'د هـ و 5678',
                'chassis_number' => 'CHS56789012345678',
                'latitude' => 21.5433,
                'longitude' => 39.1728,
                'vehicle_status' => 'نشطة'
            ],
            [
                'truck_name' => 'الشاحنة الخفيفة 1',
                'plate_number' => 'ز ح ط 9012',
                'chassis_number' => 'CHS90123456789012',
                'latitude' => 26.4207,
                'longitude' => 50.0888,
                'vehicle_status' => 'نشطة'
            ]
        ];

        foreach ($trucks as $index => $truckData) {
            // ربط الشاحنة مع الشركة المقابلة
            $truckData['company_id'] = $companies[$index]->id;
            Truck::create($truckData);
        }
    }
}
