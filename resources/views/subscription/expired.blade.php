@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-danger shadow-lg">
                <div class="card-header bg-gradient-danger text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-exclamation-circle mr-2"></i> تنبيه هام بخصوص الاشتراك
                    </h4>
                    <span class="badge bg-white text-danger p-2">حالة الاشتراك: غير نشط</span>
                </div>

                <div class="card-body">
                    <div class="alert alert-danger border-danger">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-2x mr-3"></i>
                            <h5 class="mb-0">{{ session('message') }}</h5>
                        </div>
                    </div>

                    <div class="subscription-steps mb-4">
                        <h4 class="text-center mb-4">
                            <i class="fas fa-file-invoice-dollar mr-2"></i>إجراءات تفعيل الاشتراك
                        </h4>

                        <div class="steps-container">
                            @if(session('has_subscription'))
                            <!-- خطوات تجديد الاشتراك -->
                            <div class="step-card bg-light-warning border-warning">
                                <div class="step-number bg-warning">1</div>
                                <div class="step-content">
                                    <h5>الدفع البنكي</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check-circle text-success mr-2"></i> قم بإيداع مبلغ <strong>100 دولار</strong> لكل شهر</li>
                                        <li><i class="fas fa-check-circle text-success mr-2"></i> الحساب البنكي: <strong>SA03 8000 1234 5678 9012 3456</strong></li>
                                        <li><i class="fas fa-check-circle text-success mr-2"></i> اسم البنك: <strong>بنك البلاد</strong></li>
                                        <li><i class="fas fa-check-circle text-success mr-2"></i> إسم المستفيد: <strong>شركة النقل المتكامل</strong></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="step-card bg-light-info border-info">
                                <div class="step-number bg-info">2</div>
                                <div class="step-content">
                                    <h5>إرسال إيصال الدفع</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-envelope text-primary mr-2"></i> البريد الإلكتروني: <strong>payments@example.com</strong></li>
                                        <li><i class="fas fa-phone-alt text-primary mr-2"></i> واتساب: <strong>+966501234567</strong></li>
                                        <li><i class="fas fa-info-circle text-primary mr-2"></i> تأكد من إرفاق رقم الشركة في الرسالة</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="step-card bg-light-success border-success">
                                <div class="step-number bg-success">3</div>
                                <div class="step-content">
                                    <h5>التفعيل</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-clock text-success mr-2"></i> سيتم تفعيل اشتراكك خلال <strong>24 ساعة</strong> عمل</li>
                                        <li><i class="fas fa-bell text-success mr-2"></i> ستتلقى تأكيدًا بالبريد الإلكتروني</li>
                                    </ul>
                                </div>
                            </div>
                            @else
                            <!-- خطوات الاشتراك الجديد -->
                            <div class="step-card bg-light-primary border-primary">
                                <div class="step-number bg-primary">1</div>
                                <div class="step-content">
                                    <h5>اختيار الباقة</h5>
                                    <div class="pricing-table">
                                        <div class="pricing-card">
                                            <h6>اشتراك شهري</h6>
                                            <div class="price">100 دولار/شهر</div>
                                        </div>
                                        <div class="pricing-card featured">
                                            <h6>اشتراك سنوي</h6>
                                            <div class="price">1000 دولار/سنوياً</div>
                                            <div class="discount">توفير 20%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="step-card bg-light-warning border-warning">
                                <div class="step-number bg-warning">2</div>
                                <div class="step-content">
                                    <h5>الدفع البنكي</h5>
                                    <div class="bank-info">
                                        <div class="bank-card">
                                            <img src="{{ asset('images/alrajhi-bank.png') }}" alt="البنك الأهلي" class="bank-logo">
                                            <div class="account-info">
                                                <div>IBAN: <strong>SA03 8000 1234 5678 9012 3456</strong></div>
                                            </div>
                                        </div>
                                        <div class="bank-card">
                                            <img src="{{ asset('images/albilad-bank.png') }}" alt="بنك البلاد" class="bank-logo">
                                            <div class="account-info">
                                                <div>IBAN: <strong>SA55 7000 9876 5432 1098 7654</strong></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="step-card bg-light-success border-success">
                                <div class="step-number bg-success">3</div>
                                <div class="step-content">
                                    <h5>إكمال التسجيل</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-user-check mr-2"></i> التواصل مع مدير النظام</li>
                                        <li><i class="fas fa-phone-alt mr-2"></i> <strong>+966501234567</strong></li>
                                        <li><i class="fas fa-envelope mr-2"></i> <strong>sales@example.com</strong></li>
                                        <li><i class="fas fa-clock mr-2"></i> خدمة العملاء متاحة من 8 صباحاً إلى 5 مساءً</li>
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="support-section text-center p-4 bg-light rounded border">
                        <h4 class="mb-3">
                            <i class="fas fa-headset"></i> لديك استفسار؟ نحن هنا لمساعدتك
                        </h4>
                        <div class="d-flex justify-content-center flex-wrap">
                            <a href="tel:+966501234567" class="btn btn-outline-primary m-2">
                                <i class="fas fa-phone-alt"></i> اتصل بنا: 0501234567
                            </a>
                            <a href="https://wa.me/966501234567" class="btn btn-outline-success m-2">
                                <i class="fab fa-whatsapp"></i> واتساب
                            </a>
                            <a href="mailto:support@example.com" class="btn btn-outline-danger m-2">
                                <i class="fas fa-envelope"></i> البريد الإلكتروني
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        font-weight: 700;
    }

    .step-card {
        position: relative;
        border-left: 4px solid;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .step-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .step-number {
        position: absolute;
        top: -15px;
        left: -15px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }

    .step-content {
        margin-left: 30px;
    }

    .pricing-table {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .pricing-card {
        background: white;
        border-radius: 10px;
        padding: 15px;
        margin: 10px;
        text-align: center;
        width: 200px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        position: relative;
    }

    .pricing-card.featured {
        border: 2px solid #28a745;
    }

    .pricing-card h6 {
        font-weight: 600;
        color: #333;
    }

    .price {
        font-size: 18px;
        font-weight: 700;
        color: #2c3e50;
        margin: 10px 0;
    }

    .discount {
        position: absolute;
        top: -10px;
        right: -10px;
        background: #28a745;
        color: white;
        border-radius: 20px;
        padding: 3px 10px;
        font-size: 12px;
    }

    .bank-info {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .bank-card {
        display: flex;
        align-items: center;
        background: white;
        padding: 15px;
        border-radius: 8px;
        margin: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
    }

    .bank-logo {
        width: 60px;
        height: 60px;
        object-fit: contain;
        margin-right: 15px;
    }

    .account-info {
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .pricing-table, .bank-info {
            flex-direction: column;
            align-items: center;
        }

        .pricing-card, .bank-card {
            width: 100%;
            max-width: none;
        }
    }
</style>
@endsection
