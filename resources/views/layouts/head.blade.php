<!-- Title -->
<title>@yield("title")</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon" />

<!-- Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
@yield('css')
<!--- Style css -->
<link href="{{ URL::asset('public/assets/css/style.css') }}" rel="stylesheet">
<!-- إضافة Toastr CSS في الـ <head> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<!--- Style css -->
@if (App::getLocale() == 'ar')
    <link href="{{ URL::asset('public/assets/css/ltr.css') }}" rel="stylesheet">
@else
    <link href="{{ URL::asset('public/assets/css/rtl.css') }}" rel="stylesheet">
@endif
