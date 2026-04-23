@php
use App\Datanilai;
@endphp
@extends('adminlte3.layouttop')
    <style>
        .table-wrapper {
            max-width: 100%;
            overflow-x: auto;
            border: 1px solid #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
        }

        /* Membekukan kolom pertama, kedua, dan ketiga */
        th, td {
            background-color: #fff; /* Pastikan background konsisten */
        }

        th.sticky, td.sticky {
            position: sticky;
            left: 0;
            background-color: #f0f0f0;
            z-index: 2;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan */
            width: 50px; /* Menetapkan lebar untuk kolom pertama */
        }

        th.sticky-2, td.sticky-2 {
            position: sticky;
            left: 50px; /* Posisi untuk kolom kedua */
            background-color: #f9f9f9;
            z-index: 1;
            width: 100px; /* Menetapkan lebar untuk kolom kedua */
        }

        th.sticky-3, td.sticky-3 {
            position: sticky;
            left: 150px; /* Posisi untuk kolom ketiga */
            background-color: #f9f9f9;
            z-index: 1;
            width: 100px; /* Menetapkan lebar untuk kolom ketiga */
        }
        th.sticky-4, td.sticky-4 {
            position: sticky;
            left: 250px; /* Posisi untuk kolom ketiga */
            background-color: #f9f9f9;
            z-index: 1;
            text-align: left;
            width: 150px; /* Menetapkan lebar untuk kolom ketiga */
        }
    </style>
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-10">
                    <h1> Rekapitulasi Data Nilai Kelas {{$setidkelas}} Semester {{$smt}} Tapel {{$tapel}}</h1>
                </div>
                <div class="col-sm-2">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ $urlkembali }}">Kembali</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Tabel</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" id="btnexport"><i class="fa fa-print"></i></button>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-bordered" id="tblkeaktifankelas">
                        <thead>
                            <tr>
                                <th class="sticky" rowspan="2">No</th>
                                <th class="sticky" rowspan="2">NIS</th>
                                <th class="sticky" rowspan="2">NISN</th>
                                <th class="sticky" rowspan="2">Nama</th>
                                @if(isset($matpels) && !empty($matpels))
                                    @foreach($matpels as $rows)
                                        <td colspan="4">{{$rows->matpel}}</td>
                                    @endforeach
                                @endif
                            </tr>
                            <tr>
                                @if(isset($matpels) && !empty($matpels))
                                    @foreach($matpels as $rows)
                                        <td>NH</td>
                                        <td>NA</td>
                                        <td>(NH+NA)/2</td>
                                        <td>((NHx2)+NA)/3</td>
                                    @endforeach
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $nomor          = 1;
                            @endphp
                            @if(isset($datasiswa) && !empty($datasiswa))
                                @foreach($datasiswa as $rsiswa)
                                    <tr>
                                        <td class="sticky" align="center">{{$nomor}}</td>
                                        <td class="sticky" align="center">{{$rsiswa->noinduk}}</td>
                                        <td class="sticky" align="center">{{$rsiswa->nisn}}</td>
                                        <td class="sticky">{{$rsiswa->nama}}</td>
                                        @if(isset($matpels) && !empty($matpels))
                                            @foreach($matpels as $rows)
                                                @php
                                                    $matpel    = $rows->matpel;
                                                    $golekakhir = Datanilai::whereIn('jennilai', ['pts', 'pat'])
                                                                    ->where('noinduk', $rsiswa->noinduk)
                                                                    ->where('semester', $smt)
                                                                    ->where('tapel', $tapel)
                                                                    ->where('matpel', $matpel)
                                                                    ->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
                                                                    ->groupBy('noinduk')
                                                                    ->first();
                                    
                                                    $golekharian = DB::table('db_nilai')
                                                                    ->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])
                                                                    ->where('noinduk', $rsiswa->noinduk)
                                                                    ->where('semester', $smt)
                                                                    ->where('tapel', $tapel)
                                                                    ->where('matpel', $matpel)
                                                                    ->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
                                                                    ->groupBy('noinduk')
                                                                    ->first();
                                                    $rataakhir 	= isset($golekakhir->rata_rata) ? $golekakhir->rata_rata : 0;
                                                    $rataharian = isset($golekharian->rata_rata) ? $golekharian->rata_rata : 0;
                                                    $total      = $rataakhir + $rataharian;
                                                    $otal2      = $rataakhir + $rataharian + $rataharian;
                                                    if ($total != 0){
                                                        $total  = round(($total / 2), 2);
                                                        $otal2  = round(($otal2 / 3), 2);
                                                    }
                                                    echo '<td>'.round($rataharian, 2).'</td><td>'.round($rataakhir,2).'</td><td>'.$total.'</td><td>'.$otal2.'</td>';
                                                @endphp
                                            @endforeach
                                        @endif
                                    </tr>
                                    @php 
                                        $nomor++;
                                    @endphp
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    Catatan :<br />
                    NH : Rata-Rata Nilai Harian (Penilaian Harian dan Evaluasi Harian)<br />
                    NA : Rata-Rata Nilai PTS, PAS <br />
                </div>
            </div>
		</div>
	</div>
</div>
<div style="overflow: hidden; display: none;">
    <div id="printiki"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<!-- SIGNATURE PAD -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btnexport').addEventListener('click', function() {
            var table = document.getElementById('tblkeaktifankelas');
            if (table) {
                var wb = XLSX.utils.table_to_book(table, { sheet: "summary" });
                XLSX.writeFile(wb, "Kelas{{$setidkelas}}_Semester_{{$smt}}_Tapel{{$tapel}}.xlsx");
            } else {
                console.error('Tabel dengan ID "tblkeaktifankelas" tidak ditemukan.');
            }
        });
    });
</script>
@endpush