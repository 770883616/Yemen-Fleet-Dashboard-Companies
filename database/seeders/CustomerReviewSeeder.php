<?php

namespace Database\Seeders;

use App\Models\CustomerReview;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerReviewSeeder extends Seeder
{
    public function run()
    {
        $customers = Customer::limit(3)->get();

        if ($customers->isEmpty()) {
            $this->call([CustomerSeeder::class]);
            $customers = Customer::limit(3)->get();
        }

        $reviews = [
            [
                'customer_id' => $customers[0]->id,
                'rating' => 5,
                'comment' => 'خدمة ممتازة وتوصيل سريع',
                'company_response' => 'شكراً لثقتكم بنا'
            ],
            [
                'customer_id' => $customers[1]->id,
                'rating' => 3,
                'comment' => 'جيدة ولكن التأخير في التسليم',
                'company_response' => 'سنعمل على تحسين خدمة التسليم'
            ],
            [
                'customer_id' => $customers[2]->id,
                'rating' => 4,
                'comment' => 'جيدة جداً ولكن الأسعار مرتفعة قليلاً',
                'company_response' => 'نقدر ملاحظاتكم وسنعمل على تقديم عروض خاصة'
            ]
        ];

        foreach ($reviews as $review) {
            CustomerReview::create($review);
        }
    }
}
