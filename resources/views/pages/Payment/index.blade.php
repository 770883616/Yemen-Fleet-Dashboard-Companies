{{-- filepath: resources/views/pages/Payment/index.blade.php --}}
@extends('layouts.master')
@section('title', 'الدفع والفواتير')

@section('content')
<div class="container-fluid" dir="rtl">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="fa fa-credit-card"></i> الدفع والفواتير</h2>
        <div>
            <button class="btn btn-info" onclick="location.reload()">تحديث البيانات</button>
            <a href="#" class="btn btn-success">إضافة دفعة يدوية</a>
            <a href="#" class="btn btn-primary">عرض ملخص الفواتير</a>
        </div>
    </div>

    {{-- نظرة عامة مالية --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <i class="fa fa-money-bill"></i> إجمالي المدفوع
                    <h3>{{ number_format($totalPaid, 2) }} ر.ي</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <i class="fa fa-file-invoice-dollar"></i> الفواتير المستحقة
                    <h3>{{ $dueInvoices }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <i class="fa fa-check-circle"></i> حالة الاشتراك
                    <h3>{{ $currentSubscriptionStatus }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- جدول الفواتير --}}
    <h4>الفواتير</h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>رقم الفاتورة</th>
                <th>عنوان الفاتورة</th>
                <th>تاريخ الإصدار</th>
                <th>تاريخ الاستحقاق</th>
                <th>المبلغ</th>
                <th>رقم الصيانة</th>
                <th>رقم التقرير</th>
                <th>رقم الدفعة</th>
                <th>تفاصيل</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->invoice_num }}</td>
                <td>{{ $invoice->invoice_title }}</td>
                <td>{{ $invoice->issued_at ? $invoice->issued_at->format('Y-m-d') : '-' }}</td>
                <td>{{ $invoice->due_date }}</td>
                <td>{{ number_format($invoice->amount, 2) }} ر.ي</td>
                <td>{{ $invoice->maintenance_id }}</td>
                <td>{{ $invoice->report_id }}</td>
                <td>{{ $invoice->payment_id }}</td>
                <td>
                    <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-sm btn-info">تفاصيل</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $invoices->links() }}

    {{-- جدول عمليات الدفع --}}
    <h4 class="mt-5">عمليات الدفع</h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>رقم الدفعة</th>
                <th>المبلغ المدفوع</th>
                <th>طريقة الدفع</th>
                <th>الحالة</th>
                <th>تاريخ الدفع</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\App\Models\Payment::latest()->take(10)->get() as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ number_format($payment->amount, 2) }} ر.ي</td>
                <td>{{ $payment->method }}</td>
                <td>
                    <span class="badge
                        @if($payment->status == 'مكتمل') bg-success
                        @elseif($payment->status == 'فشل') bg-danger
                        @else bg-warning @endif">
                        {{ $payment->status }}
                    </span>
                </td>
                <td>{{ $payment->payment_date ? $payment->payment_date->format('Y-m-d') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
