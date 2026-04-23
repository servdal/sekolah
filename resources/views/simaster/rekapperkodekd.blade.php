@php
use App\Datapresensi;
use App\Rapotan;
use App\Datanilai;
use App\MushafUjianLisan;
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
                    <h1> Rekapitulasi Data {{$muatan}} Kelas {{$setidkelas}} Semester {{$smt}} Tapel {{$tapel}}</h1>
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
                                @if(isset($kodekds) && !empty($kodekds))
                                    @foreach($kodekds as $rows)
                                        <td colspan="{{$koloms}}">{{$rows->kodekd}}</td>
                                    @endforeach
                                @endif
                            </tr>
                            <tr>
                                @if(isset($kodekds) && !empty($kodekds))
                                    @foreach($kodekds as $rows)
                                        @if(isset($jennilai) && !empty($jennilai))
                                            @foreach($jennilai as $rjenis)
                                                <td>{{$rjenis->jennilai}}</td>
                                            @endforeach
                                        @endif
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
                                        @if(isset($kodekds) && !empty($kodekds))
                                            @foreach($kodekds as $rows)
                                                @php
                                                    $kodekd = $rows->kodekd;
                                                @endphp
                                                @if(isset($jennilai) && !empty($jennilai))
                                                    @foreach($jennilai as $rjenis)
                                                        @php
                                                            $jennilaicari   = $rjenis->jennilai;
                                                            $getnilai 	    = Datanilai::where('noinduk', $rsiswa->noinduk)->where('semester', $smt)->where('tapel', $tapel)->where('id_sekolah', session('sekolah_id_sekolah'))->where('matpel', $muatan)->where('kodekd', $kodekd)->where('jennilai', $jennilaicari)->select('nilai')->first();
                                                            $nilai          = $getnilai->nilai ?? '';
                                                            echo '<td>'.$nilai.'</td>';
                                                        @endphp
                                                    @endforeach
                                                @endif
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
                var wb = XLSX.utils.table_to_book(table, { sheet: "{{$muatan}}" });
                XLSX.writeFile(wb, "{{$muatan}}_Kelas{{$setidkelas}}_Semester_{{$smt}}_Tapel{{$tapel}}.xlsx");
            } else {
                console.error('Tabel dengan ID "tblkeaktifankelas" tidak ditemukan.');
            }
        });
    });
</script>
@endpush