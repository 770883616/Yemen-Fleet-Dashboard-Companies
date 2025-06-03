<?php
// namespace App\Http\Controllers;


// use App\Models\Product;
// use App\Models\products;
// use App\Models\Attribute;
// use App\Models\categories;
// use App\Models\ProductImage;
// use Illuminate\Http\Request;
// use App\Http\Requests\ProductRequest;

// class ProductsController extends Controller
// {
//     // عرض جميع المنتجات
//     public function index()
//     {
//         $products = Product::with('category')->get();
//         return view('pages.Products.index', compact('products'));
//     }

//     // عرض صفحة إنشاء منتج جديد
//     public function create()
//     {
//         $categories = categories::all(); // جلب جميع الأقسام لإضافتها للمنتج
      
//         $attributes = Attribute::all(); // جلب الألوان والمقاسات
//         return view('pages.Products.create', compact('categories','attributes'));
//     }


//     // تخزين المنتج في قاعدة البيانات
 
//     public function store(ProductRequest $request)
// {
//     $data = $request->all();

//     // رفع الصورة الرئيسية وحفظ اسم الصورة فقط في قاعدة البيانات
//     if ($request->hasFile('main_image')) {
//         $imageName = $request->file('main_image')->getClientOriginalName();
//         $request->file('main_image')->storeAs('products', $imageName, 'public');
//         $data['main_image'] = $imageName;
//     }

//     $product = Product::create($data);

//     // رفع الصور الإضافية وحفظها
//     if ($request->hasFile('additional_images')) {
//         foreach ($request->file('additional_images') as $image) {
//             $imageName = $image->getClientOriginalName();
//             $image->storeAs('productimages', $imageName, 'public');

//             ProductImage::create([
//                 'product_id' => $product->id,
//                 'image_path' => $imageName,
//             ]);
//         }
//     }

//     // ربط الخصائص
//     if ($request->attributes) {
//         $product->attributes()->sync($request->input('attributes'));
//     }

//     return redirect()->route('products.index')->with('success', 'تمت إضافة المنتج بنجاح!');
// }
//     // عرض صفحة تعديل منتج
//     public function edit(Product $product)
//     {
//         $categories = categories::all();
//         $attributes = Attribute::all(); // جلب الخصائص (الألوان والمقاسات)
//         return view('pages.Products.edit', compact('product', 'categories', 'attributes'));
//     }

  
//         // $filenameOnly = $request->file('main_image')->getClientOriginalName();
//         // $request->file('main_image')->storeAs('products', $filenameOnly, 'products');
//         // if ($product->main_image) {
//         //     Storage::disk('products')->delete('products/' . $product->main_image);
//         // }
//         // $product->main_image = $filenameOnly;

//         public function update(ProductRequest $request, $id)
//         {
//             $product = Product::findOrFail($id);
        
//             // رفع وتخزين الصورة الرئيسية إذا كانت موجودة
//             if ($request->hasFile('main_image')) {
//                 // حذف الصورة القديمة إذا كانت موجودة
//                 if ($product->main_image && file_exists(public_path('storage/products/' . $product->main_image))) {
//                     unlink(public_path('storage/products/' . $product->main_image));
//                 }
        
//                 // تخزين الصورة الجديدة باستخدام اسم فريد
//                 $imageName = time() . '_' . $request->file('main_image')->getClientOriginalName();
//                 // تخزين الصورة في المجلد الصحيح
//                 $request->file('main_image')->storeAs('products', $imageName, 'public');
//                 // تحديث اسم الصورة في قاعدة البيانات
//                 $product->main_image = $imageName;
//             }
        
//             // تحديث باقي التفاصيل للمنتج
//             $product->update($request->all());
        
//             // حذف الصور التي تم تحديدها للحذف
//             if ($request->has('deleted_images')) {
//                 foreach ($request->input('deleted_images') as $imageId) {
//                     $image = ProductImage::find($imageId);
//                     if ($image) {
//                         // حذف الصورة من المجلد
//                         if (file_exists(public_path('storage/productimages/' . $image->image_path))) {
//                             unlink(public_path('storage/productimages/' . $image->image_path));
//                         }
//                         // حذف السجل من قاعدة البيانات
//                         $image->delete();
//                     }
//                 }
//             }
        
