@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Penilaian Alquran {{ $setidkelas }}</h1>
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
                <div class="col-md-12 sectiontahfid">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title" id="juduldetailalquran">Perkembangan Santri</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body" id="divawalperkemsantri">
                            <div id="gridperkembangansantri"></div>
                        </div>
                        <div class="card-footer" id="divdetperkemsantri">
                            <button class="btn btn-success" id="btnclosedetailperkembangan">Close Detail</button>
                            <button class="btn btn-primary" id="btnexport">Export</button>
                            <div id="griddetailperkembangansantri"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 sectiontahfid">
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Tugas di Rumah Kelas {{ $setidkelas }} </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body" id="divrpa">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group btn-group-vertical">
                                            @if(isset($kelasrpa) && !empty($kelasrpa))
                                                @foreach($kelasrpa as $rows)
                                                    <a href="#" id="grade{{$rows['kelas']}}"  onClick="jQueryOpenRPAKelas('{{$rows['kelas']}}')" class="btn btn-block btn-social btn-primary">
                                                        <i class="fa fa-windows"></i> Grade {{$rows['kelas']}}
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <a href="{{url('/prestasialquran')}}" class="btn btn-social btn-info"><i class="fa fa-cogs"></i> Edit Data </a>
                                        <div id="gridrpa"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" id="divceklistpr">
                            <button class="btn btn-success" id="btnviewrpa">Close Detail</button>
                            <div id="gridceklistpr"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 sectionsetoran">
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
                                        <div class="col-lg-6">
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
                                        <div class="col-lg-2">
                                            <label>Tanggal</label>
                                            <input type="text" id="setoran_tanggal" name="setoran_tanggal" class="form-control" readonly>
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
                <div class="col-md-6 sectionsetoran">
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
                <div class="col-md-4 sectionujian">
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
                <div class="col-md-8" id="divkertasujian">
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
                                        <label for="ujian_kelas">Kelas</label>
                                        <input type="text" class="form-control" id="ujian_kelas" name="ujian_kelas" readonly>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="ujian_noinduk">No Induk</label>
                                        <input type="text" class="form-control" id="ujian_noinduk" name="ujian_noinduk" readonly>
                                        <input type="hidden" id="ujian_foto" name="ujian_foto">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="ujian_semester">Semester</label>
                                        <input type="text" class="form-control" id="ujian_semester" name="ujian_semester" value="{{$smt}}" readonly>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="ujian_tapel">Tapel</label>
                                        <input type="text" class="form-control" id="ujian_tapel" name="ujian_tapel" value="{{$tapel}}" readonly>
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
                                                echo '<li class="nav-item"><a class="nav-link '.$aktif.'" href="#tabpaneidjuz'.$juznumberonly[$i].'" data-toggle="tab">'.$juznumberonly[$i].'</a></li>';
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
                                                    <div class="tab-pane {{$aktif}}" id="tabpaneidjuz{{ $juznumberonly[$i] }}"><div class="card">
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
                                <div class="form-group row">
                                    <label for="ujian_hariefektif" class="col-sm-4 col-form-label">Hari Efektif <span class="text-danger">*</span>:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="ujian_hariefektif" name="ujian_hariefektif">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ujian_harisetorsekolah" class="col-sm-4 col-form-label">Jumlah Setoran di Sekolah <span class="text-danger">*</span>:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="ujian_harisetorsekolah" name="ujian_harisetorsekolah">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ujian_harisetorrumah" class="col-sm-4 col-form-label">Jumlah Setoran di Rumah <span class="text-danger">*</span>:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="ujian_harisetorrumah" name="ujian_harisetorrumah">
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
                <div class="col-md-8" id="divriwayat">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Penilaian</h3>
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
                </div>
            </div>
		</div>
	</section>
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
                        <label>Mulai Surah</label>
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
                                    <select id="murojaah_nilai" name="murojaah_nilai" class="form-control">
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
                                    <select id="murojaah_status" name="murojaah_status"  class="form-control">
                                        <option value="">Pilih Salah Satu</option>
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
    <div class="modal fade" id="modalrpa">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Penilaian Murojaah di Rumah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
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
                <div class="modal-footer justify-content-between">
                    <div class="form-group">
                        <label for="rpa_murojaahdirumah">Voice Note di Rumah</label>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Mulai Surah</label>
                                <select id="rpa_murojaahdirumahawal" name="rpa_murojaahdirumahawal" class="form-control select2">
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
                            <div class="col-lg-6">
                                <label>Akhir Surah</label>
                                <select id="rpa_murojaahdirumahakhir" name="rpa_murojaahdirumahakhir" class="form-control select2">
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
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline pull-left btnviewrpa">Cancel</button>
                        <button type="button" class="btn btn-success" id="btnsimpandatarpa">Simpan</button>	
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
<input type="hidden" id="mas_semester" name="mas_semester" value="{{ $smt }}">
<input type="hidden" id="mas_tapel" name="mas_tapel" value="{{ $tapel }}">
<input type="hidden" id="id_kelas" name="id_kelas" value="{{$setidkelas}}">
<input type="hidden" name="masterkls" id="masterkls" value="{{ $masterkls }}">
<input type="hidden" name="set_tanggal" id="set_tanggal" value="{{ date('Y-m-d') }}">

