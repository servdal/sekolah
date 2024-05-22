@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Tagihan Rutin</h1>
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
                <div class="col-md-12">
                    <div id="status"></div>
                    <div class="card card-primary shadow" id="divawal">
                        <div class="card-header">
                            <h3 class="card-title">Pilih Menu Pembayaran Yang Anda Inginkan</h3>
                        </div>
                        <div class="card-body">
                            <p>Tata Cara Pembayaran Secara Online</p>
                            <ol>
                                <li>Klik Pembayaran Yang Ingin Anda Bayarkan</li>
                                <li>Klik Riwayat Pembayaran dan Lihat pada Bulan dan Tahun Bayar Yang Anda Masukkan</li>
                                <li>Klik "View" Kwitansi Untuk Melihat Nominal / Besaran Uang Yang Harus di Bayar</li>
                                <li>Gunakan ATM / E-Banking / Mobile Banking Anda Untuk Melakukan Transfer Ke Nomor Rekening Yang Tertera di Bawah Ini</li>					
                                <li>Setelah Melakukan Transfer, Foto Dan Upload Bukti Pembayaran Dengan Cara Klik "Upload"</li>
                                <li>Anda Bisa Mengetahui apakah pembayaran anda telah diterima (ter verifikasi) atau tidak dengan melihat melalui menu "Riwayat Pembayaran" di bawah ini</li>
                                <li>Pembayaran Lain - Lain Yang <b>Tidak Tercantum</b> dalam Aplikasi Ini, <b>Wajib dibayarkan secara offline ke Sekolah</b></li>
                            </ol>
                        </div>
                        <div class="card-footer">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fa fa-credit-card"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><font color=blue>Bank Account<br />{!! Session('sekolah_nama_sekolah') !!}</font></span>
                                    <span class="info-box-number">{!! $namabank !!}<br />Norek : {!! $norek !!}</span>
                                </div>
                            </div>
                            <div class="btn-group">
                                <a href="#" id="btnviewbyrspp" class="btn btn-app btn-primary">
                                    <i class="fa fa-bicycle"></i> SPP dan Ekstrakulikuler
                                </a>
                                <a href="#" id="btnviewbyrinsidental" class="btn btn-app btn-success">
                                    <i class="fa fa-soccer-ball-o"></i> Insidental
                                </a>
                                <a href="#" id="btnviewrekap" class="btn btn-app btn-warning">
                                    <i class="fa fa-suitcase"></i> Riwayat Pembayaran
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card card-info shadow" id="divbayarrutin">
                        <div class="card-header">
                            <h3 class="card-title">Jenis Tagihan Rutin</h3>
                            <div class="box-tools pull-right">
                                <button class="btn bg-teal btn-sm btnkembali"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group"> 
                                <label>Pilih Nama Siswa</label>
                                <select id="id_siswa" name="id_siswa" class="form-control">
                                    <option value="">Pilih Nama Siswa</option>
                                    @foreach($listanak as $ranak)
                                        <option value="{{ $ranak['noinduk'] }}" id1="{{ $ranak['dpp'] }}" id2="{{ $ranak['spp'] }}" id3="{{ $ranak['paguyuban'] }}" id4="{{ $ranak['eksul1'] }}" id5="{{ $ranak['biaya1'] }}" id6="{{ $ranak['eksul2'] }}" id7="{{ $ranak['biaya2'] }}" id8="{{ $ranak['eksul3'] }}" id9="{{ $ranak['biaya3'] }}" id10="{{ $ranak['eksul4'] }}" id11="{{ $ranak['biaya4'] }}" id12="{{ $ranak['eksul5'] }}" id13="{{ $ranak['biaya5'] }}">{!! $ranak['nama'] !!}</option>
                                    @endforeach
                                </select>
                            </div>		  
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>SPP</label>
                                        <input type="text" id="id_spp" name="id_spp" class="form-control" disabled="disable">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Bulan</label>
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
                                    <div class="col-lg-4">
                                        <label>Tahun</label>
                                        <select id="id_tahun" class="form-control" >
                                            <option value=""></option>
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
									<input type="text" class="form-control" disabled="disable" value="Uang Makan">
								</div>
								<div class="col-lg-4">
									<input type="text" class="form-control" id="byr_paguyuban">
								</div>
							</div>
                            <div class="form-group">
                                <label>Ekstrakulikuler</label>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <input type="text" id="id_ekskul1" name="id_ekskul1" class="form-control" placeholder="Ekstrakulikuler 1" disabled="disable">
                                    </div> 
                                    <div class="col-lg-4">
                                        <input type="text" id="id_nil1" name="id_nil2" class="form-control" placeholder="Biaya Eks. 1" disabled="disable">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <input type="text" id="id_ekskul2" name="id_ekskul2" class="form-control" placeholder="Ekstrakulikuler 2" disabled="disable">
                                    </div> 
                                    <div class="col-lg-4">
                                        <input type="text" id="id_nil2" name="id_nil2" class="form-control" placeholder="Biaya Eks. 2" disabled="disable">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <input type="text" id="id_ekskul3" name="id_ekskul3" class="form-control" placeholder="Ekstrakulikuler 3" disabled="disable">
                                    </div> 
                                    <div class="col-lg-4">
                                        <input type="text" id="id_nil3" name="id_nil3" class="form-control" placeholder="Biaya Eks. 3" disabled="disable">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <input type="text" id="id_ekskul4" name="id_ekskul4" class="form-control" placeholder="Ekstrakulikuler 4" disabled="disable">
                                    </div> 
                                    <div class="col-lg-4">
                                        <input type="text" id="id_nil4" name="id_nil4" class="form-control" placeholder="Biaya Eks. 4" disabled="disable">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <input type="text" id="id_ekskul5" name="id_ekskul5" class="form-control" placeholder="Ekstrakulikuler 5" disabled="disable">
                                    </div> 
                                    <div class="col-lg-4">
                                        <input type="text" id="id_nil5" name="id_nil5" class="form-control" placeholder="Biaya Eks. 5" disabled="disable">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pilih Pembayaran</label>
                                <select id="id_byrapa" class="form-control">
                                    <option value="all">Bayar SPP dan Ekstrakulikuler</option>
                                    <option value="sppsaja">Bayar SPP Saja</option>
                                    <option value="eksulsaja">Bayar Ekstrakulikuler Saja</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-info" id="bayarrutinan">Simpan</button>
                        </div>
                        <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
                    </div>
                    <div class="card card-warning shadow" id="divbayarinsidental">
                        <div class="card-header">
                            <h3 class="card-title">Tagihan Insidental</h3>
                            <div class="box-tools pull-right">
                                <button class="btn bg-teal btn-sm btnkembali"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            Tidak Semua Yang Tertera di bawah ini, merupakan kewajiban Bapak/Ibu Untuk membayar. Cek Deskripsi jenis pembayaran dan jika sesuai dengan kondisi Anak Ibu, baru klik bayar
                            <div id="griddatainsidental"></div>
                        </div>
                        <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
                    </div>
                    <div class="card card-danger shadow" id="divriwayat">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Pembayaran</h3>
                            <div class="box-tools pull-right">
                                <button class="btn bg-teal btn-sm btnkembali"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            Jika Kolom Verifikasi Berarti Anda Belum Menyetorkan Uang Ke Loket TU !! {!! Session('sekolah_nama_sekolah') !!} atau Petugas Loket TU Belum Mengklik tombol Verifikasi di sistem
                            <div id="griddatabayar"></div>
                        </div>
                        <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
                    </div>
                    <div class="card card-success shadow" id="divtambahinsidental">
                        <div class="card-header">
                            <h3 class="card-title">Pembayaran Insidental</h3>
                            <div class="box-tools pull-right">
                                <button class="btn bg-teal btn-sm btnkembali"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
							  <label>Tanggal dan Tahun</label>
							  <div class="row">
								  <div class="col-lg-6">
									<select id="ins_bulan" class="form-control">
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
									<select id="ins_tahun" class="form-control" >
										<option value="">Pilih Tahun</option>
										<option value="{{ $datethn3 }}">{{ $datethn3 }}</option>
										<option value="{{ $datethn1 }}">{{ $datethn1 }}</option>
										<option value="{{ $datethn2 }}">{{ $datethn2 }}</option>
									</select>
								  </div>
							  </div>
							</div>
							<div class="form-group">
								<label>Deskripsi</label>
								<input type="text" id="byr_deskripsi" name="byr_deskripsi" class="form-control" disabled="disable">
							</div>
							<div class="form-group">
								<label>Bayar</label>
								<input type="text" id="byr_insidentil" name="byr_insidentil" class="form-control">	
								<p> Bila Bapak/Ibu ingin mencicil silahkan ubah angka diatas sesuai dengan kemampuan Bapak/Ibu</p>
							</div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" class="form-control" id="kodeinsidental" >
                            <input type="hidden" class="form-control" id="indukinsidental" >
                            <button type="button" class="btn btn-info" id="byrinsedental">Bayar</button>
                        </div>
                        <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
                    </div>
                    <div class="card card-danger shadow" id="divuploadbukti">
                        <div class="card-header">
                            <h3 class="card-title">Upload Bukti Pembayaran</h3>
                            <div class="box-tools pull-right">
                                <button class="btn bg-teal btn-sm btnkembali"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
								<label>Bulan dan Tahun Bayar</label>
								<input type="text" id="upl_deskripsi" name="upl_deskripsi" class="form-control" disabled="disable">
							</div>
							<div class="form-group">
								<label>Total Bayar</label>
								<input type="text" id="upl_total" name="upl_total" class="form-control" disabled="disable">
							</div>
							<div class="form-group">
								<label>Foto Bukti Pembayaran</label>
								<input id="fileinput" type="file" accept="image/gif, image/jpeg, image/png" onchange="readURL(this);" />
							</div>
							<div class="form-group">
								<img id="avatar" class="img-responsive" />
							</div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" class="form-control" id="upl_marking" name="upl_marking">
                            <button type="button" class="btn btn-success" id="btnsimpanupload">Simpan</button>
                        </div>
                        <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" id="getnama" value="{!! Session('nama') !!}">
