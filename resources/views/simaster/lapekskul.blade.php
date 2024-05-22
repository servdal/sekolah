@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">  Laporan Ekstrakulikuler</h1>
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
                    <div id="message"></div>
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Tabel</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridekskul"></div>
						</div>
                    </div>
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-users"></i> Report Perkelas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group input-group-sm">
                                <select id="id_kelas" size="1" class="form-control select2">
                                    <option value="">Pilih Kelas</option>
                                    @if (isset($jkelas) AND !empty($jkelas))
                                        @foreach($jkelas as $rkelas)
                                            <option value="{{ $rkelas['klspos'] }}">{{ $rkelas['klspos'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="input-group-append">
                                    <div class="btn btn-primary" id="btnlihatperkelas">
                                        <i class="fa fa-search"></i>
                                    </div>
                                </div>
                            </div>
						</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Workarea</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" id="saveexcel"><i class="fa fa-file-excel-o"></i></button>
						        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridreport"></div>
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
@endsection
@push('script')
<script>
    $(document).ready(function () {
        $("#saveexcel").click(function () {
            var gridContent = $("#gridreport").jqxGrid('exportdata', 'json');
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
        $("#btnlihatperkelas").click(function () {
            var set01=document.getElementById('id_kelas').value;
            var token=document.getElementById('token').value;
            var sourcerincianharian = {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'kelas', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'eksul1', type: 'text'},
                    { name: 'eksul2', type: 'text'},
                    { name: 'eksul3', type: 'text'},
                    { name: 'eksul4', type: 'text'},
                    { name: 'eksul5', type: 'text'},
                    { name: 'nama', type: 'text'},
                ],
                type: 'POST',
                data: {	val01: set01, _token:token },
                url: "json/setkeuangan"
            };
            var datarincianharian = new $.jqx.dataAdapter(sourcerincianharian);
            $("#gridreport").jqxGrid({
                width: '100%',
                source: datarincianharian,
                autoheight: true,
                theme: "energyblue",
                columnsresize: true,
                selectionmode: 'multiplecellsextended',
                columns: [
                    { text: 'Nama', datafield: 'nama', width: '15%', cellsalign: 'left', align: 'center' },
                    { text: 'NIS', datafield: 'noinduk', width: '5%', cellsalign: 'center', align: 'center' },
                    { text: 'Kelas', datafield: 'kelas', width: '5%', cellsalign: 'center', align: 'center' },
                    { text: 'Ekskul 1', datafield: 'eksul1', width: '15%', align: 'center' },
                    { text: 'Ekskul 2', datafield: 'eksul2', width: '15%', align: 'center' },
                    { text: 'Ekskul 3', datafield: 'eksul3', width: '15%', align: 'center' },
                    { text: 'Ekskul 4', datafield: 'eksul4', width: '15%', align: 'center' },
                    { text: 'Ekskul 5', datafield: 'eksul5', width: '15%', align: 'center' },
                ]
            });
        });
        var sourceeksul = {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'namaeksul', type: 'text'},
                { name: 'biaya', type: 'text'},
                { name: 'peminat', type: 'text'},
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
                { text: 'Peminat', datafield: 'peminat', width: '30%', align: 'center', cellsalign: 'left'},
                { text: 'Detail', columntype: 'button', width: '20%', align: 'center', cellsrenderer: function () {
                    return "Detail";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridekskul").offset();
                        var dataRecord 	= $("#gridekskul").jqxGrid('getrowdata', editrow);
                        var goook		= dataRecord.id;
                        var token		= document.getElementById('token').value;
                        var sourcerincianharian ={
                            datatype: "json",
                            datafields: [
                                { name: 'id',type: 'text'},	
                                { name: 'no'},
                                { name: 'nama',type: 'text'},
                                { name: 'noinduk',type: 'text'},
                                { name: 'kelas',type: 'text'},
                            ],
                            type: 'POST',
                            data: {	val01:goook, _token: token },
                            url: 'json/rincianekskul',
                        };

                        var datarincianharian = new $.jqx.dataAdapter(sourcerincianharian);
                        $("#gridreport").jqxGrid({
                            width: '100%',									
                            source: datarincianharian,
                            autoheight: true,
                            theme: "orange",										
                            columnsresize: true,
                            selectionmode: 'multiplecellsextended',
                            columns: [
                                { text: 'No', datafield: 'no', width: '5%', align: 'center', cellsalign: 'center'},
                                { text: 'Nama', datafield: 'nama', width: '55%', align: 'center' },
                                { text: 'No.Induk', datafield: 'noinduk', width: '20%', align: 'center' },
                                { text: 'Kelas', datafield: 'kelas', width: '20%', align: 'center' },
                            ]
                        });						 
                    }
                },
            ]
        });
    });
</script>
@endpush