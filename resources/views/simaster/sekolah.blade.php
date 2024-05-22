@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Master Data Sekolah</h1>
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
                <div class="col-md-12">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Data Sekolah</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                        <div id="gridsekolah"></div>
						</div>
                    </div>
                    <div id="status"></div>
                    @if(Session::has('message'))
                        <div class="alert {{ Session::get('alert-class') }} alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> {{ Session::get('status') }}</h4>
                            {!! Session::get('message') !!}
                        </div>
                    @endif
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Input Data Sekolah</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <form action="" id="forminput" name="forminput" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Yayasan</label>
                                <input type="text" id="nama_yayasan" name="nama_yayasan" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIS</label>
                                        <input type="text" id="nis" name="nis" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NSS</label>
                                        <input type="text" id="nss" name="nss" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NPSN</label>
                                        <input type="text" id="npsn" name="npsn" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kode Sekolah</label>
                                        <input type="text" id="kode_sekolah" name="kode_sekolah" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Nama Sekolah</label>
                                        <input type="text" id="nama_sekolah" name="nama_sekolah" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" id="alamat" name="alamat" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kota</label>
                                        <input type="text" id="kota" name="kota" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Telp</label>
                                        <input type="text" id="telp" name="telp" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" id="email" name="email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kepala Sekolah</label>
                                        <select id="id_kepala_sekolah" name="id_kepala_sekolah" class="form-control" >
                                            @foreach($jpeg as $rpeg)
                                            <option value="{{ $rpeg['id'] }}">{{ $rpeg['nama'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Slogan</label>
                                        <input type="text" id="slogan" name="slogan" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Level</label>
                                        <select id="level" name="level" class="form-control" >
                                            <option value="1">TK/KB</option>
                                            <option value="2">SD/MI</option>
                                            <option value="3">SLTP/Mts</option>
                                            <option value="4">SLTA/MA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select id="status" name="status" class="form-control" >
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pendaftaran</label>
                                        <input type="text" id="pendaftaran" name="pendaftaran" placeholder="ex:2020-2021" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Pengumuman</label>
                                        <textarea name="pengumuman" id="pengumuman" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No Rekening</label>
                                        <input type="text" id="no_rek" name="no_rek" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Rekening Atas Nama</label>
                                        <input type="text" id="nama_rek" name="nama_rek" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama BANK</label>
                                        <input type="text" id="nama_bank_rek" name="nama_bank_rek" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Logo</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" id="logo" name="logo" onchange="readURL(this);" >
                                    </div> 
                                    <div class="col-md-6">
                                        <img id="logo_prev" class="img-responsive" />
                                    </div>				 
                                </div>			  
                            </div>
                            <div class="form-group">
                                <label>Logo Grey</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" id="logo_grey" name="logo_grey" onchange="readURLbc(this);"" >
                                    </div> 
                                    <div class="col-md-6">
                                        <img id="logo_grey_prev" class="img-responsive" />
                                    </div>				 
                                </div>			  
                            </div>
                            <div class="form-group">
                                <label>Frontpage Logo</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" id="frontpage" name="frontpage" onchange="readURLfront(this);">
                                    </div> 
                                    <div class="col-md-6">
                                        <img id="frontpage_prev" class="img-responsive" />
                                    </div>				 
                                </div>			  
                            </div>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-success" type="submit" name="simpansekolah" id="simpansekolah" value="Simpan" />
                        </div>
						</form>
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
<div class="modal fade" id="editsekolah">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Sekolah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="formedit" name="formedit" enctype="multipart/form-data">
			{{ csrf_field() }}
            <div class="modal-body">
                <input type="hidden" id="edit_id" name="edit_id" class="form-control">
                <div class="form-group">
                    <label>Nama Yayasan</label>
                    <input type="text" id="edit_nama_yayasan" name="edit_nama_yayasan" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NIS</label>
                            <input type="text" id="edit_nis" name="edit_nis" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NSS</label>
                            <input type="text" id="edit_nss" name="edit_nss" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NPSN</label>
                            <input type="text" id="edit_npsn" name="edit_npsn" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kode Sekolah</label>
                            <input type="text" id="edit_kode_sekolah" name="edit_kode_sekolah" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Nama Sekolah</label>
                            <input type="text" id="edit_nama_sekolah" name="edit_nama_sekolah" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" id="edit_alamat" name="edit_alamat" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" id="edit_kota" name="edit_kota" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Telp</label>
                            <input type="text" id="edit_telp" name="edit_telp" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" id="edit_email" name="edit_email" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kepala Sekolah</label>
                            <select id="edit_id_kepala_sekolah" name="edit_id_kepala_sekolah" class="form-control" >
                                @foreach($jpeg as $rpeg)
                                <option value="{{ $rpeg['id'] }}">{{ $rpeg['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Slogan</label>
                            <input type="text" id="edit_slogan" name="edit_slogan" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Level</label>
                            <select id="edit_level" name="edit_level" class="form-control" >
                                <option value="1">TK/KB</option>
                                <option value="2">SD/MI</option>
                                <option value="3">SLTP/Mts</option>
                                <option value="4">SLTA/MA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select id="edit_status" name="edit_status" class="form-control" >
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pendaftaran</label>
                            <input type="text" id="edit_pendaftaran" name="edit_pendaftaran" placeholder="ex:2020-2021" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Pengumuman</label>
                            <textarea name="edit_pengumuman" id="edit_pengumuman" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>No Rekening</label>
                            <input type="text" id="edit_no_rek" name="edit_no_rek" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Rekening Atas Nama</label>
                            <input type="text" id="edit_nama_rek" name="edit_nama_rek" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama BANK</label>
                            <input type="text" id="edit_nama_bank_rek" name="edit_nama_bank_rek" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Logo</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <input type="file" id="edit_logo" name="edit_logo" onchange="edtreadURL(this);" >
                        </div> 
                        <div class="col-xs-6">
                            <img id="edit_logo_prev" class="img-responsive" />
                        </div>				 
                    </div>			  
                </div>
                <div class="form-group">
                    <label>Logo Grey</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <input type="file" id="edit_logo_grey" name="edit_logo_grey" onchange="edtreadURLbc(this);"" >
                        </div> 
                        <div class="col-xs-6">
                            <img id="edit_logo_grey_prev" class="img-responsive" />
                        </div>				 
                    </div>			  
                </div>
                <div class="form-group">
                    <label>Frontpage Logo</label>
                    <div class="row">
                        <div class="col-xs-6">
                            <input type="file" id="edit_frontpage" name="edit_frontpage" onchange="edtreadURLfront(this);">
                        </div> 
                        <div class="col-xs-6">
                            <img id="edit_frontpage_prev" class="img-responsive" />
                        </div>				 
                    </div>			  
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            	<input class="btn btn-danger" type="submit" name="updatesekolah" id="updatesekolah" value="UPDATE" />			
			</div>
            </form>
        </div>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="getnama" id="getnama" value="{{Session('nama')}}">
@endsection
@push('script')
<script>
	function readURLfront(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#frontpage_prev').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#logo_prev').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function readURLbc(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#logo_grey_prev').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function edtreadURLfront(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#edit_frontpage_prev').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function edtreadURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#edit_logo_prev').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function edtreadURLbc(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#edit_logo_grey_prev').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	$(document).ready(function () {
		var source = {
			datatype: "json",
			datafields: [
                {name: 'id',type: 'text'},
                {name:'nama_yayasan',type:'text'},
                {name:'kode_sekolah',type:'text'},
                {name:'nama_sekolah',type:'text'},
                {name:'alamat',type:'text'},
                {name:'kota',type:'text'},
                {name:'telp',type:'text'},
                {name:'email',type:'text'},
                {name:'id_kepala_sekolah',type:'text'},
                {name:'nama_kepala_sekolah',type:'text'},
                {name:'slogan',type:'text'},
                {name:'logo',type:'text'},
                {name:'logo_grey',type:'text'},
                {name:'frontpage',type:'text'},
                {name:'nis',type:'text'},
                {name:'nss',type:'text'},
                {name:'npsn',type:'text'},
                {name:'status',type:'text'},
                {name:'level',type:'text'},
                {name:'pendaftaran',type:'text'},
                {name:'pengumuman',type:'text'},
                {name:'no_rek',type:'text'},
                {name:'nama_rek',type:'text'},
                {name:'nama_bank_rek',type:'text'},
                {name:'nama_status',type:'text'},
                {name:'nama_level',type:'text'},
                {name:'img_logo',type:'text'},
                {name:'img_logo_grey',type:'text'},
                {name:'img_frontpage',type:'text'},
			],
			url: 'json/datasekolah',
			cache: false,
			pager: function (pagenum, pagesize, oldpagenum) {}
		};
		var dataAdapter = new $.jqx.dataAdapter(source, { async: false, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
		var editrow = -1;
		$("#gridsekolah").jqxGrid({
			width: '100%',
			showfilterrow: true,
			rowsheight: 35,
			filterable: true,                
			columnsresize: true,
			autoshowfiltericon: true,
			pageable: true,
			autoheight: true,
			theme: "energyblue",
			source: dataAdapter,
			selectionmode: 'multiplecellsextended',
			columns: [
                { text: 'Logo', datafield: 'img_logo', width: 50, align: 'center' },
                { text: 'Nama Yayasan', datafield: 'nama_yayasan', width: 180, align: 'center' },
                { text: 'Level', datafield: 'nama_level', width: 70, align: 'center' },
                { text: 'Kode Sekolah', datafield: 'kode_sekolah', width: 180, align: 'center' },
                { text: 'Nama Sekolah', datafield: 'nama_sekolah', width: 180, align: 'center' },
                { text: 'Kepala Sekolah', datafield: 'nama_kepala_sekolah', width: 120, align: 'center' },
                { text: 'NIS', datafield: 'nis', width: 70, align: 'center' },
                { text: 'NSS', datafield: 'nss', width: 70, align: 'center' },
                { text: 'NPSN', datafield: 'npsn', width: 70, align: 'center' },
                { text: 'Alamat', datafield: 'alamat', width: 120, align: 'center' },
                { text: 'Kota', datafield: 'kota', width: 70, align: 'center' },
                { text: 'Telp', datafield: 'telp', width: 70, align: 'center' },
                { text: 'Status', datafield: 'nama_status', width: 70, align: 'center' },
                { text: 'id',datafield:'id', hidden: true},	
                { text:'email',datafield:'email', hidden: true},	
                { text:'id_kepala_sekolah',datafield:'id_kepala_sekolah', hidden: true},	
                { text:'slogan',datafield:'slogan', hidden: true},	
                { text:'logo',datafield:'logo', hidden: true},	
                { text:'logo_grey',datafield:'logo_grey', hidden: true},	
                { text:'frontpage',datafield:'frontpage', hidden: true},	
                { text:'status',datafield:'status', hidden: true},	
                { text:'level',datafield:'level', hidden: true}, 
                { text:'pendaftaran',datafield:'pendaftaran', hidden: true}, 
                { text:'pengumuman',datafield:'pengumuman', hidden: true}, 
                { text:'no_rek',datafield:'no_rek', hidden: true}, 
                { text:'nama_rek',datafield:'nama_rek', hidden: true}, 
                { text:'nama_bank_rek',datafield:'nama_bank_rek', hidden: true}, 
                { text: 'Edit', columntype: 'button', width: 50, cellsrenderer: function () { return "Edit"; }, 
                    buttonclick: function (row) {
                        editrow         = row;
                        var offset 		= $("#gridsekolah").offset();
                        var dataRecord 	= $("#gridsekolah").jqxGrid('getrowdata', editrow);
                        $('#edit_id').val(dataRecord.id);
                        $('#edit_nama_yayasan').val(dataRecord.nama_yayasan);
                        $('#edit_kode_sekolah').val(dataRecord.kode_sekolah);
                        $('#edit_nama_sekolah').val(dataRecord.nama_sekolah);
                        $('#edit_alamat').val(dataRecord.alamat);
                        $('#edit_kota').val(dataRecord.kota);
                        $('#edit_telp').val(dataRecord.telp);
                        $('#edit_email').val(dataRecord.email);
                        $('#edit_id_kepala_sekolah').val(dataRecord.id_kepala_sekolah);
                        $('#edit_slogan').val(dataRecord.slogan);
                        // $('#edit_logo').val(dataRecord.logo);
                        // $('#edit_logo_grey').val(dataRecord.logo_grey);
                        // $('#edit_frontpage').val(dataRecord.frontpage);
                        $('#edit_nis').val(dataRecord.nis);
                        $('#edit_nss').val(dataRecord.nss);
                        $('#edit_npsn').val(dataRecord.npsn);
                        $('#edit_status').val(dataRecord.status);
                        $('#edit_level').val(dataRecord.level);
                        $('#edit_pendaftaran').val(dataRecord.pendaftaran);
                        $('#edit_pengumuman').val(dataRecord.pengumuman);
                        $('#edit_no_rek').val(dataRecord.no_rek);
                        $('#edit_nama_rek').val(dataRecord.nama_rek);
                        $('#edit_nama_bank_rek').val(dataRecord.nama_bank_rek);
                        $('#edit_logo').val("");
                        $('#edit_logo_grey').val("");
                        $('#edit_frontpage').val("");
                        $('#edit_logo_prev').attr('src', '');
                        $('#edit_logo_grey_prev').attr('src', '');
                        $('#edit_frontpage_prev').attr('src', '');
                        $("#editsekolah").modal('show');
                    }
		        },
            ],
        });
        $('#simpansekolah').click(function () {
            var form_data = new FormData($('#forminput')[0]);
            $.ajax({
                url: '{{ url('') }}/admin/savesekolah',
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    var status  = data.status;
                    var message = data.message;
                    var warna 	= data.warna;
                    var icon 	= data.icon;
                    if(icon == 'error') {
                        $.toast({
                            heading: status,
                            text: message,
                            position: 'top-right',
                            loaderBg: warna,
                            icon: icon,
                            hideAfter: 5000,
                            stack: 1
                        });
                    } else {
                        $.toast({
                            heading: status,
                            text: message,
                            position: 'top-right',
                            loaderBg: warna,
                            icon:icon,
                            hideAfter: 3000,
                            stack: 1
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    }
                    return false;
                },
                error: function (xhr, status, error) {
                    var pesan = xhr.responseText;
                    swal({
                        title: 'Stop',
                        text: pesan,
                        type: 'warning',
                    })
                }
            });
        });
        $('#updatesekolah').click(function () {
            var form_data = new FormData($('#formedit')[0]);
            $.ajax({
                url: '{{ url('') }}/admin/updatesekolah',
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    var status  = data.status;
                    var message = data.message;
                    var warna 	= data.warna;
                    var icon 	= data.icon;
                    if(icon == 'error') {
                        $.toast({
                            heading: status,
                            text: message,
                            position: 'top-right',
                            loaderBg: warna,
                            icon: icon,
                            hideAfter: 5000,
                            stack: 1
                        });
                    } else {
                        $.toast({
                            heading: status,
                            text: message,
                            position: 'top-right',
                            loaderBg: warna,
                            icon:icon,
                            hideAfter: 3000,
                            stack: 1
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    }
                    return false;
                },
                error: function (xhr, status, error) {
                    var pesan = xhr.responseText;
                    swal({
                        title: 'Stop',
                        text: pesan,
                        type: 'warning',
                    })
                }
            });
        });
    });
</script>
@endpush