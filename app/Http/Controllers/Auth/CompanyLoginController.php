<?php

namespace App\Http\Controllers\Auth;

use App\Models\Order;
use App\Models\Truck;
use App\Models\Company;
use App\Models\Accident;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Console\View\Components\Task; // Remove this if not needed
use App\Models\Task; // Ensure the correct namespace for the Task model
use App\Models\Driver; // Ensure the correct namespace for the Driver model
use App\Models\Product;

class CompanyLoginController extends Controller
{
    /**
     * عرض نموذج تسجيل الدخول
     */
    public function showLoginForm()
    {
        return view('auth.company-login');
    }

    /**
     * معالجة محاولة تسجيل الدخول
     */
public function login(Request $request)
{
    $credentials = $request->validate([
        'email_company' => 'required|email',
        'password'      => 'required|string',
    ]);

    if (Auth::guard('company')->attempt([
        'email_company' => $credentials['email_company'],
        'password'      => $credentials['password'],
    ])) {
        $request->session()->regenerate();

        $company = Auth::guard('company')->user();

        // التحقق من وجود اشتراك نشط
        $activeSubscription = $company->subscriptions()
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->latest()
            ->first();

        if (!$activeSubscription) {
            Auth::guard('company')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // التحقق مما إذا كانت هناك أي اشتراكات (منتهية أو ملغاة)
            $hasAnySubscription = $company->subscriptions()->exists();

            return redirect()->route('subscription.expired')->with([
                'message' => $hasAnySubscription
                    ? 'انتهى اشتراكك. يرجى تجديد الاشتراك.'
                    : 'ليس لديك اشتراك نشط. يرجى الاشتراك أولاً.',
                'has_subscription' => $hasAnySubscription
            ]);
        }

        // إذا كان هناك اشتراك نشط، توجيه إلى dashboard
        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email_company' => 'بيانات الاعتماد هذه لا تتطابق مع سجلاتنا.',
    ]);
}

    /**
     * تسجيل الخروج
     */
    public function logout(Request $request)
    {
        Auth::guard('company')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/company/login');
    }

    /**
     * عرض لوحة تحكم الشركة
     */
    public function dashboard()
    {
        $driversCount = Driver::count();

        // السائقين الذين لديهم مهام
        $driversWithTasks = Driver::whereHas('tasks')->count();

        // السائقين الذين ليس لديهم مهام
        $driversWithoutTasks = Driver::whereDoesntHave('tasks')->count();

        // احصل على إجمالي المركبات الخاصة بالشركة
        $company = auth()->guard('company')->user();
        $totalTrucks = Truck::where('company_id', $company->id)->count();
        $activeTrucks = Truck::where('company_id', $company->id)->where('vehicle_status', 'نشطة')->count();
        $stoppedTrucks = Truck::where('company_id', $company->id)->where('vehicle_status', 'متوقفة')->count();
        $maintenanceTrucks = Truck::where('company_id', $company->id)->where('vehicle_status', 'تحت الصيانة')->count();

        // احصل على عدد المهام
        $tasksCount = Task::count();
        $tasksInProgress = Task::where('status', 'قيد التنفيذ')->count(); // المهام قيد التنفيذ
        $tasksPending = Task::where('status', 'معلق')->count(); // المهام المعلقة
        $tasksCompleted = Task::where('status', 'تم انجازالمهمه')->count(); // المهام المكتملة

        // جلب بيانات الوجهات
        $destinations = Destination::all();

        // جلب بيانات الحوادث
        $accidents = Accident::all();

        // المنتجات
        $totalProducts = Product::count();
        $totalQuantity = Product::sum('quantity');
        $lowStockProducts = Product::where('quantity', '<', 10)->count();

        // جلب قائمة المركبات الخاصة بالشركة
        $trucksList = Truck::where('company_id', $company->id)->get();

        // احصل على كل العملاء التابعين للشركة

        // احصل على الشركة الحالية
        $company = auth()->guard('company')->user();

        // جلب جميع طلبات الشركة
        $companyOrders = \App\Models\CompanyOrder::with('order')
            ->where('company_id', $company->id)
            ->orderByDesc('created_at')
            ->get();

        $ordersCount = $companyOrders->count();

        // مرر العدد إلى العرض
        return view('dashboard', compact(
            'driversCount',
            'driversWithTasks',
            'driversWithoutTasks',
            'tasksCount',
            'totalTrucks',
            'activeTrucks',
            'stoppedTrucks',
            'maintenanceTrucks',
            'tasksInProgress',
            'tasksPending',
            'tasksCompleted',
            'destinations',
            'accidents',
            'totalProducts',
            'totalQuantity',
            'lowStockProducts',
            'trucksList',
            'companyOrders',
            'ordersCount'
        ));
    }
}
