@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Bank Soal</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 divawal">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Control</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item"><a href="#" class="nav-link" id="btnbanksoal"><i class="fa fa-clone"></i> List Soal <span class="badge badge-primary float-right">{{$soalterverifikasi}} / {{$soaltidakterverikasi}}</span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link" id="btnopenkoreksi"><i class="fa fa-pencil"></i> Permohonan Koreksi<span class="badge badge-primary float-right">{{$koreksi}}</span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link" id="btntestlist"><i class="fa fa-check-square-o"></i> Ujian<span class="badge badge-primary float-right">{{$ujian}}</span></a></li>
                            </ul>
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
                            <div class="form-group">
                                <label>Kelas</label>
                                <select id="id_kelas" name="id_kelas" class="form-control" >
                                    <option value=""></option>
                                    @php
                                        for($i = 1; $i < 13; $i++) {
                                            echo '<option value="'.$i.'">Kelas '.$i.'</option>';
                                        }
                                    @endphp
                                </select>
                            </div>
						</div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-success" id="simpansetguru">Set Data Anda</button>
					    </div>
                    </div>
                </div>
                <div class="col-md-10 divawal">
                    <div id="enteni">
                        <img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
                    </div>
                    <div class="card card-success card-outline" id="diveditsoal">
                        <div class="card-header">
                            <h3 class="card-title">Add/Edit/Remove</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3">
                                        <label for="id_ceel">Semester</label>
                                        <select id="id_ceel" class="form-control">
                                            <option value="0">All Semester</option>
                                            @if ($smt == '1')
                                                <option value="1" selected>Ganjil</option>
                                                <option value="2">Genap</option>
                                            @else
                                                <option value="1">Ganjil</option>
                                                <option value="2" selected>Genap</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <label for="id_kace">Mata Pelajaran</label>
                                        <select id="id_kace" class="form-control">
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
                                    </div>
                                    
                                    <div class="col-lg-3 col-md-3">
                                        <label for="id_tipe">Type Soal</label>
                                        <select id="id_tipe" class="form-control">
                                            <option value="choice">Multiple Choice</option>
                                            <option value="esay">Esay (Option A as Key)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_deskripsi">Case Deskription</label>
                                <textarea id="id_deskripsi" rows="15" cols="20"></textarea>
                            </div>
                            <div class="form-group choice">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4" id="divopsia">
                                        <label for="id_optiona" id="labelopsia">Option A</label>
                                        <textarea id="id_optiona" rows="5" cols="20"></textarea>
                                    </div>
                                    <div class="col-lg-4 col-md-4 esay">
                                        <label for="id_optionb">Option B</label>
                                        <textarea id="id_optionb" rows="5" cols="20"></textarea>
                                    </div>
                                    <div class="col-lg-4 col-md-4 esay">
                                        <label for="id_optionc">Option C</label>
                                        <textarea id="id_optionc" rows="5" cols="20"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group choice">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 esay">
                                        <label for="id_optiond">Option D</label>
                                        <textarea id="id_optiond" rows="5" cols="20"></textarea>
                                    </div>
                                    <div class="col-lg-4 col-md-4 esay">
                                        <label for="id_optione">Option E</label>
                                        <textarea id="id_optione" rows="5" cols="20"></textarea>
                                    </div>
                                    <div class="col-lg-4 col-md-4 esay">
                                        <label for="id_keys">Keys</label>
                                        <select id="id_keys" class="form-control">
                                            <option value="">Please Select</option>
                                            <option value="A">Option A</option>
                                            <option value="B">Option B</option>
                                            <option value="C">Option C</option>
                                            <option value="D">Option D</option>
                                            <option value="E">Option E</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2" >
                                        <button class="btn btn-success pull-right" type="button" id="btnopenimage1"><i class="fa fa-instagram"></i></button>
                                        <button class="btn btn-warning pull-left" type="button" id="btnremoveimage1"><i class="fa fa-close"></i></button>
                                        <a href="#" id="imagenumber1" data-toggle="lightbox" data-title="Picture 01" data-gallery="gallery">
                                            <img id="preview" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic1" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="col-sm-2" >
                                        <button class="btn btn-success pull-right" type="button" id="btnopenimage2"><i class="fa fa-instagram"></i></button>
                                        <button class="btn btn-warning pull-left" type="button" id="btnremoveimage2"><i class="fa fa-close"></i></button>
                                        <a href="#" id="imagenumber2" data-toggle="lightbox" data-title="Picture 02" data-gallery="gallery">
                                            <img id="preview2" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic2" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="col-sm-2" >
                                        <button class="btn btn-success pull-right" type="button" id="btnopenimage3"><i class="fa fa-instagram"></i></button>
                                        <button class="btn btn-warning pull-left" type="button" id="btnremoveimage3"><i class="fa fa-close"></i></button>
                                        <a href="#" id="imagenumber3" data-toggle="lightbox" data-title="Picture 03" data-gallery="gallery">
                                            <img id="preview3" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic3" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="col-sm-2" >
                                        <button class="btn btn-success pull-right" type="button" id="btnopenimage4"><i class="fa fa-instagram"></i></button>
                                        <button class="btn btn-warning pull-left" type="button" id="btnremoveimage4"><i class="fa fa-close"></i></button>
                                        <a href="#" id="imagenumber4" data-toggle="lightbox" data-title="Picture 04" data-gallery="gallery">
                                            <img id="preview4" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic4" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="col-sm-2" >
                                        <button class="btn btn-success pull-right" type="button" id="btnopenimage5"><i class="fa fa-instagram"></i></button>
                                        <button class="btn btn-warning pull-left" type="button" id="btnremoveimage5"><i class="fa fa-close"></i></button>
                                        <a href="#" id="imagenumber5" data-toggle="lightbox" data-title="Picture 05" data-gallery="gallery">
                                            <img id="preview5" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic5" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="col-sm-2" >
                                        <button class="btn btn-success pull-right" type="button" id="btnopenimage6"><i class="fa fa-instagram"></i></button>
                                        <button class="btn btn-warning pull-left" type="button" id="btnremoveimage6"><i class="fa fa-close"></i></button>
                                        <a href="#" id="imagenumber6" data-toggle="lightbox" data-title="Picture 06" data-gallery="gallery">
                                            <img id="preview6" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic6" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="divpreviewdraftsoal">
                                <button class="btn btn-danger pull-right" type="button" id="btnclosedraftpreviewimage"><i class="fa fa-close"></i></button>
                                        
                                <img class="media-object" id="previewdraftsoal" src="{{ url('/') }}//dist/img/takadagambar.png" />
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6" >
                                        <input type="hidden" id="edit_idne">
                                        <button class="btn btn-success pull-right" type="button" id="btnupdatedataps">Simpan</button>
                                        <button class="btn btn-warning pull-left btnkembali" type="button">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary card-outline" id="divbanksoal">
                        <div class="card-header">
                            <h3 class="card-title">Semester {{$smt}} TA {{$tapel}} Kelas {{$klsajar}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <select id="set_jenis" class="form-control">
                                            <option value="1">Semua Soal Aktif</option>
                                            <option value="2">Soal Un Verified</option>
                                            <option value="3">Soal Rejected</option>
                                            <option value="0">Soal Inaktif/Deleted</option>
                                        
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" placeholder="Enter an Keyword and Press Search Buttom" id="main_valcari">
                                            <div class="input-group-append">
                                                <div class="btn btn-primary" id="btn-search">
                                                    <i class="fa fa-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 btn-group">
                                        <a href="#" id="btntambahsoal" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive mailbox-messages">
                                <table class="table products-list" id="table_list">
                                    <thead><tr><th class="text-center">Case List (click description to edit)</th></tr></thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card card-danger card-outline" id="divlistujian">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Ujian</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnarsipujian"><i class="fa fa-database"></i> View Arsip</button>
                                <button type="button" class="btn btn-tool" id="btntambahujian"><i class="fa fa-plus"></i> Tambah Ujian</button>
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body" id="diveditorujian">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <label for="ujian_nama">Nama Ujian</label>
                                        <input type="text" id="ujian_nama" class="form-control">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="ujian_matpel">Komponen Nilai</label>
                                        <select id="ujian_matpel" class="form-control select2">
                                            <option value="">Pilih</option>
                                            @if(isset($arraykomponen) && !empty($arraykomponen))
                                                @foreach($arraykomponen as $rkom)
                                                    <option value="{{ $rkom['idsetting'] }}" set01="{{ $rkom['nilaike'] }}" set02="{{ $rkom['idkd'] }}" set03="{{ $rkom['deskripsi'] }}" set04="{{ $rkom['muatan'] }}" set05="{{ $rkom['kodekd'] }}">{{ $rkom['namakomponen'] }} ( {{ $rkom['kodekd'] }} {{ $rkom['muatan'] }} )</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="hidden" id="ujian_semester">
                                        <input type="hidden" id="ujian_tapel">
                                        <input type="hidden" id="ujian_kelas">
                                        <input type="hidden" id="ujian_matapelajaran">
                                        <input type="hidden" id="ujian_komponen">
                                        <input type="hidden" id="ujian_kode">
                                        <input type="hidden" id="ujian_idkd">
                                        <input type="hidden" id="ujian_deskripsi">
                                        <input type="hidden" id="ujian_idsetting">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="ujian_tglmulai">Tgl. Mulai</label>
                                        <input type="text" id="ujian_tglmulai" name="ujian_tglmulai" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="ujian_jammulai">Jam Mulai</label>
                                        <input type="text" id="ujian_jammulai" name="ujian_jammulai" class="form-control timepicker">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="ujian_tglselesai">Tgl. Selesai</label>
                                        <input type="text" id="ujian_tglselesai" name="ujian_tglselesai" class="form-control"  data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="ujian_jamselesai">Jam Selesai</label>
                                        <input type="text" id="ujian_jamselesai" name="ujian_jamselesai" class="form-control timepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="ujian_status">Status Ujian</label>
                                        <select id="ujian_status" size="1" class="form-control">
                                            <option value="1">Aktif</option>
                                            <option value="0">Non Aktif</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="ujian_timer">Timer (Menit)</label>
                                        <input type="text" id="ujian_timer" name="ujian_timer" class="form-control">
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-success" id="btnsimpanujian"><i class="fa fa-thumbs-up"></i> Simpan</button>
                                    </div>
                                    <div class="col-lg-6" id="groupbtnlanjutan">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info" id="btnopencaselistview"><i class="fa fa-tasks"></i> Case List</button>
                                            <button type="button" class="btn btn-warning" id="btnopencaselistadd"><i class="fa fa-plus-circle"></i> Add Case</button>
                                            <button type="button" class="btn btn-danger" id="btnkembalidariinputtes"><i class="fa fa-reply"></i> Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" id="daftarujian">
                            <div id="gridtest"></div>
                        </div>
                        <div class="card-footer" id="divanalisisujian">
                            <button type="button" class="btn btn-success btn-icon btn-sm" id="btnclosedivanalisis"><i class="fa fa-close"></i></button>
                            <button type="button" class="btn btn-info btn-icon btn-sm" id="btnexportdivanalisis"><i class="fa fa-file-excel-o"></i></button>
                            <div id="gridanalisis"></div>
                        </div>
                        <div class="card-footer" id="daftarpeserta">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6" id="listpesertakiri">
                                        <div class="btn-group btn-corner">
                                            <div class="btn btn-danger" id="btncloselistpeserta"><i class="fa fa-close"></i></div>
                                        </div>
                                        <div class="form-group">
                                            <h2>Peserta Belum Terploting</h2>
                                            <div id="gridpelamar"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" id="listpesertakanan">
                                        <div class="form-group">
                                            <div class="btn-group btn-corner">
                                                <div class="btn btn-success" id="btnopenlistpeserta">
                                                    <i class="fa fa-database"></i> Open List
                                                </div>
                                                <div class="btn btn-danger" id="btnrefreshpeserta">
                                                    <i class="fa fa-refresh"></i> Refresh
                                                </div>
                                                <div class="btn btn-info" id="btneksportpeserta">
                                                    <i class="fa fa-print"></i> Export
                                                </div>
                                                <div class="btn btn-warning btnkembalikeujian" id="btnkembalidariinputpeserta">
                                                    <i class="fa fa-close"></i> Close
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h2 id="judultes">Daftar Peserta</h2>
                                            <div id="gridpesertaujian"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" id="listpesertahitung">
                                        <div class="form-group">
                                            <div class="btn-group btn-corner">
                                                <div class="btn btn-info" id="btneksportpesertahitungg">
                                                    <i class="fa fa-print"></i> Export
                                                </div>
                                                <div class="btn btn-warning" id="btnkembalidaripesertahitung">
                                                    <i class="fa fa-close"></i> Close
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div id="gridpesertahitung"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" id="diveditorujiancaselist">
                            <input type="hidden" class="form-control" id="ujian_id">
                            <div id="messagetest"></div>
                            <div id="gridlistcase"></div>
                        </div>
                    </div>
                    <div class="card card-info card-outline" id="divkoreksi">
                        <div class="card-header">
                            <h3 class="card-title">Koreksi Ujian</h3>
                            <div class="card-tools" id="tombolkoreksiawal">
                                <button type="button" class="btn btn-tool" id="btnexportkoreksilist"><i class="fa fa-print"></i></button>
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                            </div>
                            <div class="card-tools" id="tombolkoreksisoal">
                                <button type="button" class="btn btn-tool" id="btnkembalikekoreksilist"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body" id="divkoreksilistpeserta">
                            <div class="form-group">
                                <div id="gridkoreksilistpeserta"></div>
                            </div>
                        </div>
                        <div class="card-footer" id="divkoreksieditnilai">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <strong><i class="fa fa-users mr-1"></i> Kategori</strong>
                                        <p class="text-muted" id="koreksi_kategori"></p>
                                        <hr>
                                        <strong><i class="fa fa-bank mr-1"></i> CINTA</strong>
                                        <p class="text-muted" id="koreksi_ceel"></p>
                                        <hr>
                                        <strong><i class="fa fa-bank mr-1"></i> Rubrik</strong>
                                        <div id="koreksi_opsia"></div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Soal</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-sm-2" >
                                                                <a href="{{ url('/') }}//dist/img/takadagambar.png" id="korimagenumber1" data-toggle="lightbox" data-title="Picture 01" data-gallery="gallery">
                                                                    <img id="korpreview" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic1" class="img-fluid mb-2" alt="white sample" />
                                                                </a>
                                                            </div>
                                                            <div class="col-sm-2" >
                                                                <a href="{{ url('/') }}//dist/img/takadagambar.png" id="korimagenumber2" data-toggle="lightbox" data-title="Picture 02" data-gallery="gallery">
                                                                    <img id="korpreview2" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic2" class="img-fluid mb-2" alt="white sample" />
                                                                </a>
                                                            </div>
                                                            <div class="col-sm-2" >
                                                                <a href="{{ url('/') }}//dist/img/takadagambar.png" id="korimagenumber3" data-toggle="lightbox" data-title="Picture 03" data-gallery="gallery">
                                                                    <img id="korpreview3" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic3" class="img-fluid mb-2" alt="white sample" />
                                                                </a>
                                                            </div>
                                                            <div class="col-sm-2" >
                                                                <a href="{{ url('/') }}//dist/img/takadagambar.png" id="korimagenumber4" data-toggle="lightbox" data-title="Picture 04" data-gallery="gallery">
                                                                    <img id="korpreview4" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic4" class="img-fluid mb-2" alt="white sample" />
                                                                </a>
                                                            </div>
                                                            <div class="col-sm-2" >
                                                                <a href="{{ url('/') }}//dist/img/takadagambar.png" id="korimagenumber5" data-toggle="lightbox" data-title="Picture 05" data-gallery="gallery">
                                                                    <img id="korpreview5" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic5" class="img-fluid mb-2" alt="white sample" />
                                                                </a>
                                                            </div>
                                                            <div class="col-sm-2" >
                                                                <a href="{{ url('/') }}//dist/img/takadagambar.png" id="korimagenumber6" data-toggle="lightbox" data-title="Picture 06" data-gallery="gallery">
                                                                    <img id="korpreview6" src="{{ url('/') }}//dist/img/takadagambar.png?text=Pic6" class="img-fluid mb-2" alt="white sample" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div id="koreksi_deskripsi"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="koreksi_jawaban">Jawaban Peserta</label>
                                            <textarea id="koreksi_jawaban" rows="5" cols="20"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="koreksi_skore">Skore Akhir</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="koreksi_skore">
                                                <input type="hidden" class="form-control" id="koreksi_id">
                                                <div class="input-group-append">
                                                    <div class="btn btn-primary" id="btnsimpanskoring">
                                                        <i class="fa fa-pencil"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
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
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
    <input type="hidden" id="namafile1">
    <input type="hidden" id="namafile2">
    <input type="hidden" id="namafile3">
    <input type="hidden" id="namafile4">
    <input type="hidden" id="namafile5">
    <input type="hidden" id="namafile6">
    <input type="file" id="id_fotoprofile">
    <input type="file" id="id_fotoprofile2">
    <input type="file" id="id_fotoprofile3">
    <input type="file" id="id_fotoprofile4">
    <input type="file" id="id_fotoprofile5">
    <input type="file" id="id_fotoprofile6">
    <div class="card-footer" id="diveditorpewancara">
        <div class="form-group">
            <div class="row">
                <div class="col-lg-7">
                    <select id="pewancara_nama" size="1" class="form-control select2">
                        <option value="">Pilih SPV</option>
                        @if (isset($kelompokspv) AND !empty($kelompokspv))
                            @foreach($kelompokspv as $rows)
                            <option value="{{$rows->email}}">{!! $rows->nama !!} ( {!! $rows->email !!} )</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-5">
                    <div class="btn btn-primary btn-block" id="btninputpewancara">
                        <i class="fa fa-user-plus"></i> Set Sebagai Pewancara
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div id="gridpewancara"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaluploadsoal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Excel </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="soal_fileexcel">File Excel</label>
                    <div class="input-group input-group-sm">
                        <input type="file" class="form-control" id="soal_fileexcel">
                        <div class="input-group-append">
                            <div class="btn btn-primary">
                                <i class="fa fa-file-excel-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    Catatan : Mohon Download Format File Berikut <a href="/format/soal.xlsx">Format Soal</a><br />File Tersebut telah kami beri petunjuk pengisian, mohon mengikuti petunjuk pengisian dan pastikan format kolom sudah "text"
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-success pull-left" id="btnsimpanuploadsoal">Upload</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalubahspv">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change SPV</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="spv_peserta">Deskription</label>
                            <textarea id="spv_peserta" rows="5" cols="20"></textarea>
                        </div>
                        <div class="col-lg-6">
                            <label for="spv_nomor">Category</label>
                            <input type="text" id="spv_nomor" name="spv_nomor" class="form-control" disabled="disable" />
                        </div>
                        <div class="col-lg-6">
                            <label for="spv_asalpeserta">Code</label>
                            <input type="text" id="spv_asalpeserta" name="spv_asalpeserta" class="form-control" disabled="disable" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="spv_nama">Pilih SPV Sebagai Korektor Ujian</label>
                    <select id="spv_nama" size="1" class="form-control select2">
                        <option value="">Pilih SPV</option>
                        @if (isset($kelompokspv) AND !empty($kelompokspv))
                            @foreach($kelompokspv as $rows)
                            <option value="{{$rows->id}}">{!! $rows->nama !!} ( {!! $rows->unit_kerja !!} )</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="spv_idtes" name="spv_idtes" />
                <input type="hidden" id="spv_idsoal" name="spv_idsoal" />
                <button type="button" class="btn btn-success pull-left" id="btnubahspv">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalujianlisan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nilai Ujian Lisan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-7">
                            <label for="wawancara_nama">Nama</label>
                            <input type="text" id="wawancara_nama" name="wawancara_nama" class="form-control" disabled="disable" />
                        </div>
                        <div class="col-lg-5">
                            <label for="wawancara_nilai">Nilai (Angka Bulat)</label>
                            <input type="text" id="wawancara_nilai" name="wawancara_nilai" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <p> Catatan : Nilai 0 Tidak dihitung sebagai pembagi rata-rata dan mohon menggunakan angka bulat (tanpa desimal), namun apabila diperlukan desimal penulisannya menggunakan titik sebagai pemisah desimal contoh : xx.xx</p>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="wawancara_id" name="wawancara_id" />
                <button type="button" class="btn btn-success pull-left" id="btnisihasilwawancara">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalpreviewsoal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Profile Soal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-2" >
                                <img id="lihatsoalnumber1" src="{{url('/')}}//dist/img/takadagambar.png?text=Pic1" class="img-fluid mb-2" alt="white sample" />
                            
                        </div>
                        <div class="col-sm-2" >
                                <img id="lihatsoalnumber2" src="{{url('/')}}//dist/img/takadagambar.png?text=Pic2" class="img-fluid mb-2" alt="white sample" />
                            
                        </div>
                        <div class="col-sm-2" >
                                <img id="lihatsoalnumber3" src="{{url('/')}}//dist/img/takadagambar.png?text=Pic3" class="img-fluid mb-2" alt="white sample" />
                            
                        </div>
                        <div class="col-sm-2" >
                                <img id="lihatsoalnumber4" src="{{url('/')}}//dist/img/takadagambar.png?text=Pic4" class="img-fluid mb-2" alt="white sample" />
                            
                        </div>
                        <div class="col-sm-2" >
                                <img id="lihatsoalnumber5" src="{{url('/')}}//dist/img/takadagambar.png?text=Pic5" class="img-fluid mb-2" alt="white sample" />
                            
                        </div>
                        <div class="col-sm-2" >
                                <img id="lihatsoalnumber6" src="{{url('/')}}//dist/img/takadagambar.png?text=Pic6" class="img-fluid mb-2" alt="white sample" />
                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <textarea id="lihatdeskripsi" rows="5" cols="20"></textarea>
                </div>
                <div class="form-group" id="lihatchoice">
                    <table width="100%" border="0" class="table table-striped" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="5%" valign="top" align="center">A</td>
                            <td width="30%" valign="top"><p id="lihatopsia"></p></td>
                            <td width="3%">&nbsp;</td>
                            <td width="5%" valign="top" align="center">B</td>
                            <td width="30%" valign="top"><p id="lihatopsib"></p></td>
                        </tr>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                            <td valign="top" align="center">C</td>
                            <td valign="top"><p id="lihatopsic"></p></td>
                            <td>&nbsp;</td>
                            <td valign="top" align="center">D</td>
                            <td valign="top"><p id="lihatopsid"></p></td>
                        </tr>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                            <td valign="top" align="center">E</td>
                            <td valign="top"><p id="lihatopsie"></p></td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                    </table>
                </div>
                <div class="form-group" id="lihatrubrik">
                    <textarea id="lihatteksrubrik" rows="5" cols="20"></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="wawancara_id" name="wawancara_id" />
                <button type="button" class="btn btn-success pull-left" id="btnisihasilwawancara">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal modal-info fade" id="modaljeniscetak">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Salah Satu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 btn-grp">
                        <button type="button" id="btncetakformatmoodle" class="btn btn-success btn-block">
                            <i class="fa fa-moon-o "></i> Moodle Format
                        </button>
                        <button type="button" id="btncetakformatstandartkey" class="btn btn-info btn-block">
                            <i class="fa fa-newspaper-o "></i> Standart With Keys
                        </button>
                        <button type="button" id="btncetakformatstandartnokey" class="btn btn-warning btn-block">
                            <i class="fa fa-navicon "></i> Standart No Keys
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="cetak_marking">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>				
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<style>
	table.dataTable tbody td {
        word-break: break-word;
        vertical-align: top;
    }
</style>
<input type="hidden" value="Upload" id="master_set01">

<input type="hidden" value="{{Session('previlage')}}" id="master_set02">
<input type="hidden" value="{{ date('Y') }}" id="tahunujian">
<input type="hidden" value="" id="editorview">

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
      	$('.select2').select2({width: '100%'});
        let summernoteOptions = {
            height: 300
        }
        bsCustomFileInput.init();
        $('#edit_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#edit_akhir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#ujian_tglmulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#ujian_tglselesai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $("#ujian_jammulai").timepicker({format: 'HH:mm:ss'});
        $("#ujian_jamselesai").timepicker({format: 'HH:mm:ss'});
        $('#table_list tbody').on('click', '.btnubah', function () {
            id = $(this).data("id");
            $("#edit_idne").val(id);
            $.post('{{ route("getFirstSoal") }}', { val01: id, _token: '{{ csrf_token() }}' },function(data){
                var idsoal    = data.idsoal;
                var kode      = data.kode;
                var kunci     = data.kunci;
                var jawaban   = data.tipesoal;
                var deskripsi = data.deskripsi;
                var opsia     = data.opsia;
                var opsib     = data.opsib;
                var opsic     = data.opsic;
                var opsid     = data.opsid;
                var opsie     = data.opsie;
                var ceel      = data.ceel;
                var kace      = data.kode;
                var lampiran  = data.lampiran;
                var lampiran2 = data.lampiran2;
                var lampiran3 = data.lampiran3;
                var lampiran4 = data.lampiran4;
                var lampiran5 = data.lampiran5;
                var lampiran6 = data.lampiran6;
                if (jawaban == 'choice'){
                    $('#divopsia').removeClass('col-lg-12 col-md-12').addClass('col-lg-4 col-md-4');
                    $("#labelopsia").html('Option A');
                    $('#id_optiona').summernote('destroy');
                    $('#id_optiona').summernote()
                    $('.colkeys').show();
                    $('.esay').show();
                    $("#id_keys").val(kunci);
                    $('.choice').show();
                } else if (jawaban == 'esay'){
                    $('#divopsia').removeClass('col-lg-4 col-md-4').addClass('col-lg-12 col-md-12');
					$("#labelopsia").html('Rubrik dan Skore Maksimal');
                    $('#id_optiona').summernote('destroy');
                    $('#id_optiona').summernote(summernoteOptions);
                    $('.colkeys').hide();
                    $('.esay').hide();
                    $('.choice').show();
                    $("#id_keys").val('A');
                } else {
                    $('.colkeys').hide();
                    $("#id_keys").val('LABEL');
                    $('.esay').show();
                    $('.choice').show();
                }
                $('#ketikkategori').hide();
                $('#pilihankategori').show();
                
                $("#id_ceel").val(ceel);
                $("#id_kace").val(kace);
                $("#id_tipe").val(jawaban);
                $("#edit_idne").val(idsoal);
                $('#id_deskripsi').summernote('code', deskripsi);
                $('#id_optiona').summernote('code', opsia);
                $('#id_optionb').summernote('code', opsib);
                $('#id_optionc').summernote('code', opsic);
                $('#id_optiond').summernote('code', opsid);
                $('#id_optione').summernote('code', opsie);
                
                $("#id_fotoprofile").val('');
                $("#namafile1").val(lampiran);
                if (lampiran == ''){
                    $('#preview').attr('src', '/dist/img/takadagambar.png');
                } else {
                    $('#preview').attr('src', lampiran);
                }
                $("#id_fotoprofile2").val('');
                $("#namafile2").val(lampiran2);
                if (lampiran2 == ''){
                    $('#preview2').attr('src', '/dist/img/takadagambar.png');
                } else {
                    $('#preview2').attr('src', lampiran2);
                }
                $("#id_fotoprofile3").val('');
                $("#namafile3").val(lampiran3);
                if (lampiran3 == ''){
                    $('#preview3').attr('src', '/dist/img/takadagambar.png');
                } else {
                    $('#preview3').attr('src', lampiran3);
                }
                $("#id_fotoprofile4").val('');
                $("#namafile4").val(lampiran4);
                if (lampiran4 == ''){
                    $('#preview4').attr('src', '/dist/img/takadagambar.png');
                } else {
                    $('#preview4').attr('src', lampiran4);
                }
                $("#id_fotoprofile5").val('');
                $("#namafile5").val(lampiran5);
                if (lampiran5 == ''){
                    $('#preview5').attr('src', '/dist/img/takadagambar.png');
                } else {
                    $('#preview5').attr('src', lampiran5);
                }
                $("#id_fotoprofile6").val('');
                $("#namafile6").val(lampiran6);
                if (lampiran6 == ''){
                    $('#preview6').attr('src', '/dist/img/takadagambar.png');
                } else {
                    $('#preview6').attr('src', lampiran6);
                }
                $('.divawal').show();
                $('#diveditsoal').show();
                $('#divkoreksi').hide();
                $('#divlistujian').hide();
                $('#divriwayat').hide();
                $('#divbanksoal').hide();
                $('#diveditpeserta').hide();
                $('#divupload').hide();
                $("#divverifikasisoal").hide();
                $('#divpreviewdraftsoal').hide();
                $("#editorview").val('bank');
            });
        });
        $('#table_list tbody').on('click', '.btndeletesoal', function () {
            id = $(this).data("id");
            swal({
                title: 'Apakah anda yakin ?',
                text: "Soal Ini Akan Kami Non Aktifkan, dan Bisa di Kembalikan ke Aktif apabila di Edit Kembali",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-confirm mt-2',
                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                confirmButtonText: 'Yes, Remove It'
            }).then(function () {
                $.post('{{ route("exInputBankSoal") }}', { set01: 'hapus', set02: id, _token: '{{ csrf_token() }}' },	
                function(data){
                    swal({
                        title	: 'Info',
                        text	: data,
                        type	: 'warning',
                    })
                    $('#table_list').dataTable().fnDraw();
                    return false;
                });
            });
        });
        $('#table_list tbody').on('click', '.btnverified', function () {
            id = $(this).data("id");
            swal({
                title   : 'Apakah anda yakin ?',
                text    : "Sudah diperiksa dan sudah sesuai antara deskripsi soal, pilihan jawaban dan kunci jawaban",
                type    : 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-confirm mt-2',
                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                confirmButtonText: 'Yes, Set Verified'
            }).then(function () {
                $.post('{{ route("exInputBankSoal") }}', { set01: 'setverified', set02: id, _token: '{{ csrf_token() }}' },	
                function(data){
                    $("#set_jenis").val('1');
                    swal({
                        title	: 'Info',
                        text	: data,
                        type	: 'warning',
                    })
                    $('#table_list').dataTable().fnDraw();
                    return false;
                });
            });
        });
    });
    $('#id_fotoprofile').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
            swal({
                title	: 'Stop',
                text	: 'Maksimum file adalah 3Mb',
                type	: 'warning',
            })
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLAddmhs(this);
            } else {
                $('#preview').attr('src', '/dist/img/takadagambar.png');
                swal({
                    title	: 'Stop',
                    text	: 'Please select image file (jpg, jpeg, png).',
                    type	: 'warning',
                })
            }
        }
    });
    $('#id_fotoprofile2').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
            swal({
                title	: 'Stop',
                text	: 'Maksimum file adalah 3Mb',
                type	: 'warning',
            })
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLPic2(this);
            } else {
                $('#preview2').attr('src', '/dist/img/takadagambar.png');
                swal({
                    title	: 'Stop',
                    text	: 'Please select image file (jpg, jpeg, png).',
                    type	: 'warning',
                })
            }
        }
    });
    $('#id_fotoprofile3').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
            swal({
                title	: 'Stop',
                text	: 'Maksimum file adalah 3Mb',
                type	: 'warning',
            })
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLPic3(this);
            } else {
                $('#preview3').attr('src', '/dist/img/takadagambar.png');
                swal({
                    title	: 'Stop',
                    text	: 'Please select image file (jpg, jpeg, png).',
                    type	: 'warning',
                })
            }
        }
    });
    $('#id_fotoprofile4').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
            swal({
                title	: 'Stop',
                text	: 'Maksimum file adalah 3Mb',
                type	: 'warning',
            })
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLPic4(this);
            } else {
                $('#preview4').attr('src', '/dist/img/takadagambar.png');
                swal({
                    title	: 'Stop',
                    text	: 'Please select image file (jpg, jpeg, png).',
                    type	: 'warning',
                })
            }
        }
    });
    $('#id_fotoprofile5').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
            swal({
                title	: 'Stop',
                text	: 'Maksimum file adalah 3Mb',
                type	: 'warning',
            })
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLPic5(this);
            } else {
                $('#preview5').attr('src', '/dist/img/takadagambar.png');
                swal({
                    title	: 'Stop',
                    text	: 'Please select image file (jpg, jpeg, png).',
                    type	: 'warning',
                })
            }
        }
    });
    $('#id_fotoprofile6').change(function () {
        if(this.files[0].size > 3000000){
            this.value = "";
            swal({
                title	: 'Stop',
                text	: 'Maksimum file adalah 3Mb',
                type	: 'warning',
            })
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLPic6(this);
            } else {
                $('#preview6').attr('src', '/dist/img/takadagambar.png');
                swal({
                    title	: 'Stop',
                    text	: 'Please select image file (jpg, jpeg, png).',
                    type	: 'warning',
                })
            }
        }
    });
    function readURLAddmhs(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $("#namafile1").val('ada');
            };
        }
    }
    function readURLPic2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#preview2').attr('src', e.target.result);
                $("#namafile2").val('ada');
            };
        }
    }
    function readURLPic3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#preview3').attr('src', e.target.result);
                $("#namafile3").val('ada');
            };
        }
    }
    function readURLPic4(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#preview4').attr('src', e.target.result);
                $("#namafile4").val('ada');
            };
        }
    }
    function readURLPic5(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#preview5').attr('src', e.target.result);
                $("#namafile5").val('ada');
            };
        }
    }
    function readURLPic6(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#preview6').attr('src', e.target.result);
                $("#namafile6").val('ada');
            };
        }
    }
    $(document).ready(function() {
        let summernoteOptions = {
            height: 300
        }
        $('#divsettingstation').hide();
        $('#divwawancara').hide();
        $('#diveditorpewancara').hide();
        $('#divstatistik').hide();
        $('#divkoreksi').hide();
        $('#divlistujian').hide();
        $("#divverifikasisoal").hide();
        $('#enteni').hide();
        $('#spv_peserta').summernote()
        $('#koreksi_jawaban').summernote()
        $('#verifikasi_komentar').summernote()
        $('#id_deskripsi').summernote()
        $('#id_optiona').summernote()
        $('#id_optionb').summernote()
        $('#id_optionc').summernote()
        $('#id_optiond').summernote()
        $('#id_optione').summernote()
        $('#lihatdeskripsi').summernote()
        $('#lihatteksrubrik').summernote()
        $('#diveditsoal').hide();
        $('#divbanksoal').show();
        $('#divupload').hide();
        //START_BLOK_SOAL
            $("#set_jenis").on('change', function () {
                $('#table_list').dataTable().fnDraw();
            });
            $("#main_valcari").on('change', function () {
                $('#table_list').dataTable().fnDraw();
            });
            $("#id_tipe").on('change', function () {
                var pilihan 	      = $(this).find('option:selected').attr('value');
                if (pilihan == 'choice'){
                    $('#divopsia').removeClass('col-lg-12 col-md-12').addClass('col-lg-4 col-md-4');
                    $("#labelopsia").html('Option A');
                    $('#id_optiona').summernote('destroy');
                    $('#id_optiona').summernote()
                    $('.colkeys').show();
                    $('.esay').show();
                    $("#id_keys").val('');
                    $('.choice').show();
                } else if (pilihan == 'esay'){
                    $('#divopsia').removeClass('col-lg-4 col-md-4').addClass('col-lg-12 col-md-12');
					$("#labelopsia").html('Rubrik dan Skore Maksimal');
                    $('#id_optiona').summernote('destroy');
                    $('#id_optiona').summernote(summernoteOptions);
                    $('.colkeys').hide();
                    $('.esay').hide();
                    $('.choice').show();
                    $("#id_keys").val('A');
                } else {
                    $('.colkeys').hide();
                    $("#id_keys").val('LABEL');
                    $('.esay').show();
                    $('.choice').show();
                }
            });
            $('#btnbanksoal').on('click', function (){
                $('.card-outline').hide();
                $('#divbanksoal').show();
            });
            $('#btntambahsoal').click(function () {
                $("#edit_idne").val('new');
                $('#preview').attr('src', '/dist/img/takadagambar.png');
                $('#preview2').attr('src', '/dist/img/takadagambar.png');
                $('#preview3').attr('src', '/dist/img/takadagambar.png');
                $('#preview4').attr('src', '/dist/img/takadagambar.png');
                $('#preview5').attr('src', '/dist/img/takadagambar.png');
                $('#preview6').attr('src', '/dist/img/takadagambar.png');
                
                $("#id_tipe").val('choice');
                $('#ketikkategori').hide();
                $('#pilihankategori').show();
                $('.esay').show();
                $('.choice').show();
                $('#id_deskripsi').summernote('code', '');
                $('#id_optiona').summernote('code', '');
                $('#id_optionb').summernote('code', '');
                $('#id_optionc').summernote('code', '');
                $('#id_optiond').summernote('code', '');
                $('#id_optione').summernote('code', '');
                $("#id_keys").val('');
                $("#id_fotoprofile").val('');
                $("#id_fotoprofile2").val('');
                $("#id_fotoprofile3").val('');
                $("#id_fotoprofile4").val('');
                $("#id_fotoprofile5").val('');
                $("#id_fotoprofile6").val('');
                $("#namafile1").val('');
                $("#namafile2").val('');
                $("#namafile3").val('');
                $("#namafile4").val('');
                $("#namafile5").val('');
                $("#namafile6").val('');
                $('#diveditsoal').show();
                $('#divriwayat').hide();
                $('#divbanksoal').hide();
                $('#diveditpeserta').hide();
                $('#divupload').hide();
                $('#divkoreksi').hide();
                $('#divlampiran').hide();
                $('#divpreviewdraftsoal').hide();
                $("#editorview").val('bank');
            });
            $("#btnupdatedataps").click(function(){
                var val01=document.getElementById('edit_idne').value;
                var val02=document.getElementById('id_ceel').value;
                var val03="{{Session('sekolah_kode_sekolah')}}";
                var val04=$('#id_deskripsi').summernote('code');
                var val05=$('#id_optiona').summernote('code');
                var val06=$('#id_optionb').summernote('code');
                var val07=$('#id_optionc').summernote('code');
                var val08=$('#id_optiond').summernote('code');
                var val09=$('#id_optione').summernote('code');
                var val10=document.getElementById('id_keys').value;
                var val11=document.getElementById('id_fotoprofile');
                var val12=document.getElementById('id_tipe').value;
                var val13=document.getElementById('id_kace').value;
                var val14=document.getElementById('id_fotoprofile2');
                var val15=document.getElementById('id_fotoprofile3');
                var val16=document.getElementById('id_fotoprofile4');
                var val17=document.getElementById('id_fotoprofile5');
                var val18=document.getElementById('id_fotoprofile6');
                var val19=document.getElementById('namafile1').value;
                var val20=document.getElementById('namafile2').value;
                var val21=document.getElementById('namafile3').value;
                var val22=document.getElementById('namafile4').value;
                var val23=document.getElementById('namafile5').value;
                var val24=document.getElementById('namafile6').value;
                var eview=document.getElementById('editorview').value;
                if (val12 == 'Labelled Case'){ var val10 = 'Labelled Case'; }
                if ($('#id_fotoprofile').val() == '' && val12 == 'Labelled Case'){
                    swal({
                        title	: 'Stop',
                        text	: 'Labelled Case Must Have an Images',
                        type	: 'warning',
                    })
                } else if (val01 == '' || val02 == '' || val03 == '' ||  val04 == '' || val05 == '' || val10 == '' || val12 == ''){
                    swal({
                        title	: 'Stop',
                        text	: 'Form Wajib di Lengkapi, Apabila ada data yg kosong / tidak diketahui, maka diberi tanda (-) / strip',
                        type	: 'warning',
                    })
                } else {
                    var form_data = new FormData();
                        form_data.append('set01', val01);
                        form_data.append('set02', val02);
                        form_data.append('set03', val03);
                        form_data.append('set04', val04);
                        form_data.append('set05', val05);
                        form_data.append('set06', val06);
                        form_data.append('set07', val07);
                        form_data.append('set08', val08);
                        form_data.append('set09', val09);
                        form_data.append('set10', val10);
                        form_data.append('set11', val12);
                        form_data.append('set13', val13);
                        form_data.append('file', val11.files[0]);
                        form_data.append('file2', val14.files[0]);
                        form_data.append('file3', val15.files[0]);
                        form_data.append('file4', val16.files[0]);
                        form_data.append('file5', val17.files[0]);
                        form_data.append('file6', val18.files[0]);
                        form_data.append('set19', val19);
                        form_data.append('set20', val20);
                        form_data.append('set21', val21);
                        form_data.append('set22', val22);
                        form_data.append('set23', val23);
                        form_data.append('set24', val24);
                        form_data.append('_token', '{{csrf_token()}}');
                    $('#diveditsoal').hide();
                    $("#set_jenis").val('2');
                    $.ajax({
                        url         : '{{ route("exInputBankSoal") }}',
                        data        : form_data,
                        type        : 'POST',
                        contentType : false,
                        processData : false,
                        success     : function (data) {
                            if (eview == 'caselist'){
                                $('#divlistujian').show();
                            } else {
                                $('#divbanksoal').show();
                            }
                            $.toast({
                                heading: 'Info',
                                text: data,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'success',
                                hideAfter: 5000,
                                stack: 1
                            });
                            $('#table_list').dataTable().fnDraw();
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                            return false;
                        },
                        error: function (xhr, status, error) {
                            $('#diveditsoal').show();
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
            $("#btnsimpanuploadsoal").click(function(){
                var val01=document.getElementById('soal_fileexcel');
                if ($('#soal_fileexcel').val() == ''){
                    swal({
                        title	: 'Stop',
                        text	: 'File Kosong',
                        type	: 'warning',
                    })
                } else {
                    var form_data = new FormData();
                        form_data.append('set01', 'upload');
                        form_data.append('set02', '');
                        form_data.append('set03', '');
                        form_data.append('file', val01.files[0]);
                        form_data.append('_token', '{{csrf_token()}}');
                    $("#modaluploadsoal").modal('hide');
                    $('#enteni').show();
                    $.ajax({
                        url         : '{{ route("exInputBankSoal") }}',
                        data        : form_data,
                        type        : 'POST',
                        contentType : false,
                        processData : false,
                        success     : function (data) {
                            $("#set_jenis").val('0');
                            $.toast({
                                heading: 'Info',
                                text: data,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'success',
                                hideAfter: 5000,
                                stack: 1
                            });
                            $('#enteni').hide();
                            $('#table_list').dataTable().fnDraw();
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                            return false;
                        },
                        error: function (xhr, status, error) {
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
            $('#btnuploadsoal').on('click', function (){
                $("#modaluploadsoal").modal('show');
            });
            $('#btnremoveimage1').on('click', function (){
                $('#preview').attr('src', '/dist/img/takadagambar.png');
                $("#id_fotoprofile").val('');
                $("#namafile1").val('');
            });
            $('#btnremoveimage2').on('click', function (){
                $('#preview2').attr('src', '/dist/img/takadagambar.png');
                $("#id_fotoprofile2").val('');
                $("#namafile2").val('');
            });
            $('#btnremoveimage3').on('click', function (){
                $('#preview3').attr('src', '/dist/img/takadagambar.png');
                $("#id_fotoprofile3").val('');
                $("#namafile3").val('');
            });
            $('#btnremoveimage4').on('click', function (){
                $('#preview4').attr('src', '/dist/img/takadagambar.png');
                $("#id_fotoprofile4").val('');
                $("#namafile4").val('');
            });
            $('#btnremoveimage5').on('click', function (){
                $('#preview5').attr('src', '/dist/img/takadagambar.png');
                $("#id_fotoprofile5").val('');
                $("#namafile5").val('');
            });
            $('#btnremoveimage6').on('click', function (){
                $('#preview6').attr('src', '/dist/img/takadagambar.png');
                $("#id_fotoprofile6").val('');
                $("#namafile6").val('');
            });
            $('#btnopenimage1').on('click', function (){
                $('#id_fotoprofile').click();
            });
            $('#btnopenimage2').on('click', function (){
                $('#id_fotoprofile2').click();
            });
            $('#btnopenimage3').on('click', function (){
                $('#id_fotoprofile3').click();
            });
            $('#btnopenimage4').on('click', function (){
                $('#id_fotoprofile4').click();
            });
            $('#btnopenimage5').on('click', function (){
                $('#id_fotoprofile5').click();
            });
            $('#btnopenimage6').on('click', function (){
                $('#id_fotoprofile6').click();
            });
            $('#btnclosedraftpreviewimage').click(function (e) {
                $('#divpreviewdraftsoal').hide();
            });
            $('#imagenumber1').click(function (e) {
                var images = $('#preview').attr('src');
                $('#divpreviewdraftsoal').show();
                $('#previewdraftsoal').attr('src', images);
            });
            $('#imagenumber2').click(function (e) {
                var images = $('#preview2').attr('src');
                $('#divpreviewdraftsoal').show();
                $('#previewdraftsoal').attr('src', images);
            });
            $('#imagenumber3').click(function (e) {
                var images = $('#preview3').attr('src');
                $('#divpreviewdraftsoal').show();
                $('#previewdraftsoal').attr('src', images);
            });
            $('#imagenumber4').click(function (e) {
                var images = $('#preview4').attr('src');
                $('#divpreviewdraftsoal').show();
                $('#previewdraftsoal').attr('src', images);
            });
            $('#imagenumber5').click(function (e) {
                var images = $('#preview5').attr('src');
                $('#divpreviewdraftsoal').show();
                $('#previewdraftsoal').attr('src', images);
            });
            $('#imagenumber6').click(function (e) {
                var images = $('#preview6').attr('src');
                $('#divpreviewdraftsoal').show();
                $('#previewdraftsoal').attr('src', images);
            });
            $('#verimagenumber1').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#verimagenumber2').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#verimagenumber3').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#verimagenumber4').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#verimagenumber5').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#verimagenumber6').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $("#btndelete").click(function(){
                var val01=document.getElementById('edit_idne').value;
                var val02="{{Session('sekolah_kode_sekolah')}}";
                var val03=document.getElementById('id_ceel').value;
                var val04=$('#id_deskripsi').summernote('code');
                var val05=$('#id_optiona').summernote('code');
                var val06=$('#id_optionb').summernote('code');
                var val07=$('#id_optionc').summernote('code');
                var val08=$('#id_optiond').summernote('code');
                var val09=$('#id_optione').summernote('code');
                var val10=document.getElementById('id_keys').value;
                var val11=document.getElementById('id_fotoprofile');
                swal({
                    title				: 'Apakah anda yakin ?',
                    text				: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
                    type				: 'warning',
                    showCancelButton	: true,
                    confirmButtonClass	: 'btn btn-confirm mt-2',
                    cancelButtonClass	: 'btn btn-cancel ml-2 mt-2',
                    confirmButtonText	: 'Yes'
                }).then(function () {
                    $('#diveditor').hide();
                    var form_data = new FormData();
                        form_data.append('set01', 'hapus');
                        form_data.append('set02', val01);
                        form_data.append('set03', val03);
                        form_data.append('set04', null);
                        form_data.append('set05', null);
                        form_data.append('set06', val06);
                        form_data.append('set07', val07);
                        form_data.append('set08', val08);
                        form_data.append('set09', val09);
                        form_data.append('set10', val10);
                        form_data.append('file', null);
                        form_data.append('_token', '{{csrf_token()}}');
                    $.ajax({
                        url         : '{{ route("exInputBankSoal") }}',
                        data        : form_data,
                        type        : 'POST',
                        contentType : false,
                        processData : false,
                        success     : function (data) {
                            $('#divbanksoal').show();
                            $.toast({
                                heading: 'Info',
                                text: data,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'success',
                                hideAfter: 5000,
                                stack: 1
                            });
                            $('#table_list').dataTable().fnDraw();
                            $("html, body").animate({ scrollTop: 0 }, "slow");
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
            $('#btnmultiverifikasi').click(function () {
                var rows = $("#gridsoalunverif").jqxGrid('selectedrowindexes');
                var selectedRecords = new Array();
                for (var m = 0; m < rows.length; m++) {
                    var row = $("#gridsoalunverif").jqxGrid('getrowdata', rows[m]);
                    if (row){
                        selectedRecords.push(row.idsoal);
                    }
                }
                if (m == 0){
                    swal({
                        title	: 'Stop',
                        text	: 'Soal Belum di Pilih',
                        type	: 'warning',
                    })
                } else {
                    $.post('{{ route("exInputBankSoal") }}', {  set01: 'verifikasimulti', set02: selectedRecords, set03: '', _token: '{{ csrf_token() }}' },
                        function(data){
                        $("#gridsoalunverif").jqxGrid('updatebounddata', 'filter');
                        swal({
                            title	: 'Info',
                            text	: data,
                            type	: 'warning',
                        })
                        return false;
                    });
                }
            });
            $('#btn-searchunverif').click(function () {
                var val01=document.getElementById('unverif_valcari').value;
                var rows = $("#gridsoalunverif").jqxGrid('selectedrowindexes');
                var selectedRecords = new Array();
                for (var m = 0; m < rows.length; m++) {
                    var row = $("#gridsoalunverif").jqxGrid('getrowdata', rows[m]);
                    if (row){
                        selectedRecords.push(row.idsoal);
                    }
                }
                if (m == 0){
                    swal({
                        title	: 'Stop',
                        text	: 'Soal Belum di Pilih',
                        type	: 'warning',
                    })
                } else {
                    $.post('{{ route("exInputBankSoal") }}', {  set01: 'setverifikator', set02: selectedRecords, set03: val01, _token: '{{ csrf_token() }}' },
                        function(data){
                        $("#gridsoalunverif").jqxGrid('updatebounddata', 'filter');
                        swal({
                            title	: 'Info',
                            text	: data,
                            type	: 'warning',
                        })
                        return false;
                    });
                }
            });
            
        //END_BLOK_SOAL
        //START_BLOK_UJIAN
            $('#btntambahujian').on('click', function (){
                $("#ujian_id").val('new');
                $('#daftarpeserta').hide();
                $('#daftarujian').hide();
                $('#groupbtnlanjutan').hide();
                $('#divanalisisujian').hide();
                $('#diveditorujiancaselist').show();
                $('#diveditorujian').show();
                $("#ujian_deskripsi").val('');
                $("#ujian_matapelajaran").val('');
                $("#ujian_komponen").val('');
                $("#ujian_kode").val('');
                $("#ujian_idsetting").val('0');
                $("#ujian_idkd").val('0');
                $("#ujian_matpel").val('').select2().trigger('change');
            });
            $("#ujian_matpel").on('change', function () {
                var idsetting   = $(this).find('option:selected').attr('value');
                var nilaike     = $(this).find('option:selected').attr('set01');
                var idkd        = $(this).find('option:selected').attr('set02');
                var deskripsi   = $(this).find('option:selected').attr('set03');
                var muatan      = $(this).find('option:selected').attr('set04');
                var kodekd      = $(this).find('option:selected').attr('set05');
                if (idsetting == ''){
                    $("#ujian_deskripsi").val('');
                    $("#ujian_matapelajaran").val('');
                    $("#ujian_komponen").val('');
                    $("#ujian_kode").val('');
                    $("#ujian_idsetting").val('0');
                    $("#ujian_idkd").val('0');
                } else {
                    $("#ujian_deskripsi").val(deskripsi);
                    $("#ujian_matapelajaran").val(muatan);
                    $("#ujian_komponen").val(nilaike);
                    $("#ujian_kode").val(kodekd);
                    $("#ujian_idsetting").val(idsetting);
                    $("#ujian_idkd").val(idkd);
                }
            });
            $('#btnsimpanujian').click(function () {
                $('#diveditorujiancaselist').hide();
                $('#diveditorujian').hide();
                $('#enteni').show();
                var form_data = new FormData();
                    form_data.append('val01', document.getElementById('ujian_nama').value);
                    form_data.append('val02', document.getElementById('ujian_tglmulai').value);
                    form_data.append('val03', document.getElementById('ujian_jammulai').value);
                    form_data.append('val04', document.getElementById('ujian_tglselesai').value);
                    form_data.append('val05', document.getElementById('ujian_jamselesai').value);
                    form_data.append('val06', document.getElementById('ujian_status').value);
                    form_data.append('val07', document.getElementById('ujian_id').value);
                    form_data.append('val08', document.getElementById('ujian_timer').value);
                    form_data.append('val09', "{{Session('sekolah_kode_sekolah')}}");
                    form_data.append('val10', document.getElementById('ujian_idkd').value);
                    form_data.append('val11', document.getElementById('ujian_deskripsi').value);
                    form_data.append('val12', document.getElementById('ujian_matapelajaran').value);
                    form_data.append('val13', document.getElementById('ujian_komponen').value);
                    form_data.append('val14', document.getElementById('ujian_kode').value);
                    form_data.append('val15', document.getElementById('ujian_idsetting').value);
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url         : '{{ route("exAddTest") }}',
                    data        : form_data,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success     : function (data) {
                        var status  = data.status;
                        var message = data.message;
                        var warna 	= data.warna;
                        var icon 	= data.icon;
                        $("#ujian_id").val(data.marking);
                        $.toast({
                            heading     : status,
                            text        : message,
                            position    : 'top-right',
                            loaderBg    : warna,
                            icon        : icon,
                            hideAfter   : 5000,
                            stack       : 1
                        });
                        $('#enteni').hide();
                        $('#groupbtnlanjutan').show();
                        $('#diveditorujiancaselist').show();
                        $('#diveditorujian').show();
                        return false;
                    },
                    error: function (xhr, status, error) {
                        swal({
                            title	: 'Stop',
                            text	: xhr.responseText,
                            type	: 'error',
                        })
                    }
                });
            });
            $('#btntestlist').on('click', function (){
                $('.card-outline').hide();
                $('#diveditorujian').hide();
                $('#daftarujian').show();
                $('#daftarpeserta').hide();
                $('#diveditorujiancaselist').hide();
                $('#diveditorpewancara').hide();
                $('#divlistujian').show();
              	$('#divanalisisujian').hide();
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'id'},
                        { name: 'ceel', type: 'text'},
                        { name: 'kode', type: 'text'},
                        { name: 'mulai', type: 'text'},
                        { name: 'selesai', type: 'text'},
                        { name: 'tglmulai', type: 'text'},
                        { name: 'jammulai', type: 'text'},
                        { name: 'tglselesai', type: 'text'},
                        { name: 'jamselesai', type: 'text'},
                        { name: 'namaujian', type: 'text'},
                        { name: 'supervisor', type: 'text'},
                        { name: 'tlssupervisor', type: 'text'},
                        { name: 'tipe', type: 'text'},
                        { name: 'status', type: 'text'},
                        { name: 'marking', type: 'text'},
                        { name: 'timer', type: 'text'},
                        { name: 'jumlah', type: 'text'},
                        { name: 'peserta', type: 'text'},
                        { name: 'pengumuman', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	set01: 'Master', set02:'Aktif', _token: '{{ csrf_token() }}' },
                    url:  '{{ route("jsonaktiftest") }}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $("#gridtest").jqxGrid({
                    width: '100%',
                    filterable: true,
                    columnsresize: true,
                    theme: "energyblue",
                    sortable: true,
                    autoheight: true,
                    pageable: true,
                    source: datadetail,
                    columns: [
                        { text: 'Setting', editable: false, sortable: false, filterable: false, align: 'center', columntype: 'button', width: '6%', cellsrenderer: function () {
                            return "Edit";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset      = $("#gridtest").offset();
                                var dataRecord 	= $("#gridtest").jqxGrid('getrowdata', editrow);
                                var status      = dataRecord.status;
                                if (status == ''){
                                    var status  = 0;
                                }
                                $("#ujian_id").val(dataRecord.marking);
                                $("#ujian_nama").val(dataRecord.namaujian);
                                $("#ujian_tglmulai").val(dataRecord.tglmulai);
                                $("#ujian_jammulai").val(dataRecord.jammulai);
                                $("#ujian_tglselesai").val(dataRecord.tglselesai);
                                $("#ujian_jamselesai").val(dataRecord.jamselesai);
                                $("#ujian_status").val(status);
                                $("#ujian_timer").val(dataRecord.timer);
                                $("#ujian_matpel").val(dataRecord.tipe).select2().trigger('change');
                                $('#daftarujian').hide();
                                $('#diveditorpewancara').hide();
                                $('#diveditorujiancaselist').show();
                                $('#diveditorujian').show();
                                $('#groupbtnlanjutan').show();
                            }
                        },
                        { text: 'Peserta', editable: false, sortable: false, filterable: false, align: 'center', columntype: 'button', width: '6%', cellsrenderer: function () {
                            return "List";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridtest").offset();
                                var dataRecord 	= $("#gridtest").jqxGrid('getrowdata', editrow);
                                $('#listpesertakiri').hide();
                                $('#listpesertahitung').hide();
                                $('#daftarujian').hide();
                                $('#daftarpeserta').show();
                                $("#ujian_id").val(dataRecord.marking);
                                var judultes    = dataRecord.ceel+' '+dataRecord.kode+' '+dataRecord.namaujian;
                                $("#judultes").html(judultes);
                                var sumberpeserta = {
                                    datatype: "json",
                                    datafields: [
                                        { name: 'id'},
                                        { name: 'noinduk', type: 'text'},
                                        { name: 'nama', type: 'text'},
                                        { name: 'kelas', type: 'text'},
                                        { name: 'tapel', type: 'text'},
                                        { name: 'semester', type: 'text'},
                                        { name: 'tema', type: 'text'},
                                        { name: 'subtema', type: 'text'},
                                        { name: 'kodekd', type: 'text'},
                                        { name: 'deskripsi', type: 'text'},
                                        { name: 'matpel', type: 'text'},
                                        { name: 'nilai', type: 'text'},
                                        { name: 'kkm', type: 'text'},
                                        { name: 'status', type: 'text'},
                                        { name: 'catatan', type: 'text'},
                                        { name: 'id_sekolah', type: 'text'},
                                        { name: 'penginput', type: 'text'},
                                        { name: 'tanggal', type: 'text'},
                                        { name: 'mulai', type: 'text'},
                                        { name: 'akhir', type: 'text'},
                                        { name: 'timer', type: 'text'},
                                        { name: 'jennilai', type: 'text'},
                                        { name: 'marking', type: 'text'},
                                        { name: 'keterangan', type: 'text'},
                                        { name: 'surat', type: 'text'},
                                        { name: 'created_at', type: 'text'},
                                        { name: 'updated_at', type: 'text'},
                                    ],
                                    type: 'POST',
                                    data: {	val01: dataRecord.marking, _token: '{{ csrf_token() }}' },
                                    url: '{{ route("rad-json-pesertates") }}',
                                };
                                var datadetail = new $.jqx.dataAdapter(sumberpeserta);
                                $("#gridpesertaujian").jqxGrid({
                                    width           : '100%',
                                    rowsheight      : 35,
                                    filterable      : true,
                                    columnsresize   : true,
                                    showfilterrow   : true,
                                    theme           : "energyblue",
                                    sortable        : true,
                                    autoheight      : true,
                                    pageable        : true,
                                    source          : datadetail,
                                    altrows         : true,
                                    columns         : [
                                        { text: 'Start', editable: false, sortable: false, filterable: false, cellsalign: 'center', align: 'center', columntype: 'button', width: '7%', cellsrenderer: function () {
                                            return "Start";
                                            }, buttonclick: function (row) {
                                                editrow         = row;
                                                var offset 		= $("#gridpesertaujian").offset();
                                                var dataRecord 	= $("#gridpesertaujian").jqxGrid('getrowdata', editrow);
                                                swal({
                                                    title: 'Apakah anda yakin ?',
                                                    text: "Peserta Ini Akan Kami Set Ujian tetap bisa dikerjakan?",
                                                    type: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonClass: 'btn btn-confirm mt-2',
                                                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                                    confirmButtonText: 'Yes'
                                                }).then(function () {
                                                    var set01		= dataRecord.noinduk;
                                                    var token   	= document.getElementById('token').value;
                                                    $.post('{{ route("exInputBankSoal") }}', { set01: 'startindividu', val02: set01, val03: dataRecord.marking, _token: token },	
                                                    function(data){
                                                        swal({
                                                            title	: 'Info',
                                                            text	: data,
                                                            type	: 'warning',
                                                        })
                                                        $("#gridpesertaujian").jqxGrid('updatebounddata');
                                                        return false;
                                                    });
                                                });
                                            }
                                        },
                                        { text: 'Stop', editable: false, sortable: false, filterable: false, cellsalign: 'center', align: 'center', columntype: 'button', width: '7%', cellsrenderer: function () {
                                            return "Stop";
                                            }, buttonclick: function (row) {
                                                editrow         = row;
                                                var offset 		= $("#gridpesertaujian").offset();
                                                var dataRecord 	= $("#gridpesertaujian").jqxGrid('getrowdata', editrow);
                                                swal({
                                                    title: 'Apakah anda yakin ?',
                                                    text: "Peserta Ini Akan Kami Set Ujian tidak lagi bisa dikerjakan?",
                                                    type: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonClass: 'btn btn-confirm mt-2',
                                                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                                    confirmButtonText: 'Yes'
                                                }).then(function () {
                                                    var set01		= dataRecord.noinduk;
                                                    var token   	= document.getElementById('token').value;		
                                                    $.post('{{ route("exInputBankSoal") }}', { set01: 'Stopindividu', val02: set01, val03: dataRecord.marking, _token: token },	
                                                    function(data){
                                                        swal({
                                                            title	: 'Info',
                                                            text	: data,
                                                            type	: 'warning',
                                                        })
                                                        $("#gridpesertaujian").jqxGrid('updatebounddata');
                                                        return false;
                                                    });
                                                });
                                            }
                                        },
                                        { text: 'Kode Unik', datafield: 'deskripsi', sortable: false, filterable: false, width: '10%', cellsalign: 'left', align: 'center'},
                                        { text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'},
                                        { text: 'Kelas', datafield: 'kelas', sortable: false, filterable: false, width: '7%', cellsalign: 'left', align: 'center'},
                                        { text: 'NoInduk', datafield: 'noinduk', sortable: false, filterable: false, width: '7%', cellsalign: 'left', align: 'center'},
                                        { text: 'KKM', datafield: 'kkm', filterable: false, width: '7%', cellsalign: 'center', align: 'center'  },
                                        { text: 'Nilai', datafield: 'nilai', filterable: false, width: '7%', cellsalign: 'center', align: 'center'  },
                                        { text: 'Keterangan', datafield: 'catatan', sortable: false, filterable: false, width: '21%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', cellsalign: 'center', align: 'center', width: '7%', cellsrenderer: function () {
                                            return "Del";
                                            }, buttonclick: function (row) {
                                                editrow         = row;
                                                var offset 		= $("#gridpesertaujian").offset();
                                                var dataRecord 	= $("#gridpesertaujian").jqxGrid('getrowdata', editrow);
                                                swal({
                                                    title: 'Apakah anda yakin ?',
                                                    text: "Peserta Ini Akan Kami Hapus Dari Peserta Ujian Ini, Apakah yakin ingin menghapus.?",
                                                    type: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonClass: 'btn btn-confirm mt-2',
                                                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                                    confirmButtonText: 'Yes'
                                                }).then(function () {
                                                    $.post('{{ route("exAddPesertaTest") }}', { val01: dataRecord.noinduk, val02: dataRecord.marking, val03: 'remove', val04: '0', _token: '{{ csrf_token() }}' }, function(data){
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
                                                            hideAfter: 3000,
                                                            stack: 1
                                                        });
                                                        $("#gridpesertaujian").jqxGrid('updatebounddata');
                                                        return false;
                                                    });
                                                });
                                            }
                                        },
                                    ]
                                });
                            }
                        },
                        { text: 'Export', editable: false, sortable: false, filterable: false, align: 'center', columntype: 'button', align: 'center', width: '6%', cellsrenderer: function () { return "Export"; }, 
                            buttonclick: function (row) {
                                editrow = row;	
                                var offset 		= $("#gridtest").offset();
                                var dataRecord 	= $("#gridtest").jqxGrid('getrowdata', editrow);
                                $("#cetak_marking").val(dataRecord.marking);
                                $("#modaljeniscetak").modal('show');
                            }
                        },
                        { text: 'Nama Ujian', datafield: 'namaujian', width: '16%', align: 'center', cellsalign: 'left' },
                        { text: 'Mata Pelajaran', datafield: 'ceel', width: '17%', align: 'center', cellsalign: 'left' },
                        { text: 'Komponen', datafield: 'kode', width: '7%', align: 'center', cellsalign: 'left' },
                        { text: 'Start', datafield: 'mulai', width: '18%', align: 'center', cellsalign: 'left' },
                        { text: 'Timer', datafield: 'timer', width: '5%', cellsalign: 'center', align: 'center' },
                        { text: 'Case', datafield: 'jumlah', width: '5%', cellsalign: 'center', align: 'center' },
                        { text: 'Peserta', datafield: 'peserta', width: '5%', cellsalign: 'center', align: 'center' },
					    { text: 'Analisis Hasil', editable: false, sortable: false, filterable: false, align: 'center', columntype: 'button', width: '9%', cellsrenderer: function () {
                            return "Preview";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridtest").offset();
                                var dataRecord 	= $("#gridtest").jqxGrid('getrowdata', editrow);
                                $('#daftarujian').hide();
                                $('#divanalisisujian').show();
                                var sumbersoaluntukdianalisisi = {
                                    datatype: "json",
                                    datafields: [
                                        { name: 'id'},
                                        { name: 'deskripsi', type: 'text'},
                                        { name: 'tipesoal', type: 'text'},
                                        { name: 'kode', type: 'text'},
                                        { name: 'ceel', type: 'text'},
                                        { name: 'tahun', type: 'text'},
                                        { name: 'tahun', type: 'text'},
                                        { name: 'created_by', type: 'text'},
                                        { name: 'namaujian', type: 'text'},
                                        { name: 'idsoal', type: 'text'},
                                    ],
                                    type: 'POST',
                                    data: {	set01: 'Analisis', set02: '', set03:dataRecord.marking, _token: '{{ csrf_token() }}' },
                                    url:  '{{ route("jsonallcase") }}',
                                };
                                var datadetailSoalAn = new $.jqx.dataAdapter(sumbersoaluntukdianalisisi);
                                $("#gridanalisis").jqxGrid({
                                    width           : '100%',
                                    filterable      : true,
                                    columnsresize   : true,
                                    showfilterrow   : true,
                                    theme           : "energyblue",
                                    sortable        : true,
                                    autoheight      : true,
                                    pageable        : true,
                                    source          : datadetailSoalAn,
                                    altrows         : true,
                                    columns         : [
                                        { text: 'Preview', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '7%', cellsrenderer: function () { return "Preview"; }, 
                                            buttonclick: function (row) {
                                                editrow = row;	
                                                var offset 		= $("#gridanalisis").offset();
                                                var dataRecord 	= $("#gridanalisis").jqxGrid('getrowdata', editrow);
                                                $.post('{{ route("getFirstDataUjian") }}', { val01: dataRecord.idsoal,val02: 'banksoal',  _token: '{{ csrf_token() }}' },function(data){
                                                    var deskripsi = data.deskripsi;
                                                    var opsia     = data.opsia;
                                                    var opsib     = data.opsib;
                                                    var opsic     = data.opsic;
                                                    var opsid     = data.opsid;
                                                    var opsie     = data.opsie;
                                                    var lampiran  = data.lampiran;
                                                    var jenissoal = data.jenissoal;
                                                    var lampiran  = data.lampiran;
                                                    var lampiran2 = data.lampiran2;
                                                    var lampiran3 = data.lampiran3;
                                                    var lampiran4 = data.lampiran4;
                                                    var lampiran5 = data.lampiran5;
                                                    var lampiran6 = data.lampiran6;
                                                    if (lampiran == ''){
                                                        $('#lihatsoalnumber1').attr('src', '/dist/img/takadagambar.png');
                                                    } else {
                                                        $('#lihatsoalnumber1').attr('src', lampiran);
                                                    }
                                                    if (lampiran2 == ''){
                                                        $('#lihatsoalnumber2').attr('src', '/dist/img/takadagambar.png');
                                                    } else {
                                                        $('#lihatsoalnumber2').attr('src', lampiran2);
                                                    }
                                                    if (lampiran3 == ''){
                                                        $('#lihatsoalnumber3').attr('src', '/dist/img/takadagambar.png');
                                                    } else {
                                                        $('#lihatsoalnumber3').attr('src', lampiran3);
                                                    }
                                                    if (lampiran4 == ''){
                                                        $('#lihatsoalnumber4').attr('src', '/dist/img/takadagambar.png');
                                                    } else {
                                                        $('#lihatsoalnumber4').attr('src', lampiran4);
                                                    }
                                                    if (lampiran5 == ''){
                                                        $('#lihatsoalnumber5').attr('src', '/dist/img/takadagambar.png');
                                                    } else {
                                                        $('#lihatsoalnumber5').attr('src', lampiran5);
                                                    }
                                                    if (lampiran6 == ''){
                                                        $('#lihatsoalnumber6').attr('src', '/dist/img/takadagambar.png');
                                                    } else {
                                                        $('#lihatsoalnumber6').attr('src', lampiran6);
                                                    }
                                                    $('#lihatdeskripsi').summernote('code', deskripsi);

                                                    if (jenissoal == 'esay'){
                                                        $('#lihatrubrik').show();
                                                        $('#lihatchoice').hide();
                                                        $('#lihatteksrubrik').summernote('code', opsia);
                                                    } else {
                                                        $('#lihatrubrik').hide();
                                                        $('#lihatchoice').show();
                                                        
                                                        $('#lihatopsia').html(opsia);
                                                        $('#lihatopsib').html(opsib);
                                                        $('#lihatopsic').html(opsic);
                                                        $('#lihatopsid').html(opsid);
                                                        $('#lihatopsie').html(opsie);
                                                    }
                                                    $("#modalpreviewsoal").modal('show');

                                                });
                                            }
                                        },
                                        { text: 'Nama Ujian', datafield: 'namaujian', width: '49%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Code', filtertype: 'checkedlist', datafield: 'kode', width: '15%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Category', filtertype: 'checkedlist', datafield: 'ceel', width: '15%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Type', filtertype: 'checkedlist', datafield: 'tipesoal', width: '7%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Rate', datafield: 'tahun', width: '5%', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  },
                                    ]
                                });
                            }
                        },
                    ]
                });
            });
            $('#btncetakformatmoodle').on('click', function (){
                $("#modaljeniscetak").modal('hide');
                var ujian_id=document.getElementById('cetak_marking').value;
                $.post('{{ route("exaddtotxt") }}', {  set01: ujian_id, set02: 'moodle', _token: '{{ csrf_token() }}' },
                function(data){			
                    var newWindow = window.open('', '', 'width=800, height=500'),
                        document = newWindow.document.open(),
                        pageContent =
                            '<!DOCTYPE html>\n' +
                            '<html>\n' +
                            '<head>\n' +
                            '<meta charset="utf-8" />\n' +
                            '<title>Moodle Format</title>\n' +
                            '</head>\n' +
                            '<body>' + data + '\n</body>\n</html>';
                        document.write(pageContent);
                        document.close();
                });
            });
            $('#btncetakformatstandartkey').on('click', function (){
                $("#modaljeniscetak").modal('hide');
                var ujian_id=document.getElementById('cetak_marking').value;
                $.post('{{ route("exaddtotxt") }}', {  set01: ujian_id, set02: 'standartkey', _token: '{{ csrf_token() }}' },
                function(data){			
                    var newWindow = window.open('', '', 'width=800, height=500'),
                        document = newWindow.document.open(),
                        pageContent =
                            '<!DOCTYPE html>\n' +
                            '<html>\n' +
                            '<head>\n' +
                            '<meta charset="utf-8" />\n' +
                            '<title>Standart Format with Key</title>\n' +
                            '</head>\n' +
                            '<body>' + data + '\n</body>\n</html>';
                        document.write(pageContent);
                        document.close();
                });
            });
            $('#btncetakformatstandartnokey').on('click', function (){
                $("#modaljeniscetak").modal('hide');
                var ujian_id=document.getElementById('cetak_marking').value;
                $.post('{{ route("exaddtotxt") }}', {  set01: ujian_id, set02: 'standartnokey', _token: '{{ csrf_token() }}' },
                function(data){			
                    var newWindow = window.open('', '', 'width=800, height=500'),
                        document = newWindow.document.open(),
                        pageContent =
                            '<!DOCTYPE html>\n' +
                            '<html>\n' +
                            '<head>\n' +
                            '<meta charset="utf-8" />\n' +
                            '<title>Standart Format No Key</title>\n' +
                            '</head>\n' +
                            '<body>' + data + '\n</body>\n</html>';
                        document.write(pageContent);
                        document.close();
                });
            });
      		$('#btnclosedivanalisis').click(function () {
                $('#daftarujian').show();
                $('#divanalisisujian').hide();
            });
            $('#btnexportdivanalisis').click(function(){
                var gridContent = $("#gridanalisis").jqxGrid('exportdata', 'json');
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
                            var res = isi2;
                                    td.setAttribute('style', 'mso-number-format: "\@";');
                                    td.innerHTML = res;
                                
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
            $('#btnrefreshpeserta').click(function () {
                $('#listpesertakiri').hide();
                $('#listpesertakanan').removeClass('col-lg-6').addClass('col-lg-12');
                $("#gridpesertaujian").jqxGrid('updatebounddata', 'filter');
            });
            $('#btnkalkulasi').click(function () {
                $('#listpesertakiri').hide();
                $('#listpesertahitung').show();
                $('#listpesertakanan').hide();
                var idujian	        = document.getElementById('ujian_id').value;
                var set03	        = document.getElementById('hitung_jumlahesai').value;
                var set04	        = document.getElementById('hitung_bobotesai').value;
                var set05	        = document.getElementById('hitung_bobotmcq').value;
                var set06	        = document.getElementById('hitung_bobotlisan').value;
                var set07	        = document.getElementById('hitung_ambangbatas').value;
                var sumberpesertahtg= {
                    datatype: "json",
                    datafields: [
                        { name: 'name', type: 'text'},
                        { name: 'alamat', type: 'text'},
                        { name: 'alamatasal', type: 'text'},
                        { name: 'countmcq', type: 'text'},
                        { name: 'countesai', type: 'text'},
                        { name: 'bobotmcq', type: 'text'},
                        { name: 'bobotesai', type: 'text'},
                        { name: 'bobotlisan', type: 'text'},
                        { name: 'skoremcq', type: 'text'},
                        { name: 'skoreesai', type: 'text'},
                        { name: 'oral01', type: 'text'},
                        { name: 'oral02', type: 'text'},
                        { name: 'oral03', type: 'text'},
                        { name: 'oral04', type: 'text'},
                        { name: 'oral05', type: 'text'},
                        { name: 'totalskore', type: 'text'},
                        { name: 'catatan', type: 'text'},
                        { name: 'ambangbatas', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	val01: 'hitung', val02: idujian, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, _token: '{{ csrf_token() }}' },
                    url: '{{ route("rad-json-pesertates") }}',
                };
                var jSonhitunggan = new $.jqx.dataAdapter(sumberpesertahtg);
                $("#gridpesertahitung").jqxGrid({
                    width           : '100%',
                    height          : 50,
                    filterable      : true,
                    columnsresize   : true,
                    showfilterrow   : true,
                    theme           : "energyblue",
                    sortable        : true,
                    autoheight      : true,
                    pageable        : true,
                    source          : jSonhitunggan,
                    altrows         : true,
                    columns         : [
                        { text: 'Nama', datafield: 'name', width: '18%', cellsalign: 'left', align: 'center'},
                        { text: 'Asal', datafield: 'alamat', sortable: false, filterable: false, width: '12%', cellsalign: 'left', align: 'center'},
                        { text: 'Bobot MCQ', columngroup: 'groupbobot', datafield: 'bobotmcq', width: '5%', cellsalign: 'center', align: 'center'  },
                        { text: 'Bobot Esai', columngroup: 'groupbobot', datafield: 'bobotesai', width: '5%', cellsalign: 'center', align: 'center'  },
                        { text: 'Bobot Oral', columngroup: 'groupbobot', datafield: 'bobotlisan', width: '5%', cellsalign: 'center', align: 'center'  },
                        { text: 'MCQ', columngroup: 'groupnilai',datafield: 'skoremcq', width: '5%', cellsalign: 'center', align: 'center'  },
                        { text: 'ESSAY', columngroup: 'groupnilai',datafield: 'skoreesai', width: '5%', cellsalign: 'center', align: 'center'  },
                        { text: 'Oral 01', columngroup: 'groupnilai',datafield: 'oral01', width: '5%', cellsalign: 'center', align: 'center'  },
                        { text: 'Oral 02', columngroup: 'groupnilai',datafield: 'oral02', width: '5%', cellsalign: 'center', align: 'center'  },
                        { text: 'Oral 03', columngroup: 'groupnilai', datafield: 'oral03', width: '5%', cellsalign: 'center', align: 'center'  },
                        { text: 'Oral 04', columngroup: 'groupnilai',datafield: 'oral04', width: '5%', cellsalign: 'center', align: 'center'  },
                        { text: 'Oral 05', columngroup: 'groupnilai',datafield: 'oral05', width: '5%', cellsalign: 'center', align: 'center'  },
                        { text: 'Nilai', datafield: 'totalskore', width: '5%', cellsalign: 'center', align: 'center'  },
                        { text: 'Ambang Batas', datafield: 'ambangbatas', width: '5%', cellsalign: 'center', align: 'center'  },
                        { text: 'Keterangan', datafield: 'catatan', width: '10%', cellsalign: 'left', align: 'center'  },
                    ],
                    columngroups: 
                    [
                        { text: 'BOBOT', align: 'center', name: 'groupbobot' },
                        { text: 'NILAI', align: 'center', name: 'groupnilai' },
                    ]
                });
            });
            $('#btnkembalidaripesertahitung').click(function () {
                $('#listpesertakiri').hide();
                $('#listpesertahitung').hide();
                $('#listpesertakanan').show();
                $("#gridpesertaujian").jqxGrid('updatebounddata');
            });
            $('#btncloselistpeserta').click(function () {
                $('#listpesertakiri').hide();
                $('#listpesertahitung').hide();
                $('#listpesertakanan').removeClass('col-lg-6').addClass('col-lg-12');
                $("#gridpesertaujian").jqxGrid('updatebounddata');
            });
            $('#btnopenlistpeserta').click(function () {
                $('#listpesertakiri').show();
                $('#listpesertahitung').hide();
                $('#listpesertakanan').removeClass('col-lg-12').addClass('col-lg-6');
                var token	= document.getElementById('token').value;
                var idujian	= document.getElementById('ujian_id').value;
                if (idujian == ''){
                    swal({
                        title	: 'Stop',
                        text	: 'Unkown Mark Test, Please Refresh This Page',
                        type	: 'warning',
                    })
                } else {
                    var source  = {
                        datatype: "json",
                        datafields: [
                            { name: 'id'},
                            { name: 'nama',type: 'text'},
                            { name: 'foto',type: 'text'},
                            { name: 'klspos',type: 'text'},
                            { name: 'noinduk',type: 'text'},
                        ],
                        type        : 'POST',
                        data        : {_token: "{{ csrf_token() }}", val02:'viewallnonpeserta', val01: idujian},
                        url         : '{{ route("rad-json-datausercari") }}',
                    };
                    var dataAdapter     = new $.jqx.dataAdapter(source);
                    var filerenderer = function (row, column, value) {
                        var lampiran = $('#gridpelamar').jqxGrid('getrowdata', row).foto;
                        if (lampiran != '' && lampiran != null){
                            var filelink = '<div style="background: white;"><img src="{{URL::to("/")}}/dist/img/foto/'+lampiran+'" height="40" /></div>';
                        } else {
                            var filelink = '<div style="background: white;"><img src="{{URL::to("/")}}/mascot.png" height="80" /></div>';
                        }
                        return filelink;
                    }
                    $("#gridpelamar").jqxGrid({
                        width               : '100%',
                        sortable            : true,
                        rowsheight          : 40,
                        autoheight          : true,
                        filterable          : true,
                        columnsresize       : true,
                        pageable            : true,
                        showfilterrow       : true,
                        source			    : dataAdapter,
                        theme               : "energyblue",
                        selectionmode       : 'multiplecellsextended',
                        columns             : [
                            { text: 'Add', editable: false, sortable: false, filterable: false, cellsalign: 'center', align: 'center', columntype: 'button', width: '10%', cellsrenderer: function () {
                                return "Add";
                                }, buttonclick: function (row) {
                                    editrow         = row;
                                    var offset 		= $("#gridpelamar").offset();
                                    var dataRecord 	= $("#gridpelamar").jqxGrid('getrowdata', editrow);
                                    var set01       = dataRecord.id;
                                    var pottabrum   = dataRecord.noinduk;
                                    var set02       = document.getElementById('ujian_id').value;
                                    var acak        = 2;
                                    $.post('{{ route("exAddPesertaTest") }}', { val01: set01, val02: set02, val03: 'tambah', val04: acak, _token: '{{ csrf_token() }}' }, function(data){
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
                                        $("#gridpesertaujian").jqxGrid('updatebounddata', 'filter');
                                        return false;
                                    });
                                }
                            },
                            { text: 'Photo', editable: false, sortable: false, filterable: false, width: '10%', align: 'center', cellsrenderer: filerenderer },
                            { text: 'Name', datafield: 'nama', width: '30%', cellsalign: 'left', align: 'center' },
		                    { text: 'Kelas', datafield: 'klspos', width: '20%', cellsalign: 'left', align: 'center' },
                            { text: 'No. Induk', datafield: 'noinduk', width: '30%', cellsalign: 'left', align: 'center' },
                        ],
                    });
                    $("#gridpesertaujian").jqxGrid('updatebounddata');
                }
            });
            $('.btnarsipujian').on('click', function (){
                $('#divwawancara').hide();
                $('#daftarpeserta').hide();
                $('#diveditorujiancaselist').hide();
                $('#diveditorujian').hide();
                $('#daftarujian').show();
                $('#divlistujian').show();
                $('#diveditsoal').hide();
                $('#divriwayat').hide();
                $('#divbanksoal').hide();
                $('#diveditpeserta').hide();
                $('#divanalisisujian').hide();
                $('#divupload').hide();
                var sourcedetail = {
                    datatype: "json",
                    datafields: [
                        { name: 'id'},
                        { name: 'ceel', type: 'text'},
                        { name: 'kode', type: 'text'},
                        { name: 'mulai', type: 'text'},
                        { name: 'selesai', type: 'text'},
                        { name: 'tglmulai', type: 'text'},
                        { name: 'jammulai', type: 'text'},
                        { name: 'tglselesai', type: 'text'},
                        { name: 'jamselesai', type: 'text'},
                        { name: 'namaujian', type: 'text'},
                        { name: 'supervisor', type: 'text'},
                        { name: 'tlssupervisor', type: 'text'},
                        { name: 'tipe', type: 'text'},
                        { name: 'status', type: 'text'},
                        { name: 'marking', type: 'text'},
                        { name: 'timer', type: 'text'},
                        { name: 'jumlah', type: 'text'},
                        { name: 'peserta', type: 'text'},
                        { name: 'aktif', type: 'text'},
                        { name: 'pengumuman', type: 'text'},
                        { name: 'tahun', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	set01: 'Master', set02:'Arsip', _token: '{{ csrf_token() }}' },
                    url:  '{{ route("jsonaktiftest") }}',
                };
                var datadetail = new $.jqx.dataAdapter(sourcedetail);
                $("#gridtest").jqxGrid({
                    width: '100%',
                    filterable: true,
                    columnsresize: true,
                    theme: "energyblue",
                    sortable: true,
                    autoheight: true,
                    pageable: true,
                    source: datadetail,
                    columns: [
                        { text: 'Analisis Hasil', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
                            return "Preview";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset 		= $("#gridtest").offset();
                                var dataRecord 	= $("#gridtest").jqxGrid('getrowdata', editrow);
                                $('#daftarujian').hide();
                                $('#divanalisisujian').show();
                                var sumbersoaluntukdianalisisi = {
                                    datatype: "json",
                                    datafields: [
                                        { name: 'id'},
                                        { name: 'deskripsi', type: 'text'},
                                        { name: 'tipesoal', type: 'text'},
                                        { name: 'kode', type: 'text'},
                                        { name: 'ceel', type: 'text'},
                                        { name: 'tahun', type: 'text'},
                                        { name: 'tahun', type: 'text'},
                                        { name: 'created_by', type: 'text'},
                                        { name: 'namaujian', type: 'text'},
                                        { name: 'idsoal', type: 'text'},
                                    ],
                                    type: 'POST',
                                    data: {	set01: 'Analisis', set02: '', set03:dataRecord.marking, _token: '{{ csrf_token() }}' },
                                    url:  '{{ route("jsonallcase") }}',
                                };
                                var datadetailSoalAn = new $.jqx.dataAdapter(sumbersoaluntukdianalisisi);
                                $("#gridanalisis").jqxGrid({
                                    width           : '100%',
                                    filterable      : true,
                                    columnsresize   : true,
                                    showfilterrow   : true,
                                    theme           : "energyblue",
                                    sortable        : true,
                                    autoheight      : true,
                                    pageable        : true,
                                    source          : datadetailSoalAn,
                                    altrows         : true,
                                    columns         : [
                                        { text: 'Preview', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '7%', cellsrenderer: function () { return "Preview"; }, 
                                            buttonclick: function (row) {
                                                editrow = row;	
                                                var offset 		= $("#gridanalisis").offset();
                                                var dataRecord 	= $("#gridanalisis").jqxGrid('getrowdata', editrow);
                                                $.post('{{ route("getFirstDataUjian") }}', { val01: dataRecord.idsoal,val02: 'banksoal',  _token: '{{ csrf_token() }}' },function(data){
                                                    var deskripsi = data.deskripsi;
                                                    var opsia     = data.opsia;
                                                    var opsib     = data.opsib;
                                                    var opsic     = data.opsic;
                                                    var opsid     = data.opsid;
                                                    var opsie     = data.opsie;
                                                    var lampiran  = data.lampiran;
                                                    var jenissoal = data.jenissoal;
                                                    var lampiran  = data.lampiran;
                                                    var lampiran2 = data.lampiran2;
                                                    var lampiran3 = data.lampiran3;
                                                    var lampiran4 = data.lampiran4;
                                                    var lampiran5 = data.lampiran5;
                                                    var lampiran6 = data.lampiran6;
                                                    if (lampiran == ''){
                                                        $('#lihatsoalnumber1').attr('src', '/dist/img/takadagambar.png');
                                                    } else {
                                                        $('#lihatsoalnumber1').attr('src', lampiran);
                                                    }
                                                    if (lampiran2 == ''){
                                                        $('#lihatsoalnumber2').attr('src', '/dist/img/takadagambar.png');
                                                    } else {
                                                        $('#lihatsoalnumber2').attr('src', lampiran2);
                                                    }
                                                    if (lampiran3 == ''){
                                                        $('#lihatsoalnumber3').attr('src', '/dist/img/takadagambar.png');
                                                    } else {
                                                        $('#lihatsoalnumber3').attr('src', lampiran3);
                                                    }
                                                    if (lampiran4 == ''){
                                                        $('#lihatsoalnumber4').attr('src', '/dist/img/takadagambar.png');
                                                    } else {
                                                        $('#lihatsoalnumber4').attr('src', lampiran4);
                                                    }
                                                    if (lampiran5 == ''){
                                                        $('#lihatsoalnumber5').attr('src', '/dist/img/takadagambar.png');
                                                    } else {
                                                        $('#lihatsoalnumber5').attr('src', lampiran5);
                                                    }
                                                    if (lampiran6 == ''){
                                                        $('#lihatsoalnumber6').attr('src', '/dist/img/takadagambar.png');
                                                    } else {
                                                        $('#lihatsoalnumber6').attr('src', lampiran6);
                                                    }
                                                    $('#lihatdeskripsi').summernote('code', deskripsi);

                                                    if (jenissoal == 'esay'){
                                                        $('#lihatrubrik').show();
                                                        $('#lihatchoice').hide();
                                                        $('#lihatteksrubrik').summernote('code', opsia);
                                                    } else {
                                                        $('#lihatrubrik').hide();
                                                        $('#lihatchoice').show();
                                                        
                                                        $('#lihatopsia').html(opsia);
                                                        $('#lihatopsib').html(opsib);
                                                        $('#lihatopsic').html(opsic);
                                                        $('#lihatopsid').html(opsid);
                                                        $('#lihatopsie').html(opsie);
                                                    }
                                                    $("#modalpreviewsoal").modal('show');

                                                });
                                            }
                                        },
                                        { text: 'Nama Ujian', datafield: 'namaujian', width: '49%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Code', filtertype: 'checkedlist', datafield: 'kode', width: '15%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Category', filtertype: 'checkedlist', datafield: 'ceel', width: '15%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Type', filtertype: 'checkedlist', datafield: 'tipesoal', width: '7%', cellsalign: 'left', align: 'center'  },
                                        { text: 'Rate', datafield: 'tahun', width: '5%', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  },
                                    ]
                                });
                            }
                        },
                        { text: 'Setting', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
                            return "Edit";
                            }, buttonclick: function (row) {
                                editrow         = row;
                                var offset      = $("#gridtest").offset();
                                var dataRecord 	= $("#gridtest").jqxGrid('getrowdata', editrow);
                                var status      = dataRecord.status;
                                if (status == ''){
                                    var status  = 0;
                                }
                                $("#ujian_id").val(dataRecord.marking);
                                $("#ujian_nama").val(dataRecord.namaujian);
                                $("#ujian_tglmulai").val(dataRecord.tglmulai);
                                $("#ujian_jammulai").val(dataRecord.jammulai);
                                $("#ujian_tglselesai").val(dataRecord.tglselesai);
                                $("#ujian_jamselesai").val(dataRecord.jamselesai);
                                $("#ujian_status").val(status);
                                $("#ujian_timer").val(dataRecord.timer);
                                $("#ujian_matpel").val(dataRecord.tipe).select2().trigger('change');
                                $('#daftarujian').hide();
                                $('#diveditorpewancara').hide();
                                $('#diveditorujiancaselist').show();
                                $('#diveditorujian').show();
                            }
                        },
                        { text: 'Exam Name', datafield: 'namaujian', width: '30%', align: 'center', cellsalign: 'left' },
                        { text: 'Start', datafield: 'mulai', width: '13%', align: 'center', cellsalign: 'left' },
                        { text: 'Finish', datafield: 'selesai', width: '13%', align: 'center', cellsalign: 'left' },
                        { text: 'Timer', datafield: 'timer', width: '7%', cellsalign: 'center', align: 'center' },
                        { text: 'Case', datafield: 'jumlah', width: '7%', cellsalign: 'center', align: 'center' },
                        { text: 'Participant', datafield: 'peserta', width: '8%', cellsalign: 'center', align: 'center' },
					    { text: 'Remove', columntype: 'button', width: '7%', editable: false, sortable: false, filterable: false, cellsrenderer: function () { return "Del";
                            }, buttonclick: function (row) {
                                editrow             = row;
                                var offset 		    = $("#gridtest").offset();
                                var dataRecord 	    = $("#gridtest").jqxGrid('getrowdata', editrow);
                                var set01		    = dataRecord.marking;
                                swal({
                                    title               : 'Apakah anda yakin ?',
                                    text                : "Delete Permanen Data Tes Ini.?",
                                    type                : 'warning',
                                    showCancelButton    : true,
                                    confirmButtonClass  : 'btn btn-confirm mt-2',
                                    cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
                                    confirmButtonText   : 'Yes, Remove It'
                                }).then(function () {
                                    $.post('{{ route("aktifet") }}', { val01: set01, val02: 'removetest', _token: '{{ csrf_token() }}' },	
                                    function(data){
                                        swal({
                                            title	: 'Info',
                                            text	: data,
                                            type	: 'warning',
                                        })
                                        $("#gridtest").jqxGrid('updatebounddata','filter');
                                        return false;
                                    });
                                });
                            }
                        },
                    ]
                });
            });
            $('#btnopencaselistview').on('click', function (){
                var markingtes=document.getElementById('ujian_id').value;
                if (markingtes == 'new' || markingtes == ''){
                    swal({
                        title	: 'Mohon di Lengkapi',
                        text	: 'Simpan Terlebih dahulu Ujian Ini',
                        type	: 'danger',
                    })
                } else {
                    $('#diveditorpewancara').hide();
                    var source = {
                        datatype: "json",
                        datafields: [
                            { name: 'id'},
                            { name: 'tipe', type: 'text'},
                            { name: 'jawaban', type: 'text'},
                            { name: 'deskripsi', type: 'text'},
                            { name: 'tipesoal', type: 'text'},
                            { name: 'kode', type: 'text'},
                            { name: 'ceel', type: 'text'},
                            { name: 'aktif', type: 'text'},
                            { name: 'markingtes', type: 'text'},
                            { name: 'created_by', type: 'text'},
                            { name: 'aktifview', type: 'text'},
                            { name: 'lampiran', type: 'text'},
                            { name: 'tahun', type: 'text'},
                            { name: 'idsoal'},
                            { name: 'tlssoale', type: 'text'},
                            { name: 'fullkode', type: 'text'},
                            { name: 'inputor', type: 'text'},
                            { name: 'opsia', type: 'text'},
                            { name: 'opsib', type: 'text'},
                            { name: 'opsic', type: 'text'},
                            { name: 'opsid', type: 'text'},
                            { name: 'opsie', type: 'text'},
                            { name: 'jawaba', type: 'text'},
                            { name: 'jawabb', type: 'text'},
                            { name: 'jawabc', type: 'text'},
                            { name: 'jawabd', type: 'text'},
                            { name: 'jawabe', type: 'text'},
                            { name: 'jawabf', type: 'text'},
                            { name: 'jawabg', type: 'text'},
                            { name: 'jawabh', type: 'text'},
                            { name: 'jawabi', type: 'text'},
                            { name: 'jawabj', type: 'text'},
                            { name: 'jawabk', type: 'text'},
                            { name: 'jawabl', type: 'text'},
                            { name: 'jawabm', type: 'text'},
                            { name: 'jawabn', type: 'text'},
                            { name: 'jawabo', type: 'text'},
                            { name: 'jawabp', type: 'text'},
                            { name: 'jawabq', type: 'text'},
                            { name: 'jawabr', type: 'text'},
                            { name: 'jawabs', type: 'text'},
                            { name: 'jawabt', type: 'text'},
                            { name: 'kunci', type: 'text'},
                            { name: 'keterangan', type: 'text'},
                            { name: 'aktifview', type: 'text'},
                            { name: 'lampiran', type: 'text'},
                            { name: 'lampiran2', type: 'text'},
                            { name: 'lampiran3', type: 'text'},
                            { name: 'lampiran4', type: 'text'},
                            { name: 'lampiran5', type: 'text'},
                            { name: 'lampiran6', type: 'text'},
                            { name: 'deskripsitambahan', type: 'text'},
                            { name: 'tahun', type: 'text'},
                            { name: 'created_by', type: 'text'},
                            { name: 'fakultas', type: 'text'},
                            { name: 'fakpanjang', type: 'text'},
                            { name: 'verified_by', type: 'text'},
                        ],
                        type: 'POST',
                        data: {set01:'soalaktif', set02:'all', set03:markingtes, _token: '{{ csrf_token() }}'},
                        url: '{{ route("jsonallcase") }}'
                    };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    $("#gridlistcase").jqxGrid({
                        width           : '100%',
                        pageable        : true,
                        filterable      : true,
                        showfilterrow   : true,
                        autoheight      : true,
                        source          : dataAdapter,
                        columnsresize   : true,
                        theme           : "energyblue",
                        selectionmode   : 'multiplecellsextended',
                        columns: [
                            { text: 'Description', datafield: 'deskripsi', width: '33%', cellsalign: 'left', align: 'center'  },
                            { text: 'Type', filtertype: 'checkedlist', datafield: 'tipesoal', width: '10%', cellsalign: 'left', align: 'center'  },
                            { text: 'Opsi A', datafield: 'opsia', width: '10%', cellsalign: 'left', align: 'center'  },
                            { text: 'Opsi B', datafield: 'opsib', width: '10%', cellsalign: 'left', align: 'center'  },
                            { text: 'Opsi C', datafield: 'opsic', width: '10%', cellsalign: 'left', align: 'center'  },
                            { text: 'Opsi D', datafield: 'opsid', width: '10%', cellsalign: 'left', align: 'center'  },
                            { text: 'Opsi E', datafield: 'opsie', width: '10%', cellsalign: 'left', align: 'center'  },
                            { text: 'Remove', columntype: 'button', width: '7%', editable: false, sortable: false, filterable: false, align: 'center', cellsrenderer: function () { return "Del";
                                }, buttonclick: function (row) {
                                    editrow             = row;
                                    var offset 		    = $("#gridlistcase").offset();
                                    var dataRecord 	    = $("#gridlistcase").jqxGrid('getrowdata', editrow);
                                    var set01		    = dataRecord.id;
                                    $.post('{{ route("aktifet") }}', { val01: set01, val02: 'remove', val03: markingtes, _token: '{{ csrf_token() }}' },
                                    function(data){
                                        $("#messagetest").html(data);
                                        $("#gridlistcase").jqxGrid('updatebounddata','filter');
                                        return false;
                                    });
                                }
                            },
                        ]
                    });
                }
            });
            $('#btnopencaselistadd').on('click', function (){
                var markingtes=document.getElementById('ujian_id').value;
                if (markingtes == 'new' || markingtes == ''){
                    swal({
                        title	: 'Mohon di Lengkapi',
                        text	: 'Simpan Terlebih dahulu Ujian Ini',
                        type	: 'danger',
                    })
                } else {
                    $('#diveditorpewancara').hide();
                    var source = {
                        datatype: "json",
                        datafields: [
                            { name: 'id'},
                            { name: 'tipesoal', type: 'text'},
                            { name: 'jawaban', type: 'text'},
                            { name: 'deskripsi', type: 'text'},
                            { name: 'tlssoale', type: 'text'},
                            { name: 'kode', type: 'text'},
                            { name: 'ceel', type: 'text'},
                            { name: 'aktif', type: 'text'},
                            { name: 'markingtes', type: 'text'},
                            { name: 'created_by', type: 'text'},
                            { name: 'jawaban', type: 'text'},
                            { name: 'created_at', type: 'text'},
                            { name: 'tahun', type: 'text'},
                            { name: 'deskripsitambahan', type: 'text'},
                        ],
                        type: 'POST',
                        data: {set01:'carisoal', set02:'all', set03:markingtes, _token: '{{ csrf_token() }}'},
                        url: '{{ route("jsonallcase") }}'
                    };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    $("#gridlistcase").jqxGrid({
                        width           : '100%',
                        pageable        : true,
                        filterable      : true,
                        showfilterrow   : true,
                        autoheight      : true,
                        source          : dataAdapter,
                        columnsresize   : true,
                        theme           : "energyblue",
                        selectionmode   : 'multiplecellsextended',
                        columns: [
                            { text: 'Select', columntype: 'button', width: '7%', editable: false, sortable: false, filterable: false, cellsrenderer: function () { return "Select";
                                }, buttonclick: function (row) {
                                    editrow             = row;
                                    var offset 		    = $("#gridlistcase").offset();
                                    var dataRecord 	    = $("#gridlistcase").jqxGrid('getrowdata', editrow);
                                    var set01		    = dataRecord.id;
                                    $.post('{{ route("aktifet") }}', { val01: set01, val02: 'input', val03: markingtes, _token: '{{ csrf_token() }}' },
                                    function(data){
                                        $("#messagetest").html(data);
                                        $("#gridlistcase").jqxGrid('updatebounddata','filter');
                                        return false;
                                    });
                                }
                            },
                            { text: 'Description', datafield: 'deskripsi', width: '30%', cellsalign: 'left', align: 'center'  },
                            { text: 'Contributor', datafield: 'created_by', width: '13%', cellsalign: 'left', align: 'center'  },
                            { text: 'Type', filtertype: 'checkedlist', datafield: 'jawaban', width: '7%', cellsalign: 'left', align: 'center'  },
                            { text: 'Code', filtertype: 'checkedlist', datafield: 'deskripsitambahan', width: '43%', cellsalign: 'left', align: 'center'  },
                        ]
                    });
                }
            });
            $('#btnkembalidariinputpeserta').click(function () {
                $('#daftarujian').show();
                $('#daftarpeserta').hide();
                $("#gridtest").jqxGrid('updatebounddata');
            });
            $('#btnkembalidariinputtes').click(function () {
                $('#daftarujian').show();
                $('#diveditorujian').hide();
                $('#diveditorujiancaselist').hide();
                $("#gridtest").jqxGrid('updatebounddata');
            });
            $('#btninputpeserta').click(function () {
                var set01 = document.getElementById('ujian_idpeserta').value;
                var set02 = document.getElementById('ujian_id').value;
                if (set01 == ''){
                    swal({
                        title	: 'Mohon di Lengkapi',
                        text	: 'Mohon Pilih Peserta',
                        type	: 'warning',
                    })
                } else if (set02 == 'new' || set02 == ''){
                    swal({
                        title	: 'Mohon di Lengkapi',
                        text	: 'Arsip Ujian Tidak Bisa di Tambah Anggota',
                        type	: 'warning',
                    })
                } else {
                    $.post('{{ route("exAddPesertaTest") }}', { val01: set01, val02: set02, val03: 'any', _token: '{{ csrf_token() }}' },
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
                        
                        $("#gridpeserta").jqxGrid('updatebounddata', 'filter');
                        return false;
                    });
                }
            });
            $("#btnubahspv").click(function(){
                var set01 = document.getElementById('spv_nama').value;
                var set02 = document.getElementById('spv_idtes').value;
                var set03 = document.getElementById('spv_idsoal').value;
                if (set01 == ''){
                    swal({
                        title	: 'Stop',
                        text	: 'Mohon Tentukan SPV Pengganti',
                        type	: 'warning',
                    })
                } else {
                    var form_data = new FormData();
                        form_data.append('set01', 'ubahspv');
                        form_data.append('set02', set01);
                        form_data.append('set03', set02);
                        form_data.append('set04', set03);
                        form_data.append('file', null);
                        form_data.append('_token', '{{csrf_token()}}');
                    $("#modalubahspv").modal('hide');
                    $.ajax({
                        url         : '{{ route("exInputBankSoal") }}',
                        data        : form_data,
                        type        : 'POST',
                        contentType : false,
                        processData : false,
                        success     : function (data) {
                            $.toast({
                                heading: 'Info',
                                text: data,
                                position: 'top-right',
                                loaderBg: '#bf441d',
                                icon: 'success',
                                hideAfter: 5000,
                                stack: 1
                            });
                            $("#gridlistcase").jqxGrid('updatebounddata', 'filter');
                            return false;
                        },
                        error: function (xhr, status, error) {
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'error',
                            })
                        }
                    });
                }
            });
            $('#btneksportpeserta').click(function(){
                var gridContent = $("#gridpesertaujian").jqxGrid('exportdata', 'json');
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
                            var res     = isi2;
                                td.setAttribute('style', 'mso-number-format: "\@";');
                                td.innerHTML = res;
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
            $('#btneksportpesertahitungg').click(function(){
                var gridContent = $("#gridpesertahitung").jqxGrid('exportdata', 'json');
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
                            var td 		    = document.createElement("td");
                            var isi 	    = data[i][col[j]];
                            var isi2 	    = isi.toString();
                            var res         = isi2;
                            td.setAttribute('style', 'mso-number-format: "\@";');
                            td.innerHTML    = res;
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
        //END_BLOK_UJIAN
        //START_BLOK_KOREKSI
            $('#btnopenkoreksi').on('click', function (){
                $('#divwawancara').hide();
                $('#divkoreksi').show();
                $('#divkoreksilistpeserta').show();
                $('#divkoreksieditnilai').hide();
                $('#tombolkoreksiawal').show();
                $('#tombolkoreksisoal').hide();
                $('#divkoreksilistsoal').hide();
                $('#daftarpeserta').hide();
                $('#diveditorujiancaselist').hide();
                $('#diveditorujian').hide();
                $('#daftarujian').hide();
                $('#divlistujian').hide();
                $('#diveditsoal').hide();
                $('#divriwayat').hide();
                $('#divbanksoal').hide();
                $('#diveditpeserta').hide();
                $('#divupload').hide();
                var sumberpeserta = {
                    datatype: "json",
                    datafields: [
                        { name: 'id', type: 'text'},
                        { name: 'marking', type: 'text'},
                        { name: 'namapeserta', type: 'text'},
                        { name: 'nomorpeserta', type: 'text'},
                        { name: 'asalpeserta', type: 'text'},
                        { name: 'supervisor', type: 'text'},
                        { name: 'idmahasiswa', type: 'text'},
                        { name: 'idtest', type: 'text'},
                        { name: 'idsoal', type: 'text'},
                        { name: 'nilai', type: 'text'},
                        { name: 'jawaban', type: 'text'},
                        { name: 'tanggal', type: 'text'},
                        { name: 'namaujian', type: 'text'},
                    ],
                    type: 'POST',
                    data: {	set01:'koreksipeserta', set02:'', set03:'', _token: '{{ csrf_token() }}' },
                    url: '{{ route("jsonallcase") }}',
                };
                var datadetail = new $.jqx.dataAdapter(sumberpeserta);
                $("#gridkoreksilistpeserta").jqxGrid({
                    width           : '100%',
                    filterable      : true,
                    columnsresize   : true,
                    showfilterrow   : true,
                    theme           : "energyblue",
                    sortable        : true,
                    autoheight      : true,
                    pageable        : true,
                    source          : datadetail,
                    altrows         : true,
                    ready           : function () {
                        $("#gridkoreksilistpeserta").jqxGrid('sortby', 'nomorpeserta', 'rand');
                    },
                    columns         : [
                        { text: 'Nomor Urut', datafield: 'nomorpeserta', width: '15%', cellsalign: 'left', align: 'center'  },
                        { text: 'Nama Ujian', datafield: 'namaujian', width: '35%', cellsalign: 'left', align: 'center'  },
                        { text: 'Tanggal', datafield: 'tanggal', width: '30%', cellsalign: 'left', align: 'center'  },
                        { text: 'Nilai', filtertype: 'checkedlist', datafield: 'nilai', width: '10%', cellsalign: 'center', align: 'center'  },
                        { text: 'Skoring', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
                            return "Input";
                            }, buttonclick: function (row) {
                                editrow 		= row;	
                                var offset 		= $("#gridkoreksilistpeserta").offset();		
                                var dataRecord 	= $("#gridkoreksilistpeserta").jqxGrid('getrowdata', editrow);
                                $('#divkoreksilistpeserta').hide();
                                $('#divkoreksieditnilai').show();
                                $('#tombolkoreksiawal').hide();
                                $('#tombolkoreksisoal').show();
                                $('#koreksi_jawaban').summernote('code', dataRecord.jawaban);
                                $("#koreksi_id").val(dataRecord.id);
                                $("#koreksi_skore").val(dataRecord.nilai);
                                $.post('{{ route("getFirstSoal") }}', { val01: dataRecord.idsoal, _token: '{{ csrf_token() }}' },function(data){
                                    $("#koreksi_kategori").html(data.ceel);
                                    $("#koreksi_ceel").html(data.kode);
                                    $("#koreksi_deskripsi").html(data.deskripsi);
                                    $("#koreksi_opsia").html(data.opsia);
                                    if (data.lampiran == ''){
                                        $('#korimagenumber1').attr('href', '/dist/img/takadagambar.png');
                                        $('#korpreview').attr('src', '/dist/img/takadagambar.png');
                                    } else {
                                        $('#korimagenumber1').attr('href', data.lampiran);
                                        $('#korpreview').attr('src', data.lampiran);
                                    }
                                    if (data.lampiran2 == ''){
                                        $('#korimagenumber2').attr('href', '/dist/img/takadagambar.png');
                                        $('#korpreview2').attr('src', '/dist/img/takadagambar.png');
                                    } else {
                                        $('#korimagenumber2').attr('href', data.lampiran2);
                                        $('#korpreview2').attr('src', data.lampiran2);
                                    }
                                    if (data.lampiran3 == ''){
                                        $('#korimagenumber3').attr('href', '/dist/img/takadagambar.png');
                                        $('#korpreview3').attr('src', '/dist/img/takadagambar.png');
                                    } else {
                                        $('#korimagenumber3').attr('href', data.lampiran3);
                                        $('#korpreview3').attr('src', data.lampiran3);
                                    }
                                    if (data.lampiran4 == ''){
                                        $('#korimagenumber4').attr('href', '/dist/img/takadagambar.png');
                                        $('#korpreview4').attr('src', '/dist/img/takadagambar.png');
                                    } else {
                                        $('#korimagenumber4').attr('href', data.lampiran4);
                                        $('#korpreview4').attr('src', data.lampiran4);
                                    }
                                    if (data.lampiran5 == ''){
                                        $('#korimagenumber5').attr('href', '/dist/img/takadagambar.png');
                                        $('#korpreview5').attr('src', '/dist/img/takadagambar.png');
                                    } else {
                                        $('#korpreview5').attr('src', data.lampiran5);
                                        $('#korimagenumber5').attr('href', data.lampiran5);
                                    }
                                    if (data.lampiran6 == ''){
                                        $('#korimagenumber6').attr('href', '/dist/img/takadagambar.png');
                                        $('#korpreview6').attr('src', '/dist/img/takadagambar.png');
                                    } else {
                                        $('#korpreview6').attr('src', data.lampiran6);
                                        $('#korimagenumber6').attr('href', data.lampiran6);
                                    }
                                });
                            }
                        },
                    ]
                });
            });
            $("#btntutupkoreksinilai").click(function(){
                $('#divkoreksilistsoal').show();
                $('#divkoreksieditnilai').hide();
            });
            $("#btnkembalikekoreksilist").click(function(){
                $('#tombolkoreksiawal').show();
                $('#divkoreksilistpeserta').show();
                $('#divkoreksieditnilai').hide();
                $('#tombolkoreksisoal').hide();
                $("#gridkoreksilistpeserta").jqxGrid('updatebounddata', 'filter');
            });
            $('#btnexportkoreksilist').click(function(){
                var gridContent = $("#gridkoreksilistpeserta").jqxGrid('exportdata', 'json');
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
            $("#btnsimpanskoring").click(function(){
                var val01 = document.getElementById('koreksi_id').value;
                var val02 = document.getElementById('koreksi_skore').value;
                $.post('{{ route("exInputBankSoal") }}', { set01: 'editnilai', set02: val01, set03: val02, _token: '{{ csrf_token() }}' }, function(data){
                    $.toast({
                        heading: 'Info',
                        text: data,
                        position: 'top-right',
                        loaderBg: '#bf441d',
                        icon: 'success',
                        hideAfter: 5000,
                        stack: 1
                    });
                    $("#gridkoreksilistpeserta").jqxGrid('updatebounddata', 'filter');
                    $('#tombolkoreksiawal').show();
                    $('#divkoreksilistpeserta').show();
                    $('#divkoreksieditnilai').hide();
                    $('#tombolkoreksisoal').hide();
                    return false;
                });
            });
            $('#korimagenumber1').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#korimagenumber2').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#korimagenumber3').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#korimagenumber4').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#korimagenumber5').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#korimagenumber6').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
        //END_BLOK_KOREKSI
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
        $('.btnkembali').click(function () {
            $('.card-outline').hide();
            $('.divawal').show();
            $('#divbanksoal').show();
            $('#divverifikasisoal').hide();
        });
        $('#btn-clear').click(function(){
            $('.form-filter').val('');
        });
        $('#btn-search').click(function(){
            $('#table_list').dataTable().fnDraw();
        });
        var col_order   = ["deskripsi", "tahun"];
        $('#table_list').DataTable({
            responsive  : true, 
            dom         : "<'row'<'col-sm-12'tr>>\
                            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            lengthMenu  : [10, 25, 50],
            pageLength  : 10,
            ordering    : true,
            processing  : true,
            serverSide  : true,
            autoWidth   : false,
            columns     : [
                { width : '450px' },
            ],
            ajax        : function(data, callback, settings) {
                $.ajax({
                url     : '{{ route("getBankSoal") }}',
                data    : {
                    limit   : settings._iDisplayLength,
                    page    : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
                    jenis   : $('#set_jenis').val(),
                    valcari : $('#main_valcari').val(),
                    view    : '1',
                    order   : col_order[settings.aaSorting[0][0]]+' '+settings.aaSorting[0][1],
                },
                type        : "GET",
                beforeSend  : function(request) {
                    request.setRequestHeader('Authorization', 'Bearer ' + token);
                },
                success: function(res) {
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
                "data"      : {
                    idsoal      : "idsoal",
                    kode        : "kode",
                    tipesoal    : "tipesoal",
                    deskripsi   : "deskripsi",
                    jawaba      : "jawaba",
                    jawabb      : "jawabb",
                    jawabc      : "jawabc",
                    jawabd      : "jawabd",
                    jawabe      : "jawabe",
                    lampiran    : "lampiran",
                    kuncie      : "kuncie",
                    showjawab   : "showjawab",
                    verified_by : "verified_by",
                    created_by  : "created_by",
                    fakultas    : "fakultas",
                    fakpanjang  : "fakpanjang",
                    inputor     : "inputor",
                    aktif       : "aktif",
                    view        : "view",
                },
                "orderable" : true,
                render      : function (data, type, row, meta) {
                    nomor = meta.row + meta.settings._iDisplayStart + 1;
                    var aktif       = data.aktif;
                    var view        = data.view;
                    var inputor     = data.inputor;
                    var lampiran    = data.lampiran;
                    var verified_by = data.verified_by;
                    var deskripsitambahan = data.deskripsitambahan;
                    var btnaktifasi = '';
                    if (aktif == 0){
                        var aktif = '<span class="badge badge-secondary">Deleted</span>';
                    } else {
                        if (view == 1){
                            if (verified_by == null || verified_by == ''){
                                var aktif       = '<span class="badge badge-warning">Mohon di Perbaiki dengan catatan : '+data.inputor+'</span>';
                                var btnaktifasi = '<button type="button" class="btn btn-default btn-sm btnverified" data-id="'+data.idsoal+'"><i class="fa fa-cloud-upload"></i> Set to Verified Case</button>';
                            } else {
                                var aktif = '<span class="badge badge-success">'+data.inputor+'</span>';
                            }
                        } else {
                            if (inputor == null || inputor == ''){
                                var aktif = '<span class="badge badge-primary">Data Baru</span>';
                                var btnaktifasi = '<button type="button" class="btn btn-default btn-sm btnverified" data-id="'+data.idsoal+'"><i class="fa fa-cloud-upload"></i> Set to Verified Case</button>';
                            } else {
                                if (verified_by == ''){
                                    var aktif = '<span class="badge badge-info">Updated dengan catatan sebelumnya : '+data.inputor+'</span>';
                                    var btnaktifasi = '<button type="button" class="btn btn-default btn-sm btnverified" data-id="'+data.idsoal+'"><i class="fa fa-cloud-upload"></i> Set to Verified Case</button>';
                                } else {
                                    var aktif = '<span class="badge badge-danger">'+data.inputor+'</span>';
                                }
                            }
                        }
                        
                    }
                    if (lampiran == ''){
                        var lampiran = '<img src="/dist/img/takadagambar.png" alt="Product Image" style="max-height: 160px;">'
                    } else {
                        var lampiran = '<img src="'+data.lampiran+'" alt="Product Image" style="max-height: 160px; max-width: 100px;">'
                    }
                    str = '<div class="row"><div class="col-auto">'+lampiran+'</div><div class="col px-4"><div><div class="float-right">'+aktif+'</div><h3>'+data.deskripsitambahan+'</h3>'+
                            '<p class="mb-0">'+data.deskripsi+'</p>'+data.showjawab+
                            '</div><div class="card-footer card-comments"><div class="card-comment"><div class="btn-group"><button type="button" class="btn btn-default btn-sm btnubah" data-id="'+data.idsoal+'"><i class="fa fa-edit"></i> Edit</button>'+
                            '<button type="button" class="btn btn-default btn-sm btndeletesoal" data-id="'+data.idsoal+'"><i class="fa fa-remove"></i> Delete</button>'+
                            btnaktifasi+
                            '</div></div><div class="card-comment">Created By '+data.created_by+'</div></div>'+
                            '</div></div></div>';

                    return str;
                }
                },
            ],
            "initComplete"  : function(settings, json) {
            }
        });
        
    });
</script>
@endpush