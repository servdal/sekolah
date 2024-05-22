@extends('base.layout')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
      <h1>
        Access Denied
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Access Denied</li>
      </ol>
    </section>
	<section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> STOP</h2>
        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Page requested is denied.</h3>
          <p>
            Mohon maaf, anda tidak di ijinkan untuk melihat halaman ini. Mohon kembali ke halaman sebelumnya.!!!!
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