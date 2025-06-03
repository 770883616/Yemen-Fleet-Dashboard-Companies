<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Maintenance;
use App\Models\Report;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
        $maintenances = Maintenance::limit(3)->get();
        $reports = Report::limit(3)->get();
        $payments = Payment::limit(3)->get();

        if ($maintenances->isEmpty() || $reports->isEmpty() || $payments->isEmpty()) {
            $this->call([
                MaintenanceSeeder::class,
                ReportSeeder::class,
                PaymentSeeder::class
            ]);
            $maintenances = Maintenance::limit(3)->get();
            $reports = Report::limit(3)->get();
            $payments = Payment::limit(3)->get();
        }

        $invoices = [
            [
                'invoice_title' => 'INV-2023-001',
                'amount' => 1500.00,
                'due_date' => now()->addDays(30)->format('Y-m-d'),
                'maintenance_id' => $maintenances[0]->id,
                'report_id' => $reports[0]->id,
                'payment_id' => $payments[0]->id,
                'invoice_num' => 1001
            ],
            [
                'invoice_title' => 'INV-2023-002',
                'amount' => 2500.00,
                'due_date' => now()->addDays(15)->format('Y-m-d'),
                'maintenance_id' => $maintenances[1]->id,
                'report_id' => $reports[1]->id,
                'payment_id' => $payments[1]->id,
                'invoice_num' => 1002
            ],
            [
                'invoice_title' => 'INV-2023-003',
                'amount' => 1800.00,
                'due_date' => now()->addDays(45)->format('Y-m-d'),
                'maintenance_id' => $maintenances[2]->id,
                'report_id' => $reports[2]->id,
                'payment_id' => $payments[2]->id,
                'invoice_num' => 1003
            ]
        ];

        foreach ($invoices as $invoice) {
            Invoice::create($invoice);
        }
    }
}
