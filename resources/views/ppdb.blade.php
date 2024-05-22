<!DOCTYPE html>
<html>
   <head>
        <meta charset="utf-8" />
		<title>{!! config('global.Title') !!}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta content="{!! config('global.sekolah') !!}" name="description" />
        <meta content="{!! config('global.kota') !!}" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">
        @include('base.partials.css')
    </head>
	<body class="hold-transition skin-purple layout-top-nav" style="background-image: url('{{asset('dist/img/bgub.jpg')}}'); background-repeat: no-repeat; background-position: center;">
    <div class="wrapper" >
		<div class="content-wrapper">
			<section class="content" >
				<div class="row">
					<div class="col-md-12">
						<div class="box box-widget widget-user">
							<div class="widget-user-header bg-black" style="background-image: url('{!! config('global.mrinbackground') !!}'); background-repeat: no-repeat; background-position: center; background-position-y: 15px; height: 140px;">
								<h3 class="widget-user-username">Pendaftaran Peserta Didik Baru Online </h3>
								<a href="/frontpage?id={{ $id_sekolah }}"><h5 class="widget-user-desc">{{ $sekolah }}</h5></a>
							</div>
							<div class="widget-user-image">
								<img class="img-circle" src="{{ url('').'/'.$logo }}" alt="{{ $sekolah }}">
							</div>
							<div class="box-footer">
								<div class="row" id="divpilihan">
									<div class="col-lg-4 border-right">
										<div class="small-box bg-red">
											<div class="inner">
												<h3>Pengumuman</h3>
												<p>Hasil Penerimaan Siswa Baru TA. {!! $pendaftaran !!}</p>&nbsp;
											</div>
											<div class="icon">
												<i class="fa fa-bell"></i>
											</div>
											<a href="#" id="topbtnpengumuman" class="small-box-footer">
												Click Untuk Menuju Halaman Pengumuman <i class="fa fa-arrow-circle-right"></i>
											</a>
										</div>
									</div>
									<div class="col-lg-4 border-right">
										<div class="small-box bg-green">
											<div class="inner">
												<h3>Pendaftaran</h3>
												<p>Halaman Pendaftaran Siswa Baru TA. {!! $pendaftaran !!}</p>&nbsp;
											</div>
											<div class="icon">
												<i class="fa fa-user-plus"></i>
											</div>
											<a href="#" id="topbtnpendaftaran" class="small-box-footer">
												Click Untuk Menuju Halaman Pendaftaran <i class="fa fa-arrow-circle-right"></i>
											</a>
										</div>
									</div>
									<div class="col-lg-4 border-right">
										<div class="small-box bg-blue">
											<div class="inner">
												<h3>Kelengkapan</h3>
												<p>Bagi Anda Yang Sudah Mendaftar, Namun Perlu Melengkapi Berkas Upload</p>&nbsp;
											</div>
											<div class="icon">
												<i class="fa fa-cloud-upload"></i>
											</div>
											<a href="#" id="topbtnkelengkapan" class="small-box-footer">
												Click Untuk Menuju Halaman Kelengkapan <i class="fa fa-arrow-circle-right"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row" id="divawal">
					<div class="col-md-12">
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 class="box-title">PENGUMUMAN</h3>
							</div>
							<div class="box-body">
							{!! $pengumuman !!}
							</div>
						</div>
					</div>
				</div>
				<div class="row" id="divtutuppendaftaran">
					<div class="col-md-8">
						<div id="divpesantutuppendaftaran">
							<div class="error-page">
								<h2 class="headline text-yellow"> T_T</h2>
								<div class="error-content">
									<h3><i class="fa fa-warning text-yellow"></i> PENDAFTARAN TELAH KAMI TUTUP</h3>
									<p>
										PPDB ONLINE TELAH DI TUTUP. DAN AKAN DIBUKA KEMBALI DENGAN JADWAL YANG AKAN KAMI UMUMKAN BERIKUTNYA
										<button class="btn btn-danger btn-block btnkembalikepilihan"><i class="fa fa-times"></i> KEMBALI KE AWAL</button>
									</p>
								</div>
							</div>
						</div>
						<div id="divpesantutuppengumuman">
							<div class="error-page">
								<h2 class="headline text-yellow"> T_T</h2>
								<div class="error-content">
									<h3><i class="fa fa-warning text-yellow"></i> PENGUMUMAN SISWA BARU BELUM BISA DI AKSESS</h3>
									<p>
										PENGUMUMAN HASIL PENERIMAAN PESERTA DIDIK BARU BELUM DIBUKA, DAN AKAN DIBUKA SESUAI TANGGAL YANG TERTERA PADA PENGUMUMAN
										<button class="btn btn-danger btn-block btnkembalikepilihan"><i class="fa fa-times"></i> KEMBALI KE AWAL</button>
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="box-body box-profile">
							<img class="img-responsive" src="{{ asset('wasimong.png') }}" alt="User profile picture">
							<h3 class="profile-username text-center">Terima Kasih Atas Kunjunganya</h3>
						</div>
					</div>
				</div>
				<div class="row" id="divpengumuman">
					<div class="error-page" id="divpengumumancek">
						<h2 class="headline text-yellow"> <i class="fa fa-child"></i> </h2>
						<div class="error-content">
							<h3><i class="fa fa-warning text-yellow"></i> INPUT DATA CALON SISWA BARU</h3>
							<p>
							<div class="form-group">
								<label>Isi NIK Calon Siswa dan Tgl. Lahir Calon Siswa</label>
								<div class="row">
									<div class="col-lg-6">
										<input type="text" class="form-control" placeholder="Ketik NIK (16 digit)" id="umum_nik">
									</div> 
									<div class="col-lg-6">
										<input type="text" class="form-control" placeholder="dd-mm-yyyy" id="umum_ttl">
									</div>
								</div>
								<button class="btn btn-info btn-flat" type="button" id="btnlihatpengumuman">Lihat</button>
							</div>
							</p>
						</div><!-- /.error-content -->
					</div><!-- /.error-page -->
					<div class="box box-info" id="divpengumumanpesan">
						<div class="box-header with-border">
							<h3 class="box-title">PENGUMUMAN HASIL PPDB</h3>
						</div>
						<div class="box-body">
							<div id="cetakpengumuman"></div>
						</div>
					</div><!-- /.error-page -->
				</div>
				<div class="row" id="divpendaftaran">
					<div id="pesan"></div>
					<div id="divdatadiri">
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 class="box-title">Data Diri Siswa</h3>
								<div class="box-tools pull-right">
								<button class="btn btn-box-tool btnkembalikepilihan" ><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body no-padding">
								<div class="box-body">
									<div class="form-group">
										<div class="row">
											<div class="col-lg-8">
												<label for="btnopenupload">Bagi Yang <strong><u>Sudah Mendaftar Sebelumnya</u></strong>, Namun Belum Melampirkan Scan / Foto Yang di Perlukan bisa Langsung Klik Tombol di Bawah</label>
											</div>
											<div class="col-lg-4">
												<button type="button" class="btn btn-info btnopenupload">Tambah Lampiran Scan / Foto</button>
											</div>
										</div>
									</div>
									<div class="small-box bg-blue">&nbsp;</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-3 col-xs-6">
												<label>TAPEL Diterima *)</label>
												<input type="text" id="id_tahun" name="id_tahun" class="form-control" value="{!! $pendaftaran !!}" disabled="disable">
											</div> 
											<div class="col-lg-3 col-xs-6">
												<label>Masuk Ke *)</label>
												@if($lvlsekolah == 1)
												<select id="id_kelas" name="id_kelas" class="form-control" >
													<option value="1">Tarbiyatul Athfal (TA/TK)</option>
													<option value="2">Kelompok Belajar (KB)</option>
												</select>
												@elseif($lvlsekolah == 2)
												<select id="id_kelas" name="id_kelas" class="form-control" >
													<option value="1">Siswa baru (Kelas 1)</option>
													<option value="2">Mutasi Kelas 2</option>
													<option value="3">Mutasi Kelas 3</option>
													<option value="4">Mutasi Kelas 4</option>
													<option value="5">Mutasi Kelas 5</option>
													<option value="6">Mutasi Kelas 6</option>
												</select>
												@elseif($lvlsekolah == 3)
												<select id="id_kelas" name="id_kelas" class="form-control" >
													<option value="1">Siswa baru (Kelas 1)</option>
													<option value="2">Mutasi Kelas 2</option>
													<option value="3">Mutasi Kelas 3</option>
												</select>
												@else
												<select id="id_kelas" name="id_kelas" class="form-control" >
													<option value="1">Siswa baru (Kelas 1)</option>
													<option value="2">Mutasi Kelas 2</option>
													<option value="3">Mutasi Kelas 3</option>
												</select>
												@endif
											</div>
											<div class="col-lg-6 col-xs-12">
												<label>NIK Calon Siswa (Nomor Induk Kependudukan) *)</label>
												<input type="text" id="id_niksiswa" class="form-control" placeholder="Nomor Induk Kependudukan">
											</div>
										</div>			  			  
									</div>			
									<div class="form-group">
										<div class="row">
											<div class="col-lg-8 col-xs-12">
												<label>Nama Lengkap *)</label>
												<input type="text" id="id_nama" class="form-control" placeholder="Nama Lengkap">
											</div> 
											<div class="col-lg-4 col-xs-12">
												<label>Nama Panggilan *)</label>
												<input type="text" id="id_namapanggilan" class="form-control" placeholder="Nama Panggilan">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<label>Kota Kelahiran *)</label>
												<input type="text" id="id_tmplahir" class="form-control" placeholder="Tempat Lahir">
											</div> 
											<div class="col-lg-3 col-xs-12">
												<label>Tgl.Lahir *)</label>
												<input type="text" id="id_tgllahir" class="form-control" placeholder="Tanggal Lahir">
											</div>
											<div class="col-lg-3 col-xs-12">
												<label>Umur Per Juli {{ $tahun }} *)</label>
												<input type="text" id="id_umur" class="form-control" placeholder="Umur">
											</div>
										</div>			  
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-4 col-xs-12">
												<label>Kelamin *)</label>
												<select id="id_kelamin" class="form-control" >
													<option value="L">Laki-Laki</option>
													<option value="P">Perempuan</option>
												</select>
											</div>
											<div class="col-lg-4 col-xs-12">
												<label>Agama *)</label>
												<select id="id_agama" class="form-control" >
													<option value="Islam">Islam</option>
													<option value="Kristen">Kristen</option>
													<option value="Katholik">Katholik</option>
													<option value="Budha">Budha</option>
													<option value="Hindu">Hindu</option>
													<option value="Konghuchu">Konghuchu</option>
												</select>
											</div>
											<div class="col-lg-4 col-xs-12">
												<label>Kewarganegaraan *)</label>
												<select id="id_warga" class="form-control" >
													<option value="WNI">WNI</option>
													<option value="WNA">WNA</option>
												</select>
											</div>
										</div>			  
									</div>
									<div class="form-group">
										<div class="row">				   
											<div class="col-lg-4 col-xs-12">
												<label>Tinggi Badan</label>
												<input type="text" id="id_tinggi" class="form-control" placeholder="Tinggi Badan">
											</div>
											<div class="col-lg-4 col-xs-12">
												<label>Berat Badan</label>
												<input type="text" id="id_berat" class="form-control" placeholder="Berat Badan">
											</div>
											<div class="col-lg-4 col-xs-12">
												<label>Gol.Darah</label>
												<select id="id_darah" class="form-control" >
													<option value="">Tidak Tahu</option>
													<option value="A">A</option>
													<option value="B">B</option>
													<option value="AB">AB</option>
													<option value="O">O</option>
												</select>
											</div> 
										</div>			  
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<label>Bahasa Sehari-hari</label>
												<input type="text" id="id_bahasa" class="form-control" placeholder="Bahasa Sehari-hari">
											</div> 
											<div class="col-lg-6 col-xs-12">
												<label>Penyakit yang pernah di derita</label>
												<input type="text" id="id_penyakit" class="form-control" placeholder="Penyakit Yang Pernah di Derita">
											</div>				 
										</div>			  
									</div>
									<div class="form-group">
										<div class="row">	
											<div class="col-lg-3 col-md-3 col-xs-12">
												<label>Anak Ke *)</label>
												<select id="id_anakke" class="form-control" >
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
												</select>
											</div>
											<div class="col-lg-3 col-md-3 col-xs-12">
												<label>Saudara Kandung *)</label>
												<select id="id_kandung" class="form-control" >
													<option value="0">0</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
												</select>
											</div>
											<div class="col-lg-3 col-md-3 col-xs-12">
												<label>Saudara Tiri</label>
												<select id="id_tiri" class="form-control" >
													<option value="0">0</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
												</select>
											</div>
											<div class="col-lg-3 col-md-3 col-xs-12">
												<label>Saudara Angkat</label>
												<select id="id_angkat" class="form-control" >
													<option value="0">0</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
												</select>
											</div>
										</div>			  
									</div>
									<div class="form-group">
										<div class="row">				   
											<div class="col-lg-4 col-xs-12">
												<label>Jarak Rumah Ke Sekolah *)</label>
												<input type="text" id="id_jarak" class="form-control" placeholder="Jarak (KM)">
											</div>
											<div class="col-lg-4 col-xs-12">
												<label>Email Salah Satu ORTU *)</label>
												<input type="text" id="id_telpon" class="form-control" placeholder="email@xxx.xxx">
											</div>
											<div class="col-lg-4 col-xs-12">
												<label>Tinggal Bersama</label>
												<select id="id_bersama" class="form-control" >
													<option value="Orang Tua">Orang Tua</option>
													<option value="Saudara">Saudara</option>
												</select>
											</div>
										</div>			  
									</div>
								</div>
							</div>
							<div class="box-footer">
								<button type="button" class="btn btn-success pull-right" id="navbtndarisiswa">Selanjutnya <i class="fa fa-hand-o-right"></i></button>
							</div>
						</div>
					</div>
					<div id="divdataortu">
						<div class="box box-info">
							<div class="box-header with-border"><h3 class="box-title">Data Orang Tua</h3></div>
							<div class="box-body no-padding">
								<div class="box-body">
									<div class="small-box bg-blue">Alamat Calon Siswa</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<label>Alamat</label>
												<input type="text" id="id_alamat" name="id_alamat" class="form-control" placeholder="Nama Jalan dan Nomer Rumah">	
											</div> 
											<div class="col-lg-3 col-xs-12">
												<label>RT</label>
												<input type="text" id="id_rt" name="id_rt" class="form-control" placeholder="RT">
											</div>
											<div class="col-lg-3 col-xs-12">
												<label>RW</label>
												<input type="text" id="id_rw" name="id_rw" class="form-control" placeholder="RW">
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<label>Kelurahan</label>
												<input type="text" id="id_kel" name="id_kel" class="form-control" placeholder="Kelurahan">	
											</div> 
											<div class="col-lg-6 col-xs-12">
												<label>Kecamatan</label>
												<input type="text" id="id_kec" name="id_kec" class="form-control" placeholder="Kecamatan">
											</div>				
										</div>
										<div class="row">
											<div class="col-lg-8 col-xs-12">
												<label>Kota</label>
												<input type="text" id="id_kota" name="id_kota" class="form-control" placeholder="Kota">	
											</div>				  
											<div class="col-lg-4 col-xs-12">
												<label>Kode POS</label>
												<input type="text" id="id_kodepos" name="id_kodepos" class="form-control" placeholder="Kode POS">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<label>Nama Ayah</label>
												<input type="text" id="id_ayah" name="id_ayah" class="form-control" placeholder="Ayah">
											</div> 
											<div class="col-lg-6 col-xs-12">
												<label>Nama Ibu</label>
												<input type="text" id="id_ibu" name="id_ibu" class="form-control" placeholder="Ibu">
											</div>				 
										</div>			  
									</div>	
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<label>Pekerjaan Ayah</label>
												<select id="id_kayah" class="form-control" >
													<option value="">Pilih Salah Satu</option>
													<option value="01 Tidak bekerja">01 Tidak bekerja</option>
													<option value="02 Nelayan">02 Nelayan</option>
													<option value="03 Petani">03 Petani</option>
													<option value="04 Peternak">04 Peternak</option>
													<option value="05 PNS/TNI/POLRI">05 PNS/TNI/POLRI</option>
													<option value="06 Karyawan Swasta">06 Karyawan Swasta</option>
													<option value="07 Pedagang">07 Pedagang</option>
												</select>
											</div> 
											<div class="col-lg-6 col-xs-12">
												<label>Pekerjaan Ibu</label>
												<select id="id_kibu" class="form-control" >
													<option value="">Pilih Salah Satu</option>
													<option value="01 Tidak bekerja">01 Tidak bekerja</option>
													<option value="02 Nelayan">02 Nelayan</option>
													<option value="03 Petani">03 Petani</option>
													<option value="04 Peternak">04 Peternak</option>
													<option value="05 PNS/TNI/POLRI">05 PNS/TNI/POLRI</option>
													<option value="06 Karyawan Swasta">06 Karyawan Swasta</option>
													<option value="07 Pedagang">07 Pedagang</option>
												</select>
											</div>				 
										</div>			  
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<label>Pendidikan Terakhir Ayah</label>
												<input type="text" id="id_payah" class="form-control" placeholder="Pendidikan Ayah">
											</div> 
											<div class="col-lg-6 col-xs-12">
												<label>Pendidikan Terakhir Ibu</label>
												<input type="text" id="id_pibu" class="form-control" placeholder="Pendidikan Ibu">
											</div>				 
										</div>			  
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<label>Penghasilan Perbulan Ayah</label>
												<select id="id_gayah" class="form-control" >
													<option value="rangegaji1">&lt; Rp. 500.000,00 </option>
													<option value="rangegaji2">Rp. 500.000,00 - Rp. 999.999,00</option>
													<option value="rangegaji3">Rp. 1.000.000,00 - Rp. 1.999.999,00</option>
													<option value="rangegaji4">Rp. 2.000.000,00 - Rp. 4.999.999,00</option>
													<option value="rangegaji5">Rp. 5.000.000,00 - Rp. 20Jt</option>
													<option value="rangegaji6">&gt; Rp. 20.000.000,00</option>
												</select>
											</div> 
											<div class="col-lg-6 col-xs-12">
												<label>Penghasilan Perbulan Ibu</label>
												<select id="id_gibu" class="form-control">
													<option value="rangegaji1">&lt; Rp. 500.000,00 </option>
													<option value="rangegaji2">Rp. 500.000,00 - Rp. 999.999,00</option>
													<option value="rangegaji3">Rp. 1.000.000,00 - Rp. 1.999.999,00</option>
													<option value="rangegaji4">Rp. 2.000.000,00 - Rp. 4.999.999,00</option>
													<option value="rangegaji5">Rp. 5.000.000,00 - Rp. 20Jt</option>
													<option value="rangegaji6">&gt; Rp. 20.000.000,00</option>
												</select>
											</div>				 
										</div>			  
									</div>
									<div class="form-group">
										<label>Alamat Ayah/Ibu <span style="color: #999">(diisi jika tidak serumah dengan calon siswa)</span></label>
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<input type="text" id="id_aayah" class="form-control" placeholder="Alamat Ayah">
											</div> 
											<div class="col-lg-6 col-xs-12">
												<input type="text" id="id_aibu" class="form-control" placeholder="Alamat Ibu">
											</div>				 
										</div>			  
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<label>No. Telpon / HP Ayah</label>
												<input type="text" id="id_hayah" class="form-control" placeholder="No.HP/Telp Ayah">
											</div> 
											<div class="col-lg-6 col-xs-12">
												<label>No. Telpon / HP IBU</label>
												<input type="text" id="id_hibu" class="form-control" placeholder="No.HP/Telp Ibu">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Nama Wali</label>
										<input type="text" id="id_wali" name="id_wali" class="form-control" placeholder="Wali (bila ada)">		  
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<label>No. HP Wali</label>
												<input type="text" id="id_hapewali" class="form-control" placeholder="No.HP/Telp Wali">
											</div> 
											<div class="col-lg-6 col-xs-12">
												<label>Agama dari Wali</label>
												<select id="id_agamawali" class="form-control" >
													<option value="Islam">Islam</option>
													<option value="Kristen">Kristen</option>
													<option value="Katholik">Katholik</option>
													<option value="Budha">Budha</option>
													<option value="Hindu">Hindu</option>
													<option value="Konghuchu">Konghuchu</option>
												</select>
											</div>				 
										</div>			  
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6 col-xs-12">
												<label>Pekerjaan Wali</label>
												<select id="id_kwali" class="form-control" >
													<option value="">Pilih Salah Satu</option>
													<option value="01 Tidak bekerja">01 Tidak bekerja</option>
													<option value="02 Nelayan">02 Nelayan</option>
													<option value="03 Petani">03 Petani</option>
													<option value="04 Peternak">04 Peternak</option>
													<option value="05 PNS/TNI/POLRI">05 PNS/TNI/POLRI</option>
													<option value="06 Karyawan Swasta">06 Karyawan Swasta</option>
													<option value="07 Pedagang">07 Pedagang</option>
												</select>
											</div> 
											<div class="col-lg-6 col-xs-12">
												<label>Hubungan Keluarga</label>
												<input type="text" id="id_hubwali" class="form-control">
											</div>				 
										</div>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<button type="button" class="btn btn-info pull-left" id="navbtnkesiswa"><i class="fa fa-hand-o-left"></i> Kembali</button>
								<button type="button" class="btn btn-success pull-right" id="navbtndariortu">Selanjutnya <i class="fa fa-hand-o-right"></i></button>
							</div>
						</div>
					</div>
					<div id="divdatatk">
						<div class="box box-warning">
							<div class="box-header with-border"><h3 class="box-title">DATA SEKOLAH ASAL</h3></div>
							<div class="box-body no-padding">
								<div class="box-body">
									<div class="form-group">
										<div class="row">
											<div class="col-lg-5">
												<label>Asal Sekolah Sebelumnya</label>
												<input type="text" id="id_asal" class="form-control" placeholder="Nama Sekolah Sebelumnya">
											</div> 
											<div class="col-lg-7">
												<label>Alamat Sekolah Sebelumnya</label>
												<input type="text" id="id_alamattk" class="form-control" placeholder="Alamat Sekolah Sebelumnya">
											</div>
										</div>
									</div>
									<div class="small-box bg-blue">Bila Pindahan</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-3">
												<label>Sekolah Asal</label>
												<input type="text" id="id_pindahasal" class="form-control" placeholder="Nama Sekolah Asal">
											</div> 
											<div class="col-lg-3">
												<label>Dari Tingkat</label>
												<select id="id_pindahkelas" class="form-control" >
													<option value=""></option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
												</select>
											</div>
											<div class="col-lg-3">
												<label>Tanggal Mendaftar</label>
												<input type="text" id="id_pindahtanggal" class="form-control" placeholder="Tanggal Pindah">
											</div> 
											<div class="col-lg-3">
												<label>di Tingkat</label>
												<select id="id_pindahkekelas" class="form-control" >
													<option value=""></option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
												</select>
											</div>
										</div>
									</div>
									<div class="small-box bg-blue">NILAI RATA-RATA  RAPOT SEMESTER 1-5</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">1</span><input type="text" class="form-control" id="id_semester1" placeholder="Semester 1">
										</div>
										<div class="input-group">
											<span class="input-group-addon">2</span><input type="text" class="form-control" id="id_semester2" placeholder="Semester 2">
										</div> 
										<div class="input-group">
											<span class="input-group-addon">3</span><input type="text" class="form-control" id="id_semester3" placeholder="Semester 3">
										</div> 
										<div class="input-group">
											<span class="input-group-addon">4</span><input type="text" class="form-control" id="id_semester4" placeholder="Semester 4">
										</div>
										<div class="input-group">
											<span class="input-group-addon">5</span><input type="text" class="form-control" id="id_semester5" placeholder="Semester 5">
										</div> 
									</div>
								</div>
							</div>
							<div class="box-footer">
								<button type="button" class="btn btn-info pull-left" id="navbtnkeortu"><i class="fa fa-hand-o-left"></i> Kembali</button>
								<button type="button" class="btn btn-success pull-right" id="navbtndaritk">Selanjutnya <i class="fa fa-hand-o-right"></i></button>
							</div>
						</div>
					</div>
					<div id="divdatakhusus">
						<div class="box box-danger">
							<div class="box-header with-border"><h3 class="box-title">DATA KHUSUS CALON SISWA</h3></div>
							<div class="box-body no-padding">
								<div class="box-body">
									<div class="form-group">
										<label>Kesulitan yang pernah dialami selama disekolah asal</label>
										<input type="text" id="id_kesulitan" class="form-control" placeholder="Kesulitan yang pernah dialami selama disekolah asal">		  
									</div>
									<div class="form-group">
										<label>Orang-orang yang tinggal bersama calon siswa</label>
										<div class="row">
											<div class="col-lg-3">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="tglbersama[]" value="Ayah"/>
													</span>
													<input type="text" class="form-control" value="Ayah" disabled="disable">
												</div>
											</div>
											<div class="col-lg-3">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="tglbersama[]" value="Ibu"/>
													</span>
													<input type="text" class="form-control" value="Ibu" disabled="disable">
												</div>
											</div>
											<div class="col-lg-3">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="tglbersama[]" value="Kakak/Adik"/>
													</span>
													<input type="text" class="form-control" value="Kakak/Adik" disabled="disable">
												</div>
											</div>
											<div class="col-lg-3">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="tglbersama[]" value="Kakek/Nenek"/>
													</span>
													<input type="text" class="form-control" value="Kakek/Nenek" disabled="disable">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="tglbersama[]" value="Lain"/>
													</span>
													<input type="text" class="form-control" id="id_bersamalainnya" placeholder="Lainnya Mohon di Tulis">
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Kegiatan yang dapat dilakukan sendiri</label>
										<div class="row">
											<div class="col-lg-4">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="kegsendiri[]" value="Bangun Tidur"/>
													</span>
													<input type="text" class="form-control" value="Bangun Tidur" disabled="disable">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="kegsendiri[]" value="Makan"/>
													</span>
													<input type="text" class="form-control" value="Makan" disabled="disable">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="kegsendiri[]" value="Memakai Sepatu"/>
													</span>
													<input type="text" class="form-control" value="Memakai Sepatu" disabled="disable">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="kegsendiri[]" value="Berpakaian"/>
													</span>
													<input type="text" class="form-control" value="Berpakaian" disabled="disable">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="kegsendiri[]" value="Lain"/>
													</span>
													<input type="text" class="form-control" id="id_kegsendirilainnya" placeholder="Lainnya Mohon di Tulis">
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Sumber Info</label>
										<div class="row">
											<div class="col-lg-4">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="sumberinfo[]" value="Teman/Saudara"/>
													</span>
													<input type="text" class="form-control" value="Teman/Saudara" disabled="disable">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="sumberinfo[]" value="Website"/>
													</span>
													<input type="text" class="form-control" value="Website" disabled="disable">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="sumberinfo[]" value="Media Cetak"/>
													</span>
													<input type="text" class="form-control" value="Media Cetak" disabled="disable">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="sumberinfo[]" value="FB / IG"/>
													</span>
													<input type="text" class="form-control" value="FB /IG" disabled="disable">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="input-group">
													<span class="input-group-addon">
														<input type="checkbox" name="sumberinfo[]" value="Lain"/>
													</span>
													<input type="text" class="form-control" id="id_sumberinfolain" placeholder="Lainnya Mohon di Tulis">
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6">
												<label>Penglihatan</label>
												<select id="id_penglihatan" class="form-control" >
													<option value="Normal">Normal</option>
													<option value="Berkacama Minus">Berkacama Minus</option>					 
												</select>
											</div> 
											<div class="col-lg-6">
												<label>Pendengaran</label>
												<select id="id_pendengaran" class="form-control" >
													<option value="Normal">Normal</option>
													<option value="Kurang Tanggap Terhadap Suara">Kurang Tanggap Terhadap Suara</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6">
												<label>Penampilan</label>
												<select id="id_penampilan" class="form-control" >
													<option value="Normal">Normal</option>
													<option value="Gagap">Gagap</option>
													<option value="Koordinasi gerakan kurang terkendali">Koordinasi gerakan kurang terkendali</option>
												</select>
											</div> 
											<div class="col-lg-6">
												<label>Gaya belajar calon siswa (jika diketahui)</label>
												<select id="id_gayabelajar" class="form-control" >
													<option value="Auditorial">Auditorial</option>
													<option value="Visual">Visual</option>
													<option value="Kinestetik">Kinestetik</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Bakat Khusus yang Menonjol</label>
										<input type="text" id="id_bakat" class="form-control" placeholder="Bakat Khusus yang Menonjol">		  
									</div>
									<div class="form-group">
										<label>Prestasi yang pernah diraih selama di Sekolah Sebelumnya (dilengkapi dengan foto atau fotokopi piagam penghargaan)</label>
										<div class="input-group">
											<span class="input-group-addon">a</span><input type="text" class="form-control" id="id_prestasi1" placeholder="Prestasi 1">
										</div>
										<div class="input-group">
											<span class="input-group-addon">b</span><input type="text" class="form-control" id="id_prestasi2" placeholder="Prestasi 2">
										</div> 
										<div class="input-group">
											<span class="input-group-addon">c</span><input type="text" class="form-control" id="id_prestasi3" placeholder="Prestasi 3">
										</div> 
										<div class="input-group">
											<span class="input-group-addon">d</span><input type="text" class="form-control" id="id_prestasi4" placeholder="Prestasi 4">
										</div> 
									</div>
								</div>
							</div>
							<div class="box-footer">
								<div class="form-group">				
									<div class="row">
										<strong>Sebelum Anda Menyimpan Data Tersebut di Atas, Mohon Menyiapkan File Scan / Foto Berikut :</strong>
										<ol>
											<li>Scan / Foto Akta Kelahiran (Ukuran Maks. 2Mb)</li>
											<li>Scan / Foto Calon Siswa 3x4 (Ukuran Maks. 2Mb)</li>
											<li>Scan / Foto Kartu Keluarga (Ukuran Maks. 2Mb)</li>
											<li>Scan / Foto Surat Keterangan Sedang Duduk di Kelas B atau Surat Keterangan Lulus dari TK (Ukuran Maks. 2Mb)</li>
										</ol>
										Untuk di Upload Setelah Proses Penyimpanan Data Berhasil dilakukan.<br />
										<button type="button" class="btn btn-info pull-left" id="navbtnketk"><i class="fa fa-hand-o-left"></i> Kembali</button>
										<button type="button" class="btn btn-success pull-right" id="navbtndarikhusus">Selanjutnya <i class="fa fa-hand-o-right"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="divstatus">
						<div class="col-lg-12">
							<div class="box box-widget widget-user-2">
								<div id="status"></div>
							</div>
						</div>
						<div class="col-lg-5 infoupload">
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title">PETUNJUK</h3>
								</div>
								<div class="box-body no-padding">
									<div class="box-body">
										<ol>
											<li>Apabila Bapak / Ibu sampai pada tahap ini dan belum siap dengan scan / foto Dari berkas - berkas yang dibutuhkan. Bapak / Ibu bisa mempersiapkan terlebih dahulu, dan halaman ini bisa langsung diakses pada menu <a href="#" class="btnopenupload">Kelengkapan di halaman muka (FRONTPAGE)</a> </li>
											<li>Apabila semua berkas telah Bapak/Ibu Upload. Tahapan selanjutnya adalah mencetak Form Kesanggupan dan Mengupload Biaya Pendaftaran di menu<a href="#" class="btnopenupload">Kelengkapan di halaman muka (FRONTPAGE)</a> </li>
										</ol>
									</div>
								</div>
							</div> 
						</div>
						<div class="col-lg-7 infoupload">
							<div class="box box-success">
								<div class="box-header with-border">
									<h3 class="box-title">Upload Data Dukung</h3>
								</div>
								<div class="box-body no-padding">
									<div class="box-body">
										<div class="form-group">
											<label>NIK Calon Siswa</label>
											<input type="text" class="form-control" id="file_nik"  name="file_nik" placeholder="Tulis NIK Calon Siswa Anda">
										</div>
										<div class="form-group">
											<label>Akta Kelahiran (Ukuran Maks. 2Mb)</label>
											<input type="file" id="file_akte" name="file_akte">
										</div>
										<div class="form-group">
											<label>Scan / Foto Calon Siswa 4x6 (Ukuran Maks. 2Mb)</label>
											<input type="file" id="file_foto" name="file_foto">
										</div>
										<div class="form-group">
											<label>Kartu Keluarga (Ukuran Maks. 2Mb)</label>
											<input type="file" id="file_kk" name="file_kk">
										</div>
										<div class="form-group">
											<label>Surat Keterangan Lulus (Ukuran Maks. 2Mb)</label>
											<input type="file" id="file_keterangan" name="file_keterangan">
										</div>
										<div class="form-group">
											<a href="#" id="btnuploadfileppdb"  class="btn btn-block btn-social btn-instagram">
												<i class="fa fa-upload"></i> Upload
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row" id="divberkas">
					<div class="error-page">
						<h2 class="headline text-yellow"> <i class="fa fa-child"></i> </h2>
						<div class="error-content">
							<h3><i class="fa fa-warning text-yellow"></i> INPUT DATA CALON SISWA BARU</h3>
							<p>
							<div class="form-group">
								<label>Isi NIK Calon Siswa dan Tgl. Lahir Calon Siswa</label>
								<div class="row">
									<div class="col-lg-6">
									<input type="text" class="form-control" placeholder="Ketik NIK (16 digit)" id="berkas_nik">
									</div> 
									<div class="col-lg-6">
									<input type="text" class="form-control" placeholder="dd-mm-yyyy" id="berkas_ttl">
									</div>
								</div>
								<button class="btn btn-info btn-flat" type="button" id="btnlhthasil">Lihat</button>
							</div>
							</p>
						</div><!-- /.error-content -->
					</div><!-- /.error-page -->
				</div>
				<div id="divkelengkapanberkas">
					<div class="row">
						<div class="col-lg-4">
							<div class="box box-info">
							<div class="box-header with-border">
								<h3 class="box-title">Tahapan</h3>
							</div>
							<div class="box-body">
									<a class="btn btn-block btn-social btn-instagram btnkembalikepilihan">
									<i class="fa fa-backward"></i>Kembali
									</a>
									<a href="#" class="btn btn-block btn-social btn-bitbucket">
									<i>1</i>Mendaftar dan Mengisi Form Pendaftaran
									</a>
									<a href="#" class="btn btn-block btn-social btn-dropbox">
									<i>2</i>Upload Kelengkapan
									</a>
									<a href="#" id="btncetakbiodata" class="btn btn-block btn-social btn-google">
									<i>3</i>Cetak Biodata
									</a>
									<a id="btncetakformkesanggupan" class="btn btn-block btn-social btn-facebook">
									<i>4</i>Cetak Form Kesanggupan
									</a>
									<a id="btncetakformkesanggupan" class="btn btn-block btn-social btn-flickr">
									<i>5</i>Membayar Biaya Psikotest
									</a>
									<div class="info-box">
									<span class="info-box-icon bg-aqua"><i class="fa fa-credit-card"></i></span>
									<div class="info-box-content">
										<span class="info-box-text"><font color=blue>Transfer Biaya<br /> Pendaftaran Ke</font></span>
										<span class="info-box-number">{!! $namabank !!}<br />Norek : {!! $norek !!}<br />Nominal : Rp. {!! $hargaformulir !!}</span>
									</div>
									</div>
									<a id="btncetakformkesanggupan" class="btn btn-block btn-social btn-foursquare">
									<i>6</i>Upload Bukti Pembayaran
									</a>
									<a id="btnhari3" class="btn btn-block btn-social btn-github">
									<i>7</i>Verifikasi Administrasi Sekolah
									</a>
									<a id="btncetakkartupeserta" class="btn btn-block btn-social btn-google">
									<i>8</i>Cetak Kartu Peserta Tes
									</a>
							</div>
							</div><!-- /.box -->	
						</div>
						<div class="col-lg-8">
							<div class="box box-info">
							<div class="box-header with-border">
								<h3 class="box-title">KELENGKAPAN DATA PPDB</h3>
							</div>
							<div class="box-body">
								<div id="divtabelfile">
									<div id="gridcalonsiswa"></div>
								</div>
								<div id="divuploadfile">
									<div class="box-body">
										<div class="form-group">
											<label for="id_masternik">NIK</label>
											<input type="text" class="form-control" placeholder="Ketik NIK (16 digit)" id="id_masternik" disabled="disable">
										</div>
										<div class="form-group">
											<label id="labelupload"></label><br />
											<input type="file" id="file_unggah" name="file_unggah">
										</div>
										<div class="form-group">
											<input type="hidden" id="file_jenis" name="file_jenis">
											<div class="row">
												<div class="col-lg-6">
													<a id="btnkembalidrupload" class="btn btn-block btn-social btn-google">
														<i class="fa fa-mail-reply"></i> Cancel
													</a>
												</div>
												<div class="col-lg-6">
													<a id="btnuploadberkas" class="btn btn-block btn-social btn-facebook">
														<i class="fa fa-upload"></i> Upload
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<div id="divcetak"></div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
			  <b>{!! config('global.namaapps') !!}</b>
			</div>
			<strong>Copyright &copy; 2023 <a href="{!! config('global.homeweb') !!}">{!! config('global.sekolah') !!}</a>.</strong> All rights reserved.
		</footer>
    </div>
	<!-- TOKEN -->
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	<input type="hidden" name="statppdb" id="statppdb" value="{!! $statppdb !!}">
	@include('base.partials.js')
	<script>
		$(function () {
			$("#id_tgllahir").datepicker({format: 'dd-mm-yyyy'});
			$("#berkas_ttl").datepicker({format: 'dd-mm-yyyy'});
			$("#id_pindahtanggal").datepicker({format: 'dd-mm-yyyy'});
		});
		$(document).ready(function() {
			var token=document.getElementById('token').value;
			$('#divpengumuman').hide();
			$('#divtutuppendaftaran').hide();
			$('#divpendaftaran').hide();
			$('#divberkas').hide();
			$('.infoupload').hide();
			$('#divstatus').hide();
			$('#divdataortu').hide();
			$('#divdatatk').hide();
			$('#divdatakhusus').hide();
			$('#divkelengkapanberkas').hide();
			$("#topbtnpengumuman").click(function(){
				var statppdb	= document.getElementById('statppdb').value;
				if (statppdb == 'umum'){
					$('#divtutuppendaftaran').hide();
					$('#divpengumuman').show();
					$('#divpengumumanpesan').hide();
					$('#divpengumumancek').show();
				} else {
					$('#divpengumuman').hide();
					$('#divtutuppendaftaran').show();
					$('#divpesantutuppendaftaran').hide();
					$('#divpesantutuppengumuman').show();
				}				
				$('#divpendaftaran').hide();
				$('#divberkas').hide();
				$('#divpilihan').hide();
				$('#divawal').hide();
				$('#divstatus').hide();
				$('#divdataortu').hide();
				$('#divdatatk').hide();
				$('#divdatakhusus').hide();
				$('#divkelengkapanberkas').hide();
			});
			$("#topbtnkelengkapan").click(function(){
				var statppdb	= document.getElementById('statppdb').value;
				if (statppdb == 'tutup'){
					$('#divtutuppendaftaran').show();
					$('#divpesantutuppendaftaran').show();
					$('#divpesantutuppengumuman').hide();
					$('#divberkas').hide();
				} else {
					$('#divberkas').show();
					$('#divtutuppendaftaran').hide();
				}
				$('#divkelengkapanberkas').hide();
				$('#divpengumuman').hide();
				$('#divpendaftaran').hide();
				$('#divpilihan').hide();
				$('#divtutuppendaftaran').hide();
				$('#divawal').hide();
				$('#divstatus').hide();
				$('#divdataortu').hide();
				$('#divdatatk').hide();
				$('#divdatakhusus').hide();
			});
			$("#topbtnpendaftaran").click(function(){
				var statppdb	= document.getElementById('statppdb').value;
				if (statppdb == 'tutup'){
					$('#divtutuppendaftaran').show();
					$('#divpendaftaran').hide();
					$('#divpesantutuppendaftaran').show();
					$('#divpesantutuppengumuman').hide();
				} else {
					$('#divpendaftaran').show();
					$('#divtutuppendaftaran').hide();
				}
				$('#divkelengkapanberkas').hide();
				$('#divstatus').hide();
				$('#divdataortu').hide();
				$('#divdatatk').hide();
				$('#divdatakhusus').hide();
				$('#divpengumuman').hide();				
				$('#divberkas').hide();
				$('#divpilihan').hide();
				$('#divawal').hide();
			});
			$("#btnkembalidrupload").click(function(){
				$('#divtabelfile').show();
				$('#divuploadfile').hide();
			});
			$('#btnlhthasil').click(function () {
				var set01=document.getElementById('berkas_nik').value;
				var set02=document.getElementById('berkas_ttl').value;
				$.post('ppdb/ceknikppdb', { val01: set01, val02: set02, _token:token ,id_sekolah:'{{$id_sekolah}}' },
				function(data){
					var status  = data.status;
					var message = data.message;
					var warna 	= data.warna;
					var icon 	= data.icon;
					$('#id_masternik').val(set01);
					if (icon == 'success'){
						$('#divberkas').hide();
						$('#divtabelfile').show();
						$('#divuploadfile').hide();
						$('#divkelengkapanberkas').show();						
						$("html, body").animate({ scrollTop: 0 }, "slow");
						var sumberdatacalon = {
							datatype: "json",
							datafields: [
								{ name: 'idpsb',type: 'text'},
								{ name: 'nik',type: 'text'},
								{ name: 'idpelengkap',type: 'text'},
								{ name: 'jenis',type: 'text'},
								{ name: 'deskripsi',type: 'text'},
								{ name: 'isine',type: 'text'},
							],
							type: 'POST',
							data: {	val01:set01, val02:set02, _token: token },
							url: 'ppdb/datacalonsiswa',
						};
						var dataAdapter = new $.jqx.dataAdapter(sumberdatacalon);
						var photorenderer = function (row, column, value) {
							var gambar = $('#gridcalonsiswa').jqxGrid('getrowdata', row).isine;
							if (gambar == ''){
								var img = '<div style="background: white;"><img style="margin:2px; margin-left: 10px;" width="75" height="75" src="dist/img/logo-gray.jpg"></div>';
							} else {
								var img = '<div style="background: white;"><img style="margin:2px; margin-left: 10px;" width="150" height="150" src="dist/img/' + gambar + '"></div>';
							}							
							return img;
						}
						$("#gridcalonsiswa").jqxGrid({
							width: '100%',
							theme: "orange",
							autoheight: true,
							autorowheight: true,
							source: dataAdapter,
							selectionmode: 'multiplecellsextended',
							columns: [
								{ text: 'Scan/ Foto', width: '20%', align: 'center', cellsalign: 'center', cellsrenderer: photorenderer },
								{ text: 'Deskripsi', datafield: 'deskripsi', width: '70%', cellsalign: 'left', align: 'center' },
								{ text: 'Ubah', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
									return "UPLOAD";
									}, buttonclick: function (row) {
										editrow = row;
										var offset 		= $("#gridcalonsiswa").offset();		
										var dataRecord 	= $("#gridcalonsiswa").jqxGrid('getrowdata', editrow);
										$("#id_masternik").val(dataRecord.nik);
										$("#file_jenis").val(dataRecord.jenis);
										$('#labelupload').html(dataRecord.deskripsi);
										$('#divtabelfile').hide();
										$('#divuploadfile').show();
									}
								},
							],
						});
						return false;
					} else {
						$.toast({
							heading: status,
							text: message,
							position: 'top-right',
							loaderBg: warna,
							icon: icon,
							hideAfter: 5000,
							stack: 1
						});
						return false;
					}
				});
			});
			$(".btnkembalikepilihan").click(function(){
				$('#divkelengkapanberkas').hide();
				$('#divpengumuman').hide();
				$('#divtutuppendaftaran').hide();
				$('#divpendaftaran').hide();
				$('#divberkas').hide();
				$('#divstatus').hide();
				$('#divdataortu').hide();
				$('#divdatatk').hide();
				$('#divdatakhusus').hide();
				$('#divpilihan').show();
				$('#divawal').show();
			});
			$('#navbtndarisiswa').click(function () {
				var kerja='siswa';
				var set01=document.getElementById('id_tahun').value;
				var set02=document.getElementById('id_kelas').value;
				var set03=document.getElementById('id_niksiswa').value;
				var set04=document.getElementById('id_nama').value;
				var set05=document.getElementById('id_namapanggilan').value;
				var set06=document.getElementById('id_tmplahir').value;
				var set07=document.getElementById('id_tgllahir').value;
				var set08=document.getElementById('id_umur').value;
				var set09=document.getElementById('id_kelamin').value;
				var set10=document.getElementById('id_agama').value;
				var set11=document.getElementById('id_warga').value;
				var set12=document.getElementById('id_tinggi').value;
				var set13=document.getElementById('id_berat').value;
				var set14=document.getElementById('id_darah').value;
				var set15=document.getElementById('id_bahasa').value;
				var set16=document.getElementById('id_penyakit').value;
				var set17=document.getElementById('id_anakke').value;
				var set18=document.getElementById('id_kandung').value;
				var set19=document.getElementById('id_tiri').value;
				var set20=document.getElementById('id_angkat').value;
				var set21=document.getElementById('id_jarak').value;
				var set22=document.getElementById('id_telpon').value;
				var set23=document.getElementById('id_bersama').value;
				$.post('ppdb/daftar', { setkerja: kerja, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06,val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14, val15: set15, val16: set16, val17: set17, val18: set18, val19: set19, val20: set20, val21: set21, val22: set22, val23: set23, val24: '', val25: '', val26: '', _token:token,id_sekolah:'{{$id_sekolah}}' },
				function(data){
					if (data == 'sukses'){
						$("#berkas_nik").val(set03);
						$("#berkas_ttl").val(set07);
						$('#divstatus').hide();
						$('#divdatadiri').hide();
						$('#divdataortu').show();
						$('#divdatatk').hide();
						$('#divdatakhusus').hide();
						$("html, body").animate({ scrollTop: 0 }, "slow");
						return false;
					}
					else {
						$('#pesan').html(data);
						$("html, body").animate({ scrollTop: 0 }, "slow");
						return false;
					}
				});
			});
			$('#navbtndariortu').click(function () {
				var kerja='ortu';
				var set01=document.getElementById('id_ayah').value;
				var set02=document.getElementById('id_ibu').value;
				var set03=document.getElementById('id_kayah').value;
				var set04=document.getElementById('id_kibu').value;
				var set05=document.getElementById('id_wali').value;
				var set06=document.getElementById('id_kwali').value;
				var set07=document.getElementById('id_alamat').value;
				var set08=document.getElementById('id_rt').value;
				var set09=document.getElementById('id_rw').value;
				var set10=document.getElementById('id_kel').value;
				var set11=document.getElementById('id_kec').value;
				var set12=document.getElementById('id_kodepos').value;
				var set13=document.getElementById('id_kota').value;
				var set14=document.getElementById('id_payah').value;
				var set15=document.getElementById('id_pibu').value;
				var set16=document.getElementById('id_gayah').value;
				var set17=document.getElementById('id_gibu').value;
				var set18=document.getElementById('id_aayah').value;
				var set19=document.getElementById('id_aibu').value;
				var set20=document.getElementById('id_hayah').value;
				var set21=document.getElementById('id_hibu').value;
				var set22=document.getElementById('id_agamawali').value;
				var set23=document.getElementById('id_hapewali').value;
				var set24=document.getElementById('id_kwali').value;
				var set25=document.getElementById('id_hubwali').value;
				var set26=document.getElementById('id_niksiswa').value;
				$.post('ppdb/daftar', { setkerja: kerja, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06,val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14, val15: set15, val16: set16, val17: set17, val18: set18, val19: set19, val20: set20, val21: set21, val22: set22, val23: set23, val24: set24, val25: set25, val26: set26, _token: token ,id_sekolah:'{{$id_sekolah}}'},
				function(data){
					if (data == 'sukses'){
						$('#divstatus').hide();
						$('#divdatadiri').hide();
						$('#divdataortu').hide();
						$('#divdatatk').show();
						$('#divdatakhusus').hide();
						$("html, body").animate({ scrollTop: 0 }, "slow");
						return false;
					}
					else {
						$('#pesan').html(data);
						$("html, body").animate({ scrollTop: 0 }, "slow");
						return false;
					}
				});
			});
			$('#navbtndaritk').click(function () {
				var kerja='asaltk';
				var set01=document.getElementById('id_asal').value;
				var set02=document.getElementById('id_alamattk').value;
				var set03=document.getElementById('id_pindahasal').value;
				var set04=document.getElementById('id_pindahkelas').value;
				var set05=document.getElementById('id_pindahtanggal').value;
				var set06=document.getElementById('id_pindahkekelas').value;
				var set07=document.getElementById('id_niksiswa').value;
				var set08=document.getElementById('id_semester1').value;
				var set09=document.getElementById('id_semester2').value;
				var set10=document.getElementById('id_semester3').value;
				var set11=document.getElementById('id_semester4').value;
				var set12=document.getElementById('id_semester5').value;
				$.post('ppdb/daftar', { setkerja: kerja, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06,val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: '', val14: '', val15: '', val16: '', val17: '', val18: '', val19: '', val20: '', val21: '', val22: '', val23: '', val24: '', val25: '', val26: '', _token:token ,id_sekolah:'{{$id_sekolah}}'},
				function(data){
					if (data == 'sukses'){
						$('#divstatus').hide();
						$('#divdatadiri').hide();
						$('#divdataortu').hide();
						$('#divdatatk').hide();
						$('#divdatakhusus').show();
						$("html, body").animate({ scrollTop: 0 }, "slow");
						return false;
					}
					else {
						$('#pesan').html(data);
						$("html, body").animate({ scrollTop: 0 }, "slow");
						return false;
					}
				});	
			});
			$('#navbtndarikhusus').click(function () {
				var kerja='selesai';
				var set01=document.getElementById('id_kesulitan').value;
				var set02=document.getElementById('id_bersamalainnya').value;
				var set03=document.getElementById('id_kegsendirilainnya').value;
				var set04=document.getElementById('id_penglihatan').value;
				var set05=document.getElementById('id_pendengaran').value;
				var set06=document.getElementById('id_penampilan').value;
				var set07=document.getElementById('id_gayabelajar').value;
				var set08=document.getElementById('id_bakat').value;
				var set09=document.getElementById('id_prestasi1').value;
				var set10=document.getElementById('id_prestasi2').value;
				var set11=document.getElementById('id_prestasi3').value;
				var set12=document.getElementById('id_prestasi4').value;
				var set13=document.getElementById('id_sumberinfolain').value;
				var set14=document.getElementById('id_niksiswa').value;
				var ARRBERSAMA = new Array();
				var ARRKEGIATAN = new Array();
				var ARRSUMBER = new Array();
				$("input[name='tglbersama[]']:checked").each(function(){ARRBERSAMA.push($(this).val());});
				$("input[name='kegsendiri[]']:checked").each(function(){ARRKEGIATAN.push($(this).val());});
				$("input[name='sumberinfo[]']:checked").each(function(){ARRSUMBER.push($(this).val());});
				$.post('ppdb/daftar', { setkerja: kerja, val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06,val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14, val15: ARRBERSAMA, val16: ARRKEGIATAN, val17: ARRSUMBER, val18: '', val19: '', val20: '', val21: '', val22: '', val23: '', val24: '', val25: '', val26: '', _token:token ,id_sekolah:'{{$id_sekolah}}'},
				function(data){
					$("#file_nik").val(set14);
					if (data != 'gagal'){
						$('.infoupload').show();
						$('#divstatus').show();
						$('#status').html(data);
						$('#divdatadiri').hide();
						$('#divdataortu').hide();
						$('#divdatatk').hide();
						$('#divdatakhusus').hide();
						$("html, body").animate({ scrollTop: 0 }, "slow");
						return false;
					}
					else {
						$('#pesan').html(data);
						$("html, body").animate({ scrollTop: 0 }, "slow");
						return false;
					}
				});	
			});
			$("#btnuploadfileppdb").click(function(){
				var set01 	= '';
				var set02	= document.getElementById('file_akte');
				var set03	= document.getElementById('file_foto');
				var set04	= document.getElementById('file_kk');
				var set05	= document.getElementById('file_keterangan');
				var set06	= document.getElementById('id_niksiswa').value;
				var token 	= document.getElementById('token').value;
				if ($('#file_kk').val() == ''){
					swal({
						title: 'Stop',
						text: 'Pilih File KK Ananda',
						type: 'warning',
					})
				}
				else if ($('#file_akte').val() == ''){
					swal({
						title: 'Stop',
						text: 'Pilih File Akte Kelahiran Ananda',
						type: 'warning',
					})
				}
				else if ($('#file_foto').val() == ''){
					swal({
						title: 'Stop',
						text: 'Pilih File Foto Ananda',
						type: 'warning',
					})
				}
				else if (set06 == ''){
					swal({
						title: 'Stop',
						text: 'NIK Ananda Tidak Terdeteksi, silahkan upload melalui halaman depan',
						type: 'warning',
					})
				}
				else {
					var form_data = new FormData();
					form_data.append('akte', set02.files[0]);
					form_data.append('foto', set03.files[0]);
					form_data.append('ksk', set04.files[0]);
					form_data.append('keterangan', set05.files[0]);
					form_data.append('nik', set06);
					form_data.append('_token', '{{csrf_token()}}');
					form_data.append('id_sekolah', '{{$id_sekolah}}');
					$.ajax({
						url: 'ppdb/savefileppdb',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							var status  = data.status;
							var message = data.message;
							var warna 	= data.warna;
							var icon 	= data.icon;
							$("#file_kk").val('');
							$("#file_akte").val('');
							$("#file_foto").val('');
							$("#file_keterangan").val('');
							$.toast({
								heading: status,
								text: message,
								position: 'top-right',
								loaderBg: warna,
								icon: icon,
								hideAfter: 5000,
								stack: 1
							});
							$('.infoupload').hide();
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
				}
			});
			$("#btnuploadberkas").click(function(){
				var set01 	= document.getElementById('id_masternik').value;
				var set02	= document.getElementById('file_jenis').value;
				var set03	= document.getElementById('file_unggah');
				if ($('#file_unggah').val() == ''){
					swal({
						title: 'Stop',
						text: 'Pilih File Anda',
						type: 'warning',
					})
				}
				else {
					var form_data = new FormData();
					form_data.append('file', set03.files[0]);
					form_data.append('val01', set01);
					form_data.append('val02', set02);
					form_data.append('_token', '{{csrf_token()}}');
					form_data.append('id_sekolah', '{{$id_sekolah}}');
					$.ajax({
						url: 'ppdb/saveberkasppdb',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							var status  = data.status;
							var message = data.message;
							var warna 	= data.warna;
							var icon 	= data.icon;
							$("#file_unggah").val('');
							$('#divtabelfile').show();
							$('#divuploadfile').hide();
							$("#gridcalonsiswa").jqxGrid('updatebounddata');
							$.toast({
								heading: status,
								text: message,
								position: 'top-right',
								loaderBg: warna,
								icon: icon,
								hideAfter: 5000,
								stack: 1
							});
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
				}
			});
			$('#navbtnkeortu').click(function () {
				$('#divstatus').hide();
				$('#divdatadiri').hide();
				$('#divdataortu').show();
				$('#divdatatk').hide();
				$('#divdatakhusus').hide();
				$("html, body").animate({ scrollTop: 0 }, "slow");	
			});
			$('#navbtnkesiswa').click(function () {
				$('#divstatus').hide();
				$('#divdatadiri').show();
				$('#divdataortu').hide();
				$('#divdatatk').hide();
				$('#divdatakhusus').hide();
				$("html, body").animate({ scrollTop: 0 }, "slow");	
			});
			$('#navbtnkekhusus').click(function () {
				$('#divstatus').hide();
				$('#divdatadiri').hide();
				$('#divdataortu').hide();
				$('#divdatatk').hide();
				$('#divdatakhusus').show();
				$('#divpendaftaran').show();
				$("html, body").animate({ scrollTop: 0 }, "slow");	
			});
			$('#navbtnketk').click(function () {
				$('#divstatus').hide();
				$('#divdatadiri').hide();
				$('#divdataortu').hide();
				$('#divdatatk').show();
				$('#divdatakhusus').hide();
				$("html, body").animate({ scrollTop: 0 }, "slow");	
			});
			$('.btnopenupload').click(function () { 
				var statppdb	= document.getElementById('statppdb').value;
				if (statppdb == 'tutup'){
					$('#divtutuppendaftaran').show();
					$('#divberkas').hide();
					$('#divpesantutuppendaftaran').show();
					$('#divpesantutuppengumuman').hide();
				} else {
					$('#divberkas').show();
					$('#divtutuppendaftaran').hide();
				}
				$('#divpengumuman').hide();
				$('#divpendaftaran').hide();
				$('#divpilihan').hide();
				$('#divtutuppendaftaran').hide();
				$('#divawal').hide();
				$('#divstatus').hide();
				$('#divdataortu').hide();
				$('#divdatatk').hide();
				$('#divdatakhusus').hide();
			});
			$('#btncetakformkesanggupan').on('click', function (){
				var set01=document.getElementById('berkas_nik').value;
				var set02=document.getElementById('berkas_ttl').value;
				$.post('ppdb/getkodependaf', { val01: set01, val02: set02, _token:token ,id_sekolah:'{{$id_sekolah}}'},
				function(data){
					var url 		= "{{URL::to("/")}}/formkesanggupan/"+data;
					var windowName 	= data;
					var windowSize 	= "width=800,height=800";
					window.open(url, windowName, windowSize);
					//event.preventDefault();
					return false;
				});	
			});
			$('#btncetakbiodata').on('click', function (){		
				var set01=document.getElementById('berkas_nik').value;
				var set02=document.getElementById('berkas_ttl').value;
				$.post('ppdb/getkodependaf', { val01: set01, val02: set02, _token:token,id_sekolah:'{{$id_sekolah}}' },
				function(data){
					var url 		= "{{URL::to("/")}}/biodatapsb/"+data;
					var windowName 	= data;
					var windowSize 	= "width=800,height=800";
					window.open(url, windowName, windowSize);
					//event.preventDefault();
					return false;
				});	
			});
			$('#btncetakkartupeserta').on('click', function (){		
				var set01=document.getElementById('berkas_nik').value;
				var set02=document.getElementById('berkas_ttl').value;
				$.post('ppdb/getkodependaf', { val01: set01, val02: set02, _token:token,id_sekolah:'{{$id_sekolah}}' },
				function(data){
					var url 		= "{{URL::to("/")}}/karpes/"+data;
					var windowName 	= data;
					var windowSize 	= "width=800,height=800";
					window.open(url, windowName, windowSize);
					//event.preventDefault();
					return false;
				});	
			});
			$('#btnlihatpengumuman').on('click', function (){		
				var set01=document.getElementById('umum_nik').value;
				var set02=document.getElementById('umum_ttl').value;
				$.post('ppdb/getkodependaf', { val01: set01, val02: set02, _token:token ,id_sekolah:'{{$id_sekolah}}'},
				function(data){
					var url 		= "{{URL::to("/")}}/observasi/"+data;
					$('#divpengumumancek').hide();
					$('#divpengumumanpesan').show();
					var iframe = '<iframe src="'+url+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
					$('#cetakpengumuman').html(iframe);
					return false;
				});	
			});
		});
	</script>
  </body>
</html>
