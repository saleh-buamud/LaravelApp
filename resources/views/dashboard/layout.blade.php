<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Google Font: Tajawal (Arabic font) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;600&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Amiri', serif;

            /* Apply the Arabic font */
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar .nav-link {
            color: white;
            transition: color 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: #00bcd4;
        }

        .main-sidebar {
            background-color: #1a1a1a;
            color: white;
        }

        .sidebar .nav-item .nav-link {
            color: white;
        }

        .sidebar .nav-item .nav-link:hover {
            background-color: #00bcd4;
        }

        .sidebar .user-panel img {
            width: 40px;
            height: 40px;
        }

        .sidebar .user-panel .info a {
            color: white;
            font-weight: bold;
        }

        .sidebar .user-panel .info a:hover {
            color: #00bcd4;
        }

        .sidebar .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: bold;
        }

        .sidebar .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .content-wrapper {
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .content-header h1 {
            font-size: 24px;
            font-weight: bold;
        }

        .content-header .breadcrumb {
            background: none;
            padding: 0;
        }

        .content-header .breadcrumb .breadcrumb-item {
            color: #007bff;
        }

        .content-header .breadcrumb .breadcrumb-item.active {
            color: #6c757d;
        }

        .btn-lg.w-100 {
            margin-top: 10px;
        }

        .alert-dismissible {
            position: relative;
            margin-bottom: 15px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard') }}" class="nav-link">الرئيسية</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="mt-4 text-center">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8; width: 50px; height: 50px">
                <br>
                <span class="brand-text font-weight-light">متجر قطع غيار السيارات</span>
            </div>

            <div class="sidebar mt-3">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <div class="m-3 text-center">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-sm px-5 py-2">تسجيل الخروج</button>
                    </form>
                </div>

                <div class="mt-3">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg w-100  text-white">الفئات</a>
                    <a href="{{ route('dashboard.in') }}" class="btn btn-primary btn-lg w-100 text-white">سب
                        كاتجوري داخلية</a>
                    <a href="{{ route('dashboard.ex') }}" class="btn btn-primary btn-lg w-100  text-white">سب
                        كاتجوري الخارجية</a>
                    <a href="{{ route('dashboard.el') }}" class="btn btn-primary btn-lg w-100  text-white">سب
                        الكاتجوري كهربائية</a>
                    <a href="{{ route('dashboard.allProducts') }}" class="btn btn-primary btn-lg w-100  text-white">All
                        Products</a>
                    <a href="{{ route('dashboard.makes.index') }}"
                        class="btn btn-primary btn-lg w-100  text-white">الماركات</a>
                    <a href="{{ route('dashboard.modes.index') }}"
                        class="btn btn-primary btn-lg w-100  text-white">موديلات</a>
                </div>

            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @section('breadcrumb')
                                    <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                                @show
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                    @yield('create')
                    @yield('edit')
                </div>
            </div>
        </div>
        <!-- Main Footer -->
        @include('dashboard.categories.includes.footer')
    </div>

    <!-- REQUIRED SCRIPTS -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
