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

        .additional-images {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            /* margin-top: 20px; */
        }

        .additional-images .image-item {
            position: relative;
            width: 100px;
            height: 100px;
            object-fit: cover;

        }

        .additional-images .image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .additional-images .image-item .delete-icon {
            position: absolute;
            /* top: 5px; */
            left: 5px;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 5px;
            border-radius: 50%;
            cursor: pointer;
        }

        .add-image-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #007bff;
            color: #fff;
            width: 100px;
            height: 100px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 24px;
        }
    </style>
@section('title')
    تعديل المنتج
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    تعديل المنتج
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

                <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="name_ar">الاسم باللغة العربية</label>
                            <input type="text" value="{{ old('name_ar', $product->name_ar) }}" name="name_ar" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="name_en">الاسم باللغة الانجليزية</label>
                            <input type="text" value="{{ old('name_en', $product->name_en) }}" name="name_en" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="description_ar">الوصف باللغة العربية</label>
                            <textarea name="description_ar" class="form-control" style="height: 48px;">{{ old('description_ar', $product->description_ar) }}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="description_en">الوصف باللغة الإنجليزية</label>
                            <textarea name="description_en" class="form-control" style="height: 48px;">{{ old('description_en', $product->description_en) }}</textarea>
                        </div>
                        <div class="form-group col">
                            <label for="price">السعر</label>
                            <input type="text" value="{{ old('price', $product->price) }}" name="price" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="discount">الخصم</label>
                            <input type="text" value="{{ old('discount', $product->discount) }}" name="discount" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="main_image">الصورة الرئيسية</label>
                            <div class="product-image-container" >
                                @if($product->main_image)
                                    <img id="main_image_preview" src="{{ asset('public/uploads/products/' . $product->main_image) }}" alt="Main Image" height="100">
                                @else
                                    <img id="main_image_preview" src="{{ asset('storage/uploads/products/default-image.jpg') }}" alt="Main Image">
                                @endif
                                <input type="file" name="main_image" class="form-control" onchange="previewImage(event, 'main_image_preview')" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                            </div>
                            </div>
                       
                            <div class="form-group col">
                                <label for="additional_images">صور إضافية</label>
                                <div class="additional-images" id="additional_images_container">
                                    <div class="add-image-btn" onclick="document.getElementById('additional_images_input').click()">+</div>
                                    <input type="file" name="additional_images[]" class="form-control" id="additional_images_input" multiple style="display: none" onchange="previewAdditionalImages(event)">
                                    @foreach ($product->images as $image)
                                        <div class="image-item" id="image_item_{{ $image->id }}">
                                            <img src="{{ asset('public/uploads/products/productimages/' . $image->image_path) }}" class="product-image" alt="Product Image">
                                            <span class="delete-icon" onclick="removeImage({{ $image->id }})">X</span>
                                            <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                                            
                                        </div>
                                    @endforeach
                                </div>
                             </div>
                  
                    </div>
              
                    <div class="form-group col">
                        <label for="category_id">الأقسام</label>
                        <select class="custom-select mr-sm-2" name="category_id">
                            <option selected disabled>اختر...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Colors -->
                    <div class="form-group col">
                        <label>Colors:</label>
                        <div id="color-grid" class="color-grid">
                            @foreach ($attributes as $attribute)
                                @if ($attribute->type == 'color')
                                    <div class="color-box {{ in_array($attribute->id, $product->attributes->pluck('id')->toArray()) ? 'selected' : '' }}" 
                                         style="background-color: {{ $attribute->name }};" 
                                         data-value="{{ $attribute->id }}">
                                        <input type="checkbox" name="attributes[]" value="{{ $attribute->id }}" {{ in_array($attribute->id, $product->attributes->pluck('id')->toArray()) ? 'checked' : '' }} hidden>
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
                                    <div class="size-box {{ in_array($attribute->id, $product->attributes->pluck('id')->toArray()) ? 'selected' : '' }}" 
                                         data-value="{{ $attribute->id }}">
                                        <input type="checkbox" name="attributes[]" value="{{ $attribute->id }}" {{ in_array($attribute->id, $product->attributes->pluck('id')->toArray()) ? 'checked' : '' }} hidden>
                                        <span class="checkmark">✔</span>
                                        <span class="size-label">{{ $attribute->name }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                
                    <button type="submit" class="btn btn-primary mt-3">تحديث</button>
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
        function previewImage(event, elementId) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById(elementId).src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewAdditionalImages(event) {
    const container = document.getElementById('additional_images_container');
    const files = event.target.files;
    for (let i = 0; i < files.length; i++) {
        const reader = new FileReader();
        reader.onload = function () {
            const imageItem = document.createElement('div');
            imageItem.classList.add('image-item');
            const img = document.createElement('img');
            img.src = reader.result;
            img.classList.add('product-image');
            imageItem.appendChild(img);

            const deleteIcon = document.createElement('span');
            deleteIcon.classList.add('delete-icon');
            deleteIcon.textContent = 'X';
            deleteIcon.onclick = function() {
                container.removeChild(imageItem);
            };
            imageItem.appendChild(deleteIcon);

            // إضافة الصورة الجديدة قبل زر "إضافة صورة"
            container.insertBefore(imageItem, container.lastElementChild);
        };
        reader.readAsDataURL(files[i]);
    }
}

function removeImage(imageId) {
    const imageItem = document.getElementById('image_item_' + imageId);
    if (imageItem) {
        imageItem.remove();

        // إضافة id الصورة المحذوفة إلى الحقول المخفية
        const deletedImagesField = document.createElement('input');
        deletedImagesField.type = 'hidden';
        deletedImagesField.name = 'deleted_images[]';
        deletedImagesField.value = imageId;
        document.querySelector('form').appendChild(deletedImagesField);
    }
}

    </script>
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
