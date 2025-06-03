<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    public function run()
    {
        $offers = [
            [
                'offer_code' => 'SUMMER2023',
                'discount' => 15.00,
                'valid_from' => now()->format('Y-m-d'),
                'valid_to' => now()->addMonth()->format('Y-m-d'),
                'max_uses' => 100,
                'current_uses' => 25,
                'applicable_to' => 'الكل',
                'description' => 'خصم الصيف على جميع الخدمات',
                'is_active' => true
            ],
            [
                'offer_code' => 'COMPANY10',
                'discount' => 10.00,
                'valid_from' => now()->format('Y-m-d'),
                'valid_to' => now()->addMonths(3)->format('Y-m-d'),
                'max_uses' => 50,
                'current_uses' => 10,
                'applicable_to' => 'الشركات',
                'description' => 'خصم خاص للشركات المسجلة',
                'is_active' => true
            ],
            [
                'offer_code' => 'NEWCUSTOMER',
                'discount' => 20.00,
                'valid_from' => now()->subDays(15)->format('Y-m-d'),
                'valid_to' => now()->addDays(15)->format('Y-m-d'),
                'max_uses' => 200,
                'current_uses' => 75,
                'applicable_to' => 'العملاء',
                'description' => 'خصم ترحيبي للعملاء الجدد',
                'is_active' => false
            ]
        ];

        foreach ($offers as $offer) {
            Offer::create($offer);
        }
    }
}
