@extends('layouts.driver')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>تفاصيل المهمة</h1>
        <a href="{{ route('driver.tasks.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> رجوع
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>وصف المهمة:</h5>
                    <p>{{ $task->description }}</p>
                </div>
                <div class="col-md-6">
                    <h5>الوجهة:</h5>
                    <p>{{ $task->destination->name ?? 'غير محدد' }}</p>
                    <p>{{ $task->destination->address ?? '' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>الشاحنة المخصصة:</h5>
                    <p>{{ $task->truck->plate_number ?? 'غير محدد' }}</p>
                </div>
                <div class="col-md-6">
                    <h5>تاريخ الإنشاء:</h5>
                    <p>{{ $task->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h5>حالة المهمة:</h5>
                    <form method="POST" action="{{ route('driver.tasks.update-status', $task) }}">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select mb-2" onchange="this.form.submit()">
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>قيد التنفيذ</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>مكتمل</option>
                            <option value="cancelled" {{ $task->status == 'cancelled' ? 'selected' : '' }}>ملغى</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
