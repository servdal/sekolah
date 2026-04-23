@extends('adminlte3.layout')

@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hasil & Koreksi Ujian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('exam.index') }}">Ujian</a></li>
                        <li class="breadcrumb-item active">Rekap Nilai</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            
            <div class="callout callout-info">
                <h5>{{ $exam->nama_ujian }}</h5>
                <p>
                    Mapel: <b>{{ $exam->mapel }}</b> |
                    KKM/Passing Grade: <b>75.00</b> |
                    Total Peserta: <b>{{ count($participants) }}</b>
                </p>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Daftar Peserta</h3>
                    <div class="card-tools">
                        {{-- Tombol Export Excel bisa ditaruh disini --}}
                        <button class="btn btn-tool" title="Download Excel"><i class="fa fa-file-excel text-success"></i> Export</button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table-rekap" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Peserta</th>
                                <th>Kelas</th>
                                <th>Status Ujian</th>
                                <th>Nilai Akhir</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($participants as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $p->nama }}</strong><br>
                                    <small class="text-muted">{{ $p->noinduk }}</small>
                                </td>
                                <td>{{ $p->kelas }}</td>
                                <td>
                                    @if($p->status == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                        <br><small>{{ \Carbon\Carbon::parse($p->selesai_pada)->format('d M H:i') }}</small>
                                    @elseif($p->status == 'mengerjakan')
                                        <span class="badge badge-warning">Sedang Mengerjakan</span>
                                    @else
                                        <span class="badge badge-secondary">Belum Mulai</span>
                                    @endif
                                </td>
                                
                                {{-- Kolom Nilai --}}
                                <td class="font-weight-bold" style="font-size: 1.1em">
                                    @if(!is_null($p->total_nilai))
                                        {{ number_format($p->total_nilai, 2) }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                {{-- Tombol Aksi --}}
                                <td class="text-center">
                                    @if($p->status == 'selesai')
                                        <a href="{{ route('exam.grading', ['exam_id' => $exam->id, 'student_id' => $p->student_id]) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i> Koreksi / Detail
                                        </a>
                                    @elseif($p->status == 'mengerjakan')
                                        <button class="btn btn-sm btn-warning" disabled><i class="fa fa-clock"></i> Sedang Ujian</button>
                                    @else
                                        <button class="btn btn-sm btn-secondary" disabled>Belum Hadir</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada peserta yang terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@push('script')
<script>
    $(document).ready(function() {
        $('#table-rekap').DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#table-rekap_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush

@endsection