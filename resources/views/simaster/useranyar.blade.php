@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
	<section class="content-header">
	    <div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"> User Admin</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
					</ol>
				</div>
			</div>
		</div>
    </section>
	<section class="content">
		<div class="container-fluid">
			<div class="card card-solid">
				<div class="card-header">
					<h3 class="card-title">All User</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-primary" id="adduserstaff"><i class="fa fa-plus"></i> Add User untuk Staff</button>
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="card-body pb-0">
					<div class="row users-list">
						@if(isset($alluser) && !empty($alluser))
							@foreach($alluser as $rows)
								<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
									<div class="card bg-light d-flex flex-fill">
										<div class="card-header text-muted border-bottom-0">
											@php 
												$jabatan = $rows['previlage'];
												if ($jabatan == 'level1'){
													$jabatan = 'Kepala / Wakil Sekolah';
												} else if ($jabatan == 'level2'){
													$jabatan = 'Guru Kelas';
												} else if ($jabatan == 'level3'){
													$jabatan = 'Guru Mata Pelajaran';
												} else if ($jabatan == 'level4'){
													$jabatan = 'Staf Tata Usaha';
												} else if ($jabatan == 'level5'){
													$jabatan = 'Bendahara';
												} else if ($jabatan == 'ortu'){
													$jabatan = 'Wali Murid';
												} else {
													$jabatan = $rows['previlage'];
												}
											@endphp
											{{$jabatan}}
										</div>
										<div class="card-body pt-0">
											<div class="row">
												<div class="col-7">
													<h2 class="lead"><b>{{$rows['nama']}}</b></h2>
													<p class="text-muted text-sm"><b> {{$rows['fakpanjang']}}</b></p>
													<ul class="ml-4 mb-0 fa-ul text-muted">
														<li class="small"><span class="fa-li"><i class="fa fa-lg fa-building"></i></span>  {{$rows['nip']}}</li>
														<li class="small"><span class="fa-li"><i class="fa fa-lg fa-phone"></i></span>  {{$rows['email']}}</li>
													</ul>
												</div>
												<div class="col-5 text-center">
													@if ($rows['photo'] == null OR $rows['photo'] == '')
														<img src="{{Session('sekolah_logo')}}" alt="user-avatar" class="img-circle img-fluid">
													@else 
														<img src="dist/img/foto/{{$rows['photo']}}" alt="user-avatar" class="img-circle img-fluid">
													@endif
												</div>
											</div>
										</div>
										<div class="card-footer">
											<div class="text-right">
												<a href="#" class="btn btn-sm btn-danger" onClick="kirimemail('{{ $rows['email'] }}')"><i class="fa fa-key"></i> Reset Password (kirim email)</a>

												<a href="#" class="btn btn-sm btn-primary" onClick="selectasvalue('{{ $rows['id'] }}')"><i class="fa fa-user"></i> Change</a>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						@endif
					</div>
				</div>
				<div class="card-footer">
					<nav aria-label="Contacts Page Navigation">
						@if ($alluser->lastPage() > 1)
							<ul class="pagination justify-content-center m-0">
								@if ($alluser->currentPage() > 1)
									<li class="page-item"><a class="page-link" href="{{ $alluser->previousPageUrl() }}">&laquo;</a></li>
								@endif
								@for ($i = 1; $i <= $alluser->lastPage(); $i++)
									<li class="page-item {{ ($alluser->currentPage() == $i) ? 'active' : '' }}">
										<a class="page-link" href="{{ $alluser->url($i) }}">{{ $i }}</a>
									</li>
								@endfor
								@if ($alluser->currentPage() < $alluser->lastPage())
									<li class="page-item"><a class="page-link" href="{{ $alluser->nextPageUrl() }}">&raquo;</a></li>
								@endif
							</ul>
						@endif
					</nav>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="modal fade" id="formtambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Editor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Pegawai</label>
                    <select id="id_pegawai" class="form-control" >
                        <option value="">Pilih Salah Satu</option>
                        @foreach($jpegawai as $rpeg)
                            <option value="{{ $rpeg['niy'] }}">{{ $rpeg['nama'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" id="id_username" name="id_username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="password" id="id_pass1" name="id_pass1" class="form-control">
                        </div> 
                        <div class="col-md-6">
                            <input type="password" id="id_pass2" name="id_pass2" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select id="id_level" name="id_level" class="form-control" >
                        <option value=""></option>
                        <option value="level1">Level 1 (KaSek, WaKaSek)</option>
                        <option value="Waka Kurikulum">Level 1.a (Waka Kurikulum)</option>
                        <option value="Waka Kurikulum Al Quran">Level 1.b (Waka Kurikulum Al Quran)</option>
                        <option value="Waka Kesiswaan">Level 1.c (Waka Kesiswaan)</option>
                        <option value="level2">Level 2 (Guru Kelas)</option>
                        <option value="level3">Level 3 (Guru Matpel)</option>
                        <option value="Guru Ekstrakurikuler">Level 3 (Guru Ekstrakurikuler)</option>
                        <option value="level4">Level 4 (Staf TU/Administrasi)</option>
                        <option value="level5">Level 5 (Bendahara)</option>
                        <option value="Guru AlQuran">Guru AlQuran</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="hidden" class="form-control" id="id_idne">
                <button type="button" class="btn btn-success" id="addstaffuser">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editdatainduk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Editor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
				<div class="form-group">
                    <label>Pilih Pegawai</label>
                    <select id="edit_pegawai" class="form-control" >
                        <option value="">Pilih Salah Satu</option>
                        @foreach($jpegawai as $rpeg)
                            <option value="{{ $rpeg['niy'] }}">{{ $rpeg['nama'] }}</option>
                        @endforeach
                    </select>
                </div>	
				<div class="form-group">
                    <label>Nama</label>
                    <input type="text" id="edit_namaasli" name="edit_namaasli" class="form-control" readonly="readonly">			  
                </div>	
                <div class="form-group">
                    <label>Username (Email Aktif)</label>
                    <input type="text" id="edit_nama" name="edit_nama" class="form-control">			  
                </div>
                <div class="form-group">
                    <label>Password Baru</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="password" id="edit_pass1" name="edit_pass1" class="form-control">
                        </div> 
                        <div class="col-md-6">
                            <input type="password" id="edit_pass2" name="edit_pass2" class="form-control">
                        </div>
                    </div>
                </div>
				<div class="form-group">
                    <label>Level</label>
                    <select id="edit_level" name="edit_level" class="form-control" >
                        <option value=""></option>
                        <option value="level1">Level 1 (KaSek, WaKaSek)</option>
                        <option value="Waka Kurikulum">Level 1.a (Waka Kurikulum)</option>
                        <option value="Waka Kurikulum Al Quran">Level 1.b (Waka Kurikulum Al Quran)</option>
                        <option value="Waka Kesiswaan">Level 1.c (Waka Kesiswaan)</option>
                        <option value="level2">Level 2 (Guru Kelas)</option>
                        <option value="level3">Level 3 (Guru Matpel)</option>
                        <option value="Guru Ekstrakurikuler">Level 3 (Guru Ekstrakurikuler)</option>
                        <option value="level4">Level 4 (Staf TU/Administrasi)</option>
                        <option value="level5">Level 5 (Bendahara)</option>
						<option value="Guru AlQuran">Guru AlQuran</option>
                        <option value="Arsip">Non Aktifkan</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="simpanpass">Save</button>
            </div>
        </div>
    </div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script>
	function selectasvalue(id){
		var btn = $(this);
            btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
        $.post('{{ route("exusername") }}', { val01:id, val02:'-', val04: 'getusername', _token: '{{ csrf_token() }}' },
        function(data){
			var cekprevilage = data.previlage;
			btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
			if (cekprevilage == 'ortu'){
				swal({
					title	: 'Stop',
					text	: 'Akun Orang Tua tidak boleh di Edit, Apabila ingin membantu terkait password Bapak/Ibu bisa mengirimkan link reset password dengan clik tombol Kirim Password Reset',
					type	: 'warning',
				})
			} else {
				$("#edit_namaasli").val(data.message);
				$("#edit_nama").val(data.username);
				$("#edit_pegawai").val(data.nip);
				$("#edit_level").val(data.previlage);
				$("#id_idne").val(id);
				$("#editdatainduk").modal('show');
			}
            return false;
        });
    }
	function kirimemail(id){
		var btn = $(this);
            btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
		var formdata = new FormData();
			formdata.set('val01',id);
			formdata.set('val02','resetpassword');
			formdata.set('val03','');
			formdata.set('val04','');
			formdata.set('_token','{{ csrf_token() }}');
		url='{{ route("exResetPassword") }}';
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
				btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
				swal({
					title: 'Info',
					text:  response.message,
					type: 'info',
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {
				btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
				swal({
					title: textStatus,
					text:  jqXHR.responseText,
					type: 'info',
				});
			}
		});
    }
	$(document).ready(function () {
		var token = document.getElementById('token').value;
		$('#adduserstaff').click(function () {
			$("#id_pegawai").val('');
			$("#id_level").val('');
			$("#id_pass1").val('');
			$("#id_pass2").val('');
			$("#id_username").val('');
			$("#id_idne").val('new');
			$("#formtambah").modal('show');
		});
		$('#simpanpass').click(function () {
			var set01=document.getElementById('id_idne').value;
			var set02=document.getElementById('edit_nama').value;
			var set03=document.getElementById('edit_pass1').value;
			var set04='ubah';
			var set05=document.getElementById('edit_pass2').value;
			var set06=document.getElementById('edit_level').value;
			var set07=document.getElementById('edit_pegawai').value;
			var set08=document.getElementById('id_username').value;
			var token=document.getElementById('token').value;
			$("#editdatainduk").modal('hide');
			$.post('exusername', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, _token: token },
			function(data){
				$("html, body").animate({ scrollTop: 0 }, "slow");
				var status  = data.status;
				var message = data.message;
				var warna 	= data.warna;
				var icon 	= data.icon;
				$.toast({
					heading		: status,
					text		: message,
					position	: 'top-right',
					loaderBg	: warna,
					icon		: icon,
					hideAfter	: 5000,
					stack		: 1
				});
				location.reload();
				return false;
			});
		});
		$('#addstaffuser').click(function () {
			var set01=document.getElementById('id_idne').value;
			var set02=document.getElementById('id_pegawai').value;
			var set03=document.getElementById('id_pass1').value;
			var set04=document.getElementById('id_username').value;
			var set05=document.getElementById('id_pass2').value;
			var set06=document.getElementById('id_level').value;
			var token=document.getElementById('token').value;
			$.post('exusername', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, _token: token },
			function(data){	
				$("#formtambah").modal('hide');
				$("#gridusername").jqxGrid("updatebounddata", "filter");		
				$("html, body").animate({ scrollTop: 0 }, "slow");
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
			});
		});
	});
</script>
@endpush