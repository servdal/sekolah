@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Presensi Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
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
							<div class="form-group"> 
								<div class="row">
									<div class="col-lg-6">
										<label>Surat Keterangan Dokter</label>
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="berkas_file">
											<label class="custom-file-label" for="berkas_file">Foto Surat Dokter</label>
										</div>
									</div>
									<div class="col-lg-6">
										<img id="preview" style="margin:2px; margin-left: 10px;" width="100%" src="dist/img/takadagambar.png">
									</div>
								</div>
								
							</div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-info" id="btnclearttd">Clear</button>
                            <button type="button" class="btn btn-success pull-right" id="btnsimpanttd">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-danger shadow" id="divawalpresensi">
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
					<div class="card direct-chat direct-chat-warning shadow" id="divdetailmateri">
                        <div class="card-header">
                            <h3 class="card-title" id="judul">Materi</h3>
							<div class="card-tools">
                                <button type="button" class="btn btn-tool" title="Export" id="btnexport"><i class="fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridviewmateri"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</section>
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
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="mas_noinduk" id="mas_noinduk">
<input type="hidden" id="getfoto" value="">
<input type="hidden" name="mas_noinduk" id="mas_noinduk">
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
		bsCustomFileInput.init();
	});
	function openedpage( jQuery ){
        var noinduk	    = document.getElementById('mas_noinduk').value;
        var formdata = new FormData();
            formdata.set('val02', 'persiswa');
            formdata.set('val01', noinduk);
            formdata.set('_token', '{{ csrf_token() }}');
        $.ajax({
            url         : '{{ route("jsonPresensicari") }}',
            data        : formdata,
            type        : 'POST',
            contentType : false,
            processData : false,
            success: function (data) {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                viewdatadetail	= '<ul class="products-list product-list-in-card pl-2 pr-2">';
                states          = ['info', 'primary', 'warning', 'info', 'primary', 'secondary'];
				if (Array.isArray(data) && data.length > 0) {
					for (let i = 0; i < data.length; i++) {
                        let id = data[i].id;
						let foto = data[i].foto;
						let tanggal = data[i].tanggal;
						let alasan = data[i].alasan;
						let surat = data[i].surat;
						let status = data[i].status;
						let btnsurat = surat === '' ? '' : '<a href="{{url("/")}}/suratijinortu/' + id + '" class="btn btn-sm btn-info" target="_blank">View Surat Ijin</a>';
						if (status == '1'){
							if (foto == '' || foto == null){
								foto = '<img src="{{url("/")}}/dist/img/takadagambar.png" alt="image" class="img-circle img-size-32 mr-2">';
							} else {
								foto = '<img src="{{url("/")}}/dist/img/foto/' + data[i].foto + '" alt="image" class="img-circle img-size-32 mr-2">';
							}
							kehadiran = '<span class="badge badge-success float-right">HADIR</span>';
						} else if (status == '2'){
							foto = '<img src="{{url("/")}}/dist/img/takadagambar.png" alt="image" class="img-circle img-size-32 mr-2">';
							kehadiran = '<span class="badge badge-warning float-right">IJIN</span>';
						} else if (status == '3'){
							foto = '<img src="{{url("/")}}/dist/img/takadagambar.png" alt="image" class="img-circle img-size-32 mr-2">';
							kehadiran = '<span class="badge badge-info float-right">SAKIT</span>';
						} else {
							foto = '<img src="{{url("/")}}/dist/img/takadagambar.png" alt="image" class="img-circle img-size-32 mr-2">';
							if (alasan == ''){
								kehadiran = '<span class="badge badge-danger float-right">ALPHA</span>';
							} else {
								kehadiran = alasan;
							}
							
						}
						viewdatadetail 	= viewdatadetail +'<li class="item">'+
											'<div class="product-img">'+foto+'</div>'+
											'<div class="product-info"><a href="#" class="product-title" onClick="viewMateri('+id+')">Tanggal '+tanggal+' '+kehadiran+'</a>'+
											'<span class="product-description"><a href="#" class="btn btn-sm btn-primary" onClick="viewMateri('+id+')"><i class="fa fa-book"></i> Materi</a>'+btnsurat+'</span></div></li>';
                    }
                }
				
                viewdatadetail = viewdatadetail +'</ul>';
                $('#gridpencarian').html(viewdatadetail);
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
	function viewMateri(id){
        $("html, body").animate({ scrollTop: 0 }, "slow");
		$('#divawalpresensi').hide();
        var noinduk	    = document.getElementById('mas_noinduk').value;
        var formdata = new FormData();
            formdata.set('val02', 'detailmateriperid');
            formdata.set('val01', id);
            formdata.set('_token', '{{ csrf_token() }}');
        $.ajax({
            url         : '{{ route("jsonPresensicari") }}',
            data        : formdata,
            type        : 'POST',
            contentType : false,
            processData : false,
            success: function (data) {
                viewdatadetail	= '<div class="direct-chat-messages">';
				if (Array.isArray(data) && data.length > 0) {
					for (let i = 0; i < data.length; i++) {
                        let jammulai 		= data[i].jammulai;
						let jamakhir 		= data[i].jamakhir;
						let ruang 			= data[i].ruang;
						let matapelajaran 	= data[i].matapelajaran;
						let guruyanghadir 	= data[i].guruyanghadir;
						let materi 			= data[i].materi;
						let foto 			= data[i].foto;
						
						viewdatadetail 	= viewdatadetail +'<div class="direct-chat-msg left">'+
											'<div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+jammulai+' s/d '+jamakhir+'</span><span class="direct-chat-timestamp pull-left"><i class="fa fa-bank"></i> '+ruang+'</span></div>'+foto+
											'<div class="direct-chat-text">'+matapelajaran+' Materi '+materi+'</div></div>';
                    }
                }
				
                viewdatadetail = viewdatadetail +'</div>';
                $('#gridviewmateri').html(viewdatadetail);
				$('#divdetailmateri').show();
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
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.readAsDataURL(input.files[0]);
			reader.onload = function (e) {
				$('#preview').attr('src', e.target.result);
				$('#getfoto').val(e.target.result);
			};
		}
	}

$(document).ready(function () {
	$('.overlay').hide();
	$('#divpencarian').hide();
	$('#divdetailmateri').hide();
	$('#divawalpresensi').show();
	var ttdPad = new SignaturePad(document.getElementById('id_ttd'), {
	  backgroundColor: 'rgba(255, 255, 255, 0)',
	  penColor: 'rgb(0, 0, 0)'
	});
	$('#berkas_file').change(function () {
		if(this.files[0].size > 1000000){
			this.value = "";
			swal({
				title	: 'Mohon lengkapi',
				text	: 'Maksimum File yang boleh di upload adalah 1Mb',
				type	: 'info',
			});
		} else {
			var imgPath = this.value;
			var ukfile 	= this.files[0].size;
			var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
			if(ext == "jpg" || ext == "jpeg" || ext == "png") {
				readURL(this);
			} else {
				swal({
					title: 'Mohon lengkapi',
					text: 'File yang diperbolehkan hanya JPG/JPEG/PNG',
					type: 'info',
				});
			}
		}
	});	
	$('#btnsimpanttd').on('click', function (){
		var set01 = ttdPad.toDataURL('image/png');
		if (set01 == document.getElementById('id_ttdblank').toDataURL()){ set01 = ''; }
		var set02 = document.getElementById('getfoto').value;
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
	$('.btnkembali').on('click', function (){
		$('#divdetailmateri').hide();
		$('#divawalpresensi').show();
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
				url: '{{ route("jsonDataabsenkelas") }}',
			};
			$('#divawal').show();
			$('#divpencarian').hide();
			var dataAdapter = new $.jqx.dataAdapter(source);
			$("#gridnonhadir").jqxGrid({
				width			: '100%',   
				columnsresize	: true,
				theme			: "energyblue",
				autoheight		: true,
				altrows			: true,
				source			: dataAdapter,
				rowsheight		: 50,
				columns			: [
					{ text: 'Photo', datafield: 'foto', editable: false, width: '10%', cellsalign: 'center', align: 'center' },
					{ text: 'No.Induk', datafield: 'noinduk', editable: false, width: '10%', cellsalign: 'center', align: 'center' },
					{ text: 'Nama', datafield: 'nama', editable: false, width: '30%', cellsalign: 'left', align: 'center' },		
					{ text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center'},
					{ text: 'Masuk', datafield: 'masuk', width: '8%', cellsalign: 'center', align: 'center'},
					{ text: 'Sakit', datafield: 'sakit', width: '8%', cellsalign: 'center', align: 'center'},
					{ text: 'Ijin', datafield: 'ijin', width: '8%', cellsalign: 'center', align: 'center'},
					{ text: 'Alpha', datafield: 'alpha', width: '8%', cellsalign: 'center', align: 'center'},
					{ text: 'Detail', columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
						return "View";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#gridnonhadir").offset();
							var dataRecord 	= $("#gridnonhadir").jqxGrid('getrowdata', editrow);
							$('#mas_noinduk').val(dataRecord.noinduk);
							$('#divawal').hide();
							openedpage();
							$('#divpencarian').show();
						}
					},
				]
			});
		}
	});
	$("#btnexport").click(function () {
            var gridContent = $("#gridviewmateri").jqxGrid('exportdata', 'json');
                data        = $.parseJSON(gridContent);
            var noOfContacts= data.length;
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
                        if (isi == null){
                            td.innerHTML = '';
                        } else {
                            td.setAttribute('style', 'mso-number-format: "\@";');
                            td.innerHTML = isi;
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
});
</script>
@endpush