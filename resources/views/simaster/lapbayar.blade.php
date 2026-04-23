@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
	<section class="content-header">
        <div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-4">
					<h1 class="m-0"> Pembayaran</h1>
				</div>
				<div class="col-sm-8">
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
    </section>
    <section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div id="status"></div>
					<div class="card card-primary shadow">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-money"></i> Laporan</h3>
							<div class="card-tools">
								<a href="{{ url('lapbayar') }}"><button type="button" class="btn btn-tool"><i class="fa fa-refresh"></i></button></a>
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-2">
									<a href="#" id="btntambahbyr"  class="btn btn-block btn-social btn-info">
										<i class="fa fa-paypal"></i> Input Pembayaran
									</a>
								</div>
								<div class="col-lg-2">
									<a href="#" id="btntambahtagihanmanual"  class="btn btn-block btn-social btn-danger">
										<i class="fa fa-credit-card"></i> Input Tagihan Manual
									</a>
								</div>
								<div class="col-lg-4">
									<div class="form-group row">
										<label for="id_mastertgl" class="col-sm-6 col-form-label">Master Tanggal <span class="text-danger">*</span>:</label>
										<div class="col-sm-6">
											<input type="text" id="id_mastertgl" name="id_mastertgl" class="form-control" value="{{$tanggal}}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask />
										</div>
									</div>
								</div>
								<!--
								<div class="col-lg-3">
									<label>Centang Yang di Inginkan *)</label>
									<a href="#" id="topbtncetakmulti"  class="btn btn-block btn-social btn-info">
										<i class="fa fa-print"></i> Cetak Multi
									</a>
								</div>
								<div class="col-lg-3">
									<label>Centang Yang di Inginkan *)</label>
									<a href="#" id="topbtnverifidmulti"  class="btn btn-block btn-social btn-warning">
										<i class="fa fa-check"></i> Verifikasi Multi
									</a>
								</div>
								-->
							</div>
						</div>
						<div class="card-footer">
							<div class="divlaporanbyr">
								<div id="griddatabayar"></div>
							</div>
							<div class="divrincianortu">
								<div class="col-lg-3">
									<a href="#" id="btnkembali"  class="btn btn-block btn-social btn-warning">
										<i class="fa fa-hand-o-left"></i> Close
									</a>
								</div>
								<div id="gridrincianortu"></div>
							</div>
						</div>
					</div>
					<div class="card card-danger shadow">
						<div class="card-header">
							<h3 class="card-title"><i class="fa fa-money"></i> Tagihan Manual</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
								<button type="button" class="btn btn-tool" data-card-widget="remove" title="Close"><i class="fa fa-times"></i>
							</div>
						</div>
						<div class="card-body">
							<div id="griddatatagihanmanual"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="modal fade" id="modaleditkeuangan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Edit Data Pembayaran</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-8">
							<label>Nama</label>
							<input type="text" id="id_nama" name="id_nama" class="form-control">
						</div> 
						<div class="col-lg-4">
							<label>No.Induk</label>
							<input type="text" id="id_noinduk" name="id_noinduk" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-6">
							<label>Jenis </label>
							<input type="text" id="id_jenis" name="id_jenis" class="form-control" disabled="disable">
						</div>
						<div class="col-lg-6">
							<label>Biaya</label>
							<input type="text" id="id_biaya" name="id_biaya" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Alasan Kenapa diubah *)</label>
					<input type="text" id="id_alasan" name="id_alasan" class="form-control">
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<input type="hidden" class="form-control" id="idform" >
				<button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-info" id="btnsaveeditbyr">Simpan</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalbyrmanual">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Tambah Pembayaran</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Beri Nilai 0 Bila Tidak Dibayarkan, Khusus Insidental bila ada saja baru di pilih.
				<div class="form-group">			 
					<div class="row">
						<div class="col-lg-8">
							<label>Nama</label>
							<input type="text" id="tmbh_nama" name="tmbh_nama" class="form-control">
						</div> 
						<div class="col-lg-4">
							<label>No.Induk</label>
							<input type="text" id="tmbh_noinduk" name="tmbh_noinduk" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Tanggal dan Tahun</label>
					<div class="row">
						<div class="col-lg-6">
							<select id="id_bulan" class="form-control">
								<option value=""></option>
								<option value="Januari">Januari</option>
								<option value="Februari">Februari</option>
								<option value="Maret">Maret</option>
								<option value="April">April</option>
								<option value="Mei">Mei</option>
								<option value="Juni">Juni</option>
								<option value="Juli">Juli</option>
								<option value="Agustus">Agustus</option>
								<option value="September">September</option>
								<option value="Oktober">Oktober</option>
								<option value="November">November</option>
								<option value="Desember">Desember</option>
							</select>
						</div> 
						<div class="col-lg-6">
							<select id="id_tahun" class="form-control" >
								<option value="">Pilih Salah Satu</option>
								<option value="{{ $datethn3 }}">{{ $datethn3 }}</option>
								<option value="{{ $datethn1 }}">{{ $datethn1 }}</option>
								<option value="{{ $datethn2 }}">{{ $datethn2 }}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<input type="text" class="form-control" disabled="disable" value="DPP">
					</div>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="byr_dpp">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<input type="text" class="form-control" disabled="disable" value="SPP">
					</div>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="byr_spp">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<input type="text" class="form-control" disabled="disable" value="Uang Makan">
					</div>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="byr_paguyuban">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<input type="text" class="form-control" disabled="disable" id="namaekskul1">
					</div>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="ekskul1">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<input type="text" class="form-control" disabled="disable" id="namaekskul2">
					</div>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="ekskul2">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<input type="text" class="form-control" disabled="disable" id="namaekskul3">
					</div>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="ekskul3">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<input type="text" class="form-control" disabled="disable" id="namaekskul4">
					</div>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="ekskul4">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<input type="text" class="form-control" disabled="disable" id="namaekskul5">
					</div>
					<div class="col-lg-4">
						<input type="text" class="form-control" id="ekskul5">
					</div>
				</div>
				<div class="form-group">
					<label>Insidental</label>
					<select id="insidental1" name="insidental1" class="form-control" >
						<option value=""></option>
						@foreach($insidentalaktif as $rekstra)
							<option value="{{ $rekstra['id'] }}">{{ $rekstra['deskripsi'] }}</option>
						@endforeach
					</select>
					<select id="insidental2" name="insidental2" class="form-control" >
						<option value=""></option>
						@foreach($insidentalaktif as $rekstra)
							<option value="{{ $rekstra['id'] }}">{{ $rekstra['deskripsi'] }}</option>
						@endforeach
					</select>
					<select id="insidental3" name="insidental3" class="form-control" >
						<option value=""></option>
						@foreach($insidentalaktif as $rekstra)
							<option value="{{ $rekstra['id'] }}">{{ $rekstra['deskripsi'] }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<input type="hidden" class="form-control" id="idform" >
				<button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-info" id="btnbyrmanual">Bayar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalkirim">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Kirim Bukti Bayar</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">			 
					<div class="row">
						<div class="col-lg-8">
							<label>Nama</label>
							<input type="text" id="kirim_nama" name="kirim_nama" class="form-control">
						</div>
						<div class="col-lg-4">
							<label>No.Induk</label>
							<input type="text" id="kirim_noinduk" name="kirim_noinduk" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Link Kwitansi</label>
					<input type="text" id="kirim_link" name="kirim_link" class="form-control">
				</div>
				<div class="form-group">
					<label>Nomer WA Wali Murid (Format +62xxxx)</label>
					<input type="text" id="kirim_hape" name="kirim_hape" class="form-control">
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-info" id="btnkirimwa">Kirim WA</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modaltagihanmanual">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tagihan Manual</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">			 
					<label>Nama</label>
					<select id="manual_nama" name="manual_nama" class="form-control" >
						<option value="">Pilih Salah Satu</option>
						@if(isset($datasiswa) && !empty($datasiswa))
							@foreach($datasiswa as $rsiswa)
								<option value="{{ $rsiswa['id'] }}">{{ $rsiswa['nama'] }} No.Induk ({{ $rsiswa['noinduk'] }})</option>
							@endforeach
						@endif
					</select>
				</div>
				<div class="form-group">
					<label>Jenis Tagihan</label>
					<select id="manual_jenis" name="manual_jenis" class="form-control" >
						<option value="">Pilih Salah Satu</option>
						<option value="spp">SPP</option>
						<option value="dpp">DPP</option>
						<option value="makan">UANG MAKAN</option>
						<option value="kegiatan">KEGIATAN</option>
						<option value="peralatan">PERALATAN</option>
						<option value="ekstrakurikuler">EKSTRAKULIKULER</option>
						<option value="buku">BUKU</option>
						<option value="seragam">SERAGAM</option>
						@foreach($allinsidental as $rowinsidental)
							<option value="{{ $rowinsidental['deskripsi'] }}">{{ $rowinsidental['deskripsi'] }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">			 
					<div class="row">
						<div class="col-lg-6">
							<label>Tagihan</label>
							<input type="text" id="manual_nominal" name="manual_nominal" class="form-control">
						</div>
						<div class="col-lg-4">
							<label>Tenggat Waktu</label>
							<input type="text" id="manual_tanggal" name="manual_tanggal" class="form-control" value="{{date('Y-m-d')}}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<input type="hidden" id="manual_id" name="manual_id" class="form-control">
				<button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-info" id="btnsimpantagihanmanual">Simpan</button>
			</div>
		</div>
	</div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="makhir" id="makhir" value="now">
@endsection
@push('script')
<script>
	$(function () {
        $('#id_mastertgl').inputmask('dd-mm-yyyy', { 'placeholder': 'Tgl bulan Tahun' });
		$('#manual_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'Tgl bulan Tahun' });
	});
	window.opengambar = function(img) {
		var gambarpreview = img.getAttribute("src");
		var newWindow = window.open('', '', 'width=880, height=500'),
			document = newWindow.document.open(),
			pageContent =
				'<!DOCTYPE html>\n' +
				'<html>\n' +
				'<head>\n' +
				'<meta charset="utf-8" />\n' +
				'<title>Biodata Siswa</title>\n' +
				'</head>\n' +
				'<body><img id="gambargede" class="img-responsive" src="' + gambarpreview + '"></body>\n</html>';
			document.write(pageContent);
			document.close();
			return false;
	}
$(document).ready(function () {
	$('.divrincianortu').hide();
	$('.overlay').hide();
	$("#manual_nominal").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#biayadpp").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#biayaspp").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#biayapaguyuban").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#ekskul1").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#ekskul2").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#ekskul3").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#ekskul4").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#ekskul5").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#id_biaya").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
	var token = document.getElementById('token').value;
	$("#topbtncetakmulti").click(function(){
		var rows = $("#griddatabayar").jqxGrid('selectedrowindexes');
		var selectedRecords = new Array();
		for (var m = 0; m < rows.length; m++) {
			var row = $("#griddatabayar").jqxGrid('getrowdata', rows[m]);
			selectedRecords.push(row.no);
		}
		var staff	= '';
		var mstdate	= document.getElementById('id_mastertgl').value;
		if (m == '0'){
			swal({
				title: 'Stop',
				text: 'Mohon Centang Yang Ingin Anda Cetak',
				type: 'warning',
			})
		} else if (mstdate == ''){
			swal({
				title: 'Stop',
				text: 'Tanggal Cetak Mohon di Isi',
				type: 'warning',
			})
		} else {
			$.post('cetak/kwitansimulti', { valkirim: selectedRecords, jeneng: staff, tanggal: mstdate, _token: token },
			function(data){
				var newWindow = window.open('', '', 'width=800, height=500'),
				document = newWindow.document.open(),
					pageContent =
						'<!DOCTYPE html>\n' +
						'<html>\n' +
						'<head>\n' +
						'<meta charset="utf-8" />\n' +
						'<title>Cetak Kwitansi</title>\n' +
						'</head>\n' +
						'<body>' + data + '</body>\n</html>';
				document.write(pageContent);
				document.close();
				newWindow.print();
				return false;
			});
		}
	});
	$("#topbtnverifidmulti").click(function(){
		var rows = $("#griddatabayar").jqxGrid('selectedrowindexes');
		var selectedRecords = new Array();
		for (var m = 0; m < rows.length; m++) {
			var row = $("#griddatabayar").jqxGrid('getrowdata', rows[m]);
			selectedRecords.push(row.no);
		}
		var set02		= '';
		var set03		= document.getElementById('id_mastertgl').value;
		if (m == '0'){
			swal({
				title: 'Stop',
				text: 'Mohon Centang Yang Ingin Anda Cetak',
				type: 'warning',
			})
		} else if (set03 == ''){
			swal({
				title: 'Stop',
				text: 'Tanggal Cetak Mohon di Isi',
				type: 'warning',
			})
		} else {
			$.post('admin/exmultiverified', { val01: selectedRecords, val02: set02, val03: set03, _token: token },
			function(data){
				$('#status').html(data);
				$("#griddatabayar").jqxGrid("updatebounddata");
				return false;
			});
		}
	});
	$("#cetak").click(function () {
		var gridContent = $("#gridrincianortu").jqxGrid('exportdata', 'html');
		var tglcetak = '<?php echo date("j F Y"); ?>';
		var newWindow = window.open('', '', 'width=800, height=500'),
		document = newWindow.document.open(),
		pageContent =
			'<!DOCTYPE html>\n' +
			'<html>\n' +
			'<head>\n' +
			'<meta charset="utf-8" />\n' +
			'<title>Laporan Keuangan</title>\n' +
			'</head>\n' +
			'<body> <h2>laporan Keuangan</h2> <br /> Dicetak Pada Tanggal : ' + tglcetak + '\n' + gridContent + '\n</body>\n</html>';
		document.write(pageContent);
		document.close();
		newWindow.print();
	});
	$('#btntambahbyr').click(function () {	
		var set01	='all';
		var source	 = {
			datatype: "json",
			datafields: [
				{ name: 'id'},	
				{ name: 'noinduk', type: 'text'},
				{ name: 'dpp', type: 'text'},
				{ name: 'kelas', type: 'text'},
				{ name: 'spp', type: 'text'},
				{ name: 'paguyuban', type: 'text'},
				{ name: 'eksul1', type: 'text'},
				{ name: 'eksul2', type: 'text'},
				{ name: 'eksul3', type: 'text'},
				{ name: 'eksul4', type: 'text'}, 
				{ name: 'eksul5', type: 'text'},
				{ name: 'eksul6', type: 'text'},
				{ name: 'biaya1', type: 'text'},
				{ name: 'biaya2', type: 'text'},
				{ name: 'biaya3', type: 'text'},
				{ name: 'biaya4', type: 'text'},
				{ name: 'biaya5', type: 'text'},
				{ name: 'biaya6', type: 'text'},
				{ name: 'nama', type: 'text'},
			],
			type: 'POST',
			data: {val01:set01, _token: token},
			url: "json/setkeuangan"
		};	
		var dataAdapter = new $.jqx.dataAdapter(source);
		$('.divrincianortu').show(); 
		$('.divlaporanbyr').hide(); 
		$("#gridrincianortu").jqxGrid({
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
				{ text: 'Nama', datafield: 'nama', width: '13%', cellsalign: 'left', align: 'center' },
				{ text: 'No.Induk', datafield: 'noinduk', width: '8%', cellsalign: 'center', align: 'center' },
				{ text: 'Kelas', datafield: 'kelas', width: '8%', cellsalign: 'center', align: 'center' },
				{ text: 'DPP', datafield: 'dpp', width: '8%', cellsalign: 'left', align: 'center' },
				{ text: 'SPP', datafield: 'spp', width: '8%', cellsalign: 'left', align: 'center' },
				{ text: 'Uang Makan', datafield: 'paguyuban', width: '8%', cellsalign: 'left', align: 'center' },	
				{ text: 'Ekskul 1', datafield: 'eksul1', width: '8%', align: 'center' },
				{ text: 'Ekskul 2', datafield: 'eksul2', width: '8%', align: 'center' },
				{ text: 'Ekskul 3', datafield: 'eksul3', width: '8%', align: 'center' },
				{ text: 'Ekskul 4', datafield: 'eksul4', width: '8%', align: 'center' },
				{ text: 'Ekskul 5', datafield: 'eksul5', width: '8%', align: 'center' },
				{ text: 'Bayar', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '7%', cellsrenderer: function () {
					return "Bayar";
					}, buttonclick: function (row) {
						editrow = row;
						var offset 		= $("#gridrincianortu").offset();
						var dataRecord 	= $("#gridrincianortu").jqxGrid('getrowdata', editrow);
						$("#tmbh_nama").val(dataRecord.nama);
						$("#tmbh_noinduk").val(dataRecord.noinduk);
						$("#byr_dpp").val(dataRecord.dpp);
						$("#byr_spp").val(dataRecord.spp);
						$("#byr_paguyuban").val(dataRecord.paguyuban);
						$("#namaekskul1").val(dataRecord.eksul1);
						$("#namaekskul2").val(dataRecord.eksul2);
						$("#namaekskul3").val(dataRecord.eksul3);
						$("#namaekskul4").val(dataRecord.eksul4);
						$("#namaekskul5").val(dataRecord.eksul5);
						$("#ekskul1").val(dataRecord.biaya1);
						$("#ekskul2").val(dataRecord.biaya2);
						$("#ekskul3").val(dataRecord.biaya3);
						$("#ekskul4").val(dataRecord.biaya4);
						$("#ekskul5").val(dataRecord.biaya5);
						$("#modalbyrmanual").modal('show');	
					}
				},
			]
		});		
	});
	$('#btnbyrmanual').click(function () {
		var set01=document.getElementById('tmbh_noinduk').value;
		var set02=document.getElementById('byr_dpp').value;
		var set03=document.getElementById('byr_spp').value;
		var set04=document.getElementById('byr_paguyuban').value;
		var set05=document.getElementById('ekskul1').value;
		var set06=document.getElementById('ekskul2').value;
		var set07=document.getElementById('ekskul3').value;
		var set08=document.getElementById('ekskul4').value;
		var set09=document.getElementById('insidental1').value;
		var set10=document.getElementById('id_tahun').value;
		var set11=document.getElementById('id_bulan').value;
		var set12=document.getElementById('insidental2').value;
		var set13=document.getElementById('insidental3').value;
		var set14="{{Session('nama')}}";
		var set15=document.getElementById('ekskul5').value;
		var set16='';
		$.post('admin/manualbyr', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14, val15: set15,val16: set16, _token: token },
		function(data){	
			$("#modalbyrmanual").modal('hide');
			$('#status').html(data);
			$('.divrincianortu').hide();
			$('.divlaporanbyr').show();
			$("#griddatabayar").jqxGrid("updatebounddata", "filter");
			return false;
		});
	});
	$('#btnsaveeditbyr').click(function () {
		var set01=document.getElementById('idform').value;
		var set02=document.getElementById('id_biaya').value;
		var set03='';
		var set04=document.getElementById('id_alasan').value;
		$.post('admin/editorbyr', { val01: set01, val02: set02, val03: set03, val04: set04, _token: token },
		function(data){	
			$("#modaleditkeuangan").modal('hide');
			$("#gridrincianortu").jqxGrid("updatebounddata");		
			$('#status').html(data);
			$("html, body").animate({ scrollTop: 0 }, "slow");		
			return false;
		});
	});
	$('#btnkembali').click(function () {
		$('.divrincianortu').hide();
		$('.divlaporanbyr').show();
		$("#griddatabayar").jqxGrid("updatebounddata", "filter");
	});
	var sourcebiodata = {
		datatype: "json",
		datafields: [
			{ name: 'no',type: 'text'},	
			{ name: 'nama',type: 'text'},
			{ name: 'noinduk',type: 'text'},
			{ name: 'rutin',type: 'text'},
			{ name: 'verifi',type: 'text'},
			{ name: 'total',type: 'text'},
			{ name: 'marking',type: 'text'},
			{ name: 'tanggal',type: 'text'},
			{ name: 'inputor',type: 'text'},
			{ name: 'foto',type: 'text'},
		],
		url: 'json/databayar',
		cache: false,
		pager: function (pagenum, pagesize, oldpagenum) {}
	};
	var datasiswa = new $.jqx.dataAdapter(sourcebiodata);
	var photorenderer = function (row, column, value) {
		var name = $('#griddatabayar').jqxGrid('getrowdata', row).foto;
		if (name == ''){
			var img = '<div style="background: white;"></div>'; 
		}
		else { 
			var img = '<div style="background: white;"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="' + name + '" onclick="opengambar(this)"></div>';
		}
		return img;
	}
	$("#griddatabayar").jqxGrid({
		width				: '100%',
		showfilterrow		: true,
		filterable			: true,
		columnsresize		: true,
		autoshowfiltericon	: true,
		pageable			: true,
		autoheight			: true,
		theme				: "energyblue",
		source				: datasiswa,
		selectionmode		: 'checkbox',
		columns				: [
			{ text: 'View', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
				return "View";
				}, buttonclick: function (row) {		
					editrow = row;	
					var offset 		= $("#griddatabayar").offset();		
					var dataRecord 	= $("#griddatabayar").jqxGrid('getrowdata', editrow);
					var url 		= "{{URL::to("/")}}/kwitansi/"+dataRecord.marking;
					var windowName 	= dataRecord.marking;
					var windowSize 	= "width=800,height=800";
					window.open(url, windowName, windowSize);
				}
			},
			{ text: 'Verified', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
				return "Verified";
				}, buttonclick: function (row) {		
					editrow = row;	
					var offset 		= $("#griddatabayar").offset();		
					var dataRecord 	= $("#griddatabayar").jqxGrid('getrowdata', editrow);						
					var set01		= dataRecord.marking;
					var set02		= dataRecord.noinduk;
					var set03		= '';
					var set04		= document.getElementById('id_mastertgl').value;
					$.post('admin/verifiedpembayaran', { val01: set01, val02: set02, val03: set03, val04: set04, _token: token },			
					function(data){		
						$('#status').html(data);
						$("#griddatabayar").jqxGrid("updatebounddata");
						return false;
					});						 
				}
			},
			{ text: 'Nama', datafield: 'nama', width: '20%', align: 'center' },
			{ text: 'NIS', datafield: 'noinduk', width: '5%', align: 'center' },
			{ text: 'Tagihan', datafield: 'rutin', width: '10%', align: 'center' },
			{ text: 'Total', datafield: 'total', width: '10%', cellsalign: 'right', align: 'center' },
			{ text: 'Tgl.Bayar', datafield: 'tanggal', width: '12%', cellsalign: 'center', align: 'center' },
			{ text: 'Bukti', width: '5%', cellsrenderer: photorenderer, editable: false, sortable: false, filterable: false },
			{ text: 'Verifikasi', datafield: 'verifi', width: '8%', cellsalign: 'center', align: 'center' },
			{ text: 'Inputor', datafield: 'inputor', width: '12%', cellsalign: 'left', align: 'center' },
			{ text: 'EDIT', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
				return "Edit";
				}, buttonclick: function (row) {		
					editrow = row;	
					var offset 		= $("#griddatabayar").offset();		
					var dataRecord 	= $("#griddatabayar").jqxGrid('getrowdata', editrow);						
					var goook		= dataRecord.marking;	
					var sourcerincianbyrortu = {
						datatype: "json",
						datafields: [
							{ name: 'id',type: 'text'},	
							{ name: 'nama',type: 'text'},
							{ name: 'noinduk',type: 'text'},
							{ name: 'rutin',type: 'text'},			
							{ name: 'verifi',type: 'text'},
							{ name: 'biaya',type: 'text'},
							{ name: 'marking',type: 'text'},
							{ name: 'tanggal',type: 'text'},
							{ name: 'jenis',type: 'text'},
							{ name: 'inputor',type: 'text'},
							],
							type: 'POST',
							data: {	val01:goook, _token: token },
							url: 'json/rincianbyrortu',
					};
					var datarincianortu = new $.jqx.dataAdapter(sourcerincianbyrortu);
					var editrow = -1;
					$('.divrincianortu').show();
					$('.divlaporanbyr').hide();
					$("#gridrincianortu").jqxGrid({
						width: '100%',
						source: datarincianortu,
						autoheight: true,
						theme: "orange",
						columnsresize: true,
						selectionmode: 'multiplecellsextended',
						columns: [
							{ text: 'Nama', datafield: 'nama', width: '30%', align: 'center' },
							{ text: 'No.Induk', datafield: 'noinduk', width: '10%', align: 'center' },
							{ text: 'Tagihan', datafield: 'rutin', width: '10%', align: 'center' },
							{ text: 'Biaya', datafield: 'biaya', width: '10%', cellsalign: 'center', align: 'center' },
							{ text: 'Tgl.Bayar', datafield: 'tanggal', width: '10%', cellsalign: 'center', align: 'center' },
							{ text: 'Jenis', datafield: 'jenis', width: '10%', cellsalign: 'left', align: 'center' },
							{ text: 'Inputor', datafield: 'inputor', width: '10%', cellsalign: 'left', align: 'center' },
							{ text: 'UBAH',  editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
								return "Edit";
								}, buttonclick: function (row) {
								editrow = row;
								$('.divrincianortu').show();
								$('.divlaporanbyr').hide();
								var offset 		= $("#gridrincianortu").offset();
								var dataRecord 	= $("#gridrincianortu").jqxGrid('getrowdata', editrow);
									$("#id_nama").val(dataRecord.nama);
									$("#id_noinduk").val(dataRecord.noinduk);
									$("#id_jenis").val(dataRecord.jenis);
									$("#idform").val(dataRecord.id);
									$("#id_biaya").val(dataRecord.biaya);
									$("#modaleditkeuangan").modal('show');	
								}
							},
						]
					});						 
				}
			},
		],                
	});
	$('#btntambahtagihanmanual').click(function () {
		$('#manual_id').val('new');
		$("#modaltagihanmanual").modal('show');
	});
	$('#btnsimpantagihanmanual').click(function () {
		var set02=document.getElementById('manual_nominal').value;
		var set03=document.getElementById('manual_jenis').value;
		var set04=document.getElementById('manual_nama').value;
		var set05=document.getElementById('manual_tanggal').value;
		var set06=document.getElementById('manual_id').value;
		if (set06 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == ''){
			swal({
				title	: 'Warning',
				text	: 'Lengkapi semua isian pada field yang bertanda bintang, apabila ada data yang memang tidak ada mohon memberikan tanda 0 (nol) atau - (strip)',
				type	: 'error',
			});
		} else {
			var formdata = new FormData();
				formdata.set('val01', 'tagihanmanual');
				formdata.set('val02', set02);
				formdata.set('val03', set03);
				formdata.set('val04', set04);
				formdata.set('val05', set05);
				formdata.set('val06', set06);
				formdata.set('_token', '{{ csrf_token() }}');
				$("#modaltagihanmanual").modal('hide');
			$.ajax({
				url         : '{{ route("exEditorbyr") }}',
				data        : formdata,
				type        : 'POST',
				contentType : false,
				processData : false,
				success: function (data) {
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
					$("#griddatatagihanmanual").jqxGrid("updatebounddata");		
					$("html, body").animate({ scrollTop: 0 }, "slow");
					return false;
				},
				error: function (xhr, status, error) {
					swal({
						title	: 'Stop',
						text	: xhr.responseText,
						type	: 'warning',
					})
				}
			});
		}
	});
	var sourcetagihanmanual = {
		datatype: "json",
		datafields: [
			{ name: 'id',type: 'text'},	
			{ name: 'idsiswa',type: 'text'},
			{ name: 'nama',type: 'text'},
			{ name: 'noinduk',type: 'text'},
			{ name: 'klspos',type: 'text'},
			{ name: 'jenis',type: 'text'},
			{ name: 'biaya',type: 'text'},
			{ name: 'nominal',type: 'text'},
			{ name: 'tenggat',type: 'text'},
			{ name: 'marking',type: 'text'},
		],
		url: '{{ route("jsonTagihanManual") }}',
		cache: false,
	};
	var jsonTagihanManual = new $.jqx.dataAdapter(sourcetagihanmanual);
	$("#griddatatagihanmanual").jqxGrid({
		width				: '100%',
		showfilterrow		: true,
		filterable			: true,
		columnsresize		: true,
		autoshowfiltericon	: true,
		pageable			: true,
		autoheight			: true,
		theme				: "energyblue",
		source				: jsonTagihanManual,
		columns				: [
			{ text: 'Nama', datafield: 'nama', width: '20%', align: 'center' },
			{ text: 'No.Induk', datafield: 'noinduk', width: '10%', align: 'center' },
			{ text: 'Jenis', datafield: 'jenis', width: '20%', align: 'center' },
			{ text: 'Nominal', datafield: 'nominal', width: '15%', cellsalign: 'right', align: 'center' },
			{ text: 'Tenggat', datafield: 'tenggat', width: '15%', cellsalign: 'center', align: 'center' },
			{ text: 'Edit',  editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
				return "Edit";
				}, buttonclick: function (row) {
					editrow = row;
					var offset 		= $("#griddatatagihanmanual").offset();
					var dataRecord 	= $("#griddatatagihanmanual").jqxGrid('getrowdata', editrow);
					$("#manual_nama").val(dataRecord.idsiswa);
					$("#manual_jenis").val(dataRecord.jenis);
					$("#manual_nominal").val(dataRecord.biaya);
					$("#manual_tanggal").val(dataRecord.tenggat);
					$("#manual_id").val(dataRecord.id);
					$("#modaltagihanmanual").modal('show');	
				}
			},
			{ text: 'Hapus',  editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
				return "Hapus";
				}, buttonclick: function (row) {
					editrow = row;
					var offset 		= $("#griddatatagihanmanual").offset();
					var dataRecord 	= $("#griddatatagihanmanual").jqxGrid('getrowdata', editrow);
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
							data		: {val01:dataRecord.id, val02:'tagihanmanual',  _token: '{{ csrf_token() }}'},
							dataType	: 'json',
							success: function(response, status, xhr) {
								swal({
									title	: response.status,
									text	: response.message,
									type	: response.icon,
								});
								$("#griddatatagihanmanual").jqxGrid("updatebounddata");	
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
		],
	});
});
</script>
@endpush