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
                    {{-- {{ trans('Grades_trans.add_Grade') }} --}}
                    إضافة منتج
                </button>
                <a href="{{ route('categories.create') }}" class="btn btn-primary">إضافة قسم جديد</a>

                <br><br>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>الأقسام</h1>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">إضافة قسم جديد</a>
                </div>
            
                @if($categories->count())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>اسم القسم</th>
                                <th>صورة القسم</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if($category->image)
                                        <td>
                                            @if($category->image)
                                                <img src="{{ asset('public/categories/' . $category->image) }}" alt="{{ $category->name }}" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                            @else
                                                <span>لا توجد صورة</span>
                                            @endif
                                        </td>
                                                                                @else
                                            <span>لا توجد صورة</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">تعديل</a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">لا توجد أقسام مضافة.</p>
                @endif
            </div>
        </div>
    </div>
    <!-- add_modal_Grade -->

</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
