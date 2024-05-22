<li><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="nav-icon fa fa-angle-double-left text-danger"></i> HIDE</a></li>
@if(Session('fakultas') == 'BS')
    <li><a class="nav-link" href="{{ url('/') }}"><i class="nav-icon fa fa-power-on text-primary"></i> <p>Home</p></a></li>
@else
    @if(Session('previlage') == 'Pelamar')
    @elseif(Session('previlage') == 'Operator')
        <li class="nav-item">
            <a class="nav-link {{ isset($sidebar) && $sidebar == 'usersadmin' ? 'active' : '' }}" href="{{ url('usersadmin') }}">
            <i class="nav-icon fa fa-arrow-circle-right {{ isset($sidebar) && $sidebar == 'usersadmin' ? 'text-primary' : '' }}"></i> <p>User Admin</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isset($sidebar) && $sidebar == 'ahh' ? 'active' : '' }}" href="{{ url('ahh') }}">
            <i class="nav-icon fa fa-arrow-circle-right {{ isset($sidebar) && $sidebar == 'ahh' ? 'text-primary' : '' }}"></i> <p>Angka Harapan Hidup</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isset($sidebar) && $sidebar == 'hls' ? 'active' : '' }}" href="{{ url('hls') }}">
            <i class="nav-icon fa fa-arrow-circle-right {{ isset($sidebar) && $sidebar == 'hls' ? 'text-primary' : '' }}"></i> <p>Angka Harapan Lama Sekolah</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isset($sidebar) && $sidebar == 'rls' ? 'active' : '' }}" href="{{ url('rls') }}">
            <i class="nav-icon fa fa-arrow-circle-right {{ isset($sidebar) && $sidebar == 'rls' ? 'text-primary' : '' }}"></i> <p> Rata-rata Lama Sekolah</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isset($sidebar) && $sidebar == 'ppp' ? 'active' : '' }}" href="{{ url('ppp') }}">
            <i class="nav-icon fa fa-arrow-circle-right {{ isset($sidebar) && $sidebar == 'ppp' ? 'text-primary' : '' }}"></i> <p> Analisis Indeks Pendapatan dan Pengeluaran</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isset($sidebar) && $sidebar == 'ipm' ? 'active' : '' }}" href="{{ url('ipm') }}">
            <i class="nav-icon fa fa-arrow-circle-right {{ isset($sidebar) && $sidebar == 'ipm' ? 'text-primary' : '' }}"></i> <p> IPM</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ isset($sidebar) && $sidebar == 'ipg' ? 'active' : '' }}" href="{{ url('ipg') }}">
            <i class="nav-icon fa fa-arrow-circle-right {{ isset($sidebar) && $sidebar == 'ipg' ? 'text-primary' : '' }}"></i> <p> IPG</p>
            </a>
        </li>
    @else
        <li><a class="nav-link" href="{{ url('/') }}"><i class="nav-icon fa fa-power-on text-primary"></i> <p>Home</p></a></li>
    @endif
@endif