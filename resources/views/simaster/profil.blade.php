@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Welcome {!! $user->nama !!} </h1>
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
            <div class="row" >
				<div class="col-md-3">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Control Panel</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fa fa-minus"></i>
								</button>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<a id="btnshowdepan" class="btn btn-block btn-social btn-primary">
									<i class="fa fa-user"></i> Biodata
								</a>
                              	<a id="btnubahpassword" class="btn btn-block btn-social btn-warning">
									<i class="fa fa-users"></i> Ubah Password
								</a>
							</div>
						</div>
					</div>
                </div>
                <div class="col-md-9">
                    <div id="logprogram"></div>
					<div id="halamanmuka" class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Biodata</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fa fa-minus"></i>
										</button>
									</div>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" class="form-control" id="id_masterno" value="{{$user->id}}">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label for="id_name">Name</label>
                                                <input type="text" class="form-control" id="id_name" value="{!!$user->nama!!}">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="id_username">Username</label>
                                                <input type="text" id="id_username" class="form-control" value="{{$user->username}}"  disabled="disable">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_previlage">Hak Akses</label>
												<input type="text" class="form-control" id="id_previlage" value="{{$user->previlage}}" disabled="disable">
                                            </div>
                                            <div class="col-md-4 col-lg-4">
                                                <label for="id_unitkerja">NIY/NIP/NIK</label>
                                                <input type="text" class="form-control" id="id_unitkerja" value="{{$user->nip}}" disabled="disable">
                                            </div>
                                            <div class="col-md-4 col-lg-4">
												<label for="id_email">Email</label>
                                        		<input type="text" id="id_email" class="form-control" value="{{$user->email}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="card-footer">
                                    <button type="button" class="btn btn-success" id="updatebiodata">Update</button>
                                </div>
                            </div>
                        </div><!-- /kiri -->
                        <div class="col-md-5 col-lg-5">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Foto Terbaru</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fa fa-minus"></i>
										</button>
									</div>
                                </div>
                                <div class="card-body">
                                	<div class="form-group">
                                        @if(isset($datastaf->foto))
                                            <img src="{!!$datastaf->foto!!}" alt="image" width="100%" id="preview">
                                        @else
                                            <img src="dist/img/foto/{!!$user->photo!!}" alt="image" width="100%" id="preview">
                                        @endif
                                        <input type="file" id="id_fotoprofile" style="display: none;"/>
                                        <button type="button" class="btn btn-danger btn-block" id="btnuploadfoto">&nbsp;&nbsp;Upload Pas Foto&nbsp;&nbsp;</button></p>
                                    </div>
                                </div>
                            </div>
							<div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Tandatangan</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fa fa-minus"></i>
										</button>
									</div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <img src="{!!$user->tandatangan!!}" alt="image" width="100%" id="previewttd">
                                        <input type="file" id="id_tandatangan" style="display: none;"/>
                                        <button type="button" class="btn btn-info btn-block" id="btnuploadtandatangan">&nbsp;&nbsp;Upload Tandatangan&nbsp;&nbsp;</button></p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /kanan -->
                    </div><!-- /batas halaman muka -->
                    <div id="halamanubahpassword">
                        <div class="card card-primary card-outline" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    @if(isset($datastaf->foto))
                                    <img class="profile-user-img img-fluid img-circle" src="{!!$datastaf->foto!!}" alt="User profile picture">
                                    @else
                                        <img class="profile-user-img img-fluid img-circle" src="dist/img/foto/{!!$user->photo!!}" alt="User profile picture">
                                  @endif
                                </div>
                                <h3 class="profile-username text-center">Ubah Password</h3>
                                <p class="text-muted text-center">{!! $user->name !!}</p>
                            </div>
                            <div class="card-footer">
								<div class="form-group row">
									<label for="lupa_password1" class="col-sm-4 col-form-label">Password <span class="text-danger">*</span>:</label>
									<div class="col-sm-8">
										<input type="password" name="lupa_password1" id="lupa_password1" class="form-control" />
									</div>
								</div>
								<div class="form-group row">
									<label for="lupa_password2" class="col-sm-4 col-form-label">Konfirmasi Password <span class="text-danger">*</span>:</label>
									<div class="col-sm-8">
										<input type="password" name="lupa_password2" id="lupa_password2" class="form-control" />
									</div>
								</div>
								<div class="form-group row">
									<a id="btnkirimpassword" href="#" class="btn btn-social btn-primary pull-right">
										<i class="fa fa-unlock-alt"></i> Set Password Baru
									</a>
								</div>
                            </div>
                        </div>
                    </div><!-- /batas halaman Pendidikan -->
					<div id="halamanquiz">
						<div class="card card-warning direct-chat direct-chat-warning shadow">
							<div class="card-header">
								<h3 class="card-title">Lounge</h3>
								<div class="card-tools">
									<div id="timeremaining"></div>
								</div>
							</div>
							<div class="card-body">
                                <iframe src="/chatify" width="100%" height="780" style="border: none;"></iframe>
							</div>
						</div>
                    </div><!-- /batas halaman Quiz -->
                </div>
            </div>
		</div>
	</div>
