@extends('layouts.app')

@section('title', 'إضافة مهمة جديدة')

@section('content')
    <h1>إضافة مهمة جديدة</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="task_name" class="form-label">اسم المهمة</label>
            <input type="text" class="form-control" id="task_name" name="task_name" value="{{ old('task_name') }}" required>
        </div>
        <div class="mb-3">
            <label for="deadline" class="form-label">الموعد النهائي</label>
            <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">الحالة</label>
            <input type="text" class="form-control" id="status" name="status" value="{{ old('status') }}" required>
        </div>
        <div class="mb-3">
            <label for="driver_id" class="form-label">السائق</label>
            <select class="form-control" id="driver_id" name="driver_id" required>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                        {{ $driver->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">حفظ</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
@endsection

@endsection
@section('js')

@endsection
