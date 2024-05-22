@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Input Nilai Untuk Kelas {{ $setidkelas }}</h1>
            </div>
            <div class="col-sm-6">
                <div class="btn-group">
                    <a class="btn btn-app btn-primary" id="topbtncover" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Presensi"><i class="fa fa-calculator"></i> Presensi</a>
				    <a class="btn btn-app btn-success" id="topbtnpenilaian" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Penilaian"><i class="fa fa-pencil"></i> Penilaian</a>
				    <a class="btn btn-app btn-info" href="{{url('/')}}/tahfidz/{{$setidkelas}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Tahsin, Murojaah, Ziyadah, Tilawah"><i class="fa fa-book"></i> Alquran</a>
                    <a class="btn btn-app btn-danger" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Kenaikan Kelas" id="topbtnkenaikan"><i class="fa fa-trophy"></i> Rapot</a>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="content" >
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
                            <label>Komponen Nilai Yang Akan di isi</label>
                            <select id="komponennilai_id" name="komponennilai_id" class="form-control select2" >
                                <option value="">Pilih Salah Satu</option>
                                @if(isset($arraykomponen) && !empty($arraykomponen))
                                    @foreach($arraykomponen as $rkom)
                                        <option value="{{ $rkom['idsetting'] }}" set01="{{ $rkom['nilaike'] }}" set02="{{ $rkom['idkd'] }}" set03="{{ $rkom['deskripsi'] }}" set04="{{ $rkom['muatan'] }}" set05="{{ $rkom['kodekd'] }}">{{ $rkom['namakomponen'] }} ( {{ $rkom['kodekd'] }} {{ $rkom['muatan'] }} )</option>
                                    @endforeach
                                @endif
                            </select>
						</div>
                        <div class="card-footer">
                            <label>Isi sebelum generate Rapot Semester (setelah PAT)</label>
                            <button type="button" class="btn btn-success" id="btnopendatafisik"><i class="fa fa-users"></i> Data Fisik dan Ekstrakulikuler</button>
                        </div>
                    </div>
                    <div class="card card-danger divkenaikankelas shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> Pilih Siswa</h3>
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
                                            @if ($rsiswa['foto'] == '' OR $$rsiswa['foto'] == null)
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
                                                <a href="javascript:void(0)" class="product-title" onClick="btnprintcover('{{ $rsiswa['noinduk'] }}')">
                                                <span class="badge badge-primary float-right">Print Cover</span></a>
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
                                            <option value="{{ $rjadwal['id'] }}">{{ $rjadwal['matapelajaran'] }} ( {{$rjadwal['tanggal']}} di {{$rjadwal['ruang']}} Jam : {{$rjadwal['jammulai']}}-{{$rjadwal['jamakhir']}} )</option>
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
                                                        <option value="0">Alpha</option>
                                                    @elseif ($rsiswa['statuspresensi'] == 2)
                                                        <option value="1">Hadir</option>
                                                        <option value="2" selected>Ijin</option>
                                                        <option value="3">Sakit</option>
                                                        <option value="0">Alpha</option>
                                                    @elseif ($rsiswa['statuspresensi'] == 3)
                                                        <option value="1">Hadir</option>
                                                        <option value="2">Ijin</option>
                                                        <option value="3" selected>Sakit</option>
                                                        <option value="0">Alpha</option>
                                                    @else
                                                        <option value="1">Hadir</option>
                                                        <option value="2">Ijin</option>
                                                        <option value="3">Sakit</option>
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
                                                <input type="text" name="nilai[{{$i}}][nilainya]" value="0"  class="form-control"/>
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
                                        <th width="6%">Ektrakulikuler 1</th>
                                        <th width="6%">Ektrakulikuler 2</th>
                                        <th width="6%">Ektrakulikuler 3</th>
                                        <th width="6%">Ektrakulikuler 4</th>
                                        <th width="6%">Ektrakulikuler 5</th>
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
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="text" class="form-control" name="nilai[{{$i}}][eks1]" value="{{ $rsiswa['nildeskripsieks1'] }}"/>
                                                    <label class="custom-control-label" for="nilai[{{$i}}][eks1]">{{ $rsiswa['ekstrakulikuler1'] }}</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="text" class="form-control" name="nilai[{{$i}}][eks2]" value="{{ $rsiswa['nildeskripsieks2'] }}"/>
                                                    <label class="custom-control-label" for="nilai[{{$i}}][eks2]">{{ $rsiswa['ekstrakulikuler2'] }}</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="text" class="form-control" name="nilai[{{$i}}][eks3]" value="{{ $rsiswa['nildeskripsieks3'] }}"/>
                                                    <label class="custom-control-label" for="nilai[{{$i}}][eks3]">{{ $rsiswa['ekstrakulikuler3'] }}</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="text" class="form-control" name="nilai[{{$i}}][eks4]" value="{{ $rsiswa['nildeskripsieks4'] }}"/>
                                                    <label class="custom-control-label" for="nilai[{{$i}}][eks4]">{{ $rsiswa['ekstrakulikuler4'] }}</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="text"class="form-control" name="nilai[{{$i}}][eks5]" value="{{ $rsiswa['nildeskripsieks5'] }}"/>
                                                    <label class="custom-control-label" for="nilai[{{$i}}][eks5]">{{ $rsiswa['ekstrakulikuler5'] }}</label>
                                                </div>
                                            </td>
                                            <input type="hidden" name="nilai[{{$i}}][klspos]" value="{!! $rsiswa['klspos'] !!}" />
                                            <input type="hidden" name="nilai[{{$i}}][namanya]" value="{!! $rsiswa['nama'] !!}" />
                                            <input type="hidden" name="nilai[{{$i}}][noinduk]" value="{!! $rsiswa['noinduk'] !!}" />
                                            <input type="hidden" name="nilai[{{$i}}][nisn]" value="{!! $rsiswa['nisn'] !!}" />
                                            <input type="hidden" name="nilai[{{$i}}][alamat]" value="{!! $rsiswa['alamat'] !!}" />
                                            <input type="hidden" name="nilai[{{$i}}][foto]" value="{!! $rsiswa['foto'] !!}" />
                                            <input type="hidden" name="nilai[{{$i}}][ekstrakulikuler1]" value="{{ $rsiswa['ekstrakulikuler1'] }}"/>
                                            <input type="hidden" name="nilai[{{$i}}][ekstrakulikuler2]" value="{{ $rsiswa['ekstrakulikuler2'] }}"/>
                                            <input type="hidden" name="nilai[{{$i}}][ekstrakulikuler3]" value="{{ $rsiswa['ekstrakulikuler3'] }}"/>
                                            <input type="hidden" name="nilai[{{$i}}][ekstrakulikuler4]" value="{{ $rsiswa['ekstrakulikuler4'] }}"/>
                                            <input type="hidden" name="nilai[{{$i}}][ekstrakulikuler5]" value="{{ $rsiswa['ekstrakulikuler5'] }}"/>
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
                            <div id="divpreviewrapot"></div>
						</div>
                        <div class="card-footer rapotpreview">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label>Tanggal Rapot</label>
                                        <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="rapot_tanggal" name="rapot_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                    </div>
                                    @if($masterkls == 6 OR $masterkls == 9 OR $masterkls == 12)
                                        <div class="col-lg-8">
                                            <label for="id_nokelulusan" class="col-form-label">No. Kelulusan :</label>
                                            <input type="text" class="form-control" id="id_nokelulusan">
                                            <input type="hidden" class="form-control" id="id_naikkls">
                                        </div>
                                    @else
                                        <div class="col-lg-8">
                                            <label>Naik / Tinggal Kelas</label>
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
                                            <input type="hidden" class="form-control" id="id_nokelulusan">
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>
						</div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<div class="modal fade" id="modalnaikkelas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tentukan Naik / Tinggal Kelas Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-8">
                            <label>Nama</label>
                            <input type="text" id="id_nama" name="id_nama" class="form-control" disabled="disable">
                        </div>
                        <div class="col-xs-4">
                            <label>NIS</label>
                            <input type="text" id="id_nis" name="id_nis" class="form-control" disabled="disable">
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="idform2" >
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="simpankenaikankelas">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalnaikkelasmulti">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tentukan Naik / Tinggal Kelas Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Naik / Tinggal Kelas Bagi Yang Di Centang</label>
                    <select id="multi_naikkls" name="multi_naikkls" class="form-control" >
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
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpannaikklsmulti">Simpan</button>
            </div>
        </div>
    </div>
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
<input type="hidden" id="mas_semester" name="mas_semester" value="{{ $smt }}">
<input type="hidden" id="mas_tapel" name="mas_tapel" value="{{ $tapel }}">
<input type="hidden" id="mas_niyguru" name="mas_niyguru" value="{{ Session('id') }}">
<input type="hidden" name="idekskul" id="idekskul" value="{{ $masterkls }}">
@endsection
@push('script')
<script>
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
		$('#set_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#absen_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
    function selectasvalue(id){
        $.post('{{ route("ctkBiodatarapot") }}', { val01: 'previewrapot', val02: id, _token: '{{ csrf_token() }}' },
        function(data){
            var iframe  = '<iframe src="'+data.message+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
            $('#divpreviewrapot').html(iframe);
			$('.rapotpreview').show();
            return false;
        });
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
    $(document).ready(function () {
        $('.divnilai').hide();
        $('.divkenaikankelas').hide();
        $('.divhidcover').hide();
        $('#lebokno').hide();
        $('#leboknodatadiri').hide();
        $('.divumum').show();
        $('#diveditorpresensi').hide();
        $('#diveditornilai').hide();
        $('#utama').show();
        $('#btnnaikkelasall').click(function () { $("#modalnaikkelasmulti").modal('show'); });
        $('#btnsimpannaikklsmulti').click(function () {
            var set01=document.getElementById('multi_naikkls').value;
            var rows = $("#gridnilai").jqxGrid('selectedrowindexes');
            var selectedRecords = new Array();
            for (var m = 0; m < rows.length; m++) {
                var row = $("#gridnilai").jqxGrid('getrowdata', rows[m]);
                selectedRecords.push(row.noinduk);
            }
            if (m == 0){
                swal({
                    title: 'Stop',
                    text: 'Centang Siswa Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set01 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Status Naik / Tidak Naik Terlebih Dahulu',
                    type: 'warning',
                })
            } else {
                $.post('{{ route("exMultinaikkls") }}', { val01: set01, val02: selectedRecords, val03: '', _token: '{{ csrf_token() }}' },
                function(data){
                    $("#modalnaikkelasmulti").modal('hide');
                    $("#gridnilai").jqxGrid("updatebounddata");
                    $('#status').html(data);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    return false;
                });
            }
        });
        $('#simpankenaikankelas').click(function () {
            var set01=document.getElementById('id_nis').value;
            var set02=document.getElementById('id_naikkls').value;
            if (set01 == ''){
                swal({
                    title: 'Stop',
                    text: 'Pilih Siswa Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom Naik/Tidak Naik Kelas Terlebih Dahulu',
                    type: 'warning',
                })
            } else {
                $.post('{{ route("exSavenaikkelas") }}', { val01: set01, val02: set02, _token: '{{ csrf_token() }}'  },
                function(data){
                    $("#modalnaikkelas").modal('hide');
                    $("#gridnilai").jqxGrid("updatebounddata");
                    $('#status').html(data);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    return false;
                });
            }
        });
        //new
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
                $('.shadow').hide();
                $('.divnilai').show();
                $('#lebokno').hide();
            }
        });
        $('#btnopendatafisik').click(function () {
            $("#komponennilai_id").val('').select2().trigger('change');
            $('#lebokno').hide();
            $('#leboknodatadiri').show();
        });
        $('#btnboxkembali').click(function () {
            $("#komponennilai_id").val('').select2().trigger('change');
            $('#lebokno').show();
            $('#leboknodatadiri').hide();
        });
        $("#komponennilai_id").on('change', function () {
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
            filtermode      : 'excel',
            source          : datanilai,
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
                        if (dataRecord.jennilai == 'Biodata Rapot'){
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
                            $('#diveditorpresensi').hide();
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
                        if (jenisdata == 'Biodata Rapot'){
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
    });
</script>
@endpush