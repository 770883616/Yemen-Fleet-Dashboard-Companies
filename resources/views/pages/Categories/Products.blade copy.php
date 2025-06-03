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
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المنتج</th>
                                <th>وصف المنتج</th>
                                <th>السعر</th>
                                <th>العمليات</th>

                            </tr>
                        </thead>
                        <tbody>


                            <?php $i = 0; ?>
                            @foreach ($Products as $Product)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $Product->name }}</td>
                                    <td>{{ $Product->description }}</td>
                                    <td>{{ $Product->price }}</td>
                                    {{-- <td>{{ $item['description'] }}</td>
                        <td>{{ $item['price'] }}</td> --}}
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $Product->id }}"
                                            title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $Product->id }}"
                                            title="{{ trans('Grades_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>


                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $Product->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">تعديل المنتج
                                                    {{-- {{ trans('Grades_trans.edit_Grade') }} --}}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- edit_form -->
                                                {{-- <form action="{{route('Grades.update','test')}}" method="post"> --}}
                                                <form action="{{ route('update.data', $Product->id) }}" method="post">
                                                    {{-- <form action="" method="post"> --}}
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name" class="mr-sm-2">الاسم
                                                                :</label>
                                                            <input id="name" type="text" name="name"
                                                                class="form-control" value="{{ $Product->name }}"
                                                                required>
                                                            <input id="id" type="hidden" name="id"
                                                                class="form-control" value="{{ $Product->id }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en" class="mr-sm-2">السعر
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                {{-- value="{{$item['description']}}" --}} value="{{ $Product->price }}"
                                                                name="price" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">الوصف
                                                            :</label>
                                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $Product->description }}</textarea>
                                                    </div>
                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $Product->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{-- {{ trans('Grades_trans.delete_Grade') }} --}}
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
                                </div>
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
                        {{-- {{ trans('Grades_trans.add_Grade') }} --}}
                        اضافة منتج
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    {{-- <form action="{{ route('add.data') }}" method="POST"> --}}
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Name" {{-- class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }} --}} class="mr-sm-2">الاسم
                                    :</label>
                                <input id="name" type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="price" {{-- class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }} --}} class="mr-sm-2">السعر
                                    :</label>
                                <input type="text" class="form-control" name="price" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label {{-- for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }} --}} for="exampleFormControlTextarea1">الوصف
                                :</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" required></textarea>
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

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
