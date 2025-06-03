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
    المنتجات
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<h1>إضافة قسم جديد</h1>

<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">اسم القسم</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">صورة القسم</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">حفظ</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">إلغاء</a>
</form>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
