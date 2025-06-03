@extends('layouts.app')

@section('title', 'قائمة المهام')

@section('content')
    <h1>قائمة المهام</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">إضافة مهمة جديدة</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>الموعد النهائي</th>
                <th>الوصف</th>
                <th>الحالة</th>
                <th>السائق</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->task_name }}</td>
                    <td>{{ $task->deadline->format('Y-m-d') }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->driver->name ?? 'غير محدد' }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">تعديل</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
@section('js')

@endsection
