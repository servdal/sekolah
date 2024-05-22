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
                <div class="col-md-7">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-success">
                            <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{!! Session('photo') !!}" alt="User Avatar">
                            </div>
                            <h3 class="widget-user-username">{{Session('nama')}}</h3>
                            <h5 class="widget-user-desc">{{Session('jabatan')}}</h5>
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
                                    <button type="button" class="btn btn-success" id="btnkirimpesan">Send</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Apps List</h3>
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
							<div class="row">
								<div class="col-xs-4">
									<div class="btn-group-vertical">
										<a href="{{ url('bukutamuadmin') }}" class="btn btn-app btn-block bg-red">								
											<i class="fa fa-black-tie"></i> Buku Tamu
										</a>
										<a href="{{ url('karyawan') }}" class="btn btn-app btn-block bg-green">
											<i class="fa fa-calculator"></i> SIGAP
										</a>
										<a href="{{ url('bantuanadmin') }}" class="btn btn-app btn-block bg-blue">
											<i class="fa fa-cc-mastercard"></i> Bantuan
										</a>
										<a href="{{ url('lembaga') }}" class="btn btn-app btn-block bg-aqua">
											<i class="fa fa-bank"></i> Unit Kerja
										</a>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="btn-group-vertical">
										<a href="{{ url('sppdadmin') }}" class="btn btn-app btn-block bg-orange">
											<i class="fa fa-street-view "></i> SPD
										</a>
										<a href="{{ url('dashboarddokar') }}" class="btn btn-app btn-block bg-purple">
											<i class="fa fa-users"></i> DIKTENDIK
										</a>
										<a href="{{ url('jadwal') }}" class="btn btn-app btn-block bg-navy">
											<i class="fa fa-building"></i> SI Asset
										</a>
										<a href="{{ url('surat') }}" class="btn btn-app btn-block bg-danger">
											<i class="fa fa-graduation-cap"></i> SI Fakultas
										</a>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="btn-group-vertical">
										<a href="{{ url('ecekadmin') }}" class="btn btn-app btn-block bg-olive">
											<i class="fa fa-newspaper-o"></i> E-Cek
										</a>
										<a href="{{ url('simpukjapengajuan') }}" class="btn btn-app btn-block bg-blue">
											<i class="fa fa-search"></i> SIMPRO-KJA
										</a>
										<a href="{{ url('kategori3') }}" class="btn btn-app btn-block bg-teal">
											<i class="fa fa-gears"></i> SI Unggul
										</a>
										<a href="{{ url('dashboardarsip') }}" class="btn btn-app btn-block bg-green">
											<i class="fa fa-book"></i> Arsip Dinamis
										</a>
									</div>
								</div>
							</div>
                        </div>
                    </div>
					<div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
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
							<div class="form-group">
								<label>Username</label>
								<input type="text" id="id_username" name="id_username" class="form-control">			  
							</div>	
							<div class="form-group">
								<label>Password</label>
								<input type="password" id="id_pass1" name="id_pass1" class="form-control">
							</div>	
							<div class="form-group">
								<label>Repeat Password</label>
								<input type="password" id="id_pass2" name="id_pass2" class="form-control">
							</div>
                        </div>
                        <div class="card-footer">
							<button type="button" class="btn btn-danger" id="btnubahpassword">Change</button>             
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
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="mjenis" id="mjenis" value="Ruang">
<input type="hidden" name="mlokasi" id="mlokasi" value="All">
<input type="hidden" name="mnama" id="mnama" value="All">
<input type="hidden" name="mmulai" id="mmulai" value="now">
<input type="hidden" name="makhir" id="makhir" value="now">
@endsection
@push('script')
<script>
	function openedpage( jQuery ){
		var token=document.getElementById('token').value;
		$.post('surat/chatgetlist', { _token: token},
		function(data){
			$('#chatbody').html(data);
		});
	}
	setTimeout(function () { 
      openedpage();
    }, 60 * 50000);
$(document).ready(function () {
	openedpage();
	$('#btnkirimpesan').on('click', function (){		
		var kirim=document.getElementById('kirimpsn').value;
		var nama='';
		var foto='';
		var token=document.getElementById('token').value;
		$.post('surat/catting', { val01: kirim, val02: nama, val03: foto, _token: token },
		function(data){
			$('#chatbody').html(data);
		});
	}); 
	$("#btnubahpassword").click(function(){
		var id 			= 	document.getElementById('id_username').value;
		var password1 	= 	document.getElementById('id_pass1').value;	
		var password2 	= 	document.getElementById('id_pass2').value;
		var token 		= 	document.getElementById('token').value;
		$.post('user/updatepass', { val01: id, val02: password1, val03: password2, _token: token },
		function(data){			
			var status  = data.status;
			var message = data.message;
			$.toast({
				heading: status,
				text: message,
				position: 'top-right',
				loaderBg: '#bf441d',
				icon: 'info',
				hideAfter: 5000,
				stack: 1
			});
			return false;
		});	
	});
	
});
</script>
@endpush