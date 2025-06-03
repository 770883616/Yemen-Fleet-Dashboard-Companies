<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // عرض قائمة المنتجات
    public function index(Request $request)
    {
        $query = Product::with('company')
            ->when($request->search, function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%');
            })
            ->when($request->company_id, function($q) use ($request) {
                $q->where('company_id', $request->company_id);
            })
            ->when($request->min_price, function($q) use ($request) {
                $q->where('price', '>=', $request->min_price);
            })
            ->when($request->max_price, function($q) use ($request) {
                $q->where('price', '<=', $request->max_price);
            });

        $products = $query->paginate(10);
        $companies = Company::all();

        return view('pages.Product.index', compact('products', 'companies'));
    }

    // عرض نموذج إضافة منتج
    public function create()
    {
        $company = auth('company')->user();
        return view('pages.Product.create', compact('company'));
    }

    // حفظ منتج جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:100',
            'quantity'   => 'required|integer|min:0',
            'price'      => 'required|numeric|min:0',
            'company_id' => 'required|exists:companies,id',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        // رفع الصورة إن وجدت
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'تم إضافة المنتج بنجاح');
    }

    // عرض نموذج تعديل منتج
    public function edit(Product $product)
    {
        $companies = Company::all();
        return view('pages.Product.edit', compact('product', 'companies'));
    }

    // تحديث منتج
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:100',
            'quantity'     => 'required|integer|min:0',
            'price'        => 'required|numeric|min:0',
            'company_id'   => 'required|exists:companies,id',
        ]);
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'تم تحديث المنتج بنجاح');
    }

    // حذف منتج
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'تم حذف المنتج بنجاح');
    }
}
