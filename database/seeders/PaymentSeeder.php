<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $payments = [
            [
                'amount' => 1500.00,
                'method' => 'بطاقة الائتمان',
                'status' => 'مكتمل',
                'payment_date' => now()->subDays(10)
            ],
            [
                'amount' => 2500.00,
                'method' => 'التحويل المصرفي',
                'status' => 'مكتمل',
                'payment_date' => now()->subDays(5)
            ],
            [
                'amount' => 1800.00,
                'method' => 'عند التسليم',
                'status' => 'معلق',
                'payment_date' => now()
            ]
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}
