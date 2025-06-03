@extends('layouts.driver')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">المهام المخصصة لك</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($tasks->isEmpty())
                <p class="text-center">لا توجد مهام مخصصة لك حالياً.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الوصف</th>
                                <th>الوجهة</th>
                                <th>الحالة</th>
                                <th>تاريخ الإنشاء</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Str::limit($task->description, 50) }}</td>
                                <td>{{ $task->destination->name ?? 'غير محدد' }}</td>
                                <td>
                                    <span class="badge
                                        @if($task->status == 'pending') bg-warning text-dark
                                        @elseif($task->status == 'in_progress') bg-info text-white
                                        @elseif($task->status == 'completed') bg-success text-white
                                        @else bg-secondary text-white
                                        @endif">
                                        {{ __('driver.task_status.'.$task->status) }}
                                    </span>
                                </td>
                                <td>{{ $task->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('driver.tasks.show', $task) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> عرض
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
