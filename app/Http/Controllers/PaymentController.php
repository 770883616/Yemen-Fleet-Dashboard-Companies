<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PaymentController extends Controller
{
    // عرض قائمة الدفعات
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

    // عرض نموذج إضافة دفعة جديدة
    public function create()
    {
        $currentSubscriptions = Subscription::all(); // جلب الاشتراكات لإسناد الدفعة
        return view('pages.Payment.create', compact('subscriptions'));
    }

    // تخزين دفعة جديدة
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'subscription_id' => 'required|exists:subscriptions,id',
        ]);

        Payment::create($request->all());

        return redirect()->route('payments.index')->with('success', 'تم إضافة الدفعة بنجاح.');
    }

    // عرض نموذج تعديل دفعة
    public function edit(Payment $payment)
    {
        $currentSubscriptions = Subscription::all(); // جلب الاشتراكات لإسناد الدفعة
        return view('pages.Payment.edit', compact('payment', 'subscriptions'));
    }

    // تحديث بيانات الدفعة
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'subscription_id' => 'required|exists:subscriptions,id',
        ]);

        $payment->update($request->all());

        return redirect()->route('payments.index')->with('success', 'تم تحديث الدفعة بنجاح.');
    }

    // حذف دفعة
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'تم حذف الدفعة بنجاح.');
    }

    // الدفع الإلكتروني
    public function payOnline(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'payment_method' => 'required|string',
        ]);

        $invoice = \App\Models\Invoice::find($request->invoice_id);
        $invoice->status = 'معلقة';
        $invoice->payment_method = $request->payment_method;
        $invoice->save();

        return redirect()->back()->with('success', 'تم إرسال طلب الدفع بنجاح، سيتم معالجة العملية قريباً.');
    }

    // رفع إثبات التحويل البنكي
    public function uploadProof(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'proof_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $invoice = \App\Models\Invoice::find($request->invoice_id);

        // حفظ الملف
        $path = $request->file('proof_file')->store('payment_proofs', 'public');

        // تحديث الفاتورة
        $invoice->status = 'معلقة';
        $invoice->payment_proof = $path;
        $invoice->save();

        return redirect()->back()->with('success', 'تم رفع إثبات التحويل وسيتم مراجعته من الإدارة.');
    }
}
