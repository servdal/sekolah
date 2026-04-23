@extends('adminlte3.layouttop')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Rapot Elektronik</h1>
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
                                <img class="img-circle elevation-2" src="{!! $foto !!}" alt="User Avatar">
                                </div>
                                <h3 class="widget-user-username">{{$rapot->nama}}</h3>
                                <h5 class="widget-user-desc">{{$rapot->noinduk}} / {{$rapot->nisn}}</h5>
                            </div>
                        </div>
                        <div class="card card-body">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link navlinkother" href="#depan" data-toggle="tab">Rapot Khas</a></li>
                                        <li class="nav-item"><a class="nav-link navlinkother active" href="#telemedicine" data-toggle="tab">Rapot Al Quran</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane" id="depan">
                                            <div class="card">
                                                <div class="card-body table-responsive p-0">
                                                {!! $rapotkhas !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="active tab-pane" id="telemedicine">
                                            <div class="card">
                                                <div class="card-body table-responsive p-0">
                                                {!! $rapotalquran !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-body">
                            
                            <div class="form-group">
                                <label for="alasan" class="col-form-label">Catatan Kepala Sekolah</label>
                                <textarea id="alasan"></textarea>
                            </div>
                            <div class="card card-footer">
                                <div class="form-group">
                                    Dengan menandatangani Form Pengajuan ini, saya menyatakan bahwa saya telah memeriksa isi surat tersebut diatas dan menyatakan isi dan redaksi surat sudah benar dan bisa di proses lebih lanjut
                                </div>
                                <div class="form-group"> 
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="username" id="username" class="form-control" value="{{$usernameks}}" disabled="disable"/>
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
                    </div>
                    <div class="col-md-4">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Statistik</h3>
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
                                <div id='grafiksebaranperjenis' style="width:100%; height:320px;"></div>
                            </div>
                            <div class="card-footer">
                                <div id='grafiksebaran' style="width:100%; height:320px;"></div>
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
<input type="hidden" name="idsurat" id="idsurat" value="{{ $rapot->id }}">
<input type="hidden" name="tandatangan" id="tandatangan" value="{!!$tandatangan!!}">
<input type="hidden" name="jenissurat" id="jenissurat" value="Rapot Kepala Sekolah">
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
    function openedpage( jQuery ){
        var set01=document.getElementById('idsurat').value;
        var token=document.getElementById('token').value;
        var sourcegrafik = {
            datatype: "json",
            datafields: [
                { name: 'jenis' },				
                { name: 'jumlah' },
            ],
            type: 'POST',
            data: {val01: set01, _token: token},
            url : '{{ route("jsonStatistikkd") }}',
        };
        var datajrekap		= new $.jqx.dataAdapter(sourcegrafik);
        var settinggrafik 	= {
            title           : "Statistik",
            description     : "Tugas, Evaluasi dan Ujian Akhir",
            enableAnimations: true,
            showBorderLine  : true,
            colorScheme     : 'scheme03',
            padding         : { left: 5, top: 5, right: 5, bottom: 5 },
            titlePadding    : { left: 0, top: 0, right: 0, bottom: 10 },		
            source          : datajrekap,
            seriesGroups    :
            [
                {
                    type        : 'pie',
                    showLabels  : true,
                    series      :
                    [
                        {
                            dataField       : 'jumlah',
                            displayText     : 'jenis',
                            labelRadius     : 100,
                            initialAngle    : 15,
                            radius          : 90,
                            centerOffset    : 0,
                            formatSettings  : { decimalPlaces: 1 }
                        }
                    ]
                }
            ]
        };
        $('#grafiksebaran').jqxChart(settinggrafik);
        var source2 = {
            datatype: "json",
            datafields: [
                { name: 'jenis' },				
                { name: 'jumlah3' },
                { name: 'jumlah4' },
            ],
            type    : 'POST',
            data    : {val01: set01, _token: token},
            url     : '{{ route("jsonStatpermuatan") }}',
        };
        var datajrekap2		= new $.jqx.dataAdapter(source2);
        var settinggrafik2 = {
            title           : "Statistik",
            description     : "Per Matapelajar",		
            enableAnimations: true,		
            titlePadding    : { left: 0, top: 0, right: 0, bottom: 10 },
            source          : datajrekap2,
            xAxis           :
                {
                    dataField       : 'jenis',
                    displayText     : 'Matapelajaran',
                    gridLines       : { visible: true },
                    valuesOnTicks   : false
                },
            colorScheme         : 'scheme01',
            columnSeriesOverlap : false,
            seriesGroups        :
                [
                    {
                        type        : 'column',
                        valueAxis   :
                        {
                            visible : true,
                            title   : { text: 'Nilai<br>' }
                        },
                        series: [
                                { dataField: 'jumlah3', displayText: 'Rata-Rata Harian' },	
                                { dataField: 'jumlah4', displayText: 'Ujian Akhir' },							
                            ]
                    }				
                ]
        };
        $('#grafiksebaranperjenis').jqxChart(settinggrafik2);
    }
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
            var val04   = CKEDITOR.instances['alasan'].getData();
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
        openedpage();
    });
</script>
@endpush