{{-- filepath: resources/views/pages/Fleet/maintenance_accidents.blade.php --}}
@extends('layouts.master')
@section('title', 'سجل الصيانة والحوادث')

@section('content')
<div class="container-fluid" dir="rtl" style="font-family: 'Cairo', 'Tajawal', Arial, sans-serif;">
    <div class="row mb-4">
        <div class="col-md-6">
            <h3><i class="fa fa-tools text-primary"></i> سجل الصيانة</h3>
        </div>
    </div>
    {{-- فلترة السجلات --}}
    <form method="get" class="row g-2 mb-3">
        <div class="col-md-3">
            <select name="truck_id" class="form-select">
                <option value="">كل الشاحنات</option>
                @foreach($trucks as $truck)
                    <option value="{{ $truck->id }}" {{ request('truck_id') == $truck->id ? 'selected' : '' }}>
                        {{ $truck->truck_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary w-100">تصفية</button>
        </div>
    </form>

    {{-- جدول الصيانة --}}
    <div class="card mb-5">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>الشاحنة</th>
                            <th>النوع</th>
                            <th>التكلفة</th>
                            <th>التاريخ</th>
                            <th>الوصف</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($maintenances as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->truck->truck_name ?? '-' }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->cost }} ر.س</td>
                                <td>{{ $item->date ? $item->date->format('Y-m-d') : '-' }}</td>
                                <td>{{ $item->description ?? '-' }}</td>
                                <td>
                                    @if($item->status == 'مكتملة')
                                        <span class="badge bg-success">مكتملة</span>
                                    @elseif($item->status == 'قيد التنفيذ')
                                        <span class="badge bg-warning text-dark">قيد التنفيذ</span>
                                    @else
                                        <span class="badge bg-secondary">غير محددة</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">لا توجد عمليات صيانة مسجلة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $maintenances->links() }}
            </div>
        </div>
    </div>

    <hr class="my-5">

    <div class="row mb-4">
        <div class="col-md-6">
            <h3><i class="fa fa-exclamation-triangle text-danger"></i> سجل الحوادث</h3>
        </div>
    </div>
    {{-- جدول الحوادث --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>الموقع</th>
                            <th>نوع الحادث</th>
                            <th>التاريخ</th>
                            <th>الشاحنة المرتبطة</th>
                            <th>الوصف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($accidents as $accident)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $accident->location }}</td>
                                <td>{{ $accident->type }}</td>
                                <td>{{ $accident->date ? $accident->date->format('Y-m-d') : '-' }}</td>
                                <td>{{ $accident->truck->truck_name ?? '-' }}</td>
                                <td>{{ $accident->description ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">لا توجد حوادث مسجلة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $accidents->links() }}
            </div>
        </div>
    </div>

    <a href="{{ route('maintenances.create') }}" class="btn btn-success rounded-circle shadow position-fixed"
       style="bottom: 30px; right: 30px; width:60px; height:60px; z-index:1000; display:flex; align-items:center; justify-content:center;">
        <i class="fa fa-plus fa-lg"></i>
    </a>
</div>
@endsection
