<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
        TruckSeeder::class,
        DriverSeeder::class,
        ObdDeviceSeeder::class,
        ObdDataSeeder::class,
        TaskSeeder::class,
        DestinationSeeder::class,
        AccidentSeeder::class,
        CustomerSeeder::class,
        MaintenanceSeeder::class,
        ReportSeeder::class,
        PaymentSeeder::class,
        SubscriptionSeeder::class,
        ShipmentSeeder::class,
        AlertSeeder::class,
        OrderSeeder::class,
        // productsSeeder::class,
        OfferSeeder::class,
        InvoiceSeeder::class,
        CustomerReviewSeeder::class,
        TruckSensorSeeder::class,
        TruckSensorDataSeeder::class,
        WatchSensorSeeder::class,
        WatchSensorDataSeeder::class,
        // DataObdAlertSeeder::class,
        // ReportAlertSeeder::class,

        ]);
    }
}
