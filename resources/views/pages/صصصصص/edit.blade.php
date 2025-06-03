@extends('layouts.master')

@section('title', 'تعديل الصيانة')

@section('content')
    <h2>تعديل الصيانة</h2>

    <form action="{{ route('maintenance.update', $maintenance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>نوع الصيانة</label>
            <select name="maintenance_type" class="form-control">
                <option value="روتيني" {{ $maintenance->maintenance_type == 'روتيني' ? 'selected' : '' }}>روتيني</option>
                <option value="طوارئ" {{ $maintenance->maintenance_type == 'طوارئ' ? 'selected' : '' }}>طوارئ</option>
            </select>
        </div>

        <div class="form-group">
            <label>التكلفة</label>
            <input type="number" name="cost" class="form-control" value="{{ $maintenance->cost }}">
        </div>

        <div class="form-group">
            <label>التاريخ</label>
            <input type="date" name="date" class="form-control" value="{{ $maintenance->date->format('Y-m-d') }}">
        </div>

        <div class="form-group">
            <label>الوصف</label>
            <input type="text" name="description" class="form-control" value="{{ $maintenance->description }}">
        </div>

        <div class="form-group">
            <label>الشاحنة</label>
            <select name="truck_id" class="form-control">
                @foreach($trucks as $truck)
                    <option value="{{ $truck->id }}" {{ $maintenance->truck_id == $truck->id ? 'selected' : '' }}>
                        {{ $truck->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">حفظ التعديلات</button>
        <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
@endsection

@endsection
@section('js')

@endsection
