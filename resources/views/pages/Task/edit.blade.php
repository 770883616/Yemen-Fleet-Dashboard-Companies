@extends('layouts.master')

@section('title')
    تعديل المهمة
@stop

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

                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">اسم المهمة</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $task->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">الوصف</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">الحالة</label>
                        <select name="status" class="form-control">
                            <option value="معلقة" {{ old('status', $task->status) == 'معلقة' ? 'selected' : '' }}>معلقة</option>
                            <option value="قيد التنفيذ" {{ old('status', $task->status) == 'قيد التنفيذ' ? 'selected' : '' }}>قيد التنفيذ</option>
                            <option value="تم انجازالمهمه" {{ old('status', $task->status) == 'تم انجازالمهمه' ? 'selected' : '' }}>تم انجازالمهمه</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="deadline">الموعد النهائي</label>
                        <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $task->deadline ? $task->deadline->format('Y-m-d') : '') }}">
                    </div>

                    <div class="form-group">
                        <label for="driver_id">السائق</label>
                        <select name="driver_id" class="form-control">
                            <option value="">-- اختر سائقاً --</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ old('driver_id', $task->driver_id) == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->driver_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="destination_id">الوجهة</label>
                        <select name="destination_id" class="form-control">
                            <option value="">-- اختر وجهة --</option>
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->id }}" {{ old('destination_id', $task->destination_id) == $destination->id ? 'selected' : '' }}>
                                    {{ $destination->start_point }} → {{ $destination->end_point }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">💾 تحديث المهمة</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">↩️ رجوع</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
