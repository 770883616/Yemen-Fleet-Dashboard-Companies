@extends('layouts.master')

@section('title', 'إضافة دفعة جديدة')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">إتمام عملية الاشتراك</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('subscriptions.store') }}">
                        @csrf

                        <input type="hidden" name="subscription_type" value="{{ request('type') }}">

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">نوع الاشتراك</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ request('type') == 'شهري' ? 'اشتراك شهري (100 ريال)' : 'اشتراك سنوي (1000 ريال)' }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="company_id" class="col-md-4 col-form-label text-md-end">الشركة</label>
                            <div class="col-md-6">
                                <select id="company_id" class="form-select @error('company_id') is-invalid @enderror" name="company_id" required>
                                    <option value="">-- اختر الشركة --</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="payment_id" class="col-md-4 col-form-label text-md-end">طريقة الدفع</label>
                            <div class="col-md-6">
                                <select id="payment_id" class="form-select @error('payment_id') is-invalid @enderror" name="payment_id" required>
                                    <option value="">-- اختر طريقة الدفع --</option>
                                    @foreach($paymentMethods as $method)
                                        <option value="{{ $method->id }}">{{ $method->method }}</option>
                                    @endforeach
                                </select>
                                @error('payment_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    تأكيد الاشتراك
                                </button>
                                <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary">
                                    رجوع
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
