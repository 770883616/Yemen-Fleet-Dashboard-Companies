@extends('layouts.master')

@section('title', 'إضافة منتج جديد')

@section('content')
<div class="container mt-4">
    <h2>إضافة منتج جديد</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">اسم المنتج</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">الكمية</label>
            <input type="number" name="quantity" class="form-control" required min="0">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">السعر</label>
            <input type="number" name="price" class="form-control" required min="0" step="0.01">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">صورة المنتج</label>
            <input type="file" name="image" class="form-control">
        </div>
        <input type="hidden" name="company_id" value="{{ $company->id }}">
        <button type="submit" class="btn btn-success">حفظ</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
    @if(isset($product->image))
    <div class="mt-3">
        <h4>صورة المنتج الحالي:</h4>
        <img src="{{ asset('storage/' . $product->image) }}" alt="صورة المنتج" class="img-thumbnail" style="max-width: 200px;">
    </div>
    @endif
</div></div>
@endsection
