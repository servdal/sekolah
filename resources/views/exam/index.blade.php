@extends('adminlte3.layout')
@section('content')

<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manajemen Ujian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Ujian</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-widget widget-user-2">
                <div class="widget-user-header bg-primary">
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" 
                            src="{{ url('').'/'.session('sekolah_logo') }}">
                    </div>
                    <h3 class="widget-user-username">Manajemen Ujian</h3>
                    <h5 class="widget-user-desc">Kelola ujian berbasis ANBK</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('exam.create') }}" class="btn btn-success mb-3">
                        <i class="fa fa-plus"></i> Buat Ujian
                    </a>
                    <table class="table table-bordered table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Passcode</th>
                                <th>Nama Ujian</th>
                                <th>Mapel</th>
                                <th>Durasi</th>
                                <th>Mulai</th>
                                <th>Status</th>
                                <th width="220">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($exams as $e)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge badge-secondary">{{ $e->kode_ujian }}</span></td>
                                <td><span class="badge badge-danger">{{ $e->exam_password }}</span></td>
                                <td>{{ $e->nama_ujian }}</td>
                                <td>{{ $e->mapel }}</td>
                                <td>{{ $e->durasi_menit }} menit</td>
                                <td>{{ \Carbon\Carbon::parse($e->tanggal_mulai)->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($e->status=='draft')
                                        <span class="badge badge-warning">Draft</span>
                                    @elseif($e->status=='aktif')
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('exam.edit',$e->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('exam.preview', $e->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('exam.result.index', $e->id) }}" 
                                        class="btn btn-sm btn-success" 
                                        title="Lihat Hasil & Koreksi">
                                        <i class="fas fa-chart-bar"></i> Hasil
                                    </a>
                                    <form action="{{ route('exam.destroy', $e->id) }}" method="POST" class="d-inline form-hapus">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger btn-hapus" title="Hapus Ujian">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    Belum ada ujian dibuat
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('script')
<script>
    $('.btn-hapus').click(function(e){
        e.preventDefault();
        var form = $(this).closest('form');
        
        swal({
            title: "Yakin hapus ujian?",
            text: "Data soal & nilai siswa terkait akan ikut terhapus!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
    @if(session('success'))
        swal("Berhasil!", "{{ session('success') }}", "success");
    @endif
</script>
@endpush