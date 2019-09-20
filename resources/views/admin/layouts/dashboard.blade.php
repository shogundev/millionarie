<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('admin/img/favicon.png')}}">
    <title>
        Millionarie
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{!! asset('/admin/css/nucleo-icons.css') !!}" rel="stylesheet" />
    <link href="{!! asset('/admin/css/bootstrap.min.css') !!}" rel="stylesheet" />
    <link href="{!! asset('/admin/css/black-dashboard.css') !!}" rel="stylesheet" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">


</head>

<body class="dashbaord">
<div class="wrapper">
    <div class="sidebar">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="javascript:void(0)" class="simple-text logo-mini">

                </a>
                <a href="{{url('/')}}" class="simple-text logo-normal">
                    Millionarie
                </a>
            </div>

            <ul class="nav">
                <li class="@if(request()->is('admin/dashboard')) {!! 'active' !!} @endif)">
                    <a href="{!! url('/admin/dashboard') !!}">
                        <i class="tim-icons icon-atom"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="@if(request()->is('admin/dashboard/questions')) {!! 'active' !!} @endif">
                    <a href="{!! route('questions.index') !!}" >
                        <i class="tim-icons icon-chat-33"></i>
                        <p>Questions</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle d-inline">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="{{url('admin/dashboard')}}">Dashboard</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto ">
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                {!! auth()->user()->first_name !!}
                                <div class="photo" style="margin-left: 15px;">
                                    <img  src="{{asset('admin/img/anime3.png')}}" alt="Profile Photo" class="rounded-circle img-30">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-navbar">
                                <li class="nav-link">
                                    <a class="dropdown-item nav-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                        <span class="nav-link-inner--text">Logout</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>

                            </ul>
                        </li>
                        <li class="separator d-lg-none"></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Navbar -->
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>
</body>
<script src="{{asset('admin/js/jquery.min.js')}}"></script>
<script src="{{asset('admin/js/popper.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
@yield('scripts')
</html>