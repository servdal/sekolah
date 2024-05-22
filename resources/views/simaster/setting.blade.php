@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Data Sekolah</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <form method="POST" action="" id="formedit" name="formedit" enctype="multipart/form-data">
						{{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Yayasan</label>
                                <input type="text" id="edit_nama_yayasan" name="edit_nama_yayasan" class="form-control" value="{{ $sekolah->nama_yayasan }}">
                            </div>
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" id="edit_nis" name="edit_nis" class="form-control" value="{{ $sekolah->nis }}">
                            </div>
                            <div class="form-group">
                                <label>NSS</label>
                                <input type="text" id="edit_nss" name="edit_nss" class="form-control" value="{{ $sekolah->nss }}">
                            </div>
                            <div class="form-group">
                                <label>NPSN</label>
                                <input type="text" id="edit_npsn" name="edit_npsn" class="form-control" value="{{ $sekolah->npsn }}">
                            </div>
                            <div class="form-group">
                                <label>Kode Sekolah</label>
                                <input type="text" id="edit_kode_sekolah" name="edit_kode_sekolah" class="form-control" value="{{ $sekolah->kode_sekolah }}">
                            </div>
                            <div class="form-group">
                                <label>Nama Sekolah</label>
                                <input type="text" id="edit_nama_sekolah" name="edit_nama_sekolah" class="form-control" value="{{ $sekolah->nama_sekolah }}">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" id="edit_alamat" name="edit_alamat" class="form-control" value="{{ $sekolah->alamat }}">
                            </div>
                            <div class="form-group">
                                <label>Kota</label>
                                <input type="text" id="edit_kota" name="edit_kota" class="form-control" value="{{ $sekolah->kota }}">
                            </div>
                            <div class="form-group">
                                <label>Telp</label>
                                <input type="text" id="edit_telp" name="edit_telp" class="form-control" value="{{ $sekolah->telp }}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" id="edit_email" name="edit_email" class="form-control" value="{{ $sekolah->email }}">
                            </div>
                            <div class="form-group">
                                <label>Kepala Sekolah</label>
                                <select id="edit_id_kepala_sekolah" name="edit_id_kepala_sekolah" class="form-control" >
                                    @foreach($jpeg as $rpeg)
                                    <option value="{{ $rpeg['id'] }}">{{ $rpeg['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Slogan</label>
                                <input type="text" id="edit_slogan" name="edit_slogan" class="form-control" value="{{ $sekolah->slogan }}">
                            </div>
                            <div class="form-group">
                                <label>No Rekening</label>
                                <input type="text" id="edit_no_rek" name="edit_no_rek" class="form-control" value="{{ $sekolah->no_rek }}">
                            </div>
                            <div class="form-group">
                                <label>Rekening Atas Nama</label>
                                <input type="text" id="edit_nama_rek" name="edit_nama_rek" class="form-control" value="{{ $sekolah->nama_rek }}">
                            </div>
                            <div class="form-group">
                                <label>Nama BANK</label>
                                <input type="text" id="edit_nama_bank_rek" name="edit_nama_bank_rek" class="form-control" value="{{ $sekolah->nama_bank_rek }}">
                            </div>
                            <div style="overflow: hidden; display: none;">
                                <div class="form-group">
                                    <label>Level</label>
                                    <select id="edit_level" name="edit_level" class="form-control" >
                                        <option value="1">TK/KB</option>
                                        <option value="2">SD/MI</option>
                                        <option value="3">SLTP/Mts</option>
                                        <option value="4">SLTA/MA</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="edit_status" name="edit_status" class="form-control" >
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pendaftaran</label>
                                    <input type="text" id="edit_pendaftaran" name="edit_pendaftaran" placeholder="ex:2020-2021" class="form-control" value="{{ $sekolah->pendaftaran }}">
                                </div>
                                <div class="form-group">
                                    <label>Pengumuman</label>
                                    <textarea name="edit_pengumuman" id="edit_pengumuman" cols="30" rows="10" class="form-control" value="{!! $sekolah->pengumuman !!}"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Logo</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="file" id="edit_logo" name="edit_logo" onchange="readURL(this);" >
                                    </div> 
                                    <div class="col-lg-6">
                                        <img id="edit_logo_prev" class="img-responsive" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Logo Grey</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="file" id="edit_logo_grey" name="edit_logo_grey" onchange="readURLbc(this);"" >
                                    </div> 
                                    <div class="col-lg-6">
                                        <img id="edit_logo_grey_prev" class="img-responsive" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Frontpage Logo</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="file" id="edit_frontpage" name="edit_frontpage" onchange="readURLfront(this);">
                                    </div> 
                                    <div class="col-lg-6">
                                        <img id="edit_frontpage_prev" class="img-responsive" />
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
                                <label>Kop Surat</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="file" id="edit_kopsurat" name="edit_kopsurat" onchange="readURLKop(this);">
                                    </div> 
                                    <div class="col-lg-6">
                                        <img id="edit_kopsurat_prev" class="img-responsive" />
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="card-footer">
                            <a href="#" id="simpansetting"  class="btn btn-block btn-social btn-twitter">
                                <i class="fa fa-gears"></i> Simpan
                            </a>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    @if(Session::has('message'))
                        <div class="alert {{ Session::get('alert-class') }} alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> {{ Session::get('status') }}</h4>
                            {!! Session::get('message') !!}
                        </div>
                    @endif
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Preview</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-image: url('{{url('').'/'.$sekolah->logo_grey}}'); background-repeat: no-repeat; background-position: center;">
								<tr>
									<td colspan="3" rowspan="4" align="center" valign="middle" style="border-bottom:double"><img src="{!! url('').'/'.$sekolah->logo !!}" width="98" height="75" /></td>
									<td colspan="8">{!! $sekolah->nama_yayasan !!}</td>
								</tr>
								<tr>
									<td colspan="8">{!! $sekolah->nama_sekolah !!}</td>
								</tr>
								<tr>
									<td colspan="8">{!! $sekolah->alamat !!}</td>
								</tr>
								<tr>
									<td width="101" style="border-bottom:double">&nbsp;</td>
									<td width="25" style="border-bottom:double">&nbsp;</td>
									<td width="118" style="border-bottom:double">&nbsp;</td>
									<td width="13" style="border-bottom:double">&nbsp;</td>
									<td width="26" style="border-bottom:double">&nbsp;</td>
									<td width="125" style="border-bottom:double">&nbsp;</td>
									<td width="39" style="border-bottom:double">&nbsp;</td>
									<td width="129" style="border-bottom:double">&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td colspan="3" align="center"><span class="isi">Kepala Sekolah</span></td>
								</tr>
								
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td colspan="6"><span class="isi">&quot;{!! $sekolah->slogan !!}&quot;</span></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td colspan="3" style="border-bottom:dotted" align="center"><span class="isi">
									@if (isset($sekolah->kepala_sekolah->nama))
									{!! $sekolah->kepala_sekolah->nama !!}
									@endif
									</span></td>
								</tr>
							</table>
                        </div>
                    </div>
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-map-marker"></i> Aktifkan Laman Pendaftaran Ekstrakulikuler</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($ijin == '')
                            <button type="button" class="btn btn-success" id="onoffminat">AKTIF</button>
                            @else 
                            <button type="button" class="btn btn-danger" id="onoffminat">NONAKTIF</button>
                            @endif
                        </div>
                    </div>
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-map-marker"></i> Aktifkan Laman Pembayaran ZIS</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($ijinzis == '')
                            <button type="button" class="btn btn-success" id="onoffzis">AKTIF</button>
                            @else 
                            <button type="button" class="btn btn-danger" id="onoffzis">NONAKTIF</button>
                            @endif
                        </div>
                    </div>
                    <div class="card card-success shadow">
                        <div class="card-header">
                            <h3 class="card-title">Uploader / Backup</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <dl class="dl-horizontal">
                                <dt>Petunjuk</dt>
                                <dd>Menu Uploader ini digunakan untuk mengupload data siswa baru, baik biodata maupun setting keuangan (spp,dpp,,dll). Mohon Bapak/Ibu Admin Sekolah Mendownload Terlebih Dahulu Format Kami, dan isi file tersebut dengan data baru. Setelah data terisi pastikan semua data berformat "TEXT" untuk menghindari kesalahan dalam penginputan. Sistem akan melakukan pengecekan terhadap isian excel, bila terdapat NIS yang sama maka sistem akan melakukan penolakan input data. Terima Kasih.</dd>
                                <dt>Data Induk</dt>
                                <dd><a href="format/datainduk.xlsx"><button class="btn btn-block btn-info btn-sm">Download File Format Data Induk di sini</button></a></dd>
                                <dd>
                                    <form name="import" action="{{ url('admin/uploaddatainduk') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Import Data Induk</label>
                                            <input type="file" id="datainduk" name="datainduk" >			  
                                        </div>
                                        <input class="btn btn-info" type="submit" name="simpaninduk" value="Import Data Induk" />
                                    </form>
                                </dd>
                                <dt>Setting Keuangan Untuk Data Induk Baru</dt>
                                <dd><a href="format/datakeuangan.xlsx"><button class="btn btn-block btn-warning btn-sm">Download File Format Data Setting Keuangan</button></a></dd>
                                <dd>
                                    <form name="import" action="{{ url('admin/uploadkeuangan') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Import Setting Keuangan</label>
                                            <input type="file" id="datakeuangan" name="datakeuangan" >			  
                                        </div>
                                        <input class="btn btn-warning" type="submit" name="simpankeuangan" value="Import Data Keuangan" />
                                    </form>
                                </dd>
                                <dt>Backup Database</dt>
                                <dd>Perintah ini berfungsi untuk membackup keseluruhan database. Setelah anda mengklik bakcup, mohon simpan file hasil tersebut di tempat yang aman (kami menyarankan sekolah mempunyai account di Google Drive dan simpan file backup tersebut di Google Drive) Mohon fasilitas ini dimanfaatkan minimal 3 bulan sekali, untuk menghindari hal-hal yang tidak diinginkan</dd>
                                <dd>
									<div class="btn-group">
										<a href="/backup/database"><button type="button" class="btn btn-primary"><i class="fa fa-database"></i></button></a>
										<a href="/backup/public"><button type="button" class="btn btn-danger"><i class="fa fa-file"></i></a>
									</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
								<li class="nav-item"><a class="nav-link" href="#visimisi" data-toggle="tab">Visi, Misi, Tujuan, Moto dan Nilai Dasar</a></li>
								<li class="nav-item"><a class="nav-link" href="#strukturorganisasi" data-toggle="tab">Struktur Organisasi</a></li>
								<li class="nav-item"><a class="nav-link" href="#pendidik" data-toggle="tab">Data Pendidik</a></li>
								<li class="nav-item"><a class="nav-link" href="#jadwal" data-toggle="tab">Jadwal</a></li>
								<li class="nav-item"><a class="nav-link" href="#kontak" data-toggle="tab">Kontak</a></li>
								<li class="nav-item"><a class="nav-link" href="#sertamerta" data-toggle="tab">Serta Merta</a></li>
								<li class="nav-item"><a class="nav-link" href="#setiapsaat" data-toggle="tab">Setiap Saat</a></li>
							</ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
								<div class="tab-pane active" id="profile">
									<section>
										<div class="form-group">
											<textarea id="set_profile" name="set_profile" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
											{!! $profile !!}
											</textarea>
										</div>
										<div class="form-group">
											<button type="button" class="btn btn-success" id="btnupdateprofile">UPDATE</button>
										</div>
									</section>
								</div>
								<div class="tab-pane" id="visimisi">
									<section>
										<div class="form-group">
											<textarea id="set_visimisi" name="set_visimisi" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
											{!! $visimisi !!}
											</textarea>
										</div>
										<div class="form-group">
											<button type="button" class="btn btn-success" id="btnupdatevisimisi">UPDATE</button>
										</div>
									</section>
								</div>
								<div class="tab-pane" id="strukturorganisasi">
									<section>
										<div class="form-group">
											<textarea id="set_strukturorganisasi" name="set_strukturorganisasi" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
											{!! $strukturorganisasi !!}
											</textarea>
										</div>
										<div class="form-group">
											<button type="button" class="btn btn-success" id="btnupdatestruktur">UPDATE</button>
										</div>
									</section>
								</div>
								<div class="tab-pane" id="pendidik">
									<section>
										<div class="form-group">
											<textarea id="set_pendidik" name="set_pendidik" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
											{!! $pendidik !!}
											</textarea>
										</div>
										<div class="form-group">
											<button type="button" class="btn btn-success" id="btnupdatependidik">UPDATE</button>
										</div>
									</section>
								</div>
								<div class="tab-pane" id="jadwal">
									<section>
										<div class="form-group">
											<textarea id="set_jadwal" name="set_jadwal" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
											{!! $jadwal !!}
											</textarea>
										</div>
										<div class="form-group">
											<button type="button" class="btn btn-success" id="btnupdatejadwal">UPDATE</button>
										</div>
									</section>
								</div>
								<div class="tab-pane" id="kontak">
									<section>
										<div class="form-group">
											<textarea id="set_kontak" name="set_kontak" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
											{!! $kontak !!}
											</textarea>
										</div>
										<div class="form-group">
											<button type="button" class="btn btn-success" id="btnupdatekontak">UPDATE</button>
										</div>
									</section>
								</div>
								<div class="tab-pane" id="sertamerta">
									<section>
										<div class="form-group">
											<textarea id="set_sertamerta" name="set_sertamerta" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
											{!! $sertamerta !!}
											</textarea>
										</div>
										<div class="form-group">
											<button type="button" class="btn btn-success" id="btnupdatesertamerta">UPDATE</button>
										</div>
									</section>
								</div>
								<div class="tab-pane" id="setiapsaat">
									<section>
										<div class="form-group">
											<textarea id="set_setiapsaat" name="set_setiapsaat" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
											{!! $setiapsaat !!}
											</textarea>
										</div>
										<div class="form-group">
											<button type="button" class="btn btn-success" id="btnupdatesetiapsaat">UPDATE</button>
										</div>
									</section>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="getnama" id="getnama" value="{{Session('nama')}}">
@endsection
@push('script')
<script>
	function readURLfront(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#edit_frontpage_prev').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function readURLKop(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#edit_kopsurat_prev').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#edit_logo_prev').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function readURLbc(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#edit_logo_grey_prev').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	$(function () {
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace( 'set_setiapsaat');
		CKEDITOR.replace( 'set_sertamerta');
		CKEDITOR.replace( 'set_profile');
		CKEDITOR.replace( 'set_visimisi');
		CKEDITOR.replace( 'set_strukturorganisasi');
		CKEDITOR.replace( 'set_pendidik');
		CKEDITOR.replace( 'set_jadwal');
		CKEDITOR.replace( 'set_kontak');
	});
	$(document).ready(function () {
		$('#edit_level').val('{{$sekolah->level}}');
		$('#edit_status').val('{{$sekolah->status}}');
		$('#edit_id_kepala_sekolah').val('{{$sekolah->id_kepala_sekolah}}');
		$('#btnupdatesetiapsaat').on('click', function (){
			var set01='setiapsaat';
			var set02=CKEDITOR.instances['set_setiapsaat'].getData()
			var token=document.getElementById('token').value;		
			$.post('admin/exprofilesekolah', { val01: set01, val02: set02, _token: token },
			function(data){
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
				setTimeout(function () {
					location.reload();
				}, 3000);
			});
		});
		$('#btnupdatesertamerta').on('click', function (){
			var set01='sertamerta';
			var set02=CKEDITOR.instances['set_sertamerta'].getData()
			var token=document.getElementById('token').value;		
			$.post('admin/exprofilesekolah', { val01: set01, val02: set02, _token: token },
			function(data){
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
				setTimeout(function () {
					location.reload();
				}, 3000);
			});
		});
		$('#btnupdatekontak').on('click', function (){
			var set01='kontak';
			var set02=CKEDITOR.instances['set_kontak'].getData()
			var token=document.getElementById('token').value;		
			$.post('admin/exprofilesekolah', { val01: set01, val02: set02, _token: token },
			function(data){
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
				setTimeout(function () {
					location.reload();
				}, 3000);
			});
		});
		$('#btnupdatejadwal').on('click', function (){
			var set01='jadwal';
			var set02=CKEDITOR.instances['set_jadwal'].getData()
			var token=document.getElementById('token').value;		
			$.post('admin/exprofilesekolah', { val01: set01, val02: set02, _token: token },
			function(data){
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
				setTimeout(function () {
					location.reload();
				}, 3000);
			});
		});
		$('#btnupdatependidik').on('click', function (){
			var set01='pendidik';
			var set02=CKEDITOR.instances['set_pendidik'].getData()
			var token=document.getElementById('token').value;		
			$.post('admin/exprofilesekolah', { val01: set01, val02: set02, _token: token },
			function(data){
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
				setTimeout(function () {
					location.reload();
				}, 3000);
			});
		});
		$('#btnupdatevisimisi').on('click', function (){
			var set01='visimisi';
			var set02=CKEDITOR.instances['set_visimisi'].getData()
			var token=document.getElementById('token').value;		
			$.post('admin/exprofilesekolah', { val01: set01, val02: set02, _token: token },
			function(data){
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
				setTimeout(function () {
					location.reload();
				}, 3000);
			});
		});
		$('#btnupdatestruktur').on('click', function (){
			var set01='strukturorganisasi';
			var set02=CKEDITOR.instances['set_strukturorganisasi'].getData()
			var token=document.getElementById('token').value;		
			$.post('admin/exprofilesekolah', { val01: set01, val02: set02, _token: token },
			function(data){
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
				setTimeout(function () {
					location.reload();
				}, 3000);
			});
		});
		$('#btnupdateprofile').on('click', function (){
			var set01='profile';
			var set02=CKEDITOR.instances['set_profile'].getData()
			var token=document.getElementById('token').value;		
			$.post('admin/exprofilesekolah', { val01: set01, val02: set02, _token: token },
			function(data){
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
				setTimeout(function () {
					location.reload();
				}, 3000);
			});
		});
		$('#onoffminat').on('click', function (){
			var set01='ekstrakulikuler';
			var token=document.getElementById('token').value;		
			$.post('admin/onofflayanan', { val01: set01, _token: token },
			function(data){
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
				setTimeout(function () {
					location.reload();
				}, 3000);
			});
		});
		$('#onoffzis').on('click', function (){
			var set01='zis';
			var token=document.getElementById('token').value;		
			$.post('admin/onofflayanan', { val01: set01, _token: token },
			function(data){
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
				setTimeout(function () {
					location.reload();
				}, 3000);
			});
		});
		$('#simpansetting').click(function () {
			var form_data = new FormData($('#formedit')[0]);
			$.ajax({
				url: '{{ url('') }}/admin/savesetting',
				data: form_data,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					var status  = data.status;
					var message = data.message;
					var warna 	= data.warna;
					var icon 	= data.icon;
					if(icon == 'error') {
						$.toast({
							heading: status,
							text: message,
							position: 'top-right',
							loaderBg: warna,
							icon: icon,
							hideAfter: 5000,
							stack: 1
						});
					} else {
						$.toast({
							heading: status,
							text: message,
							position: 'top-right',
							loaderBg: warna,
							icon:icon,
							hideAfter: 3000,
							stack: 1
						});
						setTimeout(function () {
							location.reload();
						}, 3000);
					}
					return false;
				},
				error: function (xhr, status, error) {
					var pesan = xhr.responseText;
					swal({
						title: 'Stop',
						text: pesan,
						type: 'warning',
					})
				}
			});
		});
	});
</script>
@endpush