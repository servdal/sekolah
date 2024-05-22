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
            <div class="row" >
                <div class="col-md-4">
                    <div id="status"></div>
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Permohonan Ijin</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group"> 
								<label>Pilih Nama Siswa</label>
								<select id="id_siswa" name="id_siswa" class="form-control" >
									<option value="">Pilih Siswa</option>
									@foreach($datasiswa as $rsiswa)
										<option value="{{ $rsiswa['noinduk'] }}">{{ $rsiswa['nama'] }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-lg-6">
										<label>Ijin Pada Tanggal</label>
										<input type="text" id="id_tanggal" class="form-control" value="{{ $tanggal }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
									</div>
									<div class="col-lg-6">
										<label>Ijin Selama (Hari)</label>
										<select id="id_selama" class="form-control">
										  <option value="1">1 Hari</option>
										  <option value="2">2 Hari</option>
										  <option value="3">3 Hari</option>
										  <option value="4">4 Hari</option>
										  <option value="5">5 Hari</option>
										  <option value="6">6 Hari</option>
										  <option value="7">7 Hari</option>
										  <option value="8">8 Hari</option>
										  <option value="9">9 Hari</option>
										  <option value="10">10 Hari</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group"> 
								<label>Dikarenakan.?</label>
								<textarea id="id_alasan" rows="10" cols="80"></textarea>
							</div>
							<div class="form-group"> 
								<label>Pemohon</label>
								<input type="text" id="id_pemohon" class="form-control" placeholder="Nama Lengkap Orang Tua/Wali" value="{!! Session('nama') !!}">
							</div>
							<div class="form-group"> 
								<label>Tanda Tangan Orang Tua</label>
							</div>
							<div class="kotakttd">
								<img src="dist/img/boxed-bg.jpg" width=320 height=200 />	
								<canvas id="id_ttd" class="signature-pad" width=320 height=200></canvas>
								<canvas id="id_ttdblank" class="signature-pad" width=320 height=200 style='display:none'></canvas>
							</div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-info" id="btnclearttd">Clear</button>
                            <button type="button" class="btn btn-success pull-right" id="btnsimpanttd">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Data Presensi Siswa</h3>
                        </div>
                        <div class="card-body">
                            <div id="message"></div>
                            <button type="button" class="btn btn-danger btn-xs" id="btnviewrekap">Tampilkan Data Presensi</button>
                        </div>
                        <div class="card-footer">
                            <div id="divawal">
                                <div id="gridnonhadir"></div>
                            </div>
                            <div id="divpencarian">
                                <div id="gridpencarian"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<style>
    .kotakttd {
        position: relative;
        width: 320px;
        height: 200px;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: solid 1px #ddd;
        margin: 10px 0px;
    }
    .signature-pad {
        position: absolute;
        left: 0;
        top: 0;
        width:320px;
        height:200px;
    }
</style>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script src="{{ asset('plugins/signature_pad/signature_pad.js') }}"></script>
<script type="text/javascript">
	$(function () {
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace( 'id_alasan', {
			toolbarGroups: [{"name":"paragraph","groups":["list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
		$('#id_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
$(document).ready(function () {
	$('.overlay').hide();
	$('#divpencarian').hide();
	var ttdPad = new SignaturePad(document.getElementById('id_ttd'), {
	  backgroundColor: 'rgba(255, 255, 255, 0)',
	  penColor: 'rgb(0, 0, 0)'
	});
	$('#btnsimpanttd').on('click', function (){		
		var set01 = ttdPad.toDataURL('image/png');
		if (set01 == document.getElementById('id_ttdblank').toDataURL()){ set01 = ''; }
		var set02 = '';
		var set03 = document.getElementById('id_siswa').value;
		var set04 = document.getElementById('id_tanggal').value;
		var set05 = document.getElementById('id_selama').value;
		var set06 = CKEDITOR.instances['id_alasan'].getData()
		var set07 = document.getElementById('id_pemohon').value;
		var token = document.getElementById('token').value;
		if (set01 == ''){
			swal({
				title: 'Stop',
				text: 'Mohon Tanda Tangani Surat Anda',
				type: 'warning',
			})
		}
		else if (set03 == ''){
			swal({
				title: 'Stop',
				text: 'Mohon Pilih Siswa Yang dimohonkan Ijin',
				type: 'warning',
			})
		}
		else if (set04 == ''){
			swal({
				title: 'Stop',
				text: 'Mohon Pilih Tanggal Ijin',
				type: 'warning',
			})
		}
		else if (set06 == ''){ 
			swal({
				title: 'Stop',
				text: 'Alasan Wajib di Cantumkan',
				type: 'warning',
			})
		}
		else if (set07 == ''){ 
			swal({
				title: 'Stop',
				text: 'Nama Lengkap Pemohon Wajib di Cantumkan',
				type: 'warning',
			})
		}
		else {
			$.post('ortu/exsimpanijin', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, _token: token },
			function(data){
				$('#message').html(data);
				ttdPad.clear();
				$("#gridnonhadir").jqxGrid('updatebounddata');
				return false;       
			});
		}
	});
	$('#btnclearttd').on('click', function (){		
		ttdPad.clear();
	});
	$('#btnviewrekap').click(function () {
		var set01=document.getElementById('id_siswa').value;
		var token=document.getElementById('token').value;
		if (set01 == ''){
			swal({
				title: 'Stop',
				text: 'Mohon Pilih Siswa Terlebih Dahulu',
				type: 'warning',
			})
		} else {
			var source = {
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
					{ name: 'tapel', type: 'text'},
				],
				type: 'POST',
				data: {val01:set01, val02:'persiswa', _token: token},
				url: "json/dataabsenkelas",
			};
			$('#divawal').show();
			$('#divpencarian').hide();
			var dataAdapter = new $.jqx.dataAdapter(source);
			$("#gridnonhadir").jqxGrid({
				width: '100%',   
				columnsresize: true,
				theme: "energyblue",
				autoheight: true,
				altrows: true,
				source: dataAdapter,
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
							var offset 		= $("#gridnonhadir").offset();
							var dataRecord 	= $("#gridnonhadir").jqxGrid('getrowdata', editrow);
							var set01		= dataRecord.noinduk;
							var set02		= 'persiswa';
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
							$('#divawal').hide();
							$('#divpencarian').show();
							var datarincianharian = new $.jqx.dataAdapter(sourcerinciannilai);
							var editrow = -1;
							$("#gridpencarian").jqxGrid({
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
											var offset 		= $("#gridpencarian").offset();		
											var dataRecord 	= $("#gridpencarian").jqxGrid('getrowdata', editrow);
											var set01		= dataRecord.surat;
											if (set01 == ''){
												swal({
													title: 'Stop',
													text: 'Tidak ada surat yang diajukan',
													type: 'warning',
												})
											} else {
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
										}
									},
									{ text: 'KLS', datafield: 'kelas', width: '5%', align: 'center' },
									{ text: 'Nama', datafield: 'nama', width: '29%', align: 'center' },
									{ text: 'Tanggal', datafield: 'tanggal', width: '12%', cellsalign: 'left', align: 'center'},
									{ text: 'Keterangan', datafield: 'alasan', width: '15%', cellsalign: 'left', align: 'center'},	
									{ text: 'TAPEL', datafield: 'tapel', width: '12%', cellsalign: 'left', align: 'center' },
									{ text: 'Inputor', datafield: 'inputor', width: '11%', cellsalign: 'left', align: 'center' },
									{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
										return "Del";
										}, buttonclick: function (row) {
											editrow = row;	
											var offset 		= $("#gridpencarian").offset();		
											var dataRecord 	= $("#gridpencarian").jqxGrid('getrowdata', editrow);
											var set01		= dataRecord.tapel;
											if (set01 == ''){
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
													var set02		= 'ijinortu';
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
															$("#gridpencarian").jqxGrid('updatebounddata');
															return false;
													});
												});
											} else {
												swal({
													title: 'Stop',
													text: 'Data Yang Telah di Validasi TU, Tidak Bisa di Ubah',
													type: 'warning',
												})
											}					
										}
									},
								]
							});
						}
					},
				]
			});
		}
	});
});
</script>
@endpush