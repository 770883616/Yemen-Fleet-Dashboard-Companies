@extends('layouts.master')

@section('title', 'إضافة دفعة جديدة')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>إضافة دفعة جديدة</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="amount">المبلغ</label>
                <input type="number" name="amount" id="amount" class="form-control" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="payment_date">تاريخ الدفع</label>
                <input type="date" name="payment_date" id="payment_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subscription_id">الاشتراك</label>
                <select name="subscription_id" id="subscription_id" class="form-control" required>
                    @foreach($currentSubscriptions as $currentSubscription)
                        <option value="{{ $currentSubscription->id }}">{{ $currentSubscription->subscription_type }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">إضافة</button>
        </form>
    </div>
</div>
@endsection

@section('js')

@endsection
