@php 
    use App\Datakkm;
    $arraymatpel = Datakkm::where('id_sekolah', session('sekolah_id_sekolah'))->where('kelas', $masterkls)->select('kitiga as kkm', 'muatan', 'matpel')->get();

@endphp 
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
                        <a class="btn btn-app btn-success" id="topbtnpenilaian" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Penilaian"><i class="fa fa-pencil"></i> Penilaian</a>
                        <a class="btn btn-app btn-info" href="{{url('/')}}/prestasialquran" data-bs-toggle="tooltip" data-bs-placement="top" title="Tahsin, Murojaah, Ziyadah, Tilawah"><i class="fa fa-book"></i> Alquran</a>
                        <a class="btn btn-app btn-info" href="{{url('/')}}/ujianlisan/{{$setidkelas}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Ujian Lisan"><i class="fa fa-book"></i> Ujian Lisan</a>
                        <a class="btn btn-app btn-danger" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Kenaikan Kelas" id="topbtnkenaikan"><i class="fa fa-trophy"></i> Rapot</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-warning divnilai shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> Pilih Nilai</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Mata Pelajaran</label>
                                <select id="komponennilai_matpel" name="komponennilai_matpel" class="form-control" >
                                    <option value="">Pilih Salah</option>
                                    @if(isset($arraymatpel) && !empty($arraymatpel))
                                        @foreach($arraymatpel as $rmatpel)
                                            @if ($rmatpel['matpel'] == 'Bahasa Arab')
                                                @continue
                                            @endif
                                            <option value="{{$rmatpel['muatan']}}">{{$rmatpel['matpel']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group" id="divkomponennilaiid">
                                <label>Komponen Nilai Yang Akan di isi</label>
                                <select id="komponennilai_id" name="komponennilai_id" class="form-control select2" >
                                    <option value="">Pilih Salah Satu</option>
                                    
                                </select>
                            </div>
                            
						</div>
                        <div class="card-footer">
                            <label>Isi sebelum generate Rapot Semester (setelah PAT)</label>
                            <button type="button" class="btn btn-success btn-block" id="btnopendatafisik"><i class="fa fa-users"></i> Data Fisik dan Ekstrakulikuler</button>
                        </div>
                    </div>
                    <div class="card card-warning divnilai shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> Penilaian Khusus Bahasa Arab</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <label>Pilih Penliaian</label>
                            <select id="komponennilai_idba" name="komponennilai_idba" class="form-control select2" >
                                <option value="">Pilih Salah Satu</option>
                                @if(isset($arraykdba) && !empty($arraykdba))
                                    @foreach($arraykdba as $rkomba)
                                        <option value="{{ $rkomba['idsetting'] }}" set01="{{ $rkomba['nilaike'] }}" set02="{{ $rkomba['idkd'] }}" set03="{{ $rkomba['deskripsi'] }}" set04="{{ $rkomba['muatan'] }}" set05="{{ $rkomba['kodekd'] }}" set06="{{ $rkomba['setidkelas'] }}">{{ $rkomba['deskripsi'] }} ( {{ $rkomba['kodekd'] }} )</option>
                                    @endforeach
                                @endif
                            </select>
						</div>
                    </div>
                    <div class="card card-info divnilai shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> Report</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>TAPEL</label>
                                <input type="text" name="reportkd_tapel" id="reportkd_tapel" class="form-control" value="{{$tapel}}">
                            </div>
                            <div class="form-group">
                                <label>Semester</label>
                                <select id="reportkd_semester" name="reportkd_semester" class="form-control" >
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
                            <div class="form-group">
                                <label>Mata Pelajaran</label>
                                <select id="reportkd_matpel" name="reportkd_matpel" class="form-control" >
                                    <option value="">Pilih Salah</option>
                                    @if(isset($arraymatpel) && !empty($arraymatpel))
                                        @foreach($arraymatpel as $rmatpel)
                                            <option value="{{$rmatpel['muatan']}}">{{$rmatpel['matpel']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
						</div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-info btn-block" id="btnrekapitulasinilaikd"><i class="fa fa-calculator"></i> Rekapitulasi Data Nilai</button>
                            <button type="button" class="btn btn-warning btn-block" id="btnsummaryreport"><i class="fa fa-search"></i> Summary Report</button>
                            <button type="button" class="btn btn-success btn-block" id="btnsummaryreportpermapel"><i class="fa fa-info"></i> Export Nilai Mapel</button>
                            <a class="btn btn-primary btn-block" href="{{url('/')}}/legger/{{$setidkelas}}"><i class="fa fa-print"></i> Legger</a>
                        </div>
                    </div>
                    <div class="card card-danger divkenaikankelas shadow">
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
                        <div class="card-footer kelompokutama" id="diveditorpresensi">
                            <div id="gridpresensi"></div>
						</div>
                        <div class="card-footer kelompokutama" id="diveditornilai">
                            <div id="gridnilai"></div>
						</div>
                        <div class="card-footer kelompokutama" id="divriwayatrapot">
                            <div id="gridriwayatrapot"></div>
						</div>
                        <div class="card-footer kelompokutama" id="divriwayatrapotfisik">
                            <div id="gridriwayatrapotfisik"></div>
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
                                            <option value="{{ $rjadwal->id }}">{{ $rjadwal->matapelajaran }} ( di {{ $rjadwal->ruang }} Jam : {{$rjadwal->jammulai }}to{{$rjadwal->jammulai}} )</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group bilasesuairps">
                                <label>Pilih Materi <font color="red" class="pull-right">*</font></label>
                                <select id="presensi_materi" name="presensi_materi" class="form-control select2">
                                    <option value="">Pilih</option>
                                    <option value="TJ">Tidak Tercantum (Isi Manual)</option>
                                    @if(isset($komponendasar) && !empty($komponendasar))
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
                                    @endif
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
                                        <input value="{{date('Y-m-d')}}" type="text" class="form-control" name="presensi_tanggal" id="presensi_tanggal" disabled="disable"/>
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
                                            @if(isset($ruangans) && !empty($ruangans))
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            @endif
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
                    <div class="card card-warning shadow divnilai" id="lebokno">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-pencil"></i> Input Nilai</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool btnrefresh"><i class="fa fa-backward"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Mata Pelajaran</label>
                                        <input type="text" id="identitaskomponen_matpel" name="identitaskomponen_matpel" class="form-control" disabled="disable">
                                    </div> 
                                    <div class="col-lg-2">
                                        <label>Komponen</label>
                                        <input type="text" id="identitaskomponen_komponen" name="identitaskomponen_komponen" class="form-control" disabled="disable">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Kode</label>
                                        <input type="text" id="identitaskomponen_kode" name="identitaskomponen_kode" class="form-control" disabled="disable">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Deskripsi</label>
                                        <input type="text" id="identitaskomponen_deskripsi" name="identitaskomponen_deskripsi" class="form-control" disabled="disable">
                                        <input type="hidden" id="identitaskomponen_idsetting" name="identitaskomponen_idsetting">
                                        <input type="hidden" id="identitaskomponen_idkd" name="identitaskomponen_idkd">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form id="forminputnilai" method="post" enctype="multipart/form-data">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No.Induk</th>
                                        <th>NAMA</th>
                                        <th>NILAI (Masukkan Angka)</th>
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
                                                <input type="text" name="nilai[{{$i}}][nilainya]" value="0" class="form-control isianpenilaian"/>
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
                            <button class="btn btn-lg btn-success" id="btnsimpanformnilai"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                    <div class="card card-warning shadow divnilai" id="leboknobakelas1">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-pencil"></i> Input Nilai</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool btnrefresh"><i class="fa fa-backward"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Mata Pelajaran</label>
                                        <input type="text" id="ba01identitaskomponen_matpel" name="ba01identitaskomponen_matpel" class="form-control" disabled="disable">
                                    </div> 
                                    <div class="col-lg-2">
                                        <label>Komponen</label>
                                        <input type="text" id="ba01identitaskomponen_komponen" name="ba01identitaskomponen_komponen" class="form-control" disabled="disable">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Kode</label>
                                        <input type="text" id="ba01identitaskomponen_kode" name="ba01identitaskomponen_kode" class="form-control" disabled="disable">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Deskripsi</label>
                                        <input type="text" id="ba01identitaskomponen_deskripsi" name="identitaskomponen_deskripsi" class="form-control" disabled="disable">
                                        <input type="hidden" id="ba01identitaskomponen_idsetting" name="identitaskomponen_idsetting">
                                        <input type="hidden" id="ba01identitaskomponen_idkd" name="identitaskomponen_idkd">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form id="forminputnilai01" method="post" enctype="multipart/form-data">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No.Induk</th>
                                        <th>NAMA</th>
                                        <th>K-1</th>
                                        <th>K-2</th>
                                        <th>K-3</th>
                                        <th>K-4</th>
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
                                                <input type="text" name="nilai[{{$i}}][nilainya]" value="0" class="form-control isianpenilaianba"/>
                                                <input type="hidden" name="nilai[{{$i}}][namanya]" value="{!! $rsiswa['nama'] !!}" />
                                                <input type="hidden" name="nilai[{{$i}}][noinduk]" value="{!! $rsiswa['noinduk'] !!}" />
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][nilainya02]" value="0" class="form-control isianpenilaianba"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][nilainya03]" value="0" class="form-control isianpenilaianba"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][nilainya04]" value="0" class="form-control isianpenilaianba"/>
                                            </td>
                                            @php
                                                $i++;
                                            @endphp
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                            <button class="btn btn-lg btn-success" id="btnsimpanformnilaiba01"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                    <div class="card card-warning shadow divnilai" id="leboknobakelas2">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-pencil"></i> Input Nilai</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool btnrefresh"><i class="fa fa-backward"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Mata Pelajaran</label>
                                        <input type="text" id="ba02identitaskomponen_matpel" name="ba02identitaskomponen_matpel" class="form-control" disabled="disable">
                                    </div> 
                                    <div class="col-lg-2">
                                        <label>Komponen</label>
                                        <input type="text" id="ba02identitaskomponen_komponen" name="ba02identitaskomponen_komponen" class="form-control" disabled="disable">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Kode</label>
                                        <input type="text" id="ba02identitaskomponen_kode" name="ba02identitaskomponen_kode" class="form-control" disabled="disable">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Deskripsi</label>
                                        <input type="text" id="ba02identitaskomponen_deskripsi" name="ba02identitaskomponen_deskripsi" class="form-control" disabled="disable">
                                        <input type="hidden" id="ba02identitaskomponen_idsetting" name="ba02identitaskomponen_idsetting">
                                        <input type="hidden" id="ba02identitaskomponen_idkd" name="ba02identitaskomponen_idkd">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form id="forminputnilai02" method="post" enctype="multipart/form-data">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No.Induk</th>
                                        <th>NAMA</th>
                                        <th>K-1</th>
                                        <th>K-2</th>
                                        <th>K-3</th>
                                        <th>K-4</th>
                                        <th>K-5</th>
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
                                                <input type="text" name="nilai[{{$i}}][nilainya]" value="0" class="form-control isianpenilaianba"/>
                                                <input type="hidden" name="nilai[{{$i}}][namanya]" value="{!! $rsiswa['nama'] !!}" />
                                                <input type="hidden" name="nilai[{{$i}}][noinduk]" value="{!! $rsiswa['noinduk'] !!}" />
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][nilainya02]" value="0" class="form-control isianpenilaianba"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][nilainya03]" value="0" class="form-control isianpenilaianba"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][nilainya04]" value="0" class="form-control isianpenilaianba"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][nilainya05]" value="0" class="form-control isianpenilaianba"/>
                                            </td>
                                            @php
                                                $i++;
                                            @endphp
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                            <button class="btn btn-lg btn-success" id="btnsimpanformnilaiba02"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                    <div class="card card-warning shadow divnilai" id="leboknobakelas3">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-pencil"></i> Input Nilai</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool btnrefresh"><i class="fa fa-backward"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Mata Pelajaran</label>
                                        <input type="text" id="ba03identitaskomponen_matpel" name="ba03identitaskomponen_matpel" class="form-control" disabled="disable">
                                    </div> 
                                    <div class="col-lg-2">
                                        <label>Komponen</label>
                                        <input type="text" id="ba03identitaskomponen_komponen" name="ba03identitaskomponen_komponen" class="form-control" disabled="disable">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Kode</label>
                                        <input type="text" id="ba03identitaskomponen_kode" name="ba03identitaskomponen_kode" class="form-control" disabled="disable">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Deskripsi</label>
                                        <input type="text" id="ba03identitaskomponen_deskripsi" name="ba03identitaskomponen_deskripsi" class="form-control" disabled="disable">
                                        <input type="hidden" id="ba03identitaskomponen_idsetting" name="ba03identitaskomponen_idsetting">
                                        <input type="hidden" id="ba03identitaskomponen_idkd" name="ba03identitaskomponen_idkd">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form id="forminputnilai03" method="post" enctype="multipart/form-data">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No.Induk</th>
                                        <th>NAMA</th>
                                        <th>K-1</th>
                                        <th>K-2</th>
                                        <th>K-3</th>
                                        <th>K-4</th>
                                        <th>K-5</th>
                                        <th>K-6</th>
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
                                                <input type="text" name="nilai[{{$i}}][nilainya]" value="0" class="form-control isianpenilaianba"/>
                                                <input type="hidden" name="nilai[{{$i}}][namanya]" value="{!! $rsiswa['nama'] !!}" />
                                                <input type="hidden" name="nilai[{{$i}}][noinduk]" value="{!! $rsiswa['noinduk'] !!}" />
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][nilainya02]" value="0" class="form-control isianpenilaianba"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][nilainya03]" value="0" class="form-control isianpenilaianba"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][nilainya04]" value="0" class="form-control isianpenilaianba"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][nilainya05]" value="0" class="form-control isianpenilaianba"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][nilainya06]" value="0" class="form-control isianpenilaianba"/>
                                            </td>
                                            @php
                                                $i++;
                                            @endphp
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                            <button class="btn btn-lg btn-success" id="btnsimpanformnilaiba03"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                    <div class="card card-warning shadow divnilai" id="leboknobakelas6">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-pencil"></i> Input Nilai</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool btnrefresh"><i class="fa fa-backward"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Mata Pelajaran</label>
                                        <input type="text" id="ba06identitaskomponen_matpel" name="ba06identitaskomponen_matpel" class="form-control" disabled="disable">
                                    </div> 
                                    <div class="col-lg-2">
                                        <label>Komponen</label>
                                        <input type="text" id="ba06identitaskomponen_komponen" name="ba06identitaskomponen_komponen" class="form-control" disabled="disable">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Kode</label>
                                        <input type="text" id="ba06identitaskomponen_kode" name="ba06identitaskomponen_kode" class="form-control" disabled="disable">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Deskripsi</label>
                                        <input type="text" id="ba06identitaskomponen_deskripsi" name="ba06identitaskomponen_deskripsi" class="form-control" disabled="disable">
                                        <input type="hidden" id="ba06identitaskomponen_idsetting" name="ba06identitaskomponen_idsetting">
                                        <input type="hidden" id="ba06identitaskomponen_idkd" name="ba06identitaskomponen_idkd">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form id="forminputnilai06" method="post" enctype="multipart/form-data">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No.Induk</th>
                                        <th>NAMA</th>
                                        <th>K-1</th>
                                        <th>K-2</th>
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
                                                <input type="text" name="nilai[{{$i}}][nilainya03]" value="0" class="form-control isianpenilaianba"/>
                                                <input type="hidden" name="nilai[{{$i}}][namanya]" value="{!! $rsiswa['nama'] !!}" />
                                                <input type="hidden" name="nilai[{{$i}}][noinduk]" value="{!! $rsiswa['noinduk'] !!}" />
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][nilainya04]" value="0" class="form-control isianpenilaianba"/>
                                            </td>
                                            @php
                                                $i++;
                                            @endphp
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                            <button class="btn btn-lg btn-success" id="btnsimpanformnilaiba06"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                    <div class="card card-success shadow" id="leboknodatadiri">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Input Nilai</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" id="btnboxkembali"><i class="fa fa-backward"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="forminputdatapribadi" method="post" enctype="multipart/form-data">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="7%">No.Induk</th>
                                        <th width="20%">NAMA</th>
                                        <th width="6%">Tinggi Badan Smt 1</th>
                                        <th width="6%">Tinggi Badan Smt 2</th>
                                        <th width="6%">Berat Badan Smt 1</th>
                                        <th width="6%">Berat Badan Smt 2</th>
                                        <th width="6%">Pendengaran</th>
                                        <th width="6%">Penglihatan</th>
                                        <th width="6%">Gigi</th>
                                        <th width="6%">Lainnya</th>
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
                                                <td>{{ $rsiswa['noinduk'] }}</td>
                                                <td>{{ $rsiswa['nama'] }}</td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][tbs1]" class="form-control" value="{{ $rsiswa['tbs1'] }}"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][tbs2]" class="form-control" value="{{ $rsiswa['tbs2'] }}"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][bbs1]" class="form-control" value="{{ $rsiswa['bbs1'] }}"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][bbs2]" class="form-control" value="{{ $rsiswa['bbs2'] }}"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][telinga]" class="form-control"  value="{{ $rsiswa['pendengaran'] }}"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][mata]" class="form-control"  value="{{ $rsiswa['penglihatan'] }}"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][gigi]" class="form-control" value="{{ $rsiswa['gigi'] }}"/>
                                            </td>
                                            <td>
                                                <input type="text" name="nilai[{{$i}}][lainnya]" class="form-control"  value="{{ $rsiswa['kesehatanlain'] }}"/>
                                            </td>
                                            <input type="hidden" name="nilai[{{$i}}][klspos]" value="{!! $rsiswa['klspos'] !!}" />
                                            <input type="hidden" name="nilai[{{$i}}][namanya]" value="{!! $rsiswa['nama'] !!}" />
                                            <input type="hidden" name="nilai[{{$i}}][noinduk]" value="{!! $rsiswa['noinduk'] !!}" />
                                            <input type="hidden" name="nilai[{{$i}}][nisn]" value="{!! $rsiswa['nisn'] !!}" />
                                            <input type="hidden" name="nilai[{{$i}}][alamat]" value="{!! $rsiswa['alamat'] !!}" />
                                            <input type="hidden" name="nilai[{{$i}}][foto]" value="{!! $rsiswa['foto'] !!}" />
                                            @php
                                                $i++;
                                            @endphp
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
						</div>
                        <div class="card-footer">
                            <button class="btn btn-lg btn-success" id="btnsimpandatadiri"><i class="fa fa-save"></i> Simpan</button>
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
                                            <span class="bs-stepper-label">Penilaian Afektif</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#part2">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="part2" id="part2-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Akhlak Mulia</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#part3">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="part3" id="part3-trigger">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Preview Raport Khas</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#part4">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="part4" id="part4-trigger">
                                            <span class="bs-stepper-circle">4</span>
                                            <span class="bs-stepper-label">Preview Raport Dinas</span>
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
                                                    <label for="rapot_kelas">Kelas</label>
                                                    <input type="text" class="form-control" id="rapot_kelas" name="rapot_kelas" readonly>
                                                    <input type="hidden" class="form-control" id="rapot_noinduk" name="rapot_noinduk" readonly>
                                                    <input type="hidden" class="form-control" id="rapot_nisn" name="rapot_nisn" readonly>
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
                                                <div class="form-group row">
                                                    <label class="col-sm-6 col-form-label">Nama Mata Pelajaran</label>
                                                    <div class="col-sm-3">
                                                        KKM
                                                    </div>
                                                    <div class="col-sm-3">
                                                        Nilai Afektif
                                                    </div>
                                                </div>
                                            @php
                                                $indexnilai = 0;
                                            @endphp
                                            @if(isset($arraymatpel) && !empty($arraymatpel))
                                                @foreach($arraymatpel as $rmatpel)
                                                    <div class="form-group row">
                                                        <label for="{{$rmatpel['muatan']}}" class="col-sm-6 col-form-label">{{$rmatpel['matpel']}}:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control isiankkmpelajaran" name="nilaiafektif[{{$indexnilai}}][kkm]" value="{{$rmatpel['kkm']}}">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control isiansikappelajaran" name="nilaiafektif[{{$indexnilai}}][nilai]" placeholder="Nilai Sikap : A/B/C/D">
                                                            <input type="hidden" name="nilaiafektif[{{$indexnilai}}][muatan]" value="{{$rmatpel['muatan']}}" />
                                                            <input type="hidden" name="nilaiafektif[{{$indexnilai}}][matpel]" value="{{$rmatpel['matpel']}}" />                                            
                                                        </div>
                                                    </div>
                                                    @php
                                                        $indexnilai++;
                                                    @endphp
                                                @endforeach
                                            @endif
                                            </form>
                                        </div>
                                        <button class="btn btn-primary" id="btnsimpan1">Next</button>
                                    </div>
                                    <div id="part2" class="content" role="tabpanel" aria-labelledby="part2-trigger">
                                        <div class="card">
                                            <div class="card-body" id="divrapot_akhlak">
                                                <textarea id="rapot_akhlak"></textarea>
                                            </div>
                                            <div class="card-footer">
                                                <div class="form-group">
                                                    <label>Catatan Wali Kelas</label>
                                                    <textarea id="rapot_catatanwalas"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                        <button class="btn btn-primary" id="btnsimpan2">Next</button>
                                    </div>
                                    <div id="part3" class="content" role="tabpanel" aria-labelledby="part3-trigger">
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
                                                                <img src="dist/img/takadagambar.png" alt="image" width="100%" id="previewttd">
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
                                        <button class="btn btn-primary" id="btnsimpan3">Next</button>
                                    </div>
                                    <div id="part4" class="content" role="tabpanel" aria-labelledby="part4-trigger">
                                        <div class="card">
                                            <div class="card-body">
                                                <div id="previewrapotdinas"></div>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        @if($masterkls == 6 OR $masterkls == 9 OR $masterkls == 12)
                                                            @if ($smt == 1)
                                                                <div class="col-lg-8">
                                                                    <label for="id_fase" class="col-form-label">Fase :</label>
                                                                    <input type="text" class="form-control" id="id_fase">
                                                                    <input type="hidden" class="form-control" id="id_nokelulusan">
                                                                    <input type="hidden" class="form-control" id="id_naikkls">
                                                                </div>
                                                            @else 
                                                                <div class="col-lg-3">
                                                                    <label for="id_fase" class="col-form-label">Fase :</label>
                                                                    <input type="text" class="form-control" id="id_fase">
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <label for="id_nokelulusan" class="col-form-label">No. Kelulusan :</label>
                                                                    <input type="text" class="form-control" id="id_nokelulusan">
                                                                    <input type="hidden" class="form-control" id="id_naikkls">
                                                                </div>
                                                            @endif
                                                        @else
                                                            @if ($smt == 1)
                                                                <div class="col-lg-8">
                                                                    <label for="id_fase" class="col-form-label">Fase :</label>
                                                                    <input type="text" class="form-control" id="id_fase">
                                                                    <input type="hidden" class="form-control" id="id_nokelulusan">
                                                                    <input type="hidden" class="form-control" id="id_naikkls">
                                                                </div>
                                                            @else 
                                                                <div class="col-lg-4">
                                                                    <label for="id_fase" class="col-form-label">Fase :</label>
                                                                    <input type="text" class="form-control" id="id_fase">
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label for="id_nokelulusan" class="col-form-label">Naik / Tingggal Kelas:</label>
                                                                    <input type="hidden" class="form-control" id="id_nokelulusan">
                                                                    <select id="id_naikkls" name="id_naikkls" class="form-control" >
                                                                        <option value=""></option>
                                                                        @if(Session('sekolah_level') == 1)
                                                                            <option value="{{$minkelasa}}">{{$minkelasa}}</option>
                                                                            <option value="{{$minkelasb}}">{{$minkelasb}}</option>
                                                                            <option value="{{$minkelasc}}">{{$minkelasc}}</option>
                                                                            <option value="{{$masterklsa}}">{{$masterklsa}}</option>
                                                                            <option value="{{$masterklsb}}">{{$masterklsb}}</option>
                                                                            <option value="{{$masterklsc}}">{{$masterklsc}}</option>
                                                                        @elseif (Session('sekolah_level') == 2)
                                                                            <option value="{{$masterklsa}}">Naik Ke Kelas {{$masterklsa}}</option>
                                                                            <option value="{{$masterklsb}}">Naik Ke Kelas {{$masterklsb}}</option>
                                                                            <option value="{{$masterklsc}}">Naik Ke Kelas {{$masterklsc}}</option>
                                                                            <option value="{{$minkelasa}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasa}}</option>
                                                                            <option value="{{$minkelasb}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasb}}</option>
                                                                            <option value="{{$minkelasc}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasc}}</option>
                                                                        @elseif (Session('sekolah_level') == 3)
                                                                            <option value="{{$masterklsa}}">Naik Ke Kelas {{$masterklsa}}</option>
                                                                            <option value="{{$masterklsb}}">Naik Ke Kelas {{$masterklsb}}</option>
                                                                            <option value="{{$masterklsc}}">Naik Ke Kelas {{$masterklsc}}</option>
                                                                            <option value="{{$masterklsd}}">Naik Ke Kelas {{$masterklsd}}</option>
                                                                            <option value="{{$masterklse}}">Naik Ke Kelas {{$masterklse}}</option>
                                                                            <option value="{{$masterklsf}}">Naik Ke Kelas {{$masterklsf}}</option>
                                                                            <option value="{{$masterklsg}}">Naik Ke Kelas {{$masterklsg}}</option>
                                                                            <option value="{{$masterklsh}}">Naik Ke Kelas {{$masterklsh}}</option>
                                                                            <option value="{{$masterklsi}}">Naik Ke Kelas {{$masterklsi}}</option>
                                                                            <option value="{{$minkelasa}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasa}}</option>
                                                                            <option value="{{$minkelasb}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasb}}</option>
                                                                            <option value="{{$minkelasc}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasc}}</option>
                                                                            <option value="{{$minkelasd}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasd}}</option>
                                                                            <option value="{{$minkelase}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelase}}</option>
                                                                            <option value="{{$minkelasf}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasf}}</option>
                                                                            <option value="{{$minkelasg}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasg}}</option>
                                                                            <option value="{{$minkelash}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelash}}</option>
                                                                            <option value="{{$minkelasi}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasi}}</option>
                                                                        @else
                                                                            <option value="{{$masterklsa}}">Naik Ke Kelas {{$masterklsa}}</option>
                                                                            <option value="{{$masterklsb}}">Naik Ke Kelas {{$masterklsb}}</option>
                                                                            <option value="{{$masterklsc}}">Naik Ke Kelas {{$masterklsc}}</option>
                                                                            <option value="{{$masterklsd}}">Naik Ke Kelas {{$masterklsd}}</option>
                                                                            <option value="{{$masterklse}}">Naik Ke Kelas {{$masterklse}}</option>
                                                                            <option value="{{$masterklsf}}">Naik Ke Kelas {{$masterklsf}}</option>
                                                                            <option value="{{$masterklsg}}">Naik Ke Kelas {{$masterklsg}}</option>
                                                                            <option value="{{$masterklsh}}">Naik Ke Kelas {{$masterklsh}}</option>
                                                                            <option value="{{$masterklsi}}">Naik Ke Kelas {{$masterklsi}}</option>
                                                                            <option value="{{$minkelasa}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasa}}</option>
                                                                            <option value="{{$minkelasb}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasb}}</option>
                                                                            <option value="{{$minkelasc}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasc}}</option>
                                                                            <option value="{{$minkelasd}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasd}}</option>
                                                                            <option value="{{$minkelase}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelase}}</option>
                                                                            <option value="{{$minkelasf}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasf}}</option>
                                                                            <option value="{{$minkelasg}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasg}}</option>
                                                                            <option value="{{$minkelash}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelash}}</option>
                                                                            <option value="{{$minkelasi}}">Tinggal Kelas dan Masuk ke Kelas {{$minkelasi}}</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            @endif
                                                        @endif
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
                    <label>Nilai</label>
                    <input type="text" id="nil_nil" name="nil_nil" class="form-control">
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
                    <p>Sebelum Membuat Rapot Mohon Pastikan Bapak/Ibu Sudah Memastikan Bahwa</p>
                    <ul>
                        <ol>Isi Skrining Kesehatan di <a href="#" id="btnopendatafisik2">Menu Ini</a></ol>
                        <ol>Data Ekstrakurikuler Sudah di Isi di <a href="{{url('penilaianekskul')}}">Menu Ini</a></ol>
                        <ol>Data Prestasi Sudah di Isi di <a href="{{url('prestasisiswa')}}">Menu Ini</a></ol>
                        <ol>Data Nilai Sudah di Input seluruhnya</ol>
                        <ol>Data KKM diambil dari RPS, namun Bapak/Ibu bisa mengedit langsung dari laman rapot setelah ini</ol>
                    </ul>
                </div>
                <div class="form-group">
                    <label for="rapot_tapel">Tapel</label>
                    <input type="text" class="form-control" id="rapot_tapel" name="rapot_tapel" value="{{$tapel}}">
                </div>
                <div class="form-group">
                    <label for="rapot_semester">Semester</label>
                    <select id="rapot_semester" name="rapot_semester" class="form-control" >
                        <option value=""></option>
                        <option value="1.1">PTS Ganjil</option>
                        <option value="1.2">PAS Ganjil</option>
                        <option value="2.1">PTS Genap</option>
                        <option value="2.2">PAS Genap</option>
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
<div class="modal fade" id="modaleditnilaifisik">
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
                            <input type="text" id="nilfisik_nama" name="nilfisik_nama" class="form-control" disabled="disable">
                        </div>
                        <div class="col-lg-2">
                            <label>No.Induk</label>
                            <input type="text" id="nilfisik_nis" name="nilfisik_nis" class="form-control" disabled="disable">
                        </div>
                        <div class="col-lg-2">
                            <label>Tapel</label>
                            <input type="text" id="nilfisik_tapel" name="nilfisik_tapel" class="form-control" disabled="disable">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Tinggi Badan Semester 1</label>
                            <input type="text" id="nilfisik_tbs1" name="nilfisik_tbs1" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label>Tinggi Badan Semester 2</label>
                            <input type="text" id="nilfisik_tbs2" name="nilfisik_tbs2" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Berat Badan Semester 1</label>
                            <input type="text" id="nilfisik_bbs1" name="nilfisik_bbs1" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label>Berat Badan Semester 2</label>
                            <input type="text" id="nilfisik_bbs2" name="nilfisik_bbs2" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pendengaran</label>
                    <input type="text" id="nilfisik_pendengaran" name="nilfisik_pendengaran" class="form-control">
                </div>
                <div class="form-group">
                    <label>Penglihatan</label>
                    <input type="text" id="nilfisik_penglihatan" name="nilfisik_penglihatan" class="form-control">
                </div>
                <div class="form-group">
                    <label>Gigi</label>
                    <input type="text" id="nilfisik_gigi" name="nilfisik_gigi" class="form-control">
                </div>
                <div class="form-group">
                    <label>Kesehatan lainnya</label>
                    <input type="text" id="nilfisik_kesehatanlain" name="nilfisik_kesehatanlain" class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpannilaifisik">Simpan</button>
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
		CKEDITOR.replace( 'rapot_akhlak' );
        CKEDITOR.replace( 'rapot_catatanwalas', {
			toolbarGroups: [{"name":"paragraph","groups":["list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
        CKEDITOR.replace( 'absen_alasan', {
			toolbarGroups: [{"name":"paragraph","groups":["list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
		$('#set_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#absen_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
    function selectasvalue(id){
        $('#kirimrapot_id').val(id);
        $("#modalkirimrapot").modal('show');
    }
    function btnprintopendatadiri(id){
        var url = '{{url('/')}}/viewalldata?id='+id;
        window.location.href = url;
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
    function getAllKomponen( jQuery ){
        var set01=document.getElementById('id_semester').value;
        var set02=document.getElementById('tapel').value;
        var set04=document.getElementById('idekskul').value;
        $.post('{{ route("jsonJadwalRPS") }}', { val01: set01, val02: set02, val03: 'jadwal', val04: set04, _token: '{{ csrf_token() }}' }, function(data){
            if (data && data.length > 0) {
                data.forEach(item => {
                    $('#presensi_jadwal').append(`<option value="${item.id}">${item.matapelajaran} (di ${item.ruang} Jam : ${item.jammulai} to ${item.jammulai} )</option>`);
                });
            } else {
                console.log("Data tidak ditemukan.");
            }
            return false;
        });
        $.post('{{ route("jsonJadwalRPS") }}', { val01: set01, val02: set02, val03: 'ruangans', val04: set04, _token: '{{ csrf_token() }}' }, function(data){
            data.forEach(item => {
                $('#presensi_ruang').append(`<option value="${item.namarg}">${item.namarg} ( ${item.namagd} )</option>`);
            });
            return false;
        });
        $.post('{{ route("jsonJadwalRPS") }}', { val01: set01, val02: set02, val03: 'materi', val04: set04, _token: '{{ csrf_token() }}' }, function(data){
            data.forEach(item => {
                $('#presensi_materi').append(`<option value="${item.id}">${item.deskripsi} (${item.muatan} ${item.kodekd})</option>`);
            });
            return false;
        });
    }
    function getAllKomponenBA( jQuery ){
        var set01=document.getElementById('id_semester').value;
        var set02=document.getElementById('tapel').value;
        var set04=document.getElementById('idekskul').value;
        $.post('{{ route("jsonJadwalRPS") }}', { val01: set01, val02: set02, val03: 'datakdba', val04: set04, _token: '{{ csrf_token() }}' }, function(data){
            var arraykdba       = data.arraykdba;
            arraykdba.forEach(itemarraykdba => {
                $('#komponennilai_idba').append(`<option value="${itemarraykdba.idsetting}" set01="${itemarraykdba.nilaike}" set02="${itemarraykdba.idkd}" set03="${itemarraykdba.deskripsi}" set04="${itemarraykdba.muatan}" set05="${itemarraykdba.kodekd}"  set06="${itemarraykdba.setidkelas}">${itemarraykdba.deskripsi} ( ${itemarraykdba.kodekd} )</option>`);
            });
            return false;
        });
    }
    $(document).ready(function () {
        $('#loading').hide();
        $('.divnilai').hide();
        $('.divkenaikankelas').hide();
        $('.divhidcover').hide();
        $('.kelompokutama').hide();
        $('#lebokno').hide();
        $('#leboknobakelas1').hide();
        $('#leboknobakelas2').hide();
        $('#leboknobakelas3').hide();
        $('#leboknodatadiri').hide();
        $('.divumum').show();
        $('#diveditorpresensi').hide();
        $('#diveditornilai').hide();
        $('#divriwayatrapot').hide();
        $('#utama').show();
        $('#komponennilai_matpel').val('');
        $('#divkomponennilaiid').hide();
        $('#simpaneditnilai').click(function () {
            var set01=document.getElementById('nil_id').value;
            var set02=document.getElementById('nil_nil').value;
            if (set01 == ''){
                swal({
                    title: 'Stop',
                    text: 'Pilih Siswa Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Nilai Terlebih Dahulu',
                    type: 'warning',
                })
            } else {
                $("#modaleditnilai").modal('hide');
                $.post('{{ route("exSaveditnilai") }}', { val01: set01, val02: set02, _token: '{{ csrf_token() }}' },
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
        $("#komponennilai_matpel").on('change', function () {
            var set01=document.getElementById('id_semester').value;
            var set02=document.getElementById('tapel').value;
            var set04=document.getElementById('idekskul').value;
            var set05 = $(this).find('option:selected').attr('value');		
            if (set05 == ''){
                $('#divkomponennilaiid').hide();
            } else {
                $.post('{{ route("jsonJadwalRPS") }}', { val01: set01, val02: set02, val03: 'datakdmulok', val04: set04, val05: set05, _token: '{{ csrf_token() }}' }, function(data){
                    var arraykomponen   = data.arraykomponen;
                    arraykomponen.forEach(itemarraykomponen => {
                        $('#komponennilai_id').append(`<option value="${itemarraykomponen.idsetting}" set01="${itemarraykomponen.nilaike}" set02="${itemarraykomponen.idkd}" set03="${itemarraykomponen.deskripsi}" set04="${itemarraykomponen.muatan}" set05="${itemarraykomponen.kodekd}">${itemarraykomponen.namakomponen} ( ${itemarraykomponen.kodekd} ${itemarraykomponen.muatan} )</option>`);
                    });
                    $('#divkomponennilaiid').show();
                    return false;
                });
            }
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
                $("#komponennilai_id").val('').select2().trigger('change');
                $("#komponennilai_idba").val('').select2().trigger('change');
                $('.shadow').hide();
                $('.divnilai').show();
                $('#lebokno').hide();
                $('#leboknobakelas1').hide();
                $('#leboknobakelas2').hide();
                $('#leboknobakelas3').hide();
            }
        });
        $('#btnsummaryreport').click(function () {
            var set01=document.getElementById('mas_semester').value;
            var set02=document.getElementById('mas_tapel').value;
            var set03=document.getElementById('id_kelas').value;
            var set04=document.getElementById('idekskul').value;
            /*
            var formdata = new FormData();
                formdata.set('semester',set01);
                formdata.set('tapel',set02);
                formdata.set('kelas',set03);
                formdata.set('masterkls',set04);
                formdata.set('val01','summaryreport');
                formdata.set('_token', '{{ csrf_token() }}');
            url='{{ route("ctkBiodatarapot") }}';
            var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                
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

                    var datacari    = response.data;
                    var newWindow   = window.open('', '', 'width=800, height=500'),
                        document    = newWindow.document.open(),
                        pageContent =
                            '<!DOCTYPE html>\n' +
                            '<html>\n' +
                            '<head>\n' +
                            '<meta charset="utf-8" />\n' +
                            '<title>Laporan Nilai Per Kode Semester '+set01+' Tapel '+tapel+'</title>\n' +
                            '</head>\n' +
                            '<body>' + datacari + '</body>\n</html>';
                        document.write(pageContent);
                        document.close();
                        //newWindow.print();
                    return false;
                },
                error: function (xhr, status, error) {
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    var response = xhr.responseJSON || {};
                    var traceText = response.trace ? JSON.stringify(response.trace) : null;
                    swal({
                        title	: response.message || 'Terjadi kesalahan',
                        text	: traceText || xhr.responseText,
                        type	: 'error',
                    })
                }
            });
            */
            var url = '{{url('/')}}/summaryreport?semester='+set01+'?tapel='+set02+'?kelas='+set03+'?mstkelas='+set04;
            window.location.href = url;
        });
        $('#btnsummaryreportpermapel').click(function () {
            var set01=document.getElementById('reportkd_semester').value;
            var set02=document.getElementById('reportkd_tapel').value;
            var set03=document.getElementById('id_kelas').value;
            var set04=document.getElementById('idekskul').value;
            var set05=document.getElementById('reportkd_matpel').value;
            var formdata = new FormData();
                formdata.set('semester',set01);
                formdata.set('tapel',set02);
                formdata.set('kelas',set03);
                formdata.set('masterkls',set04);
                formdata.set('mapel',set05);
                formdata.set('val01','summaryreportpermapel');
                formdata.set('_token', '{{ csrf_token() }}');
            url='{{ route("ctkBiodatarapot") }}';
            var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                
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

                    var datacari    = response.data;
                    var newWindow   = window.open('', '', 'width=800, height=500'),
                        document    = newWindow.document.open(),
                        pageContent =
                            '<!DOCTYPE html>\n' +
                            '<html>\n' +
                            '<head>\n' +
                            '<meta charset="utf-8" />\n' +
                            '<title>Laporan Nilai '+set01+' Tapel '+tapel+'</title>\n' +
                            '</head>\n' +
                            '<body>' + datacari + '</body>\n</html>';
                        document.write(pageContent);
                        document.close();
                        //newWindow.print();
                    return false;
                },
                error: function (xhr, status, error) {
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    var response = xhr.responseJSON || {};
                    var traceText = response.trace ? JSON.stringify(response.trace) : null;
                    swal({
                        title	: response.message || 'Terjadi kesalahan',
                        text	: traceText || xhr.responseText,
                        type	: 'error',
                    })
                }
            });
        });
        $('#btnrekapitulasinilaikd').click(function () {
            var set01=document.getElementById('reportkd_semester').value;
            var set02=document.getElementById('reportkd_tapel').value;
            var set03=document.getElementById('id_kelas').value;
            var set04=document.getElementById('idekskul').value;
            var set05=document.getElementById('reportkd_matpel').value;
            if (set01 == '' || set02 == '' || set05 == ''){
                swal({
                    title	: 'Mohon di Lengkapi',
                    text	: 'Data Yang di Cari tidak boleh kosong',
                    type	: 'warning',
                })
            } else {
                /*
                var formdata = new FormData();
                    formdata.set('semester',set01);
                    formdata.set('tapel',set02);
                    formdata.set('kelas',set03);
                    formdata.set('masterkls',set04);
                    formdata.set('muatan',set05);
                    formdata.set('val01','rekapperkodekd');
                    formdata.set('_token', '{{ csrf_token() }}');
                url='{{ route("ctkBiodatarapot") }}';
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
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
                        var datacari    = response.data;
                        var newWindow   = window.open('', '', 'width=800, height=500'),
                            document    = newWindow.document.open(),
                            pageContent =
                                '<!DOCTYPE html>\n' +
                                '<html>\n' +
                                '<head>\n' +
                                '<meta charset="utf-8" />\n' +
                                '<title>Laporan Nilai Per Kode Semester '+response.semester+' Tapel '+response.tapel+'</title>\n' +
                                '</head>\n' +
                                '<body>' + datacari + '</body>\n</html>';
                            document.write(pageContent);
                            document.close();
                            //newWindow.print();
                        return false;
                    },
                    error: function (xhr, status, error) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        var response = xhr.responseJSON || {};
                        var traceText = response.trace ? JSON.stringify(response.trace) : null;
                        swal({
                            title	: response.message || 'Terjadi kesalahan',
                            text	: traceText || xhr.responseText,
                            type	: 'error',
                        })
                    }
                });
                */
                var url = '{{url('/')}}/rekapperkodekd?muatan='+set05+'?semester='+set01+'?tapel='+set02+'?kelas='+set03+'?mstkelas='+set04;
                window.location.href = url;
            }
        });
        $('#btnopendatafisik').click(function () {
            $("#komponennilai_id").val('').select2().trigger('change');
            $("#komponennilai_idba").val('').select2().trigger('change');
            $('.isianpenilaian').val('0');
            $('#lebokno').hide();
            $('#leboknodatadiri').show();
        });
        $('#btnopendatafisik2').click(function () {
            $('#topbtnpenilaian').click();
            $("#komponennilai_id").val('').select2().trigger('change');
            $("#komponennilai_idba").val('').select2().trigger('change');
            $('.isianpenilaian').val('0');
            $('#lebokno').hide();
            $('#leboknodatadiri').show();
            $('#modalkirimrapot').modal('hide');
        });
        $('#btnboxkembali').click(function () {
            $("#komponennilai_id").val('').select2().trigger('change');
            $("#komponennilai_idba").val('').select2().trigger('change');
            $('#lebokno').show();
            $('#leboknodatadiri').hide();
        });
        $("#komponennilai_id").on('change', function () {
            $('#lebokno').hide();
            $('#leboknobakelas1').hide();
            $('#leboknobakelas2').hide();
            $('#leboknobakelas3').hide();
            $('.isianpenilaian').val('0');
            var idsetting   = $(this).find('option:selected').attr('value');
            var nilaike     = $(this).find('option:selected').attr('set01');
            var idkd        = $(this).find('option:selected').attr('set02');
            var deskripsi   = $(this).find('option:selected').attr('set03');
            var muatan      = $(this).find('option:selected').attr('set04');
            var kodekd      = $(this).find('option:selected').attr('set05');
            if (idsetting == ''){
                $('#lebokno').hide();
                $("#identitaskomponen_deskripsi").val('');
                $("#identitaskomponen_matpel").val('');
                $("#identitaskomponen_komponen").val('');
                $("#identitaskomponen_kode").val('');
                $("#identitaskomponen_idsetting").val('0');
                $("#identitaskomponen_idkd").val('0');
            } else {
                $('#lebokno').show();
                $("#identitaskomponen_deskripsi").val(deskripsi);
                $("#identitaskomponen_matpel").val(muatan);
                $("#identitaskomponen_komponen").val(nilaike);
                $("#identitaskomponen_kode").val(kodekd);
                $("#identitaskomponen_idsetting").val(idsetting);
                $("#identitaskomponen_idkd").val(idkd);
            }
        });
        $("#komponennilai_idba").on('change', function () {
            $('#lebokno').hide();
            $('#leboknobakelas1').hide();
            $('#leboknobakelas2').hide();
            $('#leboknobakelas3').hide();
            $('.isianpenilaianba').val('');
            var idsetting   = $(this).find('option:selected').attr('value');
            var nilaike     = $(this).find('option:selected').attr('set01');
            var idkd        = $(this).find('option:selected').attr('set02');
            var deskripsi   = $(this).find('option:selected').attr('set03');
            var muatan      = $(this).find('option:selected').attr('set04');
            var kodekd      = $(this).find('option:selected').attr('set05');
            var kelas       = $(this).find('option:selected').attr('set06');
            if (idsetting == ''){
                $("#identitaskomponen_deskripsi").val('');
                $("#identitaskomponen_matpel").val('');
                $("#identitaskomponen_komponen").val('');
                $("#identitaskomponen_kode").val('');
                $("#identitaskomponen_idsetting").val('0');
                $("#identitaskomponen_idkd").val('0');
            } else if (idsetting == '0'){
                $('#lebokno').show();
                $("#identitaskomponen_deskripsi").val(deskripsi);
                $("#identitaskomponen_matpel").val(muatan);
                $("#identitaskomponen_komponen").val(nilaike);
                $("#identitaskomponen_kode").val(kodekd);
                $("#identitaskomponen_idsetting").val(idsetting);
                $("#identitaskomponen_idkd").val(idkd);
            } else {
                if (kelas == '1'){
                    $('#leboknobakelas1').show();
                    $("#ba01identitaskomponen_deskripsi").val(deskripsi);
                    $("#ba01identitaskomponen_matpel").val(muatan);
                    $("#ba01identitaskomponen_komponen").val(nilaike);
                    $("#ba01identitaskomponen_kode").val(kodekd);
                    $("#ba01identitaskomponen_idsetting").val(idsetting);
                    $("#ba01identitaskomponen_idkd").val(idkd);
                } else if (kelas == '2'){
                    $('#leboknobakelas2').show();
                    $("#ba02identitaskomponen_deskripsi").val(deskripsi);
                    $("#ba02identitaskomponen_matpel").val(muatan);
                    $("#ba02identitaskomponen_komponen").val(nilaike);
                    $("#ba02identitaskomponen_kode").val(kodekd);
                    $("#ba02identitaskomponen_idsetting").val(idsetting);
                    $("#ba02identitaskomponen_idkd").val(idkd);
                } else if (kelas == '3'){
                    $('#leboknobakelas3').show();
                    $("#ba03identitaskomponen_deskripsi").val(deskripsi);
                    $("#ba03identitaskomponen_matpel").val(muatan);
                    $("#ba03identitaskomponen_komponen").val(nilaike);
                    $("#ba03identitaskomponen_kode").val(kodekd);
                    $("#ba03identitaskomponen_idsetting").val(idsetting);
                    $("#ba03identitaskomponen_idkd").val(idkd);
                } else {
                    $('#leboknobakelas6').show();
                    $("#ba06identitaskomponen_deskripsi").val(deskripsi);
                    $("#ba06identitaskomponen_matpel").val(muatan);
                    $("#ba06identitaskomponen_komponen").val(nilaike);
                    $("#ba06identitaskomponen_kode").val(kodekd);
                    $("#ba06identitaskomponen_idsetting").val(idsetting);
                    $("#ba06identitaskomponen_idkd").val(idkd);
                }
                
            }
        });
        $('#btnsimpanformnilai').click(function () {
            var set01=document.getElementById('mas_semester').value;
            var set02=document.getElementById('mas_tapel').value;
            var set03=document.getElementById('identitaskomponen_idsetting').value;
            var set04=document.getElementById('identitaskomponen_komponen').value;
            var set05=document.getElementById('identitaskomponen_kode').value;
            var set06=document.getElementById('identitaskomponen_matpel').value;
            var set07=document.getElementById('identitaskomponen_deskripsi').value;
            var set08=document.getElementById('identitaskomponen_idkd').value;
            if (set04 == '' || set04 == '0'){
                swal({
                    title	: 'Mohon di Lengkapi',
                    text	: 'Materi tidak boleh kosong',
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
                    formdata.set('identitaskomponen_idsetting', set03);
                    formdata.set('identitaskomponen_komponen', set04);
                    formdata.set('identitaskomponen_kode', set05);
                    formdata.set('identitaskomponen_matpel', set06);
                    formdata.set('identitaskomponen_deskripsi', set07);
                    formdata.set('identitaskomponen_idkd', set08);
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
        $('#btnsimpanformnilaiba01').click(function () {
            var set01=document.getElementById('mas_semester').value;
            var set02=document.getElementById('mas_tapel').value;
            var set03=document.getElementById('ba01identitaskomponen_idsetting').value;
            var set04=document.getElementById('ba01identitaskomponen_komponen').value;
            var set05=document.getElementById('ba01identitaskomponen_kode').value;
            var set06=document.getElementById('ba01identitaskomponen_matpel').value;
            var set07=document.getElementById('ba01identitaskomponen_deskripsi').value;
            var set08=document.getElementById('ba01identitaskomponen_idkd').value;
            if (set04 == '' || set04 == '0'){
                swal({
                    title	: 'Mohon di Lengkapi',
                    text	: 'Materi tidak boleh kosong',
                    type	: 'warning',
                })
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData($('#forminputnilai01')[0]);
                    formdata.set('_token', '{{ csrf_token() }}');
                    formdata.set('semester', set01);
                    formdata.set('tapel', set02);
                    formdata.set('kelas', '{{ $masterkls }}');
                    formdata.set('identitaskomponen_idsetting', set03);
                    formdata.set('identitaskomponen_komponen', set04);
                    formdata.set('identitaskomponen_kode', set05);
                    formdata.set('identitaskomponen_matpel', set06);
                    formdata.set('identitaskomponen_deskripsi', set07);
                    formdata.set('identitaskomponen_idkd', set08);
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
        $('#btnsimpanformnilaiba02').click(function () {
            var set01=document.getElementById('mas_semester').value;
            var set02=document.getElementById('mas_tapel').value;
            var set03=document.getElementById('ba02identitaskomponen_idsetting').value;
            var set04=document.getElementById('ba02identitaskomponen_komponen').value;
            var set05=document.getElementById('ba02identitaskomponen_kode').value;
            var set06=document.getElementById('ba02identitaskomponen_matpel').value;
            var set07=document.getElementById('ba02identitaskomponen_deskripsi').value;
            var set08=document.getElementById('ba02identitaskomponen_idkd').value;
            if (set04 == '' || set04 == '0'){
                swal({
                    title	: 'Mohon di Lengkapi',
                    text	: 'Materi tidak boleh kosong',
                    type	: 'warning',
                })
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData($('#forminputnilai02')[0]);
                    formdata.set('_token', '{{ csrf_token() }}');
                    formdata.set('semester', set01);
                    formdata.set('tapel', set02);
                    formdata.set('kelas', '{{ $masterkls }}');
                    formdata.set('identitaskomponen_idsetting', set03);
                    formdata.set('identitaskomponen_komponen', set04);
                    formdata.set('identitaskomponen_kode', set05);
                    formdata.set('identitaskomponen_matpel', set06);
                    formdata.set('identitaskomponen_deskripsi', set07);
                    formdata.set('identitaskomponen_idkd', set08);
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
        $('#btnsimpanformnilaiba03').click(function () {
            var set01=document.getElementById('mas_semester').value;
            var set02=document.getElementById('mas_tapel').value;
            var set03=document.getElementById('ba03identitaskomponen_idsetting').value;
            var set04=document.getElementById('ba03identitaskomponen_komponen').value;
            var set05=document.getElementById('ba03identitaskomponen_kode').value;
            var set06=document.getElementById('ba03identitaskomponen_matpel').value;
            var set07=document.getElementById('ba03identitaskomponen_deskripsi').value;
            var set08=document.getElementById('ba03identitaskomponen_idkd').value;
            if (set04 == '' || set04 == '0'){
                swal({
                    title	: 'Mohon di Lengkapi',
                    text	: 'Materi tidak boleh kosong',
                    type	: 'warning',
                })
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData($('#forminputnilai03')[0]);
                    formdata.set('_token', '{{ csrf_token() }}');
                    formdata.set('semester', set01);
                    formdata.set('tapel', set02);
                    formdata.set('kelas', '{{ $masterkls }}');
                    formdata.set('identitaskomponen_idsetting', set03);
                    formdata.set('identitaskomponen_komponen', set04);
                    formdata.set('identitaskomponen_kode', set05);
                    formdata.set('identitaskomponen_matpel', set06);
                    formdata.set('identitaskomponen_deskripsi', set07);
                    formdata.set('identitaskomponen_idkd', set08);
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
        $('#btnsimpanformnilaiba06').click(function () {
            var set01=document.getElementById('mas_semester').value;
            var set02=document.getElementById('mas_tapel').value;
            var set03=document.getElementById('ba06identitaskomponen_idsetting').value;
            var set04=document.getElementById('ba06identitaskomponen_komponen').value;
            var set05=document.getElementById('ba06identitaskomponen_kode').value;
            var set06=document.getElementById('ba06identitaskomponen_matpel').value;
            var set07=document.getElementById('ba06identitaskomponen_deskripsi').value;
            var set08=document.getElementById('ba06identitaskomponen_idkd').value;
            if (set04 == '' || set04 == '0'){
                swal({
                    title	: 'Mohon di Lengkapi',
                    text	: 'Materi tidak boleh kosong',
                    type	: 'warning',
                })
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData($('#forminputnilai06')[0]);
                    formdata.set('_token', '{{ csrf_token() }}');
                    formdata.set('semester', set01);
                    formdata.set('tapel', set02);
                    formdata.set('kelas', '{{ $masterkls }}');
                    formdata.set('identitaskomponen_idsetting', set03);
                    formdata.set('identitaskomponen_komponen', set04);
                    formdata.set('identitaskomponen_kode', set05);
                    formdata.set('identitaskomponen_matpel', set06);
                    formdata.set('identitaskomponen_deskripsi', set07);
                    formdata.set('identitaskomponen_idkd', set08);
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
            $('#loading').hide();
            $('.divnilai').hide();
            $('.divkenaikankelas').hide();
            $('.divhidcover').hide();
            $('.kelompokutama').hide();
            $('#lebokno').hide();
            $('#leboknobakelas1').hide();
            $('#leboknobakelas2').hide();
            $('#leboknobakelas3').hide();
            $('#leboknodatadiri').hide();
            $('.divumum').show();
            $('#diveditorpresensi').hide();
            $('#diveditornilai').hide();
            $('#divriwayatrapot').hide();
            $('#utama').show();
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
            pageable        : true,
            sortable        : true,
            columns         : [
                { text: 'JENIS', datafield: 'jennilai', width: '18%', cellsalign: 'left', align: 'center'},
                { text: 'Tanggal', datafield: 'tanggal', width: '10%', align: 'center' },
                { text: 'TAPEL', datafield: 'tapel', width: '10%', cellsalign: 'center', align: 'center'},
                { text: 'SMT', datafield: 'semester', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'KELAS', datafield: 'kelas', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'MATPEL', datafield: 'matpel', width: '25%', cellsalign: 'left', align: 'center'},
                { text: 'KODE', datafield: 'kodekd', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'TEMA', datafield: 'tema', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'SUBTEMA', datafield: 'subtema', width: '7%', cellsalign: 'center', align: 'center'},
                { text: 'EDIT', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
                    return "EDIT";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridlogaktifitas").offset();
                        var dataRecord 	= $("#gridlogaktifitas").jqxGrid('getrowdata', editrow);
                        if (dataRecord.jennilai == 'Ujian Al Quran'){
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
                            $('#utama').hide();
                            $('.kelompokutama').hide();
                            $('#diveditorpresensi').show();
                        } else if (dataRecord.jennilai == 'Rapot' || dataRecord.jennilai == 'Biodata Rapot'){
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
                                    { name: 'tbs1',type: 'text'},
                                    { name: 'bbs1',type: 'text'},
                                    { name: 'tbs2',type: 'text'},
                                    { name: 'bbs2',type: 'text'},
                                    { name: 'pendengaran',type: 'text'},
                                    { name: 'penglihatan',type: 'text'},
                                    { name: 'gigi',type: 'text'},
                                    { name: 'kesehatanlain',type: 'text'},
                                ],
                                type: 'POST',
                                data: {	val01:dataRecord.id, val02: 'pertanggalrapot', val03:dataRecord.jennilai, _token: '{{ csrf_token() }}' },
                                url : '{{ route("jsonPresensicari") }}',	
                            };
                            var jsonPresensiRapot = new $.jqx.dataAdapter(sourcedatacarirapot);
                            $('#utama').hide();
                            $('.kelompokutama').hide();
                            if (dataRecord.jennilai == 'Biodata Rapot'){
                                
                                $("#gridriwayatrapotfisik").jqxGrid({
                                    width           : '100%',
                                    columnsresize   : true,
                                    theme           : "energyblue",
                                    autoheight      : true,
                                    altrows         : true,
                                    source          : jsonPresensiRapot,
                                    columns         : [
                                        { text: 'Edit', columntype: 'button', width: '5%', cellsrenderer: function () {
                                            return "edit";
                                            }, buttonclick: function (row) {
                                                editrow = row;
                                                var offset 		= $("#gridriwayatrapotfisik").offset();
                                                var dataRecord 	= $("#gridriwayatrapotfisik").jqxGrid('getrowdata', editrow);
                                                $("#nilfisik_nama").val(dataRecord.nama);
                                                $("#nilfisik_nis").val(dataRecord.noinduk);
                                                $("#nilfisik_tapel").val(dataRecord.tapel);
                                                $("#nilfisik_tbs1").val(dataRecord.tbs1);
                                                $("#nilfisik_tbs2").val(dataRecord.tbs2);
                                                $("#nilfisik_bbs1").val(dataRecord.bbs1);
                                                $("#nilfisik_bbs2").val(dataRecord.bbs2);
                                                $("#nilfisik_pendengaran").val(dataRecord.pendengaran);
                                                $("#nilfisik_penglihatan").val(dataRecord.penglihatan);
                                                $("#nilfisik_gigi").val(dataRecord.gigi);
                                                $("#nilfisik_kesehatanlain").val(dataRecord.kesehatanlain);
                                                $("#modaleditnilaifisik").modal('show');
                                            }
                                        },
                                        { text: 'Nama', datafield: 'nama', width: '21%', align: 'center' },
                                        { text: 'No Induk', datafield: 'noinduk', width: '5%', cellsalign: 'center', align: 'center'},
                                        { text: 'TAPEL', datafield: 'tapel', width: '5%', cellsalign: 'center', align: 'center' },
                                        { text: 'Tinggi Badan Smt 1', datafield: 'tbs1', width: '8%', cellsalign: 'right', align: 'center' },
                                        { text: 'Tinggi Badan Smt 2', datafield: 'tbs2', width: '8%', cellsalign: 'right', align: 'center' },
                                        { text: 'Berat Badan Smt 1', datafield: 'bbs1', width: '8%', cellsalign: 'right', align: 'center' },
                                        { text: 'Berat Badan Smt 2', datafield: 'bbs2', width: '8%', cellsalign: 'right', align: 'center' },
                                        { text: 'Pendengaran', datafield: 'pendengaran', width: '8%', cellsalign: 'right', align: 'center' },
                                        { text: 'Penglihatan', datafield: 'penglihatan', width: '8%', cellsalign: 'right', align: 'center' },
                                        { text: 'Gigi', datafield: 'gigi', width: '8%', cellsalign: 'right', align: 'center' },
                                        { text: 'Lain-Lain', datafield: 'kesehatanlain', width: '8%', cellsalign: 'right', align: 'center' },
                                    ],
                                });
                                $('#divriwayatrapotfisik').show();
                            } else {
                                var linkrapotgenerator = function (row, column, value) {
                                    var id    = $('#gridriwayatrapot').jqxGrid('getrowdata', row).id;
                                    var url     = '<a href="{{url("/")}}/editorrapot/'+id+'" target="_blank"><span class="badge badge-primary">View</span></a>';
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
                                        { text: 'Edit', cellsrenderer: linkrapotgenerator, width: '10%', cellsalign: 'center', align: 'center' },
                                    ],
                                });
                                $('#divriwayatrapot').show();
                            }
                            
                        } else {
                            var sourcerinciannilai = {
                                datatype: "json",
                                datafields: [
                                    { name: 'id',type: 'text'},
                                    { name: 'nama',type: 'text'},
                                    { name: 'noinduk',type: 'text'},
                                    { name: 'kelas',type: 'text'},
                                    { name: 'nilai',type: 'text'},
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
                                    { text: 'Nama', datafield: 'nama', width: '60%', align: 'center' },
                                    { text: 'No.Induk', datafield: 'noinduk', width: '10%', align: 'center' },
                                    { text: 'Kelas', datafield: 'kelas', width: '10%', align: 'center' },
                                    { text: 'Nilai', datafield: 'nilai', width: '10%', cellsalign: 'center', align: 'center' },
                                    { text: 'Edit', columntype: 'button', width: '10%', cellsrenderer: function () {
                                        return "edit";
                                        }, buttonclick: function (row) {
                                            editrow = row;
                                            var offset 		= $("#gridnilai").offset();
                                            var dataRecord 	= $("#gridnilai").jqxGrid('getrowdata', editrow);
                                            $("#nil_nama").val(dataRecord.nama);
                                            $("#nil_nis").val(dataRecord.noinduk);
                                            $("#nil_nil").val(dataRecord.nilai);
                                            $("#nil_id").val(dataRecord.id);
                                            $("#modaleditnilai").modal('show');
                                        }
                                    },
                                ]
                            });
                            $('#utama').hide();
                            $('.kelompokutama').hide();
                            $('#diveditornilai').show();
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
            var set07=document.getElementById('rapot_sakit').value;
            var set08=document.getElementById('rapot_ijin').value;
            var set09=document.getElementById('rapot_alpha').value;
            var set10=document.getElementById('rapot_hariefektif').value;
            var set11=document.getElementById('rapot_tanggal').value;
            var bolehlanjut = '';
            var inputs      = document.querySelectorAll('.isiansikappelajaran');
                inputs.forEach(function(input) {
                if (input.value.trim() === '') {
                    var bolehlanjut = 'TIDAK';
                }
            });
            if (set05 == '' || set06 == '' || set07 == '' || set08 == '' || set09 == '' || set10 == '' || set11 == ''){
                swal({
                    title: 'Stop',
                    text: 'Form Isian Wajib di Isi Semua, Adapun Ada Data Yang Tidak di Ketahui Mohon di Beri Tanda 0 (nol) atau - (strip)',
                    type: 'warning',
                })
            } else if (bolehlanjut == 'TIDAK'){
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
                    formdata.set('tanggal',set11);
                    formdata.set('sakit',set07);
                    formdata.set('ijin',set08);
                    formdata.set('alpha',set09);
                    formdata.set('val01','getraportdua');
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
                        if (set06 == '1.1' || set06 == '2.1'){
                            $('#divrapot_akhlak').hide();
                        } else {
                            $('#divrapot_akhlak').show();
                        }
                        CKEDITOR.instances['rapot_akhlak'].setData(response.rapotakhlak);
                        CKEDITOR.instances['rapot_catatanwalas'].setData(response.saran);
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    },
                    error: function (xhr, status, error) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        var response = xhr.responseJSON || {};
                        var traceText = response.trace ? JSON.stringify(response.trace) : null;
                        swal({
                            title	: response.message || 'Terjadi kesalahan',
                            text	: traceText || xhr.responseText,
                            type	: 'error',
                        })
                    }
                });
            }
        });
        $('#btnsimpan2').click(function () {
            var teksakhlak  = CKEDITOR.instances['rapot_akhlak'].getData()
            var tekssaran   = CKEDITOR.instances['rapot_catatanwalas'].getData()
            if (teksakhlak == '' || tekssaran == ''){
                swal({
                    title: 'Stop',
                    text: 'Form Isian Wajib di Isi Semua, Adapun Ada Data Yang Tidak di Ketahui Mohon di Beri Tanda 0 (nol) atau - (strip)',
                    type: 'warning',
                })
            } else {
                var set01=document.getElementById('rapot_nama').value;
                var set02=document.getElementById('rapot_kelas').value;
                var set03=document.getElementById('rapot_noinduk').value;
                var set04=document.getElementById('rapot_nisn').value;
                var set05=document.getElementById('rapot_tapel').value;
                var set06=document.getElementById('rapot_semester').value;
                var set07=document.getElementById('rapot_sakit').value;
                var set08=document.getElementById('rapot_ijin').value;
                var set09=document.getElementById('rapot_alpha').value;
                var set10=document.getElementById('rapot_hariefektif').value;
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData();
                    formdata.set('nama',set01);
                    formdata.set('kelas',set02);
                    formdata.set('noinduk',set03);
                    formdata.set('nisn',set04);
                    formdata.set('tapel',set05);
                    formdata.set('semester',set06);
                    formdata.set('rapotakhlak',teksakhlak);
                    formdata.set('saran',tekssaran);
                    formdata.set('sakit',set07);
                    formdata.set('ijin',set08);
                    formdata.set('alpha',set09);
                    formdata.set('efektif',set10);
                    formdata.set('val01','getraporttiga');
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
                        CKEDITOR.instances['rapot_catatanwalas'].setData(response.saran)
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    },
                    error: function (xhr, status, error) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        var response = xhr.responseJSON || {};
                        var traceText = response.trace ? JSON.stringify(response.trace) : null;
                        swal({
                            title	: response.message || 'Terjadi kesalahan',
                            text	: traceText || xhr.responseText,
                            type	: 'error',
                        })
                    }
                });
            }
        });
        $('#btnuploadtandatangan').on('click', function (){	
            $('#id_tandatangan').click();
        });
        $('#btnsimpan3').click(function () {
            var tandatangan = document.getElementById('gettandatangan').value;
            
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
                    formdata.set('val01','getraportempat');
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
                        $('#previewrapotdinas').html(response.rapotdinas);
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    },
                    error: function (xhr, status, error) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        var response = xhr.responseJSON || {};
                        var traceText = response.trace ? JSON.stringify(response.trace) : null;
                        swal({
                            title	: response.message || 'Terjadi kesalahan',
                            text	: traceText || xhr.responseText,
                            type	: 'error',
                        })
                    }
                });
            }
        });
        $('#btnsimpan4').click(function () {
            var fase        = document.getElementById('id_fase').value;
            var nomor       = document.getElementById('id_nokelulusan').value;
            var naikkelas   = document.getElementById('id_naikkls').value;
            var tanggal     = document.getElementById('rapot_tanggal').value;
            if (tanggal == ''){
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
                    formdata.set('fase',fase);
                    formdata.set('nomor',nomor);
                    formdata.set('naikkelas',naikkelas);
                    formdata.set('tanggal',tanggal);
                    formdata.set('val01','getraportlima');
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
                    error: function (xhr, status, error) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        var response = xhr.responseJSON || {};
                        var traceText = response.trace ? JSON.stringify(response.trace) : null;
                        swal({
                            title	: response.message || 'Terjadi kesalahan',
                            text	: traceText || xhr.responseText,
                            type	: 'error',
                        })
                    }
                });
            }
        });
        $('#btnsimpannilaifisik').click(function () {
            var set01=document.getElementById('nilfisik_nama').value;
            var set02=document.getElementById('nilfisik_nis').value;
            var set03=document.getElementById('nilfisik_tapel').value;
            var formdata = new FormData();
                formdata.set('nama',set01);
                formdata.set('noinduk',set02);
                formdata.set('tapel',set03);
                formdata.set('tbs1',document.getElementById('nilfisik_tbs1').value);
                formdata.set('tbs2',document.getElementById('nilfisik_tbs2').value);
                formdata.set('bbs1',document.getElementById('nilfisik_bbs1').value);
                formdata.set('bbs2',document.getElementById('nilfisik_bbs2').value);
                formdata.set('pendengaran',document.getElementById('nilfisik_pendengaran').value);
                formdata.set('penglihatan',document.getElementById('nilfisik_penglihatan').value);
                formdata.set('gigi',document.getElementById('nilfisik_gigi').value);
                formdata.set('kesehatanlain',document.getElementById('nilfisik_kesehatanlain').value);
                formdata.set('val01','editorrapotfisik');
                formdata.set('_token', '{{ csrf_token() }}');
            url='{{ route("ctkBiodatarapot") }}';
            $("#modaleditnilaifisik").modal('hide');
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
                    $("#gridriwayatrapotfisik").jqxGrid('updatebounddata');
                },
                error: function (xhr, status, error) {
                    var response = xhr.responseJSON || {};
                    var traceText = response.trace ? JSON.stringify(response.trace) : null;
                    swal({
                        title	: response.message || 'Terjadi kesalahan',
                        text	: traceText || xhr.responseText,
                        type	: 'error',
                    })
                }
            });
        });
        getAllKomponen();
        getAllKomponenBA();
    });
</script>
@endpush