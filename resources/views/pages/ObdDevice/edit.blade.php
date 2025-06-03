@extends('layouts.master')

@section('title')
    تعديل جهاز OBD
@stop

@section('page-header')
@section('PageTitle')
    تعديل بيانات الجهاز
@stop
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card card-statistics h-100">
            <div class="card-body">
                <form action="{{ route('obd.update', $device->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>اسم الجهاز:</label>
                        <input type="text" name="device_name" class="form-control" required value="{{ old('device_name', $device->device_name) }}">
                    </div>

                    <div class="form-group">
                        <label>نوع الجهاز:</label>
                        <select name="device_type" class="form-control" required>
                            <option value="OBD-II" {{ old('device_type', $device->device_type) == 'OBD-II' ? 'selected' : '' }}>OBD-II</option>
                            <option value="ELM327" {{ old('device_type', $device->device_type) == 'ELM327' ? 'selected' : '' }}>ELM327</option>
                            <option value="MCP2515" {{ old('device_type', $device->device_type) == 'MCP2515' ? 'selected' : '' }}>MCP2515</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>الشاحنة المرتبطة:</label>
                        <select name="truck_id" class="form-control" required>
                            @foreach($trucks as $truck)
                                <option value="{{ $truck->id }}" {{ old('truck_id', $device->truck_id) == $truck->id ? 'selected' : '' }}>
                                    {{ $truck->truck_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>الشركة:</label>
                        <select name="company_id" class="form-control" required>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id', $device->company_id) == $company->id ? 'selected' : '' }}>
                                    {{ $company->company_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">💾 تحديث</button>
                    <a href="{{ route('obd.index') }}" class="btn btn-secondary">🔙 رجوع</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
