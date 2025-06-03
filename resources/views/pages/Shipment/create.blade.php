@extends('layouts.master')
@section('title', 'إضافة شحنة جديدة')

@section('content')
<div class="container">
    <h2>إضافة شحنة جديدة</h2>
    <form action="{{ route('shipments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>نوع الشحنة</label>
            <select name="shipment_type" class="form-control" required>
                <option value="قياسي">قياسي</option>
                <option value="صريح">صريح</option>
            </select>
        </div>
        <div class="mb-3">
            <label>الحالة</label>
            <select name="status" class="form-control" required>
                <option value="معلق">معلق</option>
                <option value="تم التسليم">تم التسليم</option>
                <option value="جاري الشحن">جاري الشحن</option>
                <option value="متأخر بسبب عطل">متأخر بسبب عطل</option>
            </select>
        </div>
        <div class="mb-3">
            <label>الوجهة</label>
            <input type="text" name="destination" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>الشاحنة</label>
            <select name="truck_id" class="form-control" required>
                @foreach($trucks as $truck)
                    <option value="{{ $truck->id }}">{{ $truck->plate_number }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>السائق</label>
            <select name="driver_id" class="form-control">
                <option value="">بدون</option>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>رقم الطلب</label>
            <input type="number" name="order_id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">حفظ</button>
        <a href="{{ route('shipments.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection
