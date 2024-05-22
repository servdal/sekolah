<!DOCTYPE html>
<html>
   <head>
        <meta charset="utf-8" />
		<title>{!! config('global.Title') !!} | {!! $nama_sekolah !!}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta content="{{ $nama_sekolah }}" name="description" />
        <meta content="{{ $kota }}" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">
        @include('base.partials.css')
    </head>
	<body class="hold-transition skin-purple layout-top-nav">
    <div class="wrapper" >      
		<div class="content-wrapper">
			<section class="content" >
				<div class="row">
					<div class="col-md-12">
						<div class="box box-widget widget-user">
							<div class="widget-user-header bg-black" style="background-image: url('{!! config('global.mrinbackground') !!}'); background-repeat: no-repeat; background-position: center; background-position-y: 15px; height: 140px;">
							  <h3 class="widget-user-username">Welcome to </h3>
							  <a href="{{url('')}}/frontpage?id={{$id_sekolah}}"><h5 class="widget-user-desc">{{ $nama_sekolah }}</h5></a>
							</div>
							<div class="widget-user-image">
								<img class="img-circle" src="{{ url('').'/'.$logo }}" alt="{{ $nama_sekolah }}">
							</div>
							<div class="box-footer">
								<div class="row" id="divpilihan">
									<div class="col-lg-4 border-right">
										<div class="box box-widget widget-user">
											<div class="widget-user-header bg-red">
											  <div class="widget-user-image">
												<img class="img-circle" src="{{ asset('dist/img/lhead.png') }}" alt="{{ $nama_sekolah }}">
											  </div>
											  <h3 class="widget-user-username">Aplikasi</h3>
											  <h5 class="widget-user-desc">{!! config('global.Title') !!}</h5>
											</div>
											<div class="box-footer">
												<div class="row">
													<div class="col-lg-6">
														<a href="{{ url('login').'?id='.$id_sekolah }}" class="btn btn-block btn-social btn-danger">
															<i class="fa fa-sign-in"></i> Login
														</a>
													</div>
													<div class="col-lg-6">
														<a href="#" id="btndaftarbaru" class="btn btn-block btn-social btn-warning">
															<i class="fa fa-user-plus"></i> Daftar
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-5 border-right">
										<div class="box box-widget widget-user">
											<div class="widget-user-header bg-green">
											  <div class="widget-user-image">
												<img class="img-circle" src="{{ asset('dist/img/wasimonghead.png') }}" alt="{{ $nama_sekolah }}">
											  </div>
											  <h3 class="widget-user-username">PPDB Online</h3>
											  <h5 class="widget-user-desc">Pendaftaran Peserta Didik Baru </h5>
											</div>
											<div class="box-footer">
												<div class="row">
													@if ($id_sekolah == 5)
														<div class="col-lg-6">
															<a href="{{url('')}}/ppdb?id={{$id_sekolah}}" class="btn btn-block btn-social btn-success">
																<i class="fa fa-bank"></i> Click Untuk Mendaftar
															</a>
														</div>
														<div class="col-lg-6">
															<a href="{{url('')}}/pip?id={{$id_sekolah}}" class="btn btn-block btn-social btn-warning">
																<i class="fa fa-graduation-cap"></i> Program Indonesia Pintar
															</a>
														</div>
													@else
														<a href="{{url('')}}/ppdb?id={{$id_sekolah}}" class="btn btn-block btn-social btn-success">
															<i class="fa fa-bank"></i> Click Untuk Mendaftar
														</a>
													@endif
												</div>
											
											</div>
										</div>
									</div>
									<div class="col-lg-3 border-right">
										<div class="box box-widget widget-user">
											<div class="widget-user-header bg-yellow">
											  <div class="widget-user-image">
												<img class="img-circle" src="{{ asset('dist/img/phead.png') }}" alt="{{ $nama_sekolah }}">
											  </div>
											  <h3 class="widget-user-username">Pembayaran ZIS</h3>
											  <h5 class="widget-user-desc">Zakat, Infaq dan Shodaqoh</h5>
											</div>
											<div class="box-footer">
												<a href="{{url('')}}/zis?id={{$id_sekolah}}" class="btn btn-block btn-social btn-warning">
													<i class="fa fa-money"></i> Click Untuk Membayar
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-2 border-right">
										<a href="{{url('')}}/frontpage?id={{$id_sekolah}}" class="btn btn-block btn-social btn-primary">
											<i class="fa fa-tv"></i> Beranda
										</a>
									</div>
									<div class="col-lg-2 border-right">
										<a href="#" id="btnprofile" class="btn btn-block btn-social btn-danger">
											<i class="fa fa-bank"></i> Profile
										</a>
									</div>
									<div class="col-lg-2 border-right">
										<a href="#" id="btninfopublik" class="btn btn-block btn-social btn-warning">
											<i class="fa fa-tripadvisor"></i> Info Publik
										</a>
									</div>
									<div class="col-lg-2 border-right">
										<a href="#" id="btnaduan" class="btn btn-block btn-social btn-info">
											<i class="fa fa-bullhorn"></i> Aduan Masyarakat
										</a>
									</div>
									<div class="col-lg-2 border-right">
										<a href="#" id="btnwbs" class="btn btn-block btn-social btn-success">
											<i class="fa fa-bell"></i> Wistle Blower System
										</a>
									</div>
									<div class="col-lg-2 border-right">
										<a href="#" id="btnbukutamu" class="btn btn-block btn-social btn-primary">
											<i class="fa fa-slideshare"></i> Buku Tamu
										</a>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 center">
										<table width="100%" class="table">
											<tr><td></td></tr>
										</table>
									</div>
									<section  class="col-md-12" id="divberanda">
									<!-- Post 1 -->
										<div class="box box-widget">
											<div class="box-header with-border">
												<div class="user-block">
													<img class="img-circle" src="{{ url('').'/'.$logo }}" alt="User Image">
													<span class="username"><a href="#">{{ $nama_sekolah }}</a></span>
													<span class="description">Shared publicly - 7:30 PM Today</span>
												</div>
											</div>
											<div class="box-body">
												<p>Selamat Datang di SIMASTER, Sistem Informasi Manajemen Sekolah Terpadu</p>
												<p>Silahkan Pilih Dari Menu-Menu Yang Telah Kami Sediakan, Bagi Orang Tua Yang Belum Memiliki Akun. Silahkan Mendaftar Terlebih Dahulu, yang perlu dipersiapkan untuk membuat <i>Account</i> di aplikasi ini adalah No. Induk Siswa dan Tanggal Lahir Siswa, Bapak/Ibu bisa menanyakan ke Admin Terkait apabila tidak mengetahui No. Induk Siswa</p>
											</div>
										</div>
								
									</section>
								</div>
								<div id="divbukutamu">
									<div class="col-md-12">
										<div class="box box-solid">
											<div class="box-header with-border">
												<h3 class="box-title">Buku Tamu</h3>
												<div class="box-tools">
													<button type="button" class="btn btn-box-tool btnkembalikepilihan" ><i class="fa fa-times"></i></button>
												</div>
											</div>
											<div class="box-body">
												<div class="row">
													<div class="col-lg-9 border-right">
														<div class="box box-solid bg-green-gradient" id="divawal">
															<div class="box-body">
																<a href="#" class="btn btn-block btn-social btn-danger" id="btnisibukutamu">
																	<i class="fa fa-users"></i>Isi Buku Tamu
																</a>
																<div id="griddaftartamu"></div>
															</div>
														</div>
														<div class="box box-solid bg-green-gradient" id="divpencarian">
															<div class="box-body">
																<div class="form-group">
																	<div class="row">
																		<div class="col-lg-6">
																			<a href="#" class="btn btn-block btn-social btn-danger" id="btnkembalidrlaporan">
																				<i class="fa fa-reply-all"></i>Tutup
																			</a>
																		</div>
																		<div class="col-lg-6">
																			<a href="#" class="btn btn-block btn-social btn-success" id="btnexport">
																				<i class="fa fa-save"></i> Export
																			</a>
																		</div>
																	</div>
																</div>
																<div id="gridpencarian"></div>
															</div>
														</div>
														<div class="box box-solid bg-red-gradient" id="divisi">
															<div class="box-body">
																<div class="row">
																	<div class="col-lg-4">
																		<img id="preview" style="margin:2px; margin-left: 10px;" width="100%" src="logo.png">
																		<input type="file" id="addfile" style="display: none;"/>
																		<a href="#" class="btn btn-block btn-social btn-twitter" id="btnambilfoto">
																			<i class="fa fa-file-image-o"></i>Ambil Foto
																		</a>
																	</div>
																	<div class="col-lg-8">
																		<div class="form-group">
																		<label for="id_nama">Nama Lengkap:</label>
																		<input type="text" id="id_nama" name="id_nama" class="form-control">
																		</div>
																		<div class="form-group">
																		<label for="id_instansi">Asal Unit Kerja / Instansi :</label>
																		<input type="text" id="id_instansi" name="id_instansi" class="form-control">
																		</div>
																		<div class="form-group">
																			<label for="id_pejabat">Menemui</label>
																			<input type="text" id="id_pejabat" name="id_pejabat" class="form-control">
																		</div>
																		<div class="form-group">
																		<label for="id_keperluan">Keperluan :</label>
																		<textarea id="id_keperluan" name="id_keperluan" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
																		</div>
																		<div class="row">
																			<div class="col-lg-6">
																				<label for="id_email">Email :</label>
																				<input type="text" id="id_email" name="id_email" class="form-control">
																			</div>
																			<div class="col-lg-6">
																				<label for="id_hape">HP :</label>
																				<input type="text" id="id_hape" name="id_hape" class="form-control">
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-6">
																				<a href="#" class="btn btn-block btn-social btn-info" id="btnkembali">
																					<i class="fa fa-reply-all"></i>Cancel
																				</a>
																			</div>
																			<div class="col-lg-6">
																				<a href="#" class="btn btn-block btn-social btn-twitter" id="btnsimpan">
																					<i class="fa fa-calendar-plus-o"></i>Isi Buku Tamu
																				</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="box box-solid bg-red-gradient" id="divlihat">
															<div class="box-body">
																<div class="row">
																	<div class="col-lg-4">
																		<img id="lihat_img" style="margin:2px; margin-left: 10px;" width="100%" src="logo.png">
																		
																	</div>
																	<div class="col-lg-8">
																		<div class="form-group">
																		<label for="lihat_nama">Nama Lengkap:</label>
																		<input type="text" id="lihat_nama" name="lihat_nama" class="form-control">
																		</div>
																		<div class="form-group">
																		<label for="lihat_instansi">Asal Unit Kerja / Instansi :</label>
																		<input type="text" id="lihat_instansi" name="lihat_instansi" class="form-control">
																		</div>
																		<div class="form-group">
																		<label for="lihat_pejabat">Menemui</label>
																		<input type="text" id="lihat_pejabat" name="lihat_pejabat" class="form-control">
																		</div>
																		<div class="form-group">
																		<label for="lihat_keperluan">Keperluan :</label>
																		<textarea id="lihat_keperluan" name="lihat_keperluan" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
																		</div>
																		<div class="row">
																			<div class="col-lg-6">
																				<label for="lihat_email">Email :</label>
																				<input type="text" id="lihat_email" name="lihat_email" class="form-control">
																			</div>
																			<div class="col-lg-6">
																				<label for="lihat_hape">HP :</label>
																				<input type="text" id="lihat_hape" name="lihat_hape" class="form-control">
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-6">
																				<input type="hidden" id="lihat_tombol">
																				<a href="#" class="btn btn-block btn-social btn-info" id="btnkembalidrlihat">
																					<i class="fa fa-reply-all"></i>Tutup
																				</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-3 border-right">
														<div class="box box-solid bg-green-gradient">
															<div class="box-header">
															<i class="fa fa-mortar-board"></i>
															<h3 class="box-title">
															View Laporan
															</h3>
															</div>
															<div class="box-body">
																<div class="form-group">
																<div class="row">
																	<div class="col-lg-6">
																		<select id="cekbln" class="form-control">
																			<option value="ALL">ALL</option>
																			<option value="01">Jan</option>
																			<option value="02">Feb</option>
																			<option value="03">Mar</option>
																			<option value="04">Apr</option>
																			<option value="05">May</option>
																			<option value="06">Jun</option>
																			<option value="07">Jul</option>
																			<option value="08">Aug</option>
																			<option value="09">Sep</option>
																			<option value="10">Oct</option>
																			<option value="11">Nov</option>
																			<option value="12">Dec</option>							 
																		</select>
																	</div>
																	<div class="input-group margin">
																		<input type="text" class="form-control" id="cekthn" value="{{ date("Y") }}">
																		<span class="input-group-btn">
																		<button class="btn btn-warning btn-flat" type="button" id="btnviewdata">View</button>
																		</span>
																	</div><!-- /input-group -->	
																</div>
																</div>
															</div><!-- /.box-body-->
														</div>
														<div class="box box-danger">
															<div class="box-header with-border">
																<i class="fa fa-briefcase"></i>
																<h3 class="box-title">Statistik Hari Ini</h3>
																<div class="box-tools pull-right">
																	<div id="timeremaining"></div>
																</div>
															</div><!-- /.box-header -->
															<div class="box-body">
																<a href="bukutamuadmin" class="btn btn-block btn-social btn-warning">
																	<i class="fa fa-globe"></i> Refresh
																</a>
																<div id="gridrekap"></div>
															</div>
														</div>
													</div>								
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="pendaftaranortu">
									<div class="col-md-12">
										<div class="box box-solid">
											<div class="box-header with-border">
												<h3 class="box-title">Pendaftaran Akun Orang Tua</h3>
												<div class="box-tools">
												<button type="button" class="btn btn-box-tool btnkembalikepilihan" ><i class="fa fa-times"></i></button>
												</div>
											</div>
											<div class="box-body">
												<div class="form-group row">
                                                    <label for="daftar_nama" class="col-sm-4 col-form-label">Nama <span class="text-danger">*</span>:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="daftar_nama" name="daftar_nama">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="daftar_ktp" class="col-sm-4 col-form-label">NIK (KTP) <span class="text-danger">*</span>:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="daftar_ktp" name="daftar_ktp">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="daftar_email" class="col-sm-4 col-form-label">Email <span class="text-danger">*</span>:</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" name="daftar_email"  id="daftar_email" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="daftar_hape" class="col-sm-4 col-form-label">No Telp / HP (WA) <span class="text-danger">*</span>:</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" name="daftar_hape"  id="daftar_hape" class="form-control" />
                                                    </div>
                                                </div>
											</div>
											<div class="box-footer">
												<input type="hidden" id="daftar_idne" value="new">
												<input type="hidden" id="daftar_fakultas" value="@if (isset($subdomainapps01)){{ $subdomainapps01 }}@else{{ config('global.yayasan') }}@endif">
												<input type="hidden" id="daftar_fakpanjang" value="@if (isset($subsubdomainapps01)){{ $subsubdomainapps01 }}@else{{ config('global.sekolah') }}@endif">
												<input type="hidden" name="id_sekolah" id="id_sekolah" value="{{$id_sekolah}}">
												<input type="hidden" name="firebaseid" id="firebaseid" value="{{$firebaseid}}">
												
												<button type="button" class="btn btn-primary" id="btn-pendaftaranortu">Daftarkan</button>
	                						</div>
											<div class="overlay">
												<i class="fa fa-refresh fa-spin"></i>
											</div>
										</div>
									</div>
								</div>
								<div id="divaduan">
									<div class="col-md-12">
										<div class="box box-solid">
											<div class="box-header with-border">
												<h3 class="box-title">Pengaduan Masyarakat</h3>
												<div class="box-tools">
													<button type="button" class="btn btn-box-tool btnkembalikepilihan" ><i class="fa fa-times"></i></button>
												</div>
											</div>
											<div class="box-body">
												<div class="form-group">
													<label>Nama Lengkap</label>
													<input type="text" id="aduan_nama" name="aduan_nama" class="form-control">	
												</div>
												<div class="form-group">
													<label>Email</label>
													<input type="text" id="aduan_email" name="aduan_email" class="form-control">	
													ditulis email lengkap beserta domainnya. contoh : admin@gmail.com
												</div>
												<div class="form-group">
													<label>Isi Pengaduan</label>
													<textarea id="aduan_isi" name="aduan_isi" rows="10" cols="80"></textarea>
												</div>
											</div>
											<div class="box-footer">
												<button type="button" class="btn btn-danger btn-block" id="btnsimpanpengaduan">Sampaikan</button>
											</div>
										</div>
									</div>
								</div>
								<div id="divprofile">
									<div class="col-md-12 center">
										<table width="100%" class="table table-bordered">
											<tr><td></td></tr>
										</table>
									</div>
									<div class="col-md-12">
										<div class="box box-widget widget-user">
											<div class="widget-user-body">
												<div class="nav-tabs-custom">
													<ul class="nav nav-tabs">
														<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
														<li><a href="#visimisi" data-toggle="tab">Visi, Misi, Tujuan, Moto dan Nilai Dasar</a></li>
														<li><a href="#strukturorganisasi" data-toggle="tab">Struktur Organisasi</a></li>
														<li><a href="#pendidik" data-toggle="tab">Data Pendidik</a></li>
														<li><a href="#jadwal" data-toggle="tab">Jadwal</a></li>
														<li><a href="#kontak" data-toggle="tab">Kontak</a></li>
													</ul>
													<div class="tab-content">
														<div class="tab-pane active" id="profile">
															<section>
																<h4 class="page-header">Profile {!! $nama_sekolah !!}</h4>
																{!! $profile !!}
															</section>
														</div>
														<div class="tab-pane" id="visimisi">
															<section>
																{!! $visimisi !!}
															</section>
														</div>
														<div class="tab-pane" id="strukturorganisasi">
															<section>
																{!! $strukturorganisasi !!}
															</section>
														</div>
														<div class="tab-pane" id="pendidik">
															<section>
																{!! $pendidik !!}
															</section>
														</div>
														<div class="tab-pane" id="jadwal">
															<section>
																{!! $jadwal !!}
															</section>
														</div>
														<div class="tab-pane" id="kontak">
															<section>
																{!! $kontak !!}
															</section>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="divinfopublik">
									<div class="col-md-12">
										<div class="box box-solid">
											<div class="box-header with-border">
												<h3 class="box-title">Informasi Publik</h3>
												<div class="box-tools">
													<button type="button" class="btn btn-box-tool btnkembalikepilihan" ><i class="fa fa-times"></i></button>
												</div>
											</div>
											<div class="box-body">
												<div class="form-group">
													<div class="col-lg-4">
														<button type="button" id="btninfoberkala" class="btn btn-primary btn-block btn-sm">
															<i class="fa fa-search"></i> Berkala
														</button>
													</div>
													<div class="col-lg-4">
														<button type="button" id="btninfosertamerta" class="btn btn-success btn-block btn-sm">
															<i class="fa fa-database"></i> Serta Merta
														</button>
													</div>
													<div class="col-lg-4">
														<button type="button" id="btninfosetiapsaat" class="btn btn-info btn-block btn-sm">
															<i class="fa fa-calendar-check-o "></i> Setiap Saat
														</button>
													</div>
												</div>
												<div class="form-group">
													<div id="divpreviewinfoberkala">{!! $pengumuman !!}</div>
													<div id="divpreviewinfosertamerta">{!! $sertamerta !!}</div>
													<div id="divpreviewinfosetiapsaat">{!! $setiapsaat !!}</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="divkomplain">
									<div class="col-md-12">
										<div class="box box-solid">
											<div class="box-header with-border">
												<h3 class="box-title">Sampaikan Keluhan Anda ke :</h3>
												<div class="box-tools">
													<a href="{{url('')}}/frontpage?id={{$id_sekolah}}"><button type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></button></a>
												</div>
											</div>
											<div class="box-body">
												<div class="form-row">
													<div class="col-lg-4">
														<div class="card-box">
															<button type="button" id="btnshowakademik" class="btn btn-primary btn-block btn-sm">
																<i class="fa fa-font icon-on-right bigger-110"></i> Keluhan Terkait Pendidikan
															</button>
															<button type="button" id="btnshowumum" class="btn btn-success btn-block btn-sm">
																<i class="fa fa-university icon-on-right bigger-110"></i> Keluhan Terkait Sarana Prasarana
															</button>
															<button type="button" id="btnshowkemahasiswaan" class="btn btn-info btn-block btn-sm">
																<i class="fa fa-trophy icon-on-right bigger-110"></i> Keluhan Terkait Kesiswaan
															</button>
															<button type="button" id="btnshowkeuangan" class="btn btn-warning btn-block btn-sm">
																<i class="fa fa-users icon-on-right bigger-110"></i> Keluhan Terkait SDM
															</button>
															<button type="button" id="btnshowpsik" class="btn btn-danger btn-block btn-sm">
																<i class="fa fa-wifi icon-on-right bigger-110"></i> Keluhan Terkait IT (Information and Technology)
															</button>
														</div>
													</div>
													<div class="col-lg-8">
														<div id="divawalkomplain">
															Yth. Bapak / Ibu / Saudara Civitas Akademika <br />
															Terima Kasih Telah Menyampaikan Keluhan Bapak /Ibu, Kami telah menanggapi dan segera melakukan tindakan terkait keluhan Bapak / Ibu / Saudara sampaikan. Untuk menunjang data Indeks Kepuasan terkait penanganan keluhan, kami mohon dengan hormat Bapak / Ibu / Saudara Memberikan Rating Terkait Penanganan Keluhan Melalui Aplikasi Ini dengan Cara Mengklik Tombol "Open" di kolom paling kanan pada tabel dibawah ini. Terima Kasih atas kerjasamanya, semoga kami dapat berkembang dan berbenah lebih baik lagi kedepannya.
															<div id="gridkeluhan"></div>
														</div>
														<div id="divakademik">
															<div class="box box-primary">
																<div class="box-header with-border">
																	<h3 class="box-title">Sampaikan Keluhan Anda</h3>
																	<div class="box-tools pull-right">
																		<button class="btn bg-teal btn-sm btkkembalimengeluh"><i class="fa fa-times"></i></button>
																	</div>
																</div><!-- /.box-header -->
																<div class="box-body">
																	<div class="form-group">
																		<label>Keluhan Tentang : </label>
																		<input type="text" id="akad_tentang" class="form-control" value="Pendidikan">
																	</div>
																	<div class="form-group">
																		<label>Isi Keluhan</label>
																		<textarea id="akad_isi" rows="10" cols="80"></textarea>
																		<p class="help-block">Mohon Menuliskan Lokasi Keluhan (Nama Gedung, Lantai, Ruangan)</p>
																	</div>
																	<div class="form-group">
																		<label>Lampiran Foto Keluhan</label>
																		<input type="file" id="akad_gambar" name="akad_gambar"> 
																	</div>
																	<div class="form-group">
																		<label>Nama</label>
																		<input type="text" id="akad_nama" class="form-control">
																	</div>
																	<div class="form-group">
																		<label>Email</label>
																		<input type="text" id="akad_status" class="form-control">
																	</div>
																	<div class="form-group">
																		<label>No. HP</label>
																		<input type="text" class="form-control" id="akad_nim" >
																	</div>
																</div><!-- /.box-body -->
																<div class="box-footer">
																	<button type="button" class="btn btn-primary btn-block" id="btnkomakademik">Sampaikan</button>
																</div>				
															</div>
														</div>
														<div id="divumum">
															<div class="box box-success">
																<div class="box-header with-border">
																	<h3 class="box-title">Sampaikan Keluhan Anda</h3>
																	<div class="box-tools pull-right">
																		<button class="btn bg-teal btn-sm btkkembalimengeluh"><i class="fa fa-times"></i></button>
																	</div>
																</div><!-- /.box-header -->
																<div class="box-body">
																	<div class="form-group">
																		<label>Keluhan Tentang : </label>
																		<input type="text" id="umum_tentang" class="form-control" value="Sarana dan Prasarana">
																	</div>
																	<div class="form-group">
																		<label>Isi Keluhan</label>
																		<textarea id="umum_isi" rows="10" cols="80"></textarea>
																		<p class="help-block">Mohon Menuliskan Lokasi Keluhan (Nama Gedung, Lantai, Ruangan)</p>
																	</div>
																	<div class="form-group">
																		<label>Lampiran Foto Keluhan</label>
																		<input type="file" id="umum_gambar" name="umum_gambar"> 
																	</div>
																	<div class="form-group">
																		<label>Nama</label>
																		<input type="text" id="umum_nama" class="form-control">
																	</div>
																	<div class="form-group">
																		<label>Email</label>
																		<input type="text" id="umum_status" class="form-control">
																	</div>
																	<div class="form-group">
																		<label>No. HP</label>
																		<input type="text" class="form-control" id="umum_nim" >
																	</div>
																</div><!-- /.box-body -->
																<div class="box-footer">
																	<button type="button" class="btn btn-success btn-block" id="btnkomakumum">Sampaikan</button>
																</div>				
															</div>
														</div>
														<div id="divkepegawaian">
															<div class="box box-info">
																<div class="box-header with-border">
																<h3 class="box-title">Sampaikan Keluhan Anda</h3>
																<div class="box-tools pull-right">
																	<button class="btn bg-teal btn-sm btkkembalimengeluh"><i class="fa fa-times"></i></button>
																</div>
																</div><!-- /.box-header -->
																<div class="box-body">
																	<div class="form-group">
																		<label>Keluhan Tentang : </label>
																		<input type="text" id="kepeg_tentang" class="form-control" value="Pejabat Yayasan / Guru / Administrator / Security">
																	</div>
																	<div class="form-group">
																		<label>Isi Keluhan</label>
																		<textarea id="kepeg_isi" rows="10" cols="80"></textarea>
																		<p class="help-block">Mohon Menuliskan Lokasi Keluhan (Nama Gedung, Lantai, Ruangan)</p>
																	</div>
																	<div class="form-group">
																		<label>Lampiran Foto Keluhan</label>
																		<input type="file" id="kepeg_gambar" name="kepeg_gambar"> 
																	</div>
																	<div class="form-group">
																		<label>Nama</label>
																		<input type="text" id="kepeg_nama" class="form-control">
																	</div>
																	<div class="form-group">
																		<label>Email</label>
																		<input type="text" id="kepeg_status" class="form-control">
																	</div>
																	<div class="form-group">
																		<label>No. HP</label>
																		<input type="text" class="form-control" id="kepeg_nim" >
																	</div>
																</div><!-- /.box-body -->
																<div class="box-footer">
																	<button type="button" class="btn btn-info btn-block" id="btnkomkepeg">Sampaikan</button>
																</div>				
															</div>
														</div>
														<div id="divkemahasiswaan">
															<div class="box box-warning">
																<div class="box-header with-border">
																	<h3 class="box-title">Sampaikan Keluhan Anda</h3>
																	<div class="box-tools pull-right">
																		<button class="btn bg-teal btn-sm btkkembalimengeluh"><i class="fa fa-times"></i></button>
																	</div>
																</div><!-- /.box-header -->
																<div class="box-body">
																	<div class="form-group">
																		<label>Keluhan Tentang : </label>
																		<input type="text" id="kmh_tentang" class="form-control" value="Kesiswaan">
																	</div>
																	<div class="form-group">
																		<label>Isi Keluhan</label>
																		<textarea id="kmh_isi" rows="10" cols="80"></textarea>
																		<p class="help-block">Mohon Menuliskan Lokasi Keluhan (Nama Gedung, Lantai, Ruangan)</p>
																	</div>
																	<div class="form-group">
																		<label>Lampiran Foto Keluhan</label>
																		<input type="file" id="kmh_gambar" name="kmh_gambar"> 
																	</div>
																	<div class="form-group">
																		<label>Nama</label>
																		<input type="text" id="kmh_nama" class="form-control">
																	</div>
																	<div class="form-group">
																		<label>Email</label>
																		<input type="text" id="kmh_status" class="form-control">
																	</div>
																	<div class="form-group">
																		<label>No. HP</label>
																		<input type="text" class="form-control" id="kmh_nim" >
																	</div>
																</div><!-- /.box-body -->
																<div class="box-footer">
																	<button type="button" class="btn btn-warning btn-block" id="btnkomkmh">Sampaikan</button>
																</div>				
															</div>
														</div>
														<div id="divpsik">
															<div class="box box-danger">
																<div class="box-header with-border">
																	<h3 class="box-title">Sampaikan Keluhan Anda</h3>
																	<div class="box-tools pull-right">
																		<button class="btn bg-teal btn-sm btkkembalimengeluh"><i class="fa fa-times"></i></button>
																	</div>
																</div><!-- /.box-header -->
																<div class="box-body">
																	<div class="form-group">
																		<label>Keluhan Tentang : </label>
																		<input type="text" id="psik_tentang" class="form-control" value="Internet / Software / Hardware">
																	</div>
																	<div class="form-group">
																		<label>Isi Keluhan</label>
																		<textarea id="psik_isi" name="psik_isi" rows="10" cols="80"></textarea>
																		<p class="help-block">Mohon Menuliskan Lokasi Keluhan (Nama Gedung, Lantai, Ruangan)</p>
																	</div>
																	<div class="form-group">
																		<label>Lampiran Foto Keluhan</label>
																		<input type="file" id="psik_gambar" name="psik_gambar"> 
																	</div>
																	<div class="form-group">
																		<label>Nama</label>
																		<input type="text" id="psik_nama" class="form-control">
																	</div>
																	<div class="form-group">
																		<label>Email</label>
																		<input type="text" id="psik_status" class="form-control">
																	</div>
																	<div class="form-group">
																		<label>No. HP</label>
																		<input type="text" class="form-control" id="psik_nim" >
																	</div>
																</div><!-- /.box-body -->
																<div class="box-footer">
																	<button type="button" class="btn btn-danger btn-block" id="btnkompsik">Sampaikan</button>
																</div>				
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
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
			<strong>Copyright &copy; 2020 <a href="{!! config('global.homeweb') !!}">{{ $nama_sekolah }}</a>.</strong> All rights reserved.
		</footer>
    </div>
	<!-- TOKEN -->
	<div class="modal fade" id="modalerror">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Error..!!!</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" readonly="readonly" id="err_text">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>	
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div class="modal fade" id="modalrating">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Apakah anda puas dengan jawaban kami.?</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<textarea id="komplain_tanggapan" name="komplain_tanggapan" rows="10" cols="80" readonly></textarea>
					</div>
					<div class="form-group">
						<select id="komplain_rating"  class="form-control">
							<option value="Netral">Silahkan Pilih salah satu</option>
							<option value="Puas">Puas</option>
							<option value="Sangat Puas">Sangat Puas</option>
							<option value="Tidak Puas">Tidak Puas</option>
							<option value="Sangat Tidak Puas">Sangat Tidak Puas</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" class="form-control" id="komplain_idne">
					<button type="button" class="btn btn-black pull-left" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-info pull-right" id="btnkirimrating">Simpan</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<input type="hidden" name="id_ukfile" id="id_ukfile">
	<input type="hidden" name="id_jnfile" id="id_jnfile">
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	<div id="tempatctk" style="overflow: hidden; display: none;">
		<div id="tabel_cetak"></div>
	</div>
	@include('base.partials.js')
	<script>
		$(function () {
			$("#ttlno1").datepicker({format: 'yyyy-mm-dd'});
			$("#ttlno2").datepicker({format: 'yyyy-mm-dd'});
			$("#ttlno3").datepicker({format: 'yyyy-mm-dd'});
			$("#ttlno4").datepicker({format: 'yyyy-mm-dd'});
			$("#ttlno5").datepicker({format: 'yyyy-mm-dd'});
			$("#ttlno6").datepicker({format: 'yyyy-mm-dd'});
			$('.select2').select2()			
			CKEDITOR.env.isCompatible = true;
			CKEDITOR.replace( 'id_keperluan', {
				toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
				removeButtons: 'Strike',
				width: '100%',
				height: 45	
			});
			CKEDITOR.replace( 'lihat_keperluan', {
				toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
				removeButtons: 'Strike',
				width: '100%',
				height: 45	
			});
			CKEDITOR.replace( 'aduan_isi', {
				toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
				removeButtons: 'Strike',
				width: '100%',
				height: 90	
			});
			CKEDITOR.replace( 'komplain_tanggapan', {
				toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
				removeButtons: 'Strike',
				width: '100%',
				height: 90	
			});
			CKEDITOR.replace( 'akad_isi', {
				toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
				removeButtons: 'Strike',
				width: '100%',
				height: 90	
			});
			CKEDITOR.replace( 'umum_isi', {
				toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
				removeButtons: 'Strike',
				width: '100%',
				height: 90	
			});
			CKEDITOR.replace( 'kepeg_isi', {
				toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
				removeButtons: 'Strike',
				width: '100%',
				height: 90	
			});
			CKEDITOR.replace( 'kmh_isi', {
				toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
				removeButtons: 'Strike',
				width: '100%',
				height: 90	
			});
			CKEDITOR.replace( 'psik_isi', {
				toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
				removeButtons: 'Strike',
				width: '100%',
				height: 90	
			});
			function addFile() {
				$('#addfile').click();
			}
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.readAsDataURL(input.files[0]);
					reader.onload = function (e) {
						$('#preview').attr('src', e.target.result);
					};
				}
			}
			$('#addfile').change(function () {
				if(this.files[0].size > 700000){
					this.value = "";
					swal({
						title: 'Mohon lengkapi',
						text: 'Maksimum File yang boleh di upload adalah 7Mb',
						type: 'info',
					});
				} else {
					var imgPath = this.value;
					var ukfile 	= this.files[0].size;
					var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
					if(ext == "jpg" || ext == "jpeg" || ext == "png") {
						readURL(this);
					} else {
						swal({
							title: 'Mohon lengkapi',
							text: 'File yang diperbolehkan hanya JPG/JPEG/PNG',
							type: 'info',
						});
					}
				}
			});			
		});
		$(document).ready(function() {
			$('#divprofile').hide();
			$('#divinfopublik').hide();
			$('#divaduan').hide();
			$('#divbukutamu').hide();
			$('#divkomplain').hide();
			$('#pendaftaranortu').hide();
			$("#btn-pendaftaranortu").click(function(){
				var set01=document.getElementById('daftar_nama').value;
                var set02=document.getElementById('daftar_ktp').value;
                var set03=document.getElementById('daftar_email').value;
                var set04=document.getElementById('daftar_hape').value;
                var set05=document.getElementById('daftar_fakultas').value;
                var set06=document.getElementById('daftar_fakpanjang').value;
                var set07=document.getElementById('firebaseid').value;
                var set08=document.getElementById('id_sekolah').value;
                var token=document.getElementById('token').value;
                if (set01 == ''){ 
                    swal({
                        title: 'Mohon lengkapi',
                        text: 'Nama Lengkap Wajib di Isi',
                        type: 'info',
                    });
                } else if (set02 == ''){ 
                    swal({
                        title: 'Mohon lengkapi',
                        text: 'KTP Belum Terisi',
                        type: 'info',
                    });
                } else if (set03 == ''){
                    swal({
                        title: 'Mohon lengkapi',
                        text: 'Email Aktif Wajib di Isi',
                        type: 'info',
                    });
                } else if (set04 == ''){ 
                    swal({
                        title: 'Mohon lengkapi',
                        text: 'No. HP Wajib di Isi',
                        type: 'info',
                    });
                } else {
                    $('.overlay').show();
					var formdata = new FormData();
                        formdata.set('val01',set01);
                        formdata.set('val02',set02);
                        formdata.set('val03',set03);
                        formdata.set('val04',set04);
                        formdata.set('val05',set08);
                        formdata.set('val06',set06);
                        formdata.set('firebaseid',set07);
                        formdata.set('_token',token);
                    url='{{ route("exDaftarBaru") }}';
                    $.ajax({
                        type        : 'ajax',
                        url         : url,
                        method      : 'post',
                        data        : formdata,
                        cache       : false,
                        contentType : false,
                        processData : false,
                        dataType    : 'json',
                        success: function(response, status, xhr) {
                            $.toast({
								heading: response.status,
								text: response.message,
								position: 'top-right',
								loaderBg: response.warna,
								icon: response.icon,
								hideAfter: 5000,
								stack: 1
							});
                            $('.overlay').hide();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $('.overlay').hide();
							swal({
                                title: textStatus,
                                text:  jqXHR.responseText,
                                type: 'info',
                            });
                        }
                    });
                }
			});
			
			$("#btnsimpanpengaduan").click(function(){
				var set01 	= '';
				var set02	= document.getElementById('aduan_nama').value;
				var set03	= document.getElementById('aduan_email').value;
				var set04	= '-';
				var set05	= 'ADUAN';
				var set06	= CKEDITOR.instances['aduan_isi'].getData()
				var token 	= document.getElementById('token').value;
				var set07	= 'ADUAN';
				var set08	= document.getElementById('id_sekolah').value;
				if (set06 == ''){ 
					$("#err_text").val('Mohon di Isi Komplain Anda'); 
					$("#modalerror").modal('show');
				} else if (set03 == ''){ 
					$("#err_text").val('Mohon di Isi Email Anda'); 
					$("#modalerror").modal('show');
				} else {
					var form_data = new FormData();
					form_data.append('file', null);
					form_data.append('val01', set02);
					form_data.append('val02', set03);
					form_data.append('val03', set04);
					form_data.append('val04', set05);
					form_data.append('val05', set06);
					form_data.append('val06', set07);
					form_data.append('val07', set08);
					form_data.append('_token', '{{csrf_token()}}');
					$.ajax({
						url: '{{ route("savekomplain") }}',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							var status  = data.status;
							var message = data.message;
							var warna 	= data.warna;
							var icon 	= data.icon;
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
							alert(xhr.responseText);
						}
					});
				}
			});
			$(".btnkembalikepilihan").click(function(){
				$('#divberanda').show();
				$('#divprofile').hide();
				$('#divinfopublik').hide();
				$('#pendaftaranortu').hide();
				$('#divbukutamu').hide();
				$('#divpilihan').show();
				$('#divaduan').hide();
			});
			$(".btkkembalimengeluh").click(function(){
				$('#divawalkomplain').show();
				$('#divakademik').hide();
				$('#divkemahasiswaan').hide();
				$('#divumum').hide();
				$('#divkepegawaian').hide();
				$('#divpsik').hide();
			});
			$("#btnaduan").click(function(){
				$('#divberanda').hide();
				$('#divprofile').hide();
				$('#divinfopublik').hide();
				$('#divbukutamu').hide();
				$('#divkomplain').hide();
				$('#divaduan').show();
				$('#divakademik').hide();
				$('#divumum').hide();
				$('#divkepegawaian').hide();
				$('#divkemahasiswaan').hide();
				$('#pendaftaranortu').hide();
				$('#divpsik').hide();
			});
			$("#btninfopublik").click(function(){
				$('#divberanda').hide();
				$('#divprofile').hide();
				$('#divinfopublik').show();
				$('#divpreviewinfoberkala').show();
				$('#divpreviewinfosertamerta').hide();
				$('#divpreviewinfosetiapsaat').hide();
				$('#divbukutamu').hide();
				$('#divkomplain').hide();
				$('#divaduan').hide();
				$('#divakademik').hide();
				$('#divumum').hide();
				$('#divkepegawaian').hide();
				$('#divkemahasiswaan').hide();
				$('#pendaftaranortu').hide();
				$('#divpsik').hide();
			});
			$("#btninfoberkala").click(function(){
				$('#divberanda').hide();
				$('#divprofile').hide();
				$('#divinfopublik').show();
				$('#divpreviewinfoberkala').show();
				$('#divpreviewinfosertamerta').hide();
				$('#divpreviewinfosetiapsaat').hide();
				$('#divbukutamu').hide();
				$('#divkomplain').hide();
				$('#divaduan').hide();
				$('#divakademik').hide();
				$('#divumum').hide();
				$('#divkepegawaian').hide();
				$('#divkemahasiswaan').hide();
				$('#pendaftaranortu').hide();
				$('#divpsik').hide();
			});
			$("#btninfosertamerta").click(function(){
				$('#divberanda').hide();
				$('#divprofile').hide();
				$('#divinfopublik').show();
				$('#divpreviewinfoberkala').hide();
				$('#divpreviewinfosertamerta').show();
				$('#divpreviewinfosetiapsaat').hide();
				$('#divbukutamu').hide();
				$('#divkomplain').hide();
				$('#divaduan').hide();
				$('#divakademik').hide();
				$('#divumum').hide();
				$('#divkepegawaian').hide();
				$('#divkemahasiswaan').hide();
				$('#pendaftaranortu').hide();
				$('#divpsik').hide();
			});
			$("#btninfosetiapsaat").click(function(){
				$('#divberanda').hide();
				$('#divprofile').hide();
				$('#divinfopublik').show();
				$('#divpreviewinfoberkala').hide();
				$('#divpreviewinfosertamerta').hide();
				$('#divpreviewinfosetiapsaat').show();
				$('#divbukutamu').hide();
				$('#divkomplain').hide();
				$('#divaduan').hide();
				$('#divakademik').hide();
				$('#divumum').hide();
				$('#divkepegawaian').hide();
				$('#divkemahasiswaan').hide();
				$('#pendaftaranortu').hide();
				$('#divpsik').hide();
			});
			$("#btnprofile").click(function(){
				$('#divberanda').hide();
				$('#divprofile').show();
				$('#divinfopublik').hide();
				$('#divbukutamu').hide();
				$('#divkomplain').hide();
				$('#divaduan').hide();
				$('#divakademik').hide();
				$('#divumum').hide();
				$('#divkepegawaian').hide();
				$('#divkemahasiswaan').hide();
				$('#pendaftaranortu').hide();
				$('#divpsik').hide();
			});
			$("#btnwbs").click(function(){
				$('#divberanda').hide();
				$('#divprofile').hide();
				$('#divinfopublik').hide();
				$('#divbukutamu').hide();
				$('#divkomplain').show();
				$('#divaduan').hide();
				$('#divakademik').hide();
				$('#divumum').hide();
				$('#divkepegawaian').hide();
				$('#divkemahasiswaan').hide();
				$('#pendaftaranortu').hide();
				$('#divpsik').hide();
			});
			$("#btnbukutamu").click(function(){
				$('#divberanda').hide();
				$('#divprofile').hide();
				$('#divinfopublik').hide();
				$('#pendaftaranortu').hide();
				$('#divbukutamu').show();
				$('#divkomplain').hide();
				var set01=document.getElementById('id_sekolah').value;
				var token=document.getElementById('token').value;
				var source = {
					datatype: "json",
					datafields: [
						{ name: 'pejabat', type: 'text'},	
						{ name: 'jumlah', type: 'text'},
					],
					type: 'POST',
					data: {val01: set01, _token: token},
					url: 'tamu/rekaptamu',
				};
				var datajrekap = new $.jqx.dataAdapter(source);
				$("#gridrekap").jqxGrid({
					width: '100%',
					columnsresize: true,
					autoheight: true,
					sortable: true,
					pageable: true,
					source: datajrekap,
					theme: "orange",
					columns: [
						{ text: 'Pejabat', datafield: 'pejabat', width: '80%', cellsalign: 'left', align: 'center'},
						{ text: 'Jumlah', datafield: 'jumlah', width: '20%', cellsalign: 'center', align: 'center'},
					],
				});
				var sourcetamu = {
					datatype: "json",
					datafields: [
						{ name: 'id'},
						{ name: 'nama'},
						{ name: 'instansi', type: 'text'},
						{ name: 'pejabat', type: 'text'},
						{ name: 'keperluan', type: 'text'},
						{ name: 'hape', type: 'text'},
						{ name: 'email', type: 'text'},
						{ name: 'tanggal', type: 'text'},
						{ name: 'foto', type: 'text'},
					],
					type: 'POST',
					data: {val01: set01, _token: token},
					url: 'tamu/bukutamu',
				};
				var datajtamu = new $.jqx.dataAdapter(sourcetamu);
				var photorenderer = function (row, column, value) {
					var foto 		= $('#griddaftartamu').jqxGrid('getrowdata', row).foto;
					var nama 		= $('#griddaftartamu').jqxGrid('getrowdata', row).nama;
					var instansi 	= $('#griddaftartamu').jqxGrid('getrowdata', row).instansi;
					var pejabat 	= $('#griddaftartamu').jqxGrid('getrowdata', row).pejabat;
					var keperluan 	= $('#griddaftartamu').jqxGrid('getrowdata', row).keperluan;
					var hape 		= $('#griddaftartamu').jqxGrid('getrowdata', row).hape;
					var email 		= $('#griddaftartamu').jqxGrid('getrowdata', row).email;
					
					if (foto == ''){
						var foto = 'logo.png';					
					}
					var img = '<div style="background: white;"><a href="#" id1="'+foto+'" id2="'+nama+'" id3="'+instansi+'"  id4="'+pejabat+'" id5="'+keperluan+'" id6="'+hape+'" id7="'+email+'" class="lihat"><img style="margin:2px; margin-left: 10px;" width="50" height="50" src="' + foto + '"></a></div>';
							
					return img;
				}
				$("#griddaftartamu").jqxGrid({
					width: '100%',
					height: '600',
					rowsheight: 50,
					filterable: true,
					showfilterrow: true,
					columnsresize: true,
					pageable: false,
					source: datajtamu,
					theme: "energyblue",
					rendered: function () {
						$( ".lihat" ).click( function () {
							var valfoto			= $(this).attr('id1');
							var valnama			= $(this).attr('id2');
							var valinstansi		= $(this).attr('id3');
							var valpejabat		= $(this).attr('id4');
							var valkeperluan	= $(this).attr('id5');
							var valhape			= $(this).attr('id6');
							var valemail		= $(this).attr('id7');
							$('#lihat_img').attr('src',valfoto);
							$("#lihat_nama").val(valnama);
							$("#lihat_instansi").val(valinstansi);
							$("#lihat_email").val(valemail);
							$("#lihat_hape").val(valhape);
							$("#lihat_pejabat").val(valpejabat);
							$("#lihat_tombol").val('awal');
							CKEDITOR.instances['lihat_keperluan'].setData(valkeperluan)
							$('#divisi').hide();
							$('#divpencarian').hide();
							$('#divawal').hide();
							$('#divlihat').show();
						});
					},
					columns: [					
						{ text: 'Photo', editable: false, sortable: false, filterable: false,  width: '8%', cellsrenderer: photorenderer },
						{ text: 'Tanggal', datafield: 'tanggal', filtertype: 'checkedlist', width: '15%', cellsalign: 'left', align: 'center'  },
						{ text: 'Menemui', filtertype: 'checkedlist', datafield: 'pejabat', width: '17%', cellsalign: 'left', align: 'center'  },
						{ text: 'Keperluan', datafield: 'keperluan', width: '20%', cellsalign: 'left', align: 'center'  },
						{ text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'  },
						{ text: 'Asal Unit Kerja / Instansi', datafield: 'instansi', width: '20%', cellsalign: 'left', align: 'center'  },
					],
				});
			});	
			$("#btndaftarbaru").click(function(){
				$('.overlay').hide();
				$('#divpilihan').hide();
				$('#divberanda').hide();
				$('#divprofile').hide();
				$('#divinfopublik').hide();
				$('#divkomplain').hide();
				$('#pendaftaranortu').show();
				$('#divbukutamu').hide();
				$('#divaduan').hide();
			});	
			$('#divpencarian').hide();
			$('#divisi').hide();
			$('#divlihat').hide();
			$('#btnisibukutamu').click(function () {
				$('#divisi').show();
				$('#divpencarian').hide();
				$('#divawal').hide();
				$('#preview').attr('src','duidev-softwarehouse.png');
				$("#addfile").val('');
				$("#id_nama").val('');
				$("#id_instansi").val('');
				$("#id_email").val('');
				$("#id_hape").val('');
				$("#id_pejabat").val('').trigger('change');
				CKEDITOR.instances['id_keperluan'].setData('')
			});
			$('#btnkembali').click(function () {
				$('#divisi').hide();
				$('#divpencarian').hide();
				$('#divawal').show();
				$('#divlihat').hide();
			});
			$('#btnkembalidrlihat').click(function () {
				var set01=document.getElementById('lihat_tombol').value;
				if (set01 == 'cari'){
					$('#divawal').hide();
					$('#divpencarian').show();
				} else {
					$('#divawal').show();
					$('#divpencarian').hide();
				}
				$('#divisi').hide();		
				$('#divlihat').hide();
			});
			$('#btnkembalidrlaporan').click(function () {
				$('#divisi').hide();
				$('#divpencarian').hide();
				$('#divawal').show();
				$('#divlihat').hide();
			});
			$('#btnambilfoto').click(function () {
				$('#addfile').click();
			});
			$("#btnsimpan").click(function(){
				var set01 	= document.getElementById('addfile');
				var set02	= document.getElementById('id_nama').value;
				var set03	= document.getElementById('id_instansi').value;
				var set04	= document.getElementById('id_pejabat').value;
				var set05	= CKEDITOR.instances['id_keperluan'].getData();
				var set06	= document.getElementById('id_email').value;
				var set07	= document.getElementById('id_hape').value;				
				var set08	= document.getElementById('id_sekolah').value;				
				var token 	= document.getElementById('token').value;
				if (set02 == ''){ 
					swal({
						title: 'Mohon lengkapi',
						text: 'Nama Lengkap Wajib di Isi',
						type: 'info',
					});
				}
				else if (set03 == ''){ 
					swal({
						title: 'Mohon lengkapi',
						text: 'Unit / Fakultas / Instansi Pemohon Belum Terisi',
						type: 'info',
					});
				}
				else if (set04 == ''){ 
					swal({
						title: 'Mohon lengkapi',
						text: 'Pejabat Yang Akan di Temui',
						type: 'info',
					});
				}
				else if (set05 == ''){ 
					swal({
						title: 'Mohon lengkapi',
						text: 'Keperluan Wajib di Isi',
						type: 'info',
					});
				}
				else if (set07 == ''){ 
					swal({
						title: 'Mohon lengkapi',
						text: 'No. HP Wajib di Isi',
						type: 'info',
					});
				}
				else {
					$('#divisi').hide();
					var form_data = new FormData();
					form_data.append('file', set01.files[0]);
					form_data.append('val02', set02);
					form_data.append('val03', set03);
					form_data.append('val04', set04);
					form_data.append('val05', set05);
					form_data.append('val06', set06);
					form_data.append('val07', set07);
					form_data.append('val08', set08);
					form_data.append('_token', '{{csrf_token()}}');
					$.ajax({
						url: '{{ route("exbukutamu") }}',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							var status  = data.status;
							var message = data.message;
							var warna 	= data.warna;
							var icon 	= data.icon;
							$('#divawal').show();
							$("#gridrekap").jqxGrid('updatebounddata');
							$("#griddaftartamu").jqxGrid('updatebounddata');
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
								title: 'Error..!!!',
								text: xhr.responseText,
								type: 'info',
							});
						}
					});
				}
			});
			$('#btnviewdata').click(function () {
				var set01=document.getElementById('cekthn').value;
				var set02=document.getElementById('cekbln').value;
				var set03=document.getElementById('id_sekolah').value;
				var token=document.getElementById('token').value;
				var source = {
					datatype: "json",
					datafields: [
						{ name: 'id'},
						{ name: 'nama'},
						{ name: 'instansi', type: 'text'},
						{ name: 'pejabat', type: 'text'},
						{ name: 'keperluan', type: 'text'},
						{ name: 'hape', type: 'text'},
						{ name: 'email', type: 'text'},
						{ name: 'tanggal', type: 'text'},
						{ name: 'foto', type: 'text'},
					],
					type: 'POST',
					data: {val01: set01, val02: set02, val03: set03, _token: token},
					url: 'tamu/carilaptamu',
				};
				var dataAdapter = new $.jqx.dataAdapter(source);
				var gambartamu = function (row, column, value) {
					var foto 		= $('#gridpencarian').jqxGrid('getrowdata', row).foto;
					var nama 		= $('#gridpencarian').jqxGrid('getrowdata', row).nama;
					var instansi 	= $('#gridpencarian').jqxGrid('getrowdata', row).instansi;
					var pejabat 	= $('#gridpencarian').jqxGrid('getrowdata', row).pejabat;
					var keperluan 	= $('#gridpencarian').jqxGrid('getrowdata', row).keperluan;
					var hape 		= $('#gridpencarian').jqxGrid('getrowdata', row).hape;
					var email 		= $('#gridpencarian').jqxGrid('getrowdata', row).email;
					
					if (foto == ''){
						var foto = 'logo.png';					
					}
					var img = '<div style="background: white;"><a href="#" id1="'+foto+'" id2="'+nama+'" id3="'+instansi+'"  id4="'+pejabat+'" id5="'+keperluan+'" id6="'+hape+'" id7="'+email+'" class="lihat"><img style="margin:2px; margin-left: 10px;" width="50" height="50" src="' + foto + '"></a></div>';
							
					return img;
				}
				$('#divawal').hide();
				$('#divpencarian').show();
				$('#divisi').hide();
				$('#divlihat').hide();
				$("#gridpencarian").jqxGrid({
					width: '100%',
					height: 480,
					rowsheight: 50,
					pageable: false,
					autoheight: true,
					filterable: true,
					source: dataAdapter,
					columnsresize: true,
					showfilterrow: true,
					theme: "energyblue",
					altrows: true,
					sortable: true,
					selectionmode: 'singlecell',
					rendered: function () {
						$( ".lihat" ).click( function () {
							var valfoto			= $(this).attr('id1');
							var valnama			= $(this).attr('id2');
							var valinstansi		= $(this).attr('id3');
							var valpejabat		= $(this).attr('id4');
							var valkeperluan	= $(this).attr('id5');
							var valhape			= $(this).attr('id6');
							var valemail		= $(this).attr('id7');
							$('#lihat_img').attr('src',valfoto);
							$("#lihat_nama").val(valnama);
							$("#lihat_instansi").val(valinstansi);
							$("#lihat_email").val(valemail);
							$("#lihat_hape").val(valhape);
							$("#lihat_pejabat").val(valpejabat);
							$("#lihat_tombol").val('cari');
							CKEDITOR.instances['lihat_keperluan'].setData(valkeperluan)
							$('#divisi').hide();
							$('#divpencarian').hide();
							$('#divawal').hide();
							$('#divlihat').show();
						});
					},
					columns: [					
						{ text: 'Photo', editable: false, sortable: false, filterable: false,  width: '10%', cellsrenderer: gambartamu },
						{ text: 'Tanggal', datafield: 'tanggal', filtertype: 'checkedlist', width: '15%', cellsalign: 'left', align: 'center'  },
						{ text: 'Menemui', filtertype: 'checkedlist', datafield: 'pejabat', width: '25%', cellsalign: 'left', align: 'center'  },
						{ text: 'Keperluan', datafield: 'keperluan', width: '20%', cellsalign: 'left', align: 'center'  },
						{ text: 'Nama', datafield: 'nama', width: '25%', cellsalign: 'left', align: 'center'  },
						{ text: 'Asal Unit Kerja / Instansi', datafield: 'instansi', width: '15%', cellsalign: 'left', align: 'center'  },
						{ text: 'Email', datafield: 'email', width: '10%', cellsalign: 'left', align: 'center'  },
						{ text: 'Handphone', datafield: 'hape', width: '10%', cellsalign: 'left', align: 'center'  },				
					],
				});
			});
			$('#btnexport').click(function(){			
				var gridContent = $("#gridpencarian").jqxGrid('exportdata', 'json');
				data = $.parseJSON(gridContent);
				var noOfContacts = data.length;
				if(noOfContacts>0){
					var table = document.createElement("table");
						table.style.width = '100%';
						table.setAttribute('border', '1');
						table.setAttribute('cellspacing', '0');
						table.setAttribute('cellpadding', '5');
						table.setAttribute('id', 'tabelcetak');
						table.setAttribute('class', 'text');
					var col = [];
					for (var i = 0; i < noOfContacts; i++) {
						for (var key in data[i]) {
							if (col.indexOf(key) === -1) {
								col.push(key);
							}
						}
					}
					var tHead = document.createElement("thead");
					var hRow = document.createElement("tr");
					for (var i = 0; i < col.length; i++) {
							var th = document.createElement("th");
							th.innerHTML = col[i];
							hRow.appendChild(th);
					}
					tHead.appendChild(hRow);
					table.appendChild(tHead);
					var tBody = document.createElement("tbody");
					for (var i = 0; i < noOfContacts; i++) {
						var bRow = document.createElement("tr");
						for (var j = 0; j < col.length; j++) {
							var td 		= document.createElement("td");
							var isi 	= data[i][col[j]];
							var isi2 	= isi.toString();
							var pjg 	= isi2.length;
							if (pjg > 8){
								if (pjg == 9 || pjg == 10){
									if( isi2.indexOf(',') != -1 ){
										var res = isi2.replace(/,/g, "");
										td.innerHTML = res;
									}
									else {
										var res = isi2;
										td.setAttribute('style', 'mso-number-format: "\@";');
										td.innerHTML = res;
									}
								}
								else { 
									var res = isi2;
									td.setAttribute('style', 'mso-number-format: "\@";');
									td.innerHTML = res;
								}						
							}
							else {
								var res = isi2.replace(/,/g, "");
								td.innerHTML = res;
							}
								
							bRow.appendChild(td);
						}
						tBody.appendChild(bRow)
					}
					table.appendChild(tBody);
					var divContainer = document.getElementById("tabel_cetak");
						divContainer.innerHTML = "";
						divContainer.appendChild(table);
				}
				
				$("#tabel_cetak").btechco_excelexport({
					containerid: "tabel_cetak"
					, datatype: $datatype.Table
				});
				return false;
			});
			$("#btnshowakademik").click(function(){
				$('#divawalkomplain').hide();
				$('#divakademik').show();
				$('#divkemahasiswaan').hide();
				$('#divumum').hide();
				$('#divkepegawaian').hide();
				$('#divpsik').hide();
			});
			$("#btnshowkemahasiswaan").click(function(){
				$('#divawalkomplain').hide();
				$('#divakademik').hide();
				$('#divkemahasiswaan').show();
				$('#divumum').hide();
				$('#divkepegawaian').hide();
				$('#divpsik').hide();
			});
			$("#btnshowkeuangan").click(function(){
				$('#divawalkomplain').hide();
				$('#divakademik').hide();
				$('#divkemahasiswaan').hide();
				$('#divumum').hide();
				$('#divkepegawaian').show();
				$('#divpsik').hide();
			});
			$("#btnshowpsik").click(function(){
				$('#divawalkomplain').hide();
				$('#divakademik').hide();
				$('#divkemahasiswaan').hide();
				$('#divumum').hide();
				$('#divkepegawaian').hide();
				$('#divpsik').show();
			});
			$("#btnshowumum").click(function(){
				$('#divawalkomplain').hide();
				$('#divakademik').hide();
				$('#divkemahasiswaan').hide();
				$('#divumum').show();
				$('#divkepegawaian').hide();
				$('#divpsik').hide();
			});
			$("#btnkomakademik").click(function(){
				var set01 	= document.getElementById('akad_gambar');
				var set02	= document.getElementById('akad_nama').value;
				var set03	= document.getElementById('akad_nim').value;
				var set04	= document.getElementById('akad_status').value;
				var set05	= document.getElementById('akad_tentang').value;
				var set06	= CKEDITOR.instances['akad_isi'].getData()
				var token 	= document.getElementById('token').value;
				var set07	= 'Akademik';
				var set08	= document.getElementById('id_sekolah').value;
				if (set06 == ''){ 
					$("#err_text").val('Mohon di Isi Komplain Anda'); 
					$("#modalerror").modal('show');
				} else if (set03 == ''){ 
					$("#err_text").val('Mohon di Isi Nomor HP Anda'); 
					$("#modalerror").modal('show');
				} else {
					var form_data = new FormData();
					form_data.append('file', set01.files[0]);
					form_data.append('val01', set02);
					form_data.append('val02', set03);
					form_data.append('val03', set04);
					form_data.append('val04', set05);
					form_data.append('val05', set06);
					form_data.append('val06', set07);
					form_data.append('val07', set08);
					form_data.append('_token', '{{csrf_token()}}');
					$.ajax({
						url: '{{ route("savekomplain") }}',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							var status  = data.status;
							var message = data.message;
							var warna 	= data.warna;
							var icon 	= data.icon;
							$.toast({
								heading: status,
								text: message,
								position: 'top-right',
								loaderBg: warna,
								icon: icon,
								hideAfter: 5000,
								stack: 1
							});
							$('#divawalkomplain').show();
							$('#divakademik').hide();
							$('#divkemahasiswaan').hide();
							$('#divumum').hide();
							$('#divkepegawaian').hide();
							$('#divpsik').hide();
							$("#gridkeluhan").jqxGrid('updatebounddata', 'filter');		
							return false;
						},
						error: function (xhr, status, error) {
							alert(xhr.responseText);
						}
					});
				}
			});
			$("#btnkomakumum").click(function(){
				var set01 	= document.getElementById('umum_gambar');
				var set02	= document.getElementById('umum_nama').value;
				var set03	= document.getElementById('umum_nim').value;
				var set04	= document.getElementById('umum_status').value;
				var set05	= document.getElementById('umum_tentang').value;
				var set06	= CKEDITOR.instances['umum_isi'].getData()
				var token 	= document.getElementById('token').value;
				var set07	= 'Sarana dan Prasarana';
				var set08	= document.getElementById('id_sekolah').value;
				if (set06 == ''){ 
					$("#err_text").val('Mohon di Isi Komplain Anda'); 
					$("#modalerror").modal('show');
				} else if (set03 == ''){ 
					$("#err_text").val('Mohon di Isi Nomor HP Anda'); 
					$("#modalerror").modal('show');
				} else {
					var form_data = new FormData();
					form_data.append('file', set01.files[0]);
					form_data.append('val01', set02);
					form_data.append('val02', set03);
					form_data.append('val03', set04);
					form_data.append('val04', set05);
					form_data.append('val05', set06);
					form_data.append('val06', set07);
					form_data.append('val07', set08);
					form_data.append('_token', '{{csrf_token()}}');
					$.ajax({
						url: '{{ route("savekomplain") }}',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							var status  = data.status;
							var message = data.message;
							var warna 	= data.warna;
							var icon 	= data.icon;
							$.toast({
								heading: status,
								text: message,
								position: 'top-right',
								loaderBg: warna,
								icon: icon,
								hideAfter: 5000,
								stack: 1
							});
							$('#divawalkomplain').show();
							$('#divakademik').hide();
							$('#divkemahasiswaan').hide();
							$('#divumum').hide();
							$('#divkepegawaian').hide();
							$('#divpsik').hide();
							$("#gridkeluhan").jqxGrid('updatebounddata', 'filter');		
							return false;
						},
						error: function (xhr, status, error) {
							alert(xhr.responseText);
						}
					});
				}
			});
			$("#btnkomkepeg").click(function(){
				var set01 	= document.getElementById('kepeg_gambar');
				var set02	= document.getElementById('kepeg_nama').value;
				var set03	= document.getElementById('kepeg_nim').value;
				var set04	= document.getElementById('kepeg_status').value;
				var set05	= document.getElementById('kepeg_tentang').value;
				var set06	= CKEDITOR.instances['kepeg_isi'].getData()
				var token 	= document.getElementById('token').value;
				var set07	= 'Kepegawaian';
				var set08	= document.getElementById('id_sekolah').value;
				if (set06 == ''){ 
					$("#err_text").val('Mohon di Isi Komplain Anda'); 
					$("#modalerror").modal('show');
				} else if (set03 == ''){ 
					$("#err_text").val('Mohon di Isi Nomor HP Anda'); 
					$("#modalerror").modal('show');
				} else {
					var form_data = new FormData();
					form_data.append('file', set01.files[0]);
					form_data.append('val01', set02);
					form_data.append('val02', set03);
					form_data.append('val03', set04);
					form_data.append('val04', set05);
					form_data.append('val05', set06);
					form_data.append('val06', set07);
					form_data.append('val07', set08);
					form_data.append('_token', '{{csrf_token()}}');
					$.ajax({
						url: '{{ route("savekomplain") }}',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							var status  = data.status;
							var message = data.message;
							var warna 	= data.warna;
							var icon 	= data.icon;
							$.toast({
								heading: status,
								text: message,
								position: 'top-right',
								loaderBg: warna,
								icon: icon,
								hideAfter: 5000,
								stack: 1
							});
							$('#divawalkomplain').show();
							$('#divakademik').hide();
							$('#divkemahasiswaan').hide();
							$('#divumum').hide();
							$('#divkepegawaian').hide();
							$('#divpsik').hide();
							$("#gridkeluhan").jqxGrid('updatebounddata', 'filter');		
							return false;
						},
						error: function (xhr, status, error) {
							alert(xhr.responseText);
						}
					});
				}
			});
			$("#btnkomkmh").click(function(){
				var set01 	= document.getElementById('kmh_gambar');
				var set02	= document.getElementById('kmh_nama').value;
				var set03	= document.getElementById('kmh_nim').value;
				var set04	= document.getElementById('kmh_status').value;
				var set05	= document.getElementById('kmh_tentang').value;
				var set06	= CKEDITOR.instances['kmh_isi'].getData()
				var token 	= document.getElementById('token').value;
				var set07	= 'Kemahasiswaan';
				var set08	= document.getElementById('id_sekolah').value;
				if (set06 == ''){ 
					$("#err_text").val('Mohon di Isi Komplain Anda'); 
					$("#modalerror").modal('show');
				} else if (set03 == ''){ 
					$("#err_text").val('Mohon di Isi Nomor HP Anda'); 
					$("#modalerror").modal('show');
				} else {
					var form_data = new FormData();
					form_data.append('file', set01.files[0]);
					form_data.append('val01', set02);
					form_data.append('val02', set03);
					form_data.append('val03', set04);
					form_data.append('val04', set05);
					form_data.append('val05', set06);
					form_data.append('val06', set07);
					form_data.append('val07', set08);
					form_data.append('_token', '{{csrf_token()}}');
					$.ajax({
						url: '{{ route("savekomplain") }}',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							var status  = data.status;
							var message = data.message;
							var warna 	= data.warna;
							var icon 	= data.icon;
							$.toast({
								heading: status,
								text: message,
								position: 'top-right',
								loaderBg: warna,
								icon: icon,
								hideAfter: 5000,
								stack: 1
							});
							$('#divawalkomplain').show();
							$('#divakademik').hide();
							$('#divkemahasiswaan').hide();
							$('#divumum').hide();
							$('#divkepegawaian').hide();
							$('#divpsik').hide();
							$("#gridkeluhan").jqxGrid('updatebounddata', 'filter');		
							return false;
						},
						error: function (xhr, status, error) {
							alert(xhr.responseText);
						}
					});
				}
			});
			$("#btnkompsik").click(function(){
				var set01 	= document.getElementById('psik_gambar');
				var set02	= document.getElementById('psik_nama').value;
				var set03	= document.getElementById('psik_nim').value;
				var set04	= document.getElementById('psik_status').value;
				var set05	= document.getElementById('psik_tentang').value;
				var set06	= CKEDITOR.instances['psik_isi'].getData()
				var token 	= document.getElementById('token').value;
				var set07	= 'PSIK';
				var set08	= document.getElementById('id_sekolah').value;
				if (set06 == ''){ 
					$("#err_text").val('Mohon di Isi Komplain Anda'); 
					$("#modalerror").modal('show');
				} else if (set03 == ''){ 
					$("#err_text").val('Mohon di Isi Nomor HP Anda'); 
					$("#modalerror").modal('show');
				} else {
					var form_data = new FormData();
					form_data.append('file', set01.files[0]);
					form_data.append('val01', set02);
					form_data.append('val02', set03);
					form_data.append('val03', set04);
					form_data.append('val04', set05);
					form_data.append('val05', set06);
					form_data.append('val06', set07);
					form_data.append('val07', set08);
					form_data.append('_token', '{{csrf_token()}}');
					$.ajax({
						url: '{{ route("savekomplain") }}',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							var status  = data.status;
							var message = data.message;
							var warna 	= data.warna;
							var icon 	= data.icon;
							$.toast({
								heading: status,
								text: message,
								position: 'top-right',
								loaderBg: warna,
								icon: icon,
								hideAfter: 5000,
								stack: 1
							});
							$('#divawalkomplain').show();
							$('#divakademik').hide();
							$('#divkemahasiswaan').hide();
							$('#divumum').hide();
							$('#divkepegawaian').hide();
							$('#divpsik').hide();
							$("#gridkeluhan").jqxGrid('updatebounddata', 'filter');		
							return false;
						},
						error: function (xhr, status, error) {
							alert(xhr.responseText);
						}
					});
				}
			});
			$("#btnkirimrating").click(function(){
				var set01 	= '';
				var set02	= document.getElementById('komplain_rating').value;
				var set03	= document.getElementById('komplain_idne').value;
				var token 	= document.getElementById('token').value;
				if (set02 == ''){ 
					$("#err_text").val('Mohon di Isi Rating Anda'); 
					$("#modalerror").modal('show');
				} else {
					$("#modalrating").modal('hide');
					var form_data = new FormData();
					form_data.append('file', '');
					form_data.append('val01', set02);
					form_data.append('val02', set03);
					form_data.append('_token', '{{csrf_token()}}');
					$.ajax({
						url: '{{ route("saverating") }}',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							var status  = data.status;
							var message = data.message;
							var warna 	= data.warna;
							var icon 	= data.icon;
							$.toast({
								heading: status,
								text: message,
								position: 'top-right',
								loaderBg: warna,
								icon: icon,
								hideAfter: 5000,
								stack: 1
							});
							$("#gridkeluhan").jqxGrid('updatebounddata', 'filter');		
							return false;
						},
						error: function (xhr, status, error) {
							alert(xhr.responseText);
						}
					});
				}
			});
		});
	</script>
  </body>
</html>
