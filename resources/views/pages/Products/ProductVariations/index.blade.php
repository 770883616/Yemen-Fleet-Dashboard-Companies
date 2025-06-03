@extends('layouts.master')
@section('css')

@section('title')
    اختلافات المنتج - {{ $product->name_ar }}
@stop

@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    اختلافات المنتج
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <a href="{{ route('product.variations.create', $product->id) }}" class="btn btn-success btn-sm" role="button"
                aria-pressed="true">إضافة اختلاف منتج</a>
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم اختلاف المنتج عربي</th>
                                <th>اسم اختلاف المنتج انجليزي</th>
                                <th>السعر</th>
                                <th>الخصم</th>
                                <th>الصورة</th>
                                <th>السمات</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->productVariations as $variation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $variation->name_ar }}</td>
                                    <td>{{ $variation->name_en }}</td>
                                    <td>{{ $variation->price }}</td>
                                    <td>{{ $variation->discount }}</td>
                                    <td>
                                        @if ($variation->image)
                                            <img src="{{ asset('public/uploads/products/productvariations/' . $variation->image) }}" 
                                                 style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                        @else
                                            <span>لا توجد صورة</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($variation->attributes as $attribute)
                                            <span>{{ $attribute->name }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('product.variations.edit', [$product->id, $variation->id]) }}" 
                                           class="btn btn-primary btn-sm" role="button" aria-pressed="true">تعديل</a>
                                    
                                        <form action="{{ route('product.variations.destroy', [$product->id, $variation->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من عملية الحذف؟')">حذف</button>
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
