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
    </style>
{{-- @endsection --}}


@section('title')

    إنشاء شركة جديدة
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    إنشاء شركة جديدة
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form action="{{ route('companies.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <input type="text" name="company_name" required>
                    <input type="text" name="address_company" required>
                    <input type="text" name="phone_company" required>
                    <input type="email" name="email_company" required>
                    <input type="password" name="password" required>
                    <input type="text" name="owner_name" required>
                    <input type="text" name="phone_owner" required>
                    <input type="text" name="commercial_reg_number" required>
                    <select name="economic_activity" required>
                        <option value="">اختر النشاط</option>
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
                    <select name="fleet_type" required>
                        <option value="">اختر النوع</option>
                        <option value="شاحنات ثقيلة (قواطر)">شاحنات ثقيلة (قواطر)</option>
                        <option value="شاحنات خفيفة (دينات)">شاحنات خفيفة (دينات)</option>
                        <option value="سيارات (هيلوكسات - دبابات)">سيارات (هيلوكسات - دبابات)</option>
                    </select>
                    <button type="submit">حفظ البيانات</button>
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
    </script>
@endsection
