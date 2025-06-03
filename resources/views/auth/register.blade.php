<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Yemen Fleet, تسجيل شركة, إدارة أسطول">
    <meta name="description" content="سجل شركتك في نظام Yemen Fleet لإدارة أساطيل النقل">
    <meta name="author" content="Yemen Fleet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>تسجيل شركة جديدة - Yemen Fleet</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
    <style>
        :root {
            --primary-color: #4e54c8;
            --secondary-color: #8f94fb;
            --accent-color: #6a3093;
            --text-color: #333;
            --light-gray: #f5f5f5;
            --white: #ffffff;
            --error-color: #e74c3c;
            --success-color: #2ecc71;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background-color: var(--light-gray);
            color: var(--text-color);
            direction: rtl;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Preloader Styles */
        #pre-loader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Main Container */
        .registration-container {
            display: flex;
            min-height: 100vh;
        }

        /* Banner Section */
        .registration-banner {
            flex: 1;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                        url('{{ asset("public/assets/images/yemenfleet.jpg") }}');
            background-size: cover;
            background-position: center;
            color: var(--white);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .banner-content {
            max-width: 500px;
            margin: 0 auto;
        }

        .banner-content h2 {
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .banner-content p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .legal-links {
            margin-top: auto;
            display: flex;
            gap: 1.5rem;
        }

        .legal-links a {
            color: var(--white);
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .legal-links a:hover {
            opacity: 0.8;
            text-decoration: underline;
        }

        /* Form Section */
        .registration-form-container {
            flex: 1;
            background-color: var(--white);
            padding: 3rem;
            overflow-y: auto;
            max-height: 100vh;
        }

        .form-header {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .form-header h3 {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .registration-form {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-color);
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(78, 84, 200, 0.2);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: var(--error-color);
        }

        .invalid-feedback {
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: 0.3rem;
            display: block;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: left 1rem center;
            background-size: 12px;
            padding-right: 1rem;
        }

        /* Button Styles */
        .submit-btn {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: var(--white);
            border: none;
            padding: 1rem 2rem;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            width: 100%;
            font-weight: 500;
            margin-top: 1rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .submit-btn i {
            margin-left: 0.5rem;
        }

        /* Link Styles */
        .form-footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.95rem;
        }

        .form-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .alert-success {
            background-color: rgba(46, 204, 113, 0.1);
            border: 1px solid var(--success-color);
            color: var(--success-color);
        }

        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            border: 1px solid var(--error-color);
            color: var(--error-color);
        }

        /* Responsive Adjustments */
        @media (max-width: 1199.98px) {
            .registration-container {
                flex-direction: column;
            }

            .registration-banner {
                order: 2;
                padding: 1.5rem;
                text-align: center;
            }

            .registration-form-container {
                order: 1;
                padding: 2rem;
            }

            .banner-content {
                max-width: 100%;
            }

            .banner-content h2 {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 767.98px) {
            .registration-form-container {
                padding: 1.5rem;
            }

            .form-header h3 {
                font-size: 1.5rem;
            }

            .form-group {
                margin-bottom: 1.2rem;
            }
        }

        @media (max-width: 575.98px) {
            .registration-banner {
                padding: 1rem;
            }

            .registration-form-container {
                padding: 1rem;
            }

            .form-header h3 {
                font-size: 1.3rem;
            }

            .legal-links {
                flex-direction: column;
                gap: 0.5rem;
                align-items: center;
            }
        }

        /* Animation for form elements */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-group {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* Delay animations for better visual effect */
        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
        .form-group:nth-child(6) { animation-delay: 0.6s; }
        .form-group:nth-child(7) { animation-delay: 0.7s; }
        .form-group:nth-child(8) { animation-delay: 0.8s; }
        .form-group:nth-child(9) { animation-delay: 0.9s; }
        .form-group:nth-child(10) { animation-delay: 1s; }
        .form-group:nth-child(11) { animation-delay: 1.1s; }
    </style>
</head>

<body>

    <!-- Preloader -->
    <div id="pre-loader">
        <img src="{{ asset('public/assets/images/pre-loader/yemenfleet.svg') }}" alt="جار التحميل...">
    </div>

    <!-- Main Registration Container -->
    <div class="registration-container">
        <!-- Banner Section -->
        <div class="registration-banner">
            <div class="banner-content">
                <h2>انضم إلى Yemen Fleet اليوم!</h2>
                <p>سجل شركتك الآن للاستفادة من نظام متكامل لإدارة أسطول الشاحنات والخدمات اللوجستية بكل سهولة وكفاءة.</p>
                <div class="legal-links">
                    <a href="#">شروط الاستخدام</a>
                    <a href="#">سياسة الخصوصية</a>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="registration-form-container">
            <div class="form-header">
                <h3>تسجيل شركة جديدة</h3>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any()))
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('company.register.submit') }}" class="registration-form">
                @csrf

                <!-- Company Information -->
                <div class="form-group">
                    <label for="company_name">اسم الشركة *</label>
                    <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror"
                           name="company_name" value="{{ old('company_name') }}" required autofocus>
                    @error('company_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address_company">عنوان الشركة *</label>
                    <input id="address_company" type="text" class="form-control @error('address_company') is-invalid @enderror"
                           name="address_company" value="{{ old('address_company') }}" required>
                    @error('address_company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_company">هاتف الشركة *</label>
                    <input id="phone_company" type="tel" class="form-control @error('phone_company') is-invalid @enderror"
                           name="phone_company" value="{{ old('phone_company') }}" required>
                    @error('phone_company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email_company">البريد الإلكتروني *</label>
                    <input id="email_company" type="email" class="form-control @error('email_company') is-invalid @enderror"
                           name="email_company" value="{{ old('email_company') }}" required>
                    @error('email_company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password Section -->
                <div class="form-group">
                    <label for="password">كلمة المرور *</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">تأكيد كلمة المرور *</label>
                    <input id="password_confirmation" type="password" class="form-control"
                           name="password_confirmation" required>
                </div>

                <!-- Owner Information -->
                <div class="form-group">
                    <label for="phone_owner">هاتف المالك *</label>
                    <input id="phone_owner" type="tel" class="form-control @error('phone_owner') is-invalid @enderror"
                           name="phone_owner" value="{{ old('phone_owner') }}" required>
                    @error('phone_owner')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="owner_name">اسم المالك *</label>
                    <input id="owner_name" type="text" class="form-control @error('owner_name') is-invalid @enderror"
                           name="owner_name" value="{{ old('owner_name') }}" required>
                    @error('owner_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Commercial Information -->
                <div class="form-group">
                    <label for="commercial_reg_number">رقم السجل التجاري *</label>
                    <input id="commercial_reg_number" type="text"
                           class="form-control @error('commercial_reg_number') is-invalid @enderror"
                           name="commercial_reg_number" value="{{ old('commercial_reg_number') }}" required>
                    @error('commercial_reg_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="economic_activity">النشاط الاقتصادي *</label>
                    <select id="economic_activity" name="economic_activity" class="form-control" required>
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
                    @error('economic_activity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="fleet_type">نوع الأسطول *</label>
                    <select id="fleet_type" name="fleet_type" class="form-control" required>
                        <option value="">اختر النوع</option>
                        <option value="شاحنات ثقيلة (قواطر)">شاحنات ثقيلة (قواطر)</option>
                        <option value="شاحنات خفيفة (دينات)">شاحنات خفيفة (دينات)</option>
                        <option value="سيارات (هيلوكسات - دبابات)">سيارات (هيلوكسات - دبابات)</option>
                    </select>
                    @error('fleet_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">
                    <span>تسجيل الشركة</span>
                    <i class="fas fa-user-plus"></i>
                </button>
            </form>

            <div class="form-footer">
                <p>لديك حساب بالفعل؟ <a href="{{ route('company.login') }}">سجل دخولك هنا</a></p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Hide preloader when page is loaded
        $(window).on('load', function() {
            $('#pre-loader').fadeOut('slow');
        });

        // Form submission handling
        $(document).ready(function() {
            $('form').on('submit', function() {
                $(this).find('button[type="submit"]')
                    .prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin"></i> جاري التسجيل...');
            });

            // Set default values for select fields if coming back with errors
            @if(old('Economic_activity'))
                $('#Economic_activity').val('{{ old('Economic_activity') }}');
            @endif

            @if(old('Fleet_Type'))
                $('#Fleet_Type').val('{{ old('Fleet_Type') }}');
            @endif
        });
    </script>
</body>
</html>
