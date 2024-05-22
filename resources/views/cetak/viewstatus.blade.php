@extends('adminlte3.layoutstandart')
@section('content')
<div class="wrapper">
	<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tracking Pembayaran <small>Zakat Fitrah, Zakat Maal, Donasi</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Back Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-success">
                            <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ url('').'/'.session('sekolah_logo') }}" alt="User Avatar">
                            </div>
                            <h3 class="widget-user-username">{!! session('sekolah_nama_yayasan') !!}</h3>
                            <h5 class="widget-user-desc">{!! session('sekolah_nama_sekolah') !!} {!! session('sekolah_kota') !!}</h5>
                        </div>
                    </div>
					<div class="card card-info shadow">
						<div class="card-footer">		
                        	<table width="800" border="0" cellpadding="0" cellspacing="0" class="table table-stripped" style='background: url("{{ $logo_grey }}") no-repeat; background-position:center;'>
								{!! $kopsurat !!}
								<tr>
									<td width="113" style="border-bottom:double">&nbsp;</td>
									<td width="114" style="border-bottom:double">&nbsp;</td>
									<td width="74" style="border-bottom:double">&nbsp;</td>
									<td width="15" style="border-bottom:double">&nbsp;</td>
									<td width="69" style="border-bottom:double">&nbsp;</td>
									<td width="31" style="border-bottom:double">&nbsp;</td>
									<td width="51" style="border-bottom:double">&nbsp;</td>
									<td width="165" style="border-bottom:double">&nbsp;</td>
								</tr>
								<tr height="20">
									<td colspan="3"><span class="isi">Nama Siswa</span></td>
									<td colspan="6" style="border-bottom:dotted"><span class="isi">: {{$nama}}</span></td>
									<td><span class="isi">Kelas</span></td>
									<td style="border-bottom:dotted"><span class="isi">: {{$kelas}}</span></td>
								</tr>
								<tr height="20">
									<td colspan="3"><span class="isi">Nama Orang Tua/Wali</span></td>
									<td colspan="8" style="border-bottom:dotted"><span class="isi">: {{$namawali}}</span></td>
								</tr>
								<tr height="20">
									<td width="40"><span class="isi">1.</span></td>
									<td colspan="6" align="left"><span class="isi">Zakat Fitrah ( {{$jeniszakat}} ) Untuk {{$orang}} Orang @ {{ $satuan }}</span></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>Rp</td>
									<td style="border-bottom:dotted" align="right">{{$nominal}}</td>
								</tr>
								<tr height="20">
									<td>2.</td>
									<td colspan="8">Zakat Maal</td>
									<td>Rp.</td>
									<td style="border-bottom:dotted" align="right">{{$zakatmaal}}</td>
								</tr>
								<tr height="20">
									<td>3. </td>
									<td colspan="8">Donasi</td>
									<td>Rp.</td>
									<td style="border-bottom:dotted" align="right">{{$donasi}}</td>
								</tr>
								<tr height="20">
									<td>&nbsp;</td>
									<td colspan="8">&nbsp;</td>
									<td>&nbsp;</td>
									<td style="border-bottom:dotted" align="right">&nbsp;</td>
								</tr>
								<tr height="20">
									<td>&nbsp;</td>
									<td colspan="8">&nbsp;</td>
									<td>&nbsp;</td>
									<td style="border-bottom:dotted" align="right">&nbsp;</td>
								</tr>
								<tr height="20">
									<td>&nbsp;</td>
									<td colspan="8">Total</td>
									<td>Rp.</td>
									<td style="border-bottom:dotted" align="right">{{$total}}</td>
								</tr>
								<tr height="20">
									<td>&nbsp;</td>
									<td colspan="8">{!!$status!!}</td>
									<td>&nbsp;</td>
									<td align="right">&nbsp;</td>
								</tr>
							</table>
						</div>
                    </div>
				</div>
			</div>
		</div>
	</section> <!-- end container -->
</div>
<!-- TOKEN -->
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection