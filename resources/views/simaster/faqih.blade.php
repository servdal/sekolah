@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kelas Al Quran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Back Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" id="sectiontahfid">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title" id="juduldetailalquran">Perkembangan Santri</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btnopenmushaf"><i class="fa fa-book"></i> Open Mushaf</button>
                            </div>
                        </div>
                        <div class="card-body" id="divawalperkemsantri">
                            <div id="gridperkembangansantri"></div>
                        </div>
                        <div class="card-footer" id="divdetperkemsantri">
                            <button class="btn btn-success" id="btnclosedetailperkembangan">Close Detail</button>
                            <div id="griddetailperkembangansantri"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="sectionsetoran">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Setoran Santri</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btnsimpansetoran"><i class="fa fa-database"></i> Save All</button>
                                <button type="button" class="btn btn-tool" id="btnkembalidarisetoran"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <form id="formtambahsetoran" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
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
                                            <label>Grade</label>
                                            <input type="text" id="setoran_jilid" name="setoran_jilid" class="form-control" readonly> 
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
                                                        <div class="row">
                                                            <div class="col-lg-9">
                                                                <label>Mulai Surah</label>
                                                                <select id="setoran_ziyadahsurahawal" name="setoran_ziyadahsurahawal" class="form-control select2">
                                                                    <option value="">Pilih Salah Satu</option>
                                                                    <option value="Jilid 1">Jilid 1</option>
                                                                    <option value="Jilid 2">Jilid 2</option>
                                                                    <option value="Jilid 3">Jilid 3</option>
                                                                    <option value="Jilid 4">Jilid 4</option>
                                                                    <option value="Jilid 5">Jilid 5</option>
                                                                    <option value="Jilid 6">Jilid 6</option>
                                                                    <option value="Tajwid ghorib">Tajwid ghorib</option>
                                                                    @foreach($mushaflist as $rows)
                                                                        <option value="{{ $rows['surah'] }}">{{ $rows['surah'] }} ( {{ $rows['makna'] }} - {{ $rows['jumlah'] }} - {{ $rows['jenis'] }} )</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label>Mulai Ayat</label>
                                                                <select id="setoran_ziyadahayatawal" name="setoran_ziyadahayatawal" class="form-control select2">
                                                                    @php 
                                                                        for ($i = 1; $i < 287; $i++){
                                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                                        }
                                                                    @endphp
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-9">
                                                                <label>Mulai Surah</label>
                                                                <select id="setoran_ziyadahsurahakhir" name="setoran_ziyadahsurahakhir" class="form-control select2">
                                                                    <option value="">Pilih Salah Satu</option>
                                                                    <option value="Jilid 1">Jilid 1</option>
                                                                    <option value="Jilid 2">Jilid 2</option>
                                                                    <option value="Jilid 3">Jilid 3</option>
                                                                    <option value="Jilid 4">Jilid 4</option>
                                                                    <option value="Jilid 5">Jilid 5</option>
                                                                    <option value="Jilid 6">Jilid 6</option>
                                                                    <option value="Tajwid ghorib">Tajwid ghorib</option>
                                                                    @foreach($mushaflist as $rows)
                                                                        <option value="{{ $rows['surah'] }}">{{ $rows['surah'] }} ( {{ $rows['makna'] }} - {{ $rows['jumlah'] }} - {{ $rows['jenis'] }} )</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label>Mulai Ayat</label>
                                                                <select id="setoran_ziyadahayatakhir" name="setoran_ziyadahayatakhir" class="form-control select2">
                                                                    @php 
                                                                        for ($i = 1; $i < 287; $i++){
                                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                                        }
                                                                    @endphp
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
                                                        <div class="row">
                                                            <div class="col-lg-9">
                                                                <label>Mulai Surah</label>
                                                                <select id="setoran_msurahawal" name="setoran_msurahawal" class="form-control select2">
                                                                    <option value="">Pilih Salah Satu</option>
                                                                    <option value="Jilid 1">Jilid 1</option>
                                                                    <option value="Jilid 2">Jilid 2</option>
                                                                    <option value="Jilid 3">Jilid 3</option>
                                                                    <option value="Jilid 4">Jilid 4</option>
                                                                    <option value="Jilid 5">Jilid 5</option>
                                                                    <option value="Jilid 6">Jilid 6</option>
                                                                    <option value="Tajwid ghorib">Tajwid ghorib</option>
                                                                    @foreach($mushaflist as $rows)
                                                                        <option value="{{ $rows['surah'] }}">{{ $rows['surah'] }} ( {{ $rows['makna'] }} - {{ $rows['jumlah'] }} - {{ $rows['jenis'] }} )</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label>Mulai Ayat</label>
                                                                <select id="setoran_mayatawal" name="setoran_mayatawal" class="form-control select2">
                                                                    @php 
                                                                        for ($i = 1; $i < 287; $i++){
                                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                                        }
                                                                    @endphp
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-9">
                                                                <label>Mulai Surah</label>
                                                                <select id="setoran_msurahakhir" name="setoran_msurahakhir" class="form-control select2">
                                                                    <option value="">Pilih Salah Satu</option>
                                                                    <option value="Jilid 1">Jilid 1</option>
                                                                    <option value="Jilid 2">Jilid 2</option>
                                                                    <option value="Jilid 3">Jilid 3</option>
                                                                    <option value="Jilid 4">Jilid 4</option>
                                                                    <option value="Jilid 5">Jilid 5</option>
                                                                    <option value="Jilid 6">Jilid 6</option>
                                                                    <option value="Tajwid ghorib">Tajwid ghorib</option>
                                                                    @foreach($mushaflist as $rows)
                                                                        <option value="{{ $rows['surah'] }}">{{ $rows['surah'] }} ( {{ $rows['makna'] }} - {{ $rows['jumlah'] }} - {{ $rows['jenis'] }} )</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label>Mulai Ayat</label>
                                                                <select id="setoran_mayatakhir" name="setoran_mayatakhir" class="form-control select2">
                                                                    @php 
                                                                        for ($i = 1; $i < 287; $i++){
                                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                                        }
                                                                    @endphp
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
                                        <div class="col-lg-3">
                                            <div class="card card-info shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Adab dan Akhlak</h3>
                                                </div>
                                                <div class="card-body">
                                                    <textarea id="setoran_adab" name="setoran_adab" rows="10" cols="80"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="card card-warning shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Fiqih</h3>
                                                </div>
                                                <div class="card-body">
                                                    <textarea id="setoran_fiqih" name="setoran_fiqih" rows="10" cols="80"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="card card-danger shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Akidah</h3>
                                                </div>
                                                <div class="card-body">
                                                    <textarea id="setoran_akidah" name="setoran_akidah" rows="10" cols="80"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="card card-success shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Life Skill</h3>
                                                </div>
                                                <div class="card-body">
                                                    <textarea id="setoran_lifeskil" name="setoran_lifeskil" rows="10" cols="80"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12" id="sectionmushaf">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Mushaf</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body row">
                            <div class="col-lg-4">
                                <div class="list-group list-group-flush" id="sidenav"></div>
                            </div>
                            <div class="col-md-8">
                                <section class="jumbotron">
                                    <div class="container-fluid">
                                        <div style="text-align: center;" id="loadingview"></div>
                                    </div>
                                    <h1 class="mt-4" id="surahtitle" style="text-align: center;"></h1>
                                    <div id="surah" style="margin: 20;"></div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="idekskul" id="idekskul" value="{{ $jilid }}">
