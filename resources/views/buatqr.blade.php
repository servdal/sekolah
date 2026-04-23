@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <h1>
            QrCode Generator
        </h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-success">
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="logo.png">
                            </div>
                            <h3 class="widget-user-username">{!! session('sekolah_nama_yayasan') !!}</h3>
                            <h5 class="widget-user-desc">
                                {!! session('sekolah_nama_sekolah') !!} {!! session('sekolah_kota') !!}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="time-label">
                                    <span class="bg-red">Note</span>
                                </div>
                                <div>
                                    <i class="fa fa-envelope bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock"></i> 12:05</span>
                                        <h3 class="timeline-header"><a href="#">Support Team</a> </h3>
                                        <div class="timeline-body">
                                            Laman Ini Berfungsi untuk membuat QrCode dengan Beragam Keperluan
                                        </div>
                                    </div>
                                </div>
                                @if(isset($pengumumans) && !empty($pengumumans))
                                    @foreach($pengumumans as $pengumuman)
                                    <div class="time-label">
                                        <span class="bg-red">{!! $pengumuman['jenis'] !!}</span>
                                    </div>
                                    <div>
                                        @if ($pengumuman['jenis'] == 'Shortlink')
                                            <i class="fa fa-link bg-red"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock"></i> {{ $pengumuman['created_at'] }}</span>
                                                <h3 class="timeline-header"><a href="{{url('/s/')}}/{!! $pengumuman['val01'] !!}">{{url('/s/')}}/{!! $pengumuman['val01'] !!}</a> </h3>
                                                <div class="timeline-body">
                                                    Dialihkan ke :
                                                    {!! $pengumuman['val02'] !!}
                                                </div>
                                            </div>
                                        @else
                                            <i class="fa fa-qrcode bg-blue"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock"></i> {{ $pengumuman['created_at'] }}</span>
                                                <h3 class="timeline-header"><a href="#">{!! $pengumuman['val01'] !!}</a> </h3>
                                                <div class="timeline-body">
                                                <img src="data:image/png;base64, {!! $pengumuman['base64qrcode'] !!} ">
                                                </div>
                                            </div>
                                        @endif
                                        
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-header with-border">
                            <h3 class="card-title">Pilih Jenis Qr Code</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <div id="accordion">
                                    <div class="card card-primary">
                                        <div class="card-header with-border">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                    Qr Code Alamat Web 
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="id_nilai01">Masukkan Alamat Web Lengkap</label>
                                                    <input class="form-control" type="text" name="id_nilai01" id="id_nilai01" />
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success pull-left" id="btngenerate1">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-danger">
                                        <div class="card-header with-border">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                    QrCode Email
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="id_nilai02">Masukkan Alamat Email</label>
                                                    <input class="form-control" type="email" name="id_nilai02" id="id_nilai02" />
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success pull-left" id="btngenerate2">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-success">
                                        <div class="card-header with-border">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                    Qr Code Phone Number
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="id_nilai03">Masukkan No. Telpon</label>
                                                    <input class="form-control" type="tel" name="id_nilai03" id="id_nilai03" />
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success pull-left" id="btngenerate3">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-info">
                                        <div class="card-header with-border">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                                    Qr Code Lokasi Anda
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseFour" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="id_nilai04">Masukkan Titik Melintang (latitude)</label>
                                                    <input class="form-control" type="text" name="id_nilai04" id="id_nilai04" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_nilai05">Masukkan Titik Membujur (longitude)</label>
                                                    <input class="form-control" type="text" name="id_nilai05" id="id_nilai05" />
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success pull-left" id="btngenerate4">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-warning">
                                        <div class="card-header with-border">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                                    Qr Code Kartu Nama 
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseFive" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="id_nilai06">Nama Lengkap</label>
                                                    <input class="form-control" type="text" name="id_nilai06" id="id_nilai06" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_nilai07">Alamat</label>
                                                    <input class="form-control" type="text" name="id_nilai07" id="id_nilai07" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_nilai08">Email</label>
                                                    <input class="form-control" type="text" name="id_nilai08" id="id_nilai08" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_nilai09">No. HP / Telpon</label>
                                                    <input class="form-control" type="text" name="id_nilai09" id="id_nilai09" />
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success pull-left" id="btngenerate5">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-primary">
                                        <div class="card-header with-border">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                                                Qr Code WIFI Login
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseSix" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="id_nilai10">SSID</label>
                                                    <input class="form-control" type="text" name="id_nilai10" id="id_nilai10" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_nilai11">Password</label>
                                                    <input class="form-control" type="text" name="id_nilai11" id="id_nilai11" />
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-success pull-left" id="btngenerate6">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-danger">
                        <div class="card-header with-border">
                            <h3 class="card-title">ShortLink Generator</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="slug">Nama Singkat</label>
                                    <input class="form-control" type="text" name="slug" id="slug" />
                                </div>
                                <div class="form-group">
                                    <label for="destination_url">Tujuan</label>
                                    <input class="form-control" type="text" name="destination_url" id="destination_url" />
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success pull-left" id="btngenerateshortlink">Generate</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

    <input class="form-control" type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<!-- Page script -->
