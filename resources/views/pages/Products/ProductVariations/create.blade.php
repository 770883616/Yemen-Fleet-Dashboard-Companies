@extends('layouts.master')
@section('css')
    @toastr_css
    <style>
        .color-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .color-box, .size-box {
            width: 40px;
            height: 40px;
            border: 2px solid #ddd;
            border-radius: 5px;
            position: relative;
            cursor: pointer;
            transition: border-color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .color-box:hover, .size-box:hover {
            border-color: #333;
        }

        .color-box.selected, .size-box.selected {
            border-color: #007bff;
        }

        .checkmark {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            color: #007bff;
        }

        .color-box.selected .checkmark, .size-box.selected .checkmark {
            display: block;
        }

        .size-box .size-label {
            position: absolute;
            color: black;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
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

                <form method="post" action="{{ route('product.variations.store', $product->id) }}" enctype="multipart/form-data" autocomplete="off">
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
                            <textarea name="description_ar" class="form-control" style="height: 48px;">{{ old('description_ar') }}</textarea>
                        </div>
                        {{-- <div class="form-group col">
                            <label for="inputEmail4">الوصف باللغة العربية</label>
                            <input type="text" value="{{ old('description_ar') }}" name="description_ar" class="form-control">
                        </div> --}}
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="description_en">الوصف باللغة الإنجليزية</label>
                            <textarea name="description_en" class="form-control" style="height: 48px;">{{ old('description_en') }}</textarea>
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
                            <label for="image">الصورة الرئيسية</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                      
                   
                    </div>
                
                    <!-- Colors -->
                    <div class="form-group col">
                        <label>Colors:</label>
                        <div id="color-grid" class="color-grid">
                            @foreach ($attributes as $attribute)
                                @if ($attribute->type == 'color')
                                    <div class="color-box" 
                                         style="background-color: {{ $attribute->name }};" 
                                         data-value="{{ $attribute->id }}">
                                        <input type="checkbox" name="attributes[]" value="{{ $attribute->id }}" hidden>
                                        <span class="checkmark">✔</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                
                    <!-- Sizes -->
                    <div class="form-group col">
                        <label>Sizes:</label>
                        <div id="size-grid" class="color-grid">
                            @foreach ($attributes as $attribute)
                                @if ($attribute->type == 'size')
                                    <div class="size-box" 
                                         data-value="{{ $attribute->id }}">
                                        <input type="checkbox" name="attributes[]" value="{{ $attribute->id }}" hidden>
                                        <span class="checkmark">✔</span>
                                        <span class="size-label">{{ $attribute->name }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const colorBoxes = document.querySelectorAll('.color-box');
            const sizeBoxes = document.querySelectorAll('.size-box');

            colorBoxes.forEach(box => {
                box.addEventListener('click', () => {
                    const checkbox = box.querySelector('input[type="checkbox"]');
                    box.classList.toggle('selected');
                    checkbox.checked = !checkbox.checked;
                });
            });

            sizeBoxes.forEach(box => {
                box.addEventListener('click', () => {
                    const checkbox = box.querySelector('input[type="checkbox"]');
                    box.classList.toggle('selected');
                    checkbox.checked = !checkbox.checked;
                });
            });
        });
    </script>
@endsection
