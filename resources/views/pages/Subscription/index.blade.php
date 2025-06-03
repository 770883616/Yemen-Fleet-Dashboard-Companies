{{-- filepath: resources/views/pages/Subscription/index.blade.php --}}
@extends('layouts.master')
@section('title', 'الاشتراك والفواتير')

@section('content')
<div class="container-fluid" dir="rtl" style="font-family: 'Cairo', 'Tajawal', Arial, sans-serif;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fa fa-credit-card text-primary"></i> الاشتراك والفواتير</h2>
        <a href="{{ route('subscriptions.create') }}" class="btn btn-success">اشتراك جديد</a>
    </div>

    {{-- تفاصيل الاشتراك الحالي --}}
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fa fa-id-card"></i> تفاصيل الاشتراك الحالي</h5>
        </div>
        <div class="card-body">
            @if($currentSubscription)
                <ul class="list-unstyled">
                    <li><strong>نوع الاشتراك:</strong>
                        {{ $currentSubscription->type == 'monthly' ? 'شهري' : 'سنوي' }}
                    </li>
                    <li><strong>تاريخ البداية:</strong>
                        {{ $currentSubscription->start_date ? $currentSubscription->start_date->format('Y-m-d') : '-' }}
                    </li>
                    <li><strong>تاريخ النهاية:</strong>
                        {{ $currentSubscription->end_date ? $currentSubscription->end_date->format('Y-m-d') : '-' }}
                    </li>
                    <li><strong>الحالة:</strong>
                        <span class="badge
                            @if($currentSubscription->status == 'active') bg-success
                            @elseif($currentSubscription->status == 'expired') bg-danger
                            @else bg-warning text-dark @endif">
                            {{ $currentSubscription->status == 'active' ? 'نشط' : ($currentSubscription->status == 'expired' ? 'منتهي' : 'ملغي') }}
                        </span>
                    </li>
                    <li><strong>السعر:</strong> {{ number_format($currentSubscription->price, 2) }} ر.س</li>
                </ul>
            @else
                <div class="alert alert-warning">لا يوجد اشتراك حالي لهذه الشركة.</div>
            @endif
        </div>
    </div>

    {{-- جدول كل الاشتراكات --}}
    <h5 class="mt-4">كل اشتراكات الشركة:</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>نوع الاشتراك</th>
                <th>تاريخ البداية</th>
                <th>تاريخ النهاية</th>
                <th>الحالة</th>
                <th>السعر</th>
            </tr>
        </thead>
        <tbody>
            @forelse($allSubscriptions as $sub)
                <tr>
                    <td>{{ $sub->type == 'monthly' ? 'شهري' : 'سنوي' }}</td>
                    <td>{{ $sub->start_date ? $sub->start_date->format('Y-m-d') : '-' }}</td>
                    <td>{{ $sub->end_date ? $sub->end_date->format('Y-m-d') : '-' }}</td>
                    <td>
                        <span class="badge
                            @if($sub->status == 'active') bg-success
                            @elseif($sub->status == 'expired') bg-danger
                            @else bg-warning text-dark @endif">
                            {{ $sub->status == 'active' ? 'نشط' : ($sub->status == 'expired' ? 'منتهي' : 'ملغي') }}
                        </span>
                    </td>
                    <td>{{ number_format($sub->price, 2) }} ر.س</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">لا توجد اشتراكات سابقة.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- جدول الفواتير --}}
    <h5 class="mt-4">الفواتير:</h5>
    <table class="table table-bordered text-center align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th>رقم الفاتورة</th>
                <th>تاريخ الإصدار</th>
                <th>المبلغ</th>
                <th>الحالة</th>
                <th>طريقة الدفع</th>
                <th>تفاصيل</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoices as $invoice)
            <tr>
                <td>INV-{{ $invoice->id }}</td>
                <td>{{ $invoice->created_at ? $invoice->created_at->format('Y-m-d') : '-' }}</td>
                <td>{{ number_format($invoice->amount, 2) }} ر.س</td>
                <td>
                    @if($invoice->status == 'مدفوعة')
                        <span class="text-success">🟢 مدفوعة</span>
                    @elseif($invoice->status == 'معلقة')
                        <span class="text-warning">🟡 معلقة</span>
                    @else
                        <span class="text-danger">🔴 غير مدفوعة</span>
                    @endif
                </td>
                <td>{{ $invoice->payment_method ?? '-' }}</td>
                <td>
                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-outline-info">عرض</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">لا توجد فواتير حالياً</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
