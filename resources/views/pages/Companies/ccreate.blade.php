@extends('layouts.master')

@section('title', 'إنشاء حساب شركة')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h4>إنشاء حساب شركة</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('company.register.submit') }}">
                        @csrf
                        <div class="form-group">
                            <label for="company_name">اسم الشركة</label>
                            <input type="text" name="company_name" id="company_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address_company">عنوان الشركة</label>
                            <input type="text" name="address_company" id="address_company" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_company">هاتف الشركة</label>
                            <input type="text" name="phone_company" id="phone_company" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email_company">البريد الإلكتروني</label>
                            <input type="email" name="email_company" id="email_company" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">كلمة المرور</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="owner_name">اسم المالك *</label>
                            <input type="text" class="form-control" id="owner_name" name="owner_name" required maxlength="255">
                            <div class="invalid-feedback">يرجى إدخال اسم المالك</div>
                        </div>

                        <div class="form-group">
                            <label for="phone_owner">هاتف المالك *</label>
                            <input type="text" class="form-control" id="phone_owner" name="phone_owner" required maxlength="15">
                            <div class="invalid-feedback">يرجى إدخال هاتف المالك</div>
                        </div>

                        <div class="form-group">
                            <label for="economic_activity">النشاط الاقتصادي *</label>
                            <select class="form-control select2" id="economic_activity" name="economic_activity" required>
                                <option value="" selected disabled>اختر النشاط الاقتصادي</option>
                                <option value="نشاط صناعي">نشاط صناعي</option>
                                <option value="نشاط تجاري">نشاط تجاري</option>
                                <option value="نشاط خدمي">نشاط خدمي</option>
                                <option value="نشاط مالي">نشاط مالي</option>
                                <option value="نشاط عقاري">نشاط عقاري</option>
                                <option value="نشاط سياحي">نشاط سياحي</option>
                                <option value="نشاط صحي وتعليمي">نشاط صحي وتعليمي</option>
                                <option value="نشاط بناء ومقاولات">نشاط بناء ومقاولات</option>
                                <option value="نشاط تعديني">نشاط تعديني</option>
                                <option value="نشاط تقني ورقمي">نشاط تقني ورقمي</option>
                                <option value="نشاط اجتماعي">نشاط اجتماعي</option>
                            </select>
                            <div class="invalid-feedback">يرجى اختيار النشاط الاقتصادي</div>
                        </div>

                        <div class="form-group">
                            <label for="fleet_type">نوع الأسطول *</label>
                            <select class="form-control select2" id="fleet_type" name="fleet_type" required>
                                <option value="" selected disabled>اختر نوع الأسطول</option>
                                <option value="شاحنات ثقيلة (قواطر)">شاحنات ثقيلة (قواطر)</option>
                                <option value="شاحنات خفيفة (دينات)">شاحنات خفيفة (دينات)</option>
                                <option value="سيارات (هيلوكسات - دبابات)">سيارات (هيلوكسات - دبابات)</option>
                            </select>
                            <div class="invalid-feedback">يرجى اختيار نوع الأسطول</div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">إنشاء الحساب</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
