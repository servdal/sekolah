@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Data Induk Staff</h1>
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
                            <h3 class="card-title">Input Data Staff Baru</h3>
                        </div>
                        <form id="kt_form" enctype="multipart/form-data">
						<div class="card-body">
                            <div class="form-group">
                                <label>Nama Lengkap *)</label>
                                <input type="text" id="id_nama" name="id_nama" class="form-control">
                            </div>	
                            <div class="form-group">
                                <label>Tempat dan Tanggal lahir *)</label>
                                <input type="text" id="id_ttl" name="id_ttl" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>NUPTK dan NIY</label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" id="id_nuptk" name="id_nuptk" class="form-control" placeholder="NUPTK">
                                    </div> 
                                    <div class="col-sm-6">
                                        <input type="text" id="id_niy" name="id_niy" class="form-control" placeholder="NIY">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <label>Tanggal di Terima (TMT)</label>
                                        <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="id_tmt" name="id_tmt" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                    </div> 
                                    <div class="col-sm-5">
                                        <label>ID Finger</label>
                                        <input type="text" id="id_finger" name="id_finger" class="form-control" placeholder="Hanya Angka">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kelamin/Agama/Status Pegawai</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select id="id_kelamin" name="id_kelamin" class="form-control" >
                                            <option value=""></option>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div> 
                                    <div class="col-sm-4">
                                        <select id="id_agama" name="id_agama" class="form-control" >
                                            <option value=""></option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katholik">Katholik</option>
                                            <option value="Konghuchu">Konghuchu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Hindu">Hindu</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select id="id_status" name="id_status" class="form-control" >
                                            <option value="GTY">Guru Tetap Yayasan</option>
                                            <option value="GTT">Guru Tidak Tetap</option>
                                            <option value="PTY">Pegawai Tetap Yayasan</option>
                                            <option value="PTT">Pegawai Tidak Tetap</option>
                                            <option value="Pengabdian">Pengabdian</option>
                                        </select>
                                    </div>
                                </div>			  
                            </div>
                            <div class="form-group">
                                <label>Ijasah dan Jabatan</label>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <select id="id_jabatan" name="id_jabatan" class="form-control" >
                                        <option value=""></option>
                                        <option value="Kepala Sekolah">Kepala Sekolah</option>
                                        <option value="Waka Kesiswaan">Waka Kesiswaan</option>
                                        <option value="Waka Kurikulum">Waka Kurikulum</option>
                                        <option value="Wali Kelas">Wali Kelas</option>
                                        <option value="Guru Kelas">Guru Kelas</option>
                                        <option value="Guru PAI">Guru PAI</option>
                                        <option value="Guru PJOK">Guru PJOK</option>
                                        <option value="Guru Pendamping Khusus (GPK)">Guru Pendamping Khusus (GPK)</option>
                                        <option value="Staf TU">Staf TU</option>
                                        <option value="Pustakawan">Pustakawan</option>
                                        <option value="Koperasi">Koperasi</option>
                                        <option value="Security">Security</option>
                                        <option value="Cleanning Service">Cleanning Service</option>
                                        </select>
                                    </div> 
                                    <div class="col-sm-4">
                                        <select id="id_ijasah" name="id_ijasah" class="form-control" >
                                        <option value=""></option>
                                        <option value="S3">S3</option>
                                        <option value="S2">S2</option>
                                        <option value="S1">S1</option>
                                        <option value="DIII">DIII</option>
                                        <option value="DII">DII</option>
                                        <option value="DI">DI</option>
                                        <option value="SMA">SMA</option>
                                        <option value="SMK">SMK</option>
                                        <option value="STM">STM</option>
                                        <option value="SMEA">SMEA</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SD">SD</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat *)</label>
                                <input type="text" id="id_alamat" name="id_alamat" class="form-control" placeholder="Alamat">		  
                            </div>
                            <div class="form-group">
                                <label>No.HP  *)</label>
                                <input type="text" id="id_hape" name="id_hape" class="form-control" placeholder="No. HP">		  
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="file" id="id_foto" name="id_foto" >
                                    </div> 
                                    <div class="col-sm-6">
                                        <div id="fotone"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" id="btnsimpansiswa">
                                <i class="fa fa-save"></i>
                            </button>
					    </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Data Induk Staff</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="exportgrid">
                                    <i class="fa fa-print"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="griddatainduk"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="modal fade" id="editdatainduk">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Extra Large Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="kt_formupdate" enctype="multipart/form-data">
			<div class="modal-body">
                <div class="form-group">
                    <label>Nama Lengkap *)</label>
                    <input type="text" id="edit_nama" name="edit_nama" class="form-control">
                </div>
                <div class="form-group">
                    <label>Tempat dan Tanggal lahir *)</label>
                    <input type="text" id="edit_ttl" name="edit_ttl" class="form-control">
                </div>
                <div class="form-group">
                    <label>NUPTK dan NIY</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" id="edit_nuptk" name="edit_nuptk" class="form-control" placeholder="NUPTK">
                        </div> 
                        <div class="col-sm-6">
                            <input type="text" id="edit_niy" name="edit_niy" class="form-control" placeholder="NIY">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-7">
                            <label>Tanggal di Terima (TMT)</label>
                            <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="edit_tmt" name="edit_tmt" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                        </div> 
                        <div class="col-sm-5">
                            <label>ID Finger</label>
                            <input type="text" id="edit_finger" name="edit_finger" class="form-control" placeholder="Hanya Angka">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Kelamin/Agama/Status Pegawai</label>
                    <div class="row">
                        <div class="col-sm-4">
                            <select id="edit_kelamin" name="edit_kelamin" class="form-control" >
                            <option value=""></option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                            </select>
                        </div> 
                        <div class="col-sm-4">
                            <select id="edit_agama" name="edit_agama" class="form-control" >
                            <option value=""></option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katholik">Katholik</option>
                            <option value="Konghuchu">Konghuchu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Hindu">Hindu</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select id="edit_status" name="edit_status" class="form-control" >
                                <option value="GTY">Guru Tetap Yayasan</option>
                                <option value="GTT">Guru Tidak Tetap</option>
                                <option value="PTY">Pegawai Tetap Yayasan</option>
                                <option value="PTT">Pegawai Tidak Tetap</option>
                                <option value="Pengabdian">Pengabdian</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ijasah dan Jabatan</label>
                    <div class="row">
                        <div class="col-sm-8">
                            <select id="edit_jabatan" name="edit_jabatan" class="form-control" >
                                <option value=""></option>
                                <option value="Kepala Sekolah">Kepala Sekolah</option>
                                <option value="Waka Kesiswaan">Waka Kesiswaan</option>
                                <option value="Waka Kurikulum">Waka Kurikulum</option>
                                <option value="Wali Kelas">Wali Kelas</option>
                                <option value="Guru Kelas">Guru Kelas</option>
                                <option value="Guru PAI">Guru PAI</option>
                                <option value="Guru PJOK">Guru PJOK</option>
                                <option value="Guru Pendamping Khusus (GPK)">Guru Pendamping Khusus (GPK)</option>
                                <option value="Staf TU">Staf TU</option>
                                <option value="Pustakawan">Pustakawan</option>
                                <option value="Koperasi">Koperasi</option>
                                <option value="Security">Security</option>
                                <option value="Cleanning Service">Cleanning Service</option>
                            </select>
                        </div> 
                        <div class="col-sm-4">
                            <select id="edit_ijasah" name="edit_ijasah" class="form-control" >
                                <option value=""></option>
                                <option value="S3">S3</option>
                                <option value="S2">S2</option>
                                <option value="S1">S1</option>
                                <option value="DIII">DIII</option>
                                <option value="DII">DII</option>
                                <option value="DI">DI</option>
                                <option value="SMA">SMA</option>
                                <option value="SMK">SMK</option>
                                <option value="STM">STM</option>
                                <option value="SMEA">SMEA</option>
                                <option value="SMP">SMP</option>
                                <option value="SD">SD</option>
                            </select>
                        </div>				 
                    </div>			  
                </div>
                <div class="form-group">
                    <label>Alamat *)</label>
                    <input type="text" id="edit_alamat" name="edit_alamat" class="form-control" placeholder="Alamat">
                </div>
                <div class="form-group">
                    <label>No.HP  *)</label>
                    <input type="text" id="edit_hape" name="edit_hape" class="form-control" placeholder="No. HP">
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="file" id="edit_foto" name="edit_foto" >
                        </div> 
                        <div class="col-sm-6">
                            <div id="fotone"></div>
                        </div>
                    </div>			  
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="edit_idne" name="edit_idne">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnupdatesiswa">
                    <i class="fa fa-save"></i>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="makhir" id="makhir" value="now">
