@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Presensi Siswa</h1>
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
                <div class="col-lg-4" id="sectionsetting">
                    <div id="status"></div>
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Control Panel</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">		
								<label>TAPEL</label>
								<input type="text" name="mas_tapel" id="mas_tapel" class="form-control" value="{{$tapel}}" placeholder="yyyy-yyyy">
								<input type="hidden" name="id_kelas" id="id_kelas" class="form-control" value="all">
							</div>
							<div class="form-group"> 
								<font color="red">Tentukan Tanggal Presensi</font>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" id="set_tanggal" class="form-control" placeholder="Tanggal Presensi" value="{{ date('Y-m-d') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
								</div>
							</div>
						</div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-success pull-right" id="btnsethadir">Set Hadir Semua</button>	
                        </div>
                    </div>
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Rekap</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group"> 
								<font color="red">Tentukan Tapel</font>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<select id="set_tapel" class="form-control">
										<option value="">Pilih Kelas</option>
										@foreach($jtapel as $rtapel)
											<option value="{{ $rtapel['tapel'] }}">{{ $rtapel['tapel'] }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-info pull-right" id="btnviewrekap">Tampilkan</button>	
                        </div>
                    </div>
                </div>
                <div class="col-lg-8" id="sectionkerja">
                    <div id="message"></div>
                    <div class="card card-info shadow" id="datanilai">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Workarea</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="divawal">
                                <div id="gridnonhadir"></div>
                            </div>
                            <div id="divpencarian">
                                <div id="gridpencarian"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="divgriddetailpresensi">
                                <button class="btn btn-success" id="btnclosedetail">Close Detail</button>
                                <div id="gridpresensi"></div>
                            </div>
						</div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="idekskul" id="idekskul" value="@if(isset($idekskul)){{ $idekskul }}@endif">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<div class="modal fade" id="modalverifikasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Verifikasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group"> 
                    <label>Pilih Nama Siswa</label>
                    <input type="text" id="id_nama" name="id_nama" class="form-control" disabled="disable">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Ijin Pada Tanggal</label>
                            <input type="text" id="id_tanggal" class="form-control"  disabled="disable">
                        </div>
                        <div class="col-lg-6">
                            <label>Ijin Selama (Hari)</label>
                            <input type="text" id="id_selama" class="form-control"  disabled="disable">
                        </div>
                    </div>
                </div>
                <div class="form-group"> 
                    <label>Dikarenakan.?</label>
                    <textarea id="id_alasan" rows="10" cols="80" disabled="disable"></textarea>
                </div>
                <div class="form-group"> 
                    <label>Pemohon</label>
                    <input type="text" id="id_pemohon" class="form-control" disabled="disable">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Tapel</label>
                            <input type="text" id="id_tapel" class="form-control" >
                        </div>
                        <div class="col-lg-6">
                            <label>Kategori</label>
                            <select id="id_kategori" class="form-control">
                                <option value="1">Hadir dan Tepat Waktu</option>
                                <option value="2">Hadir Namun Terlambat</option>
                                <option value="3">Ijin</option>
                                <option value="4">Sakit</option>
                                <option value="0">Alpha</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="id_idpresensi" >
                <button type="button" class="btn btn-danger" id="btnsmpnverifikasi">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(function () {
        CKEDITOR.env.isCompatible = true;
        CKEDITOR.replace( 'id_alasan', {
            toolbarGroups: [{"name":"paragraph","groups":["list"]}],
            removeButtons: 'Strike',
            width: '100%',
            height: 90
        });
    	$('#set_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
    $(document).ready(function () {
        $('.overlay').hide();
        $('#divpencarian').hide();
        $('#divgriddetailpresensi').hide();
        var token = document.getElementById('token').value;
        $('#btnclosedetail').click(function () {
            $('#divpencarian').show();
            $('#divgriddetailpresensi').hide();
        });
        $('#btnsmpnverifikasi').click(function () {
            var set01=document.getElementById('id_idpresensi').value;
            var set02=document.getElementById('id_tapel').value;
            var set03=document.getElementById('id_kategori').value;
            if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom TAPEL Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set03 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom Kategori Terlebih Dahulu',
                    type: 'warning',
                })
            } else {
                $.post('guru/exverpresensi',  { val01: set01, val02: set02, val03: set03, val04: 'pbm', val05: set05, _token: token },
                function(data){
                    $('#status').html(data);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $("#modalverifikasi").modal('hide');
                    $("#gridnonhadir").jqxGrid('updatebounddata');
                    return false;
                });
            }
        });
        var sourcedataawal = {
            datatype: "json",
            datafields: [
                { name: 'id',type: 'text'},	
                { name: 'nama',type: 'text'},
                { name: 'noinduk',type: 'text'},
                { name: 'tanggal',type: 'text'},	
                { name: 'alasan',type: 'text'},
                { name: 'inputor',type: 'text'},
                { name: 'surat',type: 'text'},
                { name: 'tapel',type: 'text'},
                { name: 'kelas',type: 'text'},
                { name: 'status',type: 'text'},
                { name: 'selama',type: 'text'},
                { name: 'alasan',type: 'text'},
            ],
            url: 'json/presensiadmin',
            cache: false,		
        };
        var jsondataawal = new $.jqx.dataAdapter(sourcedataawal);
        $("#gridnonhadir").jqxGrid({
            width: '100%',   
            columnsresize: true,
            theme: "energyblue",
            autoheight: true,
            altrows: true,
            source: jsondataawal,
            columns: [
                { text: 'View', columntype: 'button', width: '10%',  cellsrenderer: function () {
                    return "Surat";
                    }, buttonclick: function (row) {	
                        editrow = row;	
                        var offset 		= $("#gridnonhadir").offset();		
                        var dataRecord 	= $("#gridnonhadir").jqxGrid('getrowdata', editrow);
                        var set01		= dataRecord.surat;
                        var newWindow = window.open('', '', 'width=800, height=500'),
                            document = newWindow.document.open(),
                                    pageContent =
                                        '<!DOCTYPE html>\n' +
                                        '<html>\n' +
                                        '<head>\n' +
                                        '<meta charset="utf-8" />\n' +
                                        '<title>Arsip Surat</title>\n' +
                                        '</head>\n' +
                                        '<body>' + set01 + '</body>\n</html>';
                            document.write(pageContent);
                            document.close();
                    }
                },
                { text: 'KLS', datafield: 'kelas', width: '10%', align: 'center' },
                { text: 'Nama', datafield: 'nama', width: '20%', align: 'center' },
                { text: 'Tanggal', datafield: 'tanggal', width: '20%', cellsalign: 'left', align: 'center'},
                { text: 'Keterangan', datafield: 'alasan', width: '10%', cellsalign: 'left', align: 'center'},	
                { text: 'TAPEL', datafield: 'tapel', width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'Pemohon', datafield: 'inputor', width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'Verifikasi', columntype: 'button', width: '10%', cellsrenderer: function () {
                    return "Verifikasi";
                    }, buttonclick: function (row) {	
                        editrow = row;	
                        var offset 		= $("#gridnonhadir").offset();		
                        var dataRecord 	= $("#gridnonhadir").jqxGrid('getrowdata', editrow);
                        $("#id_idpresensi").val(dataRecord.id);		
                        $("#id_nama").val(dataRecord.nama);	
                        $("#id_pemohon").val(dataRecord.inputor);
                        $("#id_tanggal").val(dataRecord.tanggal);
                        $("#id_tapel").val(dataRecord.tapel);
                        $("#id_kategori").val(dataRecord.status);
                        $("#id_selama").val(dataRecord.selama);
                        CKEDITOR.instances['id_alasan'].setData(dataRecord.alasan)
                        $("#modalverifikasi").modal('show');
                    }
                },	
            ],                
        });
        $('#btnsethadir').click(function () {
            var set01	= document.getElementById('id_kelas').value;
            var set02	= document.getElementById('mas_tapel').value;
            var set03	= document.getElementById('set_tanggal').value;
            if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Set TAPEL Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set03 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Tanggal Kehadiran Terlebih Dahulu',
                    type: 'warning',
                })
            } else {
                $.post('guru/saveabsenall', { val01: set01, val02: set02, val03: set03, _token: token },
                function(data){
                    $('#status').html(data);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    var source 	= {
                        datatype: "json",
                        datafields: [
                            { name: 'id'},
                            { name: 'noinduk', type: 'text'},
                            { name: 'nama', type: 'text'},
                            { name: 'kelas', type: 'text'},
                            { name: 'foto', type: 'text'},
                            { name: 'masuk', type: 'text'},
                            { name: 'ijin', type: 'text'},
                            { name: 'alpha', type: 'text'},
                            { name: 'sakit', type: 'text'},
                        ],
                        type: 'POST',
                        data: {val01:set01, val02:set02, _token: token},
                        url: "json/dataabsenkelas",
                    };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    $('#divawal').hide();
                    $('#divpencarian').show();
                    $("#gridpencarian").jqxGrid({
                        width: '100%',   
                        columnsresize: true,
                        theme: "energyblue",
                        autoheight: true,
                        altrows: true,
                        source: jsondataawal,
                        columns: [
                            { text: 'TAPEL', datafield: 'tapel', width: '12%', cellsalign: 'left', align: 'center'  },
                            { text: 'Nama', datafield: 'nama', width: '40%', cellsalign: 'left', align: 'center'  },
                            { text: 'No.Induk', datafield: 'noinduk', width: '8%', cellsalign: 'left', align: 'center'  },
                            { text: 'Kelas', datafield: 'kelas', width: '8%', cellsalign: 'center', align: 'center'},
                            { text: 'Hadir', datafield: 'masuk', width: '8%', cellsalign: 'center', align: 'center'  },
                            { text: 'Sakit', datafield: 'sakit', width: '8%', cellsalign: 'center', align: 'center'  },
                            { text: 'Ijin', datafield: 'ijin', width: '8%', cellsalign: 'center', align: 'center'  },
                            { text: 'Aplha', datafield: 'alpha', width: '8%', cellsalign: 'center', align: 'center' },
                            { text: 'EDIT', columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
                                return "EDIT";
                                }, buttonclick: function (row) {
                                    editrow = row;	
                                    var offset 		= $("#gridpencarian").offset();
                                    var dataRecord 	= $("#gridpencarian").jqxGrid('getrowdata', editrow);
                                    var set01		= dataRecord.noinduk;
                                    var set02		= document.getElementById('mas_tapel').value;
                                    var sourcerinciannilai = {
                                        datatype: "json",
                                        datafields: [
                                            { name: 'id',type: 'text'},	
                                            { name: 'nama',type: 'text'},
                                            { name: 'noinduk',type: 'text'},
                                            { name: 'tanggal',type: 'text'},	
                                            { name: 'alasan',type: 'text'},
                                            { name: 'inputor',type: 'text'},
                                            { name: 'surat',type: 'text'},
                                            { name: 'tapel',type: 'text'},
                                            { name: 'kelas',type: 'text'},
                                            { name: 'status',type: 'text'},
                                            { name: 'selama',type: 'text'},
                                            { name: 'alasan',type: 'text'},
                                        ],
                                        type: 'POST',
                                        data: {	val01:set01, val02:set02, _token: token },
                                        url: 'json/presensicari',
                                    };
                                    $('#divgriddetailpresensi').show();
                                    var datarincianharian = new $.jqx.dataAdapter(sourcerinciannilai);
                                    var editrow = -1;
                                    $("#gridpresensi").jqxGrid({
                                        width: '100%',
                                        source: datarincianharian,
                                        autoheight: true,
                                        theme: "orange",
                                        columnsresize: true,
                                        selectionmode: 'multiplecellsextended',
                                        columns: [
                                            { text: 'View', columntype: 'button', width: '10%',  cellsrenderer: function () {
                                                return "Surat";
                                                }, buttonclick: function (row) {	
                                                    editrow = row;	
                                                    var offset 		= $("#gridpresensi").offset();		
                                                    var dataRecord 	= $("#gridpresensi").jqxGrid('getrowdata', editrow);
                                                    var set01		= dataRecord.surat;
                                                    var newWindow = window.open('', '', 'width=800, height=500'),
                                                        document = newWindow.document.open(),
                                                                pageContent =
                                                                    '<!DOCTYPE html>\n' +
                                                                    '<html>\n' +
                                                                    '<head>\n' +
                                                                    '<meta charset="utf-8" />\n' +
                                                                    '<title>Arsip Surat</title>\n' +
                                                                    '</head>\n' +
                                                                    '<body>' + set01 + '</body>\n</html>';
                                                        document.write(pageContent);
                                                        document.close();
                                                }
                                            },
                                            { text: 'KLS', datafield: 'kelas', width: '10%', align: 'center' },
                                            { text: 'Nama', datafield: 'nama', width: '20%', align: 'center' },
                                            { text: 'Tanggal', datafield: 'tanggal', width: '20%', cellsalign: 'left', align: 'center'},
                                            { text: 'Keterangan', datafield: 'alasan', width: '10%', cellsalign: 'left', align: 'center'},	
                                            { text: 'TAPEL', datafield: 'tapel', width: '10%', cellsalign: 'left', align: 'center' },
                                            { text: 'Pemohon', datafield: 'inputor', width: '10%', cellsalign: 'left', align: 'center' },
                                            { text: 'Verifikasi', columntype: 'button', width: '10%', cellsrenderer: function () {
                                                return "Verifikasi";
                                                }, buttonclick: function (row) {
                                                    editrow = row;
                                                    var offset 		= $("#gridpresensi").offset();
                                                    var dataRecord 	= $("#gridpresensi").jqxGrid('getrowdata', editrow);
                                                    $("#absen_idpresensi").val(dataRecord.id);		
                                                    $("#absen_nama").val(dataRecord.nama);	
                                                    $("#absen_pemohon").val(dataRecord.inputor);
                                                    $("#absen_tanggal").val(dataRecord.tanggal);
                                                    $("#absen_tapel").val(dataRecord.tapel);
                                                    $("#absen_kategori").val(dataRecord.status);
                                                    $("#absen_selama").val(dataRecord.selama);
                                                    CKEDITOR.instances['absen_alasan'].setData(dataRecord.alasan)
                                                    $("#modalverifikasipresensi").modal('show');
                                                }
                                            },	
                                        ]
                                    });
                                }
                            },
                        ]
                    });
                    return false;
                });
            }
        });
        $('#btnviewrekap').click(function () {
            var set01	= 'all';
            var set02	= document.getElementById('set_tapel').value;
            var token	= document.getElementById('token').value;
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'nama', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'foto', type: 'text'},
                    { name: 'masuk', type: 'text'},
                    { name: 'ijin', type: 'text'},
                    { name: 'alpha', type: 'text'},
                    { name: 'sakit', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, _token: token},
                url: "json/dataabsenkelas",
            };
            $('#divpencarian').show();
            $('#divgriddetailpresensi').hide();
            $('#divawal').hide();
        
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#gridpencarian").jqxGrid({
                width: '100%',
                pageable: true,
                rowsheight: 35,
                filterable: true,
                filtermode: 'excel',
                source: dataAdapter,
                theme: "energyblue",
                selectionmode: 'singlecell',
                columns: [
                    { text: 'Photo', datafield: 'foto', editable: false, width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', editable: false, width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', editable: false, width: '30%', cellsalign: 'left', align: 'center' },
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Masuk', datafield: 'masuk', width: '8%', cellsalign: 'center', align: 'center'},
                    { text: 'Sakit', datafield: 'sakit', width: '8%', cellsalign: 'center', align: 'center'},
                    { text: 'Ijin', datafield: 'ijin', width: '8%', cellsalign: 'center', align: 'center'},
                    { text: 'Alpha', datafield: 'alpha', width: '8%', cellsalign: 'center', align: 'center'},
                    { text: 'EDIT', columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
                        return "EDIT";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridpencarian").offset();
                            var dataRecord 	= $("#gridpencarian").jqxGrid('getrowdata', editrow);
                            var set01		= dataRecord.noinduk;
                            var set02		= document.getElementById('mas_tapel').value;
                            var sourcerinciannilai = {
                                datatype: "json",
                                datafields: [
                                    { name: 'id',type: 'text'},
                                    { name: 'nama',type: 'text'},
                                    { name: 'noinduk',type: 'text'},
                                    { name: 'tanggal',type: 'text'},
                                    { name: 'alasan',type: 'text'},
                                    { name: 'inputor',type: 'text'},
                                    { name: 'surat',type: 'text'},
                                    { name: 'tapel',type: 'text'},
                                    { name: 'kelas',type: 'text'},
                                    { name: 'status',type: 'text'},
                                    { name: 'selama',type: 'text'},
                                    { name: 'alasan',type: 'text'},
                                ],
                                type: 'POST',
                                data: {	val01:set01, val02:set02, _token: token },
                                url: 'json/presensicari',
                            };
                            $('#divpencarian').hide();
                            $('#divgriddetailpresensi').show();
                            $('#divawal').hide();
                            var datarincianharian = new $.jqx.dataAdapter(sourcerinciannilai);
                            var editrow = -1;
                            $("#gridpresensi").jqxGrid({
                                width: '100%',
                                source: datarincianharian,
                                autoheight: true,
                                filterable: true,
                                theme: "orange",
                                columnsresize: true,
                                selectionmode: 'multiplecellsextended',
                                columns: [
                                    { text: 'View', columntype: 'button', width: '8%',  cellsrenderer: function () {
                                        return "Surat";
                                        }, buttonclick: function (row) {
                                            editrow = row;
                                            var offset 		= $("#gridpresensi").offset();
                                            var dataRecord 	= $("#gridpresensi").jqxGrid('getrowdata', editrow);
                                            var set01		= dataRecord.surat;
                                            var newWindow = window.open('', '', 'width=800, height=500'),
                                                document = newWindow.document.open(),
                                                        pageContent =
                                                            '<!DOCTYPE html>\n' +
                                                            '<html>\n' +
                                                            '<head>\n' +
                                                            '<meta charset="utf-8" />\n' +
                                                            '<title>Arsip Surat</title>\n' +
                                                            '</head>\n' +
                                                            '<body>' + set01 + '</body>\n</html>';
                                                document.write(pageContent);
                                                document.close();
                                        }
                                    },
                                    { text: 'KLS', datafield: 'kelas', width: '5%', align: 'center' },
                                    { text: 'Nama', datafield: 'nama', width: '29%', align: 'center' },
                                    { text: 'Tanggal', datafield: 'tanggal', width: '12%', cellsalign: 'left', align: 'center'},
                                    { text: 'Keterangan', datafield: 'alasan', width: '15%', cellsalign: 'left', align: 'center'},
                                    { text: 'TAPEL', datafield: 'tapel', width: '12%', cellsalign: 'left', align: 'center' },
                                    { text: 'Pemohon', datafield: 'inputor', width: '11%', cellsalign: 'left', align: 'center' },
                                    { text: 'Edit', columntype: 'button', width: '8%', cellsrenderer: function () {
                                        return "Edit";
                                        }, buttonclick: function (row) {
                                            editrow = row;
                                            var offset 		= $("#gridpresensi").offset();
                                            var dataRecord 	= $("#gridpresensi").jqxGrid('getrowdata', editrow);
                                            $("#absen_idpresensi").val(dataRecord.id);
                                            $("#absen_nama").val(dataRecord.nama);
                                            $("#absen_pemohon").val(dataRecord.inputor);
                                            $("#absen_tanggal").val(dataRecord.tanggal);
                                            $("#absen_tapel").val(dataRecord.tapel);
                                            $("#absen_kategori").val(dataRecord.status);
                                            $("#absen_selama").val(dataRecord.selama);
                                            CKEDITOR.instances['absen_alasan'].setData(dataRecord.alasan)
                                            $("#modalverifikasipresensi").modal('show');
                                        }
                                    },
                                ]
                            });
                        }
                    },
                ]
            });
        });
    });
</script>
@endpush