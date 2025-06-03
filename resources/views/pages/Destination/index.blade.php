@extends('layouts.master')

@section('title', 'قائمة الوجهات')

@section('content')
<div class="row">
    <div class="col-12 mb-3">
        <a href="{{ route('destinations.create') }}" class="btn btn-success">➕ إضافة وجهة جديدة</a>
    </div>

    <div class="col-12">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>موقع الشاحنة (نقطة البداية)</th>
                                <th>نقطة النهاية</th>
                                <th>التاريخ</th>
                                <th>الشاحنة</th>
                                <th>المهمة</th>
                                <th>السائق</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($destinations as $index => $destination)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
    @if($destination->truck_location)
        <a href="https://maps.google.com/?q={{ $destination->truck_location }}" target="_blank">
            عرض الموقع
        </a>
    @else
        <span class="text-muted">لا توجد بيانات موقع</span>
    @endif
</td>
                                  <td>{{ $destination->end_point }}</td>
                                  <td>{{ $destination->date->format('Y-m-d') }}</td>
                                    <td>{{ $destination->task->truck->truck_name ?? 'غير محددة' }}</td>
                                    <td>{{ $destination->task->name ?? 'غير محددة' }}</td>
                                    <td>{{ $destination->task->driver->driver_name ?? 'غير محدد' }}</td>
                                    <td>
                                        <a href="{{ route('destinations.edit', $destination->id) }}" class="btn btn-info btn-sm">تعديل</a>
                                        <form action="{{ route('destinations.destroy', $destination->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8">لا توجد وجهات حالياً</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
