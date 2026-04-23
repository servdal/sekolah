@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Input Nilai Untuk Kelas {{ $setidkelas }}</h1>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group">
                        <a class="btn btn-app btn-primary" id="topbtncover" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Presensi"><i class="fa fa-calculator"></i> Presensi</a>
                        <a class="btn btn-app btn-warning" id="topbtnkms" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Menuju Sehat"><i class="fa fa-child"></i> KMS</a>
                        <a class="btn btn-app btn-info" href="{{url('/')}}/prestasialquran" data-bs-toggle="tooltip" data-bs-placement="top" title="Tahsin, Murojaah, Ziyadah, Tilawah"><i class="fa fa-book"></i> Alquran</a>
                        <a class="btn btn-app btn-danger" id="topbtnkenaikan" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Rapot"><i class="fa fa-trophy"></i> Rapot</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-danger shadow divkenaikankelas">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> Pilih Siswa</h3>
                            <div class="card-tools">
                                <a href="{{ url('cetakrapot') }}"><button class="btn btn-tool"><i class="fa fa-print"></i></button></a>
                                <button class="btn btn-tool btnrefresh"><i class="fa fa-backward"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(isset($datasiswa) && !empty($datasiswa))
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach($datasiswa as $rsiswa)
                                    <li class="item">
                                        <div class="product-img">
                                            @if ($rsiswa['foto'] == '' OR $rsiswa['foto'] == null)
                                            <a href="javascript:void(0)" onClick="selectasvalue('{{ $rsiswa['id'] }}')"><img src="{{url('/')}}/{{Session('sekolah_logo')}}" alt="{{ $rsiswa['nama'] }}" class="img-circle img-size-32 mr-2"></a>
                                            @else 
                                            <a href="javascript:void(0)" onClick="selectasvalue('{{ $rsiswa['id'] }}')"><img src="{{url('/')}}/dist/img/foto/{{ $rsiswa['foto'] }}" alt="{{ $rsiswa['nama'] }}" class="img-circle img-size-32 mr-2"></a>
                                            @endif
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" onClick="selectasvalue('{{ $rsiswa['id'] }}')">{{$rsiswa['nama']}}
                                            <span class="badge badge-warning float-right">{{$rsiswa['noinduk']}}</span></a>
                                            <span class="product-description">
                                                {{$rsiswa['alamat']}} 
                                            </span>
                                            <div class="btn-group">
                                                <a href="javascript:void(0)" class="product-title" onClick="btnprintcover('{{ $rsiswa['noinduk'] }}')">
                                                <span class="badge badge-primary float-right">Print Cover</span></a>
                                                <a href="javascript:void(0)" class="product-title" onClick="btnprintopendatadiri('{{ $rsiswa['id'] }}')">
                                                <span class="badge badge-warning float-right">View All</span></a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            @endif
						</div>
                    </div>
                    <div class="card card-danger shadow divnilai">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> Grafik KMS Siswa</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool btnrefresh"><i class="fa fa-backward"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(isset($datasiswa) && !empty($datasiswa))
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach($datasiswa as $rsiswa)
                                    <li class="item">
                                        <div class="product-img">
                                            @if ($rsiswa['foto'] == '' OR $rsiswa['foto'] == null)
                                            <a href="javascript:void(0)" onClick="viewgrafikkms('{{ $rsiswa['id'] }}')"><img src="{{url('/')}}/{{Session('sekolah_logo')}}" alt="{{ $rsiswa['nama'] }}" class="img-circle img-size-32 mr-2"></a>
                                            @else 
                                            <a href="javascript:void(0)" onClick="viewgrafikkms('{{ $rsiswa['id'] }}')"><img src="{{url('/')}}/dist/img/foto/{{ $rsiswa['foto'] }}" alt="{{ $rsiswa['nama'] }}" class="img-circle img-size-32 mr-2"></a>
                                            @endif
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" onClick="viewgrafikkms('{{ $rsiswa['id'] }}')">{{$rsiswa['nama']}}
                                            <span class="badge badge-warning float-right">{{$rsiswa['noinduk']}}</span></a>
                                            <span class="product-description">
                                                {{$rsiswa['alamat']}} 
                                                <a href="javascript:void(0)" class="product-title" onClick="viewgrafikkms('{{ $rsiswa['id'] }}')">
                                                <span class="badge badge-primary float-right">View</span></a>
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            @endif
						</div>
                    </div>
                    <div class="card card-info shadow divumum divhidcover">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> Setting</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>TAPEL</label>
                                <input type="text" name="tapel" id="tapel" class="form-control" value="{{$tapel}}">
                                <input type="hidden" name="id_kelas" id="id_kelas" class="form-control" value="{{$setidkelas}}">
                            </div>
                            <div class="form-group">
                                <label>Semester</label>
                                <select id="id_semester" name="id_semester" class="form-control" >
                                    <option value=""></option>
                                    @if ($smt == '1')
                                        <option value="1" selected>Ganjil</option>
                                        <option value="2">Genap</option>
                                    @else
                                        <option value="1">Ganjil</option>
                                        <option value="2" selected>Genap</option>
                                    @endif
                                </select>
                            </div>
						</div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-success" id="simpansetguru">Set Data Anda</button>
					    </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div id="loading">
                        <img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
                    </div>
                    <div class="card card-info shadow divumum">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Riwayat Input Nilai Tapel {{ $tapel }} Semester {{ $smt }}</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool btnrefresh"  title="Refresh Page"><i class="fa fa-refresh"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" id="utama">
                            <div id="gridlogaktifitas"></div>
						</div>
                        <div class="card-footer" id="diveditorpresensi">
                            <div id="gridpresensi"></div>
						</div>
                        <div class="card-footer" id="diveditornilai">
                            <div id="gridnilai"></div>
						</div>
                        <div class="card-footer" id="divriwayatrapot">
                            <div id="gridriwayatrapot"></div>
						</div>
                    </div>
                    <div class="card card-warning shadow divhidcover">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-pencil"></i> Input Presensi</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool btnrefresh"><i class="fa fa-backward"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group bilasesuaijadwal">
                                <label>Pilih Jadwal <font color="red" class="pull-right">*</font></label>
                                <select id="presensi_jadwal" name="presensi_jadwal" class="form-control select2">
                                    <option value="">Pilih Jadwal</option>
                                    <option value="TJ">Tidak Sesuai Jadwal (Isi Jadwal Manual)</option>
                                    @if(isset($jadwal) && !empty($jadwal))
                                        @foreach($jadwal as $rjadwal)
                                            <option value="{{ $rjadwal->id }}">{{ $rjadwal->matapelajaran }} ( di {{ $rjadwal->ruang }} Jam : {{$rjadwal->jammulai }}to{{$rjadwal->jamakhir}} )</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group bilasesuairps">
                                <label>Pilih Materi <font color="red" class="pull-right">*</font></label>
                                <select id="presensi_materi" name="presensi_materi" class="form-control select2">
                                    <option value="">Pilih</option>
                                    <option value="TJ">Tidak Tercantum (Isi Manual)</option>
                                    @php
                                        $keys = array_keys($komponendasar);
                                        for($i = 0; $i < count($komponendasar); $i++) {
                                    @endphp
                                        <optgroup label="{{ $muatanlist[$i] }}">
                                        @php
                                            foreach($komponendasar[$keys[$i]] as $key => $value) {
                                        @endphp
                                            <option value="{{ $value['id'] }}">{{ $value['deskripsi'] }}</option>
                                        @php
                                            }
                                        @endphp
                                        </optgroup>
                                    @php
                                    }
                                    @endphp
                                </select>
                            </div>
                            <div class="form-group" id="bilatidaksesuaijadwal">
                                <div class="row">
                                    <div class="col-lg-12" id="materimanual">
                                        <label>Materi</label>
                                        <input type="text" class="form-control" name="presensi_materimanual"/>
                                    </div> 
                                    <div class="col-lg-2">
                                        <label>Tanggal</label>
                                        <input value="{{date('Y-m-d')}}" type="text" class="form-control" name="presensi_tanggal" id="presensi_tanggal"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                    </div> 
                                    <div class="col-lg-3">
                                        <label>Mulai <font color="red" class="pull-right">*</font></label>
                                        <input type="text" id="presensi_mulai" name="presensi_mulai" class="form-control timepicker">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Akhir <font color="red" class="pull-right">*</font></label>
                                        <input type="text" id="presensi_akhir" name="presensi_akhir" class="form-control timepicker">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Ruangan <font color="red" class="pull-right">*</font></label>
                                        <select id="presensi_ruang" name="presensi_ruang" class="form-control">
                                            <option value="">Pilih Ruangan</option>
                                            <option value="Online">Online</option>
                                            <option value="Outing Class">Outing Class</option>
                                            @foreach($ruangans as $rruang)
                                                <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer table-responsive p-0">
                            <form id="forminputpresensi" method="post" enctype="multipart/form-data">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No.Induk</th>
                                            <th>NAMA</th>
                                            <th>Kehadiran</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($datasiswa as $rsiswa)
                                        <tr>
                                            <td>
                                                @php
                                                    echo $i + 1;
                                                @endphp
                                            </td>
                                            <td>{!! $rsiswa['noinduk'] !!}</td>
                                            <td>{!! $rsiswa['nama'] !!}</td>
                                            <td>
                                                <select name="nilai[{{$i}}][nilainya]" class="form-control" >
                                                    @if ($rsiswa['statuspresensi'] == 1)
                                                        <option value="1" selected>Hadir</option>
                                                        <option value="2">Ijin</option>
                                                        <option value="3">Sakit</option>
                                                        <option value="4">Terlambat</option>
                                                        <option value="0">Alpha</option>
                                                    @elseif ($rsiswa['statuspresensi'] == 2)
                                                        <option value="1">Hadir</option>
                                                        <option value="2" selected>Ijin</option>
                                                        <option value="3">Sakit</option>
                                                        <option value="4">Terlambat</option>
                                                        <option value="0">Alpha</option>
                                                    @elseif ($rsiswa['statuspresensi'] == 3)
                                                        <option value="1">Hadir</option>
                                                        <option value="2">Ijin</option>
                                                        <option value="3" selected>Sakit</option>
                                                        <option value="4">Terlambat</option>
                                                        <option value="0">Alpha</option>
                                                    @elseif ($rsiswa['statuspresensi'] == 5)
                                                        <option value="1">Hadir</option>
                                                        <option value="2">Ijin</option>
                                                        <option value="3">Sakit</option>
                                                        <option value="5" selected>Terlambat</option>
                                                        <option value="0">Alpha</option>
                                                    @else
                                                        <option value="1">Hadir</option>
                                                        <option value="2">Ijin</option>
                                                        <option value="3">Sakit</option>
                                                        <option value="4">Terlambat</option>
                                                        <option value="0">Alpha</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td>
                                                @php
                                                    $suratpresensi = $rsiswa['surat'];
                                                    if ($suratpresensi == '' OR $suratpresensi == null){
                                                        $keteranganpresensi = $rsiswa['keteranganpresensi'];
                                                @endphp
                                                        <input type="text" name="nilai[{{$i}}][keterangan]" value="{{$keteranganpresensi}}" class="form-control"/>
                                                @php
                                                    } else {
                                                @endphp
                                                        <input type="hidden" name="nilai[{{$i}}][keterangan]" value="{{$rsiswa['keteranganpresensi']}}"/>
                                                @php
                                                        echo '<a href="'.url('/').'/suratijinortu/'.$rsiswa['idsurat'].'" target="_blank">'.$rsiswa['keteranganpresensi'].'</a>';
                                                    }
                                                @endphp
                                                <input type="hidden" name="nilai[{{$i}}][kelas]" value="{!! $rsiswa['klspos'] !!}" />
                                                <input type="hidden" name="nilai[{{$i}}][namanya]" value="{!! $rsiswa['nama'] !!}" />
                                                <input type="hidden" name="nilai[{{$i}}][noinduk]" value="{!! $rsiswa['noinduk'] !!}" />
                                            </td>
                                            @php
                                                $i++;
                                            @endphp
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                            <button class="btn btn-lg btn-success" id="btnsimpanpresensi"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                    <div class="card card-warning shadow divnilai">
                        <div class="card-header divnilaiinput">
                            <h3 class="card-title"><i class="fa fa-pencil"></i> Input KMS</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool btnrefresh"><i class="fa fa-backward"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-footer divnilaiinput">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Tanggal</label>
                                        <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" name="penilaian_tanggal" id="penilaian_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                        <div class="card-footer divnilaiinput">
                            <form id="forminputnilai" method="post" enctype="multipart/form-data">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No.Induk</th>
                                        <th>NAMA</th>
                                        <th>Berat Badan</th>
                                        <th>Tinggi Badan</th>
                                        <th>Lingkar Kepala</th>
                                        <th>Vitamin/Imunisasi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($datasiswa as $rsiswa)
                                        <tr>
                                            <td>
                                            @php
                                                echo $i + 1;
                                            @endphp
                                            </td>
                                            <td>{!! $rsiswa['noinduk'] !!}</td>
                                            <td>{!! $rsiswa['nama'] !!}</td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][berat]" placeholder=" dalam kg"  class="form-control"/>
                                                <input type="hidden" name="nilai[{{$i}}][namanya]" value="{!! $rsiswa['nama'] !!}" />
                                                <input type="hidden" name="nilai[{{$i}}][noinduk]" value="{!! $rsiswa['noinduk'] !!}" />
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][tinggi]" placeholder=" dalam cm" class="form-control"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][lingkar]" placeholder=" dalam cm" class="form-control"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][vitamin]" placeholder="" class="form-control"/>
                                            </td>
                                            @php
                                                $i++;
                                            @endphp
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                            <button class="btn btn-lg btn-success" id="btnsimpanformnilai"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                        <div class="card-body divnilaigrafik">
                            <div id="grafikberat" style="width:100%; height:300px;"></div>
						</div>
                        <div class="card-body divnilaigrafik">
                            <div id="grafiktinggi" style="width:100%; height:300px;"></div>
						</div>
                        <div class="card-body divnilaigrafik">
                            <div id="grafiklingkar" style="width:100%; height:300px;"></div>
						</div>
                    </div>
                    <div class="card card-danger shadow divkenaikankelas">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Review Rapot Tapel {{ $tapel }} Semester {{ $smt }}</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool btnrefresh"><i class="fa fa-backward"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body rapotpreview">
                            <div class="bs-stepper">
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="step" data-target="#part1">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="part1" id="part1-trigger">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Penilaian</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#part2">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="part2" id="part2-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Preview Raport Khas</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <div id="part1" class="content" role="tabpanel" aria-labelledby="part1-trigger">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label for="rapot_nama">Nama</label>
                                                    <input type="text" class="form-control" id="rapot_nama" name="rapot_nama" readonly>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="rapot_noinduk">No Induk</label>
                                                    <input type="text" class="form-control" id="rapot_noinduk" name="rapot_noinduk" readonly>
                                                    <input type="hidden" class="form-control" id="rapot_nisn" name="rapot_nisn" readonly>
                                                    <input type="hidden" class="form-control" id="rapot_kelas" name="rapot_kelas">
                                                    <input type="hidden" class="form-control" id="rapot_hariefektif" name="rapot_hariefektif">
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="rapot_sakit">Sakit</label>
                                                    <input type="text" class="form-control" id="rapot_sakit" name="rapot_sakit">
                                                </div> 
                                                <div class="col-lg-2">
                                                    <label for="rapot_ijin">Ijin</label>
                                                    <input type="text" class="form-control" id="rapot_ijin" name="rapot_ijin">
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="rapot_alpha">Alpha</label>
                                                    <input type="text" class="form-control" id="rapot_alpha" name="rapot_alpha">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-horizontal">
                                            <form id="forminputnilaiafektif" method="post" enctype="multipart/form-data">
                                                @if ($masterkls == '1')
                                                    <div class="form-group row">
                                                        <div class="col-sm-9">
                                                            <label for="rapot_indikator01">AL-ISLAM</label>
                                                            @if ($smt == 1)
                                                                <input type="text" class="form-control" id="rapot_indikator01" name="rapot_indikator01" value="Mengenal Rukun Islam melalui nasyid. Adab Makan. Hadits Makan dan minum. Hadits jangan marah. Hadits saling memberi">
                                                            @else
                                                                <input type="text" class="form-control" id="rapot_indikator01" name="rapot_indikator01" value="Menyebutkan: Rukun Islam, Nama-naa sholat, Rukun islam ke 3. Hadits-hadits: Saling memberi, jangan marah, senyum, malu, makan dan minum. Do’a-do’a: Makan dan minum, Masuk KM, Sebelum dan sesudah belajar, tutup majelis, naik kendaraan darat.">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="rapot_perkembangan01">Perkembangan</label>
                                                            <select id="rapot_perkembangan01" name="rapot_perkembangan01" class="form-control" >
                                                                <option value="BB">Belum Berkembang</option>
                                                                <option value="MB">Mulai Berkembang</option>
                                                                <option value="BSH">Berkembang Sesuai Harapan</option>
                                                                <option value="BSB">Berkembang Sangat Baik</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <textarea id="rapot_deskripsi01" name="rapot_deskripsi01" class="ckeditortag"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-9">
                                                            <label for="rapot_indikator02">KOGNITIF</label>
                                                            @if ($smt == 1)
                                                                <input type="text" class="form-control" id="rapot_indikator02" name="rapot_indikator02" value="Mengenal warna (merah, kuning, hijau, biru), Mengenal angka 1-5, Menghitung banyak benda 1-5, Mengenal bentuk Geometri (lingkarang, Segi tiga, Segi empat),  Mengenal huruf vocal (a, i, u, e, o), Memasangkan gambar sesuai dengan pasangannya.">
                                                            @else
                                                                <input type="text" class="form-control" id="rapot_indikator02" name="rapot_indikator02" value="Mengenal dan membilang angka 1-10. Mengenal dan menyebut bentuk-bentuk geometri. Menghubungkan gambar dengan angka. Mengenal warna-warna dasar.">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="rapot_perkembangan02">Perkembangan</label>
                                                            <select id="rapot_perkembangan02" name="rapot_perkembangan02" class="form-control" >
                                                                <option value="BB">Belum Berkembang</option>
                                                                <option value="MB">Mulai Berkembang</option>
                                                                <option value="BSH">Berkembang Sesuai Harapan</option>
                                                                <option value="BSB">Berkembang Sangat Baik</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <textarea id="rapot_deskripsi02" name="rapot_deskripsi02" class="ckeditortag"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-9">
                                                            <label for="rapot_indikator03">BAHASA</label>
                                                            @if ($smt == 1)
                                                                <input type="text" class="form-control" id="rapot_indikator03" name="rapot_indikator03" value="Hafal 3 warna dengan bahas arab, Hafal 4 warna dengan bahas inggris, Hafal 5 nama binatang dengan bahasa arab, Berhitung 1-10 dengan bahasa arab, Berhitung 1-10 dengan bahasa inggris, Menjawab pertanyaan sederhana.">
                                                            @else
                                                                <input type="text" class="form-control" id="rapot_indikator03" name="rapot_indikator03" value="Menyebut: 3-4 nama binatang dengan bahasa arab, 3-4 nama-nama binatang dengan bahasa inggris, 3-4 anggota tubuh dengan bahasa arab, 3-4 macam warna dengan bahasa inggris. Mengenal huruf vocal a, i, u, e, o.">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="rapot_perkembangan03">Perkembangan</label>
                                                            <select id="rapot_perkembangan03" name="rapot_perkembangan03" class="form-control" >
                                                                <option value="BB">Belum Berkembang</option>
                                                                <option value="MB">Mulai Berkembang</option>
                                                                <option value="BSH">Berkembang Sesuai Harapan</option>
                                                                <option value="BSB">Berkembang Sangat Baik</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <textarea id="rapot_deskripsi03" name="rapot_deskripsi03" class="ckeditortag"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-9">
                                                            <label for="rapot_indikator04">FISIK MOTORIK</label>
                                                            @if ($smt == 1)
                                                                <input type="text" class="form-control" id="rapot_indikator04" name="rapot_indikator04" value="Memegang pensil/ krayon dengan benar. Membuat coretan sederhana. Mewarnai gambar sederhana. Menempel/ Mozaik gambar sederhana. Lari dengan jarak 7-8 m. Memasukkan bola kedalam keranjang. Merangkak. Melompat.">
                                                            @else
                                                                <input type="text" class="form-control" id="rapot_indikator04" name="rapot_indikator04" value="Memegang krayon dengan benar, mewarnai gambar sederhana. Meremas dan membuat bola dari kertas. Kolase gambar sederhana.Menebalkan garis putus-putus. Melempar dan menangkap bola. Melompat dengan 1 dan 2 kaki. Berdiri dengan 1 kaki. Merangkak. Berjalan berjinjit. Berlari dengan jarak 7-8 meter.">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="rapot_perkembangan04">Perkembangan</label>
                                                            <select id="rapot_perkembangan04" name="rapot_perkembangan04" class="form-control" >
                                                                <option value="BB">Belum Berkembang</option>
                                                                <option value="MB">Mulai Berkembang</option>
                                                                <option value="BSH">Berkembang Sesuai Harapan</option>
                                                                <option value="BSB">Berkembang Sangat Baik</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <textarea id="rapot_deskripsi04" name="rapot_deskripsi04" class="ckeditortag"></textarea>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="form-group row">
                                                        <div class="col-sm-9">
                                                            <label for="rapot_indikator01">AL-ISLAM</label>
                                                            @if ($smt == 1)
                                                                <input type="text" class="form-control" id="rapot_indikator01" name="rapot_indikator01" value="Asmaul Husna (Ar rohman, Ar rohim, Al malik, Al kuddus). Rukun Islam dan Rukun Iman. Adab terhadap orang tua. Adab terhadap lingkungan. Hadits saling memberi. Hadits jangan marah. Hadits senyum sedekah. Hadits keindahan.">
                                                            @else
                                                                <input type="text" class="form-control" id="rapot_indikator01" name="rapot_indikator01" value="Menyebutkan : Rukun iman, Jumlah dan nama-nama malaikat, nama-nama kitab Allah. Hadits-hadits: Keindahan, kesucian, Malu, Makan dan minum, senyum. Do’a-do’a: Sebelum dan sesudah makan, Sebelum dan sesudah keluar KM, Sebelum dan sesudah belajar, tutup majalis, naik kendaraan darat.">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="rapot_perkembangan01">Perkembangan</label>
                                                            <select id="rapot_perkembangan01" name="rapot_perkembangan01" class="form-control" >
                                                                <option value="BB">Belum Berkembang</option>
                                                                <option value="MB">Mulai Berkembang</option>
                                                                <option value="BSH">Berkembang Sesuai Harapan</option>
                                                                <option value="BSB">Berkembang Sangat Baik</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <textarea id="rapot_deskripsi01" name="rapot_deskripsi01" class="ckeditortag"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-9">
                                                            <label for="rapot_indikator02">KOGNITIF</label>
                                                            @if ($smt == 1)
                                                                <input type="text" class="form-control" id="rapot_indikator02" name="rapot_indikator02" value="Mengenal pencampuran warna, Mengenal bentuk geometri (lingkaran, segi tiga, segi empat), Mengenal angka 1-10, Mengenal huruf konsonan, Mengurutkan benda dari besar ke kecil dan sebaliknya, Mengurutkan benda sesuai pola, Memasangkan gambar sesuai dengan pasangannya.">
                                                            @else
                                                                <input type="text" class="form-control" id="rapot_indikator02" name="rapot_indikator02" value="Mengenal angka 1-10. Mengenal bangun ruang (kubus dan balok). Menghitung banyak benda. Mengurutkan benda dari besar-kecil / sebaliknya. Mengenal campuran warna. Mengenal macam-macam rasa.">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="rapot_perkembangan02">Perkembangan</label>
                                                            <select id="rapot_perkembangan02" name="rapot_perkembangan02" class="form-control" >
                                                                <option value="BB">Belum Berkembang</option>
                                                                <option value="MB">Mulai Berkembang</option>
                                                                <option value="BSH">Berkembang Sesuai Harapan</option>
                                                                <option value="BSB">Berkembang Sangat Baik</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <textarea id="rapot_deskripsi02" name="rapot_deskripsi02" class="ckeditortag"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-9">
                                                            <label for="rapot_indikator03">BAHASA</label>
                                                            @if ($smt == 1)
                                                                <input type="text" class="form-control" id="rapot_indikator03" name="rapot_indikator03" value="Hafal 5-6 warna dengan bahas arab, Hafal 5-6 warna dengan bahas inggris, Hafal 5-6 nama binatang dengan bahasa arab, Berhitung 1-10 dengan bahasa arab, Berhitung 1-10 dengan bahasa inggris, Membaca beberapa kata sederhana, Menjawab pertanyaan sederhana">
                                                            @else
                                                                <input type="text" class="form-control" id="rapot_indikator03" name="rapot_indikator03" value="Menyebutkan 4-5 nama binatang dengan bahasa inggris. Mencari huruf vokal. Menyebutkan angka 1-10 dengan bahasa inggris. Menyebutkan 4-5 anggota tubuh dengan bahasa arab. Menyebutkan angka 1-10 dengan bahasa arab">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="rapot_perkembangan03">Perkembangan</label>
                                                            <select id="rapot_perkembangan03" name="rapot_perkembangan03" class="form-control" >
                                                                <option value="BB">Belum Berkembang</option>
                                                                <option value="MB">Mulai Berkembang</option>
                                                                <option value="BSH">Berkembang Sesuai Harapan</option>
                                                                <option value="BSB">Berkembang Sangat Baik</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <textarea id="rapot_deskripsi03" name="rapot_deskripsi03" class="ckeditortag"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-9">
                                                            <label for="rapot_indikator04">FISIK MOTORIK</label>
                                                            @if ($smt == 1)
                                                                <input type="text" class="form-control" id="rapot_indikator04" name="rapot_indikator04" value="Mewarnai gambar dengan rapi dan dengan gradasi sederhana, Melipat bentuk sederhana, Mencontoh menulis kalimat sederhana. Mencontoh menulis hijaiyah sederhana. Lari dengan jarak 7-8 m, Menendang bola, Memasukkan bola kedalam keranjang, Melompat sesuai perintah.">
                                                            @else
                                                                <input type="text" class="form-control" id="rapot_indikator04" name="rapot_indikator04" value="Memegang pensil dengan benar. Menebalkan garis-garis putus. Mencontoh menulis huruf sederhana. Mencontoh menulis hijaiyah sederhana. Menggambar bentuk geometri. Mewarnai gambar dengan rapi.">
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label for="rapot_perkembangan04">Perkembangan</label>
                                                            <select id="rapot_perkembangan04" name="rapot_perkembangan04" class="form-control" >
                                                                <option value="BB">Belum Berkembang</option>
                                                                <option value="MB">Mulai Berkembang</option>
                                                                <option value="BSH">Berkembang Sesuai Harapan</option>
                                                                <option value="BSB">Berkembang Sangat Baik</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <textarea id="rapot_deskripsi04" name="rapot_deskripsi04" class="ckeditortag"></textarea>
                                                        </div>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                        <button class="btn btn-primary" id="btnsimpan1">Next</button>
                                    </div>
                                    <div id="part2" class="content" role="tabpanel" aria-labelledby="part2-trigger">
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="previewrapotkhas"></div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            @if(isset($tandatangan) AND $tandatangan != '')
                                                                <img src="{!!$tandatangan!!}" alt="image" width="100%" id="previewttd">
                                                            @else
                                                                <img src="{{url('/')}}/dist/img/takadagambar.png" alt="image" width="100%" id="previewttd">
                                                            @endif
                                                            <input type="file" id="id_tandatangan" style="display: none;"/>
                                                            <button type="button" class="btn btn-info btn-block" id="btnuploadtandatangan">&nbsp;&nbsp;Tandatangan Rapot&nbsp;&nbsp;</button></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                        <button class="btn btn-primary" id="btnsimpan4">Kirim Ke Kepala Sekolah</button>
                                    </div>
                                </div>
                            </div>
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
<div class="modal fade" id="modaleditnilai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Nilai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-8">
                            <label>Nama</label>
                            <input type="text" id="nil_nama" name="nil_nama" class="form-control" disabled="disable">
                        </div>
                        <div class="col-lg-4">
                            <label>NIS</label>
                            <input type="text" id="nil_nis" name="nil_nis" class="form-control" disabled="disable">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Berat Badan</label>
                    <input type="text" id="nil_tema" name="nil_tema" class="form-control">
                </div>
                <div class="form-group">
                    <label>Tinggi Badan</label>
                    <input type="text" id="nil_subtema" name="nil_subtema" class="form-control">
                </div>
                <div class="form-group">
                    <label>Lingkar Kepala</label>
                    <input type="text" id="nil_nilai" name="nil_nilai" class="form-control">
                </div>
                <div class="form-group">
                    <label>Vitamin/Imunisasi</label>
                    <input type="text" id="nil_deskripsi" name="nil_deskripsi" class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="nil_id" >
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="simpaneditnilai">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalverifikasipresensi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Verifikasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Nama Siswa</label>
                    <input type="text" id="absen_nama" name="absen_nama" class="form-control" disabled="disable">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Ijin Pada Tanggal</label>
                            <input type="text" id="absen_tanggal" class="form-control"  disabled="disable">
                        </div>
                        <div class="col-lg-6">
                            <label>Ijin Selama (Hari)</label>
                            <input type="text" id="absen_selama" class="form-control"  disabled="disable">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Dikarenakan.?</label>
                    <textarea id="absen_alasan" rows="10" cols="80" disabled="disable"></textarea>
                </div>
                <div class="form-group">
                    <label>Pemohon</label>
                    <input type="text" id="absen_pemohon" class="form-control" disabled="disable">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Tapel</label>
                            <input type="text" id="absen_tapel" class="form-control" >
                        </div>
                        <div class="col-lg-6">
                            <label>Kategori</label>
                            <select id="absen_kategori" class="form-control">
                                <option value="1">Hadir</option>
                                <option value="2">Ijin</option>
                                <option value="3">Sakit</option>
                                <option value="4">Terlambat</option>
                                <option value="0">Alpha</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="absen_idpresensi" >
                <button type="button" class="btn btn-danger" id="btnsmpnverpresensi">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalkirimsurat">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Kirim Email</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="kirim_penerima" class="col-form-label">Yang Terhormat :</label>
                    <input type="text" class="form-control" id="kirim_penerima" disabled="disable">
                </div>
                <div class="form-group">
                    <textarea id="kirim_body"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="kirim_hape" class="col-form-label">No.HP Penerima</label>
                        <input type="number" class="form-control" id="kirim_hape" placeholder="Format = +6281359108565">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="kirim_email" class="col-form-label">Email Penerima</label>
                        <input type="text" class="form-control" id="kirim_email">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="kirim_idne">
                <button type="button" class="btn btn-success pull-left" id="btnkirimsurat">Kirim</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalkirimrapot">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Setting Raport</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="rapot_tapel">Tapel</label>
                    <input type="text" class="form-control" id="rapot_tapel" name="rapot_tapel" value="{{$tapel}}">
                </div>
                <div class="form-group">
                    <label for="rapot_semester">Semester</label>
                    <select id="rapot_semester" name="rapot_semester" class="form-control" >
                        <option value=""></option>
                        <!-- <option value="1.1">PTS Ganjil</option> -->
                        <option value="1">Semester 1</option>
                        <!-- <option value="2.1">PTS Genap</option> -->
                        <option value="2">Semester 2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="rapot_tanggal" class="col-form-label">Tanggal Rapot</label>
                    <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="rapot_tanggal" name="rapot_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="kirimrapot_id">
                <button type="button" class="btn btn-success pull-left" id="btnbuatrapot">Create</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="mas_semester" name="mas_semester" value="{{ $smt }}">
