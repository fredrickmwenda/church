<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title')</title>


    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/smart/css/bootstrap.min.css')}}">
        
	<!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/smart/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/smart/plugins/fontawesome/css/all.min.css')}}">
   
    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/smart/css/line-awesome.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/smart/css/material.css')}}">
		
	<!-- Chart CSS -->
	<link rel="stylesheet" href="{{ asset('assets/smart/plugins/morris/morris.css')}}">
		
	<!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/smart/css/style.css')}}">
    <!-- Bootstrap 3.3.6 -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}"> -->
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/custom.css') }}"> -->
    <link href="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" /> -->
    <link href="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap-touchspin/bootstrap.touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/select2/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatable/media/css/dataTables.bootstrap.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/datatable/extensions/Buttons/css/buttons.dataTables.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/datatable/extensions/Buttons/css/buttons.bootstrap.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/datatable/extensions/Responsive/css/responsive.bootstrap.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/fancybox/jquery.fancybox.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datepicker/bootstrap-datepicker3.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/jstree/themes/default/style.min.css') }}" rel="stylesheet"
        type="text/css" />


    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}"> -->
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}"> --}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('assets/plugins/jquery/jquery-2.2.3.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jqueryui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
   // <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    {{-- Start Page header level scripts --}}
    @yield('page-header-scripts')
   
</head>

