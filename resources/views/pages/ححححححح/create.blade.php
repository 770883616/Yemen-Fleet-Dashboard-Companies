@extends('layouts.master')

@section('title', 'تسجيل حادث جديد')

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

                <form action="{{ route('accidents.store') }}" method="POST">
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
                        <label for="location">موقع الحادث</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="date">تاريخ الحادث</label>
                        <input type="datetime-local" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="type">نوع الحادث</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">-- اختر نوع الحادث --</option>
                            <option value="الاصطدام" {{ old('type') == 'الاصطدام' ? 'selected' : '' }}>الاصطدام</option>
                            <option value="الانهيار" {{ old('type') == 'الانهيار' ? 'selected' : '' }}>الانهيار</option>
                            <option value="اخرى" {{ old('type') == 'اخرى' ? 'selected' : '' }}>أخرى</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">وصف الحادث</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">حفظ الحادث</button>
                    <a href="{{ route('accidents.index') }}" class="btn btn-secondary">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
