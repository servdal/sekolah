@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Laporan Beasiswa</h1>
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
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{{ $countakademik }}</h3>
                            <p>Akademik</p>
                        </div>
                        <div class="icon"><i class="fa fa-trophy"></i></div>
                        <a href="#" id="topbtnakademik" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $countnonakademik }}</h3>
                            <p>Non Akademik</p>
                        </div>
                        <div class="icon"><i class="fa fa-trophy"></i></div>
                        <a href="#" id="topbtnnonakademik" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $countsiswa }}</h3>
                            <p>Total Penerima</p>
                        </div>
                        <div class="icon"><i class="fa fa-trophy"></i></div>
                        <a href="#" id="topbtnall" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="card card-solid bg-green-gradient">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-mortar-board"></i>Report</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
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
                                    <div class="col-lg-6">
                                        <div class="input-group margin">
                                            <input type="text" class="form-control" id="cekthn" value="{{ date('Y') }}">
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
                <div class="col-lg-12" id="sectionaksi">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-cloud"></i> Tabel Laporan Beasiswa</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" title="Add New" id="btnaddnew"><i class="fa fa-plus"></i> Tambah Data</button>
                                <button type="button" class="btn btn-tool" title="Export to Excel" id="btnexport"><i class="fa fa-print"></i></button>
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
	</section>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
    <div class="form-row">
        <div class="form-group col-md-7">
            <label for="prestasi_penyelenggara">Penyelenggara</label>
            <input type="text" class="form-control" id="prestasi_penyelenggara">
        </div>
        <div class="col-md-4">
            <label for="prestasi_tanggal" class="col-form-label">Tanggal Mulai</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="prestasi_tanggal" class="form-control" >
            </div>
        </div>
        <div class="col-md-4">
            <label for="prestasi_tanggal2" class="col-form-label">Tanggal Selesai</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="prestasi_tanggal2" class="form-control" >
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    <div class="form-group">
        <label for="prestasi_tempat" class="col-form-label">Tempat</label>
        <input type="text" class="form-control" id="prestasi_tempat">
    </div>
</div>
<div class="modal fade" id="modaltambahdata">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Tambah Data Beasiswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <select id="prestasi_siswa" name="prestasi_siswa" class="form-control select2" style="width:100%;">
                        <option value="">Pilih salah satu</option>
                        @foreach($datasiswa as $rsiswa)
                            <option value="{{ $rsiswa['noinduk'] }}">{{ $rsiswa['nama'] }} ( {{ $rsiswa['klspos'] }} No. Induk {{ $rsiswa['noinduk'] }} )</option>
                        @endforeach			  
                    </select>
                </div>
                <div class="form-group">
                    <label for="prestasi_namakegiatan" class="col-form-label">Nama Beasiswa</label>
                    <input type="text" class="form-control" id="prestasi_namakegiatan">
                </div>
                <div class="form-group">
                    <label for="prestasi_peringkat" class="col-form-label">Jenis</label>
                    <select id="prestasi_peringkat" class="form-control">
                        <option value="Akademik">Beasiswa Dari Bidang Akademik</option>
                        <option value="Non Akademik">Beasiswa Dari Bidang Non Akademik</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="prestasi_bidang">Nominal (Ketik Hanya Angka)</label>
                        <input type="text" class="form-control" id="prestasi_bidang">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="prestasi_tingkat">Berapa Kali (Ketik Hanya Angka)</label>
                        <input type="text" class="form-control" id="prestasi_tingkat">
                    </div>
                </div>
                <div class="form-group">
                    <label for="prestasi_tapel" class="col-form-label">Tapel</label>
                    <select id="prestasi_tapel" class="form-control">
                        <option value="{{$tapel1}}">{{$tapel1}}</option>
                        <option value="{{$tapel2}}">{{$tapel2}}</option>
                        <option value="{{$tapel3}}">{{$tapel3}}</option>
                    </select>
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
<input type="hidden" name="setbulan" id="setbulan" value="BULANINI">
<input type="hidden" name="settahun" id="settahun" value="TAHUNINI">
<input type="hidden" name="setjenis" id="setjenis" value="ALL">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="getgambar" id="getgambar" value="">

