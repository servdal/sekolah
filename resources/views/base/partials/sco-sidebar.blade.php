<aside class="main-sidebar">
    <section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image"><img src="{{ asset('logo-ub.png') }}" class="img-circle" alt="User Image"></div>
			@if(Session('previlage') == 'Peserta Ujian Dinas')
			<div class="pull-left info">
				<p>Ujian Dinas</p>
				<a href="#"><i class="fa fa-circle text-success"></i> {!! Session('deskripsiaplikasi') !!}</a>
			</div>
		</div>
			@else
			<div class="pull-left info">
				<p>{!! config('global.swandhananama') !!}</p>
				<a href="#"><i class="fa fa-circle text-success"></i> {!! config('global.swandhanauniv') !!}</a>
			</div>
		</div>
		<ul class="sidebar-menu" data-widget="tree">
        @if(Session('previlage') == 'developer')
			<li class="{{ isset($sidebar) && $sidebar == 'developing' ? 'active' : '' }}" style='background: url("{{ asset("/dist/img/pointing.gif") }}") no-repeat; background-size: 100% 50px;  background-position: center top;'>
				<a href="{{ url('developing') }}">
				<i class="fa fa-dashboard text-primary"></i> <span>Developing</span>
					@if(isset($counttugas))
						@if($counttugas != 0)
							 <small class="label pull-right bg-green">{{ $counttugas }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}">
				<a href="{{ url('antritte') }}">
				<i class="fa fa-dashboard text-success"></i> <span>TTE Queue</span>
					@if(isset($countantritte))
						@if($countantritte != 0)
							 <small class="label pull-right bg-green">{{ $countantritte }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }}">
				<a href="{{ url('mailbox') }}">
				<i class="fa fa-envelope text-danger"></i> 
					<span>Mailbox</span>
					@if(isset($countmailbox))
						@if($countmailbox != 0)
							 <small class="label pull-right bg-green">{{ $countmailbox }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'sigap' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-calculator text-warning"></i> <span>SIGAP</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a href="{{ url('karyawan') }}">Penerima Gaji</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a href="{{ url('pinjaman') }}">Pinjaman</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a href="{{ url('gaji') }}">Laporan Gaji</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'gpp' ? 'active' : '' }}"><a href="{{ url('gpp') }}">Data GPP</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'gajidosen' ? 'active' : '' }}"><a href="{{ url('gajidosen') }}">Tunj. Dosen dan Professor</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a href="{{ url('gajisetting') }}">Setting</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a href="{{ url('espete') }}">SPT Tahunan</a></li>
			  </ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-envelope-o  text-info"></i> <span>Persuratan</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'dashboardpimpinan' ? 'active' : '' }}"><a href="{{ url('dashboardpimpinan') }}">Dashboard Pimpinan</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'dashbordsurat' ? 'active' : '' }}"><a href="{{ url('dashbordsurat') }}">Dashboard Sekpim</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}"><a href="{{ url('dashboardagendaris') }}">Dashboard Agendaris</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'controlsekpim' ? 'active' : '' }}"><a href="{{ url('controlsekpim') }}">Kontrol Sekpim</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'controltu' ? 'active' : '' }}"><a href="{{ url('controltu') }}">Kontrol TU</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'controlekspedisi' ? 'active' : '' }}"><a href="{{ url('controlekspedisi') }}">Kontrol Sekpim</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }}"><a href="{{ url('insurat') }}">Surat Masuk</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE </a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE </a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a href="{{ url('outsurat') }}">Surat Keluar</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'notadinas' ? 'active' : '' }}"><a href="{{ url('notadinas') }}">Nota Dinas</a>
					@if(isset($countsendnd))
						@if($countsendnd != 0)
							 <small class="label pull-right bg-green">{{ $countsendnd }}</small>
						@endif
					@endif
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'disposisi' ? 'active' : '' }}"><a href="{{ url('disposisi') }}">Disposisi</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'tandatangan' ? 'active' : '' }}"><a href="{{ url('tandatangan') }}">Tanda Tangan</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'ekspedisi' ? 'active' : '' }}"><a href="{{ url('ekspedisi') }}">Ekspedisi Surat Keluar</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'suratakademikkp' ? 'active' : '' }}"><a href="{{ url('suratakademikkp') }}"><i class="fa fa-flask text-success"></i>Surat Akademik KP </a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'suratlabklinik' ? 'active' : '' }}"><a href="{{ url('suratlabklinik') }}"><i class="fa fa-flask text-success"></i>Surat Hasil Lab </a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a href="{{ url('arsipkeluar') }}">Arsip Surat Keluar</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a href="{{ url('arsipmasuk') }}">Arsip Surat Masuk</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}"><a href="{{ url('statistik') }}">Statistik</a></li>
			  </ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-black-tie text-yellow"></i> <span>Bantuan Studi dan Publikasi</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a href="{{ url('daftarbantuanadmin') }}">Pendaftaran Baru</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}"><a href="{{ url('bantuanadmin') }}">Admin Bantuan Studi</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }}"><a href="{{ url('bantuanadminpublikasi') }}">Admin Bantuan Publikasi</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}"><a href="{{ url('bantuanadminriset') }}">Penerima Dana Riset dan PKM</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanuser' ? 'active' : '' }}"><a href="{{ url('bantuanuser') }}">Bantuan Model User</a></li>
			  </ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'simsppd' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-street-view text-aqua"></i> <span>Perjalanan Dinas</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
			  </ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'dokar' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-users text-magenta"></i> <span>DIKTENDIK</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a href="{{ url('ewsub') }}">EWS UB</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }}"><a href="{{ url('dashboarddokar') }}">Dashboard</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'draftremunerasi' ? 'active' : '' }}"><a href="{{ url('draftremunerasi') }}">Draft Remunerasi</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'draftpangkat' ? 'active' : '' }}"><a href="{{ url('draftpangkat') }}">Draft Kenaikan Pangkat</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'drafttubel' ? 'active' : '' }}"><a href="{{ url('drafttubel') }}">Draft Tugas/Ijin Belajar DOSEN</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'drafttubeltendik' ? 'active' : '' }}"><a href="{{ url('drafttubeltendik') }}">Draft Tugas/Ijin Belajar TENDIK</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'draftjabakad' ? 'active' : '' }}"><a href="{{ url('draftjabakad') }}">Jabatan Akademik Dosen</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'draftpemberhentian' ? 'active' : '' }}"><a href="{{ url('draftpemberhentian') }}">Pemberhentian Tetap Non PNS</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'pengangkatanpns' ? 'active' : '' }}"><a href="{{ url('pengangkatanpns') }}">Pengangkatan PNS</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'jabatanpelaksana' ? 'active' : '' }}"><a href="{{ url('jabatanpelaksana') }}">Penetapan Jabatan Pelaksana</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'draftpenempatan' ? 'active' : '' }}"><a href="{{ url('draftpenempatan') }}">Draft Penempatan Pegawai</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'inpassinggaji' ? 'active' : '' }}"><a href="{{ url('inpassinggaji') }}">Draft SK Penyesuain Gaji</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'udin' ? 'active' : '' }}"><a href="{{ url('udin') }}">Ujian Dinas</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'latsaradmin' ? 'active' : '' }}"><a href="{{ url('latsaradmin') }}">LATSAR</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'skkontrak' ? 'active' : '' }}"><a href="{{ url('skkontrak') }}">Draft SK Kontrak</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'verifikatorkgb' ? 'active' : '' }}"><a href="{{ url('verifikatorkgb') }}">Verifikasi KGB</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'dokarsetting' ? 'active' : '' }}"><a href="{{ url('dokarsetting') }}">Setting</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }}"><a href="{{ url('verfikasicuti') }}/all">Cuti Pegawai</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'listsurattugas' ? 'active' : '' }}"><a href="{{ url('listsurattugas') }}">Management Surat Tugas</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'bpjsadmin' ? 'active' : '' }}"><a href="{{ url('bpjsadmin') }}">Data BPJS</a></li>
			 </ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-calendar-plus-o text-primary"></i> <span>Administrasi <i class="fa fa-building"></i> dan <i class="fa fa-taxi"></i></span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
			  </ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'ecek' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-credit-card text-danger"></i> <span>E-Cek</span>			
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'ecekadmin' ? 'active' : '' }}"><a href="{{ url('ecekadmin') }}">E-Cek Admin</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }}"><a href="{{ url('ecekverfikasi') }}">E-Cek Verifikasi</a></li>
			  </ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'simpukjadmin' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-search text-primary"></i> <span>SIMPRO-PAK</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'simpukjadmin' ? 'active' : '' }}"><a href="{{ url('simpukjadmin') }}">Setting Layanan</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'simpukjapengajuan' ? 'active' : '' }}"><a href="{{ url('simpukjapengajuan') }}">Pengajuan</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}"><a href="{{ url('simpukjaverifikasi') }}">Verifikasi</a></li>
			  </ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
				<a href="#">
					<i class="fa fa-bank text-yellow"></i> <span>SI FAKULTAS</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}">
						<a href="{{ url('adminplagiasi') }}">
						<i class="fa fa-line-chart text-yellow"></i> <span>Pelaporan Deteksi Plagiasi</span>
						</a>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}">
						<a href="{{ url('ruangbaca') }}">
						<i class="fa fa-book text-yellow"></i> <span>Ruang Baca</span>
						</a>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}">
						<a href="{{ url('jadwalsatpam') }}">
						<i class="fa fa-drupal text-yellow"></i> <span>Jadwal Satpam</span>
						</a>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}">
						<a href="{{ url('simbhp') }}">
						<i class="fa fa-shopping-cart text-yellow"></i> <span>SIMBHP</span>
						</a>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}">
						<a href="{{ url('swakelola') }}">
						<i class="fa fa-globe text-yellow"></i> <span>Swakelola</span>
						</a>
					</li>
					<li class="treeview"> <!--Pelayanan Akademik-->
						<a href="#">
							<i class="fa fa-bank text-yellow"></i> <span>Administrasi</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">Program Studi</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Akademik</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'lapkrsmanual' ? 'active' : '' }}"><a href="{{ url('lapkrsmanual') }}">Laporan KRS Manual</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'skl' ? 'active' : '' }}"><a href="{{ url('skl') }}">Laporan SKL</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'lapnilaiakad' ? 'active' : '' }}"><a href="{{ url('lapnilaiakad') }}">Laporan Nilai Kuliah</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'arsipnilaiakad' ? 'active' : '' }}"><a href="{{ url('arsipnilaiakad') }}">Database Nilai</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'arsipijasahakad' ? 'active' : '' }}"><a href="{{ url('arsipijasahakad') }}">Arsip Ijasah dan Transkrip</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'lapdospa' ? 'active' : '' }}"><a href="{{ url('lapdospa') }}">Laporan Dosen PA</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'lapkeuanganakad' ? 'active' : '' }}"><a href="{{ url('lapkeuanganakad') }}">Laporan Keuangan Akademik</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'uploadnilai' ? 'active' : '' }}"><a href="{{ url('uploadnilai') }}">Editor KHS/KRS/Transkrip</a></li>
							<li class="treeview">
								<a href="#">
									<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Semester Antara</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'lapakadsp' ? 'active' : '' }}"><a href="{{ url('lapakadsp') }}">Pendaftaran</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'pesertakelassa' ? 'active' : '' }}"><a href="{{ url('pesertakelassa') }}">Peserta Kelas</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="treeview"> <!--Jadwal-->
						<a href="#">
							<i class="fa fa-buysellads text-yellow"></i> <span>Jadwal Kuliah</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="treeview">
								<a href="#">
								<i class="fa fa-calendar-plus-o text-info"></i> <span>Setting</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Kuliah</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a href="{{ url('vjadharian') }}">View Harian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Ujian</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="treeview"> <!--Pelayanan Prodi-->
						<a href="#">
							<i class="fa fa-cubes text-yellow"></i> <span>Pelayanan Prodi</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-briefcase text-green"></i> <span>Magang</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-briefcase text-green"></i> <span>Diploma/Sarjana/Magister</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Judul</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Proposal</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Wisuda</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="treeview"> <!--Pelayanan Kemahasiswaan-->
						<a href="#">
							<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Kemahasiswaan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a href="{{ url('datakegiatan') }}">E-LPJ</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a href="{{ url('datapkm') }}">Laporan PKM</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
						</ul>
					</li>
					<li class="treeview"><!--CAMABA-->
						<a href="#">
							<i class="fa fa-user-plus text-yellow"></i> <span>Reg. CAMABA</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a href="{{ url('camabas2') }}">Magister</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a href="{{ url('camabas3') }}">Doktor</a></li>
						</ul>
					</li>
					<li class="treeview"> <!--SIPAGU-->
						<a href="#">
							<i class="fa fa-money text-yellow"></i> <span>SIPAGU</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a href="{{ url('pagu') }}">Set Pagu</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a href="{{ url('pagugu') }}">Set Pagu GU</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
						</ul>
					</li>
					<li class="treeview"> <!--Keuangan Jurusan-->
						<a href="#">
							<i class="fa fa-money text-yellow"></i> <span>Keuangan Jurusan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }}"><a href="{{ url('datakeuhptmasuk') }}">Data Masuk</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a href="{{ url('laporankeuhpt') }}">Laporan</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'simba' ? 'active' : '' }} treeview">
				<a href="#">
					<i class="fa fa-paper-plane-o text-info"></i> <span>SI Akreditasi</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="treeview">
						<a href="#">
						<i class="fa fa-calendar-plus-o text-info"></i> <span>Kegiatan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li title="Data Akademik Lain" class="{{ isset($sidebar) && $sidebar == 'akademik' ? 'active' : '' }}"><a href="{{ url('akademik') }}">Pendidikan</a></li>
							<li title="Data Penelitan dan Publikasi Ilmiah"  class="{{ isset($sidebar) && $sidebar == 'penelitian' ? 'active' : '' }}"><a href="{{ url('penelitian') }}">Penelitian</a></li>
							<li title="Data Pengabdian" class="{{ isset($sidebar) && $sidebar == 'pengabdian' ? 'active' : '' }}"><a href="{{ url('pengabdian') }}">PkM</a></li>
							<li title="Data Penunjang, Luaran HAKI" class="{{ isset($sidebar) && $sidebar == 'penunjangdosen' ? 'active' : '' }}"><a href="{{ url('penunjangdosen') }}">Penunjang</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-fonticons text-danger"></i> <span>Penilaian</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'bkd' ? 'active' : '' }}"><a href="{{ url('bkd') }}">BKD</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'pak' ? 'active' : '' }}"><a href="{{ url('pak') }}">PAK</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'settingpakbkd' ? 'active' : '' }}"><a href="{{ url('settingpakbkd') }}">Setting Rubrik BKD</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'settingbkd' ? 'active' : '' }}"><a href="{{ url('settingbkd') }}">Setting Rubrik PAK</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-trophy text-primary"></i> <span>Tambahan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-area-chart text-success"></i> <span>Laporan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-gears text-danger"></i> <span>Setting</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Control Keuangan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'masterlab' ? 'active' : '' }}"><a href="{{ url('masterlab') }}">Master Laboratorium</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="header">==========================</li>
			<li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}">
				<a href="{{ url('user') }}">
				<i class="fa fa-user-plus text-aqua"></i> <span>Setting</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'lembaga' ? 'active' : '' }}">
				<a href="{{ url('lembaga') }}">
				<i class="fa fa-bank text-danger"></i> <span>Setting Unit Kerja</span>
				</a>
			</li>
		@elseif(Session('previlage') == 'admin')
			<li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}">
				<a href="{{ url('user') }}">
				<i class="fa fa-user-plus text-success"></i> <span>Setting</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}">
				<a href="{{ url('kategori12') }}">
				<i class="fa fa-bank text-info"></i> <span>Setting Prodi</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}">
				<a href="{{ url('dashboardagendaris') }}">
				<i class="fa fa-qrcode text-danger"></i> <span>Penomoran Surat</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}">
				<a href="{{ url('settingpejabat') }}">
				<i class="fa fa-mortar-board text-danger"></i> <span>TTD dan Paraf Pimpinan</span>
				</a>
			</li>
			@if(Session('fakultas') == 'FMIPA' OR Session('fakultas') == 'FP')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-buysellads text-yellow"></i> <span>Jadwal Kuliah</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="treeview">
							<a href="#">
							<i class="fa fa-calendar-plus-o text-info"></i> <span>Setting</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Ruang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a href="{{ url('settingjadwal') }}">Setting</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-calendar-plus-o text-info"></i> <span>Penjadwalan</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a href="{{ url('vjadharian') }}">View Harian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Ujian</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Kemahasiswaan</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a href="{{ url('datakegiatan') }}">E-LPJ</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a href="{{ url('datapkm') }}">Laporan PKM</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-cubes text-yellow"></i> <span>Pelayanan (SEMUA JURUSAN)</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Setting Ruang</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Magang</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Sarjana/Magister</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Judul</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Doktor</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="treeview">
									<a href="#">
									<i class="fa fa-briefcase text-yellow"></i> <span>Jurusan Biologi</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Seminar Kemajuan I</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3kemajuan2' ? 'active' : '' }}"><a href="{{ url('s3kemajuan2') }}">Seminar Kemajuan II</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Internasional</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
									</ul>
								</li>
								<li class="treeview">
									<a href="#">
									<i class="fa fa-briefcase text-yellow"></i> <span>ALL Jurusan</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Proposal</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA MAGISTER</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2biologi' ? 'active' : '' }}"><a href="{{ url('camabas2biologi') }}"> Biologi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2fisika' ? 'active' : '' }}"><a href="{{ url('camabas2fisika') }}"> Fisika</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2matematika' ? 'active' : '' }}"><a href="{{ url('camabas2matematika') }}"> Matematika</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2kimia' ? 'active' : '' }}"><a href="{{ url('camabas2kimia') }}"> Kimia</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2statistika' ? 'active' : '' }}"><a href="{{ url('camabas2statistika') }}"> Statistika</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA DOKTOR</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3biologi' ? 'active' : '' }}"><a href="{{ url('camabas3biologi') }}">Biologi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3fisika' ? 'active' : '' }}"><a href="{{ url('camabas3fisika') }}">Fisika</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3matematika' ? 'active' : '' }}"><a href="{{ url('camabas3matematika') }}">Matematika</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3kimia' ? 'active' : '' }}"><a href="{{ url('camabas3kimia') }}">Kimia</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3statistika' ? 'active' : '' }}"><a href="{{ url('camabas3statistika') }}">Statistika</a></li>
							</ul>
						</li>
					</ul>
				</li>
			@endif
		@elseif(Session('previlage') == 'Sekretaris' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Akademik' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Riset dan Inovasi' OR Session('previlage') == 'Sekretaris Rektor' OR Session('previlage') == 'Sekretaris Dekan' OR Session('previlage') == 'Sekretaris WD I' OR Session('previlage') == 'Sekretaris WD II' OR Session('previlage') == 'Sekretaris WD III')
			<li class="{{ isset($sidebar) && $sidebar == 'dashbordsurat' ? 'active' : '' }}">
				<a href="{{ url('dashbordsurat') }}">
				<i class="fa fa-dashboard text-primary"></i> <span>Dashboard</span>
				</a>
			</li>
				
			<li class="{{ isset($sidebar) && $sidebar == 'bukutamuadmin' ? 'active' : '' }}">
				<a href="{{ url('bukutamuadmin') }}">
				<i class="fa fa-book"></i> <span>Buku Tamu</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }}">
				<a href="{{ url('mailbox') }}">
				<i class="fa fa-envelope text-danger"></i> 
					<span>Mailbox</span>
					@if(isset($countmailbox))
						@if($countmailbox != 0)
							<small class="label pull-right bg-green">{{ $countmailbox }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }}">
				<a href="{{ url('insurat') }}">
				<i class="fa fa-briefcase text-success"></i> <span>Surat Masuk</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}">
				<a href="{{ url('outsurat') }}">
				<i class="fa fa-pencil-square-o text-info"></i> <span>Surat Keluar</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}">
				<a href="{{ url('suratkeluar') }}">
				<i class="fa fa-pencil-square-o text-info"></i> <span>Surat Keluar dengan TTE </span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}"><i class="fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a href="{{ url('ewsub') }}"><i class="fa fa-graduation-cap text-danger"></i>Direktori Jabatan</a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}">
				<a href="{{ url('outperaturan') }}">
				<i class="fa fa-book text-warning"></i> <span>Peraturan dan Keputusan</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}">
				<a href="{{ url('dashboardagendaris') }}">
				<i class="fa fa-qrcode text-danger"></i> <span>Penomoran Surat</span>
				</a>
			</li>
			@if (Session('fakultas') == 'FIKES')
			<li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}">
				<a href="{{ url('simpukjaverifikasi') }}">
					<i class="fa fa-search text-primary"></i> <span>SIMPRO-PAK</span>
					@if(isset($countsimpro))
						@if($countsimpro != 0)
							<small class="label bg-aqua"> {{ $countsimpro }}</small>
						@endif
					@endif
				</a>
			</li>
			@endif
			@if(Session('previlage') == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan')
				<li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}">
					<a href="{{ url('user') }}">
					<i class="fa fa-user-plus text-success"></i> <span>Setting</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'lembaga' ? 'active' : '' }}">
					<a href="{{ url('lembaga') }}">
					<i class="fa fa-bank text-danger"></i> <span>Admin Fakultas/Lembaga</span>
					</a>
				</li>
			@endif
		@elseif(Session('previlage') == 'Sekretaris Senat UB')
			<li class="{{ isset($sidebar) && $sidebar == 'dashbordsurat' ? 'active' : '' }}">
				<a href="{{ url('dashbordsurat') }}">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'bukutamuadmin' ? 'active' : '' }}">
				<a href="{{ url('bukutamuadmin') }}">
				<i class="fa fa-book"></i> <span>Buku Tamu</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }}">
				<a href="{{ url('mailbox') }}">
				<i class="fa fa-envelope text-danger"></i> 
					<span>Mailbox</span>
					@if(isset($countmailbox))
						@if($countmailbox != 0)
							<small class="label pull-right bg-green">{{ $countmailbox }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}">
				<a href="{{ url('outsurat') }}">
				<i class="fa fa-pencil-square-o"></i> <span>Surat Keluar</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}">
				<a href="{{ url('suratkeluar') }}">
				<i class="fa fa-pencil-square-o text-info"></i> <span>Surat Keluar dengan TTE </span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}"><i class="fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
		@elseif(Session('previlage') == 'Agendaris Umum' OR Session('previlage') == 'Agendaris')
			<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}">
				<a href="{{ url('dashboardagendaris') }}">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }}">
				<a href="{{ url('mailbox') }}">
				<i class="fa fa-envelope text-danger"></i> 
					<span>Mailbox</span>
					@if(isset($countmailbox))
						@if($countmailbox != 0)
							<small class="label pull-right bg-green">{{ $countmailbox }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'ekspedisi' ? 'active' : '' }}">
				<a href="{{ url('ekspedisi') }}">
				<i class="fa fa-paper-plane-o text-success"></i> <span>Ekpedisi Surat</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}">
				<a href="{{ url('outsurat') }}">
				<i class="fa fa-pencil-square-o"></i> <span>Surat Keluar</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}">
				<a href="{{ url('suratkeluar') }}">
				<i class="fa fa-pencil-square-o text-info"></i> <span>Surat Keluar dengan TTE </span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}"><i class="fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
		@elseif(Session('previlage') == 'Arsiparis Umum' OR Session('previlage') == 'Arsiparis')
			<li class="{{ isset($sidebar) && $sidebar == 'dashboardarsiparis' ? 'active' : '' }}">
				<a href="{{ url('dashboardarsiparis') }}">
				<i class="fa fa-dashboard text-danger"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }}">
				<a href="{{ url('mailbox') }}">
				<i class="fa fa-envelope text-danger"></i> 
					<span>Mailbox</span>
					@if(isset($countmailbox))
						@if($countmailbox != 0)
							<small class="label pull-right bg-green">{{ $countmailbox }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'settingsurat' ? 'active' : '' }}">
				<a href="{{ url('settingsurat') }}">
				<i class="fa fa-gears text-success"></i> <span>Setting</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}">
				<a href="{{ url('outsurat') }}">
				<i class="fa fa-pencil-square-o text-info"></i> <span>Surat Keluar </span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}">
				<a href="{{ url('suratkeluar') }}">
				<i class="fa fa-pencil-square-o text-info"></i> <span>Surat Keluar dengan TTE </span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}"><i class="fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
		@elseif(Session('previlage') == 'Tata Usaha')
			<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}">
				<a href="{{ url('dashboardagendaris') }}">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }}">
				<a href="{{ url('mailbox') }}">
				<i class="fa fa-envelope text-primary"></i> 
					<span>Mailbox</span>
					@if(isset($countmailbox))
						@if($countmailbox != 0)
							<small class="label pull-right bg-green">{{ $countmailbox }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'ekspedisi' ? 'active' : '' }}">
				<a href="{{ url('ekspedisi') }}">
				<i class="fa fa-paper-plane-o text-success"></i> <span>Ekpedisi Surat</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }}">
				<a href="{{ url('insurat') }}">
				<i class="fa fa-briefcase text-success"></i> <span>Surat Masuk</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}">
				<a href="{{ url('outsurat') }}">
				<i class="fa fa-pencil-square-o text-warning"></i> <span>Surat Keluar</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}">
				<a href="{{ url('suratkeluar') }}">
				<i class="fa fa-pencil-square-o text-info"></i> <span>Surat Keluar dengan TTE </span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}"><i class="fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
		@elseif(Session('previlage') == 'Frontoffice' OR Session('previlage') == 'frontoffice')
			<li class="{{ isset($sidebar) && $sidebar == 'bukutamuadmin' ? 'active' : '' }}">
				<a href="{{ url('bukutamuadmin') }}">
				<i class="fa fa-book"></i> <span>Buku Tamu</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }}">
				<a href="{{ url('mailbox') }}">
				<i class="fa fa-envelope text-primary"></i> 
					<span>Mailbox</span>
					@if(isset($countmailbox))
						@if($countmailbox != 0)
							<small class="label pull-right bg-green">{{ $countmailbox }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}">
				<a href="{{ url('outsurat') }}">
				<i class="fa fa-pencil-square-o text-warning"></i> <span>Surat Keluar</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}">
				<a href="{{ url('suratkeluar') }}">
				<i class="fa fa-pencil-square-o text-info"></i> <span>Surat Keluar dengan TTE </span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}"><i class="fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
		@elseif(Session('previlage') == 'Sekretaris Ka.Biro Keuangan' OR Session('previlage') == 'Sekretaris Ka.Biro Umum dan Kepegawaian' OR Session('previlage') == 'Sekretaris Ka.Biro Akademik dan Kemahasiswaan' OR Session('previlage') == 'Sekretaris Bagian Akutansi')
			<li class="{{ isset($sidebar) && $sidebar == 'dashboardsekbiro' ? 'active' : '' }}">
				<a href="{{ url('dashboardsekbiro') }}">
				<i class="fa fa-dashboard text-danger"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'bukutamuadmin' ? 'active' : '' }}">
				<a href="{{ url('bukutamuadmin') }}">
				<i class="fa fa-book text-success"></i> <span>Buku Tamu</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }}">
				<a href="{{ url('mailbox') }}">
				<i class="fa fa-envelope text-warning"></i> 
					<span>Mailbox</span>
					@if(isset($countmailbox))
						@if($countmailbox != 0)
							<small class="label pull-right bg-green">{{ $countmailbox }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}">
				<a href="{{ url('dashboardagendaris') }}">
				<i class="fa fa-qrcode text-info"></i> <span>Penomoran Surat</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}">
				<a href="{{ url('outsurat') }}">
				<i class="fa fa-pencil-square-o text-aqua"></i> <span>Surat Keluar</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}">
				<a href="{{ url('suratkeluar') }}">
				<i class="fa fa-pencil-square-o text-info"></i> <span>Surat Keluar dengan TTE </span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}"><i class="fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
		@elseif(Session('previlage') == 'PEJABAT')
			<li class="{{ isset($sidebar) && $sidebar == 'dashboardpimpinan' ? 'active' : '' }}">
				<a href="{{ url('dashboardpimpinan') }}">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }}">
				<a href="{{ url('mailbox') }}">
				<i class="fa fa-envelope text-danger"></i> 
					<span>Mailbox</span>
					@if(isset($countmailbox))
						@if($countmailbox != 0)
							<small class="label pull-right bg-green">{{ $countmailbox }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'disposisi' ? 'active' : '' }}">
				<a href="{{ url('disposisi') }}">
				<i class="fa fa-briefcase"></i> 
					<span>Surat Masuk</span>
					@if(isset($countinboxmasuk))
						@if($countinboxmasuk != 0)
							<small class="label pull-right bg-green">{{ $countinboxmasuk }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'tandatangan' ? 'active' : '' }}"
			@if(isset($countinboxkeluar))
				@if($countinboxkeluar != 0)
					style='background: url("{{ asset("/dist/img/pointing.gif") }}") no-repeat; background-size: 100% 50px;  background-position: center top;'
				@endif
			@endif
			>
				<a href="{{ url('tandatangan') }}">
				<i class="fa fa-pencil-square-o"></i> 
					<span>Mohon Paraf/Ttd</span>
					@if(isset($countinboxkeluar))
						@if($countinboxkeluar != 0)
							<small class="label pull-right bg-yellow">{{ $countinboxkeluar }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'notadinas' ? 'active' : '' }}">
				<a href="{{ url('notadinas') }}">
				<i class="fa fa-file-text"></i> 
					<span>Nota Dinas</span>
					@if(isset($countsendnd))
						@if($countsendnd != 0)
							 <small class="label pull-right bg-green">{{ $countsendnd }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'memo' ? 'active' : '' }}">
				<a href="{{ url('memo') }}">
				<i class="fa fa-file-text"></i> 
					<span>Memo</span>
				</a>
			</li>
			@if(Session('idjabatan') == '3')
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}">
					<a href="{{ url('bantuanadmin') }}">
					<i class="fa fa-mortar-board text-yellow"></i> 
						<span>Bantuan Biaya Studi Lanjut</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }}">
					<a href="{{ url('bantuanadminpublikasi') }}">
					<i class="fa fa-mortar-board text-yellow"></i> 
						<span>Bantuan Publikasi</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}">
					<a href="{{ url('bantuanadminriset') }}">
					<i class="fa fa-mortar-board text-yellow"></i> 
						<span>Penerima Dana Riset dan PKM</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'simprokja' ? 'active' : '' }}">
					<a href="{{ url('simprokja') }}">
					<i class="fa fa-mortar-board text-green"></i> 
						<span>SIMPRO-KJA</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }}">
					<a href="{{ url('ecekverfikasi') }}">
					<i class="fa fa-money text-red"></i> 
						<span>E-Cek</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}">
					<a href="{{ url('antritte') }}">
					<i class="fa fa-dashboard text-success"></i> <span>TTE Report</span>
						@if(isset($countantritte))
							@if($countantritte != 0)
								<small class="label pull-right bg-green">{{ $countantritte }}</small>
							@endif
						@endif
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-primary"></i> <span>Management Assets</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Assets <i class="fa fa-building"></i> dan <i class="fa fa-taxi"></i></a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Assets Kendaraan</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'masterlab' ? 'active' : '' }}"><a href="{{ url('masterlab') }}">Assets Laboratorium</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-gears text-primary"></i> <span>Developing</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'DataInduk' ? 'active' : '' }}">
							<a href="/datainduk/Dosen-{{Session('nim')}}">
							<i class="fa fa-newspaper-o"></i> <span>Profile Lengkap</span>
							</a>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-area-chart text-success"></i> <span>Tabel SAPTO Akreditasi</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan Akreditasi</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-gears text-danger"></i> <span>Manual Input</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
							</ul>
						</li>
						<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
							<a href="#">
								<i class="fa fa-bank text-yellow"></i> <span>SI FAKULTAS</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}">
									<a href="{{ url('adminplagiasi') }}">
									<i class="fa fa-line-chart text-yellow"></i> <span>Pelaporan Deteksi Plagiasi</span>
									</a>
								</li>
								<li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}">
									<a href="{{ url('ruangbaca') }}">
									<i class="fa fa-book text-yellow"></i> <span>Ruang Baca</span>
									</a>
								</li>
								<li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}">
									<a href="{{ url('jadwalsatpam') }}">
									<i class="fa fa-drupal text-yellow"></i> <span>Jadwal Satpam</span>
									</a>
								</li>
								<li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}">
									<a href="{{ url('simbhp') }}">
									<i class="fa fa-shopping-cart text-yellow"></i> <span>SIMBHP</span>
									</a>
								</li>
								<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}">
									<a href="{{ url('swakelola') }}">
									<i class="fa fa-globe text-yellow"></i> <span>Swakelola</span>
									</a>
								</li>
								<li class="treeview"> <!--Pelayanan Akademik-->
									<a href="#">
										<i class="fa fa-bank text-yellow"></i> <span>Administrasi</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">Program Studi</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
									</ul>
								</li>
								<li class="treeview">
									<a href="#">
										<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Akademik</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="{{ isset($sidebar) && $sidebar == 'lapkrsmanual' ? 'active' : '' }}"><a href="{{ url('lapkrsmanual') }}">Laporan KRS Manual</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'skl' ? 'active' : '' }}"><a href="{{ url('skl') }}">Laporan SKL</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'lapnilaiakad' ? 'active' : '' }}"><a href="{{ url('lapnilaiakad') }}">Laporan Nilai Kuliah</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'arsipnilaiakad' ? 'active' : '' }}"><a href="{{ url('arsipnilaiakad') }}">Database Nilai</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'arsipijasahakad' ? 'active' : '' }}"><a href="{{ url('arsipijasahakad') }}">Arsip Ijasah dan Transkrip</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'lapdospa' ? 'active' : '' }}"><a href="{{ url('lapdospa') }}">Laporan Dosen PA</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'lapkeuanganakad' ? 'active' : '' }}"><a href="{{ url('lapkeuanganakad') }}">Laporan Keuangan Akademik</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'uploadnilai' ? 'active' : '' }}"><a href="{{ url('uploadnilai') }}">Editor KHS/KRS/Transkrip</a></li>
										<li class="treeview">
											<a href="#">
												<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Semester Antara</span>
												<span class="pull-right-container">
												<i class="fa fa-angle-left pull-right"></i>
												</span>
											</a>
											<ul class="treeview-menu">
												<li class="{{ isset($sidebar) && $sidebar == 'lapakadsp' ? 'active' : '' }}"><a href="{{ url('lapakadsp') }}">Pendaftaran</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'pesertakelassa' ? 'active' : '' }}"><a href="{{ url('pesertakelassa') }}">Peserta Kelas</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="treeview"> <!--Jadwal-->
									<a href="#">
										<i class="fa fa-buysellads text-yellow"></i> <span>Jadwal Kuliah</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="treeview">
											<a href="#">
											<i class="fa fa-calendar-plus-o text-info"></i> <span>Setting</span>
												<span class="pull-right-container">
												<i class="fa fa-angle-left pull-right"></i>
												</span>
											</a>
											<ul class="treeview-menu">
												<li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
											</ul>
										</li>
										<li class="treeview">
											<a href="#">
											<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Kuliah</span>
												<span class="pull-right-container">
												<i class="fa fa-angle-left pull-right"></i>
												</span>
											</a>
											<ul class="treeview-menu">
												<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a href="{{ url('vjadharian') }}">View Harian</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
											</ul>
										</li>
										<li class="treeview">
											<a href="#">
											<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Ujian</span>
												<span class="pull-right-container">
												<i class="fa fa-angle-left pull-right"></i>
												</span>
											</a>
											<ul class="treeview-menu">
												<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="treeview"> <!--Pelayanan Prodi-->
									<a href="#">
										<i class="fa fa-cubes text-yellow"></i> <span>Pelayanan Prodi</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
										<li class="treeview">
											<a href="#">
											<i class="fa fa-briefcase text-green"></i> <span>Magang</span>
												<span class="pull-right-container">
												<i class="fa fa-angle-left pull-right"></i>
												</span>
											</a>
											<ul class="treeview-menu">
												<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
											</ul>
										</li>
										<li class="treeview">
											<a href="#">
											<i class="fa fa-briefcase text-green"></i> <span>Diploma/Sarjana/Magister</span>
												<span class="pull-right-container">
												<i class="fa fa-angle-left pull-right"></i>
												</span>
											</a>
											<ul class="treeview-menu">
												<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Judul</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Proposal</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
											</ul>
										</li>
										<li class="treeview">
											<a href="#">
											<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
												<span class="pull-right-container">
												<i class="fa fa-angle-left pull-right"></i>
												</span>
											</a>
											<ul class="treeview-menu">
												<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Wisuda</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="treeview"> <!--Pelayanan Kemahasiswaan-->
									<a href="#">
										<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Kemahasiswaan</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a href="{{ url('datakegiatan') }}">E-LPJ</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a href="{{ url('datapkm') }}">Laporan PKM</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
									</ul>
								</li>
								<li class="treeview"><!--CAMABA-->
									<a href="#">
										<i class="fa fa-user-plus text-yellow"></i> <span>Reg. CAMABA</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a href="{{ url('camabas2') }}">Magister</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a href="{{ url('camabas3') }}">Doktor</a></li>
									</ul>
								</li>
								<li class="treeview"> <!--SIPAGU-->
									<a href="#">
										<i class="fa fa-money text-yellow"></i> <span>SIPAGU</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a href="{{ url('pagu') }}">Set Pagu</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a href="{{ url('pagugu') }}">Set Pagu GU</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
									</ul>
								</li>
								<li class="treeview"> <!--Keuangan Jurusan-->
									<a href="#">
										<i class="fa fa-money text-yellow"></i> <span>Keuangan Jurusan</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="{{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }}"><a href="{{ url('datakeuhptmasuk') }}">Data Masuk</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a href="{{ url('laporankeuhpt') }}">Laporan</a></li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			@endif
			@if(Session('idjabatan') == '436')
				<li class="{{ isset($sidebar) && $sidebar == 'simprokja' ? 'active' : '' }}">
					<a href="{{ url('simprokja') }}">
					<i class="fa fa-mortar-board text-green"></i> 
						<span>SIMPRO-KJA</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}">
					<a href="{{ url('alihstatus') }}">
					<i class="fa fa-gift text-primary"></i> <span>Promosi Tendik Kontrak</span>
					</a>
				</li>
			@endif
			@if(Session('idjabatan') == '1')
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}">
					<a href="{{ url('bantuanadmin') }}">
					<i class="fa fa-mortar-board text-yellow"></i> 
						<span>Bantuan Biaya Studi Lanjut</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }}">
					<a href="{{ url('bantuanadminpublikasi') }}">
					<i class="fa fa-mortar-board text-yellow"></i> 
						<span>Bantuan Publikasi</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}">
					<a href="{{ url('bantuanadminriset') }}">
					<i class="fa fa-mortar-board text-yellow"></i> 
						<span>Penerima Dana Riset dan PKM</span>
					</a>
				</li>
			@endif
			@if(Session('idjabatan') == '2')
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}">
					<a href="{{ url('bantuanadmin') }}">
					<i class="fa fa-mortar-board text-yellow"></i> 
						<span>Bantuan Biaya Studi Lanjut</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }}">
					<a href="{{ url('bantuanadminpublikasi') }}">
					<i class="fa fa-mortar-board text-yellow"></i> 
						<span>Bantuan Publikasi</span>
					</a>
				</li>
			@endif
			@if(Session('idjabatan') == '61' OR Session('idjabatan') == '65' OR Session('idjabatan') == '11' OR Session('idjabatan') == '970' OR Session('idjabatan') == '973')
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}">
					<a href="{{ url('bantuanadmin') }}">
					<i class="fa fa-mortar-board text-yellow"></i> 
						<span>Bantuan Biaya Studi Lanjut</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
			@endif
			@if(Session('idjabatan') == '10')
				<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
			@endif
			@if(Session('idjabatan') == '35')
				<li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}">
					<a href="{{ url('antritte') }}">
					<i class="fa fa-dashboard text-success"></i> <span>TTE Report</span>
						@if(isset($countantritte))
							@if($countantritte != 0)
								<small class="label pull-right bg-green">{{ $countantritte }}</small>
							@endif
						@endif
					</a>
				</li>
			@endif
			@if(Session('idjabatan') == '8')
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}">
					<a href="{{ url('bantuanadmin') }}">
					<i class="fa fa-mortar-board text-yellow"></i> 
						<span>Bantuan Studi dan Publikasi</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }}">
					<a href="{{ url('ecekverfikasi') }}">
					<i class="fa fa-money text-red"></i> 
						<span>E-Cek</span>
						@if(isset($countvercek))
							@if($countvercek != 0)
								<small class="label pull-right bg-green">{{ $countvercek }}</small>
							@endif
						@endif
					</a>
				</li>
			@endif
			@if(Session('idjabatan') == '15')
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}">
					<a href="{{ url('bantuanadmin') }}">
					<i class="fa fa-mortar-board text-yellow"></i> 
						<span>Bantuan Studi dan Publikasi</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }}">
					<a href="{{ url('ecekverfikasi') }}">
					<i class="fa fa-money text-red"></i> 
						<span>E-Cek</span>
						@if(isset($countvercek))
							@if($countvercek != 0)
								<small class="label pull-right bg-green">{{ $countvercek }}</small>
							@endif
						@endif
					</a>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-bank text-yellow"></i> <span>Administrasi Vokasi</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">Master Program Studi</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-buysellads text-yellow"></i> <span>Jadwal Vokasi</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="treeview">
							<a href="#">
							<i class="fa fa-calendar-plus-o text-info"></i> <span>Setting</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="{{ url('ruangan') }}">Ruang</a></li>
								<li><a href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
								<li><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
								<li><a href="{{ url('settingjadwal') }}">Setting</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-calendar-plus-o text-info"></i> <span>Penjadwalan</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a href="{{ url('vjadharian') }}">View Harian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Ujian</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
								<li><a href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-cubes text-yellow"></i> <span>Pelayanan Vokasi</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a href="{{ url('adminplagiasi') }}">Laporan Adm. Deteksi Plagiasi</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-green"></i> <span>Magang</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
								<li><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-green"></i> <span>Ujian</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Judul</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a href="{{ url('penelitiantesis') }}">Publikasi Jurnal (S2)</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Kemahasiswaan Vokasi</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a href="{{ url('datakegiatan') }}">E-LPJ</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a href="{{ url('datapkm') }}">Laporan PKM</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
					</ul>
				</li>
			@endif
			@if(Session('idjabatan') == '965')
				<li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-primary"></i> <span>Administrasi <i class="fa fa-building"></i> dan <i class="fa fa-taxi"></i></span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
					</ul>
				</li>
			@endif
			@if(Session('idjabatan') == '53')
				<li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} treeview">
				<a href="#">
					<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Bantuan Studi dan Publikasi</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a href="{{ url('daftarbantuanadmin') }}">Pendaftaran Baru</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}"><a href="{{ url('bantuanadmin') }}">Bantuan Studi dan Publikasi</a></li>
				</ul>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'ecekverfikasi' ? 'active' : '' }}">
					<a href="{{ url('ecekverfikasi') }}">
					<i class="fa fa-money text-red"></i> 
						<span>E-Cek</span>
						@if(isset($countvercek))
							@if($countvercek != 0)
								<small class="label pull-right bg-green">{{ $countvercek }}</small>
							@endif
						@endif
					</a>
				</li>
			@endif
			@if(Session('idjabatan') == '63')
				<li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-primary"></i> <span>Administrasi <i class="fa fa-building"></i> dan <i class="fa fa-taxi"></i></span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
					</ul>
				</li>
			@endif
			@if(Session('idjabatan') == '924' OR Session('idjabatan') == '833' OR Session('idjabatan') == '1004' OR Session('idjabatan') == '1024' OR Session('idjabatan') == '958' OR Session('idjabatan') == '973' OR Session('idjabatan') == '950')
				<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}">
					<a href="{{ url('suratkeluar') }}">
					<i class="fa fa-envelope text-yellow"></i> <span>Surat Keluar</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}"><i class="fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
			@endif
			@if(Session('idjabatan') == '64')
				<li class="{{ isset($sidebar) && $sidebar == 'controlsekpim' ? 'active' : '' }}">
					<a href="{{ url('controlsekpim') }}">
					<i class="fa fa-black-tie text-yellow"></i> <span>Kontrol Sekpim</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'controltu' ? 'active' : '' }}">
					<a href="{{ url('controltu') }}">
					<i class="fa fa-newspaper-o text-yellow"></i> <span>Kontrol Tata Usaha</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}">
					<a href="{{ url('dashboardagendaris') }}">
					<i class="fa fa-pencil text-yellow"></i> <span>Kontrol Agendaris</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'controlekspedisi' ? 'active' : '' }}">
					<a href="{{ url('controlekspedisi') }}">
					<i class="fa fa-map-signs text-yellow"></i> <span>Kontrol Ekspedisi</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }}">
					<a href="{{ url('insurat') }}">
					<i class="fa fa-briefcase text-success"></i> <span>Surat Masuk</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}">
					<a href="{{ url('suratkeluar') }}">
					<i class="fa fa-envelope text-yellow"></i> <span>Surat Keluar</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}"><i class="fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'simsppd' ? 'active' : '' }} treeview">
					<a href="#">
						<i class="fa fa-street-view text-aqua"></i> <span>Perjalanan Dinas</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
					</ul>
				</li>
			@endif
			@if(Session('idjabatan') == '1005')
				<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}">
					<a href="{{ url('dashboardagendaris') }}">
					<i class="fa fa-pencil text-yellow"></i> <span>Kontrol Surat Keluar</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}">
					<a href="{{ url('outperaturan') }}">
					<i class="fa fa-pencil text-yellow"></i> <span>Kontrol SK dan Peraturan</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }}">
					<a href="{{ url('insurat') }}">
					<i class="fa fa-pencil text-yellow"></i> <span>Kontrol Surat Masuk</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}">
					<a href="{{ url('suratkeluar') }}">
					<i class="fa fa-pencil text-yellow"></i> <span>Surat Keluar</span>
					</a>
				</li>
			@endif
			@if(Session('fakultas') == 'FMIPA')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-cubes text-yellow"></i> <span>Pelayanan (SEMUA JURUSAN)</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Setting Ruang</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Magang</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Sarjana/Magister</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Judul</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Doktor</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
							@if(Session('jabatan') == 'Ketua Jurusan Biologi' OR Session('jabatan') == 'Sekretaris Jurusan Biologi' OR Session('jabatan') == 'Ketua Program Studi S1 Biologi' OR Session('jabatan') == 'Ketua Program Studi S2 Biologi' OR Session('jabatan') == 'Ketua Program Studi S3 Biologi' OR Session('jabatan') == 'Kepala Laboratorium Biologi Dasar' OR Session('jabatan') == 'Kepala Laboratorium Mikrobiologi' OR Session('jabatan') == 'Kepala Laboratorium Biologi Seluler dan Molekuler')
								<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Seminar Kemajuan I</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kemajuan2' ? 'active' : '' }}"><a href="{{ url('s3kemajuan2') }}">Seminar Kemajuan II</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Internasional</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
							@else
								<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
							@endif
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA MAGISTER</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2biologi' ? 'active' : '' }}"><a href="{{ url('camabas2biologi') }}"> Biologi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2fisika' ? 'active' : '' }}"><a href="{{ url('camabas2fisika') }}"> Fisika</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2matematika' ? 'active' : '' }}"><a href="{{ url('camabas2matematika') }}"> Matematika</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2kimia' ? 'active' : '' }}"><a href="{{ url('camabas2kimia') }}"> Kimia</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2statistika' ? 'active' : '' }}"><a href="{{ url('camabas2statistika') }}"> Statistika</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA DOKTOR</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3biologi' ? 'active' : '' }}"><a href="{{ url('camabas3biologi') }}">Biologi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3fisika' ? 'active' : '' }}"><a href="{{ url('camabas3fisika') }}">Fisika</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3matematika' ? 'active' : '' }}"><a href="{{ url('camabas3matematika') }}">Matematika</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3kimia' ? 'active' : '' }}"><a href="{{ url('camabas3kimia') }}">Kimia</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3statistika' ? 'active' : '' }}"><a href="{{ url('camabas3statistika') }}">Statistika</a></li>
							</ul>
						</li>
					</ul>
				</li>
				@if (Session('keljabatan') == 'KASUB KEPEG FAK' OR Session('keljabatan') == 'KASUB AKAD FAK' OR Session('keljabatan') == 'KASUB UMUM FAK' OR Session('keljabatan') == 'KASUB KEU FAK' OR Session('keljabatan') == 'KASUB UMUMKEU FAK' OR Session('keljabatan') == 'KASUB KEUKEPEG FAK')
            		<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}">
						<a href="{{ url('alihstatus') }}">
						<i class="fa fa-gift text-primary"></i> <span>Promosi Tendik Kontrak</span>
						</a>
					</li>
				@endif
			@elseif(Session('fakultas') == 'PASCAUB')
				@if(Session('idjabatan') == '31')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-cubes text-yellow"></i> <span>1. Sistem Pelayanan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-briefcase text-green"></i> <span>Magister</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-money text-aqua"></i> <span>2. Keuangan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="treeview">
								<a href="#">
									<i class="fa fa-credit-card text-aqua"></i> <span>SPD Online</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fa fa-bank text-aqua"></i> <span>Sistem Penggajian</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a href="{{ url('karyawan') }}">Penerima Gaji</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a href="{{ url('pinjaman') }}">Pinjaman</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a href="{{ url('gaji') }}">Laporan Gaji</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a href="{{ url('gajisetting') }}">Setting</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a href="{{ url('espete') }}">SPT Tahunan</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
						</ul>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} treeview">
						<a href="#">
							<i class="fa fa-calendar-plus-o text-yellow"></i> <span>3. Beasiswa</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-building text-primary"></i> <span>4. Umum</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
						</ul>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}">
						<a href="{{ url('adminplagiasi') }}">
						<i class="fa fa-line-chart text-yellow"></i> <span>5. Jurnal</span>
						</a>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}">
						<a href="{{ url('ruangbaca') }}">
						<i class="fa fa-book text-yellow"></i> <span>6. Ruang Baca</span>
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-calendar-plus-o text-primary"></i> <span>7. CAMABA</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a href="{{ url('camabas2') }}">Magister</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a href="{{ url('camabas3') }}">Doktor</a></li>
						</ul>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}">
						<a href="{{ url('swakelola') }}">
						<i class="fa fa-building text-yellow"></i> <span>8. BPPM</span>
						</a>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}">
						<a href="{{ url('lapkuisioner') }}">
						<i class="fa fa-pencil text-yellow"></i> <span>9. GJM</span>
						</a>
					</li>
				@elseif(Session('idjabatan') == '573' OR Session('jabatan') == '831')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-cubes text-yellow"></i> <span>Akademik</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-briefcase text-green"></i> <span>Magister</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} treeview">
						<a href="#">
							<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Beasiswa</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
						</ul>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}">
						<a href="{{ url('adminplagiasi') }}">
						<i class="fa fa-line-chart text-yellow"></i> <span>Jurnal</span>
						</a>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}">
						<a href="{{ url('swakelola') }}">
						<i class="fa fa-building text-yellow"></i> <span>BPPM</span>
						</a>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}">
						<a href="{{ url('lapkuisioner') }}">
						<i class="fa fa-pencil text-yellow"></i> <span>GJM</span>
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-calendar-plus-o text-primary"></i> <span>CAMABA</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a href="{{ url('camabas2') }}">Magister</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a href="{{ url('camabas3') }}">Doktor</a></li>
						</ul>
					</li>
				@elseif(Session('idjabatan') == '703')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-money text-aqua"></i> <span>Keuangan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="treeview">
								<a href="#">
									<i class="fa fa-credit-card text-aqua"></i> <span>SPD Online</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fa fa-bank text-aqua"></i> <span>Sistem Penggajian</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a href="{{ url('karyawan') }}">Penerima Gaji</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a href="{{ url('pinjaman') }}">Pinjaman</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a href="{{ url('gaji') }}">Laporan Gaji</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a href="{{ url('gajisetting') }}">Setting</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a href="{{ url('espete') }}">SPT Tahunan</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
						</ul>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} treeview">
						<a href="#">
							<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Beasiswa</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-building text-primary"></i> <span>Umum</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
						</ul>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}">
						<a href="{{ url('swakelola') }}">
						<i class="fa fa-building text-yellow"></i> <span>BPPM</span>
						</a>
					</li>
				@elseif(Session('idjabatan') == '575')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-money text-aqua"></i> <span>Keuangan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="treeview">
								<a href="#">
									<i class="fa fa-credit-card text-aqua"></i> <span>SPD Online</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fa fa-bank text-aqua"></i> <span>Sistem Penggajian</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a href="{{ url('karyawan') }}">Penerima Gaji</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a href="{{ url('pinjaman') }}">Pinjaman</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a href="{{ url('gaji') }}">Laporan Gaji</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a href="{{ url('gajisetting') }}">Setting</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a href="{{ url('espete') }}">SPT Tahunan</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
						</ul>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} treeview">
						<a href="#">
							<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Beasiswa</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-building text-primary"></i> <span>Umum</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
						</ul>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}">
						<a href="{{ url('swakelola') }}">
						<i class="fa fa-building text-yellow"></i> <span>BPPM</span>
						</a>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}">
						<a href="{{ url('alihstatus') }}">
						<i class="fa fa-gift text-primary"></i> <span>Promosi Tendik Kontrak</span>
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-calendar-plus-o text-primary"></i> <span>CAMABA</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a href="{{ url('camabas2') }}">Magister</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a href="{{ url('camabas3') }}">Doktor</a></li>
						</ul>
					</li>
				@elseif(Session('idjabatan') == '576')
					<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}">
						<a href="{{ url('swakelola') }}">
						<i class="fa fa-building text-yellow"></i> <span>BPPM</span>
						</a>
					</li>
				@elseif(Session('idjabatan') == '577')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-cubes text-yellow"></i> <span>Akademik</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-briefcase text-green"></i> <span>Magister</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-bank text-yellow"></i> <span>Administrasi</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">Master Program Studi</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
						</ul>
					</li>
				@elseif(Session('idjabatan') == '578')
					<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}">
						<a href="{{ url('adminplagiasi') }}">
						<i class="fa fa-line-chart text-yellow"></i> <span>Jurnal</span>
						</a>
					</li>
				@elseif(Session('idjabatan') == '579')
					<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}">
						<a href="{{ url('lapkuisioner') }}">
						<i class="fa fa-pencil text-yellow"></i> <span>GJM</span>
						</a>
					</li>
				@else
					<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}">
						<a href="{{ url('suratkeluar') }}">
						<i class="fa fa-pencil-square-o text-info"></i> <span>Surat Keluar dengan TTE </span>
						</a>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}"><i class="fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-cubes text-yellow"></i> <span>Akademik</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-briefcase text-green"></i> <span>Magister</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
								</ul>
							</li>
						</ul>
					</li>
				@endif
			@elseif (Session('fakultas') == 'FAPET' OR Session('fakultas') == 'FEB' OR Session('fakultas') == 'FH' OR Session('fakultas') == 'FIA' OR Session('fakultas') == 'FIB' OR Session('fakultas') == 'FIKES' OR Session('fakultas') == 'FILKOM' OR Session('fakultas') == 'FISIP' OR Session('fakultas') == 'FK' OR Session('fakultas') == 'FKG' OR Session('fakultas') == 'FKH' OR Session('fakultas') == 'FMIPA' OR Session('fakultas') == 'FP' OR Session('fakultas') == 'FPIK' OR Session('fakultas') == 'FT' OR Session('fakultas') == 'FTP' OR Session('fakultas') == 'FV' OR Session('fakultas') == 'PSDKUJAKARTA' OR Session('fakultas') == 'PSLKU')
				@if(Session('keljabatan') == 'KABAG FAK')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-envelope text-yellow"></i> <span>Persuratan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}"><a href="{{ url('dashboardagendaris') }}">Kontrol Surat Keluar</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'insurat' ? 'active' : '' }}"><a href="{{ url('insurat') }}">Kontrol Surat Masuk</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a href="{{ url('outsurat') }}">Surat Keluar</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-bank text-yellow"></i> <span>Pelayanan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="treeview"> <!--Akademik-->
										<a href="#">
											<i class="fa fa-buysellads text-yellow"></i> <span>Akademik dan Kemahasiswaan</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}">
												<a href="{{ url('ruangbaca') }}">
												<i class="fa fa-book text-yellow"></i> <span>Ruang Baca</span>
												</a>
											</li>
											<li class="treeview">
												<a href="#">
												<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Kuliah</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="treeview">
														<a href="#">
														<i class="fa fa-calendar-plus-o text-info"></i> <span>Setting</span>
															<span class="pull-right-container">
															<i class="fa fa-angle-left pull-right"></i>
															</span>
														</a>
														<ul class="treeview-menu">
															<li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
														</ul>
													</li>
													<li class="treeview">
														<a href="#">
														<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Kuliah</span>
															<span class="pull-right-container">
															<i class="fa fa-angle-left pull-right"></i>
															</span>
														</a>
														<ul class="treeview-menu">
															<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a href="{{ url('vjadharian') }}">View Harian</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
														</ul>
													</li>
													<li class="treeview">
														<a href="#">
														<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Ujian</span>
															<span class="pull-right-container">
															<i class="fa fa-angle-left pull-right"></i>
															</span>
														</a>
														<ul class="treeview-menu">
															<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
														</ul>
													</li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
												<i class="fa fa-calendar-plus-o text-info"></i> <span>Pelayanan Mahasiswa</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Persuratan</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a href="{{ url('datakegiatan') }}">E-LPJ</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a href="{{ url('datapkm') }}">Laporan PKM</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
												<i class="fa fa-calendar-plus-o text-info"></i> <span>Pelayanan Prodi</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="treeview">
														<a href="#">
														<i class="fa fa-briefcase text-green"></i> <span>Magang</span>
															<span class="pull-right-container">
															<i class="fa fa-angle-left pull-right"></i>
															</span>
														</a>
														<ul class="treeview-menu">
															<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
														</ul>
													</li>
													<li class="treeview">
														<a href="#">
														<i class="fa fa-briefcase text-green"></i> <span>Diploma/Sarjana/Magister/Profesi</span>
															<span class="pull-right-container">
															<i class="fa fa-angle-left pull-right"></i>
															</span>
														</a>
														<ul class="treeview-menu">
															<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
														</ul>
													</li>
													<li class="treeview">
														<a href="#">
														<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
															<span class="pull-right-container">
															<i class="fa fa-angle-left pull-right"></i>
															</span>
														</a>
														<ul class="treeview-menu">
															<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
														</ul>
													</li>
												</ul>
											</li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'simsppd' ? 'active' : '' }} treeview">
										<a href="#">
											<i class="fa fa-calendar-plus-o text-aqua"></i> <span>Kepegawaian</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }}"><a href="{{ url('dashboarddokar') }}">Dashboard</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}">
												<a href="{{ url('simpukjaverifikasi') }}">
													<i class="fa fa-search text-primary"></i> <span>SIMPRO-PAK</span>
													@if(isset($countsimpro))
														@if($countsimpro != 0)
															<small class="label bg-aqua"> {{ $countsimpro }}</small>
														@endif
													@endif
												</a>
											</li>
											<li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }}">
												<a href="{{ url('verfikasicuti') }}/all">
													<i class="fa fa-users text-warning"></i> <span>Cuti Pegawai</span>
													@if(isset($countcuti))
														@if($countcuti != 0)
															<small class="label bg-aqua"> {{ $countcuti }}</small>
														@endif
													@endif
												</a>
											</li>
											<li class="{{ isset($sidebar) && $sidebar == 'listsurattugas' ? 'active' : '' }}">
												<a href="{{ url('listsurattugas') }}">
													<i class="fa fa-users text-warning"></i> <span>Management Surat Tugas</span>
												</a>
											</li>
											<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a href="{{ url('dosenpenguji') }}">SK Dosen Penguji</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}"><a href="{{ url('user') }}">Account Management</a></li>
										</ul>
									</li>
									<li class="treeview"> <!-- Keuangan -->
										<a href="#">
											<i class="fa fa-money text-aqua"></i> <span>Keuangan</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="treeview">
												<a href="#">
													<i class="fa fa-credit-card text-aqua"></i> <span>SPD Online</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
													<i class="fa fa-bank text-aqua"></i> <span>Sistem Penggajian</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a href="{{ url('karyawan') }}">Penerima Gaji</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a href="{{ url('pinjaman') }}">Pinjaman</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a href="{{ url('gaji') }}">Laporan Gaji</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a href="{{ url('gajisetting') }}">Setting</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a href="{{ url('espete') }}">SPT Tahunan</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
													<i class="fa fa-bank text-aqua"></i> <span>PAGU</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a href="{{ url('pagu') }}">Set Pagu</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a href="{{ url('pagugu') }}">Set Pagu GU</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a href="{{ url('laporankeuhpt') }}">Report</a></li>
												</ul>
											</li>
											<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
										</ul>
									</li>
									<li class="treeview"><!-- Umum -->
										<a href="#">
											<i class="fa fa-building text-primary"></i> <span>Umum</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}">
										<a href="{{ url('pengumuman') }}">
										<i class="fa fa-bullhorn text-yellow"></i> <span>Pengumuman ke Mahasiswa</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Swakelola</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'arsipsubstantif' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-paper-plane-o text-info"></i> <span>Arsip Dinamis</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Substantif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a href="{{ url('arsipsubaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
											
										</ul>
									</li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Fasilitatif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a href="{{ url('arsipfasaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a href="{{ url('arsippermanen') }}">Permanen</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a href="{{ url('arsipmusnah') }}">Musnah</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}">
								<a href="{{ url('antritte') }}">
								<i class="fa fa-dashboard text-success"></i> <span>TTE Report</span>
									@if(isset($countantritte))
										@if($countantritte != 0)
											<small class="label pull-right bg-green">{{ $countantritte }}</small>
										@endif
									@endif
								</a>
							</li>
						</ul>
					</li>
				@elseif(Session('keljabatan') == 'KASUB AKAD FAK')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-envelope text-yellow"></i> <span>Persuratan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							@if (Session('fakultas') == 'FIKES')
								<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}"><a href="{{ url('dashboardagendaris') }}">Surat Keluar Mundur</a></li>
							@endif
							<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a href="{{ url('outsurat') }}">Surat Keluar</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-bank text-yellow"></i> <span>Pelayanan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="treeview"> <!--Akademik-->
										<a href="#">
											<i class="fa fa-buysellads text-yellow"></i> <span>Akademik dan Kemahasiswaan</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}">
												<a href="{{ url('ruangbaca') }}">
												<i class="fa fa-book text-yellow"></i> <span>Ruang Baca</span>
												</a>
											</li>
											<li class="treeview">
												<a href="#">
												<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Kuliah</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="treeview">
														<a href="#">
														<i class="fa fa-calendar-plus-o text-info"></i> <span>Setting</span>
															<span class="pull-right-container">
															<i class="fa fa-angle-left pull-right"></i>
															</span>
														</a>
														<ul class="treeview-menu">
															<li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
														</ul>
													</li>
													<li class="treeview">
														<a href="#">
														<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Kuliah</span>
															<span class="pull-right-container">
															<i class="fa fa-angle-left pull-right"></i>
															</span>
														</a>
														<ul class="treeview-menu">
															<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a href="{{ url('vjadharian') }}">View Harian</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
														</ul>
													</li>
													<li class="treeview">
														<a href="#">
														<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Ujian</span>
															<span class="pull-right-container">
															<i class="fa fa-angle-left pull-right"></i>
															</span>
														</a>
														<ul class="treeview-menu">
															<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
														</ul>
													</li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
												<i class="fa fa-calendar-plus-o text-info"></i> <span>Pelayanan Mahasiswa</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Persuratan</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a href="{{ url('datakegiatan') }}">E-LPJ</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a href="{{ url('datapkm') }}">Laporan PKM</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
												<i class="fa fa-calendar-plus-o text-info"></i> <span>Pelayanan Prodi</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="treeview">
														<a href="#">
														<i class="fa fa-briefcase text-green"></i> <span>Magang</span>
															<span class="pull-right-container">
															<i class="fa fa-angle-left pull-right"></i>
															</span>
														</a>
														<ul class="treeview-menu">
															<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
														</ul>
													</li>
													<li class="treeview">
														<a href="#">
														<i class="fa fa-briefcase text-green"></i> <span>Diploma/Sarjana/Magister/Profesi</span>
															<span class="pull-right-container">
															<i class="fa fa-angle-left pull-right"></i>
															</span>
														</a>
														<ul class="treeview-menu">
															<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
														</ul>
													</li>
													<li class="treeview">
														<a href="#">
														<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
															<span class="pull-right-container">
															<i class="fa fa-angle-left pull-right"></i>
															</span>
														</a>
														<ul class="treeview-menu">
															<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
															<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
														</ul>
													</li>
												</ul>
											</li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}">
										<a href="{{ url('pengumuman') }}">
										<i class="fa fa-bullhorn text-yellow"></i> <span>Pengumuman ke Mahasiswa</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Swakelola</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'arsipsubstantif' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-paper-plane-o text-info"></i> <span>Arsip Dinamis</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Substantif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a href="{{ url('arsipsubaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
											
										</ul>
									</li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Fasilitatif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a href="{{ url('arsipfasaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a href="{{ url('arsippermanen') }}">Permanen</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a href="{{ url('arsipmusnah') }}">Musnah</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}">
								<a href="{{ url('antritte') }}">
								<i class="fa fa-dashboard text-success"></i> <span>TTE Report</span>
									@if(isset($countantritte))
										@if($countantritte != 0)
											<small class="label pull-right bg-green">{{ $countantritte }}</small>
										@endif
									@endif
								</a>
							</li>
						</ul>
					</li>
				@elseif(Session('keljabatan') == 'KAJUR')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-bank text-yellow"></i> <span>Pelayanan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Pelayanan Prodi</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="treeview">
												<a href="#">
												<i class="fa fa-briefcase text-green"></i> <span>Magang</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
												<i class="fa fa-briefcase text-green"></i> <span>Diploma/Sarjana/Magister/Profesi</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
												<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}">
										<a href="{{ url('pengumuman') }}">
										<i class="fa fa-bullhorn text-yellow"></i> <span>Pengumuman ke Mahasiswa</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Swakelola</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
								</ul>
							</li>
						</ul>
					</li>
				@elseif(Session('keljabatan') == 'KPSS1')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-bank text-yellow"></i> <span>Pelayanan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="treeview">
										<a href="#">
										<i class="fa fa-briefcase text-green"></i> <span>Magang</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
										</ul>
									</li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-briefcase text-green"></i> <span>Sarjana</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Dosen Pembimbing</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}">
										<a href="{{ url('pengumuman') }}">
										<i class="fa fa-bullhorn text-yellow"></i> <span>Pengumuman ke Mahasiswa</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Swakelola</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
								</ul>
							</li>
						</ul>
					</li>
				@elseif(Session('keljabatan') == 'KPSS2')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-bank text-yellow"></i> <span>Pelayanan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="treeview">
										<a href="#">
										<i class="fa fa-briefcase text-green"></i> <span>Magister</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Tesis</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}">
										<a href="{{ url('pengumuman') }}">
										<i class="fa fa-bullhorn text-yellow"></i> <span>Pengumuman ke Mahasiswa</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Swakelola</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
								</ul>
							</li>
						</ul>
					</li>
				@elseif(Session('keljabatan') == 'KPSS3')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-bank text-yellow"></i> <span>Pelayanan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="treeview">
										<a href="#">
										<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}">
										<a href="{{ url('pengumuman') }}">
										<i class="fa fa-bullhorn text-yellow"></i> <span>Pengumuman ke Mahasiswa</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Swakelola</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
								</ul>
							</li>
						</ul>
					</li>
				@elseif(Session('keljabatan') == 'KASUB UMUM FAK')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-envelope text-yellow"></i> <span>Persuratan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a href="{{ url('outsurat') }}">Surat Keluar</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-bank text-yellow"></i> <span>Pelayanan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="treeview"><!-- Umum -->
										<a href="#">
											<i class="fa fa-building text-primary"></i> <span>Umum</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}">
										<a href="{{ url('pengumuman') }}">
										<i class="fa fa-bullhorn text-yellow"></i> <span>Pengumuman ke Mahasiswa</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Swakelola</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'arsipsubstantif' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-paper-plane-o text-info"></i> <span>Arsip Dinamis</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Substantif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a href="{{ url('arsipsubaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
											
										</ul>
									</li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Fasilitatif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a href="{{ url('arsipfasaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a href="{{ url('arsippermanen') }}">Permanen</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a href="{{ url('arsipmusnah') }}">Musnah</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}">
								<a href="{{ url('antritte') }}">
								<i class="fa fa-dashboard text-success"></i> <span>TTE Report</span>
									@if(isset($countantritte))
										@if($countantritte != 0)
											<small class="label pull-right bg-green">{{ $countantritte }}</small>
										@endif
									@endif
								</a>
							</li>
						</ul>
					</li>
				@elseif(Session('keljabatan') == 'KASUB KEU FAK')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-envelope text-yellow"></i> <span>Persuratan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a href="{{ url('outsurat') }}">Surat Keluar</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-bank text-yellow"></i> <span>Pelayanan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="treeview"> <!-- Keuangan -->
										<a href="#">
											<i class="fa fa-money text-aqua"></i> <span>Keuangan</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="treeview">
												<a href="#">
													<i class="fa fa-credit-card text-aqua"></i> <span>SPD Online</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
													<i class="fa fa-bank text-aqua"></i> <span>Sistem Penggajian</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a href="{{ url('karyawan') }}">Penerima Gaji</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a href="{{ url('pinjaman') }}">Pinjaman</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a href="{{ url('gaji') }}">Laporan Gaji</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a href="{{ url('gajisetting') }}">Setting</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a href="{{ url('espete') }}">SPT Tahunan</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
													<i class="fa fa-bank text-aqua"></i> <span>PAGU</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a href="{{ url('pagu') }}">Set Pagu</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a href="{{ url('pagugu') }}">Set Pagu GU</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a href="{{ url('laporankeuhpt') }}">Report</a></li>
												</ul>
											</li>
											<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Swakelola</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'arsipsubstantif' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-paper-plane-o text-info"></i> <span>Arsip Dinamis</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Substantif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a href="{{ url('arsipsubaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
											
										</ul>
									</li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Fasilitatif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a href="{{ url('arsipfasaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a href="{{ url('arsippermanen') }}">Permanen</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a href="{{ url('arsipmusnah') }}">Musnah</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}">
								<a href="{{ url('antritte') }}">
								<i class="fa fa-dashboard text-success"></i> <span>TTE Report</span>
									@if(isset($countantritte))
										@if($countantritte != 0)
											<small class="label pull-right bg-green">{{ $countantritte }}</small>
										@endif
									@endif
								</a>
							</li>
						</ul>
					</li>
				@elseif(Session('keljabatan') == 'KASUB KEPEG FAK')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-envelope text-yellow"></i> <span>Persuratan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a href="{{ url('outsurat') }}">Surat Keluar</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-bank text-yellow"></i> <span>Pelayanan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'simsppd' ? 'active' : '' }} treeview">
										<a href="#">
											<i class="fa fa-calendar-plus-o text-aqua"></i> <span>Kepegawaian</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }}"><a href="{{ url('dashboarddokar') }}">Dashboard</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}">
												<a href="{{ url('simpukjaverifikasi') }}">
													<i class="fa fa-search text-primary"></i> <span>SIMPRO-PAK</span>
													@if(isset($countsimpro))
														@if($countsimpro != 0)
															<small class="label bg-aqua"> {{ $countsimpro }}</small>
														@endif
													@endif
												</a>
											</li>
											<li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }}">
												<a href="{{ url('verfikasicuti') }}/all">
													<i class="fa fa-users text-warning"></i> <span>Cuti Pegawai</span>
													@if(isset($countcuti))
														@if($countcuti != 0)
															<small class="label bg-aqua"> {{ $countcuti }}</small>
														@endif
													@endif
												</a>
											</li>
											<li class="{{ isset($sidebar) && $sidebar == 'listsurattugas' ? 'active' : '' }}">
												<a href="{{ url('listsurattugas') }}">
													<i class="fa fa-users text-warning"></i> <span>Management Surat Tugas</span>
												</a>
											</li>
											<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a href="{{ url('dosenpenguji') }}">SK Dosen Penguji</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}"><a href="{{ url('user') }}">Account Management</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Swakelola</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'arsipsubstantif' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-paper-plane-o text-info"></i> <span>Arsip Dinamis</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Substantif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a href="{{ url('arsipsubaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
											
										</ul>
									</li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Fasilitatif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a href="{{ url('arsipfasaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a href="{{ url('arsippermanen') }}">Permanen</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a href="{{ url('arsipmusnah') }}">Musnah</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}">
								<a href="{{ url('antritte') }}">
								<i class="fa fa-dashboard text-success"></i> <span>TTE Report</span>
									@if(isset($countantritte))
										@if($countantritte != 0)
											<small class="label pull-right bg-green">{{ $countantritte }}</small>
										@endif
									@endif
								</a>
							</li>
						</ul>
					</li>
				@elseif(Session('keljabatan') == 'KASUB UMUMKEU FAK')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-envelope text-yellow"></i> <span>Persuratan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							@if (Session('fakultas') == 'FIKES')
								<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}"><a href="{{ url('dashboardagendaris') }}">Surat Keluar Mundur</a></li>
							@endif
							<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a href="{{ url('outsurat') }}">Surat Keluar</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-bank text-yellow"></i> <span>Pelayanan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="treeview"> <!-- Keuangan -->
										<a href="#">
											<i class="fa fa-money text-aqua"></i> <span>Keuangan</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="treeview">
												<a href="#">
													<i class="fa fa-credit-card text-aqua"></i> <span>SPD Online</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
													<i class="fa fa-bank text-aqua"></i> <span>Sistem Penggajian</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a href="{{ url('karyawan') }}">Penerima Gaji</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a href="{{ url('pinjaman') }}">Pinjaman</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a href="{{ url('gaji') }}">Laporan Gaji</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a href="{{ url('gajisetting') }}">Setting</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a href="{{ url('espete') }}">SPT Tahunan</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
													<i class="fa fa-bank text-aqua"></i> <span>PAGU</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a href="{{ url('pagu') }}">Set Pagu</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a href="{{ url('pagugu') }}">Set Pagu GU</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a href="{{ url('laporankeuhpt') }}">Report</a></li>
												</ul>
											</li>
											<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
										</ul>
									</li>
									<li class="treeview"><!-- Umum -->
										<a href="#">
											<i class="fa fa-building text-primary"></i> <span>Umum</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}">
										<a href="{{ url('pengumuman') }}">
										<i class="fa fa-bullhorn text-yellow"></i> <span>Pengumuman ke Mahasiswa</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Swakelola</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'arsipsubstantif' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-paper-plane-o text-info"></i> <span>Arsip Dinamis</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Substantif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a href="{{ url('arsipsubaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
											
										</ul>
									</li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Fasilitatif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a href="{{ url('arsipfasaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a href="{{ url('arsippermanen') }}">Permanen</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a href="{{ url('arsipmusnah') }}">Musnah</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}">
								<a href="{{ url('antritte') }}">
								<i class="fa fa-dashboard text-success"></i> <span>TTE Report</span>
									@if(isset($countantritte))
										@if($countantritte != 0)
											<small class="label pull-right bg-green">{{ $countantritte }}</small>
										@endif
									@endif
								</a>
							</li>
						</ul>
					</li>
				@elseif(Session('keljabatan') == 'KASUB KEUKEPEG FAK')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-envelope text-yellow"></i> <span>Persuratan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							@if (Session('fakultas') == 'FIKES')
								<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}"><a href="{{ url('dashboardagendaris') }}">Surat Keluar Mundur</a></li>
							@endif
							<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}"><a href="{{ url('outsurat') }}">Surat Keluar</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}"><a href="{{ url('suratkeluar') }}">Surat Keluar dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}">Sertifikat dengan TTE</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-bank text-yellow"></i> <span>Pelayanan</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'simsppd' ? 'active' : '' }} treeview">
										<a href="#">
											<i class="fa fa-calendar-plus-o text-aqua"></i> <span>Kepegawaian</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }}"><a href="{{ url('dashboarddokar') }}">Dashboard</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}">
												<a href="{{ url('simpukjaverifikasi') }}">
													<i class="fa fa-search text-primary"></i> <span>SIMPRO-PAK</span>
													@if(isset($countsimpro))
														@if($countsimpro != 0)
															<small class="label bg-aqua"> {{ $countsimpro }}</small>
														@endif
													@endif
												</a>
											</li>
											<li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }}">
												<a href="{{ url('verfikasicuti') }}/all">
													<i class="fa fa-users text-warning"></i> <span>Cuti Pegawai</span>
													@if(isset($countcuti))
														@if($countcuti != 0)
															<small class="label bg-aqua"> {{ $countcuti }}</small>
														@endif
													@endif
												</a>
											</li>
											<li class="{{ isset($sidebar) && $sidebar == 'listsurattugas' ? 'active' : '' }}">
												<a href="{{ url('listsurattugas') }}">
													<i class="fa fa-users text-warning"></i> <span>Management Surat Tugas</span>
												</a>
											</li>
											<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a href="{{ url('dosenpenguji') }}">SK Dosen Penguji</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}"><a href="{{ url('user') }}">Account Management</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}"><a href="{{ url('alihstatus') }}">Promosi Tendik Kontrak</a></li>
										</ul>
									</li>
									<li class="treeview"> <!-- Keuangan -->
										<a href="#">
											<i class="fa fa-money text-aqua"></i> <span>Keuangan</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="treeview">
												<a href="#">
													<i class="fa fa-credit-card text-aqua"></i> <span>SPD Online</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
													<i class="fa fa-bank text-aqua"></i> <span>Sistem Penggajian</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a href="{{ url('karyawan') }}">Penerima Gaji</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a href="{{ url('pinjaman') }}">Pinjaman</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a href="{{ url('gaji') }}">Laporan Gaji</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a href="{{ url('gajisetting') }}">Setting</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a href="{{ url('espete') }}">SPT Tahunan</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
													<i class="fa fa-bank text-aqua"></i> <span>PAGU</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a href="{{ url('pagu') }}">Set Pagu</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a href="{{ url('pagugu') }}">Set Pagu GU</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a href="{{ url('laporankeuhpt') }}">Report</a></li>
												</ul>
											</li>
											<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}">
										<a href="{{ url('pengumuman') }}">
										<i class="fa fa-bullhorn text-yellow"></i> <span>Pengumuman ke Mahasiswa</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Swakelola</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'arsipsubstantif' ? 'active' : '' }} treeview">
								<a href="#">
									<i class="fa fa-paper-plane-o text-info"></i> <span>Arsip Dinamis</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Substantif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a href="{{ url('arsipsubaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
											
										</ul>
									</li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Fasilitatif</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a href="{{ url('arsipfasaktif') }}">Aktif</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
										</ul>
									</li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a href="{{ url('arsippermanen') }}">Permanen</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a href="{{ url('arsipmusnah') }}">Musnah</a></li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}">
								<a href="{{ url('antritte') }}">
								<i class="fa fa-dashboard text-success"></i> <span>TTE Report</span>
									@if(isset($countantritte))
										@if($countantritte != 0)
											<small class="label pull-right bg-green">{{ $countantritte }}</small>
										@endif
									@endif
								</a>
							</li>
						</ul>
					</li>
				@elseif(Session('keljabatan') == 'BPPM')
					<li class="treeview">
						<a href="#">
							<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="treeview">
								<a href="#">
								<i class="fa fa-trophy text-primary"></i> <span>Data BPPM</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Data Penelitian / Swakelola</a></li>
								</ul>
							</li>
							<li class="treeview">
								<a href="#">
								<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
									<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
								</ul>
							</li>
						</ul>
					</li>
				@else
					@if (Session('keljabatan') == 'ATASANLANGSUNG')
						<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}">
							<a href="{{ url('alihstatus') }}">
							<i class="fa fa-gift text-primary"></i> <span>Promosi Tendik Kontrak</span>
							</a>
						</li>
					@endif
				@endif
			@else
				@if (Session('keljabatan') == 'ATASANLANGSUNG')
					<li class="{{ isset($sidebar) && $sidebar == 'alihstatus' ? 'active' : '' }}">
						<a href="{{ url('alihstatus') }}">
						<i class="fa fa-gift text-primary"></i> <span>Promosi Tendik Kontrak</span>
						</a>
					</li>
				@endif
			@endif
		@else
			<li class="{{ isset($sidebar) && $sidebar == 'dashboardstaf' ? 'active' : '' }}">
				<a href="{{ url('dashboardstaf') }}">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'mailbox' ? 'active' : '' }}">
				<a href="{{ url('mailbox') }}">
				<i class="fa fa-envelope text-danger"></i> 
					<span>Mailbox</span>
					@if(isset($countmailbox))
						@if($countmailbox != 0)
							<small class="label pull-right bg-green">{{ $countmailbox }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'outsurat' ? 'active' : '' }}">
				<a href="{{ url('outsurat') }}">
				<i class="fa fa-pencil-square-o"></i> <span>Surat Keluar</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'suratkeluar' ? 'active' : '' }}">
				<a href="{{ url('suratkeluar') }}">
				<i class="fa fa-pencil-square-o text-info"></i> <span>Surat Keluar dengan TTE </span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'serfitikatwithtte' ? 'active' : '' }}"><a href="{{ url('serfitikatwithtte') }}"><i class="fa fa-newspaper-o text-info"></i>Sertifikat dengan TTE </a></li>
		@endif
		@if(Session('semester') == 'Penguji')
			<li class="{{ isset($sidebar) && $sidebar == 'nilaiujiandinas' ? 'active' : '' }}">
				<a href="{{ url('nilaiujiandinas') }}">
				<i class="fa fa-pencil text-success"></i>
					<span>Penilaian Ujian Dinas</span>
				</a>
			</li>
		@endif
		@if(Session('fakultas') == 'FV')
			<li class="treeview">
				<a href="#">
					<i class="fa fa-bank text-yellow"></i> <span>Administrasi</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">Master Program Studi</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
				</ul>
			</li>
			@if(Session('previlage') == 'Staf Kemahasiswaan')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Kemahasiswaan</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a href="{{ url('datakegiatan') }}">E-LPJ</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a href="{{ url('datapkm') }}">Laporan PKM</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
					</ul>
				</li>
			@elseif(Session('previlage') == 'Staf Akademik')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-buysellads text-yellow"></i> <span>Jadwal Kuliah</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="treeview">
							<a href="#">
							<i class="fa fa-calendar-plus-o text-info"></i> <span>Setting</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Ruang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a href="{{ url('settingjadwal') }}">Setting</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-calendar-plus-o text-info"></i> <span>Penjadwalan</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a href="{{ url('vjadharian') }}">View Harian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Ujian</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}">
					<a href="{{ url('adminplagiasi') }}">
					<i class="fa fa-line-chart text-yellow"></i> <span>Pelaporan Deteksi Plagiasi</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-cubes text-green"></i> <span>Pelayanan</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Setting Ruang</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-green"></i> <span>Magang</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-green"></i> <span>Ujian</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Judul</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
					</ul>
				</li>
			@elseif(Session('previlage') == 'Staf Keuangan')
				<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}">
					<a href="{{ url('presensidosen') }}">
					<i class="fa fa-line-chart text-yellow"></i> <span>Rekap Presensi Dosen</span>
					</a>
				</li>
			@elseif(Session('previlage') == 'PEJABAT' OR Session('previlage') == 'pejabat')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-buysellads text-yellow"></i> <span>Jadwal Kuliah</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="treeview">
							<a href="#">
							<i class="fa fa-calendar-plus-o text-info"></i> <span>Setting</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="{{ url('ruangan') }}">Ruang</a></li>
								<li><a href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
								<li><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
								<li><a href="{{ url('settingjadwal') }}">Setting</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-calendar-plus-o text-info"></i> <span>Penjadwalan</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a href="{{ url('vjadharian') }}">View Harian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Ujian</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
								<li><a href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-cubes text-yellow"></i> <span>Pelayanan Prodi</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a href="{{ url('adminplagiasi') }}">Laporan Adm. Deteksi Plagiasi</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-green"></i> <span>Magang</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-green"></i> <span>Ujian</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Judul</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Kemahasiswaan</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a href="{{ url('datakegiatan') }}">E-LPJ</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a href="{{ url('datapkm') }}">Laporan PKM</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
					</ul>
				</li>
			@endif
		@endif
		@if(Session('fakultas') == 'PASCAUB')
			<li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
			@if(Session('previlage') == 'Staf Sub.Bag.Akademik dan Kemahasiswaan')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-bank text-yellow"></i> <span>Administrasi</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">Master Program Studi</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-cubes text-yellow"></i> <span>Sistem Pelayanan</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-green"></i> <span>Magister</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
			@elseif(Session('previlage') == 'Staf Sub.Bag.Umum dan Keuangan')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-primary"></i> <span>Gaji</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a href="{{ url('karyawan') }}">Penerima Gaji</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a href="{{ url('pinjaman') }}">Pinjaman</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a href="{{ url('gaji') }}">Laporan Gaji</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a href="{{ url('gajisetting') }}">Setting</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a href="{{ url('espete') }}">SPT Tahunan</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-credit-card text-aqua"></i> <span>SPD Online</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
					</ul>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
			@elseif(Session('previlage') == 'Tim Jurnal')
				<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}">
					<a href="{{ url('adminplagiasi') }}">
					<i class="fa fa-line-chart text-yellow"></i> <span>Jurnal</span>
					</a>
				</li>
			@elseif(Session('previlage') == 'Tim Umum')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-building text-primary"></i> <span>Umum</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
					</ul>
				</li>
			@elseif(Session('previlage') == 'Tim Pendaftaran')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-primary"></i> <span>CAMABA</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a href="{{ url('camabas2') }}">Magister</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a href="{{ url('camabas3') }}">Doktor</a></li>
					</ul>
				</li>
			@elseif(Session('previlage') == 'Tim Ruang Baca')
				<li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}">
					<a href="{{ url('ruangbaca') }}">
					<i class="fa fa-book text-yellow"></i> <span>Ruang Baca</span>
					</a>
				</li>
			@elseif(Session('previlage') == 'Tim Pendaftaran GJM BPPM')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-primary"></i> <span>CAMABA</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a href="{{ url('camabas2') }}">Magister</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a href="{{ url('camabas3') }}">Doktor</a></li>
					</ul>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}">
					<a href="{{ url('lapkuisioner') }}">
					<i class="fa fa-pencil text-yellow"></i> <span>GJM</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}">
					<a href="{{ url('swakelola') }}">
					<i class="fa fa-building text-yellow"></i> <span>BPPM</span>
					</a>
				</li>
			@elseif(Session('previlage') == 'Tim Beasiswa, BPPM, GJM, Pendaftaran')
				<li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Beasiswa</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-primary"></i> <span>CAMABA</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a href="{{ url('camabas2') }}">Magister</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a href="{{ url('camabas3') }}">Doktor</a></li>
					</ul>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}">
					<a href="{{ url('lapkuisioner') }}">
					<i class="fa fa-pencil text-yellow"></i> <span>GJM</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}">
					<a href="{{ url('swakelola') }}">
					<i class="fa fa-building text-yellow"></i> <span>BPPM</span>
					</a>
				</li>
			@elseif(Session('previlage') == 'Tim Beasiswa, Akademik, GJM, BPPM, Pendaftaran')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-bank text-yellow"></i> <span>Administrasi</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">Master Program Studi</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-cubes text-yellow"></i> <span>Sistem Pelayanan</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-green"></i> <span>Magister</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Beasiswa</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-primary"></i> <span>CAMABA</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a href="{{ url('camabas2') }}">Magister</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a href="{{ url('camabas3') }}">Doktor</a></li>
					</ul>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}">
					<a href="{{ url('lapkuisioner') }}">
					<i class="fa fa-pencil text-yellow"></i> <span>GJM</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}">
					<a href="{{ url('swakelola') }}">
					<i class="fa fa-building text-yellow"></i> <span>BPPM</span>
					</a>
				</li>
			@elseif(Session('previlage') == 'Tim Umum, GJM, BPPM')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-building text-primary"></i> <span>Umum</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
					</ul>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}">
					<a href="{{ url('lapkuisioner') }}">
					<i class="fa fa-pencil text-yellow"></i> <span>GJM</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}">
					<a href="{{ url('swakelola') }}">
					<i class="fa fa-building text-yellow"></i> <span>BPPM</span>
					</a>
				</li>
			@elseif(Session('previlage') == 'Sekretaris GJM')
				<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}">
					<a href="{{ url('lapkuisioner') }}">
					<i class="fa fa-pencil text-yellow"></i> <span>GJM</span>
					</a>
				</li>
			@elseif(Session('previlage') == 'admin')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-cubes text-yellow"></i> <span>1. Sistem Pelayanan</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-green"></i> <span>Magister</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-money text-aqua"></i> <span>2. Keuangan</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="treeview">
							<a href="#">
								<i class="fa fa-credit-card text-aqua"></i> <span>SPD Online</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-bank text-aqua"></i> <span>Sistem Penggajian</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a href="{{ url('karyawan') }}">Penerima Gaji</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a href="{{ url('pinjaman') }}">Pinjaman</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a href="{{ url('gaji') }}">Laporan Gaji</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a href="{{ url('gajisetting') }}">Setting</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a href="{{ url('espete') }}">SPT Tahunan</a></li>
							</ul>
						</li>
						<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
					</ul>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-yellow"></i> <span>3. Beasiswa</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="{{ url('databeasiswa') }}"><i class="fa fa-address-card"></i> Database Beasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a href="{{ url('pencairanbeasiswa') }}">Beasiswa</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-building text-primary"></i> <span>4. Umum</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'simbhp' ? 'active' : '' }}"><a href="{{ url('simbhp') }}">Sistem Persediaan</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'jadwalsatpam' ? 'active' : '' }}"><a href="{{ url('jadwalsatpam') }}">Jadwal Satpam</a></li>
					</ul>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}">
					<a href="{{ url('adminplagiasi') }}">
					<i class="fa fa-line-chart text-yellow"></i> <span>5. Jurnal</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}">
					<a href="{{ url('ruangbaca') }}">
					<i class="fa fa-book text-yellow"></i> <span>6. Ruang Baca</span>
					</a>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-calendar-plus-o text-primary"></i> <span>7. CAMABA</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'camabas2' ? 'active' : '' }}"><a href="{{ url('camabas2') }}">Magister</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'camabas3' ? 'active' : '' }}"><a href="{{ url('camabas3') }}">Doktor</a></li>
					</ul>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}">
					<a href="{{ url('swakelola') }}">
					<i class="fa fa-building text-yellow"></i> <span>8. BPPM</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}">
					<a href="{{ url('lapkuisioner') }}">
					<i class="fa fa-pencil text-yellow"></i> <span>9. GJM</span>
					</a>
				</li>
			@else
				<li class="treeview">
					<a href="#">
						<i class="fa fa-bank text-yellow"></i> <span>Administrasi</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">Master Program Studi</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'settingpejabat' ? 'active' : '' }}"><a href="{{ url('settingpejabat') }}">Setting Pejabat</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
					</ul>
				</li>
			@endif
		@endif
		@if(Session('spesial') == 'Admin Bantuan Studi')
			<li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Bantuan Studi dan Publikasi</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a href="{{ url('daftarbantuanadmin') }}">Pendaftaran Baru</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadmin' ? 'active' : '' }}"><a href="{{ url('bantuanadmin') }}">Admin Bantuan</a></li>
			  </ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}">
				<a href="{{ url('bantuanadminriset') }}">
				<i class="fa fa-mortar-board text-yellow"></i> 
					<span>Penerima Dana Riset dan PKM</span>
				</a>
			</li>
		@endif
		@if(Session('spesial') == 'Admin Bantuan Publikasi')
			<li class="{{ isset($sidebar) && $sidebar == 'bantuan' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Bantuan Publikasi</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a href="{{ url('daftarbantuanadmin') }}">Pendaftaran Baru</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadminpublikasi' ? 'active' : '' }}"><a href="{{ url('bantuanadminpublikasi') }}">Admin Bantuan</a></li>
			  </ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}">
				<a href="{{ url('bantuanadminriset') }}">
				<i class="fa fa-mortar-board text-yellow"></i> 
					<span>Penerima Dana Riset dan PKM</span>
				</a>
			</li>
		@endif
		@if(Session('spesial') == 'Admin Peminjaman')
			<li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-calendar-plus-o text-primary"></i> <span>Manaj.Aset <i class="fa fa-building"></i> dan <i class="fa fa-taxi"></i></span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Master Gedung dan Ruang</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'kendaraan' ? 'active' : '' }}"><a href="{{ url('kendaraan') }}">Master Kendaraan</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'jadwal' ? 'active' : '' }}"><a href="{{ url('jadwal') }}">SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</a></li>
			  </ul>
			</li>
		@else
			<li class="{{ isset($sidebar) && $sidebar == 'simpen' ? 'active' : '' }}">
				<a href="{{ url('simpen') }}">
				<i class="fa fa-building text-primary"></i> <span> SIMPEN (Sistem Informasi Peminjaman Ruang, Gedung dan Kendaraan)</span>
				</a>
			</li>
		@endif
		@if(Session('spesial') == 'Admin SPD')
			<li class="{{ isset($sidebar) && $sidebar == 'simsppd' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-calendar-plus-o text-aqua"></i> <span>SI PD</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
			  </ul>
			</li>
		@endif
		@if(Session('spesial') == 'Admin SK')
			<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}">
				<a href="{{ url('outperaturan') }}">
				<i class="fa fa-book text-warning"></i> <span>Peraturan dan Keputusan</span>
				</a>
			</li>
			@if (Session('fakultas') == 'KP')
				<li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}">
					<a href="{{ url('bantuanadminriset') }}">
					<i class="fa fa-mortar-board text-yellow"></i> 
						<span>Penerima Dana Riset dan PKM</span>
					</a>
				</li>
			@endif
			<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
		@endif
		@if(Session('spesial') == 'Admin HTL')
			<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}">
				<a href="{{ url('outperaturan') }}">
				<i class="fa fa-book text-warning"></i> <span>Peraturan dan Keputusan</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'bantuanadminriset' ? 'active' : '' }}">
				<a href="{{ url('bantuanadminriset') }}">
				<i class="fa fa-mortar-board text-yellow"></i> 
					<span>Penerima Dana Riset dan PKM</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
			<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}"><a href="{{ url('dashboardagendaris') }}">Penomoran Surat</a></li>
		@endif
		@if(Session('spesial') == 'Admin Ecek')
			<li class="{{ isset($sidebar) && $sidebar == 'ecek' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-credit-card text-danger"></i> E-Cek</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'ecekadmin' ? 'active' : '' }}"><a href="{{ url('ecekadmin') }}">E-Cek Admin</a></li>
			  </ul>
			</li>
		@endif
		@if(Session('spesial') == 'Bendahara Gaji')
			@if (Session('fakultas') == 'FIKES')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
							<a href="#">
								<i class="fa fa-bank text-yellow"></i> <span>Pelayanan</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="treeview"> <!-- Keuangan -->
									<a href="#">
										<i class="fa fa-money text-aqua"></i> <span>Keuangan</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="treeview">
											<a href="#">
												<i class="fa fa-credit-card text-aqua"></i> <span>SPD Online</span>
												<span class="pull-right-container">
												<i class="fa fa-angle-left pull-right"></i>
												</span>
											</a>
											<ul class="treeview-menu">
												<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
											</ul>
										</li>
										<li class="treeview">
											<a href="#">
												<i class="fa fa-bank text-aqua"></i> <span>Sistem Penggajian</span>
												<span class="pull-right-container">
												<i class="fa fa-angle-left pull-right"></i>
												</span>
											</a>
											<ul class="treeview-menu">
												<li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a href="{{ url('karyawan') }}">Penerima Gaji</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a href="{{ url('pinjaman') }}">Pinjaman</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a href="{{ url('gaji') }}">Laporan Gaji</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a href="{{ url('gajisetting') }}">Setting</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a href="{{ url('espete') }}">SPT Tahunan</a></li>
											</ul>
										</li>
										<li class="treeview">
											<a href="#">
												<i class="fa fa-bank text-aqua"></i> <span>PAGU</span>
												<span class="pull-right-container">
												<i class="fa fa-angle-left pull-right"></i>
												</span>
											</a>
											<ul class="treeview-menu">
												<li class="{{ isset($sidebar) && $sidebar == 'pagu' ? 'active' : '' }}"><a href="{{ url('pagu') }}">Set Pagu</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'pagugu' ? 'active' : '' }}"><a href="{{ url('pagugu') }}">Set Pagu GU</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'belanja' ? 'active' : '' }}"><a href="{{ url('belanja') }}">Perbelanjaan Pagu</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'belanjanonpagu' ? 'active' : '' }}"><a href="{{ url('belanjanonpagu') }}">Perbelanjaan Non Pagu</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'belanjapagugu' ? 'active' : '' }}"><a href="{{ url('belanjapagugu') }}">Perbelanjaan Pagu GU</a></li>
												<li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}"><a href="{{ url('laporankeuhpt') }}">Report</a></li>
											</ul>
										</li>
										<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen Pengampu</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'lemburtendik' ? 'active' : '' }}"><a href="{{ url('lemburtendik') }}">Lembur Tendik</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Swakelola</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
							</ul>
						</li>
						<li class="{{ isset($sidebar) && $sidebar == 'arsipsubstantif' ? 'active' : '' }} treeview">
							<a href="#">
								<i class="fa fa-paper-plane-o text-info"></i> <span>Arsip Dinamis</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
								<li class="treeview">
									<a href="#">
									<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Substantif</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a href="{{ url('arsipsubaktif') }}">Aktif</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
										
									</ul>
								</li>
								<li class="treeview">
									<a href="#">
									<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Fasilitatif</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a href="{{ url('arsipfasaktif') }}">Aktif</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
									</ul>
								</li>
								<li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a href="{{ url('arsippermanen') }}">Permanen</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a href="{{ url('arsipmusnah') }}">Musnah</a></li>
							</ul>
						</li>
						<li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}">
							<a href="{{ url('antritte') }}">
							<i class="fa fa-dashboard text-success"></i> <span>TTE Report</span>
								@if(isset($countantritte))
									@if($countantritte != 0)
										<small class="label pull-right bg-green">{{ $countantritte }}</small>
									@endif
								@endif
							</a>
						</li>
					</ul>
				</li>
			@else
				<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}">
					<a href="{{ url('dosenpenguji') }}">
					<i class="fa fa-book text-warning"></i> <span> HR Dosen Penguji</span>
					</a>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'simsppd' ? 'active' : '' }} treeview">
				<a href="#">
					<i class="fa fa-calendar-plus-o text-aqua"></i> <span>SI PD</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'sppdadmin' ? 'active' : '' }}"><a href="{{ url('sppdadmin') }}">Admin SPD</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'sppdkegiatan' ? 'active' : '' }}"><a href="{{ url('sppdkegiatan') }}">Kegiatan PD</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'sppdsetting' ? 'active' : '' }}"><a href="{{ url('sppdsetting') }}">Setting</a></li>
				</ul>
				</li>
				<li class="treeview">
				<a href="#">
					<i class="fa fa-calculator text-warning"></i> <span>SIGAP</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'karyawan' ? 'active' : '' }}"><a href="{{ url('karyawan') }}">Penerima Gaji</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'pinjaman' ? 'active' : '' }}"><a href="{{ url('pinjaman') }}">Pinjaman</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'gaji' ? 'active' : '' }}"><a href="{{ url('gaji') }}">Laporan Gaji</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'gajisetting' ? 'active' : '' }}"><a href="{{ url('gajisetting') }}">Setting</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'espete' ? 'active' : '' }}"><a href="{{ url('espete') }}">SPT Tahunan</a></li>
				</ul>
				</li>
			@endif
			<li class="{{ isset($sidebar) && $sidebar == 'ujiandinas' ? 'active' : '' }}">
				<a href="{{ url('ujiandinas') }}">
				<i class="fa fa-pencil text-success"></i> 
					<span>UJIAN</span>
				</a>
			</li>
		@else
			<li class="{{ isset($sidebar) && $sidebar == 'gajiuser' ? 'active' : '' }}">
				<a href="{{ url('gajiuser') }}">
				<i class="fa fa-money text-danger"></i> 
					<span>SIGAP</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'ujiandinas' ? 'active' : '' }}">
				<a href="{{ url('ujiandinas') }}">
				<i class="fa fa-pencil text-success"></i> 
					<span>UJIAN</span>
				</a>
			</li>
		@endif
		@if(Session('spesial') == 'Bendahara Jurusan')
			<li class="{{ isset($sidebar) && $sidebar == 'datakeuhptmasuk' ? 'active' : '' }}">
				<a href="{{ url('datakeuhptmasuk') }}">
				<i class="fa fa-line-chart text-yellow"></i> <span>Data Masuk</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'laporankeuhpt' ? 'active' : '' }}">
				<a href="{{ url('laporankeuhpt') }}">
				<i class="fa fa-line-chart text-yellow"></i> <span>Laporan</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'settingkeuhpt' ? 'active' : '' }}">
				<a href="{{ url('settingkeuhpt') }}">
				<i class="fa fa-line-chart text-yellow"></i> <span>Setting</span>
				</a>
			</li>
		@endif
		@if(Session('spesial') == 'Admin DISTENDIK')
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-users text-aqua"></i> <span>SI DIKTENDIK</span>
				@if(isset($countsidokar))
					@if($countsidokar != 0)
						<small class="label bg-aqua"> {{ $countsidokar }}</small>
					@endif
				@endif
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }}"><a href="{{ url('dashboarddokar') }}">Dashboard</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
				@if(Session('fakultas') == 'KP')
					<li class="{{ isset($sidebar) && $sidebar == 'verifikatorkgb' ? 'active' : '' }}">
						<a href="{{ url('verifikatorkgb') }}">
							Verifikasi KGB
							@if(isset($countsidokar))
								@if($countsidokar != 0)
									<small class="label bg-aqua pull-right"> {{ $countsidokar }}</small>
								@endif
							@endif
						</a>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'draftremunerasi' ? 'active' : '' }}"><a href="{{ url('draftremunerasi') }}">Draft Remunerasi</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'draftpangkat' ? 'active' : '' }}"><a href="{{ url('draftpangkat') }}">Draft Kenaikan Pangkat</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'drafttubel' ? 'active' : '' }}"><a href="{{ url('drafttubel') }}">Draft Tugas/Ijin Belajar DOSEN</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'drafttubeltendik' ? 'active' : '' }}"><a href="{{ url('drafttubeltendik') }}">Draft Tugas/Ijin Belajar TENDIK</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'draftjabakad' ? 'active' : '' }}"><a href="{{ url('draftjabakad') }}">Jabatan Akademik Dosen</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'draftpemberhentian' ? 'active' : '' }}"><a href="{{ url('draftpemberhentian') }}">Pemberhentian Tetap Non PNS</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'pengangkatanpns' ? 'active' : '' }}"><a href="{{ url('pengangkatanpns') }}">Pengangkatan PNS</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'jabatanpelaksana' ? 'active' : '' }}"><a href="{{ url('jabatanpelaksana') }}">Penetapan Jabatan Pelaksana</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'draftpenempatan' ? 'active' : '' }}"><a href="{{ url('draftpenempatan') }}">Draft Penempatan Pegawai</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'inpassinggaji' ? 'active' : '' }}"><a href="{{ url('inpassinggaji') }}">Draft SK Penyesuain Gaji</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'skkontrak' ? 'active' : '' }}"><a href="{{ url('skkontrak') }}">Draft SK Kontrak Pegawai</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'udin' ? 'active' : '' }}"><a href="{{ url('udin') }}">Ujian Dinas</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'latsaradmin' ? 'active' : '' }}"><a href="{{ url('latsaradmin') }}">LATSAR</a></li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-calendar-plus-o text-info"></i> <span>Berkas PAK</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">Usul Penilaian Angka Kredit Kenaikan Jabatan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">SK Tunjangan Fungsional Dosen</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">SK Pengangkatan Pertama kali dalam Jabatan Akademik</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">SURAT PERNYATAAN MELAKSANAKAN TUGAS</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">Pengantar dari Fakultas ke KP</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">Pengantar Revisi Usulan/Pengembalian/Penolakan ke Fakultas</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">Nota Dinas Usul Pertimbangan / Persetujuan Senat</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">Permintaan Kuisioner (Dari Senat)</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">DUPAK</a></li>
						</ul>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'dokarsetting' ? 'active' : '' }}"><a href="{{ url('dokarsetting') }}">Setting</a></li>
				@endif
					<li class="{{ isset($sidebar) && $sidebar == 'bpjsadmin' ? 'active' : '' }}"><a href="{{ url('bpjsadmin') }}">Data BPJS</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}"><a href="{{ url('user') }}">Setting Pejabat</a></li>
			  </ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}">
				<a href="{{ url('simpukjaverifikasi') }}">
					<i class="fa fa-search text-primary"></i> <span>SIMPRO-PAK</span>
					@if(isset($countsimpro))
						@if($countsimpro != 0)
							<small class="label bg-aqua"> {{ $countsimpro }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }}">
				<a href="{{ url('verfikasicuti') }}/all">
					<i class="fa fa-users text-warning"></i> <span>Cuti Pegawai</span>
					@if(isset($countcuti))
						@if($countcuti != 0)
							<small class="label bg-aqua"> {{ $countcuti }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'listsurattugas' ? 'active' : '' }}">
				<a href="{{ url('listsurattugas') }}">
					<i class="fa fa-users text-warning"></i> <span>Management Surat Tugas</span>
				</a>
			</li>
		@endif
		@if(Session('spesial') == 'Admin SIDOKAR')
			<li class="{{ isset($sidebar) && $sidebar == 'dashboardagendaris' ? 'active' : '' }}">
				<a href="{{ url('dashboardagendaris') }}">
				<i class="fa fa-dashboard"></i> <span>Permohonan Nomor Mundur</span>
				</a>
			</li>
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-users text-aqua"></i> <span>SI DIKTENDIK</span>
				@if(isset($countsidokar))
					@if($countsidokar != 0)
						<small class="label bg-aqua"> {{ $countsidokar }}</small>
					@endif
				@endif
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'dashboarddokar' ? 'active' : '' }}"><a href="{{ url('dashboarddokar') }}">Dashboard</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'outperaturan' ? 'active' : '' }}"><a href="{{ url('outperaturan') }}">Peraturan dan Keputusan</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'ewsub' ? 'active' : '' }}"><a href="{{ url('ewsub') }}">Direktori Pejabat</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'daftarbantuanadmin' ? 'active' : '' }}"><a href="{{ url('daftarbantuanadmin') }}">Data Dosen Tugas / Ijin Belajar</a></li>
				@if(Session('fakultas') == 'KP')
					<li class="{{ isset($sidebar) && $sidebar == 'verifikatorkgb' ? 'active' : '' }}">
						<a href="{{ url('verifikatorkgb') }}">
							Verifikasi KGB
							@if(isset($countsidokar))
								@if($countsidokar != 0)
									<small class="label bg-aqua pull-right"> {{ $countsidokar }}</small>
								@endif
							@endif
						</a>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'draftremunerasi' ? 'active' : '' }}"><a href="{{ url('draftremunerasi') }}">Draft Remunerasi</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'draftpangkat' ? 'active' : '' }}"><a href="{{ url('draftpangkat') }}">Draft Kenaikan Pangkat</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'drafttubel' ? 'active' : '' }}"><a href="{{ url('drafttubel') }}">Draft Tugas/Ijin Belajar DOSEN</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'drafttubeltendik' ? 'active' : '' }}"><a href="{{ url('drafttubeltendik') }}">Draft Tugas/Ijin Belajar TENDIK</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'draftjabakad' ? 'active' : '' }}"><a href="{{ url('draftjabakad') }}">Jabatan Akademik Dosen</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'draftpemberhentian' ? 'active' : '' }}"><a href="{{ url('draftpemberhentian') }}">Pemberhentian Tetap Non PNS</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'pengangkatanpns' ? 'active' : '' }}"><a href="{{ url('pengangkatanpns') }}">Pengangkatan PNS</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'jabatanpelaksana' ? 'active' : '' }}"><a href="{{ url('jabatanpelaksana') }}">Penetapan Jabatan Pelaksana</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'draftpenempatan' ? 'active' : '' }}"><a href="{{ url('draftpenempatan') }}">Draft Penempatan Pegawai</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'inpassinggaji' ? 'active' : '' }}"><a href="{{ url('inpassinggaji') }}">Draft SK Penyesuain Gaji</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'skkontrak' ? 'active' : '' }}"><a href="{{ url('skkontrak') }}">Draft SK Kontrak Pegawai</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'udin' ? 'active' : '' }}"><a href="{{ url('udin') }}">Ujian Dinas</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'latsaradmin' ? 'active' : '' }}"><a href="{{ url('latsaradmin') }}">LATSAR</a></li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-calendar-plus-o text-info"></i> <span>Berkas PAK</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">Usul Penilaian Angka Kredit Kenaikan Jabatan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">SK Tunjangan Fungsional Dosen</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">SK Pengangkatan Pertama kali dalam Jabatan Akademik</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">SURAT PERNYATAAN MELAKSANAKAN TUGAS</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">Pengantar dari Fakultas ke KP</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">Pengantar Revisi Usulan/Pengembalian/Penolakan ke Fakultas</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">Nota Dinas Usul Pertimbangan / Persetujuan Senat</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">Permintaan Kuisioner (Dari Senat)</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'berkaspak' ? 'active' : '' }}"><a href="{{ url('berkaspak') }}">DUPAK</a></li>
						</ul>
					</li>
					<li class="{{ isset($sidebar) && $sidebar == 'dokarsetting' ? 'active' : '' }}"><a href="{{ url('dokarsetting') }}">Setting</a></li>
				@endif
					<li class="{{ isset($sidebar) && $sidebar == 'bpjsadmin' ? 'active' : '' }}"><a href="{{ url('bpjsadmin') }}">Data BPJS</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'user' ? 'active' : '' }}"><a href="{{ url('user') }}">Setting Pejabat</a></li>
			  </ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'simpukjaverifikasi' ? 'active' : '' }}">
				<a href="{{ url('simpukjaverifikasi') }}">
					<i class="fa fa-search text-primary"></i> <span>SIMPRO-PAK</span>
					@if(isset($countsimpro))
						@if($countsimpro != 0)
							<small class="label bg-aqua"> {{ $countsimpro }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'cuti' ? 'active' : '' }}">
				<a href="{{ url('verfikasicuti') }}/all">
					<i class="fa fa-users text-warning"></i> <span>Cuti Pegawai</span>
					@if(isset($countcuti))
						@if($countcuti != 0)
							<small class="label bg-aqua"> {{ $countcuti }}</small>
						@endif
					@endif
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'listsurattugas' ? 'active' : '' }}">
				<a href="{{ url('listsurattugas') }}">
					<i class="fa fa-users text-warning"></i> <span>Management Surat Tugas</span>
				</a>
			</li>
		@endif
		@if(Session('spesial') == 'Admin SIMPRO-SENAT')
			<li class="{{ isset($sidebar) && $sidebar == 'simprosenat' ? 'active' : '' }}">
				<a href="{{ url('simprosenat') }}">
					<i class="fa fa-search text-primary"></i> <span>SIMPRO-PAK</span>
					@if(isset($countsimprosenat))
						@if($countsimprosenat != 0)
							<small class="label bg-aqua"> {{ $countsimprosenat }}</small>
						@endif
					@endif
				</a>
			</li>
		@endif
		@if(Session('spesial') == 'Operator Prodi S1')
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cubes text-yellow"></i> <span>Administrasi dan Persuratan</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">Setting Prodi</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a href="{{ url('dosenpenguji') }}">HR Dosen Penguji</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
				<i class="fa fa-briefcase text-yellow"></i> <span>Magang</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cubes text-yellow"></i> <span>Tahapan Prodi S1</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Judul</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Proposal</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
				</ul>
			</li>
		@endif
		@if(Session('spesial') == 'Operator Prodi S2')
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cubes text-yellow"></i> <span>Administrasi dan Persuratan</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">Setting Prodi</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a href="{{ url('dosenpenguji') }}">HR Dosen Penguji</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cubes text-yellow"></i> <span>Tahapan Prodi S2</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Judul</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Proposal</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
				</ul>
			</li>
		@endif
		@if(Session('spesial') == 'Operator Prodi S3')
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cubes text-yellow"></i> <span>Administrasi dan Persuratan</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">Setting Prodi</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a href="{{ url('dosenpenguji') }}">HR Dosen Penguji</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cubes text-yellow"></i> <span>Tahapan Prodi S3</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Proposal</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
				</ul>
			</li>
		@endif
		@if(Session('spesial') == 'Pramu Kelas')
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cubes text-yellow"></i> <span>Jadwal Perkuliahan</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">Jadwal Mahasiswa</a></li>
				</ul>
			</li>
		@endif
		@if(Session('spesial') == 'Admin Akademik')
			<li class="treeview">
				<a href="#">
					<i class="fa fa-buysellads text-yellow"></i> <span>Jadwal Kuliah</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="treeview">
						<a href="#">
						<i class="fa fa-calendar-plus-o text-info"></i> <span>Setting</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Ruang</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a href="{{ url('settingjadwal') }}">Setting</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-calendar-plus-o text-info"></i> <span>Penjadwalan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a href="{{ url('vjadharian') }}">View Harian</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Ujian</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
						</ul>
					</li>
				</ul>
			</li>
			@if(Session('fakultas') == 'FMIPA')
				<li class="treeview">
					<a href="#">
						<i class="fa fa-cubes text-yellow"></i> <span>Pelayanan (SEMUA JURUSAN)</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Magang</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Sarjana/Magister</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Judul</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Doktor</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="treeview">
									<a href="#">
									<i class="fa fa-briefcase text-yellow"></i> <span>Jurusan Biologi</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Internasional</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
									</ul>
								</li>
								<li class="treeview">
									<a href="#">
									<i class="fa fa-briefcase text-yellow"></i> <span>Jurusan Matematika</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
										<li><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
										<li><a href="{{ url('s3sidangkomisi') }}">Proposal Disertasi</a></li>
										<li><a href="{{ url('s3seminter') }}">Seminar Ilmiah Internasional</a></li>
										<li><a href="{{ url('s3sidangkomhas') }}">Pelaksanaan Penelitian dan Penulisan Disertasi I</a></li>
										<li><a href="{{ url('s3publikasi') }}">Publikasi Internasional</a></li>
										<li><a href="{{ url('s3ujianevaluasi') }}">Pelaksanaan Penelitian dan Penulisan Disertasi II</a></li>
										<li><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
										<li><a href="{{ url('s3kompengesahan') }}">Pelaksanaan Penelitian dan Penulisan Disertasi III</a></li>
										<li><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
										<li><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
										<li><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
										<li><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
										<li><a href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
										<li><a href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
									</ul>
								</li>
								<li class="treeview">
									<a href="#">
									<i class="fa fa-briefcase text-yellow"></i> <span>ALL Jurusan</span>
										<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Proposal</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
										<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA MAGISTER</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2biologi' ? 'active' : '' }}"><a href="{{ url('camabas2biologi') }}"> Biologi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2fisika' ? 'active' : '' }}"><a href="{{ url('camabas2fisika') }}"> Fisika</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2matematika' ? 'active' : '' }}"><a href="{{ url('camabas2matematika') }}"> Matematika</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2kimia' ? 'active' : '' }}"><a href="{{ url('camabas2kimia') }}"> Kimia</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2statistika' ? 'active' : '' }}"><a href="{{ url('camabas2statistika') }}"> Statistika</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA DOKTOR</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3biologi' ? 'active' : '' }}"><a href="{{ url('camabas3biologi') }}">Biologi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3fisika' ? 'active' : '' }}"><a href="{{ url('camabas3fisika') }}">Fisika</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3matematika' ? 'active' : '' }}"><a href="{{ url('camabas3matematika') }}">Matematika</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3kimia' ? 'active' : '' }}"><a href="{{ url('camabas3kimia') }}">Kimia</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3statistika' ? 'active' : '' }}"><a href="{{ url('camabas3statistika') }}">Statistika</a></li>
							</ul>
						</li>
					</ul>
				</li>
			@else 
				<li class="treeview">
					<a href="#">
						<i class="fa fa-cubes text-yellow"></i> <span>Administrasi dan Persuratan</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">Setting Prodi</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a href="{{ url('dosenpenguji') }}">HR Dosen Penguji</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-cubes text-yellow"></i> <span>Pelayanan JURUSAN</span>
						<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Magang</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Sarjana/Magister</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Judul</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Doktor</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
					</ul>
				</li>
			@endif
		@endif
		@if(Session('spesial') == 'Admin Kemahasiswaan')
			<li class="treeview">
				<a href="#">
					<i class="fa fa-calendar-plus-o text-yellow"></i> <span>Kemahasiswaan</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a href="{{ url('datakegiatan') }}">E-LPJ</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a href="{{ url('datapkm') }}">Laporan PKM</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
				</ul>
			</li>
		@endif
		@if(Session('spesial') == 'Admin AkaddanKmh')
			<li class="treeview">
				<a href="#">
					<i class="fa fa-gears text-primary"></i> <span>SIFAKULTAS</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'sifak' ? 'active' : '' }} treeview">
						<a href="#">
							<i class="fa fa-bank text-yellow"></i> <span>Pelayanan</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="treeview"> <!--Akademik-->
								<a href="#">
									<i class="fa fa-buysellads text-yellow"></i> <span>Akademik dan Kemahasiswaan</span>
									<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li class="{{ isset($sidebar) && $sidebar == 'ruangbaca' ? 'active' : '' }}">
										<a href="{{ url('ruangbaca') }}">
										<i class="fa fa-book text-yellow"></i> <span>Ruang Baca</span>
										</a>
									</li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Kuliah</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="treeview">
												<a href="#">
												<i class="fa fa-calendar-plus-o text-info"></i> <span>Setting</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'matakuliah' ? 'active' : '' }}"><a href="{{ url('matakuliah') }}">Master Matakuliah</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'settingjadwal' ? 'active' : '' }}"><a href="{{ url('settingjadwal') }}">Setting Jadwal</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
												<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Kuliah</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'jadwalsiakad' ? 'active' : '' }}"><a href="{{ url('jadwalsiakad') }}">Export SIAKAD</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'vjadharian' ? 'active' : '' }}"><a href="{{ url('vjadharian') }}">View Harian</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'vjadangkatan' ? 'active' : '' }}"><a href="{{ url('vjadangkatan') }}">View Per Angkatan</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'vjaddosen' ? 'active' : '' }}"><a href="{{ url('vjaddosen') }}">View Per Dosen</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'vjadmatakuliah' ? 'active' : '' }}"><a href="{{ url('vjadmatakuliah') }}">View Per Matakuliah</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'presensidosen' ? 'active' : '' }}"><a href="{{ url('presensidosen') }}">Presensi Dosen</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
												<i class="fa fa-calendar-plus-o text-info"></i> <span>Jadwal Ujian</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwalujian' ? 'active' : '' }}"><a href="{{ url('plotingjadwalujian') }}">Jadwal Ujian</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'presensipengawas' ? 'active' : '' }}"><a href="{{ url('presensipengawas') }}">Presensi Pengawas</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Pelayanan Mahasiswa</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Persuratan</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Laporan Prestasi Mhs</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Laporan Tracestudy</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'datakegiatan' ? 'active' : '' }}"><a href="{{ url('datakegiatan') }}">E-LPJ</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'datapkm' ? 'active' : '' }}"><a href="{{ url('datapkm') }}">Laporan PKM</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Laporan Beasiswa</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'pencairanbeasiswa' ? 'active' : '' }}"><a href="{{ url('pencairanbeasiswa') }}">Pencairan Beasiswa</a></li>
											<li class="{{ isset($sidebar) && $sidebar == 'transkripnonakademik' ? 'active' : '' }}"><a href="{{ url('transkripnonakademik') }}">Transkrip Non Akademik</a></li>
										</ul>
									</li>
									<li class="treeview">
										<a href="#">
										<i class="fa fa-calendar-plus-o text-info"></i> <span>Pelayanan Prodi</span>
											<span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
											</span>
										</a>
										<ul class="treeview-menu">
											<li class="treeview">
												<a href="#">
												<i class="fa fa-briefcase text-green"></i> <span>Magang</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
												</ul>
											</li>
											<li class="treeview">
												<a href="#">
												<i class="fa fa-briefcase text-green"></i> <span>Diploma/Sarjana/Magister/Profesi</span>
													<span class="pull-right-container">
													<i class="fa fa-angle-left pull-right"></i>
													</span>
												</a>
												<ul class="treeview-menu">
													<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Komisi Pembimbing</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Seminar Proposal</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
													<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
												</ul>
											</li>
											@if(Session('fakultas') == 'FMIPA')
												<li class="treeview">
													<a href="#">
													<i class="fa fa-briefcase text-yellow"></i> <span>Doktor</span>
														<span class="pull-right-container">
														<i class="fa fa-angle-left pull-right"></i>
														</span>
													</a>
													<ul class="treeview-menu">
														<li class="treeview">
															<a href="#">
															<i class="fa fa-briefcase text-yellow"></i> <span>Jurusan Biologi</span>
																<span class="pull-right-container">
																<i class="fa fa-angle-left pull-right"></i>
																</span>
															</a>
															<ul class="treeview-menu">
																<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Internasional</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
															</ul>
														</li>
														<li class="treeview">
															<a href="#">
															<i class="fa fa-briefcase text-yellow"></i> <span>Jurusan Matematika</span>
																<span class="pull-right-container">
																<i class="fa fa-angle-left pull-right"></i>
																</span>
															</a>
															<ul class="treeview-menu">
																<li><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
																<li><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
																<li><a href="{{ url('s3sidangkomisi') }}">Proposal Disertasi</a></li>
																<li><a href="{{ url('s3seminter') }}">Seminar Ilmiah Internasional</a></li>
																<li><a href="{{ url('s3sidangkomhas') }}">Pelaksanaan Penelitian dan Penulisan Disertasi I</a></li>
																<li><a href="{{ url('s3publikasi') }}">Publikasi Internasional</a></li>
																<li><a href="{{ url('s3ujianevaluasi') }}">Pelaksanaan Penelitian dan Penulisan Disertasi II</a></li>
																<li><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
																<li><a href="{{ url('s3kompengesahan') }}">Pelaksanaan Penelitian dan Penulisan Disertasi III</a></li>
																<li><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
																<li><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
																<li><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
																<li><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
																<li><a href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
																<li><a href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
															</ul>
														</li>
														<li class="treeview">
															<a href="#">
															<i class="fa fa-briefcase text-yellow"></i> <span>ALL Jurusan</span>
																<span class="pull-right-container">
																<i class="fa fa-angle-left pull-right"></i>
																</span>
															</a>
															<ul class="treeview-menu">
																<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Proposal</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
																<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
															</ul>
														</li>
													</ul>
												</li>
											@else
												<li class="treeview">
													<a href="#">
													<i class="fa fa-briefcase text-green"></i> <span>Doktor</span>
														<span class="pull-right-container">
														<i class="fa fa-angle-left pull-right"></i>
														</span>
													</a>
													<ul class="treeview-menu">
														<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
														<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
														<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal Disertasi</a></li>
														<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal Disertasi</a></li>
														<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
														<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
														<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
														<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
														<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
													</ul>
												</li>
											@endif
										</ul>
									</li>
								</ul>
							</li>
							<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}">
								<a href="{{ url('pengumuman') }}">
								<i class="fa fa-bullhorn text-yellow"></i> <span>Pengumuman ke Mahasiswa</span>
								</a>
							</li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-trophy text-primary"></i> <span>Data Tambahan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'dataprestasi' ? 'active' : '' }}"><a href="{{ url('dataprestasi') }}">Data Prestasi</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'faspendukung' ? 'active' : '' }}"><a href="{{ url('faspendukung') }}">Fasilitas Pendukung Penelitian</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'datatracerstudy' ? 'active' : '' }}"><a href="{{ url('datatracerstudy') }}">Tracestudy</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'penelitiasing' ? 'active' : '' }}"><a href="{{ url('penelitiasing') }}">Peneliti Asing</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'unitbisnis' ? 'active' : '' }}"><a href="{{ url('unitbisnis') }}">Unit Bisnis Hasil Riset</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'databeasiswa' ? 'active' : '' }}"><a href="{{ url('databeasiswa') }}">Data Beasiswa</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'keucontrol' ? 'active' : '' }}"><a href="{{ url('keucontrol') }}">Data Keuangan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'swakelola' ? 'active' : '' }}"><a href="{{ url('swakelola') }}">Swakelola</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-area-chart text-success"></i> <span>Report (Under Construction)</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Detail Mahasiswa</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'lapkuisioner' ? 'active' : '' }}"><a href="{{ url('lapkuisioner') }}">Laporan Kuisioner</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'datakeluhan' ? 'active' : '' }}"><a href="{{ url('datakeluhan') }}">E-Complain</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori12' ? 'active' : '' }}"><a href="{{ url('kategori12') }}">1 - 2 Penjaminan Mutu dan Kerjasama</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori3' ? 'active' : '' }}"><a href="{{ url('kategori3') }}">3. Mahasiswa</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori4' ? 'active' : '' }}"><a href="{{ url('kategori4') }}">4. Sumberdaya Manusia</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori5' ? 'active' : '' }}"><a href="{{ url('kategori5') }}">5. Keungan, Sarana dan Prasarana</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori6' ? 'active' : '' }}"><a href="{{ url('kategori6') }}">6. Pendidikan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori7' ? 'active' : '' }}"><a href="{{ url('kategori7') }}">7. Penelitian</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori8' ? 'active' : '' }}"><a href="{{ url('kategori8') }}">8. Pengabdian Kepada Masyarakat</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'kategori9' ? 'active' : '' }}"><a href="{{ url('kategori9') }}">9. Luaran dan Capaian TRIDHARMA</a></li>
						</ul>
					</li>
				</ul>
			</li>
		@endif
		@if(Session('spesial') == 'Admin Jurusan Biologi' OR Session('spesial') == 'Admin Jurusan Fisika' OR Session('spesial') == 'Admin Jurusan Matematika' OR Session('spesial') == 'Admin Jurusan Kimia' OR Session('spesial') == 'Admin Jurusan Statistika')
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cubes text-yellow"></i> <span>Pelayanan Jurusan</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a href="{{ url('dosenpenguji') }}">HR Dosen Penguji</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'ruangan' ? 'active' : '' }}"><a href="{{ url('ruangan') }}">Setting Ruang Ujian</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'laptranskrip' ? 'active' : '' }}"><a href="{{ url('laptranskrip') }}">Laporan Transkrip</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-briefcase text-yellow"></i> <span>Magang</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-briefcase text-yellow"></i> <span>Sarjana/Magister</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Judul</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Proposal</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
						</ul>
					</li>
					@if(Session('spesial') == 'Admin Jurusan Biologi')
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Jurusan Biologi</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Pra Proposal 1</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Pra Proposal 2</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Proposal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Seminar Kemajuan I</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kemajuan2' ? 'active' : '' }}"><a href="{{ url('s3kemajuan2') }}">Seminar Kemajuan II</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Internasional</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Jurnal</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA </span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2biologi' ? 'active' : '' }}"><a href="{{ url('camabas2biologi') }}"> Magister</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3biologi' ? 'active' : '' }}"><a href="{{ url('camabas3biologi') }}"> Doktor</a></li>
							</ul>
						</li>
					@elseif(Session('spesial') == 'Admin Jurusan Fisika')
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Doktor</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Proposal Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA </span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2fisika' ? 'active' : '' }}"><a href="{{ url('camabas2fisika') }}"> Magister</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3fisika' ? 'active' : '' }}"><a href="{{ url('camabas3fisika') }}"> Doktor</a></li>
							</ul>
						</li>
					@elseif(Session('spesial') == 'Admin Jurusan Matematika')
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Doktor</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
								<li><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi Disertasi</a></li>
								<li><a href="{{ url('s3sidangkomisi') }}">Proposal Disertasi</a></li>
								<li><a href="{{ url('s3seminter') }}">Seminar Ilmiah Internasional</a></li>
								<li><a href="{{ url('s3sidangkomhas') }}">Pelaksanaan Penelitian dan Penulisan Disertasi I</a></li>
								<li><a href="{{ url('s3publikasi') }}">Publikasi Internasional</a></li>
								<li><a href="{{ url('s3ujianevaluasi') }}">Pelaksanaan Penelitian dan Penulisan Disertasi II</a></li>
								<li><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
								<li><a href="{{ url('s3kompengesahan') }}">Pelaksanaan Penelitian dan Penulisan Disertasi III</a></li>
								<li><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Disertasi</a></li>
								<li><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
								<li><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
								<li><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
								<li><a href="{{ url('formbebaspinjam') }}"> Form Bebas Pinjam</a></li>
								<li><a href="{{ url('formplagiasivokasi') }}"> Form Plagiasi</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA </span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2matematika' ? 'active' : '' }}"><a href="{{ url('camabas2matematika') }}"> Magister</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3matematika' ? 'active' : '' }}"><a href="{{ url('camabas3matematika') }}"> Doktor</a></li>
							</ul>
						</li>
					@elseif(Session('spesial') == 'Admin Jurusan Statistika')
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Doktor</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Proposal Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA </span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2statistika' ? 'active' : '' }}"><a href="{{ url('camabas2statistika') }}"> Magister</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3statistika' ? 'active' : '' }}"><a href="{{ url('camabas3statistika') }}"> Doktor</a></li>
							</ul>
						</li>
					@else
						<li class="treeview">
							<a href="#">
							<i class="fa fa-briefcase text-yellow"></i> <span>Doktor</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Seminar Proposal Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Seminar Kemajuan Studi dan Penelitian</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Penelitian Seminar Ilmiah Internasional</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Penilaian Publikasi Ilmiah</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Penilaian Penelitian Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil Penelitian Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Revisi Naskas Setelah SEMHAS</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Ujian Kelayakan Naskah Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi Hasil (Tanpa UAD)</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA </span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2kimia' ? 'active' : '' }}"><a href="{{ url('camabas2kimia') }}"> Magister</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3kimia' ? 'active' : '' }}"><a href="{{ url('camabas3kimia') }}"> Doktor</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</li>
		@endif
		@if(Session('spesial') == 'Admin Jurusan Sosial Ekonomi Pertanian' OR Session('spesial') == 'Admin Jurusan Budidaya Pertanian' OR Session('spesial') == 'Admin Jurusan Tanah' OR Session('spesial') == 'Admin Jurusan Hama dan Penyakit Tumbuhan' OR Session('spesial') == 'Admin Ilmu Pertanian')
			<li class="treeview">
				<a href="#">
					<i class="fa fa-buysellads text-yellow"></i> <span>Jadwal Kuliah</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="treeview">
						<a href="#">
						<i class="fa fa-calendar-plus-o text-info"></i> <span>Penjadwalan</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'plotingjadwal' ? 'active' : '' }}"><a href="{{ url('plotingjadwal') }}">Ploting Jadwal</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'jadwalkuliahmhs' ? 'active' : '' }}"><a href="{{ url('jadwalkuliahmhs') }}/{{Session('fakultas')}}">All View</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cubes text-yellow"></i> <span>Pelayanan Jurusan</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ isset($sidebar) && $sidebar == 'dosenpengampu' ? 'active' : '' }}"><a href="{{ url('dosenpengampu') }}">Master Dosen</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'pengumuman' ? 'active' : '' }}"><a href="{{ url('pengumuman') }}">Pengumuman</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'dosenpenguji' ? 'active' : '' }}"><a href="{{ url('dosenpenguji') }}">Dosen Penguji</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'ruangujian' ? 'active' : '' }}"><a href="{{ url('ruangujian') }}">Setting Ruang Ujian</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'akadcontrol' ? 'active' : '' }}"><a href="{{ url('akadcontrol') }}">Control Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'accountmanagement' ? 'active' : '' }}"><a href="{{ url('accountmanagement') }}">User Login Mahasiswa</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'surat' ? 'active' : '' }}"><a href="{{ url('surat') }}">Permohonan Surat Mhs</a></li>
					<li class="{{ isset($sidebar) && $sidebar == 'adminplagiasi' ? 'active' : '' }}"><a href="{{ url('adminplagiasi') }}">Pengantar Deteksi Plagiasi</a></li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-briefcase text-yellow"></i> <span>Magang</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'laporandmagang' ? 'active' : '' }}"><a href="{{ url('laporandmagang') }}">Pendaftaran Magang</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'lapujianmagang' ? 'active' : '' }}"><a href="{{ url('lapujianmagang') }}">Ujian Magang</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'penilaianmagang' ? 'active' : '' }}"><a href="{{ url('penilaianmagang') }}">Penilaian Magang</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-briefcase text-yellow"></i> <span>Sarjana/Magister</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 'judul' ? 'active' : '' }}"><a href="{{ url('judul') }}">Pengajuan Judul</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'sempro' ? 'active' : '' }}"><a href="{{ url('sempro') }}">Proposal</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'penelitiantesis' ? 'active' : '' }}"><a href="{{ url('penelitiantesis') }}">Pelaksanaan Penelitian Tesis</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'semhas' ? 'active' : '' }}"><a href="{{ url('semhas') }}">Seminar Hasil</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'penulisantesis' ? 'active' : '' }}"><a href="{{ url('penulisantesis') }}">Penulisan Tesis</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'publikasijurnal' ? 'active' : '' }}"><a href="{{ url('publikasijurnal') }}">Publikasi Tesis</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'ujian' ? 'active' : '' }}"><a href="{{ url('ujian') }}">Ujian Akhir</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Diseminasi</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 'yudisium' ? 'active' : '' }}"><a href="{{ url('yudisium') }}">Yudisium</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
						<i class="fa fa-briefcase text-yellow"></i> <span>Doktor</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ isset($sidebar) && $sidebar == 's3ujiankualifikasi' ? 'active' : '' }}"><a href="{{ url('s3ujiankualifikasi') }}">Ujian Kualifikasi</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3pengajuanpromotor' ? 'active' : '' }}"><a href="{{ url('s3pengajuanpromotor') }}">Pengajuan Tim Promotor</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomisi' ? 'active' : '' }}"><a href="{{ url('s3sidangkomisi') }}">Sidang Komisi Proposal</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3ujianevaluasi' ? 'active' : '' }}"><a href="{{ url('s3ujianevaluasi') }}">Ujian Evaluasi Proposal</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3sidangkomhas' ? 'active' : '' }}"><a href="{{ url('s3sidangkomhas') }}">Sidang Komisi Hasil</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3sempeng' ? 'active' : '' }}"><a href="{{ url('s3sempeng') }}">Seminar Pengajuan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3seminter' ? 'active' : '' }}"><a href="{{ url('s3seminter') }}">Seminar Internasional</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3publikasi' ? 'active' : '' }}"><a href="{{ url('s3publikasi') }}">Publikasi Ilmiah</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3semhas' ? 'active' : '' }}"><a href="{{ url('s3semhas') }}">Seminar Hasil</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3kelayakanuad' ? 'active' : '' }}"><a href="{{ url('s3kelayakanuad') }}">Kelayakan UAD</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3uad' ? 'active' : '' }}"><a href="{{ url('s3uad') }}">Ujian Akhir Disertasi</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3kompengesahan' ? 'active' : '' }}"><a href="{{ url('s3kompengesahan') }}">Komisi Pengesahan</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3yudisium' ? 'active' : '' }}"><a href="{{ url('s3yudisium') }}">Yudisium</a></li>
							<li class="{{ isset($sidebar) && $sidebar == 's3wisuda' ? 'active' : '' }}"><a href="{{ url('s3wisuda') }}">Wisuda</a></li>
						</ul>
					</li>
					@if(Session('spesial') == 'Admin Jurusan Sosial Ekonomi Pertanian')
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA </span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2se' ? 'active' : '' }}"><a href="{{ url('camabas2se') }}"> Magister</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3se' ? 'active' : '' }}"><a href="{{ url('camabas3se') }}"> Doktor</a></li>
							</ul>
						</li>
					@elseif(Session('spesial') == 'Admin Jurusan Budidaya Pertanian')
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA </span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2bp' ? 'active' : '' }}"><a href="{{ url('camabas2bp') }}"> Magister</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3bp' ? 'active' : '' }}"><a href="{{ url('camabas3bp') }}"> Doktor</a></li>
							</ul>
						</li>
					@elseif(Session('spesial') == 'Admin Jurusan Tanah')
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA </span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2tanah' ? 'active' : '' }}"><a href="{{ url('camabas2tanah') }}"> Magister</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3tanah' ? 'active' : '' }}"><a href="{{ url('camabas3tanah') }}"> Doktor</a></li>
							</ul>
						</li>
					@elseif(Session('spesial') == 'Admin Jurusan Hama dan Penyakit Tumbuhan')
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA </span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas2hpt' ? 'active' : '' }}"><a href="{{ url('camabas2hpt') }}"> Magister</a></li>
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3hpt' ? 'active' : '' }}"><a href="{{ url('camabas3hpt') }}"> Doktor</a></li>
							</ul>
						</li>
					@else
						<li class="treeview">
							<a href="#">
								<i class="fa fa-calendar-plus-o text-yellow"></i> <span>CAMABA </span>
								<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li class="{{ isset($sidebar) && $sidebar == 'camabas3pertanian' ? 'active' : '' }}"><a href="{{ url('camabas3pertanian') }}"> Doktor</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</li>
		@endif
		@if(Session('spesial') == 'esign')
			<li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}">
				<a href="{{ url('antritte') }}">
				<i class="fa fa-dashboard text-success"></i> <span>TTE Report</span>
					@if(isset($countantritte))
						@if($countantritte != 0)
							<small class="label pull-right bg-green">{{ $countantritte }}</small>
						@endif
					@endif
				</a>
			</li>
		@endif
		@if(Session('spesial') == 'Admin Hasil LAB Klinik UB')
			<li class="{{ isset($sidebar) && $sidebar == 'suratlabklinik' ? 'active' : '' }}">
				<a href="{{ url('suratlabklinik') }}">
				<i class="fa fa-flask text-success"></i> <span>Hasil LAB</span>
				</a>
			</li>
		@endif
		@if(Session('spesial') == 'Admin Akademik KP')
			<li class="{{ isset($sidebar) && $sidebar == 'suratakademikkp' ? 'active' : '' }}">
				<a href="{{ url('suratakademikkp') }}">
				<i class="fa fa-flask text-success"></i> <span>Terminal Kuliah</span>
				</a>
			</li>
		@endif
		@if(Session('idjabatan') == '64' OR Session('idjabatan') == '60' OR Session('spesial') == 'Arsiparis Umum' OR Session('previlage') == 'developer' OR Session('jabatan') == 'Subkoordinator Subbagian Tata Kelola Keorganisasian Elektronik' OR Session('previlage') == 'Arsiparis Umum' OR Session('previlage') == 'Sekretaris Ka.Biro Keuangan' OR Session('previlage') == 'Sekretaris Ka.Biro Umum dan Kepegawaian' OR Session('previlage') == 'Sekretaris Ka.Biro Akademik dan Kemahasiswaan' OR Session('previlage') == 'Sekretaris Bagian Akutansi' OR Session('previlage') == 'Sekretaris Senat UB' OR Session('previlage') == 'Sekretaris' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Akademik' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Umum dan Keuangan' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Kemahasiswaan' OR Session('previlage') == 'Sekretaris Wakil Rektor Bidang Perencanaan dan Kerjasama' OR Session('previlage') == 'Sekretaris Rektor' OR Session('previlage') == 'Sekretaris Dekan' OR Session('previlage') == 'Sekretaris WD I' OR Session('previlage') == 'Sekretaris WD II' OR Session('previlage') == 'Sekretaris WD III' OR Session('previlage') == 'Tata Usaha' OR Session('previlage') == 'Kepala Subbagian Kearsipan dan Hubungan Masyarakat')
			<li class="{{ isset($sidebar) && $sidebar == 'antritte' ? 'active' : '' }}">
				<a href="{{ url('antritte') }}">
				<i class="fa fa-black-tie text-success"></i> <span>TTE Admin</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'arsipsubstantif' ? 'active' : '' }} treeview">
			  <a href="#">
				<i class="fa fa-paper-plane-o text-info"></i> <span>Arsip Dinamis</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li class="{{ isset($sidebar) && $sidebar == 'dashboardarsip' ? 'active' : '' }}"><a href="{{ url('dashboardarsip') }}">Penciptaan Arsip</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}"><a href="{{ url('arsipmasuk') }}">Arsip Masuk</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}"><a href="{{ url('arsipkeluar') }}">Arsip Keluar</a></li>
				<li class="treeview">
					<a href="#">
					<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Substantif</span>
						<span class="pull-right-container">
						  <i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'arsipsubaktif' ? 'active' : '' }}"><a href="{{ url('arsipsubaktif') }}">Aktif</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'arsipsubinakti' ? 'active' : '' }}"><a href="{{ url('arsipsubinakti') }}">In Aktif</a></li>
						
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
					<i class="fa fa-calendar-plus-o text-info"></i> <span>Arsip Fasilitatif</span>
						<span class="pull-right-container">
						  <i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="{{ isset($sidebar) && $sidebar == 'arsipfasaktif' ? 'active' : '' }}"><a href="{{ url('arsipfasaktif') }}">Aktif</a></li>
						<li class="{{ isset($sidebar) && $sidebar == 'arsipfasinakti' ? 'active' : '' }}"><a href="{{ url('arsipfasinakti') }}">In Aktif</a></li>
					</ul>
				</li>
				<li class="{{ isset($sidebar) && $sidebar == 'arsipnilai' ? 'active' : '' }}"><a href="{{ url('arsipnilai') }}">Dinilai Kembali</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'arsipperorang' ? 'active' : '' }}"><a href="{{ url('arsipperorang') }}">Masuk Berkas Perseorangan</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'arsippermanen' ? 'active' : '' }}"><a href="{{ url('arsippermanen') }}">Permanen</a></li>
				<li class="{{ isset($sidebar) && $sidebar == 'arsipmusnah' ? 'active' : '' }}"><a href="{{ url('arsipmusnah') }}">Musnah</a></li>
			  </ul>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}">
				<a href="{{ url('statistik') }}">
				<i class="fa fa-line-chart text-yellow"></i> <span>Statistik</span>
				</a>
			</li>
		@else
			<li class="{{ isset($sidebar) && $sidebar == 'arsipmasuk' ? 'active' : '' }}">
				<a href="{{ url('arsipmasuk') }}">
				<i class="fa fa-folder  text-aqua"></i> <span>Arsip Surat Masuk</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'arsipkeluar' ? 'active' : '' }}">
				<a href="{{ url('arsipkeluar') }}">
				<i class="fa fa-envelope  text-magenta"></i> <span>Arsip Surat Keluar</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'statistik' ? 'active' : '' }}">
				<a href="{{ url('statistik') }}">
				<i class="fa fa-line-chart text-yellow"></i> <span>Statistik</span>
				</a>
			</li>
		@endif
		<li class="header">==========================</li>
		@if (Session('previlage') != 'developer' AND Session('id') == 2)
        	<li class="{{ isset($sidebar) && $sidebar == 'developing' ? 'active' : '' }}" style='background: url("{{ asset("/dist/img/pointing.gif") }}") no-repeat; background-size: 100% 50px;  background-position: center top;'>
				<a href="{{ url('developing') }}">
				<i class="fa fa-dashboard text-primary"></i> <span>Developing</span>
					@if(isset($counttugas))
						@if($counttugas != 0)
							 <small class="label pull-right bg-green">{{ $counttugas }}</small>
						@endif
					@endif
				</a>
			</li>
		@endif
			<li class="{{ isset($sidebar) && $sidebar == 'bpjsadmin' ? 'active' : '' }}">
				<a href="{{ url('bpjsadmin') }}">
				<i class="fa fa-medkit text-primary"></i> <span> Data BPJS</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'dashboardwebinar' ? 'active' : '' }}">
				<a href="{{ url('dashboardwebinar') }}">
				<i class="fa fa-calendar-check-o  text-green"></i> <span>Rapat/Webinar</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'todolist' ? 'active' : '' }}">
				<a href="{{ url('todolist') }}">
				<i class="fa  fa-calendar-check-o text-info"></i> <span>To Do List</span>
				</a>
			</li>
			<li class="{{ isset($sidebar) && $sidebar == 'buatqr' ? 'active' : '' }}">
				<a href="{{ url('buatqr') }}">
				<i class="fa fa-qrcode text-warning"></i> <span>QrCode Creator</span>
				</a>
			</li>
			<li>
				<a href="{{ url('manualbook') }}">
				<i class="fa fa-book text-danger"></i> <span>Manual Book</span>
				</a>
			</li>
			<li>
				<a href="{{ route('logout') }}">
				<i class="fa fa-power-off text-primary"></i> <span>Logout</span>
				</a>
			</li>
      </ul>
	  @endif
    </section>
</aside>
