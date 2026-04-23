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
		<meta content="@if (isset($domainapps01)){{ $domainapps01 }}@else{{ config('global.yayasan') }}@endif" name="description" />
        <meta content="@if (isset($subdomainapps01)){{ $subdomainapps01 }}@else{{ config('global.sekolah') }}@endif" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="icon" href="@if (isset($logo01)){{ $logo01 }}@else{{ asset('logo.png') }}@endif">
        <link rel="apple-touch-icon" href="@if (isset($logo01)){{ $logo01 }}@else{{ asset('logo.png') }}@endif">
        <!-- App css -->
        @include('adminlte3.css')
    </head>
    <body class="hold-transition sidebar-collapse layout-top-nav">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-light navbar-blue">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
                    </li>
                    @include('adminlte3.topmenu')
                </ul>
                <ul class="navbar-nav ml-auto">
                    @php
                        if (Session('previlage') !== null){
                            $unreadCount = auth()->user()->notifications()->count();
                        } else {
                            $unreadCount = 0;
                        }
                    @endphp
                    @if($unreadCount > 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fa fa-bullhorn"></i><span class="badge badge-danger navbar-badge">{{$unreadCount}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <span class="dropdown-item dropdown-header">{{$unreadCount}} Notifications</span>
                                <div class="dropdown-divider"></div>
                                @php
                                    $notifications = auth()->user()->notifications;
                                    foreach($notifications as $notification){
                                        $data       = json_decode($notification->data);
                                        $message    = $data->{'message'};
                                        echo '<a href="#" class="dropdown-item"><i class="fa fa-comments-o mr-2"></i> '.$message.'</a><div class="dropdown-divider"></div>';
                                    }
                                @endphp
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer" id="btnmarkingnotifikasi">Tandai Semua Sudah di Baca</a>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item dropdown dropdown-notifications">
                        <a class="nav-link" data-toggle="dropdown" href="#"><i class="fa fa-bell" data-count="0"></i>
                            <span class="badge badge-warning navbar-badge notif-count">{{$unreadCount}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header texttotalnotif"><span class="notif-count">{{$unreadCount}}</span> Notifications</span>
                            <div class="dropdown-divider"></div>
                            <div class="isi-notifications"></div>
                        </div>
                    </li>
                    @if (Session('previlage') !== null)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('mailbox') }}" role="button"><i class="fa fa-file-archive-o"></i></a>
                        </li>
                        <li class="nav-item dropdown user-menu">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <img src="{!! Session('avatar') !!}" class="user-image img-circle elevation-2" alt="User Image">
                                <span class="d-none d-md-inline">{!! Session('nama') !!}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <li class="user-header bg-primary">
                                    <img src="{!! Session('avatar') !!}" class="img-circle elevation-2" alt="User Image">
                                    <p>{!! Session('nama') !!}<small>{!! Session('previlage') !!}</small></p>
                                </li>
                                
                                <li class="user-footer">
                                    <a href="{{ url('profiluser') }}" class="btn btn-default btn-flat">Profile</a>
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">Sign out</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fa fa-arrows-alt"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown user-menu">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ config('global.logo') }}" class="user-image img-circle elevation-2" alt="User Image">
                                <span class="d-none d-md-inline">Welcome</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <li class="user-header bg-primary">
                                    <img src="{{ config('global.logo') }}" class="img-circle elevation-2" alt="User Image">
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
                                            @endif
                                        </small>
                                    </p>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="{{url('/')}}" class="brand-link">
                    <img src="@if (isset($logo01)){{ $logo01 }}@else{{ asset('logo.png') }}@endif" alt="Duidev Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">
                    @if (isset($subdomainapps01))
                        {{ $subdomainapps01 }}
                    @else
                        {{ config('global.sekolah') }}
                    @endif
                    </span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info">
                            <a href="#" class="d-block" data-widget="pushmenu" href="#" role="button">Hide</a>
                        </div>
                    </div>
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
	    @include('adminlte3.js')
        @stack('script')
        <script type="text/javascript">
            $("#btnmarkingnotifikasi").click(function(){
                var form_data = new FormData();
                    form_data.append('val02', 'notifikasi');
                    form_data.append('val01', 'all');
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url         : '{{route("exDestroyer")}}',
                    data        : form_data,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success     : function (data) {
                        var status  = data.status;
                        var message = data.message;
                        $.toast({
                            heading: status,
                            text: message,
                            position: 'top-right',
                            loaderBg: '#bf441d',
                            icon: 'info',
                            hideAfter: 3000,
                            stack: 1
                        });
                        window.setTimeout('location.reload()', 3000);
                        return false;
                    },
                    error: function (xhr, status, error) {
                        swal({
                            title: 'Stop',
                            text: xhr.responseText,
                            type: 'warning',
                        })
                    }
                });
            });
        </script>
    </body>
</html>