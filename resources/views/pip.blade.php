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
							  <h3 class="widget-user-username">Program Indonesia Pintar </h3>
							  <a href="/frontpage?id={{ $id_sekolah }}"><h5 class="widget-user-desc">{{ $sekolah }}</h5></a>
							</div>
							<div class="widget-user-image">
								<img class="img-circle" src="{{ url('').'/'.$logo }}" alt="{{ $sekolah }}">
							</div>
							<div class="box-footer">
                            <div class="box box-solid bg-green-gradient">
                                <div class="box-header">
                                    <i class="fa fa-mortar-board"></i>
                                    <h3 class="box-title">Isi Buku Tamu Terlebih Dahulu</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="id_nama" placeholder="Isi Nama Siswa">
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="id_kelas" placeholder="Kelas">
                                        </div>
                                        <div class="col-lg-2">
                                            <button class="btn btn-warning btn-flat" type="button" id="btnviewdata">Simpan</button>
                                        </div><!-- /input-group -->	
                                    </div>
                                    <p class="help-text"><i>Setelah Anda Mengisi Buku Tamu, Scroll Di Bawah Ini</i></p>
                                    </div>
                                </div><!-- /.box-body-->
                            </div>
							</div>
						</div>
					</div>
				</div>
				<div class="row" id="divawal">
					<div class="col-md-12">
						<div class="box box-success">
							<div class="box-header with-border">
							  <h3 class="box-title">DAFTAR PENERIMA PIP</h3>
							</div>
							<div class="box-body">
							@if(isset($tabel) && !empty($tabel))
                                <table class="table table-striped table-hover">
                                    @php $no = 1; @endphp
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>DATA MASUK</th>
                                            <th>NAMA</th>
                                            <th>KLS LAMA</th>
                                            <th>KLS BARU</th>
                                            <th>THP/TAHUN</th>
                                            <th>NO.REKENING</th>
                                            <th>VIRTUAL ACC</th>
                                            <th>KETERANGAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
								    @foreach($tabel as $rows)
                                        <tr>
                                            <td>{{$no}}</td>
									        <td>{{$rows['datamasuk']}}</td>
									        <td>{!! $rows['nama'] !!}</td>
									        <td>{!! $rows['kelaslama'] !!}</td>
									        <td>{!! $rows['kelasbaru'] !!}</td>
									        <td>{!! $rows['tahap'] !!}</td>
									        <td>{!! $rows['norek'] !!}</td>
									        <td>{!! $rows['virtualacc'] !!}</td>
									        <td>{!! $rows['keterangan'] !!}</td>
                                        </tr>
                                        @php $no++; @endphp
									@endforeach
                                    </tbody>
                                </table>
								@else
                                <ul class="timeline">
									<li class="time-label">
										<span class="bg-green">
										{{ $sekarang }}
										</span>
									</li>
									<li>
									  <i class="fa fa-bullhorn bg-green"></i>
									  <div class="timeline-item">
										<span class="time"><i class="fa fa-clock-o"></i> just now</span>
										<h3 class="timeline-header"><font color="green">Welcome</font> to {{ config('global.Title') }}</h3>
										<div class="timeline-body">
										Default value : <br />
										  <h2>{{ config('global.Title') }}</h2>
										  <h5>{{ config('global.sekolah') }}</h5>
										  <strong>{{ config('global.namaapps') }}</strong>
										</div>
									  </div>
									</li>
                                </ul>
								@endif
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
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	<input type="hidden" name="statppdb" id="statppdb" value="{!! $statppdb !!}">
	@include('base.partials.js')
	<script>
		$(document).ready(function() {
			var token=document.getElementById('token').value;
			$('#divawal').hide();
			$("#btnviewdata").click(function(){
				var set01 	= document.getElementById('id_nama').value;
				var set02	= document.getElementById('id_kelas').value;
				if (set01 == '' || set02 == ''){
					swal({
						title: 'Stop',
						text: 'Isi Nama dan Kelas Terlebih Dahulu',
						type: 'warning',
					})
				}
				else {
					var form_data = new FormData();
					form_data.append('val01', set01);
					form_data.append('val02', set02);
					form_data.append('val03', '{{$id_sekolah}}');
					form_data.append('_token', '{{csrf_token()}}');
					$.ajax({
						url: 'pip/saveabsen',
						data: form_data,
						type: 'POST',
						contentType: false,
						processData: false,
						success: function (data) {
							var status  = data.status;
							var message = data.message;
							var warna 	= data.warna;
							var icon 	= data.icon;
                            if (icon == 'success'){
                                $('#divawal').show();
                            }
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
		});
	</script>
  </body>
</html>
