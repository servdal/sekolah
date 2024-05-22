@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Laporan Prestasi Siswa</h1>
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
                <div class="col-lg-3 col-md-3">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{{ $countregional }}</h3>
                            <p>Regional</p>
                        </div>
                        <div class="icon"><i class="fa fa-trophy"></i></div>
                        <a href="#" id="topbtnregional" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $countnasional }}</h3>
                            <p>Nasional</p>
                        </div>
                        <div class="icon"><i class="fa fa-trophy"></i></div>
                        <a href="#" id="topbtnnasional" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $countinter }}</h3>
                            <p>Internasional</p>
                        </div>
                        <div class="icon"><i class="fa fa-trophy"></i></div>
                        <a href="#" id="topbtninternasional" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="box box-solid bg-green-gradient">
                        <div class="box-header">
                            <i class="fa fa-mortar-board"></i>
                            <h3 class="box-title">Report</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">  						
                                <div class="row">
                                    <div class="col-lg-12">
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
                                    <div class="col-lg-12">
                                        <div class="input-group margin">
                                            <input type="text" class="form-control" id="cekthn" value="{{ $tahunne }}">
                                            <span class="input-group-btn">
                                                <button class="btn btn-warning btn-flat" type="button" id="btnviewdata">View</button>
                                            </span>				
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4" id="sectionutama">
                    <div id="status" class="status"></div>
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Control</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="#" id="btnaddnew"  class="btn btn-block btn-social btn-success">
                                <i class="fa fa-star"></i> Tambah Data
                            </a>
                        </div>
                        <div class="card-footer">
                            <h3>Statistik Per Kelas Tahun {{ date("Y") }}</h3>
                            <div id='grafiksebaran' style="width:100%; height:320px;"></div>
                        </div>
                        <div class="card-footer">
                            <h3>Statistik Per Bidang {{ date("Y") }}</h3>
                            <div id='grafiksebaranperjenis' style="width:100%; height:320px;"></div>
                        </div>
                    </div>
				</div>
				<div class="col-md-8">
                	<div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Prestasi Siswa</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" id="btnexport"><i class="fa fa-file-excel-o"></i></button>
						        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="divpesan"></div>
							<div id="tabeldata"></div>
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

