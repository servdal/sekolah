@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1> Riwayat Data an. {{$datainduk->nama}} Semester {{$semester}} TP {{$tapel}}</h1>
                </div>
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:history.back()">Kembali ke Laman Sebelumnya</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Profil Siswa</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card card-outline shadow">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <select id="induk_dataview" name="induk_dataview" class="form-control" >
                                                    <option value="1">Data Siswa</option>
                                                    <option value="6">Beasiswa</option>
                                                    <option value="10">Perilaku Siswa (Bimbingan dan Konseling)</option>
                                                    <option value="11">Laporan Prestasi Siswa</option>
                                                    <option value="28">Laporan Halaqoh Alquran</option>
                                                    <option value="29">Laporan Ujian AlQuran</option>
                                                    <option value="30">Laporan Ujian Lisan</option>
                                                    <option value="31">Prestasi Belajar Kelas Umum</option>
                                                    <option value="32">Rincian Nilai</option>
                                                </select>
                                                <input type="hidden" name="valcari" id="valcari">
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div style="overflow-y: auto; height:480px; ">
                                                <div id="divdataview"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-primary card-outline" >
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img src="" width="100%" id="picprofile" alt="User profile picture" width="100%"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-warning card-outline" >
                                        <div class="card-body box-profile bg-warning">
                                            <div class="text-center">Semester {{$semester}} TP {{$tapel}}</div>
                                        </div>
                                        <div class="card-body">
                                            <div id='grafiksebaran' style="width:100%; height:320px;"></div>
                                        </div>
                                    </div>
                                    <div class="card card-danger card-outline" >
                                        <div class="card-body box-profile bg-danger">
                                            <div class="text-center">Semester {{$semester}} TP {{$tapel}}</div>
                                        </div>
                                        <div class="card-body">
                                            <div id='grafiksebaranperjenis' style="width:100%; height:320px;"></div>
                                        </div>
                                    </div>
                                    <div class="card card-info card-outline" >
                                        <div class="card-body box-profile bg-info">
                                            <div class="text-center">Semester {{$semester}} TP {{$tapel}}</div>
                                        </div>
                                        <div class="card-body">
                                            <div id='grafikkehadiran' style="width:100%; height:320px;"></div>
                                        </div>
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
@endsection
@push('script')
<script>
	function openedpage( jQuery ){
		var set01		= "{{$datainduk->id}}";
        var set02		= "{{$datainduk->foto}}";
        if (set02 == '' || set02 == null){
            var set02   = 'mascot.png';
        } else {
            var set02   = '/dist/img/foto/'+set02;
        }
        $("#induk_dataview").val('1');
        $('#picprofile').attr('src', set02);
        $("#valcari").val(set01);
        $('#divawal').hide();
        $('#detailsiswa').show();
        var source1 = {
            datatype: "json",
            datafields: [
                { name: 'jenis' },
                { name: 'jumlah' },
            ],
            type: 'POST',
            data: {val01: set01, _token: '{{ csrf_token() }}'},
            url : '{{ route("jsonStatistikDatakd") }}',
        };
        var datajrekap1		= new $.jqx.dataAdapter(source1);
        var settinggrafik 	= {
            title           : "Perbandingan Rata-Rata Nilai",
            description     : "Penilaian vs Evaluasi",
            enableAnimations: true,
            showBorderLine  : true,
            colorScheme     : 'scheme03',
            padding         : { left: 5, top: 5, right: 5, bottom: 5 },
            titlePadding    : { left: 0, top: 0, right: 0, bottom: 10 },
            source          : datajrekap1,
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
            type: 'POST',
            data: {val01: set01, _token: '{{ csrf_token() }}'},
            url : '{{ route("jsonStatDatapermuatan") }}',
        };
        var datajrekap2		= new $.jqx.dataAdapter(source2);
        var settinggrafik2 = {
            title               : "Statistik",
            description         : "Per Matapelajar",
            enableAnimations    : true,
            titlePadding        : { left: 0, top: 0, right: 0, bottom: 10 },
            source              : datajrekap2,
            xAxis               :
                {
                    dataField       : 'jenis',
                    displayText     : 'Matapelajaran',
                    gridLines       : { visible: true },
                    valuesOnTicks   : false
                },
            colorScheme         : 'scheme02',
            columnSeriesOverlap : false,
            seriesGroups        : [{
                type            : 'column',
                valueAxis       :
                {
                    visible     : true,
                    title       : { text: 'Nilai<br>' }
                },
                series: [
                    { dataField : 'jumlah3', displayText: 'Rata-Rata P-E' },	
                    { dataField : 'jumlah4', displayText: 'Rata-Rata PTS-PAS' },
                ]
            }]
        };
        $('#grafiksebaranperjenis').jqxChart(settinggrafik2);
        var source3 = {
            datatype    : "json",
            datafields  : [
                { name: 'jenis' },
                { name: 'jumlah' },
            ],
            type: 'POST',
            data: {val01: set01, _token: '{{ csrf_token() }}'},
            url : '{{ route("jsonStatDatakehadiran") }}',
        };
        var datajrekap3		= new $.jqx.dataAdapter(source3);
        var settinggrafik3  = {
            title               : "Statistik",
            description         : "Kehadiran Siswa",
            enableAnimations    : true,
            titlePadding        : { left: 0, top: 0, right: 0, bottom: 10 },
            source              : datajrekap3,
            xAxis               : {
                dataField       : 'jenis',
                displayText     : 'Status',
                gridLines       : { visible: true },
                valuesOnTicks   : false
            },
            colorScheme         : 'scheme03',
            columnSeriesOverlap : false,
            seriesGroups        : [{
                type    : 'column',
                series  : [
                    { dataField: 'jumlah', displayText: 'Jumlah' },
                ]
            }]
        };
        $('#grafikkehadiran').jqxChart(settinggrafik3);
        $.post('{{ route("jsonViewDatainduk") }}', { val01: '1', val02: set01, _token: '{{ csrf_token() }}' },
        function(data){
            $('#divdataview').html(data);
            return false;
        });
	}
	window.onload = openedpage;
    $(document).ready(function () {
        $("#induk_dataview").on('change', function () {
            var set01	= $(this).find('option:selected').attr('value');
            var set02	= document.getElementById('valcari').value;
            $.post('{{ route("jsonViewDatainduk") }}', { val01: set01, val02: set02, _token: '{{ csrf_token() }}' },
            function(data){
                $('#divdataview').html(data);
                return false;
            });
        });
    });
</script>
@endpush