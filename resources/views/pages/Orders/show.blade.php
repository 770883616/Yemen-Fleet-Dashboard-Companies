@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>تفاصيل طلب الشركة #{{ $order->company_order_id }}</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('company-orders.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> رجوع
            </a>
            @if($order->status == 'pending')
            <button class="btn btn-success approve-btn" data-id="{{ $order->company_order_id }}">
                <i class="fas fa-check"></i> موافقة
            </button>
            @endif
            @if($order->status != 'suspended' && $order->status != 'completed')
            <button class="btn btn-warning suspend-btn" data-id="{{ $order->company_order_id }}">
                <i class="fas fa-pause"></i> تعليق
            </button>
            @endif
            @if($order->status == 'suspended')
            <button class="btn btn-primary unsuspend-btn" data-id="{{ $order->company_order_id }}">
                <i class="fas fa-play"></i> إلغاء تعليق
            </button>
            @endif
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5>معلومات الطلب</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>الشركة:</strong> {{ $order->company->name }}</p>
                    <p><strong>حالة الطلب:</strong>
                        <span class="badge
                            @if($order->status == 'approved') badge-success
                            @elseif($order->status == 'suspended') badge-warning
                            @elseif($order->status == 'pending') badge-info
                            @elseif($order->status == 'completed') badge-primary
                            @else badge-secondary @endif">
                            {{ $order->status }}
                        </span>
                    </p>
                </div>
                <div class="col-md-4">
                    <p><strong>المبلغ الإجمالي:</strong> {{ number_format($order->total_amount, 2) }} ر.س</p>
                    <p><strong>حالة الدفع:</strong>
                        @if($order->payment)
                            <span class="badge badge-success">{{ $order->payment->status }}</span>
                        @else
                            <span class="badge badge-danger">غير مدفوع</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-4">
                    <p><strong>تاريخ الإنشاء:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                    <p><strong>آخر تحديث:</strong> {{ $order->updated_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5>المنتجات</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الصورة</th>
                            <th>اسم المنتج</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                            <th>المجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item->product->image)
                                <img src="{{ asset('storage/'.$item->product->image) }}" width="50" alt="{{ $item->product->name }}">
                                @else
                                <img src="{{ asset('images/no-image.png') }}" width="50" alt="No image">
                                @endif
                            </td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->product->price, 2) }} ر.س</td>
                            <td>{{ number_format($item->quantity * $item->product->price, 2) }} ر.س</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-right">المجموع الإجمالي:</th>
                            <th>{{ number_format($order->total_amount, 2) }} ر.س</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>معلومات العميل</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>اسم العميل:</strong> {{ $order->order->customer->name }}</p>
                    <p><strong>البريد الإلكتروني:</strong> {{ $order->order->customer->email }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>رقم الهاتف:</strong> {{ $order->order->customer->phone }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Suspend Reason -->
<div class="modal fade" id="suspendModal" tabindex="-1" role="dialog" aria-labelledby="suspendModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="suspendModalLabel">تعليق الطلب</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="suspendForm">
                    <input type="hidden" name="order_id" id="suspendOrderId">
                    <div class="form-group">
                        <label for="reason">سبب التعليق</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-warning" id="confirmSuspend">تعليق الطلب</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Approve order
    $('.approve-btn').click(function() {
        const orderId = $(this).data('id');
        if (confirm('هل أنت متأكد من الموافقة على هذا الطلب؟')) {
            $.ajax({
                url: "{{ url('company-orders') }}/" + orderId + "/approve",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    }
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message || 'حدث خطأ أثناء الموافقة على الطلب');
                }
            });
        }
    });

    // Show suspend modal
    $('.suspend-btn').click(function() {
        const orderId = $(this).data('id');
        $('#suspendOrderId').val(orderId);
        $('#suspendModal').modal('show');
    });

    // Confirm suspend
    $('#confirmSuspend').click(function() {
        const formData = $('#suspendForm').serialize();

        $.ajax({
            url: "{{ url('company-orders') }}/" + $('#suspendOrderId').val() + "/suspend",
            method: 'POST',
            data: formData + '&_token={{ csrf_token() }}',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    $('#suspendModal').modal('hide');
                    location.reload();
                }
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message || 'حدث خطأ أثناء تعليق الطلب');
            }
        });
    });

    // Unsuspend order
    $('.unsuspend-btn').click(function() {
        const orderId = $(this).data('id');
        if (confirm('هل أنت متأكد من إلغاء تعليق هذا الطلب؟')) {
            $.ajax({
                url: "{{ url('company-orders') }}/" + orderId + "/unsuspend",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    }
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message || 'حدث خطأ أثناء إلغاء تعليق الطلب');
                }
            });
        }
    });
});
</script>
@endsection
