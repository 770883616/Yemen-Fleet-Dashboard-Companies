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
                <div class="form-row">
                    <div class="col">
                        <label for="title">الاسم</label>
                        <input id="name" type="text" name="name" class="form-control"
                            value="{{ Auth::user()->name }}">

                        @error('Email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">البريد الاكتروني</label>
                        <input id="name" type="text" name="name" class="form-control"
                        value="{{ Auth::user()->email }}">                        @error('Email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="from-group row mt-2">
                    <label class="col-lg-12">Auth API Key</label>
                    <div class="col-lg-12">
                        <input type="text" name="authket" required="" class="form-control" value="{{ Auth::user()->api_key }}" disabled="">
                    </div>
                </div>
                {{-- <div class="form-row">
                    <div class="col-md-4">
                        <label for="title">name</label>
                        <input type="text" wire:model="Job_Father" class="form-control">
                        @error('Job_Father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="title">{{trans('Parent_trans.Job_Father')}}</label>
                        <input type="text" wire:model="Job_Father" class="form-control">
                        @error('Job_Father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="title">{{trans('Parent_trans.Job_Father')}}</label>
                        <input type="text" wire:model="Job_Father" class="form-control">
                        @error('Job_Father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}
                {{-- <p><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></p> --}}
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
