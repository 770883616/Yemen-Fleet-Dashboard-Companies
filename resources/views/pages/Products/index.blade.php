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
             
                <a href="{{route('products.create') }}" class="btn btn-success btn-sm" role="button"
                aria-pressed="true">{{trans('main_trans.add_student')}}</a>
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>

                                <th>اسم المنتج عربي</th>
                                <th>اسم المنتج انجليزي </th>
                                <th>الوصف عربي</th>
                                <th>الوصف انجليزي</th>
                                <th>السعر</th>
                                 <th>الخصم</th>
                                <th>الصورة</th>
                                <th>الصور</th>
                                <th>القسم</th>
                                <th>الالوان</th>
                                <th>الاحجام</th>
                                <th>الحالة</th>
                                <th>العمليات</th>

                            </tr>
                        </thead>
                        <tbody>


                            <?php $i = 0; ?>
                            @foreach($products as $product)
                                <tr>
                                    {{-- protected $fillable = [
                                        'name_ar', 'name_en', 'description_ar', 'description_en',
                                        'main_image', 'status', 'price', 'discount', 'category_id'
                                    ]; --}}
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $product->name_ar }}</td>
                                    <td>{{ $product->name_en }}</td>
                                    <td>{{ $product->description_ar }}</td>
                                    <td>{{ $product->description_en}}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->discount }}</td>
                                    <td>
                                        @if ($product->main_image)
                                            <img src="{{ asset('public/uploads/products/' .$product->main_image) }}"
                                                {{-- alt="{{ $category->name }}" --}}
                                                style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                        @else
                                            <span>لا توجد صورة</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($product->images as $image)
                                            <img src="{{ asset('public/uploads/products/productimages/' . $image->image_path) }}"
                                            style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                            @endforeach
                                    </td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td>
                                        @if ($product->attributes->where('type', 'color')->isEmpty())
                                            <span>لا توجد ألوان</span>
                                        @else
                                            @foreach ($product->attributes->where('type', 'color') as $attribute)
                                                <span style="display: inline-block; width: 20px; height: 20px; background-color: {{ $attribute->name }}; border: 1px solid #000; margin: 2px;"></span>
                                            @endforeach
                                        @endif
                                    </td>
                                      <!-- الأحجام -->
                                    <td>
                                        @if ($product->attributes->where('type', 'size')->isEmpty())
                                            <span>لا توجد ألوان</span>
                                        @else
                                            @foreach ($product->attributes->where('type', 'size') as $attribute)
                                                {{-- <span style="display: inline-block; width: 20px; height: 20px; background-color: {{ $attribute->name }}; border: 1px solid #000; margin: 2px;"></span> --}}
                                                <span style="display: inline-block; margin-right: 5px;">{{ $attribute->name }}</span>
                                                @endforeach
                                        @endif
                                    </td>
                                    
                                  
                                
                                    <td>{{ $product->status }}</td>
                                
                                   

                                    
                                
                                    <td>
                                        {{-- <a href="{{ route('ProductVariations.index', $product->id) }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                                            <i class="fa fa-cogs"></i> اختلافات المنتج
                                        </a> --}}
                                        {{-- <a href="{{ route('products.showVariations', $product->id) }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                                            <i class="fa fa-cogs"></i> اختلافات المنتج
                                        </a> --}}
                                        <a href="{{ route('product.variations', $product->id) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">
                                            عرض اختلافات المنتج
                                        </a>
                                        {{-- <a href="{{ route('product.variations', $product->id) }}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">
                                            <i class="fa fa-cogs"></i> اختلافات المنتج
                                        </a> --}}
                                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                 
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف المنتج؟');">
                                                <i class="fa fa-trash"></i>
                                            </button>
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
@section('js')

@endsection
