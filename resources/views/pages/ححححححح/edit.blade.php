@extends('layouts.master')

@section('title')
    تعديل الحادث
@stop

@section('page-header')
@section('PageTitle')
    تعديل الحادث
@stop
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('accidents.update', $accident->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>الموقع:</label>
                <input type="text" name="location" class="form-control" value="{{ $accident->location }}" required>
            </div>
            <div class="form-group">
                <label>نوع الحادث:</label>
                <select name="accident_type" class="form-control" required>
                    <option value="الاصطدام" {{ $accident->accident_type == 'الاصطدام' ? 'selected' : '' }}>الاصطدام</option>
                    <option value="الانهيار" {{ $accident->accident_type == 'الانهيار' ? 'selected' : '' }}>الانهيار</option>
                    <option value="اخرى" {{ $accident->accident_type == 'اخرى' ? 'selected' : '' }}>أخرى</option>
                </select>
            </div>
            <div class="form-group">
                <label>تاريخ الحادث:</label>
                <input type="datetime-local" name="accident_date" class="form-control" value="{{ $accident->accident_date->format('Y-m-d\TH:i') }}">
            </div>
            <div class="form-group">
                <label>الوصف:</label>
                <textarea name="description" class="form-control">{{ $accident->description }}</textarea>
            </div>
            <div class="form-group">
                <label>الشاحنة:</label>
                <select name="truck_id" class="form-control" required>
                    @foreach ($trucks as $truck)
                        <option value="{{ $truck->id }}" {{ $accident->truck_id == $truck->id ? 'selected' : '' }}>{{ $truck->truck_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">💾 تحديث</button>
        </form>
    </div>
</div>
@endsection
