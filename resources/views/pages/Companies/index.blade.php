@extends('layouts.master')
@section('css')

@section('title')
    قائمة المنتجات
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    قائمة المنتجات
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="card-title">قائمة المنتجات</h5>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> إضافة منتج جديد
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-light">
                            <tr>
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
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->company->company_name ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning" title="تعديل">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="حذف" onclick="return confirm('هل أنت متأكد؟')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                <div class="mt-3">
                    {{ $products->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
