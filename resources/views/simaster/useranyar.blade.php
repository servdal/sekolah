@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> User Admin</h1>
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
        <div class="card" id="divawal">
            <div class="card-header">
                <h3 class="card-title">All User</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-primary" id="adduserstaff"><i class="fa fa-plus"></i> Add User untuk Staff</button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body" >
                <div id="gridusername"></div>
            </div>
        </div>
	</div>
</div>
<div class="modal fade" id="formtambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Editor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Pegawai</label>
                    <select id="id_pegawai" class="form-control" >
                        <option value="">Pilih Salah Satu</option>
                        @foreach($jpegawai as $rpeg)
                            <option value="{{ $rpeg['niy'] }}">{{ $rpeg['nama'] }}</option>
                        @endforeach
                    </select>
                </div>	
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" id="id_username" name="id_username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="password" id="id_pass1" name="id_pass1" class="form-control">
                        </div> 
                        <div class="col-md-6">
                            <input type="password" id="id_pass2" name="id_pass2" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select id="id_level" name="id_level" class="form-control" >
                        <option value=""></option>
                        <option value="level1">Level 1 (KaSek, WaKaSek)</option>
                        <option value="level2">Level 2 (Guru Kelas)</option>
                        <option value="level3">Level 3 (Guru Matpel)</option>
                        <option value="level4">Level 4 (Staf TU)</option>
                        <option value="level5">Level 5 (Bendahara)</option>
                        <option value="ortu">Orang Tua</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="hidden" class="form-control" id="id_idne">
                <button type="button" class="btn btn-success" id="addstaffuser">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editdatainduk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Editor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" id="edit_nama" name="edit_nama" class="form-control" disabled="disable">			  
                </div>	
                <div class="form-group">
                    <label>Password Baru</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="password" id="edit_pass1" name="edit_pass1" class="form-control">
                        </div> 
                        <div class="col-md-6">
                            <input type="password" id="edit_pass2" name="edit_pass2" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="simpanpass">Save</button>
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
$(document).ready(function () {
	var token = document.getElementById('token').value;
	$('#adduserstaff').click(function () {
		$("#id_pegawai").val('');
		$("#id_level").val('');
		$("#id_pass1").val('');
		$("#id_pass2").val('');
		$("#id_username").val('');
		$("#id_idne").val('new');
		$("#formtambah").modal('show');
	});
	$('#adduseryayasan').click(function () {
		$("#formtambahyayasan").modal('show');
	});
	$('#addstaffyayasan').click(function () {
		var set01='new';
		var set02=document.getElementById('nama').value;
		var set03=document.getElementById('pass1').value;
		var set04=document.getElementById('username').value;
		var set05=document.getElementById('pass2').value;
		var set06=document.getElementById('level').value;
		var token=document.getElementById('token').value;
		$.post('exusername', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, _token: token },
		function(data){	
			$("#formtambahyayasan").modal('hide');
			$("#gridusername").jqxGrid("updatebounddata", "filter");		
			$("html, body").animate({ scrollTop: 0 }, "slow");
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
			return false;
		});
	});
	$('#addstaffuser').click(function () {
		var set01=document.getElementById('id_idne').value;
		var set02=document.getElementById('id_pegawai').value;
		var set03=document.getElementById('id_pass1').value;
		var set04=document.getElementById('id_username').value;
		var set05=document.getElementById('id_pass2').value;
		var set06=document.getElementById('id_level').value;
		var token=document.getElementById('token').value;
		$.post('exusername', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, _token: token },
		function(data){	
			$("#formtambah").modal('hide');
			$("#gridusername").jqxGrid("updatebounddata", "filter");		
			$("html, body").animate({ scrollTop: 0 }, "slow");
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
			return false;
		});
	});
	var sourcebuku = {
		datatype: "json",
		datafields: [
			{ name: 'idne'},
			{ name: 'nama', type: 'text'},
			{ name: 'username', type: 'text'},
			{ name: 'previlage', type: 'text'},
			{ name: 'nip', type: 'text'},
			{ name: 'email', type: 'text'},
		],
		url: 'getallusername',
		cache: false
	};		
	var databuku = new $.jqx.dataAdapter(sourcebuku);
	$("#gridusername").jqxGrid({
		width: '100%',
		autoheight: true,
		source: databuku,
		theme: "energyblue",
		selectionmode: 'multiplecellsextended',
		columns: [			
			{ text: 'Nama',  datafield: 'nama', width: '30%', align: 'center' },
			{ text: 'Username', datafield: 'username', width: '20%', align: 'center' },
			{ text: 'Hak Aksess', datafield: 'previlage', width: '10%', align: 'center' },
			{ text: 'NIP/NIY', datafield: 'nip', width: '14%', align: 'center' },
			{ text: 'Email', datafield: 'email', width: '16%', align: 'center' },
			{ text: 'Edit', columntype: 'button', width: '5%', cellsrenderer: function () {
				return "Edit";
				}, buttonclick: function (row) {
					editrow = row;	
					var offset 		= $("#gridusername").offset();
					var dataRecord 	= $("#gridusername").jqxGrid('getrowdata', editrow);
					$("#id_idne").val(dataRecord.idne);
					$("#id_pegawai").val(dataRecord.nip);
					$("#id_level").val(dataRecord.previlage);
					$("#id_username").val(dataRecord.username);
					$("#id_pass1").val('');
					$("#id_pass2").val('');
					$("#formtambah").modal('show');
				}
			},
			{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
				return "Del";
				}, buttonclick: function (row) {
					editrow = row;	
					var offset 		= $("#gridusername").offset();		
					var dataRecord 	= $("#gridusername").jqxGrid('getrowdata', editrow);
					swal({
						title: 'Apakah anda yakin ?',
						text: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
						type: 'warning',
						showCancelButton: true,
						confirmButtonClass: 'btn btn-confirm mt-2',
						cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
						confirmButtonText: 'Yes'
					}).then(function () {
						var set01		= dataRecord.idne;
						var set02		= dataRecord.nama;
						var set03		= dataRecord.username;
						var set04		= 'hapus';						
						$.post('exusername', { val01: set01, val02: set02, val03: set03, val04: set04, val05: '', val06: '', _token: token },
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
								$("#gridusername").jqxGrid('updatebounddata');
								return false;
						});
					});
				}
			},
		]
	});
});
</script>
@endpush