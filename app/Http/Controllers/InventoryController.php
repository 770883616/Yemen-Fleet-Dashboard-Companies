<?php

// namespace App\Http\Controllers;

// use App\Models\products;
// use App\Models\Company;
// use App\Models\Order;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class productsController extends Controller
// {
//     /**
//      * عرض قائمة المنتجات
//      */
//     public function index(Request $request)
//     {
//         // البحث والتصفية
//         $query = products::with(['company', 'order'])
//             ->when($request->search, function($q) use ($request) {
//                 $q->where('product_name', 'like', '%'.$request->search.'%');
//             })
//             ->when($request->company_id, function($q) use ($request) {
//                 $q->where('company_id', $request->company_id);
//             })
//             ->when($request->min_price, function($q) use ($request) {
//                 $q->where('price', '>=', $request->min_price);
//             })
//             ->when($request->max_price, function($q) use ($request) {
//                 $q->where('price', '<=', $request->max_price);
//             });

//         $products = $query->paginate(10);
//         $companies = Company::all(); // للقائمة المنسدلة للتصفية

//         return view('pages.products.index', compact('products', 'companies'));
//     }

//     /**
//      * عرض نموذج إنشاء منتج جديد
//      */
//     public function create()
//     {
//         // احصل على الشركة الحالية من جلسة تسجيل الدخول
//         $company = auth('company')->user();
//         return view('pages.products.create', compact('company'));
//     }

//     /**
//      * حفظ المنتج الجديد
//      */
//     public function store(Request $request)
//     {
//         $company = auth('company')->user();
//         $validated = $request->validate([
//             'product_name' => 'required|string|max:100',
//             'quantity' => 'required|integer|min:0',
//             'price' => 'required|numeric|min:0',
//         ]);
//         $validated['company_id'] = $company->id;

//         try {
//             products::create($validated);
//             return redirect()->route('products.index')->with('success', 'تم إضافة المنتج بنجاح');
//         } catch (\Exception $e) {
//             return back()->withInput()->with('error', 'حدث خطأ أثناء إضافة المنتج');
//         }
//     }

//     /**
//      * عرض نموذج تعديل المنتج
//      */
//     public function edit(products $products)
//     {
//         $companies = Company::all();
//         return view('pages.products.edit', compact('products', 'companies'));
//     }

//     /**
//      * تحديث بيانات المنتج
//      */
//     public function update(Request $request, products $products)
//     {
//         $validated = $request->validate([
//             'product_name' => 'required|string|max:100',
//             'quantity' => 'required|integer|min:0',
//             'price' => 'required|numeric|min:0',
//             'company_id' => 'required|exists:companies,id',
//         ]);

//         try {
//             $products->update($validated);
//             return redirect()->route('products.index')->with('success', 'تم تحديث المنتج بنجاح');
//         } catch (\Exception $e) {
//             return back()->withInput()->with('error', 'حدث خطأ أثناء تحديث المنتج');
//         }
//     }

//     /**
//      * تعطيل/حذف المنتج
//      */
//     public function destroy(products $products)
//     {
//         try {
//             // يمكنك استخدام soft delete إذا أردت تعطيل المنتج بدلاً من حذفه
//             $products->delete();
//             return redirect()->route('products.index')->with('success', 'تم تعطيل المنتج بنجاح');
//         } catch (\Exception $e) {
//             return back()->with('error', 'حدث خطأ أثناء تعطيل المنتج');
//         }
//     }

//     /**
//      * خصم الكمية عند استخدام المنتج في طلب
//      */
//     public function deductQuantity($productId, $quantityUsed)
//     {
//         DB::transaction(function () use ($productId, $quantityUsed) {
//             $product = products::findOrFail($productId);

//             if ($product->quantity < $quantityUsed) {
//                 throw new \Exception('الكمية غير كافية في المخزون');
//             }

//             $product->decrement('quantity', $quantityUsed);
//         });
//     }

//     /**
//      * API للحصول على قائمة المنتجات
//      */
//     public function apiIndex(Request $request)
//     {
//         $products = \App\Models\products::select('id', 'product_name', 'quantity', 'price', 'company_id')
//             ->with('company:id,company_name')
//             ->get();

//         return response()->json($products);
//     }

//     /**
//      * عرض منتجات شركة محددة
//      */
//     public function companyProducts($company_id)
//     {
//         $products = \App\Models\products::where('company_id', $company_id)->get();
//         return response()->json($products);
//     }

//     /**
//      * إضافة منتج جديد عبر API
//      */
//     public function storeApi(Request $request, $company_id)
//     {
//         $validated = $request->validate([
//             'product_name' => 'required|string|max:100',
//             'quantity' => 'required|integer|min:0',
//             'price' => 'required|numeric|min:0',
//         ]);

//         $validated['company_id'] = $company_id;

//         $product = \App\Models\products::create($validated);

//         return response()->json($product, 201);
//     }
// }
