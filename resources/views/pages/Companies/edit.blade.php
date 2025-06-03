@extends('layouts.master')
@section('css')
    <!-- إضافة أي أنماط CSS خاصة بالنموذج هنا -->
    <link href="{{ asset('assets/css/form-validation.css') }}" rel="stylesheet">
    <style>
        .select2-container--default .select2-selection--single {
            height: 38px;
            padding-top: 4px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        .password-field {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>

<!-- breadcrumb -->
@section('title')

    تعديل بيانات الشركة
@stop
@endsection
@section('page-header')

@section('PageTitle')
    تعديل بيانات الشركة
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form action="{{ route('companies.update', $company->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="company_name" class="form-label">اسم الشركة *</label>
                            <input type="text" class="form-control" id="company_name" name="company_name"
                                   value="{{ old('company_name', $company->company_name) }}" required maxlength="255">
                            <div class="invalid-feedback">يرجى إدخال اسم الشركة</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email_company" class="form-label">البريد الإلكتروني *</label>
                            <input type="email" class="form-control" id="email_company" name="email_company"
                                   value="{{ old('email_company', $company->email_company) }}" required maxlength="50">
                            <div class="invalid-feedback">يرجى إدخال بريد إلكتروني صحيح</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 password-field">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" class="form-control" id="password" name="password" minlength="8">
                            <small class="text-muted">اترك الحقل فارغًا إذا كنت لا تريد تغيير كلمة المرور</small>
                            <span class="password-toggle" onclick="togglePassword()">
                                <i class="fa fa-eye"></i>
                            </span>
                            <div class="invalid-feedback">كلمة المرور يجب أن تكون 8 أحرف على الأقل</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone_company" class="form-label">هاتف الشركة *</label>
                            <input type="text" class="form-control" id="phone_company" name="phone_company"
                                   value="{{ old('phone_company', $company->phone_company) }}" required maxlength="15">
                            <div class="invalid-feedback">يرجى إدخال هاتف الشركة</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="address_company" class="form-label">عنوان الشركة *</label>
                            <textarea class="form-control" id="address_company" name="address_company" rows="2" required>{{ old('address_company', $company->address_company) }}</textarea>
                            <div class="invalid-feedback">يرجى إدخال عنوان الشركة</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="owner_name" class="form-label">اسم المالك *</label>
                            <input type="text" class="form-control" id="owner_name" name="owner_name"
                                   value="{{ old('owner_name', $company->owner_name) }}" required maxlength="255">
                            <div class="invalid-feedback">يرجى إدخال اسم المالك</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone_owner" class="form-label">هاتف المالك *</label>
                            <input type="text" class="form-control" id="phone_owner" name="phone_owner"
                                   value="{{ old('phone_owner', $company->phone_owner) }}" required maxlength="15">
                            <div class="invalid-feedback">يرجى إدخال هاتف المالك</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="commercial_reg_number" class="form-label">رقم السجل التجاري *</label>
                            <input type="number" class="form-control" id="commercial_reg_number"
                                   name="commercial_reg_number"
                                   value="{{ old('commercial_reg_number', $company->commercial_reg_number) }}" required>
                            <div class="invalid-feedback">يرجى إدخال رقم السجل التجاري</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="economic_activity" class="form-label">النشاط الاقتصادي *</label>
                            <select class="form-control select2" id="economic_activity" name="economic_activity" required>
                                <option value="" disabled>اختر النشاط الاقتصادي</option>
                                <option value="نشاط صناعي" {{ old('economic_activity', $company->economic_activity) == 'نشاط صناعي' ? 'selected' : '' }}>نشاط صناعي</option>
                                <option value="نشاط تجاري" {{ old('economic_activity', $company->economic_activity) == 'نشاط تجاري' ? 'selected' : '' }}>نشاط تجاري</option>
                                <option value="نشاط خدمي" {{ old('economic_activity', $company->economic_activity) == 'نشاط خدمي' ? 'selected' : '' }}>نشاط خدمي</option>
                                <option value="نشاط مالي" {{ old('economic_activity', $company->economic_activity) == 'نشاط مالي' ? 'selected' : '' }}>نشاط مالي</option>
                                <option value="نشاط عقاري" {{ old('economic_activity', $company->economic_activity) == 'نشاط عقاري' ? 'selected' : '' }}>نشاط عقاري</option>
                                <option value="نشاط سياحي" {{ old('economic_activity', $company->economic_activity) == 'نشاط سياحي' ? 'selected' : '' }}>نشاط سياحي</option>
                                <option value="نشاط صحي وتعليمي" {{ old('economic_activity', $company->economic_activity) == 'نشاط صحي وتعليمي' ? 'selected' : '' }}>نشاط صحي وتعليمي</option>
                                <option value="نشاط بناء ومقاولات" {{ old('economic_activity', $company->economic_activity) == 'نشاط بناء ومقاولات' ? 'selected' : '' }}>نشاط بناء ومقاولات</option>
                                <option value="نشاط تعديني" {{ old('economic_activity', $company->economic_activity) == 'نشاط تعديني' ? 'selected' : '' }}>نشاط تعديني</option>
                                <option value="نشاط تقني ورقمي" {{ old('economic_activity', $company->economic_activity) == 'نشاط تقني ورقمي' ? 'selected' : '' }}>نشاط تقني ورقمي</option>
                                <option value="نشاط اجتماعي" {{ old('economic_activity', $company->economic_activity) == 'نشاط اجتماعي' ? 'selected' : '' }}>نشاط اجتماعي</option>
                            </select>
                            <div class="invalid-feedback">يرجى اختيار النشاط الاقتصادي</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="fleet_type" class="form-label">نوع الأسطول *</label>
                            <select class="form-control select2" id="fleet_type" name="fleet_type" required>
                                <option value="" disabled>اختر نوع الأسطول</option>
                                <option value="شاحنات ثقيلة (قواطر)" {{ old('fleet_type', $company->fleet_type) == 'شاحنات ثقيلة (قواطر)' ? 'selected' : '' }}>شاحنات ثقيلة (قواطر)</option>
                                <option value="شاحنات خفيفة (دينات)" {{ old('fleet_type', $company->fleet_type) == 'شاحنات خفيفة (دينات)' ? 'selected' : '' }}>شاحنات خفيفة (دينات)</option>
                                <option value="سيارات (هيلوكسات - دبابات)" {{ old('fleet_type', $company->fleet_type) == 'سيارات (هيلوكسات - دبابات)' ? 'selected' : '' }}>سيارات (هيلوكسات - دبابات)</option>
                            </select>
                            <div class="invalid-feedback">يرجى اختيار نوع الأسطول</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary" type="submit">حفظ التعديلات</button>
                            <a href="{{ route('companies.index') }}" class="btn btn-secondary">إلغاء</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@section('js')
    <!-- إضافة أي سكريبتات JS خاصة بالنموذج هنا -->
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script>
        // تفعيل select2
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "اختر من القائمة",
                allowClear: true
            });

            // التحقق من الصحة
            (function() {
                'use strict';

                var forms = document.querySelectorAll('.needs-validation');

                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            }

                            form.classList.add('was-validated');
                        }, false);
                    });
            })();
        });

        // تبديل عرض كلمة المرور
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
