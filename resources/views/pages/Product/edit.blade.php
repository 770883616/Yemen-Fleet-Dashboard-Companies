@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5>تعديل المنتج</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">اسم المنتج</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="quantity">الكمية</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" min="0" value="{{ old('quantity', $product->quantity) }}" required>
                </div>
                <div class="form-group">
                    <label for="price">السعر</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control" min="0" value="{{ old('price', $product->price) }}" required>
                </div>
                <div class="form-group">
                    <label for="company_id">الشركة</label>
                    <select name="company_id" id="company_id" class="form-control" required>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ $product->company_id == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="image">صورة المنتج</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if($product->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="صورة المنتج" width="80" height="80" style="object-fit:cover; border-radius:50%;">
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">تحديث</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">إلغاء</a>
            </form>
        </div>
    </div>
</div>
@endsection
