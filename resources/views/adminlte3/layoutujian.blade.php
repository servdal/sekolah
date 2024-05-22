<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>Ujian Online</title>
		<meta content="Ujian Online {!! config('global.sekolah') !!}" name="description" />
        <meta content="{!! config('global.Title2') !!}" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('logo.png') }}">
        <!-- App css -->
        @include('adminlte3.css')
    </head>
    <body class="hold-transition sidebar-collapse layout-top-nav">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-blue">
                <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="{{ asset('logo.png') }}" alt="{!! config('global.Title2') !!} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">
                    @if(Session('namaaplikasi') !== null)
                        {!! Session('namaaplikasi') !!}
                    @else 
                        {!! config('global.Title2') !!}
                    @endif
                    </span>
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
                        </li>
                        <li class="nav-item"><a href="{{ url('/') }}"  class="nav-link"><i class="fa fa-dashboard"></i></a></li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fa fa-arrows-alt"></i>
                            </a>
                        </li>
                        @if (Session('id') !== null)
                            <li class="nav-item dropdown user-menu">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <img src="{!! Session('photo') !!}" class="user-image img-circle elevation-2" alt="User Image">
                                <span class="d-none d-md-inline">{!! Session('nama') !!}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <li class="user-header bg-primary">
                                    <img src="{!! Session('photo') !!}" class="img-circle elevation-2" alt="User Image">

                                    <p>
                                    {!! Session('nama') !!}
                                    <small>{!! Session('previlage') !!} -  {!! Session('fakultas') !!}</small>
                                    </p>
                                </li>
                                
                                <li class="user-footer">
                                    @if(Session('previlage') == 'mahasiswa' OR Session('previlage') == 'mahasiswa magister' OR Session('previlage') == 'mahasiswa doktoral')
                                        <a href="{{ url('profileuser') }}" class="btn btn-default btn-flat">Profile</a>
                                    @else
                                        <a href="{{ url('profile') }}" class="btn btn-default btn-flat">Profile</a>
                                    @endif
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">Sign out</a>
                                </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item dropdown user-menu">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ asset('mascot.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                                    <span class="d-none d-md-inline">{!! config('global.Title2') !!}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <li class="user-header bg-primary">
                                    <img src="{{ asset('mascot.png') }}" class="img-circle elevation-2" alt="User Image">
                                    <p>
                                    {!! config('global.Title2') !!}
                                    <small>{!! config('global.sekolah') !!}</small>
                                    </p>
                                </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="/" class="brand-link">
                    <img src="{{ asset('logo-ub.png') }}" alt="{!! config('global.Title2') !!} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">
                    @if(Session('namaaplikasi') !== null)
                        {!! Session('namaaplikasi') !!}
                    @else 
                        {!! config('global.Title2') !!}
                    @endif
                    </span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info">
                            <a href="#" class="d-block">Semoga Sukses</a>
                        </div>
                    </div>
                </div>
            </aside>
            @yield('content')
            <footer class="main-footer">
                <div class="float-right d-none d-sm-inline">
                    <b>{!! config('global.Title2') !!}</b>
                </div>
                <strong>Copyright &copy; 2024 <a href="/">{!! config('global.yayasan') !!}</a>.</strong> All rights reserved.
            </footer>
        </div>
	    @include('adminlte3.js')
        @stack('script')
    </body>
</html>