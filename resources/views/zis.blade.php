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
							  <h3 class="widget-user-username">Form Pembayaran Zakat, Infaq dan Shodaqoh</h3>
							  <a href="/frontpage?id={{ $id_sekolah }}"><h5 class="widget-user-desc">{{ $sekolah }}</h5></a>
							</div>
							<div class="widget-user-image">
								<img class="img-circle" src="{{ url('').'/'.$logo }}" alt="{{ $sekolah }}">
							</div>
							
							<div class="box-footer">
								<div class="row">
									<div class="col-lg-9">
										<div class="box box-danger" id="divawal">
											<div class="box-header with-border">
											<i class="fa fa-briefcase"></i>
											  <h3 class="box-title">Form Isian</h3>
											</div>
											<div class="box-body">
												<div class="box-body">
													<div class="form-group">
														<label>Nama Orang Tua/Wali</label>
														<input type="text" id="id_namawali" class="form-control">
													</div>
													<div class="form-group">
														<label>No.HP Orang Tua/Wali</label>
														<input type="text" id="id_hape" class="form-control">
													</div>
													<div class="form-group">
														<label>Nama Siswa</label>
														<input type="text" id="id_namasiswa" class="form-control">
													</div>
													<div class="form-group">
														<label>Kelas</label>
														<input type="text" id="id_kelas" class="form-control" value="">
													</div>
													<div class="form-group">		
														<div class="row">
															<div class="col-lg-3">
																<label>Zakat Fitrah</label>
																<select id="id_fitrah" name="id_fitrah" class="form-control">
																	<option value="Uang">Berupa Uang</option>
																	<option value="Beras">Berupa Beras</option>
																</select>
															</div>
															<div class="col-lg-3">
																<label>Untuk</label>
																<select id="id_orang" name="id_orang" class="form-control" >
																	<option value="1">1 Orang</option>
																	<option value="2">2 Orang</option>
																	<option value="3">3 Orang</option>
																	<option value="4">4 Orang</option>
																	<option value="5">5 Orang</option>
																	<option value="6">6 Orang</option>
																	<option value="7">7 Orang</option>
																	<option value="8">8 Orang</option>
																	<option value="9">9 Orang</option>
																	<option value="10">10 Orang</option>
																</select>
															</div>
															<div class="col-lg-6">
																<label>Jumlah (Jumlah Uang / Jumlah Beras dalam (Kg) )</label>
																<input type="text" id="id_nominal" class="form-control" value="35000">
															</div>
														</div>
													</div>
													<label>Zakat Maal (Sesuai dengan Nisob dan Perhitungan)</label>
													<div class="input-group">
														<span class="input-group-addon">Rp.</span>
														<input type="text" id="id_zakatmaal" class="form-control">
														<span class="input-group-addon">,-</span>
													</div>
													<label>Donasi (sesuai kemampuan)</label>
													<div class="input-group">
														<span class="input-group-addon">Rp.</span>
														<input type="text" id="id_donasi" class="form-control">
														<span class="input-group-addon">,-</span>
													</div>
													<div class="form-group">
														<label>Bukti Transfer</label>
														<input id="fileinput" type="file" accept="image/gif, image/jpeg, image/png" onchange="readURL(this);" />
													</div>
													<div class="form-group">
														<img id="avatar" class="img-responsive" />
													</div>
												</div>
												<div class="box-footter">
													<button type="button" class="btn btn-danger" id="btnsimpan">Simpan</button>
												</div>
											</div>
										</div>
										<div class="box box-success" id="divhasil">
											<div class="box-header with-border">
											<i class="fa fa-briefcase"></i>
											  <h3 class="box-title">Terima Kasih</h3>
											</div><!-- /.box-header -->
											<div class="box-body">
												<div class="box-body">
													<div id="divpesan"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="box box-primary">
											<div class="box-body box-profile">
											  <img class="img-responsive" src="{{ url('').'/'.$logo }}" alt="{{ $sekolah }}">
											  <h3 class="profile-username text-center">Transfer Ke</h3>
											  <ul class="list-group list-group-unbordered">
												<li class="list-group-item">
												  <b>No. Rekening</b> <a class="pull-right">{{$no_rek}}</a>
												</li>
												<li class="list-group-item">
												  <b>Bank</b> <a class="pull-right">{{$nama_bank_rek}}</a>
												</li>
											  </ul>
											 	<b>An. </b> <a class="pull-right">{{$nama_rek}}</a>
												
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
			<strong>Copyright &copy; 2020 <a href="{!! config('global.homeweb') !!}">{!! config('global.sekolah') !!}</a>.</strong> All rights reserved.
		</footer>
    </div>
	<!-- TOKEN -->
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	<input type="hidden" name="id_setuang" id="id_setuang" value="35000">
	@include('base.partials.js')
	<script>
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#avatar').attr('src', e.target.result);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
		$(document).ready(function() {
			$('#divhasil').hide();
			$("#btnisizakat").click(function(){
				$('#divzakat').show();
				$('#divhasil').hide();
				$('#divpilihan').hide();
			});
			$(".btnkembalikepilihan").click(function(){
				$('#divzakat').hide();
				$('#divhasil').hide();
				$('#divpilihan').show();
			});
			$("#id_nominal").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
			$("#id_zakatmaal").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
			$("#id_donasi").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
			$("#id_fitrah").on('change', function () {
				var jenis	= $(this).find('option:selected').attr('value');
				var nominal	= document.getElementById('id_setuang').value;
				var orang	= document.getElementById('id_orang').value;
				var nominal	= nominal.toString().replace(",", "");
				if (jenis == 'Uang'){
					var total 	= Math.round((Number(nominal) * Number(orang)));
				} else {
					var total 	= 2.5 * Number(orang);
				}
				$("#id_nominal").val(total);
				
			});
			$("#id_orang").on('change', function () {
				var orang	= $(this).find('option:selected').attr('value');
				var nominal	= document.getElementById('id_setuang').value;
				var jenis	= document.getElementById('id_fitrah').value;
				var nominal	= nominal.toString().replace(",", "");
				if (jenis == 'Uang'){
					var total 	= Math.round((Number(nominal) * Number(orang)));
				} else {
					var total 	= 2.5 * Number(orang);
				}
				$("#id_nominal").val(total);
				
			});
			$("#btnsimpan").click(function(){
				var set01	= document.getElementById('fileinput');
				var set02	= document.getElementById('id_namawali').value;
				var set03	= document.getElementById('id_namasiswa').value;
				var set04	= document.getElementById('id_kelas').value;
				var set05	= document.getElementById('id_fitrah').value;
				var set06	= document.getElementById('id_orang').value;
				var set07	= document.getElementById('id_nominal').value;
				var set08	= document.getElementById('id_zakatmaal').value;
				var set09	= document.getElementById('id_donasi').value;
				var set10	= document.getElementById('id_hape').value;
				var set11	= 'new';
				var token 	= document.getElementById('token').value;
				var id_sekolah	= '{{$id_sekolah}}';
				if ($('#fileinput').val() == ''){
					swal({
						title: 'Stop',
						text: 'Mohon Memilih File Bukti Pembayaran Anda',
						type: 'warning',
					})
				}
				else if (set02 == ''){
					swal({
						title: 'Stop',
						text: 'Nama Wali Wajib di Isi',
						type: 'warning',
					})
				}
				else if (set07 == ''){
					swal({
						title: 'Stop',
						text: 'Tentukan Nominal Zakat Anda',
						type: 'warning',
					})
				}
				else if (set10 == ''){
					swal({
						title: 'Stop',
						text: 'No. Handphone (WA) Orang Tua Wajib di Isi',
						type: 'warning',
					})
				}
				else if (set03 == ''){
					swal({
						title: 'Stop',
						text: 'Nama Siswa Wajib di Isi',
						type: 'warning',
					})
				}
				else {
					var form_data = new FormData();
					form_data.append('file', set01.files[0]);
					form_data.append('val02', set02);
					form_data.append('val03', set03);
					form_data.append('val04', set04);
					form_data.append('val05', set05);
					form_data.append('val06', set06);
					form_data.append('val07', set07);
					form_data.append('val08', set08);
					form_data.append('val09', set09);
					form_data.append('val10', set10);
					form_data.append('val11', set11);
					form_data.append('_token', '{{csrf_token()}}');
					form_data.append('id_sekolah', id_sekolah);
					$.ajax({
						url: 'exsimpanpendaftaran',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							$('#divpesan').html(data);
							$('#divawal').hide();
							$('#divhasil').show();
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
		});
	</script>
  </body>
</html>
