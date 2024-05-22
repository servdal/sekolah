@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
            <div class="col-sm-7">
                <h1 class="m-0"> Ektrakulikuler {{ $namaekskul }}</h1>
            </div>
            <div class="col-sm-5">
				<div class="btn-group">
                    <a class="btn btn-app btn-primary" id="topbtnpresensi" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Presensi"><i class="fa fa-calculator"></i> Presensi</a>
				    <a class="btn btn-app btn-success" id="topbtnuts" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Penilaian"><i class="fa fa-pencil"></i> PTS</a>
				    <a class="btn btn-app btn-danger" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Kenaikan Kelas" id="topbtnuas"><i class="fa fa-trophy"></i> PAS</a>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-lg-3" id="sectionsetting">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Setting</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" id="btnperbesar"><i class="fa fa-times"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>TAPEL</label>
                                <input type="text" name="tapel" id="tapel" class="form-control" value="{{$tapel}}">
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <input type="text" name="id_kelas" id="id_kelas" class="form-control" value="{{$klsajar}}">
                            </div>
                            <div class="form-group">
                                <label>Semester</label>
                                <select id="id_semester" name="id_semester" class="form-control" >
                                    <option value=""></option>
                                    @if ($smt == '1')
                                        <option value="1" selected>Ganjil</option>
                                        <option value="2">Genap</option>
                                    @else
                                        <option value="1">Ganjil</option>
                                        <option value="2" selected>Genap</option>
                                    @endif
                                </select>
                            </div>
						</div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-success" id="simpansetguru">Set Data Anda</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9" id="sectionkerja">
                    <div class="card card-primary shadow" id="datanilai">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Tapel {{ $tapel }} Semester {{ $smt }}</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" id="btnboxrefresh1"><i class="fa fa-refresh"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="status"></div>
                            <div id="gridlogaktifitas"></div>
						</div>
                        <div class="card-footer">
                            <div id="divabsen">
                                <button class="btn btn-success" id="btntambahpresensi">Add New Data</button>
                                <div id="gridpresensi"></div>
                            </div>
                            <div class="form-group" id="divgriddetailpresensi">
                                <button class="btn btn-success" id="btnclosedetail">Close Detail</button>
                                <div id="griddetailpresensi"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-warning shadow" id="datarinciannnilai">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-tasks"></i> Rincian Nilai Tapel {{ $tapel }} Semester {{ $smt }}</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" id="btnclosedetailnilai"><i class="fa fa-close"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="griddetailnilai"></div>
						</div>
                    </div>
                    <div class="card card-info shadow" id="leboknoabsen">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-pencil"></i> Input Presensi</h3>
                            <div class="card-tools">
                                <button class="btn btn-tool btnboxkembali"><i class="fa fa-close"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <label>Kegiatan/Materi</label>
                                        <input type="text" id="new_kegiatan" name="new_kegiatan" class="form-control">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Tanggal</label>
                                        <input type="text" id="new_tanggal" name="new_tanggal" class="form-control" value="{{ date('Y-m-d') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask /> 
                                    </div>
                                </div>
                            </div>
                            <div>
								<form id="formpresensi" method="post" enctype="multipart/form-data">
									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>No.Induk</th>
												<th>Nama</th>
												<th>Kelas</th>
												<th>Kehadiran</th>
											</tr>
										</thead>
										<tbody>
											@php
												$i = 0;
											@endphp
											@foreach($datasiswa as $rsiswa)
											<tr>
												<td>
													@php
														echo $i + 1;
													@endphp
												</td>
													<td>{!! $rsiswa['noinduk'] !!}</td>
													<td>{!! $rsiswa['nama'] !!}</td>
													<td>{!! $rsiswa['kelas'] !!}</td>
												<td>
													<select id="nilai" name="nilai[{{$i}}][nilainya]" class="form-control" >
														<option value="1">Hadir dan Aktif</option>
														<option value="4">Hadir namun kurang Aktif</option>
														<option value="2">Tidak Hadir (Ijin)</option>
														<option value="3">Tidak Hadir (Sakit)</option>
														<option value="0">Tidak Hadir</option>
													</select>
													<input type="hidden" name="nilai[{{$i}}][kelas]" value="{!! $rsiswa['kelas'] !!}" />
													<input type="hidden" name="nilai[{{$i}}][namanya]" value="{!! $rsiswa['nama'] !!}" />
													<input type="hidden" name="nilai[{{$i}}][noinduk]" value="{!! $rsiswa['noinduk'] !!}" />
												</td>
												@php
													$i++;
												@endphp
											</tr>
											@endforeach
										</tbody>
									</table>
								</form>
                            </div>
						</div>
                        <div class="card-footer">
							<button type="button" class="btn btn-success" id="btnsimpanpresensi"><i class="fa fa-save"></i> Simpan</button>
                            <button type="button" class="btn btn-danger pull-right" id="btnkembalidrabsen">Cancel</button>
                        </div>
                    </div>
                    <div class="card card-danger shadow" id="lebokpenilaian">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-pencil"></i> Input Penilaian </h3>
                            <div class="card-tools">
                                <button class="btn btn-tool btnboxkembali"><i class="fa fa-close"></i></button>
					            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
						<div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Jenis Nilai</label>
                                        <input type="text" id="nilai_jenis" name="nilai_jenis" class="form-control" readonly>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Semester</label>
                                        <input type="text" id="nilai_semester" name="nilai_semester" class="form-control" value="{{ $smt }}" readonly> 
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Tapel</label>
                                        <input type="text" id="nilai_tapel" name="nilai_tapel" class="form-control" value="{{ $tapel }}" readonly> 
                                    </div>
                                </div>
                            </div>
                            <div>
								<form id="forminputnilai" method="post" enctype="multipart/form-data">
									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>No.Induk</th>
												<th>Nama</th>
												<th>Kelas</th>
												<th>Penilaian (Deskripsi)</th>
											</tr>
										</thead>
										<tbody>
											@php
												$i = 0;
											@endphp
											@foreach($datasiswa as $rsiswa)
											<tr>
												<td>
												@php
													echo $i + 1;
												@endphp
												</td>
													<td>{!! $rsiswa['noinduk'] !!}</td>
													<td>{!! $rsiswa['nama'] !!}</td>
													<td>{!! $rsiswa['kelas'] !!}</td>
												<td>
													<input type="text" name="nilai[{{$i}}][nilainya]" />
													<input type="hidden" name="nilai[{{$i}}][namaekskul]" value="{!! $namaekskul !!}" />
													<input type="hidden" name="nilai[{{$i}}][nisn]" value="{!! $rsiswa['nisn'] !!}" />
													<input type="hidden" name="nilai[{{$i}}][alamat]" value="{!! $rsiswa['alamat'] !!}" />
													<input type="hidden" name="nilai[{{$i}}][foto]" value="{!! $rsiswa['foto'] !!}" />
													<input type="hidden" name="nilai[{{$i}}][urutan]" value="{!! $rsiswa['urutan'] !!}" />
													<input type="hidden" name="nilai[{{$i}}][kelas]" value="{!! $rsiswa['kelas'] !!}" />
													<input type="hidden" name="nilai[{{$i}}][namanya]" value="{!! $rsiswa['nama'] !!}" />
													<input type="hidden" name="nilai[{{$i}}][noinduk]" value="{!! $rsiswa['noinduk'] !!}" />
												</td>
												@php
													$i++;
												@endphp
											</tr>
											@endforeach
										</tbody>
									</table>
								</form>
                            </div>
						</div>
                        <div class="card-footer">
							<button type="button" class="btn btn-success" id="btnsimpannilai"><i class="fa fa-save"></i> Simpan</button>
                            <button type="button" class="btn btn-danger pull-right" id="btnkembalidrabsen">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="idekskul" id="idekskul" value="{{ $idekskul }}">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<div class="modal fade" id="modalverifikasipresensi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Verifikasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Nama Siswa</label>
                    <input type="text" id="absen_nama" name="absen_nama" class="form-control" disabled="disable">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Ijin Pada Tanggal</label>
                            <input type="text" id="absen_tanggal" class="form-control"  disabled="disable">
                        </div>
                        <div class="col-lg-6">
                            <label>Ijin Selama (Hari)</label>
                            <input type="text" id="absen_selama" class="form-control"  disabled="disable">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Dikarenakan.?</label>
                    <textarea id="absen_alasan" rows="10" cols="80" disabled="disable"></textarea>
                </div>
                <div class="form-group">
                    <label>Pemohon</label>
                    <input type="text" id="absen_pemohon" class="form-control" disabled="disable">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Tapel</label>
                            <input type="text" id="absen_tapel" class="form-control" >
                        </div>
                        <div class="col-lg-6">
                            <label>Kategori</label>
                            <select id="absen_kategori" class="form-control">
                                <option value="1">Hadir</option>
                                <option value="2">Ijin</option>
                                <option value="3">Sakit</option>
                                <option value="0">Alpha</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="absen_idpresensi" >
                <button type="button" class="btn btn-danger" id="btnsmpnverpresensi">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaleditnilai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit Nilai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-8">
                            <label>Nama</label>
                            <input type="text" id="nil_nama" name="nil_nama" class="form-control" disabled="disable">
                        </div>
                        <div class="col-lg-4">
                            <label>NIS</label>
                            <input type="text" id="nil_nis" name="nil_nis" class="form-control" disabled="disable">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keaktifan</label>
                    <select id="nil_nil" class="form-control">
                        <option value="1">Hadir dan Aktif</option>
                        <option value="4">Hadir namun kurang Aktif</option>
                        <option value="2">Tidak Hadir (Ijin)</option>
                        <option value="3">Tidak Hadir (Sakit)</option>
                        <option value="0">Tidak Hadir Tanpa Keterangan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <input type="text" id="nil_deskripsi" name="nil_deskripsi" class="form-control"  disabled="disable">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="nil_id" >
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="simpaneditnilai">Simpan</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="mas_matkul">
<input type="hidden" id="mas_semester" name="mas_semester" value="{{ $smt }}">
<input type="hidden" id="mas_tapel" name="mas_tapel" value="{{ $tapel }}">
<input type="hidden" id="mas_niyguru" name="mas_niyguru" value="{{ Session('id') }}">
@endsection
@push('script')
<script>
	$(function () {
		CKEDITOR.env.isCompatible = true;
		
		$('#absen_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
	$(document).ready(function () {
		$('#leboknoabsen').hide();
		$('#lebokpenilaian').hide();
		$('#divgriddetailpresensi').hide();
		$('#datarinciannnilai').hide();
		$('#divabsen').hide();
		$('.btnboxkembali').click(function () {
			$('#leboknoabsen').hide();
			$('#datanilai').show();
			$('#lebokpenilaian').hide();
		});
		$('#btnclosedetailnilai').click(function () {
			$('#datarinciannnilai').hide();
			$('#datanilai').show();
		});
		$('#btnclosedetail').click(function () {
			$('#divgriddetailpresensi').hide();
			$('#divabsen').show();
		});
		$('#btntambahpresensi').click(function () {
			$('#datanilai').hide();
			$('#datarinciannnilai').hide();
			$('#lebokpenilaian').hide();
			$('#leboknoabsen').show();
		});
		$('#topbtnuts').click(function () {
			$('#datanilai').hide();
			$('#datarinciannnilai').hide();
			$('#lebokpenilaian').show();
			$('#leboknoabsen').hide();
			$("#nilai_jenis").val('PTS');
		});
		$('#topbtnuas').click(function () {
			$('#datanilai').hide();
			$('#datarinciannnilai').hide();
			$('#lebokpenilaian').show();
			$('#leboknoabsen').hide();
			$("#nilai_jenis").val('PAS');
		});
		$('#btnperbesar').click(function () {
			$('#sectionsetting').hide();
			$('#sectionkerja').removeClass('col-lg-9').addClass('col-lg-12');
			$("#gridlogaktifitas").jqxGrid("updatebounddata");
		});
		$('#btnboxrefresh1').click(function () {
			var uri = window.location.href.split("#")[0];
			window.location=uri
		});
		$('#btnclosedetail').click(function () {
			$('#divgriddetailpresensi').hide();
		});
		var sourcenilai = {
            datatype: "json",
            datafields: [
                { name: 'id',type: 'text'},
                { name: 'nama',type: 'text'},
                { name: 'kelas',type: 'text'},
                { name: 'tapel',type: 'text'},
                { name: 'semester',type: 'text'},
                { name: 'tema',type: 'text'},
                { name: 'subtema',type: 'text'},
                { name: 'kodekd',type: 'text'},
                { name: 'matpel',type: 'text'},
                { name: 'tanggal',type: 'text'},
                { name: 'jennilai',type: 'text'},
                { name: 'marking',type: 'text'},
            ],
            url     : '{{ route("jsonLognilai") }}',
            cache   : false,
        };
		var datanilai = new $.jqx.dataAdapter(sourcenilai);
		$("#gridlogaktifitas").jqxGrid({
            width           : '100%',
            columnsresize   : true,
            theme           : "energyblue",
            autoheight      : true,
            altrows         : true,
            filterable      : true,
            filtermode      : 'excel',
            source          : datanilai,
            columns         : [
                { text: 'JENIS', datafield: 'jennilai', width: '18%', cellsalign: 'left', align: 'center'},
                { text: 'Tanggal', datafield: 'tanggal', width: '10%', align: 'center' },
                { text: 'TAPEL', datafield: 'tapel', width: '10%', cellsalign: 'center', align: 'center'},
                { text: 'SMT', datafield: 'semester', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'KELAS', datafield: 'kelas', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'MATPEL', datafield: 'matpel', width: '25%', cellsalign: 'left', align: 'center'},
                { text: 'KODE', datafield: 'kodekd', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'TEMA', datafield: 'tema', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'SUBTEMA', datafield: 'subtema', width: '7%', cellsalign: 'center', align: 'center'},
				{ text: 'EDIT', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', align: 'center', cellsrenderer: function () {
                    return "EDIT";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridlogaktifitas").offset();
                        var dataRecord 	= $("#gridlogaktifitas").jqxGrid('getrowdata', editrow);
                        if (dataRecord.jennilai == 'Ekstrakurikuler') {
                            var sourcerinciannilai = {
                                datatype: "json",
                                datafields: [
                                    { name: 'id',type: 'text'},
                                    { name: 'nama',type: 'text'},
                                    { name: 'noinduk',type: 'text'},
                                    { name: 'kelas',type: 'text'},
                                    { name: 'nilai',type: 'text'},
                                    { name: 'deskripsi',type: 'text'},
                                ],
                                type: 'POST',
                                data: {	val01:dataRecord.marking, _token: '{{ csrf_token() }}' },
                                url : '{{ route("jsonRinciannilai") }}',
                            };
                            var datarincianharian = new $.jqx.dataAdapter(sourcerinciannilai);
                            $("#griddetailnilai").jqxGrid({
                                width: '100%',
                                source: datarincianharian,
                                autoheight: true,
                                theme: "orange",
                                columnsresize: true,
                                selectionmode: 'multiplecellsextended',
                                columns: [
                                    { text: 'Nama', datafield: 'nama', width: '30%', align: 'center' },
                                    { text: 'No.Induk', datafield: 'noinduk', width: '10%', align: 'center' },
                                    { text: 'Kelas', datafield: 'kelas', width: '10%', align: 'center' },
                                    { text: 'Kehadiran', datafield: 'nilai', width: '10%', cellsalign: 'center', align: 'center' },
                                    { text: 'Materi', datafield: 'deskripsi', width: '30%', cellsalign: 'center', align: 'center' },
                                    { text: 'Edit', columntype: 'button', width: '10%', cellsrenderer: function () {
                                        return "edit";
                                        }, buttonclick: function (row) {
                                            editrow = row;
                                            var offset 		= $("#griddetailnilai").offset();
                                            var dataRecord 	= $("#griddetailnilai").jqxGrid('getrowdata', editrow);
                                            $("#nil_nama").val(dataRecord.nama);
                                            $("#nil_nis").val(dataRecord.noinduk);
                                            $("#nil_nil").val(dataRecord.nilai);
                                            $("#nil_deskripsi").val(dataRecord.deskripsi);
                                            $("#nil_id").val(dataRecord.id);
                                            $("#modaleditnilai").modal('show');
                                        }
                                    },
                                ]
                            });
                            $('#datanilai').hide();
                            $('#datarinciannnilai').show();
                        } else {
                            swal({
                                title	: 'Stop',
                                text	: 'Untuk edit data ini, silahkan ulangi pengisian dari laman Penilaian',
                                type	: 'error',
                            })
                        }
                    }
                },
                { text: 'Del', editable: false, sortable: false, filterable: false, columntype: 'button', align: 'center', width: '5%', cellsrenderer: function () {
                    return "Del";
                    }, buttonclick: function (row) {
                        editrow = row;	
                        var offset 		= $("#gridlogaktifitas").offset();		
                        var dataRecord 	= $("#gridlogaktifitas").jqxGrid('getrowdata', editrow);
                        var jenisdata   = dataRecord.jennilai;
                        if (dataRecord.jennilai == 'Biodata Rapot' || dataRecord.jennilai == 'PTS' || dataRecord.jennilai == 'PAS'){
                            swal({
                                title	: 'Stop',
                                text	: 'Data Ini tidak untuk dihapus',
                                type	: 'error',
                            })
                        } else {
                            swal({
                                title: 'Apakah anda yakin ?',
                                text: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonClass: 'btn btn-confirm mt-2',
                                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                confirmButtonText: 'Yes'
                            }).then(function () {
                                var set01		= dataRecord.id;
                                var set02		= 'datanilai';
                                var set03		= '';
                                $.post('{{ route("exDestroyer") }}', { val01: set01, val02: set02, val03: '', _token: '{{ csrf_token() }}' },
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
                                        $("#gridlogaktifitas").jqxGrid('updatebounddata');
                                        return false;
                                });
                            });
                        }
                    }
                },
            ],
        });
		$('.btnexport').click(function () {
			var gridContent = $("#gridnilai").jqxGrid('exportdata', 'json');
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
		$('#simpansetguru').click(function () {
			var set01=document.getElementById('id_semester').value;
			var set02=document.getElementById('id_kelas').value;
			var set03='';
			var set04=document.getElementById('tapel').value;
			if (set01 == ''){
				swal({
					title: 'Stop',
					text: 'Isi Kolom Semester Terlebih Dahulu',
					type: 'warning',
				})
			} else if (set02 == ''){
				swal({
					title: 'Stop',
					text: 'Isi Kolom Kelas Terlebih Dahulu',
					type: 'warning',
				})
			} else if (set04 == ''){
				swal({
					title: 'Stop',
					text: 'Isi Kolom TAPEL Terlebih Dahulu',
					type: 'warning',
				})
			} else {
				$.post('guru/savesetguru', { val01: set01, val02: set02, val03: set03, val04: set04, _token: '{{ csrf_token() }}' },
				function(data){
					location.reload();
				});
			}
		});
		$('#topbtnpresensi').click(function () {
			var set01	= document.getElementById('idekskul').value;
			var set02	= document.getElementById('nilai_tapel').value;
			var source 	= {
				datatype: "json",
				datafields: [
					{ name: 'id'},
					{ name: 'noinduk', type: 'text'},
					{ name: 'nama', type: 'text'},
					{ name: 'kelas', type: 'text'},
					{ name: 'foto', type: 'text'},
					{ name: 'mskaktif', type: 'text'},
					{ name: 'msknonakt', type: 'text'},
					{ name: 'ijin', type: 'text'},
					{ name: 'alpha', type: 'text'},
					{ name: 'sakit', type: 'text'},
				],
				type: 'POST',
				data: {val01:set01, val02:set02, _token: '{{ csrf_token() }}'},
				url	:  '{{ route("jsonDataabsenekskul") }}',
			};
			var dataAdapter = new $.jqx.dataAdapter(source);
			$('#gridlogaktifitas').hide();
			$('#divgriddetailpresensi').hide();
			$('#divabsen').show();
			$("#gridpresensi").jqxGrid({
				width: '100%',
				pageable: true,
				rowsheight: 35,
				filterable: true,
				filtermode: 'excel',
				source: dataAdapter,
				theme: "energyblue",
				selectionmode: 'singlecell',
				columns: [
					{ text: 'Photo', datafield: 'foto', editable: false, width: '10%', cellsalign: 'center', align: 'center' },
					{ text: 'No.Induk', datafield: 'noinduk', editable: false, width: '10%', cellsalign: 'center', align: 'center' },
					{ text: 'Nama', datafield: 'nama', editable: false, width: '30%', cellsalign: 'left', align: 'center' },
					{ text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center'},
					{ text: 'Aktif', datafield: 'mskaktif', width: '8%', cellsalign: 'center', align: 'center'},
					{ text: 'Pasif', datafield: 'msknonakt', width: '8%', cellsalign: 'center', align: 'center'},
					{ text: 'S', datafield: 'sakit', width: '5%', cellsalign: 'center', align: 'center'},
					{ text: 'I', datafield: 'ijin', width: '5%', cellsalign: 'center', align: 'center'},
					{ text: 'A', datafield: 'alpha', width: '5%', cellsalign: 'center', align: 'center'},
					{ text: 'EDIT', columntype: 'button', width: '9%', align: 'center', cellsrenderer: function () {
						return "EDIT";
						}, buttonclick: function (row) {
							editrow = row;
							var offset 		= $("#gridpresensi").offset();
							var dataRecord 	= $("#gridpresensi").jqxGrid('getrowdata', editrow);
							var set01		= dataRecord.noinduk;
							var set02		= document.getElementById('mas_tapel').value;
							var set03		= document.getElementById('idekskul').value;
							var sourcerinciannilai = {
								datatype: "json",
								datafields: [
									{ name: 'id',type: 'text'},
                                    { name: 'nama',type: 'text'},
                                    { name: 'noinduk',type: 'text'},
                                    { name: 'kelas',type: 'text'},
                                    { name: 'nilai',type: 'text'},
                                    { name: 'tanggal',type: 'text'},
                                    { name: 'deskripsi',type: 'text'},
                                    { name: 'alasan',type: 'text'},
								],
								type: 'POST',
								data: {	val01:set01, val02:set02, val03:set03, _token: '{{ csrf_token() }}' },
								url	: '{{ route("jsonPresensiekskulcari") }}',
							};
							$('#divgriddetailpresensi').show();
							$('#divabsen').hide();
							var datarincianharian = new $.jqx.dataAdapter(sourcerinciannilai);
							var editrow = -1;
							$("#griddetailpresensi").jqxGrid({
								width: '100%',
								source: datarincianharian,
								autoheight: true,
								filterable: true,
								theme: "orange",
								columnsresize: true,
								selectionmode: 'multiplecellsextended',
								columns: [
									{ text: 'Nama', datafield: 'nama', width: '25%', cellsalign: 'left', align: 'center' },
                                    { text: 'No.Induk', datafield: 'noinduk', width: '5%', cellsalign: 'center', align: 'center' },
                                    { text: 'Kelas', datafield: 'kelas', width: '5%', cellsalign: 'center', align: 'center' },
                                    { text: 'Tanggal', datafield: 'tanggal', width: '15%', cellsalign: 'center', align: 'center' },
                                    { text: 'Kehadiran', datafield: 'alasan', width: '20%', cellsalign: 'left', align: 'center' },
                                    { text: 'Materi', datafield: 'deskripsi', width: '25%', cellsalign: 'left', align: 'center' },
                                    { text: 'Edit', columntype: 'button', width: '5%', cellsrenderer: function () {
                                        return "edit";
                                        }, buttonclick: function (row) {
                                            editrow = row;
                                            var offset 		= $("#griddetailpresensi").offset();
                                            var dataRecord 	= $("#griddetailpresensi").jqxGrid('getrowdata', editrow);
                                            $("#nil_nama").val(dataRecord.nama);
                                            $("#nil_nis").val(dataRecord.noinduk);
                                            $("#nil_nil").val(dataRecord.nilai);
                                            $("#nil_deskripsi").val(dataRecord.deskripsi);
                                            $("#nil_id").val(dataRecord.id);
                                            $("#modaleditnilai").modal('show');
                                        }
                                    },
								]
							});
						}
					},
				]
			});
		});
		$('#btnsimpannilai').click(function () {
            var set01=document.getElementById('nilai_jenis').value;
            var set02=document.getElementById('nilai_semester').value;
            var set03=document.getElementById('nilai_tapel').value;
            var set05=document.getElementById('idekskul').value;
			if (set01 == '' || set02 == '' || set03 == ''){
                swal({
                    title	: 'Mohon di Lengkapi',
                    text	: 'Tapel dan Semester Mohon di Simpan Terlebih Dahulu',
                    type	: 'warning',
                })
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData($('#forminputnilai')[0]);
                    formdata.set('_token', '{{ csrf_token() }}');
                    formdata.set('nilai_jenis', set01);
                    formdata.set('nilai_semester', set02);
                    formdata.set('nilai_tapel', set03);
                    formdata.set('nilai_idne', set05);
                $.ajax({
                    url         : '{{ route("exInputnilaiekskul") }}',
                    data        : formdata,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success: function (data) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        $('#leboknoabsen').hide();
						$('#lebokpenilaian').hide();
						$('#datarinciannnilai').hide();
						$('#datanilai').show();
						var status  = data.status;
                        var message = data.message;
                        var warna 	= data.warna;
                        var icon 	= data.icon;
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        swal({
                            title	: status,
                            text	: message,
                            type	: icon,
                        })
                        $("#gridlogaktifitas").jqxGrid('updatebounddata');
                        return false;
                    },
                    error: function (xhr, status, error) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title	: 'Stop',
                            text	: xhr.responseText,
                            type	: 'warning',
                        })
                    }
                });
            }
        });
		$('#btnsimpanpresensi').click(function () {
            var set01=document.getElementById('new_kegiatan').value;
            var set02=document.getElementById('new_tanggal').value;
            var set03=document.getElementById('nilai_semester').value;
            var set04=document.getElementById('nilai_tapel').value;
            var set05=document.getElementById('idekskul').value;
			if (set01 == '' || set02 == '' || set03 == '' || set04 == ''){
                swal({
                    title	: 'Mohon di Lengkapi',
                    text	: 'Tanggal dan Kegiatan Mohon di Simpan Terlebih Dahulu',
                    type	: 'warning',
                })
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData($('#formpresensi')[0]);
                    formdata.set('_token', '{{ csrf_token() }}');
                    formdata.set('absen_kegiatan', set01);
                    formdata.set('presensi_tanggal', set02);
                    formdata.set('absen_semester', set03);
                    formdata.set('presensi_tapel', set04);
                    formdata.set('absen_idne', set05);
                    formdata.set('absen_jenis', '');
                $.ajax({
                    url         : '{{ route("exInputabsenekskul") }}',
                    data        : formdata,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success: function (data) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        $('#leboknoabsen').hide();
						$('#lebokpenilaian').hide();
						$('#datarinciannnilai').hide();
						$('#datanilai').show();
						var status  = data.status;
                        var message = data.message;
                        var warna 	= data.warna;
                        var icon 	= data.icon;
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        swal({
                            title	: status,
                            text	: message,
                            type	: icon,
                        })
                        $("#gridlogaktifitas").jqxGrid('updatebounddata');
                        return false;
                    },
                    error: function (xhr, status, error) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title	: 'Stop',
                            text	: xhr.responseText,
                            type	: 'warning',
                        })
                    }
                });
            }
        });
        $('#simpaneditnilai').click(function () {
            var set01=document.getElementById('nil_id').value;
            var set02=document.getElementById('nil_nil').value;
            if (set01 == ''){
                swal({
                    title: 'Stop',
                    text: 'Pilih Siswa Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Nilai Terlebih Dahulu',
                    type: 'warning',
                })
            } else {
                $("#modaleditnilai").modal('hide');
                $.post('{{ route("exSaveditnilai") }}', { val01: set01, val02: set02, _token: '{{ csrf_token() }}' },
                function(data){
                    $("#gridnilai").jqxGrid("updatebounddata");
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
	});
</script>
@endpush