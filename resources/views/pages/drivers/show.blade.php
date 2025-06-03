@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>تفاصيل السائق: {{ $driver->driver_name }}</span>
                    <div>
                        <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                        <a href="{{ route('drivers.index') }}" class="btn btn-secondary btn-sm">رجوع</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>المعلومات الأساسية</h5>
                            <p><strong>الاسم:</strong> {{ $driver->driver_name }}</p>
                            <p><strong>البريد الإلكتروني:</strong> {{ $driver->email }}</p>
                            <p><strong>الهاتف:</strong> {{ $driver->phone }}</p>
                            <p><strong>العنوان:</strong> {{ $driver->address ?? 'غير محدد' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>معلومات إضافية</h5>
                            <p><strong>الشركة:</strong> {{ $driver->company->company_name }}</p>
                            <p><strong>الشاحنة:</strong>
                                @if($driver->truck)
                                    {{ $driver->truck->truck_number }} ({{ $driver->truck->truck_type }})
                                @else
                                    <span class="text-muted">لا يوجد شاحنة معينة</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>المهام الموكلة</h5>
                        @if($driver->tasks->count() > 0)
                            <ul class="list-group">
                                @foreach($driver->tasks as $task)
                                    <li class="list-group-item">
                                        {{ $task->task_name }} -
                                        <span class="badge badge-{{ $task->status == 'مكتمل' ? 'success' : 'warning' }}">
                                            {{ $task->status }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="alert alert-info">لا توجد مهام مسندة لهذا السائق</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
