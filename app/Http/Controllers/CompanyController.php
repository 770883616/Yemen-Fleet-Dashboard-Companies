<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyOrder;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        // $companies = Company::all();
        return view('pages.Companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register'); // عرض صفحة التسجيل
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name'            => 'required|string|max:255',
            'address_company'         => 'required|string',
            'phone_company'           => 'required|string|max:20',
            'email_company'           => 'required|email|unique:companies,email_company',
            'password'                => 'required|string|min:8|confirmed', // تأكيد كلمة المرور
            'owner_name'              => 'required|string|max:255', // <-- الاسم الصحيح
            'phone_owner'             => 'required|string|max:20',  // <-- الاسم الصحيح
            'commercial_reg_number'   => 'required|string|unique:companies,commercial_reg_number',
            'economic_activity'       => 'required|string', // <-- الاسم الصحيح
            'fleet_type'              => 'required|string' // <-- الاسم الصحيح
        ]);

        // تشفير كلمة المرور
        $validated['password'] = bcrypt($validated['password']);

        // إنشاء الحساب
        $company = Company::create($validated);

        // تسجيل الدخول تلقائيًا
        auth()->guard('company')->login($company);

        // إعادة التوجيه إلى صفحة تسجيل الدخول مع رسالة ترحيب
        return redirect()->route('company.login')->with('success', 'تم إنشاء الحساب بنجاح. يمكنك الآن تسجيل الدخول.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('pages.Companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {

$validated = $request->validate([
    'company_name'            => 'required|string|max:255',
    'address_company'         => 'required|string',
    'phone_company'           => 'required|string|max:20',
    'email_company'           => 'required|email|unique:companies,email_company,' . $company->id,
    'password'                => 'nullable|string|min:8|confirmed',
    'owner_name'              => 'required|string|max:255',
    'phone_owner'             => 'required|string|max:20',
    'commercial_reg_number'   => 'required|string|unique:companies,commercial_reg_number,' . $company->id,
    'economic_activity'       => 'required|string',
    'fleet_type'              => 'required|string'
]);

        // Only update password if it's provided
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']);
        }

        $company->update($validated);

        return redirect()->route('companies.index')
            ->with('success', 'تم تحديث بيانات الشركة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully');
    }
}

class CompanyOrderController extends Controller
{
    // عرض جميع طلبات الشركات
    public function index()
    {
        $companyOrders = CompanyOrder::with(['company', 'order.customer'])->latest()->paginate(15);
        return view('pages.CompanyOrder.index', compact('companyOrders'));
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