<body >
<div class="main-wrapper">

    <div class="header">
        
        <!-- Logo -->
        <div class="header-left">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
                <img class="logo-mini"
                    src="
                {{ asset('uploads/' . \App\Models\Setting::where('setting_key', 'company_logo')->first()->setting_value) }}"
                    style="height:50px; width:auto;  padding:5px;" />
                <!-- logo for regular state and mobile devices -->

                <img class="logo-lg"
                    src="
                {{ asset('uploads/' . \App\Models\Setting::where('setting_key', 'company_logo')->first()->setting_value) }}"
                    style="height:50px; width:auto; padding:5px;" />
            </a>
                <!-- <a href="admin-dashboard.html" class="logo">
                <img src="assets/img/logo.png" width="40" height="40" alt="Logo">
            </a>
            <a href="admin-dashboard.html" class="logo2">
                <img src="assets/img/logo2.png" width="40" height="40" alt="Logo">
            </a> -->
        </div>
        <!-- /Logo -->
        
        <a id="toggle_btn" href="javascript:void(0);">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>
        
        <!-- Header Title -->
        <div class="page-title-box">
            <h3>Msoft Church</h3>
        </div>
        <!-- /Header Title -->
        
        <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa-solid fa-bars"></i></a>
        
        <!-- Header Menu -->
        <ul class="nav user-menu">
        

        
            <!-- Notifications -->
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <i class="fa-regular fa-bell"></i> <span class="badge rounded-pill">3</span>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="chat-block d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img src="assets/img/profiles/avatar-02.jpg" alt="User Image">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
                                            <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="chat-block d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img src="assets/img/profiles/avatar-03.jpg" alt="User Image">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
                                            <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="chat-block d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img src="assets/img/profiles/avatar-06.jpg" alt="User Image">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
                                            <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="chat-block d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img src="assets/img/profiles/avatar-17.jpg" alt="User Image">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
                                            <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="chat-block d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img src="assets/img/profiles/avatar-13.jpg" alt="User Image">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
                                            <p class="noti-time"><span class="notification-time">2 days ago</span></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="activities.html">View all Notifications</a>
                    </div>
                </div>
            </li>
            <!-- /Notifications -->
            
            <!-- Message Notifications -->
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <i class="fa-regular fa-comment"></i><span class="badge rounded-pill">8</span>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Messages</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <li class="notification-message">
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">
                                                <img src="assets/img/profiles/avatar-09.jpg" alt="User Image">
                                            </span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Richard Miles </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">
                                                <img src="assets/img/profiles/avatar-02.jpg" alt="User Image">
                                            </span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">John Doe</span>
                                            <span class="message-time">6 Mar</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">
                                                <img src="assets/img/profiles/avatar-03.jpg" alt="User Image">
                                            </span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Tarah Shropshire </span>
                                            <span class="message-time">5 Mar</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">
                                                <img src="assets/img/profiles/avatar-05.jpg" alt="User Image">
                                            </span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Mike Litorus</span>
                                            <span class="message-time">3 Mar</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">
                                                <img src="assets/img/profiles/avatar-08.jpg" alt="User Image">
                                            </span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Catherine Manseau </span>
                                            <span class="message-time">27 Feb</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="chat.html">View all Messages</a>
                    </div>
                </div>
            </li>
            <!-- /Message Notifications -->

            <li class="nav-item dropdown has-arrow main-drop">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <span class="user-img"><img src="assets/img/profiles/avatar-21.jpg" alt="User Image">
                    <span class="status online"><i class="fa fa-circle text-success"></span></span>
                    <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
                    <span class="hidden-xs">{{ Sentinel::getUser()->first_name }}
                                {{ Sentinel::getUser()->last_name }}</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('user/' . Sentinel::getUser()->id . '/profile') }}">My Profile</a>
                    @if (Sentinel::hasAccess('settings'))
                        <a class="dropdown-item" href="{{ url('setting/data') }}">Settings</a>
                    @endif
                    <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                </div>
            </li>
        </ul>
        <!-- /Header Menu -->
        
        <!-- Mobile Menu -->
        <div class="dropdown mobile-user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ url('user/' . Sentinel::getUser()->id . '/profile') }}">My Profile</a>
                @if (Sentinel::hasAccess('settings'))
                    <a class="dropdown-item" href="{{ url('setting/data') }}">Settings</a>
                @endif
                <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
            </div>
        </div>
        
        
    </div>
       
        <!-- Left side column. contains the logo and sidebar -->

        @include('left_menu.admin')
        <!-- end Left side column. contains the logo and sidebar -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header" style="min-height: 30px">
                <h1>
                    @yield('title')
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">@yield('title')</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                @if (Session::has('flash_notification'))
                    @foreach (Session::get('flash_notification') as $key)
                        <script>
                            $(document).ready(function() {
                                toastr.{{ $key->level }}('{{ $key->message }}', 'Response Status')
                            })
                        </script>
                    @endforeach
                @endif
                @if (isset($msg))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-bs-dismiss="alert"
                            aria-hidden="true">&times;</button>
                        {{ $msg }}
                    </div>
                @endif
                @if (isset($error))
                    <div class="alert alert-error">
                        <button type="button" class="close" data-bs-dismiss="alert"
                            aria-hidden="true">&times;</button>
                        {{ $error }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('partials.footer')
    </div>
    <!-- ./wrapper -->
        <!-- jQuery -->
       <script src="{{ asset('assets/smart/js/jquery-3.7.0.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{ asset('assets/smart/js/bootstrap.bundle.min.js')}}"></script>
		
		<!-- Slimscroll JS -->
		<script src="{{ asset('assets/smart/js/assets/js/jquery.slimscroll.min.js')}}"></script>
		
		<!-- Chart JS -->
		<script src="{{ asset('assets/smart/js/plugins/morris/morris.min.js')}}"></script>
		<script src="{{ asset('assets/smart/js/plugins/raphael/raphael.min.js')}}"></script>
		<script src="{{ asset('assets/smart/js/chart.js')}}"></script>
		<script src="{{ asset('assets/smart/js/greedynav.js')}}"></script>

		 <!-- Theme Settings JS -->
		<script src="{{ asset('assets/smart/js/js/layout.js')}}"></script>
		<script src="{{ asset('assets/smart/js/js/theme-settings.js')}}"></script>

		<!-- Custom JS -->
		<script src="{{ asset('assets/smart/js/app.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrap-touchspin/bootstrap.touchspin.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/fancybox/jquery.fancybox.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery.numeric.js') }}"></script>
    <!-- AdminLTE App -->
    <!-- <script src="{{ asset('assets/dist/js/app.min.js') }}"></script> -->
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jstree/jstree.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vue.js') }}"></script>
    @yield('footer-scripts')
    <!-- ChartJS 1.0.1 -->
    <script src="{{ asset('assets/dist/js/custom.js') }}"></script>

</body>

</html>
