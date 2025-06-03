<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    /**
     * عرض صفحة الاشتراكات الرئيسية
     */
    public function index()
    {
        $company = auth()->guard('company')->user() ?? Company::first();

        if (!$company) {
            return redirect()->route('companies.create')->with('error', 'يجب إنشاء شركة أولاً');
        }

        // الاشتراك الحالي (الأحدث)
        $currentSubscription = Subscription::where('company_id', $company->id)
            ->orderByDesc('end_date')
            ->first();

        // جميع الاشتراكات السابقة (مرتبة من الأحدث للأقدم)
        $allSubscriptions = Subscription::where('company_id', $company->id)
            ->orderByDesc('start_date')
            ->get();

        // جلب الفواتير الخاصة بالشركة (تأكد أن لديك علاقة صحيحة بين الفاتورة والاشتراك)
        $invoices = [];
        if ($currentSubscription) {
            $invoices = \App\Models\Invoice::where('subscription_id', $currentSubscription->id)
                ->orderByDesc('created_at')
                ->get();
        }

        // حساب نسبة الفواتير المدفوعة
        $paidCount = $invoices ? $invoices->where('status', 'مدفوعة')->count() : 0;
        $paidPercent = ($invoices && $invoices->count() > 0) ? round(($paidCount / $invoices->count()) * 100) : 0;

        return view('pages.Subscription.index', [
            'company' => $company,
            'currentSubscription' => $currentSubscription,
            'allSubscriptions' => $allSubscriptions,
            'invoices' => $invoices,
            'paidPercent' => $paidPercent,
        ]);
    }

    /**
     * عرض نموذج إنشاء اشتراك جديد
     */
    public function create()
    {
        $companies = Company::all();
        $paymentMethods = Payment::all();

        return view('pages.Subscription.create', compact('companies', 'paymentMethods'));
    }

    /**
     * حفظ الاشتراك الجديد
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:monthly,yearly',
            'company_id' => 'required|exists:companies,id',
            'payment_id' => 'nullable|exists:payments,id',
        ]);

        // حساب تاريخ الانتهاء بناءً على نوع الاشتراك
        $startDate = now();
        $endDate = $request->type === 'monthly'
            ? now()->addMonth()
            : now()->addYear();

        // حساب السعر بناءً على نوع الاشتراك
        $price = $request->type === 'monthly' ? 100 : 1000;

        Subscription::create([
            'type' => $request->type,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'price' => $price,
            'status' => 'نشط',
            'company_id' => $request->company_id,
            'payment_id' => $request->payment_id,
        ]);

        return redirect()->route('subscriptions.index')
                         ->with('success', 'تم الاشتراك بنجاح!');
    }

    // يمكنك إضافة الطرق الأخرى (show, edit, update, destroy) حسب الحاجة
}


