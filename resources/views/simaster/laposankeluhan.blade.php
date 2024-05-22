@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Laporan Keluhan</h1>
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
                <div class="col-lg-12">
                    <div class="card-box ribbon-box">
                    <h4 class="ribbon ribbon-success">Control</h4>
                    <p class="m-b-0"></p>
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="card-box">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="id_bulan">Bulan</label>
                                            <select id="id_bulan" class="form-control">
                                                <option value="ALL">Semua Kegiatan Pertahun</option>
                                                <option value="01">Januari</option>
                                                <option value="02">Februari</option>
                                                <option value="03">Maret</option>
                                                <option value="04">April</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Juni</option>
                                                <option value="07">Juli</option>
                                                <option value="08">Agustus</option>
                                                <option value="09">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="id_thn1">Tahun</label>
                                            <input type="text" class="form-control" id="id_thn1" name="id_thn1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-block" id="btncarikegiatan">Cari Data</button>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-block btn-info" id="btndldata">Export Excell</button>
                                    </div>
                                    <div id='statunit' style="width:100%; height:300px;"></div>
                                    <div id='statrating' style="width:100%; height:300px;"></div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div id="divawal">
                                    Guna meningkatkan kepuasan stakeholder, mohon keluhan ini segera dijawab dan ditanggapi. Mengingat data waktu keluhan dan waktu tanggapan yang nantinya akan dihitung otomatis
                                    <div id="gridkeluhan"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" id="gettahun" value="{{ date('Y') }}">
