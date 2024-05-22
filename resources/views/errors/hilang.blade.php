@extends('base.layout')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
      <h1>
        Data Tidak di Temukan
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>
	<section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> T_T</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Data not found.</h3>

          <p>
			Data yang ingin anda akses, kemungkinan telah dihapus atau url anda salah. Periksa kembali URL yang anda akses, atau hubungi tim TI untuk merestore data anda. <br />
            Sementara anda bisa <a href="{{ url('/') }}">Kembali ke halaman muka</a> 
          </p>

        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
</div>

@endsection