@extends('layouts.master')

@section('title')
    تعديل بيانات الشاحنة
@stop

@section('css')
<!-- CSS إضافي عند الحاجة -->
@endsection

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    تعديل بيانات الشاحنة
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form action="{{ route('trucks.update', $truck->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>اسم الشاحنة:</label>
                        <input type="text" name="truck_name" class="form-control" value="{{ old('truck_name', $truck->truck_name) }}" required>
                    </div>

                    <div class="form-group">
                        <label>رقم اللوحة:</label>
                        <input type="text" name="plate_number" class="form-control" value="{{ old('plate_number', $truck->plate_number) }}" required>
                    </div>

                    <div class="form-group">
                        <label>رقم الشاسيه:</label>
                        <input type="text" name="chassis_number" class="form-control" value="{{ old('chassis_number', $truck->chassis_number) }}" required>
                    </div>

                    <div class="form-group">
                        <label>الشركة التابعة:</label>
                        <input type="text" class="form-control" value="{{ $truck->company->company_name ?? '' }}" disabled>
                        <input type="hidden" name="company_id" value="{{ $truck->company_id }}">
                    </div>

                    <div class="form-group">
                        <label>الموقع (خط العرض):</label>
                        <input type="text" name="latitude" class="form-control" value="{{ old('latitude', $truck->latitude) }}">
                    </div>

                    <div class="form-group">
                        <label>الموقع (خط الطول):</label>
                        <input type="text" name="longitude" class="form-control" value="{{ old('longitude', $truck->longitude) }}">
                    </div>

                    <div class="form-group">
                        <label>حالة الشاحنة:</label>
                        <select name="vehicle_status" class="form-control">
                            <option value="">-- اختر الحالة --</option>
                            <option value="نشطة" {{ old('vehicle_status', $truck->vehicle_status) == 'نشطة' ? 'selected' : '' }}>نشطة</option>
                            <option value="متوقفة" {{ old('vehicle_status', $truck->vehicle_status) == 'متوقفة' ? 'selected' : '' }}>متوقفة</option>
                            <option value="تحت الصيانة" {{ old('vehicle_status', $truck->vehicle_status) == 'تحت الصيانة' ? 'selected' : '' }}>تحت الصيانة</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">💾 تحديث</button>
                    <a href="{{ route('trucks.index') }}" class="btn btn-secondary">🔙 رجوع</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- JS إضافي عند الحاجة -->
@endsection
