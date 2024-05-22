@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> TABEL KOMPETENSI DASAR</h1>
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
                <div class="col-lg-3">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Control Panel</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group"> 
								<label for="id_kelas">Pilih Kelas:</label>
								<select id="id_kelas" class="form-control">
									<option value="...">Silahkan Pilih</option>
									<option value="kb">Kelas KB</option>
									<option value="ta">Kelas TA</option>
									<option value="1">Kelas I</option>
									<option value="2">Kelas II</option>
									<option value="3">Kelas III</option>
									<option value="4">Kelas IV</option>
									<option value="5">Kelas V</option>
									<option value="6">Kelas VI</option>
									<option value="7">Kelas VII</option>
									<option value="8">Kelas VIII</option>
									<option value="9">Kelas IX</option>
									<option value="10">Kelas X</option>
									<option value="11">Kelas XI</option>
									<option value="12">Kelas XII</option>
								</select>
							</div>
							<div class="form-group"> 
								<label for="jqmatpel">Pilih Mata Pelajaran</label>
								<div id='jqmatpel'></div>
							</div>
						</div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-info" id="btnupload">Upload Data KD</button>
							(Format File Upload Mohon Download di <a href="/format/masterkd.xlsx">Di SINI</a>)
						</div>
                    </div>
                    <div id="status" class="status"></div>
                </div>
                <div class="col-lg-9">
                    @if(Session::has('message'))
                        <div class="alert {{ Session::get('alert-class') }} alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> {{ Session::get('status') }}</h4>
                                {!! Session::get('message') !!}
                        </div>
                    @endif
                    <div class="card card-info shadow" id="datanilai">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Tabel KD</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body utama">
                            <button type="button" class="btn btn-success" id="btntambahkd">Tambahkan Data KD</button>
						</div>
                        <div class="card-footer utama">
                            <div id="gridkurikulum"></div>
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
<div class="modal fade" id="modaluploader">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Uploader Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="import" action="{{ url('guru/uploaddatakd') }}" method="post" enctype="multipart/form-data">
		    {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
					<input type="file" id="sheeta" name="sheeta">
				</div>
				<div class="form-group">
					<label>Aksi Uploader</label>
					<select id="set_aksi" name="set_aksi" class="form-control" >
						<option value="1">Timpa Data (Data Lama Akan Kami Hapus Total, dan Ganti Baru)</option>
						<option value="2">Tambah Data (Data Lama akan kami tambahkan dengan file anda)</option>
					</select>
				</div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <input class="btn btn-danger" type="submit" name="unggahnilai" value="Unggah" />
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltambahkd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form ADD/Edit Kompetensi Dasar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Muatan Matpel</label>
                    <select id="add_matpel" size="1" class="form-control">
                        <option value="">Pilih Salah Satu</option>
                        @foreach($jmuatan as $rmuatan)
                            <option value="{{ $rmuatan['muatan'] }}">{{ $rmuatan['matpel'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Semester</label>
                            <input type="text" id="add_semester" class="form-control">
                        </div> 
                        <div class="col-lg-4">
                            <label>Tema</label>
                            <input type="text" id="add_tema" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Subtema</label>
                            <input type="text" id="add_subtema" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi Tema</label>
                    <textarea id="add_deskripsitema" rows="10" cols="80"></textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Kode KD</label>
                            <input type="text" id="add_kodekd" class="form-control">
                        </div> 
                        <div class="col-lg-6">
                            <label>KKM</label>
                            <input type="text" id="add_nilai" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi Kompetensi Dasar</label>
                    <textarea id="add_kompetensi" rows="10" cols="80"></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="add_idne">
                <input type="hidden" class="form-control" id="id_muatan">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <div id="tomboltambah">
                    <button type="button" class="btn btn-success" id="btnsimpankd">Simpan</button>	
                </div>
                <div id="tombolupdate">
                    <button type="button" class="btn btn-info" id="btnubahkd">Update</button>	
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
	$(function () {
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace( 'add_kompetensi', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
	});
    $(document).ready(function () {
        var token = document.getElementById('token').value;
        $('#utama').hide();
        $('#btnupload').click(function () {
            $("#modaluploader").modal('show');
        });
        
        $("#id_kelas").on('change', function () {
            var klse = $(this).find('option:selected').attr('value');				
            if (klse != ''){
                var sourcemuatan =
                {
                    datatype: "json",
                    datafields: [{ name: 'matpel',type: 'text'}, { name: 'muatan',type: 'text'},],
                    type: 'POST',
                    data: { val01:klse, _token:token },
                    url: 'json/datakkm',
                };
                var datamuatan = new $.jqx.dataAdapter(sourcemuatan);
                $("#jqmatpel").jqxComboBox({ selectedIndex: 0, source: datamuatan, displayMember: "matpel", valueMember: "muatan", width: "100%", height: 30});
            }
        });
        $("#jqmatpel").on('select', function (event) {	
            var set01=document.getElementById('id_kelas').value;
            if (event.args) {
                var item = event.args.item;
                if (item) {
                    var set02 = item.value;
                    $("#id_muatan").val(item.value);
                    $('#utama').show();
                    var source =
                        {
                            datatype: "json",
                            datafields: [						
                                { name: 'idne', type: 'text'},
                                { name: 'semester', type: 'text'},
                                { name: 'kelas', type: 'text'},
                                { name: 'tema', type: 'text'},
                                { name: 'subtema', type: 'text'},
                                { name: 'deskripsitema', type: 'text'},
                                { name: 'matpel', type: 'text'},
                                { name: 'muatan', type: 'text'},
                                { name: 'kodekd', type: 'text'},
                                { name: 'kkm', type: 'text'},
                                { name: 'deskripsi', type: 'text'},		
                            ],
                            type: 'POST',
                            data: {val01:set01, val02: set02, _token:token},
                            url: "json/jsdatakd"
                        };
                        
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    $("#gridkurikulum").jqxGrid({
                        width: '100%',
                        pageable: false,
                        filterable: true,
                        filtermode: 'excel',
                        source: dataAdapter,
                        columnsresize: true,
                        theme: "energyblue",
                        selectionmode: 'multiplecellsextended',
                        columns: [
                            { text: 'SMT', datafield: 'semester', width: '5%', cellsalign: 'center', align: 'center' },
                            { text: 'TEMA', datafield: 'tema', width: '5%', cellsalign: 'center', align: 'center' },
                            { text: 'SUBTEMA', datafield: 'subtema', width: '5%', cellsalign: 'center', align: 'center' },
                            { text: 'Deskripsi Tema', datafield: 'deskripsitema', width: '25%', cellsalign: 'center', align: 'center' },
                            { text: 'Muatan', datafield: 'muatan', width: '10%', cellsalign: 'center', align: 'center' },
                            { text: 'Kode KD', datafield: 'kodekd', width: '5%', cellsalign: 'left', align: 'center' },
                            { text: 'KKM', datafield: 'kkm', width: '5%', cellsalign: 'left', align: 'center' },
                            { text: 'Deskripsi KD', datafield: 'deskripsi', width: '30%', cellsalign: 'left', align: 'center' },
                            { text: 'UBAH', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '5%', cellsrenderer: function () {
                                return "Edit";
                                }, buttonclick: function (row) {	
                                editrow = row;	
                                var offset 		= $("#gridkurikulum").offset();
                                var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                                    $("#add_idne").val(dataRecord.idne);
                                    $("#add_matpel").val(dataRecord.muatan);
                                    $("#add_kodekd").val(dataRecord.kodekd);
                                    $("#add_nilai").val(dataRecord.kkm);
                                    $("#add_semester").val(dataRecord.semester);
                                    $("#add_tema").val(dataRecord.tema);
                                    $("#add_subtema").val(dataRecord.subtema);
                                    CKEDITOR.instances['add_deskripsitema'].setData(dataRecord.deskripsitema)
                                    CKEDITOR.instances['add_kompetensi'].setData(dataRecord.deskripsi)
                                    $('#tomboltambah').hide();
                                    $('#tombolupdate').show();
                                    $("#modaltambahkd").modal('show');	
                                }
                            },
                            { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                                return "Del";
                                }, buttonclick: function (row) {
                                    editrow = row;	
                                    var offset 		= $("#gridkurikulum").offset();
                                    var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                                    swal({
                                        title: 'Apakah anda yakin ?',
                                        text: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
                                        type: 'warning',
                                        showCancelButton: true,
                                        confirmButtonClass: 'btn btn-confirm mt-2',
                                        cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                        confirmButtonText: 'Yes'
                                    }).then(function () {
                                        var set01		= dataRecord.idne;
                                        var set02		= 'db_kd';
                                        var set03		= '';
                                        var token		= document.getElementById('token').value;
                                        $.post('admin/destroyer', { val01: set01, val02: set02, val03: '', _token: token },
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
                                                $("#gridkurikulum").jqxGrid('updatebounddata');
                                                return false;
                                        });
                                    });
                                }
                            },
                        ]
                    });
                }
            }
        });
        $('#btnsimpankd').click(function () {
            var set01=document.getElementById('id_kelas').value;
            var set02=document.getElementById('add_matpel').value;
            var set03=document.getElementById('id_muatan').value;
            var set04=document.getElementById('add_kodekd').value;
            var set05=CKEDITOR.instances['add_kompetensi'].getData()
            var set06='baru';
            var set07=document.getElementById('add_nilai').value;
            $.post('guru/exdatakodekd', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, _token:token },
            function(data){	
                $("#modaltambahkd").modal('hide');
                $("#gridkurikulum").jqxGrid("updatebounddata");		
                $('.status').html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");		
                return false;
            });
        });

        $('#btnubahkd').click(function () {
            var set01=document.getElementById('id_kelas').value;
            var set02=document.getElementById('add_matpel').value;
            var set03=document.getElementById('id_muatan').value;
            var set04=document.getElementById('add_kodekd').value;
            var set05=CKEDITOR.instances['add_kompetensi'].getData()
            var set06=document.getElementById('add_idne').value;
            var set07=document.getElementById('add_nilai').value;
            var set08=document.getElementById('add_semester').value;
            var set09=document.getElementById('add_tema').value;
            var set10=document.getElementById('add_subtema').value;
            var set11=CKEDITOR.instances['add_deskripsitema'].getData()
            $.post('guru/exdatakodekd', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, _token:token },
            function(data){	
                $("#modaltambahkd").modal('hide');
                $("#gridkurikulum").jqxGrid("updatebounddata");		
                $('.status').html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");		
                return false;
            });
        });
        $('#btntambahkd').click(function () { 	
            $("#modaltambahkd").modal('show');	 
            $('#tomboltambah').show();
            $('#tombolupdate').hide(); 
        });
    });
</script>
@endpush