<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['maintenance', 'report', 'payment'])->latest()->paginate(10);

        $totalPaid = Payment::where('status', 'مكتمل')->sum('amount');
        $dueInvoices = Invoice::whereDoesntHave('payment', function($q) {
            $q->where('status', 'مكتمل');
        })->count();
        $currentSubscriptionStatus = 'فعال'; // عدلها حسب نظام الاشتراك لديك

        return view('pages.Payment.index', compact('invoices', 'totalPaid', 'dueInvoices', 'subscriptionStatus'));
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['maintenance', 'report', 'payment']);
        return view('pages.Payment.show', compact('invoice'));
    }
}
