@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Setting Program Indonesia Pintar</h1>
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
            <div class="row" id="divutama">
                <div class="col-md-4">
                    <div id="status" class="status"></div>
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Komponen</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="#" id="btntambah"  class="btn btn-block btn-social btn-bitbucket">
								<i class="fa fa-windows"></i> Tambah Data Baru
							</a>
                        </div>
                        <div class="card-footer" id="divtambahdata">
                            <div class="form-group">
                                <label for="id_datamasuk">Data Masuk</label>
                                <input type="text" class="form-control" id="id_datamasuk">
                            </div>
                            <div class="form-group">
                                <label for="id_nama">Nama Siswa</label>
                                <input type="text" class="form-control" id="id_nama">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="id_kelaslama">Kls.Lama</label>
                                        <input type="text" class="form-control" id="id_kelaslama">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="id_kelasbaru">Kls.Baru</label>
                                        <input type="text" class="form-control" id="id_kelasbaru">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="id_tahap">THP/THN</label>
                                        <input type="text" class="form-control" id="id_tahap">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_norek">No. Rekening</label>
                                <input type="text" class="form-control" id="id_norek">
                            </div>
                            <div class="form-group">
                                <label for="id_virtual">Virtual Acc</label>
                                <input type="text" class="form-control" id="id_virtual">
                            </div>
                            <div class="form-group">
                                <label for="id_keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="id_keterangan">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="#" id="btncanceltambah"  class="btn btn-block btn-social btn-danger">
                                            <i class="fa fa-close"></i> Cancel
                                        </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="hidden" class="form-control" id="id_idne">
                                        <a href="#" id="btnsimpan"  class="btn btn-block btn-social btn-success">
                                            <i class="fa fa-database"></i> Simpan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				<div class="col-md-8">
                	<div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Data PIP</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" id="btnexport"><i class="fa fa-file-excel-o"></i></button>
						        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="status"></div>
						    <div id="gridpenerima"></div>
                        </div>
                    </div>
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Hadir Viewer PIP</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" id="btnexport2"><i class="fa fa-file-excel-o"></i></button>
						        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">			  
                                    <div class="col-lg-3">
                                        <label for="set_mulai">Mulai</label>
                                        <input type="text" class="form-control" id="set_mulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
                                    </div>			 
                                    <div class="col-lg-3">
                                        <label for="set_akhir">Sampai</label>
                                        <input type="text" class="form-control" id="set_akhir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
                                    </div>
                                    <div class="col-lg-3">
                                        <a href="#" id="btnviewabsen"  class="btn btn-block btn-social btn-bitbucket">
                                            <i class="fa fa-search"></i> View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="gridhadir"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script>
    $(function () {
		$('#set_mulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#set_akhir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
    $(document).ready(function () {
        var token = document.getElementById('token').value;
        $('#divtambahdata').hide();
        $('#btntambah').click(function () {	
            $("#id_idne").val('new');
            $("#id_nama").val('');
            $("#id_norek").val('');
            $("#id_virtual").val('');
            $("#id_keterangan").val('');
            $('#divtambahdata').show();
        });
        $('#btncanceltambah').click(function () {	
            $("#id_idne").val('new');
            $("#id_nama").val('');
            $("#id_norek").val('');
            $("#id_keterangan").val('');
            $('#divtambahdata').hide();
            $("html, body").animate({ scrollTop: 0 }, "slow");		
        });
        $('#btnsimpan').click(function () {
            var set01=document.getElementById('id_idne').value;
            var set02=document.getElementById('id_datamasuk').value;
            var set03=document.getElementById('id_nama').value;
            var set04=document.getElementById('id_kelaslama').value;
            var set05=document.getElementById('id_kelasbaru').value;
            var set06=document.getElementById('id_tahap').value;
            var set07=document.getElementById('id_norek').value;
            var set08=document.getElementById('id_virtual').value;
            var set09=document.getElementById('id_keterangan').value;
            if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set06 == '' || set07 == '' || set08 == ''){
                swal({
                    title: 'Stop',
                    text: 'Lengkapi Isian Terlebih Dahulu, Apabila ada data kosong mohon diberi tanda strip (-)',
                    type: 'warning',
                })
            } else {
                $.post('admin/exsimpandatapip', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, _token: token },
                function(data){	
                    $('#divtambahdata').hide();
                    $("#gridpenerima").jqxGrid("updatebounddata");		
                    $('.status').html(data);
                    $("html, body").animate({ scrollTop: 0 }, "slow");		
                    return false;
                });
            }
        });
        $('#btnviewabsen').click(function () {	
            var set01=document.getElementById('set_mulai').value;
            var set02=document.getElementById('set_akhir').value;
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'id', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'nama', type: 'text'},
                    { name: 'tanggal', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, _token: token},
                url: "admin/jsonpresensipipview"
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#gridhadir").jqxGrid({
                width: '100%',
                filterable: true,
                pageable: true,
                filtermode: 'excel',
                autorowheight: true,
                source: dataAdapter,
                columnsresize: true,
                theme: "energyblue",
                selectionmode: 'multiplecellsextended',
                columns: [				
                    { text: 'Nama', datafield: 'nama', width: '50%', cellsalign: 'left', align: 'center'},
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Tanggal', datafield: 'tanggal', width: '40%', cellsalign: 'left', align: 'center' },
                ]
            });		
        });
        var source = {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'idsekolah', type: 'text'},
                { name: 'datamasuk', type: 'text'},
                { name: 'nama', type: 'text'},
                { name: 'kelaslama', type: 'text'},
                { name: 'kelasbaru', type: 'text'},
                { name: 'tahap', type: 'text'},
                { name: 'norek', type: 'text'},	
                { name: 'virtualacc', type: 'text'},
                { name: 'keterangan', type: 'text'},
                { name: 'created_by', type: 'text'},
            ],
            url: 'json/dataprogrampip',
            cache: false
        };		
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#gridpenerima").jqxGrid({
            width: '100%',
            filterable: true,
            pageable: true,
            filtermode: 'excel',
            autorowheight: true,
            source: dataAdapter,
            columnsresize: true,
            theme: "energyblue",
            selectionmode: 'multiplecellsextended',
            columns: [				
                { text: 'UBAH', columntype: 'button', align: 'center', width: '8%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {	
                    editrow = row;	
                    var offset 		= $("#gridpenerima").offset();					
                    var dataRecord 	= $("#gridpenerima").jqxGrid('getrowdata', editrow);						
                        $("#id_idne").val(dataRecord.id);
                        $("#id_nama").val(dataRecord.nama);
                        $("#id_norek").val(dataRecord.norek);
                        $("#id_keterangan").val(dataRecord.keterangan);
                        $("#id_kelaslama").val(dataRecord.kelaslama);
                        $("#id_kelasbaru").val(dataRecord.kelasbaru);
                        $("#id_tahap").val(dataRecord.tahap);
                        $('#divtambahdata').show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");	
                    }
                },
                { text: 'Data Masuk', datafield: 'datamasuk', width: '25%', cellsalign: 'left', align: 'center' },
                { text: 'Nama', datafield: 'nama', width: '38%', cellsalign: 'left', align: 'center'},
                { text: 'Kelas Lama', datafield: 'kelaslama', width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'Kelas Baru', datafield: 'kelasbaru', width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'THP/THN', datafield: 'tahap', width: '15%', cellsalign: 'center', align: 'center' },				
                { text: 'No. Rekeing', datafield: 'norek', width: '20%', cellsalign: 'left', align: 'center' },				
                { text: 'Virtual Acc', datafield: 'virtualacc', width: '20%', cellsalign: 'left', align: 'center' },				
                { text: 'Keterangan', datafield: 'keterangan', width: '32%', cellsalign: 'left', align: 'center' },
                { text: 'Inputor', datafield: 'created_by', width: '32%', cellsalign: 'left', align: 'center' },
                { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
                    return "Del";
                    }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridpenerima").offset();
                        var dataRecord 	= $("#gridpenerima").jqxGrid('getrowdata', editrow);
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
                            var set02		= 'db_programpip';
                            var set03		= '';
                            var token		= document.getElementById('token').value;
                            $.post('admin/destroyer', { val01: set01, val02: set02, val03: '', _token: token }, function(data){					
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
                                $("#gridpenerima").jqxGrid('updatebounddata');
                                return false;
                            });
                        });
                    }
                },
            ]
        });
        $('#btnexport').click(function(){
            var gridContent = $("#gridpenerima").jqxGrid('exportdata', 'json');
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
        $('#btnexport2').click(function(){
            var gridContent = $("#gridhadir").jqxGrid('exportdata', 'json');
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
    });
</script>
@endpush