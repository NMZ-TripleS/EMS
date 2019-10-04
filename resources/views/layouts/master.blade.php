
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AdminLTE 3 | Starter</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
        </ul>
        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="data:image/png;base64,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" alt="HEXAKSY Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">HEXASKY</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="data:image/png;base64,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" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <router-link to="/profile" class="d-block profile-link">{{ Auth::user()->name }}</router-link>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-cog"></i>
                            <p>
                                Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link to="/users" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Users</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Inactive Page</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @can('isAdmin')
                    <li class="nav-item">
                        <router-link to="/developer" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Developer
                            </p>
                        </router-link>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-th"></i>
                            <p>
                                Simple Link
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-power-off"></i>
                            <p>
                                {{ __('Logout') }}
                            </p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <router-view></router-view>
                <vue-progress-bar></vue-progress-bar>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
@auth
    <script>
        window.user =@json(auth()->user());
    </script>
@endauth
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
