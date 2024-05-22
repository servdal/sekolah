@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Session Expired</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Session Expired</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="error-page">
        <h2 class="headline text-danger">T_T</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-danger"></i> Batas Sesi Berakhir.</h3>

            <p>
            Batas 5 Menit Iddle Time Telah Terlampaui, Silahkan anda Relogin Kembali
            <br /> <a href="{{ url('/') }}">return to dashboard</a>
            </p>
        <!-- /.input-group 
            <form class="search-form">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search">

                <div class="input-group-append">
                <button type="submit" name="submit" class="btn btn-danger"><i class="fas fa-search"></i>
                </button>
                </div>
            </div>
            </form>
            -->
        
        </div>
        </div>
        <!-- /.error-page -->

    </section>
</div>
@endsection
