@extends('base.layout')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
      <h1>
        Main Site Not Define
        <small>Page Not Found</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>
	<section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> >,<</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Mohon Maaf</h3>

          <p>
            Halaman ini telah kami reset. Silahkan kembali ke Halaman Utama dengan Click <a href="{{ url('/') }}">TOMBOL INI</a>.
          </p>
			
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
</div>

@endsection