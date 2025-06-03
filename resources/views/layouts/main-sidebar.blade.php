<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
    <a href="{{ url('/dashboard') }}">
        <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>

                    <!-- Grades-->
                    {{-- <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                            <div class="pull-left"><i class="fas fa-school"></i><span
                                    class="right-nav-text">{{trans('main_trans.Grades')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('Grades.index')}}">{{trans('main_trans.Grades_list')}}</a></li>

                        </ul>
                    </li> --}}
                    <!-- classes-->
                    <li>
                        {{-- <a href="{{route('companies.index')}}">
                            <div class="pull-left"><i class="fa fa-building"></i><span
                                    class="right-nav-text">الشركات</span></div>

                            <div class="clearfix"></div>
                        </a> --}}
                        <a href="{{route('trucks.index')}}">
                            <div class="pull-left"><i class="fa fa-user"></i><span
                                class="right-nav-text">المركبات</span></div>

                                <div class="clearfix"></div>
                            </a>
                        <a href="{{route('drivers.index')}}">
                            <div class="pull-left"><i class="fa fa-user"></i><span
                                    class="right-nav-text">السائقين</span></div>

                            <div class="clearfix"></div>
                        </a>
                                                <a href="{{route('tasks.index')}}">
                            <div class="pull-left"><i class="fa fa-user"></i><span
                                    class="right-nav-text">المهام</span></div>

                            <div class="clearfix"></div>
                        </a>
                        <a href="{{route('destinations.index')}}">
                            <div class="pull-left"><i class="fa fa-user"></i><span
                                    class="right-nav-text">الوجهات</span></div>

                            <div class="clearfix"></div>
                        </a>
                        <a href="{{route('products.index')}}">
                            <div class="pull-left"><i class="fa fa-user"></i><span
                                    class="right-nav-text">المنتجات</span></div>

                            <div class="clearfix"></div>
                        </a>



                        <a href="{{ route('fleet.log') }}">
    <div class="pull-left"><i class="fa fa-tools"></i><span class="right-nav-text">الصيانة والحوادث</span></div>
    <div class="clearfix"></div>
</a>



                    <!-- الإشعارات -->
                    <li>
                        <a href="{{ route('alerts.index') }}">
                            <div class="pull-left"><i class="fa fa-bell"></i><span class="right-nav-text">الإشعارات</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <!-- الشحنات -->
                    <li>
                        <a href="{{ route('shipments.index') }}">
                            <div class="pull-left"><i class="fa fa-shipping-fast"></i><span class="right-nav-text">الشحنات</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('subscriptions.index') }}">
                            <div class="pull-left"><i class="fa fa-subscribe"></i><span class="right-nav-text">الاشتراكات</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('company-orders.index') }}">
                            <div class="pull-left"><i class="fa fa-subscribe"></i><span class="right-nav-text">الطلبات</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('products.index') }}">
                            <div class="pull-left"><i class="fa fa-subscribe"></i><span class="right-nav-text">الطلبات</span></div>
                            <div class="clearfix"></div>
                        </a>
                        <a href="{{ route('products.index') }}">
                            <div class="pull-left"><i class="fa fa-cube"></i><span class="right-nav-text">المنتجات</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li> --}}
                        {{-- <a href="{{route('products.index')}}">
                            <div class="pull-left"><i class="fa fa-building"></i><span
                                    class="right-nav-text">المنتجات</span></div>

                            <div class="clearfix"></div>
                        </a> --}}
                        {{-- <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('Products.index')}}">المنتجات</a></li>
                            <li><a href="{{url('Products')}}">المنتجات</a></li>

                        </ul> --}}
                    </li>




                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