@endsection
@push('script')
<script>
	$(function () {
        $('.select2').select2({width: '100%'});
		CKEDITOR.env.isCompatible = true;
        CKEDITOR.replace( 'setoran_tahsin', {
			toolbarGroups: [{"name":"paragraph","groups":["list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
		$('#set_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#absen_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
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
    function jQueryOpenRPA(){
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
                                        $("#setoran_kelas").val(dataRecord.kelas);
                                        $("#setoran_jilid").val(dataRecord.jilid);
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
                        $("#setoran_kelas").val(dataRecord.kelas);
                        $("#setoran_jilid").val(dataRecord.jilid);
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
                { text: 'Start Murojaah', columngroup: 'kelompok04', datafield: 'murojaah_mulaisurah', editable: false, filterable: false, width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'End Murojaah', columngroup: 'kelompok04', datafield: 'murojaah_akhirsurah', editable: false, filterable: false, width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'Start Ziyadah', columngroup: 'kelompok01', datafield: 'ziyadah_mulaisurah', editable: false, filterable: false, width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'End Ziyadah', columngroup: 'kelompok01', datafield: 'ziyadah_akhirsurah', editable: false, filterable: false, width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'Start Tilawah', columngroup: 'kelompok02', datafield: 'tilawah_mulaisurah', editable: false, filterable: false, width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'End Tilawah', columngroup: 'kelompok02', datafield: 'tilawah_akhirsurah', editable: false, filterable: false, width: '10%', cellsalign: 'left', align: 'center' },
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
                        $('#divkertasujian').show();
                        $('#divriwayat').hide();
                        $('.detailperhalaman').show();
                        $('.reviewujian').hide();
                        $('.selectornilai').val('');
                        $('.navalue').html('n/a');
                        $('.clearvalue').val('');
                    }
                },
            ],
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
    function jQueryOpenRPAKelas(set01){
        $(".card9").hide();
        $("#divrpa").show();
        var tahun='{{date("Y")}}';
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
                { text: 'Cheklist', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '5%', cellsrenderer: function () {
                    return "Cek PR";
                    }, buttonclick: function (row) {
                        editrow         = row;
                        var offset 		= $("#gridrpa").offset();
                        var dataRecord 	= $("#gridrpa").jqxGrid('getrowdata', editrow);
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
                        $("#divrpa").hide();
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
                                { text: 'Kelas', datafield: 'kelas', editable: false, width: '7%', cellsalign: 'center', align: 'center' },
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
                                        $("#murojaah_murojaahdirumahawal").val(dataRecord.murojaah_mulaiayat);
                                        $("#murojaah_murojaahdirumahakhir").val(dataRecord.murojaah_akhirayat);
                                        $("#murojaah_nilai").val(dataRecord.nilai);
                                        $("#murojaah_status").val(dataRecord.kelulusan);
                                        $("#murojaah_catatan").val(dataRecord.catatan);
                                        $("#murojaah_tanggal").val(dataRecord.tanggal);
                                        $("#idmurojaah").val(dataRecord.idmurojaah);
                                        $("#modalpenilaianprmurojaah").modal('show');
                                    }
                                },
                            ]
                        });
                    }
                },
                { text: 'Pekan', datafield: 'pekan', filtertype: 'checkedlist', width: '5%', cellsalign: 'center', align: 'center' },
                { text: 'PB', datafield: 'pb', filtertype: 'checkedlist', width: '5%', cellsalign: 'center', align: 'center' },
                { text: 'Bulan', datafield: 'bulan', filtertype: 'checkedlist', width: '5%', cellsalign: 'center', align: 'center' },
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
    }
    $(document).ready(function () {
        $('#divkertasujian').hide();
        $('#divriwayat').hide();
        $('#divceklistpr').hide();
        $('#divdetperkemsantri').hide();
        $('#divawalperkemsantri').show();
        $('.sectiontahfid').show();
        $('.sectionsetoran').hide();
        $('.sectionujian').hide();
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
                    formdata.set('setoran_nilai', set04);
                    formdata.set('setoran_status', set05);
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
        $('#btnviewrpa').click(function () {
            $('#divrpa').show();
            $('#divceklistpr').hide();
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
            $('.sectiontahfid').hide();
            $('.sectionsetoran').hide();
            $('.sectionujian').show();
            $('#divkertasujian').hide();
            $('#divriwayat').hide();
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
            var set07=document.getElementById('ujian_harisetorsekolah').value;
            var set08=document.getElementById('ujian_harisetorrumah').value;
            var set09=document.getElementById('ujian_foto').value;
            var formdata = new FormData();
                formdata.set('_token', '{{ csrf_token() }}');
                formdata.set('nama', set01);
                formdata.set('noinduk', set03);
                formdata.set('kelas', set02);
                formdata.set('foto', set09);
                formdata.set('semester', set04);
                formdata.set('tapel', set05);
                formdata.set('tapelsemester', set05+'-'+set04);
                formdata.set('juz', 'Juz '+juzid);
                formdata.set('idtemplate', idne);
                formdata.set('jumlahkesalahan', nilai);
                formdata.set('nilaikesalahan', nilawal);
                formdata.set('nilaipersurat', nilkedua);
                formdata.set('predikat', predikat);
                formdata.set('nilaiperjuz', rataRata);
                formdata.set('hariefektif', set06);
                formdata.set('setoransekolah', set07);
                formdata.set('setoranrumah', set08);
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
                    var rumah   = data.rumah;
                    var sekolah = data.sekolah;
                    $('#ujian_harisetorsekolah').val(sekolah);
                    $('#ujian_harisetorrumah').val(rumah);
                    
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
            var set07=document.getElementById('ujian_harisetorsekolah').value;
            var set08=document.getElementById('ujian_harisetorrumah').value;
            var set09=document.getElementById('ujian_foto').value;
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
                    formdata.set('setoransekolah', set07);
                    formdata.set('setoranrumah', set08);
                    formdata.set('foto', set09);
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
        jQueryOpenRPA();
        $('#btnviewarsip').click(function () {
            var set01   = document.getElementById('arsip_tapel').value;
            var set02   = document.getElementById('arsip_semester').value;
            var sourcearsip 	= {
                datatype: "json",
                datafields: [
                    { name: 'nama', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'foto', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'tapel', type: 'text'},
                    { name: 'semester', type: 'text'},
                    { name: 'link', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:'arsipujianalquran', _token: '{{ csrf_token() }}'},
                url: '{{ route("jsonSetoranTahfid") }}',
            };
            var dataAdapterArsip = new $.jqx.dataAdapter(sourcearsip);
            var linkrapotgenerator = function (row, column, value) {
                var id    = $('#gridriwayat').jqxGrid('getrowdata', row).link;
                var url     = '<a href="{{url("/")}}/'+id+'" target="_blank"><span class="badge badge-primary">View</span></a>';
                return url;
            }
            $("#gridriwayat").jqxGrid({
                width           : '100%',
                pageable        : true,
                autoheight      : true,
                filterable      : true,
                source          : dataAdapterArsip,
                theme           : "energyblue",
                selectionmode   : 'singlecell',
                columns         : [
                    { text: 'Kelas', datafield: 'kelas', width: '15%', ellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '25%', align: 'center' },
                    { text: 'No Induk', datafield: 'noinduk', width: '15%', cellsalign: 'center', align: 'center'},
                    { text: 'Semester', datafield: 'semester', width: '15%', cellsalign: 'center', align: 'center'},	
                    { text: 'TAPEL', datafield: 'tapel', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'Link Rapot', cellsrenderer: linkrapotgenerator, width: '15%', cellsalign: 'center', align: 'center' },
                ], 
            });
            $('#divriwayat').show();
        });
        $('#btnsimpandatarpa').click(function () {
            var set01=document.getElementById('rpa_murojaahdirumahawal').value;
            var set02=document.getElementById('rpa_murojaahdirumahakhir').value;
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
                    $("#modalrpa").modal('hide');
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
    });
</script>
@endpush