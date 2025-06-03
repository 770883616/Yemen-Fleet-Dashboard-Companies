<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\Company;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run()
    {
        $companies = Company::limit(3)->get();
        $payments = Payment::limit(3)->get();

        if ($companies->isEmpty() || $payments->isEmpty()) {
            $this->call([CompanySeeder::class, PaymentSeeder::class]);
            $companies = Company::limit(3)->get();
            $payments = Payment::limit(3)->get();
        }

        $currentSubscriptions = [
            [
                'subscription_type' => 'شهري',
                'start_date' => now()->format('Y-m-d'),
                'end_date' => now()->addMonth()->format('Y-m-d'),
                'price' => 1500.00,
                'status' => 'نشط',
                'company_id' => $companies[0]->id,
                'payment_id' => $payments[0]->id
            ],
            [
                'subscription_type' => 'سنوي',
                'start_date' => now()->format('Y-m-d'),
                'end_date' => now()->addYear()->format('Y-m-d'),
                'price' => 15000.00,
                'status' => 'نشط',
                'company_id' => $companies[1]->id,
                'payment_id' => $payments[1]->id
            ],
            [
                'subscription_type' => 'شهري',
                'start_date' => now()->subMonth()->format('Y-m-d'),
                'end_date' => now()->format('Y-m-d'),
                'price' => 1500.00,
                'status' => 'منتهي الصلاحية',
                'company_id' => $companies[2]->id,
                'payment_id' => $payments[2]->id
            ]
        ];

        foreach ($currentSubscriptions as $currentSubscription) {
            Subscription::create($currentSubscription);
        }
    }
}
