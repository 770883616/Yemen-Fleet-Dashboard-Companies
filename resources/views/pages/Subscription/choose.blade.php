@extends('layouts.master')

@section('title', 'اختيار نوع الاشتراك')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2>اختيار نوع الاشتراك</h2>
        <form action="{{ route('subscriptions.payment') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="subscription_type">نوع الاشتراك</label>
                <select name="subscription_type" id="subscription_type" class="form-control" required>
                    <option value="سنوي">سنوي - 250$</option>
                    <option value="شهري">شهري - 99$</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">التالي</button>
        </form>
    </div>
</div>
@endsection
