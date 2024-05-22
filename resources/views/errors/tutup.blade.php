@extends('base.layout')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
      <h1>
        Layanan di Tutup
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tutup</li>
      </ol>
    </section>
	<section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> <i class="fa fa-warning text-yellow"></i></h2>
        <div class="error-content">
          <h3> Mohon Maaf</h3>
          <p>
            Layanan yang ingin anda akses, sedang kami tutup. Dan akan kami buka kembali, pada jadwal yang telah ditentukan.
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
</div>
<!-- TOKEN -->
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection