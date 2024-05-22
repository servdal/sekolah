@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0"> Rencana Pembelajaran</h1>
            </div>
            <div class="col-sm-2">
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
                    <div id="status" class="status"></div>
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Control Panel</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            Silahkan Pilih Kelas Untuk di Tentukan Kurikulum 
							@if(Session('sekolah_level') == 1)
                                <a href="#" id="gradekb"  class="btn btn-block btn-social btn-primary">
                                    <i class="fa fa-windows"></i> Kelompok Belajar
                                </a>
                                <a href="#" id="gradeta"  class="btn btn-block btn-social btn-warning">
                                    <i class="fa fa-android"></i> Tarbiyatul Athfal
                                </a>
                            @elseif (Session('sekolah_level') == 2)
                                <a href="#" id="grade1"  class="btn btn-block btn-social btn-info">
                                    <i class="fa fa-windows"></i> Kelas I
                                </a>
                                <a href="#" id="grade2"  class="btn btn-block btn-social btn-danger">
                                    <i class="fa fa-android"></i> Kelas II
                                </a>
                                <a href="#" id="grade3"  class="btn btn-block btn-social btn-success">
                                    <i class="fa fa-apple"></i> Kelas III
                                </a>
                                <a href="#" id="grade4"  class="btn btn-block btn-social btn-primary">
                                    <i class="fa fa-facebook"></i> Kelas IV
                                </a>
                                <a href="#" id="grade5"  class="btn btn-block btn-social btn-warning">
                                    <i class="fa fa-google"></i> Kelas V
                                </a>
                                <a href="#" id="grade6"  class="btn btn-block btn-social btn-info">
                                    <i class="fa fa-twitter"></i> Kelas VI
                                </a>
                            @elseif (Session('sekolah_level') == 3)
                                <a href="#" id="grade7"  class="btn btn-block btn-social btn-danger">
                                    <i class="fa fa-windows"></i> Kelas I
                                </a>
                                <a href="#" id="grade8"  class="btn btn-block btn-social btn-success">
                                    <i class="fa fa-android"></i> Kelas II
                                </a>
                                <a href="#" id="grade9"  class="btn btn-block btn-social btn-primary">
                                    <i class="fa fa-apple"></i> Kelas III
                                </a>
                            @else
                                <a href="#" id="grade10"  class="btn btn-block btn-social btn-warning">
                                    <i class="fa fa-windows"></i> Kelas I
                                </a>
                                <a href="#" id="grade11"  class="btn btn-block btn-social btn-info">
                                    <i class="fa fa-android"></i> Kelas II
                                </a>
                                <a href="#" id="grade12"  class="btn btn-block btn-social btn-danger">
                                    <i class="fa fa-apple"></i> Kelas III
                                </a>
                            @endif
						</div>
                        <div class="card-footer">
                            <a href="#" id="btnupload"  class="btn btn-block btn-social btn-danger">
								<i class="fa fa-upload"></i> Upload Data KKM
							</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card card-info shadow" id="datanilai">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Data KKM</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body utama">
                            <button type="button" class="btn btn-success" id="btntambahkkm">Tambahkan Data KKM</button>
							<button type="button" class="btn btn-info" id="btnviewrekap">Lihat Rekap Data</button>
						</div>
                        <div class="card-footer utama">
                            <div id="gridkurikulum"></div>
					    </div>
                        <div id="pendukung" class="card-footer">
                            <button type="button" class="btn btn-danger" id="btnkembali">Kembali</button>
                            <div id="divrekap"></div>
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
                <button type="button" class="btn btn-danger pull-right" id="btnunggah">Unggah</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltambahkkm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form ADD/Edit KKM</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-8">
                            <label>Muatan Matpel</label>
                            <input type="text" id="id_matpel" class="form-control">
                        </div> 
                        <div class="col-xs-4">
                            <label>MUATAN</label>
                            <input type="text" id="id_muatan" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-4">
                            <label>KI-3</label>
                            <input type="text" id="id_ki3" class="form-control">
                        </div> 
                        <div class="col-xs-4">
                            <label>KI-4</label>
                            <input type="text" id="id_ki4" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="id_idne">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <div id="tomboltambah">
                    <button type="button" class="btn btn-success" id="btnsimpankkm">Simpan</button>	
                </div>
                <div id="tombolupdate">
                    <button type="button" class="btn btn-info" id="btnubahkkm">Update</button>	
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        var token = document.getElementById('token').value;
        $('#pendukung').hide();
        $('#btnkembali').click(function () { $('#pendukung').hide(); $('.utama').show(); });
        $('#gradekb').click(function () {	
            var set01	='kb';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#gradeta').click(function () {	
            var set01	='ta';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#grade1').click(function () {
            var set01='1';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#grade2').click(function () {	
            var set01='2';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#grade3').click(function () {	
            var set01='3';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#grade4').click(function () {	
            var set01='4';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#grade5').click(function () {	
            var set01='5';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#grade6').click(function () {	
            var set01='6';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#grade7').click(function () {	
            var set01='7';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#grade8').click(function () {	
            var set01='8';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#grade9').click(function () {	
            var set01='9';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#grade10').click(function () {	
            var set01='10';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url: '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#grade11').click(function () {
            var set01='11';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url : '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#grade12').click(function () {	
            var set01='12';
            $("#id_kelas").val(set01);
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'namamk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'matpel', type: 'text'},
                    { name: 'muatan', type: 'text'},
                    { name: 'kitiga', type: 'text'},
                    { name: 'kiempat', type: 'text'},
                    { name: 'idne', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, _token: token},
                url : '{{ route("jsonDatakkm") }}'
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Muatan Mata Pelajaran', datafield: 'matpel', width: '35%', cellsalign: 'left', align: 'center' },
                    { text: 'Kode', datafield: 'muatan', width: '15%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-3', datafield: 'kitiga', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'KI-4', datafield: 'kiempat', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'UBAH', ditable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '10%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 		= $("#gridkurikulum").offset();
                            var dataRecord 	= $("#gridkurikulum").jqxGrid('getrowdata', editrow);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_ki3").val(dataRecord.kitiga);
                            $("#id_ki4").val(dataRecord.kiempat);
                            $("#id_muatan").val(dataRecord.muatan);
                            $("#id_matpel").val(dataRecord.matpel);
                            $('#tomboltambah').hide();
                            $('#tombolupdate').show();
                            $("#modaltambahkkm").modal('show');
                        }
                    },
                    { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
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
                                var set02		= 'db_kkm';
                                var set03		= '';
                                var token		= document.getElementById('token').value;
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: token },
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
        });
        $('#btnsimpankkm').click(function () {
            var set01=document.getElementById('id_kelas').value;
            var set02=document.getElementById('id_matpel').value;
            var set03=document.getElementById('id_muatan').value;
            var set04=document.getElementById('id_ki3').value;
            var set05=document.getElementById('id_ki4').value;
            var set06='baru';
            $.post('{{ route("exDatakkm") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, _token: token },
            function(data){	
                $("#modaltambahkkm").modal('hide');
                $("#gridkurikulum").jqxGrid("updatebounddata");		
                $('.status').html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");		
                return false;
            });
        });
        $('#btnubahkkm').click(function () {
            var set01=document.getElementById('id_kelas').value;
            var set02=document.getElementById('id_matpel').value;
            var set03=document.getElementById('id_muatan').value;
            var set04=document.getElementById('id_ki3').value;
            var set05=document.getElementById('id_ki4').value;
            var set06=document.getElementById('id_idne').value;
            $.post('{{ route("exDatakkm") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, _token: token },
            function(data){	
                $("#modaltambahkkm").modal('hide');
                $("#gridkurikulum").jqxGrid("updatebounddata");		
                $('.status').html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");		
                return false;
            });
        });
        $('#btnupload').click(function () { 	
            $("#modaluploader").modal('show');	
        });
        $('#btntambahkkm').click(function () { 	
            $("#modaltambahkkm").modal('show');	 
            $('#tomboltambah').show();
            $('#tombolupdate').hide(); 
        });
        $('#btnunggah').click(function () {
            var set01=document.getElementById('set_aksi').value;
            var pictu=document.getElementById('sheeta');
            if (set01 == ''){
                swal({
                    title	: 'Mohon lengkapi',
                    text	: 'Field Nama Belum di Isi',
                    type	: 'info',
                });
            } else if ($('#sheeta').val() == ''){
                swal({
                    title	: 'Stop',
                    text	: 'File belum dipilih',
                    type	: 'warning',
                })
            } else {
                var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData();
                    formdata.append('sheeta', pictu.files[0]);
                    formdata.set('set_aksi',set01);
                    formdata.set('_token','{{ csrf_token() }}');
                url='{{ route("exUploaddatakkm") }}';
                $.ajax({
                    type        : 'ajax',
                    url         : url,
                    method      : 'post',
                    data        : formdata,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    dataType    : 'json',
                    success: function(response, status, xhr) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        var status  = response.status;
                        var message = response.message;
                        var warna 	= response.warna;
                        var icon 	= response.icon;
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
                    error: function(jqXHR, textStatus, errorThrown) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title	: textStatus,
                            text	:  jqXHR.responseText,
                            type	: 'info',
                        });
                    }
                });
            }
        });
    });
</script>
@endpush