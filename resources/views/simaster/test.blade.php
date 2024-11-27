<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            @if (isset($namaapps01))
                {{ $namaapps01 }}
            @elseif (Session('namaapps01') !== null)
                {{ Session('namaapps01') }}
            @else
                {{ config('global.Title') }}
            @endif
        </title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ asset('adminlte3/fonts/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
        <link href="{{ asset('adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('adminlte3/dist/css/adminlte.min.css') }}" rel="stylesheet">
        <link href="{{ asset('adminlte3/plugins/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet" />

    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="#" class="h1"><b>PDS</b><br />Daarul Ukhuwwah</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Portal Ujian</p>
                    <div class="input-group mb-3">
                        <input type="text" name="username" id="username" class="form-control" placeholder="Nomor Ujian"/>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="password" id="login_password" class="form-control" onkeyup="submitForm(event)" placeholder="No. Induk Sekolah"/>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <a href="#" id="btnshowpassword"><span class="fa fa-lock"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <a id="btnlogin" href="#" class="btn btn-social btn-primary pull-right"><i class="fa fa-unlock-alt"></i> Sign In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('adminlte3/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('adminlte3/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('adminlte3/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <script>
          function submitForm(e) {
                var keyCode = e.keyCode ? e.keyCode : e.which;
                if (keyCode == 13){
                    $('#btnlogin').click();
                }
            }
		    $(document).ready(function () {
			    $('#btnshowpassword').on('click', function (){
					var x = document.getElementById('password');
					if (x.type === "password") {
						x.type = "text";
					} else {
						x.type = "password";
					}
				});
                $('#btnlogin').click(function () {
                    var set01=document.getElementById('username').value;
                    var set02=document.getElementById('login_password').value;
                    var set04='SDTQDU';
                    var set05='';
                    var set06='1';
                    var token=document.getElementById('token').value;
                    if (set01 == ''){
                        swal({
                            title: 'Mohon lengkapi',
                            text: 'Email Aktif Wajib di Isi',
                            type: 'info',
                        });
                    } else if (set02 == ''){
                        swal({
                            title: 'Mohon lengkapi',
                            text: 'Password Wajib di Isi',
                            type: 'info',
                        });
                    } else {
                        var btn = $(this);
                            btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                        var formdata = new FormData();
                            formdata.set('email',set01);
                            formdata.set('password',set02);
                            formdata.set('remember','1');
                            formdata.set('fakultas',set04);
                            formdata.set('firebaseid',set05);
                            formdata.set('id_sekolah',set06);
                            formdata.set('_token',token);
                        url='{{ route("exLoginTest") }}';
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
                                    title: 'Success',
                                    text:  'Welcome '+response.user.nama,
                                    type: 'info',
                                });
                                location.reload();
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
                });
			});
		</script>
    </body>
</html>
