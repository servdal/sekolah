<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>{!! config('global.mrintitle') !!}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta content="{!! config('global.mrinkemen') !!}" name="description" />
        <meta content="{!! config('global.mrinfak') !!}" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{!! config('global.mrinlogo') !!}">
        <!-- App css -->
        @include('base.partials.css')
    </head>
	<body class="hold-transition skin-blue layout-top-nav" >
    <div class="wrapper" >      
		<header class="main-header" >
			<nav class="navbar navbar-static-top">
			  <div class="container">
				<div class="navbar-header">
				  <a href="{{ url('webinar') }}" class="navbar-brand">{!! config('global.mrintitle') !!}</a>
				</div>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						@if (Session('nama') != '')
							<li class="dropdown user user-menu">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="{{ Session('foto') }}" class="user-image" alt="user-image">
								<span class="hidden-xs">{{ Session('nama') }}</span>
							  </a>
							  <ul class="dropdown-menu">
								<li class="user-header">
								  <img src="{{ Session('foto') }}" class="img-circle" alt="User Image">
								  <p>
									{{ Session('nama') }}
									<small>{{ Session('previlage') }}</small>
								  </p>
								</li>
								<li class="user-footer">
								  <div class="pull-right">
									<a href="{{ url('logoutwebinar') }}" class="btn btn-default btn-flat">Sign out</a>
								  </div>
								</li>
							  </ul>
							</li>
						@else 
							<li class="dropdown user user-menu">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="../{!! config('global.mrinlogo') !!}" class="user-image" alt="user-image">
								<span class="hidden-xs">{!! config('global.mrinfak') !!}</span>
							  </a>
							  <ul class="dropdown-menu">
								<li class="user-header">
								  <img src="../{!! config('global.mrinlogo') !!}" class="img-circle" alt="User Image">
								  <p>
									{!! config('global.mrinfak') !!}
									<small>{!! config('global.mrinhomename') !!}</small>
								  </p>
								</li>
								<li class="user-footer">
								  <div class="pull-right">
									<a href="{{ url('loginwebinar') }}" class="btn btn-default btn-flat">Sign in</a>
								  </div>
								</li>
							  </ul>
							</li>
						@endif
					</ul>
				</div>
			  </div>
			</nav>
		</header>
		<div class="content-wrapper">
			@yield('content')
		</div>
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
			  <b>{!! config('global.mrinnama') !!}</b>
			</div>
			<strong>Copyright &copy; 2020 <a href="{!! config('global.mrindomain') !!}">{!! config('global.mrinhomename') !!}</a></strong> All rights reserved.
		</footer>
    </div>
	@include('base.partials.js')
    @stack('script')
  </body>
</html>