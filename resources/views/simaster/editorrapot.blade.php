@php
use App\Datapresensi;
use App\Rapotan;
use App\Datanilai;
use App\Datakd;
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
                    <h1 class="m-0"> Editor Rapot an. {{$datarapot->nama}} Tapel {{$datarapot->tapel}} Semester {{$datarapot->semester}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#" onclick="history.back()">Kembali</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i>Biodata</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btnsimpanall"><i class="fa fa-save"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                        @php
                            $nomor                  = 1;
                            $bulanlist 				= array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");

                            $arrtanggal				= explode(' ', $datarapot->updated_at);
                            $tanggal				= $arrtanggal[0];
                            $totalsum 				= 0;
                            $pembagisum 			= 0;
                            $ttdortu				= '[ttdortu]';
                            $ttdkasek				= '[ttdks]';
                            $tabelatas				= '';
                            $nomor 					= 1;
                            $headermulok 			= '';
                            $rowswajib				= [];
                            $rowsmulok 				= [];
                            $semester				= $datarapot->semester;
                            $semestercari 			= mb_substr($semester, 0, 1);
                        @endphp
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="rapot_nama">Nama</label>
                                        <input type="text" class="form-control" id="rapot_nama" name="nama" value="{{$datarapot->nama}}">
                                    </div> 
                                    <div class="col-lg-1">
                                        <label for="rapot_kelas">Kelas</label>
                                        <input type="text" class="form-control" id="rapot_kelas" name="kelas" value="{{$datarapot->kelas}}">
                                        <input type="hidden" class="form-control" id="rapot_noinduk" name="noinduk" value="{{$datarapot->noinduk}}">
                                        <input type="hidden" class="form-control" id="rapot_nisn" name="nisn" value="{{$datarapot->nisn}}">
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="rapot_sakit">Sakit</label>
                                        <input type="text" class="form-control" id="rapot_sakit" name="sakit" value="{{$datarapot->sakit}}">
                                    </div> 
                                    <div class="col-lg-1">
                                        <label for="rapot_ijin">Ijin</label>
                                        <input type="text" class="form-control" id="rapot_ijin" name="ijin" value="{{$datarapot->ijin}}">
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="rapot_alpha">Alpha</label>
                                        <input type="text" class="form-control" id="rapot_alpha" name="alpha" value="{{$datarapot->alpha}}">
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="rapot_fase">Fase</label>
                                        <input type="text" class="form-control" id="rapot_fase" name="fase" value="{{$datarapot->fase}}">
                                    </div>
                                    <div class="col-lg-1">
                                        <label for="rapot_tanggal">Tanggal Rapot</label>
                                        <input type="text" class="form-control" id="rapot_tanggal" name="tanggal" value="{{$tanggal}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="rapot_keputusan">Keterangan Naik Kelas</label>
                                        <input type="text" class="form-control" id="rapot_keputusan" name="keputusan" value="{{$datarapot->keputusan}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="rapot_naik">Naik Ke Kelas</label>
                                        <input type="text" class="form-control" id="rapot_naik" name="naik" value="{{$datarapot->naik}}">
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card card-success shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> Nilai</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btnsimpanall"><i class="fa fa-save"></i></button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran</th>
                                        <th>KKM</th>
                                        <th>Afektif</th>
                                        <th>Nilai</th>
                                        <th>KD Terendah</th>
                                        <th>KD Tertinggi</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                            @php
                           
                            for ($index = 1; $index <= 30; $index++) {
                                $kode 			= 'k'.sprintf("% 02s", $index);
                                $field_huruf 	= 'h'.sprintf("% 02s", $index);
                                $field_nilai 	= 'n'.sprintf("% 02s", $index);
                                $matpel 		= $datarapot->$field_huruf;
                                $kkm 			= $datarapot->$field_nilai;
                                $afektif		= '';
                                $angka			= 0;
                                $terbilang		= '';
                                $deskripsi		= '';
                                $cekmatpel 		= explode('; ', $matpel);
                                if (isset($cekmatpel[1])){
                                    $jenis 		= $cekmatpel[0];
                                    $matpel		= $cekmatpel[1];
                                } else {
                                    $jenis 		= 'Wajib';
                                }
                                if ($datarapot->$kode !== '' && $datarapot->$kode !== null) {
                                    $datacari 	= $datarapot->$kode;
                                    $cekjenis 	= explode('[pisah]', $datacari);
                                    if (isset($cekjenis[1])) {
                                        $afektif 	= $cekjenis[0];
                                        $muatan 	= $cekjenis[1];
                                        $golekakhir = DB::table('db_nilai')
                                                        ->whereIn('jennilai', ['pts', 'pat'])
                                                        ->where('noinduk', $datarapot->noinduk)
                                                        ->where('semester', $semestercari)
                                                        ->where('tapel', $datarapot->tapel)
                                                        ->where('matpel', $muatan)
                                                        ->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
                                                        ->groupBy('noinduk')
                                                        ->first();
                        
                                        $golekharian= DB::table('db_nilai')
                                                        ->whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])
                                                        ->where('noinduk', $datarapot->noinduk)
                                                        ->where('semester', $semestercari)
                                                        ->where('tapel', $datarapot->tapel)
                                                        ->where('matpel', $muatan)
                                                        ->select('noinduk', DB::raw('AVG(nilai) as rata_rata'))
                                                        ->groupBy('noinduk')
                                                        ->first();
                        
                                        $rataakhir 	= isset($golekakhir->rata_rata) ? $golekakhir->rata_rata : 0;
                                        $rataharian = isset($golekharian->rata_rata) ? $golekharian->rata_rata : 0;
                                        $angka 		= ($rataakhir != 0 && $rataharian != 0) ? round(((($rataharian * 2) + $rataakhir) / 3), 0) : 0;
                                        $totalsum	= $totalsum + $angka;
                                        $pembagisum++;
                                        if ($angka == 0){
                                            $terbilang = 'Nol';
                                        } else {
                                            $idterbesar 		= 0;
                                            $golekterterbesar	= Datanilai::whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])
                                                                    ->where('noinduk', $datarapot->noinduk)
                                                                    ->where('semester', $semestercari)
                                                                    ->where('tapel', $datarapot->tapel)
                                                                    ->where('matpel', $muatan)
                                                                    ->orderBY('nilai', 'DESC')
                                                                    ->first();
                                            $nilaiterbesar 	= $golekterterbesar->nilai ?? '';
                                            $kdterbesar 	= $golekterterbesar->kodekd ?? '';
                                            if (isset($golekterterbesar->nilai)){
                                                $idterbesar 	= $golekterterbesar->id;
                                                $cekdata 		= Datakd::where('muatan', $golekterterbesar->matpel)->where('tema', $golekterterbesar->kodekd)->where('kelas', $golekterterbesar->kelas)->first();
                                                $range01 		= $cekdata->template01 ?? 'Ananda menunjukkan penguasaan yang baik dalam ';
                                                $range02 		= $cekdata->template02 ?? 'Ananda menunjukkan penguasaan yang baik dalam ';
                                                $range03 		= $cekdata->template03 ?? 'Ananda menunjukkan penguasaan yang baik dalam ';
                                                $range04 		= $cekdata->template04 ?? 'Ananda menunjukkan penguasaan yang baik dalam ';
                                                $range05 		= $cekdata->template05 ?? 'Ananda menunjukkan penguasaan yang baik dalam ';
                                                $teks 			= '';
                                                if ($nilaiterbesar <= 74) {
                                                    $teks = $range01;
                                                } else if (74 < $nilaiterbesar && $nilaiterbesar <= 77) {
                                                    $teks = $range02;
                                                } else if (77 < $nilaiterbesar && $nilaiterbesar <= 85) {
                                                    $teks = $range03;
                                                } else if (85 < $nilaiterbesar && $nilaiterbesar <= 92) {
                                                    $teks = $range04;
                                                } else {
                                                    $teks = $range05;
                                                }
                                                if ($muatan == 'BA'){
                                                    $deskripsi		= $deskripsi.$teks.$golekterterbesar->kodekd;
                                                } else {
                                                    $deskripsi		= $deskripsi.$teks.$golekterterbesar->deskripsi;
                                                }
                                            }
                                            $golekterkecil		= Datanilai::whereIn('jennilai', ['p01', 'p02', 'p03', 'p04', 'p05', 'e01', 'e02', 'e03', 'e04', 'e05'])
                                                                    ->where('noinduk', $datarapot->noinduk)
                                                                    ->where('semester', $semestercari)
                                                                    ->where('tapel', $datarapot->tapel)
                                                                    ->where('matpel', $muatan)
                                                                    ->where('id', '!=', $idterbesar)
                                                                    ->orderBY('nilai', 'ASC')
                                                                    ->first();
                                            $nilaiterkecil 	= $golekterkecil->nilai ?? '';
                                            $kdterkecil 	= $golekterkecil->kodekd ?? '';
                                            if (isset($golekterkecil->id)){
                                                $cekdata 		= Datakd::where('muatan', $golekterkecil->matpel)->where('tema', $golekterkecil->kodekd)->where('kelas', $golekterkecil->kelas)->first();
                                                $range01 		= $cekdata->template01 ?? 'Ananda perlu pendampingan dalam ';
                                                $range02 		= $cekdata->template02 ?? 'Ananda perlu pendampingan dalam ';
                                                $range03 		= $cekdata->template03 ?? 'Ananda perlu pendampingan dalam ';
                                                $range04 		= $cekdata->template04 ?? 'Ananda perlu pendampingan dalam ';
                                                $range05 		= $cekdata->template05 ?? 'Ananda perlu pendampingan dalam ';
                                                $teks 			= '';
                                                if ($nilaiterkecil <= 74) {
                                                    $teks = $range01;
                                                } else if (74 < $nilaiterkecil && $nilaiterkecil <= 77) {
                                                    $teks = $range02;
                                                } else if (77 < $nilaiterkecil && $nilaiterkecil <= 85) {
                                                    $teks = $range03;
                                                } else if (85 < $nilaiterkecil && $nilaiterkecil <= 92) {
                                                    $teks = $range04;
                                                } else {
                                                    $teks = $range05;
                                                }
                                                if ($muatan == 'BA'){
                                                    $deskripsi		= $deskripsi.'<br />'.$teks.$golekterkecil->kodekd;
                                                } else {
                                                    $deskripsi		= $deskripsi.'<br />'.$teks.$golekterkecil->deskripsi;
                                                }
                                            }
                            @endphp
                                    <tr>
                                        <td>{{$nomor}}</td>
                                        <td align="left">{{$matpel}}</td>
                                        <td>
                                            <input type="text" class="form-control" id="n{{$index}}" name="n{{$index}}" value="{{$kkm}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="k{{$index}}" name="k{{$index}}" value="{{$afektif}}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="nilai{{$index}}" name="nilai{{$index}}" value="{{$angka}}">
                                        </td>
                                        <td>{{$nilaiterkecil}} / {{$kdterkecil}}</td>
                                        <td>{{$nilaiterbesar}} / {{$kdterbesar}}</td>
                                        <td><textarea id="deskripsi{{$index}}">{!! $deskripsi !!}</textarea></td>
                                    </tr>
                            @php
                                            $nomor++;
                                        }
                                    }
                                }
                            }
                            @endphp
                                </tbody>
                            </table>
						</div>
                        <div class="card-footer">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="rapot_total">Total Nilai</label>
                                        <input type="text" class="form-control" id="rapot_total" name="total" value="{{$totalsum}}">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="rapot_jumlahmatpel">Jumlah Matpel</label>
                                        <input type="text" class="form-control" id="rapot_jumlahmatpel" name="jumlahmatpel" value="{{$pembagisum}}">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="rapot_ratarata">Rata-Rata</label>
                                        @php 
                                            if ($totalsum != 0 AND $pembagisum != 0){
                                                $ratarata = round(($totalsum/$pembagisum), 2);
                                            } else {
                                                $ratarata = 0;
                                            }
                                        @endphp
                                        <input type="text" class="form-control" id="rapot_ratarata" name="ratarata" value="{{$ratarata}}">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="rapot_rangking">Rangking</label>
                                        <input type="text" class="form-control" id="rapot_rangking" name="rangking" value="{{$datarapot->rangking}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i>Prestasi</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btnsimpanall"><i class="fa fa-save"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="rapot_prestasi1">Prestasi 1</label>
                                        <input type="text" class="form-control" id="rapot_prestasi1" name="prestasi1" value="{{$datarapot->prestasi1}}">
                                    </div> 
                                    <div class="col-lg-6">
                                        <label for="rapot_ketprestasi1">Keterangan</label>
                                        <input type="text" class="form-control" id="rapot_ketprestasi1" name="ketprestasi1" value="{{$datarapot->ketprestasi1}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="rapot_prestasi2">Prestasi 2</label>
                                        <input type="text" class="form-control" id="rapot_prestasi2" name="prestasi2" value="{{$datarapot->prestasi2}}">
                                    </div> 
                                    <div class="col-lg-6">
                                        <label for="rapot_ketprestasi2">Keterangan</label>
                                        <input type="text" class="form-control" id="rapot_ketprestasi2" name="ketprestasi2" value="{{$datarapot->ketprestasi2}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="rapot_prestasi3">Prestasi 3</label>
                                        <input type="text" class="form-control" id="rapot_prestasi3" name="prestasi3" value="{{$datarapot->prestasi3}}">
                                    </div> 
                                    <div class="col-lg-6">
                                        <label for="rapot_ketprestasi3">Keterangan</label>
                                        <input type="text" class="form-control" id="rapot_ketprestasi3" name="ketprestasi3" value="{{$datarapot->ketprestasi3}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="rapot_prestasi4">Prestasi 4</label>
                                        <input type="text" class="form-control" id="rapot_prestasi4" name="prestasi4" value="{{$datarapot->prestasi4}}">
                                    </div> 
                                    <div class="col-lg-6">
                                        <label for="rapot_ketprestasi4">Keterangan</label>
                                        <input type="text" class="form-control" id="rapot_ketprestasi4" name="ketprestasi4" value="{{$datarapot->ketprestasi4}}">
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i>Ekstrakulikuler</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btnsimpanall"><i class="fa fa-save"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="rapot_ekstrakulikuler1">Ekstrakulikuler 1</label>
                                        <input type="text" class="form-control" id="rapot_ekstrakulikuler1" name="ekstrakulikuler1" value="{{$datarapot->ekstrakulikuler1}}">
                                    </div> 
                                    <div class="col-lg-6">
                                        <label for="rapot_nildeskripsieks1">Keterangan</label>
                                        <input type="text" class="form-control" id="rapot_nildeskripsieks1" name="nildeskripsieks1" value="{{$datarapot->nildeskripsieks1}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="rapot_ekstrakulikuler2">Ekstrakulikuler 2</label>
                                        <input type="text" class="form-control" id="rapot_ekstrakulikuler2" name="ekstrakulikuler2" value="{{$datarapot->ekstrakulikuler2}}">
                                    </div> 
                                    <div class="col-lg-6">
                                        <label for="rapot_nildeskripsieks2">Keterangan</label>
                                        <input type="text" class="form-control" id="rapot_nildeskripsieks2" name="nildeskripsieks2" value="{{$datarapot->nildeskripsieks2}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="rapot_ekstrakulikuler3">Ekstrakulikuler 3</label>
                                        <input type="text" class="form-control" id="rapot_ekstrakulikuler3" name="ekstrakulikuler3" value="{{$datarapot->ekstrakulikuler3}}">
                                    </div> 
                                    <div class="col-lg-6">
                                        <label for="rapot_nildeskripsieks3">Keterangan</label>
                                        <input type="text" class="form-control" id="rapot_nildeskripsieks3" name="nildeskripsieks3" value="{{$datarapot->nildeskripsieks3}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="rapot_ekstrakulikuler4">Ekstrakulikuler 4</label>
                                        <input type="text" class="form-control" id="rapot_ekstrakulikuler4" name="ekstrakulikuler4" value="{{$datarapot->ekstrakulikuler4}}">
                                    </div> 
                                    <div class="col-lg-6">
                                        <label for="rapot_nildeskripsieks4">Keterangan</label>
                                        <input type="text" class="form-control" id="rapot_nildeskripsieks4" name="nildeskripsieks4" value="{{$datarapot->nildeskripsieks4}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="rapot_ekstrakulikuler5">Ekstrakulikuler 5</label>
                                        <input type="text" class="form-control" id="rapot_ekstrakulikuler5" name="ekstrakulikuler5" value="{{$datarapot->ekstrakulikuler5}}">
                                    </div> 
                                    <div class="col-lg-6">
                                        <label for="rapot_nildeskripsieks5">Keterangan</label>
                                        <input type="text" class="form-control" id="rapot_nildeskripsieks5" name="nildeskripsieks5" value="{{$datarapot->nildeskripsieks5}}">
                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> Observasi Fisik</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btnsimpanall"><i class="fa fa-save"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Tinggi Badan Semester 1</label>
                                        <input type="text" id="nilfisik_tbs1" name="tbs1" class="form-control" value="{{$datarapot->tbs1}}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tinggi Badan Semester 2</label>
                                        <input type="text" id="nilfisik_tbs2" name="tbs2" class="form-control" value="{{$datarapot->tbs2}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Berat Badan Semester 1</label>
                                        <input type="text" id="nilfisik_bbs1" name="bbs1" class="form-control" value="{{$datarapot->bbs1}}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Berat Badan Semester 2</label>
                                        <input type="text" id="nilfisik_bbs2" name="bbs2" class="form-control" value="{{$datarapot->bbs2}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pendengaran</label>
                                <input type="text" id="nilfisik_pendengaran" name="pendengaran" class="form-control" value="{{$datarapot->pendengaran}}">
                            </div>
                            <div class="form-group">
                                <label>Penglihatan</label>
                                <input type="text" id="nilfisik_penglihatan" name="penglihatan" class="form-control" value="{{$datarapot->penglihatan}}">
                            </div>
                            <div class="form-group">
                                <label>Gigi</label>
                                <input type="text" id="nilfisik_gigi" name="gigi" class="form-control" value="{{$datarapot->gigi}}">
                            </div>
                            <div class="form-group">
                                <label>Kesehatan lainnya</label>
                                <input type="text" id="nilfisik_kesehatanlain" name="kesehatanlain" class="form-control" value="{{$datarapot->kesehatanlain}}">
                            </div>
						</div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i>Catatan Wali Kelas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btnsimpanall"><i class="fa fa-save"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea id="rapot_saran" name="saran">{!! $datarapot->saran !!}</textarea>
						</div>
                        <div class="card-footer">
                        </div>
                    </div>
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
<script type="text/javascript">
    
</script>
@endpush