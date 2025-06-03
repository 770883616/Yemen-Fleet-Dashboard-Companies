@extends('layouts.master')
@section('title', 'اضافة السائقين')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">إضافة سائق جديد</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('drivers.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="driver_name" class="col-md-4 col-form-label text-md-right">اسم السائق</label>
                            <div class="col-md-6">
                                <input id="driver_name" type="text" class="form-control @error('driver_name') is-invalid @enderror" name="driver_name" value="{{ old('driver_name') }}" required>
                                @error('driver_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">البريد الإلكتروني</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">رقم الهاتف</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">العنوان</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">
                                @error('address')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="truck_id" class="col-md-4 col-form-label text-md-right">الشاحنة</label>
                            <div class="col-md-6">
                                <select id="truck_id" class="form-control @error('truck_id') is-invalid @enderror" name="truck_id">
                                    <option value="">-- اختر شاحنة --</option>
                                    @foreach($trucks as $truck)
                                        <option value="{{ $truck->id }}" {{ old('truck_id') == $truck->id ? 'selected' : '' }}>
                                            {{ $truck->truck_number ?? $truck->truck_name ?? 'شاحنة #' . $truck->id }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('truck_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">كلمة المرور</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">تأكيد كلمة المرور</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">حفظ السائق</button>
                                <a href="{{ route('drivers.index') }}" class="btn btn-secondary">رجوع</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
