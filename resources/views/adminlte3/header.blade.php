<header class="main-header">
	<a href="{{ url('/') }}" class="logo">
    <span class="logo-mini">
      @if(Session('namaaplikasi') !== null)
          {!! Session('namaaplikasi') !!}
      @else 
          {!! config('global.swandhananama') !!}
      @endif
    </span>
    <span class="logo-lg">
      @if(Session('namaaplikasi') !== null)
          {!! Session('namaaplikasi') !!}
      @else 
          {!! config('global.swandhananama') !!}
      @endif
    </span>
  </a>
	<nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        @php
          if(isset($totalnotif)){
            echo '
            <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">'.$totalnotif.'</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have '.$totalnotif.' notifications</li>
                <li>
                  <ul class="menu">';
                  if(isset($countsimpro) AND $countsimpro != 0){
                    echo '
                    <li>
                      <a href="simpukjaverifikasi">
                        <i class="fa fa-registered text-red"></i> '.$countsimpro.' SIMPRO-KJA
                      </a>
                    </li>';
                  }
                  if(isset($countmailbox) AND $countmailbox != 0){
                    echo '
                    <li>
                      <a href="mailbox">
                        <i class="fa fa-television text-green"></i> '.$countmailbox.' Mailbox
                      </a>
                    </li>';
                  }
                  if(isset($countvercek) AND $countvercek != 0){
                    echo '
                    <li>
                      <a href="ecekverfikasi">
                        <i class="fa fa-credit-card text-yellow"></i> '.$countvercek.' Permohonan Verifikasi Cek
                      </a>
                    </li>';
                  }
                  if(isset($countsidokar) AND $countsidokar != 0){
                    echo '
                    <li>
                      <a href="verifikatorkgb">
                        <i class="fa fa-check-square-o text-navy"></i> '.$countsidokar.' Permohonan Verifikasi KGB
                      </a>
                    </li>';
                  }
                  if(isset($countinbox) AND $countinbox != 0){
                    echo '
                    <li>
                      <a href="disposisi">
                        <i class="fa fa-file-text-o text-blue"></i> '.$countinbox.' Permohonan Disposisi
                      </a>
                    </li>';
                  }
                  if(isset($counttandatangan) AND $counttandatangan != 0){
                    echo '
                    <li>
                      <a href="tandatangan">
                        <i class="fa fa-pencil-square-o text-orange"></i> '.$counttandatangan.' Permohonan Paraf/TTD
                      </a>
                    </li>';
                  }
                  if(isset($allujian) && !empty($allujian)){
									 foreach($allujian as $pengumuman){
                    echo '
                      <li>
                        <a href="'.$pengumuman['url'].'">
                          <i class="fa fa-users text-aqua"></i> '.$pengumuman['jumlah'].' Antrian '.$pengumuman['jenis'].'
                        </a>
                      </li>';
                   }
                  } else {
										if(isset($countujians3) AND $countujians3 != 0){
                      echo '
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> '.$countujians3.' Mahasiswa S3 Sedang Ujian
                        </a>
                      </li>';
                    }
                    if(isset($countujians2) AND $countujians2 != 0){
                      echo '
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> '.$countujians2.' Mahasiswa S2 Sedang Ujian
                        </a>
                      </li>';
                    }
                    if(isset($countujians1) AND $countujians1 != 0){
                      echo '
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> '.$countujians1.' Mahasiswa S1 Sedang Ujian
                        </a>
                      </li>';
                    }
                    if(isset($countujiandiploma) AND $countujiandiploma != 0){
                      echo '
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> '.$countujiandiploma.' Mahasiswa Diploma Sedang Ujian
                        </a>
                      </li>';
                    }
                  }
                  
            echo '
                  </ul>
                </li>
              </ul>
            </li>';
          }
        @endphp
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{!! Session('photo') !!}" class="user-image" alt="User Image"><span class="hidden-xs"> {!! Session('nama') !!}</span></a>
          <ul class="dropdown-menu">
          @if(Session('id'))
            <li class="user-header">
              <img src="{!! Session('photo') !!}" class="img-circle" alt="User Image">
              <p>{{ Session('nama') }}<small>{{ Session('jabatan') }} {{ Session('fakpanjang') }}</small></p>
            </li>
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
              <img src="{!! Session('photo') !!}" class="img-circle" alt="User Image">
              <p>Welcome<small>Please Login</small></p>
            </li>
            <li class="user-footer">
              <div class="pull-right">
                <a href="{{ route('login') }}" class="btn btn-default btn-flat">Login</a>
              </div>
            </li>
          @endif
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
