<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyDashboardController extends Controller
{
    public function index()
    {
        // جلب بيانات الشركة الحالية
        $company = auth()->guard('company')->user();

        // احصل على كل العملاء التابعين للشركة
        $customerIds = \App\Models\Customer::where('company_id', $company->id)->pluck('id');

        // استعلامات الطلبات حسب حالة الطلب
        $ordersCount = \App\Models\Order::whereIn('customer_id', $customerIds)->count();
        $ordersInProgress = \App\Models\Order::whereIn('customer_id', $customerIds)->where('status', 'قيد التنفيذ')->count();
        $ordersPending = \App\Models\Order::whereIn('customer_id', $customerIds)->where('status', 'تحت المراجعة')->count();
        $ordersDelivered = \App\Models\Order::whereIn('customer_id', $customerIds)->where('status', 'تم التسليم')->count();

        // باقي البيانات...

        // تمرير البيانات إلى العرض
        return view('dashboard', compact(
            'ordersCount',
            'ordersInProgress',
            'ordersPending',
            'ordersDelivered',
            // ... باقي المتغيرات
        ));
    }
}
