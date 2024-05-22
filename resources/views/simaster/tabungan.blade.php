@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> TABUNGAN</h1>
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
                    @if(Session::has('message'))
                        <div class="alert {{ Session::get('alert-class') }} alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> {{ Session::get('status') }}</h4>
                                {!! Session::get('message') !!}
                        </div>
                    @endif
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">MENABUNG</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group"> 
								<label>Pilih Nama Siswa</label>
								<select id="id_siswa" name="id_siswa" class="form-control" >
									<option value="">Pilih salah satu</option>
									@foreach($datasiswa as $rsiswa)
										<option value="{{ $rsiswa['noinduk'] }}">{{ $rsiswa['nama'] }}</option>
									@endforeach			  
								</select>
							</div>		  
							<div class="form-group"> 
								<label>Sebanyak (Rupiah)</label>
								<input type="text" id="id_tabung" name="id_tabung" class="form-control">
							</div>	
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-info" id="tabungkan">Simpan</button>
						</div>
                    </div>
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">MENARIK TABUNGAN</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group"> 
								<label>Pilih Nama Siswa</label>
								<select id="id_siswa2" name="id_siswa2" class="form-control" >
									<option value=""></option>
									@foreach($datasiswa as $rsiswa)
										<option value="{{ $rsiswa['noinduk'] }}">{{ $rsiswa['nama'] }}</option>
									@endforeach
								</select>
							</div>		  
							<div class="form-group"> 
								<label>Diambil Sebanyak (Rupiah)</label>
								<input type="text" id="id_tarik" name="id_tarik" class="form-control">
							</div>	
							<div class="form-group"> 
								<label>Keperluan</label>
								<input type="text" id="id_perlu" name="id_perlu" class="form-control">
							</div>	
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-danger" id="tarikan">Simpan</button>	
						</div>
                    </div>
                    <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
                </div>
                <div class="col-md-8">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Tabungan Putra/Putri Bapak/Ibu</h3>
                        </div>
                        <div class="card-body">
                            <div id="gridtabungansiswa"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<input type="hidden" id="getnama" value="{!! Session('nama') !!}">
<input type="hidden" id="getfoto">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
$(document).ready(function () {
	$('.overlay').hide();
	$("#id_tabung").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#id_tarik").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	var token=document.getElementById('token').value;
	$('#tarikan').on('click', function (){		
		$('.overlay').show();
		var set01=document.getElementById('id_siswa2').value;
		var set02=document.getElementById('id_tarik').value;
		var set03=document.getElementById('id_perlu').value;
		var set06=document.getElementById('getnama').value;
		if (set03 == ''){
			$('.overlay').hide();
			swal({
				title: 'Stop',
				text: 'Keperluan Pengambilan Tabungan Wajib di Isi',
				type: 'warning',
			})
		} else if (set02 == ''){
			$('.overlay').hide();
			swal({
				title: 'Stop',
				text: 'Nominal Pengambilan Tabungan Wajib di Isi',
				type: 'warning',
			})	
		} else {
			$.post('admin/tabung', { val01: set01, val02: set02, val03: set03, val04: 'tarik', val05: '', val06: set06, _token: token },
			function(data){
				$('.overlay').hide();
				$('#laporantabungan').show(); 
				$('#tambahtabungan').hide();
				$('#gridtabunganpersiswa').show();
				$("#modalnarik").modal('hide');
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#status').html(data);
				$("#gridtabungansiswa").jqxGrid("updatebounddata");
			});
		}
	});
	$('#tabungkan').on('click', function (){
		$('.overlay').show();
		var set01=document.getElementById('id_siswa').value;
		var set02=document.getElementById('id_tabung').value;
		var set06=document.getElementById('getnama').value;
		if (set02 == ''){
			swal({
				title: 'Stop',
				text: 'Nominal Tabungan Wajib di Isi',
				type: 'warning',
			})	
		} else {
			$.post('admin/tabung', { val01: set01, val02: set02, val03: '', val04: 'tabung', val05: '', val06: set06, _token: token },
			function(data){
				$('.overlay').hide();
				$('#laporantabungan').show(); 
				$('#tambahtabungan').hide();
				$('#gridtabunganpersiswa').show();
				$("#modalnabung").modal('hide');
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#status').html(data);
				$("#gridtabungansiswa").jqxGrid("updatebounddata");
			});
		}	
	});
    var sourcetabungan = {
		datatype: "json",
		datafields: [
			{ name: 'id',type: 'text'},	
			{ name: 'nama',type: 'text'},
			{ name: 'noinduk',type: 'text'},
			{ name: 'debet',type: 'text'},	
			{ name: 'kredit',type: 'text'},
			{ name: 'keterangan',type: 'text'},
			{ name: 'verified',type: 'text'},
			{ name: 'marking',type: 'text'},
			{ name: 'inputor',type: 'text'},
		],
		url: 'json/tabungan',
		cache: false,
		
	};
	var datatabungan = new $.jqx.dataAdapter(sourcetabungan);
	var editrow = -1;
	$("#gridtabungansiswa").jqxGrid({
		width: '100%',   
		columnsresize: true,
		theme: "energyblue",
		autoheight: true,
		showstatusbar: true,
        statusbarheight: 50,
		altrows: true,
		source: datatabungan,
		showaggregates: true,
		selectionmode: 'singlecell',
		columns: [		
			{ text: 'Tanggal', datafield: 'marking', width: '10%', align: 'center' },
			{ text: 'Nama', datafield: 'nama', width: '20%', align: 'center' },
			{ text: 'Debit', datafield: 'debet', width: '10%', cellsalign: 'right', align: 'center', cellsformat: 'n2', aggregates: ['sum']},
			{ text: 'Kredit', datafield: 'kredit', width: '10%', cellsalign: 'right', align: 'center', cellsformat: 'n2', aggregates: ['sum']},
			{ text: 'Keterangan', datafield: 'keterangan', width: '20%', cellsalign: 'right', align: 'center'},	
			{ text: 'Verifikasi TU', datafield: 'verified', width: '10%', cellsalign: 'right', align: 'center' },
			{ text: 'Inputor', datafield: 'inputor', width: '10%', cellsalign: 'right', align: 'center' },
			{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
				return "Del";
				}, buttonclick: function (row) {
					editrow = row;	
					var offset 		= $("#gridtabungansiswa").offset();		
					var dataRecord 	= $("#gridtabungansiswa").jqxGrid('getrowdata', editrow);
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
						var set02		= 'batal';
						var set03		= document.getElementById('getnama').value;
						$.post('admin/tabung', { val01: set01, val02: '', val03: '', val04: set02, val05: set03, val06: '', _token: token },
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
								$("#gridtabungansiswa").jqxGrid('updatebounddata');
								return false;
						});
					});
				}
			},
		],                
	});
});
</script>
@endpush