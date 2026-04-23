@php
use App\Datapresensi;
use App\Rapotan;
use App\MushafUjian;
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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Legger Kelas {{$setidkelas}} Tapel {{$tapel}}</h1>
                </div>
                <div class="col-sm-6">
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
                                <th class="sticky" rowspan="3">No</th>
                                <th class="sticky" rowspan="3">NIS</th>
                                <th class="sticky" rowspan="3">NISN</th>
                                <th class="sticky" rowspan="3">Nama</th>
                                <th colspan="5">Semester I</th>
                                <th colspan="5">Semester II</th>
                                <th colspan="6">Al Quran</th>
                                <th colspan="6">Bahasa Arab</th>
                                <th colspan="6">Bahasa Inggris</th>
                                <th colspan="6">PAI</th>
                                
                                @if(isset($matpelnonlisan) && !empty($matpelnonlisan))
                                    @foreach($matpelnonlisan as $rows)
                                        <th colspan="3" align="center">{{$rows['matpel']}}</th>
                                    @endforeach
                                @endif
                                <td rowspan="3">Nilai BA+BING+PAI</td>
                                <td rowspan="3">Nilai Selain Tiga</td>
                                <td rowspan="3">TOTAL</td>
                                <td rowspan="3">Rangking</td>
                            </tr>
                            <tr>
                                <td rowspan="2">Sakit</td>
                                <td rowspan="2">Ijin</td>
                                <td rowspan="2">Alpha</td>
                                <td colspan="2">Setoran</td>
                                <td rowspan="2">Sakit</td>
                                <td rowspan="2">Ijin</td>
                                <td rowspan="2">Alpha</td>
                                <td colspan="2">Setoran</td>
                                <td colspan="3">Semester I</td>
                                <td colspan="3">Semester II</td>
                                <td colspan="2">SAS</td>
                                <td colspan="2">SAT</td>
                                <td rowspan="2">Rata-Rata</td>
                                <td rowspan="2">Peringkat</td>
                                <td colspan="2">SAS</td>
                                <td colspan="2">SAT</td>
                                <td rowspan="2">Rata-Rata</td>
                                <td rowspan="2">Peringkat</td>
                                <td colspan="2">SAS</td>
                                <td colspan="2">SAT</td>
                                <td rowspan="2">Rata-Rata</td>
                                <td rowspan="2">Peringkat</td>
                                @if(isset($matpelnonlisan) && !empty($matpelnonlisan))
                                    @foreach($matpelnonlisan as $rnon)
                                        <td rowspan="2">SAS</td>
                                        <td rowspan="2">SAT</td>
                                        <td rowspan="2">Rata-Rata</td>
                                    @endforeach
                                @endif
                                
                            </tr>
                            <tr>
                                <td>Sekolah</td>
                                <td>Rumah</td>
                                <td>Sekolah</td>
                                <td>Rumah</td>
                                <td>Juz</td>
                                <td>Nilai</td>
                                <td>Peringkat</td>
                                <td>Juz</td>
                                <td>Nilai</td>
                                <td>Peringkat</td>
                                <td>KI 3</td>
                                <td>KI 4</td>
                                <td>KI 3</td>
                                <td>KI 4</td>
                                <td>KI 3</td>
                                <td>KI 4</td>
                                <td>KI 3</td>
                                <td>KI 4</td>
                                <td>KI 3</td>
                                <td>KI 4</td>
                                <td>KI 3</td>
                                <td>KI 4</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @if(isset($dataleggerpart1) && !empty($dataleggerpart1))
                                @php
                                    $keys = array_keys($dataleggerpart1);
                                    for($i = 0; $i < count($dataleggerpart1); $i++) {
                                @endphp
                                    <tr>
                                        <td class="sticky" align="center">{{$nomor}}</td>
                                        <td class="sticky" align="center">{{$dataleggerpart1[$i]['noinduk']}}</td>
                                        <td class="sticky" align="center">{{$dataleggerpart1[$i]['nisn']}}</td>
                                        <td class="sticky">{{$dataleggerpart1[$i]['nama']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester1sakit']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester1ijin']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester1alpha']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester1ms']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester1mr']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester2sakit']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester2ijin']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester2alpha']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester2ms']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester2mr']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester1hua']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester1nua']}}</td>
                                        <td>{{$dataleggerpart1[$i]['rangkingalquran1']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester2hua']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester2nua']}}</td>
                                        <td>{{$dataleggerpart1[$i]['rangkingalquran2']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester1batls']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester1balsn']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester2batls']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester2balsn']}}</td>
                                        <td>{{$dataleggerpart1[$i]['naba']}}</td>
                                        <td>{{$dataleggerpart1[$i]['rangkingba']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester1bitls']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester1bilsn']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester2bitls']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester2bilsn']}}</td>
                                        <td>{{$dataleggerpart1[$i]['nabi']}}</td>
                                        <td>{{$dataleggerpart1[$i]['rangkingbi']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester1paitls']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester1pailsn']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester2paitls']}}</td>
                                        <td>{{$dataleggerpart1[$i]['semester2pailsn']}}</td>
                                        <td>{{$dataleggerpart1[$i]['napai']}}</td>
                                        <td>{{$dataleggerpart1[$i]['rangkingpai']}}</td>
                                    @php
                                        foreach($dataleggerpart2[$keys[$i]] as $key => $value) {
                                    @endphp
                                        <td>{{$value['sas']}}</td>
                                        <td>{{$value['sat']}}</td>
                                        <td>{{$value['total']}}</td>
                                    @php
                                    $nomor++;
                                        }
                                    @endphp
                                        <td>{{$dataleggerpart1[$i]['totalbabingpai']}}</td>
                                        <td>{{$dataleggerpart1[$i]['totallainnya']}}</td>
                                        <td>{{$dataleggerpart1[$i]['totalsemuanilai']}}</td>
                                        <td>
                                            @if($dataleggerpart1[$i]['rangking'] == 1)
                                                <span class="text-success fw-bold">
                                                    <i class="fa fa-trophy"></i> {{$dataleggerpart1[$i]['rangking']}}
                                                </span>
                                            @else 
                                            {{$dataleggerpart1[$i]['rangking']}}
                                            @endif
                                        </td>
                                    </tr>
                                @php
                                }
                                @endphp
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
                var wb = XLSX.utils.table_to_book(table, { sheet: "{{$tapel}}" });
                XLSX.writeFile(wb, "{{$tapel}}_Kelas{{$setidkelas}}.xlsx");
            } else {
                console.error('Tabel dengan ID "tblkeaktifankelas" tidak ditemukan.');
            }
        });
    });
</script>
@endpush