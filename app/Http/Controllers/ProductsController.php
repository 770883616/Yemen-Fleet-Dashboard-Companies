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
        $query = Product::with('company');

        // البحث
        if ($request->has('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        // التصفية حسب الحالة
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $products = $query->paginate(10);

        return view('pages.product.index', compact('products'));
    }

    // عرض نموذج إضافة منتج
    public function create()
    {
        $company = auth('company')->user();
        return view('pages.product.create', compact('company'));
    }

    // تخزين منتج جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:100',
            'quantity'     => 'required|integer|min:0',
            'price'        => 'required|numeric|min:0',
            'company_id'   => 'required|exists:companies,id',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'تم إضافة المنتج بنجاح');
    }

    // عرض نموذج تعديل منتج
    public function edit(Product $product)
    {
        $companies = Company::all();
        return view('pages.product.edit', compact('product', 'companies'));
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
