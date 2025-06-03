{{-- filepath: resources/views/pages/Payment/show.blade.php --}}
@extends('layouts.master')
@section('title', 'تفاصيل الفاتورة')

@section('content')
<div class="container">
    <h2>تفاصيل الفاتورة #{{ $invoice->invoice_num }}</h2>
    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>عنوان الفاتورة:</strong> {{ $invoice->invoice_title }}</li>
        <li class="list-group-item"><strong>المبلغ:</strong> {{ number_format($invoice->amount, 2) }} ر.ي</li>
        <li class="list-group-item"><strong>تاريخ الإصدار:</strong> {{ $invoice->issued_at ? $invoice->issued_at->format('Y-m-d') : '-' }}</li>
        <li class="list-group-item"><strong>تاريخ الاستحقاق:</strong> {{ $invoice->due_date }}</li>
        <li class="list-group-item"><strong>رقم الصيانة:</strong> {{ $invoice->maintenance_id }}</li>
        <li class="list-group-item"><strong>رقم التقرير:</strong> {{ $invoice->report_id }}</li>
        <li class="list-group-item"><strong>رقم الدفعة:</strong> {{ $invoice->payment_id }}</li>
    </ul>
    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">رجوع</a>
</div>
@endsection