<script type="text/javascript">
$(document).ready(function () {
	var token=document.getElementById('token').value;
	$("#btngenerate1").click(function(){
		var set01 	    = document.getElementById('id_nilai01').value;
		var set05	    = 'Website';
		var form_data   = new FormData();
            form_data.append('val01', set01);
			form_data.append('val02', '');
			form_data.append('val03', '');
			form_data.append('val04', '');
			form_data.append('val05', set05);
            form_data.append('_token', '{{csrf_token()}}');
		$.ajax({
            url: '{{ route("exCreateQR") }}',
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
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
                setTimeout(function () {
                    location.reload();
                }, 5000);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
	});
    $("#btngenerate2").click(function(){
		var set01 	    = document.getElementById('id_nilai02').value;
		var set05	    = 'Email';
		var form_data   = new FormData();
            form_data.append('val01', set01);
			form_data.append('val02', '');
			form_data.append('val03', '');
			form_data.append('val04', '');
			form_data.append('val05', set05);
            form_data.append('_token', '{{csrf_token()}}');
		$.ajax({
            url: '{{ route("exCreateQR") }}',
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
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
                setTimeout(function () {
                    location.reload();
                }, 5000);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
	});
    $("#btngenerate3").click(function(){
		var set01 	    = document.getElementById('id_nilai03').value;
		var set05	    = 'Telpon';
		var form_data   = new FormData();
            form_data.append('val01', set01);
			form_data.append('val02', '');
			form_data.append('val03', '');
			form_data.append('val04', '');
			form_data.append('val05', set05);
            form_data.append('_token', '{{csrf_token()}}');
		$.ajax({
            url: '{{ route("exCreateQR") }}',
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
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
                setTimeout(function () {
                    location.reload();
                }, 5000);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
	});
    $("#btngenerate4").click(function(){
		var set01 	    = document.getElementById('id_nilai04').value;
		var set02	    = document.getElementById('id_nilai05').value;
		var set05	    = 'Geolocation';
		var form_data   = new FormData();
            form_data.append('val01', set01);
			form_data.append('val02', set02);
			form_data.append('val03', '');
			form_data.append('val04', '');
			form_data.append('val05', set05);
            form_data.append('_token', '{{csrf_token()}}');
		$.ajax({
            url: '{{ route("exCreateQR") }}',
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
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
                setTimeout(function () {
                    location.reload();
                }, 5000);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
	});
	$("#btngenerate5").click(function(){
		var set01 	    = document.getElementById('id_nilai06').value;
		var set02	    = document.getElementById('id_nilai07').value;
		var set03	    = document.getElementById('id_nilai08').value;
		var set04	    = document.getElementById('id_nilai09').value;
		var set05	    = 'VCard';
		var form_data   = new FormData();
            form_data.append('val01', set01);
			form_data.append('val02', set02);
			form_data.append('val03', set03);
			form_data.append('val04', set04);
			form_data.append('val05', set05);
            form_data.append('_token', '{{csrf_token()}}');
		$.ajax({
            url: '{{ route("exCreateQR") }}',
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
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
                setTimeout(function () {
                    location.reload();
                }, 5000);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
	});
    $("#btngenerate6").click(function(){
		var set01 	    = document.getElementById('id_nilai10').value;
		var set02	    = document.getElementById('id_nilai11').value;
		var set05	    = 'Wifi';
		var form_data   = new FormData();
            form_data.append('val01', set01);
			form_data.append('val02', set02);
			form_data.append('val03', '');
			form_data.append('val04', '');
			form_data.append('val05', set05);
            form_data.append('_token', '{{csrf_token()}}');
		$.ajax({
            url: '{{ route("exCreateQR") }}',
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
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
                setTimeout(function () {
                    location.reload();
                }, 5000);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
	});
	$("#btngenerateshortlink").click(function(){
		var set01 	    = document.getElementById('slug').value;
		var set02 	    = document.getElementById('destination_url').value;
		var set05	    = 'Shortlink';
		var form_data   = new FormData();
            form_data.append('val01', set01);
			form_data.append('val02', set02);
			form_data.append('val03', '');
			form_data.append('val04', '');
			form_data.append('val05', set05);
            form_data.append('_token', '{{csrf_token()}}');
		$.ajax({
            url: '{{ route("exCreateQR") }}',
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
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
                setTimeout(function () {
                    location.reload();
                }, 5000);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
	});
});
</script>
@endpush