<input type="hidden" name="mastertgl" id="mastertgl" value="{{ date('Y-m-d') }}">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" id="mas_matkul">
<input type="hidden" id="mas_semester" name="mas_semester" value="{{ $smt }}">
<input type="hidden" id="mas_tapel" name="mas_tapel" value="{{ $tapel }}">
<input type="hidden" id="mas_niyguru" name="mas_niyguru" value="{{ Session('id') }}">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection

@push('script')
<script type="text/javascript">
    $(function () {
        $('.select2').select2({width: '100%'});
        CKEDITOR.env.isCompatible = true;
		$('#presensi_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
    var baseurl = 'https://raw.githubusercontent.com/iqbalsyamhad/Al-Quran-JSON-Indonesia-Kemenag/master/';
    var isLoading = document.getElementById("loadingview");
    (function () {
      fetch(baseurl + 'Daftar%20Surat.json')
        .then(function (response) {
          return response.json();
        })
        .then(function (json) {
          var navContainer = document.getElementById("sidenav");
          for (var i = 0; i < json.data.length; i++) {
            var div = document.createElement("div");
            div.innerHTML = '<a class="list-group-item list-group-item-action bg-light" style="cursor: pointer;" onclick="getSurat(\'' + json.data[i].id + '\', \'' + json.data[i].surat_name.replace(/[^\w\s]/gi, '') + '\')">' + json.data[i].id + '. Surat ' + json.data[i].surat_name + '</a>';
            navContainer.appendChild(div);
          }
        })
        .catch(function (err) {
          alert('error: ' + err);
        });
    })();
    function getSurat(id, title) {
      isLoading.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span>'
      document.getElementById("surahtitle").innerHTML = title;
      var mainContainer = document.getElementById("surah");
      mainContainer.innerHTML = '';
      fetch(baseurl + 'Surat/' + id + '.json')
        .then(function (response) {
          return response.json();
        })
        .then(function (data) {
          for (var i = 0; i < data.data.length; i++) {
            var div = document.createElement("div");
            div.innerHTML = '<p class="arabic pull-right"><span class="badge badge-primary">' + data.data[i].aya_number + '</span> ' + data.data[i].aya_text + '</p><div class="clearfix"></div><p style="terjemah">' + data.data[i].translation_aya_text + '</p>';
            mainContainer.appendChild(div);
          }
          isLoading.innerHTML = ''
        })
        .catch(function (err) {
          alert('error: ' + err);
        });
    }
    function openedpage( jQuery ){
        $('#sectiontahfid').show();
        $('#divdetperkemsantri').hide();
        $('#divawalperkemsantri').show();
        $('#sectionkerja').hide();
        $('#sectionsetting').hide();
        var judul = 'Perkembangan santri';
        $('#juduldetailalquran').html(judul);
        var set01	= document.getElementById('idekskul').value;
        var set02	= 'ortu';
        var source 	= {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'noinduk', type: 'text'},
                { name: 'nama', type: 'text'},
                { name: 'jilid', type: 'text'},
                { name: 'kelas', type: 'text'},
                { name: 'foto', type: 'text'},
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
            ],
            type: 'POST',
            data: {val01:set01, val02:set02, val03:'last', _token: '{{ csrf_token() }}'},
            url: '{{ route("jsonSetoranTahfid") }}',
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#gridperkembangansantri").jqxGrid({
            width: '100%',
            pageable: true,
            rowsheight: 40,
            autoheight:true,
            filterable: true,
            filtermode: 'excel',
            source: dataAdapter,
            theme: "energyblue",
            selectionmode: 'singlecell',
            columns: [
                { text: 'Detail', columntype: 'button', width: 50, align: 'center', cellsrenderer: function () {
                    return "Detail";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridperkembangansantri").offset();
                        var dataRecord 	= $("#gridperkembangansantri").jqxGrid('getrowdata', editrow);
                        var tapel	    = document.getElementById('tapel').value;
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
                            ],
                            type: 'POST',
                            data: {	val01:dataRecord.noinduk, val02:tapel, val03:'all', _token: token },
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
                            autorowheight   : true,
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
                                        var inputor     = dataRecord.inputor;
                                        if (inputor == "{{Session('nama')}}"){
                                            $('#sectionsetoran').show();
                                            $('#sectiontahfid').hide();
                                            $("#setoran_nama").val(dataRecord.nama);
                                            $("#setoran_noinduk").val(dataRecord.noinduk);
                                            $("#setoran_kelas").val(dataRecord.kelas);
                                            $("#setoran_jilid").val(dataRecord.jilid);
                                            $("#setoran_nilai").val(dataRecord.nilai);
                                            $("#setoran_status").val(dataRecord.kelulusan);
                                            $("#setoran_catatan").val(dataRecord.catatan);
                                            $("#setoran_ziyadahsurahawal").val(dataRecord.ziyadah_akhirsurah).select2().trigger('change');
                                            $("#setoran_ziyadahayatawal").val(dataRecord.ziyadah_akhirayat).select2().trigger('change');
                                            $("#setoran_ziyadahsurahakhir").val(dataRecord.ziyadah_akhirsurah).select2().trigger('change');
                                            $("#setoran_ziyadahayatakhir").val(dataRecord.ziyadah_akhirayat).select2().trigger('change');
                                            $("#setoran_msurahawal").val(dataRecord.murojaah_akhirsurah).select2().trigger('change');
                                            $("#setoran_mayatawal").val(dataRecord.murojaah_akhirayat).select2().trigger('change');
                                            $("#setoran_msurahakhir").val(dataRecord.murojaah_akhirsurah).select2().trigger('change');
                                            $("#setoran_mayatakhir").val(dataRecord.murojaah_akhirayat).select2().trigger('change');
                                            $("#setoran_tahsinawal").val(dataRecord.tahsin_akhirsurah).select2().trigger('change');
                                            $("#setoran_tahsinayatawal").val(dataRecord.tahsin_akhirayat).select2().trigger('change');
                                            $("#setoran_tahsinakhir").val(dataRecord.tahsin_akhirsurah).select2().trigger('change');
                                            $("#setoran_tahsinayatakhir").val(dataRecord.tahsin_akhirayat).select2().trigger('change');
                                            $("#setoran_tilawahsurahawal").val(dataRecord.tilawah_akhirsurah).select2().trigger('change');
                                            $("#setoran_tilawahayatawal").val(dataRecord.tilawah_akhirayat).select2().trigger('change');
                                            $("#setoran_tilawahsurahakhir").val(dataRecord.tilawah_akhirsurah).select2().trigger('change');
                                            $("#setoran_tilawahayatakhir").val(dataRecord.tilawah_akhirayat).select2().trigger('change');
                                        } else {
                                            swal({
                                                title	: 'Access Denied',
                                                text	: 'Data ini hanya boleh di ubah oleh '+inputor,
                                                type	: 'error',
                                            })
                                        }
                                    }
                                },
                                { text: 'Ustad / Ustadzah', datafield: 'inputor', width: 120, cellsalign: 'left', align: 'center' },
                                { text: 'Tanggal', datafield: 'tanggal', editable: false, width: 100, cellsalign: 'center', align: 'center' },
                                { text: 'Z. Mulai Surah', columngroup: 'kelompok01', datafield: 'ziyadah_mulaisurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                { text: 'Z. Mulah Ayat', columngroup: 'kelompok01', datafield: 'ziyadah_mulaiayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                                { text: 'Z. Sampai Surat', columngroup: 'kelompok01', datafield: 'ziyadah_akhirsurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                { text: 'Z. Sampai Ayat', columngroup: 'kelompok01', datafield: 'ziyadah_akhirayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                                { text: 'Ti Mulai Surah', columngroup: 'kelompok02', datafield: 'tilawah_mulaisurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                { text: 'Ti Mulai Ayat', columngroup: 'kelompok02', datafield: 'tilawah_mulaiayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                                { text: 'Ti Sampai Surah', columngroup: 'kelompok02', datafield: 'tilawah_akhirsurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                { text: 'Ti Sampai Ayat', columngroup: 'kelompok02', datafield: 'tilawah_akhirayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                                { text: 'Ta Mulai Surah', columngroup: 'kelompok03', datafield: 'tahsin_mulaisurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                { text: 'Ta Mulah Ayat', columngroup: 'kelompok03', datafield: 'tahsin_mulaiayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                                { text: 'Ta Sampai Surat', columngroup: 'kelompok03', datafield: 'tahsin_akhirsurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                { text: 'Ta Sampai Ayat', columngroup: 'kelompok03', datafield: 'tahsin_akhirayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                                { text: 'M. Mulai Surah', columngroup: 'kelompok04', datafield: 'murojaah_mulaisurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                { text: 'M. Mulai Ayat', columngroup: 'kelompok04', datafield: 'murojaah_mulaiayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                                { text: 'M. Sampai Surah', columngroup: 'kelompok04', datafield: 'murojaah_akhirsurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                                { text: 'M. Sampai Ayat', columngroup: 'kelompok04', datafield: 'murojaah_akhirayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                                { text: 'Nilai', columngroup: 'kelompok05', datafield: 'nilai', width: 50, cellsalign: 'center', align: 'center' },
                                { text: 'Kelulusan', columngroup: 'kelompok05', datafield: 'kelulusan', filtertype: 'checkedlist', width: 100, cellsalign: 'left', align: 'center' },
                                { text: 'Catatan', columngroup: 'kelompok05', datafield: 'catatan', width: 200, cellsalign: 'center', align: 'center' },
                            ],
                            columngroups: 
                            [
                                { text: 'ZIYADAH', align: 'center', name: 'kelompok01' },
                                { text: 'TILAWAH', align: 'center', name: 'kelompok02' },
                                { text: 'TAHSIN', align: 'center', name: 'kelompok03' },
                                { text: 'MUROJAAH', align: 'center', name: 'kelompok04' },
                                { text: 'Uraian', align: 'center', name: 'kelompok05' },
                            ]
                        });
                    }
                },
                { text: 'Tambah', columntype: 'button', width: 70, align: 'center', cellsrenderer: function () {
                    return "Setoran";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridperkembangansantri").offset();
                        var dataRecord 	= $("#gridperkembangansantri").jqxGrid('getrowdata', editrow);
                        $('#sectionsetoran').show();
                        $('#sectiontahfid').hide();
                        var tanggal	= document.getElementById('mastertgl').value;
                        $("#setoran_nama").val(dataRecord.nama);
                        $("#setoran_noinduk").val(dataRecord.noinduk);
                        $("#setoran_kelas").val(dataRecord.kelas);
                        $("#setoran_jilid").val(dataRecord.jilid);
                        $("#setoran_tanggal").val(tanggal);
                        $("#setoran_nilai").val('');
                        $("#setoran_status").val('');
                        $("#setoran_catatan").val('');
                        $("#setoran_ziyadahsurahawal").val(dataRecord.ziyadah_akhirsurah).select2().trigger('change');
                        $("#setoran_ziyadahayatawal").val(dataRecord.ziyadah_akhirayat).select2().trigger('change');
                        $("#setoran_ziyadahsurahakhir").val(dataRecord.ziyadah_akhirsurah).select2().trigger('change');
                        $("#setoran_ziyadahayatakhir").val(dataRecord.ziyadah_akhirayat).select2().trigger('change');
                        $("#setoran_msurahawal").val(dataRecord.murojaah_akhirsurah).select2().trigger('change');
                        $("#setoran_mayatawal").val(dataRecord.murojaah_akhirayat).select2().trigger('change');
                        $("#setoran_msurahakhir").val(dataRecord.murojaah_akhirsurah).select2().trigger('change');
                        $("#setoran_mayatakhir").val(dataRecord.murojaah_akhirayat).select2().trigger('change');
                        $("#setoran_tahsinawal").val(dataRecord.tahsin_akhirsurah).select2().trigger('change');
                        $("#setoran_tahsinayatawal").val(dataRecord.tahsin_akhirayat).select2().trigger('change');
                        $("#setoran_tahsinakhir").val(dataRecord.tahsin_akhirsurah).select2().trigger('change');
                        $("#setoran_tahsinayatakhir").val(dataRecord.tahsin_akhirayat).select2().trigger('change');
                        $("#setoran_tilawahsurahawal").val(dataRecord.tilawah_akhirsurah).select2().trigger('change');
                        $("#setoran_tilawahayatawal").val(dataRecord.tilawah_akhirayat).select2().trigger('change');
                        $("#setoran_tilawahsurahakhir").val(dataRecord.tilawah_akhirsurah).select2().trigger('change');
                        $("#setoran_tilawahayatakhir").val(dataRecord.tilawah_akhirayat).select2().trigger('change');
                    }
                },
                { text: 'Photo', datafield: 'foto', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                { text: 'Nama', datafield: 'nama', width: 180, cellsalign: 'left', align: 'center' },
                { text: 'Setoran Akhir', datafield: 'tanggal', width: 100, cellsalign: 'center', align: 'center' },
                { text: 'Z. Mulai Surah', columngroup: 'kelompok01', datafield: 'ziyadah_mulaisurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                { text: 'Z. Mulah Ayat', columngroup: 'kelompok01', datafield: 'ziyadah_mulaiayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                { text: 'Z. Sampai Surat', columngroup: 'kelompok01', datafield: 'ziyadah_akhirsurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                { text: 'Z. Sampai Ayat', columngroup: 'kelompok01', datafield: 'ziyadah_akhirayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                { text: 'Ti Mulai Surah', columngroup: 'kelompok02', datafield: 'tilawah_mulaisurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                { text: 'Ti Mulai Ayat', columngroup: 'kelompok02', datafield: 'tilawah_mulaiayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                { text: 'Ti Sampai Surah', columngroup: 'kelompok02', datafield: 'tilawah_akhirsurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                { text: 'Ti Sampai Ayat', columngroup: 'kelompok02', datafield: 'tilawah_akhirayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                { text: 'Ta Mulai Surah', columngroup: 'kelompok03', datafield: 'tahsin_mulaisurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                { text: 'Ta Mulah Ayat', columngroup: 'kelompok03', datafield: 'tahsin_mulaiayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                { text: 'Ta Sampai Surat', columngroup: 'kelompok03', datafield: 'tahsin_akhirsurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                { text: 'Ta Sampai Ayat', columngroup: 'kelompok03', datafield: 'tahsin_akhirayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                { text: 'M. Mulai Surah', columngroup: 'kelompok04', datafield: 'murojaah_mulaisurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                { text: 'M. Mulai Ayat', columngroup: 'kelompok04', datafield: 'murojaah_mulaiayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
                { text: 'M. Sampai Surah', columngroup: 'kelompok04', datafield: 'murojaah_akhirsurah', editable: false, filterable: false, width: 90, cellsalign: 'left', align: 'center' },
                { text: 'M. Sampai Ayat', columngroup: 'kelompok04', datafield: 'murojaah_akhirayat', editable: false, filterable: false, width: 50, cellsalign: 'center', align: 'center' },
            ],
            columngroups: 
            [
                { text: 'ZIYADAH', align: 'center', name: 'kelompok01' },
                { text: 'TILAWAH', align: 'center', name: 'kelompok02' },
                { text: 'TAHSIN', align: 'center', name: 'kelompok03' },
                { text: 'MUROJAAH', align: 'center', name: 'kelompok04' },
            ]
        });
    }
    $(document).ready(function () {
        var token = document.getElementById('token').value;
        openedpage();
        $('#sectionsetoran').hide();
        $('#sectionmushaf').hide();
        $('.btnkembali').click(function () {
            $('#sectionsetoran').hide();
            $('#sectionmushaf').hide();
            $('#sectiontahfid').hide();
            $('#sectionsetting').show();
            $('#sectionkerja').show();
            $('#gridlogaktifitas').show();
            $('#datanilai').show();
            $('#lebokpenilaian').hide();
            $('#leboknoabsen').hide();
            $('#divabsen').hide();
            $('#divgriddetailpresensi').hide();
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });
        $('#btnkembalidarisetoran').click(function () {
            $('#sectionsetoran').hide();
            $('#sectiontahfid').show();
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });
        $('#btnopenmushaf').click(function () {
            $('#sectiontahfid').hide();
            $('#sectionmushaf').show();
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });
        $('#btnclosedetailnilai').click(function () {
            $('#datarinciannnilai').hide();
            $('#datanilai').show();
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });
        $('#btnclosedetail').click(function () {
            $('#divabsen').show();
            $('#divgriddetailpresensi').hide();
            $("#gridpresensi").jqxGrid("updatebounddata");
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });
        $('.btnkembalidrabsen').click(function () {
            $('#leboknoabsen').hide();
            $('#datanilai').show();
            $('#divabsen').show();
            $('#divgriddetailpresensi').hide();
            $("#gridpresensi").jqxGrid("updatebounddata");
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });
        $('#btntambahpresensi').click(function () {
            $('#datanilai').hide();
            $('#datarinciannnilai').hide();
            $('#lebokpenilaian').hide();
            $('#leboknoabsen').show();
        });
        $('#topbtnuts').click(function () {
            $('#datanilai').hide();
            $('#datarinciannnilai').hide();
            $('#lebokpenilaian').show();
            $('#leboknoabsen').hide();
            $("#nilai_jenis").val('PTS');
        });
        $('#topbtnuas').click(function () {
            $('#datanilai').hide();
            $('#datarinciannnilai').hide();
            $('#lebokpenilaian').show();
            $('#leboknoabsen').hide();
            $("#nilai_jenis").val('PAS');
        });
        $('#btnperbesar').click(function () {
            $('#sectionsetting').hide();
            $('#sectionkerja').removeClass('col-lg-9').addClass('col-lg-12');
            $("#gridlogaktifitas").jqxGrid("updatebounddata");
        });
        $('#btnboxrefresh1').click(function () {
            var uri = window.location.href.split("#")[0];
            window.location=uri
        });
        $('.btnexport').click(function () {
            var gridContent = $("#gridnilai").jqxGrid('exportdata', 'json');
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
        $('#btnsimpansetoran').click(function () {
            var set01=CKEDITOR.instances['setoran_adab'].getData()
			var set02=CKEDITOR.instances['setoran_fiqih'].getData()
			var set03=CKEDITOR.instances['setoran_akidah'].getData()
			var set04=CKEDITOR.instances['setoran_lifeskil'].getData()
            var formdata = new FormData($('#formtambahsetoran')[0]);
                formdata.set('val01',set01);
                formdata.set('val02',set02);
                formdata.set('val03',set03);
                formdata.set('val04',set04);
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
                    $("#gridperkembangansantri").jqxGrid('updatebounddata');
                    $("#griddetailperkembangansantri").jqxGrid('updatebounddata');
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
        
    });
</script>
@endpush