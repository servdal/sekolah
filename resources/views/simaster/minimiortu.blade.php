@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Perpustakaan Mini</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="https://sdtqdu.sch.id/PDSDU_for_walsan.mp4">Video</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row" >
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle" id="tabelperpustakaan">
                                <thead>
                                    <tr>
                                        <th>List Buku</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</section>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#tabelperpustakaan').DataTable({
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonBuku") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
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
                        var jenis   = full['kategori'];
                        if (jenis == 'E-Book'){
                            var tombol = '<a href="'+full['link']+'" class="btn btn-'+state+'">DOWNLOAD</a>';
                        } else {
                            var tombol = '<a href="#" class="btn btn-'+state+'">Peminjaman</a>';
                        }
                        var rawData = '<div class="list-group-item">'+
                                        '<div class="row">'+
                                            '<div class="col-auto bg-'+state+'">'+
                                                '<img class="img-fluid" src="'+full['gambar']+'" alt="Photo" style="max-height: 160px;">'+
                                            '</div>'+
                                            '<div class="col px-4">'+
                                                '<div>'+
                                                    '<div class="float-right">'+full['created_at']+'</div>'+
                                                    '<h3>'+full['judul']+'</h3>'+
                                                    '<div class="row"><div class="col-lg-8"><p class="mb-0">Pengarang : '+full['pengarang']+'</p>'+
                                                    '<p class="mb-0">Penerbit : '+full['penerbit']+'</p>'+
                                                    '<p class="mb-0">ISBN : '+full['isbn']+'</p>'+
                                                    '<p class="mb-0">Kode Buku : '+full['kodebuku']+'</p>'+
                                                    '<p class="mb-0">Rak Buku : '+full['rakbuku']+'</p></div><div class="col-lg-4">'+tombol+'</div></div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
						return rawData;
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
    });
</script>
@endpush