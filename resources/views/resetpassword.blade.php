<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>{!! config('global.Title') !!}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
		<meta content="Smart and Collaborative UB" name="description" />
        <meta content="Universitas Brawijaya" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('logo-ub.png') }}">
        <!-- App css -->
        @include('base.partials.css')
    </head>
	<body class="hold-transition lockscreen">
	<div class="lockscreen-wrapper">     
		<div class="lockscreen-logo">
			<a href="#"><b>Password </b> Reseter</a>
		</div>
		<div class="lockscreen-name">Masukkan Email</div>
		<div class="lockscreen-item">
		<div class="lockscreen-image">
		  <img src="logo-ub.png" alt="User Image">
		</div>
		<form class="lockscreen-credentials">
		  <div class="input-group">
			<input type="text" class="form-control" placeholder="Email Lengkap dengan @ub.ac.id" id="trackingcode">
			<div class="input-group-btn">
			  <button type="button" class="btn" id="btnviewdata"><i class="fa fa-arrow-right text-muted"></i></button>
			</div>
		  </div>
		</form>
		</div>
		<div class="text-center">
            <p>Password anda akan kami kirimkan melalui email anda, pastikan anda bisa mengaksess email anda untuk mendapatkan password anda</p>
			<a href="#" id="btnkembali"> Back to Dashboard</a>
		</div>
		<div class="lockscreen-footer text-center">
			<div class="pull-right hidden-xs">
			  <b>{!! config('global.swandhananama') !!}</b>
			</div>
			<strong>Copyright &copy; 2019 <a href="http://ub.ac.id">Universitas Brawijaya</a></strong> All rights reserved.
		</footer>
    </div>
	<!-- TOKEN -->
	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	@include('base.partials.js')
	<script>
		$(document).ready(function() {
            $("#btnkembali").click(function(){
				window.location = history.back();
			});
			$("#btnviewdata").click(function(){
				var val01=document.getElementById('trackingcode').value;
				if (val01 == ''){
					swal({
						title: 'Stop',
						text: 'Masukkan NIM Anda',
						type: 'warning',
					})
				} else {
					var token=document.getElementById('token').value;
					$.post('proses_forget', { set01: val01, _token: token },
					function(data){
						swal({
							title	: data.status,
							text	: data.message,
							type	: data.icon,
						})
					});	
				}
			});
		});
	</script>
  </body>
</html>
