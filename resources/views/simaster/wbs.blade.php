@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Wistleblow System</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row" >
                <div class="col-md-4">
					<div class="card card-danger shadow">
                        <div class="card-body">
							<div class="btn-group-vertical">
								<button type="button" id="btnshowakademik" class="btn btn-primary btn-block btn-lg">
									<i class="fa fa-font "></i>  Terkait Pendidikan
								</button>
								<button type="button" id="btnshowumum" class="btn btn-success btn-block btn-lg">
									<i class="fa fa-university "></i>  Terkait Sarana Prasarana
								</button>
								<button type="button" id="btnshowkemahasiswaan" class="btn btn-info btn-block btn-lg">
									<i class="fa fa-trophy "></i>  Terkait Kesiswaan
								</button>
								<button type="button" id="btnshowkeuangan" class="btn btn-warning btn-block btn-lg">
									<i class="fa fa-users "></i>  Terkait SDM
								</button>
								<button type="button" id="btnshowpsik" class="btn btn-danger btn-block btn-lg">
									<i class="fa fa-wifi "></i>  Terkait IT (Information and Technology)
								</button>
							</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div id="divawalkomplain">
						<div class="card card-primary shadow">
							<div class="card-body">
								Yth. Bapak / Ibu / Saudara Civitas Akademika <br />
								Terima Kasih Telah Menyampaikan Kritik dan Saran Bapak /Ibu, Kami telah menanggapi dan segera melakukan tindakan terkait kritik dan saran Bapak / Ibu / Saudara sampaikan. Untuk menunjang data Indeks Kepuasan terkait penanganan kritik dan saran, kami mohon dengan hormat Bapak / Ibu / Saudara Memberikan Rating Terkait Penanganan kritik dan saran Melalui Aplikasi Ini dengan Cara Mengklik Tombol "Open" di kolom paling kanan pada tabel dibawah ini. Terima Kasih atas kerjasamanya, semoga kami dapat berkembang dan berbenah lebih baik lagi kedepannya.
							</div>
							<div class="card-footer">
								<div id="gridkeluhan"></div>
							</div>
						</div>
                    </div>
                    <div id="divakademik">
						<div class="card card-primary shadow">
							<div class="card-header">
								<h3 class="card-title">Sampaikan kritik dan saran Anda</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool btkkembalimengeluh" title="Kembali Ke Tampilan Awal"><i class="fa fa-times"></i></button>
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="card-body">
								<div class="form-group">
                                    <label>kritik dan saran Tentang : </label>
                                    <input type="text" id="akad_tentang" class="form-control" value="Pendidikan">
                                </div>
                                <div class="form-group">
                                    <label>Isi kritik dan saran</label>
                                    <textarea id="akad_isi" rows="10" cols="80"></textarea>
                                    <p class="help-block">Mohon Menuliskan Lokasi kritik dan saran (Nama Gedung, Lantai, Ruangan)</p>
                                </div>
                                <div class="form-group">
                                    <label>Lampiran Foto kritik dan saran</label>
                                    <input type="file" id="akad_gambar" name="akad_gambar"> 
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" id="akad_nama" class="form-control"  value="{{Session('nama')}}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" id="akad_status" class="form-control" value="{{Session('email')}}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control" id="akad_nim"  value="{{Session('nip')}}" readonly="readonly">
                                </div>
							</div>
							<div class="card-footer">
                                <button type="button" class="btn btn-primary btn-block" id="btnkomakademik">Sampaikan</button>
                            </div>
						</div>
                    </div>
                    <div id="divumum">
						<div class="card card-success shadow">
							<div class="card-header">
								<h3 class="card-title">Sampaikan kritik dan saran Anda</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool btkkembalimengeluh" title="Kembali Ke Tampilan Awal"><i class="fa fa-times"></i></button>
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="card-body">
								<div class="form-group">
                                    <label>kritik dan saran Tentang : </label>
                                    <input type="text" id="umum_tentang" class="form-control" value="Sarana dan Prasarana">
                                </div>
                                <div class="form-group">
                                    <label>Isi kritik dan saran</label>
                                    <textarea id="umum_isi" rows="10" cols="80"></textarea>
                                    <p class="help-block">Mohon Menuliskan Lokasi Keluhan (Nama Gedung, Lantai, Ruangan)</p>
                                </div>
                                <div class="form-group">
                                    <label>Lampiran Foto kritik dan saran</label>
                                    <input type="file" id="umum_gambar" name="umum_gambar"> 
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" id="umum_nama" class="form-control"  value="{{Session('nama')}}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" id="umum_status" class="form-control"  value="{{Session('email')}}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control" id="umum_nim"  value="{{Session('nip')}}" readonly="readonly">
                                </div>
							</div>
							<div class="card-footer">
                                <button type="button" class="btn btn-primary btn-block" id="btnkomakumum">Sampaikan</button>
                            </div>
						</div>
                    </div>
                    <div id="divkepegawaian">
						<div class="card card-warning shadow">
							<div class="card-header">
								<h3 class="card-title">Sampaikan kritik dan saran Anda</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool btkkembalimengeluh" title="Kembali Ke Tampilan Awal"><i class="fa fa-times"></i></button>
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="card-body">
								<div class="form-group">
                                    <label>kritik dan saran Tentang : </label>
                                    <input type="text" id="kepeg_tentang" class="form-control" value="Pejabat Yayasan / Guru / Administrator / Security">
                                </div>
                                <div class="form-group">
                                    <label>Isi kritik dan saran</label>
                                    <textarea id="kepeg_isi" rows="10" cols="80"></textarea>
                                    <p class="help-block">Mohon Menuliskan Lokasi Keluhan (Nama Gedung, Lantai, Ruangan)</p>
                                </div>
                                <div class="form-group">
                                    <label>Lampiran Foto kritik dan saran</label>
                                    <input type="file" id="kepeg_gambar" name="kepeg_gambar"> 
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" id="kepeg_nama" class="form-control"  value="{{Session('nama')}}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" id="kepeg_status" class="form-control"  value="{{Session('email')}}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control" id="kepeg_nim"  value="{{Session('nip')}}" readonly="readonly">
                                </div>
							</div>
							<div class="card-footer">
                                <button type="button" class="btn btn-primary btn-block" id="btnkomkepeg">Sampaikan</button>
                            </div>
						</div>
                    </div>
                    <div id="divkemahasiswaan">
						<div class="card card-info shadow">
							<div class="card-header">
								<h3 class="card-title">Sampaikan kritik dan saran Anda</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool btkkembalimengeluh" title="Kembali Ke Tampilan Awal"><i class="fa fa-times"></i></button>
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="card-body">
								<div class="form-group">
                                    <label>kritik dan saran Tentang : </label>
                                    <input type="text" id="kmh_tentang" class="form-control" value="Kesiswaan">
                                </div>
                                <div class="form-group">
                                    <label>Isi Keluhan</label>
                                    <textarea id="kmh_isi" rows="10" cols="80"></textarea>
                                    <p class="help-block">Mohon Menuliskan Lokasi kritik dan saran (Nama Gedung, Lantai, Ruangan)</p>
                                </div>
                                <div class="form-group">
                                    <label>Lampiran Foto kritik dan saran</label>
                                    <input type="file" id="kmh_gambar" name="kmh_gambar"> 
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" id="kmh_nama" class="form-control"  value="{{Session('nama')}}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" id="kmh_status" class="form-control"  value="{{Session('email')}}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control" id="kmh_nim"  value="{{Session('nip')}}" readonly="readonly">
                                </div>
							</div>
							<div class="card-footer">
                                <button type="button" class="btn btn-primary btn-block" id="btnkomkmh">Sampaikan</button>
                            </div>
						</div>
                    </div>
                    <div id="divpsik">
						<div class="card card-danger shadow">
							<div class="card-header">
								<h3 class="card-title">Sampaikan kritik dan saran Anda</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool btkkembalimengeluh" title="Kembali Ke Tampilan Awal"><i class="fa fa-times"></i></button>
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="card-body">
								<div class="form-group">
                                    <label>kritik dan saran Tentang : </label>
                                    <input type="text" id="psik_tentang" class="form-control" value="Internet / Software / Hardware">
                                </div>
                                <div class="form-group">
                                    <label>Isi kritik dan saran</label>
                                    <textarea id="psik_isi" name="psik_isi" rows="10" cols="80"></textarea>
                                    <p class="help-block">Mohon Menuliskan Lokasi kritik dan saran (Nama Gedung, Lantai, Ruangan)</p>
                                </div>
                                <div class="form-group">
                                    <label>Lampiran Foto kritik dan saran</label>
                                    <input type="file" id="psik_gambar" name="psik_gambar"> 
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" id="psik_nama" class="form-control"  value="{{Session('nama')}}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" id="psik_status" class="form-control"  value="{{Session('email')}}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control" id="psik_nim"  value="{{Session('nip')}}" readonly="readonly">
                                </div>
							</div>
							<div class="card-footer">
                                <button type="button" class="btn btn-primary btn-block" id="btnkompsik">Sampaikan</button>
                            </div>
						</div>
                    </div>
                </div>
            </div>
		</div>
	</section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" id="gettahun" value="{{ date('Y') }}">
