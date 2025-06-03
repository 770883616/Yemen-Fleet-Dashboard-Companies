<?php

// namespace Database\Seeders;

// use App\Models\products;
// use App\Models\Company;
// use App\Models\Order;
// use Illuminate\Database\Seeder;

// class productsSeeder extends Seeder
// {
//     public function run()
//     {
//         $companies = Company::limit(3)->get();
//         $orders = Order::limit(3)->get();

//         if ($companies->isEmpty() || $orders->isEmpty()) {
//             $this->call([
//                 CompanySeeder::class,
//                 OrderSeeder::class
//             ]);
//             $companies = Company::limit(3)->get();
//             $orders = Order::limit(3)->get();
//         }

//         $productsItems = [
//             [
//                 'product_name' => 'إطارات شاحنة مقاس 22',
//                 'quantity' => 50,
//                 'price' => 1200.00,
//                 'company_id' => $companies[0]->id,
//                 'order_id' => $orders[0]->id
//             ],
//             [
//                 'product_name' => 'زيت محرك 10W40',
//                 'quantity' => 100,
//                 'price' => 150.00,
//                 'company_id' => $companies[1]->id,
//                 'order_id' => $orders[1]->id
//             ],
//             [
//                 'product_name' => 'فلتر هواء شاحنة',
//                 'quantity' => 30,
//                 'price' => 300.00,
//                 'company_id' => $companies[2]->id,
//                 'order_id' => $orders[2]->id
//             ]
//         ];

//         foreach ($productsItems as $item) {
//             products::create($item);
//         }
//     }
// }
