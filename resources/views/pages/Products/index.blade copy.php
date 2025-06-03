@extends('layouts.master')
@section('css')

@section('title')
    empty
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    empty
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h1>Products</h1>
                <a href="{{ route('products.create') }}">Create New Product</a>
                <table>
                    <tr>
                        <th>Name (AR)</th>
                        <th>Name (EN)</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Main Image</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name_ar }}</td>
                        <td>{{ $product->name_en }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td><img src="{{ asset($product->main_image) }}" alt="{{ $product->name_en }}" width="50"></td>
                        <td>
                            <a href="{{ route('products.edit', $product) }}">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
