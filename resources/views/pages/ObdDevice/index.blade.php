@extends('layouts.master')

@section('title')
    قائمة أجهزة OBD
@stop

@section('page-header')
@section('PageTitle')
    قائمة أجهزة OBD
@stop
@endsect

@section('content')
<div class="row">
    <div class="col-12 mb-3">
        <a href="{{ route('obd.create') }}" class="btn btn-success">➕ إضافة جهاز جديد</a>
    </div>

    <div class="col-12">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>اسم الجهاز</th>
                                <th>نوع الجهاز</th>
                                <th>الشاحنة</th>
                                <th>الشركة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($devices as $index => $device)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $device->device_name }}</td>
                                    <td>{{ $device->device_type }}</td>
                                    <td>{{ $device->truck->truck_name ?? 'غير مرتبطة' }}</td>
                                    <td>{{ $device->company->company_name ?? 'غير محددة' }}</td>
                                    <td>
                                        <a href="{{ route('obd.edit', $device->id) }}" class="btn btn-info btn-sm">تعديل</a>

                                        <form action="{{ route('obd.destroy', $device->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6">لا توجد أجهزة OBD حالياً</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection 
