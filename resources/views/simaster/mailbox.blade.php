@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
	<section class="content-header">
	    <div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"> MailBox</h1>
				</div>
				<div class="col-sm-6">
                    
				</div>
			</div>
		</div>
    </section>
	<section class="content">
        <div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Tandatangan</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                @if(isset($tandatangan) AND $tandatangan != '')
                                    <img src="{!!$tandatangan!!}" alt="image" width="100%" id="previewttd">
                                @else
                                    <img src="dist/img/takadagambar.png" alt="image" width="100%" id="previewttd">
                                @endif
                                <input type="file" id="id_tandatangan" style="display: none;"/>
                                <button type="button" class="btn btn-info btn-block" id="btnuploadtandatangan">&nbsp;&nbsp;Upload Tandatangan&nbsp;&nbsp;</button></p>
                            </div>
                        </div>
                    </div>
                    @if (Session('previlage') == 'level1')
                        <div class="card card-info shadow">
                            <div class="card-header">
                                <h3 class="card-title">Tandatangan Khusus Kepala Sekolah</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    @if(isset($tandatanganks) AND $tandatanganks != '')
                                        <img src="{!!$tandatanganks!!}" alt="image" width="100%" id="previewttdks">
                                    @else
                                        <img src="dist/img/takadagambar.png" alt="image" width="100%" id="previewttdks">
                                    @endif
                                    <input type="file" id="id_tandatanganks" style="display: none;"/>
                                    <button type="button" class="btn btn-info btn-block" id="btnuploadtandatanganks">&nbsp;&nbsp;Upload Tandatangan&nbsp;&nbsp;</button></p>
                                </div>
                            </div>
                        </div>
                    @endif
				</div>
                <div class="col-lg-9">
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
                                Periksa Kembali Sebelum Menandatangani Dokumen-Dokumen di Bawah Ini. Centang Dokumen Yang Akan di Tandatangani Kemudian Masukkan Password Bapak/Ibu di Kolom yang telah disediakan di bawah ini
                            </div>
                            <div class="form-group"> 
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="username" id="username" class="form-control" value="{{Session('username')}}"  disabled="disable"/>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Sesuai Username disamping" />
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#" class="btn btn-primary pull-left" id="btnmultitandatangan">
                                            <i class="fa fa-edit"></i>  Tandatangai Semua Yang Tercentang
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="gridmailbox"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="gridriwayat"></div>
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
<input type="hidden" class="form-control" id="tandatangan" value="{!!$tandatangan!!}">
<input type="hidden" class="form-control" id="usernameks" value="{!!$usernameks!!}">
<input type="hidden" class="form-control" id="tandatanganks" value="{!!$tandatanganks!!}">
<input type="hidden" class="form-control" id="ttekirim" value="{!!$ttekirim!!}">

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
    $('#id_tandatangan').change(function () {
        if(this.files[0].size > 1000000){
            this.value = "";
			swal({
				title	: 'Stop',
				text	: 'Maksimum file adalah 1Mb',
				type	: 'warning',
			})
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLAddttd(this);
            } else {
				swal({
					title	: 'Stop',
					text	: 'Please select image file (jpg, jpeg, png).',
					type	: 'warning',
				})
            }
        }
    });
    function readURLAddttd(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#previewttd').attr('src', e.target.result);
                $('#tandatangan').val(e.target.result);
                var form_data = new FormData();
                    form_data.append('val01', 'updatettepribadi');
                    form_data.append('val02', e.target.result);
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url         : '{{ route("exEditProfil") }}',
                    data        : form_data,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success     : function (data) {
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
                        return false;
                    },
                    error: function (xhr, status, error) {
                        swal({
                            title   : status,
                            text    : xhr.responseText,
                            type    : 'info',
                        });
                    }
                });
            };
        }
    }
    $('#id_tandatanganks').change(function () {
        if(this.files[0].size > 1000000){
            this.value = "";
			swal({
				title	: 'Stop',
				text	: 'Maksimum file adalah 1Mb',
				type	: 'warning',
			})
        } else {
            var imgPath = this.value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "PNG" || ext == "png" || ext == "JPG" || ext == "JPEG" || ext == "jpg" || ext == "jpeg") {
                readURLAddttdKS(this);
            } else {
				swal({
					title	: 'Stop',
					text	: 'Please select image file (jpg, jpeg, png).',
					type	: 'warning',
				})
            }
        }
    });
    function readURLAddttdKS(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#previewttdks').attr('src', e.target.result);
                $('#tandatanganks').val(e.target.result);
                var form_data = new FormData();
                    form_data.append('val01', 'updatetteks');
                    form_data.append('val02', e.target.result);
                    form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url         : '{{ route("exEditProfil") }}',
                    data        : form_data,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success     : function (data) {
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
                        return false;
                    },
                    error: function (xhr, status, error) {
                        swal({
                            title   : status,
                            text    : xhr.responseText,
                            type    : 'info',
                        });
                    }
                });
            };
        }
    }
    function openedpage( jQuery ){
        var token   = document.getElementById('token').value;
        var source  = {
            datatype: "json",
            datafields: [
                { name: 'id' },
                { name: 'xmarking', type: 'text'},
                { name: 'tabel', type: 'text'},
                { name: 'perihal', type: 'text'},
                { name: 'pengirim', type: 'text'},
                { name: 'penerima', type: 'text'},
                { name: 'urlsurat', type: 'text'},
                { name: 'jenis', type: 'text'},
                { name: 'status' },
                { name: 'id_sekolah' },
            ],
            type: 'POST',
            data: {cari: 'mailbox', _token: token},
            url : '{{ route("jsonDataSurat") }}',
        };
        var dataJson		= new $.jqx.dataAdapter(source);
        var linkrapotgenerator = function (row, column, value) {
            var id    = $('#gridmailbox').jqxGrid('getrowdata', row).urlsurat;
            var url     = '<a href="'+id+'" target="_blank"><span class="badge badge-primary">VIEW SURAT</span></a>';
            return url;
        }
        $("#gridmailbox").jqxGrid({
            width           : '100%',
            filterable      : true,
            pageable        : true,
            autoheight      : true,
            source          : dataJson,
            theme           : "energyblue",
            selectionmode   : 'checkbox',
            columnsresize   : true,
            altrows         : true,
            columns         : [
                { text: 'Perihal', datafield: 'perihal', width: '56%', cellsalign: 'left', align: 'center'  },
                { text: 'Pengirim', datafield: 'pengirim', width: '20%', cellsalign: 'left', align: 'center'  },
                { text: 'Link Dokumen', cellsrenderer: linkrapotgenerator, width: '12%', cellsalign: 'center', align: 'center' },
                { text: 'Tolak', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '7%', cellsrenderer: function () {
                    return "Tolak";
                    }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridmailbox").offset();		
                        var dataRecord 	= $("#gridmailbox").jqxGrid('getrowdata', editrow);
                        var jenisdata   = dataRecord.jennilai;
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
                            var set02		= 'deletemailbox';
                            var set03		= '';
                            $.post('{{ route("exPersuratanFunc") }}', { id: set01, workcode: set02, val03: '', _token: '{{ csrf_token() }}' },
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
                                    $("#gridmailbox").jqxGrid('updatebounddata');
                                    return false;
                            });
                        });
                    }
                },
            ],
        });
        var sourcearsip  = {
            datatype: "json",
            datafields: [
                { name: 'id' },
                { name: 'xmarking', type: 'text'},
                { name: 'tabel', type: 'text'},
                { name: 'perihal', type: 'text'},
                { name: 'pengirim', type: 'text'},
                { name: 'penerima', type: 'text'},
                { name: 'urlsurat', type: 'text'},
                { name: 'jenis', type: 'text'},
                { name: 'status' },
                { name: 'id_sekolah' },
            ],
            type: 'POST',
            data: {cari: 'arsipmailbox', _token: token},
            url : '{{ route("jsonDataSurat") }}',
        };
        var dataJsonArsip		= new $.jqx.dataAdapter(sourcearsip);
        var linkArsipgenerator = function (row, column, value) {
            var id    = $('#gridriwayat').jqxGrid('getrowdata', row).urlsurat;
            var url     = '<a href="'+id+'" target="_blank"><span class="badge badge-primary">VIEW SURAT</span></a>';
            return url;
        }
        $("#gridriwayat").jqxGrid({
            width           : '100%',
            filterable      : true,
            pageable        : true,
            autoheight      : true,
            source          : dataJsonArsip,
            theme           : "energyblue",
            altrows         : true,
            columns         : [
                { text: 'Perihal', datafield: 'perihal', width: '68%', cellsalign: 'left', align: 'center'  },
                { text: 'Pengirim', datafield: 'pengirim', width: '20%', cellsalign: 'left', align: 'center'  },
                { text: 'Link Dokumen', cellsrenderer: linkArsipgenerator, width: '12%', cellsalign: 'center', align: 'center' },
                
            ],
        });
    }
	$(document).ready(function () {
        $('#loading').hide();
        $('#btnuploadtandatangan').on('click', function (){	
            $('#id_tandatangan').click();
        });
        $('#btnuploadtandatanganks').on('click', function (){	
            $('#id_tandatanganks').click();
        });
        $('#btnmultitandatangan').click(function () {
            var set01           = document.getElementById('password').value;
            var set02           = document.getElementById('ttekirim').value;
            var rows            = $("#gridmailbox").jqxGrid('selectedrowindexes');
            var selectedRecords = new Array();
            for (var m = 0; m < rows.length; m++) {
                var row = $("#gridmailbox").jqxGrid('getrowdata', rows[m]);
                if (m < 50){
                    selectedRecords.push(row.id);
                }
            }
            if (set01 == ''){
                swal({
                    title	: 'Mohon di Lengkapi',
                    text	: 'Password Wajib di Isi',
                    type	: 'warning',
                })
            } else if (m == 0){
                swal({
                    title: 'Stop',
                    text: 'Mohon maaf, mohon centang surat yang ingin anda tanda tangani.',
                    type: 'warning',
                })
            } else {
                $('#loading').show();
                $('#divworkarea').hide();
                var formdata = new FormData();
                    formdata.set('xmarkinglist',selectedRecords);
                    formdata.set('password',set01);
                    formdata.set('ttekirim',set02);
                    formdata.set('workcode','ttemulti');
                    formdata.set('_token', '{{ csrf_token() }}');
                url='{{ route("exPersuratanFunc") }}';
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
                        $('#divworkarea').show();
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
                        $("#gridmailbox").jqxGrid('updatebounddata');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loading').hide();
                        $('#divworkarea').show();
                        swal({
                            title   : textStatus,
                            text    : jqXHR.responseText,
                            type    : 'info',
                        });
                    }
                });
            }
        });
        openedpage();
	});
</script>
@endpush

