@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Rencana Pembelajaran</h1>
            </div>
            <div class="col-sm-6">
                <div class="btn-group">
                    <a class="btn btn-app btn-success btnviewdivjadwal" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Jadwal"><i class="fa fa-calendar-check-o"></i> Jadwal</a>
				    <a class="btn btn-app btn-info" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Mata Pelajaran dan KKM" id="btnviewdivkkm"><i class="fa fa-file-text"></i> KKM</a>
                    <a class="btn btn-app btn-warning" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Rencana Pembelajaran" id="btnrps"><i class="fa fa-file-powerpoint-o"></i> RPS</a>
                    <a class="btn btn-app btn-danger" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Legger Setting" id="btnlegger"><i class="fa fa-file-excel-o"></i> Setting Nilai</a>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 divawal divrps">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-file-powerpoint-o"></i> Form Tambah Data Baru</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="form-row">
                                    <label for="add_matkul">Pilih Mata Pelajaran Berdasarkan Data KKM</label>
                                    <div class="input-group">
                                        <select id="add_matkul" name="add_matkul"  class="form-control">
                                            <option value="">Pilih</option>
                                                @php
                                                    $keys = array_keys($matpels);
                                                    for($i = 0; $i < count($matpels); $i++) {
                                                @endphp
                                                        <optgroup label="{{ $kelaslist[$i] }}">
                                                        @php
                                                            foreach($matpels[$keys[$i]] as $key => $value) {
                                                        @endphp
                                                            <option value="{{ $value['id'] }}">{{ $value['matpel'] }}</option>
                                                        @php
                                                            }
                                                        @endphp
                                                        </optgroup>
                                                @php
                                                }
                                                @endphp
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-trophy"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Semester</label>
                                            <select id="add_semester" name="add_semester"  class="form-control">
                                                <option value="1">Ganjil</option>
                                                <option value="2">Genap</option>
                                            </select>
                                        </div> 
                                        <div class="col-lg-4">
                                            <label>Tema</label>
                                            <select id="add_tema" name="add_tema"  class="form-control">
                                                <option value="0">Non Tematik</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Subtema</label>
                                            <select id="add_subtema" name="add_subtema"  class="form-control">
                                                <option value="0">Non Tematik</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Tema</label>
                                    <textarea id="add_deskripsitema" rows="10" cols="80"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Kode KD</label>
                                            <input type="text" id="add_kodekd" class="form-control" placeholder="x.x">
                                        </div> 
                                        <div class="col-lg-6">
                                            <label>KKM</label>
                                            <input type="text" id="add_nilai" class="form-control"  placeholder="hanya angka bulat: 1-100">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Kompetensi Dasar</label>
                                    <textarea id="add_kompetensi" rows="10" cols="80"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Link Materi (optional)</label>
                                    <input type="text" name="add_materi" id="add_materi" class="form-control">
                                </div>
                            </div>
						</div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" id="btntambahrps"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 divawal divrps">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-file-powerpoint-o"></i> Detail</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" title="Print" id="btnexportdatarps"><i class="fa fa-print"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle" id="tabelrps">
                                    <thead>
                                        <tr>
                                            <th>Mata Pelajaran</th>
                                            <th class="text-truncate">Identitas</th>
                                            <th class="text-truncate">Deskripsi Tema</th>
                                            <th class="text-truncate">Deskripsi KD</th>
                                            <th class="cell-fit">Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 divawal divlegger">
                    <div class="card card-success shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-file-excel-o"></i> Pilih Kode Muatan Yang di Pilih</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            Data di bawah ini berasal dari tabel RPS, dan akan menghilang secara otomatis sesuai Tapel dan Semester yang sudah di pilih
						</div>
                        <div class="card-footer">
                            <table class="table table-bordered table-striped products-list product-list-in-card pl-2 pr-2" id="tabelunsignkodekd">
                                <thead>
                                    <tr>
                                        <th>Mata Pelajaran</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 divawal divlegger">
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-file-excel-o"></i> Preview</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" title="Print" id="btnexportlegggger"><i class="fa fa-print"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle" id="tabellegger">
                                    <thead>
                                        <tr>
                                            <td rowspan="3">Matapelajaran</td>
                                            <td colspan="10">Penilaian Proses</td>
                                            <td rowspan="3">PTS</td>
                                            <td rowspan="3">PAT</td>
                                            <td rowspan="3">Action</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Penilaian Harian</td>
                                            <td colspan="5">Evaluasi</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 divawal divkkm">
                    <div class="card card-success shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-file-text"></i> Setting Legger Kolom</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            Silahkan Pilih Kelas Untuk di Tentukan Kurikulum 
							@if(Session('sekolah_level') == 1)
                                <a href="#" id="gradekb"  onClick="jQueryOpenKKM('kb')" class="btn btn-block btn-social btn-primary">
                                    <i class="fa fa-windows"></i> Kelompok Belajar
                                </a>
                                <a href="#" id="gradeta"  onClick="jQueryOpenKKM('ta')" class="btn btn-block btn-social btn-warning">
                                    <i class="fa fa-android"></i> Tarbiyatul Athfal
                                </a>
                            @elseif (Session('sekolah_level') == 2)
                                <a href="#" id="grade1"  onClick="jQueryOpenKKM('1')" class="btn btn-block btn-social btn-info">
                                    <i class="fa fa-windows"></i> Kelas I
                                </a>
                                <a href="#" id="grade2"  onClick="jQueryOpenKKM('2')" class="btn btn-block btn-social btn-danger">
                                    <i class="fa fa-android"></i> Kelas II
                                </a>
                                <a href="#" id="grade3"  onClick="jQueryOpenKKM('3')" class="btn btn-block btn-social btn-success">
                                    <i class="fa fa-apple"></i> Kelas III
                                </a>
                                <a href="#" id="grade4"  onClick="jQueryOpenKKM('4')" class="btn btn-block btn-social btn-primary">
                                    <i class="fa fa-facebook"></i> Kelas IV
                                </a>
                                <a href="#" id="grade5"  onClick="jQueryOpenKKM('5')" class="btn btn-block btn-social btn-warning">
                                    <i class="fa fa-google"></i> Kelas V
                                </a>
                                <a href="#" id="grade6"  onClick="jQueryOpenKKM('6')" class="btn btn-block btn-social btn-info">
                                    <i class="fa fa-twitter"></i> Kelas VI
                                </a>
                            @elseif (Session('sekolah_level') == 3)
                                <a href="#" id="grade7"  onClick="jQueryOpenKKM('7')" class="btn btn-block btn-social btn-danger">
                                    <i class="fa fa-windows"></i> Kelas I
                                </a>
                                <a href="#" id="grade8"  onClick="jQueryOpenKKM('8')" class="btn btn-block btn-social btn-success">
                                    <i class="fa fa-android"></i> Kelas II
                                </a>
                                <a href="#" id="grade9"  onClick="jQueryOpenKKM('9')" class="btn btn-block btn-social btn-primary">
                                    <i class="fa fa-apple"></i> Kelas III
                                </a>
                            @else
                                <a href="#" id="grade10"  onClick="jQueryOpenKKM('10')" class="btn btn-block btn-social btn-warning">
                                    <i class="fa fa-windows"></i> Kelas I
                                </a>
                                <a href="#" id="grade11"  onClick="jQueryOpenKKM('11')" class="btn btn-block btn-social btn-info">
                                    <i class="fa fa-android"></i> Kelas II
                                </a>
                                <a href="#" id="grade12"  onClick="jQueryOpenKKM('12')" class="btn btn-block btn-social btn-danger">
                                    <i class="fa fa-apple"></i> Kelas III
                                </a>
                            @endif
						</div>
                    </div>
                </div>
                <div class="col-lg-9 divawal divkkm">
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-file-text"></i> Preview</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" title="Print" id="btnexportdatakkm"><i class="fa fa-print"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-success" id="btntambahkkm">Tambahkan Data KKM</button>
						</div>
                        <div class="card-footer">
                            <div id="gridkurikulum"></div>
					    </div>
                    </div>
                </div>
                <div class="col-lg-3 divawal divjadwal">
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-calendar-check-o"></i> Setting TAPEL dan Semester</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>TAPEL</label>
                                <input type="text" name="set_tapel" id="set_tapel" class="form-control" value="{{$tapel}}" placeholder="{{date('Y')}}-xxxx">
                                <input type="hidden" name="set_kelas" id="set_kelas" class="form-control" value="{{$setidkelas}}">
                            </div>
                            <div class="form-group">
                                <label>Semester</label>
                                <select id="set_semester" name="set_semester" class="form-control">
                                    <option value=""></option>
                                    @if ($smt == '1')
                                        @php
                                            $msemester = 'Ganjil';
                                        @endphp
                                        <option value="1" selected>Ganjil</option>
                                        <option value="2">Genap</option>
                                    @else
                                        @php
                                            $msemester = 'Genap';
                                        @endphp
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
                <div class="col-lg-9 divawal divjadwal">
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-calendar-check-o"></i> Work Area ( {{ $msemester }} / {{ $tapel }} )</h3>
                            <div class="card-tools divjadwalviewtabel">
                                <button type="button" class="btn btn-tool" title="Print" id="btnexportjadwaltabel"><i class="fa fa-print"></i></button>
                            </div>
                        </div>
                        <div class="card-body divjadwalawal">
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger btn-sm" id="btnaddmatkul"><i class="fa fa-plus"></i> Tambah Jadwal</button>
                                <button type="button" class="btn btn-info btn-sm" id="btnviewformattabel"><i class="fa fa-file-excel-o"></i> View Format Tabel</button>
                            </div>
                        </div>
                        <div class="card-footer divjadwalawal">
                            <div id='gridjadwalkalender'></div>
					    </div>
                        <div class="card-footer divjadwalviewtabel">
                            <button class="btn btn-danger btn-sm btnviewdivjadwal"><i class="fa fa-close"></i> Close</button>
                            <div id='gridjadwaltabel'></div>
					    </div>
                        <div class="card-body divgriddetail">
                            <button class="btn btn-danger btn-sm" id="btnclosedivdetail">
                                <i class="fa fa-close  blue"></i>
                                Close
                            </button>
                            <button class="btn btn-info btn-sm" id="btnexportdata">
                                <i class="fa fa-print  green"></i>
                                Export
                            </button>
                        </div>
                        <div class="card-footer divgriddetail">
                            <div id='griddetail'></div>
					    </div>
                        <div class="card-body divcatatanjadwal">
                            <button class="btn btn-danger btn-sm btnviewdivjadwal">
                                <i class="fa fa-close"></i>
                                Close
                            </button>
                        </div>
                        <div class="card-footer divcatatanjadwal">
                            <div id='idcatatanjadwal'></div>
					    </div>
                        <div class="card-body modaladdmatkul">
                            <form id="formtambahjadwal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <label for="jadwal_matpel">Pilih Mata Pelajaran sesuai Kelas Masing - Masingg<font color="red" class="pull-right">*</font></label>
                                            <div class="input-group">
                                                <select id="jadwal_matpel" name="jadwal_matpel" class="form-control">
                                                    <option value="">Pilih</option>
                                                    @php
                                                        $keys = array_keys($matpels);
                                                        for($i = 0; $i < count($matpels); $i++) {
                                                    @endphp
                                                        <optgroup label="{{ $kelaslist[$i] }}">
                                                        @php
                                                            foreach($matpels[$keys[$i]] as $key => $value) {
                                                        @endphp
                                                            <option value="{{ $value['id'] }}">{{ $value['matpel'] }}</option>
                                                        @php
                                                            }
                                                        @endphp
                                                        </optgroup>
                                                    @php
                                                    }
                                                    @endphp
                                                </select>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-trophy"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>TAPEL <font color="red" class="pull-right">*</font></label>
                                            <input type="text" id="jadwal_tapel" name="jadwal_tapel" class="form-control" value="{{$tapel}}">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Semester <font color="red" class="pull-right">*</font></label>
                                            <select id="jadwal_semester" name="jadwal_semester" class="form-control">
                                                <option value="1">Ganjil</option>
                                                <option value="2">Genap</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>01.Tanggal <font color="red" class="pull-right">*</font></label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal01" name="jadwal_tanggal01" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('01')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai <font color="red" class="pull-right">*</font></label>
                                            <input type="text" id="jadwal_mulai01" name="jadwal_mulai01" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir <font color="red" class="pull-right">*</font></label>
                                            <input type="text" id="jadwal_akhir01" name="jadwal_akhir01" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan <font color="red" class="pull-right">*</font></label>
                                            <select id="jadwal_ruangan01" name="jadwal_ruangan01" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru01" name="jadwal_guru01" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>02.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal02" name="jadwal_tanggal02" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('02')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai02" name="jadwal_mulai02" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir02" name="jadwal_akhir02" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan02" name="jadwal_ruangan02" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru02" name="jadwal_guru02" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>03.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal03" name="jadwal_tanggal03" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('03')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai03" name="jadwal_mulai03" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir03" name="jadwal_akhir03" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan03" name="jadwal_ruangan03" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru03" name="jadwal_guru03" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>04.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal04" name="jadwal_tanggal04" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('04')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai04" name="jadwal_mulai04" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir04" name="jadwal_akhir04" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan04" name="jadwal_ruangan04" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru04" name="jadwal_guru04" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>05.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal05" name="jadwal_tanggal05" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('05')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai05" name="jadwal_mulai05" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir05" name="jadwal_akhir05" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan05" name="jadwal_ruangan05" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru05" name="jadwal_guru05" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>06.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal06" name="jadwal_tanggal06" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('06')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai06" name="jadwal_mulai06" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir06" name="jadwal_akhir06" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan06" name="jadwal_ruangan06" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru06" name="jadwal_guru06" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>07.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal07" name="jadwal_tanggal07" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('07')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai07" name="jadwal_mulai07" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir07" name="jadwal_akhir07" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan07" name="jadwal_ruangan07" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru07" name="jadwal_guru07" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>08.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal08" name="jadwal_tanggal08" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('08')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai08" name="jadwal_mulai08" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir08" name="jadwal_akhir08" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan08" name="jadwal_ruangan08" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div> <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru08" name="jadwal_guru08" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>09.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal09" name="jadwal_tanggal09" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('09')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai09" name="jadwal_mulai09" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir09" name="jadwal_akhir09" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan09" name="jadwal_ruangan09" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru09" name="jadwal_guru09" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>10.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal10" name="jadwal_tanggal10" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('10')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai10" name="jadwal_mulai10" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir10" name="jadwal_akhir10" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan10" name="jadwal_ruangan10" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru10" name="jadwal_guru10" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>11.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal11" name="jadwal_tanggal11" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('11')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai11" name="jadwal_mulai11" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir11" name="jadwal_akhir11" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan11" name="jadwal_ruangan11" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru11" name="jadwal_guru11" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>12.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal12" name="jadwal_tanggal12" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('12')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai12" name="jadwal_mulai12" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir12" name="jadwal_akhir12" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan12" name="jadwal_ruangan12" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru12" name="jadwal_guru12" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>13.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal13" name="jadwal_tanggal13" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('13')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai13" name="jadwal_mulai13" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir13" name="jadwal_akhir13" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan13" name="jadwal_ruangan13" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru13" name="jadwal_guru13" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>14.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal14" name="jadwal_tanggal14" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('14')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai14" name="jadwal_mulai14" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir14" name="jadwal_akhir14" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan14" name="jadwal_ruangan14" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru14" name="jadwal_guru14" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>15.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal15" name="jadwal_tanggal15" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('15')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai15" name="jadwal_mulai15" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir15" name="jadwal_akhir15" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan15" name="jadwal_ruangan15" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru15" name="jadwal_guru15" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>16.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal16" name="jadwal_tanggal16" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('16')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai16" name="jadwal_mulai16" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir16" name="jadwal_akhir16" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan16" name="jadwal_ruangan16" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru16" name="jadwal_guru16" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>17.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal17" name="jadwal_tanggal17" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('17')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai17" name="jadwal_mulai17" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir17" name="jadwal_akhir17" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan17" name="jadwal_ruangan17" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru17" name="jadwal_guru17" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>18.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal18" name="jadwal_tanggal18" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('18')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai18" name="jadwal_mulai18" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir18" name="jadwal_akhir18" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan18" name="jadwal_ruangan18" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru18" name="jadwal_guru18" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>19.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tangggal19" name="jadwal_tangggal19" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('19')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai19" name="jadwal_mulai19" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir19" name="jadwal_akhir19" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan19" name="jadwal_ruangan19" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru19" name="jadwal_guru19" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>20.Tanggal</label>
                                            <div class="input-group date" data-target-input="nearest">
                                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="jadwal_tanggal20" name="jadwal_tanggal20" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><a href="#" onClick="jQueryRemoveValJadwal('20')"><i class="fa fa-minus-square"></i></a></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-2">
                                            <label>Mulai</label>
                                            <input type="text" id="jadwal_mulai20" name="jadwal_mulai20" class="form-control timepicker classjam1">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Akhir</label>
                                            <input type="text" id="jadwal_akhir20" name="jadwal_akhir20" class="form-control timepicker classjam2">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ruangan</label>
                                            <select id="jadwal_ruangan20" name="jadwal_ruangan20" class="form-control classruang">
                                                <option value="">Pilih Ruangan</option>
                                                <option value="Online">Online</option>
                                                <option value="Outing Class">Outing Class</option>
                                                @foreach($ruangans as $rruang)
                                                    <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Guru</label>
                                            <select id="jadwal_guru20" name="jadwal_guru20" class="form-control classguru">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($dataguru as $rguru)
                                                    @if (Session('nip') == $rguru['niy'])
                                                        <option value="{{ $rguru['niy'] }}" selected>{{ $rguru['nama'] }}</option>
                                                    @else
                                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer modaladdmatkul">
                            <input type="hidden" name="jadwal_idne" id="jadwal_idne">
                            <button type="button" class="btn btn-success pull-right" id="btntambahmatkul">Simpan</button>
                            <button type="button" class="btn btn-danger pull-left btnviewdivjadwal">Close</button>	
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<input type="hidden" name="id_kelas" id="id_kelas">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<div class="modal fade" id="editorrps">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Rencana Pembelajaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_matkul">Pilih Mata Pelajaran Berdasarkan Data KKM</label>
                    <input type="text" name="edit_matkul" id="edit_matkul" class="form-control" disabled="disable">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Semester</label>
                            <select id="edit_semester" name="edit_semester" class="form-control">
                                <option value="1">Ganjil</option>
                                <option value="2">Genap</option>
                            </select>
                        </div> 
                        <div class="col-lg-4">
                            <label>Tema</label>
                            <select id="edit_tema" name="edit_tema"  class="form-control">
                                <option value="0">Non Tematik</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label>Subtema</label>
                            <select id="edit_subtema" name="edit_subtema"  class="form-control">
                                <option value="0">Non Tematik</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi Tema</label>
                    <textarea id="edit_deskripsitema" rows="10" cols="80"></textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Kode KD</label>
                            <input type="text" id="edit_kodekd" class="form-control" placeholder="x.x">
                        </div> 
                        <div class="col-lg-6">
                            <label>KKM</label>
                            <input type="text" id="edit_nilai" class="form-control"  placeholder="hanya angka bulat: 1-100">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi Kompetensi Dasar</label>
                    <textarea id="edit_kompetensi" rows="10" cols="80"></textarea>
                </div>
                <div class="form-group">
                    <label>Link Materi (optional)</label>
                    <input type="text" name="edit_materi" id="edit_materi" class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="edit_idne">
                <button type="button" class="btn btn-success pull-left" id="btnsaveupdate">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltambahkkm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Mata Pelajaran dan KKM</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-8">
                            <label>Muatan Matpel</label>
                            <input type="text" id="id_matpel" class="form-control">
                        </div> 
                        <div class="col-lg-4">
                            <label>MUATAN</label>
                            <input type="text" id="id_muatan" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>KI-3</label>
                            <input type="text" id="id_ki3" class="form-control">
                        </div> 
                        <div class="col-lg-4">
                            <label>KI-4</label>
                            <input type="text" id="id_ki4" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="id_idne">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <div id="tomboltambah">
                    <button type="button" class="btn btn-success" id="btnsimpankkm">Simpan</button>	
                </div>
                <div id="tombolupdate">
                    <button type="button" class="btn btn-info" id="btnubahkkm">Update</button>	
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaleditjadwal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editor Jadwal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="masteredit_matkul">Mata Pelajaran</label>
                            <input type="text" class="form-control" id="masteredit_matkul" disabled="disable">
                        </div>			 
                        <div class="col-lg-2">
                            <label for="masteredit_kelas">Kelas</label>
                            <input type="text" class="form-control" id="masteredit_kelas" disabled="disable">
                        </div>
                        <div class="col-lg-2">
                            <label for="masteredit_semester">Semester</label>
                            <input type="text" class="form-control" id="masteredit_semester" disabled="disable">
                        </div>
                        <div class="col-lg-2">
                            <label for="masteredit_tapel">Tapel</label>
                            <input type="text" class="form-control" id="masteredit_tapel" disabled="disable">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">			  
                    <div class="col-lg-4">
                        <label for="masteredit_tanggal">Tanggal</label>
                        <input type="text" class="form-control" id="masteredit_tanggal" disabled="disable">
                    </div>			 
                    <div class="col-lg-4">
                        <label for="masteredit_jam">Jam</label>
                        <input type="text" class="form-control" id="masteredit_jam" disabled="disable">
                    </div>
                    <div class="col-lg-4">
                        <label for="masteredit_ruang">Ruang</label>
                        <input type="text" class="form-control" id="masteredit_ruang" disabled="disable">
                    </div>
                    </div>
                </div>
                <div id="modalawal">
                    <div class="form-group">
                        <div class="row">			  
                            <div class="col-lg-6">
                                <button class="btn btn-white btn-info btn-round btn-block" id="btneditwaktu">
                                    <i class="fa fa-calendar-times-o  blue"></i>
                                    Edit Jadwal dan Guru
                                </button>
                            </div>
                            <div class="col-lg-6">
                                <button class="btn btn-white btn-success btn-round btn-block" id="btneditmateri">
                                    <i class="fa fa-tv  yellow"></i>
                                    Edit Kehadiran dan Materi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modalbodyeditwaktu">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label>Tangggal <font color="red" class="pull-right">*</font></label>
                                <input type="text" class="form-control" id="editjadwal_tanggal" name="editjadwal_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                            </div> 
                            <div class="col-lg-2">
                                <label>Mulai <font color="red" class="pull-right">*</font></label>
                                <input type="text" id="editjadwal_mulai" name="editjadwal_mulai" class="form-control timepicker">
                            </div>
                            <div class="col-lg-2">
                                <label>Akhir <font color="red" class="pull-right">*</font></label>
                                <input type="text" id="editjadwal_akhir01" name="editjadwal_akhir" class="form-control timepicker">
                            </div>
                            <div class="col-lg-3">
                                <label>Ruangan <font color="red" class="pull-right">*</font></label>
                                <select id="editjadwal_ruangan" name="editjadwal_ruangan" class="form-control">
                                    <option value="">Pilih Ruangan</option>
                                    <option value="Online">Online</option>
                                    <option value="Outing Class">Outing Class</option>
                                    @foreach($ruangans as $rruang)
                                        <option value="{{ $rruang['namarg'] }}">{{ $rruang['namarg'] }} ( {{ $rruang['namagd'] }} )</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>Guru</label>
                                <select id="editjadwal_guru" name="editjadwal_guru" class="form-control">
                                    <option value="">Pilih Salah Satu</option>
                                    @foreach($dataguru as $rguru)
                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modalbodyeditmateri">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Guru Yang Hadir</label>
                                <select id="editjadwal_guruhadir" name="editjadwal_guruhadir" class="form-control">
                                    <option value="">Pilih Salah Satu</option>
                                    @foreach($dataguru as $rguru)
                                        <option value="{{ $rguru['niy'] }}">{{ $rguru['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="editmat_materi">Tulis Materi Yang di Rencanakan</label>
                                <input type="text" class="form-control" id="editmat_materi">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="editjad_id">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <div class="modalbodyeditmateri">
                    <button type="button" class="btn btn-success" id="btnupdajadwalbymateri">Simpan</button>	
                </div>
                <div class="modalbodyeditwaktu">
                    <button type="button" class="btn btn-info" id="btnupdajadwalbywaktu">Update</button>	
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltambahsettingnilai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Setting Nilai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-9">
                            <label>Penilaian Harian</label>
                        </div> 
                        <div class="col-lg-3">
                            <select id="legger_penilaianharian" name="legger_penilaianharian" class="form-control">
                                <option value="5">5 Kali</option>
                                <option value="4">4 Kali</option>
                                <option value="3">3 Kali</option>
                                <option value="2">2 Kali</option>
                                <option value="1">1 Kali</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-9">
                            <label>Evaluasi</label>
                        </div> 
                        <div class="col-lg-3">
                            <select id="legger_evaluasi" name="legger_evaluasi" class="form-control">
                                <option value="5">5 Kali</option>
                                <option value="4">4 Kali</option>
                                <option value="3">3 Kali</option>
                                <option value="2">2 Kali</option>
                                <option value="1">1 Kali</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="settingnilai_id">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btntambahsetleggger">Simpan</button>	
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(function () {
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace( 'add_kompetensi', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
		CKEDITOR.replace( 'add_deskripsitema', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
        CKEDITOR.replace( 'edit_kompetensi', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
		CKEDITOR.replace( 'edit_deskripsitema', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
        $('.datemaskinput').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $(".timepicker").timepicker({format: 'HH:mm:ss'});
	});
    function openjadviewKalender( jQuery ){
        var set01   = document.getElementById('set_semester').value;
        var set02   = document.getElementById('set_tapel').value;
        if (set01 == '' || set02 == ''){
            swal({
                    title	: 'Peringatan',
                    text	: 'Mohon Set Semester dan Tapel Bapak/Ibu Terlebih Dahulu untuk melanjutkan',
                    type	: 'info',
                });
        } else {
            $.post('{{ route("jsonJadwalRPS") }}', { val01: set01, val02: set02, val03: 'kalender', _token: '{{ csrf_token() }}' },
            function(data){
                var sourcekalender = {
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'string' },
                        { name: 'description', type: 'string' },
                        { name: 'location', type: 'string' },
                        { name: 'subject', type: 'string' },
                        { name: 'calendar', type: 'string' },
                        { name: 'start', type: 'date' },
                        { name: 'end', type: 'date' }
                    ],
                    id			: 'id',
                    localData	: data
                };
                var datajsonawal = new $.jqx.dataAdapter(sourcekalender);
                $("#gridjadwalkalender").jqxScheduler({
                    date			: new $.jqx.date('todayDate'),
                    width			: '100%',
                    height			: 600,
                    source			: datajsonawal,
                    showLegend		: true,
                    dayNameFormat	: "abbr",
                    view			: 'agendaView',
                    ready: function () {
                        $("#gridjadwalkalender").jqxScheduler('ensureAppointmentVisible', 'id1');
                    },
                    resources:
                    {
                        colorScheme	: "scheme05",
                        orientation	: "vertical",
                        dataField	: "calendar",
                        source		:  new $.jqx.dataAdapter(sourcekalender)
                    },
                    appointmentDataFields:
                    {
                        from		: "start",
                        to			: "end",
                        id			: "id",
                        description	: "description",
                        location	: "place",
                        subject		: "subject",
                        resourceId	: "calendar",
                        readOnly	: "readOnly",
                        style		: "style",
                        status		: "status",
                        tooltip		: "tooltip",
                        timeZone	: "UTC+07:00"
                    },
                    views	:
                    [
                        { type: "dayView", showWeekends: false, timeRuler: { hidden: false } },
                        { type: "weekView", workTime:
                            {
                                fromDayOfWeek: 1,
                                toDayOfWeek: 5,
                                fromHour: 7,
                                toHour: 19
                            }
                        },
                        { type: "agendaView", timeRuler :
                            {
                                formatString : "HH:mm",
                                timeZones  :  [{ id: "UTC+07:00", text: "UTC+07:00" }],
                            }
                        }
                    ]
                });
                return false;
            });
        }
    }
    function openjadviewTabel( jQuery ){
        var set01   = document.getElementById('set_semester').value;
        var set02   = document.getElementById('set_tapel').value;
        if (set01 == '' || set02 == ''){
            swal({
                    title	: 'Peringatan',
                    text	: 'Mohon Set Semester dan Tapel Bapak/Ibu Terlebih Dahulu untuk melanjutkan',
                    type	: 'info',
                });
        } else {
            $.post('{{ route("jsonJadwalRPS") }}', { val01: set01, val02: set02, val03: 'tabel', _token: '{{ csrf_token() }}' },
            function(data){
                var sourcetabel = {
                    datatype: "json",
                    datafields: [
                        { name: 'id' },
                        { name: 'tanggal', type: 'string' },
                        { name: 'jammulai', type: 'string' },
                        { name: 'jamakhir', type: 'string' },
                        { name: 'mulai', type: 'string' },
                        { name: 'akhir', type: 'string' },
                        { name: 'hari', type: 'string' },
                        { name: 'ruang', type: 'string' },
                        { name: 'idmatpel'},
                        { name: 'matapelajaran', type: 'string' },
                        { name: 'kelas', type: 'string' },
                        { name: 'semester', type: 'string' },
                        { name: 'tapel', type: 'string' },
                        { name: 'marking', type: 'string' },
                        { name: 'guruterjadwal', type: 'string' },
                        { name: 'materi', type: 'string' },
                        { name: 'tglkehadiran', type: 'date' },
                        { name: 'guruyanghadir', type: 'string' },
                        { name: 'k1', type: 'string' },
                        { name: 'k2', type: 'string' },
                        { name: 'k3', type: 'string' },
                        { name: 'k4', type: 'string' },
                        { name: 'k5', type: 'string' },
                        { name: 'k6', type: 'string' },
                        { name: 'k7', type: 'string' },
                        { name: 'k8', type: 'string' },
                        { name: 'k9', type: 'string' },
                        { name: 'k10', type: 'string' },
                        { name: 'k11', type: 'string' },
                        { name: 'k12', type: 'string' },
                        { name: 'k13', type: 'string' },
                        { name: 'k14', type: 'string' },
                        { name: 'k15', type: 'string' },
                        { name: 'k16', type: 'string' },
                        { name: 'k17', type: 'string' },
                        { name: 'k18', type: 'string' },
                        { name: 'k19', type: 'string' },
                        { name: 'k20', type: 'string' },
                    ],
                    id			: 'id',
                    localData	: data
                };
                var dataAdapter = new $.jqx.dataAdapter(sourcetabel);
                $("#gridjadwaltabel").jqxGrid({
                    width           : '100%',
                    pageable        : true,
                    autoheight      : true,
                    filterable      : true,
                    showfilterrow   : true,
                    columnsresize   : true,
                    source          : dataAdapter,
                    sortable        : true,
                    columnsresize   : true,
                    theme           : "energyblue",
                    columns: [
                        { text: 'Detail', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                            return "Detail";
                            }, buttonclick: function (row) {	
                                editrow = row;	
                                var offset 		= $("#gridjadwaltabel").offset();		
                                var dataRecord 	= $("#gridjadwaltabel").jqxGrid('getrowdata', editrow);
                                var source      = {
                                    datatype: "json",
                                    datafields: [
                                        { name: 'id' },
                                        { name: 'tanggal', type: 'string' },
                                        { name: 'jammulai', type: 'string' },
                                        { name: 'jamakhir', type: 'string' },
                                        { name: 'mulai', type: 'string' },
                                        { name: 'akhir', type: 'string' },
                                        { name: 'hari', type: 'string' },
                                        { name: 'ruang', type: 'string' },
                                        { name: 'idmatpel'},
                                        { name: 'matapelajaran', type: 'string' },
                                        { name: 'kelas', type: 'string' },
                                        { name: 'semester', type: 'string' },
                                        { name: 'tapel', type: 'string' },
                                        { name: 'marking', type: 'string' },
                                        { name: 'guruterjadwal', type: 'string' },
                                        { name: 'materi', type: 'string' },
                                        { name: 'tglkehadiran', type: 'date' },
                                        { name: 'guruyanghadir', type: 'string' },
                                        { name: 'k1', type: 'string' },
                                        { name: 'k2', type: 'string' },
                                        { name: 'k3', type: 'string' },
                                        { name: 'k4', type: 'string' },
                                        { name: 'k5', type: 'string' },
                                        { name: 'k6', type: 'string' },
                                        { name: 'k7', type: 'string' },
                                        { name: 'k8', type: 'string' },
                                        { name: 'k9', type: 'string' },
                                        { name: 'k10', type: 'string' },
                                        { name: 'k11', type: 'string' },
                                        { name: 'k12', type: 'string' },
                                        { name: 'k13', type: 'string' },
                                        { name: 'k14', type: 'string' },
                                        { name: 'k15', type: 'string' },
                                        { name: 'k16', type: 'string' },
                                        { name: 'k17', type: 'string' },
                                        { name: 'k18', type: 'string' },
                                        { name: 'k19', type: 'string' },
                                        { name: 'k20', type: 'string' },
                                    ],
                                    type: 'POST',
                                    data: {val01: dataRecord.marking, val02: '', val03: 'detailtabel', _token: '{{ csrf_token() }}' },
                                    url : '{{ route("jsonJadwalRPS") }}'
                                };
                                $(".divjadwalawal").hide();
                                $(".divgriddetail").show();
                                $(".divjadwalviewtabel").hide();
                                $(".modaladdmatkul").hide();
                                $(".divcatatanjadwal").hide();
                                var dataAdapter = new $.jqx.dataAdapter(source);
                                $("#griddetail").jqxGrid({
                                    width           : '100%',
                                    filterable      : true,
                                    filtermode      : 'excel',
                                    source          : dataAdapter,
                                    columnsresize   : true,
                                    theme           : "orange",
                                    sortable        : true,		
                                    autoheight      : true,
                                    selectionmode   : 'multiplecellsextended',
                                    columns         : [	
                                        { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                                            return "Edit";
                                            }, buttonclick: function (row) {	
                                                editrow = row;	
                                                var offset 		= $("#griddetail").offset();
                                                var dataRecord 	= $("#griddetail").jqxGrid('getrowdata', editrow);
                                                $("#editjad_id").val(dataRecord.id);
                                                $("#masteredit_matkul").val(dataRecord.matapelajaran);
                                                $("#masteredit_kelas").val(dataRecord.kelas);
                                                $("#masteredit_semester").val(dataRecord.semester);
                                                $("#masteredit_tapel").val(dataRecord.tapel);
                                                $("#masteredit_tanggal").val(dataRecord.tanggal);
                                                $("#masteredit_jam").val(dataRecord.jammulai+'-'+dataRecord.jamakhir);
                                                $("#masteredit_ruang").val(dataRecord.ruang);
                                                $("#editjadwal_tanggal").val(dataRecord.tanggal);
                                                $("#editjadwal_mulai").val(dataRecord.jammulai);
                                                $("#editjadwal_akhir").val(dataRecord.jamakhir);
                                                $("#editjadwal_ruangan").val(dataRecord.ruang);
                                                $("#editjadwal_guru").val(dataRecord.guruterjadwal);
                                                $("#editjadwal_guruhadir").val(dataRecord.guruyanghadir);
                                                $("#editmat_materi").val(dataRecord.materi);
                                                $('.modalbodyeditwaktu').hide();
                                                $('.modalbodyeditsemester').hide();
                                                $('.modalbodyeditdosen').hide();
                                                $('.modalbodyeditjenis').hide();
                                                $('.modalbodyeditmateri').hide();
                                                $("#modalawal").show();
                                                $("#modaleditjadwal").modal('show');
                                            }
                                        },
                                        { text: 'Hari', filtertype: 'checkedlist', datafield: 'hari', width: '6%', cellsalign: 'center', align: 'center' },
                                        { text: 'Tanggal', datafield: 'tanggal', width: '9%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Start', filtertype: 'checkedlist', datafield: 'jammulai', width: '6%', cellsalign: 'center', align: 'center' },
                                        { text: 'End', filtertype: 'checkedlist', datafield: 'jamakhir', width: '6%', cellsalign: 'center', align: 'center' },
                                        { text: 'Ruang', datafield: 'ruang', width: '8%', cellsalign: 'left', align: 'center' },
                                        { text: 'Mata Pelajaran', datafield: 'matapelajaran', width: '20%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Kelas', datafield: 'kelas', width: '6%', cellsalign: 'center', align: 'center'  },
                                        { text: 'Guru Terjadwal', datafield: 'guruterjadwal', width: '15%', cellsalign: 'center', align: 'center'  },
                                        { text: 'Guru Hadir', datafield: 'guruyanghadir', width: '15%', cellsalign: 'center', align: 'center'  },
                                        { text: 'Tgl. Kehadiran', datafield: 'tglkehadiran', width: '9%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Materi yang disampaikan', datafield: 'materi', width: '14%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Delete', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                                            return "Delete";
                                            }, buttonclick: function (row) {
                                                editrow         = row;	
                                                var offset 		= $("#griddetail").offset();
                                                var dataRecord 	= $("#griddetail").jqxGrid('getrowdata', editrow);
                                                swal({
                                                    title			    : "Konfirmasi",
                                                    text			    : "Data yang akan dihapus tidak bisa di kembalikan lagi (undo). Apakah anda yakin.?",
                                                    type			    : 'warning',
                                                    showCancelButton    : true,
                                                    confirmButtonClass  : 'btn btn-confirm mt-2',
                                                    cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                                                    confirmButtonText   : 'Yes, Delete'
                                                }).then(function () {
                                                    $.ajax({
                                                        type		: 'ajax',
                                                        url			: '{{ route("exJadwalRPS") }}',
                                                        method		: 'post',
                                                        data		: {kerja:'removejadwalbyid', val02:dataRecord.id,  _token: '{{ csrf_token() }}'},
                                                        dataType	: 'json',
                                                        success: function(response, status, xhr) {
                                                            swal({
                                                                title	: response.status,
                                                                text	: response.message,
                                                                type	: response.icon,
                                                            });
                                                            $("#griddetail").jqxGrid("updatebounddata");	
                                                        },
                                                        error: function(jqXHR, textStatus, errorThrown) {
                                                            swal({
                                                                title	: textStatus,
                                                                text	: jqXHR.responseText,
                                                                type	: 'info',
                                                            });
                                                        }
                                                    });
                                                });
                                            }
                                        },
                                    ]
                                });	
                            }
                        },
                        { text: 'Hari', filtertype: 'checkedlist', datafield: 'hari', width: '6%', cellsalign: 'center', align: 'center' },
                        { text: 'Tanggal', datafield: 'tanggal', width: '8%', cellsalign: 'center', align: 'center'  },
                        { text: 'Start', filtertype: 'checkedlist', datafield: 'jammulai', width: '6%', cellsalign: 'center', align: 'center' },
                        { text: 'End', filtertype: 'checkedlist', datafield: 'jamakhir', width: '6%', cellsalign: 'center', align: 'center' },
                        { text: 'Ruang', datafield: 'ruang', width: '8%', cellsalign: 'left', align: 'center' },
                        { text: 'Mata Pelajaran', datafield: 'matapelajaran', width: '23%', cellsalign: 'left', align: 'center'  },
                        { text: 'Kelas', filtertype: 'checkedlist', datafield: 'kelas', width: '6%', cellsalign: 'center', align: 'center'  },
                        { text: 'Tapel', filtertype: 'checkedlist', datafield: 'tapel', width: '9%', cellsalign: 'center', align: 'center' },
                        { text: 'Semester', filtertype: 'checkedlist', datafield: 'semester', width: '6%', cellsalign: 'center', align: 'center' },
                        { text: 'Ploting', datafield: 'guruterjadwal', width: '12%', cellsalign: 'left', align: 'center'  },
                        { text: 'Delete', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                            return "Delete";
                            }, buttonclick: function (row) {
                                editrow         = row;	
                                var offset 		= $("#gridjadwaltabel").offset();
                                var dataRecord 	= $("#gridjadwaltabel").jqxGrid('getrowdata', editrow);
                                swal({
                                    title			    : "Konfirmasi",
                                    text			    : "Data yang akan dihapus tidak bisa di kembalikan lagi (undo). Apakah anda yakin.?",
                                    type			    : 'warning',
                                    showCancelButton    : true,
                                    confirmButtonClass  : 'btn btn-confirm mt-2',
                                    cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                                    confirmButtonText   : 'Yes, Delete'
                                }).then(function () {
                                    $.ajax({
                                        type		: 'ajax',
                                        url			: '{{ route("exJadwalRPS") }}',
                                        method		: 'post',
                                        data		: {kerja:'removejadwalbymarking', val02:dataRecord.marking,  _token: '{{ csrf_token() }}'},
                                        dataType	: 'json',
                                        success: function(response, status, xhr) {
                                            swal({
                                                title	: response.status,
                                                text	: response.message,
                                                type	: response.icon,
                                            });
                                            $("#gridjadwaltabel").jqxGrid("updatebounddata");	
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            swal({
                                                title	: textStatus,
                                                text	: jqXHR.responseText,
                                                type	: 'info',
                                            });
                                        }
                                    });
                                });
                            }
                        },
                    ],
                    columngroups: 
                    [
                        { text: 'Jadwal Penugasan Guru Untuk Pembelajaran Pada Minggu Ke :', align: 'center', name: 'pertemuan' }                 
                    ]
                });
                return false;
            });
        }
    }
    function editorrps(id){
        $('#edit_idne').val(id);
        $.post('{{ route("exDatakodekd") }}', { val01: 'getdata', val02: id, _token: '{{ csrf_token() }}' }, function(data){	
            var status = data.status;
            if (status == 'Gagal'){
                swal({
                    title	: data.status,
                    text	: data.message,
                    type	: data.icon,
                });
            } else {
                $("#editorrps").modal('show');
                $('#edit_matkul').val(data.matpel);
                $('#edit_semester').val(data.semester);
                $('#edit_tema').val(data.tema);
                $('#edit_subtema').val(data.subtema);
                CKEDITOR.instances['edit_deskripsitema'].setData(data.deskripsitema)
                CKEDITOR.instances['edit_kompetensi'].setData(data.deskripsi)
                $('#edit_kodekd').val(data.kodekd);
                $('#edit_nilai').val(data.kkm);
                $('#edit_materi').val(data.materi);
                $("html, body").animate({ scrollTop: 0 }, "slow");
                return false;
            }
        });
    }
    function removerps(id){
        swal({
            title			    : "Konfirmasi",
            text			    : "Data yang akan dihapus tidak bisa di kembalikan lagi (undo). Apakah anda yakin.?",
            type			    : 'warning',
            showCancelButton    : true,
            confirmButtonClass  : 'btn btn-confirm mt-2',
            cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
            confirmButtonText   : 'Yes, Delete'
        }).then(function () {
            $.ajax({
                type		: 'ajax',
                url			: '{{ route("exDatakodekd") }}',
                method		: 'post',
                data		: {val01:'remove', val02:id,  _token: '{{ csrf_token() }}'},
                dataType	: 'json',
                success: function(response, status, xhr) {
                    swal({
                        title	: response.status,
                        text	: response.message,
                        type	: response.icon,
                    });
                    $("#tabelrps").DataTable().ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal({
                        title	: textStatus,
                        text	: jqXHR.responseText,
                        type	: 'info',
                    });
                }
            });
        });
    }
    function selectasvalue(id){
        $('#settingnilai_id').val(id);
        $("#modaltambahsettingnilai").modal('show');
    }
    function removesettingnilai(id){
        swal({
            title			    : "Konfirmasi",
            text			    : "Data yang akan dihapus tidak bisa di kembalikan lagi (undo). Apakah anda yakin.?",
            type			    : 'warning',
            showCancelButton    : true,
            confirmButtonClass  : 'btn btn-confirm mt-2',
            cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
            confirmButtonText   : 'Yes, Delete'
        }).then(function () {
            $.ajax({
                type		: 'ajax',
                url			: '{{ route("exDatakodekd") }}',
                method		: 'post',
                data		: {val01:'removesettingnilai', val02:id,  _token: '{{ csrf_token() }}'},
                dataType	: 'json',
                success: function(response, status, xhr) {
                    swal({
                        title	: response.status,
                        text	: response.message,
                        type	: response.icon,
                    });
                    $("#tabelunsignkodekd").DataTable().ajax.reload();
                    $("#tabellegger").DataTable().ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal({
                        title	: textStatus,
                        text	: jqXHR.responseText,
                        type	: 'info',
                    });
                }
            });
        });
    }
    function jQueryRemoveValJadwal(id){
        $("#jadwal_tanggal"+id).val('0000-00-00');
        $("#jadwal_mulai"+id).val('00:00:00');
        $("#jadwal_akhir"+id).val('00:00:00');
        $("#jadwal_ruangan"+id).val('');
        $("#jadwal_guru"+id).val('');
    }
    function jQueryOpenKKM(set01){
        $("#id_kelas").val(set01);
        var source = {
            datatype: "json",
            datafields: [
                { name: 'namamk', type: 'text'},
                { name: 'kelas', type: 'text'},
                { name: 'matpel', type: 'text'},
                { name: 'muatan', type: 'text'},
                { name: 'kitiga', type: 'text'},
                { name: 'kiempat', type: 'text'},
                { name: 'idne', type: 'text'},
            ],
            type: 'POST',
            data: {val01:set01, _token: '{{ csrf_token() }}'},
            url : '{{ route("jsonDatakkm") }}'
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#gridkurikulum").jqxGrid({
            width           : '100%',
            pageable        : false,
            filterable      : true,
            filtermode      : 'excel',
            source          : dataAdapter,
            columnsresize   : true,
            theme           : "energyblue",
            selectionmode   : 'multiplecellsextended',
            columns         : [
                { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridkurikulum").offset();
                        var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                        $("#id_idne").val(dataRecord.idne);
                        $("#id_ki3").val(dataRecord.kitiga);
                        $("#id_ki4").val(dataRecord.kiempat);
                        $("#id_muatan").val(dataRecord.muatan);
                        $("#id_matpel").val(dataRecord.matpel);
                        $('#tomboltambah').hide();
                        $('#tombolupdate').show();
                        $("#modaltambahkkm").modal('show');
                    }
                },
                { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
                    return "Del";
                    }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridkurikulum").offset();
                        var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                        swal({
                            title: 'Apakah anda yakin ?',
                            text: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonClass: 'btn btn-confirm mt-2',
                            cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                            confirmButtonText: 'Yes'
                        }).then(function () {
                            var set01		= dataRecord.idne;
                            var set02		= 'db_kkm';
                            var set03		= '';
                            var token		= document.getElementById('token').value;
                            $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
                                    $("#gridkurikulum").jqxGrid('updatebounddata');
                                    return false;
                            });
                        });
                    }
                },
            ]
        });
    }
    $(document).ready(function () {
        $(".divawal").hide();
        $(".divjadwal").show();
        $(".divgriddetail").hide();
        $(".modaladdmatkul").hide();
        $(".divjadwalawal").show();
        $(".divcatatanjadwal").hide();
        $(".divjadwalviewtabel").hide();
        $('.btnviewdivjadwal').click(function () {
            $(".divawal").hide();
            $(".divjadwal").show();
            $(".divgriddetail").hide();
            $(".modaladdmatkul").hide();
            $(".divjadwalawal").show();
            $(".divcatatanjadwal").hide();
            $(".divjadwalviewtabel").hide();
        });
        $('#btnviewformattabel').click(function () {
            $(".divjadwalviewtabel").show();
            $(".divjadwalawal").hide();
            openjadviewTabel();
        });
        $('#btnaddmatkul').click(function () {
            $(".divawal").hide();
            $(".divjadwal").show();
            $(".divcatatanjadwal").hide();
            $(".divgriddetail").hide();
            $(".modaladdmatkul").show();
            $(".divjadwalawal").hide();
            $('#jadwal_idne').val('new');
        });
        $('#btntambahmatkul').click(function () {
            var set01=document.getElementById('jadwal_matpel').value;
            var set02=document.getElementById('jadwal_tapel').value;
            var set03=document.getElementById('jadwal_semester').value;
            var set04=document.getElementById('jadwal_ruangan01').value;
            var set05=document.getElementById('jadwal_tanggal01').value;
            var set06=document.getElementById('jadwal_mulai01').value;
            var set07=document.getElementById('jadwal_akhir01').value;
            if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set07 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Lengkapi semua isian pada field yang bertanda bintang, apabila ada data yang memang tidak ada mohon memberikan tanda 0 (nol) atau - (strip)',
                    type	: 'error',
                });
            } else {
                var formdata = new FormData($('#formtambahjadwal')[0]);
                    formdata.set('kerja', 'new');
                    formdata.set('_token', '{{ csrf_token() }}');
                    $(".modaladdmatkul").hide();
                $.ajax({
                    url         : '{{ route("exJadwalRPS") }}',
                    data        : formdata,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success: function (data) {
                        var status  = data.status;
                        var message = data.message;
                        var warna 	= data.warna;
                        var icon 	= data.icon;
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $(".divcatatanjadwal").show();
                        $("#idcatatanjadwal").html(message);
                        openjadviewKalender();
                        return false;
                    },
                    error: function (xhr, status, error) {
                        swal({
                            title	: 'Stop',
                            text	: xhr.responseText,
                            type	: 'warning',
                        })
                    }
                });
            }
        });
        $('#btnclosedivdetail').click(function () {
            $(".divgriddetail").hide();
            $(".divjadwalviewtabel").show();
        });
        $('#btnviewdivkkm').click(function () {
            $(".divawal").hide();
            $(".divkkm").show();
        });
        $('#btnrps').click(function () {
            $(".divawal").hide();
            $(".divrps").show();
        });
        $('#btnlegger').click(function () {
            $(".divawal").hide();
            $(".divlegger").show();
        });
        $('#tabelrps').DataTable({
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonDataRPS") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						idmatkul		: document.getElementById('add_matkul').value,
                        search          : data.search.value,
						_token			: '{{ csrf_token() }}'
					},
					type: "POST",
					success: function(res) {
						callback({
							recordsTotal    : res.total,
							recordsFiltered : res.total,
							data            : res.data
						});
					},
				})
			},
			searching	: true,
            autoWidth	: false,
            serverSide  : true,
			columnDefs	: [
				{
					targets				: 0,
					responsivePriority	: 4,
					width				: '270px',
					render		: function (data, type, full, meta) {
						var matpel= full['matpel'],
							muatan= full['muatan'];
						var $rowOutput 	= matpel+'<br />Kode Muatan :'+muatan;
						return $rowOutput;
					}
				},
                {
					targets				: 1,
					responsivePriority	: 4,
					width				: '270px',
					render		: function (data, type, full, meta) {
						var kelas   = full['kelas'],
                            tema    = full['tema'],
                            subtema = full['subtema'],
                            semester= full['semester'],
                            kodekd  = full['kodekd'],
                            kkm     = full['kkm'];
						var $rowOutput 	= 'Kelas/Smt:'+kelas+' ( '+semester+' )<br />Tema / Sub Tema :'+tema+'/'+subtema+'<br />Kode and KKM : '+kodekd+'( '+kkm+' )';
						return $rowOutput;
					}
				},
                {
					targets				: 2,
					responsivePriority	: 4,
					width				: '540px',
					render		: function (data, type, full, meta) {
						deskripsitema= full['deskripsitema'];
						return deskripsitema;
					}
				},
                {
					targets				: 3,
					responsivePriority	: 4,
					width				: '540px',
					render		: function (data, type, full, meta) {
						var deskripsi   = full['deskripsi'],
                            materi      = full['materi'];
                        if (materi == '' || materi == null){
                            $rowOutput = deskripsi;
                        } else {
                            $rowOutput = deskripsi+'<br /><a href="'+materi+'" target="_blank" class="btn btn-primary btn-sm">Link Materi</a>';
                        }
                        return $rowOutput;
					}
				},
                {
					targets		: -1,
					title		: 'Actions',
					width		: '80px',
					orderable	: false,
					render		: function (data, type, full, meta) {
						var $id 	= full['id'];
						return (
						    '<a class="btn btn-app" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" onClick="editorrps('+$id+')"><i class="fa fa-edit"></i></a>' +
						    '<a class="btn btn-app" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" onClick="removerps('+$id+')"><i class="fa fa-trash"></i></a>'
						);
					}
				}
			],
            order		: [[1, 'desc']],
      		dom			: 	'<"row d-flex justify-content-between align-items-center m-1"' +
        						'<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start "B>>' +
       							'<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>t' +
        					'<"d-flex justify-content-between mx-2 row"' +
        						'<"col-sm-12 col-md-6"i>' +
        						'<"col-sm-12 col-md-6"p>' +
        					'>',
            language: {
                'lengthMenu': 'Display _MENU_',
            },
      		responsive: {
				details: {
					display	: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							return 'Details of ' + data['matpel'];
						}
					}),
					type	: 'column',
					renderer: function (api, rowIdx, columns) {
						var data = $.map(columns, function (col, i) {
						return col.columnIndex !== 2
							? '<tr data-dt-row="' + col.rowIdx +'" data-dt-column="' + col.columnIndex +'">' +
								'<td>' +col.title + ':' + '</td> ' +
								'<td>' +col.data +'</td>' +
								'</tr>'
							: '';
						}).join('');
						return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
					}
				}
			},
            initComplete: function () {
			},
			drawCallback: function () {
			}
		});
        $('#tabelunsignkodekd').DataTable({
			responsive: {
				details: {
					display	: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							return 'Details of ' + data['id'];
						}
					}),
					type	: 'column',
					renderer: function (api, rowIdx, columns) {
						var data = $.map(columns, function (col, i) {
						return col.columnIndex !== 2
							? '<tr data-dt-row="' + col.rowIdx +'" data-dt-column="' + col.columnIndex +'">' +
								'<td>' +col.title + ':' + '</td> ' +
								'<td>' +col.data +'</td>' +
								'</tr>'
							: '';
						}).join('');
						return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
					}
				}
			},
			ordering	: true,
			autoWidth	: false,
            serverSide  : true,
            searching	: true,
			dom			: 	'<"row d-flex justify-content-between align-items-center m-1"' +
        						'<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start ">>' +
       							'<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>'+
                            '<"d-flex justify-content-between row"' +
        						'<"col-sm-12 col-md-12"p>' +
        					'>',
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonDataSettingNilai") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						semester        : document.getElementById('set_semester').value,
                        tapel           : document.getElementById('set_tapel').value,
						jenis           : 'belumtersimpan',
                        search          : data.search.value,
						_token			: '{{ csrf_token() }}'
					},
					type    : "POST",
					success : function(res) {
						callback({
							recordsTotal    : res.total,
							recordsFiltered : res.total,
							data            : res.data
						});
					},
				})
			},
			columns: [	
				{
					"data": {
						id 						: "id",
						muatan 					: "muatan",
						kelas 				    : "kelas",
						kodekd 					: "kodekd",
						deskripsi 				: "deskripsi",
                        semester 				: "semester",
					},
					"orderable" : false,
					"render" 	: function(data,type,full,meta){
                        stateNum    = Math.floor(Math.random() * 6);
                        states 		= ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
						state 		= states[stateNum];
                        var $rowOutput 	= '<div class="item"><div class="product-img">'+
                                            '<div class="time-label"><button class="btn btn-'+state+'" onClick="selectasvalue('+data.id+')">'+data.kodekd+'</button></div></div><div class="product-info">'+
                                            '<a href="javascript:void(0)" onClick="selectasvalue('+data.id+')" class="product-title">'+data.muatan+' (Kelas '+data.kelas+' SMT : '+data.semester+')<span class="badge badge-'+state+' float-right">Add</span></a>'+
                                            '<span class="product-description">'+data.deskripsi+'</span>'+
                                        '</div></div>';
						return $rowOutput;
					}
				}
			],
		});
        $('#tabellegger').DataTable({
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonDataSettingNilai") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						semester        : document.getElementById('set_semester').value,
                        tapel           : document.getElementById('set_tapel').value,
						jenis           : 'tersimpan',
                        search          : data.search.value,
						_token			: '{{ csrf_token() }}'
					},
					type: "POST",
					success: function(res) {
						callback({
							recordsTotal    : res.total,
							recordsFiltered : res.total,
							data            : res.data
						});
					},
				})
			},
			searching	: true,
            autoWidth	: false,
            serverSide  : true,
			columnDefs	: [
                {
					targets				: 0,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						var $matpel     = full['matpel'],
							$kelas 	    = full['kelas'],
							$semester 	= full['semester'],
							$tapel 	    = full['tapel'],
							$kodekd 	= full['kodekd'];
                        var $rowOutput 	= $matpel+'<br /><font color="blue">KD : '+$kodekd+' | Kelas : '+$kelas+' | Smt : '+ $semester+' TA : '+$tapel;
						return $rowOutput;
					}
				},
                {
					targets				: 1,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						var view   = full['p01'];
                        if (view == '' || view == null || view == 0){
                            var $rowOutput 	= '<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>';
                        } else {
                            var $rowOutput 	= '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i></a>';
                        }
						return $rowOutput;
					}
				},
                {
					targets				: 2,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						var view   = full['p02'];
                        if (view == '' || view == null || view == 0){
                            var $rowOutput 	= '<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>';
                        } else {
                            var $rowOutput 	= '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i></a>';
                        }
						return $rowOutput;
					}
				},
                {
					targets				: 3,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						var view   = full['p03'];
                        if (view == '' || view == null || view == 0){
                            var $rowOutput 	= '<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>';
                        } else {
                            var $rowOutput 	= '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i></a>';
                        }
						return $rowOutput;
					}
				},
                {
					targets				: 4,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						var view   = full['p04'];
                        if (view == '' || view == null || view == 0){
                            var $rowOutput 	= '<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>';
                        } else {
                            var $rowOutput 	= '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i></a>';
                        }
						return $rowOutput;
					}
				},
                {
					targets				: 5,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						var view   = full['p05'];
                        if (view == '' || view == null || view == 0){
                            var $rowOutput 	= '<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>';
                        } else {
                            var $rowOutput 	= '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i></a>';
                        }
						return $rowOutput;
					}
				},
                {
					targets				: 6,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						var view   = full['e01'];
                        if (view == '' || view == null || view == 0){
                            var $rowOutput 	= '<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>';
                        } else {
                            var $rowOutput 	= '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i></a>';
                        }
						return $rowOutput;
					}
				},
                {
					targets				: 7,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						var view   = full['e02'];
                        if (view == '' || view == null || view == 0){
                            var $rowOutput 	= '<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>';
                        } else {
                            var $rowOutput 	= '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i></a>';
                        }
						return $rowOutput;
					}
				},
                {
					targets				: 8,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						var view   = full['e03'];
                        if (view == '' || view == null || view == 0){
                            var $rowOutput 	= '<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>';
                        } else {
                            var $rowOutput 	= '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i></a>';
                        }
						return $rowOutput;
					}
				},
                {
					targets				: 9,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						var view   = full['e04'];
                        if (view == '' || view == null || view == 0){
                            var $rowOutput 	= '<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>';
                        } else {
                            var $rowOutput 	= '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i></a>';
                        }
						return $rowOutput;
					}
				},
                {
					targets				: 10,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						var view   = full['e05'];
                        if (view == '' || view == null || view == 0){
                            var $rowOutput 	= '<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>';
                        } else {
                            var $rowOutput 	= '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i></a>';
                        }
						return $rowOutput;
					}
				},
                {
					targets				: 11,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						var view   = full['pts'];
                        if (view == '' || view == null || view == 0){
                            var $rowOutput 	= '<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>';
                        } else {
                            var $rowOutput 	= '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i></a>';
                        }
						return $rowOutput;
					}
				},
                {
					targets				: 12,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						var view   = full['pat'];
                        if (view == '' || view == null || view == 0){
                            var $rowOutput 	= '<a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>';
                        } else {
                            var $rowOutput 	= '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i></a>';
                        }
						return $rowOutput;
					}
				},
                {
					targets		: -1,
					title		: 'Actions',
					orderable	: false,
					render		: function (data, type, full, meta) {
						var $id 	= full['id'];
						return (
						    '<a class="btn btn-sm" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove" onClick="removesettingnilai('+$id+')"><i class="fa fa-trash"></i></a>'
						);
					}
				}
			],
            order       : [[ 0, "desc" ], [ 1, "desc" ]],
      		dom			: 	'<"row d-flex justify-content-between align-items-center m-1"' +
        						'<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start "B>>' +
       							'<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>t' +
        					'<"d-flex justify-content-between mx-2 row"' +
        						'<"col-sm-12 col-md-6"i>' +
        						'<"col-sm-12 col-md-6"p>' +
        					'>',
            language: {
                'lengthMenu': 'Display _MENU_',
            },
      		responsive: {
				details: {
					display	: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							return 'Details of ' + data['matpel'];
						}
					}),
					type	: 'column',
					renderer: function (api, rowIdx, columns) {
						var data = $.map(columns, function (col, i) {
						return col.columnIndex !== 2
							? '<tr data-dt-row="' + col.rowIdx +'" data-dt-column="' + col.columnIndex +'">' +
								'<td>' +col.title + ':' + '</td> ' +
								'<td>' +col.data +'</td>' +
								'</tr>'
							: '';
						}).join('');
						return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
					}
				}
			},
			initComplete: function () {
			},
			drawCallback: function () {
			}
		});
        $("#add_matkul").on('change', function () {
            $("#tabelrps").DataTable().ajax.reload();
        });
        $("#jadwal_tanggal01").on('change', function () {
            var val01       = document.getElementById('jadwal_tanggal01').value;
            var tglan02 	= moment(val01).add(+7, 'days');
		    var newtgl02	= moment(tglan02).format('YYYY-MM-DD');
            $("#jadwal_tanggal02").val(newtgl02);
            
            var tglan03 	= moment(newtgl02).add(+7, 'days');
		    var newtgl03	= moment(tglan03).format('YYYY-MM-DD');
            $("#jadwal_tanggal03").val(newtgl03);
            
            var tglan04 	= moment(newtgl03).add(+7, 'days');
		    var newtgl04	= moment(tglan04).format('YYYY-MM-DD');
            $("#jadwal_tanggal04").val(newtgl04);

            var tglan05 	= moment(newtgl04).add(+7, 'days');
		    var newtgl05	= moment(tglan05).format('YYYY-MM-DD');
            $("#jadwal_tanggal05").val(newtgl05);

            var tglan06 	= moment(newtgl05).add(+7, 'days');
		    var newtgl06	= moment(tglan06).format('YYYY-MM-DD');
            $("#jadwal_tanggal06").val(newtgl06);

            var tglan07 	= moment(newtgl06).add(+7, 'days');
		    var newtgl07	= moment(tglan07).format('YYYY-MM-DD');
            $("#jadwal_tanggal07").val(newtgl07);

            var tglan08 	= moment(newtgl07).add(+7, 'days');
		    var newtgl08	= moment(tglan08).format('YYYY-MM-DD');
            $("#jadwal_tanggal08").val(newtgl08);

            var tglan09 	= moment(newtgl08).add(+7, 'days');
		    var newtgl09	= moment(tglan09).format('YYYY-MM-DD');
            $("#jadwal_tanggal09").val(newtgl09);

            var tglan10 	= moment(newtgl09).add(+7, 'days');
		    var newtgl10	= moment(tglan10).format('YYYY-MM-DD');
            $("#jadwal_tanggal10").val(newtgl10);

            var tglan11 	= moment(newtgl10).add(+7, 'days');
		    var newtgl11	= moment(tglan11).format('YYYY-MM-DD');
            $("#jadwal_tanggal11").val(newtgl11);

            var tglan12 	= moment(newtgl11).add(+7, 'days');
		    var newtgl12	= moment(tglan12).format('YYYY-MM-DD');
            $("#jadwal_tanggal12").val(newtgl12);

            var tglan13 	= moment(newtgl12).add(+7, 'days');
		    var newtgl13	= moment(tglan13).format('YYYY-MM-DD');
            $("#jadwal_tanggal13").val(newtgl13);

            var tglan14 	= moment(newtgl13).add(+7, 'days');
		    var newtgl14	= moment(tglan14).format('YYYY-MM-DD');
            $("#jadwal_tanggal14").val(newtgl14);

            var tglan15 	= moment(newtgl14).add(+7, 'days');
		    var newtgl15	= moment(tglan15).format('YYYY-MM-DD');
            $("#jadwal_tanggal15").val(newtgl15);

            var tglan16 	= moment(newtgl15).add(+7, 'days');
		    var newtgl16	= moment(tglan16).format('YYYY-MM-DD');
            $("#jadwal_tanggal16").val(newtgl16);

            var tglan17 	= moment(newtgl16).add(+7, 'days');
		    var newtgl17	= moment(tglan17).format('YYYY-MM-DD');
            $("#jadwal_tanggal17").val(newtgl17);

            var tglan18 	= moment(newtgl17).add(+7, 'days');
		    var newtgl18	= moment(tglan18).format('YYYY-MM-DD');
            $("#jadwal_tanggal18").val(newtgl18);

            var tglan19 	= moment(newtgl18).add(+7, 'days');
		    var newtgl19	= moment(tglan19).format('YYYY-MM-DD');
            $("#jadwal_tanggal19").val(newtgl19);

            var tglan20 	= moment(newtgl19).add(+7, 'days');
		    var newtgl20	= moment(tglan20).format('YYYY-MM-DD');
            $("#jadwal_tanggal20").val(newtgl20);
        });
        $("#jadwal_ruangan01").on('change', function () {
            var set01=document.getElementById('jadwal_ruangan01').value;
            $(".classruang").val(set01);
        });
        $("#jadwal_guru01").on('change', function () {
            var set01=document.getElementById('jadwal_guru01').value;
            $(".classguru").val(set01);
        });
        $("#jadwal_mulai01").on('change', function () {
            var set01=document.getElementById('jadwal_mulai01').value;
            $(".classjam1").val(set01);
        });
        $("#jadwal_akhir01").on('change', function () {
            var set01=document.getElementById('jadwal_akhir01').value;
            $(".classjam2").val(set01);
        });
        $("#btneditmateri").click(function(){
            $('.modalbodyeditmateri').show();
            $('#modalawal').hide();
        });
        $("#btneditwaktu").click(function(){
            $('.modalbodyeditwaktu').show();
            $('#modalawal').hide();
        });
        $('#btnupdajadwalbymateri').click(function () {
            var set01=document.getElementById('editjad_id').value;
            var set02=document.getElementById('editjadwal_guruhadir').value;
            var set03=document.getElementById('editmat_materi').value;
            if (set01 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Lengkapi semua isian pada field ini, apabila ada data yang memang tidak ada mohon memberikan tanda 0 (nol) atau - (strip) dan pastikan Bapak/Ibu sudah click Icon Kelas di Samping',
                    type	: 'error',
                });
            } else {
                $.post('{{ route("exJadwalRPS") }}', { kerja: 'materi', val01: set01, val02: set02, val03: set03, _token: '{{ csrf_token() }}' },
                function(data){	
                    $("#modaleditjadwal").modal('hide');
                    $("#griddetail").jqxGrid("updatebounddata");
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
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    return false;
                });
            }
        });
        $('#btnupdajadwalbywaktu').click(function () {
            var set01=document.getElementById('editjad_id').value;
            var set02=document.getElementById('editjadwal_tanggal').value;
            var set03=document.getElementById('editjadwal_mulai').value;
            var set04=document.getElementById('editjadwal_akhir').value;
            var set05=document.getElementById('editjadwal_ruangan').value;
            var set06=document.getElementById('editjadwal_guru').value;
            if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Lengkapi semua isian pada field ini, apabila ada data yang memang tidak ada mohon memberikan tanda 0 (nol) atau - (strip) dan pastikan Bapak/Ibu sudah click Icon Kelas di Samping',
                    type	: 'error',
                });
            } else {
                $("#modaleditjadwal").modal('hide');
                $.post('{{ route("exJadwalRPS") }}', { kerja: 'waktu', val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, _token: '{{ csrf_token() }}' },
                function(data){	
                    $("#griddetail").jqxGrid("updatebounddata");
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
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    return false;
                });
            }
        });
        $('#btnsaveupdate').click(function () {
            var set01=document.getElementById('edit_semester').value;
            var set02=document.getElementById('edit_tema').value;
            var set03=document.getElementById('edit_subtema').value;
            var set04=CKEDITOR.instances['edit_deskripsitema'].getData()
            var set05=CKEDITOR.instances['edit_kompetensi'].getData()
            var set06=document.getElementById('edit_idne').value;
            var set07=document.getElementById('edit_kodekd').value;
            var set08=document.getElementById('edit_nilai').value;
            var set09=document.getElementById('edit_materi').value;
            if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set07 == '' || set08 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Lengkapi semua isian pada field ini, apabila ada data yang memang tidak ada mohon memberikan tanda 0 (nol) atau - (strip)',
                    type	: 'error',
                });
            } else {
                $("#editorrps").modal('hide');
                $.post('{{ route("exDatakodekd") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, _token: '{{ csrf_token() }}' },
                function(data){
                    $("#tabelrps").DataTable().ajax.reload();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var status  = data.status;
                    var message = data.message;
                    var warna 	= data.warna;
                    var icon 	= data.icon;
                    $.toast({
                        heading     : status,
                        text        : message,
                        position    : 'top-right',
                        loaderBg    : warna,
                        icon        : icon,
                        hideAfter   : 5000,
                        stack       : 1
                    });
                    return false;
                });
            }
        });
        $('#btntambahrps').click(function () {
            var set01=document.getElementById('add_semester').value;
            var set02=document.getElementById('add_tema').value;
            var set03=document.getElementById('add_subtema').value;
            var set04=CKEDITOR.instances['add_deskripsitema'].getData()
            var set05=CKEDITOR.instances['add_kompetensi'].getData()
            var set06='baru';
            var set07=document.getElementById('add_kodekd').value;
            var set08=document.getElementById('add_nilai').value;
            var set09=document.getElementById('add_matkul').value;
            var set10=document.getElementById('add_materi').value;
            if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set07 == '' || set08 == '' || set09 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Lengkapi semua isian pada field ini, apabila ada data yang memang tidak ada mohon memberikan tanda 0 (nol) atau - (strip)',
                    type	: 'error',
                });
            } else {
                var btn = $(this);
				    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
			
                $.post('{{ route("exDatakodekd") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, _token: '{{ csrf_token() }}' },
                function(data){
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    $("#tabelrps").DataTable().ajax.reload();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var status  = data.status;
                    var message = data.message;
                    var warna 	= data.warna;
                    var icon 	= data.icon;
                    $.toast({
                        heading     : status,
                        text        : message,
                        position    : 'top-right',
                        loaderBg    : warna,
                        icon        : icon,
                        hideAfter   : 5000,
                        stack       : 1
                    });
                    return false;
                });
            }
            
        });
        $('#btntambahsetleggger').click(function () {
            var set02=document.getElementById('settingnilai_id').value;
            var set03=document.getElementById('legger_penilaianharian').value;
            var set04=document.getElementById('legger_evaluasi').value;
            if (set03 == '' || set04 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Lengkapi semua isian pada field ini, apabila ada data yang memang tidak ada mohon memberikan tanda 0 (nol) atau - (strip)',
                    type	: 'error',
                });
            } else {
                var btn = $(this);
				    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                $.post('{{ route("exDatakodekd") }}', { val01: 'settingnilai', val02: set02, val03: set03, val04: set04, _token: '{{ csrf_token() }}' },
                function(data){
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
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
                    $("#modaltambahsettingnilai").modal('hide');
                    $("#tabelunsignkodekd").DataTable().ajax.reload();
                    $("#tabellegger").DataTable().ajax.reload();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    return false;
                });
            }
        });
        $('#btntambahkkm').click(function () {
            var set01   = document.getElementById('id_kelas').value;
            if (set01 == '' || set01 == null){
                swal({
                    title	: 'Warning',
                    text	: 'Pilih Kelas Terlebih Dahulu',
                    type	: 'error',
                });
            } else {
                $("#modaltambahkkm").modal('show');
                $('#tomboltambah').show();
                $('#tombolupdate').hide();
            }
        });
        $('#btnexportdatakkm').click(function () {
            var set01   = document.getElementById('id_kelas').value;
            if (set01 == '' || set01 == null){
                swal({
                    title	: 'Warning',
                    text	: 'Pilih Kelas Terlebih Dahulu',
                    type	: 'error',
                });
            } else {
                $.post('{{ route("jsonDatakkm") }}', { val01:set01, _token: '{{ csrf_token() }}' },
                function(data){
                    data = $.parseJSON(data);
                    var noOfContacts = data.length;
                    if(noOfContacts>0){
                        var table = document.createElement("table");
                            table.style.width = '100%';
                            table.setAttribute('border', '1');
                            table.setAttribute('cellspacing', '0');
                            table.setAttribute('cellpadding', '5');
                            table.setAttribute('id', 'tabelcetak');
                            table.setAttribute('class', 'text');
                        var col = [];
                        for (var i = 0; i < noOfContacts; i++) {
                            for (var key in data[i]) {
                                if (col.indexOf(key) === -1) {
                                    col.push(key);
                                }
                            }
                        }
                        var tHead = document.createElement("thead");
                        var hRow = document.createElement("tr");
                        for (var i = 0; i < col.length; i++) {
                                var th = document.createElement("th");
                                th.innerHTML = col[i];
                                hRow.appendChild(th);
                        }
                        tHead.appendChild(hRow);
                        table.appendChild(tHead);
                        var tBody = document.createElement("tbody");
                        for (var i = 0; i < noOfContacts; i++) {
                            var bRow = document.createElement("tr");
                            for (var j = 0; j < col.length; j++) {
                                var td 		= document.createElement("td");
                                var isi 	= data[i][col[j]];
                                if (isi == null){
                                    td.innerHTML = '';
                                } else {
                                    var isi2 	= isi.toString();
                                    var pjg 	= isi2.length;
                                    if (pjg > 8){
                                        if (pjg == 9 || pjg == 10){
                                            if( isi2.indexOf(',') != -1 ){
                                                var res = isi2.replace(/,/g, "");
                                                td.innerHTML = res;
                                            }
                                            else {
                                                var res = isi2;
                                                td.setAttribute('style', 'mso-number-format: "\@";');
                                                td.innerHTML = res;
                                            }
                                        }
                                        else { 
                                            var res = isi2;
                                            td.setAttribute('style', 'mso-number-format: "\@";');
                                            td.innerHTML = res;
                                        }						
                                    } else {
                                        var res = isi2.replace(/,/g, "");
                                        td.innerHTML = res;
                                    }
                                }   
                                bRow.appendChild(td);
                            }
                            tBody.appendChild(bRow)
                        }
                        table.appendChild(tBody);
                        var divContainer = document.getElementById("tabel_cetak");
                            divContainer.innerHTML = "";
                            divContainer.appendChild(table);
                    }
                    $("#tabel_cetak").btechco_excelexport({
                        containerid: "tabel_cetak"
                        , datatype: $datatype.Table
                    });
                    return false;
                });
            }
        });
        $('#btnsimpankkm').click(function () {
            var set01=document.getElementById('id_kelas').value;
            var set02=document.getElementById('id_matpel').value;
            var set03=document.getElementById('id_muatan').value;
            var set04=document.getElementById('id_ki3').value;
            var set05=document.getElementById('id_ki4').value;
            var set06='baru';
            if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Lengkapi semua isian pada field ini, apabila ada data yang memang tidak ada mohon memberikan tanda 0 (nol) atau - (strip) dan pastikan Bapak/Ibu sudah click Icon Kelas di Samping',
                    type	: 'error',
                });
            } else {
                $.post('{{ route("exDatakkm") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, _token: '{{ csrf_token() }}' },
                function(data){	
                    $("#modaltambahkkm").modal('hide');
                    $("#gridkurikulum").jqxGrid("updatebounddata");
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
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    return false;
                });
            }
        });
        $('#btnubahkkm').click(function () {
            var set01=document.getElementById('id_kelas').value;
            var set02=document.getElementById('id_matpel').value;
            var set03=document.getElementById('id_muatan').value;
            var set04=document.getElementById('id_ki3').value;
            var set05=document.getElementById('id_ki4').value;
            var set06=document.getElementById('id_idne').value;
            if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Lengkapi semua isian pada field ini, apabila ada data yang memang tidak ada mohon memberikan tanda 0 (nol) atau - (strip) dan pastikan Bapak/Ibu sudah click Icon Kelas di Samping',
                    type	: 'error',
                });
            } else {
                $.post('{{ route("exDatakkm") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, _token: '{{ csrf_token() }}' },
                function(data){	
                    $("#modaltambahkkm").modal('hide');
                    $("#gridkurikulum").jqxGrid("updatebounddata");
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
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    return false;
                });
            }
        });
        $('#simpansetguru').click(function () {
            var set01=document.getElementById('set_semester').value;
            var set02=document.getElementById('set_kelas').value;
            var set03='';
            var set04=document.getElementById('set_tapel').value;
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
        $("#btnexportdata").click(function () {
            var gridContent = $("#griddetail").jqxGrid('exportdata', 'json');
            data = $.parseJSON(gridContent);
            var noOfContacts = data.length;
            if(noOfContacts>0){
                var table = document.createElement("table");
                    table.style.width = '100%';
                    table.setAttribute('border', '1');
                    table.setAttribute('cellspacing', '0');
                    table.setAttribute('cellpadding', '5');
                    table.setAttribute('id', 'tabelcetak');
                    table.setAttribute('class', 'text');
                var col = [];
                for (var i = 0; i < noOfContacts; i++) {
                    for (var key in data[i]) {
                        if (col.indexOf(key) === -1) {
                            col.push(key);
                        }
                    }
                }
                var tHead = document.createElement("thead");
                var hRow = document.createElement("tr");
                for (var i = 0; i < col.length; i++) {
                        var th = document.createElement("th");
                        th.innerHTML = col[i];
                        hRow.appendChild(th);
                }
                tHead.appendChild(hRow);
                table.appendChild(tHead);
                var tBody = document.createElement("tbody");
                for (var i = 0; i < noOfContacts; i++) {
                    var bRow = document.createElement("tr");
                    for (var j = 0; j < col.length; j++) {
                        var td 		= document.createElement("td");
                        var isi 	= data[i][col[j]];
                        var isi2 	= isi.toString();
                        var pjg 	= isi2.length;
                        if (pjg > 8){
                            if (pjg == 9 || pjg == 10){
                                if( isi2.indexOf(',') != -1 ){
                                    var res = isi2.replace(/,/g, "");
                                    td.innerHTML = res;
                                }
                                else {
                                    var res = isi2;
                                    td.setAttribute('style', 'mso-number-format: "\@";');
                                    td.innerHTML = res;
                                }
                            }
                            else { 
                                var res = isi2;
                                td.setAttribute('style', 'mso-number-format: "\@";');
                                td.innerHTML = res;
                            }						
                        }
                        else {
                            var res = isi2.replace(/,/g, "");
                            td.innerHTML = res;
                        }
                            
                        bRow.appendChild(td);
                    }
                    tBody.appendChild(bRow)
                }
                table.appendChild(tBody);
                var divContainer = document.getElementById("tabel_cetak");
                    divContainer.innerHTML = "";
                    divContainer.appendChild(table);
            }
            $("#tabel_cetak").btechco_excelexport({
                containerid: "tabel_cetak"
                , datatype: $datatype.Table
            });
            return false;
        });
        $("#btnexportjadwaltabel").click(function () {
            var set01   = document.getElementById('set_semester').value;
            var set02   = document.getElementById('set_tapel').value;
            $.post('{{ route("jsonJadwalRPS") }}', { val01: set01, val02: set02, val03: 'tabel', _token: '{{ csrf_token() }}' },
            function(data){
                data = $.parseJSON(data);
                var noOfContacts = data.length;
                if(noOfContacts>0){
                    var table = document.createElement("table");
                        table.style.width = '100%';
                        table.setAttribute('border', '1');
                        table.setAttribute('cellspacing', '0');
                        table.setAttribute('cellpadding', '5');
                        table.setAttribute('id', 'tabelcetak');
                        table.setAttribute('class', 'text');
                    var col = [];
                    for (var i = 0; i < noOfContacts; i++) {
                        for (var key in data[i]) {
                            if (col.indexOf(key) === -1) {
                                col.push(key);
                            }
                        }
                    }
                    var tHead = document.createElement("thead");
                    var hRow = document.createElement("tr");
                    for (var i = 0; i < col.length; i++) {
                            var th = document.createElement("th");
                            th.innerHTML = col[i];
                            hRow.appendChild(th);
                    }
                    tHead.appendChild(hRow);
                    table.appendChild(tHead);
                    var tBody = document.createElement("tbody");
                    for (var i = 0; i < noOfContacts; i++) {
                        var bRow = document.createElement("tr");
                        for (var j = 0; j < col.length; j++) {
                            var td 		= document.createElement("td");
                            var isi 	= data[i][col[j]];
                            if (isi == null){
                                td.innerHTML = '';
                            } else {
                                var isi2 	= isi.toString();
                                var pjg 	= isi2.length;
                                if (pjg > 8){
                                    if (pjg == 9 || pjg == 10){
                                        if( isi2.indexOf(',') != -1 ){
                                            var res = isi2.replace(/,/g, "");
                                            td.innerHTML = res;
                                        }
                                        else {
                                            var res = isi2;
                                            td.setAttribute('style', 'mso-number-format: "\@";');
                                            td.innerHTML = res;
                                        }
                                    }
                                    else { 
                                        var res = isi2;
                                        td.setAttribute('style', 'mso-number-format: "\@";');
                                        td.innerHTML = res;
                                    }						
                                } else {
                                    var res = isi2.replace(/,/g, "");
                                    td.innerHTML = res;
                                }
                            }   
                            bRow.appendChild(td);
                        }
                        tBody.appendChild(bRow)
                    }
                    table.appendChild(tBody);
                    var divContainer = document.getElementById("tabel_cetak");
                        divContainer.innerHTML = "";
                        divContainer.appendChild(table);
                }
                $("#tabel_cetak").btechco_excelexport({
                    containerid: "tabel_cetak"
                    , datatype: $datatype.Table
                });
                return false;
            });
        });
        $("#btnexportdatarps").click(function () {
            var set01   = document.getElementById('add_matkul').value;
            if (set01 == '' || set01 == null){

            } else {
                $.post('{{ route("jsonDataRPS") }}', { idmatkul: set01, set02: 'exportall', _token: '{{ csrf_token() }}' },
                function(data){
                    data = $.parseJSON(data);
                    var noOfContacts = data.length;
                    if(noOfContacts>0){
                        var table = document.createElement("table");
                            table.style.width = '100%';
                            table.setAttribute('border', '1');
                            table.setAttribute('cellspacing', '0');
                            table.setAttribute('cellpadding', '5');
                            table.setAttribute('id', 'tabelcetak');
                            table.setAttribute('class', 'text');
                        var col = [];
                        for (var i = 0; i < noOfContacts; i++) {
                            for (var key in data[i]) {
                                if (col.indexOf(key) === -1) {
                                    col.push(key);
                                }
                            }
                        }
                        var tHead = document.createElement("thead");
                        var hRow = document.createElement("tr");
                        for (var i = 0; i < col.length; i++) {
                                var th = document.createElement("th");
                                th.innerHTML = col[i];
                                hRow.appendChild(th);
                        }
                        tHead.appendChild(hRow);
                        table.appendChild(tHead);
                        var tBody = document.createElement("tbody");
                        for (var i = 0; i < noOfContacts; i++) {
                            var bRow = document.createElement("tr");
                            for (var j = 0; j < col.length; j++) {
                                var td 		= document.createElement("td");
                                var isi 	= data[i][col[j]];
                                if (isi == null){
                                    td.innerHTML = '';
                                } else {
                                    var isi2 	= isi.toString();
                                    var pjg 	= isi2.length;
                                    if (pjg > 8){
                                        if (pjg == 9 || pjg == 10){
                                            if( isi2.indexOf(',') != -1 ){
                                                var res = isi2.replace(/,/g, "");
                                                td.innerHTML = res;
                                            }
                                            else {
                                                var res = isi2;
                                                td.setAttribute('style', 'mso-number-format: "\@";');
                                                td.innerHTML = res;
                                            }
                                        }
                                        else { 
                                            var res = isi2;
                                            td.setAttribute('style', 'mso-number-format: "\@";');
                                            td.innerHTML = res;
                                        }						
                                    } else {
                                        var res = isi2.replace(/,/g, "");
                                        td.innerHTML = res;
                                    }
                                }   
                                bRow.appendChild(td);
                            }
                            tBody.appendChild(bRow)
                        }
                        table.appendChild(tBody);
                        var divContainer = document.getElementById("tabel_cetak");
                            divContainer.innerHTML = "";
                            divContainer.appendChild(table);
                    }
                    $("#tabel_cetak").btechco_excelexport({
                        containerid: "tabel_cetak"
                        , datatype: $datatype.Table
                    });
                    return false;
                });
            }
        });
        $("#btnexportlegggger").click(function () {
            var set01=document.getElementById('set_semester').value;
            var set02=document.getElementById('set_tapel').value;
            if (set01 == '' || set02 == ''){

            } else {
                $.post('{{ route("jsonDataSettingNilai") }}', { semester: set01, tapel: set02, jenis: 'exporttabel', _token: '{{ csrf_token() }}' },
                function(data){
                    data = $.parseJSON(data);
                    var noOfContacts = data.length;
                    if(noOfContacts>0){
                        var table = document.createElement("table");
                            table.style.width = '100%';
                            table.setAttribute('border', '1');
                            table.setAttribute('cellspacing', '0');
                            table.setAttribute('cellpadding', '5');
                            table.setAttribute('id', 'tabelcetak');
                            table.setAttribute('class', 'text');
                        var col = [];
                        for (var i = 0; i < noOfContacts; i++) {
                            for (var key in data[i]) {
                                if (col.indexOf(key) === -1) {
                                    col.push(key);
                                }
                            }
                        }
                        var tHead = document.createElement("thead");
                        var hRow = document.createElement("tr");
                        for (var i = 0; i < col.length; i++) {
                                var th = document.createElement("th");
                                th.innerHTML = col[i];
                                hRow.appendChild(th);
                        }
                        tHead.appendChild(hRow);
                        table.appendChild(tHead);
                        var tBody = document.createElement("tbody");
                        for (var i = 0; i < noOfContacts; i++) {
                            var bRow = document.createElement("tr");
                            for (var j = 0; j < col.length; j++) {
                                var td 		= document.createElement("td");
                                var isi 	= data[i][col[j]];
                                if (isi == null){
                                    td.innerHTML = '';
                                } else {
                                    var isi2 	= isi.toString();
                                    var pjg 	= isi2.length;
                                    if (pjg > 8){
                                        if (pjg == 9 || pjg == 10){
                                            if( isi2.indexOf(',') != -1 ){
                                                var res = isi2.replace(/,/g, "");
                                                td.innerHTML = res;
                                            }
                                            else {
                                                var res = isi2;
                                                td.setAttribute('style', 'mso-number-format: "\@";');
                                                td.innerHTML = res;
                                            }
                                        }
                                        else { 
                                            var res = isi2;
                                            td.setAttribute('style', 'mso-number-format: "\@";');
                                            td.innerHTML = res;
                                        }						
                                    } else {
                                        var res = isi2.replace(/,/g, "");
                                        td.innerHTML = res;
                                    }
                                }   
                                bRow.appendChild(td);
                            }
                            tBody.appendChild(bRow)
                        }
                        table.appendChild(tBody);
                        var divContainer = document.getElementById("tabel_cetak");
                            divContainer.innerHTML = "";
                            divContainer.appendChild(table);
                    }
                    $("#tabel_cetak").btechco_excelexport({
                        containerid: "tabel_cetak"
                        , datatype: $datatype.Table
                    });
                    return false;
                });
            }
        });
        
        openjadviewKalender();
    });
</script>
@endpush