@endsection
@push('script')
<script type="text/javascript">
    $(function () {
        $("#prestasi_tanggal").datepicker({format: 'dd-mm-yyyy'});
        $("#prestasi_tanggal2").datepicker({format: 'dd-mm-yyyy'});
    });
    function addFoto() {
		$('#addfoto').click();
	}
    function removeImage() {
        $("#addfoto").val('');
        $('#preview').attr('src', 'dist/img/takadagambar.png');
    }
    $('#addfoto').change(function () {
        var imgPath = this.value;
        var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if(ext == "jpg" || ext == "jpeg" || ext == "png") {
            readURL(this);
        } else {
            swal({
				title: 'Stop',
				text: 'Please select image file (jpg, jpeg, png).',
				type: 'warning',
			})
        }
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $('#getgambar').val(e.target.result);
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
                { name: 'noinduk', type: 'text'},
                { name: 'nama', type: 'text'},
                { name: 'kelas', type: 'text'},
                { name: 'tapel', type: 'text'},
                { name: 'jenis', type: 'text'},
                { name: 'namabeasiswa', type: 'text'},
                { name: 'jumlah', type: 'text'},
                { name: 'nominal', type: 'text'},
                { name: 'nmfile', type: 'text'},
                { name: 'tipe', type: 'text'},
                { name: 'inputor', type: 'text'},
            ],
            type: 'POST',
            data: {val01: set01, val02: set02, _token: token},
            url: '{{ route("jsonBeasiswa") }}',
        };
        var photorenderer = function (row, column, value) {
            var name = $('#tabeldata').jqxGrid('getrowdata', row).nmfile;
			if (name == '' || name == null){
				var img = '<div style="background: white;"><div>';
			} else {
                var img = '<div style="background: white;"><a href="'+name+'"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="' + name + '"></a></div>';
			}
            return img;
        }
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#tabeldata").jqxGrid({
            width: '100%',   
            columnsresize: true,
            theme: "energyblue",
            autoheight: true,
            showstatusbar: true,
            statusbarheight: 50,
            altrows: true,
            source: dataAdapter,
            showaggregates: true,
            selectionmode: 'singlecell',
            rowsheight: 35,
            columns: [
                { text: 'Sertifikat', width: '7%', cellsrenderer: photorenderer, editable: false, sortable: false, filterable: false },
                { text: 'Tapel', datafield: 'tapel', width: '7%', cellsalign: 'center', align: 'center'  },
                { text: 'Nama Siswa', datafield: 'nama', width: '15%', cellsalign: 'left', align: 'center'  },
                { text: 'Kelas', filtertype: 'checkedlist', datafield: 'kelas', width: '7%', cellsalign: 'center', align: 'center'  },
                { text: 'No.Induk', datafield: 'noinduk', width: '7%', cellsalign: 'left', align: 'center'  },
                { text: 'Jenis', filtertype: 'checkedlist', datafield: 'jenis', width: '10%', cellsalign: 'left', align: 'center'  },
                { text: 'Nama Beasiswa', datafield: 'namabeasiswa', width: '15%', cellsalign: 'left', align: 'center'  },
                { text: 'Nominal', editable: false, filterable: false, cellsformat: 'n2', aggregates: ['sum'], datafield: 'nominal', width: '10%', cellsalign: 'right', align: 'center'  },
                { text: 'Count', editable: false, filterable: false, cellsformat: 'n2', aggregates: ['sum'], datafield: 'jumlah', width: '6%', cellsalign: 'right', align: 'center'  },
                { text: 'Inputor', datafield: 'inputor', width: '10%', cellsalign: 'left', align: 'center'  },
                { text: 'Edit', columntype: 'button', width: '6%',  editable: false, sortable: false, filterable: false, align: 'center', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#tabeldata").offset();
                        var dataRecord 	= $("#tabeldata").jqxGrid('getrowdata', editrow);
                        var gambar      = dataRecord.nmfile;
                        $("#addfoto").val('');
                        $("#getgambar").val(gambar);
                        $('#preview').attr('src', gambar);
                        $("#prestasi_idne").val(dataRecord.id);
                        $("#prestasi_siswa").val(dataRecord.noinduk).select2().trigger('change');
                        $("#prestasi_namakegiatan").val(dataRecord.namabeasiswa);
                        $("#prestasi_peringkat").val(dataRecord.jenis);
                        $("#prestasi_bidang").val(dataRecord.nominal);
                        $("#prestasi_tingkat").val(dataRecord.jumlah);
                        $("#modaltambahdata").modal('show');
                    }
                },
            ],
        });
    }
    $(document).ready(function () {
        $('.select2').select2({
            width: '100%'
        });
        $("#prestasi_bidang").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#prestasi_tingkat").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        
        $("#btnsimpan").click(function(){
            var set01	= document.getElementById('getgambar').value;
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
            }
            else if (set03 == ''){
                swal({
                    title: 'Stop',
                    text: 'Nama Beasiswa Wajib di Isi',
                    type: 'warning',
                })
            }
            else if (set05 == ''){
                swal({
                    title: 'Stop',
                    text: 'Nominal Wajib di Isi',
                    type: 'warning',
                })
            }
            else if (set06 == ''){
                swal({
                    title: 'Stop',
                    text: 'Berapa Kali Menerima Beasiswa Ini Wajib di Isi',
                    type: 'warning',
                })
            }
            else {
                var form_data = new FormData();
                form_data.append('file', set01);
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
                $.ajax({
                    url: '{{ route("exSimpanBeasiswa") }}',
                    data: form_data,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $("#tabeldata").jqxGrid("updatebounddata","filter");
                        $("#modaltambahdata").modal('hide');
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
            $("#getgambar").val('');
            $("#addfoto").val('');
            $('#preview').attr('src', 'dist/img/takadagambar.png');
            $("#prestasi_siswa").val('').select2().trigger('change');
            $("#prestasi_namakegiatan").val('');
            $("#prestasi_bidang").val('0');
            $("#prestasi_tingkat").val('0');
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
            $.post('{{ route("exSimpanBeasiswa") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, _token: token },
            function(data){	
                $("#modaltambahdata").modal('hide');
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
        $('#topbtnakademik').click(function(){
            $("#setbulan").val('Akademik');
            $("#settahun").val('PERJENIS');
            openedpage();
        });
        $('#topbtnnonakademik').click(function(){
            $("#setbulan").val('Non Akademik');
            $("#settahun").val('PERJENIS');
            openedpage();
        });
        $('#topbtnall').click(function(){
            $("#setbulan").val('ALL');
            $("#settahun").val('TAHUNINI');
            openedpage();
        });
        openedpage();
    });
</script>
@endpush