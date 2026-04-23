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
                <div class="col-md-12">
                    <div class="card card-solid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <h3 class="d-inline-block d-sm-none">{{ $title }}</h3>
                                    <div class="col-12">
                                        <a href="{{$urlfile}}"><img src="../dist/img/pdf.png" class="product-image" alt="Product Image"></a>
                                    </div>
                                    @if (isset($lampiran) AND $lampiran != '#')
                                    <div class="mt-4">
                                        <div class="btn btn-info btn-lg btn-flat">
                                            <a href="{{$lampiran}}"><i class="fa fa-heart fa-lg mr-2"></i> Lampiran</a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="mt-4">
                                        <div class="btn btn-success btn-lg btn-flat">
                                            <a href="{{$urlfile}}"><i class="fa fa-heart fa-lg mr-2"></i> Download</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-9">
                                    <h3 class="my-3">{{ $title }}</h3>
                                    <p>{!! $keterangan!!} <br /> Nama File : {{ $name }}</p>
                                    <hr>
                                    <h4>Tracking Paraf/TTE</h4>
                                    <div class="timeline">
                                        @if(isset($pengumumans) AND !empty($pengumumans))
                                            @foreach($pengumumans as $pengumuman)
                                                <div class="time-label">
                                                    <span class="bg-{{ $pengumuman['urutanwerno'] }}"> {!! $pengumuman['tanggal'] !!}</span>
                                                </div>
                                                <div>
                                                    <i class="fa fa-pencil bg-{{ $pengumuman['urutanwerno'] }}"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="fa fa-clock"></i> {{ $pengumuman['kapan'] }}</span>
                                                        <h3 class="timeline-header">{!! $pengumuman['siapa'] !!}</h3>
                                                        <div class="timeline-body">
                                                            {!! $pengumuman['pengumuman'] !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if(isset($tandatangan) AND $tandatangan != '')
                                            <div class="time-label">
                                                <span class="bg-success"> Surat Telah di Tandatangani</span>
                                            </div>
                                            <div>
                                                <i class="fa fa-pencil bg-success"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fa fa-clock"></i> {{ $datadiri->updated_at }}</span>
                                                    <h3 class="timeline-header">{!! $datadiri->namapejabat !!}</h3>
                                                    <div class="timeline-body">
                                                        <img src="{!! $tandatangan !!}" />
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
	</div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="fakultas" id="fakultas" value="FIKES">
<input type="hidden" name="fakpanjang" id="fakpanjang" value="Fakultas Ilmu Kesehatan">
@endsection
