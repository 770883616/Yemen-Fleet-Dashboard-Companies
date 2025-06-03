@extends('layouts.master')

@section('title', 'تعديل الدفع')

@section('content')
    <h1>تعديل الدفع</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('payments.update', $payment) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="amount" class="form-label">المبلغ</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount', $payment->amount) }}" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="payment_date" class="form-label">تاريخ الدفع</label>
            <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{ old('payment_date', $payment->payment_date->format('Y-m-d')) }}" required>
        </div>
        <div class="mb-3">
            <label for="method" class="form-label">طريقة الدفع</label>
            <select class="form-control" id="method" name="method" required>
                <option value="بطاقة الائتمان" {{ old('method', $payment->method) == 'بطاقة الائتمان' ? 'selected' : '' }}>بطاقة الائتمان</option>
                <option value="عند التسليم" {{ old('method', $payment->method) == 'عند التسليم' ? 'selected' : '' }}>عند التسليم</option>
                <option value="التحويل المصرفي" {{ old('method', $payment->method) == 'التحويل المصرفي' ? 'selected' : '' }}>التحويل المصرفي</option>
                <option value="أجل" {{ old('method', $payment->method) == 'أجل' ? 'selected' : '' }}>أجل</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">الحالة</label>
            <select class="form-control" id="status" name="status" required>
                <option value="معلق" {{ old('status', $payment->status) == 'معلق' ? 'selected' : '' }}>معلق</option>
                <option value="مكتمل" {{ old('status', $payment->status) == 'مكتمل' ? 'selected' : '' }}>مكتمل</option>
                <option value="فشل" {{ old('status', $payment->status) == 'فشل' ? 'selected' : '' }}>فشل</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="subscription_id" class="form-label">الاشتراك</label>
            <select class="form-control" id="subscription_id" name="subscription_id" required>
                @foreach($currentSubscriptions as $currentSubscription)
                    <option value="{{ $currentSubscription->id }}" {{ old('subscription_id', $payment->subscription_id) == $currentSubscription->id ? 'selected' : '' }}>
                        {{ $currentSubscription->subscription_type }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">تحديث</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
@endsection
