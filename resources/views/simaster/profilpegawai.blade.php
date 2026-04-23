@extends('adminlte3.layout')
@section('content')
<div class="wrapper" >
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Back Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if ($user->foto == '' OR $user->foto == null)
                                <img class="profile-user-img img-fluid img-circle" src="{{url('/')}}/logo.png" alt="User profile picture">
                                @else 
                                <img class="profile-user-img img-fluid img-circle" src="{{url('/')}}/dist/img/foto/{{ $user->foto }}" alt="User profile picture">
                                @endif
                            </div>
                            <h3 class="profile-username text-center">{{$user->nama}}</h3>
                            <p class="text-muted text-center">{{$user->jabatan}}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item"><b>Keaktifan Kelas</b> <a class="float-right">{{$keaktifanpresensi}}</a></li>
                                <li class="list-group-item"><b>Presensi Finger</b> <a class="float-right">{{$presensifinger}}</a></li>
                                <li class="list-group-item"><b>Presensi Alquran</b> <a class="float-right">{{$keaktifantahfids}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Utama</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fa fa-calendar mr-1"></i> Tahun Masuk</strong><p class="text-muted">{{$user->tmt}}</p>
                            <hr>
                            <strong><i class="fa fa-book mr-1"></i> Pendidikan</strong><p class="text-muted">{{$user->ijasah}}</p>
                            <hr>
                            <strong><i class="fa fa-map mr-1"></i> Alamat</strong><p class="text-muted">{{$user->alamat}}</p>
                            <hr>
                            <strong><i class="fa fa-pencil mr-1"></i> Kontak</strong><p class="text-muted"><span class="tag tag-danger">{{$user->notelp}}</span></p>
                            <hr>
                            <strong><i class="fa fa-file mr-1"></i> NUPTK / NIP / NIY</strong><p class="text-muted">{{$user->nuptk}} / {{$user->niy}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab" id="btnviewkeaktifankelas">Detail Keaktifan Kelas</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab" id="btnviewpresensifinger">Detail Keaktifan Presensi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab" id="btnviewkeaktifanalquran">Detail Keaktifan Alquran</a></li>
                                <li class="nav-item"><a class="nav-link" href="#konseling" data-toggle="tab" id="btnviewkonseling">Sebagai Guru BK</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pribadi" data-toggle="tab"  id="btnviewlogpribadi">Log Pribadi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bimbingan" data-toggle="tab"  id="btnviewlogbimbingan">Pembimbingan Karyawan</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="card card-primary shadow">
                                        <div class="card-body">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-striped table-valign-middle" id="tblkeaktifankelas">
                                                    <thead>
                                                        <tr>
                                                            <th>Jenis Kegiatan</th>
                                                            <th>Tanggal</th>
                                                            <th>Tapel</th>
                                                            <th>Semester</th>
                                                            <th>Kelas</th>
                                                            <th>Mata Pelajaran</th>
                                                            <th>Kode</th>
                                                            <th>Tema</th>
                                                            <th>Sub Tema</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="timeline">
									<div class="card">
										<div class="card-header p-2">
											<ul class="nav nav-pills">
												<li class="nav-item"><a class="nav-link navlinkother active" href="#finger" data-toggle="tab">Mesin Finger</a></li>
												<li class="nav-item"><a class="nav-link navlinkother" href="#kelas" data-toggle="tab">Presensi Kelas</a></li>
											</ul>
										</div>
										<div class="card-body">
											<div class="tab-content">
												<div class="active tab-pane" id="finger">
													<div class="card card-success shadow">
														<div class="card-body">
															<div class="card-body table-responsive p-0">
																<table class="table table-striped table-valign-middle" id="tblpresensifinger">
																	<thead>
																		<tr>
																			<th>Tanggal</th>
																			<th>Scan 1</th>
																			<th>Scan 2</th>
																			<th>Scan 3</th>
																			<th>Nama</th>
																			<th>Jabatan</th>
																			<th>Tapel</th>
																			<th>Semester</th>
																		</tr>
																	</thead>
																	<tbody>
																		
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane" id="kelas">
													<div class="card card-success shadow">
														<div class="card-body">
															<div class="card-body table-responsive p-0">
																<table class="table table-striped table-valign-middle" id="tblpresensikelas">
																	<thead>
																		<tr>
																			<th>Tanggal</th>
																			<th>Mulai</th>
																			<th>Akhir</th>
																			<th>Ruang</th>
																			<th>Kelas</th>
																			<th>Mata Pelajaran</th>
																			<th>Materi</th>
																			<th>Tapel/Semester</th>
																		</tr>
																	</thead>
																	<tbody>
																		
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
                                    
                                </div>
                                <div class="tab-pane" id="settings">
                                    <div class="card card-info shadow">
                                        <div class="card-body">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-striped table-valign-middle" id="tblkeaktifanalquran">
                                                    <thead>
                                                        <tr>
                                                            <th>Tanggal</th>
                                                            <th>Tapel</th>
                                                            <th>Semester</th>
                                                            <th>Kelas</th>
                                                            <th>Peserta</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="tab-pane" id="konseling">
                                    <div class="card card-info shadow">
                                        <div class="card-body">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-striped table-valign-middle" id="tblkonselingmurid">
                                                    <thead>
                                                        <tr>
                                                            <th>List</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pribadi">
                                    <div class="card card-warning shadow">
                                        <div class="card-body">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-striped table-valign-middle" id="tbllogpribadi">
                                                    <thead>
                                                        <tr>
                                                            <th>Jenis Kegiatan</th>
                                                            <th>Deskripsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="tab-pane" id="bimbingan">
                                    <div class="card card-warning shadow">
                                        <div class="card-body">
											<div class="btn-group">
												<a class="btn btn-app btn-primary" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data" id="topbtntambahbimbingan"><i class="fa fa-pencil"></i> Input</a>
												<a class="btn btn-app btn-danger" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Data" id="topbtnexport"><i class="fa fa-print"></i> Export</a>
											</div>
                                        </div>
										<div class="card-footer">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-striped table-valign-middle" id="tbllogbimbingan">
                                                    <thead>
                                                        <tr>
                                                            <th>Tanggal</th>
                                                            <th>Jenis Pelanggaran</th>
                                                            <th>Deskripsi</th>
                                                            <th>Tindak Lanjut</th>
															<th>Status</th>
                                                        	<th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<div class="modal fade" id="modaltambahdata">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Tambah Data Konseling</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
	function removeBimbinganGuru(id){
        swal({
            title			    : "Konfirmasi",
            text			    : "Data yang akan dihapus tidak bisa di kembalikan lagi (undo). Apakah anda yakin.?",
            type			    : 'warning',
            showCancelButton    : true,
            confirmButtonClass  : 'btn btn-confirm mt-2',
            cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
            confirmButtonText   : 'Yes, Delete'
        }).then(function () {
            $.ajax({
                type		: 'ajax',
                url			: '{{ route("exDestroyer") }}',
                method		: 'post',
                data		: {val01:id, val02:'hapusbimbinganguru',  _token: '{{ csrf_token() }}'},
                dataType	: 'json',
                success: function(response, status, xhr) {
                    swal({
                        title	: response.status,
                        text	: response.message,
                        type	: response.icon,
                    });
                    $("#tbllogbimbingan").DataTable().ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal({
                        title	: textStatus,
                        text	: jqXHR.responseText,
                        type	: 'info',
                    });
                }
            });
        });
    }
	function editBimbinganGuru(id){
        $.post('{{ route("exSimpankonseling") }}', { val01: '', val02: '', val03: '', val04: '', val05: '', val06: '', val07: '', val08: '', val09: '', val10: 'getdatabimguru', val11: id, _token: '{{ csrf_token() }}' },
		function(data){
			$("#konseling_idne").val(data.id);
			$("#konseling_hasil").val(data.hasil);
			CKEDITOR.instances['konseling_tindaklanjut'].setData(data.tindaklanjut)
			CKEDITOR.instances['konseling_layanan'].setData(data.layanan)
			$("#konseling_tanggaltangani").val(data.tglpenanganan);
			$("#konseling_tanggal").val(data.tglmasalah);
			$("#konseling_kategori").val(data.kategori);
			$("#konseling_jenis").val(data.jenis);
			$("#konseling_deskripsi").val(data.deskripsi);
			$("#modaltambahdata").modal('show');
			return false;
		});
    }
    $(document).ready(function () {
        $('#tblkeaktifankelas').DataTable({
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonCariDatainduk") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						val01           : 'keaktifankelas',
                        val02           : '{{$user->niy}}',
                        search          : data.search.value,
						_token			: '{{ csrf_token() }}'
					},
					type: "POST",
					success: function(res) {
						callback({
							recordsTotal    : res.total,
							recordsFiltered : res.total,
							data            : res.data
						});
					},
				})
			},
			searching	: true,
            autoWidth	: false,
            serverSide  : true,
			columnDefs	: [
                {
					targets				: 0,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['jennilai'];
					}
				},
                {
					targets				: 1,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['tanggal'];
					}
				},
                {
					targets				: 2,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['tapel'];
					}
				},
                {
					targets				: 3,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['semester'];
					}
				},
                {
					targets				: 4,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['kelas'];
					}
				},
                {
					targets				: 5,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['matpel'];
					}
				},
                {
					targets				: 6,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['kodekd'];
					}
				},
                {
					targets				: 7,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['tema'];
					}
				},
                {
					targets				: 8,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['subtema'];
					}
				}
			],
            order       : [[ 0, "desc" ], [ 1, "desc" ]],
      		dom			: 	'<"row d-flex justify-content-between align-items-center m-1"' +
        						'<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start "B>>' +
       							'<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>t' +
        					'<"d-flex justify-content-between mx-2 row"' +
        						'<"col-sm-12 col-md-6"i>' +
        						'<"col-sm-12 col-md-6"p>' +
        					'>',
            language: {
                'lengthMenu': 'Display _MENU_',
            },
      		responsive: {
				details: {
					display	: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							return 'Details of ' + data['matpel'];
						}
					}),
					type	: 'column',
					renderer: function (api, rowIdx, columns) {
						var data = $.map(columns, function (col, i) {
						return col.columnIndex !== 2
							? '<tr data-dt-row="' + col.rowIdx +'" data-dt-column="' + col.columnIndex +'">' +
								'<td>' +col.title + ':' + '</td> ' +
								'<td>' +col.data +'</td>' +
								'</tr>'
							: '';
						}).join('');
						return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
					}
				}
			},
			initComplete: function () {
			},
			drawCallback: function () {
			}
		});
        $('#tblpresensifinger').DataTable({
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonCariDatainduk") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						val01           : 'finger',
                        val02           : '{{$user->niy}}',
                        search          : data.search.value,
						_token			: '{{ csrf_token() }}'
					},
					type: "POST",
					success: function(res) {
						callback({
							recordsTotal    : res.total,
							recordsFiltered : res.total,
							data            : res.data
						});
					},
				})
			},
			searching	: true,
            autoWidth	: false,
            serverSide  : true,
			columnDefs	: [
                {
					targets				: 0,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['tanggal'];
					}
				},
                {
					targets				: 1,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['jam1'];
					}
				},
                {
					targets				: 2,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['jam2'];
					}
				},
                {
					targets				: 3,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['jam3'];
					}
				},
                {
					targets				: 4,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['nama'];
					}
				},
                {
					targets				: 5,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['jabatan'];
					}
				},
                {
					targets				: 6,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['departemen'];
					}
				},
                {
					targets				: 7,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['kantor'];
					}
				},
			],
            order       : [[ 0, "desc" ]],
      		dom			: 	'<"row d-flex justify-content-between align-items-center m-1"' +
        						'<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start "B>>' +
       							'<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>t' +
        					'<"d-flex justify-content-between mx-2 row"' +
        						'<"col-sm-12 col-md-6"i>' +
        						'<"col-sm-12 col-md-6"p>' +
        					'>',
            language: {
                'lengthMenu': 'Display _MENU_',
            },
      		responsive: {
				details: {
					display	: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							return 'Details of ' + data['matpel'];
						}
					}),
					type	: 'column',
					renderer: function (api, rowIdx, columns) {
						var data = $.map(columns, function (col, i) {
						return col.columnIndex !== 2
							? '<tr data-dt-row="' + col.rowIdx +'" data-dt-column="' + col.columnIndex +'">' +
								'<td>' +col.title + ':' + '</td> ' +
								'<td>' +col.data +'</td>' +
								'</tr>'
							: '';
						}).join('');
						return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
					}
				}
			},
			initComplete: function () {
			},
			drawCallback: function () {
			}
		});
		$('#tblpresensikelas').DataTable({
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonCariDatainduk") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						val01           : 'preseniskelas',
                        val02           : '{{$user->niy}}',
                        search          : data.search.value,
						_token			: '{{ csrf_token() }}'
					},
					type: "POST",
					success: function(res) {
						callback({
							recordsTotal    : res.total,
							recordsFiltered : res.total,
							data            : res.data
						});
					},
				})
			},
			searching	: true,
            autoWidth	: false,
            serverSide  : true,
			columnDefs	: [
                {
					targets				: 0,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['tanggal'];
					}
				},
                {
					targets				: 1,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['jammulai'];
					}
				},
                {
					targets				: 2,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['jamakhir'];
					}
				},
                {
					targets				: 3,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['ruang'];
					}
				},
                {
					targets				: 4,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['kelas'];
					}
				},
                {
					targets				: 5,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['matapelajaran'];
					}
				},
                {
					targets				: 6,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['materi'];
					}
				},
                {
					targets				: 7,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['tapel']+' / '+full['semester'];
					}
				},
			],
            order       : [[ 0, "desc" ]],
      		dom			: 	'<"row d-flex justify-content-between align-items-center m-1"' +
        						'<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start "B>>' +
       							'<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>t' +
        					'<"d-flex justify-content-between mx-2 row"' +
        						'<"col-sm-12 col-md-6"i>' +
        						'<"col-sm-12 col-md-6"p>' +
        					'>',
            language: {
                'lengthMenu': 'Display _MENU_',
            },
      		responsive: {
				details: {
					display	: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							return 'Details of ' + data['tanggal'];
						}
					}),
					type	: 'column',
					renderer: function (api, rowIdx, columns) {
						var data = $.map(columns, function (col, i) {
						return col.columnIndex !== 2
							? '<tr data-dt-row="' + col.rowIdx +'" data-dt-column="' + col.columnIndex +'">' +
								'<td>' +col.title + ':' + '</td> ' +
								'<td>' +col.data +'</td>' +
								'</tr>'
							: '';
						}).join('');
						return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
					}
				}
			},
			initComplete: function () {
			},
			drawCallback: function () {
			}
		});
        $('#tblkeaktifanalquran').DataTable({
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonCariDatainduk") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						val01           : 'alquran',
                        val02           : '{{$user->niy}}',
                        search          : data.search.value,
						_token			: '{{ csrf_token() }}'
					},
					type: "POST",
					success: function(res) {
						callback({
							recordsTotal    : res.total,
							recordsFiltered : res.total,
							data            : res.data
						});
					},
				})
			},
			searching	: true,
            autoWidth	: false,
            serverSide  : true,
			columnDefs	: [
                {
					targets				: 0,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['tanggal'];
					}
				},
                {
					targets				: 1,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['tapel'];
					}
				},
                {
					targets				: 2,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['semester'];
					}
				},
                {
					targets				: 3,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['kelas'];
					}
				},
                {
					targets				: 4,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['count_tanggal'];
					}
				}
			],
            order       : [[ 0, "desc" ]],
      		dom			: 	'<"row d-flex justify-content-between align-items-center m-1"' +
        						'<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start "B>>' +
       							'<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>t' +
        					'<"d-flex justify-content-between mx-2 row"' +
        						'<"col-sm-12 col-md-6"i>' +
        						'<"col-sm-12 col-md-6"p>' +
        					'>',
            language: {
                'lengthMenu': 'Display _MENU_',
            },
      		responsive: {
				details: {
					display	: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							return 'Details of ' + data['matpel'];
						}
					}),
					type	: 'column',
					renderer: function (api, rowIdx, columns) {
						var data = $.map(columns, function (col, i) {
						return col.columnIndex !== 2
							? '<tr data-dt-row="' + col.rowIdx +'" data-dt-column="' + col.columnIndex +'">' +
								'<td>' +col.title + ':' + '</td> ' +
								'<td>' +col.data +'</td>' +
								'</tr>'
							: '';
						}).join('');
						return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
					}
				}
			},
			initComplete: function () {
			},
			drawCallback: function () {
			}
		});
        $('#tbllogpribadi').DataTable({
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonCariDatainduk") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						val01           : 'logpribadi',
                        val02           : '{{$user->niy}}',
                        search          : data.search.value,
						_token			: '{{ csrf_token() }}'
					},
					type: "POST",
					success: function(res) {
						callback({
							recordsTotal    : res.total,
							recordsFiltered : res.total,
							data            : res.data
						});
					},
				})
			},
			searching	: true,
            autoWidth	: false,
            serverSide  : true,
			columnDefs	: [
                {
					targets				: 0,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['jenis'];
					}
				},
                {
					targets				: 1,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['kelakuan'];
					}
				}
			],
            order       : [[ 0, "desc" ], [ 1, "desc" ]],
      		dom			: 	'<"row d-flex justify-content-between align-items-center m-1"' +
        						'<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start "B>>' +
       							'<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>t' +
        					'<"d-flex justify-content-between mx-2 row"' +
        						'<"col-sm-12 col-md-6"i>' +
        						'<"col-sm-12 col-md-6"p>' +
        					'>',
            language: {
                'lengthMenu': 'Display _MENU_',
            },
      		responsive: {
				details: {
					display	: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							return 'Details of ' + data['matpel'];
						}
					}),
					type	: 'column',
					renderer: function (api, rowIdx, columns) {
						var data = $.map(columns, function (col, i) {
						return col.columnIndex !== 2
							? '<tr data-dt-row="' + col.rowIdx +'" data-dt-column="' + col.columnIndex +'">' +
								'<td>' +col.title + ':' + '</td> ' +
								'<td>' +col.data +'</td>' +
								'</tr>'
							: '';
						}).join('');
						return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
					}
				}
			},
			initComplete: function () {
			},
			drawCallback: function () {
			}
		});
		$('#tblkonselingmurid').DataTable({
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonCariDatainduk") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						val01           : 'logsebagaigurubk',
                        val02           : '{{$user->niy}}',
                        search          : data.search.value,
						_token			: '{{ csrf_token() }}'
					},
					type: "POST",
					success: function(res) {
						callback({
							recordsTotal    : res.total,
							recordsFiltered : res.total,
							data            : res.data
						});
					},
				})
			},
			searching	: true,
            autoWidth	: false,
            serverSide  : true,
			columnDefs	: [
                {
					targets				: 0,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						stateNum    = Math.floor(Math.random() * 6);
                        states 		= ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
						state 		= states[stateNum];
                        
						var $rowOutput 	= '<div class="item"><div class="product-img">'+
                                            '<div class="time-label"><button class="btn btn-'+state+'">'+full['kategori']+'</button></div></div><div class="product-info">'+
                                            '<a href="javascript:void(0)" class="product-title"">'+full['nama']+
                                            '<span class="badge badge-warning float-right">'+full['jenis']+'</span></a>'+
                                            '<span class="product-description">'+
                                               'Tanggal Kejadian :'+full['tglmasalah']+'<br />'+
                                               'Tanggal Tindakan :'+full['tglpenanganan']+'<br />'+
                                               'Deskripsi Kejadian :'+full['deskripsi']+'<br />'+
                                               'Deskripsi Layanan :'+full['layanan']+'<br />'+
                                               'Deskripsi Tindakan :'+full['tindaklanjut']+'<br />'+
                                               'Status :'+full['hasil']+'<br />'+
                                            '</span>'+
                                        '</div>';
						return $rowOutput;
					}
				},
			],
            order       : [[ 0, "desc" ]],
      		dom			: 	'<"row d-flex justify-content-between align-items-center m-1"' +
        						'<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start "B>>' +
       							'<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>t' +
        					'<"d-flex justify-content-between mx-2 row"' +
        						'<"col-sm-12 col-md-6"i>' +
        						'<"col-sm-12 col-md-6"p>' +
        					'>',
            language: {
                'lengthMenu': 'Display _MENU_',
            },
      		responsive: {
				details: {
					display	: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							return 'Details of ' + data['nama'];
						}
					}),
					type	: 'column',
					renderer: function (api, rowIdx, columns) {
						var data = $.map(columns, function (col, i) {
						return col.columnIndex !== 2
							? '<tr data-dt-row="' + col.rowIdx +'" data-dt-column="' + col.columnIndex +'">' +
								'<td>' +col.title + ':' + '</td> ' +
								'<td>' +col.data +'</td>' +
								'</tr>'
							: '';
						}).join('');
						return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
					}
				}
			},
			initComplete: function () {
			},
			drawCallback: function () {
			}
		});
		$('#tbllogbimbingan').DataTable({
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonCariDatainduk") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						val01           : 'bimbingan',
                        val02           : '{{$user->niy}}',
                        search          : data.search.value,
						_token			: '{{ csrf_token() }}'
					},
					type: "POST",
					success: function(res) {
						callback({
							recordsTotal    : res.total,
							recordsFiltered : res.total,
							data            : res.data
						});
					},
				})
			},
			searching	: true,
            autoWidth	: false,
            serverSide  : true,
			columnDefs	: [
                {
					targets				: 0,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['tglmasalah'];
					}
				},
                {
					targets				: 1,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['kategori']+' ( '+full['jenis']+' )';
					}
				}, 
				{
					targets				: 2,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['deskripsi']+'<br /><b>Pelayanan :</b> '+full['layanan']+'<br />Pembimbing :'+full['pembimbing'];
					}
				},
				{
					targets				: 3,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['tindaklanjut'];
					}
				},
				{
					targets				: 4,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['hasil'];
					}
				},
				{
					targets		: -1,
					title		: 'Actions',
					orderable	: false,
					render		: function (data, type, full, meta) {
						var $id 	= full['id'];
						return (
						    '<div class="btn-group"><a class="btn btn-sm" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus" onClick="removeBimbinganGuru('+$id+')"><i class="fa fa-trash"></i></a><a class="btn btn-sm" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus" onClick="editBimbinganGuru('+$id+')"><i class="fa fa-edit"></i></a></div>'
						);
					}
				}
			],
            order       : [[ 0, "desc" ], [ 1, "desc" ], [ 1, "desc" ], [ 1, "desc" ]],
      		dom			: 	'<"row d-flex justify-content-between align-items-center m-1"' +
        						'<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start "B>>' +
       							'<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>t' +
        					'<"d-flex justify-content-between mx-2 row"' +
        						'<"col-sm-12 col-md-6"i>' +
        						'<"col-sm-12 col-md-6"p>' +
        					'>',
            language: {
                'lengthMenu': 'Display _MENU_',
            },
      		responsive: {
				details: {
					display	: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							return 'Details of ' + data['matpel'];
						}
					}),
					type	: 'column',
					renderer: function (api, rowIdx, columns) {
						var data = $.map(columns, function (col, i) {
						return col.columnIndex !== 2
							? '<tr data-dt-row="' + col.rowIdx +'" data-dt-column="' + col.columnIndex +'">' +
								'<td>' +col.title + ':' + '</td> ' +
								'<td>' +col.data +'</td>' +
								'</tr>'
							: '';
						}).join('');
						return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
					}
				}
			},
			initComplete: function () {
			},
			drawCallback: function () {
			}
		});
		$('#topbtntambahbimbingan').click(function () {
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
            var set10	= 'pegawai';
            var set11	= '{{$user->niy}}';
			$("#modaltambahdata").modal('hide');
			if (set02 == ''){
				swal({
					title	: 'Stop',
					text	: 'Status Tetap Harus di Isi',
					type	: 'warning',
				})
			} else if (set04 == ''){
				swal({
					title	: 'Stop',
					text	: 'Deskripsikan layanan yang sudah Bapak/Ibu berikan kepada yang bersangkutan',
					type	: 'warning',
				})
			} else if (set06 == ''){
				swal({
					title	: 'Stop',
					text	: 'Tanggal Wajib di isi',
					type	: 'warning',
				})
			} else if (set07 == '' || set08 == '' || set09 == ''){
				swal({
					title	: 'Stop',
					text	: 'Lengkapi data wajib',
					type	: 'warning',
				})
			} else {
				$.post('{{ route("exSimpankonseling") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, _token: '{{ csrf_token() }}' },
				function(data){
					$("#tbllogbimbingan").DataTable().ajax.reload()
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
			}
        });
		$('#topbtnexport').click(function () {
			var btn = $(this);
				btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
            $.post('{{ route("jsonCariDatainduk") }}', { val01:'exportbimbingan', val02: '{{$user->niy}}', _token: '{{ csrf_token() }}' },
			function(data){
				btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
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
							var td 		= document.createElement("td");
							var isi 	= data[i][col[j]];
							if (isi == null){
								td.innerHTML = '';
							} else {
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
								} else {
									var res = isi2.replace(/,/g, "");
									td.innerHTML = res;
								}
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
    });
</script>
@endpush