@extends('layouts.master')

@section('title')
    إضافة بيانات OBD
@stop

@section('page-header')
@section('PageTitle')
    إضافة بيانات OBD جديدة
@stop
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form action="{{ route('obd_data.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>الجهاز:</label>
                        <select name="device_id" class="form-control" required>
                            <option value="">-- اختر جهاز --</option>
                            @foreach($devices as $device)
                                <option value="{{ $device->id }}" {{ old('device_id') == $device->id ? 'selected' : '' }}>
                                    {{ $device->device_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>RPM:</label>
                        <input type="number" name="rpm" class="form-control" required value="{{ old('rpm') }}">
                    </div>

                    <div class="form-group">
                        <label>حرارة المحرك (°C):</label>
                        <input type="text" name="engine_temp" class="form-control" required value="{{ old('engine_temp') }}">
                    </div>

                    <div class="form-group">
                        <label>أكواد الأعطال (افصلها بفواصل):</label>
                        <input type="text" name="error_codes[]" class="form-control" placeholder="مثال: P0420,P0171,P0300">
                    </div>

                    <button type="submit" class="btn btn-primary">💾 حفظ</button>
                    <a href="{{ route('obd_data.index') }}" class="btn btn-secondary">🔙 رجوع</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection
