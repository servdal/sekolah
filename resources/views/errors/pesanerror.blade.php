@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                    @if(isset($judulpesan))
                    {{$judulpesan}}
                    @else
                        Laman Belum Siap
                    @endif
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="{{ url('/') }}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="error-page">
        <h2 class="headline text-danger"><i class="fa fa-expeditedssl"></i></h2>
        <div class="error-content">
            <h3><strong>{!! $kalimatheader !!}</strong></h3>
            <p></p>
            {!! $kalimatbody !!}
        </div>
        </div>
        <!-- /.error-page -->

    </section>
</div>
@endsection
