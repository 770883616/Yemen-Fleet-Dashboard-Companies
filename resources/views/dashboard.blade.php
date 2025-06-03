<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @include('layouts.head')
    <style>
        #map {
            height: 400px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-primary {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }

        .form-control {
            font-size: 0.9rem;
            padding: 0.4rem 0.8rem;
        }

        .badge {
            width: 15px;
            height: 15px;
            display: inline-block;
            border-radius: 50%;
        }

        .card {
            background-color: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            font-size: 1.2rem;
            font-weight: bold;
        }


        .card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-family: 'Cairo', sans-serif;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body style="font-family: 'Cairo', sans-serif">

    <div class="wrapper" style="font-family: 'Cairo', sans-serif">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="public/assets/images/pre-loader/yemenfleet.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title" >
                <div class="row">
                    <div class="col-sm-6" >
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">{{trans('main_trans.Dashboard_page')}}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- widgets -->
            <div class="row" >
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-bar-chart-o highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">Visitors</p>
                                    <h4>65,650</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> 81% lower
                                growth
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fa fa-shopping-cart highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">Orders</p>
                                    <h4>656</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-bookmark-o mr-1" aria-hidden="true"></i> Total sales
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fa fa-cubes highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">إدارة المنتجات : {{ $totalProducts }}</p>
                                    <h4></h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-database mr-1" aria-hidden="true"></i> إجمالي الكمية: {{ $totalQuantity }}
                            </p>
                            <p class="text-muted pt-3 mb-0 mt-2">
                                <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> منتجات قاربت على النفاد: {{ $lowStockProducts }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fa fa-shopping-bag highlight-icon" aria-hidden="true"></i> <!-- أيقونة جديدة -->
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">طلبات الشركة </p>
                                    <h4>{{ $ordersCount }}</h4>
                                </div>
                            </div>
                            <div class="mt-3">

                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">السائقين</p>
                                    <h4>{{ $driversCount }}</h4> <!-- عرض عدد السائقين -->
                                </div>
                            </div>
                            <div class="mt-3">
                                <ul class="list-inline d-flex justify-content-between" style="font-family: 'Cairo', sans-serif; line-height: 2;">
                                    <li class="list-inline-item text-primary">
                                        <i class="fa fa-circle mr-1"></i>في مهام: {{ $driversWithTasks }}
                                    </li>
                                    <li class="list-inline-item text-warning">
                                        <i class="fa fa-circle mr-1"></i> بدون مهام: {{ $driversWithoutTasks }}
                                    </li>
                                </ul>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 12px;">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-info">
                                        <i class="fa fa-check-square highlight-icon" aria-hidden="true"></i> <!-- أيقونة محسنة -->
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">المهام</p>
                                    <h4>{{ $tasksCount }}</h4> <!-- عرض عدد المهام الإجمالي -->
                                </div>
                            </div>
                            <div class="mt-3">
                                <ul class="list-inline d-flex justify-content-between" style="font-family: 'Cairo', sans-serif; line-height: 2;">
                                    <li class="list-inline-item text-success">
                                        <i class="fa fa-circle mr-1"></i> تم إنجازها: {{ $tasksCompleted }}
                                    </li>
                                    <li class="list-inline-item text-primary">
                                        <i class="fa fa-circle mr-1"></i> قيد التنفيذ: {{ $tasksInProgress }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 12px;">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fa fa-car highlight-icon" aria-hidden="true"></i> <!-- أيقونة المركبات -->
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">المركبات</p>
                                    <h4>{{ $totalTrucks }}</h4> <!-- عرض إجمالي المركبات الخاصة بالشركة -->
                                </div>
                            </div>
                            <div class="mt-3">
                                <ul class="list-inline d-flex justify-content-between" style="font-family: 'Cairo', sans-serif; line-height: 2;">
                                    <li class="list-inline-item text-success">
                                        <i class="fa fa-circle mr-1"></i> نشطة: {{ $activeTrucks }}
                                    </li>
                                    <li class="list-inline-item text-warning">
                                        <i class="fa fa-circle mr-1"></i> متوقفة: {{ $stoppedTrucks }}
                                    </li>
                                    <li class="list-inline-item text-danger">
                                        <i class="fa fa-circle mr-1"></i> في الصيانة: {{ $maintenanceTrucks }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-user highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">الوجهات</p>
                                    <h4>{{ $driversCount }}</h4> <!-- عرض عدد السائقين -->
                                </div>
                            </div>
                            <div class="mt-3">
                                <ul class="list-inline d-flex justify-content-between" style="font-family: 'Cairo', sans-serif; line-height: 2;">
                                    <li class="list-inline-item text-primary">
                                        <i class="fa fa-circle mr-1"></i>في مهام: {{ $driversWithTasks }}
                                    </li>
                                    <li class="list-inline-item text-warning">
                                        <i class="fa fa-circle mr-1"></i> بدون مهام: {{ $driversWithoutTasks }}
                                    </li>
                                </ul>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-12 mb-30">
                    <div class="card">
                        <!-- Header with Search Bar -->
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center" style="font-family: 'Cairo', sans-serif; font-weight: bold;">
                            🌍 خريطة تتبع المركبات
                            <input type="text" class="form-control w-50" placeholder="🔍 بحث..." style="border-radius: 20px; font-family: 'Cairo', sans-serif;">
                        </div>
                        <div class="card-body">
                            <!-- Map -->
                            <div id="map" style="position: relative; height: 600px;"></div>

                            <!-- Zoom Buttons -->
                            <div class="d-flex justify-content-center mt-3">
                                <button id="zoom-in" class="btn btn-outline-primary mx-2" style="border-radius: 50%;">+</button>
                                <button id="zoom-out" class="btn btn-outline-primary mx-2" style="border-radius: 50%;">-</button>
                            </div>

                            <!-- Legend -->
                            <div class="mt-4">
                                <ul class="list-inline d-flex justify-content-center" style="font-family: 'Cairo', sans-serif; line-height: 2;">
                                    <li class="list-inline-item mx-3">
                                        <span class="badge" style="background-color: #007bff; width: 15px; height: 15px; display: inline-block; border-radius: 50%;"></span>
                                        المهمات الحالية
                                    </li>
                                    <li class="list-inline-item mx-3">
                                        <span class="badge" style="background-color: #28a745; width: 15px; height: 15px; display: inline-block; border-radius: 50%;"></span>
                                        الشحنات التي تم تسليمها
                                    </li>
                                    <li class="list-inline-item mx-3">
                                        <span class="badge" style="background-color: #dc3545; width: 15px; height: 15px; display: inline-block; border-radius: 50%;"></span>
                                        الحوادث
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Orders Status widgets-->
            <div class="row">
                <div class="col-xl-4 mb-30">
                    <div class="card card-statistics h-100">
                        <!-- action group -->
                        <div class="btn-group info-drop">
                            <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"><i class="text-primary ti-reload"></i>Refresh</a>
                                <a class="dropdown-item" href="#"><i class="text-secondary ti-eye"></i>View
                                    all</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Market summary</h5>
                            <h4>$50,500 </h4>
                            <div class="row mt-20">
                                <div class="col-4">
                                    <h6>Apple</h6>
                                    <b class="text-info">+ 82.24 % </b>
                                </div>
                                <div class="col-4">
                                    <h6>Instagram</h6>
                                    <b class="text-danger">- 12.06 % </b>
                                </div>
                                <div class="col-4">
                                    <h6>Google</h6>
                                    <b class="text-warning">+ 24.86 % </b>
                                </div>
                            </div>
                        </div>
                        <div id="sparkline2" class="scrollbar-x text-center"></div>
                    </div>
                </div>
                <div class="col-xl-8 mb-30">
                    <div class="card h-100">
                        <div class="btn-group info-drop">
                            <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"><i class="text-primary ti-reload"></i>Refresh</a>
                                <a class="dropdown-item" href="#"><i class="text-secondary ti-eye"></i>View
                                    all</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-block d-md-flexx justify-content-between">
                                <div class="d-block">
                                    <h5 class="card-title">Site Visits Growth </h5>
                                </div>
                                <div class="d-flex">
                                    <div class="clearfix mr-30">
                                        <h6 class="text-success">Income</h6>
                                        <p>+584</p>
                                    </div>
                                    <div class="clearfix  mr-50">
                                        <h6 class="text-danger"> Outcome</h6>
                                        <p>-255</p>
                                    </div>
                                </div>
                            </div>
                            <div id="morris-area" style="height: 320px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 mb-30">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Customer Feedback </h5>
                            <div class="row mb-30">
                                <div class="col-md-6">
                                    <div class="clearfix">
                                        <p class="mb-10 float-left">Positive</p>
                                        <i class="mb-10 text-success float-right fa fa-arrow-up"> </i>
                                    </div>
                                    <div class="progress progress-small">
                                        <div class="skill2-bar bg-success" role="progressbar" style="width: 70%"
                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="mt-10 text-success">8501</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="clearfix">
                                        <p class="mb-10 float-left">Negative</p>
                                        <i class="mb-10 text-danger float-right fa fa-arrow-down"> </i>
                                    </div>
                                    <div class="progress progress-small">
                                        <div class="skill2-bar bg-danger" role="progressbar" style="width: 30%"
                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="mt-10 text-danger">3251</h4>
                                </div>
                            </div>
                            <div class="chart-wrapper" style="width: 100%; margin: 0 auto;">
                                <div id="canvas-holder">
                                    <canvas id="canvas3" width="550"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 class="card-title">Best Sellers</h5>
                                    </div>
                                    <div class="d-block d-md-flex nav-tabs-custom">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active show" id="months-tab" data-toggle="tab"
                                                    href="#months" role="tab" aria-controls="months"
                                                    aria-selected="true"> Months</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="year-tab" data-toggle="tab" href="#year"
                                                    role="tab" aria-controls="year" aria-selected="false">Year
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade active show" id="months" role="tabpanel"
                                        aria-labelledby="months-tab">
                                        <div class="row mb-30">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/05.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">Supercharge your motivation</h6>
                                                <p class="sm-mb-5 d-block">I truly believe Augustine’s words are
                                                    true. </p>
                                                <span class="mb-0">by - <b class="text-info">PotenzaUser</b></span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-primary mb-0"><b>45,436</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-secondary mb-0"><b>$05,236</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                        <div class="row mb-30">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/02.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">Helen keller a teller seller</h6>
                                                <p class="sm-mb-5 d-block">We also know those epic stories,
                                                    those modern.</p>
                                                <span class="mb-0">by - <b class="text-warning">WebminUser</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-success mb-0"><b>23,462</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-danger mb-0"><b>$166</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                        <div class="row mb-30">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/03.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">The other virtues practice</h6>
                                                <p class="sm-mb-5 d-block">One of the most difficult aspects of
                                                    achieving. </p>
                                                <span class="mb-0">by - <b class="text-danger">TheCorps</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-warning mb-0"><b>5,566</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-info mb-0"><b>$4,126</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/04.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">You will begin to realise</h6>
                                                <p class="sm-mb-5 d-block">Remind yourself you have nowhere to
                                                    go except. </p>
                                                <span class="mb-0">by - <b class="text-success">PGSinfotech</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-dark mb-0"><b>5,446</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-success mb-0"><b>$436</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="year" role="tabpanel" aria-labelledby="year-tab">
                                        <div class="row mb-30">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/09.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">Walk out 10 years into</h6>
                                                <p class="sm-mb-5 d-block">Understanding the price and having
                                                    the willingness to pay. </p>
                                                <span class="mb-0">by - <b class="text-danger">TheZayka</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-dark mb-0"><b>12,549</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="theme-color mb-0"><b>$1,656</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                        <div class="row mb-30">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/06.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">Step out on to the path</h6>
                                                <p class="sm-mb-5 d-block">Success to you and then pull it out
                                                    when you are.</p>
                                                <span class="mb-0">by - <b class="text-info">CarDealer</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-primary mb-0"><b>1,366</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-secondary mb-0"><b>$4,536</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                        <div class="row mb-30">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/07.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">Briefly imagine that you</h6>
                                                <p class="sm-mb-5 d-block">Motivators for your personality and
                                                    your personal goals. </p>
                                                <span class="mb-0">by - <b class="text-success">SamMartin</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-success mb-0"><b>465</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-danger mb-0"><b>$499</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2 col-sm-6">
                                                <img class="img-fluid" src="images/blog/08.jpg" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <h6 class="mb-0 sm-mt-5">You continue doing what</h6>
                                                <p class="sm-mb-5 d-block">The first thing to remember about
                                                    success is that. </p>
                                                <span class="mb-0">by - <b class="text-warning">Cosntro</b>
                                                </span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-warning mb-0"><b>4,456</b></h5>
                                                <span>Sales</span>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-6 sm-mt-20">
                                                <h5 class="text-info mb-0"><b>$6,485</b></h5>
                                                <span>Revenue</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <h5 class="card-title">Best Selling Items</h5>
                            <ul class="list-unstyled">
                                <li class="mb-20">
                                    <div class="media">
                                        <div class="position-relative">
                                            <img class="img-fluid mr-15 avatar-small" src="images/item/01.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-0">Car dealer <span class="float-right text-danger">
                                                    8,561</span> </h6>
                                            <p>Automotive WordPress Theme </p>
                                        </div>
                                    </div>
                                    <div class="divider dotted mt-20"></div>
                                </li>
                                <li class="mb-20">
                                    <div class="media">
                                        <div class="position-relative clearfix">
                                            <img class="img-fluid mr-15 avatar-small" src="images/item/02.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-0">Webster <span class="float-right text-warning">
                                                    6,213</span> </h6>
                                            <p>Multi-purpose HTML5 Template </p>
                                        </div>
                                    </div>
                                    <div class="divider dotted mt-20"></div>
                                </li>
                                <li class="mb-20">
                                    <div class="media">
                                        <div class="position-relative">
                                            <img class="img-fluid mr-15 avatar-small" src="images/item/03.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-0">The corps <span class="float-right text-success">
                                                    2,926</span> </h6>
                                            <p> Multi-Purpose WordPress Theme </p>
                                        </div>
                                    </div>
                                    <div class="divider dotted mt-20"></div>
                                </li>
                                <li>
                                    <div class="media">
                                        <div class="position-relative clearfix">
                                            <img class="img-fluid mr-15 avatar-small" src="images/item/04.png" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-0">Sam martin <span
                                                    class="float-right text-warning">6,213 </span></h6>
                                            <p>Personal vCard Resume WordPress Theme </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-30">
                    <div class="card h-100">
                        <div class="btn-group info-drop">
                            <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"><i class="text-primary ti-reload"></i>Refresh</a>
                                <a class="dropdown-item" href="#"><i class="text-secondary ti-eye"></i>View
                                    all</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Site Visits Growth </h5>
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="text-danger">Income</h6>
                                    <p class="text-danger">+584</p>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-info">Outcome</h6>
                                    <p class="text-info">-255</p>
                                </div>
                            </div>
                            <div id="morris-line" style="height: 320px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="p-4 text-center bg" style="background: url(images/bg/01.jpg);">
                            <h5 class="mb-70 text-white position-relative" style="transform: translateY(10px);">Michael Bean </h5>
                            <div class="btn-group info-drop">
                                <button type="button" class="dropdown-toggle-split text-white" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"><i class="text-primary ti-files"></i> Add
                                        task</a>
                                    <a class="dropdown-item" href="#"><i class="text-dark ti-pencil-alt"></i>
                                        Edit Profile</a>
                                    <a class="dropdown-item" href="#"><i class="text-success ti-user"></i> View
                                        Profile</a>
                                    <a class="dropdown-item" href="#"><i class="text-secondary ti-info"></i>
                                        Contact Info</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center position-relative">
                            <div class="avatar-top">
                                <img class="img-fluid w-25 rounded-circle " src="images/team/13.jpg" alt="">
                            </div>
                            <div class="row">
                                <div class="col-sm-4 mt-30">
                                    <b>Files Saved</b>
                                    <h4 class="text-success mt-10">1582</h4>
                                </div>
                                <div class="col-sm-4 mt-30">
                                    <b>Memory Used </b>
                                    <h4 class="text-danger mt-10">58GB</h4>
                                </div>
                                <div class="col-sm-4 mt-30">
                                    <b>Spent Money</b>
                                    <h4 class="text-warning mt-10">352,6$</h4>
                                </div>
                            </div>
                            <div class="divider mt-20"></div>
                            <p class="mt-30">17504 Carlton Cuevas Rd, Gulfport, MS, 39503</p>
                            <p class="mt-10">michael@webmin.com</p>
                            <div class="social-icons color-icon mt-20">
                                <ul>
                                    <li class="social-rss"><a href="#"><i class="fa fa-rss"></i></a></li>
                                    <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="social-github"><a href="#"><i class="fa fa-github"></i></a></li>
                                    <li class="social-youtube"><a href="#"><i class="fa fa-youtube"></i></a>
                                    </li>
                                    <li class="social-instagram"><a href="#"><i class="fa fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="calendar-main mb-30">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="row">
                            <div class="col-12 sm-mb-30">
                                <a href="#" data-toggle="modal" data-target="#add-category"
                                    class="btn btn-primary btn-block m-t-20">
                                    <i class="fa fa-plus pr-2"></i> Create New
                                </a>
                                <div id="external-events" class="m-t-20">
                                    <br>
                                    <p class="text-muted">Drag and drop your event or click in the calendar</p>
                                    <div class="external-event bg-success fc-event">
                                        <i class="fa fa-circle mr-2 vertical-middle"></i>New Theme Release
                                    </div>
                                    <div class="external-event bg-info fc-event">
                                        <i class="fa fa-circle mr-2 vertical-middle"></i>My Event
                                    </div>
                                    <div class="external-event bg-warning fc-event">
                                        <i class="fa fa-circle mr-2 vertical-middle"></i>Meet manager
                                    </div>
                                    <div class="external-event bg-danger fc-event">
                                        <i class="fa fa-circle mr-2 vertical-middle"></i>Create New theme
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div id="calendar"></div>
                        <div class="modal" tabindex="-1" role="dialog" id="event-modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Event</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body p-20"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success save-event">Create
                                            event</button>
                                        <button type="button" class="btn btn-danger delete-event"
                                            data-dismiss="modal">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Add Category -->
                        <div class="modal" tabindex="-1" role="dialog" id="add-category">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add a category</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body p-20">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="control-label">Category Name</label>
                                                    <input class="form-control form-white" placeholder="Enter name"
                                                        type="text" name="category-name" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="control-label">Choose Category Color</label>
                                                    <select class="form-control form-white"
                                                        data-placeholder="Choose a color..." name="category-color">
                                                        <option value="success">Success</option>
                                                        <option value="danger">Danger</option>
                                                        <option value="info">Info</option>
                                                        <option value="primary">Primary</option>
                                                        <option value="warning">Warning</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success save-category"
                                            data-dismiss="modal">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jsvectormap"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap/dist/maps/world.js"></script>
    <script>
        // Initialize the map
        const map = new jsVectorMap({
            selector: "#mmap",
            map: "world",
            regionStyle: {
                initial: {
                    fill: "#d1e9ff"
                },
                hover: {
                    fill: "#4a90e2"
                }
            },
            labels: {
                regions: {
                    render(code) {
                        const names = {
                            YE: "اليمن",
                            SA: "السعودية",
                            EG: "مصر",
                            OM: "عمان"
                        };
                        return names[code] || "";
                    }
                }
            },
            zoomButtons: false, // Disable default zoom buttons
            selectedRegions: ['YE'] // Highlight Yemen
        });

        // Zoom Buttons
        document.getElementById('zoom-in').addEventListener('click', () => {
            map.zoomIn();
        });

        document.getElementById('zoom-out').addEventListener('click', () => {
            map.zoomOut();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('ordersChart').getContext('2d');

        // بيانات وهمية
        var pendingOrders = 50; // الطلبات تحت المراجعة
        var approvedOrders = 80; // الطلبات المقبولة
        var canceledOrders = 20; // الطلبات الملغاة
        var totalOrders = pendingOrders + approvedOrders + canceledOrders;

        // إنشاء المخطط
        var ordersChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['تحت المراجعة', 'مقبولة', 'ملغاة'],
                datasets: [{
                    data: [pendingOrders, approvedOrders, canceledOrders],
                    backgroundColor: ['#007bff', '#28a745', '#dc3545'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false // إخفاء الأسطورة الافتراضية
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                var value = tooltipItem.raw; // القيمة
                                var percentage = ((value / totalOrders) * 100).toFixed(2); // حساب النسبة المئوية
                                return tooltipItem.label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // إنشاء الخريطة
        var map = L.map('map').setView([15.5527, 48.5164], 6); // مركز الخريطة (اليمن)

        // إضافة طبقة الخريطة
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // بيانات الوجهات (تم تمريرها من Laravel)
        var destinations = @json($destinations);

        // بيانات الحوادث (تم تمريرها من Laravel)
        var accidents = @json($accidents);

        // رسم النقاط والمسارات للوجهات
        destinations.forEach(function (destination) {
            Promise.all([
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${destination.start_point}`).then(res => res.json()),
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${destination.end_point}`).then(res => res.json())
            ]).then(([startData, endData]) => {
                if (startData.length === 0 || endData.length === 0) {
                    console.error('لم يتم العثور على المواقع المدخلة:', destination.start_point, destination.end_point);
                    return;
                }

                var startPoint = [startData[0].lat, startData[0].lon];
                var endPoint = [endData[0].lat, endData[0].lon];

                L.marker(startPoint, {
                    icon: L.icon({
                        iconUrl: 'https://cdn-icons-png.flaticon.com/512/2991/2991138.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41]
                    })
                }).addTo(map).bindPopup(`<b>نقطة البداية:</b> ${destination.start_point}`);

                L.marker(endPoint, {
                    icon: L.icon({
                        iconUrl: 'https://cdn-icons-png.flaticon.com/512/2991/2991136.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41]
                    })
                }).addTo(map).bindPopup(`<b>نقطة النهاية:</b> ${destination.end_point}`);

                L.polyline([startPoint, endPoint], {
                    icon: L.icon({
                        iconUrl: 'https://cdn-icons-png.flaticon.com/512/2991/2991139.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41]
                    })
                }).addTo(map);

                map.fitBounds([startPoint, endPoint]);
            }).catch(err => {
                console.error('حدث خطأ أثناء تحليل النصوص:', err);
            });
        });

        // رسم مواقع الحوادث
        accidents.forEach(function (accident) {
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${accident.location}`)
                .then(res => res.json())
                .then(data => {
                    if (data.length === 0) {
                        console.error('لم يتم العثور على موقع الحادث:', accident.location);
                        return;
                    }

                    var accidentPoint = [data[0].lat, data[0].lon];

                    // إضافة أيقونة الحادث
                    L.circleMarker(accidentPoint, {
                        color: 'red',
                        radius: 10
                    }).addTo(map).bindPopup(`
                        <b>موقع الحادث:</b> ${accident.location}<br>
                        <b>نوع الحادث:</b> ${accident.accident_type}<br>
                        <b>تاريخ الحادث:</b> ${accident.accident_date}<br>
                        <b>الوصف:</b> ${accident.description}
                    `);
                }).catch(err => {
                    console.error('حدث خطأ أثناء تحليل موقع الحادث:', err);
                });
        });
    });
</script>
</body>

</html>
