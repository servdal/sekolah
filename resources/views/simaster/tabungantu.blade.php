@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-7">
                    <h1 class="m-0"> TABUNGAN</h1>
                </div>
                <div class="col-sm-5">
                    <div class="btn-group">
                        <a class="btn btn-app btn-primary" href="{{url('/')}}/lapbayar" data-bs-toggle="tooltip" data-bs-placement="top" title="Seragam, Kegiatan, Peralatan, Buku, SPP, Ekskul, Makan"><i class="fa fa-calculator"></i> SPP</a>
                        <a class="btn btn-app btn-success" href="{{url('/')}}/datakeuhptmasuk" data-bs-toggle="tooltip" data-bs-placement="top" title="Keuangan Sekolah"><i class="fa fa-pencil"></i> Sekolah</a>
                        <a class="btn btn-app btn-info" href="{{url('/')}}/lapamil" data-bs-toggle="tooltip" data-bs-placement="top" title="Zakat, Infaq dan Sedekah"><i class="fa fa-bank"></i> Lazis</a>
                        <a class="btn btn-app btn-warning" href="{{url('/')}}/laptabungan" data-bs-toggle="tooltip" data-bs-placement="top" title="Tabungan"><i class="fa fa-book"></i> Tabungan</a>
                        <a class="btn btn-app btn-danger" href="{{url('/')}}/laporankeuhpt" data-bs-toggle="tooltip" data-bs-placement="top" title="Laporan Keuangan"><i class="fa fa-file-excel-o"></i> Laporan</a>
                    </div>
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
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Lihat Tabungan Persiswa</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <select id="id_nis" name="id_nis" class="form-control select2" >
                                        <option value="">Pilih salah satu</option>
                                        @foreach($datasiswa as $rsiswa)
                                            <option value="{{ $rsiswa['noinduk'] }}">{{ $rsiswa['nama'] }} ( {{ $rsiswa['klspos'] }} No. Induk {{ $rsiswa['noinduk'] }} )</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <button class="btn btn-info btn-flat" type="button" id="caritabungan" name="caritabungan">Go!</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-info" id="downexcell">Export Excell Hasilnya</button>
							<button type="button" class="btn btn-danger" id="btntmhtabungan">Input Tabungan Siswa</button>
                        </div>
                    </div>
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Laporan Harian</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">  
                                <div class="row">			  
                                    <div class="input-group margin">
                                        <input type="text" class="form-control" placeholder="Tanggal" id="id_tglcari" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-flat" type="button" id="btnlihatlapharian">Tampilkan</button>
                                        </span>
                                    </div>
                                </div>	
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-danger shadow" id="laporantabungan">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-money"></i> Laporan Tabungan</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btnsegarkan"><i class="fa fa-refresh"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridtabungansiswa"></div>
						</div>
                        <div class="card-footer">
                            <div id="gridtabunganpersiswa"></div>
                        </div>
                    </div>
                    <div class="card card-danger shadow" id="tambahtabungan">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-users"></i> Daftar Siswa</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btnkembali"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridsiswaaktif"></div>
						</div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalnabung">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Menabung</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group"> 
                    <label>Pilih Nama Siswa</label>
                    <input type="text" id="id_nama" name="id_nama" class="form-control"  disabled="disable">
                </div>	
                <div class="form-group"> 
                    <label>Sebanyak (Rupiah)</label>
                    <input type="text" id="id_tabung" name="id_tabung" class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="id_siswa" >
                <button type="button" class="btn btn-info" id="tabungkan">Simpan</button>
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalnarik">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Menarik Tabungan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group"> 
                    <label>Pilih Nama Siswa</label>
                    <input type="text" id="id_nama2" name="id_nama2" class="form-control" disabled="disable">
                </div>		  
                <div class="form-group"> 
                    <label>Diambil Sebanyak (Rupiah)</label>
                    <input type="text" id="id_tarik" name="id_tarik" class="form-control">
                </div>
                <div class="form-group"> 
                    <label>Keperluan</label>
                    <input type="text" id="id_perlu" name="id_perlu" class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="id_siswa2" >
                <button type="button" class="btn btn-danger" id="tarikan">Simpan</button>
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="getnama" id="getnama" value="{{Session('nama')}}">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="makhir" id="makhir" value="now">
@endsection
@push('script')
<script>
	$(function () {
		$('#id_tglcari').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
    $(document).ready(function () {
        var token=document.getElementById('token').value;	
        $('.overlay').hide();
        $('#tambahtabungan').hide();
        $('#gridtabunganpersiswa').show();
        $("#id_tabung").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#id_tarik").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $('#downexcell').click(function(){
            var gridContent = $("#gridtabunganpersiswa").jqxGrid('exportdata', 'json');
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
        $("#btnkembali").click(function () {
            $('#gridtabunganpersiswa').hide();
            $('#laporantabungan').show(); 
            $('#tambahtabungan').hide();	
            $('#gridtabungansiswa').show();
            $("#gridtabungansiswa").jqxGrid("updatebounddata");
        });
        $("#btnsegarkan").click(function () {
            $('#gridtabunganpersiswa').hide();
            $('#laporantabungan').show(); 
            $('#tambahtabungan').hide();	
            $('#gridtabungansiswa').show();
            $("#gridtabungansiswa").jqxGrid("updatebounddata");
        });
        $('#btnlihatlapharian').click(function () {
            $('#tambahtabungan').hide();
            $('#laporantabungan').show();
            $('#gridtabunganpersiswa').show();
            $('#gridtabungansiswa').hide();	
            var set01	= document.getElementById('id_tglcari').value;
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id',type: 'text'},	
                    { name: 'nama',type: 'text'},
                    { name: 'noinduk',type: 'text'},
                    { name: 'debet',type: 'text'},	
                    { name: 'kredit',type: 'text'},
                    { name: 'keterangan',type: 'text'},
                    { name: 'verified',type: 'text'},
                    { name: 'marking',type: 'text'},
                    { name: 'kelas',type: 'text'},
                    { name: 'inputor',type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token },
                url: "json/laptabunganharian"
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#gridtabunganpersiswa").jqxGrid({
                width: '100%',
                filterable: true,
                columnsresize: true,
                autoheight: true,
                source: dataAdapter,
                altrows: true,		
                theme: "orange",
                selectionmode: 'singlecell',
                columns: [			
                    { text: 'Tanggal', datafield: 'marking', width: '10%', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '25%', align: 'center' },
                    { text: 'Kelas', datafield: 'kelas', width: '5%', align: 'center' },
                    { text: 'Debit', datafield: 'debet', width: '10%', cellsalign: 'right', align: 'center'},
                    { text: 'Kredit', datafield: 'kredit', width: '10%', cellsalign: 'right', align: 'center'},		
                    { text: 'Keterangan', datafield: 'keterangan', width: '20%', cellsalign: 'right', align: 'center' },	
                    { text: 'Verifikasi TU', datafield: 'verified', width: '10%', cellsalign: 'right', align: 'center' },
                    { text: 'Inputor', datafield: 'inputor', width: '10%', cellsalign: 'right', align: 'center' },
                ]
            });
        });
        $('#caritabungan').click(function () {
            $('#tambahtabungan').hide();
            $('#laporantabungan').show();
            $('#gridtabunganpersiswa').show();
            $('#gridtabungansiswa').hide();
        
            var set01	= document.getElementById('id_nis').value;	
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id',type: 'text'},	
                    { name: 'nama',type: 'text'},
                    { name: 'noinduk',type: 'text'},
                    { name: 'debet',type: 'text'},	
                    { name: 'kredit',type: 'text'},
                    { name: 'keterangan',type: 'text'},
                    { name: 'verified',type: 'text'},
                    { name: 'marking',type: 'text'},
                    { name: 'kelas',type: 'text'},
                    { name: 'inputor',type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token },
                url: "json/caritabungan"
            };

            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#gridtabunganpersiswa").jqxGrid({
                width: '100%',
                filterable: true,
                columnsresize: true,
                autoheight: true,
                source: dataAdapter,
                altrows: true,		
                selectionmode: 'singlecell',
                columns: [			
                    { text: 'Tanggal', datafield: 'marking', width: '10%', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '25%', align: 'center' },
                    { text: 'Kelas', datafield: 'kelas', width: '5%', align: 'center' },
                    { text: 'Debit', datafield: 'debet', width: '10%', cellsalign: 'right', align: 'center'},
                    { text: 'Kredit', datafield: 'kredit', width: '10%', cellsalign: 'right', align: 'center'},		
                    { text: 'Keterangan', datafield: 'keterangan', width: '20%', cellsalign: 'right', align: 'center' },	
                    { text: 'Verifikasi TU', datafield: 'verified', width: '10%', cellsalign: 'right', align: 'center' },
                    { text: 'Inputor', datafield: 'inputor', width: '10%', cellsalign: 'right', align: 'center' },
                ]
            });
        });
        $('#tarikan').on('click', function (){
            var set01=document.getElementById('id_siswa2').value;
            var set02=document.getElementById('id_tarik').value;
            var set03=document.getElementById('id_perlu').value;
            var set06=document.getElementById('getnama').value;
            if (set03 == ''){
                swal({
                    title: 'Stop',
                    text: 'Keperluan Pengambilan Tabungan Wajib di Isi',
                    type: 'warning',
                })	
            } else if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Nominal Pengambilan Tabungan Wajib di Isi',
                    type: 'warning',
                })	
            } else {
                $.post('admin/tabung', { val01: set01, val02: set02, val03: set03, val04: 'tarik', val05: '', val06: set06, _token: token },
                function(data){	
                    $('#laporantabungan').show(); 
                    $('#tambahtabungan').hide();
                    $('#gridtabunganpersiswa').show();
                    $("#modalnarik").modal('hide');
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#status').html(data);
                    $("#gridtabungansiswa").jqxGrid("updatebounddata");
                });
            }
        });
        $('#tabungkan').on('click', function (){
            var set01=document.getElementById('id_siswa').value;
            var set02=document.getElementById('id_tabung').value;
            var set06=document.getElementById('getnama').value;
            if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Nominal Tabungan Wajib di Isi',
                    type: 'warning',
                })	
            } else {
                $.post('admin/tabung', { val01: set01, val02: set02, val03: '', val04: 'tabung', val05: '', val06: set06, _token: token },
                function(data){	
                    $('#laporantabungan').show(); 
                    $('#tambahtabungan').hide();
                    $('#gridtabunganpersiswa').show();
                    $("#modalnabung").modal('hide');
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#status').html(data);
                    $("#gridtabungansiswa").jqxGrid("updatebounddata");
                });
            }
        });
        $('#btntmhtabungan').click(function () {
            var set01	= 'all';
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: "json/setkeuangan"
            };		
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#laporantabungan').hide(); 
            $('#tambahtabungan').show(); 
            $("#gridsiswaaktif").jqxGrid({
                width: '100%',
                showfilterrow: true,
                filterable: true,
                columnsresize: true,
                autoshowfiltericon: true,
                pageable: true,
                autoheight: true,
                theme: "energyblue",
                source: dataAdapter,
                selectionmode: 'multiplecellsextended',
                columns: [
                    { text: 'No.Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '60%', cellsalign: 'left', align: 'center' },
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },			
                    { text: 'Menabung', columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Tabung";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridsiswaaktif").offset();
                            var dataRecord 	= $("#gridsiswaaktif").jqxGrid('getrowdata', editrow);
                            $("#id_nama").val(dataRecord.nama);
                            $("#id_siswa").val(dataRecord.noinduk);
                            $("#modalnabung").modal('show');	
                        }
                    },
                    { text: 'Menarik Tabungan', columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Tarik";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridsiswaaktif").offset();
                            var dataRecord 	= $("#gridsiswaaktif").jqxGrid('getrowdata', editrow);
                            $("#id_nama2").val(dataRecord.nama);
                            $("#id_siswa2").val(dataRecord.noinduk);
                            $("#modalnarik").modal('show');
                        }
                    },
                ]
            });		
        });
        var sourcetabungan = {
            datatype: "json",
            datafields: [
                { name: 'id',type: 'text'},	
                { name: 'nama',type: 'text'},
                { name: 'noinduk',type: 'text'},
                { name: 'debet',type: 'text'},	
                { name: 'kredit',type: 'text'},
                { name: 'keterangan',type: 'text'},
                { name: 'verified',type: 'text'},
                { name: 'marking',type: 'text'},
                { name: 'kelas',type: 'text'},
                { name: 'inputor',type: 'text'},
            ],
            url: 'json/tabungan',
            cache: false,
        };
        var datatabungan = new $.jqx.dataAdapter(sourcetabungan);
        $("#gridtabungansiswa").jqxGrid({
            width: '100%',   
            columnsresize: true,
            theme: "energyblue",
            source: datatabungan,
            autoheight: true,
            selectionmode: 'multiplecellsextended',
            columns: [		
                { text: 'Tanggal', datafield: 'marking', width: '10%', align: 'center' },
                { text: 'Nama', datafield: 'nama', width: '25%', align: 'center' },
                { text: 'Kelas', datafield: 'kelas', width: '5%', align: 'center' },
                { text: 'Debit', datafield: 'debet', width: '10%', cellsalign: 'right', align: 'center' },
                { text: 'Kredit', datafield: 'kredit', width: '10%', cellsalign: 'right', align: 'center' },		
                { text: 'Keterangan', datafield: 'keterangan', width: '15%', cellsalign: 'right', align: 'center' },
                { text: 'Inputor', datafield: 'inputor', width: '10%', cellsalign: 'right', align: 'center' },
                { text: 'Verified', columntype: 'button', width: '8%', cellsrenderer: function () {
                    return "Verified";
                    }, buttonclick: function (row) {	
                    editrow = row;	
                    var offset 		= $("#gridtabungansiswa").offset();		
                    var dataRecord 	= $("#gridtabungansiswa").jqxGrid('getrowdata', editrow);
                    var set01		= dataRecord.id;
                    var set02		= 'verified';
                    var set03		= document.getElementById('getnama').value;	
                    $.post('admin/tabung', { val01: set01, val02: '', val03: '', val04: set02, val05: set03, val06: '', _token: token },
                    function(data){	
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $('#status').html(data);
                        $("#gridtabungansiswa").jqxGrid("updatebounddata");
                    });
                    }
                },
                { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
                    return "Del";
                    }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridtabungansiswa").offset();		
                        var dataRecord 	= $("#gridtabungansiswa").jqxGrid('getrowdata', editrow);
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
                            var set02		= 'batal';
                            var set03		= document.getElementById('getnama').value;
                            $.post('admin/tabung', { val01: set01, val02: '', val03: '', val04: set02, val05: set03, val06: '', _token: token },
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
                                    $("#gridtabungansiswa").jqxGrid('updatebounddata');
                                    return false;
                            });
                        });
                    }
                },
            ],
        });
    });
</script>
@endpush