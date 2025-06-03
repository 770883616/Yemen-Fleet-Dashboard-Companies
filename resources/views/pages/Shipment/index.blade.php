{{-- filepath: resources/views/pages/Shipment/index.blade.php --}}
@extends('layouts.master')
@section('title', 'إدارة الشحنات')

@section('content')
<div class="container-fluid" dir="rtl">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="fa fa-truck"></i> إدارة الشحنات</h2>
        <div>
            <a href="{{ route('shipments.create') }}" class="btn btn-success">إضافة شحنة</a>
            <button class="btn btn-info" onclick="location.reload()">تحديث</button>
        </div>
    </div>

    {{-- شريط البحث مع أيقونة الفلترة --}}
    <form method="get" class="mb-3 row align-items-center">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="بحث برقم الشحنة..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#filterOptions">
                <i class="fa fa-filter"></i> فلترة
            </button>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary">بحث</button>
        </div>
        <div class="col-md-4"></div>
        <div class="col-12">
            <div class="collapse mt-2" id="filterOptions">
                <div class="row">
                    <div class="col-md-4">
                        <select name="truck_id" class="form-control">
                            <option value="">كل الشاحنات</option>
                            @foreach($trucks as $truck)
                                <option value="{{ $truck->id }}" {{ request('truck_id') == $truck->id ? 'selected' : '' }}>
                                    {{ $truck->truck_name ?? $truck->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="shipping_date" class="form-control" value="{{ request('shipping_date') }}">
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- جدول الشحنات --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نوع الشحنة</th>
                    <th>تاريخ الشحن</th>
                    <th>الحالة</th>
                    <th>الشاحنة</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($shipments as $shipment)
                <tr>
                    <td>{{ $shipment->id }}</td>
                    <td>{{ $shipment->type }}</td>
                    <td>{{ $shipment->shipping_date }}</td>
                    <td>{{ $shipment->status }}</td>
                    <td>{{ $shipment->truck->truck_name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('shipments.show', $shipment->id) }}" class="btn btn-info btn-sm">عرض</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">لا توجد شحنات</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $shipments->links() }}
    </div>
</div>
@endsection
