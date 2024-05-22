@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
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
                                <li class="nav-item"><a class="nav-link" href="#pribadi" data-toggle="tab"  id="btnviewlogpribadi">Log Pribadi</a></li>
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
                                    <div class="card card-success shadow">
                                        <div class="card-body">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-striped table-valign-middle" id="tblpresensifinger">
                                                    <thead>
                                                        <tr>
                                                            <th>Tanggal Scan</th>
                                                            <th>Tanggal</th>
                                                            <th>Nama</th>
                                                            <th>Jabatan</th>
                                                            <th>Tapel</th>
                                                            <th>Semester</th>
                                                            <th>PIN</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                </table>
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
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
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
						return full['tanggalscan'];
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
						return full['nama'];
					}
				},
                {
					targets				: 3,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['jabatan'];
					}
				},
                {
					targets				: 4,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['departemen'];
					}
				},
                {
					targets				: 5,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['kantor'];
					}
				},
                {
					targets				: 6,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
						return full['pin'];
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
    });
</script>
@endpush