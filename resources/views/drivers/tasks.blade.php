{{-- filepath: resources/views/pages/Driver/tasks.blade.php --}}
@extends('layouts.master')
@section('title', 'مهام السائق')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>مهام السائق: {{ $driver->driver_name }}</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>اسم المهمة</th>
                    <th>الوصف</th>
                    <th>الموعد النهائي</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->deadline }}</td>
                    <td>{{ $task->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


