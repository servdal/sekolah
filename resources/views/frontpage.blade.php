@extends('adminlte3.layoutstandart')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Welcome Please Select Your Destination</h1>
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
                <div class="col-md-12">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-success">
                            <div class="widget-user-image">
                            	<img class="img-circle elevation-2" src="{{ asset('logo.png') }}" alt="User Avatar">
                            </div>
                            <h3 class="widget-user-username">{{ config('global.Title') }}</h3>
                            <h5 class="widget-user-desc">{{ config('global.Title2') }}</h5>
                        </div>
                    </div>
                    <div class="card card-warning shadow">
						<div class="duidevproduct-list">
							@foreach($data as $row)
								<div class="duidevproduct {{$row['id']}}" onClick="selectasvalue('{{ $row['id'] }}')">
									<div class="duidevproduct_image">
										<img src="{{ asset($row['logo']) }}" /> 
									</div>
									<div class="duidevproduct_title title-white">
										<p>{{$row['nama_sekolah']}}</p>
									</div>
								</div>
							@endforeach
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
<input type="hidden" name="firebaseid" id="firebaseid" value="{{$firebaseid ?? ''}}">
@endsection
@push('script')
<script>
	function selectasvalue(id){
        var firebaseid = document.getElementById('firebaseid').value;
        if (firebaseid == '' || firebaseid == null){
            var url = '{{url('/')}}/frontpage?id='+id;
            window.location.href = url;
        } else {
            var token=document.getElementById('token').value;
            $.post('{{ route("exbukutamu") }}', { val01: firebaseid, val02: 'pengecekanfirebase', val03: id, _token: token },
            function(data){
                window.location.href = data;
            });
        }
    }
</script>
@endpush