@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Setting Tema</h1>
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
                <div class="col-lg-3">
                    <div id="status" class="status"></div>
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Control Panel</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            Silahkan Pilih Kelas Untuk di Tentukan Kurikulum 
							<a href="#" id="grade1"  class="btn btn-block btn-social btn-primary">
								<i class="fa fa-windows"></i> Kelas I
							</a>
							<a href="#" id="grade2"  class="btn btn-block btn-social btn-warning">
								<i class="fa fa-android"></i> Kelas II
							</a>
							<a href="#" id="grade3"  class="btn btn-block btn-social btn-info">
								<i class="fa fa-apple"></i> Kelas III
							</a>
							<a href="#" id="grade4"  class="btn btn-block btn-social btn-danger">
								<i class="fa fa-facebook"></i> Kelas IV
							</a>
							<a href="#" id="grade5"  class="btn btn-block btn-social btn-success">
								<i class="fa fa-google"></i> Kelas V
							</a>
							<a href="#" id="grade6"  class="btn btn-block btn-social btn-primary">
								<i class="fa fa-twitter"></i> Kelas VI
							</a>
						</div>
						<div class="card-footer">
                            <a href="#" id="btnupload"  class="btn btn-block btn-social btn-danger">
								<i class="fa fa-upload"></i> Upload Data
							</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div id="message"></div>
                    <div class="card card-info shadow" id="datanilai">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Data Tema</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-success" id="btntmbhkd">Tambahkan Tema</button>	
                            <button type="button" class="btn btn-info" id="btnexport">Export Tabel Di bawah ini</button>
                        </div>
                        <div class="card-footer">
                            <div id="gridkurikulum"></div>
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
<div class="modal fade" id="modaleditkurikulum">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Kurikulum</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-4">
                            <label>Kelas</label>
                            <input type="text" id="udt_kelas" name="udt_kelas" class="form-control" disabled="disable">
                        </div>
                        <div class="col-xs-4">
                            <label>Tema Ke</label>
                            <select id="udt_temake" name="udt_temake" size="1" class="form-control">
                                <option value="">Pilih Salah Satu</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>			  			  
                </div>
                <div class="form-group">			 
                    <label>Tema</label>
                    <input type="text" id="udt_tema" name="udt_tema" class="form-control">		  			  
                </div>
                <div class="form-group">			 
                    <label>Sub Tema</label>
                    <input type="text" id="udt_tema1" name="udt_tema1" class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="udt_idform" >
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-info" id="btnupdtkurikulum">Update</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaladdkurikulum">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Kompetensi Inti</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-4">
                            <label>Kelas</label>
                            <input type="text" id="id_kelas" name="id_kelas" class="form-control" disabled="disable">
                        </div>
                        <div class="col-xs-4">
                            <label>Tema Ke</label>
                            <select id="id_temake" name="id_temake" size="1" class="form-control">
                                <option value="">Pilih Salah Satu</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tema</label>
                    <input type="text" id="id_tema" name="id_tema" class="form-control">
                </div>
                <div class="form-group">
                    <label>Sub Tema 1</label>
                    <input type="text" id="id_tema1" name="id_tema1" class="form-control">
                </div>
                <div class="form-group">
                    <label>Sub Tema 2</label>
                    <input type="text" id="id_tema2" name="id_tema2" class="form-control">
                </div>
                <div class="form-group">
                    <label>Sub Tema 3</label>
                    <input type="text" id="id_tema3" name="id_tema3" class="form-control">
                </div>
                <div class="form-group">
                    <label>Sub Tema 4</label>
                    <input type="text" id="id_tema4" name="id_tema4" class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsavekurikulum">Simpan</button>	
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
$(document).ready(function () {
	$('#btnupload').click(function () {
		$("#modaluploader").modal('show');
	});
	var token = document.getElementById('token').value;
	$('#grade1').click(function () {	
		var set01='1';
		$("#id_kelas").val(set01);
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'id', type: 'text'},
				{ name: 'kelas', type: 'text'},
				{ name: 'temake', type: 'text'},
				{ name: 'tema', type: 'text'},
				{ name: 'subtemake', type: 'text'},
				{ name: 'subtema', type: 'text'},
			],
			type: 'POST',
			data: {val01:set01, _token: token},
			url: "json/jsontema"
		};
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#gridkurikulum").jqxGrid({
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
				{ text: 'KLS', datafield: 'kelas', width: '4%', cellsalign: 'center', align: 'center' },
				{ text: 'Tema', datafield: 'temake', width: '8%', cellsalign: 'center', align: 'center'},
				{ text: 'Deskripsi', datafield: 'tema', width: '32%', cellsalign: 'left', align: 'center' },
				{ text: 'SubTema', datafield: 'subtemake', width: '8%', cellsalign: 'center', align: 'center' },
				{ text: 'Deskripsi', datafield: 'subtema', width: '32%', cellsalign: 'left', align: 'center' },				
				{ text: 'UBAH', columntype: 'button', align: 'center', width: '8%', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {	
					editrow = row;	
					var offset 		= $("#gridkurikulum").offset();					
					var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);						
						$("#udt_idform").val(dataRecord.id);
						$("#udt_kelas").val(dataRecord.kelas);
						$("#udt_temake").val(dataRecord.temake);
						$("#udt_tema").val(dataRecord.tema);
						$("#udt_tema1").val(dataRecord.subtema);
						$("#modaleditkurikulum").modal('show');	
					}
				},
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridkurikulum").offset();
						var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
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
							var set02		= 'db_tema';
							var set03		= '';
							var token		= document.getElementById('token').value;
							$.post('admin/destroyer', { val01: set01, val02: set02, val03: '', _token: token },
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
									$("#gridkurikulum").jqxGrid('updatebounddata');
									return false;
							});
						});
					}
				},
			]
		});		
	});
	$('#grade2').click(function () {	
		var set01='2';
		$("#id_kelas").val(set01);
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'id', type: 'text'},
				{ name: 'kelas', type: 'text'},
				{ name: 'temake', type: 'text'},
				{ name: 'tema', type: 'text'},
				{ name: 'subtemake', type: 'text'},
				{ name: 'subtema', type: 'text'},
			],
			type: 'POST',
			data: {val01:set01, _token: token},
			url: "json/jsontema"
		};			
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#gridkurikulum").jqxGrid({
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
				{ text: 'KLS', datafield: 'kelas', width: '4%', cellsalign: 'center', align: 'center' },
				{ text: 'Tema', datafield: 'temake', width: '8%', cellsalign: 'center', align: 'center'},
				{ text: 'Deskripsi', datafield: 'tema', width: '32%', cellsalign: 'left', align: 'center' },
				{ text: 'SubTema', datafield: 'subtemake', width: '8%', cellsalign: 'center', align: 'center' },
				{ text: 'Deskripsi', datafield: 'subtema', width: '32%', cellsalign: 'left', align: 'center' },				
				{ text: 'UBAH', columntype: 'button', align: 'center', width: '8%', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {	
					editrow = row;	
					var offset 		= $("#gridkurikulum").offset();					
					var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);						
						$("#udt_idform").val(dataRecord.id);
						$("#udt_kelas").val(dataRecord.kelas);
						$("#udt_temake").val(dataRecord.temake);
						$("#udt_tema").val(dataRecord.tema);
						$("#udt_tema1").val(dataRecord.subtema);
						$("#modaleditkurikulum").modal('show');					
					}
				},
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridkurikulum").offset();
						var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
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
							var set02		= 'db_tema';
							var set03		= '';
							var token		= document.getElementById('token').value;
							$.post('admin/destroyer', { val01: set01, val02: set02, val03: '', _token: token },
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
									$("#gridkurikulum").jqxGrid('updatebounddata');
									return false;
							});
						});
					}
				},
			]
		});		
	});
	$('#grade3').click(function () {	
		var set01='3';
		$("#id_kelas").val(set01);
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'id', type: 'text'},
				{ name: 'kelas', type: 'text'},
				{ name: 'temake', type: 'text'},
				{ name: 'tema', type: 'text'},
				{ name: 'subtemake', type: 'text'},
				{ name: 'subtema', type: 'text'},
			],
			type: 'POST',
			data: {val01:set01, _token: token},
			url: "json/jsontema"
		};			
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#gridkurikulum").jqxGrid({
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
				{ text: 'KLS', datafield: 'kelas', width: '4%', cellsalign: 'center', align: 'center' },
				{ text: 'Tema', datafield: 'temake', width: '8%', cellsalign: 'center', align: 'center'},
				{ text: 'Deskripsi', datafield: 'tema', width: '32%', cellsalign: 'left', align: 'center' },
				{ text: 'SubTema', datafield: 'subtemake', width: '8%', cellsalign: 'center', align: 'center' },
				{ text: 'Deskripsi', datafield: 'subtema', width: '32%', cellsalign: 'left', align: 'center' },				
				{ text: 'UBAH', columntype: 'button', align: 'center', width: '8%', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {	
					editrow = row;	
					var offset 		= $("#gridkurikulum").offset();					
					var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);						
						$("#udt_idform").val(dataRecord.id);
						$("#udt_kelas").val(dataRecord.kelas);
						$("#udt_temake").val(dataRecord.temake);
						$("#udt_tema").val(dataRecord.tema);
						$("#udt_tema1").val(dataRecord.subtema);
						$("#modaleditkurikulum").modal('show');	
					}
				},
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridkurikulum").offset();
						var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
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
							var set02		= 'db_tema';
							var set03		= '';
							var token		= document.getElementById('token').value;
							$.post('admin/destroyer', { val01: set01, val02: set02, val03: '', _token: token },
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
									$("#gridkurikulum").jqxGrid('updatebounddata');
									return false;
							});
						});
					}
				},
			]
		});		
	});
	$('#grade4').click(function () {	
		var set01='4';
		$("#id_kelas").val(set01);
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'id', type: 'text'},
				{ name: 'kelas', type: 'text'},
				{ name: 'temake', type: 'text'},
				{ name: 'tema', type: 'text'},
				{ name: 'subtemake', type: 'text'},
				{ name: 'subtema', type: 'text'},
			],
			type: 'POST',
			data: {val01:set01, _token: token},
			url: "json/jsontema"
		};			
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#gridkurikulum").jqxGrid({
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
				{ text: 'KLS', datafield: 'kelas', width: '4%', cellsalign: 'center', align: 'center' },
				{ text: 'Tema', datafield: 'temake', width: '8%', cellsalign: 'center', align: 'center'},
				{ text: 'Deskripsi', datafield: 'tema', width: '32%', cellsalign: 'left', align: 'center' },
				{ text: 'SubTema', datafield: 'subtemake', width: '8%', cellsalign: 'center', align: 'center' },
				{ text: 'Deskripsi', datafield: 'subtema', width: '32%', cellsalign: 'left', align: 'center' },				
				{ text: 'UBAH', columntype: 'button', align: 'center', width: '8%', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {	
					editrow = row;	
					var offset 		= $("#gridkurikulum").offset();					
					var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);						
						$("#udt_idform").val(dataRecord.id);
						$("#udt_kelas").val(dataRecord.kelas);
						$("#udt_temake").val(dataRecord.temake);
						$("#udt_tema").val(dataRecord.tema);
						$("#udt_tema1").val(dataRecord.subtema);
						$("#modaleditkurikulum").modal('show');	
					}
				},
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridkurikulum").offset();
						var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
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
							var set02		= 'db_tema';
							var set03		= '';
							var token		= document.getElementById('token').value;
							$.post('admin/destroyer', { val01: set01, val02: set02, val03: '', _token: token },
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
									$("#gridkurikulum").jqxGrid('updatebounddata');
									return false;
							});
						});
					}
				},
			]
		});		
	});
	$('#grade5').click(function () {	
		var set01='5';
		$("#id_kelas").val(set01);
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'id', type: 'text'},
				{ name: 'kelas', type: 'text'},
				{ name: 'temake', type: 'text'},
				{ name: 'tema', type: 'text'},
				{ name: 'subtemake', type: 'text'},
				{ name: 'subtema', type: 'text'},
			],
			type: 'POST',
			data: {val01:set01, _token: token},
			url: "json/jsontema"
		};			
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#gridkurikulum").jqxGrid({
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
				{ text: 'KLS', datafield: 'kelas', width: '4%', cellsalign: 'center', align: 'center' },
				{ text: 'Tema', datafield: 'temake', width: '8%', cellsalign: 'center', align: 'center'},
				{ text: 'Deskripsi', datafield: 'tema', width: '32%', cellsalign: 'left', align: 'center' },
				{ text: 'SubTema', datafield: 'subtemake', width: '8%', cellsalign: 'center', align: 'center' },
				{ text: 'Deskripsi', datafield: 'subtema', width: '32%', cellsalign: 'left', align: 'center' },				
				{ text: 'UBAH', columntype: 'button', align: 'center', width: '8%', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {	
					editrow = row;	
					var offset 		= $("#gridkurikulum").offset();					
					var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);						
						$("#udt_idform").val(dataRecord.id);
						$("#udt_kelas").val(dataRecord.kelas);
						$("#udt_temake").val(dataRecord.temake);
						$("#udt_tema").val(dataRecord.tema);
						$("#udt_tema1").val(dataRecord.subtema);
						$("#modaleditkurikulum").modal('show');	
					}
				},
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridkurikulum").offset();
						var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
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
							var set02		= 'db_tema';
							var set03		= '';
							var token		= document.getElementById('token').value;
							$.post('admin/destroyer', { val01: set01, val02: set02, val03: '', _token: token },
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
									$("#gridkurikulum").jqxGrid('updatebounddata');
									return false;
							});
						});
					}
				},
			]
		});		
	});
	$('#grade6').click(function () {	
		var set01='6';
		$("#id_kelas").val(set01);
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'id', type: 'text'},
				{ name: 'kelas', type: 'text'},
				{ name: 'temake', type: 'text'},
				{ name: 'tema', type: 'text'},
				{ name: 'subtemake', type: 'text'},
				{ name: 'subtema', type: 'text'},
			],
			type: 'POST',
			data: {val01:set01, _token: token},
			url: "json/jsontema"
		};			
		var dataAdapter = new $.jqx.dataAdapter(source);
		$("#gridkurikulum").jqxGrid({
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
				{ text: 'KLS', datafield: 'kelas', width: '4%', cellsalign: 'center', align: 'center' },
				{ text: 'Tema', datafield: 'temake', width: '8%', cellsalign: 'center', align: 'center'},
				{ text: 'Deskripsi', datafield: 'tema', width: '32%', cellsalign: 'left', align: 'center' },
				{ text: 'SubTema', datafield: 'subtemake', width: '8%', cellsalign: 'center', align: 'center' },
				{ text: 'Deskripsi', datafield: 'subtema', width: '32%', cellsalign: 'left', align: 'center' },				
				{ text: 'UBAH', columntype: 'button', align: 'center', width: '8%', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {	
					editrow = row;	
					var offset 		= $("#gridkurikulum").offset();					
					var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);						
						$("#udt_idform").val(dataRecord.id);
						$("#udt_kelas").val(dataRecord.kelas);
						$("#udt_temake").val(dataRecord.temake);
						$("#udt_tema").val(dataRecord.tema);
						$("#udt_tema1").val(dataRecord.subtema);
						$("#modaleditkurikulum").modal('show');	
					}
				},
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridkurikulum").offset();
						var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
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
							var set02		= 'db_tema';
							var set03		= '';
							var token		= document.getElementById('token').value;
							$.post('admin/destroyer', { val01: set01, val02: set02, val03: '', _token: token },
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
									$("#gridkurikulum").jqxGrid('updatebounddata');
									return false;
							});
						});
					}
				},
			]
		});		
	});
	$('#btnsavekurikulum').click(function () {
		var set01=document.getElementById('id_kelas').value;
		var set02=document.getElementById('id_temake').value;
		var set03=document.getElementById('id_tema').value;
		var set04=document.getElementById('id_tema1').value;
		var set05=document.getElementById('id_tema2').value;
		var set06=document.getElementById('id_tema3').value;
		var set07=document.getElementById('id_tema4').value;
		$.post('guru/simpandatatema', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, _token: token },
		function(data){	
			$("#modaladdkurikulum").modal('hide');
			$("#gridkurikulum").jqxGrid("updatebounddata");		
			$('.status').html(data);
			$("html, body").animate({ scrollTop: 0 }, "slow");		
			return false;
		});
	});
	$('#btnupdtkurikulum').click(function () {
		var set01=document.getElementById('udt_idform').value;
		var set02=document.getElementById('udt_tema').value;
		var set03=document.getElementById('udt_tema1').value;	
		$.post('guru/ubahdatatema', { val01: set01, val02: set02, val03: set03, _token: token },
		function(data){	
			$("#modaleditkurikulum").modal('hide');
			$("#gridkurikulum").jqxGrid("updatebounddata");		
			$('.status').html(data);
			$("html, body").animate({ scrollTop: 0 }, "slow");		
			return false;
		});
	});
	$('#btntmbhkd').click(function () {
		$("#modaladdkurikulum").modal('show');
	});
});
</script>
@endpush