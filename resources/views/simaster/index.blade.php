@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Welcome {{ Session('nama') }}</h1>
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
                <div class="col-md-5">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-success">
                            <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ url('').'/'.session('sekolah_logo') }}" alt="User Avatar">
                            </div>
                            <h3 class="widget-user-username">{!! session('sekolah_nama_yayasan') !!}</h3>
                            <h5 class="widget-user-desc">{!! session('sekolah_nama_sekolah') !!} {!! session('sekolah_kota') !!}</h5>
                        </div>
                    </div>
                    <div class="card card-warning direct-chat direct-chat-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Lounge</h3>
                            <div class="card-tools">
                                <div id="timeremaining"></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="direct-chat-messages">
                                <div id="chatbody"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="input-group">
                                <input type="text" name="message" id="kirimpsn" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-success" id="sendpesan">Send</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Pengumuman</h3>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-12">
                                <!-- The time line -->
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
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
    <div class="tabel_cetak"></div>		
</div>
<!-- TOKEN -->
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection

@push('script')
<script type="text/javascript">
    function openedpage( jQuery ){
		var token=document.getElementById('token').value;
		$.post('surat/chatgetlist', { _token: token},
		function(data){
			$('#chatbody').html(data);
		});
	}
	window.onload = openedpage;
	setTimeout(function () { 
      openedpage();
    }, 60 * 10000);
    $('#sendpesan').on('click', function (){
		var kirim   = document.getElementById('kirimpsn').value;
		var nama    = '';
		var foto    = '';
		var token   = document.getElementById('token').value;
		$.post('surat/catting', { val01: kirim, val02: nama, val03: foto, _token: token },
		function(data){
			$('#chatbody').html(data);
		});
	});
    var start = new Date();
    CountDownTimer(start, 'timeremaining');
    function CountDownTimer(dt, id)
    {
        var end 	= new Date(dt.getTime() + 10000);
        var _second = 1000;
        var _minute = _second * 60;
        var _hour 	= _minute * 60;
        var _day 	= _hour * 24;
        var timer;
        function showRemaining() {
            var now = new Date();
            var distance = end - now;
            if (distance < 0) {
                clearInterval(timer);
                var start = new Date();
                CountDownTimer(start, 'timeremaining');
                openedpage();
                return;
            }
            var days = Math.floor(distance / _day);
            var hours = Math.floor((distance % _day) / _hour);
            var minutes = Math.floor((distance % _hour) / _minute);
            var seconds = Math.floor((distance % _minute) / _second);
            document.getElementById(id).innerHTML ='Refresh in ';
            document.getElementById(id).innerHTML += seconds + 'secs';
        }
        timer = setInterval(showRemaining, 1000);
    }
    $(document).ready(function () {
        
	});
    
</script>
@endpush