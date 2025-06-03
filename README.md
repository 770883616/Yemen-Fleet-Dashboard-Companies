# 🏢 Yemen Fleet - لوحة تحكم الشركة

<p align="center">
  <img src="images/company_portal_logo.png" width="400" alt="Company Portal Logo">
  <br>
  <img src="https://img.shields.io/badge/Version-2.1.0-blue" alt="Version">
  <img src="https://img.shields.io/badge/Laravel-10.x-red" alt="Laravel">
  <img src="https://img.shields.io/badge/License-Commercial-yellow" alt="License">
</p>

## 🌟 نظرة عامة
لوحة تحكم متكاملة للشركات العاملة في نظام Yemen Fleet تمكنك من:
- 🚛 **إدارة أسطول الشاحنات**
- 👨‍✈️ **توزيع السائقين**
- 📦 **متابعة الطلبات**
- 📊 **تحليل الأداء**

## 🖼️ لقطات من النظام

<div align="center">
  <h3>اللوحة الرئيسية</h3>
  <img src="images/company_dashboard_main.png" width="800" class="screenshot">
  
  <div class="grid">
    <div>
      <h4>إدارة السائقين</h4>
      <img src="images/drivers_management.png" width="350">
    </div>
    <div>
      <h4>تتبع الطلبات</h4>
      <img src="images/live_orders.png" width="350">
    </div>
  </div>

  <h3 style="margin-top:30px">إدارة الشاحنات</h3>
  <img src="images/fleet_management.png" width="700">
</div>

## 🔧 الميزات الرئيسية

### 🚚 إدارة الأسطول
- تسجيل الشاحنات والمركبات
- جدولة الصيانة الدورية
- تتبع مواقع المركبات

### 📦 نظام الطلبات
| الميزة | الوصف |
|--------|-------|
| لوحة الطلبات | عرض جميع الطلبات مع فلترات متقدمة |
| تتبع حي | مشاهدة مواقع السائقين على الخريطة |
| تقارير التسليم | إشعارات وتقارير التسليم |

### 📊 التحليلات
mermaid
pie
  title توزيع الطلبات
  "مكتمل" : 65
  "قيد التوصيل" : 20
  "ملغى" : 5
  "معلق" : 10
🛠️ التقنيات المستخدمة
Diagram
Code






🚀 البدء السريع
المتطلبات
PHP 8.2+

Composer

Node.js 16+

التنصيب
bash
git clone https://github.com/770883616/Yemen-Fleet-Dashboard-Companies.git
cd Yemen-Fleet-Company-Portal
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

## 📞 الدعم الفني

<div align="center" style="margin: 30px 0;">

| طريقة التواصل | التفاصيل | 
|--------------|----------|
| **البريد الإلكتروني** | [support@yemenfleet.com](mailto:ayman.tawfaq.developer@gmail.com) |
| **واتساب** | [+967 770 883 615](https://wa.me/967770883615) |
| **ساعات العمل** | الأحد - الخميس (8 صباحًا - 4 مساءً) |

</div>

<div align="center" style="margin-top: 50px; color: #666; font-size: 14px;">
  <p>© 2024 Yemen Fleet. جميع الحقوق محفوظة</p>
</div>