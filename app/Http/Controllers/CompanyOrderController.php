<?php

namespace App\Http\Controllers;

use App\Models\CompanyOrder;
use Illuminate\Http\Request;

class CompanyOrderController extends Controller
{
    // عرض جميع طلبات الشركات
    public function index()
    {
        // جلب جميع طلبات الشركات مع بيانات الشركة والعميل المرتبطين
        $companyOrders = CompanyOrder::with([
            'company',                // بيانات الشركة
            'order.customer'          // بيانات العميل المرتبط بالطلب
        ])->latest()->paginate(15);

        // إرسال البيانات إلى صفحة العرض
        return view('pages.CompanyOrder.index', [
            'companyOrders' => $companyOrders
        ]);
    }

    // عرض تفاصيل طلب شركة
    public function show($id)
    {
        $order = CompanyOrder::with(['company', 'order.customer'])->findOrFail($id);
        return view('pages.CompanyOrder.show', compact('order'));
    }

    // الموافقة على طلب شركة
    public function approve($id)
    {
        $order = CompanyOrder::findOrFail($id);
        $order->status = 'approved';
        $order->save();

        return redirect()->back()->with('success', 'تمت الموافقة على الطلب بنجاح.');
    }

    // تعليق طلب شركة
    public function suspend($id)
    {
        $order = CompanyOrder::findOrFail($id);
        $order->status = 'suspended';
        $order->save();

        return redirect()->back()->with('success', 'تم تعليق الطلب بنجاح.');
    }

    // إلغاء تعليق طلب شركة
    public function unsuspend($id)
    {
        $order = CompanyOrder::findOrFail($id);
        $order->status = 'pending';
        $order->save();

        return redirect()->back()->with('success', 'تم إلغاء التعليق وإعادة الطلب إلى قيد الانتظار.');
    }
}
