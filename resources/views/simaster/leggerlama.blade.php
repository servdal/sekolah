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
                                @if(isset($matpels) && !empty($matpels))
                                    @foreach($matpels as $rows)
                                        <th colspan="4" align="center">{{$rows->matpel}}</th>
                                    @endforeach
                                @endif
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
                                @if(isset($matpels) && !empty($matpels))
                                    @foreach($matpels as $rows)
                                        <td rowspan="2">SAS</td>
                                        <td rowspan="2">SAT</td>
                                        <td rowspan="2">Rata-Rata</td>
                                        <td rowspan="2">Peringkat</td>
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
                                $nomor          = 1;
                                $i              = 0;
                                
                            @endphp
                                @if(isset($datasiswa) && !empty($datasiswa))
                                    @foreach($datasiswa as $rsiswa)
                                        @php 
                                            $allsemester    = Datapresensi::where('tapel', $tapel)->where('id_sekolah', $rsiswa->id_sekolah)->where('noinduk', $rsiswa->noinduk)->get();
                                            $semesterData1  = $allsemester->where('semester', 1);
                                            $totalhari1     = $semesterData1->unique('tanggal')->count();
                                            $cekhadir1      = $semesterData1->where('status', 1)->count();
                                            $semester1ijin  = $semesterData1->where('status', 2)->count();
                                            $semester1sakit = $semesterData1->where('status', 3)->count();
                                            $semester1alpha = $totalhari1 - ($cekhadir1 + $semester1ijin + $semester1sakit);
                                            
                                            $semesterData2  = $allsemester->where('semester', 2);
                                            $totalhari2     = $semesterData2->unique('tanggal')->count();
                                            $cekhadir2      = $semesterData2->where('status', 1)->count();
                                            $semester2ijin  = $semesterData2->where('status', 2)->count();
                                            $semester2sakit = $semesterData2->where('status', 3)->count();
                                            $semester2alpha = $totalhari2 - ($cekhadir2 + $semester2ijin + $semester2sakit);
                                            
                                            $uasonlysmt1    = $tapel.'-1-UAS';
                                            $uasonlysmt2    = $tapel.'-2-UAS';
                                            $semester1ms    = 0;
                                            $semester1mr    = 0;
                                            $semester1hua   = '';
                                            $semester1nua   = '';
                                            $semester2ms    = 0;
                                            $semester2mr    = 0;
                                            $semester2hua   = '';
                                            $semester2nua   = '';
                                            $semester1balsn = 0; //nilai Ujian Lisan Bahasa Arab semester 1
                                            $semester1bilsn = 0; //nilai Ujian Lisan Bahasa Inggris semester 1
                                            $semester1pailsn= 0; //nilai Ujian Lisan PAI semester 1
                                            $semester2balsn = 0; //nilai Ujian Lisan Bahasa Arab semester 2
                                            $semester2bilsn = 0; //nilai Ujian Lisan Bahasa Inggris semester 2
                                            $semester2pailsn= 0; //nilai Ujian Lisan PAI semester 2
                                            $semester1batls = 0; //nilai Ujian Tulis Bahasa Arab semester 1
                                            $semester1bitls = 0; //nilai Ujian Tulis Bahasa Inggris semester 1
                                            $semester1paitls= 0; //nilai Ujian Tulis PAI semester 1
                                            $semester2batls = 0; //nilai Ujian Tulis Bahasa Arab semester 2
                                            $semester2bitls = 0; //nilai Ujian Tulis Bahasa Inggris semester 2
                                            $semester2paitls= 0; //nilai Ujian Tulis PAI semester 2
                                            $matpelsperanak = [];
                                            $anaki          = 0;
                                            $getDataAlquran = MushafUjian::where('id_sekolah', $rsiswa->id_sekolah)->where('noinduk', $rsiswa->noinduk)->where('tapelsemester', 'LIKE', '%UAS')->select('semester', 'tapelsemester', 'hariefektif', 'setoransekolah', 'setoranrumah', 'juz', 'nilaiperjuz', 'halaman', DB::raw('AVG(nilaiperjuz) as rata_rata'))->groupBy('semester')->get();
                                            foreach ($getDataAlquran as $alquran) {
                                                if ($alquran->tapelsemester == $uasonlysmt1) {
                                                    $getDataSemuaJuz = MushafUjian::where('id_sekolah', $rsiswa->id_sekolah)
                                                        ->where('noinduk', $rsiswa->noinduk)
                                                        ->where('tapelsemester', $uasonlysmt1)
                                                        ->select('juz')
                                                        ->groupBy('juz')
                                                        ->pluck('juz')
                                                        ->toArray();
                                                    $juzList        = implode(',', $getDataSemuaJuz);
                                                    $teksjuz 	    = str_replace('Juz ', '', $juzList);
                                                    $teksjuz 	    = 'Juz : '.$teksjuz;
                                                    $semester1ms    = $alquran->setoransekolah ?? 0;
                                                    $semester1mr    = $alquran->setoranrumah ?? 0;
                                                    $semester1hua   = $teksjuz;
                                                    $semester1nua   = $alquran->rata_rata ?? '';
                                                } elseif ($alquran->tapelsemester == $uasonlysmt2) {
                                                     $getDataSemuaJuz = MushafUjian::where('id_sekolah', $rsiswa->id_sekolah)
                                                        ->where('noinduk', $rsiswa->noinduk)
                                                        ->where('tapelsemester', $uasonlysmt2)
                                                        ->select('juz')
                                                        ->groupBy('juz')
                                                        ->pluck('juz')
                                                        ->toArray();
                                                    $juzList        = implode(',', $getDataSemuaJuz);
                                                    $semester2ms    = $alquran->setoransekolah ?? 0;
                                                    $semester2mr    = $alquran->setoranrumah ?? 0;
                                                    $semester2hua   = $juzList;
                                                    $semester2nua   = $alquran->rata_rata ?? '';
                                                }
                                            }
                                            $getdataulisan  = MushafUjianLisan::where('id_sekolah', $rsiswa->id_sekolah)->where('tapel', $tapel)->where('noinduk', $rsiswa->noinduk)->get();
                                            foreach ($getdataulisan as $rowdatalisan) {
                                                $alllugot       = [];
                                                $allibadah      = [];
                                                $allinggris     = [];
                                                for ($i = 1; $i <= 8; $i++) {
                                                    $alllugot[] = $rowdatalisan->{'alllugot' . $i} ?? null;
                                                }
                                                for ($i = 1; $i <= 5; $i++) {
                                                    $allibadah[] = $rowdatalisan->{'allibadah' . $i} ?? null;
                                                }
                                                for ($i = 1; $i <= 7; $i++) {
                                                    $allinggris[] = $rowdatalisan->{'allinggris' . $i} ?? null;
                                                }
                                                $pembagilugot   = count(array_filter($alllugot)); 
                                                $pembagiinggris = count(array_filter($allinggris)); 
                                                $pembagiibadah  = count(array_filter($allibadah));
                                                if ($rowdatalisan->semester == '1') {
                                                    if ($pembagilugot > 0) {
                                                        $semester1balsn = round(array_sum($alllugot) / $pembagilugot, 2);
                                                    }
                                                    if ($pembagiinggris > 0) {
                                                        $semester1bilsn = round(array_sum($allinggris) / $pembagiinggris, 2);
                                                    }
                                                    if ($pembagiibadah > 0) {
                                                        $semester1pailsn = round(array_sum($allibadah) / $pembagiibadah, 2);
                                                    }
                                                } elseif ($rowdatalisan->semester == '2') {
                                                    
                                                    if ($pembagilugot > 0) {
                                                        $semester2balsn = round(array_sum($alllugot) / $pembagilugot, 2);
                                                    }
                                                    if ($pembagiinggris > 0) {
                                                        $semester2bilsn = round(array_sum($allinggris) / $pembagiinggris, 2);
                                                    }
                                                    if ($pembagiibadah > 0) {
                                                        $semester2pailsn = round(array_sum($allibadah) / $pembagiibadah, 2);
                                                    }
                                                }
                                            }
                                           
                                            foreach($matpelsall as $rowsallcari){
                                                $golekakhir1 = DB::table('db_nilai')
                                                                ->whereIn('jennilai', ['pts', 'pat'])
                                                                ->where('noinduk', $rsiswa->noinduk)
                                                                ->where('semester', '1')
                                                                ->where('tapel', $tapel)
                                                                ->where('matpel', $rowsallcari->muatan)
                                                                ->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
                                                                ->groupBy('noinduk')
                                                                ->first();
                                
                                                $golekharian1 = DB::table('db_nilai')
                                                                ->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])
                                                                ->where('noinduk', $rsiswa->noinduk)
                                                                ->where('semester', '1')
                                                                ->where('tapel', $tapel)
                                                                ->where('matpel', $rowsallcari->muatan)
                                                                ->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
                                                                ->groupBy('noinduk')
                                                                ->first();
                            
                                                $golekakhir2 = DB::table('db_nilai')
                                                                ->whereIn('jennilai', ['pts', 'pat'])
                                                                ->where('noinduk', $rsiswa->noinduk)
                                                                ->where('semester', '2')
                                                                ->where('tapel', $tapel)
                                                                ->where('matpel', $rowsallcari->muatan)
                                                                ->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
                                                                ->groupBy('noinduk')
                                                                ->first();
                                
                                                $golekharian2 = DB::table('db_nilai')
                                                                ->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])
                                                                ->where('noinduk', $rsiswa->noinduk)
                                                                ->where('semester', '2')
                                                                ->where('tapel', $tapel)
                                                                ->where('matpel', $rowsallcari->muatan)
                                                                ->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
                                                                ->groupBy('noinduk')
                                                                ->first();
                                                $rataakhir1     = isset($golekakhir1->rata_rata) ? $golekakhir1->rata_rata : 0;
                                                $rataharian1    = isset($golekharian1->rata_rata) ? $golekharian1->rata_rata : 0;
                                                $angka1         = ($rataakhir1 != 0 && $rataharian1 != 0) ? round(((($rataharian1 * 2) + $rataakhir1) / 3), 0) : 0;
                                                $rataakhir2     = isset($golekakhir2->rata_rata) ? $golekakhir2->rata_rata : 0;
                                                $rataharian2    = isset($golekharian2->rata_rata) ? $golekharian2->rata_rata : 0;
                                                $angka2         = ($rataakhir2 != 0 && $rataharian2 != 0) ? round(((($rataharian2 * 2) + $rataakhir2) / 3), 0) : 0;
                                                $matpelsperanak[$anaki] = array(
                                                    'sas'		    => $angka1,
                                                    'sat'			=> $angka2,
                                                    'muatancari'    => $rowsallcari->muatan,
                                                    'tapelcari'		=> $tapel,
                                                );
                                                $anaki++;
                                                if ($rowsallcari->muatan == 'BA'){ $semester1batls = $angka1; $semester2batls = $angka2; }
                                                if ($rowsallcari->muatan == 'BING'){ $semester1bitls = $angka1; $semester2bitls = $angka2; }
                                                if ($rowsallcari->muatan == 'PAIdBP'){ $semester1paitls = $angka1; $semester2paitls = $angka2; }
                                            }
                                            
                                        @endphp
                                    <tr>
                                        <td class="sticky" align="center">{{$nomor}}</td>
                                        <td class="sticky" align="center">{{$rsiswa->noinduk}}</td>
                                        <td class="sticky" align="center">{{$rsiswa->nisn}}</td>
                                        <td class="sticky">{{$rsiswa->nama}}</td>
                                        <td>{{$semester1sakit}}</td>
                                        <td>{{$semester1ijin}}</td>
                                        <td>{{$semester1alpha}}</td>
                                        <td>{{$semester1ms}}</td>
                                        <td>{{$semester1mr}}</td>
                                        <td>{{$semester2sakit}}</td>
                                        <td>{{$semester2ijin}}</td>
                                        <td>{{$semester2alpha}}</td>
                                        <td>{{$semester2ms}}</td>
                                        <td>{{$semester2mr}}</td>
                                        <td>{{$semester1hua}}</td>
                                        <td>{{$semester1nua}}</td>
                                        <td>n/a</td>
                                        <td>{{$semester2hua}}</td>
                                        <td>{{$semester2nua}}</td>
                                        <td>n/a</td>
                                        <td>{{$semester1batls}}</td>
                                        <td>{{$semester1balsn}}</td>
                                        <td>{{$semester2batls}}</td>
                                        <td>{{$semester2balsn}}</td>
                                        <td>
                                            @php
                                                $pembagi = 0;
                                                if ($semester1batls != 0){ $pembagi++; }
                                                if ($semester1balsn != 0){ $pembagi++; }
                                                if ($semester2batls != 0){ $pembagi++; }
                                                if ($semester2balsn != 0){ $pembagi++; }
                                                if ($pembagi != 0){
                                                    $total = round((($semester1batls + $semester1balsn + $semester2batls + $semester2balsn) / $pembagi), 2);
                                                    echo $total;
                                                } else {
                                                    echo 0;
                                                }
                                            @endphp
                                        </td>
                                        <td>n/a</td>
                                        <td>{{$semester1bitls}}</td>
                                        <td>{{$semester1bilsn}}</td>
                                        <td>{{$semester2bitls}}</td>
                                        <td>{{$semester2bilsn}}</td>
                                        <td>
                                            @php
                                                $pembagi = 0;
                                                if ($semester1bitls != 0){ $pembagi++; }
                                                if ($semester1bilsn != 0){ $pembagi++; }
                                                if ($semester2bitls != 0){ $pembagi++; }
                                                if ($semester2bilsn != 0){ $pembagi++; }
                                                if ($pembagi != 0){
                                                    $total = round((($semester1bitls + $semester1bilsn + $semester2bitls + $semester2bilsn) / $pembagi), 2);
                                                    echo $total;
                                                } else {
                                                    echo 0;
                                                }
                                            @endphp
                                        </td>
                                        <td>n/a</td>
                                        <td>{{$semester1paitls}}</td>
                                        <td>{{$semester1pailsn}}</td>
                                        <td>{{$semester2paitls}}</td>
                                        <td>{{$semester2pailsn}}</td>
                                        <td>
                                            @php
                                                $pembagi = 0;
                                                if ($semester1paitls != 0){ $pembagi++; }
                                                if ($semester1pailsn != 0){ $pembagi++; }
                                                if ($semester2paitls != 0){ $pembagi++; }
                                                if ($semester2pailsn != 0){ $pembagi++; }
                                                if ($pembagi != 0){
                                                    $total = round((($semester1paitls + $semester1pailsn + $semester2paitls + $semester2pailsn) / $pembagi), 2);
                                                    echo $total;
                                                } else {
                                                    echo 0;
                                                }
                                            @endphp
                                        </td>
                                        <td>n/a</td>
                                        
                                        @if(isset($matpelsperanak) && !empty($matpelsperanak))
                                            @foreach($matpelsperanak as $rows)
                                                <td>{{$rows->sas ?? 0}}</td>
                                                <td>{{$rows->sat ?? 0}}</td>
                                                <td>
                                                    @php
                                                        $total = ($rows->sas == 0 && $rows->sat == 0) ? 0 : round((($rows->sas + $rows->sat) / 2), 2);
                                                        echo $total;
                                                    @endphp
                                                </td>
                                                <td>n/a</td>
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
                var wb = XLSX.utils.table_to_book(table, { sheet: "{{$tapel}}" });
                XLSX.writeFile(wb, "{{$tapel}}_Kelas{{$setidkelas}}.xlsx");
            } else {
                console.error('Tabel dengan ID "tblkeaktifankelas" tidak ditemukan.');
            }
        });
    });
</script>
@endpush