<input type="hidden" id="getfoto">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>

@endsection
@push('script')
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#avatar').attr('src', e.target.result);
				$('#getfoto').val(e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
$(document).ready(function () {
	$('.overlay').hide();
	$('#divbayarinsidental').hide();
	$('#divbayarrutin').hide();
	$('#divriwayat').hide();
	$('#divuploadbukti').hide();
	$('#divtambahinsidental').hide();
	$("#byr_insidentil").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
	$("#byr_dpp").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
	$("#byr_paguyuban").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
	$('.btnkembali').on('click', function (){		
		$('#divbayarinsidental').hide();
		$('#divbayarrutin').hide();
		$('#divriwayat').hide();
		$('#divtambahinsidental').hide();
		$('#divuploadbukti').hide();
		$('#divawal').show();
	});
	$('#btnviewbyrinsidental').on('click', function (){		
		$('#divbayarinsidental').show();
		$('#divbayarrutin').hide();
		$('#divriwayat').hide();
		$('#divtambahinsidental').hide();
		$('#divuploadbukti').hide();
		$('#divawal').hide();
	});
	$('#btnviewbyrspp').on('click', function (){		
		$('#divbayarinsidental').hide();
		$('#divbayarrutin').show();
		$('#divriwayat').hide();
		$('#divtambahinsidental').hide();
		$('#divuploadbukti').hide();
		$('#divawal').hide();
	});
	$('#btnviewrekap').on('click', function (){		
		$('#divbayarinsidental').hide();
		$('#divbayarrutin').hide();
		$('#divriwayat').show();
		$('#divtambahinsidental').hide();
		$('#divuploadbukti').hide();
		$('#divawal').hide();
	});
	var token=document.getElementById('token').value;
	$('#btnsimpanupload').on('click', function (){		
		$('.overlay').show();
		var set01=document.getElementById('upl_marking').value;
		var set02=document.getElementById('getfoto').value;
		if (set02 == ''){
			swal({
				title	: 'Stop',
				text	: 'Pilih File Bukti Bayar Terlebih Dahulu',
				type	: 'info',
			})
		} else {
			$.post('{{ route("exUploadbuktibyr") }}', { val01: set01, val02: set02, _token: token },
			function(data){	
				$('.overlay').hide();
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#status').html(data);
				$("#griddatabayar").jqxGrid("updatebounddata");
				$('#divbayarinsidental').hide();
				$('#divbayarrutin').hide();
				$('#divriwayat').hide();
				$('#divtambahinsidental').hide();
				$('#divuploadbukti').hide();
				$('#divawal').show();
			});
		}
	});
	$('#bayarrutinan').on('click', function (){		
		$('.overlay').show();
		var set01=document.getElementById('id_siswa').value;
		var set02=document.getElementById('id_bulan').value;
		var set03=document.getElementById('id_tahun').value;
		var set04=document.getElementById('getnama').value;
		var set05=document.getElementById('id_byrapa').value;
		var set06=document.getElementById('byr_dpp').value;
		var set07=document.getElementById('byr_paguyuban').value;
		$.post('{{ route("exBayariuran") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, _token: token },
		function(data){	
			$('.overlay').hide();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#status').html(data);
			$("#griddatabayar").jqxGrid("updatebounddata");
			$('#divbayarinsidental').hide();
			$('#divbayarrutin').hide();
			$('#divriwayat').hide();
			$('#divtambahinsidental').hide();
			$('#divuploadbukti').hide();
			$('#divawal').show();
		});		
	});
	$('#byrinsedental').on('click', function (){
		$('.overlay').show();
		var set01=document.getElementById('ins_bulan').value;
		var set02=document.getElementById('ins_tahun').value;
		var set03=document.getElementById('byr_insidentil').value;
		var set04=document.getElementById('kodeinsidental').value;
		var set05=document.getElementById('indukinsidental').value;
		var set06=document.getElementById('getnama').value;
		$.post('{{ route("exBayariuranins") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, _token: token },
		function(data){	
			$('.overlay').hide();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#status').html(data);
			$("#griddatabayar").jqxGrid("updatebounddata");
			$("#griddatainsidental").jqxGrid("updatebounddata");
			$('#divbayarinsidental').hide();
			$('#divbayarrutin').hide();
			$('#divriwayat').hide();
			$('#divtambahinsidental').hide();
			$('#divuploadbukti').hide();
			$('#divawal').show();
		});		
	});
	$("#id_siswa").on('change', function () {	
		var dppne = $(this).find('option:selected').attr('id1');	
		var sppne = $(this).find('option:selected').attr('id2');
		var pagye = $(this).find('option:selected').attr('id3');
		var skul1 = $(this).find('option:selected').attr('id4');
		var biya1 = $(this).find('option:selected').attr('id5');
		var skul2 = $(this).find('option:selected').attr('id6');
		var biya2 = $(this).find('option:selected').attr('id7');
		var skul3 = $(this).find('option:selected').attr('id8');
		var biya3 = $(this).find('option:selected').attr('id9');
		var skul4 = $(this).find('option:selected').attr('id10');
		var biya4 = $(this).find('option:selected').attr('id11');
		var skul5 = $(this).find('option:selected').attr('id12');
		var biya5 = $(this).find('option:selected').attr('id13');
		$('#id_spp').val(sppne);
		$('#byr_dpp').val(dppne);
		$('#byr_paguyuban').val(pagye);
		$('#id_ekskul1').val(skul1);
		$('#id_nil1').val(biya1);
		$('#id_ekskul2').val(skul2);
		$('#id_nil2').val(biya2);
		$('#id_ekskul3').val(skul3);
		$('#id_nil3').val(biya3);
		$('#id_ekskul4').val(skul4);
		$('#id_nil4').val(biya4);
		$('#id_ekskul5').val(skul5);
		$('#id_nil5').val(biya5);
	});	
    var sourceinsidental = {
		datatype: "json",
		datafields: [
			{ name: 'no',type: 'text'},	
			{ name: 'kode',type: 'text'},
			{ name: 'deskripsi',type: 'text'},
			{ name: 'biaya',type: 'text'},	
			{ name: 'noinduk',type: 'text'},
		],
		url		: '{{ route("jsonInsidental") }}',
		cache	: false,
		pager	: function (pagenum, pagesize, oldpagenum) {}
	};
	var datainsidental = new $.jqx.dataAdapter(sourceinsidental);
	var editrow = -1;
	$("#griddatainsidental").jqxGrid({
		width: '100%',   
		columnsresize: true,
		theme: "energyblue",
		source: datainsidental,
		selectionmode: 'multiplecellsextended',
		columns: [		
			{ text: 'Deskripsi', datafield: 'deskripsi', width: '75%', align: 'center' },
			{ text: 'Biaya', datafield: 'biaya', width: '15%', cellsalign: 'right', align: 'center' },			
			{ text: 'Bayar', columntype: 'button', width: '10%', cellsrenderer: function () {
				return "Bayar";
				}, buttonclick: function (row) {	
					editrow = row;	
					var offset 		= $("#griddatainsidental").offset();
					var dataRecord 	= $("#griddatainsidental").jqxGrid('getrowdata', editrow);
					$("#byr_deskripsi").val(dataRecord.deskripsi);
					$("#byr_insidentil").val(dataRecord.biaya);
					$("#kodeinsidental").val(dataRecord.kode);
					$("#indukinsidental").val(dataRecord.noinduk);
					$('#divbayarinsidental').hide();
					$('#divbayarrutin').hide();
					$('#divriwayat').hide();
					$('#divtambahinsidental').show();
					$('#divawal').hide();
				}
			},	
		],                
	});
    var sourcepembayaran = {
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
			{ name: 'foto',type: 'text'},
		],
		url: '{{ route("jsonDatabayarortu") }}',
		cache: false,
		pager: function (pagenum, pagesize, oldpagenum) {}
	};
	var datapembayaran = new $.jqx.dataAdapter(sourcepembayaran);
	var editrow = -1;
	var photorenderer = function (row, column, value) {
		var no 	= $('#griddatabayar').jqxGrid('getrowdata', row).no;
		var name = $('#griddatabayar').jqxGrid('getrowdata', row).foto;
		if (name == ''){ var img = '<div style="background: white;"></div>'; }
		else { var img = '<div style="background: white;"><a target="_blank" href="{{url('/')}}/buktibayar/' + no + '"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="' + name + '"></a></div>'; }
		return img;
	}
	$("#griddatabayar").jqxGrid({
		width			: '100%',   
		columnsresize	: true,
		autoheight		: true,
		altrows			: true,
		theme			: "orange",
		rowsheight		: 35,
		source			: datapembayaran,
		selectionmode	: 'multiplecellsextended',
		columns			: [
			{ text: 'Upload', columntype: 'button', width: '10%', cellsrenderer: function () {
				return "Upload";
				}, buttonclick: function (row) {	
					editrow 		= row;	
					var offset 		= $("#griddatabayar").offset();		
					var dataRecord 	= $("#griddatabayar").jqxGrid('getrowdata', editrow);
					var gbrkosong	= 'dist/img/default-50x50.gif';
					var verifi		= dataRecord.verifi;
					if (verifi == ''){
						$("#upl_deskripsi").val(dataRecord.rutin);	
						$("#upl_total").val(dataRecord.total);	
						$("#upl_marking").val(dataRecord.marking);
						$("#getfoto").val('');
						$("#avatar").attr("src",gbrkosong);
						$("#indukinsidental").val(dataRecord.noinduk);	
						$('#divbayarinsidental').hide();
						$('#divbayarrutin').hide();
						$('#divriwayat').hide();
						$('#divtambahinsidental').hide();
						$('#divuploadbukti').show();
						$('#divawal').hide();
						
					} else {
						swal({
							title	: 'Stop',
							text	: 'Kwitansi ini telah di verifikasi, upload bukti sudah tidak diperlukan lagi',
							type	: 'info',
						})
					}
					
				}
			},	
			{ text: 'Nama', datafield: 'nama', width: '20%', align: 'center' },
			{ text: 'Tagihan', datafield: 'rutin', width: '10%', align: 'center' },
			{ text: 'Total', datafield: 'total', width: '10%', cellsalign: 'right', align: 'center' },
			{ text: 'Tgl.Bayar', datafield: 'tanggal', width: '15%', cellsalign: 'left', align: 'center' },
			{ text: 'Verifikasi', datafield: 'verifi', width: '15%', cellsalign: 'left', align: 'center' },
			{ text: 'Bukti', width: '10%', cellsrenderer: photorenderer, editable: false, sortable: false, filterable: false },
			{ text: 'Kwitansi', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
				return "Save";
				}, buttonclick: function (row) {
					editrow 		= row;
					var offset 		= $("#griddatabayar").offset();
					var dataRecord 	= $("#griddatabayar").jqxGrid('getrowdata', editrow);
					var goook		= dataRecord.marking;
					var verifi		= dataRecord.verifi;
					if (verifi == ''){
						swal({
							title	: 'Stop',
							text	: 'Kwitansi ini belum di verifikasi, mohon menghubungi staf administrasi untuk di proses verifikasi',
							type	: 'info',
						})
					} else {
						var url 		= "{{URL::to("/")}}/kwitansi/"+goook;
						var windowName 	= goook;
						var windowSize 	= "width=800,height=800";
						window.open(url, windowName, windowSize);
						event.preventDefault();
					}
				}
			},		
		],                
	});
});
</script>
@endpush