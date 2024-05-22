@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>404 Error Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">404 Error Page</li>
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
            <h3><i class="fa fa-exclamation-triangle text-danger"></i> Oops! Something went wrong.</h3>

            We could not find the page you were looking for. <br /><a href="{{url()->current()}}">{{url()->current()}}</a><br />
            Meanwhile, you may <a href="{{ url('/') }}">return to dashboard</a> or try using the search form.
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
