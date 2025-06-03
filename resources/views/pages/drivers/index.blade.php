{{-- filepath: resources/views/pages/Driver/index.blade.php --}}
@extends('layouts.master')
@section('title', 'إدارة السائقين')

@section('content')
<div class="mb-3">
    <a href="{{ route('drivers.create') }}" class="btn btn-success">➕ إضافة سائق</a>
</div>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>الإيميل</th>
            <th>الهاتف</th>
            <th>الحالة</th>
            <th>عدد المهام</th>
            <th>عرض المهام</th>
            <th>الشاحنة</th>
        </tr>
    </thead>
    <tbody>
        @forelse($drivers as $index => $driver)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $driver->driver_name }}</td>
                <td>{{ $driver->email }}</td>
                <td>{{ $driver->phone }}</td>
                <td>{{ $driver->status ?? 'غير محدد' }}</td>
                <td>{{ $driver->tasks->count() }}</td>
                <td>
                    <a href="{{ route('drivers.tasks', $driver->id) }}" class="btn btn-info btn-sm">عرض المهام</a>
                </td>
                <td>
                    @if($driver->truck)
                        {{ $driver->truck->truck_name ?? $driver->truck->plate_number }}
                    @else
                        <span class="text-danger">لا يملك شاحنة</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="8">لا يوجد سائقون حالياً</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
