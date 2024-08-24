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
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/smart/css/style.css')}}">
    <!--Ionicons--changefrom cdn to local -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style /change this one-->
    <link rel="stylesheet" href="{{ asset('assets/smart/css/smarta.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/css/tempus-dominus.min.css" crossorigin="anonymous">
    <style>
        .main-footer {
            left: 0;
            position: relative;
            transition: all 0.2s ease-in-out;
            margin: 0 0 0 230px;
            padding: 60px 0 0;
        }

        .dash-widget {
            transition: transform .5s;

            &::after {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                transition: opacity 2s cubic-bezier(.165, .84, .44, 1);
                box-shadow: 0 8px 17px 0 rgba(0, 0, 0, .2), 0 6px 20px 0 rgba(0, 0, 0, .15);
                content: '';
                opacity: 0;
                z-index: -1;
            }

            &:hover,
            &:focus {
                transform: scale3d(1.006, 1.006, 1);

                &::after {
                    opacity: 1;
                }
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-group-horizontal {
            margin-bottom: 20px;
        }

        .select2-container {
            width: 100% !important;
        }

        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: bold;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25em;
        }

        a.label:hover,
        a.label:focus {
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        .label:empty {
            display: none;
        }

        .btn .label {
            position: relative;
            top: -1px;
        }

        .label-default {
            background-color: #777;
        }

        .label-default[href]:hover,
        .label-default[href]:focus {
            background-color: #5e5e5e;
        }

        .label-primary {
            background-color: #337ab7;
        }

        .label-primary[href]:hover,
        .label-primary[href]:focus {
            background-color: #286090;
        }

        .label-success {
            background-color: #5cb85c;
        }

        .label-success[href]:hover,
        .label-success[href]:focus {
            background-color: #449d44;
        }

        .label-info {
            background-color: #5bc0de;
        }

        .label-info[href]:hover,
        .label-info[href]:focus {
            background-color: #0A113B;
        }

        .label-warning {
            background-color: #f0ad4e;
        }

        .label-warning[href]:hover,
        .label-warning[href]:focus {
            background-color: #ec971f;
        }

        .label-danger {
            background-color: #d9534f;
        }

        .label-danger[href]:hover,
        .label-danger[href]:focus {
            background-color: #c9302c;
        }
        .dropdown-menu.show{
            padding-left: 10px!important;
        }
    </style>
    @stack('css')
    @yield('page-header-scripts')
</head>

<body>
<div class="main-wrapper">

<div class="header">

    <!-- Logo -->

    <div class="header-left">
        <a href="{{ url('/') }}" class="logo">
            <img class="logo-mini" src="
        {{ asset('uploads/' . \App\Models\Setting::where('setting_key', 'company_logo')->first()->setting_value) }}" style="height:60px; width:120px;  padding:5px;" />
            <!-- logo for regular state and mobile devices -->

            <!-- <img class="logo-lg"
            src="
        {{ asset('uploads/' . \App\Models\Setting::where('setting_key', 'company_logo')->first()->setting_value) }}"
            style="height:50px; width:auto; padding:5px;" /> -->

            <!-- <img src="assets/img/logo.png" width="40" height="40" alt="Logo"> -->
        </a>
    </div>

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

    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa-solid fa-bars"></i></a>


    <!-- Header Menu -->
    <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ asset('assets/smart/img/profiles/avatar-21.jpg')}}" alt="User Image">
                    <span class="status online"></span></span>
                <span>{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ url('user/' . Sentinel::getUser()->id . '/profile') }}">My Profile</a>
                <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
            </div>
        </li>

    </ul>
    <!-- Header Navbar: style can be found in header.less -->

</div>
<!-- Left side column. contains the logo and sidebar -->

@include('left_menu.admin')
<!-- end Left side column. contains the logo and sidebar -->
<div class="page-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="min-height: 30px; display: flex; justify-content: space-between; align-items: center;padding:30px;">
        <h1>@yield('title')</h1>
        <ol class="breadcrumb" style="margin-bottom: 0;">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>/
            <li class="active">@yield('title')</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @if (Session::has('flash_notification'))
        @foreach (Session::get('flash_notification') as $key)
        <script>
            $(document).ready(function() {
                toastr. {
                    {
                        $key - > level
                    }
                }('{{ $key->message }}', 'Response Status')
            })
        </script>
        @endforeach
        @endif
        @if (isset($msg))
        <div class="alert alert-success">
            <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $msg }}
        </div>
        @endif
        @if (isset($error))
        <div class="alert alert-error">
            <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
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

@include('partials.footer')
<!-- /.content-wrapper -->

</div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="{{ asset('assets/smart/js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{ asset('assets/smart/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/smart/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('assets/smart/js/app.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/bootstrap-touchspin/bootstrap.touchspin.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/fancybox/jquery.fancybox.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery.numeric.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jstree/jstree.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vue.js') }}"></script>
    <script src="{{ asset('assets/dist/js/custom.js') }}"></script>
    <!-- Popperjs -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <!-- Tempus Dominus JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/js/tempus-dominus.min.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>    

        $(document).ready(function() {
            $('.delete').on('click', function(e) {
                e.preventDefault();
                var href = $(this).attr('href');

                swal({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    buttons: {
                        cancel: {
                            text: 'Cancel',
                            value: null,
                            visible: true,
                            className: 'btn btn-danger',
                            closeModal: true,
                        },
                        confirm: {
                            text: 'Ok',
                            value: true,
                            visible: true,
                            <!-- <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}"> -->
                            className: 'btn btn-primary',
                            closeModal: true
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location = href;
                    }
                });
            });
        });
    </script>

    @yield('footer-scripts')
    @stack('js')
    <!-- ChartJS 1.0.1 -->

</body>

</html>