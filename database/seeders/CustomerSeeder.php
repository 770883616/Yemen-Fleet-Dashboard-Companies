<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Company;
use App\Models\Destination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $companies = Company::limit(3)->get();
        $destinations = Destination::limit(3)->get();

        if ($companies->isEmpty() || $destinations->isEmpty()) {
            $this->call([CompanySeeder::class, DestinationSeeder::class]);
            $companies = Company::limit(3)->get();
            $destinations = Destination::limit(3)->get();
        }

        $customers = [
            [
                'customer_name' => 'شركة الأجهزة المنزلية',
                'address' => 'الرياض، حي العليا',
                'phone' => '0111111111',
                'email' => 'customer1@example.com',
                'password' => Hash::make('customer123'),
                'company_id' => $companies[0]->id,
                'destination_id' => $destinations[0]->id
            ],
            [
                'customer_name' => 'مصنع المواد الغذائية',
                'address' => 'جدة، حي المحمدية',
                'phone' => '0222222222',
                'email' => 'customer2@example.com',
                'password' => Hash::make('customer123'),
                'company_id' => $companies[1]->id,
                'destination_id' => $destinations[1]->id
            ],
            [
                'customer_name' => 'شركة مواد البناء',
                'address' => 'الدمام، حي الراكة',
                'phone' => '0333333333',
                'email' => 'customer3@example.com',
                'password' => Hash::make('customer123'),
                'company_id' => $companies[2]->id,
                'destination_id' => $destinations[2]->id
            ]
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
