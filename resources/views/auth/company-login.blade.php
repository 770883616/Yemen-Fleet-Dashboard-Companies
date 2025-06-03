<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Yemen Fleet, تسجيل دخول, إدارة أسطول">
    <meta name="description" content="سجل دخولك إلى نظام Yemen Fleet لإدارة أساطيل النقل">
    <meta name="author" content="Yemen Fleet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>تسجيل دخول الشركة - Yemen Fleet</title>

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
        .login-container {
            display: flex;
            min-height: 100vh;
        }

        /* Banner Section */
        .login-banner {
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
        .login-form-container {
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

        .login-form {
            max-width: 500px;
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
            width: 107%;
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

        /* Remember Me & Forgot Password */
        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-left: 0.5rem;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password:hover {
            text-decoration: underline;
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
            .login-container {
                flex-direction: column;
            }

            .login-banner {
                order: 2;
                padding: 1.5rem;
                text-align: center;
            }

            .login-form-container {
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
            .login-form-container {
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
            .login-banner {
                padding: 1rem;
            }

            .login-form-container {
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

            .login-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
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
    </style>
</head>

<body>

    <!-- Preloader -->
    <div id="pre-loader">
        <img src="{{ asset('public/assets/images/pre-loader/yemenfleet.svg') }}" alt="جار التحميل...">
    </div>

    <!-- Main Login Container -->
    <div class="login-container">
        <!-- Banner Section -->
        <div class="login-banner">
            <div class="banner-content">
                <h2>مرحباً بعودتك!</h2>
                <p>سجل دخولك الآن للوصول إلى لوحة تحكم شركتك وإدارة أسطولك  وأدارة جميع العمليات اليومية للأسطول من اي مكان وبكل سهولة امكانية التتبع اللحظي للشاحنات في أسطولك عبر احدث اجهزة التتبع ومتابعة حالة الشاحنات لحظة بلحظة وتتبع الاعطال وكيفية اصلحها أدارة لجميع المهام البيع الطلبات المنتجات السائقين الشحنات المهام الوجهات وادارة أداء اسطولك بكل سهولة.</p>
                <div class="legal-links">
                    <a href="#">شروط الاستخدام</a>
                    <a href="#">سياسة الخصوصية</a>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="login-form-container">
            <div class="form-header">
                <h3>تسجيل الدخول</h3>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('company.login.submit') }}" class="login-form">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email_company">البريد الإلكتروني *</label>
                    <input id="email_company" type="email" class="form-control @error('email_company') is-invalid @enderror"
                           name="email_company" value="{{ old('email_company') }}" required autofocus>
                    @error('email_company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password Field -->
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

                <!-- Remember Me & Forgot Password -->
                <div class="login-options">
                    <div class="remember-me">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">تذكرني</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="forgot-password">نسيت كلمة المرور؟</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">
                    <span>تسجيل الدخول</span>
                    <i class="fas fa-sign-in-alt"></i>
                </button>
            </form>

            <div class="form-footer">
                <p>لا تملك حساباً؟ <a href="{{ route('company.register') }}">أنشئ حساب شركة جديدة</a></p>
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
                    .html('<i class="fas fa-spinner fa-spin"></i> جاري تسجيل الدخول...');
            });

            // Auto focus on email field if empty, otherwise on password field
            @if(old('email_company'))
                $('#password').focus();
            @else
                $('#email_company').focus();
            @endif
        });
    </script>
</body>
</html>
