@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Rakapitulasi Kehadiran Siswa Bulanan</h1>
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
                <div class="col-md-12">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> View Berdasarkan Bulan dan Tahun</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pilih Bulan dan Tahun</label>
                                        <select id="val_blnthn" name="val_blnthn" class="form-control" >
                                            <option value=""></option>
                                            @if(isset($listbulan) && !empty($listbulan))
                                                @foreach($listbulan as $rkom)
                                                    <option value="{{ $rkom['year'] }}-{{ $rkom['month'] }}">{{ $rkom['month'] }} {{ $rkom['year'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2"><button type="button" class="btn btn-success" id="btnviewlaporan">View</button></div>
                                <div class="col-md-2"><button type="button" class="btn btn-danger" id="btnexport">Export</button></div>
                            </div>
						</div>
                        <div class="card-footer">
                            <div id="griddatacari"></div>
					    </div>
                        <div id="tempatctk" style="overflow: hidden; display: none;">
                            <div id="tabel_cetak"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</section>
</div>
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#btnviewlaporan').click(function () {
            var bulan        = document.getElementById('val_blnthn').value;
            if (bulan == ''){
                swal({
                    title   : 'Stop',
                    text    : 'Mohon Pilih Bulan dan Tahunnya',
                    type    : 'warning',
                })
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData();
                    formdata.set('val02',bulan);
                    formdata.set('val01','carirekappresensiperbulan');
                    formdata.set('_token', '{{ csrf_token() }}');
                url='{{ route("jsonCariDatainduk") }}';
                $.ajax({
                    type        : 'ajax',
                    url         : url,
                    method      : 'post',
                    data        : formdata,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    dataType    : 'json',
                    success: function(response, status, xhr) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        var source    = {
                            datatype: "json",
                            datafields: [
                                { name: 'id' },
                                { name: 'nomor', type: 'string' },
                                { name: 'nama', type: 'string' },
                                { name: 'klspos', type: 'string' },
                                { name: 'noinduk', type: 'string' },
                                { name: 'nisn', type: 'string' },
                                { name: 'sakit', type: 'string' },
                                { name: 'ijin', type: 'string' },
                                { name: 'alpha', type: 'string' },
                                { name: 'hadir', type: 'string' },
                                { name: 'valcari', type: 'string' }
                            ],
                            localData	: response.data
                        };
                        var datajson = new $.jqx.dataAdapter(source);
                        $("#griddatacari").jqxGrid({
                            width           : '100%',
                            pageable        : true,
                            autoheight      : true,
                            filterable      : true,
                            showfilterrow   : true,
                            columnsresize   : true,
                            source          : datajson,
                            sortable        : true,
                            altrows         : true,
                            theme           : "energyblue",
                            columns         : [
                                { text: 'No', editable: false, sortable: false, filterable: false, datafield: 'nomor', width: '5%', cellsalign: 'left', align: 'center'  },
                                { text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'  },
                                { text: 'Kelas', datafield: 'klspos', width: '7%', cellsalign: 'left', align: 'center'  },
                                { text: 'NIS', datafield: 'noinduk', width: '10%', cellsalign: 'left', align: 'center'  },
                                { text: 'NISN', datafield: 'nisn', width: '10%', cellsalign: 'left', align: 'center' },
                                { text: 'Sakit', columngroup: 'bulan', datafield: 'sakit', width: '10%', cellsalign: 'center', align: 'center' },
                                { text: 'Ijin', columngroup: 'bulan', datafield: 'ijin', width: '10%', cellsalign: 'center', align: 'center' },
                                { text: 'Alpha', columngroup: 'bulan', datafield: 'alpha', width: '10%', cellsalign: 'center', align: 'center' },
                                { text: 'Hadir', columngroup: 'bulan', datafield: 'hadir', width: '10%', cellsalign: 'center', align: 'center' },
                                { text: 'Detail', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '8%', cellsrenderer: function () {
                                    return "View";
                                    }, buttonclick: function (row) {
                                        editrow         = row;
                                        var offset 		= $("#griddatacari").offset();
                                        var dataRecord 	= $("#griddatacari").jqxGrid('getrowdata', editrow);
                                        var formdata = new FormData();
                                            formdata.set('val03',dataRecord.valcari);
                                            formdata.set('val02',dataRecord.noinduk);
                                            formdata.set('val01','cetakrekappresensiperbulan');
                                            formdata.set('_token', '{{ csrf_token() }}');
                                        url='{{ route("jsonCariDatainduk") }}';
                                        $.ajax({
                                            type        : 'ajax',
                                            url         : url,
                                            method      : 'post',
                                            data        : formdata,
                                            cache       : false,
                                            contentType : false,
                                            processData : false,
                                            dataType    : 'json',
                                            success: function(response, status, xhr) {
                                                var datacari = response.data;
                                                var newWindow   = window.open('', '', 'width=800, height=500'),
                                                    document    = newWindow.document.open(),
                                                    pageContent =
                                                        '<!DOCTYPE html>\n' +
                                                        '<html>\n' +
                                                        '<head>\n' +
                                                        '<meta charset="utf-8" />\n' +
                                                        '<title>Laporan Kehadiran an. '+dataRecord.nama+' Pada '+dataRecord.valcari+'</title>\n' +
                                                        '</head>\n' +
                                                        '<body>' + datacari + '</body>\n</html>';
                                                    document.write(pageContent);
                                                    document.close();
                                                    //newWindow.print();
                                                return false;
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                                swal({
                                                    title: textStatus,
                                                    text:  jqXHR.responseText,
                                                    type: 'info',
                                                });
                                            }
                                        });
                                    }
                                },
                            ],
                            columngroups:
                            [
                                { text: bulan, align: 'center', name: 'bulan' }                 
                            ]
                        });
                        return false;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title: textStatus,
                            text:  jqXHR.responseText,
                            type: 'info',
                        });
                    }
                });
            }
        });
        $('#btnexport').click(function () {
            var set01   = document.getElementById('val_blnthn').value;
            if (set01 == '' || set01 == null){
                swal({
                    title	: 'Warning',
                    text    : 'Mohon Pilih Bulan dan Tahunnya',
                    type	: 'error',
                });
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData();
                    formdata.set('val02',set01);
                    formdata.set('val01','carirekappresensiperbulan');
                    formdata.set('_token', '{{ csrf_token() }}');
                url='{{ route("jsonCariDatainduk") }}';
                $.ajax({
                    type        : 'ajax',
                    url         : url,
                    method      : 'post',
                    data        : formdata,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    dataType    : 'json',
                    success: function(response, status, xhr) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        data = $.parseJSON(response.data);
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
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title: textStatus,
                            text:  jqXHR.responseText,
                            type: 'info',
                        });
                    }
                });
                $.post('{{ route("jsonCariDatainduk") }}', { tahun:set01, val01:'carirekappresensiperbulan', _token: '{{ csrf_token() }}' },
                function(data){
                    
                    return false;
                });
            }
        });
    });
</script>
@endpush