<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Intelbox Gamelabs">
    <meta name="keywords" content="gaming">
    <meta name="author" content="gamelab">
    <title>{{$page_title}}</title>
    <link rel="apple-touch-icon" href="{{asset('/admin-assets/app-assets')}}/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/admin-assets/app-assets')}}/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/vendors/css/charts/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/vendors/css/weather-icons/climacons.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/css/app.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/css/plugins/calendars/clndr.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/css/core/colors/palette-climacon.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/css/pages/users.css">
    @yield('css')
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/assets')}}/css/style.css">
    <!-- END Custom CSS-->
</head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

    <!-- fixed-top-->
    @include('admin.layout.header')

    <!-- ////////////////////////////////////////////////////////////////////////////-->

    @include('admin.layout.sidebar')


    @yield('content')

    <footer class="footer footer-static footer-light navbar-border">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a class="text-bold-800 grey darken-2" href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank">PIXINVENT </a>, All rights reserved. </span><span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i></span></p>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/extensions/jquery.knob.min.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/charts/raphael-min.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/charts/morris.min.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/charts/chartist.min.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/charts/chartist-plugin-tooltip.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/charts/chart.min.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/charts/jquery.sparkline.min.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/extensions/moment.min.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/extensions/underscore-min.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/extensions/clndr.min.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/extensions/unslider-min.js"></script>
    @yield('js')
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="{{asset('/admin-assets/app-assets')}}/js/core/app-menu.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/js/core/app.js"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('/admin-assets/app-assets')}}/js/scripts/pages/dashboard-project.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/js/scripts/tables/datatables/datatable-basic.js"></script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>