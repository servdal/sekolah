<aside class="main-sidebar">
    <section class="sidebar">
       <div class="user-panel">
        <div class="pull-left image">
		@if (Session('sekolah_logo'))
			<img src="{{ url('').'/'.session('sekolah_logo') }}" class="img-circle" alt="User Image">
        @else
			<img src="{!! config('global.logoapss') !!}" class="img-circle" alt="User Image">
		@endif
        </div>
        <div class="pull-left info">
          <p>{!! session('sekolah_kode_sekolah') !!}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> {!! session('sekolah_kota') !!}</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
		@if(Session('previlage') == 'level1')
			<li class="header">MAIN NAVIGATION</li>
			<li class="{{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}">
				<a href="{{ url('dashbord') }}">
				<i class="fa fa-dashboard text-red"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-briefcase text-yellow"></i>
					<span>Admin Sekolah</span>
					<i class="glyphicon glyphicon-chevron-left pull-right"></i>
              	</a>
              	<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'datainduk' ? 'active' : '' }}"><a href="{{ url('datainduk') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Data Induk Siswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'dataindukstaff' ? 'active' : '' }}"><a href="{{ url('dataindukstaff') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Data Induk Staff</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'setkeuangan' ? 'active' : '' }}"><a href="{{ url('setkeuangan') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Setting Keuangan</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'lapbayar' ? 'active' : '' }}"><a href="{{ url('lapbayar') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Admin Pembayaran</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }}"><a href="{{ url('datakeuhptmasuk') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Data Keuangan</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a href="{{ url('laporankeuhpt') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Laporan Keuangan</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'laptabungan' ? 'active' : '' }}"><a href="{{ url('laptabungan') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Laporan Tabungan</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'lapamil' ? 'active' : '' }}"><a href="{{ url('lapamil') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Laporan ZIS</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'lapppdb' ? 'active' : '' }}"><a href="{{ url('lapppdb') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Laporan PPDB</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'lapekskul' ? 'active' : '' }}"><a href="{{ url('lapekskul') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Laporan Ekskul</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'lapabsen' ? 'active' : '' }}"><a href="{{ url('lapabsen') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Laporan Presensi</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'prestasisiswa' ? 'active' : '' }}"><a href="{{ url('prestasisiswa') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Laporan Prestasi Siswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'sarpras' ? 'active' : '' }}"><a href="{{ url('sarpras') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Sarana dan Prasarana</a></li>
                	<li class="{{ isset($sidebar) && $sidebar == 'programpip' ? 'active' : '' }}"><a href="{{ url('programpip') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Program Indonesia Pintar</a></li>
                	<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Tindak Lanjut WBS</a></li>
                </ul>
            </li>
			<li class="treeview">
				<a href="#">
                <i class="fa fa-graduation-cap text-blue"></i>
                <span>Guru</span>
                <i class="glyphicon glyphicon-chevron-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
		      	<li class="{{ isset($sidebar) && $sidebar == 'konseling' ? 'active' : '' }}"><a href="{{ url('konseling') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Data Bimbingan dan Konseling</a></li>
			  	<li class="treeview">
					<a href="#">
						<i class="fa fa-heartbeat text-yellow"></i>
						<span>Mengaji</span>
						<i class="glyphicon glyphicon-chevron-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'jilid1' ? 'active' : '' }}"><a href="{{ url('jilid/1') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Jilid 1</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'jilid2' ? 'active' : '' }}"><a href="{{ url('jilid/2') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Jilid 2</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'jilid3' ? 'active' : '' }}"><a href="{{ url('jilid/3') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Jilid 3</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'jilid4' ? 'active' : '' }}"><a href="{{ url('jilid/4') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Jilid 4</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'jilid5' ? 'active' : '' }}"><a href="{{ url('jilid/5') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Jilid 5</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'jilid6' ? 'active' : '' }}"><a href="{{ url('jilid/6') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Jilid 6</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'jilidakhir' ? 'active' : '' }}"><a href="{{ url('jilid/akhir') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Tajwid dan Ghorib</a></li>
					</ul>
				</li>
                <li class="treeview">
				  <a href="#">
					<i class="fa fa-star text-blue"></i>
					<span>Kurikulum</span>
					<i class="glyphicon glyphicon-chevron-left pull-right"></i>
				  </a>
				  <ul class="treeview-menu">
				  	<li class="{{ isset($sidebar) && $sidebar == 'setkkm' ? 'active' : '' }}"><a href="{{ url('setkkm') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> KKM</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'kodekd' ? 'active' : '' }}"><a href="{{ url('kodekd') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> KD</a></li>
				  </ul>
				</li>
				@if(Session('sekolah_level') == 1)
				  	<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelompok Belajar</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'KB-A' ? 'active' : '' }}"><a href="{{ url('kelas/gradekba') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> KB A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'KB-B' ? 'active' : '' }}"><a href="{{ url('kelas/gradekbb') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> KB B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'KB-C' ? 'active' : '' }}"><a href="{{ url('kelas/gradekbc') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> KB C</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Tarbiyatul Athfal A</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'TA-A.1' ? 'active' : '' }}"><a href="{{ url('kelas/gradeTA-A.1') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> TA A 1</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'TA-A.2' ? 'active' : '' }}"><a href="{{ url('kelas/gradeTA-A.2') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> TA A 2</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'TA-A.3' ? 'active' : '' }}"><a href="{{ url('kelas/gradeTA-A.3') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> TA A 3</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Tarbiyatul Athfal B</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'TA-B.1' ? 'active' : '' }}"><a href="{{ url('kelas/gradeTA-B.1') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> TA B 1</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'TA-B.2' ? 'active' : '' }}"><a href="{{ url('kelas/gradeTA-B.2') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> TA B 2</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'TA-B.3' ? 'active' : '' }}"><a href="{{ url('kelas/gradeTA-B.3') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> TA B 3</a></li>
						</ul>
					</li>
				@elseif (Session('sekolah_level') == 2)
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas I</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == '1A' ? 'active' : '' }}"><a href="{{ url('kelas/grade1A') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 1 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '1B' ? 'active' : '' }}"><a href="{{ url('kelas/grade1B') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 1 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '1C' ? 'active' : '' }}"><a href="{{ url('kelas/grade1C') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 1 C</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas 2</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == '2A' ? 'active' : '' }}"><a href="{{ url('kelas/grade2A') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 2 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '2B' ? 'active' : '' }}"><a href="{{ url('kelas/grade2B') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 2 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '2C' ? 'active' : '' }}"><a href="{{ url('kelas/grade2C') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 2 C</a></li>
						</ul>
					</li> 
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas 3</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == '3A' ? 'active' : '' }}"><a href="{{ url('kelas/grade3A') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 3 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '3B' ? 'active' : '' }}"><a href="{{ url('kelas/grade3B') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 3 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '3C' ? 'active' : '' }}"><a href="{{ url('kelas/grade3C') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 3 C</a></li>
						</ul>
					</li> 
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas 4</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == '4A' ? 'active' : '' }}"><a href="{{ url('kelas/grade4A') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 4 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '4B' ? 'active' : '' }}"><a href="{{ url('kelas/grade4B') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 4 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '4C' ? 'active' : '' }}"><a href="{{ url('kelas/grade4C') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 4 C</a></li>
						</ul>
					</li> 
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas 5</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == '5A' ? 'active' : '' }}"><a href="{{ url('kelas/grade5A') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 5 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '5B' ? 'active' : '' }}"><a href="{{ url('kelas/grade5B') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 5 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '5C' ? 'active' : '' }}"><a href="{{ url('kelas/grade5C') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 5 C</a></li>
						</ul>
					</li> 
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas 6</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == '6A' ? 'active' : '' }}"><a href="{{ url('kelas/grade6A') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 6 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '6B' ? 'active' : '' }}"><a href="{{ url('kelas/grade6B') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 6 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '6C' ? 'active' : '' }}"><a href="{{ url('kelas/grade6C') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 6 C</a></li>
						</ul>
					</li> 
				@elseif (Session('sekolah_level') == 3)
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas VII</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == '7A' ? 'active' : '' }}"><a href="{{ url('kelas/grade7A') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '7B' ? 'active' : '' }}"><a href="{{ url('kelas/grade7B') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '7C' ? 'active' : '' }}"><a href="{{ url('kelas/grade7C') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 C</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '7D' ? 'active' : '' }}"><a href="{{ url('kelas/grade7D') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 D</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '7E' ? 'active' : '' }}"><a href="{{ url('kelas/grade7E') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 E</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '7F' ? 'active' : '' }}"><a href="{{ url('kelas/grade7F') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 F</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '7G' ? 'active' : '' }}"><a href="{{ url('kelas/grade7G') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 G</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '7H' ? 'active' : '' }}"><a href="{{ url('kelas/grade7H') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 H</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '7I' ? 'active' : '' }}"><a href="{{ url('kelas/grade7I') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 I</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas VIII</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == '8A' ? 'active' : '' }}"><a href="{{ url('kelas/grade8A') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '8B' ? 'active' : '' }}"><a href="{{ url('kelas/grade8B') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '8C' ? 'active' : '' }}"><a href="{{ url('kelas/grade8C') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 C</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '8D' ? 'active' : '' }}"><a href="{{ url('kelas/grade8D') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 D</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '8E' ? 'active' : '' }}"><a href="{{ url('kelas/grade8E') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 E</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '8F' ? 'active' : '' }}"><a href="{{ url('kelas/grade8F') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 F</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '8G' ? 'active' : '' }}"><a href="{{ url('kelas/grade8G') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 G</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '8H' ? 'active' : '' }}"><a href="{{ url('kelas/grade8H') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 H</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '8I' ? 'active' : '' }}"><a href="{{ url('kelas/grade8I') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 I</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas IX</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == '9A' ? 'active' : '' }}"><a href="{{ url('kelas/grade9A') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '9B' ? 'active' : '' }}"><a href="{{ url('kelas/grade9B') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '9C' ? 'active' : '' }}"><a href="{{ url('kelas/grade9C') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 C</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '9D' ? 'active' : '' }}"><a href="{{ url('kelas/grade9D') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 D</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '9E' ? 'active' : '' }}"><a href="{{ url('kelas/grade9E') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 E</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '9F' ? 'active' : '' }}"><a href="{{ url('kelas/grade9F') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 F</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '9G' ? 'active' : '' }}"><a href="{{ url('kelas/grade9G') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 G</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '9H' ? 'active' : '' }}"><a href="{{ url('kelas/grade9H') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 H</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '9I' ? 'active' : '' }}"><a href="{{ url('kelas/grade9I') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 I</a></li>
						</ul>
					</li>
				@else
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas X</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == '10A' ? 'active' : '' }}"><a href="{{ url('kelas/grade10A') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '10B' ? 'active' : '' }}"><a href="{{ url('kelas/grade10B') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '10C' ? 'active' : '' }}"><a href="{{ url('kelas/grade10C') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 C</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '10D' ? 'active' : '' }}"><a href="{{ url('kelas/grade10D') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 D</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '10E' ? 'active' : '' }}"><a href="{{ url('kelas/grade10E') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 E</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '10F' ? 'active' : '' }}"><a href="{{ url('kelas/grade10F') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 F</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '10G' ? 'active' : '' }}"><a href="{{ url('kelas/grade10G') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 G</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '10H' ? 'active' : '' }}"><a href="{{ url('kelas/grade10H') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 H</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '10I' ? 'active' : '' }}"><a href="{{ url('kelas/grade10I') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 I</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas XI</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == '11A' ? 'active' : '' }}"><a href="{{ url('kelas/grade11A') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '11B' ? 'active' : '' }}"><a href="{{ url('kelas/grade11B') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '11C' ? 'active' : '' }}"><a href="{{ url('kelas/grade11C') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 C</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '11D' ? 'active' : '' }}"><a href="{{ url('kelas/grade11D') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 D</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '11E' ? 'active' : '' }}"><a href="{{ url('kelas/grade11E') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 E</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '11F' ? 'active' : '' }}"><a href="{{ url('kelas/grade11F') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 F</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '11G' ? 'active' : '' }}"><a href="{{ url('kelas/grade11G') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 G</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '11H' ? 'active' : '' }}"><a href="{{ url('kelas/grade11H') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 H</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '11I' ? 'active' : '' }}"><a href="{{ url('kelas/grade11I') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 I</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas XII</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == '12A' ? 'active' : '' }}"><a href="{{ url('kelas/grade12A') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '12B' ? 'active' : '' }}"><a href="{{ url('kelas/grade12B') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '12C' ? 'active' : '' }}"><a href="{{ url('kelas/grade12C') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 C</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '12D' ? 'active' : '' }}"><a href="{{ url('kelas/grade12D') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 D</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '12E' ? 'active' : '' }}"><a href="{{ url('kelas/grade12E') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 E</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '12F' ? 'active' : '' }}"><a href="{{ url('kelas/grade12F') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 F</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '12G' ? 'active' : '' }}"><a href="{{ url('kelas/grade12G') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 G</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '12H' ? 'active' : '' }}"><a href="{{ url('kelas/grade12H') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 H</a></li>
							<li class="{{ isset($sidebar) && $sidebar == '12I' ? 'active' : '' }}"><a href="{{ url('kelas/grade12I') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 I</a></li>
						</ul>
					</li>
				@endif
				<li class="{{ isset($sidebar) && $sidebar == 'penilaianekskul' ? 'active' : '' }}"><a href="{{ url('penilaianekskul') }}"><i class="glyphicon glyphicon-hand-right text-blue"></i> Penilaian Ekstrakulikuler</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'lognilai' ? 'active' : '' }}"><a href="{{ url('lognilai') }}"><i class="glyphicon glyphicon-hand-right text-blue"></i> Log Perubahan Nilai</a></li>
              </ul>
            </li>				
            <li class="header">==========================</li> 			
			<li class="{{ isset($sidebar) && $sidebar == 'minimi' ? 'active' : '' }}"><a href="{{ url('minimi') }}"><i class="fa fa-user-plus text-magenta"></i> <span>Mini Library</span></a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'useranyar' ? 'active' : '' }}"><a href="{{ url('useranyar') }}"><i class="fa fa-user-plus text-blue"></i> <span>Pendaftaran Account</span></a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}"><i class="fa fa-bullhorn text-red"></i> <span>Pengumuman</span></a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'setting' ? 'active' : '' }}"><a href="{{ url('setting') }}"><i class="fa fa-cogs text-green"></i> <span>Setting</span></a></li>
			@if (Session('username') == 'root')
			<li class="{{ isset($sidebar) && $sidebar == 'sekolah' ? 'active' : '' }}"><a href="{{ url('sekolah') }}"><i class="fa fa-database text-green"></i> <span>Master Sekolah</span></a></li>
			@endif
		@elseif(Session('previlage') == 'level2')
			<li class="header">MAIN NAVIGATION</li>
            <li class="{{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}">
				<a href="{{ url('dashbord') }}">
				<i class="fa fa-dashboard text-primary"></i> <span>Dashboard</span>
				</a>
			</li>
            <li class="{{ isset($sidebar) && $sidebar == 'datainduk' ? 'active' : '' }}">
				<a href="{{ url('datainduk') }}">
                <i class="fa fa-users text-red"></i>
                <span>Data Induk Siswa</span>                
              </a>              
            </li>
			 <li class="{{ isset($sidebar) && $sidebar == 'dataindukstaff' ? 'active' : '' }}">
				<a href="{{ url('dataindukstaff') }}">
                <i class="fa fa-drupal text-yellow"></i>
                <span>Data Induk Staff</span>                
              </a>              
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'lapabsen' ? 'active' : '' }}">
				<a href="{{ url('lapabsen') }}">
                <i class="fa fa-car text-aqus"></i>
                <span>Laporan Presensi</span>
              </a>
            </li>
			<li class="treeview">
				<a href="#">
                <i class="fa fa-briefcase text-yellow"></i>
                <span>Kurikulum</span>
                <i class="glyphicon glyphicon-chevron-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="{{ isset($sidebar) && $sidebar == 'setkkm' ? 'active' : '' }}"><a href="{{ url('setkkm') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> KKM</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'kodekd' ? 'active' : '' }}"><a href="{{ url('kodekd') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> KOMP. DASAR</a></li>
              </ul>
            </li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-heartbeat text-yellow"></i>
					<span>Mengaji</span>
					<i class="glyphicon glyphicon-chevron-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'jilid1' ? 'active' : '' }}"><a href="{{ url('jilid/1') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Jilid 1</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'jilid2' ? 'active' : '' }}"><a href="{{ url('jilid/2') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Jilid 2</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'jilid3' ? 'active' : '' }}"><a href="{{ url('jilid/3') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Jilid 3</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'jilid4' ? 'active' : '' }}"><a href="{{ url('jilid/4') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Jilid 4</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'jilid5' ? 'active' : '' }}"><a href="{{ url('jilid/5') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Jilid 5</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'jilid6' ? 'active' : '' }}"><a href="{{ url('jilid/6') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Jilid 6</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'jilidakhir' ? 'active' : '' }}"><a href="{{ url('jilid/akhir') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> Tajwid dan Ghorib</a></li>
				</ul>
			</li>
            <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-font text-aqua"></i>
                <span>Penilaian Siswa</span>
                <i class="glyphicon glyphicon-chevron-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  	@if(Session('sekolah_level') == 1)
				  <li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelompok Belajar</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'gradekba' ? 'active' : '' }}"><a href="{{ url('kelas/gradekba') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> KB A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'gradekbb' ? 'active' : '' }}"><a href="{{ url('kelas/gradekbb') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> KB B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'gradekbc' ? 'active' : '' }}"><a href="{{ url('kelas/gradekbc') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> KB C</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Tarbiyatul Athfal</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'gradetaa' ? 'active' : '' }}"><a href="{{ url('kelas/gradetaa') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> TA A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'gradetab' ? 'active' : '' }}"><a href="{{ url('kelas/gradetab') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> TA B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'gradetac' ? 'active' : '' }}"><a href="{{ url('kelas/gradetac') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> TA C</a></li>
						</ul>
					</li>					
				@elseif (Session('sekolah_level') == 2)
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas I</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'grade1a' ? 'active' : '' }}"><a href="{{ url('kelas/grade1a') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 1 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade1b' ? 'active' : '' }}"><a href="{{ url('kelas/grade1b') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 1 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade1c' ? 'active' : '' }}"><a href="{{ url('kelas/grade1c') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 1 C</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas 2</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'grade2a' ? 'active' : '' }}"><a href="{{ url('kelas/grade2a') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 2 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade2b' ? 'active' : '' }}"><a href="{{ url('kelas/grade2b') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 2 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade2c' ? 'active' : '' }}"><a href="{{ url('kelas/grade2c') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 2 C</a></li>
						</ul>
					</li> 
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas 3</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'grade3a' ? 'active' : '' }}"><a href="{{ url('kelas/grade3a') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 3 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade3b' ? 'active' : '' }}"><a href="{{ url('kelas/grade3b') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 3 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade3c' ? 'active' : '' }}"><a href="{{ url('kelas/grade3c') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 3 C</a></li>
						</ul>
					</li> 
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas 4</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'grade4a' ? 'active' : '' }}"><a href="{{ url('kelas/grade4a') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 4 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade4b' ? 'active' : '' }}"><a href="{{ url('kelas/grade4b') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 4 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade4c' ? 'active' : '' }}"><a href="{{ url('kelas/grade4c') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 4 C</a></li>
						</ul>
					</li> 
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas 5</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'grade5a' ? 'active' : '' }}"><a href="{{ url('kelas/grade5a') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 5 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade5b' ? 'active' : '' }}"><a href="{{ url('kelas/grade5b') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 5 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade5c' ? 'active' : '' }}"><a href="{{ url('kelas/grade5c') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 5 C</a></li>
						</ul>
					</li> 
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas 6</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'grade6a' ? 'active' : '' }}"><a href="{{ url('kelas/grade6a') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 6 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade6b' ? 'active' : '' }}"><a href="{{ url('kelas/grade6b') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 6 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade6c' ? 'active' : '' }}"><a href="{{ url('kelas/grade6c') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 6 C</a></li>
						</ul>
					</li> 
				@elseif (Session('sekolah_level') == 3)
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas VII</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'grade7a' ? 'active' : '' }}"><a href="{{ url('kelas/grade7a') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade7b' ? 'active' : '' }}"><a href="{{ url('kelas/grade7b') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade7c' ? 'active' : '' }}"><a href="{{ url('kelas/grade7c') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 C</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade7d' ? 'active' : '' }}"><a href="{{ url('kelas/grade7d') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 D</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade7e' ? 'active' : '' }}"><a href="{{ url('kelas/grade7e') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 E</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade7f' ? 'active' : '' }}"><a href="{{ url('kelas/grade7f') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 F</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade7g' ? 'active' : '' }}"><a href="{{ url('kelas/grade7g') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 G</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade7h' ? 'active' : '' }}"><a href="{{ url('kelas/grade7h') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 H</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade7i' ? 'active' : '' }}"><a href="{{ url('kelas/grade7i') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 7 I</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas VIII</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'grade8a' ? 'active' : '' }}"><a href="{{ url('kelas/grade8a') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade8b' ? 'active' : '' }}"><a href="{{ url('kelas/grade8b') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade8c' ? 'active' : '' }}"><a href="{{ url('kelas/grade8c') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 C</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade8d' ? 'active' : '' }}"><a href="{{ url('kelas/grade8d') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 D</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade8e' ? 'active' : '' }}"><a href="{{ url('kelas/grade8e') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 E</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade8f' ? 'active' : '' }}"><a href="{{ url('kelas/grade8f') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 F</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade8g' ? 'active' : '' }}"><a href="{{ url('kelas/grade8g') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 G</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade8h' ? 'active' : '' }}"><a href="{{ url('kelas/grade8h') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 H</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade8i' ? 'active' : '' }}"><a href="{{ url('kelas/grade8i') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 8 I</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas IX</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'grade9a' ? 'active' : '' }}"><a href="{{ url('kelas/grade9a') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade9b' ? 'active' : '' }}"><a href="{{ url('kelas/grade9b') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade9c' ? 'active' : '' }}"><a href="{{ url('kelas/grade9c') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 C</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade9d' ? 'active' : '' }}"><a href="{{ url('kelas/grade9d') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 D</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade9e' ? 'active' : '' }}"><a href="{{ url('kelas/grade9e') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 E</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade9f' ? 'active' : '' }}"><a href="{{ url('kelas/grade9f') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 F</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade9g' ? 'active' : '' }}"><a href="{{ url('kelas/grade9g') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 G</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade9h' ? 'active' : '' }}"><a href="{{ url('kelas/grade9h') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 H</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade9i' ? 'active' : '' }}"><a href="{{ url('kelas/grade9i') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 9 I</a></li>
						</ul>
					</li>
				@else
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas X</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'grade10a' ? 'active' : '' }}"><a href="{{ url('kelas/grade10a') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade10b' ? 'active' : '' }}"><a href="{{ url('kelas/grade10b') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade10c' ? 'active' : '' }}"><a href="{{ url('kelas/grade10c') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 C</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade10d' ? 'active' : '' }}"><a href="{{ url('kelas/grade10d') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 D</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade10e' ? 'active' : '' }}"><a href="{{ url('kelas/grade10e') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 E</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade10f' ? 'active' : '' }}"><a href="{{ url('kelas/grade10f') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 F</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade10g' ? 'active' : '' }}"><a href="{{ url('kelas/grade10g') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 G</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade10h' ? 'active' : '' }}"><a href="{{ url('kelas/grade10h') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 H</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade10i' ? 'active' : '' }}"><a href="{{ url('kelas/grade10i') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 10 I</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas XI</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'grade11a' ? 'active' : '' }}"><a href="{{ url('kelas/grade11a') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade11b' ? 'active' : '' }}"><a href="{{ url('kelas/grade11b') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade11c' ? 'active' : '' }}"><a href="{{ url('kelas/grade11c') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 C</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade11d' ? 'active' : '' }}"><a href="{{ url('kelas/grade11d') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 D</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade11e' ? 'active' : '' }}"><a href="{{ url('kelas/grade11e') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 E</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade11f' ? 'active' : '' }}"><a href="{{ url('kelas/grade11f') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 F</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade11g' ? 'active' : '' }}"><a href="{{ url('kelas/grade11g') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 G</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade11h' ? 'active' : '' }}"><a href="{{ url('kelas/grade11h') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 H</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade11i' ? 'active' : '' }}"><a href="{{ url('kelas/grade11i') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 11 I</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-star text-blue"></i>
							<span>Kelas XII</span>
							<i class="glyphicon glyphicon-chevron-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'grade12a' ? 'active' : '' }}"><a href="{{ url('kelas/grade12a') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 A</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade12b' ? 'active' : '' }}"><a href="{{ url('kelas/grade12b') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 B</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade12c' ? 'active' : '' }}"><a href="{{ url('kelas/grade12c') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 C</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade12d' ? 'active' : '' }}"><a href="{{ url('kelas/grade12d') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 D</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade12e' ? 'active' : '' }}"><a href="{{ url('kelas/grade12e') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 E</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade12f' ? 'active' : '' }}"><a href="{{ url('kelas/grade12f') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 F</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade12g' ? 'active' : '' }}"><a href="{{ url('kelas/grade12g') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 G</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade12h' ? 'active' : '' }}"><a href="{{ url('kelas/grade12h') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 H</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'grade12i' ? 'active' : '' }}"><a href="{{ url('kelas/grade12i') }}"><i class="glyphicon glyphicon-hand-right text-yellow"></i> 12 I</a></li>
						</ul>
					</li>
				@endif
              </ul>
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'konseling' ? 'active' : '' }}">
				<a href="{{ url('konseling') }}">
                <i class="fa fa-users text-yellow"></i>
                <span>Bimbingan dan Konseling</span>
              </a>
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'penilaianekskul' ? 'active' : '' }}">
				<a href="{{ url('penilaianekskul') }}">
                <i class="fa fa-chrome text-aqua"></i>
                <span>Penilaian Ekstrakulikuler</span>
              </a>
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'prestasisiswa' ? 'active' : '' }}">
				<a href="{{ url('prestasisiswa') }}">
                <i class="fa fa-trophy text-green"></i>
                <span>Pencatatan Prestasi Siswa</span>
              </a>
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}">
				<a href="{{ url('datakeluhan') }}">
                <i class="fa fa-bullhorn text-yellow"></i>
                <span>Admin WBS</span>
              </a>
            </li>
            <li class="header">==========================</li> 			
			<li class="{{ isset($sidebar) && $sidebar == 'minimi' ? 'active' : '' }}"><a href="{{ url('minimi') }}"><i class="fa fa-user-plus text-magenta"></i> <span>Mini Library</span></a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'useranyar' ? 'active' : '' }}"><a href="{{ url('useranyar') }}"><i class="fa fa-user-plus text-blue"></i> <span>Pendaftaran Account</span></a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}"><i class="fa fa-bullhorn text-red"></i> <span>Pengumuman</span></a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'setting' ? 'active' : '' }}"><a href="{{ url('setting') }}"><i class="fa fa-cogs text-green"></i> <span>Setting</span></a></li>
		@elseif(Session('previlage') == 'level3')
			<li class="header">MAIN NAVIGATION</li>
            <li class="{{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}">
				<a href="{{ url('dashbord') }}">
				<i class="fa fa-dashboard text-primary"></i> <span>Dashboard</span>
				</a>
			</li>
            <li class="{{ isset($sidebar) && $sidebar == 'datainduk' ? 'active' : '' }}">
				<a href="{{ url('datainduk') }}">
                <i class="fa fa-users text-red"></i>
                <span>Data Induk Siswa</span>                
              </a>
            </li>
			 <li class="{{ isset($sidebar) && $sidebar == 'dataindukstaff' ? 'active' : '' }}">
				<a href="{{ url('dataindukstaff') }}">
                <i class="fa fa-drupal text-yellow"></i>
                <span>Data Induk Staff</span>                
              </a>              
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'setkeuangan' ? 'active' : '' }}">
				<a href="{{ url('setkeuangan') }}">
                <i class="fa fa-money text-green"></i>
                <span>Setting Keuangan</span>                
              </a>              
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }}">
				<a href="{{ url('datakeuhptmasuk') }}">
				<i class="fa fa-line-chart text-yellow"></i> <span>Data Keuangan</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}">
				<a href="{{ url('laporankeuhpt') }}">
				<i class="fa fa-line-chart text-yellow"></i> <span>Laporan Keuangan</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'lapbayar' ? 'active' : '' }}">
				<a href="{{ url('lapbayar') }}">
                <i class="fa fa-money text-blue"></i>
                <span>Laporan Pembayaran</span>
              </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'laptabungan' ? 'active' : '' }}">
				<a href="{{ url('laptabungan') }}">
                <i class="fa fa-gift text-yellow"></i>
                <span>Laporan Tabungan</span>                
              </a>              
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'lapamil' ? 'active' : '' }}">
				<a href="{{ url('lapamil') }}">
                <i class="fa fa-balance-scale text-green"></i>
                <span>Laporan ZIS</span>
              </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'lapppdb' ? 'active' : '' }}">
				<a href="{{ url('lapppdb') }}">
                <i class="fa fa-user text-green"></i>
                <span>Laporan PPDB</span>
              </a>              
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'lapekskul' ? 'active' : '' }}">
				<a href="{{ url('lapekskul') }}">
                <i class="fa fa-flask text-magenta"></i>
                <span>Laporan Ekskul</span>                
              </a>              
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'lapabsen' ? 'active' : '' }}">
				<a href="{{ url('lapabsen') }}">
                <i class="fa fa-car text-aqus"></i>
                <span>Laporan Presensi</span>
              </a>
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'prestasisiswa' ? 'active' : '' }}">
				<a href="{{ url('prestasisiswa') }}">
                <i class="fa fa-trophy text-green"></i>
                <span>Pencatatan Prestasi Siswa</span>
              </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'sarpras' ? 'active' : '' }}">
				<a href="{{ url('sarpras') }}">
                <i class="fa fa-building text-yellow"></i>
                <span>Sarana dan Prasarana</span>
              </a>
            </li>
            <li class="{{ isset($sidebar) && $sidebar == 'programpip' ? 'active' : '' }}">
				<a href="{{ url('programpip') }}">
                <i class="fa fa-graduation-cap text-aqua"></i>
                <span>Program Indonesia Pintar</span>
              </a>
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}">
				<a href="{{ url('datakeluhan') }}">
                <i class="fa fa-bullhorn text-yellow"></i>
                <span>Admin WBS</span>
              </a>
            </li>
            <li class="header">==========================</li> 			
			<li class="{{ isset($sidebar) && $sidebar == 'minimi' ? 'active' : '' }}"><a href="{{ url('minimi') }}"><i class="fa fa-user-plus text-magenta"></i> <span>Mini Library</span></a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'useranyar' ? 'active' : '' }}"><a href="{{ url('useranyar') }}"><i class="fa fa-user-plus text-blue"></i> <span>Pendaftaran Account</span></a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}"><i class="fa fa-bullhorn text-red"></i> <span>Pengumuman</span></a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'setting' ? 'active' : '' }}"><a href="{{ url('setting') }}"><i class="fa fa-cogs text-green"></i> <span>Setting</span></a></li>
		@elseif(Session('previlage') == 'adminzis')
			<li class="header">MAIN NAVIGATION</li>
            <li class="{{ isset($sidebar) && $sidebar == 'dashbord' ? 'active' : '' }}">
				<a href="{{ url('dashbord') }}">
				<i class="fa fa-dashboard text-primary"></i> <span>Dashboard</span>
				</a>
			</li>
           <li class="{{ isset($sidebar) && $sidebar == 'lapamil' ? 'active' : '' }}">
				<a href="{{ url('lapamil') }}">
                <i class="fa fa-balance-scale text-green"></i>
                <span>Laporan ZIS</span>
              </a>
            </li>
            <li class="header">==========================</li>
		@elseif(Session('previlage') == 'ortu')
			<li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="/">
                <i class="glyphicon glyphicon-home"></i> <span>Front Page</span>
              </a>
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'biodata' ? 'active' : '' }}">
				<a href="{{ url('biodata') }}">
                <i class="fa fa-users text-red"></i>
                <span>Biodata Siswa</span>
              </a>
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'ijinortu' ? 'active' : '' }}">
				<a href="{{ url('ijinortu') }}">
               <i class="fa fa-car text-aqua"></i>
                <span>Ijin Tidak Masuk</span> 
              </a>
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'lapnilaiortu' ? 'active' : '' }}">
				<a href="{{ url('lapnilaiortu') }}">
				<i class="fa fa-bar-chart text-blue"></i>
                <span>Laporan Nilai</span> 
              </a>
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'tagihanrutin' ? 'active' : '' }}">
				<a href="{{ url('tagihanrutin') }}">
				<i class="fa fa-money text-green"></i>
                <span>Tagihan Sekolah</span> 
              </a>
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'tabungan' ? 'active' : '' }}">
				<a href="{{ url('tabungan') }}">
				<i class="fa fa-gift text-yellow"></i>
                <span>Tabungan</span> 
              </a>
            </li>
			<li class="{{ isset($sidebar) && $sidebar == 'daftarekskul' ? 'active' : '' }}">
				<a href="{{ url('daftarekskul') }}">
				<i class="fa fa-flask text-blue"></i>
                <span>Pendaftaran Ekskul</span>
              </a>
            </li>	
            <li class="header">==========================</li>
			<li class="{{ isset($sidebar) && $sidebar == 'minimi' ? 'active' : '' }}"><a href="{{ url('minimi') }}"><i class="fa fa-user-plus text-magenta"></i> <span>Mini Library</span></a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'profile' ? 'active' : '' }}"><a href="{{ url('profile') }}"><i class="glyphicon glyphicon-user text-red"></i> <span>Ganti Password</span></a></li>
		@else
			@if (isset($id_sekolah))
			<li>
			<a href="/frontpage?id={{ $id_sekolah }}">
				<i class="fa fa-home text-green"></i>
				<span>
					@if (isset($domainapps01))
						{{ $domainapps01 }}
					@elseif (Session('domainapps01') !== null)
						{{ Session('domainapps01') }}
					@else{{ 
						config('global.sekolah') }}
					@endif
				</span>
			</a>
			</li>
			@else 
			<li>
			<a href="/">
				<i class="fa fa-home text-green"></i>
				<span>Back To Home</span>
			</a>
			</li>
			@endif
		@endif
		@if(Session('spesial') == 'paguyuban')
			<li class="{{ isset($sidebar) && $sidebar == 'dashboardpaguyuban' ? 'active' : '' }}">
				<a href="{{ url('dashboardpaguyuban') }}">
				<i class="fa fa-users text-red"></i> <span>Paguyuban Zone</span>
				</a>
			</li>
		@endif
		@if(Session('id'))
		<li>
		  <a href="{{ route('logout') }}">
			<i class="fa fa-sign-out text-magenta"></i>
			<span>Logout</span>                
		  </a>
		</li>
		@else
			@if (isset($id_sekolah))
			<li><a href="/login?id={{ $id_sekolah }}"><i class="fa fa-sign-in text-aqua"></i><span>Login</span></a></li>
			@else 
			<li><a href="/"><i class="fa fa-sign-in text-aqua"></i><span>Home</span></a></li>
			@endif
		@endif
      </ul>
    </section>
  </aside>