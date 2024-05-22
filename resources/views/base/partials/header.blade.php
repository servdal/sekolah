<header class="main-header">
  <a href="{{ url('/') }}" class="logo">
    <span class="logo-mini"><img src="../{!! config('global.logoapss') !!}" height="75%" width="75%"></span>
    <span class="logo-lg"><img src="../{!! config('global.logoapss') !!}" height="75%" width="75%" ></span>
  </a>
	<nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if (Session('sekolah_logo'))
            <img src="{{ url('').'/'.session('sekolah_logo') }}" class="user-image" alt="User Image">
            @else
            <img src="{!! config('global.logoapss') !!}" class="user-image" alt="User Image">
            @endif
              <span class="hidden-xs"> {!! Session('username') !!}</span>
            </a>
            <ul class="dropdown-menu">
              @if(Session('id'))
              <li class="user-header">
                <img src="{{ url('').'/'.session('sekolah_logo') }}" class="img-circle" alt="User Image">
                <p>
                  {{ Session('nama') }}
                  <small>{{ Session('jabatan') }} {{ Session('fakpanjang') }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-danger btn-flat">Sign out</a>
                </div>
			          <div class="pull-left">
                  <a href="{{ url('profile') }}" class="btn btn-success btn-flat">Profile</a>
                </div>
              </li>
        
			  @else
			       <li class="user-header">
                <img src="{!! config('global.logoapss') !!}" class="img-circle" alt="User Image">
                <p>
                  Welcome
                  <small>Please Login</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a href="login" class="btn btn-default btn-flat">Login</a>
                </div>
              </li>
			  @endif
            </ul>
          </li>
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
</header>