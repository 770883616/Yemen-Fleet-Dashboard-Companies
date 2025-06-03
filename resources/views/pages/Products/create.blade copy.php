@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
  اضافة منتج جديدة
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    اضافة منتج جديدة
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
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

                    {{-- <form method="post" action="{{ route('products.store') }}" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">الاسم باللغة العربية</label>
                                <input type="text" value="{{ old('name_ar') }}" name="name_ar" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4">الاسم باللغة الانجليزية</label>
                                <input type="text" value="{{ old('name_en') }}" name="name_en" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">الوصف باللغة العربية</label>
                                <input type="text" value="{{ old('description_ar') }}" name="description_ar" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">الوصف باللغة الانجلزية</label>
                                <input type="text" value="{{ old('description_en') }}" name="description_en" class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="inputEmail4">  السعر</label>
                                <input type="text" value="{{ old('price') }}" name="price" class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="inputEmail4">  الخصم</label>
                                <input type="text" value="{{ old('discount') }}" name="discount" class="form-control">
                            </div>

                        </div>

                        <div class="form-row">

                         
                            <div class="form-group col">
                                <label for="inputEmail4">  صورة المنتج</label>
                                <input type="file" value="{{ old('main_image') }}" name="main_image" class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="inputEmail4">  صور المنتج</label>
                                <input type="file" value="{{ old('main_image') }}"name="additional_images[]"class="form-control"  multiple>
                            </div>
                            <div class="form-group col">
                                <label for="inputState">الاقسام </label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                     @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Colors:</label>
                            <select name="colors[]" multiple>
                                @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                            
                            <label>Sizes:</label>
                            <select name="sizes[]" multiple>
                                @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                           
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">ملاحظات</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4"></textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">تاكيد</button>

                    </form> --}}
                    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="name_ar">الاسم باللغة العربية</label>
                                <input type="text" value="{{ old('name_ar') }}" name="name_ar" class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="name_en">الاسم باللغة الانجليزية</label>
                                <input type="text" value="{{ old('name_en') }}" name="name_en" class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="description_ar">الوصف باللغة العربية</label>
                                <textarea name="description_ar" class="form-control">{{ old('description_ar') }}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="description_en">الوصف باللغة الإنجليزية</label>
                                <textarea name="description_en" class="form-control">{{ old('description_en') }}</textarea>
                            </div>
                            <div class="form-group col">
                                <label for="price">السعر</label>
                                <input type="text" value="{{ old('price') }}" name="price" class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="discount">الخصم</label>
                                <input type="text" value="{{ old('discount') }}" name="discount" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="main_image">الصورة الرئيسية</label>
                                <input type="file" name="main_image" class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="additional_images">صور إضافية</label>
                                <input type="file" name="additional_images[]" class="form-control" multiple>
                            </div>
                            <div class="form-group col">
                                <label for="category_id">الأقسام</label>
                                <select class="custom-select mr-sm-2" name="category_id">
                                    <option selected disabled>اختر...</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Colors:</label>
                            <select name="attributes[]" multiple class="form-control">
                                @foreach($attributes as $attribute)
                                    @if($attribute->type == 'color')
                                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                    @endif
                                    
                                @endforeach
                            </select>
                            <label>Sizes:</label>
                            <select name="attributes[]" multiple class="form-control">
                                @foreach($attributes as $attribute)
                                    @if($attribute->type == 'size')
                                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">تأكيد</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
