@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Setting Keuangan Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div id="status"></div>
                    @if(Session::has('message'))
                        <div class="alert {{ Session::get('alert-class') }} alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> {{ Session::get('status') }}</h4>
                                {!! Session::get('message') !!}
                        </div>
                    @endif
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Silahkan Pilih Siswa Per Kelas Untuk di Tentukan Besaran Biaya Sekolahnya</h3>
                        </div>
                        <div class="card-body">
                            @if(Session('sekolah_level') == 1)
                                <a href="#" id="gradekb"  class="btn btn-block btn-social btn-primary">
                                    <i class="fa fa-windows"></i> Kelompok Belajar
                                </a>
                                <a href="#" id="gradeta"  class="btn btn-block btn-social btn-warning">
                                    <i class="fa fa-android"></i> Tarbiyatul Athfal
                                </a>
                            @elseif (Session('sekolah_level') == 2)
                                <a href="#" id="grade1"  class="btn btn-block btn-social btn-info">
                                    <i class="fa fa-windows"></i> Kelas I
                                </a>
                                <a href="#" id="grade2"  class="btn btn-block btn-social btn-danger">
                                    <i class="fa fa-android"></i> Kelas II
                                </a>
                                <a href="#" id="grade3"  class="btn btn-block btn-social btn-success">
                                    <i class="fa fa-apple"></i> Kelas III
                                </a>
                                <a href="#" id="grade4"  class="btn btn-block btn-social btn-primary">
                                    <i class="fa fa-facebook"></i> Kelas IV
                                </a>
                                <a href="#" id="grade5"  class="btn btn-block btn-social btn-warning">
                                    <i class="fa fa-google"></i> Kelas V
                                </a>
                                <a href="#" id="grade6"  class="btn btn-block btn-social btn-info">
                                    <i class="fa fa-twitter"></i> Kelas VI
                                </a>
                            @elseif (Session('sekolah_level') == 3)
                                <a href="#" id="grade7"  class="btn btn-block btn-social btn-danger">
                                    <i class="fa fa-windows"></i> Kelas I
                                </a>
                                <a href="#" id="grade8"  class="btn btn-block btn-social btn-success">
                                    <i class="fa fa-android"></i> Kelas II
                                </a>
                                <a href="#" id="grade9"  class="btn btn-block btn-social btn-primary">
                                    <i class="fa fa-apple"></i> Kelas III
                                </a>
                            @else
                                <a href="#" id="grade10"  class="btn btn-block btn-social btn-warning">
                                    <i class="fa fa-windows"></i> Kelas I
                                </a>
                                <a href="#" id="grade11"  class="btn btn-block btn-social btn-info">
                                    <i class="fa fa-android"></i> Kelas II
                                </a>
                                <a href="#" id="grade12"  class="btn btn-block btn-social btn-danger">
                                    <i class="fa fa-apple"></i> Kelas III
                                </a>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-info" id="btneksul">Tambah Ekskul</button>		
                            <div id="gridekskul"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8" id="sectionaksi">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Workarea</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="exportgrid">
                                    <i class="fa fa-print"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="setperkelas">
                                <button type="button" class="btn btn-success" id="btnkembali">BACK</button>	
                                <div id="gridsetting"></div>
                            </div>
                            <div id="gridinsidental">
                                <button type="button" class="btn btn-danger" id="btntmbinsidental">Tambah Data Insidental</button>	
                                <div id="tabelinsidental"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modaleditkeuangan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Data Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-8">
                            <label>Nama</label>
                            <input type="text" id="id_nama" name="id_nama" class="form-control">
                        </div> 
                        <div class="col-sm-4">
                            <label>No.Induk</label>
                            <input type="text" id="id_noinduk" name="id_noinduk" class="form-control">
                        </div>
                    </div>			  			  
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>DPP</label>
                            <input type="text" id="id_dpp" name="id_dpp" class="form-control">
                        </div> 
                        <div class="col-sm-4">
                            <label>SPP</label>
                            <input type="text" id="id_spp" name="id_spp" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>Uang Makan</label>
                            <input type="text" id="id_paguyuban" name="id_paguyuban" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pilih Ekskul Yang Di Ambil</label>
                    <select id="id_eksul1" name="id_eksul1" class="form-control" >
                        <option value=""></option>
                        @foreach($ekstrakulikuler as $rekstra)
                            <option value="{{ $rekstra['nama'] }}">{{ $rekstra['nama'] }}</option>
                        @endforeach
                    </select>
                    <select id="id_eksul2" name="id_eksul2" class="form-control" >
                        <option value=""></option>
                        @foreach($ekstrakulikuler as $rekstra)
                            <option value="{{ $rekstra['nama'] }}">{{ $rekstra['nama'] }}</option>
                        @endforeach
                    </select>
                    <select id="id_eksul3" name="id_eksul3" class="form-control" >
                        <option value=""></option>
                        @foreach($ekstrakulikuler as $rekstra)
                            <option value="{{ $rekstra['nama'] }}">{{ $rekstra['nama'] }}</option>
                        @endforeach
                    </select>
                    <select id="id_eksul4" name="id_eksul4" class="form-control" >
                        <option value=""></option>
                        @foreach($ekstrakulikuler as $rekstra)
                            <option value="{{ $rekstra['nama'] }}">{{ $rekstra['nama'] }}</option>
                        @endforeach
                    </select>
                    <select id="id_eksul5" name="id_eksul5" class="form-control" >
                        <option value=""></option>
                        @foreach($ekstrakulikuler as $rekstra)
                            <option value="{{ $rekstra['nama'] }}">{{ $rekstra['nama'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="idform" >
                <button type="button" class="btn btn-info" id="btnsavesetting">Simpan</button>
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalekskul">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit/Tambah Ekskul</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-8">
                            <label>Nama Eksul</label>
                            <input type="text" id="id_namaekskul" name="id_namaekskul" class="form-control">
                        </div> 
                        <div class="col-sm-4">
                            <label>Biaya</label>
                            <input type="text" id="id_biaya" name="id_biaya" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <select id="id_eksulaktifasi" name="id_eksulaktifasi" class="form-control" >
                        <option value="aktif">Aktif</option>
                        <option value="non aktif">Non Aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="idform2" >
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <div id="tomboltambah">
                    <button type="button" class="btn btn-success" id="saveskul">Simpan</button>	
                </div>
                <div id="tombolupdate">
                    <button type="button" class="btn btn-info" id="updateekskul">Update</button>	
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalinsidental">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit/Tambah Insidental</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Kode Insidental</label>
                            <input type="text" id="id_kode" name="id_kode" class="form-control">
                        </div> 
                        <div class="col-sm-4">
                            <label>Jenis Insidental</label>
                            <select id="id_jenis" class="form-control">
                                <option value=""></option>
                                <option value="kegiatan">Kegiatan</option>
                                <option value="bukupaket">Buku Paket</option>
                                <option value="bukutulis">Buku Tulis</option>
                                <option value="peralatan">Peralatan</option>
                                <option value="pembangunan">Pembangunan</option>
                                <option value="seragam">Seragam</option>
                                <option value="jariyah">Jariyah</option>
                                <option value="lainlain">Lain-Lain</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Biaya Insidental</label>
                            <input type="text" id="id_biayainsidental" name="id_biayainsidental" class="form-control">
                        </div>
                    </div>
                    Untuk Kode Bisa di urutkan (harus unik) dari kode sebelumnya.
                </div>
                <div class="form-group">	
                    <div class="row">
                        <div class="col-sm-9">
                            <label>Deskripsi</label>
                            <input type="text" id="id_deskripsi" name="id_deskripsi" class="form-control">		
                        </div>
                        <div class="col-sm-3">
                            <label>Tenggat</label>
                            <input type="text" id="id_tengat" name="id_tengat" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="idform3" >
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <div id="tomboltambahinsidental">
                    <button type="button" class="btn btn-success" id="saveinsidental">Simpan</button>	
                </div>
                <div id="tombolupdateinsidental">
                    <button type="button" class="btn btn-info" id="updateinsidental">Update</button>	
                </div>
            </div>
        </div>
    </div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="makhir" id="makhir" value="now">
@endsection
@push('script')
<script>
	$(function () {
		$("#id_tengat").datepicker();
	});
    $(document).ready(function () {
        $("#id_spp").autoNumeric(
            'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
        );
        $("#id_dpp").autoNumeric(
            'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
        );
        $("#id_paguyuban").autoNumeric(
            'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
        );
        $("#id_biaya").autoNumeric(
            'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
        );
        $("#id_biayainsidental").autoNumeric(
            'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
        );
        $('#setperkelas').hide();
        var token=document.getElementById('token').value;
        var sourceinsidental = {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'deskripsi', type: 'text'},
                { name: 'kode', type: 'text'},
                { name: 'biaya', type: 'text'},
                { name: 'bataswaktu', type: 'text'},
                { name: 'aktifasi', type: 'text'},
                { name: 'jenis', type: 'text'},
                { name: 'operator', type: 'text'},
                { name: 'timestamp', type: 'text'},
            ],
            updaterow: function (rowid, rowdata, commit) {
                commit(true);
            },
            url: 'json/setinsidental',
            cache: false
        };
        var datainsidental = new $.jqx.dataAdapter(sourceinsidental);
        var editrow = -1;
        $("#tabelinsidental").jqxGrid({
            width: '100%',
            filterable: true,
            pageable: true,
            filterable: true,
            filtermode: 'excel',
            source: datainsidental,
            columnsresize: true,
            theme: "energyblue",
            selectionmode: 'multiplecellsextended',
            columns: [
                { text: 'Tanggal', datafield: 'timestamp', width: '10%', align: 'center', cellsalign: 'left'},
                { text: 'Administrator', datafield: 'operator', width: '10%', align: 'center', cellsalign: 'left'},
                { text: 'Jenis', datafield: 'jenis', width: '8%', align: 'center', cellsalign: 'left'},
                { text: 'Kode', datafield: 'kode', width: '10%', align: 'center', cellsalign: 'left'},
                { text: 'Deskripsi', datafield: 'deskripsi', width: '24%', align: 'center', cellsalign: 'left'},
                { text: 'Biaya', datafield: 'biaya', width: '8%', align: 'center', cellsalign: 'left'},
                { text: 'Tenggat', datafield: 'bataswaktu', width: '10%', align: 'center', cellsalign: 'left'},	
                { text: 'Status', datafield: 'aktifasi', width: '10%', align: 'center', cellsalign: 'left'},	
                { text: 'Edit', columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#tabelinsidental").offset();
                        var dataRecord 	= $("#tabelinsidental").jqxGrid('getrowdata', editrow);
                        $("#id_kode").val(dataRecord.kode);
                        $("#id_jenis").val(dataRecord.jenis);
                        $("#id_biaya").val(dataRecord.biaya);
                        $("#id_deskripsi").val(dataRecord.deskripsi);
                        $("#id_biayainsidental").val(dataRecord.biaya);
                        $('#tomboltambahinsidental').hide();
                        $('#tombolupdateinsidental').show();
                        $("#modalinsidental").modal('show');
                    }
                },
            ]
        });
        var sourceeksul = {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'namaeksul', type: 'text'},
                { name: 'biaya', type: 'text'},
            ],
            updaterow: function (rowid, rowdata, commit) {
                commit(true);
            },
            url: 'json/ekskul',
            cache: false
        };
        var dataekskul = new $.jqx.dataAdapter(sourceeksul);
        $("#gridekskul").jqxGrid({
            width: '100%',
            autoheight: true,
            source: dataekskul,
            theme: "energyblue",
            selectionmode: 'multiplecellsextended',
            columns: [
                { text: 'Nama Ekskul', datafield: 'namaeksul', width: '50%', align: 'center', cellsalign: 'left'},
                { text: 'Biaya', datafield: 'biaya', width: '30%', align: 'center', cellsalign: 'left'},
                { text: 'Edit', columntype: 'button', align: 'center', width: '20%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridekskul").offset();
                        var dataRecord 	= $("#gridekskul").jqxGrid('getrowdata', editrow);
                        $("#id_namaekskul").val(dataRecord.namaeksul);
                        $("#id_biaya").val(dataRecord.biaya);
                        $("#idform2").val(dataRecord.id);
                        $('#tomboltambah').hide();
                        $('#tombolupdate').show();
                        $("#modalekskul").modal('show');	
                    }
                },
            ]
        });
        $('#btnkembali').click(function () {
            $('#setperkelas').hide();
            $('#gridinsidental').show();
            $("#gridekskul").jqxGrid("updatebounddata");
            $("#gridinsidental").jqxGrid("updatebounddata");
        });
        $('#btneksul').click(function () {
            $("#modalekskul").modal('show');
            $('#tomboltambah').show();
            $('#tombolupdate').hide();
        });
        $('#btntmbinsidental').click(function () {
            $("#modalinsidental").modal('show');
            $("#id_biayainsidental").val();
            $("#id_jenis").val();
            $("#id_kode").val();
            $("#id_deskripsi").val();
            $("#id_tengat").val();
            $('#tomboltambahinsidental').show();
            $('#tombolupdateinsidental').hide();
        });
        $('#saveinsidental').click(function () {
            var set01=document.getElementById('id_kode').value;
            var set02=document.getElementById('id_jenis').value;
            var set03=document.getElementById('id_biayainsidental').value;
            var set04=document.getElementById('id_deskripsi').value;
            var set05=document.getElementById('id_tengat').value;
            var set06='baru';
            var token=document.getElementById('token').value;
            $.post('admin/simpaninsidental', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, _token: token },
            function(data){	
                $("#modalinsidental").modal('hide');
                $("#tabelinsidental").jqxGrid("updatebounddata");		
                $('#status').html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");		
                return false;
            });
        });
        $('#updateinsidental').click(function () {
            var set01=document.getElementById('id_kode').value;
            var set02=document.getElementById('id_jenis').value;
            var set03=document.getElementById('id_biayainsidental').value;
            var set04=document.getElementById('id_deskripsi').value;
            var set05=document.getElementById('id_tengat').value;
            var set06='ubah';
            var token=document.getElementById('token').value;
            $.post('admin/simpaninsidental', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, _token: token },
            function(data){	
                $("#modalinsidental").modal('hide');
                $("#tabelinsidental").jqxGrid("updatebounddata");		
                $('#status').html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");		
                return false;
            });
        });
        $('#saveskul').click(function () {
            var set01=document.getElementById('id_namaekskul').value;
            var set02=document.getElementById('id_biaya').value;
            var set03=document.getElementById('id_eksulaktifasi').value;
            var token=document.getElementById('token').value;
            $.post('admin/saveekskul', { val01: set01, val02: set02, val03: set03,  val04: '', _token: token },
            function(data){	
                $("#modalekskul").modal('hide');
                $("#gridekskul").jqxGrid("updatebounddata");
                window.setTimeout('window.location=window.location', 2000);
                $('#status').html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");		
                return false;
            });
        });
        $('#updateekskul').click(function () {
            var set01=document.getElementById('id_namaekskul').value;
            var set02=document.getElementById('id_biaya').value;
            var set03=document.getElementById('id_eksulaktifasi').value;
            var set04=document.getElementById('idform2').value;
            var token=document.getElementById('token').value;
            $.post('admin/saveekskul', { val01: set01, val02: set02, val03: set03,  val04: set04, _token: token },
            function(data){	
                $("#modalekskul").modal('hide');
                $("#gridekskul").jqxGrid("updatebounddata");
                window.setTimeout('window.location=window.location', 2000);
                $('#status').html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");		
                return false;
            });
        });
        $('#gradekb').click(function () {	
            var set01	='kb';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#gradeta').click(function () {	
            var set01	='ta';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#grade1').click(function () {	
            var set01	='1';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#grade2').click(function () {	
            var set01	='2';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#grade3').click(function () {	
            var set01	='3';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#grade4').click(function () {	
            var set01	='4';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#grade5').click(function () {
            var set01	='5';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#grade6').click(function () {	
            var set01	='6';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#grade7').click(function () {	
            var set01	='7';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#grade8').click(function () {	
            var set01	='8';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#grade9').click(function () {	
            var set01	='9';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#grade10').click(function () {	
            var set01	='10';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#grade11').click(function () {	
            var set01	='11';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#grade12').click(function () {	
            var set01	='12';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'dpp', type: 'text'},
                    { name: 'spp', type: 'text'},
                    { name: 'paguyuban', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#setperkelas').show(); 
            $('#gridinsidental').hide(); 
            $("#gridsetting").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filterable: true,
                filtermode: 'excel',				
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'DPP', datafield: 'dpp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'SPP', datafield: 'spp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Uang Makan', datafield: 'paguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', datafield: 'eksul1', width: 120, align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: 120, align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: 120, align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: 120, align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: 120, align: 'center' },
                    { text: 'UBAH', columntype: 'button', align: 'center', width: 50, cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {	
                            editrow = row;	
                            var offset 		= $("#gridsetting").offset();
                            $('#setperkelas').show(); 
                            $('#gridinsidental').hide();
                            var dataRecord 	= $("#gridsetting").jqxGrid('getrowdata', editrow);				
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_dpp").val(dataRecord.dpp);
                            $("#id_noinduk").val(dataRecord.noinduk);
                            $("#id_paguyuban").val(dataRecord.paguyuban);
                            $("#id_spp").val(dataRecord.spp);
                            $("#id_eksul1").val(dataRecord.eksul1);
                            $("#id_eksul2").val(dataRecord.eksul2);
                            $("#id_eksul3").val(dataRecord.eksul3);
                            $("#id_eksul4").val(dataRecord.eksul4);
                            $("#id_eksul5").val(dataRecord.eksul5);
                            $("#modaleditkeuangan").modal('show');	
                        }
                    },
                ]
            });		
        });
        $('#btnsavesetting').on('click', function (){		
            var set01=document.getElementById('id_nama').value;
            var set02=document.getElementById('id_noinduk').value;
            var set03=document.getElementById('id_dpp').value;
            var set04=document.getElementById('id_spp').value;
            var set05=document.getElementById('id_paguyuban').value;
            var set06=document.getElementById('id_eksul1').value;
            var set07=document.getElementById('id_eksul2').value;
            var set08=document.getElementById('id_eksul3').value;
            var set09=document.getElementById('id_eksul4').value;
            var set10=document.getElementById('id_eksul5').value;
            $.post('admin/simpansetkeuangan', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, _token: token },
            function(data){	
                $("#modaleditkeuangan").modal('hide');
                $('#status').html(data);
                $('#setperkelas').show(); 
                $('#gridinsidental').hide(); 
                $("#gridsetting").jqxGrid("updatebounddata");
                $("#gridinsidental").jqxGrid("updatebounddata");
            });
        });	
    });
</script>
@endpush