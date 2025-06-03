@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{-- {{ trans('Grades_trans.title_page') }} --}}
    المنتجات
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{-- {{trans('main_trans.Grades')}} --}}
    الاقسام
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
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">

                    إضافة منتج
                </button>
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>

                                <th>اسم القسم</th>
                                <th>صورة القسم</th>
                                <th>العمليات</th>

                            </tr>
                        </thead>
                        <tbody>


                            <?php $i = 0; ?>
                            @foreach ($categories as $category)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if ($category->image)
                                            <img src="{{ asset('public/uploads/categories/' . $category->image) }}"
                                                alt="{{ $category->name }}"
                                                style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                        @else
                                            <span>لا توجد صورة</span>
                                        @endif
                                    </td>
                                    {{-- <td>{{ $item['description'] }}</td>
                        <td>{{ $item['price'] }}</td> --}}
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $category->id }}"
                                            title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $category->id }}"
                                            title="{{ trans('Grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>


                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                    تعديل قسم
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="name" class="mr-sm-2">اسم القسم الانجليزي :</label>
                                                            <input id="name" type="text" name="name" class="form-control" value="{{ $category->getTranslation('name', 'en') }}" required>
                                                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $category->id }}" required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="name_en" class="mr-sm-2">اسم القسم عربي :</label>
                                                            <input type="text" class="form-control" name="name_en"  value="{{ $category->getTranslation('name', 'ar') }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="image" class="form-label">صورة القسم</label>
                                                        <div class="image-upload-wrapper" style="position: relative; width: 100%; max-width: 300px; cursor: pointer;">
                                                            <!-- عرض الصورة إذا كانت موجودة في قاعدة البيانات -->
                                                            <img id="imagePreview" src="{{ $category->image ?  asset('public/uploads/categories/' . $category->image)  : 'https://via.placeholder.com/300x150?text=اضغط+لرفع+صورة' }}"
                                                                 alt="Preview" 
                                                                 style="width: 100%; height: auto; border: 2px dashed #ccc; padding: 5px;">
                                                            <input type="file" name="image" id="image" class="form-control"
                                                                   style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;"
                                                                   onchange="previewImage(event)">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                

                                <!-- delete_modal_Grade -->
                                {{-- <div class="modal fade" id="delete{{ $Product->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                
                                                    حذف المنتج
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('destroy.data', $Product->id) }}"
                                                    method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('Grades_trans.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id"
                                                        class="form-control" value="{{ $Product->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            @endforeach


                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    اضافة قسم
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">اسم القسم الانجليزي :</label>
                            <input id="name" type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">اسم القسم عربي :</label>
                            <input type="text" class="form-control" name="name_en" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">صورة القسم</label>
                        <div class="image-upload-wrapper" style="position: relative; width: 100%; max-width: 300px; cursor: pointer;">
                            <img id="imagePreview" src="https://via.placeholder.com/300x150?text=اضغط+لرفع+صورة" 
                                alt="Preview" 
                                style="width: 100%; height: auto; border: 2px dashed #ccc; padding: 5px;">
                            <input type="file" name="image" id="image" class="form-control" 
                                style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" 
                                onchange="previewImage(event)">
                        </div>
                    </div>

                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
            </div>
            </form>

        </div>
    </div>
</div>
</div>
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
