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
                <div class="card card-primary card-outline" >
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="mascot.png" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">Form Ubah Password</h3>
                        <p class="text-muted text-center">Input new password</p>
                    </div>
                    <div class="card-footer">
                    @if (!$validasi)
                    {{$message}}
                    @else
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email <span class="text-danger">*</span>:</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" id="email" class="form-control" value="{{$email}}" placeholder="Input Email" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label">Password <span class="text-danger">*</span>:</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" id="password" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirm" class="col-sm-4 col-form-label">Konfirmasi Password <span class="text-danger">*</span>:</label>
                            <div class="col-sm-8">
                                <input type="password" name="password_confirm" id="password_confirm" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <a id="btnkirimpassword" href="#" class="btn btn-social btn-primary pull-right">
                                <i class="fa fa-unlock-alt"></i> Set Password Login
                            </a>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
  $(document).ready(function() {
    $('#btnkirimpassword').click(function () {
        var set01=document.getElementById('password').value;
        var set02=document.getElementById('password_confirm').value;
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
                        title: 'Info',
                        text: response.message,
                        type: 'info',
                    });
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal({
                        title: textStatus,
                        text:  errorThrown,
                        type: 'info',
                    });
                }
            });
        }
    });
  });
</script>
@endpush