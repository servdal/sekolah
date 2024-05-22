@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Pengumuman</h1>
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
                <div class="col-md-6">
                    <div id="status"></div>
				    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Pengumuman</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea id="id_pengumuman" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" id="btnsavepengumuman">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-danger shadow" id="divawal">
                        <div class="card-header">
                            <h3 class="card-title">Pengumuman</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                @if(isset($pengumumans) && !empty($pengumumans))
                                    @foreach($pengumumans as $pengumuman)
                                        <div class="time-label">
                                            <span class="bg-{{ $pengumuman['urutanwerno'] }}"> {!! $pengumuman['tanggal'] !!}</span>
                                        </div>
                                        <div>
                                            <i class="{{ $pengumuman['jenis'] }} bg-{{ $pengumuman['urutanwerno'] }}"></i>
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
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="getnama" id="getnama" value="{{Session('nama')}}">
@endsection
@push('script')
<script>
    $(function () {
        CKEDITOR.env.isCompatible = true;
        CKEDITOR.replace( 'id_pengumuman');
    });
    $(document).ready(function () {
        $('.delpengumuman').on('click', function (){
            var set01	=$(this).attr('id');
            var set02	='pengumuman';
            var token	= document.getElementById('token').value;
            $.post('admin/destroyer', { val01: set01, val02: set02, val03: '', _token: token},
            function(data){		
                var status  = data.status;
                var message = data.message;
                var warna 	= data.warna;
                var icon 	= data.icon;
                $.toast({
                    heading: status,
                    text: message,
                    position: 'top-right',
                    loaderBg: warna,
                    icon: icon,
                    hideAfter: 5000,
                    stack: 1
                });
                window.setTimeout('location.reload()', 3000);
            });	
        });
        $('#btnsavepengumuman').on('click', function (){		
            var nama		= '';
            var pengumuman	= CKEDITOR.instances['id_pengumuman'].getData()
            var token		= document.getElementById('token').value;
            if (pengumuman == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Pengumuman Wajib di Isi',
                    type: 'warning',
                })	
            } else {
                $.post('admin/pengumuman', { val01: nama, val02: pengumuman, _token: token },
                function(data){
                    var status  = data.status;
                    var message = data.message;
                    var warna 	= data.warna;
                    var icon 	= data.icon;
                    $.toast({
                        heading     : status,
                        text        : message,
                        position    : 'top-right',
                        loaderBg    : warna,
                        icon        : icon,
                        hideAfter   : 5000,
                        stack       : 1
                    });
                    window.setTimeout('window.location=window.location', 3000);
                });
            }
        });
    });
</script>
@endpush