<input type="hidden" id="mas_tapel" name="mas_tapel" value="{{ $tapel }}">
<input type="hidden" id="mas_niyguru" name="mas_niyguru" value="{{ Session('id') }}">
<input type="hidden" name="idekskul" id="idekskul" value="{{ $masterkls }}">
<input type="hidden" id="gettandatangan" value="{!! $tandatangan !!}">
@endsection
@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })
    $('#id_tandatangan').change(function () {
        if(this.files[0].size > 1000000){
            this.value = "";
			swal({
				title	: 'Stop',
				text	: 'Maksimum file adalah 1Mb',
				type	: 'warning',
			})
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLAddttd(this);
            } else {
				swal({
					title	: 'Stop',
					text	: 'Please select image file (jpg, jpeg, png).',
					type	: 'warning',
				})
            }
        }
    });
    function readURLAddttd(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#previewttd').attr('src', e.target.result);
                $('#gettandatangan').val(e.target.result);
            };
        }
    }
	$(function () {
        $('.select2').select2({width: '100%'});
        $(".timepicker").timepicker({format: 'HH:mm:ss'});
        $('.datemaskinput').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		CKEDITOR.env.isCompatible = true;
        
        CKEDITOR.replace( 'absen_alasan', {
			toolbarGroups: [{"name":"paragraph","groups":["list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
        CKEDITOR.replace( 'rapot_deskripsi01', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
        CKEDITOR.replace( 'rapot_deskripsi02', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
        CKEDITOR.replace( 'rapot_deskripsi03', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
        CKEDITOR.replace( 'rapot_deskripsi04', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
		$('#presensi_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#set_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#absen_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
    function selectasvalue(id){
        $('#kirimrapot_id').val(id);
        $("#modalkirimrapot").modal('show');
    }
    function btnprintcover(id){
        $.post('{{ route("ctkBiodatarapot") }}', { val01: id, val02: '', _token: '{{ csrf_token() }}' },
            function(data){
                var newWindow = window.open('', '', 'width=880, height=500'),
                    document 	= newWindow.document.open(),
                    pageContent =
                        '<!DOCTYPE html>\n' +
                        '<html>\n' +
                        '<head>\n' +
                        '<meta charset="utf-8" />\n' +
                        '<title>Biodata Siswa</title>\n' +
                        '</head>\n' +
                        '<body>' + data + '</body>\n</html>';
                    document.write(pageContent);
                    document.close();
                    newWindow.print();
            return false;
        });
    }
    function btnprintopendatadiri(id){
        var url = '{{url('/')}}/viewalldata?id='+id;
        window.location.href = url;
    }
    function viewgrafikkms(id){
        $('.divnilaiinput').hide();
        var source = {
            datatype: "json",
            datafields: [
                { name: 'tanggal', type: 'string' },
                { name: 'berat', type: 'integer'},
                { name: 'tinggi', type: 'integer' },
                { name: 'lingkar', type: 'integer' },
            ],
            type    : 'POST',
            data    : {val01: id, _token: '{{ csrf_token() }}'},
            url     : '{{ route("jsonNStatistikilaisiswa") }}',
        };
        var dataJsonKMS		= new $.jqx.dataAdapter(source);
        var settinggrafik1 = {
            title           : "Statistik",
            description     : "Perkembangan Berat Badan",
            enableAnimations: true,
            titlePadding    : { left: 0, top: 0, right: 0, bottom: 10 },
            source          : dataJsonKMS,
            xAxis           :
                {
                    dataField       : 'tanggal',
                    displayText     : 'Bulan',
                    gridLines       : { visible: true },
                    valuesOnTicks   : false
                },
            colorScheme         : 'scheme01',
            columnSeriesOverlap : false,
            seriesGroups        :
                [
                    {
                        type        : 'column',
                        valueAxis   :
                        {
                            visible : true,
                            title   : { text: 'Dalam Kg' }
                        },
                        series: [
                            { dataField: 'berat', displayText: ' Kg' },	
                        ]
                    }
                ]
        };
        $('#grafikberat').jqxChart(settinggrafik1);
        var settinggrafik2 = {
            title           : "Statistik",
            description     : "Perkembangan Tinggi Badan",
            enableAnimations: true,
            titlePadding    : { left: 0, top: 0, right: 0, bottom: 10 },
            source          : dataJsonKMS,
            xAxis           :
                {
                    dataField       : 'tanggal',
                    displayText     : 'Bulan',
                    gridLines       : { visible: true },
                    valuesOnTicks   : false
                },
            colorScheme         : 'scheme02',
            columnSeriesOverlap : false,
            seriesGroups        :
                [
                    {
                        type        : 'column',
                        valueAxis   :
                        {
                            visible : true,
                            title   : { text: 'Dalam Cm' }
                        },
                        series: [
                            { dataField: 'tinggi', displayText: ' Cm' },	
                        ]
                    }
                ]
        };
        $('#grafiktinggi').jqxChart(settinggrafik2);
        var settinggrafik3 = {
            title           : "Statistik",
            description     : "Perkembangan Tinggi Badan",
            enableAnimations: true,		
            titlePadding    : { left: 0, top: 0, right: 0, bottom: 10 },
            source          : dataJsonKMS,
            xAxis:
                {
                    dataField       : 'tanggal',
                    displayText     : 'Tahun dan Bulan',
                    gridLines       : { visible: true },
                    valuesOnTicks   : false
                },
            colorScheme         : 'scheme03',
            columnSeriesOverlap : false,
            seriesGroups        : [{
                type            : 'column',
                valueAxis       :{
                    visible     : true,
                    title       : { text: 'Dalam Cm<br>' }
                },
                series          : [
                    { dataField: 'lingkar', displayText: ' Cm' },
                ]
            }]
        };
        $('#grafiklingkar').jqxChart(settinggrafik3);
        $('.divnilaigrafik').show();
    }
    $(document).ready(function () {
        $('.shadow').hide();
        $('#loading').hide();
        $('.divnilai').hide();
        $('.divkenaikankelas').hide();
        $('.divhidcover').hide();
        $('.divumum').show();
        $('#diveditorpresensi').hide();
        $('#diveditornilai').hide();
        $('#divriwayatrapot').hide();
        $('#utama').show();
        $('#simpaneditnilai').click(function () {
            var set01=document.getElementById('nil_id').value;
            var set02=document.getElementById('nil_nilai').value;
            var set03=document.getElementById('nil_tema').value;
            var set04=document.getElementById('nil_subtema').value;
            var set05=document.getElementById('nil_deskripsi').value;
            if (set01 == ''){
                swal({
                    title: 'Stop',
                    text: 'Pilih Siswa Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Lingkar Kepala Ananda Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set03 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Berat Badan Ananda Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set04 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Tinggi Badan Ananda Terlebih Dahulu',
                    type: 'warning',
                })
            } else {
                $("#modaleditnilai").modal('hide');
                $.post('{{ route("exSaveditnilai") }}', { id: set01, val01: 'kms', val02: set02, val03: set03, val04: set04, val05: set05, _token: '{{ csrf_token() }}' },
                function(data){
                    $("#gridnilai").jqxGrid("updatebounddata");
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var status  = data.status;
                    var message = data.message;
                    var warna 	= data.warna;
                    var icon 	= data.icon;
                    $.toast({
                        heading: status,
                        text: message,
                        position: 'top-right',
                        loaderBg: warna,
                        icon: icon,
                        hideAfter: 5000,
                        stack: 1
                    });
                    return false;
                });
            }
        });
        $('#btnsmpnverpresensi').click(function () {
            var set01=document.getElementById('absen_idpresensi').value;
            var set02=document.getElementById('absen_tapel').value;
            var set03=document.getElementById('absen_kategori').value;
            if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom TAPEL Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set03 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom Kategori Terlebih Dahulu',
                    type: 'warning',
                })
            } else {
                $("#modalverifikasipresensi").modal('hide');
                $.post('{{ route("exVerpresensi") }}',  { val01: set01, val02: set02, val03: set03, _token: '{{ csrf_token() }}' },
                function(data){
                    var status  = data.status;
                    var message = data.message;
                    var warna 	= data.warna;
                    var icon 	= data.icon;
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    swal({
                        title	: status,
                        text	: message,
                        type	: icon,
                    })
                    $("#gridpresensi").jqxGrid('updatebounddata');
                    return false;
                });
            }
        });
        $('#simpansetguru').click(function () {
            var set01=document.getElementById('id_semester').value;
            var set02=document.getElementById('id_kelas').value;
            var set03='';
            var set04=document.getElementById('tapel').value;
            if (set01 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom Semester Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom Kelas Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set04 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom TAPEL Terlebih Dahulu',
                    type: 'warning',
                })
            } else {
                $.post('{{ route("exSavesetguru") }}', { val01: set01, val02: set02, val03: set03, val04: set04, _token: '{{ csrf_token() }}' },
                function(data){
                    location.reload();
                });
            }
        });
        $('#topbtncover').click(function () {
            var set01=document.getElementById('mas_semester').value;
            var set02=document.getElementById('mas_tapel').value;
            if (set01 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom Semester Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom Tahun Pelajaran Terlebih Dahulu',
                    type: 'warning',
                })
            } else {
                $("#presensi_materi").val('').select2().trigger('change');
                $("#presensi_jadwal").val('').select2().trigger('change');
                $('.shadow').hide();
                $('.divhidcover').show();
                $('.bilasesuaijadwal').show();
                $('.bilasesuairps').show();
                $('#bilatidaksesuaijadwal').hide();
                $('#materimanual').hide();
            }
        });
        $('#topbtnkms').click(function () {
            $('.shadow').hide();
            $('.divnilai').show();
            $('.divnilaigrafik').hide();
            $('.divnilaiinput').show();
        });
        $("#presensi_jadwal").on('change', function () {
            var isi = $(this).find('option:selected').attr('value');		
            if (isi == 'TJ'){
                $('.bilasesuaijadwal').hide();
                $('#bilatidaksesuaijadwal').show();
            } else {
                $('.bilasesuaijadwal').show();
                $('#bilatidaksesuaijadwal').hide();
            }
        });
        $("#presensi_materi").on('change', function () {
            var isi = $(this).find('option:selected').attr('value');		
            if (isi == 'TJ'){
                $('.bilasesuairps').hide();
                $('#materimanual').show();
            } else {
                $('.bilasesuairps').show();
                $('#materimanual').hide();
            }
        });
        $('#btnsimpanpresensi').click(function () {
            var set01=document.getElementById('mas_semester').value;
            var set02=document.getElementById('mas_tapel').value;
            var set03=document.getElementById('presensi_jadwal').value;
            var set04=document.getElementById('presensi_materi').value;
            var set05=document.getElementById('presensi_tanggal').value;
            var set06=document.getElementById('presensi_mulai').value;
            var set07=document.getElementById('presensi_akhir').value;
            var set08=document.getElementById('presensi_ruang').value;
            if (set04 == '' || set04 == '0'){
                swal({
                    title	: 'Mohon di Lengkapi',
                    text	: 'Materi tidak boleh kosong',
                    type	: 'warning',
                })
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData($('#forminputpresensi')[0]);
                    formdata.set('_token', '{{ csrf_token() }}');
                    formdata.set('semester', set01);
                    formdata.set('tapel', set02);
                    formdata.set('kelas', '{{ $masterkls }}');
                    formdata.set('presensi_jadwal', set03);
                    formdata.set('presensi_materi', set04);
                    formdata.set('presensi_tanggal', set05);
                    formdata.set('presensi_mulai', set06);
                    formdata.set('presensi_akhir', set07);
                    formdata.set('presensi_ruang', set08);
                $.ajax({
                    url         : '{{ route("exSaveabsenall") }}',
                    data        : formdata,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success: function (data) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        $('.divhidcover').hide();
                        $('.divumum').show();
                        var status  = data.status;
                        var message = data.message;
                        var warna 	= data.warna;
                        var icon 	= data.icon;
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        swal({
                            title	: status,
                            text	: message,
                            type	: icon,
                        })
                        $("#gridlogaktifitas").jqxGrid('updatebounddata');
                        return false;
                    },
                    error: function (xhr, status, error) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title	: 'Stop',
                            text	: xhr.responseText,
                            type	: 'warning',
                        })
                    }
                });
            }
        });
        $('#topbtnpenilaian').click(function () {
            $('.shadow').hide();
            $('.divnilai').show();
        });
        $('#btnsimpanformnilai').click(function () {
            var set01=document.getElementById('mas_semester').value;
            var set02=document.getElementById('mas_tapel').value;
            var set03=document.getElementById('penilaian_tanggal').value;
             if (set01 == '' || set02 == '0' || set03 == ''){
                swal({
                    title	: 'Mohon di Lengkapi',
                    text	: 'Tanggal, Semester dan Tapel tidak boleh kosong',
                    type	: 'warning',
                })
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData($('#forminputnilai')[0]);
                    formdata.set('_token', '{{ csrf_token() }}');
                    formdata.set('semester', set01);
                    formdata.set('tapel', set02);
                    formdata.set('kelas', '{{ $masterkls }}');
                    formdata.set('identitaskomponen_idsetting', 'kms');
                    formdata.set('identitaskomponen_komponen', 'Menuju Sehat');
                    formdata.set('identitaskomponen_kode', 'kms');
                    formdata.set('identitaskomponen_matpel', set03);
                    formdata.set('identitaskomponen_deskripsi', 'kms');
                    formdata.set('identitaskomponen_idkd', 'kms');
                $.ajax({
                    url         : '{{ route("exInputnilai") }}',
                    data        : formdata,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success: function (data) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        $('.divumum').show();
                        $('.divnilai').hide();
                        var status  = data.status;
                        var message = data.message;
                        var warna 	= data.warna;
                        var icon 	= data.icon;
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        swal({
                            title	: status,
                            text	: message,
                            type	: icon,
                        })
                        $("#gridlogaktifitas").jqxGrid('updatebounddata');
                        return false;
                    },
                    error: function (xhr, status, error) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title	: 'Stop',
                            text	: xhr.responseText,
                            type	: 'warning',
                        })
                    }
                });
            }
        });
        $('.btnrefresh').click(function () {
            var uri = window.location.href.split("#")[0];
            window.location=uri
        });
        var sourcenilai = {
            datatype: "json",
            datafields: [
                { name: 'id',type: 'text'},
                { name: 'nama',type: 'text'},
                { name: 'kelas',type: 'text'},
                { name: 'tapel',type: 'text'},
                { name: 'semester',type: 'text'},
                { name: 'tema',type: 'text'},
                { name: 'subtema',type: 'text'},
                { name: 'kodekd',type: 'text'},
                { name: 'matpel',type: 'text'},
                { name: 'tanggal',type: 'text'},
                { name: 'jennilai',type: 'text'},
                { name: 'marking',type: 'text'},
            ],
            url     : '{{ route("jsonLognilai") }}',
            cache   : false,
        };
        var datanilai = new $.jqx.dataAdapter(sourcenilai);
        $("#gridlogaktifitas").jqxGrid({
            width           : '100%',
            columnsresize   : true,
            theme           : "energyblue",
            autoheight      : true,
            altrows         : true,
            filterable      : true,
            showfilterrow   : true,
            source          : datanilai,
            sortable        : true,
            pageable        : true,
            columns         : [
                { text: 'JENIS', datafield: 'jennilai', width: '20%', cellsalign: 'left', align: 'center'},
                { text: 'Tanggal', datafield: 'tanggal', width: '15%', align: 'center' },
                { text: 'TAPEL', datafield: 'tapel', width: '15%', cellsalign: 'center', align: 'center'},
                { text: 'SMT', datafield: 'semester', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'KELAS', datafield: 'kelas', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'MATPEL', datafield: 'matpel', width: '25%', cellsalign: 'left', align: 'center'},
                { text: 'Materi', datafield: 'kodekd', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'EDIT', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
                    return "EDIT";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridlogaktifitas").offset();
                        var dataRecord 	= $("#gridlogaktifitas").jqxGrid('getrowdata', editrow);
                        if (dataRecord.jennilai == 'Biodata Rapot' || dataRecord.jennilai == 'Ujian Al Quran'){
                            swal({
                                title	: 'Stop',
                                text	: 'Untuk edit data ini, silahkan ulangi pengisian dari laman Penilaian',
                                type	: 'error',
                            })
                        } else if (dataRecord.jennilai == 'Presensi Kelas'){
                            var sourcedatacaripresensi = {
                                datatype: "json",
                                datafields: [
                                    { name: 'id',type: 'text'},	
                                    { name: 'nama',type: 'text'},
                                    { name: 'noinduk',type: 'text'},
                                    { name: 'tanggal',type: 'text'},
                                    { name: 'alasan',type: 'text'},
                                    { name: 'inputor',type: 'text'},
                                    { name: 'surat',type: 'text'},
                                    { name: 'tapel',type: 'text'},
                                    { name: 'kelas',type: 'text'},
                                    { name: 'status',type: 'text'},
                                    { name: 'selama',type: 'text'},
                                    { name: 'alasan',type: 'text'},
                                ],
                                type: 'POST',
                                data: {	val01:dataRecord.id, val02: 'pertanggalinput', _token: '{{ csrf_token() }}' },
                                url : '{{ route("jsonPresensicari") }}',	
                            };
                            var jsonPresensiCari = new $.jqx.dataAdapter(sourcedatacaripresensi);
                            $("#gridpresensi").jqxGrid({
                                width           : '100%',   
                                columnsresize   : true,
                                theme           : "energyblue",
                                autoheight      : true,
                                altrows         : true,
                                source          : jsonPresensiCari,
                                columns         : [
                                    { text: 'View', columntype: 'button', width: '10%',  cellsrenderer: function () {
                                        return "Surat";
                                        }, buttonclick: function (row) {	
                                            editrow = row;	
                                            var offset 		= $("#gridpresensi").offset();		
                                            var dataRecord 	= $("#gridpresensi").jqxGrid('getrowdata', editrow);
                                            var set01		= dataRecord.surat;
                                            if (set01 == '' || set01 == null){
                                                swal({
                                                    title	: 'Stop',
                                                    text	: 'Tidak ada Surat di Row Ini',
                                                    type	: 'error',
                                                })
                                            } else {
                                                var url = '{{url('/')}}/suratijinortu/'+dataRecord.id;
                                                window.location.href = url;
                                            }
                                        }
                                    },
                                    { text: 'KLS', datafield: 'kelas', width: '10%', ellsalign: 'center', align: 'center' },
                                    { text: 'Nama', datafield: 'nama', width: '30%', align: 'center' },
                                    { text: 'Tanggal', datafield: 'tanggal', width: '10%', cellsalign: 'left', align: 'center'},
                                    { text: 'Keterangan', datafield: 'alasan', width: '20%', cellsalign: 'left', align: 'center'},	
                                    { text: 'TAPEL', datafield: 'tapel', width: '10%', cellsalign: 'left', align: 'center' },
                                    { text: 'Verifikasi', columntype: 'button', width: '10%', cellsrenderer: function () {
                                        return "Verifikasi";
                                        }, buttonclick: function (row) {	
                                            editrow = row;	
                                            var offset 		= $("#gridpresensi").offset();		
                                            var dataRecord 	= $("#gridpresensi").jqxGrid('getrowdata', editrow);
                                            $("#absen_idpresensi").val(dataRecord.id);		
                                            $("#absen_nama").val(dataRecord.nama);	
                                            $("#absen_pemohon").val(dataRecord.inputor);
                                            $("#absen_tanggal").val(dataRecord.tanggal);
                                            $("#absen_tapel").val(dataRecord.tapel);
                                            $("#absen_kategori").val(dataRecord.status);
                                            $("#absen_selama").val(dataRecord.selama);
                                            CKEDITOR.instances['absen_alasan'].setData(dataRecord.alasan)
                                            $("#modalverifikasipresensi").modal('show');
                                        }
                                    },	
                                ],                
                            });
                            $('#diveditorpresensi').show();
                            $('#diveditornilai').hide();
                            $('#divriwayatrapot').hide();
                            $('#utama').hide();
                        } else if (dataRecord.jennilai == 'Rapot'){
                            var sourcedatacarirapot = {
                                datatype: "json",
                                datafields: [
                                    { name: 'id',type: 'text'},	
                                    { name: 'nama',type: 'text'},
                                    { name: 'noinduk',type: 'text'},
                                    { name: 'semester',type: 'text'},
                                    { name: 'tapel',type: 'text'},
                                    { name: 'kelas',type: 'text'},
                                    { name: 'total',type: 'text'},
                                    { name: 'rangking',type: 'text'},
                                    { name: 'ratarata',type: 'text'},
                                ],
                                type: 'POST',
                                data: {	val01:dataRecord.id, val02: 'pertanggalrapot', _token: '{{ csrf_token() }}' },
                                url : '{{ route("jsonPresensicari") }}',	
                            };
                            var jsonPresensiRapot = new $.jqx.dataAdapter(sourcedatacarirapot);
                            var linkrapotgenerator = function (row, column, value) {
                                var id    = $('#gridriwayatrapot').jqxGrid('getrowdata', row).id;
                                var url     = '<a href="{{url("/")}}/rapot/'+id+'" target="_blank"><span class="badge badge-primary">View</span></a>';
                                return url;
                            }
                            $("#gridriwayatrapot").jqxGrid({
                                width           : '100%',   
                                columnsresize   : true,
                                theme           : "energyblue",
                                autoheight      : true,
                                altrows         : true,
                                source          : jsonPresensiRapot,
                                columns         : [
                                    { text: 'Kelas', datafield: 'kelas', width: '10%', ellsalign: 'center', align: 'center' },
                                    { text: 'Nama', datafield: 'nama', width: '20%', align: 'center' },
                                    { text: 'No Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center'},
                                    { text: 'Semester', datafield: 'semester', width: '10%', cellsalign: 'center', align: 'center'},	
                                    { text: 'TAPEL', datafield: 'tapel', width: '10%', cellsalign: 'center', align: 'center' },
                                    { text: 'Total Nilai', datafield: 'total', width: '10%', cellsalign: 'right', align: 'center' },
                                    { text: 'Rata-Rata', datafield: 'ratarata', width: '10%', cellsalign: 'right', align: 'center' },
                                    { text: 'Rangking', datafield: 'rangking', width: '10%', cellsalign: 'center', align: 'center' },
                                    { text: 'Link Rapot', cellsrenderer: linkrapotgenerator, width: '10%', cellsalign: 'center', align: 'center' },
                                ],
                            });
                            $('#diveditorpresensi').hide();
                            $('#diveditornilai').hide();
                            $('#divriwayatrapot').show();
                            $('#utama').hide();
                        } else {
                            var sourcerinciannilai = {
                                datatype: "json",
                                datafields: [
                                    { name: 'id',type: 'text'},
                                    { name: 'nama',type: 'text'},
                                    { name: 'noinduk',type: 'text'},
                                    { name: 'kelas',type: 'text'},
                                    { name: 'nilai',type: 'text'},
                                    { name: 'tema',type: 'text'},
                                    { name: 'subtema',type: 'text'},
                                    { name: 'deskripsi',type: 'text'},
                                ],
                                type: 'POST',
                                data: {	val01:dataRecord.marking, _token: '{{ csrf_token() }}' },
                                url : '{{ route("jsonRinciannilai") }}',
                            };
                            var datarincianharian = new $.jqx.dataAdapter(sourcerinciannilai);
                            $("#gridnilai").jqxGrid({
                                width: '100%',
                                source: datarincianharian,
                                autoheight: true,
                                theme: "orange",
                                columnsresize: true,
                                selectionmode: 'multiplecellsextended',
                                columns: [
                                    { text: 'Nama', datafield: 'nama', width: '25%', align: 'center' },
                                    { text: 'No.Induk', datafield: 'noinduk', width: '10%', align: 'center' },
                                    { text: 'Kelas', datafield: 'kelas', width: '10%', align: 'center' },
                                    { text: 'Berat Badan', datafield: 'tema', width: '10%', cellsalign: 'center', align: 'center' },
                                    { text: 'Tinggi Badan', datafield: 'subtema', width: '10%', cellsalign: 'center', align: 'center' },
                                    { text: 'Lingkar Kepala', datafield: 'nilai', width: '10%', cellsalign: 'center', align: 'center' },
                                    { text: 'Vitamin/Imunisasi', datafield: 'deskripsi', width: '18%', cellsalign: 'left', align: 'center' },
                                    { text: 'Edit', columntype: 'button', width: '7%', cellsrenderer: function () {
                                        return "edit";
                                        }, buttonclick: function (row) {
                                            editrow = row;
                                            var offset 		= $("#gridnilai").offset();
                                            var dataRecord 	= $("#gridnilai").jqxGrid('getrowdata', editrow);
                                            $("#nil_nama").val(dataRecord.nama);
                                            $("#nil_nis").val(dataRecord.noinduk);
                                            $("#nil_nilai").val(dataRecord.nilai);
                                            $("#nil_tema").val(dataRecord.tema);
                                            $("#nil_subtema").val(dataRecord.subtema);
                                            $("#nil_deskripsi").val(dataRecord.deskripsi);
                                            $("#nil_id").val(dataRecord.id);
                                            $("#modaleditnilai").modal('show');
                                        }
                                    },
                                ]
                            });
                            $('#diveditorpresensi').hide();
                            $('#divriwayatrapot').hide();
                            $('#diveditornilai').show();
                            $('#utama').hide();
                        }
                    }
                },
                { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '5%', cellsrenderer: function () {
                    return "Del";
                    }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridlogaktifitas").offset();		
                        var dataRecord 	= $("#gridlogaktifitas").jqxGrid('getrowdata', editrow);
                        var jenisdata   = dataRecord.jennilai;
                        if (dataRecord.jennilai == 'Biodata Rapot' || dataRecord.jennilai == 'Ujian Al Quran'){
                            swal({
                                title	: 'Stop',
                                text	: 'Data Ini tidak untuk dihapus',
                                type	: 'error',
                            })
                        } else {
                            swal({
                                title: 'Apakah anda yakin ?',
                                text: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonClass: 'btn btn-confirm mt-2',
                                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                confirmButtonText: 'Yes'
                            }).then(function () {
                                var set01		= dataRecord.id;
                                var set02		= 'datanilai';
                                var set03		= '';
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: '{{ csrf_token() }}' },
                                    function(data){					
                                        var status  = data.status;
                                        var message = data.message;
                                        var warna 	= data.warna;
                                        var icon 	= data.icon;
                                        $.toast({
                                            heading: status,
                                            text: message,
                                            position: 'top-right',
                                            loaderBg: warna,
                                            icon: icon,
                                            hideAfter: 5000,
                                            stack: 1
                                        });
                                        $("#gridlogaktifitas").jqxGrid('updatebounddata');
                                        return false;
                                });
                            });
                        }
                    }
                },
            ],
        });
        $('#btnsimpandatadiri').click(function () {
            var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
            var formdata = new FormData($('#forminputdatapribadi')[0]);
                formdata.set('_token', '{{ csrf_token() }}');
                formdata.set('semester', '{{ $smt }}');
                formdata.set('tapel', '{{ $tapel }}');
                formdata.set('kelas', '{{ $masterkls }}');
            $.ajax({
                url         : '{{ route("exInputdatadiri") }}',
                data        : formdata,
                type        : 'POST',
                contentType : false,
                processData : false,
                success: function (data) {
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    $("#komponennilai_id").val('').select2().trigger('change');
                    $('#topbtnpenilaian').click();
                    var status  = data.status;
                    var message = data.message;
                    var warna 	= data.warna;
                    var icon 	= data.icon;
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    swal({
                        title	: status,
                        text	: message,
                        type	: icon,
                    })
                    return false;
                },
                error: function (xhr, status, error) {
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    swal({
                        title	: 'Stop',
                        text	: xhr.responseText,
                        type	: 'warning',
                    })
                }
            });
        });
        $('#btnbuatrapot').click(function () {
            $('#loading').show();
            $('.divkenaikankelas').hide();
            var set02=document.getElementById('kirimrapot_id').value;
            var set03=document.getElementById('idekskul').value;
            var set04=document.getElementById('rapot_tapel').value;
            var set05=document.getElementById('rapot_semester').value;
            var set06=document.getElementById('rapot_tanggal').value;
            $.post('{{ route("ctkBiodatarapot") }}', { val01: 'getraportawal', val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, _token: '{{ csrf_token() }}' },
            function(data){
                
                $('#rapot_perkembangan01').val(data.k02);
                CKEDITOR.instances['rapot_deskripsi01'].setData(data.k03)
                
                $('#rapot_perkembangan02').val(data.k05);
                CKEDITOR.instances['rapot_deskripsi02'].setData(data.k06)
                
                $('#rapot_perkembangan03').val(data.k08);
                CKEDITOR.instances['rapot_deskripsi03'].setData(data.k09)
                
                $('#rapot_perkembangan04').val(data.k11);
                CKEDITOR.instances['rapot_deskripsi04'].setData(data.k12)
                
                $('#rapot_nama').val(data.nama);
                $('#rapot_kelas').val(data.kelas);
                $('#rapot_noinduk').val(data.noinduk);
                $('#rapot_nisn').val(data.nisn);
                $('#rapot_sakit').val(data.sakit);
                $('#rapot_ijin').val(data.ijin);
                $('#rapot_alpha').val(data.alpha);
                $('#rapot_hariefektif').val(data.efektif);
                stepper.to(0)
                $('#loading').hide();
                $('.divkenaikankelas').show();
                $('.rapotpreview').show();
                $("#modalkirimrapot").modal('hide');
                return false;
            });
        });
        $('#topbtnkenaikan').click(function () {
            var set01=document.getElementById('mas_semester').value;
            var set02=document.getElementById('mas_tapel').value;
            if (set01 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom Semester Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom Tahun Pelajaran Terlebih Dahulu',
                    type: 'warning',
                })
            } else {
                $('.shadow').hide();
                $('.divkenaikankelas').show();
                $('.rapotpreview').hide();
            }
        });
        $('#btnsimpan1').click(function () {
            var set01=document.getElementById('rapot_nama').value;
            var set02=document.getElementById('rapot_kelas').value;
            var set03=document.getElementById('rapot_noinduk').value;
            var set04=document.getElementById('rapot_nisn').value;
            var set05=document.getElementById('rapot_tapel').value;
            var set06=document.getElementById('rapot_semester').value;
            var set07=CKEDITOR.instances['rapot_deskripsi01'].getData()
            var set08=CKEDITOR.instances['rapot_deskripsi02'].getData()
            var set09=CKEDITOR.instances['rapot_deskripsi03'].getData()
            var set10=CKEDITOR.instances['rapot_deskripsi04'].getData()
            var set11=document.getElementById('rapot_tanggal').value;
            var set12=document.getElementById('rapot_sakit').value;
            var set13=document.getElementById('rapot_ijin').value;
            var set14=document.getElementById('rapot_alpha').value;
            if (set05 == '' || set06 == '' || set07 == '' || set08 == '' || set09 == '' || set10 == '' || set11 == '' || set12 == '' || set13 == '' || set14 == ''){ 
                swal({
                    title: 'Stop',
                    text: 'Form Isian Wajib di Isi Semua, Adapun Ada Data Yang Tidak di Ketahui Mohon di Beri Tanda 0 (nol) atau - (strip)',
                    type: 'warning',
                })
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData($('#forminputnilaiafektif')[0]);
                    formdata.set('nama',set01);
                    formdata.set('kelas',set02);
                    formdata.set('noinduk',set03);
                    formdata.set('nisn',set04);
                    formdata.set('tapel',set05);
                    formdata.set('semester',set06);
                    formdata.set('deskripsi01',set07);
                    formdata.set('deskripsi02',set08);
                    formdata.set('deskripsi03',set09);
                    formdata.set('deskripsi04',set10);
                    formdata.set('tanggal',set11);
                    formdata.set('sakit',set12);
                    formdata.set('ijin',set13);
                    formdata.set('alpha',set14);
                    formdata.set('val01','getraporttpq');
                    formdata.set('_token', '{{ csrf_token() }}');
                url='{{ route("ctkBiodatarapot") }}';
                $.ajax({
                    type        : 'ajax',
                    url         : url,
                    method      : 'post',
                    data        : formdata,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    dataType    : 'json',
                    success: function(response, status, xhr) {
                        stepper.next()
                        $('#previewrapotkhas').html(response.rapotkhas);
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title: textStatus,
                            text:  jqXHR.responseText,
                            type: 'info',
                        });
                    }
                });
            }
        });
        $('#btnuploadtandatangan').on('click', function (){	
            $('#id_tandatangan').click();
        });
        $('#btnsimpan4').click(function () {
            var tandatangan = document.getElementById('gettandatangan').value;
            var tanggal     = document.getElementById('rapot_tanggal').value;
            if (tandatangan == ''){
                swal({
                    title   : 'Stop',
                    text    : 'Tandatangan Belum di Simpan',
                    type    : 'warning',
                })
            } else {
                var set01=document.getElementById('rapot_nama').value;
                var set02=document.getElementById('rapot_kelas').value;
                var set03=document.getElementById('rapot_noinduk').value;
                var set04=document.getElementById('rapot_nisn').value;
                var set05=document.getElementById('rapot_tapel').value;
                var set06=document.getElementById('rapot_semester').value;
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData();
                    formdata.set('nama',set01);
                    formdata.set('kelas',set02);
                    formdata.set('noinduk',set03);
                    formdata.set('nisn',set04);
                    formdata.set('tapel',set05);
                    formdata.set('semester',set06);
                    formdata.set('tandatangan',tandatangan);
                    formdata.set('tanggal',tanggal);
                    formdata.set('val01','getraportpqakhir');
                    formdata.set('_token', '{{ csrf_token() }}');
                url='{{ route("ctkBiodatarapot") }}';
                $.ajax({
                    type        : 'ajax',
                    url         : url,
                    method      : 'post',
                    data        : formdata,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    dataType    : 'json',
                    success: function(response, status, xhr) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        $('.shadow').hide();
                        $('.divkenaikankelas').show();
                        $('.rapotpreview').hide();
                        var status  = response.status;
                        var message = response.message;
                        var warna 	= response.warna;
                        var icon 	= response.icon;
                        $.toast({
                            heading: status,
                            text: message,
                            position: 'top-right',
                            loaderBg: warna,
                            icon: icon,
                            hideAfter: 5000,
                            stack: 1
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title: textStatus,
                            text:  jqXHR.responseText,
                            type: 'info',
                        });
                    }
                });
            }
        });
    });
</script>
@endpush