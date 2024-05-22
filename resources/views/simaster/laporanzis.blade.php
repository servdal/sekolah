@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-7">
					<h1 class="m-0"> Laporan Amil Zakat, Infaq dan Shodaqoh</h1>
				</div>
				<div class="col-sm-5">
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
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{{ $totalzakat }}</h3>
                            <p>Zakat Fitrah</p>
                        </div>
                        <div class="icon"><i class="fa fa-bus"></i></div>
                        <a href="#" id="topbtnzakatsaja" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $totalmaal }}</h3>
                            <p>Zakat Maal</p>
                        </div>
                        <div class="icon"><i class="fa fa-google-wallet"></i></div>
                        <a href="#" id="topbtnzakatmaalsaja" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $totalsodaqoh }}</h3>
                            <p>Shodaqoh</p>
                        </div>
                        <div class="icon"><i class="fa fa-file"></i></div>
                        <a href="#" id="topbtnshodaqohsaja" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-4" id="sectionutama">
                    <div class="box box-solid bg-green-gradient">
                        <div class="box-header">
                            <i class="fa fa-mortar-board"></i>
                            <h3 class="box-title">Report</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">  						
                                <div class="row">
                                    <div class="col-lg-6">
                                        <select id="cekjenis" class="form-control">
                                            <option value="All">ALL</option>
                                            <option value="Fitrah">Fitrah</option>
                                            <option value="Maal">Maal</option>
                                            <option value="Shodaqoh">Shodaqoh</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <select id="cekbln" class="form-control">
                                            <option value="01">Jan</option>
                                            <option value="02">Feb</option>
                                            <option value="03">Mar</option>
                                            <option value="04">Apr</option>
                                            <option value="05">May</option>
                                            <option value="06">Jun</option>
                                            <option value="07">Jul</option>
                                            <option value="08">Aug</option>
                                            <option value="09">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                            <option value="ALL">ALL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-group margin">
                                        <input type="text" class="form-control" id="cekthn" value="{{ $tahunne }}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-warning btn-flat" type="button" id="btnviewdata">View</button>
                                            <button class="btn btn-danger btn-flat" type="button" id="btnexport">Export</button>
                                            <button class="btn btn-info btn-flat" type="button" id="btnaddnew">Tambah Data Baru</button>
                                        </span>				
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Sebaran Tahun Ini</h3>
                        </div>
                        <div class="card-body">
                            <div id='grafiksebaran' style="width:100%; height:320px;"></div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-danger btn-block" type="button" id="btntambahdatausername">Tambah Akun Admin</button>
							<div id="gridusername"></div>
					    </div>
                    </div>
                </div>
                <div class="col-md-8" id="sectionaksi">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Workarea</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="exportgrid">
                                    <i class="fa fa-print"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="divpesan"></div>
							<div id="tabeldata"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalpengguna">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Add / Edit User Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" id="user_nama" name="user_nama" class="form-control" >
                </div>
                <div class="form-group">
                    <label>Username Yang di Gunakan</label>
                    <input type="text" id="user_username" name="user_username" class="form-control" >
                </div>
                <div class="form-group">
                    <label>Password Yang di Gunakan</label>
                    <input type="text" id="user_password" name="user_password" class="form-control" >
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-success pull-right" id="btnsimpanusername">Simpan</button>
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
                <button type="button" class="btn btn-warning pull-left" id="btnhapusdatausername">Hapus Data</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalhapusdata">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Hapus Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Wali</label>
                    <input type="text" id="hapus_wali" name="hapus_wali" class="form-control" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Nama Siswa</label>
                    <input type="text" id="hapus_siswa" name="hapus_siswa" class="form-control" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" id="hapus_kelas" name="hapus_kelas" class="form-control" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="text" id="hapus_total" name="hapus_total" class="form-control" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Jika Anda Yakin Ingin Menghapus Menu di atas, mohon tulis Password Hapus Data di Bawah Ini</label>
                    <input type="text" id="hapus_verifikasi" name="hapus_verifikasi" class="form-control">			  
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="hapus_id">
                <button type="button" class="btn btn-success pull-right" id="btnhapusdata">HAPUS</button>
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
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
                    <label>Nama Wali</label>
                    <input type="text" id="ver_wali" name="ver_wali" class="form-control" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Nama Siswa</label>
                    <input type="text" id="ver_siswa" name="ver_siswa" class="form-control" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" id="ver_kelas" name="ver_kelas" class="form-control" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="text" id="ver_total" name="ver_total" class="form-control" readonly="readonly">
                </div>
                <div class="form-group">
                    <label>Verifikasi Tanggal</label>
                    <input type="text" id="ver_tanggal" name="ver_tanggal" class="form-control" value="{{ $tanggal }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                </div>
                <div class="form-group">
                    <label>Nama Verifikator</label>
                    <input type="text" id="ver_verifikator" name="ver_verifikator" class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="ver_idne">
	            <button type="button" class="btn btn-success pull-right" id="btnsimpanverifikasi">Verified</button>
		        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaleditdata">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Orang Tua/Wali</label>
                    <input type="text" id="id_namawali" class="form-control">
                </div>
                <div class="form-group">
                    <label>No.HP Orang Tua/Wali</label>
                    <input type="text" id="id_hape" class="form-control">
                </div>
                <div class="form-group">
                    <label>Nama Siswa</label>
                    <input type="text" id="id_namasiswa" class="form-control">
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" id="id_kelas" class="form-control">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>Zakat Fitrah</label>
                            <select id="id_fitrah" name="id_fitrah" class="form-control">
                                <option value="Uang">Berupa Uang</option>
                                <option value="Beras">Berupa Beras</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label>Untuk</label>
                            <select id="id_orang" name="id_orang" class="form-control" >
                                <option value="1">1 Orang</option>
                                <option value="2">2 Orang</option>
                                <option value="3">3 Orang</option>
                                <option value="4">4 Orang</option>
                                <option value="5">5 Orang</option>
                                <option value="6">6 Orang</option>
                                <option value="7">7 Orang</option>
                                <option value="8">8 Orang</option>
                                <option value="9">9 Orang</option>
                                <option value="10">10 Orang</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label>Jumlah (Jumlah Uang / Jumlah Beras dalam (Kg) )</label>
                            <input type="text" id="id_nominal" class="form-control" value="35000">
                        </div>
                    </div>
                </div>
                <label>Zakat Maal (Sesuai dengan Nisob dan Perhitungan)</label>
                <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" id="id_zakatmaal" class="form-control">
                    <span class="input-group-addon">,-</span>
                </div>
                <label>Donasi (sesuai kemampuan)</label>
                <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" id="id_donasi" class="form-control">
                    <span class="input-group-addon">,-</span>
                </div>
                <div class="form-group">
                    <label>Bukti Transfer</label>
                    <input id="fileinput" type="file" accept="image/gif, image/jpeg, image/png" onchange="readURL(this);" />
                </div>
                <div class="form-group">
                    <img id="avatar" class="img-responsive" />
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="id_idne">
                <button type="button" class="btn btn-success pull-right" id="btnsimpan">Simpan</button>
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="setbulan" id="setbulan" value="ALL">
<input type="hidden" name="settahun" id="settahun" value="TAHUNINI">
<input type="hidden" name="setjenis" id="setjenis" value="ALL">
<input type="hidden" name="id_setuang" id="id_setuang" value="35000">
@endsection
@push('script')
<script type="text/javascript">
$(function () {
	$('#ver_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
    
});
function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#avatar').attr('src', e.target.result);
		};
		reader.readAsDataURL(input.files[0]);
	}
}
function openedpage( jQuery ){
	var set01=document.getElementById('setbulan').value;
	var set02=document.getElementById('settahun').value;
	var set03=document.getElementById('setjenis').value;
	var token=document.getElementById('token').value;
	var source = {
		datatype: "json",
		datafields: [
			{ name: 'idne'},
			{ name: 'namawali', type: 'text'},
			{ name: 'hape', type: 'text'},
			{ name: 'namasiswa', type: 'text'},
			{ name: 'kelas', type: 'text'},
			{ name: 'jeniszakat', type: 'text'},
			{ name: 'orang', type: 'text'},
			{ name: 'beras', type: 'text'},
			{ name: 'uang', type: 'text'},
			{ name: 'nominal', type: 'text'},
			{ name: 'zakatmaal', type: 'text'},
			{ name: 'donasi', type: 'text'},
			{ name: 'total', type: 'text'},
			{ name: 'validator', type: 'text'},
			{ name: 'tglvalidasi', type: 'text'},
			{ name: 'namafile', type: 'text'},
		],
		type: 'POST',
		data: {val01: set01, val02: set02, val03: set03, _token: token},
		url: 'jalldata',
	};
	var photorenderer = function (row, column, value) {
		var name = $('#tabeldata').jqxGrid('getrowdata', row).namafile;
		var idne = $('#tabeldata').jqxGrid('getrowdata', row).idne;
		if (name == ''){ var img = '<div style="background: white;"></div>'; }
		else { var img = '<div style="background: white;"><a target="_blank" href="{{URL::to("/")}}/viewlampiran/' + idne + '"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="' + name + '"></a></div>'; }
		return img;
	}
	var dataAdapter = new $.jqx.dataAdapter(source);
	$("#tabeldata").jqxGrid({
		width: '100%',
		pageable: true,
		autoheight: true,
		filterable: true,
		source: dataAdapter,
		columnsresize: true,
		showfilterrow: true,
		rowsheight: 35,
		theme: "energyblue",
		selectionmode: 'multiplecellsextended',
		columns: [
			{ text: 'Tanda Terima', columntype: 'button', width: 70, editable: false, sortable: false, filterable: false, cellsrenderer: function () {
				return "Cetak";
				}, buttonclick: function (row) {
					editrow = row;	
					var offset 		= $("#tabeldata").offset();		
					var dataRecord 	= $("#tabeldata").jqxGrid('getrowdata', editrow);
					var url 		= "{{URL::to("/")}}/verifikasi/"+dataRecord.idne;
					window.open(url);
				}
			},
			{ text: 'Verifikasi', columntype: 'button', width: 70, editable: false, sortable: false, filterable: false, cellsrenderer: function () {
				return "View";
				}, buttonclick: function (row) {		
					editrow = row;	
					var offset 		= $("#tabeldata").offset();		
					var dataRecord 	= $("#tabeldata").jqxGrid('getrowdata', editrow);
					$("#ver_idne").val(dataRecord.idne);
					$("#ver_kelas").val(dataRecord.kelas);
					$("#ver_siswa").val(dataRecord.namasiswa);
					//$("#ver_tanggal").val(dataRecord.tglvalidasi);
					$("#ver_total").val(dataRecord.total);
					$("#ver_wali").val(dataRecord.namawali);
					$("#modalverifikasi").modal('show');
				}
			},
			{ text: 'Bukti', width: 40, cellsrenderer: photorenderer, editable: false, sortable: false, filterable: false },
			{ text: 'Nama Wali', datafield: 'namawali', width: 200, cellsalign: 'left', align: 'center'  },
			{ text: 'Nama Siswa', datafield: 'namasiswa', width: 120, cellsalign: 'left', align: 'center'  },
			{ text: 'Kelas', filtertype: 'checkedlist', datafield: 'kelas', width: 50, cellsalign: 'left', align: 'center'  },
			{ text: 'Jenis', filtertype: 'checkedlist', columngroup: 'fitrah', datafield: 'jeniszakat', width: 70, cellsalign: 'left', align: 'center'  },
			{ text: 'Jiwa', columngroup: 'fitrah', datafield: 'orang', width: 50, cellsalign: 'left', align: 'center'  },
			{ text: 'Beras', columngroup: 'fitrah', datafield: 'beras', width: 70, cellsalign: 'left', align: 'center'  },
			{ text: 'Uang', columngroup: 'fitrah',  cellsformat: 'n', datafield: 'uang', width: 100, cellsalign: 'left', align: 'center'  },
			{ text: 'Zakat Maal', datafield: 'zakatmaal', cellsformat: 'n', width: 100, cellsalign: 'left', align: 'center'  },
			{ text: 'Shodaqoh', datafield: 'donasi', cellsformat: 'n', width: 100, cellsalign: 'left', align: 'center'  },
			{ text: 'Total', datafield: 'total', cellsformat: 'n', width: 100, cellsalign: 'left', align: 'center'  },
			{ text: 'No.HP', datafield: 'hape', width: 100, cellsalign: 'left', align: 'center'  },
			{ text: 'Edit', columntype: 'button', width: 70,  editable: false, sortable: false, filterable: false, align: 'center', cellsrenderer: function () {
				return "Edit";
				}, buttonclick: function (row) {
					editrow = row;	
					var offset 		= $("#tabeldata").offset();
					var dataRecord 	= $("#tabeldata").jqxGrid('getrowdata', editrow);
					$("#id_idne").val(dataRecord.idne);
					$("#id_donasi").val(dataRecord.donasi);
					$("#id_fitrah").val(dataRecord.jeniszakat);
					$("#id_hape").val(dataRecord.hape);
					$("#id_kelas").val(dataRecord.kelas);
					$("#id_namasiswa").val(dataRecord.namasiswa);
					$("#id_namawali").val(dataRecord.namawali);
					$("#id_nominal").val(dataRecord.nominal);
					$("#id_orang").val(dataRecord.orang);
					$("#id_zakatmaal").val(dataRecord.zakatmaal);
					$("#modaleditdata").modal('show');
				}
			},
			{ text: 'Hapus', columntype: 'button', width: 70,  editable: false, sortable: false, filterable: false, align: 'center', cellsrenderer: function () {
				return "Hapus";
				}, buttonclick: function (row) {
					editrow = row;	
					var offset 		= $("#tabeldata").offset();
					var dataRecord 	= $("#tabeldata").jqxGrid('getrowdata', editrow);
					var cekid		= dataRecord.tabel;
					$("#hapus_id").val(dataRecord.idne);
					$("#hapus_kelas").val(dataRecord.kelas);
					$("#hapus_siswa").val(dataRecord.namasiswa);
					$("#hapus_verifikasi").val('');
					$("#hapus_total").val(dataRecord.total);
					$("#hapus_wali").val(dataRecord.namawali);
					$("#modalhapusdata").modal('show');
				}
			},
		],
		columngroups: 
		[
		  { text: 'Zakat Fitrah', align: 'center', name: 'fitrah' },
		]
	});
}
$(document).ready(function () {
	openedpage();
	$("#id_nominal").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
	$("#id_zakatmaal").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
	$("#id_donasi").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
	$("#id_fitrah").on('change', function () {
		var jenis	= $(this).find('option:selected').attr('value');
		var nominal	= document.getElementById('id_setuang').value;
		var orang	= document.getElementById('id_orang').value;
		var nominal	= nominal.toString().replace(",", "");
		if (jenis == 'Uang'){
			var total 	= Math.round((Number(nominal) * Number(orang)));
		} else {
			var total 	= 2.5 * Number(orang);
		}
		$("#id_nominal").val(total);
		
	});
	$("#id_orang").on('change', function () {
		var orang	= $(this).find('option:selected').attr('value');
		var nominal	= document.getElementById('id_setuang').value;
		var jenis	= document.getElementById('id_fitrah').value;
		var nominal	= nominal.toString().replace(",", "");
		if (jenis == 'Uang'){
			var total 	= Math.round((Number(nominal) * Number(orang)));
		} else {
			var total 	= 2.5 * Number(orang);
		}
		$("#id_nominal").val(total);
		
	});
	$("#btnsimpan").click(function(){
		var set01	= document.getElementById('fileinput');
		var set02	= document.getElementById('id_namawali').value;
		var set03	= document.getElementById('id_namasiswa').value;
		var set04	= document.getElementById('id_kelas').value;
		var set05	= document.getElementById('id_fitrah').value;
		var set06	= document.getElementById('id_orang').value;
		var set07	= document.getElementById('id_nominal').value;
		var set08	= document.getElementById('id_zakatmaal').value;
		var set09	= document.getElementById('id_donasi').value;
		var set10	= document.getElementById('id_hape').value;
		var set11	= document.getElementById('id_idne').value;
		var token 	= document.getElementById('token').value;
		if (set02 == ''){
			swal({
				title: 'Stop',
				text: 'Nama Wali Wajib di Isi',
				type: 'warning',
			})
		}
		else if (set07 == ''){
			swal({
				title: 'Stop',
				text: 'Tentukan Nominal Zakat Anda',
				type: 'warning',
			})
		}
		else if (set10 == ''){
			swal({
				title: 'Stop',
				text: 'No. Handphone (WA) Orang Tua Wajib di Isi',
				type: 'warning',
			})
		}
		else if (set03 == ''){
			swal({
				title: 'Stop',
				text: 'Nama Siswa Wajib di Isi',
				type: 'warning',
			})
		}
		else {
			var form_data = new FormData();
			form_data.append('file', set01.files[0]);
			form_data.append('val02', set02);
			form_data.append('val03', set03);
			form_data.append('val04', set04);
			form_data.append('val05', set05);
			form_data.append('val06', set06);
			form_data.append('val07', set07);
			form_data.append('val08', set08);
			form_data.append('val09', set09);
			form_data.append('val10', set10);
			form_data.append('val11', set11);
			form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url: 'exsimpanpendaftaran',
				data: form_data,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					$("#tabeldata").jqxGrid("updatebounddata","filter");
					$("#modaleditdata").modal('hide');
					$('#divpesan').html(data);
					return false;
				},
				error: function (xhr, status, error) {
					swal({
						title: 'Stop',
						text: xhr.responseText,
						type: 'warning',
					})
				}
			});
		}
	});
	$('#btnaddnew').click(function () {
		$("#id_idne").val('new');
		$("#modaleditdata").modal('show');
	});
	$('#btntambahdatausername').click(function () {
		$("#user_idne").val('new');
		$("#modalpengguna").modal('show');
	});
	$('#btnsimpanusername').click(function () {
		var set01=document.getElementById('user_idne').value;
		var set02=document.getElementById('user_nama').value;
		var set03=document.getElementById('user_password').value;
		var set04=document.getElementById('user_username').value;
		var set05=document.getElementById('user_password').value;
		var set06='adminzis';
		var token=document.getElementById('token').value;
		$.post('exusername', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, _token: token },
		function(data){	
			$("#modalpengguna").modal('hide');
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
	$('#btnhapusdatausername').click(function () {
		var set01=document.getElementById('user_idne').value;
		var set02=document.getElementById('user_nama').value;
		var set03=document.getElementById('user_password').value;
		var set04='hapus';
		var token=document.getElementById('token').value;
		$.post('exusername', { val01: set01, val02: set02, val03: set03, val04: set04, val05: '', val06: '',_token: token },
		function(data){	
			$("#modalpengguna").modal('hide');
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
			{ text: 'Nama',  datafield: 'nama', width: '40%', align: 'center' },
			{ text: 'Username', datafield: 'username', width: '40%', align: 'center' },
			{ text: 'Edit', columntype: 'button', width: '20%', cellsrenderer: function () {
				return "Edit";
				}, buttonclick: function (row) {
					editrow = row;	
					var offset 		= $("#gridusername").offset();
					var dataRecord 	= $("#gridusername").jqxGrid('getrowdata', editrow);
					$("#user_idne").val(dataRecord.idne);
					$("#user_nama").val(dataRecord.nama);
					$("#user_username").val(dataRecord.username);
					$("#modalpengguna").modal('show');
				}
			},
		]
	});
	$('#btnsimpanverifikasi').click(function () {
		var set01=document.getElementById('ver_idne').value;
		var set02=document.getElementById('ver_verifikator').value;
		var set03=document.getElementById('ver_tanggal').value;
		var token=document.getElementById('token').value;
		$.post('exverifikasi', { val01: set01, val02: set02, val03: set03, _token: token },
		function(data){	
			$("#modalverifikasi").modal('hide');
			$("#tabeldata").jqxGrid("updatebounddata", "filter");		
			$('#divpesan').html(data);
			$("html, body").animate({ scrollTop: 0 }, "slow");		
			return false;
		});
	});
	$('#btnhapusdata').click(function () {
		var set01=document.getElementById('hapus_id').value;
		var set02=document.getElementById('hapus_verifikasi').value;
		var set03='hapusdata';
		var token=document.getElementById('token').value;
		$.post('exverifikasi', { val01: set01, val02: set02, val03: set03, _token: token },
		function(data){	
			$("#modalhapusdata").modal('hide');
			$("#tabeldata").jqxGrid("updatebounddata", "filter");		
			$('#divpesan').html(data);
			$("html, body").animate({ scrollTop: 0 }, "slow");		
			return false;
		});
	});
	$('#btnexport').click(function(){			
		var gridContent = $("#tabeldata").jqxGrid('exportdata', 'json');
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
	$('#btnviewdata').click(function(){
		var set01=document.getElementById('cekbln').value;
		var set02=document.getElementById('cekthn').value;
		var set03=document.getElementById('cekjenis').value;
		$("#setbulan").val(set01);
		$("#settahun").val(set02);
		$("#setjenis").val(set03);
		openedpage();
	});
	$('#topbtnshodaqohsaja').click(function(){
		$("#setbulan").val('ALL');
		$("#settahun").val('TAHUNINI');
		$("#setjenis").val('Shodaqoh');
		openedpage();
	});
	$('#topbtnzakatmaalsaja').click(function(){
		$("#setbulan").val('ALL');
		$("#settahun").val('TAHUNINI');
		$("#setjenis").val('Maal');
		openedpage();
	});
	$('#topbtnzakatsaja').click(function(){
		$("#setbulan").val('ALL');
		$("#settahun").val('TAHUNINI');
		$("#setjenis").val('Fitrah');
		openedpage();
	});
	var sourcegrafik = {
		datatype: "json",
		datafields: [
			{ name: 'jenis' },				
			{ name: 'jumlah' },			
		],
		url: 'jrekapthnini'
	};
	var datajrekap		= new $.jqx.dataAdapter(sourcegrafik);
	var settinggrafik 	= {
		title: "Statistik Perolehan",
		description: "Zakat, Infaq dan Shodaqoh",
		enableAnimations: true,		
		showBorderLine: true,
		colorScheme: 'scheme03',
		padding: { left: 5, top: 5, right: 5, bottom: 5 },
		titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },		
		source: datajrekap,
		seriesGroups:
		[
			{
				type: 'pie',
				showLabels: true,
				series:
				[
					{
						dataField: 'jumlah',
						displayText: 'jenis',
						labelRadius: 100,
						initialAngle: 15,
						radius: 90,
						centerOffset: 0,
						formatSettings: { decimalPlaces: 1 }
					}
				]
			}
		]
	};
	$('#grafiksebaran').jqxChart(settinggrafik);

});
</script>
@endpush