@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Log Nilai <small>Perubahan Data Keuangan 30 Hari Terakhir</small></h1>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-danger shadow">
                        <div class="card-body">
                            <div class="timeline">
                                @if(isset($pengumumans) && !empty($pengumumans))
                                    @foreach($pengumumans as $pengumuman)
                                        <div class="time-label">
                                            <span class="bg-{{ $pengumuman['urutanwerno'] }}"> {!! $pengumuman['tanggal'] !!}</span>
                                        </div>
                                        <div>
                                            <i class="{{ $pengumuman['icon'] }} bg-{{ $pengumuman['urutanwerno'] }}"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock"></i> {{ $pengumuman['kapan'] }}</span>
                                                <h3 class="timeline-header">{!! $pengumuman['siapa'] !!}</h3>
                                                <div class="timeline-body">
                                                    {!! $pengumuman['pengumuman'] !!}
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
                                                <h2>{{ $namaapps01 }}</h2>
                                                <h5>{{ $subsubdomainapps01 }}</h5>
                                                <strong>{{ $addressapps01 }}</strong>
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
                </div>
            </div>
		</div>
	</div>
</div>
@endsection