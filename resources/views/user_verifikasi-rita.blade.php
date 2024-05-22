@extends('adminlte3.layoutstandart')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Ubah Password</h1>
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
                <div class="col-md-12">
                    <div id="loading">
                        <img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
                    </div>
                    <div class="card card-primary card-outline" >
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{!! $foto !!}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">Form Ubah Password</h3>
                            <p class="text-muted text-center">Input new password</p>
                        </div>
                        <div class="card-footer" id="divisian">
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
                                    <i class="fa fa-unlock-alt"></i> Set Password Login
                                </a>
                            </div>
                        </div>
                        <div class="card-footer" id="divterimakasih">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title" id="status">Notif</h3>
                                </div>
                                <div class="card-footer">
                                    <span id="pesan"><a href="{{ url('/') }}">Password Telah di Ubah Klik di Sini Untuk Ke Laman Awal</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="email" id="email" value="{{ $email }}">
@endsection
@push('script')
<script type="text/javascript">
$(document).ready(function() {
    $('#loading').hide();
    $('#divterimakasih').hide();
    $('#btnkirimpassword').click(function () {
        var set01=document.getElementById('lupa_password1').value;
        var set02=document.getElementById('lupa_password2').value;
        var set03=document.getElementById('email').value;
        var token=document.getElementById('token').value;
        if (set01 == ''){
            swal({
                title: 'Mohon lengkapi',
                text: 'Email Aktif Wajib di Isi',
                type: 'info',
            });
        } else {
            var formdata = new FormData();
                formdata.set('email','setpassword');
                formdata.set('val02',set01);
                formdata.set('val03',set02);
                formdata.set('val04',set03);
                formdata.set('_token',token);
            url='{{ route("exResetPassword") }}';
            $('#loading').show();
            $('#divisian').hide();
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
                    var pesan = response.message;
                    if (pesan == null || pesan == ''){
                        $('#pesan').html('Password Gagal di Ubah. Klik di Sini Untuk Ke Laman Awal');
                    } else {
                        $('#pesan').html(response.message);
                    }
                    $('#divterimakasih').show();
                    $('#loading').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal({
                        title: textStatus,
                        text:  errorThrown,
                        type: 'info',
                    });
                    $('#loading').hide();
    
                }
            });
        }
    });
});
</script>
@endpush