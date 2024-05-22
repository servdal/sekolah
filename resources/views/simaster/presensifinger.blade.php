@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Present by Finger Print</h1>
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">List Pegawai</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            @if(isset($dataguru) && !empty($dataguru))
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach($dataguru as $rguru)
                                    <li class="item">
                                        <div class="product-img">
                                            @if ($rguru['foto'] == '' OR $rguru['foto'] == null)
                                            <a href="javascript:void(0)" onClick="selectasvalue('{{ $rguru['id'] }}')"><img src="{{url('/')}}/{{Session('sekolah_logo')}}" alt="{{ $rguru['nama'] }}" class="img-circle img-size-32 mr-2"></a>
                                            @else 
                                            <a href="javascript:void(0)" onClick="selectasvalue('{{ $rguru['id'] }}')"><img src="{{url('/')}}/dist/img/foto/{{ $rguru['foto'] }}" alt="{{ $rguru['nama'] }}" class="img-circle img-size-32 mr-2"></a>
                                            @endif
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" onClick="selectasvalue('{{ $rguru['id'] }}')">{{$rguru['nama']}}
                                            <span class="badge badge-warning float-right">{{$rguru['idfinger']}}</span></a>
                                            <span class="product-description">
                                                {{$rguru['jabatan']}}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="loading">
                        <img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
                    </div>
                    <div class="card" id="divworkarea">
                        <div class="card-header border-0">
                            <h3 class="card-title">Work Area</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm" id="btnexport">
                                    <i class="fa fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-tool btn-sm btnrefresh">
                                    <i class="fa fa-refresh"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label>TAPEL</label>
                                        <input type="text" name="tapel" id="tapel" class="form-control" value="{{$tapel}}" placeholder="Format : xxxx-xxxx">
                                        <input type="hidden" name="id_kelas" id="id_kelas" class="form-control" value="{{$setidkelas}}">
                                    </div> 
                                    <div class="col-lg-2">
                                        <label>Semester</label>
                                        <select id="id_semester" name="id_semester" class="form-control" >
                                            <option value=""></option>
                                            @if ($semester == '1')
                                                <option value="1" selected>Ganjil</option>
                                                <option value="2">Genap</option>
                                            @else
                                                <option value="1">Ganjil</option>
                                                <option value="2" selected>Genap</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>File Excel</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="berkas_file">
                                            <label class="custom-file-label" for="berkas_file">File Excel</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Upload Data Baru</label>
                                        <div class="custom-file">
                                            <button type="button" class="btn btn-success" id="btnsimpanberkas">Unggah</button>
								        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="gridarea"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
        bsCustomFileInput.init();
	});
    function selectasvalue(id){
        var url = '{{url('/')}}/profilpegawai/'+id;
        window.location=url;
    }
    $(document).ready(function () {
        $('#loading').hide();
        $('.btnrefresh').click(function () {
            var uri = window.location.href.split("#")[0];
            window.location=uri
        });
        $('#btnsimpanberkas').click(function () {
            var set01=document.getElementById('tapel').value;
            var set02=document.getElementById('id_semester').value;
            var pictu=document.getElementById('berkas_file');
            if (set01 == '' || set02 == ''){
                swal({
                    title	: 'Mohon lengkapi',
                    text	: 'Field Tahun Pelajaran dan Semester Belum di Isi',
                    type	: 'info',
                });
            } else if ($('#berkas_file').val() == ''){
                swal({
                    title	: 'Stop',
                    text	: 'File belum dipilih',
                    type	: 'warning',
                })
            } else {
                $('#loading').show();
                var formdata = new FormData();
                    formdata.append('file', pictu.files[0]);
                    formdata.set('tapel',set01);
                    formdata.set('semester',set02);
                    formdata.set('_token','{{ csrf_token() }}');
                url='{{ route("exPresFinger") }}';
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
                        $('#loading').hide();
                        var status  = response.status;
                        var message = response.message;
                        var warna 	= response.warna;
                        var icon 	= response.icon;
                        $.toast({
                            heading     : status,
                            text        : message,
                            position    : 'top-right',
                            loaderBg    : warna,
                            icon        : icon,
                            hideAfter   : 5000,
                            stack       : 1
                        });
                        var source = {
                            datatype: "json",
                            datafields: [
                                { name: 'tanggalscan', type: 'string' },
                                { name: 'tanggal', type: 'string' },
                                { name: 'jam', type: 'string' },
                                { name: 'pin' },
                                { name: 'nip', type: 'string' },
                                { name: 'nama', type: 'string' },
                                { name: 'jabatan', type: 'string' },
                                { name: 'departemen', type: 'string' },
                                { name: 'kantor', type: 'string' },
                                { name: 'verifikasi' },
                                { name: 'deviceio', type: 'string' },
                                { name: 'workcode' },
                                { name: 'serialnumber', type: 'string' },
                                { name: 'namamesin', type: 'string' },
                                { name: 'catatan', type: 'string' },
                                { name: 'status', type: 'string' },
                            ],
                            id			: 'id',
                            localData	: response.data
                        };
                        var dataAdapter = new $.jqx.dataAdapter(source);
                        $("#gridarea").jqxGrid({
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
                                { text: 'Tanggal Scan', datafield: 'tanggalscan', width: '12%', cellsalign: 'center', align: 'center' },
                                { text: 'Tanggal', datafield: 'tanggal', width: '8%', cellsalign: 'center', align: 'center'  },
                                { text: 'Jam', datafield: 'jam', width: '6%', cellsalign: 'center', align: 'center' },
                                { text: 'PIN', datafield: 'pin', width: '6%', cellsalign: 'center', align: 'center' },
                                { text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center' },
                                { text: 'Jabatan', datafield: 'jabatan', width: '13%', cellsalign: 'left', align: 'center'  },
                                { text: 'TAPEL', filtertype: 'checkedlist', datafield: 'departemen', width: '8%', cellsalign: 'center', align: 'center'  },
                                { text: 'Semester', filtertype: 'checkedlist', datafield: 'kantor', width: '7%', cellsalign: 'center', align: 'center' },
                                { text: 'Status', filtertype: 'checkedlist', datafield: 'status', width: '7%', cellsalign: 'center', align: 'center' },
                                { text: 'Catatan', filtertype: 'checkedlist', datafield: 'catatan', width: '8%', cellsalign: 'center', align: 'center' },
                                { text: 'Delete', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                                    return "Delete";
                                    }, buttonclick: function (row) {
                                        editrow         = row;	
                                        var offset 		= $("#gridarea").offset();
                                        var dataRecord 	= $("#gridarea").jqxGrid('getrowdata', editrow);
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
                                                url			: '{{ route("exDestroyer") }}',
                                                method		: 'post',
                                                data		: {val01:dataRecord.pin, val02:'presensifinger', val03:dataRecord.tanggalscan, _token: '{{ csrf_token() }}'},
                                                dataType	: 'json',
                                                success: function(response, status, xhr) {
                                                    swal({
                                                        title	: response.status,
                                                        text	: response.message,
                                                        type	: response.icon,
                                                    });
                                                    $("#gridarea").jqxGrid("updatebounddata");	
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
                        return false;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loading').hide();
                        swal({
                            title	: textStatus,
                            text	:  jqXHR.responseText,
                            type	: 'info',
                        });
                    }
                });
            }
        });
        $("#btnexport").click(function () {
            var set01=document.getElementById('tapel').value;
            var set02=document.getElementById('id_semester').value;
            if (set01 == '' || set02 == ''){

            } else {
                $.post('{{ route("jsonPresensicari") }}', { val01: set01, val02: 'exportpresensifinger', val03: set02, _token: '{{ csrf_token() }}' },
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
    });
</script>
@endpush