{{-- filepath: resources/views/pages/Shipment/show.blade.php --}}
@extends('layouts.master')
@section('title', 'تفاصيل الشحنة')

@section('content')
<div class="container">
    <h2>تفاصيل الشحنة #{{ $shipment->id }}</h2>
    <ul class="list-group mb-3">
س        <li class="list-group-item"><strong>نوع الشحنة:</strong> {{ $shipment->type ?? '-' }}</li>
        <li class="list-group-item"><strong>تاريخ الشحن:</strong> {{ $shipment->shipping_date ?? '-' }}</li>
        <li class="list-group-item"><strong>الحالة:</strong> <span class="badge bg-info">{{ $shipment->status }}</span></li>
        <li class="list-group-item"><strong>اسم الشاحنة:</strong> {{ $shipment->truck_name ?? '-' }}</li>
        <li class="list-group-item"><strong>رقم اللوحة:</strong> {{ $shipment->plate_number ?? '-' }}</li>
        <li class="list-group-item"><strong>اسم السائق:</strong> {{ $shipment->driver_name ?? '-' }}</li>
        <li class="list-group-item"><strong>تاريخ الإنشاء:</strong> {{ $shipment->created_at ?? '-' }}</li>
    </ul>
    <a href="{{ route('shipments.index') }}" class="btn btn-secondary">رجوع</a>
</div>
@endsection
