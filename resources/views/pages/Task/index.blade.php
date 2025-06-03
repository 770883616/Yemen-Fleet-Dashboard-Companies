@extends('layouts.master')

@section('title')
    قائمة المهام
@stop

@section('content')
<div class="row">
    <div class="col-12 mb-3">
        <a href="{{ route('tasks.create') }}" class="btn btn-success">➕ إضافة مهمة جديدة</a>
    </div>

    <div class="col-12">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="driver" class="form-control" placeholder="اسم السائق" value="{{ request('driver') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="start_point" class="form-control" placeholder="نقطة البداية" value="{{ request('start_point') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="end_point" class="form-control" placeholder="نقطة النهاية" value="{{ request('end_point') }}">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary">بحث</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>اسم المهمة</th>
                                <th>اسم السائق</th>
                                <th>نقطة البداية</th>
                                <th>نقطة النهاية</th>
                                <th>الحالة</th>
                                <th>الموعد النهائي</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tasks as $index => $task)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->driver->driver_name ?? 'غير مرتبط' }}</td>
                                    <td>{{ $task->destination->start_point ?? 'غير محددة' }}</td>
                                    <td>{{ $task->destination->end_point ?? 'غير محددة' }}</td>
                                    <td>
                                        @if($task->status == 'تم انجازالمهمه')
                                            <span class="badge bg-success text-white">{{ $task->status }}</span>
                                        @elseif($task->status == 'معلقة')
                                            <span class="badge bg-warning text-dark">{{ $task->status }}</span>
                                        @elseif($task->status == 'قيد التنفيذ')
                                            <span class="badge bg-primary text-white">{{ $task->status }}</span>
                                        @else
                                            <span class="badge bg-secondary text-white">{{ $task->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $task->deadline ? $task->deadline->format('Y-m-d') : 'غير محدد' }}</td>
                                    <td>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-info btn-sm">تعديل</a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8">لا توجد مهام حالياً</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
