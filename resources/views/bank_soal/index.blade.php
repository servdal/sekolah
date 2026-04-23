@extends('adminlte3.layout')

@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bank Soal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Bank Soal</li>
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
                                <img class="img-circle elevation-2"
                                    src="logo.png">
                            </div>
                            <h3 class="widget-user-username">{!! session('sekolah_nama_yayasan') !!}</h3>
                            <h5 class="widget-user-desc">
                                {!! session('sekolah_nama_sekolah') !!} {!! session('sekolah_kota') !!}
                            </h5>
                        </div>

                        <div class="card-body">
                            <div class="mb-3">
                                <a href="{{ route('bank-soal.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Tambah Soal
                                </a>
                            </div>

                            <table class="table table-bordered table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">ID SOAL</th>
                                        <th>Mapel</th>
                                        <th>Kelas</th>
                                        <th>Tipe</th>
                                        <th width="25%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($soals as $s)
                                        <tr>
                                            <td>{{ $s->id }}</td>
                                            <td>{{ $s->mapel }}</td>
                                            <td>{{ $s->kelas }}</td>
                                            <td><span class="badge badge-info">{{ strtoupper($s->tipe) }}</span></td>
                                            <td>
                                                <a href="{{ route('bank-soal.edit',$s) }}" class="btn btn-sm btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="{{ route('bank-soal.preview',$s) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <form method="POST" action="{{ route('bank-soal.destroy',$s) }}"  class="d-inline form-hapus">
                                                    @csrf 
                                                    @method('DELETE')

                                                    <button type="button" class="btn btn-sm btn-danger btn-hapus">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <nav aria-label="Contacts Page Navigation">
                                @if ($soals->lastPage() > 1)
                                    <ul class="pagination justify-content-center m-0">
                                        @if ($soals->currentPage() > 1)
                                            <li class="page-item"><a class="page-link" href="{{ $soals->previousPageUrl() }}">&laquo;</a></li>
                                        @endif
                                        @for ($i = 1; $i <= $soals->lastPage(); $i++)
                                            <li class="page-item {{ ($soals->currentPage() == $i) ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $soals->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        @if ($soals->currentPage() < $soals->lastPage())
                                            <li class="page-item"><a class="page-link" href="{{ $soals->nextPageUrl() }}">&raquo;</a></li>
                                        @endif
                                    </ul>
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@if(session('success'))
    @push('script')
    <script>
        swal({
            title	: 'Berhasil',
            text    : '{{ session('success') }}',
            type	: 'success',
        })
    </script>
    @endpush
@endif
@if(session('error'))
    @push('script')
        <script>
            swal({
                title	: 'Gagal',
                text    : '{{ session('error') }}',
                type	: 'error',
            })
        </script>
    @endpush
@endif

@endsection


@push('script')
<script type="text/javascript">
    document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', function () {

            let form = this.closest('form');
            swal({
                title: 'Apakah anda yakin ?',
                text: "Soal yang dihapus tidak bisa dikembalikan!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-confirm mt-2',
                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                confirmButtonText: 'Ya, hapus!',
            }).then(function () {
                form.submit();
            });
        });
    });
    
</script>
@endpush