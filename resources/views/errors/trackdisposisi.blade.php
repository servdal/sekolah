@extends('adminlte3.layoutstandart')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
        </div>
      </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row" >
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                        Sistem Monitoring Progres Pemrosesan Surat
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="timeline">
                                        @foreach($pengumumans as $pengumuman)
                                            <div class="time-label">
                                                <span class="bg-{{ $pengumuman['urutanwerno'] }}"> {!! $pengumuman['tanggal'] !!}</span>
                                            </div>
                                            <div>
                                                <i class="fa {{ $pengumuman['icon'] }} bg-{{ $pengumuman['urutanwerno'] }}"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fa fa-clock"></i> {{ $pengumuman['kapan'] }}</span>
                                                    <h3 class="timeline-header">{!! $pengumuman['siapa'] !!}</h3>
                                                    <div class="timeline-body">
                                                        {!! $pengumuman['pengumuman'] !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div>
                                            <i class="fa fa-clock-o bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-primary card-outline" >
                        <div class="card-body box-profile bg-primary">
                            <div class="text-center">
                                <img src="{!! $logofrontapps01 !!}" alt="User profile picture" width="100%">
                            </div>
                        </div>
                        <div class="card-body">
                            <strong><i class="fa fa-book mr-1"></i> Surat Dari</strong>
                            <p class="text-muted">
                                @if(isset($datadiri->asalsurat))
                                    {!! $datadiri->asalsurat !!}
                                @elseif (isset($datadiri->inputor))
                                    {!! $datadiri->inputor !!}
                                @elseif (isset($datadiri->pembuat))
                                    {!! $datadiri->pembuat !!}
                                @elseif (isset($datadiri->konseptor))
                                    {!! $datadiri->konseptor !!}
                                @else
                                    -
                                @endif
                            </p>
                            <hr>
                             Alamat
                            
                                @if(isset($datadiri->perihal))
                                    <strong><i class="fa fa-phone mr-1"></i>Perihal</strong>
                                    {!! $datadiri->perihal !!}
                                    <p class="text-muted">Kepada : {!! $datadiri->kepada !!}</p>
                                @elseif (isset($datadiri->jenissk))
                                    <strong><i class="fa fa-phone mr-1"></i>Jenis SK</strong>
                                    {!! $datadiri->jenissk !!}
                                    <p class="text-muted">Tentang : {!! $datadiri->judulsk !!}</p>
                                @elseif (isset($datadiri->judul))
                                    <strong><i class="fa fa-phone mr-1"></i>{!! $datadiri->kelompok !!}</strong>
                                    <p class="text-muted">Tentang : {!! $datadiri->judul !!}</p>
                                @elseif (isset($datadiri->jenissrt))
                                    <strong><i class="fa fa-phone mr-1"></i>Jenis Surat</strong>
                                    {!! $datadiri->jenissrt !!}
                                    <p class="text-muted">Perihal : {!! $datadiri->perihal !!}</p>
                                @elseif (isset($datadiri->konseptor))
                                    <strong><i class="fa fa-phone mr-1"></i>Jenis Surat</strong>
                                    {!! $datadiri->jenissrt !!}
                                    <p class="text-muted">Kepada : {!! $datadiri->kepada !!}</p>
                                @else
                                    
                                @endif
                            <hr>
                            <strong><i class="fa fa-envelope mr-1"></i> Catatan</strong>
                        </div>
                        <div class="card-body">
                            @if(isset($datadiri->footnote))
                                {!! $datadiri->footnote !!}
                            @elseif (isset($datadiri->catatan))
                                {!! $datadiri->catatan !!}
                            @elseif (isset($datadiri->arsip))
                                {!! $datadiri->arsip !!}
                            @else
                                -
                            @endif
                            @if(isset($datadiri->status) AND $datadiri->status == 'Koreksi')
                                Surat di Kembalikan dengan catatan : <font color="red">{!! $datadiri->ringkasan !!}</font>
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
