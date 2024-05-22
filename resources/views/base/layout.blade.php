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
                {{ config('global.Title') }}
            @endif
        </title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta content="
            @if (isset($domainapps01))
                {{ $domainapps01 }}
            @elseif (Session('domainapps01') !== null)
                {{ Session('domainapps01') }}
            @else{{ 
                config('global.sekolah') }}
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
        <!-- App favicon -->
		<link rel="icon" href="
            @if (isset($logo01))
            {{ asset($logo01) }}
            @elseif (Session('logo01') !== null)
            {{ Session('logo01') }}
            @else
            {{ asset('duidev-softwarehouse.png') }}
            @endif">
        <link rel="apple-touch-icon" href="
            @if (isset($logo01))
            {{ asset($logo01) }}
            @elseif (Session('logo01') !== null)
            {{ Session('logo01') }}
            @else
            {{ asset('duidev-softwarehouse.png') }}
            @endif">
        @include('base.partials.css')
    </head>
    <body class="skin-purple sidebar-mini">
        @php
			$servername = $_SERVER['SERVER_NAME'];
			if ($servername == 'https://siapdok.duidev.com' OR $servername == 'http://siapdok.duidev.com' OR $servername == 'siapdok.duidev.com'){
		@endphp
			@include('base.partials.sco-header')
			@include('base.partials.sco-sidebar')
        @php
			} else {
		@endphp
			@include('base.partials.header')
			@include('base.partials.sidebar')
		@php
			}
		@endphp
        @yield('content')  
        <footer class="main-footer">
			<div class="pull-right hidden-xs">
			  <b>
				@if (isset($namaapps01))
				{{ $namaapps01 }}
				@elseif (Session('namaapps01') !== null)
				{{ Session('namaapps01') }}
				@else
				{{ config('global.Title') }}
				@endif
				</b>
			</div>
			<strong>Copyright &copy; 2022 <a href="
                @if (isset($lamanapps01))
                {{ $lamanapps01 }}
                @elseif (Session('lamanapps01') !== null)
                {{ Session('lamanapps01') }}
                @else
                {{ config('global.Title2') }}
                @endif">
                @if (isset($lamanapps01))
                {{ $lamanapps01 }}
                @elseif (Session('lamanapps01') !== null)
                {{ Session('lamanapps01') }}
                @else
                {{ config('global.Title2') }}
                @endif
            </a>.</strong> All rights reserved.
		</footer>
		<aside class="control-sidebar control-sidebar-dark">
			<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
				<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane" id="control-sidebar-home-tab">
					<h3 class="control-sidebar-heading">Credit</h3>
					<ul class="control-sidebar-menu">
						<li><a href='https://laravel.com/'><div class="pull-left"><img src="https://laravel.com/img/logotype.min.svg" alt="User Image" height="50" width="50"></div><div class="menu-info"><h4 class="control-sidebar-subheading">Laravel 9x</h4><p>The PHP Framework For Web Artisans</p></div></a></li>
						<li><a href='https://www.php.net/'><div class="pull-left"><img src="https://www.php.net/images/logos/php-logo.svg" alt="User Image" height="50" width="50"></div><div class="menu-info"><h4 class="control-sidebar-subheading">PHP 8x</h4><p>Plain Hypertext Protocol</p></div></a></li>
						<li><a href='https://getbootstrap.com/'><div class="pull-left"><img src="https://getbootstrap.com/docs/5.2/assets/brand/bootstrap-logo-shadow.png" alt="User Image" height="50" width="50"></div><div class="menu-info"><h4 class="control-sidebar-subheading">Bootstrap</h4><p>Build fast, responsive sites with Bootstrap</p></div></a></li>
						<li><a href='https://select2.org/'><div class="pull-left"><img src="https://select2.org/user/pages/images/logo.png" alt="User Image" height="50" width="50"></div><div class="menu-info"><h4 class="control-sidebar-subheading">Select 2</h4><p>The jQuery replacement for select boxes</p></div></a></li>
						<li><a href='https://sweetalert2.github.io/'><div class="pull-left"><img src="https://sweetalert2.github.io/images/SweetAlert2.png" alt="User Image" height="50" width="50"></div><div class="menu-info"><h4 class="control-sidebar-subheading">Sweet Alert</h4><p>A beautiful, responsive, customizable, accessible (WAI-ARIA) replacement for JavaScript's popup boxes</p></div></a></li>
						<li><a href='https://www.jqwidgets.com'><div class="pull-left"><img src="https://www.jqwidgets.com/jquery-widgets-demo/resources/design/i/logo-jqwidgets.svg" alt="User Image" height="50" width="50"></div><div class="menu-info"><h4 class="control-sidebar-subheading">JQWidget</h4><p>It is built entirely on open standards and technologies like HTML5, CSS and JavaScript</p></div></a></li>
						<li><a href='http://almsaeedstudio.com'><div class="pull-left"><img src="{{ asset('dist/img/avatar5.png') }}" alt="User Image" height="50" width="50"></div><div class="menu-info"><h4 class="control-sidebar-subheading">Admin LTE 2 Ver. 2.3.0</h4><p>Website Template Source</p></div></a></li>
					</ul>
				</div>
			</div>
		</aside>
		<div class="control-sidebar-bg"></div>
        <!-- jQuery  -->
        @include('base.partials.js')

        @stack('script')
    </body>
</html>