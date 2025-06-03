filepath: resources/views/layouts/navigation.blade.php
{{-- <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm" style="font-family: 'Cairo', sans-serif;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <i class="fa fa-truck text-primary"></i> يمن فليت
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarFleet" aria-controls="navbarFleet" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarFleet">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fa fa-home"></i> الرئيسية
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('trucks.*') ? 'active' : '' }}" href="{{ route('trucks.index') }}">
                        <i class="fa fa-truck"></i> الشاحنات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('drivers.*') ? 'active' : '' }}" href="{{ route('drivers.index') }}">
                        <i class="fa fa-user"></i> السائقين
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                        <i class="fa fa-shopping-bag"></i> الطلبات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('fleet.log') ? 'active' : '' }}" href="{{ route('fleet.log') }}">
                        <i class="fa fa-tools"></i> الصيانة والحوادث
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shipments.*') ? 'active' : '' }}" href="{{ route('shipments.index') }}">
                        <i class="fa fa-shipping-fast"></i> الشحنات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('subscriptions.*') ? 'active' : '' }}" href="{{ route('subscriptions.index') }}">
                        <i class="fa fa-credit-card"></i> الاشتراكات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('alerts.*') ? 'active' : '' }}" href="{{ route('alerts.index') }}">
                        <i class="fa fa-bell"></i> الإشعارات
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('company.logout') }}">
                        <i class="fa fa-sign-out-alt"></i> تسجيل الخروج
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav> --}}
