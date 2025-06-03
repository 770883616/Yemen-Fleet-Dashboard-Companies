{{-- filepath: resources/views/pages/CompanyOrder/index.blade.php --}}
@extends('layouts.master')

@section('title', 'طلبات الشركات')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">طلبات الشركات</h2>
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>الشركة</th>
                    <th>العميل</th>
                    <th>المبلغ الإجمالي</th>
                    <th>الحالة</th>
                    <th>تاريخ الإنشاء</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companyOrders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->company->company_name ?? '-' }}</td>
                        <td>{{ $order->order->customer->customer_name ?? '-' }}</td>
                        <td>{{ number_format($order->total_amount, 2) }} ر.س</td>
                        <td>
                            <span class="badge
                                @if($order->status == 'approved') bg-success
                                @elseif($order->status == 'suspended') bg-warning text-dark
                                @elseif($order->status == 'pending') bg-info
                                @elseif($order->status == 'completed') bg-primary
                                @else bg-secondary @endif">
                                {{ $order->status == 'approved' ? 'موافق عليه' :
                                    ($order->status == 'suspended' ? 'معلق' :
                                    ($order->status == 'pending' ? 'قيد الانتظار' :
                                    ($order->status == 'completed' ? 'مكتمل' : $order->status))) }}
                            </span>
                        </td>
                        <td>{{ $order->order->order_date?->format('Y-m-d H:i') ?? '-' }}</td>
                        <td>
                            <a href="{{ route('company-orders.show', $order->id) }}" class="btn btn-sm btn-info mb-1">
                                <i class="fas fa-eye"></i> تفاصيل
                            </a>
                            @if($order->status == 'pending')
                                <form action="{{ route('company-orders.approve', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success mb-1">
                                        <i class="fas fa-check"></i> موافقة
                                    </button>
                                </form>
                            @endif
                            @if($order->status != 'suspended' && $order->status != 'completed')
                                <form action="{{ route('company-orders.suspend', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning mb-1">
                                        <i class="fas fa-pause"></i> تعليق
                                    </button>
                                </form>
                            @endif
                            @if($order->status == 'suspended')
                                <form action="{{ route('company-orders.unsuspend', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary mb-1">
                                        <i class="fas fa-play"></i> إلغاء تعليق
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">لا توجد طلبات حالياً</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- روابط الصفحات --}}
    <div class="mt-3">
        {{ $companyOrders->links() }}
    </div>
</div>
@endsection
