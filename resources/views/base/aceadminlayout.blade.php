<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta content="
            @if (isset($domainapps01))
                {{ $domainapps01 }}
            @elseif (Session('domainapps01') !== null)
                {{ Session('domainapps01') }}
            @else
            {{ config('global.sekolah') }}
            @endif" name="description" />
        <meta content="
        @if (isset($subdomainapps01))
            {{ $subdomainapps01 }}
        @elseif (Session('subdomainapps01') !== null)
            {{ Session('subdomainapps01') }}
        @else
            {{ config('global.kota') }}
        @endif" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
            @if (isset($namaapps01))
                {{ $namaapps01 }}
            @elseif (Session('namaapps01') !== null)
                {{ Session('namaapps01') }}
            @else
                {{ config('global.Title') }}
            @endif
        </title>
        <link rel="icon" href="
            @if (isset($logo01))
            {{ asset($logo01) }}
            @elseif (Session('logo01') !== null)
            {{ Session('logo01') }}
            @else
            {{ asset('duidev-softwarehouse.png') }}
            @endif">
        <link rel="apple-touch-icon" href="
            @if (isset($logofrontapps01))
            {{ asset($logofrontapps01) }}
            @elseif (Session('logo01') !== null)
            {{ Session('logo01') }}
            @else
            {{ asset('duidev-softwarehouse.png') }}
            @endif">
        @include('base.partials.acecss')
    </head>
    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default navbar-collapse h-navbar ace-save-stat">
	        <script type="text/javascript">
                try{ace.settings.check('navbar' , 'fixed')}catch(e){}
            </script>
			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
                        <img src="
                            @if (isset($logofrontapps01))
                            {{ asset($logofrontapps01) }}
                            @elseif (Session('logo01') !== null)
                            {{ Session('logo01') }}
                            @else
                            {{ asset('duidev-softwarehouse.png') }}
                            @endif" class="nav-user-photo" height="25" width="25" style="opacity: .8">
							@if (isset($namaapps01))
                                {{ $namaapps01 }}
                            @elseif (Session('namaapps01') !== null)
                                {{ Session('namaapps01') }}
                            @else
                                {{ config('global.swandhananama') }}
                            @endif
						</small>
					</a>
					<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
						<span class="sr-only">Toggle user menu</span>
                            @if (isset($foto))
                                <img src="{!!$foto!!}" class="img-circle elevation-2" alt="User Image" height="25" width="25">
                            @elseif (Session('avatar') != '' AND Session('avatar') !== null)
                                <img src="{!! Session('avatar') !!}" class="img-circle elevation-2" alt="User Image" height="25" width="25">
                            @else 
                                <img src="{{ asset('mascot.png') }}" class="img-circle elevation-2" alt="User Image" height="25" width="25">
                            @endif
					</button>
					<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
						<span class="sr-only">Toggle sidebar</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue dropdown-modal user-min">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                @if (isset($foto))
                                    <img src="{!!$foto!!}" class="img-circle elevation-2" alt="User Image" height="25" width="25">
                                @elseif (Session('avatar') != '' AND Session('avatar') !== null)
                                    <img src="{!! Session('avatar') !!}" class="img-circle elevation-2" alt="User Image" height="25" width="25">
                                @else 
                                    <img src="{{ asset('mascot.png') }}" class="img-circle elevation-2" alt="User Image" height="25" width="25">
                                @endif
								<span class="user-info">
									<small>Welcome,</small>
                                    @if (Session('previlage') !== null)
                                        {{ Session('nama') }}
                                    @else
                                        Visitor
                                    @endif
								</span>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>
							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                @if (Session('previlage') !== null)
                                    <li><a href="{{ url('profiluser') }}"><i class="ace-icon fa fa-user"></i>Profile {{ Session('previlage') }}</a></li>
                                    <li class="divider"></li>
                                    @if (Session('sekolah_id_sekolah') !== null)
                                        <li><a href="{{ route('signout') }}"><i class="ace-icon fa fa-power-off"></i>Logout</a></li>
                                    @else
                                        <li><a href="{{ route('logoutlt3') }}"><i class="ace-icon fa fa-power-off"></i>Logout</a></li>
                                    @endif
                                @else
                                    <li><a href="{{ url('logintoapps') }}"><i class="ace-icon fa fa-user"></i>Login</a></li>
                                @endif
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>
		<div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
			<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
			    <script type="text/javascript">
                    try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
                </script>
                <div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>
						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>
						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>
					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>
						<span class="btn btn-info"></span>
						<span class="btn btn-warning"></span>
						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->
				<ul class="nav nav-list">
                    @if (isset($menu))
                        {!! $menu !!}
                    @endif
                </ul>
                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>
            </div>
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        @if (isset($sidebar))
                            {!! $sidebar !!}
                        @elseif (isset($lamanportal))
                            {{ $lamanportal }}
                        @else
                            {{ config('global.Title') }}
                        @endif
                    </div>
                    @yield('content')
                </div>
            </div><!-- /.main-content -->
			<div class="footer">
                <div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">
                            @if (isset($namaapps01))
                            {{ $namaapps01 }}
                            @elseif (Session('namaapps01') !== null)
                            {{ Session('namaapps01') }}
                            @else
                            {{ config('global.Title') }}
                            @endif
                            -
                            @if (isset($subsubdomainapps01))
                            {{ $subsubdomainapps01 }}
                            @elseif (Session('subsubdomainapps01') !== null)
                            {{ Session('subsubdomainapps01') }}
                            @else
                            {{ config('global.swandhanakota') }}
                            @endif

                            </span>
							&copy; 2023
						</span>
					</div>
				</div>
			</div>
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div>
        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='/aceassets/js/jquery-2.1.4.min.js'>"+"<"+"/script>");
        </script>
	    @include('base.partials.acejs')
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='/aceassets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        @yield('footerjs')
    </body>
</html>