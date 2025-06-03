@extends('layouts.master')

@section('title', 'اختيار طريقة الدفع')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>اختيار طريقة الدفع</h2>
        <p>نوع الاشتراك: {{ $currentSubscription_type }}</p>
        <p>السعر: {{ $price }}$</p>
        <form action="{{ route('subscriptions.storePayment') }}" method="POST">
            @csrf
            <input type="hidden" name="subscription_type" value="{{ $currentSubscription_type }}">
            <div class="form-group">
                <label for="company_id">الشركة</label>
                <select name="company_id" id="company_id" class="form-control" required>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="payment_method">طريقة الدفع</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="بطاقة الائتمان">بطاقة الائتمان</option>
                    <option value="التحويل المصرفي">التحويل المصرفي</option>
                    <option value="الدفع عند التسليم">الدفع عند التسليم</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">إتمام الدفع</button>
        </form>
    </div>
</div>
@endsection
