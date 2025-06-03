<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'company_name' => 'شركة النقل السريع',
                'address_company' => 'الرياض، حي المروج، شارع الملك فهد',
                'phone_company' => '0112345678',
                'email_company' => 'fast@transport.com',
                'password' => Hash::make('password123'),
                'phone_owner' => '0501234567',
                'owner_name' => 'أحمد محمد',
                'commercial_reg_number' => '123456789',
                'economic_activity' => 'نشاط سياحي',
                'fleet_type' => 'شاحنات ثقيلة (قواطر)'
            ],
            [
                'company_name' => 'شركة الشحن الممتاز',
                'address_company' => 'جدة، حي الصفا، شارع الأمير سلطان',
                'phone_company' => '0123456789',
                'email_company' => 'excellent@shipping.com',
                'password' => Hash::make('password123'),
                'phone_owner' => '0557654321',
                'owner_name' => 'خالد عبدالله',
                'commercial_reg_number' => '987654321',
                'economic_activity' => 'نشاط سياحي',
                'fleet_type' => 'شاحنات ثقيلة (قواطر)'
            ],
            [
                'company_name' => 'شركة النقل الوطني',
                'address_company' => 'الدمام، حي الخليج، شارع الملك عبدالعزيز',
                'phone_company' => '0134567890',
                'email_company' => 'national@transport.com',
                'password' => Hash::make('password123'),
                'phone_owner' => '0549876543',
                'owner_name' => 'سعود علي',
                'commercial_reg_number' => '456789123',
                'economic_activity' => 'نشاط سياحي',
                'fleet_type' => 'شاحنات ثقيلة (قواطر)'
            ]
        ];

        foreach ($companies as $companyData) {
            Company::create($companyData);
        }
    }
}