</div>
<div class="modal modal-info" id="modaluploader">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Form Uploader</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<label>Nama</label>
								<input type="text" class="form-control" disabled="disable" value="{{$user->name}}">
							</div>		
							<div class="col-md-6 col-lg-6">
								<label>Eamil</label>
								<input type="text" class="form-control" disabled="disable" value="{{$user->email}}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<label>Tabel</label>
								<input type="text" class="form-control" disabled="disable" id="upload_tabel">
							</div>		
							<div class="col-md-6 col-lg-6">
								<label>Data</label>
								<input type="text" class="form-control" disabled="disable" id="upload_data">
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="file" id="upload_file" name="upload_file">
						<p class="help-block">File PDF / JPG / PNG</p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" id="master">
				<input type="hidden" id="upload_namafile">
				<input type="hidden" class="form-control" id="upload_id">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-success" id="btnsimpandataupload">Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-body -->
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="jenisujian" id="jenisujian" value="{{ Session('previlage') }}">

@endsection
@push('script')
<script>
	$(function () {
		bsCustomFileInput.init();
	});
	$('#id_fotoprofile').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
			swal({
				title	: 'Stop',
				text	: 'Maksimum file adalah 3Mb',
				type	: 'warning',
			})
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLAddmhs(this);
            } else {
				swal({
					title	: 'Stop',
					text	: 'Please select image file (jpg, jpeg, png).',
					type	: 'warning',
				})
            }
        }
    });
    function readURLAddmhs(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            };
        }
    }
	$('#id_tandatangan').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
			swal({
				title	: 'Stop',
				text	: 'Maksimum file adalah 3Mb',
				type	: 'warning',
			})
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLAddttd(this);
            } else {
				swal({
					title	: 'Stop',
					text	: 'Please select image file (jpg, jpeg, png).',
					type	: 'warning',
				})
            }
        }
    });
    function readURLAddttd(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#previewttd').attr('src', e.target.result);
            };
        }
    }
    $(document).ready(function () {
        var token = document.getElementById('token').value;
        $('#halamanubahpassword').hide();
        $('#halamanquiz').hide();
        $('#halamanmuka').show();
        $('#btnuploadfoto').on('click', function (){	
            $('#id_fotoprofile').click();
        });
        $('#btnuploadtandatangan').on('click', function (){	
            $('#id_tandatangan').click();
        });
        $('#btnshowdepan').on('click', function (){
            $('#halamanubahpassword').hide();
            $('#halamanquiz').hide();
            $('#halamanmuka').show();
            return false;
        });
        $('#updatebiodata').on('click', function (){
            var set01=document.getElementById('id_masterno').value;
            var set02=document.getElementById('id_name').value;
            var set03=document.getElementById('id_username').value;
            var set04=document.getElementById('id_previlage').value;
            var set05=document.getElementById('id_unitkerja').value;
            var set06=document.getElementById('id_email').value;
            var set07=document.getElementById('id_fotoprofile');
            var set08=document.getElementById('id_tandatangan');
            if (set02 == ''){ 
                swal({
                    title	: 'Stop',
                    text	: 'Nama Wajib di Isi',
                    type	: 'warning',
                })
            } else if (set03 == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Username Wajib di isi',
                    type	: 'warning',
                })
            } else if (set06 == ''){ 
                swal({
                    title	: 'Stop',
                    text	: 'Email Wajib di isi',
                    type	: 'warning',
                })
            } else {
                var form_data = new FormData();
                    form_data.append('file', set07.files[0]);
                    form_data.append('tandatangan', set08.files[0]);
                    form_data.append('val01', set01);
                    form_data.append('val02', set02);
                    form_data.append('val03', set03);
                    form_data.append('val04', set04);
                    form_data.append('val05', set05);
                    form_data.append('val06', set06);
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: '{{ route("exEditProfil") }}',
                    data: form_data,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        swal({
                            title   : 'Info',
                            text    :  data,
                            type    : 'info',
                        });	
                        return false;
                    },
                    error: function (xhr, status, error) {
                        swal({
                            title   : status,
                            text    :  xhr.responseText,
                            type    : 'info',
                        });
                    }
                });
            }
        });
        $('#btnkirimpassword').click(function () {
            var set01=document.getElementById('lupa_password1').value;
            var set02=document.getElementById('lupa_password2').value;
            var set03=document.getElementById('id_masterno').value;
            var token=document.getElementById('token').value;
            if (set01 == ''){
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Password Wajib di Isi',
                    type: 'info',
                });
            } else if (set01 == set02){
                var formdata = new FormData();
                    formdata.set('val01','resetpassword');
                    formdata.set('val02',set01);
                    formdata.set('val03',set02);
                    formdata.set('val04',set03);
                    formdata.set('_token',token);
                url='{{ route("exEditProfil") }}';
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
                        swal({
                            title   : response.status,
                            text    : response.message,
                            type    : response.icon,
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal({
                            title: textStatus,
                            text:  errorThrown,
                            type: 'info',
                        });
                    }
                });
            } else {
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Password Pertama dan Kedua Tidak Cocok',
                    type: 'info',
                });
            }
        });
        $("#export").click(function () {
            $("#printiki").btechco_excelexport({
                containerid: "printiki"
                , datatype: $datatype.Table
            });
        });
        $('#btnubahpassword').click(function () {
            $('#halamanubahpassword').show();
            $('#halamanquiz').hide();
            $('#halamanmuka').hide();
            return false;
        });
        $('#btnquizioner').on('click', function (){
            $('#halamanubahpassword').hide();
            $('#halamanquiz').show();
            $('#halamanmuka').hide();
            return false;
        });
    });
</script>
@endpush