<input type="hidden" id="getbulan" value="{{ date('m') }}">
<input type="hidden" id="getjenis" value="belum">
<input type="hidden" id="id_sekolah" value="{{ Session('sekolah_id_sekolah') }}">
<input type="hidden" id="id_nip" value="{{ Session('nip') }}">

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
	$(function () {
		CKEDITOR.env.isCompatible = true;
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
	});
	function openedpage( jQuery ){
		var val01   = document.getElementById('id_nip').value;
		var token	= document.getElementById('token').value;
		var source 	= {
			datatype: "json",
			datafields: [
				{ name: 'id'},
				{ name: 'dari', type: 'text'},
				{ name: 'hostname', type: 'text'},
				{ name: 'statuser', type: 'text'},
				{ name: 'jenis', type: 'text'},
				{ name: 'nip', type: 'text'},
				{ name: 'nama', type: 'text'},
				{ name: 'kepada', type: 'text'},
				{ name: 'judul', type: 'text'},
				{ name: 'isikeluhan', type: 'text'},
				{ name: 'gambar', type: 'text'},
				{ name: 'extension', type: 'text'},
				{ name: 'tanggapan', type: 'text'},
				{ name: 'bukti', type: 'text'},
				{ name: 'jenfile', type: 'text'},
				{ name: 'rating', type: 'text'},
				{ name: 'status', type: 'text'},
				{ name: 'buat', type: 'text'},
				{ name: 'lastupdate', type: 'text'},
				{ name: 'durasi', type: 'text'},
			],
			type: 'GET',
			data: {set01:val01,  _token: token},
			url: '{{ route("getkomplainpribadi") }}',
		};
		var photorenderer = function (row, column, value) {
			var name = $('#gridkeluhan').jqxGrid('getrowdata', row).gambar;
			if (name == '' || name == null){
				var img = '<div style="background: white;"></div>';
			} else {
				var type = $('#gridkeluhan').jqxGrid('getrowdata', row).extension;
				if(type == 'pdf') {
					var img = '<div style="background: white;"><a href="'+name+'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="dist/img/pdf_logo.png"></a></div>';
				} else {
					var img = '<div style="background: white;"><a href="'+name+'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="' + name + '"></a></div>';
				}
			}
			return img;
		}
		var buktirenderer = function (row, column, value) {
			var name = $('#gridkeluhan').jqxGrid('getrowdata', row).bukti;
			if (name == '' || name == null){
				var img = '<div style="background: white;"></div>';
			} else {
				var type = $('#gridkeluhan').jqxGrid('getrowdata', row).jenfile;
				if(type == 'pdf') {
					var img = '<div style="background: white;"><a href="'+name+'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="dist/img/pdf_logo.png"></a></div>';
				} else {
					var img = '<div style="background: white;"><a href="'+name+'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="' + name + '"></a></div>';
				}
			}
			return img;
		}
		var datajhasil = new $.jqx.dataAdapter(source);
		$("#gridkeluhan").jqxGrid({
			width: '100%',
			autoheight: true,
			rowsheight: 35,
			source: datajhasil,
			theme: "energyblue",
			columns: [
				{ text: 'Dari', datafield: 'nama', width: '25%', cellsalign: 'left', align: 'center'  },
				{ text: 'Email', datafield: 'nip', width: '25%', cellsalign: 'left', align: 'center'  },
				{ text: 'Unitkerja', datafield: 'kepada', width: '25%', cellsalign: 'left', align: 'center'  },
				{ text: 'Tentang', datafield: 'judul', width: '20%', cellsalign: 'left', align: 'center'  },
				{ text: 'Isi Komplain', datafield: 'isikeluhan', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'Waktu Komplain', datafield: 'buat', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'Lampiran', align: 'center', cellsalign: 'center', width: '12%', cellsrenderer: photorenderer },
				{ text: 'Tanggapan/Tindakan', datafield: 'tanggapan', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'Bukti Tindakan', align: 'center', cellsalign: 'center', width: '12%', cellsrenderer: buktirenderer },
				{ text: 'Waktu Tindakan', datafield: 'lastupdate', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'Durasi', datafield: 'durasi', width: '15%', cellsalign: 'left', align: 'center'  },
			]
		});
	}
    $(document).ready(function () {
        $('#divawalkomplain').show();
        $('#divakademik').hide();
        $('#divkemahasiswaan').hide();
        $('#divumum').hide();
        $('#divkepegawaian').hide();
        $('#divpsik').hide();
        $(".btkkembalimengeluh").click(function(){
            $('#divawalkomplain').show();
            $('#divakademik').hide();
            $('#divkemahasiswaan').hide();
            $('#divumum').hide();
            $('#divkepegawaian').hide();
            $('#divpsik').hide();
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
		openedpage();
    });
</script>
@endpush