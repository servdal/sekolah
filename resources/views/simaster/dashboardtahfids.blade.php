@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Tentukan Semester dan Tahun Pelajaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 divpanelleft">
                    <div class="card card-warning shadow divpanel">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> RPA</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-group date" data-target-input="nearest">
                                            <select id="id_mastertahun" name="id_mastertahun" size="1" class="form-control">
                                                @php
                                                    $tahun = date('Y');
                                                    $limtahunlalu = $tahun - 5;
                                                    while ($limtahunlalu != $tahun){
                                                        echo '<option value="'.$limtahunlalu.'">'.$limtahunlalu.'</option>';
                                                        $limtahunlalu++;
                                                    }
                                                    echo '<option value="'.$tahun.'" selected>'.$tahun.'</option>';
                                                @endphp
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <button type="button" class="btn btn-primary btn-block" title="Ubah Tahun" id="btnubahtahun"><i class="fa fa-refresh"></i> Ubah Tahun</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <h3><i class="fa fa-clone"></i> Tambah Kelas</h3>
                                        <div class="input-group" data-target-input="nearest">
                                            <input type="text" class="form-control" id="rpatambahkelas" name="rpatambahkelas" placeholder="max 10 char">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><a href="#" id="btntambahkelasrpa"><i class="fa fa-save"></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group btn-group-vertical">
                                            @if(isset($kelasrpa) && !empty($kelasrpa))
                                                @foreach($kelasrpa as $rows)
                                                    <a href="#" id="grade{{$rows['kelas']}}"  onClick="jQueryOpenRPA('{{$rows['kelas']}}')" class="btn btn-block btn-social btn-primary">
                                                        <i class="fa fa-windows"></i> Grade {{$rows['kelas']}}
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
							
						</div>
                    </div>
                    <div class="card card-info shadow divpanel">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> Setting</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>TAPEL</label>
                                <input type="text" name="tapel" id="tapel" class="form-control" value="{{$tapel}}" placeholder="gunakan dash sebegai pemisah, ex: xxxx-xxxx">
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
                    <div class="card card-primary shadow divrpa">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-bank"></i> Statistik Data Halaqoh di Sekolah</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridstatistikhs"></div>
						</div>
                    </div>
                    <div class="card card-danger shadow divrpa">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-shirtsinbulk"></i> Statistik Data Halaqoh di Rumah</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridstatistikhr"></div>
						</div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card card-info card9 shadow" id="divstatistik">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Pilih Kelas {{ $tapel }} Semester {{ $smt }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle" id="tabelrps">
                                    <thead>
                                        <tr>
                                            <th>Kelas</th>
                                            <th>Jumlah Peserta</th>
                                            <th>Jumlah Kegiatan</th>
                                            <th>Pendamping Terakhir</th>
                                            <th>Tanggal Terakhir</th>
                                            <th class="cell-fit">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($listkelas) && !empty($listkelas))
                                            @foreach($listkelas as $rows)
                                            <tr>
                                                <td>{{ $rows['klspos'] }}</td>
                                                <td>{{ $rows['peserta'] }}</td>
                                                <td>{{ $rows['kegiatan'] }}</td>
                                                <td>{{ $rows['inputor'] }}</td>
                                                <td>{{ $rows['tanggal'] }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-warning " onClick="jQueryOpenPesertaKelas('{{ $rows['klspos']}}')"><i class="fa fa-search"></i> Mapping Peserta</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>-</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>No Data</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
						</div>
                        <div class="card-footer">
                            <h3><i class="fa fa-calendar-check-o"></i> Template Penilaian</h3>
                            <div class="card card-primary shadow">
                                
                            </div>
						</div>
                    </div>
                    <div class="card card-warning card9 shadow divrpa">
                        <div class="card-header">
                            <h3 class="card-title" id="judulrpa">Rencana Pembelajaran Al Quran</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" title="Export" id="btnexport"><i class="fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-6">
                                <div class="btn-group">
                                    <a class="btn btn-app btn-warning" id="topbtnhalaqoh" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Kegiatan Halaqoh di Sekolah"><i class="fa fa-bank"></i> Halaqoh di Sekolah</a>
                                    <a class="btn btn-app btn-primary" id="topbtnpenilaianalquran" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Penilaian AlQuran"><i class="fa fa-calculator"></i> Ujian Al Quran</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="gridrpa"></div>
						</div>
                    </div>
                    <div class="card card-warning card9 shadow" id="divmappingkelas">
                        <div class="card-header">
                            <h3 class="card-title" id="judulpesertakelas">Peserta Kelas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" title="Export" id="btnexportpesertakelas"><i class="fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btnviewawal"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridpesertakelas"></div>
						</div>
                    </div>
                    <div class="card card-warning card9 shadow" id="modalrpa">
                        <div class="card-header">
                            <h3 class="card-title">Rencana Pembelajaran Al Quran</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnviewrpa"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="formeditorrpa" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="rpa_pekan">Pekan</label>
                                            <select id="rpa_pekan" name="pekan" class="form-control">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                            </select>
                                        </div> 
                                        <div class="col-lg-3">
                                            <label for="rpa_pb">PB</label>
                                            <select id="rpa_pb" name="pb" class="form-control">
                                                @php
                                                    $mulai = 1;
                                                    while ($mulai != 100){
                                                        echo '<option value="'.$mulai.'">'.$mulai.'</option>';
                                                        $mulai++;
                                                    }
                                                @endphp
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="rpa_tanggal">Tangggal</label>
                                            <input type="text" class="form-control" id="rpa_tanggal" name="realdate" readonly>
                                        </div> 
                                        <div class="col-lg-3">
                                            <label for="rpa_hal">Hal</label>
                                            <input type="text" class="form-control" id="rpa_hal" name="hal">
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rpa_murojaahkemarin">Murojaah Kemarin</label>
                                    <input type="text" class="form-control" id="rpa_murojaahkemarin" name="murojaahkemarin">
                                </div>
                                <div class="form-group">
                                    <label for="rap_mendengaraudio">Mendengarkan Audio Syekh</label>
                                    <input type="text" class="form-control" id="rpa_mendengaraudio" name="mendengaraudio">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="rap_sholatdhuha">Sholat Dhuha</label>
                                            <input type="text" class="form-control" id="rpa_sholatdhuha" name="sholatdhuha">
                                        </div> 
                                        <div class="col-lg-3">
                                            <label for="rpa_murojaahhariini">Murojaah Hari Ini</label>
                                            <input type="text" class="form-control" id="rpa_murojaahhariini" name="murojaahhariini">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="rpa_tahsin">Tahsin</label>
                                            <input type="text" class="form-control" id="rpa_tahsin" name="tahsin">
                                        </div> 
                                        <div class="col-lg-3">
                                            <label for="rpa_tilawah">Tilawah</label>
                                            <input type="text" class="form-control" id="rpa_tilawah" name="tilawah">
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rpa_persiapanhafalanbesok">PERSIAPAN HAFALAN BESOK</label>
                                    <input type="text" class="form-control" id="rpa_persiapanhafalanbesok" name="persiapanhafalanbesok">
                                </div>
                                <div class="form-group">
                                    <label for="rpa_murojaahsabtuahad">Murojaah di Rumah</label>
                                    <input type="text" class="form-control" id="rpa_murojaahsabtuahad" name="murojaahsabtuahad">
                                </div>
                                <input type="hidden" class="form-control" id="rpa_id" name="id">
                                <input type="hidden" class="form-control" id="rpa_updated_by" name="updated_by" value="{{Session('nip')}}">
                            </form>
						</div>
                        <div class="card-footer">
                            <div class="form-group">
                                <label for="rpa_murojaahdirumah">Voice Note di Rumah</label>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Mulai Surah</label>
                                        <select id="rpa_murojaahdirumahawal" name="rpa_murojaahdirumahawal" class="form-control select2">
                                            <option value="">Pilih Salah Satu</option>
                                            <option value="manual">Isi Manual</option>
                                            @foreach($mushaflist as $rows)
                                                @php
                                                    $akhir = $rows->jumlah;
                                                    $akhir = $akhir+2;
                                                    for ($i = 1; $i < $akhir; $i++){
                                                        echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                    }
                                                @endphp
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control" id="rpa_murojaahdirumahawalmanual" name="rpa_murojaahdirumahawalmanual">
                                    </div> 
                                    <div class="col-lg-6">
                                        <label>Akhir Surah</label>
                                        <select id="rpa_murojaahdirumahakhir" name="rpa_murojaahdirumahakhir" class="form-control select2">
                                            <option value="">Pilih Salah Satu</option>
                                            <option value="manual">Isi Manual</option>
                                            @foreach($mushaflist as $rows)
                                                @php
                                                    $akhir = $rows->jumlah;
                                                    $akhir = $akhir+2;
                                                    for ($i = 1; $i < $akhir; $i++){
                                                        echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                    }
                                                @endphp
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control" id="rpa_murojaahdirumahakhirmanual" name="rpa_murojaahdirumahakhirmanual">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-outline pull-left btnviewrpa">Cancel</button>
                                <button type="button" class="btn btn-success" id="btnsimpandatarpa">Simpan</button>	
                            </div>
                        </div>
                    </div>
                    <div class="card card-warning card9 shadow" id="divceklistpr">
                        <div class="card-header">
                            <h3 class="card-title" id="judulceklist">Rencana Pembelajaran Al Quran</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnviewrpa" title="Close"><i class="fa fa-close"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridceklistpr"></div>
						</div>
                    </div>
                    <div class="card card-warning card9 shadow" id="divceklisthalaqohsekolah">
                        <div class="card-header">
                            <h3 class="card-title" id="judulceklist">Rencana Pembelajaran Al Quran</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnviewrpa" title="Close"><i class="fa fa-close"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridceklisthalaqohsekolah"></div>
						</div>
                    </div>
                </div>
                <div class="col-md-12 halaqoh sectiontahfid">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title" id="juduldetailalquran">Perkembangan Santri</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body" id="divawalperkemsantri">
                            <div id="gridperkembangansantri"></div>
                        </div>
                        <div class="card-footer" id="divdetperkemsantri">
                            <button class="btn btn-success" id="btnclosedetailperkembangan">Close Detail</button>
                            <button class="btn btn-primary" id="btnexportperkembangan">Export</button>
                            <div id="griddetailperkembangansantri"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 halaqoh sectionsetoran">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Setoran Santri</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnsimpansetoran"><i class="fa fa-database"></i> Save All</button>
                                <button type="button" class="btn btn-tool" id="btnkembalidarisetoran"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <form id="formtambahsetoran" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label>Nama</label>
                                            <input type="text" id="setoran_nama" name="setoran_nama" class="form-control" readonly> 
                                        </div>
                                        <div class="col-lg-2">
                                            <label>No.INDUK</label>
                                            <input type="text" id="setoran_noinduk" name="setoran_noinduk" class="form-control" readonly> 
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Kelas</label>
                                            <input type="text" id="setoran_kelas" name="setoran_kelas" class="form-control" readonly> 
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Tanggal</label>
                                            <input value="{{date('Y-m-d')}}" type="text" class="form-control" name="setoran_tanggal" id="setoran_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card card-primary shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Ziyadah</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Mulai Surah</label>
                                                        <select id="setoran_ziyadahsurahawal" name="setoran_ziyadahsurahawal" class="form-control select2">
                                                            <option value="">Pilih Salah Satu</option>
                                                            @foreach($mushaflist as $rows)
                                                                @php
                                                                    $akhir = $rows->jumlah;
                                                                    $akhir = $akhir+2;
                                                                    for ($i = 1; $i < $akhir; $i++){
                                                                        echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                                    }
                                                                @endphp
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Akhir Surah</label>
                                                        <select id="setoran_ziyadahsurahakhir" name="setoran_ziyadahsurahakhir" class="form-control select2">
                                                            <option value="">Pilih Salah Satu</option>
                                                            @foreach($mushaflist as $rows)
                                                                @php
                                                                    $akhir = $rows->jumlah;
                                                                    $akhir = $akhir+2;
                                                                    for ($i = 1; $i < $akhir; $i++){
                                                                        echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                                    }
                                                                @endphp
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label>Nilai</label>
                                                                <select id="setoran_nilaiziyadah" name="setoran_nilaiziyadah" class="form-control">
                                                                    <option value="">Pilih Salah Satu</option>
                                                                    <option value="ممتاز">ممتاز</option>
                                                                    <option value="جيد جدا">جيد جدا</option>
                                                                    <option value="جيد">جيد</option>
                                                                    <option value="مقبول">مقبول</option>
                                                                    <option value="راسب">راسب</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>Predikat</label>
                                                                <select id="setoran_statusziyadah" name="setoran_statusziyadah"  class="form-control">
                                                                    <option value="">Pilih Salah Satu</option>
                                                                    <option value="Lulus">Lulus</option>
                                                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card card-success shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Murojaah</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Mulai Surah</label>
                                                        <select id="setoran_msurahawal" name="setoran_msurahawal" class="form-control select2">
                                                            <option value="">Pilih Salah Satu</option>
                                                            @foreach($mushaflist as $rows)
                                                                @php
                                                                    $akhir = $rows->jumlah;
                                                                    $akhir = $akhir+2;
                                                                    for ($i = 1; $i < $akhir; $i++){
                                                                        echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                                    }
                                                                @endphp
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Akhir Surah</label>
                                                        <select id="setoran_msurahakhir" name="setoran_msurahakhir" class="form-control select2">
                                                            <option value="">Pilih Salah Satu</option>
                                                            @foreach($mushaflist as $rows)
                                                                @php
                                                                    $akhir = $rows->jumlah;
                                                                    $akhir = $akhir+2;
                                                                    for ($i = 1; $i < $akhir; $i++){
                                                                        echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                                    }
                                                                @endphp
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label>Nilai</label>
                                                                <select id="setoran_nilaimurojaah" name="setoran_nilaimurojaah" class="form-control">
                                                                    <option value="">Pilih Salah Satu</option>
                                                                    <option value="ممتاز">ممتاز</option>
                                                                    <option value="جيد جدا">جيد جدا</option>
                                                                    <option value="جيد">جيد</option>
                                                                    <option value="مقبول">مقبول</option>
                                                                    <option value="راسب">راسب</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>Predikat</label>
                                                                <select id="setoran_statusmurojaah" name="setoran_statusmurojaah"  class="form-control">
                                                                    <option value="">Pilih Salah Satu</option>
                                                                    <option value="Lulus">Lulus</option>
                                                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card card-info shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Tilawah</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Mulai Surah</label>
                                                        <select id="setoran_tilawahsurahawal" name="setoran_tilawahsurahawal" class="form-control select2">
                                                            <option value="">Pilih Salah Satu</option>
                                                            @php
                                                            for($y = 1; $y < 31; $y++){
                                                                echo '<option value="IQRO1 Hal '.$y.'">IQRO1 Halaman '.$y.'</option>';
                                                            }
                                                            for($y = 1; $y < 31; $y++){
                                                                echo '<option value="IQRO2 Hal '.$y.'">IQRO2 Halaman '.$y.'</option>';
                                                            }
                                                            for($y = 1; $y < 31; $y++){
                                                                echo '<option value="IQRO3 Hal '.$y.'">IQRO3 Halaman '.$y.'</option>';
                                                            }
                                                            for($y = 1; $y < 31; $y++){
                                                                echo '<option value="IQRO4 Hal '.$y.'">IQRO4 Halaman '.$y.'</option>';
                                                            }
                                                            for($y = 1; $y < 31; $y++){
                                                                echo '<option value="IQRO5 Hal '.$y.'">IQRO5 Halaman '.$y.'</option>';
                                                            }
                                                            for($y = 1; $y < 31; $y++){
                                                                echo '<option value="IQRO6 Hal '.$y.'">IQRO6 Halaman '.$y.'</option>';
                                                            }
                                                            @endphp
                                                            @foreach($mushaflist as $rows)
                                                                @php
                                                                    $akhir = $rows->jumlah;
                                                                    $akhir = $akhir+2;
                                                                    for ($i = 1; $i < $akhir; $i++){
                                                                        echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                                    }
                                                                @endphp
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Akhir Surah</label>
                                                        <select id="setoran_tilawahsurahakhir" name="setoran_tilawahsurahakhir" class="form-control select2">
                                                            <option value="">Pilih Salah Satu</option>
                                                            @php
                                                            for($y = 1; $y < 31; $y++){
                                                                echo '<option value="IQRO1 Hal '.$y.'">IQRO1 Halaman '.$y.'</option>';
                                                            }
                                                            for($y = 1; $y < 31; $y++){
                                                                echo '<option value="IQRO2 Hal '.$y.'">IQRO2 Halaman '.$y.'</option>';
                                                            }
                                                            for($y = 1; $y < 31; $y++){
                                                                echo '<option value="IQRO3 Hal '.$y.'">IQRO3 Halaman '.$y.'</option>';
                                                            }
                                                            for($y = 1; $y < 31; $y++){
                                                                echo '<option value="IQRO4 Hal '.$y.'">IQRO4 Halaman '.$y.'</option>';
                                                            }
                                                            for($y = 1; $y < 31; $y++){
                                                                echo '<option value="IQRO5 Hal '.$y.'">IQRO5 Halaman '.$y.'</option>';
                                                            }
                                                            for($y = 1; $y < 31; $y++){
                                                                echo '<option value="IQRO6 Hal '.$y.'">IQRO6 Halaman '.$y.'</option>';
                                                            }
                                                            @endphp
                                                            @foreach($mushaflist as $rows)
                                                                @php
                                                                    $akhir = $rows->jumlah;
                                                                    $akhir = $akhir+2;
                                                                    for ($i = 1; $i < $akhir; $i++){
                                                                        echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                                    }
                                                                @endphp
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label>Nilai</label>
                                                                <select id="setoran_nilaitilawah" name="setoran_nilaitilawah" class="form-control">
                                                                    <option value="">Pilih Salah Satu</option>
                                                                    <option value="ممتاز">ممتاز</option>
                                                                    <option value="جيد جدا">جيد جدا</option>
                                                                    <option value="جيد">جيد</option>
                                                                    <option value="مقبول">مقبول</option>
                                                                    <option value="راسب">راسب</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>Predikat</label>
                                                                <select id="setoran_statustilawah" name="setoran_statustilawah"  class="form-control">
                                                                    <option value="">Pilih Salah Satu</option>
                                                                    <option value="Lulus">Lulus</option>
                                                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card card-success shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Tahsin</h3>
                                                </div>
                                                <div class="card-body">
                                                    <textarea id="setoran_tahsin" name="setoran_tahsin" rows="10" cols="80"></textarea>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label>Nilai</label>
                                                                <select id="setoran_nilaitahsin" name="setoran_nilaitahsin" class="form-control">
                                                                    <option value="">Pilih Salah Satu</option>
                                                                    <option value="ممتاز">ممتاز</option>
                                                                    <option value="جيد جدا">جيد جدا</option>
                                                                    <option value="جيد">جيد</option>
                                                                    <option value="مقبول">مقبول</option>
                                                                    <option value="راسب">راسب</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>Predikat</label>
                                                                <select id="setoran_statustahsin" name="setoran_statustahsin"  class="form-control">
                                                                    <option value="">Pilih Salah Satu</option>
                                                                    <option value="Lulus">Lulus</option>
                                                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="setoran_catatan" name="setoran_catatan" placeholder="Catatan Penting Lainnya"/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-book"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="btn btn-primary btnsimpansetoran">
                                                <i class="fa fa-save"></i> Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 halaqoh sectionsetoran">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Mushaf</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btnclosemushaf"><i class="fa fa-ban"></i></button>
                            </div>
                        </div>
                        <div class="card-body row">
                            <div class="col-lg-12">
                                <select id="mushaf_list" name="mushaf_list" class="form-control select2">
                                    <option value="">Pilih Salah Satu</option>
                                    @foreach($mushaflist as $rows)
                                        <option value="{{ $rows['id'] }}" surah="{{ $rows['surah'] }}" >{{ $rows['surah'] }} ( {{ $rows['makna'] }} - {{ $rows['jumlah'] }} - {{ $rows['jenis'] }} )</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <section class="jumbotron">
                                    <div class="container-fluid">
                                        <div style="text-align: center;" id="loadingview"></div>
                                    </div>
                                    <h1 class="mt-4" id="surahtitle" style="text-align: center;"></h1>
                                    <div id="surah" style="margin: 20;" class="direct-chat-messages"></div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 halaqoh sectionujian">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Pilih Peserta Ujian</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>TAPEL</label>
                                        <input type="text" name="arsip_tapel" id="arsip_tapel" class="form-control" value="{{$tapel}}" placeholder="Format : xxxx-xxxx">
                                    </div> 
                                    <div class="col-lg-4">
                                        <label>Semester</label>
                                        <select id="arsip_semester" name="arsip_semester" class="form-control" >
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
                                    <div class="col-lg-4">
                                        <button type="button" class="btn btn-success btn-app" id="btnviewarsip"><i class="fa fa-newspaper-o"></i>View Arsip</button>
								    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="gridsantri"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 halaqoh" id="divkertasujian">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Lembar Penilaian</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="ujian_nama">Nama</label>
                                        <input type="text" class="form-control" id="ujian_nama" name="ujian_nama" readonly>
                                    </div> 
                                    <div class="col-lg-2">
                                        <label for="ujian_noinduk">No Induk</label>
                                        <input type="text" class="form-control" id="ujian_noinduk" name="ujian_noinduk" readonly>
                                        <input type="hidden" id="ujian_foto" name="ujian_foto">
                                        <input type="hidden" id="ujian_kelas" name="ujian_kelas" readonly>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="ujian_semester">Semester</label>
                                        <input type="text" class="form-control" id="ujian_semester" name="ujian_semester" value="{{$smt}}" readonly>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="ujian_tapel">Tapel</label>
                                        <input type="text" class="form-control" id="ujian_tapel" name="ujian_tapel" value="{{$tapel}}" readonly>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="ujian_jenis">Jenis Ujian</label>
                                        <select id="ujian_jenis" name="ujian_jenis" class="form-control" >
                                            <option value="UTS">Tengah Semester</option>
                                            <option value="UAS">Akhir Semester</option>
                                            @php
                                                for($i = 0; $i < count($juznumberonly); $i++) {
                                                    echo '<option value="'.$juznumberonly[$i].'">Penilaian Juz '.$juznumberonly[$i].'</option>';
                                                }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group detailperhalaman">
                                <button class="btn btn-lg btn-success" id="btngotoreview"> Review Hasil <i class="fa fa-hand-o-right"></i></button>
                            </div>
                        </div>
                        <div class="card-footer detailperhalaman">
                            <h3><i class="fa fa-calendar-check-o"></i> Pilih Juz</h3>
                            <div class="card card-primary shadow">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        @php 
                                            $aktif = 'belum';
                                        @endphp
                                        @php
                                            for($i = 0; $i < count($juznumberonly); $i++) {
                                                if ($aktif == 'belum'){
                                                    $aktif = 'active';
                                                } else {
                                                    $aktif = '';
                                                }
                                                echo '<li class="nav-item"><a class="nav-link '.$aktif.'" href="#juz'.$juznumberonly[$i].'" data-toggle="tab">'.$juznumberonly[$i].'</a></li>';
                                                $aktif = 'sudah';
                                            }
                                        @endphp
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <form id="forminputujian" method="post" enctype="multipart/form-data">
                                        <div class="tab-content">
                                            @php 
                                                $aktif = 'belum';
                                            @endphp
                                            @if(isset($halamanmushaf) && !empty($halamanmushaf))
                                                @php
                                                    $keys = array_keys($halamanmushaf);
                                                    for($i = 0; $i < count($halamanmushaf); $i++) {
                                                        if ($aktif == 'belum'){
                                                            $aktif = 'active';
                                                        } else {
                                                            $aktif = '';
                                                        }
                                                @endphp
                                                    <div class="tab-pane {{$aktif}}" id="juz{{ $juznumberonly[$i] }}"><div class="card">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nama Surah</th>
                                                                    <th>Halaman</th>
                                                                    <th>Jumlah Kata</th>
                                                                    <th>Nilai Maksimal</th>
                                                                    <th>Jumlah Kesalahan</th>
                                                                    <th>Nilai Kesalahan</th>
                                                                    <th>Nilai Persurat</th>
                                                                    <th>Predikat</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                        @php
                                                            $x = 0; 
                                                            foreach($halamanmushaf[$keys[$i]] as $key => $value) {
                                                        @endphp
                                                            <tr>
                                                                <td>{{ $value['namasurah'] }}</td>
                                                                <td>{{ $value['halaman'] }}</td>
                                                                <td>{{ $value['kata'] }}</td>
                                                                <td>100</td>
                                                                <td>
                                                                    <select name="nilai[{{$x}}][jumlahkesalahan]" class="form-control selectornilai">
                                                                        <option value="" penanda="{{$value['id']}}" penandajuz="{{$juznumberonly[$i]}}">Pilih Nilai</option>
                                                                        @php
                                                                        for($y = 0; $y < 250; $y++){
                                                                            echo '<option value="'.$y.'" penanda="'.$value['id'].'" penandajuz="'.$juznumberonly[$i].'">'.$y.'</option>';
                                                                        }
                                                                        @endphp
                                                                    </select>
                                                                    <input type="hidden" id="nilaikesalahan_{{ $value['id'] }}" name="nilai[{{$x}}][nilaikesalahan]"  class="clearvalue" />
                                                                    <input type="hidden" id="nilaipersurat_{{ $value['id'] }}" name="nilai[{{$x}}][nilaipersurat]" class="clearvalue niljuz{{ $juznumberonly[$i] }}"/>
                                                                    <input type="hidden" id="predikat_{{ $value['id'] }}" name="nilai[{{$x}}][predikat]" class="clearvalue"/>
                                                                    <input type="hidden" id="namasurah_{{ $value['id'] }}" name="nilai[{{$x}}][namasurah]" value="{{ $value['namasurah'] }}"/>
                                                                    <input type="hidden" id="halaman_{{ $value['id'] }}" name="nilai[{{$x}}][halaman]" value="{{ $value['halaman'] }}"/>
                                                                    <input type="hidden" id="kata_{{ $value['id'] }}" name="nilai[{{$x}}][kata]" value="{{ $value['kata'] }}"/>
                                                                    <input type="hidden" id="juz_{{ $value['id'] }}" name="nilai[{{$x}}][juz]" value="Juz {{ $juznumberonly[$i] }}"/>
                                                                </td>
                                                                <td><span class="navalue badge badge-info float-right" id="tlsnilaikesalahan_{{ $value['id'] }}">n/a</span></td>
                                                                <td><span class="navalue badge badge-warning float-right" id="tlsnilaisurat_{{ $value['id'] }}">n/a</span></td>
                                                                <td><span class="navalue badge badge-danger float-right" id="tlspredikat_{{ $value['id'] }}">n/a</span></td>
                                                            </tr>
                                                        @php
                                                                $aktif = 'sudah';
                                                                $x++;
                                                            }
                                                        @endphp
                                                            <tr>
                                                                <td colspan="6">Nilai Rata-Rata Juz {{ $juznumberonly[$i] }}</td>
                                                                <td><span class="navalue badge badge-primary float-right tlsnilaijuz_{{ $juznumberonly[$i] }}">n/a</span></td>
                                                                <td></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div></div>
                                                @php
                                                }
                                                @endphp
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
						</div>
                        <div class="card-footer reviewujian">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="ujian_hariefektif">Hari Efektif <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="ujian_hariefektif" name="ujian_hariefektif">
                                        </div> 
                                        <div class="col-lg-6">
                                            <label for="ujian_tanggal">Tanggal Rapot <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="ujian_tanggal" name="ujian_tanggal" value="{{date('Y-m-d')}}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="ujian_prszydsekolah">Jumlah Ziyadah di Sekolah</label>
                                            <input type="text" class="form-control" id="ujian_prszydsekolah" name="ujian_prszydsekolah">
                                        </div> 
                                        <div class="col-lg-6">
                                            <label for="ujian_prsmrjsekolah">Jumlah Murojaah di Sekolah</label>
                                            <input type="text" class="form-control" id="ujian_prsmrjsekolah" name="ujian_prsmrjsekolah">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="ujian_prszydrumah">Jumlah Voice Note</label>
                                            <input type="text" class="form-control" id="ujian_prszydrumah" name="ujian_prszydrumah">
                                        </div> 
                                        <div class="col-lg-6">
                                            <label for="ujian_prsmrjrumah">Jumlah Murojaah di Rumah</label>
                                            <input type="text" class="form-control" id="ujian_prsmrjrumah" name="ujian_prsmrjrumah">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 1:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_1">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 2:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_2">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 3:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_3">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 4:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_4">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 5:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_5">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 6:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_6">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 7:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_7">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 8:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_8">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 9:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_9">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 10:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_10">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 11:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_11">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 12:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_12">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 13:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_13">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 14:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_14">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 15:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_15">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 16:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_16">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 17:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_17">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 18:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_18">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 19:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_19">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 20:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_20">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 21:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_21">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 22:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_22">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 23:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_23">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 24:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_24">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 25:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_25">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 26:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_26">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 27:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_27">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 28:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_28">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 29:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_29">n/a</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-7 col-form-label">Nilai Juz 30:</label>
                                    <div class="col-sm-5">
                                        <span class="navalue badge badge-primary float-right tlsnilaijuz_30">n/a</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button class="btn btn-lg btn-success" id="btngotodetailperhalaman"><i class="fa fa-hand-o-left"></i> Kembali Ke Pengisian</button>
                                    </div>
                                    <div class="col-lg-6">
                                        <button class="btn btn-lg btn-success" id="btnsimpanujianalquran"> Simpan dan Kirim Ke Waka Kurikulum <i class="fa fa-envelope-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 halaqoh" id="divriwayat">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Penilaian Per Juz</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            Catatan : Untuk Merubah Data, Bapak / Ibu Cukup Click Kembali Nama Siswa Kemudian Masukkan Nilai Tambahannya (Data Yang Lama Tidak Tampak di Penggisian). Maka otomatis data akan ditambahkan ke data lama yang sudah Bapak/Ibu Masukkan Sebelumnya
                        </div>
                        <div class="card-footer">
                            <div id="gridriwayat"></div>
                        </div>
                    </div>
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Penilaian Per Tengah Semester</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridriwayatuts"></div>
                        </div>
                    </div>
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Penilaian Per Akhir Semester</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridriwayatuas"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 halaqoh" id="diveditorujianalquran">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Editor Penilaian Ujian AlQuran</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btnboxkembalikearsip"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="editorujian_nama">Nama</label>
                                        <input type="text" class="form-control" id="editorujian_nama" name="editorujian_nama" readonly>
                                    </div> 
                                    <div class="col-lg-2">
                                        <label for="editorujian_noinduk">No Induk</label>
                                        <input type="text" class="form-control" id="editorujian_noinduk" name="editorujian_noinduk" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="editorujian_foto">Tempat, Tanggal Lahir</label>
                                        <input type="text" class="form-control" id="editorujian_foto" name="editorujian_foto">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="editorujian_sakit">Sakit</label>
                                        <input type="text" class="form-control" id="editorujian_sakit" name="editorujian_sakit">
                                    </div> 
                                    <div class="col-lg-2">
                                        <label for="editorujian_ijin">Ijin</label>
                                        <input type="text" class="form-control" id="editorujian_ijin" name="editorujian_ijin">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="editorujian_alpha">Alpha</label>
                                        <input type="text" class="form-control" id="editorujian_alpha" name="editorujian_alpha">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="editorujian_hariefektif">Hari Efektif</label>
                                        <input type="text" class="form-control" id="editorujian_hariefektif" name="editorujian_hariefektif">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="editorujian_setoransekolah">Sekolah (Z;M)</label>
                                        <input type="text" class="form-control" id="editorujian_setoransekolah" name="editorujian_setoransekolah">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="editorujian_setoranrumah">Rumah (V;M)</label>
                                        <input type="text" class="form-control" id="editorujian_setoranrumah" name="editorujian_setoranrumah">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="editorujian_kelas">Kelas</label>
                                        <input type="text" class="form-control" id="editorujian_kelas" name="editorujian_kelas">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="editorujian_semester">Semester</label>
                                        <input type="text" class="form-control" id="editorujian_semester" name="editorujian_semester">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="editorujian_tapel">Tapel</label>
                                        <input type="text" class="form-control" id="editorujian_tapel" name="editorujian_tapel">
                                        <input type="hidden" class="form-control" id="editorujian_tapelsemester" name="editorujian_tapelsemester">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="editorujian_tanggal">Tanggal</label>
                                        <input type="text" class="form-control" id="editorujian_tanggal" name="editorujian_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="editorujian_jenis">Jenis Ujian</label>
                                        <select id="editorujian_jenis" name="editorujian_jenis" class="form-control" >
                                            <option value="UTS">Tengah Semester</option>
                                            <option value="UAS">Akhir Semester</option>
                                            @php
                                                for($i = 0; $i < count($juznumberonly); $i++) {
                                                    echo '<option value="'.$juznumberonly[$i].'">Penilaian Juz '.$juznumberonly[$i].'</option>';
                                                }
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editorujian_namapengguji">Nama Penguji</label>
                                <input type="text" class="form-control" id="editorujian_namapengguji" name="editorujian_namapengguji">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="button" class="btn btn-success btn-app" id="btnupdatedataujianalquranedit"><i class="fa fa-save"></i> Save</button>
                                    </div>
                                    <div class="col-lg-6">
                                        <button type="button" class="btn btn-warning btn-app" id="btnkirimdataujianalquranedit"><i class="fa fa-send-o"></i> Kirim ke WAKA dan KS</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="gridriwayatujianalquran"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<div class="modal fade" id="modaledittemplate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Template</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="template_nama">Nama Surah</label>
                            <input type="text" class="form-control" id="template_nama" name="template_nama">
                        </div> 
                        <div class="col-lg-3">
                            <label for="template_halaman">Halaman</label>
                            <input type="text" class="form-control" id="template_halaman" name="template_halaman">
                        </div>
                        <div class="col-lg-3">
                            <label for="template_kata">Jumlah Kata</label>
                            <input type="text" class="form-control" id="template_kata" name="template_kata">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="template_id" name="template_id">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpantemplate">Simpan</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaleditkelasalquran">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Kelas Al Quran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="kelas_nama">Nama Siswa</label>
                            <input type="text" class="form-control" id="kelas_nama" name="kelas_nama" readonly="readonly">
                        </div> 
                        <div class="col-lg-3">
                            <label for="kelas_noinduk">Nomor Induk</label>
                            <input type="text" class="form-control" id="kelas_noinduk" name="kelas_noinduk" readonly="readonly">
                        </div>
                        <div class="col-lg-3">
                            <label for="kelas_klspos">Kelas Umum</label>
                            <input type="text" class="form-control" id="kelas_klspos" name="kelas_klspos" readonly="readonly">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Kelas Halaqoh</label>
                    <select id="kelas_alquran" name="kelas_alquran" class="form-control">
                        <option value="">Pilih Salah Satu</option>
                        @if(isset($kelasrpa) && !empty($kelasrpa))
                            @foreach($kelasrpa as $rkelas)
                                <option value="{{$rkelas->kelas}}">{{$rkelas->kelas}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="kelas_idne" name="kelas_idne">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpanmappingkelas">Simpan</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalpenilaianprmurojaah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Penilaian Murojaah di Rumah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="murojaah_nama">Nama</label>
                            <input type="text" class="form-control" id="murojaah_nama" name="murojaah_nama" readonly>
                        </div> 
                        <div class="col-lg-3">
                            <label for="murojaah_kelas">Kelas</label>
                            <input type="text" class="form-control" id="murojaah_kelas" name="murojaah_kelas" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="murojaah_noinduk">No Induk</label>
                            <input type="text" class="form-control" id="murojaah_noinduk" name="murojaah_noinduk" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Mulai Surah</label>
                    <select id="murojaah_murojaahdirumahawal" name="murojaah_murojaahdirumahawal" class="form-control" readonly>
                        <option value="">Pilih Salah Satu</option>
                        @foreach($mushaflist as $rows)
                            @php
                                $akhir = $rows->jumlah;
                                $akhir = $akhir+2;
                                for ($i = 1; $i < $akhir; $i++){
                                    echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                }
                            @endphp
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Akhir Surah</label>
                    <select id="murojaah_murojaahdirumahakhir" name="murojaah_murojaahdirumahakhir" class="form-control" readonly>
                        <option value="">Pilih Salah Satu</option>
                        @foreach($mushaflist as $rows)
                            @php
                                $akhir = $rows->jumlah;
                                $akhir = $akhir+2;
                                for ($i = 1; $i < $akhir; $i++){
                                    echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                }
                            @endphp
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <select id="murojaah_nilai" name="setoran_nilaimurojaah" class="form-control">
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="ممتاز">ممتاز</option>
                                    <option value="جيد جدا">جيد جدا</option>
                                    <option value="جيد">جيد</option>
                                    <option value="مقبول">مقبول</option>
                                    <option value="راسب">راسب</option>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">Nilai</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <select id="murojaah_status" name="setoran_statusmurojaah"  class="form-control">
                                    <option value="Lulus">Lulus</option>
                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">Predikat</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" class="form-control" id="murojaah_catatan" name="murojaah_catatan" placeholder="Catatan Penting Lainnya"/>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-book"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" id="murojaah_tanggal" name="murojaah_tanggal" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="idmurojaah" name="idmurojaah">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpannilaiprmurojaah">Simpan</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalpenilaianprmurojaahdisekolah">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Penilaian Murojaah di Sekolah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="laphalaqohsekolah_nama">Nama</label>
                            <input type="text" class="form-control" id="laphalaqohsekolah_nama" name="laphalaqohsekolah_nama" readonly>
                        </div> 
                        <div class="col-lg-3">
                            <label for="laphalaqohsekolah_kelas">Kelas</label>
                            <input type="text" class="form-control" id="laphalaqohsekolah_kelas" name="laphalaqohsekolah_kelas" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="laphalaqohsekolah_noinduk">No Induk</label>
                            <input type="text" class="form-control" id="laphalaqohsekolah_noinduk" name="laphalaqohsekolah_noinduk" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">Murojaah</div>
                                </div>
                                <input type="text" class="form-control" id="laphalaqohsekolah_mt" name="laphalaqohsekolah_mt" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">N</div>
                                </div>
                                <select id="laphalaqohsekolah_mn" name="laphalaqohsekolah_mn" class="form-control">
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="ممتاز">ممتاز</option>
                                    <option value="جيد جدا">جيد جدا</option>
                                    <option value="جيد">جيد</option>
                                    <option value="مقبول">مقبول</option>
                                    <option value="راسب">راسب</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">P</div>
                                </div>
                                <select id="laphalaqohsekolah_ms" name="laphalaqohsekolah_ms" class="form-control">
                                    <option value="Lulus">Lulus</option>
                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">Ziyadah</div>
                                </div>
                                <input type="text" class="form-control" id="laphalaqohsekolah_zt" name="laphalaqohsekolah_zt" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">N</div>
                                </div>
                                <select id="laphalaqohsekolah_zn" name="laphalaqohsekolah_zn" class="form-control">
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="ممتاز">ممتاز</option>
                                    <option value="جيد جدا">جيد جدا</option>
                                    <option value="جيد">جيد</option>
                                    <option value="مقبول">مقبول</option>
                                    <option value="راسب">راسب</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">P</div>
                                </div>
                                <select id="laphalaqohsekolah_zs" name="laphalaqohsekolah_zs" class="form-control">
                                    <option value="Lulus">Lulus</option>
                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">Tilawah</div>
                                </div>
                                <input type="text" class="form-control" id="laphalaqohsekolah_tit" name="laphalaqohsekolah_tit">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">N</div>
                                </div>
                                <select id="laphalaqohsekolah_tin" name="laphalaqohsekolah_tin" class="form-control">
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="ممتاز">ممتاز</option>
                                    <option value="جيد جدا">جيد جدا</option>
                                    <option value="جيد">جيد</option>
                                    <option value="مقبول">مقبول</option>
                                    <option value="راسب">راسب</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">P</div>
                                </div>
                                <select id="laphalaqohsekolah_tis" name="laphalaqohsekolah_tis" class="form-control">
                                    <option value="Lulus">Lulus</option>
                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Tahsin</label>
                                <textarea id="laphalaqohsekolah_tt" name="laphalaqohsekolah_tt" rows="10" cols="80"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">Nilai</div>
                                </div>
                                <select id="laphalaqohsekolah_tn" name="laphalaqohsekolah_tn" class="form-control">
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="ممتاز">ممتاز</option>
                                    <option value="جيد جدا">جيد جدا</option>
                                    <option value="جيد">جيد</option>
                                    <option value="مقبول">مقبول</option>
                                    <option value="راسب">راسب</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text">Predikat</div>
                                </div>
                                <select id="laphalaqohsekolah_ts" name="laphalaqohsekolah_ts" class="form-control">
                                    <option value="Lulus">Lulus</option>
                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" class="form-control" id="laphalaqohsekolah_catatan" name="laphalaqohsekolah_catatan" placeholder="Catatan Penting Lainnya"/>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-book"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" id="laphalaqohsekolah_tanggal" name="laphalaqohsekolah_tanggal" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpannilaihalaqohsekolahnew">Simpan</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaleditorpenilaianujianalquran">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Penilaian Ujian Al Quran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="modaleditorujian_nama">Nama</label>
                            <input type="text" class="form-control" id="modaleditorujian_nama" name="modaleditorujian_nama" readonly>
                        </div> 
                        <div class="col-lg-2">
                            <label for="modaleditorujian_kelas">Kelas</label>
                            <input type="text" class="form-control" id="modaleditorujian_kelas" name="modaleditorujian_kelas" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="modaleditorujian_noinduk">No Induk</label>
                            <input type="text" class="form-control" id="modaleditorujian_noinduk" name="modaleditorujian_noinduk" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="modaleditorujian_semester">Semester</label>
                            <input type="text" class="form-control" id="modaleditorujian_semester" name="modaleditorujian_semester" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="modaleditorujian_tapel">TAPEL</label>
                            <input type="text" class="form-control" id="modaleditorujian_tapel" name="modaleditorujian_tapel" readonly>
                            <input type="hidden" id="modaleditorujian_tapelsemester" name="modaleditorujian_tapelsemester">
                            <input type="hidden" id="modaleditorujian_hariefektif" name="modaleditorujian_hariefektif">
                            <input type="hidden" id="modaleditorujian_prszydsekolah" name="modaleditorujian_prszydsekolah">
                            <input type="hidden" id="modaleditorujian_prsmrjsekolah" name="modaleditorujian_prsmrjsekolah">
                            <input type="hidden" id="modaleditorujian_foto" name="modaleditorujian_foto">
                            <input type="hidden" id="modaleditorujian_jenis" name="modaleditorujian_jenis">
                            <input type="hidden" id="modaleditorujian_prszydrumah" name="modaleditorujian_prszydrumah">
                            <input type="hidden" id="modaleditorujian_prsmrjrumah" name="modaleditorujian_prsmrjrumah">
                        </div>
                        <div class="col-lg-4">
                            <label for="modaleditorujian_juzhalaman">Juz / Hal</label>
                            <input type="text" class="form-control" id="modaleditorujian_juzhalaman" name="modaleditorujian_juzhalaman" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="modaleditorujian_jumlahkata">Jumlah Kata</label>
                            <input type="text" class="form-control" id="modaleditorujian_jumlahkata" name="modaleditorujian_jumlahkata" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="modaleditorujian_jumlahkesalahan">Jumlah Kesalahan</label>
                            <select name="modaleditorujian_jumlahkesalahan" id="modaleditorujian_jumlahkesalahan" class="form-control">
                                <option value="">Pilih Nilai</option>
                                @php
                                for($y = 0; $y < 250; $y++){
                                    echo '<option value="'.$y.'">'.$y.'</option>';
                                }
                                @endphp
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="modaleditorujian_nilaikesalahan">Nilai Kesalahan</label>
                            <input type="text" class="form-control" id="modaleditorujian_nilaikesalahan" name="modaleditorujian_nilaikesalahan" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="modaleditorujian_nilaipersurat">Nilai Persurat</label>
                            <input type="text" class="form-control" id="modaleditorujian_nilaipersurat" name="modaleditorujian_nilaipersurat" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="modaleditorujian_predikat">Predikat</label>
                            <input type="text" class="form-control" id="modaleditorujian_predikat" name="modaleditorujian_predikat" readonly>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="modaleditorujian_id" name="modaleditorujian_id">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpannilaiujianedit">Simpan</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalpilihanujian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Jenis Ujian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select id="sel_ujian_jenis" name="sel_ujian_jenis" class="form-control" >
                        <option value="">Pilih Salah Satu</option>
                        <option value="UTS">Tengah Semester</option>
                        <option value="UAS">Akhir Semester</option>
                        @php
                            for($i = 0; $i < count($juznumberonly); $i++) {
                                echo '<option value="'.$juznumberonly[$i].'">Penilaian Juz '.$juznumberonly[$i].'</option>';
                            }
                        @endphp
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnopenlembarujian">Set Jenis Ujian</button>	
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" id="mas_semester" name="mas_semester" value="{{ $smt }}">
<input type="hidden" id="mas_tapel" name="mas_tapel" value="{{ $tapel }}">
<input type="hidden" id="mas_niyguru" name="mas_niyguru" value="{{ Session('id') }}">
<input type="hidden" name="idekskul" id="idekskul" value="{{ $masterkls }}">
<input type="hidden" name="set_tanggal" id="set_tanggal" value="{{ date('Y-m-d') }}">

@endsection
@push('script')
<script>
    $(function () {
        $('.select2').select2({width: '100%'});
        $('#listhalamanmushaf').on('click', '.edittemplate', function () {
            var set01       = $(this).attr('id');	
            var set02       = $(this).attr('val01');	
            var set03       = $(this).attr('val02');
            var set04       = $(this).attr('val03');
            $("#template_id").val(set01);
            $("#template_kata").val(set04);
            $('#template_halaman').val(set03);
            $('#template_nama').val(set02);
            $("#modaledittemplate").modal('show');
        });
        CKEDITOR.env.isCompatible = true;
        CKEDITOR.replace( 'setoran_tahsin', {
			toolbarGroups: [{"name":"paragraph","groups":["list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
        CKEDITOR.replace( 'laphalaqohsekolah_tt', {
			toolbarGroups: [{"name":"paragraph","groups":["list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
		$('#set_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#absen_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#setoran_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#ujian_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#editorujian_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
    });
    function jQueryOpenRPA(set01){
        $(".divpanel").hide();
        $(".card9").hide();
        $(".divrpa").show();
        var tahun   = document.getElementById('id_mastertahun').value;
        var set02	= document.getElementById('mas_tapel').value;
        var set03	= document.getElementById('mas_semester').value;
        if (set02 == '' || set02 == null){
            swal({
                title	: 'Stop',
                text	: 'Bapak/Ibu belum mengisi Tahun Pelajaran (TAPEL) dan Semester di Kotak Setting Sebelah Kiri Paling Bawah',
                type	: 'warning',
            })
        } else {
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'id', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'pekan', type: 'text'},
                    { name: 'pb', type: 'text'},
                    { name: 'tahun', type: 'text'},
                    { name: 'bulan', type: 'text'},
                    { name: 'hari', type: 'text'},
                    { name: 'tanggal', type: 'text'},
                    { name: 'realdate', type: 'text'},
                    { name: 'hal', type: 'text'},
                    { name: 'murojaahkemarin', type: 'text'},
                    { name: 'mendengaraudio', type: 'text'},
                    { name: 'sholatdhuha', type: 'text'},
                    { name: 'murojaahhariini', type: 'text'},
                    { name: 'tahsin', type: 'text'},
                    { name: 'tilawah', type: 'text'},
                    { name: 'persiapanhafalanbesok', type: 'text'},
                    { name: 'murojaahdirumah', type: 'text'},
                    { name: 'murojaahsabtuahad', type: 'text'},
                    { name: 'created_by', type: 'text'},
                    { name: 'updated_by', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, tahun:tahun, workcode:'rpaperkelas', _token: '{{ csrf_token() }}'},
                url : '{{ route("jsonDataRPA") }}'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#gridrpa").jqxGrid({
                width           : '100%',
                pageable        : true,
                autoheight      : true,
                filterable      : true,
                showfilterrow   : true,
                columnsresize   : true,
                source          : dataAdapter,
                sortable        : true,
                columnsresize   : true,
                altrows         : true,
                theme           : "energyblue",
                columns         : [
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '7%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridrpa").offset();
                            var dataRecord 	= $("#gridrpa").jqxGrid('getrowdata', editrow);
                            var sesi        = "{{Session('previlage')}}";
                            $("#rpa_pekan").val(dataRecord.pekan);
                            $("#rpa_pb").val(dataRecord.pb);
                            $("#rpa_tanggal").val(dataRecord.realdate);
                            $("#rpa_hal").val(dataRecord.hal);
                            $("#rpa_murojaahkemarin").val(dataRecord.murojaahkemarin);
                            $("#rpa_mendengaraudio").val(dataRecord.mendengaraudio);
                            $("#rpa_sholatdhuha").val(dataRecord.sholatdhuha);
                            $("#rpa_murojaahhariini").val(dataRecord.murojaahhariini);
                            $("#rpa_tahsin").val(dataRecord.tahsin);
                            $("#rpa_tilawah").val(dataRecord.tilawah);
                            $("#rpa_persiapanhafalanbesok").val(dataRecord.persiapanhafalanbesok);
                            $("#rpa_murojaahdirumah").val(dataRecord.murojaahdirumah);
                            $("#rpa_murojaahsabtuahad").val(dataRecord.murojaahsabtuahad);
                            $("#rpa_id").val(dataRecord.id);
                            $(".card9").hide();
                            $("#modalrpa").show();
                        }
                    },
                    { text: 'Halaqoh', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '8%', cellsrenderer: function () {
                        return "di Sekolah";
                        }, buttonclick: function (row) {
                            editrow         = row;
                            var offset 		= $("#gridrpa").offset();
                            var dataRecord 	= $("#gridrpa").jqxGrid('getrowdata', editrow);
                            var murojaahdirumah = dataRecord.murojaahdirumah;
                            const arrkode = murojaahdirumah.split("s/d");
                            
                            if (typeof(arrkode[1]) !== "undefined" && arrkode[1] !== null) {
                                murojaah_mulaiayat = arrkode[0];
                                murojaah_akhirayat = arrkode[1];
                            } else {
                                murojaah_mulaiayat = 0;
                                murojaah_akhirayat = 0;
                            }
                            $("#laphalaqohsekolah_mt").val(dataRecord.murojaahhariini);
                            $("#laphalaqohsekolah_zt").val(dataRecord.mendengaraudio);
                            $("#laphalaqohsekolah_tit").val(dataRecord.tilawah);
                            CKEDITOR.instances['laphalaqohsekolah_tt'].setData(dataRecord.tahsin)
                            var sourceJson  = {
                                datatype: "json",
                                datafields: [
                                    { name: 'id'},
                                    { name: 'foto', type: 'text'},
                                    { name: 'noinduk', type: 'text'},
                                    { name: 'nama', type: 'text'},
                                    { name: 'jilid', type: 'text'},
                                    { name: 'kelas', type: 'text'},
                                    { name: 'tapel', type: 'text'},
                                    { name: 'tanggal', type: 'text'},
                                    { name: 'ziyadah_nilai', type: 'text'},
                                    { name: 'ziyadah_predikat', type: 'text'},
                                    { name: 'murojaah_nilai', type: 'text'},
                                    { name: 'murojaah_predikat', type: 'text'},
                                    { name: 'tahsin_nilai', type: 'text'},
                                    { name: 'tahsin_predikat', type: 'text'},
                                    { name: 'tilawah_nilai', type: 'text'},
                                    { name: 'tilawah_predikat', type: 'text'},
                                    { name: 'catatan', type: 'text'},
                                    { name: 'inputor', type: 'text'},
                                    { name: 'idmurojaah', type: 'text'},
                                ],
                                type: 'POST',
                                data: {	val01:dataRecord.kelas, val02:dataRecord.realdate, val03:'murojaahdisekolah', val04:dataRecord.id, val05:dataRecord.murojaahdirumah, _token: '{{ csrf_token() }}' },
                                url: '{{ route("jsonSetoranTahfid") }}',
                            };
                            $(".card9").hide();
                            $("#divceklisthalaqohsekolah").show();
                            var dataJson = new $.jqx.dataAdapter(sourceJson);
                            $("#gridceklisthalaqohsekolah").jqxGrid({
                                width           : '100%',
                                source          : dataJson,
                                autoheight      : true,
                                filterable      : true,
                                theme           : "orange",
                                columnsresize   : true,
                                rowsheight      : 40,
                                selectionmode   : 'multiplecellsextended',
                                columns         : [
                                    { text: 'Ustad / Ustadzah', editable: false, sortable: false, filterable: false, datafield: 'inputor', width: '12%', cellsalign: 'left', align: 'center' },
                                    { text: 'Photo',  editable: false, sortable: false, filterable: false, datafield: 'foto', width: '5%', cellsalign: 'center', align: 'center' },
                                    { text: 'Nama', datafield: 'nama', editable: false, width: '15%', cellsalign: 'left', align: 'center' },
                                    { text: 'Tanggal', datafield: 'tanggal', editable: false, width: '10%', cellsalign: 'center', align: 'center' },
                                    { text: 'Murojaah', datafield: 'murojaah_nilai', width: '7%', cellsalign: 'left', align: 'center' },
                                    { text: 'Ziyadah', datafield: 'ziyadah_nilai', width: '7%', cellsalign: 'left', align: 'center' },
                                    { text: 'Tahsin',  datafield: 'tahsin_nilai', width: '7%', cellsalign: 'left', align: 'center' },
                                    { text: 'Tilawah',  datafield: 'tilawah_nilai', filtertype: 'checkedlist', width: '7%', cellsalign: 'left', align: 'center' },
                                    { text: 'Catatan',  datafield: 'catatan', width: '15%', cellsalign: 'left', align: 'center' },
                                    { text: 'Beri Nilai', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
                                        return "Click";
                                        }, buttonclick: function (row) {
                                            editrow         = row;	
                                            var offset 		= $("#gridceklisthalaqohsekolah").offset();		
                                            var dataRecord 	= $("#gridceklisthalaqohsekolah").jqxGrid('getrowdata', editrow);
                                            $("#laphalaqohsekolah_nama").val(dataRecord.nama);
                                            $("#laphalaqohsekolah_kelas").val(dataRecord.kelas);
                                            $("#laphalaqohsekolah_noinduk").val(dataRecord.noinduk);
                                            $("#laphalaqohsekolah_mn").val(dataRecord.murojaah_nilai);
                                            $("#laphalaqohsekolah_ms").val(dataRecord.murojaah_predikat);
                                            $("#laphalaqohsekolah_zn").val(dataRecord.ziyadah_nilai);
                                            $("#laphalaqohsekolah_zs").val(dataRecord.ziyadah_predikat);
                                            $("#laphalaqohsekolah_tin").val(dataRecord.tilawah_nilai);
                                            $("#laphalaqohsekolah_tis").val(dataRecord.tilawah_predikat);
                                            $("#laphalaqohsekolah_tn").val(dataRecord.tahsin_nilai);
                                            $("#laphalaqohsekolah_ts").val(dataRecord.tahsin_predikat);
                                            $("#laphalaqohsekolah_tanggal").val(dataRecord.tanggal);
                                            $("#laphalaqohsekolah_catatan").val(dataRecord.catatan);
                                            $("#idmurojaah").val(dataRecord.idmurojaah);
                                            $("#modalpenilaianprmurojaahdisekolah").modal('show');
                                        }
                                    },
                                    { text: 'Delete', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
                                        return "Delete";
                                        }, buttonclick: function (row) {
                                            editrow         = row;	
                                            var offset 		= $("#gridceklisthalaqohsekolah").offset();		
                                            var dataRecord 	= $("#gridceklisthalaqohsekolah").jqxGrid('getrowdata', editrow);
                                            swal({
                                                title               : 'Apakah anda yakin ?',
                                                text                : "Data Akan Kami Hapus, Dan Kami Beri Catatan. Apakah yakin ingin menghapus data ini.?",
                                                type                : 'warning',
                                                showCancelButton    : true,
                                                confirmButtonClass  : 'btn btn-confirm mt-2',
                                                cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                                                confirmButtonText   : 'Yes'
                                            }).then(function () {
                                                $.post('{{ route("exDataRPA") }}', { workcode: 'resetlaporanhalaqohsekolahperanak', noinduk: dataRecord.noinduk, tanggal: dataRecord.tanggal, _token: '{{ csrf_token() }}' },	
                                                function(data){
                                                    swal({
                                                        title	: data.status,
                                                        text	: data.message,
                                                        type	: data.icon,
                                                    })
                                                    $("#gridceklisthalaqohsekolah").jqxGrid('updatebounddata', 'filter');
                                                    return false;
                                                });
                                            });
                                        }
                                    },
                                ]
                            });
                        }
                    },
                    { text: 'Cheklist', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '7%', cellsrenderer: function () {
                        return "Cek PR";
                        }, buttonclick: function (row) {
                            editrow         = row;
                            var offset 		= $("#gridrpa").offset();
                            var dataRecord 	= $("#gridrpa").jqxGrid('getrowdata', editrow);
                            var murojaahdirumah = dataRecord.murojaahdirumah;
                            const arrkode = murojaahdirumah.split("s/d");
                            
                            if (typeof(arrkode[1]) !== "undefined" && arrkode[1] !== null) {
                                murojaah_mulaiayat = arrkode[0];
                                murojaah_akhirayat = arrkode[1];
                            } else {
                                murojaah_mulaiayat = 0;
                                murojaah_akhirayat = 0;
                            }
                            $("#murojaah_murojaahdirumahawal").val(murojaah_mulaiayat);
                            $("#murojaah_murojaahdirumahakhir").val(murojaah_akhirayat);
                                            
                            var sourceJson  = {
                                datatype: "json",
                                datafields: [
                                    { name: 'id'},
                                    { name: 'foto', type: 'text'},
                                    { name: 'noinduk', type: 'text'},
                                    { name: 'nama', type: 'text'},
                                    { name: 'jilid', type: 'text'},
                                    { name: 'kelas', type: 'text'},
                                    { name: 'tapel', type: 'text'},
                                    { name: 'tanggal', type: 'text'},
                                    { name: 'ziyadah_tanggal', type: 'text'},
                                    { name: 'ziyadah_mulaisurah', type: 'text'},
                                    { name: 'ziyadah_mulaiayat', type: 'text'},
                                    { name: 'ziyadah_akhirsurah', type: 'text'},
                                    { name: 'ziyadah_akhirayat', type: 'text'},
                                    { name: 'murojaah_tanggal', type: 'text'},
                                    { name: 'murojaah_mulaisurah', type: 'text'},
                                    { name: 'murojaah_mulaiayat', type: 'text'},
                                    { name: 'murojaah_akhirsurah', type: 'text'},
                                    { name: 'murojaah_akhirayat', type: 'text'},
                                    { name: 'tahsin_tanggal', type: 'text'},
                                    { name: 'tahsin_mulaisurah', type: 'text'},
                                    { name: 'tahsin_mulaiayat', type: 'text'},
                                    { name: 'tahsin_akhirsurah', type: 'text'},
                                    { name: 'tahsin_akhirayat', type: 'text'},
                                    { name: 'tilawah_tanggal', type: 'text'},
                                    { name: 'tilawah_mulaisurah', type: 'text'},
                                    { name: 'tilawah_mulaiayat', type: 'text'},
                                    { name: 'tilawah_akhirsurah', type: 'text'},
                                    { name: 'tilawah_akhirayat', type: 'text'},
                                    { name: 'nilai', type: 'text'},
                                    { name: 'kelulusan', type: 'text'},
                                    { name: 'catatan', type: 'text'},
                                    { name: 'inputor', type: 'text'},
                                    { name: 'idmurojaah', type: 'text'},
                                ],
                                type: 'POST',
                                data: {	val01:dataRecord.kelas, val02:dataRecord.realdate, val03:'murojaahdirumah', val04:dataRecord.id, val05:dataRecord.murojaahdirumah, _token: '{{ csrf_token() }}' },
                                url: '{{ route("jsonSetoranTahfid") }}',
                            };
                            $(".card9").hide();
                            $("#divceklistpr").show();
                            var dataJson = new $.jqx.dataAdapter(sourceJson);
                            $("#gridceklistpr").jqxGrid({
                                width           : '100%',
                                source          : dataJson,
                                autoheight      : true,
                                filterable      : true,
                                theme           : "orange",
                                columnsresize   : true,
                                rowsheight      : 40,
                                selectionmode   : 'multiplecellsextended',
                                columns         : [
                                    { text: 'Ustad / Ustadzah', editable: false, sortable: false, filterable: false, datafield: 'inputor', width: '10%', cellsalign: 'left', align: 'center' },
                                    { text: 'Photo',  editable: false, sortable: false, filterable: false, datafield: 'foto', width: '5%', cellsalign: 'center', align: 'center' },
                                    { text: 'Nama', datafield: 'nama', editable: false, width: '16%', cellsalign: 'left', align: 'center' },
                                    { text: 'Tanggal', datafield: 'tanggal', editable: false, width: '10%', cellsalign: 'center', align: 'center' },
                                    { text: 'Awal', datafield: 'murojaah_mulaiayat', editable: false, filterable: false, width: '7%', cellsalign: 'left', align: 'center' },
                                    { text: 'Akhir', datafield: 'murojaah_akhirayat', editable: false, filterable: false, width: '7%', cellsalign: 'left', align: 'center' },
                                    { text: 'Nilai',  datafield: 'nilai', width: '10%', cellsalign: 'left', align: 'center' },
                                    { text: 'Kelulusan',  datafield: 'kelulusan', filtertype: 'checkedlist', width: '7%', cellsalign: 'left', align: 'center' },
                                    { text: 'Catatan',  datafield: 'catatan', width: '13%', cellsalign: 'left', align: 'center' },
                                    { text: 'Beri Nilai', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
                                        return "Click";
                                        }, buttonclick: function (row) {
                                            editrow         = row;	
                                            var offset 		= $("#gridceklistpr").offset();		
                                            var dataRecord 	= $("#gridceklistpr").jqxGrid('getrowdata', editrow);
                                            $("#murojaah_nama").val(dataRecord.nama);
                                            $("#murojaah_kelas").val(dataRecord.kelas);
                                            $("#murojaah_noinduk").val(dataRecord.noinduk);
                                            $("#murojaah_nilai").val(dataRecord.nilai);
                                            $("#murojaah_status").val(dataRecord.kelulusan);
                                            $("#murojaah_catatan").val(dataRecord.catatan);
                                            $("#murojaah_tanggal").val(dataRecord.tanggal);
                                            $("#idmurojaah").val(dataRecord.idmurojaah);
                                            $("#modalpenilaianprmurojaah").modal('show');
                                        }
                                    },
                                    { text: 'Delete', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
                                        return "Delete";
                                        }, buttonclick: function (row) {
                                            editrow         = row;	
                                            var offset 		= $("#gridceklistpr").offset();		
                                            var dataRecord 	= $("#gridceklistpr").jqxGrid('getrowdata', editrow);
                                            swal({
                                                title               : 'Apakah anda yakin ?',
                                                text                : "Data Akan Kami Hapus, Dan Kami Beri Catatan. Apakah yakin ingin menghapus data ini.?",
                                                type                : 'warning',
                                                showCancelButton    : true,
                                                confirmButtonClass  : 'btn btn-confirm mt-2',
                                                cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                                                confirmButtonText   : 'Yes'
                                            }).then(function () {
                                                $.post('{{ route("exDataRPA") }}', { workcode: 'resetlaporanpr', noinduk: dataRecord.noinduk, tanggal: dataRecord.tanggal, _token: '{{ csrf_token() }}' },	
                                                function(data){
                                                    swal({
                                                        title	: data.status,
                                                        text	: data.message,
                                                        type	: data.icon,
                                                    })
                                                    $("#gridceklistpr").jqxGrid('updatebounddata', 'filter');
                                                    return false;
                                                });
                                            });
                                        }
                                    },
                                ]
                            });
                        }
                    },
                    { text: 'Pekan', datafield: 'pekan', filtertype: 'checkedlist', width: '5%', cellsalign: 'center', align: 'center' },
                    { text: 'PB', datafield: 'pb', filtertype: 'checkedlist', width: '5%', cellsalign: 'center', align: 'center' },
                    { text: 'Bulan', datafield: 'bulan', width: '5%', cellsalign: 'center', align: 'center' },
                    { text: 'Hari', datafield: 'hari', width: '5%', cellsalign: 'center', align: 'center' },
                    { text: 'TGL', datafield: 'tanggal', width: '5%', cellsalign: 'center', align: 'center' },
                    { text: 'HAL', datafield: 'hal', width: '5%', cellsalign: 'center', align: 'center' },
                    { text: 'Murojaah Kemarin', datafield: 'murojaahkemarin', width: '15%', cellsalign: 'left', align: 'center' },
                    { text: 'Mendengarkan Audio', datafield: 'mendengaraudio', width: '15%', cellsalign: 'left', align: 'center' },
                    { text: 'Sholat Dhuha', datafield: 'sholatdhuha', width: '8%', cellsalign: 'left', align: 'center' },
                    { text: 'Murojaah Hari Ini', datafield: 'murojaahhariini', width: '8%', cellsalign: 'left', align: 'center' },
                    { text: 'Tahsin', datafield: 'tahsin', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'Tilawah', datafield: 'tilawah', width: '5%', cellsalign: 'left', align: 'center' },
                    { text: 'Persiapan Hafalan', datafield: 'persiapanhafalanbesok', width: '15%', cellsalign: 'left', align: 'center' },
                    { text: 'Di Rumah', datafield: 'murojaahdirumah', width: '8%', cellsalign: 'left', align: 'center' },
                    { text: 'Murojaah Sabtu Ahad', datafield: 'murojaahsabtuahad', width: '8%', cellsalign: 'left', align: 'center' },
                ]
            });
            $("#judulrpa").html('<i class="fa fa-book"></i> Rencana Pembelajaran Al Quran Kelas '+set01+' Tahun '+tahun);
            var set02=document.getElementById('id_semester').value;
            var set03=document.getElementById('tapel').value;
            var sourcestatistikr = {
                datatype: "json",
                datafields: [
                    { name: 'tanggal', type: 'text'},
                    { name: 'jumlah', type: 'text'},
                    { name: 'status', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, tahun:set03, workcode:'statistikdirumah', _token: '{{ csrf_token() }}'},
                url : '{{ route("jsonDataRPA") }}'
            };
            var jsonStatistikHR = new $.jqx.dataAdapter(sourcestatistikr);
            $("#gridstatistikhr").jqxGrid({
                width           : '100%',
                pageable        : true,
                autoheight      : true,
                filterable      : true,
                showfilterrow   : true,
                columnsresize   : true,
                source          : jsonStatistikHR,
                sortable        : true,
                columnsresize   : true,
                altrows         : true,
                theme           : "energyblue",
                columns         : [
                    { text: 'Tanggal', datafield: 'tanggal', width: '30%', cellsalign: 'left', align: 'center' },
                    { text: 'Jumlah', datafield: 'jumlah', width: '20%', cellsalign: 'left', align: 'center' },
                    { text: 'Status', datafield: 'status', width: '30%', cellsalign: 'left', align: 'center' },
                    { text: 'Print', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '20%', cellsrenderer: function () {
                        return "Print";
                        }, buttonclick: function (row) {
                            editrow         = row;
                            var offset 		= $("#gridstatistikhr").offset();
                            var dataRecord 	= $("#gridstatistikhr").jqxGrid('getrowdata', editrow);
                            var kelas       = document.getElementById('id_kelas').value;
                            $.post('{{ route("jsonDataRPA") }}', { val01: kelas, val02: dataRecord.tanggal, workcode: 'printdatastatistikhr', _token: '{{ csrf_token() }}' }, function(data){
                                var newWindow   = window.open('', '', 'width=800, height=500'),
                                    document    = newWindow.document.open(),
                                    pageContent =
                                        '<!DOCTYPE html>\n' +
                                        '<html>\n' +
                                        '<head>\n' +
                                        '<meta charset="utf-8" />\n' +
                                        '<title>Laporan Halaqoh Per Hari</title>\n' +
                                        '</head>\n' +
                                        '<body>' + data + '</body>\n</html>';
                                    document.write(pageContent);
                                    document.close();
                                    //newWindow.print();
                            });
                        }
                    },
                ]
            });
            var sourcestatistiks = {
                datatype: "json",
                datafields: [
                    { name: 'tanggal', type: 'text'},
                    { name: 'jumlah', type: 'text'},
                    { name: 'status', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, tahun:set03, workcode:'statistikdisekolah', _token: '{{ csrf_token() }}'},
                url : '{{ route("jsonDataRPA") }}'
            };
            var jsonStatistikHS = new $.jqx.dataAdapter(sourcestatistiks);
            $("#gridstatistikhs").jqxGrid({
                width           : '100%',
                pageable        : true,
                autoheight      : true,
                filterable      : true,
                showfilterrow   : true,
                columnsresize   : true,
                source          : jsonStatistikHS,
                sortable        : true,
                columnsresize   : true,
                altrows         : true,
                theme           : "energyblue",
                columns         : [
                    { text: 'Hapus', editable: false, sortable: false, filterable: false, columntype: 'button', width: '17%', cellsrenderer: function () {
                        return "Hapus";
                        }, buttonclick: function (row) {
                            editrow         = row;	
                            var offset 		= $("#gridstatistikhs").offset();		
                            var dataRecord 	= $("#gridstatistikhs").jqxGrid('getrowdata', editrow);
                            var kelas       = document.getElementById('id_kelas').value;
                            swal({
                                title               : 'Apakah anda yakin ?',
                                text                : 'Data Halaqoh Sekolah dan di Rumah Untuk Tanggal '+dataRecord.tanggal+' Kelas Al Quran '+kelas+' Akan Kami Hapus, Dan Kami Beri Catatan. Apakah yakin ingin menghapus data ini.?',
                                type                : 'warning',
                                showCancelButton    : true,
                                confirmButtonClass  : 'btn btn-confirm mt-2',
                                cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                                confirmButtonText   : 'Yes'
                            }).then(function () {
                                $.post('{{ route("exDataRPA") }}', { workcode: 'resetlaporansekolah', kelas:kelas, tanggal: dataRecord.tanggal, _token: '{{ csrf_token() }}' },	
                                function(data){
                                    swal({
                                        title	: data.status,
                                        text	: data.message,
                                        type	: data.icon,
                                    })
                                    $("#gridstatistikhr").jqxGrid('updatebounddata', 'filter');
                                    $("#gridstatistikhs").jqxGrid('updatebounddata', 'filter');
                                    return false;
                                });
                            });
                        }
                    },
                    { text: 'Tanggal', datafield: 'tanggal', width: '30%', cellsalign: 'left', align: 'center' },
                    { text: 'Jumlah', datafield: 'jumlah', width: '18%', cellsalign: 'center', align: 'center' },
                    { text: 'Status', datafield: 'status', width: '20%', cellsalign: 'left', align: 'center' },
                    { text: 'Print', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '15%', cellsrenderer: function () {
                        return "Print";
                        }, buttonclick: function (row) {
                            editrow         = row;
                            var offset 		= $("#gridstatistikhs").offset();
                            var dataRecord 	= $("#gridstatistikhs").jqxGrid('getrowdata', editrow);
                            var kelas       = document.getElementById('id_kelas').value;
                            $.post('{{ route("jsonDataRPA") }}', { val01: kelas, val02: dataRecord.tanggal, workcode: 'printdatastatistikhs', _token: '{{ csrf_token() }}' }, function(data){
                                var newWindow   = window.open('', '', 'width=800, height=500'),
                                    document    = newWindow.document.open(),
                                    pageContent =
                                        '<!DOCTYPE html>\n' +
                                        '<html>\n' +
                                        '<head>\n' +
                                        '<meta charset="utf-8" />\n' +
                                        '<title>Laporan Halaqoh Per Hari</title>\n' +
                                        '</head>\n' +
                                        '<body>' + data + '</body>\n</html>';
                                    document.write(pageContent);
                                    document.close();
                                    //newWindow.print();
                            });
                        }
                    },
                ]
            });
        }
    }
    function jQueryOpenPesertaKelas(set01){
        $(".card9").hide();
        $("#divmappingkelas").show();
        var tahun=document.getElementById('id_mastertahun').value;
        $("#judulpesertakelas").html('<i class="fa fa-book"></i> Peserta Keas Al Quran, Kelas '+set01+' Tahun '+tahun);
        var sourcekelas 	= {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'nama', type: 'text'},
                { name: 'jilid', type: 'text'},
                { name: 'noinduk', type: 'text'},
                { name: 'kelas', type: 'text'},
                { name: 'masuk', type: 'text'},
                { name: 'ijin', type: 'text'},
                { name: 'alpha', type: 'text'},
                { name: 'sakit', type: 'text'},
                { name: 'foto', type: 'text'},
                { name: 'tapel', type: 'text'},
            ],
            type: 'POST',
            data: {val01:set01, val02:'', _token: '{{ csrf_token() }}'},
            url: '{{ route("jsonDataabsenkelas") }}'
        };			
        var jsonDataKelas = new $.jqx.dataAdapter(sourcekelas);
        $("#gridpesertakelas").jqxGrid({
            width           : '100%',
            filterable      : true,
            pageable        : true,
            showfilterrow   : true,
            autoheight      : true,
            rowsheight      : 35,
            source          : jsonDataKelas,
            columnsresize   : true,
            theme           : "energyblue",
            selectionmode   : 'multiplecellsextended',
            columns         : [
                { text: 'Photo', editable: false, sortable: false, filterable: false, datafield: 'foto', width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'Nama', datafield: 'nama', width: '50%', cellsalign: 'left', align: 'center' },
                { text: 'No.Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'Kelas Umum', editable: false, sortable: false, filterable: false, datafield: 'kelas', width: '10%', cellsalign: 'right', align: 'center' },
                { text: 'Kelas AlQuran', datafield: 'jilid', width: '10%', cellsalign: 'right', align: 'center' },
                { text: 'UBAH', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow         = row;
                        var offset 		= $("#gridpesertakelas").offset();
                        var dataRecord 	= $("#gridpesertakelas").jqxGrid('getrowdata', editrow);
                        $("#kelas_nama").val(dataRecord.nama);
                        $("#kelas_noinduk").val(dataRecord.noinduk);
                        $("#kelas_klspos").val(dataRecord.kelas);
                        $("#kelas_alquran").val(dataRecord.jilid);
                        $("#kelas_idne").val(dataRecord.id);
                        $("#modaleditkelasalquran").modal('show');
                    }
                },
            ]
        });	
    }
    function openEditorNilaiUjianQuran( jQuery ){
        var tapelsemester   = document.getElementById('editorujian_tapelsemester').value;
        var noinduk	        = document.getElementById('editorujian_noinduk').value;
        var gethasilujianalquran = {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'nama', type: 'text'},
                { name: 'noinduk', type: 'text'},
                { name: 'kelas', type: 'text'},
                { name: 'foto', type: 'text'},
                { name: 'tapel', type: 'text'},
                { name: 'semester', type: 'text'},
                { name: 'tapelsemester', type: 'text'},
                { name: 'juz', type: 'text'},
                { name: 'namasurah', type: 'text'},
                { name: 'halaman', type: 'text'},
                { name: 'jumlahkata', type: 'text'},
                { name: 'jumlahkesalahan', type: 'text'},
                { name: 'nilaikesalahan', type: 'text'},
                { name: 'nilaipersurat', type: 'text'},
                { name: 'predikat', type: 'text'},
                { name: 'nilaiperjuz', type: 'text'},
                { name: 'niyguru', type: 'text'},
                { name: 'namaguru', type: 'text'},
                { name: 'sakit', type: 'text'},
                { name: 'ijin', type: 'text'},
                { name: 'alpha', type: 'text'},
                { name: 'hariefektif', type: 'text'},
                { name: 'setoransekolah', type: 'text'},
                { name: 'setoranrumah', type: 'text'},
                { name: 'namawakaalquran', type: 'text'},
                { name: 'niywaka', type: 'text'},
                { name: 'namaks', type: 'text'},
                { name: 'niyks', type: 'text'},
            ],
            type: 'POST',
            data: {tapelsemester:tapelsemester, noinduk:noinduk, workcode:'getriwayatforedit', _token: '{{ csrf_token() }}'},
            url: '{{ route("jsonDataRPA") }}'
        };			
        var jsonDataUjianAlQuran = new $.jqx.dataAdapter(gethasilujianalquran);
        $("#gridriwayatujianalquran").jqxGrid({
            width           : '100%',
            filterable      : true,
            pageable        : true,
            showfilterrow   : true,
            autoheight      : true,
            rowsheight      : 35,
            source          : jsonDataUjianAlQuran,
            columnsresize   : true,
            theme           : "energyblue",
            selectionmode   : 'multiplecellsextended',
            columns         : [
                { text: 'Juz', datafield: 'juz', width: '7%', cellsalign: 'left', align: 'center' },
                { text: 'Nama Surah', datafield: 'namasurah', width: '20%', cellsalign: 'left', align: 'center' },
                { text: 'Halaman', datafield: 'halaman', width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'Jumlah Kata', datafield: 'jumlahkata', width: '8%', cellsalign: 'center', align: 'center' },
                { text: 'Kesalahan', datafield: 'jumlahkesalahan', width: '7%', cellsalign: 'center', align: 'center' },
                { text: 'Nilai Kesalahan', datafield: 'nilaikesalahan', width: '8%', cellsalign: 'right', align: 'center' },
                { text: 'Nilai', datafield: 'nilaipersurat', width: '10%', cellsalign: 'right', align: 'center' },
                { text: 'Predikat', datafield: 'predikat', width: '10%', cellsalign: 'right', align: 'center' },
                { text: 'UBAH', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow             = row;
                        var offset 		    = $("#gridriwayatujianalquran").offset();
                        var dataRecord 	    = $("#gridriwayatujianalquran").jqxGrid('getrowdata', editrow);
                        var setoransekolah  = dataRecord.setoransekolah;
                        var setoranrumah    = dataRecord.setoranrumah;
                        if (typeof setoransekolah === 'string') {
                            const arrkode = setoransekolah.split("-");
                            
                            if (typeof(arrkode[1]) !== "undefined" && arrkode[1] !== null) {
                                prszydsekolah = arrkode[0];
                                prsmrjsekolah = arrkode[1];
                            } else {
                                prszydsekolah = 0;
                                prsmrjsekolah = 0;
                            }
                        } else {
                            prszydsekolah = 0;
                            prsmrjsekolah = 0;
                        }
                        if (typeof setoranrumah === 'string') {
                            const arrkode = setoranrumah.split("-");
                            
                            if (typeof(arrkode[1]) !== "undefined" && arrkode[1] !== null) {
                                prszydrumah = arrkode[0];
                                prsmrjrumah = arrkode[1];
                            } else {
                                prszydrumah = 0;
                                prsmrjrumah = 0;
                            }
                        } else {
                            prszydrumah = 0;
                            prsmrjrumah = 0;
                        }
                        $("#modaleditorujian_nama").val(dataRecord.nama);
                        $("#modaleditorujian_noinduk").val(dataRecord.noinduk);
                        $("#modaleditorujian_kelas").val(dataRecord.kelas);
                        $("#modaleditorujian_semester").val(dataRecord.semester);
                        $("#modaleditorujian_tapel").val(dataRecord.tapel);
                        $("#modaleditorujian_tapelsemester").val(dataRecord.tapelsemester);
                        $("#modaleditorujian_hariefektif").val(dataRecord.hariefektif);
                        $("#modaleditorujian_prszydsekolah").val(prszydsekolah);
                        $("#modaleditorujian_prsmrjsekolah").val(prsmrjsekolah);
                        $("#modaleditorujian_foto").val(dataRecord.foto);
                        $("#modaleditorujian_prszydrumah").val(prszydrumah);
                        $("#modaleditorujian_prsmrjrumah").val(prsmrjrumah);
                        $("#modaleditorujian_juzhalaman").val(dataRecord.juz+' / '+dataRecord.halaman);
                        $("#modaleditorujian_id").val(dataRecord.id);
                        $("#modaleditorujian_jumlahkata").val(dataRecord.jumlahkata);
                        $("#modaleditorujian_jumlahkesalahan").val(dataRecord.jumlahkesalahan);
                        $("#modaleditorujian_nilaikesalahan").val(dataRecord.nilaikesalahan);
                        $("#modaleditorujian_nilaipersurat").val(dataRecord.nilaipersurat);
                        $("#modaleditorujian_predikat").val(dataRecord.predikat);
                        $("#modaleditorpenilaianujianalquran").modal('show');
                    }
                },
                { text: 'HAPUS', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                    return "Del";
                    }, buttonclick: function (row) {
                        editrow             = row;
                        var offset 		    = $("#gridriwayatujianalquran").offset();
                        var dataRecord 	    = $("#gridriwayatujianalquran").jqxGrid('getrowdata', editrow);
                        swal({
                            title: 'Apakah anda yakin ?',
                            text: "Data yang dihapus tidak bisa di kembalikan (undo) apakah anda yakin ingin menghapus data ini.?",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonClass: 'btn btn-confirm mt-2',
                            cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                            confirmButtonText: 'Yes, Remove It'
                        }).then(function () {
                            var formdata = new FormData();
                                formdata.set('_token', '{{ csrf_token() }}');
                                formdata.set('id', dataRecord.id);
                                formdata.set('workcode', 'hapusujianalquran');
                            $.ajax({
                                url         : '{{ route("exInputnilaiUA") }}',
                                data        : formdata,
                                type        : 'POST',
                                contentType : false,
                                processData : false,
                                success: function (data) {
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
                                    $("#gridriwayatujianalquran").jqxGrid('updatebounddata', 'filter');
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
                        });
                    }
                },
            ]
        });
    }
    function konversiNilai(nilai) {
        if (nilai >= 90) {
            return "ممتاز";
        } else if (nilai >= 80) {
            return "جيد جدا";
        } else if (nilai >= 70) {
            return "جيد";
        } else if (nilai >= 60) {
            return "مقبول";
        } else {
            return "راسب";
        }
    }
    var baseurl     = '{{url("/")}}/Surat/';
    var isLoading   = document.getElementById("loadingview");
    function getSurat(id, title) {
        isLoading.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span>'
        document.getElementById("surahtitle").innerHTML = title;
        var mainContainer = document.getElementById("surah");
            mainContainer.innerHTML = '';
        fetch(baseurl + id + '.json').then(function (response) {
            return response.json();
        }).then(function (data) {
            for (var i = 0; i < data.data.length; i++) {
                var div = document.createElement("div");
                    div.innerHTML = '<p class="arabic pull-right"><span class="badge badge-primary">' + data.data[i].aya_number + '</span> ' + data.data[i].aya_text + '</p><div class="clearfix"></div><p style="terjemah">' + data.data[i].translation_aya_text + '</p>';
                    mainContainer.appendChild(div);
            }
            isLoading.innerHTML = ''
        })
        .catch(function (err) {
            swal({
                title	: 'Stop',
                text	: err,
                type	: 'warning',
            })
        });
    }
    $(document).ready(function () {
        $(".halaqoh").hide();
        $(".card9").hide();
        $(".divrpa").hide();
        $("#divstatistik").show();
        $("#divpanel").show();
        $(".divpanelleft").show();
        $('#simpansetguru').click(function () {
            var set01=document.getElementById('id_semester').value;
            var set02=document.getElementById('id_kelas').value;
            var set03='';
            var set04=document.getElementById('tapel').value;
            var token=document.getElementById('token').value;
            if (set01 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom Semester Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set04 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom TAPEL Terlebih Dahulu',
                    type: 'warning',
                })
            } else {
                $.post('{{ route("exSavesetguru") }}', { val01: set01, val02: set02, val03: set03, val04: set04, _token: token },
                function(data){
                    var uri = window.location.href.split("#")[0];
                    window.location=uri
                });
            }
        });
        $('#topbtnhalaqoh').click(function () {
            var judul = 'Perkembangan santri';
            $('#juduldetailalquran').html(judul);
            var set01	= document.getElementById('id_kelas').value;
            var set02	= document.getElementById('mas_tapel').value;
            var set03	= document.getElementById('mas_semester').value;
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'nama', type: 'text'},
                    { name: 'jilid', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'foto', type: 'text'},
                    { name: 'tmplahir', type: 'text'},
                    { name: 'tgllahir', type: 'text'},
                    { name: 'tapel', type: 'text'},
                    { name: 'tanggal', type: 'text'},
                    { name: 'ziyadah_mulaisurah', type: 'text'},
                    { name: 'ziyadah_mulaiayat', type: 'text'},
                    { name: 'ziyadah_akhirsurah', type: 'text'},
                    { name: 'ziyadah_akhirayat', type: 'text'},
                    { name: 'ziyadah_nilai'},
                    { name: 'ziyadah_predikat', type: 'text'},
                    { name: 'murojaah_mulaisurah', type: 'text'},
                    { name: 'murojaah_mulaiayat', type: 'text'},
                    { name: 'murojaah_akhirsurah', type: 'text'},
                    { name: 'murojaah_akhirayat', type: 'text'},
                    { name: 'murojaah_nilai'},
                    { name: 'murojaah_predikat', type: 'text'},
                    { name: 'tilawah_mulaisurah', type: 'text'},
                    { name: 'tilawah_mulaiayat', type: 'text'},
                    { name: 'tilawah_akhirsurah', type: 'text'},
                    { name: 'tilawah_akhirayat', type: 'text'},
                    { name: 'tilawah_nilai'},
                    { name: 'tilawah_predikat', type: 'text'},
                    { name: 'tahsin_mulaisurah', type: 'text'},
                    { name: 'tahsin_nilai', type: 'text'},
                    { name: 'tahsin_predikat', type: 'text'},
                    { name: 'catatan', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:'semuakelas', val04:set03, _token: '{{ csrf_token() }}'},
                url: '{{ route("jsonSetoranTahfid") }}',
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#gridperkembangansantri").jqxGrid({
                width           : '100%',
                pageable        : true,
                rowsheight      : 45,
                autoheight      : true,
                filterable      : true,
                source          : dataAdapter,
                theme           : "energyblue",
                selectionmode   : 'singlecell',
                columns         : [
                    { text: 'Detail', editable: false, filterable: false, columntype: 'button', width: '3%', align: 'center', cellsrenderer: function () {
                        return "Detail";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridperkembangansantri").offset();
                            var dataRecord 	= $("#gridperkembangansantri").jqxGrid('getrowdata', editrow);
                            var tapel	    = document.getElementById('mas_tapel').value;
                            var sourcerinciannilai = {
                                datatype: "json",
                                datafields: [
                                    { name: 'id'},
                                    { name: 'noinduk', type: 'text'},
                                    { name: 'nama', type: 'text'},
                                    { name: 'jilid', type: 'text'},
                                    { name: 'kelas', type: 'text'},
                                    { name: 'tapel', type: 'text'},
                                    { name: 'tanggal', type: 'text'},
                                    { name: 'ziyadah_mulaisurah', type: 'text'},
                                    { name: 'ziyadah_mulaiayat', type: 'text'},
                                    { name: 'ziyadah_akhirsurah', type: 'text'},
                                    { name: 'ziyadah_akhirayat', type: 'text'},
                                    { name: 'ziyadah_nilai'},
                                    { name: 'ziyadah_predikat', type: 'text'},
                                    { name: 'murojaah_mulaisurah', type: 'text'},
                                    { name: 'murojaah_mulaiayat', type: 'text'},
                                    { name: 'murojaah_akhirsurah', type: 'text'},
                                    { name: 'murojaah_akhirayat', type: 'text'},
                                    { name: 'murojaah_nilai'},
                                    { name: 'murojaah_predikat', type: 'text'},
                                    { name: 'tilawah_mulaisurah', type: 'text'},
                                    { name: 'tilawah_mulaiayat', type: 'text'},
                                    { name: 'tilawah_akhirsurah', type: 'text'},
                                    { name: 'tilawah_akhirayat', type: 'text'},
                                    { name: 'tilawah_nilai'},
                                    { name: 'tilawah_predikat', type: 'text'},
                                    { name: 'tahsin', type: 'text'},
                                    { name: 'tahsin_nilai', type: 'text'},
                                    { name: 'tahsin_predikat', type: 'text'},
                                    { name: 'catatan', type: 'text'},
                                    { name: 'inputor', type: 'text'},
                                ],
                                type: 'POST',
                                data: {	val01:dataRecord.noinduk, val02:tapel, val03:'individu', _token: '{{ csrf_token() }}' },
                                url: '{{ route("jsonSetoranTahfid") }}',
                            };
                            $('#divdetperkemsantri').show();
                            $('#divawalperkemsantri').hide();
                            var judul = 'Perkembangan an. '+dataRecord.nama;
                            $('#juduldetailalquran').html(judul);
                            var datarincianharian = new $.jqx.dataAdapter(sourcerinciannilai);
                            $("#griddetailperkembangansantri").jqxGrid({
                                width           : '100%',
                                source          : datarincianharian,
                                autoheight      : true,
                                filterable      : true,
                                theme           : "orange",
                                columnsresize   : true,
                                selectionmode   : 'multiplecellsextended',
                                columns: [
                                    { text: 'Edit', columntype: 'button', width: 50, align: 'center', cellsrenderer: function () {
                                        return "Edit";
                                        }, buttonclick: function (row) {
                                            editrow = row;
                                            var offset 		= $("#griddetailperkembangansantri").offset();
                                            var dataRecord 	= $("#griddetailperkembangansantri").jqxGrid('getrowdata', editrow);
                                            $('.sectionsetoran').show();
                                            $('.sectiontahfid').hide();
                                            $("#setoran_tanggal").val(dataRecord.tanggal);
                                            $("#setoran_nama").val(dataRecord.nama);
                                            $("#setoran_noinduk").val(dataRecord.noinduk);
                                            $("#setoran_kelas").val(dataRecord.jilid);
                                            $("#setoran_catatan").val(dataRecord.catatan);
                                            $("#setoran_ziyadahsurahawal").val(dataRecord.ziyadah_akhirayat).select2().trigger('change');
                                            $("#setoran_ziyadahsurahakhir").val(dataRecord.ziyadah_akhirayat).select2().trigger('change');
                                            $("#setoran_nilaiziyadah").val(dataRecord.ziyadah_nilai);
                                            $("#setoran_statusziyadah").val(dataRecord.ziyadah_predikat);
                                            $("#setoran_msurahawal").val(dataRecord.murojaah_akhirayat).select2().trigger('change');
                                            $("#setoran_msurahakhir").val(dataRecord.murojaah_akhirayat).select2().trigger('change');
                                            $("#setoran_nilaimurojaah").val(dataRecord.murojaah_nilai);
                                            $("#setoran_statusmurojaah").val(dataRecord.murojaah_predikat);
                                            CKEDITOR.instances['setoran_tahsin'].setData(dataRecord.tahsin)
                                            $("#setoran_nilaitahsin").val(dataRecord.tahsin_nilai);
                                            $("#setoran_statustahsin").val(dataRecord.tahsin_predikat);
                                            $("#setoran_tilawahsurahawal").val(dataRecord.tilawah_akhirayat).select2().trigger('change');
                                            $("#setoran_tilawahsurahakhir").val(dataRecord.tilawah_akhirayat).select2().trigger('change');
                                            $("#setoran_nilaitilawah").val(dataRecord.tilawah_nilai);
                                            $("#setoran_statustilawah").val(dataRecord.tilawah_predikat);
                                        }
                                    },
                                    { text: 'Ustad / Ustadzah', datafield: 'inputor', width: 120, cellsalign: 'left', align: 'center' },
                                    { text: 'Tanggal', datafield: 'tanggal', editable: false, width: 100, cellsalign: 'center', align: 'center' },
                                    { text: 'Start Murojaah', columngroup: 'kelompok04', datafield: 'murojaah_mulaisurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                    { text: 'End Murojaah', columngroup: 'kelompok04', datafield: 'murojaah_akhirsurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                    { text: 'Score Murojaah', columngroup: 'kelompok04', datafield: 'murojaah_nilai', editable: false, filterable: false, width: 50, cellsalign: 'left', align: 'center' },
                                    { text: 'Predikat Murojaah', columngroup: 'kelompok04', datafield: 'murojaah_predikat', editable: false, filterable: false, width: 100, cellsalign: 'left', align: 'center' },
                                    { text: 'Start Ziyadah', columngroup: 'kelompok01', datafield: 'ziyadah_mulaisurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                    { text: 'End Ziyadah', columngroup: 'kelompok01', datafield: 'ziyadah_akhirsurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                    { text: 'Score Ziyadah', columngroup: 'kelompok01', datafield: 'ziyadah_nilai', editable: false, filterable: false, width: 50, cellsalign: 'left', align: 'center' },
                                    { text: 'Predikat Ziyadah', columngroup: 'kelompok01', datafield: 'ziyadah_predikat', editable: false, filterable: false, width: 100, cellsalign: 'left', align: 'center' },
                                    { text: 'Start Tilawah', columngroup: 'kelompok02', datafield: 'tilawah_mulaisurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                    { text: 'End Tilawah', columngroup: 'kelompok02', datafield: 'tilawah_akhirsurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                    { text: 'Score Tilawah', columngroup: 'kelompok02', datafield: 'tilawah_nilai', editable: false, filterable: false, width: 50, cellsalign: 'left', align: 'center' },
                                    { text: 'Predikat Tilawah', columngroup: 'kelompok02', datafield: 'tilawah_predikat', editable: false, filterable: false, width: 100, cellsalign: 'left', align: 'center' },
                                    { text: 'Tahsin', columngroup: 'kelompok03', datafield: 'tahsin', editable: false, filterable: false, width: 180, cellsalign: 'left', align: 'center' },
                                    { text: 'Score Tahsin', columngroup: 'kelompok03', datafield: 'tahsin_nilai', editable: false, filterable: false, width: 50, cellsalign: 'left', align: 'center' },
                                    { text: 'Predikat Tahsin', columngroup: 'kelompok03', datafield: 'tahsin_predikat', editable: false, filterable: false, width: 100, cellsalign: 'left', align: 'center' },
                                    { text: 'Catatan', datafield: 'catatan', width: 200, cellsalign: 'center', align: 'center' },
                                ],
                                columngroups: 
                                [
                                    { text: 'ZIYADAH', align: 'center', name: 'kelompok01' },
                                    { text: 'TILAWAH', align: 'center', name: 'kelompok02' },
                                    { text: 'TAHSIN', align: 'center', name: 'kelompok03' },
                                    { text: 'MUROJAAH', align: 'center', name: 'kelompok04' },
                                    { text: 'PENILAIAN', align: 'center', name: 'kelompok05' },
                                ]
                            });
                        }
                    },
                    { text: 'Tambah',editable: false, filterable: false,  columntype: 'button', width: '3%', align: 'center', cellsrenderer: function () {
                        return "NEW";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridperkembangansantri").offset();
                            var dataRecord 	= $("#gridperkembangansantri").jqxGrid('getrowdata', editrow);
                            $('.sectionsetoran').show();
                            $('.sectiontahfid').hide();
                            var tanggal	= document.getElementById('set_tanggal').value;
                            $("#setoran_nama").val(dataRecord.nama);
                            $("#setoran_noinduk").val(dataRecord.noinduk);
                            $("#setoran_kelas").val(dataRecord.jilid);
                            $("#setoran_tanggal").val(tanggal);
                            $("#setoran_catatan").val('');
                            $("#setoran_ziyadahsurahakhir").val(dataRecord.ziyadah_akhirayat).select2().trigger('change');
                            $("#setoran_ziyadahsurahawal").val(dataRecord.ziyadah_akhirayat).select2().trigger('change');
                            $("#setoran_nilaiziyadah").val('');
                            $("#setoran_statusziyadah").val('');
                            $("#setoran_msurahawal").val(dataRecord.murojaah_akhirayat).select2().trigger('change');
                            $("#setoran_msurahakhir").val(dataRecord.murojaah_akhirayat).select2().trigger('change');
                            $("#setoran_nilaimurojaah").val('');
                            $("#setoran_statusmurojaah").val('');
                            CKEDITOR.instances['setoran_tahsin'].setData(dataRecord.tahsin_mulaisurah)
                            $("#setoran_nilaitahsin").val('');
                            $("#setoran_statustahsin").val('');
                            $("#setoran_tilawahsurahawal").val(dataRecord.tilawah_akhirayat).select2().trigger('change');
                            $("#setoran_tilawahsurahakhir").val(dataRecord.tilawah_akhirayat).select2().trigger('change');
                            $("#setoran_nilaitilawah").val('');
                            $("#setoran_statustilawah").val('');
                        }
                    },
                    { text: 'Photo', datafield: 'foto', editable: false, filterable: false, width: '3%', cellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '13%', cellsalign: 'left', align: 'center' },
                    { text: 'Setoran Akhir', datafield: 'tanggal', width: '6%', cellsalign: 'center', align: 'center' },
                    { text: 'Start Murojaah', columngroup: 'kelompok04', datafield: 'murojaah_mulaiayat', editable: false, filterable: false, width: '7%', cellsalign: 'center', align: 'center' },
                    { text: 'End Murojaah', columngroup: 'kelompok04', datafield: 'murojaah_akhirayat', editable: false, filterable: false, width: '7%', cellsalign: 'center', align: 'center' },
                    { text: 'N.Murojaah', columngroup: 'kelompok04', datafield: 'murojaah_nilai', editable: false, filterable: false, width: '6%', cellsalign: 'right', align: 'center' },
                    { text: 'Start Ziyadah', columngroup: 'kelompok01', datafield: 'ziyadah_mulaiayat', editable: false, filterable: false, width: '7%', cellsalign: 'center', align: 'center' },
                    { text: 'End Ziyadah', columngroup: 'kelompok01', datafield: 'ziyadah_akhirayat', editable: false, filterable: false, width: '7%', cellsalign: 'center', align: 'center' },
                    { text: 'N.Ziyadah', columngroup: 'kelompok01', datafield: 'ziyadah_nilai', editable: false, filterable: false, width: '6%', cellsalign: 'right', align: 'center' },
                    { text: 'Start Tilawah', columngroup: 'kelompok02', datafield: 'tilawah_mulaiayat', editable: false, filterable: false, width: '7%', cellsalign: 'center', align: 'center' },
                    { text: 'End Tilawah', columngroup: 'kelompok02', datafield: 'tilawah_akhirayat', editable: false, filterable: false, width: '7%', cellsalign: 'center', align: 'center' },
                    { text: 'N.Tilawah', columngroup: 'kelompok02', datafield: 'tilawah_nilai', editable: false, filterable: false, width: '6%', cellsalign: 'right', align: 'center' },
                    { text: 'Tahsin', datafield: 'tahsin_mulaisurah', editable: false, filterable: false, width: '12%', cellsalign: 'left', align: 'center' },
                ],
                columngroups:
                [
                    { text: 'ZIYADAH', align: 'center', name: 'kelompok01' },
                    { text: 'TILAWAH', align: 'center', name: 'kelompok02' },
                    { text: 'TAHSIN', align: 'center', name: 'kelompok03' },
                    { text: 'MUROJAAH', align: 'center', name: 'kelompok04' },
                ]
            });
            $(".divpanelleft").hide();
            $(".divpanel").hide();
            $(".halaqoh").hide();
            $(".card9").hide();
            $('#divkertasujian').hide();
            $('#divriwayat').hide();
            $('#divceklistpr').hide();
            $('#divdetperkemsantri').hide();
            $('#divawalperkemsantri').show();
            $('.sectiontahfid').show();
            $('.sectionsetoran').hide();
            $('.sectionujian').hide();
        });
        $('.btnviewrpa').click(function () {
            $(".halaqoh").hide();
            $(".card9").hide();
            $(".divrpa").show();
        });
        $('.btnviewawal').click(function () {
            $(".halaqoh").hide();
            $(".card9").hide();
            $("#divstatistik").show();
        });
        $('#btnsimpanmappingkelas').click(function () {
            var set01=document.getElementById('kelas_idne').value;
            var set02=document.getElementById('kelas_alquran').value;
            var formdata = new FormData();
                formdata.set('id', set01);
                formdata.set('kelas', set02);
                formdata.set('workcode', 'mapping');
                formdata.set('_token', '{{ csrf_token() }}');
            var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
            $.ajax({
                url         : '{{ route("exDataRPA") }}',
                data        : formdata,
                type        : 'POST',
                contentType : false,
                processData : false,
                success: function (data) {
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
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $("#gridpesertakelas").jqxGrid('updatebounddata', 'filter');
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    $("#modaleditkelasalquran").modal('hide');
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
        $('#rpa_murojaahdirumahawal').show();
        $('#rpa_murojaahdirumahawalmanual').hide();
        $('#rpa_murojaahdirumahakhir').show();
        $('#rpa_murojaahdirumahakhirmanual').hide();
        $("#rpa_murojaahdirumahawal").on('change', function () {
            var cekisi      = $(this).find('option:selected').attr('value');
            if (cekisi == 'manual'){
                $('#rpa_murojaahdirumahawal').hide();
                $('#rpa_murojaahdirumahawalmanual').show();
            }
        });
        $("#rpa_murojaahdirumahakhir").on('change', function () {
            var cekisi      = $(this).find('option:selected').attr('value');
            if (cekisi == 'manual'){
                $('#rpa_murojaahdirumahakhir').hide();
                $('#rpa_murojaahdirumahakhirmanual').show();
            }
        });
        $('#btnsimpandatarpa').click(function () {
            var set01=document.getElementById('rpa_murojaahdirumahawal').value;
            var set02=document.getElementById('rpa_murojaahdirumahakhir').value;
            if (set01 == 'manual'){
                var set01=document.getElementById('rpa_murojaahdirumahawalmanual').value;
                $('#rpa_murojaahdirumahawal').show();
                $('#rpa_murojaahdirumahawalmanual').hide();
                $('#rpa_murojaahdirumahawal').val('').select2().trigger('change');
            }
            if (set02 == 'manual'){
                var set02=document.getElementById('rpa_murojaahdirumahakhirmanual').value;
                $('#rpa_murojaahdirumahakhir').show();
                $('#rpa_murojaahdirumahakhirmanual').hide();
                $('#rpa_murojaahdirumahakhir').val('').select2().trigger('change');
            }
            var formdata = new FormData($('#formeditorrpa')[0]);
                formdata.set('murojaahdirumah', set01+'s/d'+set02);
                formdata.set('_token', '{{ csrf_token() }}');
            var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
            $.ajax({
                url         : '{{ route("exDataRPA") }}',
                data        : formdata,
                type        : 'POST',
                contentType : false,
                processData : false,
                success: function (data) {
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
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $("#gridrpa").jqxGrid('updatebounddata', 'filter');
                    $(".card9").hide();
                    $(".divrpa").show();
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
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
        $('#btntambahkelasrpa').click(function () {
            var set01=document.getElementById('rpatambahkelas').value;
            if (set01 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Semua Field Wajib di Isi, Apabila memang tidak ada data mohon diisi dengan tanda strip (-) atau 0 (nol)',
                    type	: 'error',
                });
            } else {
                var formdata = new FormData();
                    formdata.set('val01', set01);
                    formdata.set('workcode', 'tambahkelasrpa');
                    formdata.set('_token', '{{ csrf_token() }}');
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                $.ajax({
                    url         : '{{ route("exDataRPA") }}',
                    data        : formdata,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success: function (data) {
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
                            hideAfter   : 3000,
                            stack       : 1
                        });
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        var uri = window.location.href.split("#")[0];
                        setTimeout(function () { window.location=uri;}, 3000);
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
        $('#btnsimpantemplate').click(function () {
            var set01=document.getElementById('template_id').value;
            var set02=document.getElementById('template_nama').value;
            var set03=document.getElementById('template_halaman').value;
            var set04=document.getElementById('template_kata').value;
            var sesi ="{{Session('previlage')}}";
            if (sesi == 'Waka Kurikulum Al Quran' || sesi == 'level1' || sesi == 'Waka Kurikulum'){
                if (set01 == '' || set02 == '' || set03 == '' || set04 == ''){
                    swal({
                        title	: 'Warning',
                        text	: 'Semua Field Wajib di Isi, Apabila memang tidak ada data mohon diisi dengan tanda strip (-) atau 0 (nol)',
                        type	: 'error',
                    });
                } else {
                    var formdata = new FormData();
                        formdata.set('id', set01);
                        formdata.set('nama', set02);
                        formdata.set('halaman', set03);
                        formdata.set('kata', set04);
                        formdata.set('workcode', 'updatetemplate');
                        formdata.set('_token', '{{ csrf_token() }}');
                    var btn = $(this);
                        btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                        
                    $.ajax({
                        url         : '{{ route("exDataRPA") }}',
                        data        : formdata,
                        type        : 'POST',
                        contentType : false,
                        processData : false,
                        success: function (data) {
                            $("#modaledittemplate").modal('hide');
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
                            btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                            var uri = window.location.href.split("#")[0];
                            setTimeout(function () { window.location=uri;}, 5000);
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
            } else {
                swal({
                    title	: 'Warning',
                    text	: 'Akses Terbatas Untuk Waka Kurikulum Alquran',
                    type	: 'error',
                });
            }
        });
        $('#btnsimpannilaiprmurojaah').click(function () {
            var set01=document.getElementById('idmurojaah').value;
            var set02=document.getElementById('murojaah_murojaahdirumahawal').value;
            var set03=document.getElementById('murojaah_murojaahdirumahakhir').value;
            var set04=document.getElementById('murojaah_nilai').value;
            var set05=document.getElementById('murojaah_status').value;
            var set06=document.getElementById('murojaah_catatan').value;
            var set07=document.getElementById('murojaah_tanggal').value;
            var set08=document.getElementById('murojaah_nama').value;
            var set09=document.getElementById('murojaah_kelas').value;
            var set10=document.getElementById('murojaah_noinduk').value;
            if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Semua Field Wajib di Isi, Apabila memang tidak ada data mohon diisi dengan tanda strip (-) atau 0 (nol)',
                    type	: 'error',
                });
            } else {
                var formdata = new FormData();
                    formdata.set('idmurojaah', set01);
                    formdata.set('setoran_ziyadahsurahawal', '');
                    formdata.set('setoran_ziyadahsurahakhir', '');
                    formdata.set('setoran_msurahawal', set02);
                    formdata.set('setoran_msurahakhir', set03);
                    formdata.set('setoran_tilawahsurahawal', '');
                    formdata.set('setoran_tilawahsurahakhir', '');
                    formdata.set('setoran_tahsinawal', '');
                    formdata.set('setoran_tahsinakhir', '');
                    formdata.set('setoran_nilaimurojaah', set04);
                    formdata.set('setoran_statusmurojaah', set05);
                    formdata.set('setoran_catatan', set06);
                    formdata.set('setoran_tanggal', set07);
                    formdata.set('setoran_nama', set08);
                    formdata.set('setoran_kelas', set09);
                    formdata.set('setoran_noinduk', set10);
                    formdata.set('_token', '{{ csrf_token() }}');
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                    
                $.ajax({
                    url         : '{{ route("exInputsetoran") }}',
                    data        : formdata,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success: function (data) {
                        $("#modalpenilaianprmurojaah").modal('hide');
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
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        $("#gridceklistpr").jqxGrid('updatebounddata', 'filter');
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
        $('#btnsimpannilaihalaqohsekolahnew').click(function () {
            var set01   = document.getElementById('laphalaqohsekolah_tanggal').value;
            var tahsin  = CKEDITOR.instances['laphalaqohsekolah_tt'].getData()
            var set08   = document.getElementById('laphalaqohsekolah_nama').value;
            var set09   = document.getElementById('laphalaqohsekolah_kelas').value;
            var set10   = document.getElementById('laphalaqohsekolah_noinduk').value;
            if (set01 == '' || set08 == '' || set09 == '' || set10 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Semua Field Wajib di Isi, Apabila memang tidak ada data mohon diisi dengan tanda strip (-) atau 0 (nol)',
                    type	: 'error',
                });
            } else {
                var formdata = new FormData();
                    formdata.set('idmurojaah', 'fromrpa');
                    formdata.set('setoran_ziyadahsurahawal', document.getElementById('laphalaqohsekolah_zt').value);
                    formdata.set('setoran_ziyadahnilai', document.getElementById('laphalaqohsekolah_zn').value);
                    formdata.set('setoran_ziyadahpredikat',document.getElementById('laphalaqohsekolah_zs').value);
                    formdata.set('setoran_msurahawal', document.getElementById('laphalaqohsekolah_mt').value);
                    formdata.set('setoran_murojaahnilai', document.getElementById('laphalaqohsekolah_mn').value);
                    formdata.set('setoran_murojaahpredikat', document.getElementById('laphalaqohsekolah_ms').value);
                    formdata.set('setoran_tilawahsurahawal', document.getElementById('laphalaqohsekolah_tit').value);
                    formdata.set('setoran_tilawahnilai', document.getElementById('laphalaqohsekolah_tin').value);
                    formdata.set('setoran_tilawahpredikat', document.getElementById('laphalaqohsekolah_tis').value);
                    formdata.set('setoran_tahsinawal', tahsin);
                    formdata.set('setoran_tahsinnilai', document.getElementById('laphalaqohsekolah_tn').value);
                    formdata.set('setoran_tahsinpredikat', document.getElementById('laphalaqohsekolah_ts').value);
                    formdata.set('setoran_catatan', document.getElementById('laphalaqohsekolah_catatan').value);
                    formdata.set('setoran_tanggal', document.getElementById('laphalaqohsekolah_tanggal').value);
                    formdata.set('setoran_nama', set08);
                    formdata.set('setoran_kelas', set09);
                    formdata.set('setoran_noinduk', set10);
                    formdata.set('_token', '{{ csrf_token() }}');
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                    
                $.ajax({
                    url         : '{{ route("exInputsetoran") }}',
                    data        : formdata,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success: function (data) {
                        $("#modalpenilaianprmurojaahdisekolah").modal('hide');
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
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        $("#gridceklisthalaqohsekolah").jqxGrid('updatebounddata', 'filter');
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
        $("#btnexport").click(function () {
            var gridContent = $("#gridrpa").jqxGrid('exportdata', 'json');
                data        = $.parseJSON(gridContent);
            var noOfContacts= data.length;
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
                            td.setAttribute('style', 'mso-number-format: "\@";');
                            td.innerHTML = isi;
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
        $("#mushaf_list").on('change', function () {
            var id      = $(this).find('option:selected').attr('value');
            var surah   = $(this).find('option:selected').attr('surah');
            surah.replace(/[^\w\s]/gi, '');
            getSurat(id, surah);
        });
        $('.btnboxrefresh').click(function () {
            var uri = window.location.href.split("#")[0];
            window.location=uri
        });
        $('#btnclosedetail').click(function () {
            $('#divgriddetailpresensi').hide();
            var judul = 'Perkembangan santri';
            $('#juduldetailalquran').html(judul);
        });
        $('#btnclosedetailperkembangan').click(function () {
            $('#divawalperkemsantri').show();
            $('#divdetperkemsantri').hide();
            var judul = 'Perkembangan santri';
            $('#juduldetailalquran').html(judul);
        });
        $('#btnclosemushaf').click(function () {
            $('.divumum').hide();
            $('.sectiontahfid').show();
            $('.sectionsetoran').hide();
            $('.sectionujian').hide();
        });
        $('#btnkembalidarisetoran').click(function () {
            $('.sectionsetoran').hide();
            $('.sectiontahfid').show();
            $('.sectionujian').hide();
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });
        $('.btnsimpansetoran').click(function () {
            var tahsin = CKEDITOR.instances['setoran_tahsin'].getData()
            var formdata = new FormData($('#formtambahsetoran')[0]);
                formdata.set('tahsin', tahsin);
                formdata.set('_token', '{{ csrf_token() }}');
            $.ajax({
                url         : '{{ route("exInputsetoran") }}',
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
                    swal({
                        title	: status,
                        text	: message,
                        type	: icon,
                    })
                    $('.sectionsetoran').hide();
                    $('.sectionujian').hide();
                    $('.sectiontahfid').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $("#gridperkembangansantri").jqxGrid('updatebounddata');
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
        });
        $('#btnexport').click(function () {
            var gridContent = $("#griddetailperkembangansantri").jqxGrid('exportdata', 'json');
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
        $('#topbtnpenilaianalquran').click(function () {
            $(".divpanelleft").hide();
            $(".halaqoh").hide();
            $(".card9").hide();
            $('.sectionujian').show();
            $('#divkertasujian').hide();
            var set01	= document.getElementById('id_kelas').value;
            var set02	= document.getElementById('mas_tapel').value;
            var set03	= document.getElementById('mas_semester').value;
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'nama', type: 'text'},
                    { name: 'jilid', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'foto', type: 'text'},
                    { name: 'tmplahir', type: 'text'},
                    { name: 'tgllahir', type: 'text'},
                    { name: 'tapel', type: 'text'},
                    { name: 'tanggal', type: 'text'},
                    { name: 'ziyadah_mulaisurah', type: 'text'},
                    { name: 'ziyadah_mulaiayat', type: 'text'},
                    { name: 'ziyadah_akhirsurah', type: 'text'},
                    { name: 'ziyadah_akhirayat', type: 'text'},
                    { name: 'ziyadah_nilai'},
                    { name: 'ziyadah_predikat', type: 'text'},
                    { name: 'murojaah_mulaisurah', type: 'text'},
                    { name: 'murojaah_mulaiayat', type: 'text'},
                    { name: 'murojaah_akhirsurah', type: 'text'},
                    { name: 'murojaah_akhirayat', type: 'text'},
                    { name: 'murojaah_nilai'},
                    { name: 'murojaah_predikat', type: 'text'},
                    { name: 'tilawah_mulaisurah', type: 'text'},
                    { name: 'tilawah_mulaiayat', type: 'text'},
                    { name: 'tilawah_akhirsurah', type: 'text'},
                    { name: 'tilawah_akhirayat', type: 'text'},
                    { name: 'tilawah_nilai'},
                    { name: 'tilawah_predikat', type: 'text'},
                    { name: 'tahsin_mulaisurah', type: 'text'},
                    { name: 'tahsin_nilai', type: 'text'},
                    { name: 'tahsin_predikat', type: 'text'},
                    { name: 'catatan', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:'semuakelas', val04:set03, _token: '{{ csrf_token() }}'},
                url: '{{ route("jsonSetoranTahfid") }}',
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#gridsantri").jqxGrid({
                width           : '100%',
                pageable        : false,
                rowsheight      : 45,
                autoheight      : true,
                filterable      : true, 
                source          : dataAdapter,
                theme           : "energyblue",
                selectionmode   : 'singlecell',
                columns         : [
                    { text: 'Photo', datafield: 'foto', editable: false, filterable: false, width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '70%', cellsalign: 'left', align: 'center' },
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'left', align: 'center' },
                    { text: 'Pilih', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
                        return "Pilih";
                        }, buttonclick: function (row) {
                            editrow         = row;
                            var offset 		= $("#gridsantri").offset();
                            var dataRecord 	= $("#gridsantri").jqxGrid('getrowdata', editrow);
                            $("#ujian_nama").val(dataRecord.nama);
                            $("#ujian_kelas").val(dataRecord.kelas);
                            $("#ujian_noinduk").val(dataRecord.noinduk);
                            $("#ujian_foto").val(dataRecord.tmplahir+', '+dataRecord.tgllahir);
                            $("#modalpilihanujian").modal('show');
                        }
                    },
                ],
            });
        });
        $('#btnopenlembarujian').click(function () {
            var jenis=document.getElementById('sel_ujian_jenis').value;
            if (jenis == ''){
                swal({
                    title	: 'Stop',
                    text	: 'Bapak/Ibu belum memilih jenis ujian',
                    type	: 'warning',
                })
            } else {
                $("#ujian_jenis").val(jenis);
                $('#divkertasujian').show();
                $('#divriwayat').hide();
                $('.detailperhalaman').show();
                $('.reviewujian').hide();
                $('.selectornilai').val('');
                $('.navalue').html('n/a');
                $('.clearvalue').val('');
                $("#modalpilihanujian").modal('hide');
            }
        });
        $(".selectornilai").on('change', function () {
            var juzid       = $(this).find('option:selected').attr('penandajuz');
            var idne        = $(this).find('option:selected').attr('penanda');
            var nilai       = $(this).find('option:selected').attr('value');
            var maksimal    = 100;
            var set01       = document.getElementById('kata_'+idne).value;
            if (nilai == '' || nilai == null){

            } else {
                if (nilai == 0){
                    $('#tlsnilaikesalahan_'+idne).html('0.00');
                    $('#nilaikesalahan_'+idne).val('0.00');
                    $('#tlsnilaisurat_'+idne).html('100.00');
                    $('#nilaipersurat_'+idne).val('100.00');
                    $('#tlspredikat_'+idne).html('ممتاز');
                    $('#predikat_'+idne).val('ممتاز');
                    var nilawal     = 0;
                    var nilkedua    = 100;
                    var predikat    = 'ممتاز';
                } else {
                    var nilai       = parseFloat(nilai);
                    var set01       = parseFloat(set01);
                    var nilawal     = ((nilai / set01)*100);
                    var nilkedua    = 100 - nilawal;
                    $('#tlsnilaikesalahan_'+idne).html(nilawal);
                    $('#nilaikesalahan_'+idne).val(nilawal);
                    $('#tlsnilaisurat_'+idne).html(nilkedua);
                    $('#nilaipersurat_'+idne).val(nilkedua);
                    var predikat = konversiNilai(nilkedua);
                    $('#tlspredikat_'+idne).html(predikat);
                    $('#predikat_'+idne).val(predikat);
                }
            }
            var inputs  = document.querySelectorAll('.niljuz'+juzid);
            var total   = 0;
            var jumlah  = 0;
            inputs.forEach(function(input) {
                var nilaiperhalaman = parseFloat(input.value);
                if (!isNaN(nilaiperhalaman)) {
                    total += nilaiperhalaman;
                    jumlah++;
                }
            });
            var rataRata = total / jumlah;
            $('.tlsnilaijuz_'+juzid).html(rataRata);
            var set01=document.getElementById('ujian_nama').value;
            var set02=document.getElementById('ujian_kelas').value;
            var set03=document.getElementById('ujian_noinduk').value;
            var set04=document.getElementById('ujian_semester').value;
            var set05=document.getElementById('ujian_tapel').value;
            var set06=document.getElementById('ujian_hariefektif').value;
            var set07=document.getElementById('ujian_prszydsekolah').value;
            var set08=document.getElementById('ujian_prsmrjsekolah').value;
            var set09=document.getElementById('ujian_foto').value;
            var set10=document.getElementById('ujian_jenis').value;
            var set11=document.getElementById('ujian_prszydrumah').value;
            var set12=document.getElementById('ujian_prsmrjrumah').value;
            var formdata = new FormData();
                formdata.set('_token', '{{ csrf_token() }}');
                formdata.set('nama', set01);
                formdata.set('noinduk', set03);
                formdata.set('kelas', set02);
                formdata.set('foto', set09);
                formdata.set('semester', set04);
                formdata.set('tapel', set05);
                formdata.set('tapelsemester', set05+'-'+set04+'-'+set10);
                formdata.set('juz', 'Juz '+juzid);
                formdata.set('idtemplate', idne);
                formdata.set('jumlahkesalahan', nilai);
                formdata.set('nilaikesalahan', nilawal);
                formdata.set('nilaipersurat', nilkedua);
                formdata.set('predikat', predikat);
                formdata.set('nilaiperjuz', rataRata);
                formdata.set('hariefektif', set06);
                formdata.set('prszydsekolah', set07);
                formdata.set('prsmrjsekolah', set08);
                formdata.set('jenisujian', set10);
                formdata.set('prszydrumah', set11);
                formdata.set('prsmrjrumah', set12);
                formdata.set('workcode', 'perhalaman');
            $.ajax({
                url         : '{{ route("exInputnilaiUA") }}',
                data        : formdata,
                type        : 'POST',
                contentType : false,
                processData : false,
                success: function (data) {
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
        $('#btngotoreview').click(function () {
            $('.detailperhalaman').hide();
            $('.reviewujian').show();
            var set03=document.getElementById('ujian_noinduk').value;
            var set04=document.getElementById('ujian_semester').value;
            var set05=document.getElementById('ujian_tapel').value;
            var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
            var formdata = new FormData();
                formdata.set('_token', '{{ csrf_token() }}');
                formdata.set('noinduk', set03);
                formdata.set('semester', set04);
                formdata.set('tapel', set05);
                formdata.set('workcode', 'getabsen');
            $("html, body").animate({ scrollTop: 0 }, "slow");
            $.ajax({
                url         : '{{ route("exInputnilaiUA") }}',
                data        : formdata,
                type        : 'POST',
                contentType : false,
                processData : false,
                success: function (data) {
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    var total   = data.total;
                    $('#ujian_hariefektif').val(total);
                    $('#ujian_prsmrjsekolah').val(data.prsmrjsekolah);
                    $('#ujian_prszydsekolah').val(data.prszydsekolah);
                    $('#ujian_prszydrumah').val(data.prszydrumah);
                    $('#ujian_prsmrjrumah').val(data.prsmrjrumah);
                    
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
        $('#btngotodetailperhalaman').click(function () {
            $('.detailperhalaman').show();
            $('.reviewujian').hide();
        });
        $('#btnsimpanujianalquran').click(function () {
            var set01=document.getElementById('ujian_nama').value;
            var set02=document.getElementById('ujian_kelas').value;
            var set03=document.getElementById('ujian_noinduk').value;
            var set04=document.getElementById('ujian_semester').value;
            var set05=document.getElementById('ujian_tapel').value;
            var set06=document.getElementById('ujian_hariefektif').value;
            var set07=document.getElementById('ujian_prszydsekolah').value;
            var set08=document.getElementById('ujian_prsmrjsekolah').value;
            var set09=document.getElementById('ujian_foto').value;
            var set10=document.getElementById('ujian_jenis').value;
            var set11=document.getElementById('ujian_prszydrumah').value;
            var set12=document.getElementById('ujian_prsmrjrumah').value;
            var set13=document.getElementById('ujian_tanggal').value;
            if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == ''){
                swal({
                    title	: 'Mohon di Lengkapi',
                    text	: 'Nama, Kelas, No Induk, Tapel dan Semester Tidak Boleh Kosong. Mohon Refresh Kembali Laman Ini',
                    type	: 'warning',
                })
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData();
                    formdata.set('_token', '{{ csrf_token() }}');
                    formdata.set('nama', set01);
                    formdata.set('kelas', set02);
                    formdata.set('noinduk', set03);
                    formdata.set('semester', set04);
                    formdata.set('tapel', set05);
                    formdata.set('hariefektif', set06);
                    formdata.set('prszydsekolah', set07);
                    formdata.set('prsmrjsekolah', set08);
                    formdata.set('jenisujian', set10);
                    formdata.set('prszydrumah', set11);
                    formdata.set('prsmrjrumah', set12);
                    formdata.set('tanggal', set13);
                    formdata.set('foto', set09);
                    formdata.set('tapelsemester', set05+'-'+set04+'-'+set10);
                    formdata.set('workcode', 'final');
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $.ajax({
                    url         : '{{ route("exInputnilaiUA") }}',
                    data        : formdata,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success: function (data) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        $('#divkertasujian').hide();
                        $('#divriwayat').hide();
                        var status  = data.status;
                        var message = data.message;
                        var warna 	= data.warna;
                        var icon 	= data.icon;
                        var linkra 	= data.linkra;
                        $.toast({
                            heading: status,
                            text: message,
                            position: 'top-right',
                            loaderBg: warna,
                            icon: icon,
                            hideAfter: 5000,
                            stack: 1
                        });
                        setTimeout(function () { window.open(linkra, '_blank');}, 5000);
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
        $('#btnboxkembalikearsip').click(function () {
            $('.halaqoh').hide();
            $('#divriwayat').show();
            $("#gridriwayat").jqxGrid('updatebounddata');
        });
        $('#btnviewarsip').click(function () {
            var set01       = document.getElementById('arsip_tapel').value;
            var set02       = document.getElementById('arsip_semester').value;
            var sourcears01 = {
                datatype: "json",
                datafields: [
                    { name: 'nama', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'foto', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'tapel', type: 'text'},
                    { name: 'tapelsemester', type: 'text'},
                    { name: 'sakit', type: 'text'},
                    { name: 'ijin', type: 'text'},
                    { name: 'alpha', type: 'text'},
                    { name: 'semester', type: 'text'},
                    { name: 'link', type: 'text'},
                    { name: 'setoransekolah', type: 'text'},
                    { name: 'setoranrumah', type: 'text'},
                    { name: 'hariefektif', type: 'text'},
                    { name: 'namaguru', type: 'text'},
                    { name: 'created_at', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:'arsipujianalquran', val04:'JUZ', _token: '{{ csrf_token() }}'},
                url: '{{ route("jsonSetoranTahfid") }}',
            };
            var dataAdapterArsip01 = new $.jqx.dataAdapter(sourcears01);
            var linkrapotgeneratorsatu = function (row, column, value) {
                var id    = $('#gridriwayat').jqxGrid('getrowdata', row).link;
                var url     = '<a href="{{url("/")}}/'+id+'" target="_blank"><span class="badge badge-primary">View</span></a>';
                return url;
            }
            $("#gridriwayat").jqxGrid({
                width           : '100%',
                pageable        : true,
                sortable        : true,
                autoheight      : true,
                filterable      : true,
                filtermode      : 'excel',
                source          : dataAdapterArsip01,
                theme           : "energyblue",
                selectionmode   : 'singlecell',
                columns         : [
                    { text: 'Kelas', datafield: 'kelas', width: '10%', ellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '30%', align: 'center' },
                    { text: 'No Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Semester', datafield: 'semester', width: '10%', cellsalign: 'center', align: 'center'},	
                    { text: 'Kode', datafield: 'tapelsemester', width: '15%', cellsalign: 'left', align: 'center' },
                    { text: 'Link Rapot', cellsrenderer: linkrapotgeneratorsatu, width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '15%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow             = row;
                            var offset 		    = $("#gridriwayat").offset();
                            var dataRecord 	    = $("#gridriwayat").jqxGrid('getrowdata', editrow);
                            var tapelsemester   = dataRecord.tapelsemester;
                            const arrkode       = tapelsemester.split("-");
                            var created_at      = dataRecord.created_at;
                            const arrtanggal    = created_at.split(" ");
                            var tanggal         = arrtanggal[0];
                            var jenis           = arrkode[3];
                            var tapel           = arrkode[0]+'-'+arrkode[1];
                            $("#editorujian_jenis").val(jenis);
                            $("#editorujian_nama").val(dataRecord.nama);
                            $("#editorujian_kelas").val(dataRecord.kelas);
                            $("#editorujian_noinduk").val(dataRecord.noinduk);
                            $("#editorujian_foto").val(dataRecord.foto);
                            $("#editorujian_semester").val(dataRecord.semester);
                            $("#editorujian_tapel").val(dataRecord.tapel);
                            $("#editorujian_sakit").val(dataRecord.sakit);
                            $("#editorujian_ijin").val(dataRecord.ijin);
                            $("#editorujian_alpha").val(dataRecord.alpha);
                            $("#editorujian_hariefektif").val(dataRecord.hariefektif);
                            $("#editorujian_setoransekolah").val(dataRecord.setoransekolah);
                            $("#editorujian_setoranrumah").val(dataRecord.setoranrumah);
                            $("#editorujian_tapelsemester").val(dataRecord.tapelsemester);
                            $("#editorujian_tanggal").val(tanggal);
                            $("#editorujian_namapengguji").val(dataRecord.namaguru);
                            $('.halaqoh').hide();
                            $('#diveditorujianalquran').show();
                            openEditorNilaiUjianQuran();
                        }
                    },
                ], 
            });
            var sourcears02 = {
                datatype: "json",
                datafields: [
                    { name: 'nama', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'foto', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'tapel', type: 'text'},
                    { name: 'tapelsemester', type: 'text'},
                    { name: 'sakit', type: 'text'},
                    { name: 'ijin', type: 'text'},
                    { name: 'alpha', type: 'text'},
                    { name: 'semester', type: 'text'},
                    { name: 'link', type: 'text'},
                    { name: 'setoransekolah', type: 'text'},
                    { name: 'setoranrumah', type: 'text'},
                    { name: 'hariefektif', type: 'text'},
                    { name: 'namaguru', type: 'text'},
                    { name: 'created_at', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:'arsipujianalquran', val04:'UTS', _token: '{{ csrf_token() }}'},
                url: '{{ route("jsonSetoranTahfid") }}',
            };
            var dataAdapterArsip02 = new $.jqx.dataAdapter(sourcears02);
            var linkrapotgeneratordua = function (row, column, value) {
                var id    = $('#gridriwayatuts').jqxGrid('getrowdata', row).link;
                var url     = '<a href="{{url("/")}}/'+id+'" target="_blank"><span class="badge badge-primary">View</span></a>';
                return url;
            }
            $("#gridriwayatuts").jqxGrid({
                width           : '100%',
                pageable        : true,
                sortable        : true,
                autoheight      : true,
                filterable      : true,
                filtermode      : 'excel',
                source          : dataAdapterArsip02,
                theme           : "energyblue",
                selectionmode   : 'singlecell',
                columns         : [
                    { text: 'Kelas', datafield: 'kelas', width: '10%', ellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '30%', align: 'center' },
                    { text: 'No Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Semester', datafield: 'semester', width: '10%', cellsalign: 'center', align: 'center'},	
                    { text: 'Kode', datafield: 'tapelsemester', width: '15%', cellsalign: 'left', align: 'center' },
                    { text: 'Link Rapot', cellsrenderer: linkrapotgeneratordua, width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '15%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow             = row;
                            var offset 		    = $("#gridriwayatuts").offset();
                            var dataRecord 	    = $("#gridriwayatuts").jqxGrid('getrowdata', editrow);
                            var tapelsemester   = dataRecord.tapelsemester;
                            const arrkode       = tapelsemester.split("-");
                            var created_at      = dataRecord.created_at;
                            const arrtanggal    = created_at.split(" ");
                            var tanggal         = arrtanggal[0];
                            var jenis           = arrkode[3];
                            var tapel           = arrkode[0]+'-'+arrkode[1];
                            
                            $("#editorujian_jenis").val(jenis);
                            $("#editorujian_nama").val(dataRecord.nama);
                            $("#editorujian_kelas").val(dataRecord.kelas);
                            $("#editorujian_noinduk").val(dataRecord.noinduk);
                            $("#editorujian_foto").val(dataRecord.foto);
                            $("#editorujian_semester").val(dataRecord.semester);
                            $("#editorujian_tapel").val(dataRecord.tapel);
                            $("#editorujian_sakit").val(dataRecord.sakit);
                            $("#editorujian_ijin").val(dataRecord.ijin);
                            $("#editorujian_alpha").val(dataRecord.alpha);
                            $("#editorujian_hariefektif").val(dataRecord.hariefektif);
                            $("#editorujian_setoransekolah").val(dataRecord.setoransekolah);
                            $("#editorujian_setoranrumah").val(dataRecord.setoranrumah);
                            $("#editorujian_tapelsemester").val(dataRecord.tapelsemester);
                            $("#editorujian_tanggal").val(tanggal);
                            $("#editorujian_namapengguji").val(dataRecord.namaguru);
                            $('.halaqoh').hide();
                            $('#diveditorujianalquran').show();
                            openEditorNilaiUjianQuran();
                        }
                    },
                ], 
            });
            var sourcears03 = {
                datatype: "json",
                datafields: [
                    { name: 'nama', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'foto', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'tapel', type: 'text'},
                    { name: 'tapelsemester', type: 'text'},
                    { name: 'sakit', type: 'text'},
                    { name: 'ijin', type: 'text'},
                    { name: 'alpha', type: 'text'},
                    { name: 'semester', type: 'text'},
                    { name: 'link', type: 'text'},
                    { name: 'setoransekolah', type: 'text'},
                    { name: 'setoranrumah', type: 'text'},
                    { name: 'hariefektif', type: 'text'},
                    { name: 'namaguru', type: 'text'},
                    { name: 'created_at', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:'arsipujianalquran', val04:'UAS', _token: '{{ csrf_token() }}'},
                url: '{{ route("jsonSetoranTahfid") }}',
            };
            var dataAdapterArsip03 = new $.jqx.dataAdapter(sourcears03);
            var linkrapotgeneratortiga = function (row, column, value) {
                var id    = $('#gridriwayatuas').jqxGrid('getrowdata', row).link;
                var url     = '<a href="{{url("/")}}/'+id+'" target="_blank"><span class="badge badge-primary">View</span></a>';
                return url;
            }
            $("#gridriwayatuas").jqxGrid({
                width           : '100%',
                pageable        : true,
                sortable        : true,
                autoheight      : true,
                filterable      : true,
                filtermode      : 'excel',
                source          : dataAdapterArsip03,
                theme           : "energyblue",
                selectionmode   : 'singlecell',
                columns         : [
                    { text: 'Kelas', datafield: 'kelas', width: '10%', ellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '30%', align: 'center' },
                    { text: 'No Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Semester', datafield: 'semester', width: '10%', cellsalign: 'center', align: 'center'},	
                    { text: 'Kode', datafield: 'tapelsemester', width: '15%', cellsalign: 'left', align: 'center' },
                    { text: 'Link Rapot', cellsrenderer: linkrapotgeneratortiga, width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '15%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow             = row;
                            var offset 		    = $("#gridriwayatuas").offset();
                            var dataRecord 	    = $("#gridriwayatuas").jqxGrid('getrowdata', editrow);
                            var tapelsemester   = dataRecord.tapelsemester;
                            const arrkode       = tapelsemester.split("-");
                            var created_at      = dataRecord.created_at;
                            const arrtanggal    = created_at.split(" ");
                            var tanggal         = arrtanggal[0];
                            var jenis           = arrkode[3];
                            var tapel           = arrkode[0]+'-'+arrkode[1];
                            
                            $("#editorujian_jenis").val(jenis);
                            $("#editorujian_nama").val(dataRecord.nama);
                            $("#editorujian_kelas").val(dataRecord.kelas);
                            $("#editorujian_noinduk").val(dataRecord.noinduk);
                            $("#editorujian_foto").val(dataRecord.foto);
                            $("#editorujian_semester").val(dataRecord.semester);
                            $("#editorujian_tapel").val(dataRecord.tapel);
                            $("#editorujian_sakit").val(dataRecord.sakit);
                            $("#editorujian_ijin").val(dataRecord.ijin);
                            $("#editorujian_alpha").val(dataRecord.alpha);
                            $("#editorujian_hariefektif").val(dataRecord.hariefektif);
                            $("#editorujian_setoransekolah").val(dataRecord.setoransekolah);
                            $("#editorujian_setoranrumah").val(dataRecord.setoranrumah);
                            $("#editorujian_tapelsemester").val(dataRecord.tapelsemester);
                            $("#editorujian_tanggal").val(tanggal);
                            $("#editorujian_namapengguji").val(dataRecord.namaguru);
                            $('.halaqoh').hide();
                            $('#diveditorujianalquran').show();
                            openEditorNilaiUjianQuran();
                        }
                    },
                ], 
            });
            $('#divriwayat').show();
        });
        $("#modaleditorujian_jumlahkesalahan").on('change', function () {
            var nilai       = $(this).find('option:selected').attr('value');
            var maksimal    = 100;
            var set01       = document.getElementById('modaleditorujian_jumlahkata').value;
            if (nilai == '' || nilai == null){

            } else {
                if (nilai == 0){
                    $('#modaleditorujian_nilaikesalahan').val('0.00');
                    $('#modaleditorujian_nilaipersurat').val('100.00');
                    $('#modaleditorujian_predikat').val('ممتاز');
                } else {
                    var nilai       = parseFloat(nilai);
                    var set01       = parseFloat(set01);
                    var nilawal     = ((nilai / set01)*100);
                    var nilkedua    = 100 - nilawal;
                    $('#modaleditorujian_nilaikesalahan').val(nilawal);
                    $('#modaleditorujian_nilaipersurat').val(nilkedua);
                    var predikat = konversiNilai(nilkedua);
                    $('#modaleditorujian_predikat').val(predikat);
                }
            }
        });
        $('#btnsimpannilaiujianedit').click(function () {
            var set01=document.getElementById('modaleditorujian_nama').value;
            var set02=document.getElementById('modaleditorujian_kelas').value;
            var set03=document.getElementById('modaleditorujian_noinduk').value;
            var set04=document.getElementById('modaleditorujian_semester').value;
            var set05=document.getElementById('modaleditorujian_tapel').value;
            var set06=document.getElementById('modaleditorujian_hariefektif').value;
            var set07=document.getElementById('modaleditorujian_prszydsekolah').value;
            var set08=document.getElementById('modaleditorujian_prsmrjsekolah').value;
            var set09=document.getElementById('modaleditorujian_foto').value;
            var set11=document.getElementById('modaleditorujian_prszydrumah').value;
            var set12=document.getElementById('modaleditorujian_prsmrjrumah').value;
            var set13=document.getElementById('modaleditorujian_id').value;
            $("#modaleditorpenilaianujianalquran").modal('hide');
            var formdata = new FormData();
                formdata.set('_token', '{{ csrf_token() }}');
                formdata.set('id', set13);
                formdata.set('jumlahkesalahan', document.getElementById('modaleditorujian_jumlahkesalahan').value);
                formdata.set('nilaikesalahan', document.getElementById('modaleditorujian_nilaikesalahan').value);
                formdata.set('nilaipersurat', document.getElementById('modaleditorujian_nilaipersurat').value);
                formdata.set('predikat', document.getElementById('modaleditorujian_predikat').value);
                formdata.set('workcode', 'editorujianalquran');
            $.ajax({
                url         : '{{ route("exInputnilaiUA") }}',
                data        : formdata,
                type        : 'POST',
                contentType : false,
                processData : false,
                success: function (data) {
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
                    $("#gridriwayatujianalquran").jqxGrid('updatebounddata', 'filter');
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
        });
        $('#btnupdatedataujianalquranedit').click(function () {
            var set01=document.getElementById('editorujian_nama').value;
            var set02=document.getElementById('editorujian_kelas').value;
            var set03=document.getElementById('editorujian_noinduk').value;
            var set04=document.getElementById('editorujian_semester').value;
            var set05=document.getElementById('editorujian_tapel').value;
            var set06=document.getElementById('editorujian_sakit').value;
            var set07=document.getElementById('editorujian_ijin').value;
            var set08=document.getElementById('editorujian_alpha').value;
            var set09=document.getElementById('editorujian_foto').value;
            var set10=document.getElementById('editorujian_tapelsemester').value;
            var set11=document.getElementById('editorujian_jenis').value;
            var set12=document.getElementById('editorujian_setoransekolah').value;
            var set13=document.getElementById('editorujian_setoranrumah').value;
            var set14=document.getElementById('editorujian_hariefektif').value;
            var set15=document.getElementById('editorujian_tanggal').value;
            var set16=document.getElementById('editorujian_namapengguji').value;
            var formdata = new FormData();
                formdata.set('_token', '{{ csrf_token() }}');
                formdata.set('nama', set01);
                formdata.set('kelas', set02);
                formdata.set('noinduk', set03);
                formdata.set('semester', set04);
                formdata.set('tapel', set05);
                formdata.set('sakit', set06);
                formdata.set('ijin', set07);
                formdata.set('alpha', set08);
                formdata.set('jenisujian', set11);
                formdata.set('foto', set09);
                formdata.set('tapelsemesterawal', set10);
                formdata.set('setoransekolah', set12);
                formdata.set('setoranrumah', set13);
                formdata.set('hariefektif', set14);
                formdata.set('tanggal', set15);
                formdata.set('namapengguji', set16);
                formdata.set('tapelsemester', set05+'-'+set04+'-'+set11);
                formdata.set('workcode', 'editordataujianalquran');
            $.ajax({
                url         : '{{ route("exInputnilaiUA") }}',
                data        : formdata,
                type        : 'POST',
                contentType : false,
                processData : false,
                success: function (data) {
                    var status  = data.status;
                    var message = data.message;
                    var warna 	= data.warna;
                    var icon 	= data.icon;
                    $("#editorujian_tapelsemester").val(set05+'-'+set04+'-'+set11);
                    $.toast({
                        heading: status,
                        text: message,
                        position: 'top-right',
                        loaderBg: warna,
                        icon: icon,
                        hideAfter: 5000,
                        stack: 1
                    });
                    openEditorNilaiUjianQuran();
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
        });
        $('#btnkirimdataujianalquranedit').click(function () {
            var set01=document.getElementById('editorujian_nama').value;
            var set02=document.getElementById('editorujian_kelas').value;
            var set03=document.getElementById('editorujian_noinduk').value;
            var set04=document.getElementById('editorujian_semester').value;
            var set05=document.getElementById('editorujian_tapel').value;
            var set06=document.getElementById('editorujian_sakit').value;
            var set07=document.getElementById('editorujian_ijin').value;
            var set08=document.getElementById('editorujian_alpha').value;
            var set09=document.getElementById('editorujian_foto').value;
            var set10=document.getElementById('editorujian_tapelsemester').value;
            var set11=document.getElementById('editorujian_jenis').value;
            var set12=document.getElementById('editorujian_setoransekolah').value;
            var set13=document.getElementById('editorujian_setoranrumah').value;
            var set14=document.getElementById('editorujian_hariefektif').value;
            var set15=document.getElementById('editorujian_tanggal').value;
            var formdata = new FormData();
                formdata.set('_token', '{{ csrf_token() }}');
                formdata.set('nama', set01);
                formdata.set('kelas', set02);
                formdata.set('noinduk', set03);
                formdata.set('semester', set04);
                formdata.set('tapel', set05);
                formdata.set('sakit', set06);
                formdata.set('ijin', set07);
                formdata.set('alpha', set08);
                formdata.set('jenisujian', set11);
                formdata.set('foto', set09);
                formdata.set('tapelsemesterawal', set10);
                formdata.set('setoransekolah', set12);
                formdata.set('setoranrumah', set13);
                formdata.set('hariefektif', set14);
                formdata.set('tanggal', set15);
                formdata.set('tapelsemester', set05+'-'+set04+'-'+set11);
                formdata.set('workcode', 'kirimdataujianalquran');
            $.ajax({
                url         : '{{ route("exInputnilaiUA") }}',
                data        : formdata,
                type        : 'POST',
                contentType : false,
                processData : false,
                success: function (data) {
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
                },
                error: function (xhr, status, error) {
                    swal({
                        title	: 'Stop',
                        text	: xhr.responseText,
                        type	: 'warning',
                    })
                }
            });
        });
        
    });
</script>
@endpush