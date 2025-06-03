@extends('layouts.master')

@section('title', 'تعديل الوجهة')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form action="{{ route('destinations.update', $destination->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="start_point">نقطة البداية</label>
                        <input type="text" name="start_point" class="form-control" value="{{ $destination->start_point }}" required>
                    </div>

                    <div class="form-group">
                        <label for="end_point">نقطة النهاية</label>
                        <input type="text" name="end_point" class="form-control" value="{{ $destination->end_point }}" required>
                    </div>

                    <div class="form-group">
                        <label for="estimated_time">الوقت المتوقع (دقائق)</label>
                        <input type="number" name="estimated_time" class="form-control" value="{{ $destination->estimated_time }}" required>
                    </div>

                    <div class="form-group">
                        <label for="date">التاريخ</label>
                        <input type="date" name="date" class="form-control" value="{{ $destination->date->format('Y-m-d') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="truck_id">الشاحنة</label>
                        <select name="truck_id" class="form-control" required>
                            @foreach($trucks as $truck)
                                <option value="{{ $truck->id }}" {{ $destination->truck_id == $truck->id ? 'selected' : '' }}>{{ $truck->truck_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="task_id">المهمة</label>
                        <select name="task_id" class="form-control" required>
                            @foreach($tasks as $task)
                                <option value="{{ $task->id }}" {{ $destination->task_id == $task->id ? 'selected' : '' }}>{{ $task->task_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="driver_id">السائق</label>
                        <select name="driver_id" class="form-control" required>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ $destination->driver_id == $driver->id ? 'selected' : '' }}>{{ $driver->driver_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">💾 تحديث الوجهة</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
