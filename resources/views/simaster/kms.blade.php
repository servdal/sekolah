@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Kartu Menuju Sehat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary shadow">
                        <div class="card-body p-0">
                            @if(isset($listanak) && !empty($listanak))
                                <ul class="users-list clearfix">
                                @foreach($listanak as $rows)
                                    <li><img src="{!! $rows['foto'] !!}" alt="User Image"><a class="users-list-name" href="javascript:void(0)" onClick="selectasvalue('{{ $rows['id'] }}')">{{ $rows['nama'] }}</a><span class="users-list-date">{{ $rows['noinduk'] }}</span></li>
                                @endforeach
                            </ul>
                            @endif
						</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-danger shadow" id="divtimeline">
                        <div class="card-body">
                            <div class="timeline">
                                @if(isset($kmsdata) && !empty($kmsdata))
                                    @foreach($kmsdata as $pengumuman)
                                        <div class="time-label">
                                            <span class="bg-{{ $pengumuman['urutanwerno'] }}"> {!! $pengumuman['tanggal'] !!}</span>
                                        </div>
                                        <div>
                                            <i class="fa fa-child bg-{{ $pengumuman['urutanwerno'] }}"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock"></i> {{ $pengumuman['penginput'] }}</span>
                                                <h3 class="timeline-header">{!! $pengumuman['nama'] !!}</h3>
                                                <div class="timeline-body">
                                                   Berat Badan : {!! $pengumuman['berat'] !!} Kg<br />
                                                   Tinggi Badan : {!! $pengumuman['tinggi'] !!} Cm<br />
                                                   Lingkar Kepala : {!! $pengumuman['lingkar'] !!} Cm<br />
                                                   Vitamin / Imunisasi : {!! $pengumuman['vitamin'] !!} <br />
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="time-label">
                                        <span class="bg-primary"> {{ date("Y-m-d H:i:s") }}</span>
                                    </div>
                                    <div>
                                        <i class="fa fa-android bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock"></i> now</span>
                                            <h3 class="timeline-header">Welcome</h3>
                                            <div class="timeline-body">
                                                <h2>Data Belum Ada</h2>
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </div>
                            </div>
						</div>
                    </div>
                    <div class="card card-primary shadow divgrafik">
                        <div class="card-body">
                            <div id="grafikberat" style="width:100%; height:300px;"></div>
						</div>
                    </div>
                    <div class="card card-warning shadow divgrafik">
                        <div class="card-body">
                            <div id="grafiktinggi" style="width:100%; height:300px;"></div>
						</div>
                    </div>
                    <div class="card card-info shadow divgrafik">
                        <div class="card-body">
                            <div id="grafiklingkar" style="width:100%; height:300px;"></div>
						</div>
                    </div>
                </div>
            </div>
		</div>
	</section>
</div>
@endsection
@push('script')
<script type="text/javascript">
    function selectasvalue(id){
        $('#divtimeline').hide();
        var source = {
            datatype: "json",
            datafields: [
                { name: 'tanggal' },
                { name: 'berat', type: 'integer'},
                { name: 'tinggi', type: 'integer' },
                { name: 'lingkar', type: 'integer' },
            ],
            type    : 'POST',
            data    : {val01: id, _token: '{{ csrf_token() }}'},
            url     : '{{ route("jsonNStatistikilaisiswa") }}',
        };
        var dataJsonKMS		= new $.jqx.dataAdapter(source);
        var settinggrafik1 = {
            title           : "Statistik",
            description     : "Perkembangan Berat Badan",
            enableAnimations: true,
            titlePadding    : { left: 0, top: 0, right: 0, bottom: 10 },
            source          : dataJsonKMS,
            xAxis           :
                {
                    dataField       : 'tanggal',
                    displayText     : 'Bulan',
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
                            
                            title   : { text: 'Dalam Kg' }
                        },
                        series: [
                            { dataField: 'berat', displayText: ' Kg' },	
                        ]
                    }
                ]
        };
        var settinggrafik2 = {
            title           : "Statistik",
            description     : "Perkembangan Tinggi Badan",
            enableAnimations: true,
            titlePadding    : { left: 0, top: 0, right: 0, bottom: 10 },
            source          : dataJsonKMS,
            xAxis           :
                {
                    dataField       : 'tanggal',
                    displayText     : 'Bulan',
                    gridLines       : { visible: true },
                    valuesOnTicks   : false
                },
            colorScheme         : 'scheme02',
            columnSeriesOverlap : false,
            seriesGroups        :
                [
                    {
                        type        : 'column',
                        valueAxis   :
                        {
                            visible : true,
                            title   : { text: 'Dalam Cm' }
                        },
                        series: [
                            { dataField: 'tinggi', displayText: ' Cm' },	
                        ]
                    }
                ]
        };
        var settinggrafik3 = {
            title           : "Statistik",
            description     : "Perkembangan Lingkar Kepala",
            enableAnimations: true,
            titlePadding    : { left: 0, top: 0, right: 0, bottom: 10 },
            source          : dataJsonKMS,
            xAxis           :
                {
                    dataField       : 'tanggal',
                    displayText     : 'Bulan',
                    gridLines       : { visible: true },
                    valuesOnTicks   : false
                },
            colorScheme         : 'scheme03',
            columnSeriesOverlap : false,
            seriesGroups        :
                [
                    {
                        type        : 'column',
                        valueAxis   :
                        {
                            visible : true,
                            title   : { text: 'Dalam Cm' }
                        },
                        series: [
                            { dataField: 'lingkar', displayText: ' Cm' },	
                        ]
                    }
                ]
        };
        $('#grafikberat').jqxChart(settinggrafik1);
        $('#grafiktinggi').jqxChart(settinggrafik2);
        $('#grafiklingkar').jqxChart(settinggrafik3);
        $('.divgrafik').show();
    }
    $(document).ready(function () {
        $('#divtimeline').show();
        $('.divgrafik').hide();
    });
</script>
@endpush