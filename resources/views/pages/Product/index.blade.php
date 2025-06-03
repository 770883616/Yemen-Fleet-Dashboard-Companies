@extends('layouts.master')

@section('title', 'قائمة المنتجات')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>قائمة المنتجات</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">إضافة منتج جديد</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الصورة</th>
                <th>الاسم</th>
                <th>الكمية</th>
                <th>السعر</th>
                <th>الشركة</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="صورة المنتج" width="50" height="50" style="object-fit:cover; border-radius:50%;">
                    @else
                        <span class="text-muted">لا يوجد</span>
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ number_format($product->price, 2) }} ر.س</td>
                <td>{{ $product->company->company_name ?? '-' }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- روابط الصفحات --}}
    {{ $products->links() }}
</div>
@endsection