<div class="modal fade" id="modaltambahdata">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Data Prestasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <select id="prestasi_siswa" name="prestasi_siswa" class="form-control select2" >
                        <option value="">Pilih salah satu</option>
                        @foreach($datasiswa as $rsiswa)
                            <option value="{{ $rsiswa['noinduk'] }}">{{ $rsiswa['nama'] }} ( {{ $rsiswa['klspos'] }} No. Induk {{ $rsiswa['noinduk'] }} )</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="prestasi_namakegiatan" class="col-form-label">Nama/Judul Kegiatan</label>
                    <input type="text" class="form-control" id="prestasi_namakegiatan">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="prestasi_peringkat" class="col-form-label">Peringkat / Capaian</label>
                        <select id="prestasi_peringkat" class="form-control">
                            <option value="Peserta">Peserta</option>
                            <option value="Gold Medal">Gold Medal</option>
                            <option value="Silver Medal">Silver Medal</option>
                            <option value="Bronze Medal">Bronze Medal</option>
                            <option value="Juara I">Juara I</option>
                            <option value="Juara II">Juara II</option>
                            <option value="Juara III">Juara III</option>
                            <option value="Finalis">Finalis</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prestasi_bidang">Bidang</label>
                        <select id="prestasi_bidang" class="form-control">
                            <option value="Keagamaan">Keagamaan</option>
                            <option value="Karya Tulis">Karya Tulis</option>
                            <option value="Seni dan Budaya">Seni dan Budaya</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Teknologi">Teknologi</option>
                            <option value="Sosial Kemasyarakatan">Sosial Kemasyarakatan</option>
                            <option value="Akademik">Akademik</option>
                            <option value="Kesiswaan">Kesiswaan</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="prestasi_tingkat">Tingkat</label>
                        <select id="prestasi_tingkat" class="form-control">
                            <option value="Regional">Regional (Kota - Provinsi)</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Internasional">Internasional</option>
                        </select>
                    </div>
                    <div class="form-group col-md-7">
                        <label for="prestasi_penyelenggara">Penyelenggara</label>
                        <input type="text" class="form-control" id="prestasi_penyelenggara">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <label for="prestasi_tanggal" class="col-form-label">Tanggal Mulai</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="prestasi_tanggal" name="prestasi_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-flag-o"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="prestasi_tanggal2" class="col-form-label">Tanggal Selesai</label>
                        <div class="input-group date" data-target-input="nearest">
                            <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="prestasi_tanggal2" name="prestasi_tanggal2" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-flag-checkered"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="prestasi_tapel" class="col-form-label">Tapel</label>
                        <select id="prestasi_tapel" class="form-control">
                            <option value="{{$tapel1}}">{{$tapel1}}</option>
                            <option value="{{$tapel2}}">{{$tapel2}}</option>
                            <option value="{{$tapel3}}">{{$tapel3}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="prestasi_tempat" class="col-form-label">Tempat</label>
                    <input type="text" class="form-control" id="prestasi_tempat">
                </div>
                <div class="form-group">
                    <img id="preview" src="{{asset('dist/img/takadagambar.png')}}" width="150px" height="150px"/><br/>
                    <input type="file" id="addfoto" style="display: none;"/>
                    <a href="javascript:addFoto()">Upload Sertifikat</a> |
                    <a style="color: red" href="javascript:removeImage()">Remove</a>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="prestasi_idne">
                <button type="button" class="btn btn-success pull-right" id="btnsimpan">Simpan</button>
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
                <button type="button" class="btn btn-warning pull-left" id="btnhapus">Hapus Data</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="setbulan" id="setbulan" value="ALL">
<input type="hidden" name="settahun" id="settahun" value="TAHUNINI">
<input type="hidden" name="setjenis" id="setjenis" value="ALL">
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
        $('.datemaskinput').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
    });
    function addFoto() {
		$('#addfoto').click();
	}
    $('#addfoto').change(function () {
        var imgPath = this.value;
        var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if(ext == 'pdf') {
            $('#preview').attr('src', 'dist/img/pdf.png');
        } else if(ext == "jpg" || ext == "jpeg" || ext == "png") {
            readURL(this);
        } else {
            swal({
				title: 'Stop',
				text: 'Please select image file (jpg, jpeg, pdf).',
				type: 'warning',
			})
        }
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function openedpage( jQuery ){
        var set01=document.getElementById('setbulan').value;
        var set02=document.getElementById('settahun').value;
        var token=document.getElementById('token').value;
        var source = {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'sertifikat', type: 'text'},
                { name: 'typefile', type: 'text'},
                { name: 'nmfile', type: 'text'},
                { name: 'nama', type: 'text'},
                { name: 'noinduk', type: 'text'},
                { name: 'kelas', type: 'text'},
                { name: 'kegiatan', type: 'text'},
                { name: 'penyelenggara', type: 'text'},
                { name: 'tanggal', type: 'text'},
                { name: 'tempat', type: 'text'},
                { name: 'peringkat', type: 'text'},
                { name: 'tingkat', type: 'text'},
                { name: 'bidang', type: 'text'},
                { name: 'tapel', type: 'text'},
                { name: 'inputor', type: 'text'},
            ],
            type: 'POST',
            data: {val01: set01, val02: set02, _token: token},
            url: 'admin/jalldataprestasi',
        };
        var photorenderer = function (row, column, value) {
            var name = $('#tabeldata').jqxGrid('getrowdata', row).sertifikat;
            var type = $('#tabeldata').jqxGrid('getrowdata', row).typefile;
			if (name == ''){
				var img = '<div style="background: white;"><div>';
			} else {
				if(type == 'pdf') {
					var img = '<div style="background: white;"><a href="'+name+'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="dist/img/pdf.png"></a></div>';
				} else {
					var img = '<div style="background: white;"><a href="'+name+'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="' + name + '"></a></div>';
				}
			}
            return img;
        }
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#tabeldata").jqxGrid({
            width           : '100%',
            pageable        : true,
            autoheight      : true,
            filterable      : true,
            source          : dataAdapter,
            columnsresize   : true,
            showfilterrow   : true,
            rowsheight      : 35,
            theme           : "energyblue",
            selectionmode   : 'multiplecellsextended',
            columns         : [
                { text: 'Sertifikat', width: 40, cellsrenderer: photorenderer, editable: false, sortable: false, filterable: false },
                { text: 'Nama Siswa', datafield: 'nama', width: 120, cellsalign: 'left', align: 'center'  },
                { text: 'Kelas', filtertype: 'checkedlist', datafield: 'kelas', width: 50, cellsalign: 'left', align: 'center'  },
                { text: 'Bidang', filtertype: 'checkedlist', datafield: 'bidang', width: 70, cellsalign: 'left', align: 'center'  },
                { text: 'Tingkat', filtertype: 'checkedlist', datafield: 'tingkat', width: 70, cellsalign: 'left', align: 'center'  },
                { text: 'Peringkat', datafield: 'peringkat', width: 100, cellsalign: 'left', align: 'center'  },
                { text: 'Nama Kegiatan', datafield: 'kegiatan', width: 100, cellsalign: 'left', align: 'center'  },
                { text: 'Penyelenggara', datafield: 'penyelenggara', width: 100, cellsalign: 'left', align: 'center'  },
                { text: 'Tanggal', datafield: 'tanggal', width: 100, cellsalign: 'left', align: 'center'  },
                { text: 'Tempat', datafield: 'tempat', width: 100, cellsalign: 'left', align: 'center'  },
                { text: 'Tapel', datafield: 'tapel', width: 100, cellsalign: 'left', align: 'center'  },
                { text: 'Inputor', datafield: 'inputor', width: 100, cellsalign: 'left', align: 'center'  },
                { text: 'Edit', columntype: 'button', width: 70,  editable: false, sortable: false, filterable: false, align: 'center', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#tabeldata").offset();
                        var dataRecord 	= $("#tabeldata").jqxGrid('getrowdata', editrow);
						$("#addfoto").val('');
                        $("#prestasi_idne").val(dataRecord.id);
                        $("#prestasi_siswa").val(dataRecord.noinduk).select2().trigger('change');
                        $("#prestasi_namakegiatan").val(dataRecord.namakegiatan);
                        $("#prestasi_peringkat").val(dataRecord.peringkat);
                        $("#prestasi_bidang").val(dataRecord.bidang);
                        $("#prestasi_tingkat").val(dataRecord.tingkat);
                        $("#prestasi_penyelenggara").val(dataRecord.penyelenggara);
                        $("#prestasi_tanggal").val(dataRecord.tanggal1);
                        $("#prestasi_tanggal2").val(dataRecord.tanggal2);
                        $("#prestasi_tempat").val(dataRecord.zakatmaal);
                        $("#modaltambahdata").modal('show');
                    }
                },
            ],
        });
    }
    $(document).ready(function () {
        openedpage();
        $('.select2').select2({
            width: '100%'
        });
        $("#btnsimpan").click(function(){
            var set01	= document.getElementById('addfoto');
            var set02	= document.getElementById('prestasi_siswa').value;
            var set03	= document.getElementById('prestasi_namakegiatan').value;
            var set04	= document.getElementById('prestasi_peringkat').value;
            var set05	= document.getElementById('prestasi_bidang').value;
            var set06	= document.getElementById('prestasi_tingkat').value;
            var set07	= document.getElementById('prestasi_penyelenggara').value;
            var set08	= document.getElementById('prestasi_tanggal').value;
            var set09	= document.getElementById('prestasi_tempat').value;
            var set10	= document.getElementById('prestasi_idne').value;
            var set11	= document.getElementById('prestasi_tanggal2').value;
            var set12	= document.getElementById('prestasi_tapel').value;
            var token 	= document.getElementById('token').value;
            if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Nama Siswa Wajib di Isi',
                    type: 'warning',
                })
            } else if (set03 == ''){
                swal({
                    title: 'Stop',
                    text: 'Nama Lomba / Kegiatan Wajib di Isi',
                    type: 'warning',
                })
            } else if (set07 == ''){
                swal({
                    title: 'Stop',
                    text: 'Penyelenggara Wajib di Isi',
                    type: 'warning',
                })
            } else if (set08 == ''){
                swal({
                    title: 'Stop',
                    text: 'Tanggal Lomba/Kegiatan Wajib di Isi',
                    type: 'warning',
                })
            } else if (set09 == ''){
                swal({
                    title: 'Stop',
                    text: 'Lokasi Lomba/Kegiatan Wajib di Isi',
                    type: 'warning',
                })
            } else {
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
                    form_data.append('val12', set12);
                form_data.append('_token', '{{csrf_token()}}');
                $("#modaltambahdata").modal('hide');
                $.ajax({
                    url         : '{{ route("exSimpanprestasi") }}',
                    data        : form_data,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success     : function (data) {
                        $("#tabeldata").jqxGrid("updatebounddata","filter");
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
            $("#prestasi_idne").val('new');
            $("#addfoto").val('');
            $("#modaltambahdata").modal('show');
        });
        $('#btnhapus').click(function () {
            var set01	= '';
            var set02	= 'hapus';
            var set03	= document.getElementById('prestasi_namakegiatan').value;
            var set04	= document.getElementById('prestasi_peringkat').value;
            var set05	= document.getElementById('prestasi_bidang').value;
            var set06	= document.getElementById('prestasi_tingkat').value;
            var set07	= document.getElementById('prestasi_penyelenggara').value;
            var set08	= document.getElementById('prestasi_tanggal').value;
            var set09	= document.getElementById('prestasi_tempat').value;
            var set10	= document.getElementById('prestasi_idne').value;
            var set11	= document.getElementById('prestasi_tanggal2').value;
            var token   = document.getElementById('token').value;
            $("#modaltambahdata").modal('hide');
            $.post('{{ route("exSimpanprestasi") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, _token: token },
            function(data){	
                $("#tabeldata").jqxGrid("updatebounddata", "filter");
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
            $("#setbulan").val(set01);
            $("#settahun").val(set02);
            openedpage();
        });
        $('#topbtnregional').click(function(){
            $("#setbulan").val('REGIONAL');
            $("#settahun").val('TAHUNINI');
            openedpage();
        });
        $('#topbtnnasional').click(function(){
            $("#setbulan").val('NASIONAL');
            $("#settahun").val('TAHUNINI');
            openedpage();
        });
        $('#topbtninternasional').click(function(){
            $("#setbulan").val('INTERNASIONAL');
            $("#settahun").val('TAHUNINI');
            openedpage();
        });
        var sourcegrafik = {
            datatype: "json",
            datafields: [
                { name: 'jenis' },				
                { name: 'jumlah' },			
            ],
            url: '{{ route("jsonPrestasithnini") }}'
        };
        var datajrekap		= new $.jqx.dataAdapter(sourcegrafik);
        var settinggrafik 	= {
            title: "Statistik Prestasi",
            description: "Per Kelas",
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
        var sourcegrafik2 = {
            datatype: "json",
            datafields: [
                { name: 'jenis' },				
                { name: 'jumlah' },			
            ],
            url: '{{ route("jsonPrestasithniniperbidang") }}'
        };
        var datajrekap2		= new $.jqx.dataAdapter(sourcegrafik2);
        var settinggrafik2 	= {
            title: "Statistik Prestasi",
            description: "Per Bidang",
            enableAnimations: true,		
            showBorderLine: true,
            colorScheme: 'scheme01',
            padding: { left: 5, top: 5, right: 5, bottom: 5 },
            titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },		
            source: datajrekap2,
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
        $('#grafiksebaranperjenis').jqxChart(settinggrafik2);
    });
</script>
@endpush