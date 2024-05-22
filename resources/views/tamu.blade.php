<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>{!! config('global.Title') !!}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
		<meta content="Smart and Collaborative UB" name="description" />
        <meta content="Universitas Brawijaya" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('logo-ub.png') }}">
        <!-- App css -->
        @include('base.partials.css')
    </head>
	<body class="hold-transition skin-purple layout-top-nav" style="background-image: url('{{asset('dist/img/bgub.jpg')}}'); background-repeat: no-repeat; background-position: center;">
    <div class="wrapper" >      
		<div class="content-wrapper">
			<section class="content" >
				<div class="row">
					<div class="col-md-12">
						<div class="box box-widget widget-user">
							<div class="widget-user-header bg-black" style="background: url('{{asset('dist/img/bgub3.jpg')}}') center center;">
							  <h3 class="widget-user-username">Buku Tamu </h3>
							  <a href="/"><h5 class="widget-user-desc">{!! config('global.Title') !!}</h5></a>
							</div>
							<div class="widget-user-image">
								<img class="img-circle" src="{{asset('logo-ub.png')}}" alt="Universitas Brawijaya">
							</div>
							<div class="box-footer">
							  <div class="row">								
								<div class="col-lg-8 border-right">
									<div class="box box-solid bg-green-gradient" id="divawal">
										<div class="box-body">
											<div class="row">
												<div class="col-xs-6">
													<a href="#" class="btn btn-block btn-social btn-warning" id="btnisibukutamu">
														<i class="fa fa-black-tie"></i>Tamu Umum
													</a>
												</div>
												<div class="col-xs-6">
													<a href="#" class="btn btn-block btn-social btn-danger" id="btnisibukutamu2">
														<i class="fa fa-graduation-cap"></i>Tamu Mahasiswa
													</a>
												</div>
											</div>
										</div>
										<div class="box-footer">
											<div id="griddaftartamu"></div>
										</div>
									</div>
									<div class="box box-solid bg-red-gradient" id="divisi">
										<div class="box-body">
											<div class="row">
												<div class="col-xs-4">
													<img id="preview" style="margin:2px; margin-left: 10px;" width="100%" src="logo-ub.png">
													<input type="file" id="addfile" style="display: none;"/>
													<a href="#" class="btn btn-block btn-social btn-twitter" id="btnambilfoto">
														<i class="fa fa-file-image-o"></i>Ambil Foto
													</a>
												</div>
												<div class="col-xs-8">
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
													  <select id="id_pejabat" name="id_pejabat" class="form-control select2" >
															@foreach($pejabats as $rpejabats)
																<option value="{{ $rpejabats['id'] }}">{{ $rpejabats['nama'] }} ( {{ $rpejabats['previlage'] }} )</option>
															@endforeach
														</select>
													</div>
													<div class="form-group">
													  <label for="id_keperluan">Keperluan :</label>
													  <textarea id="id_keperluan" name="id_keperluan" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
													</div>
													<div class="row">
														<div class="col-xs-6">
															<label for="id_email">Email :</label>
															<input type="text" id="id_email" name="id_email" class="form-control">
														</div>
														<div class="col-xs-6">
															<label for="id_hape">HP :</label>
															<input type="text" id="id_hape" name="id_hape" class="form-control">
														</div>
													</div>
													<div class="row">
														<div class="col-xs-6">
															<a href="#" class="btn btn-block btn-social btn-info" id="btnkembali">
																<i class="fa fa-reply-all"></i>Cancel
															</a>
														</div>
														<div class="col-xs-6">
															<a href="#" class="btn btn-block btn-social btn-twitter" id="btnsimpan">
																<i class="fa fa-calendar-plus-o"></i>Isi Buku Tamu
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="box box-solid bg-red-gradient" id="divisimhs">
										<div class="box-body">
											<div class="row">
												<div class="col-xs-4">
													<img id="preview2" style="margin:2px; margin-left: 10px;" width="100%" src="logo-ub.png">
													<input type="file" id="addfile2" style="display: none;"/>
													<a href="#" class="btn btn-block btn-social btn-twitter" id="btnambilfoto2">
														<i class="fa fa-file-image-o"></i>Ambil Foto
													</a>
												</div>
												<div class="col-xs-8">
													<div class="form-group">
													  <label for="id_nama2">Nama Lengkap:</label>
													  <input type="text" id="id_nama2" name="id_nama2" class="form-control">
													</div>
													<div class="form-group">
													  	<label for="id_instansi2">Fakultas :</label>
													  	<select id="id_instansi2" name="id_instansi2" class="form-control select2" >
															@foreach($fakultas as $rfak)
																<option value="{{ $rfak['fakpanjang'] }}">{{ $rfak['fakultas'] }} ( {{ $rfak['fakpanjang'] }} )</option>
															@endforeach
															<option value="Pascasarjana Universitas Brawijaya">Pascasarjana Universitas Brawijaya</option>
															<option value="Program Pendidikan Vokasi">Program Pendidikan Vokasi</option>
														</select>
													</div>
													<div class="form-group">
													  	<label for="id_pejabat2">Unit Yang di Tuju</label>
													  	<select id="id_pejabat2" name="id_pejabat2" class="form-control select2" >
														  	<option value="Pengambilan / Peminjaman Ijazah">Pengambilan / Peminjaman Ijazah</option>
															<option value="Pengambilan Sertifikat IT">Pengambilan Sertifikat IT</option>
															<option value="Pembuatan / Pengambilan KTM">Pembuatan / Pengambilan KTM</option>
															<option value="Registrasi dan Statistik">Registrasi dan Statistik</option>
															<option value="Pendidikan dan Evaluasi">Pendidikan dan Evaluasi</option>
															<option value="Akuntansi Keuangan">Akuntansi Keuangan</option>
															<option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
															<option value="Tata Usaha dan Protokoler">Tata Usaha dan Protokoler</option>
															<option value="Rumah Tangga">Rumah Tangga</option>
															<option value="Pengadaan">Pengadaan</option>
															<option value="Pendidik">Pendidik (Dosen)</option>
															<option value="Inventaris dan Penghapusan">Inventaris dan Penghapusan</option>
															<option value="Tata Kelola Keorganisasian Elektronik">Tata Kelola Keorganisasian Elektronik</option>
															<option value="Hukum dan Tata Laksana">Hukum dan Tata Laksana</option>
															<option value="Monitoring dan Evaluasi">Monitoring dan Evaluasi</option>
															<option value="Akuntansi Manajemen">Akuntansi Manajemen</option>
															<option value="PNBP">PNBP</option>
															<option value="NON PNBP">NON PNBP</option>
															<option value="Perencanaan">Perencanaan</option>
															<option value="Penalaran">Penalaran</option>
															<option value="Minat dan Bakat">Minat dan Bakat</option>
															<option value="Kerjasama">Kerjasama</option>
															<option value="Alumni">Alumni</option>
														</select>
													</div>
													<div class="form-group">
													  <label for="id_keperluan2">Keperluan :</label>
													  <textarea id="id_keperluan2" name="id_keperluan2" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
													</div>
													<div class="row">
														<div class="col-xs-6">
															<label for="id_email2">Email :</label>
															<input type="text" id="id_email2" name="id_email2" class="form-control">
														</div>
														<div class="col-xs-6">
															<label for="id_hape2">HP :</label>
															<input type="text" id="id_hape2" name="id_hape2" class="form-control">
														</div>
													</div>
													<div class="row">
														<div class="col-xs-6">
															<a href="#" class="btn btn-block btn-social btn-info" id="btnkembali2">
																<i class="fa fa-reply-all"></i>Cancel
															</a>
														</div>
														<div class="col-xs-6">
															<a href="#" class="btn btn-block btn-social btn-twitter" id="btnsimpan2">
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
												<div class="col-xs-4">
													<img id="lihat_img" style="margin:2px; margin-left: 10px;" width="100%" src="logo-ub.png">
													
												</div>
												<div class="col-xs-8">
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
														<div class="col-xs-6">
															<label for="lihat_email">Email :</label>
															<input type="text" id="lihat_email" name="lihat_email" class="form-control">
														</div>
														<div class="col-xs-6">
															<label for="lihat_hape">HP :</label>
															<input type="text" id="lihat_hape" name="lihat_hape" class="form-control">
														</div>
													</div>
													<div class="row">
														<div class="col-xs-6">
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
								<div class="col-lg-4 border-right">
									<div class="box box-danger">
										<div class="box-header with-border">
											<i class="fa fa-briefcase"></i>
											<h3 class="box-title">Statistik Hari Ini</h3>
											<div class="box-tools pull-right">
												<div id="timeremaining"></div>
											</div>
										</div><!-- /.box-header -->
										<div class="box-body">
											<a href="bukutamu" class="btn btn-block btn-social btn-warning">
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
			</section>
		</div>
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
			  <b>{!! config('global.swandhananama') !!}</b>
			</div>
			<strong>Copyright &copy; 2019 <a href="http://ub.ac.id">Universitas Brawijaya</a></strong> All rights reserved.
		</footer>
    </div>
	<!-- TOKEN -->
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	@include('base.partials.js')
	<script>
		$(function () {
			$('.select2').select2()			
			CKEDITOR.env.isCompatible = true;
			CKEDITOR.replace( 'id_keperluan', {
				toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
				removeButtons: 'Strike',
				width: '100%',
				height: 45	
			});
			CKEDITOR.replace( 'id_keperluan2', {
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
			function addFile() {
				$('#addfile').click();
			}
			function addFile2() {
				$('#addfile2').click();
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
			function readURL2(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.readAsDataURL(input.files[0]);
					reader.onload = function (e) {
						$('#preview2').attr('src', e.target.result);
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
			$('#addfile2').change(function () {
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
						readURL2(this);
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
		var start = new Date();
		CountDownTimer(start, 'timeremaining');
		function CountDownTimer(dt, id)
		{
			var end 	= new Date(dt.getTime() + 60000);
			var _second = 1000;
			var _minute = _second * 60;
			var _hour 	= _minute * 60;
			var _day 	= _hour * 24;
			var timer;
			function showRemaining() {
				var now = new Date();
				var distance = end - now;
				if (distance < 0) {
					clearInterval(timer);
					var start = new Date();
					CountDownTimer(start, 'timeremaining');
					$("#gridrekap").jqxGrid('updatebounddata','filter');
					$("#griddaftartamu").jqxGrid('updatebounddata','filter');
					return;
				}
				var days = Math.floor(distance / _day);
				var hours = Math.floor((distance % _day) / _hour);
				var minutes = Math.floor((distance % _hour) / _minute);
				var seconds = Math.floor((distance % _minute) / _second);
				document.getElementById(id).innerHTML ='Refresh in ';
				document.getElementById(id).innerHTML += seconds + 'secs';
			}
			timer = setInterval(showRemaining, 1000);
		}
		$(document).ready(function() {
			$('#divisi').hide();
			$('#divisimhs').hide();
			$('#divlihat').hide();
			$('#btnisibukutamu').click(function () {
				$('#divisi').show();
				$('#divawal').hide();
				$('#preview').attr('src','logo-ub.png');
				$("#addfile").val('');
				$("#id_nama").val('');
				$("#id_instansi").val('');
				$("#id_email").val('');
				$("#id_hape").val('');
				$("#id_pejabat").val('').trigger('change');
				CKEDITOR.instances['id_keperluan'].setData('')
			});
			$('#btnisibukutamu2').click(function () {
				$('#divisimhs').show();
				$('#divawal').hide();
				$('#preview2').attr('src','logo-ub.png');
				$("#addfile2").val('');
				$("#id_nama2").val('');
				$("#id_instansi2").val('').trigger('change');
				$("#id_email2").val('');
				$("#id_hape2").val('');
				$("#id_pejabat2").val('').trigger('change');
				CKEDITOR.instances['id_keperluan2'].setData('')
			});
			$('#btnkembali').click(function () {
				$('#divisi').hide();
				$('#divawal').show();
				$('#divlihat').hide();
			});
			$('#btnkembali2').click(function () {
				$('#divisimhs').hide();
				$('#divawal').show();
				$('#divlihat').hide();
			});
			$('#btnkembalidrlihat').click(function () {
				$('#divisi').hide();
				$('#divawal').show();
				$('#divlihat').hide();
			});
			$('#btnambilfoto').click(function () {
				 $('#addfile').click();
			});
			$('#btnambilfoto2').click(function () {
				 $('#addfile2').click();
			});
			var sumberrekap = {
				datatype: "json",
				datafields: [
				{ name: 'pejabat', type: 'text'},	
				{ name: 'jumlah', type: 'text'},
				],
				url: 'tamu/rekaptamu',
				cache: false
			};
			var datajrekap = new $.jqx.dataAdapter(sumberrekap);
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
				updaterow: function (rowid, rowdata, commit) {commit(true);},
				url: 'tamu/bukutamu',
				cache: false
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
					var foto = 'logo-ub.png';					
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
				autoheight: true,
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
						CKEDITOR.instances['lihat_keperluan'].setData(valkeperluan)
						$('#divisi').hide();
						$('#divawal').hide();
						$('#divlihat').show();
					});
				},
				columns: [					
					{ text: 'Photo', editable: false, sortable: false, filterable: false,  width: '10%', cellsrenderer: photorenderer },
					{ text: 'Tanggal', datafield: 'tanggal', filtertype: 'checkedlist', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Menemui', filtertype: 'checkedlist', datafield: 'pejabat', width: '25%', cellsalign: 'left', align: 'center'  },
					{ text: 'Keperluan', datafield: 'keperluan', width: '20%', cellsalign: 'left', align: 'center'  },
					{ text: 'Nama', datafield: 'nama', width: '25%', cellsalign: 'left', align: 'center'  },
					{ text: 'Asal Unit Kerja / Instansi', datafield: 'instansi', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Email', datafield: 'email', width: '10%', cellsalign: 'left', align: 'center'  },
					{ text: 'Handphone', datafield: 'hape', width: '10%', cellsalign: 'left', align: 'center'  },				
				],
			});
			$("#btnsimpan").click(function(){
				var set01 	= document.getElementById('addfile');
				var set02	= document.getElementById('id_nama').value;
				var set03	= document.getElementById('id_instansi').value;
				var set04	= document.getElementById('id_pejabat').value;
				var set05	= CKEDITOR.instances['id_keperluan'].getData();
				var set06	= document.getElementById('id_email').value;
				var set07	= document.getElementById('id_hape').value;				
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
			$("#btnsimpan2").click(function(){
				var set01 	= document.getElementById('addfile2');
				var set02	= document.getElementById('id_nama2').value;
				var set03	= document.getElementById('id_instansi2').value;
				var set04	= document.getElementById('id_pejabat2').value;
				var set05	= CKEDITOR.instances['id_keperluan2'].getData();
				var set06	= document.getElementById('id_email2').value;
				var set07	= document.getElementById('id_hape2').value;				
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
						text: 'Fakultas Belum Terisi',
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
					$('#divisimhs').hide();
					var form_data = new FormData();
					form_data.append('file', set01.files[0]);
					form_data.append('val02', set02);
					form_data.append('val03', set03);
					form_data.append('val04', set04);
					form_data.append('val05', set05);
					form_data.append('val06', set06);
					form_data.append('val07', set07);					
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
		});
	</script>
  </body>
</html>
