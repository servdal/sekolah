@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Laporan Konseling Siswa</h1>
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
                <div class="col-lg-4 col-md-4">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{{ $countbelum }}</h3>
                            <p>Belum ada Tindakan</p>
                        </div>
                        <div class="icon"><i class="fa fa-trophy"></i></div>
                        <a href="#" id="topbtnblmtindak" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $countpemantauan }}</h3>
                            <p>Dalam Pemantauan</p>
                        </div>
                        <div class="icon"><i class="fa fa-trophy"></i></div>
                        <a href="#" id="topbtnpemantauan" class="small-box-footer">View Detail <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="box box-solid bg-green-gradient">
                        <div class="box-header">
                            <i class="fa fa-mortar-board"></i><h3 class="box-title">Report</h3>
                        </div>
                        <div class="box-body">
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
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-cloud"></i> Control</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="#" id="btnaddnew"  class="btn btn-block btn-social btn-success">
                                <i class="fa fa-balance-scale"></i> Tambah Data
                            </a>
						</div>
                        <div class="card-footer">
                            <h3>Statistik Per Kelas Tahun {{ date("Y") }}</h3>
                            <div id='grafiksebaran' style="width:100%; height:320px;"></div>
						</div>
                        <div class="card-footer">
                            <h3>Statistik Per Jenis Tahun {{ date("Y") }}</h3>
                            <div id='grafiksebaranperjenis' style="width:100%; height:320px;"></div>
						</div>
                    </div>
                </div>
                <div class="col-lg-8" id="sectionaksi">
                    <div class="card card-info shadow" id="datanilai">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> Tabel Konseling Bulan {{ date("M") }} {{ date("Y") }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body utama">
                            <div id="divpesan"></div>
							<div id="tabeldata"></div>
						</div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<div class="modal fade" id="modaltambahdata">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Tambah Data Konseling</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <select id="konseling_siswa" name="konseling_siswa" class="form-control select2" >
                        <option value="">Pilih salah satu</option>
                        @foreach($datasiswa as $rsiswa)
                            <option value="{{ $rsiswa['noinduk'] }}">{{ $rsiswa['nama'] }} ( {{ $rsiswa['klspos'] }} No. Induk {{ $rsiswa['noinduk'] }} )</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="konseling_deskripsi" class="col-form-label">Deskripsi Kejadian</label>
                    <input type="text" class="form-control" id="konseling_deskripsi">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="konseling_jenis" class="col-form-label">Jenis Pelanggaran</label>
                        <select id="konseling_jenis" class="form-control">
                            <option value="MNK">Miras, Narkoba, Kriminal</option>
                            <option value="BP">Berkelahi dan Pengeroyokan</option>
                            <option value="BLY">Bullying / Perundungan</option>
                            <option value="TS">Perilaku Tidak Sopan</option>
                            <option value="HLS">Hubungan dengan Lawan Jenis</option>
                            <option value="BLS">Bolos / Terlambat</option>
                            <option value="MRK">Merokok</option>
                            <option value="BJR">Masalah Belajar</option>
                            <option value="HTS">Hubungan dengan Teman Sebaya</option>
                            <option value="DLL">Masalah Lain - Lain</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="konseling_kategori">Kategori</label>
                        <select id="konseling_kategori" class="form-control">
                            <option value="RINGAN">Pelanggaran Ringan</option>
                            <option value="SEDANG">Pelanggaran Sedang</option>
                            <option value="BERAT">Pelanggaran Berat</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="konseling_tanggal">Tanggal Kejadian</label>
                        <input type="text" class="form-control" id="konseling_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
                    </div>
                    <div class="form-group col-md-7">
                        <label for="konseling_tanggaltangani">Tanggal Penanganan</label>
                        <input type="text" class="form-control" id="konseling_tanggaltangani" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
                    </div>
                </div>
                <div class="form-group">
                    <label for="konseling_layanan">Layanan Yang di Berikan</label>
                    <textarea id="konseling_layanan" name="konseling_layanan" rows="10" cols="80"></textarea>
                </div>
                <div class="form-group">
                    <label for="konseling_tindaklanjut">Tindak Lanjut</label>
                    <textarea id="konseling_tindaklanjut" name="konseling_tindaklanjut" rows="10" cols="80"></textarea>
                </div>
                <div class="form-group">
                    <label for="konseling_hasil">Hasil</label>
                    <select id="konseling_hasil" class="form-control">
                        <option value="">Belum Ada Tindakan</option>
                        <option value="Dalam Pemantauan">Dalam Pemantauan</option>
                        <option value="TUNTAS">Tuntas</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="konseling_idne">
                <button type="button" class="btn btn-success pull-right" id="btnsimpan">Simpan</button>
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="setbulan" id="setbulan" value="BULANINI">
<input type="hidden" name="settahun" id="settahun" value="TAHUNINI">
<input type="hidden" name="setjenis" id="setjenis" value="ALL">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

@endsection
@push('script')
<script type="text/javascript">
    $(function () {
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace( 'konseling_tindaklanjut', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
		CKEDITOR.replace( 'konseling_layanan', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
        $('#konseling_tanggaltangani').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#konseling_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
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
                { name: 'deskripsi', type: 'text'},
                { name: 'tglmasalah', type: 'text'},
                { name: 'jenis', type: 'text'},
                { name: 'tlsjenis', type: 'text'},
                { name: 'kategori', type: 'text'},
                { name: 'tglpenanganan', type: 'text'},
                { name: 'layanan', type: 'text'},
                { name: 'tindaklanjut', type: 'text'},
                { name: 'hasil', type: 'text'},
                { name: 'guru', type: 'text'},
            ],
            type: 'POST',
            data: {val01: set01, val02: set02, _token: token},
            url: 'guru/jalldatakonseling',
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#tabeldata").jqxGrid({
            width: '100%',
            pageable: true,
            autoheight: true,
            filterable: true,
            source: dataAdapter,
            columnsresize: true,
            showfilterrow: true,
            theme: "energyblue",
            selectionmode: 'multiplecellsextended',
            columns: [
                { text: 'Nama Siswa', datafield: 'nama', width: 120, cellsalign: 'left', align: 'center'  },
                { text: 'Kelas', filtertype: 'checkedlist', datafield: 'kelas', width: 50, cellsalign: 'left', align: 'center'  },
                { text: 'No.Induk', datafield: 'noinduk', width: 70, cellsalign: 'left', align: 'center'  },
                { text: 'Tgl. Kejadian', datafield: 'tglmasalah', width: 100, cellsalign: 'left', align: 'center'  },
                { text: 'Jenis', filtertype: 'checkedlist', datafield: 'tlsjenis', width: 200, cellsalign: 'left', align: 'center'  },
                { text: 'Kategori', filtertype: 'checkedlist', datafield: 'kategori', width: 100, cellsalign: 'left', align: 'center'  },
                { text: 'Tgl. Penanganan', datafield: 'tglpenanganan', width: 100, cellsalign: 'left', align: 'center'  },
                { text: 'Layanan yang diberikan', datafield: 'layanan', width: 200, cellsalign: 'left', align: 'center'  },
                { text: 'Tindak Lanjut', datafield: 'tindaklanjut', width: 200, cellsalign: 'left', align: 'center'  },
                { text: 'Hasil', datafield: 'hasil', width: 100, cellsalign: 'left', align: 'center'  },
                { text: 'Guru BK', datafield: 'guru', width: 150, cellsalign: 'left', align: 'center'  },
                { text: 'Edit', columntype: 'button', width: 70,  editable: false, sortable: false, filterable: false, align: 'center', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#tabeldata").offset();
                        var dataRecord 	= $("#tabeldata").jqxGrid('getrowdata', editrow);
					    $("#konseling_idne").val(dataRecord.id);
                        $("#konseling_hasil").val(dataRecord.hasil);
						CKEDITOR.instances['konseling_tindaklanjut'].setData(dataRecord.tindaklanjut)
						CKEDITOR.instances['konseling_layanan'].setData(dataRecord.layanan)
                        $("#konseling_tanggaltangani").val(dataRecord.tglpenanganan);
                        $("#konseling_tanggal").val(dataRecord.tglmasalah);
                        $("#konseling_kategori").val(dataRecord.kategori);
                        $("#konseling_jenis").val(dataRecord.jenis);
                        $("#konseling_deskripsi").val(dataRecord.deskripsi);
                        $("#konseling_siswa").val(dataRecord.noinduk).select2().trigger('change');
                        $("#modaltambahdata").modal('show');
                    }
                },
				{ text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Del";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#tabeldata").offset();		
						var dataRecord 	= $("#tabeldata").jqxGrid('getrowdata', editrow);
						swal({
							title: 'Apakah anda yakin ?',
							text: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
							type: 'warning',
							showCancelButton: true,
							confirmButtonClass: 'btn btn-confirm mt-2',
							cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
							confirmButtonText: 'Yes'
						}).then(function () {
							var set01	= dataRecord.id;
							var set02	= '';
							var set03	= '';
							var set04	= '';
							var set05	= '';
							var set06	= '';
							var set07	= '';
							var set08	= '';
							var set09	= '';
							var set10	= '';
							var set11	= 'hapus';
							var token=document.getElementById('token').value;
							$.post('guru/exsimpankonseling', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, _token: token },
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
									$("#tabeldata").jqxGrid('updatebounddata');
									return false;
							});
						});
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
        $('#btnaddnew').click(function () {
            $("#konseling_idne").val('new');
            $("#modaltambahdata").modal('show');
        });
        $('#btnsimpan').click(function () {
            var set01	= document.getElementById('konseling_idne').value;
            var set02	= document.getElementById('konseling_hasil').value;
            var set03	= CKEDITOR.instances['konseling_tindaklanjut'].getData();
            var set04	= CKEDITOR.instances['konseling_layanan'].getData();
            var set05	= document.getElementById('konseling_tanggaltangani').value;
            var set06	= document.getElementById('konseling_tanggal').value;
            var set07	= document.getElementById('konseling_jenis').value;
            var set08	= document.getElementById('konseling_kategori').value;
            var set09	= document.getElementById('konseling_deskripsi').value;
            var set10	= document.getElementById('konseling_siswa').value;
            var set11	= '';
            var token=document.getElementById('token').value;
            $.post('guru/exsimpankonseling', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, _token: token },
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
        var sourcegrafik = {
            datatype: "json",
            datafields: [
                { name: 'jenis' },				
                { name: 'jumlah' },			
            ],
            url: 'jrekapkonselingthnini'
        };
        var datajrekap		= new $.jqx.dataAdapter(sourcegrafik);
        var settinggrafik 	= {
            title: "Statistik Konseling",
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
            url: 'jrekapkonselingperjenis'
        };
        var datajrekap2		= new $.jqx.dataAdapter(sourcegrafik2);
        var settinggrafik2 	= {
            title: "Statistik Konseling",
            description: "Per Jenis",
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