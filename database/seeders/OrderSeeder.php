<?php
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'total_price' => 150,
            'order_date' => now(),
            'customer_id' => 1, // غيّر للعميل المناسب
            // 'status' => 'قيد التنفيذ', // إذا كان لديك عمود status
        ]);
        // يمكنك تكرار أو استخدام factory لإضافة المزيد
    }
}

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(OrderSeeder::class);
    }
}
