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
                                        <li class="nav-item"><a class="nav-link navlinkother" href="#ujianlisan" data-toggle="tab">Ujian Lisan</a></li>
                                        <li class="nav-item"><a class="nav-link navlinkother" href="#depan" data-toggle="tab">Rapot Khas</a></li>
                                        <li class="nav-item"><a class="nav-link navlinkother" href="#formonline" data-toggle="tab">Rapot Dinas</a></li>
                                        <li class="nav-item"><a class="nav-link navlinkother active" href="#telemedicine" data-toggle="tab">Rapot Al Quran</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane" id="ujianlisan">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" id="btnprintrapot1"><i class="fa fa-print"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body table-responsive p-0">
                                                {!! $hasilujianlisan !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="depan">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" id="btnprintrapot2"><i class="fa fa-print"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body table-responsive p-0">
                                                {!! $rapotkhas !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="formonline">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" id="btnprintrapot3"><i class="fa fa-print"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body table-responsive p-0">
                                                {!! $rapotdinas !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="active tab-pane" id="telemedicine">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" id="btnprintrapot4"><i class="fa fa-print"></i></button>
                                                    </div>
                                                </div>
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
                            @if ($ttdortu != '')
                                <div class="timeline">
                                    <div class="time-label">
                                        <span class="bg-success"> Surat Telah di Tandatangani</span>
                                    </div>
                                    <div>
                                        <i class="fa fa-pencil bg-success"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock"></i> {{ $rapot->updated_at }}</span>
                                            <h3 class="timeline-header">Orang Tua</h3>
                                            <div class="timeline-body">
                                                <img src="{!! $ttdortu !!}" width="100%"/>
                                                <h5>Catatan Orang Tua :</h5>
                                                <p>{!! $catatanortu !!}</p>
                                            </div>
                                            <div class="timeline-body">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
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
                                <div class="form-group">
                                    <label for="alasan" class="col-form-label">Catatan Dari Orang Tua / Wali</label>
                                    <textarea id="alasan"></textarea>
                                </div>
                                <div class="form-group">
                                    <a href="#" class="btn btn-block btn-danger pull-left" id="btnsetuju">
                                        <i class="fa fa-save"></i>  Simpan Catatan Orang Tua
                                    </a>
                                </div>
                            @endif
                            
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
		</div>
	</div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="idsurat" id="idsurat" value="{{ $rapot->id }}">
<input type="hidden" name="alamatweb" id="alamatweb" value="">
<input type="hidden" name="jenissurat" id="jenissurat" value="Rapot Orang Tua">
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
            var val02 	= signaturePad.toDataURL('image/png');
            if (val02 == document.getElementById('signature-blank').toDataURL()){ val02 = ''; }
            var val03   = 'SETUJU';
            if (val02 == '') { 
                swal({
                    title	: 'Stop',
                    text	: 'Mohon Gambarkan Tandatangan Bapak/Ibu di Kotak Yang Sudah di Sediakan',
                    type	: icon,
                })
            }
            var val04   = CKEDITOR.instances['alasan'].getData();
            var val05	= document.getElementById('jenissurat').value;
            var token	= document.getElementById('token').value;
            var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
            $.post('{{route("expersetujuanBerkas")}}', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, _token: token },
            function(data){
                $("html, body").animate({ scrollTop: 0 }, "slow");
                btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                var status  = data.status;
                var message = data.message;
                $.toast({
                    heading     : status,
                    text        : message,
                    position    : 'top-right',
                    loaderBg    : '#bf441d',
                    icon        : 'info',
                    hideAfter   : 5000,
                    stack       : 1
                });
                var uri = window.location.href.split("#")[0];
				setTimeout(function () { window.location=uri;}, 5000);
                return false;
            });
        });
        $("#btnprintrapot1").click(function(){
            var link = '{{$linkrapotlisan}}';
            window.location=link;
        });
        $("#btnprintrapot2").click(function(){
            var link = '{{$linkrapotkhas}}';
            window.location=link;
        });
        $("#btnprintrapot3").click(function(){
            var link = '{{$linkrapotdinas}}';
            window.location=link;
        });
        $("#btnprintrapot4").click(function(){
            var link = '{{$linkrapotalquran}}';
            window.location=link;
        });
        openedpage();
    });
</script>
@endpush