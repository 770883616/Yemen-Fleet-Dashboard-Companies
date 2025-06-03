@extends('layouts.master')
@section('title', 'إضافة شاحنة جديدة')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>إضافة شاحنة جديدة</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('trucks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="truck_name" class="form-label">اسم الشاحنة</label>
                <input type="text" name="truck_name" id="truck_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="plate_number" class="form-label">رقم اللوحة</label>
                <input type="text" name="plate_number" id="plate_number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="chassis_number" class="form-label">رقم الشاسيه</label>
                <input type="text" name="chassis_number" id="chassis_number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="vehicle_status" class="form-label">الحالة</label>
                <select name="vehicle_status" id="vehicle_status" class="form-control" required>
                    <option value="نشطة">نشطة</option>
                    <option value="متوقفة">متوقفة</option>
                    <option value="تحت الصيانة">تحت الصيانة</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">حفظ</button>
            <a href="{{ route('trucks.index') }}" class="btn btn-secondary">إلغاء</a>
        </form>
    </div>
</div>
@endsection
