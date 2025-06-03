<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

 <style>
    .dropdown-notifications {
        width: 650px;
        max-height: 400px;
        overflow-y: auto;
        border-radius: 10px;
    }

    .notification-item {
        transition: background-color 0.3s ease;
        padding: 10px;
        border-radius: 8px;
    }

    .notification-item:hover {
        background-color: #f8f9fa;
    }

    .icon {
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
    }

    #clear-notifications {
        font-size: 12px;
        padding: 2px 8px;
    }

    [dir="rtl"] .navbar-nav.ml-auto {
        margin-left: 0 !important;
        margin-right: auto !important;
    }
</style>

<!--=================================
 header start-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container-fluid">
                <!-- زر القائمة للهاتف -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="تبديل القائمة">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- الشعار -->
                <a class="navbar-brand" href="index.html">
                    <img src="{{ asset('public/assets/images/yemenfleet-logo.svg') }}" alt="YemenFleet Logo" height="40">
                </a>

                <!-- عناصر القائمة -->
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a id="button-toggle" class="nav-link" href="javascript:void(0);">
                                <i class="zmdi zmdi-menu ti-align-right"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="بحث" aria-label="بحث">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto align-items-center">
                        <!-- الإشعارات -->
                        @if(isset($notifications))
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-bell"></i>
                                @if($notifications->where('is_read', false)->count())
                                    <span class="badge badge-danger notification-status">{{ $notifications->where('is_read', false)->count() }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-notifications shadow-lg rounded">
                                <div class="dropdown-header notifications d-flex justify-content-between align-items-center">
                                    <strong>الإشعارات</strong>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="notifications-container">
                                    @forelse($notifications as $notification)
                                        <div class="notification-item d-flex align-items-start mb-3">
                                            <div class="icon bg-primary text-white rounded-circle mr-3">
                                                <i class="ti-bell"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">{{ $notification->type ?? 'إشعار' }}</h6>
                                                <p class="mb-0 text-muted">{{ $notification->message }}</p>
                                                <small class="text-muted">
                                                    {{ $notification->created_at ? $notification->created_at->diffForHumans() : '-' }}
                                                </small>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center text-muted py-3">لا توجد إشعارات جديدة</div>
                                    @endforelse
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="text-center">
                                    <a href="{{ route('alerts.index') }}" class="btn btn-primary btn-sm">عرض جميع الإشعارات</a>
                                </div>
                            </div>
                        </li>
                        @endif

                        <!-- المستخدم -->
                        <li class="nav-item dropdown">
                            <a class="nav-link user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('public/assets/images/user_icon.png') }}" alt="avatar" style="width:32px; height:32px;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                {{-- أضف روابط المستخدم هنا --}}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--=================================
 header End-->
