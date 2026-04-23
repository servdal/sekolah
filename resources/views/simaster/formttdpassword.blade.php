@extends('adminlte3.layouttop')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Form Tandatangan Online</h1>
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
            <div id="divawal">
                <div class="row" >
                    <div class="col-md-8">
                        <div class="card card-widget widget-user-2">
                            <div class="widget-user-header bg-success">
                                <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="{{asset('logo.png')}}" alt="User Avatar">
                                </div>
                                <h3 class="widget-user-username">Yth. {{$bendahara}}</h3>
                                <h5 class="widget-user-desc">Mohon Menggambarkan Tandatangan Bapak/Ibu di Kotak Yang di Sediakan</h5>
                            </div>
                        </div>
                        <div class="card card-body">
                            <embed src="{!! $surat !!}" type="application/pdf" width="100%" height="600px" />
                        </div>
                        <div class="card card-footer">
                            <div class="form-group">
                                Dengan menandatangani Form Pengajuan ini, saya menyatakan bahwa saya telah memeriksa isi surat tersebut diatas dan menyatakan isi dan redaksi surat sudah benar dan bisa di proses lebih lanjut
                            </div>
                            <div class="form-group"> 
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="username" id="username" class="form-control" value="{{$usernameks}}"  disabled="disable"/>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Sesuai Username disamping" />
                                    </div>
                                    <div class="col-md-3">
                                        <a href="#" class="btn btn-lg btn-info pull-left" id="btnsetuju">
                                            <i class="fa fa-save"></i>  Simpan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Apabila Tidak Setuju</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                Apabila Bapak/Ibu Tidak Bersedia Menandatangani Dokumen Ini Mohon Menuliskan Alasan di bawah Ini			  
                                </div>	
                                <div class="form-group">
                                    <label for="alasan" class="col-form-label">Alasan (Bila tidak setuju)</label>
                                    <textarea id="alasan"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-xs btn-danger pull-right" id="btntidak">
                                    <i class="fa fa-trash"></i> Tidak Setuju/Tidak Bersedia
                                </a>            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="divterimakasih">
                <div class="row" >
                    <div class="col-md-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Terima Kasih</h3>
                            </div>
                            <div class="card-body">
                            Terima Kasih atas Konfirmasi Persetujuan / Kesedian Bapak/Ibu. Form yang telah Bapak/Ibu Isi sebelumnya telah kami sampaikan ke pemohon guna tindak lanjut berikutnya.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div style="overflow: hidden; display: none;">
    <div class="form-row kotakttd">
        <div class="col-lg-4 col-md-4">
            <canvas id="signature-pad" class="signature-pad" width=320 height=200></canvas>
            <canvas id="signature-blank" width=320 height=200 style='display:none'></canvas>
            <img src="{{ asset('boxed-bg.jpg') }}" width=320 height=200 />
        </div>
        <div class="col-lg-4 col-md-4"></div>
    </div>
    <div class="form-group">
        <button id="btnclearttd" class="btn btn-warning btn-xs">Bersihkan Kotak Tanda Tangan</button>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="idsurat" id="idsurat" value="{{ $idsurat }}">
<input type="hidden" name="alamatweb" id="alamatweb" value="">
<input type="hidden" name="tandatangan" id="tandatangan" value="{!!$tandatangan!!}">
<input type="hidden" name="jenissurat" id="jenissurat" value="{{ $jenissurat }}">
<style>
    .kotakttd {
        position: relative;
        width: 320px;
        height: 200px;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: solid 1px #ddd;
        margin: 10px 0px;
    }
    .signature-pad {
        position: absolute;
        left: 0;
        top: 0;
        width:320px;
        height:200px;
    }
</style>
@endsection

@push('script')
<!-- SIGNATURE PAD -->
<script src="{{ asset('plugins/signature_pad/signature_pad.js') }}"></script>
<script type="text/javascript">
    $(function () {
        CKEDITOR.env.isCompatible = true;
        CKEDITOR.replace( 'alasan', {toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],removeButtons: 'Strike'});
    });
    $(document).ready(function () {
        $('#divterimakasih').hide();
        $('#btnclearttd').click(function () {
                signaturePad.clear();
            });
            var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(0, 0, 0, 0)',
            penColor: 'rgb(0, 0, 0)'
            });
        $("#btnsetuju").click(function(){
            var val01	= document.getElementById('idsurat').value;
            var val02 	= document.getElementById('tandatangan').value;
            var val04	= document.getElementById('alamatweb').value;
            var val05	= document.getElementById('jenissurat').value;
            var val06	= document.getElementById('username').value;
            var val07	= document.getElementById('password').value;
            var token	= document.getElementById('token').value;
            if (val06 == '' || val07 == '' || val02 == ''){
                swal({
                    title   : 'Stop',
                    text    : 'Kolom Tandatangan, Username dan Password Tidak Boleh Kosong (Untuk Menambahkan Scan Tandatangan, silahkan login kemudian masuk ke Profil)',
                    type    : 'warning',
                })
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                $.post('{{route("expersetujuanBerkas")}}', { set01: val01, set02: val02, set03: 'SETUJU', set04: val04, set05: val05, set06: val06, set07: val07, _token: token },
                function(data){
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    var status  = data.status;
                    var message = data.message;
                    $.toast({
                        heading: status,
                        text: message,
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'info',
                        hideAfter: 1000,
                        stack: 1
                    });
                    if (status == 'Sukses'){
                        $('#divawal').hide();
                        $('#divterimakasih').show();
                    }
                    return false;
                });
            }
        });
        $("#btntidak").click(function(){
            var val01	= document.getElementById('idsurat').value;
            var val02 	= signaturePad.toDataURL('image/png');
            var val03   = CKEDITOR.instances['alasan'].getData();
            if(val03 == 'SETUJU'){ var val03 = ''; }
            if (val02 == '') { alert("Mohon Membubuhkan Tanda Tangan Anda"); }
            if (val03 == '') { alert("Mohon Mengisi Alasan Anda Mengapa Tidak Setuju / Tidak Bersedia"); }
            var val04	= document.getElementById('alamatweb').value;
            var token	= document.getElementById('token').value;
            var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                
            $.post('{{route("expersetujuanBerkas")}}', { set01: val01, set02: val02, set03: val03, set04: val04, set05: '', _token: token },
            function(data){
                btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        
                var status  = data.status;
                var message = data.message;
                $.toast({
                    heading: status,
                    text: message,
                    position: 'top-right',
                    loaderBg: '#bf441d',
                    icon: 'info',
                    hideAfter: 1000,
                    stack: 1
                });
                if (status == 'Sukses'){
                    $('#divawal').hide();
                    $('#divterimakasih').show();
                }
                
                return false;
            });
        });
    });
</script>
@endpush