@extends('layouts.master')

@section('title', 'إضافة صيانة جديدة')

@section('content')
<div class="row">
    <div class="col-12">
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

                <form action="{{ route('maintenances.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="truck_id">الشاحنة</label>
                        <select name="truck_id" id="truck_id" class="form-control" required>
                            <option value="">-- اختر شاحنة --</option>
                            @foreach($trucks as $truck)
                                <option value="{{ $truck->id }}" {{ old('truck_id') == $truck->id ? 'selected' : '' }}>
                                    {{ $truck->truck_name }} - {{ $truck->plate_number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type">نوع الصيانة</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">-- اختر نوع الصيانة --</option>
                            <option value="صيانة دورية" {{ old('type') == 'صيانة دورية' ? 'selected' : '' }}>صيانة دورية</option>
                            <option value="صيانة طارئة" {{ old('type') == 'صيانة طارئة' ? 'selected' : '' }}>صيانة طارئة</option>
                            <option value="إصلاح عطل" {{ old('type') == 'إصلاح عطل' ? 'selected' : '' }}>إصلاح عطل</option>
                            <option value="فحص فني" {{ old('type') == 'فحص فني' ? 'selected' : '' }}>فحص فني</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cost">التكلفة (ريال)</label>
                        <input type="number" step="0.01" name="cost" id="cost" class="form-control" value="{{ old('cost') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="date">تاريخ الصيانة</label>
                        <input type="datetime-local" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">وصف الصيانة</label>
                        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">حفظ الصيانة</button>
                    <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