//             // إضافة الصور الإضافية الجديدة
//             if ($request->hasFile('additional_images')) {
//                 foreach ($request->file('additional_images') as $image) {
//                     // توليد اسم فريد للصورة الإضافية
//                     $imageName = time() . '_' . $image->getClientOriginalName();
//                     // تخزين الصورة في المجلد المناسب
//                     $image->storeAs('productimages', $imageName, 'public');
        
//                     // إضافة السجل للصورة الإضافية
//                     ProductImage::create([
//                         'product_id' => $product->id,
//                         'image_path' => $imageName,
//                     ]);
//                 }
//             }
        
//             // تحديث السمات الخاصة بالمنتج
//             if ($request->attributes) {
//                 $product->attributes()->sync($request->input('attributes'));
//             }
        
//             return redirect()->route('products.index')->with('success', 'تم تعديل المنتج بنجاح!');
//         }
            // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name_ar' => 'required|string|max:255',
    //         'name_en' => 'required|string|max:255',
    //         'description_ar' => 'required',
    //         'description_en' => 'required',
    //         'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    //         'price' => 'required|numeric|min:0',
    //         'discount' => 'nullable|numeric|min:0',
    //         'category_id' => 'required|exists:categories,id',
    //         'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    //         'attributes' => 'nullable|array',
    //     ]);
    
    //     // الحصول على المنتج الموجود
    //     $product = Product::findOrFail($id);
        
    //     // رفع الصورة الرئيسية وتحديث اسم الصورة فقط في قاعدة البيانات إذا تم تغييرها
    //     if ($request->hasFile('main_image')) {
    //         // حذف الصورة القديمة من السيرفر إذا كانت موجودة
    //         // if ($product->main_image && file_exists(public_path('public/products/' . $product->main_image))) {
    //         //     unlink(public_path('public/products/' . $product->main_image));
    //         // }
    
    //         // $imageName = $request->file('main_image')->getClientOriginalName();
    //         // $request->file('main_image')->storeAs('products', $imageName, 'public');
    //         // $product->main_image = $imageName;
            
    //     $filenameOnly = $request->file('main_image')->getClientOriginalName();
    //     $request->file('main_image')->storeAs('products', $filenameOnly, 'products');
    //     if ($product->main_image) {
    //         Storage::disk('products')->delete('products/' . $product->main_image);
    //     }
    //     $product->main_image = $filenameOnly;
    //     }
    
    //     // تحديث باقي البيانات في المنتج
    //     $product->name_ar = $request->name_ar;
    //     $product->name_en = $request->name_en;
    //     $product->description_ar = $request->description_ar;
    //     $product->description_en = $request->description_en;
    //     $product->price = $request->price;
    //     $product->discount = $request->discount;
    //     $product->category_id = $request->category_id;
    //     $product->save();
    
    //     // حذف الصور الإضافية التي تم تحديدها للحذف من قبل المستخدم
    //     if ($request->has('deleted_images')) {
    //         $deletedImages = $request->input('deleted_images');
    //         foreach ($deletedImages as $imageId) {
    //             $image = ProductImage::find($imageId);
    //             if ($image) {
    //                 // حذف الصورة من السيرفر
    //                 if (file_exists(public_path('storage/productimages/' . $image->image_path))) {
    //                     unlink(public_path('storage/productimages/' . $image->image_path));
    //                 }
    //                 $image->delete();
    //             }
    //         }
    //     }
    
    //     // رفع الصور الإضافية الجديدة وتحديث قاعدة البيانات
    //     if ($request->hasFile('additional_images')) {
    //         foreach ($request->file('additional_images') as $image) {
    //             $imageName = $image->getClientOriginalName();
    //             $image->storeAs('productimages', $imageName, 'public');
    
    //             ProductImage::create([
    //                 'product_id' => $product->id,
    //                 'image_path' => $imageName,
    //             ]);
    //         }
    //     }
    
    //     // ربط الخصائص (الألوان والمقاسات)
    //     if ($request->attributes) {
    //         $product->attributes()->sync($request->input('attributes'));
    //     }
    
    //     return redirect()->route('products.index')->with('success', 'تم تعديل المنتج بنجاح!');
    // }
    
    
//     // حذف منتج
//     public function destroy(Product $product)
//     {
//         // dd($product);
//         $product->delete();
//         return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
//     }
// }