<input type="hidden" id="getbulan" value="{{ date('m') }}">
<input type="hidden" id="getjenis" value="belum">
<input type="hidden" id="id_sekolah" value="{{ Session('sekolah_id_sekolah') }}">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="id_ukfile" id="id_ukfile">
<input type="hidden" name="id_jnfile" id="id_jnfile">
<div class="modal fade" id="modalerror">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Error..!!!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" readonly="readonly" id="err_text">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltanggapan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Isi Tanggapan/Tindak Lanjut dari Keluhan Tersebut</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Keluhan</label>
                    <textarea id="komplain_keluhan" name="komplain_keluhan" rows="10" cols="80" readonly></textarea>
                </div>
                <div class="form-group">
                    <textarea id="komplain_tanggapan" name="komplain_tanggapan" rows="10" cols="80"></textarea>
                </div>
                <div class="form-group">
                    <label>Lampiran Foto Bukti</label>
                    <input type="file" id="komplain_foto" name="komplain_foto"> 
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="komplain_idne">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpantanggapan">Simpan</button>	
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
	function openedpage( jQuery ){
		var val01   = document.getElementById('gettahun').value;
        var val02   = document.getElementById('getbulan').value;
        var val03   = document.getElementById('getjenis').value;
		var val04   = document.getElementById('id_sekolah').value;
		var token=document.getElementById('token').value;
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'id'},
				{ name: 'dari', type: 'text'},
				{ name: 'hostname', type: 'text'},
				{ name: 'statuser', type: 'text'},
				{ name: 'jenis', type: 'text'},
				{ name: 'nip', type: 'text'},
				{ name: 'nama', type: 'text'},
				{ name: 'kepada', type: 'text'},
				{ name: 'judul', type: 'text'},
				{ name: 'isikeluhan', type: 'text'},
				{ name: 'gambar', type: 'text'},
				{ name: 'extension', type: 'text'},
				{ name: 'tanggapan', type: 'text'},
				{ name: 'bukti', type: 'text'},
				{ name: 'jenfile', type: 'text'},
				{ name: 'rating', type: 'text'},
				{ name: 'status', type: 'text'},
				{ name: 'buat', type: 'text'},
				{ name: 'lastupdate', type: 'text'},
				{ name: 'durasi', type: 'text'},
			],
			type: 'POST',
			data: {set01:val01, set02:val02, set03:val03, set04:val04, _token: token},
			url: '{{ route("getdatakeluhan") }}',
		};
		var photorenderer = function (row, column, value) {
			var name = $('#gridkeluhan').jqxGrid('getrowdata', row).gambar;
			if (name == ''){
				var img = '<div style="background: white;"></div>';
			} else {
				var type = $('#gridkeluhan').jqxGrid('getrowdata', row).extension;
				if(type == 'pdf') {
					var img = '<div style="background: white;"><a href="images/komplain/'+name+'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="img/pdf_logo.png"></a></div>';
				} else {
					var img = '<div style="background: white;"><a href="images/komplain/'+name+'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="images/komplain/' + name + '"></a></div>';
				}
			}
			return img;
		}
		var buktirenderer = function (row, column, value) {
			var name = $('#gridkeluhan').jqxGrid('getrowdata', row).bukti;
			if (name == ''){
				var img = '<div style="background: white;"></div>';
			} else {
				var type = $('#gridkeluhan').jqxGrid('getrowdata', row).jenfile;
				if(type == 'pdf') {
					var img = '<div style="background: white;"><a href="images/komplain/'+name+'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="img/pdf_logo.png"></a></div>';
				} else {
					var img = '<div style="background: white;"><a href="images/komplain/'+name+'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="images/komplain/' + name + '"></a></div>';
				}
			}
			return img;
		}
		var datajhasil = new $.jqx.dataAdapter(source);
		$("#gridkeluhan").jqxGrid({
			width: '100%',
			autoheight: true,
			rowsheight: 35,
			source: datajhasil,
			theme: "energyblue",
			columns: [
				{ text: 'Tanggapan/Tindak', columntype: 'button', align: 'center', width: '13%', cellsrenderer: function () {
					return "Isi";
					}, buttonclick: function (row) {
						editrow = row;
						var offset 			= $("#gridkeluhan").offset();
						var dataRecord 		= $("#gridkeluhan").jqxGrid('getrowdata', editrow);
						var set01			= '';
						var set02			= 'readonly';
						var set03			= dataRecord.id;
						var token 			= document.getElementById('token').value;
						$.post('{{ route("savetanggapan") }}', { file: set01, val01: set02, val02: set03, _token: token },		
						function(data){
							$("#komplain_idne").val(dataRecord.id);
							CKEDITOR.instances['komplain_tanggapan'].setData(dataRecord.tanggapan)
							CKEDITOR.instances['komplain_keluhan'].setData(dataRecord.isikeluhan)
							$("#modaltanggapan").modal('show');
							return false;
						});
						
					}
				},
				{ text: 'Dari', datafield: 'nama', width: '25%', cellsalign: 'left', align: 'center'  },
				{ text: 'Email', datafield: 'nip', width: '25%', cellsalign: 'left', align: 'center'  },
				{ text: 'Unitkerja', datafield: 'kepada', width: '25%', cellsalign: 'left', align: 'center'  },
				{ text: 'Tentang', datafield: 'judul', width: '20%', cellsalign: 'left', align: 'center'  },
				{ text: 'Isi Komplain', datafield: 'isikeluhan', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'Waktu Komplain', datafield: 'buat', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'Lampiran', align: 'center', cellsalign: 'center', width: '12%', cellsrenderer: photorenderer },
				{ text: 'Tanggapan/Tindakan', datafield: 'tanggapan', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'Bukti Tindakan', align: 'center', cellsalign: 'center', width: '12%', cellsrenderer: buktirenderer },
				{ text: 'Waktu Tindakan', datafield: 'lastupdate', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'Durasi', datafield: 'durasi', width: '15%', cellsalign: 'left', align: 'center'  },
			]
		});
	}
	$('#komplain_foto').change(function () {
		if(this.files[0].size > 7000000){
			$("#err_text").val('Batas Maksimal Ukuran Filenya adalah 7Mb'); 
			$("#modalerror").modal('show');
			this.value = "";
		} else {
			var imgPath = this.value;
			var ukfile 	= this.files[0].size;
			var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
			$("#id_jnfile").val(ext);
			$("#id_ukfile").val(ukfile);
		}
	});
	$(function () {
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace( 'komplain_tanggapan', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
		CKEDITOR.replace( 'komplain_keluhan', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
	});
	window.onload = openedpage;
    $(document).ready(function () {
        $('#btncarikegiatan').click(function(){ 
            var set01=document.getElementById('id_bulan').value;
            var set02=document.getElementById('id_thn1').value;
            $("#gettahun").val(set02);
            $("#getbulan").val(set01);
            $("#getjenis").val("");
            openedpage();
            return false;
            });
        var sourcerating = {
            datatype: "json",
            datafields: [
                { name: 'rating' },				
                { name: 'jumlah' },			
            ],
            url: '{{ route("statjrating") }}'
        };
        var datajrating		= new $.jqx.dataAdapter(sourcerating);
        var settingrating 	= {
            title: "Statistik Rating",
            description: "{{ date('Y') }}",
            enableAnimations: true,		
            showBorderLine: true,
            colorScheme: 'scheme01',
            padding: { left: 5, top: 5, right: 5, bottom: 5 },
            titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },		
            source: datajrating,
            seriesGroups:
                [
                    {
                        type: 'pie',
                        showLabels: true,
                        series:
                        [
                            {
                                dataField: 'jumlah',
                                displayText: 'rating',
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
        $('#statrating').jqxChart(settingrating);
        var sourceunit = {
            datatype: "json",
            datafields: [
                { name: 'unitkerja' },				
                { name: 'jumlah' },			
            ],
            url: '{{ route("statunitkerja") }}'
        };
        var dataunitkerja		= new $.jqx.dataAdapter(sourceunit);
        var settingunitkerja 	= {
            title: "Statistik Unit Kerja",
            description: "{{ date('Y') }}",
            enableAnimations: true,		
            showBorderLine: true,
            colorScheme: 'scheme03',
            padding: { left: 5, top: 5, right: 5, bottom: 5 },
            titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },		
            source: dataunitkerja,
            seriesGroups:
                [
                    {
                        type: 'pie',
                        showLabels: true,
                        series:
                        [
                            {
                                dataField: 'jumlah',
                                displayText: 'unitkerja',
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
        $('#statunit').jqxChart(settingunitkerja);
        $("#btndldata").click(function(){
            var val01   = document.getElementById('gettahun').value;
            var val02   = document.getElementById('getbulan').value;
            var val03   = document.getElementById('getjenis').value;
            var token	= document.getElementById('token').value;
            $.post('{{ route("getdatakeluhan") }}',  { set01:val01, set02:val02, set03:val03, _token: token },
            function(data){
                data = $.parseJSON(data);
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
                            var td = document.createElement("td");
                                td.setAttribute('style', 'mso-number-format: "\@";');
                                td.innerHTML = data[i][col[j]];
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
        });
        $("#btnsimpantanggapan").click(function(){
            var set01 	= document.getElementById('komplain_foto');
            var set02	= CKEDITOR.instances['komplain_tanggapan'].getData()
            var set03	= document.getElementById('komplain_idne').value;
            var token 	= document.getElementById('token').value;
            if (set02 == ''){ 
                $("#err_text").val('Mohon di Isi Tanggapan/Tindakan Anda'); 
                $("#modalerror").modal('show');
            } else {
                $("#modaltanggapan").modal('hide');
                var form_data = new FormData();
                form_data.append('file', set01.files[0]);
                form_data.append('val01', set02);
                form_data.append('val02', set03);
                form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: '{{ route("savetanggapan") }}',
                    data: form_data,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function (data) {
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
                        $("#gridkeluhan").jqxGrid('updatebounddata', 'filter');		
                        return false;
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@endpush