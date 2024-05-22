@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rapot Staf</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Back Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" id="sectionmushaf">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">List Pegawai</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fa fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tempat Tanggal Lahir</th>
                                        <th>Status</th>
                                        <th>Data Finger</th>
                                        <th>Presensi Kelas</th>
                                        <th>Presensi Alquran</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($dataguru) && !empty($dataguru))
                                        @foreach($dataguru as $rows)
                                            <tr>
                                                <td>
                                                    <img src="dist/img/foto/{{ $rows['foto'] }}" alt="{{ $rows['nama'] }}" class="img-circle img-size-32 mr-2">
                                                    {{ $rows['nama'] }}
                                                </td>
                                                <td>{{ $rows['ttl'] }}</td>
                                                <td>
                                                    <small class="text-success mr-1">
                                                        <i class="fa fa-arrow-up"></i>
                                                        {{ $rows['statpeg'] }}
                                                    </small>
                                                    {{ $rows['niy'] }}
                                                </td>
                                                <td>{{ $rows['presensifinger'] }}</td>
                                                <td>{{ $rows['keaktifanpresensi'] }}</td>
                                                <td>{{ $rows['keaktifantahfids'] }}</td>
                                                <td>
                                                    <a href="{{url('/')}}/profilpegawai/{{ $rows['id'] }}" class="text-muted">
                                                        <i class="fa fa-search"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <img src="logo.png" alt="No Pic" class="img-circle img-size-32 mr-2">
                                                No Users Found
                                            </td>
                                            <td>-</td>
                                            <td>
                                                <small class="text-success mr-1">
                                                    <i class="fa fa-arrow-up"></i>
                                                    0
                                                </small>
                                                0
                                            </td>
                                            <td>
                                                <a href="#" class="text-muted">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
        $('.select2').select2({width: '100%'});
        CKEDITOR.env.isCompatible = true;
		$('#presensi_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
    function openedpage( jQuery ){
        
    }
    $(document).ready(function () {
        $('#sectionsetoran').hide();
        
    });
</script>
@endpush