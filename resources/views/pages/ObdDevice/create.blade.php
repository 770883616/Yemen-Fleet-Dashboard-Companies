@extends('layouts.master')

@section('title')
    إضافة جهاز OBD
@stop

@section('page-header')
@section('PageTitle')
    إضاف جهاز OBD جديد
@stop
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form action="{{ route('obd.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>اسم الجهاز:</label>
                        <input type="text" name="device_name" class="form-control" required value="{{ old('device_name') }}">
                    </div>

                    <div class="form-group">
                        <label>نوع الجهاز:</label>
                        <select name="device_type" class="form-control" required>
                            <option value="">-- اختر النوع --</option>
                            <option value="OBD-II" {{ old('device_type') == 'OBD-II' ? 'selected' : '' }}>OBD-II</option>
                            <option value="ELM327" {{ old('device_type') == 'ELM327' ? 'selected' : '' }}>ELM327</option>
                            <option value="MCP2515" {{ old('device_type') == 'MCP2515' ? 'selected' : '' }}>MCP2515</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>الشاحنة المرتبطة:</label>
                        <select name="truck_id" class="form-control" required>
                            <option value="">-- اختر شاحنة --</option>
                            @foreach($trucks as $truck)
                                <option value="{{ $truck->id }}" {{ old('truck_id') == $truck->id ? 'selected' : '' }}>
                                    {{ $truck->truck_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>الشركة:</label>
                        <select name="company_id" class="form-control" required>
                            <option value="">-- اختر شركة --</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->company_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">💾 حفظ</button>
                    <a href="{{ route('obd.index') }}" class="btn btn-secondary">🔙 رجوع</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