@endsection
@push('script')
<script>
$(document).ready(function () {
    $('.datemaskinput').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });

	$('#exportgrid').click(function(){
		var gridContent = $("#griddatainduk").jqxGrid('exportdata', 'json');
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
	var source = {
		datatype: "json",
		datafields: [
			{ name: 'id',type: 'text'},	
			{ name: 'nama',type: 'text'},
			{ name: 'ttl',type: 'text'},
			{ name: 'nuptk',type: 'text'},
			{ name: 'niy',type: 'text'},
			{ name: 'kelamin',type: 'text'},
			{ name: 'agama',type: 'text'},
			{ name: 'ijasah',type: 'text'},
			{ name: 'jabatan',type: 'text'},
			{ name: 'statpeg',type: 'text'},
			{ name: 'alamat',type: 'text'},
			{ name: 'notelp',type: 'text'},
			{ name: 'foto',type: 'text'},
			{ name: 'tmt',type: 'text'},
			{ name: 'idfinger',type: 'text'},
			{ name: 'lampiran',type: 'text'},
		],
		url     :  '{{ route("jsonDataindukstaff") }}',
		cache   : false,
		pager   : function (pagenum, pagesize, oldpagenum) {}
	};
	var dataAdapter = new $.jqx.dataAdapter(source, { async: false, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
	var editrow = -1;
	$("#griddatainduk").jqxGrid({
		width               : '100%',
		showfilterrow       : true,
		rowsheight          : 35,
		filterable          : true,                
		columnsresize       : true,
		autoshowfiltericon  : true,
		pageable            : true,
		autoheight          : true,
		theme               : "energyblue",
		source              : dataAdapter,
		selectionmode       : 'multiplecellsextended',
		columns             : [
			{ text: 'Photo', datafield: 'lampiran', width: 50, align: 'center' },
			{ text: 'TMT',  datafield: 'tmt', width: 115, cellsalign: 'left', align: 'center' },
			{ text: 'Nama Lengkap', datafield: 'nama', width: 250, align: 'center' },
			{ text: 'L/P', datafield: 'kelamin', width: 20, cellsalign: 'center', align: 'center' },		
			{ text: 'Tempat Tanggal Lahir', datafield: 'ttl', width: 200, cellsalign: 'left', align: 'center' },
			{ text: 'NUPTK',  datafield: 'nuptk', width: 115, cellsalign: 'left', align: 'center' },
			{ text: 'NIY',  datafield: 'niy', width: 115, cellsalign: 'left', align: 'center' },
			{ text: 'Agama',  datafield: 'agama', width: 80, cellsalign: 'center', align: 'center' },
			{ text: 'Ijasah',  datafield: 'ijasah', width: 50, cellsalign: 'center', align: 'center' },
			{ text: 'Jabatan',  datafield: 'jabatan', width: 150, cellsalign: 'center', align: 'center' },
			{ text: 'Status',  datafield: 'statpeg', width: 50, cellsalign: 'center', align: 'center' },
			{ text: 'No.HP',  datafield: 'notelp', width: 150, cellsalign: 'left', align: 'center' },
			{ text: 'Alamat',  datafield: 'alamat', width: 280, cellsalign: 'left', align: 'center' },
			{ text: 'id Finger',  datafield: 'idfinger', width: 50, cellsalign: 'center', align: 'center' },
			{ text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: 50, cellsrenderer: function () {
				return "Edit";
				}, buttonclick: function (row) {
						editrow = row;
						var offset 		= $("#griddatainduk").offset();		
						var dataRecord 	= $("#griddatainduk").jqxGrid('getrowdata', editrow);
						$("#edit_idne").val(dataRecord.id);
						$("#edit_tmt").val(dataRecord.tmt);
						$("#edit_finger").val(dataRecord.idfinger);
						$("#edit_nama").val(dataRecord.nama);
						$("#edit_ttl").val(dataRecord.ttl);
						$("#edit_nuptk").val(dataRecord.nuptk);
						$("#edit_niy").val(dataRecord.niy);
						$("#edit_kelamin").val(dataRecord.kelamin);
						$("#edit_agama").val(dataRecord.agama);
						$("#edit_status").val(dataRecord.statpeg);
						$("#edit_jabatan").val(dataRecord.jabatan);
						$("#edit_ijasah").val(dataRecord.ijasah);
						$("#edit_alamat").val(dataRecord.alamat);
						$("#edit_hape").val(dataRecord.notelp);
						$("#editdatainduk").modal('show');	
				}
			},
		],                
	});
    $('#btnsimpansiswa').click(function () {
        var formdata = new FormData($('#kt_form')[0]);
            formdata.set('_token', '{{ csrf_token() }}');
        $.ajax({
            url         : '{{ route("exDataindukstaf") }}',
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
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $("#griddatainduk").jqxGrid("updatebounddata");
                return false;
            },
            error: function (xhr, status, error) {
                swal({
                    title   : 'Stop',
                    text    : xhr.responseText,
                    type    : 'warning',
                })
            }
        });
    });
    $('#btnupdatesiswa').click(function () {
        var formdata = new FormData($('#kt_formupdate')[0]);
            formdata.set('_token', '{{ csrf_token() }}');
        $("#editdatainduk").modal('hide');	
        $.ajax({
            url         : '{{ route("exupdDataindukstaff") }}',
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
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $("#griddatainduk").jqxGrid("updatebounddata");
                return false;
            },
            error: function (xhr, status, error) {
                swal({
                    title   : 'Stop',
                    text    : xhr.responseText,
                    type    : 'warning',
                })
            }
        });
    });
});
</script>
@endpush