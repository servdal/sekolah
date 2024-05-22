<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>
            @if (isset($namaapps01))
                {{ $namaapps01 }}
            @elseif (Session('namaapps01') !== null)
                {{ Session('namaapps01') }}
            @else
                {{ config('global.Title2') }}
            @endif
        </title>
		<meta content="@if (isset($domainapps01)){{ $domainapps01 }}@else{{ config('global.yayasan') }}@endif" name="description" />
        <meta content="@if (isset($subdomainapps01)){{ $subdomainapps01 }}@else{{ config('global.sekolah') }}@endif" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="icon" href="@if (isset($logo01)){{ url('').'/'.$logo01 }}@else{{ asset('duidev-softwarehouse.png') }}@endif">
        <link rel="apple-touch-icon" href="@if (isset($logo01)){{ url('').'/'.$logo01 }}@else{{ asset('duidev-softwarehouse.png') }}@endif">
        <!-- App css -->
        @include('adminlte3.cssmap')
    </head>
    <body class="hold-transition sidebar-collapse layout-top-nav">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-blue">
                <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="@if (isset($logo01)){{ $logo01 }}@else{{ asset('duidev-softwarehouse.png') }}@endif" alt="Duidev Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">
                    @if (isset($namaapps01)){{ $namaapps01 }}@else{{ config('global.Title') }}@endif
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
                        @include('adminlte3.topmenu')
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fa fa-arrows-alt"></i>
                            </a>
                        </li>
                        @if (Session('previlage') !== null)
                            <li class="nav-item dropdown user-menu">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                @if (Session('avatar') !== '')
                                    <img src="{!! Session('avatar') !!}" class="user-image img-circle elevation-2" alt="User Image">
                                @else 
                                    <img src="{{ asset('mascot.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                                @endif
                                <span class="d-none d-md-inline">{!! Session('nama') !!}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <li class="user-header bg-primary">
                                    @if (Session('avatar') !== '')
                                        <img src="{!! Session('avatar') !!}" class="img-circle elevation-2" alt="User Image">
                                    @else 
                                        <img src="{{ asset('mascot.png') }}" class="img-circle elevation-2" alt="User Image">
                                    @endif
                                    <p>
                                    {!! Session('nama') !!}
                                    <small>{!! Session('previlage') !!}</small>
                                    </p>
                                </li>
                                
                                <li class="user-footer">
                                    <a href="{{ url('profiluser') }}" class="btn btn-default btn-flat">Profile</a>
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">Sign out</a>
                                </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item dropdown user-menu">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ asset('mascot.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                                    <span class="d-none d-md-inline">Welcome</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <li class="user-header bg-primary">
                                    <img src="{{ asset('mascot.png') }}" class="img-circle elevation-2" alt="User Image">
                                    <p>
                                    @if (isset($domainapps01))
                                        {{ $domainapps01 }}
                                    @else
                                        {{ config('global.yayasan') }}
                                    @endif
                                    <small>
                                        @if (isset($subdomainapps01))
                                            {{ $subdomainapps01 }}
                                        @else
                                            {{ config('global.sekolah') }}
                                        @endif</small>
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
                    <img src="@if (isset($logo01)){{ $logo01 }}@else{{ asset('duidev-softwarehouse.png') }}@endif" alt="Duidev Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">
                    @if (isset($namaapps01)){{ $namaapps01 }}@else{{ config('global.Title') }}@endif
                    </span>
                </a>
                <div class="sidebar">
                    @if(Session('previlage') !== null)
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                @if (Session('avatar') !== '')
                                    <img src="{!! Session('avatar') !!}" class="img-circle elevation-2" alt="User Image">
                                @else 
                                    <img src="{{ asset('mascot.png') }}" class="img-circle elevation-2" alt="User Image">
                                @endif
                            </div>
                            <div class="info">
                            <a href="{{ url('profiluser') }}" class="d-block">{!! Session('nama') !!}</a>
                            </div>
                        </div>
                    @else
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                <img src="{{ asset('mascot.png') }}" class="img-circle elevation-2" alt="User Image">
                            </div>
                            <div class="info">
                                <a href="#" class="d-block">@if (isset($domainapps01)){{ $domainapps01 }}@else{{ config('global.yayasan') }}@endif</a>
                            </div>
                        </div>
                    @endif
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            @include('adminlte3.sidebar')
                        </ul>
                    </nav>
                </div>
            </aside>
            @yield('content')
            <footer class="main-footer">
                <div class="float-right d-none d-sm-inline">
                    <b>@if (isset($namaapps01)){{ $namaapps01 }}@else{{ config('global.Title2') }}@endif</b>
                </div>
                <strong>Copyright &copy; 2024 <a href="@if (isset($lamanapps01)){{ $lamanapps01 }}@else{{ config('global.homeweb') }}@endif">@if (isset($lamanapps01)){{ $lamanapps01 }}@else{{ config('global.sekolah') }}@endif</a>.</strong> All rights reserved.
            </footer>
        </div>
	    @include('adminlte3.jsmap')
        @stack('script')
        
    </body>
</html>