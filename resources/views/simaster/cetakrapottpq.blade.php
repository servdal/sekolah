@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Cetak Raport</h1>
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
            <div class="row" >
                <div class="col-md-4">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Raport Al Quran</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>TAPEL</label>
                                        <input type="text" name="arsip_tapel" id="arsip_tapel" class="form-control" value="{{$tapel}}" placeholder="Format : xxxx-xxxx">
                                    </div> 
                                    <div class="col-lg-4">
                                        <label>Semester</label>
                                        <select id="arsip_semester" name="arsip_semester" class="form-control" >
                                            <option value=""></option>
                                            @if ($semester == '1')
                                                <option value="1" selected>Ganjil</option>
                                                <option value="2">Genap</option>
                                            @else
                                                <option value="1">Ganjil</option>
                                                <option value="2" selected>Genap</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="button" class="btn btn-success btn-app" id="btnviewarsip"><i class="fa fa-newspaper-o"></i>View Arsip</button>
								    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-success shadow">
                        <div class="card-header">
                            <h3 class="card-title">Raport Umum</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>TAPEL</label>
                                        <input type="text" name="arsip_tapelumum" id="arsip_tapelumum" class="form-control" value="{{$tapel}}" placeholder="Format : xxxx-xxxx">
                                    </div> 
                                    <div class="col-lg-4">
                                        <label>Semester</label>
                                        <select id="arsip_semesterumum" name="arsip_semesterumum" class="form-control" >
                                            <option value=""></option>
                                            @if ($semester == '1')
                                                <option value="1" selected>Ganjil</option>
                                                <option value="2">Genap</option>
                                            @else
                                                <option value="1">Ganjil</option>
                                                <option value="2" selected>Genap</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="button" class="btn btn-success btn-app" id="btnviewarsipumum"><i class="fa fa-newspaper-o"></i>View Arsip</button>
								    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 hasilpencarian" id="divriwayatalquran">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Penilaian Per Juz</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            Catatan : Untuk Merubah Data, Bapak / Ibu Cukup Click Kembali Nama Siswa Kemudian Masukkan Nilai Tambahannya (Data Yang Lama Tidak Tampak di Penggisian). Maka otomatis data akan ditambahkan ke data lama yang sudah Bapak/Ibu Masukkan Sebelumnya
                        </div>
                        <div class="card-footer">
                            <div id="gridriwayat"></div>
                        </div>
                    </div>
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Penilaian Per Tengah Semester</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridriwayatuts"></div>
                        </div>
                    </div>
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Penilaian Per Akhir Semester</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridriwayatuas"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 hasilpencarian" id="divriwayatumum">
                    <div class="card card-success shadow">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Raport Yang DiAjukan</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridriwayatrapot"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 hasilpencarian" id="diveditor">
                    <div class="card card-success shadow">
                        <div class="card-header">
                            <h3 class="card-title">Editor Rapot</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="forminputnilaiafektif" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="rapot_nama">Nama</label>
                                            <input type="text" class="form-control" id="rapot_nama" name="rapot_nama" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="rapot_tanggal" class="col-form-label">Tanggal Rapot</label>
                                            <input type="text" class="form-control" id="rapot_tanggal" name="rapot_tanggal"/>
                                            <input type="hidden" class="form-control" id="rapot_id" name="rapot_id">
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="rapot_sakit">Sakit</label>
                                            <input type="text" class="form-control" id="rapot_sakit" name="rapot_sakit">
                                        </div> 
                                        <div class="col-lg-2">
                                            <label for="rapot_ijin">Ijin</label>
                                            <input type="text" class="form-control" id="rapot_ijin" name="rapot_ijin">
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="rapot_alpha">Alpha</label>
                                            <input type="text" class="form-control" id="rapot_alpha" name="rapot_alpha">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <label for="rapot_indikator01">AL-ISLAM</label>
                                        <input type="text" class="form-control" id="rapot_indikator01" name="rapot_indikator01">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="rapot_perkembangan01">Perkembangan</label>
                                        <select id="rapot_perkembangan01" name="rapot_perkembangan01" class="form-control" >
                                            <option value="BB">Belum Berkembang</option>
                                            <option value="MB">Mulai Berkembang</option>
                                            <option value="BSH">Berkembang Sesuai Harapan</option>
                                            <option value="BSB">Berkembang Sangat Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea id="rapot_deskripsi01" name="rapot_deskripsi01" class="ckeditortag"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <label for="rapot_indikator02">KOGNITIF</label>
                                        <input type="text" class="form-control" id="rapot_indikator02" name="rapot_indikator02">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="rapot_perkembangan02">Perkembangan</label>
                                        <select id="rapot_perkembangan02" name="rapot_perkembangan02" class="form-control" >
                                            <option value="BB">Belum Berkembang</option>
                                            <option value="MB">Mulai Berkembang</option>
                                            <option value="BSH">Berkembang Sesuai Harapan</option>
                                            <option value="BSB">Berkembang Sangat Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea id="rapot_deskripsi02" name="rapot_deskripsi02" class="ckeditortag"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <label for="rapot_indikator03">BAHASA</label>
                                        <input type="text" class="form-control" id="rapot_indikator03" name="rapot_indikator03">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="rapot_perkembangan03">Perkembangan</label>
                                        <select id="rapot_perkembangan03" name="rapot_perkembangan03" class="form-control" >
                                            <option value="BB">Belum Berkembang</option>
                                            <option value="MB">Mulai Berkembang</option>
                                            <option value="BSH">Berkembang Sesuai Harapan</option>
                                            <option value="BSB">Berkembang Sangat Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea id="rapot_deskripsi03" name="rapot_deskripsi03" class="ckeditortag"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <label for="rapot_indikator04">FISIK MOTORIK</label>
                                        <input type="text" class="form-control" id="rapot_indikator04" name="rapot_indikator04">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="rapot_perkembangan04">Perkembangan</label>
                                        <select id="rapot_perkembangan04" name="rapot_perkembangan04" class="form-control" >
                                            <option value="BB">Belum Berkembang</option>
                                            <option value="MB">Mulai Berkembang</option>
                                            <option value="BSH">Berkembang Sesuai Harapan</option>
                                            <option value="BSB">Berkembang Sangat Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <textarea id="rapot_deskripsi04" name="rapot_deskripsi04" class="ckeditortag"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" id="btnsimpanrapot"><i class="fa fa-save"></i> Simpan</button>
                            <button type="button" class="btn btn-danger" id="btncetakrapot"><i class="fa fa-print"></i> Cetak Rapot</button>
                            <button type="button" class="btn btn-warning" id="btnkembali"><i class="fa fa-close"></i> Cancel</button>
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
<input type="hidden" id="gettahun" value="{{ date('Y') }}">
<input type="hidden" id="getbulan" value="{{ date('m') }}">
<input type="hidden" id="getjenis" value="belum">
<input type="hidden" id="id_sekolah" value="{{ Session('sekolah_id_sekolah') }}">
<input type="hidden" id="id_nip" value="{{ Session('nip') }}">

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
        $('.datemaskinput').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		CKEDITOR.env.isCompatible = true;
        CKEDITOR.replace( 'rapot_deskripsi01', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
        CKEDITOR.replace( 'rapot_deskripsi02', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
        CKEDITOR.replace( 'rapot_deskripsi03', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
        CKEDITOR.replace( 'rapot_deskripsi04', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90
		});
		$('#presensi_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#set_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$('#absen_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
    $(document).ready(function () {
        $('.hasilpencarian').hide();
        $(".btnboxrefresh").click(function(){
            var uri = window.location.href.split("#")[0];
            window.location=uri
        });
        $("#btncetakrapot").click(function(){
            var set01   = document.getElementById('rapot_id').value;
            var uri     = '{{url("/")}}/rapot/'+set01;
            window.open(uri, '_blank');
        });
        $("#btnkembali").click(function(){
            $('.hasilpencarian').hide();
            $('#divriwayatumum').show();
        });
        $('#btnviewarsip').click(function () {
            $('.hasilpencarian').hide();
            var set01       = document.getElementById('arsip_tapel').value;
            var set02       = document.getElementById('arsip_semester').value;
            var sourcears01 = {
                datatype: "json",
                datafields: [
                    { name: 'nama', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'foto', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'tapel', type: 'text'},
                    { name: 'tapelsemester', type: 'text'},
                    { name: 'sakit', type: 'text'},
                    { name: 'ijin', type: 'text'},
                    { name: 'alpha', type: 'text'},
                    { name: 'semester', type: 'text'},
                    { name: 'link', type: 'text'},
                    { name: 'setoransekolah', type: 'text'},
                    { name: 'setoranrumah', type: 'text'},
                    { name: 'hariefektif', type: 'text'},
                    { name: 'namaguru', type: 'text'},
                    { name: 'created_at', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:'arsipujianalquran', val04:'JUZ', _token: '{{ csrf_token() }}'},
                url: '{{ route("jsonSetoranTahfid") }}',
            };
            var dataAdapterArsip01 = new $.jqx.dataAdapter(sourcears01);
            var linkrapotgeneratorsatu = function (row, column, value) {
                var id    = $('#gridriwayat').jqxGrid('getrowdata', row).link;
                var url     = '<a href="{{url("/")}}/'+id+'" target="_blank"><span class="badge badge-primary">View</span></a>';
                return url;
            }
            $("#gridriwayat").jqxGrid({
                width           : '100%',
                pageable        : true,
                sortable        : true,
                autoheight      : true,
                filterable      : true,
                showfilterrow   : true,
                source          : dataAdapterArsip01,
                theme           : "energyblue",
                selectionmode   : 'singlecell',
                columns         : [
                    { text: 'Kelas', datafield: 'kelas', width: '10%', ellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '30%', align: 'center' },
                    { text: 'No Induk', datafield: 'noinduk', width: '15%', cellsalign: 'center', align: 'center'},
                    { text: 'Semester', datafield: 'semester', width: '15%', cellsalign: 'center', align: 'center'},	
                    { text: 'Kode', datafield: 'tapelsemester', width: '20%', cellsalign: 'left', align: 'center' },
                    { text: 'Link Rapot', cellsrenderer: linkrapotgeneratorsatu, width: '10%', cellsalign: 'center', align: 'center' },
                ], 
            });
            var sourcears02 = {
                datatype: "json",
                datafields: [
                    { name: 'nama', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'foto', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'tapel', type: 'text'},
                    { name: 'tapelsemester', type: 'text'},
                    { name: 'sakit', type: 'text'},
                    { name: 'ijin', type: 'text'},
                    { name: 'alpha', type: 'text'},
                    { name: 'semester', type: 'text'},
                    { name: 'link', type: 'text'},
                    { name: 'setoransekolah', type: 'text'},
                    { name: 'setoranrumah', type: 'text'},
                    { name: 'hariefektif', type: 'text'},
                    { name: 'namaguru', type: 'text'},
                    { name: 'created_at', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:'arsipujianalquran', val04:'UTS', _token: '{{ csrf_token() }}'},
                url: '{{ route("jsonSetoranTahfid") }}',
            };
            var dataAdapterArsip02 = new $.jqx.dataAdapter(sourcears02);
            var linkrapotgeneratordua = function (row, column, value) {
                var id    = $('#gridriwayatuts').jqxGrid('getrowdata', row).link;
                var url     = '<a href="{{url("/")}}/'+id+'" target="_blank"><span class="badge badge-primary">View</span></a>';
                return url;
            }
            $("#gridriwayatuts").jqxGrid({
                width           : '100%',
                pageable        : true,
                sortable        : true,
                autoheight      : true,
                filterable      : true,
                showfilterrow   : true,
                source          : dataAdapterArsip02,
                theme           : "energyblue",
                selectionmode   : 'singlecell',
                columns         : [
                    { text: 'Kelas', datafield: 'kelas', width: '10%', ellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '30%', align: 'center' },
                    { text: 'No Induk', datafield: 'noinduk', width: '12%', cellsalign: 'center', align: 'center'},
                    { text: 'Semester', datafield: 'semester', width: '12%', cellsalign: 'center', align: 'center'},	
                    { text: 'Kode', datafield: 'tapelsemester', width: '20%', cellsalign: 'left', align: 'center' },
                    { text: 'Link Rapot', cellsrenderer: linkrapotgeneratordua, width: '10%', cellsalign: 'center', align: 'center' },
                ], 
            });
            var sourcears03 = {
                datatype: "json",
                datafields: [
                    { name: 'nama', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'foto', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'tapel', type: 'text'},
                    { name: 'tapelsemester', type: 'text'},
                    { name: 'sakit', type: 'text'},
                    { name: 'ijin', type: 'text'},
                    { name: 'alpha', type: 'text'},
                    { name: 'semester', type: 'text'},
                    { name: 'link', type: 'text'},
                    { name: 'setoransekolah', type: 'text'},
                    { name: 'setoranrumah', type: 'text'},
                    { name: 'hariefektif', type: 'text'},
                    { name: 'namaguru', type: 'text'},
                    { name: 'created_at', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:'arsipujianalquran', val04:'UAS', _token: '{{ csrf_token() }}'},
                url: '{{ route("jsonSetoranTahfid") }}',
            };
            var dataAdapterArsip03 = new $.jqx.dataAdapter(sourcears03);
            var linkrapotgeneratortiga = function (row, column, value) {
                var id    = $('#gridriwayatuas').jqxGrid('getrowdata', row).link;
                var url     = '<a href="{{url("/")}}/'+id+'" target="_blank"><span class="badge badge-primary">View</span></a>';
                return url;
            }
            $("#gridriwayatuas").jqxGrid({
                width           : '100%',
                pageable        : true,
                sortable        : true,
                autoheight      : true,
                filterable      : true,
                showfilterrow   : true,
                source          : dataAdapterArsip03,
                theme           : "energyblue",
                selectionmode   : 'singlecell',
                columns         : [
                    { text: 'Kelas', datafield: 'kelas', width: '10%', ellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '30%', align: 'center' },
                    { text: 'No Induk', datafield: 'noinduk', width: '15%', cellsalign: 'center', align: 'center'},
                    { text: 'Semester', datafield: 'semester', width: '15%', cellsalign: 'center', align: 'center'},	
                    { text: 'Kode', datafield: 'tapelsemester', width: '20%', cellsalign: 'left', align: 'center' },
                    { text: 'Link Rapot', cellsrenderer: linkrapotgeneratortiga, width: '10%', cellsalign: 'center', align: 'center' },
                ], 
            });
            $('#divriwayatalquran').show();
        });
        $('#btnviewarsipumum').click(function () {
            $('.hasilpencarian').hide();
            var set01       = document.getElementById('arsip_tapelumum').value;
            var set02       = document.getElementById('arsip_semesterumum').value;
            var sourcedatacarirapot = {
                datatype: "json",
                datafields: [
                    { name: 'id',type: 'text'},	
                    { name: 'nama',type: 'text'},
                    { name: 'noinduk',type: 'text'},
                    { name: 'semester',type: 'text'},
                    { name: 'tapel',type: 'text'},
                    { name: 'kelas',type: 'text'},
                    { name: 'total',type: 'text'},
                    { name: 'rangking',type: 'text'},
                    { name: 'ratarata',type: 'text'},
                    { name: 'ratarata',type: 'text'},
                    { name: 'tanggal',type: 'text'},
                    { name: 'sakit',type: 'text'},
                    { name: 'ijin',type: 'text'},
                    { name: 'alpha',type: 'text'},
                    { name: 'k01',type: 'text'},
                    { name: 'k02',type: 'text'},
                    { name: 'k03',type: 'text'},
                    { name: 'k04',type: 'text'},
                    { name: 'k05',type: 'text'},
                    { name: 'k06',type: 'text'},
                    { name: 'k07',type: 'text'},
                    { name: 'k08',type: 'text'},
                    { name: 'k09',type: 'text'},
                    { name: 'k10',type: 'text'},
                    { name: 'k11',type: 'text'},
                    { name: 'k12',type: 'text'},
                ],
                type: 'POST',
                data: {	val01:set01, val03:set02, val02: 'pertapelsemesterrapot', _token: '{{ csrf_token() }}' },
                url : '{{ route("jsonPresensicari") }}',	
            };
            var jsonPresensiRapot = new $.jqx.dataAdapter(sourcedatacarirapot);
            var linkrapotgenerator = function (row, column, value) {
                var id    = $('#gridriwayatrapot').jqxGrid('getrowdata', row).id;
                var url     = '<a href="{{url("/")}}/ttdrapot/'+id+'" target="_blank"><span class="badge badge-primary">View</span></a>';
                return url;
            }
            $("#gridriwayatrapot").jqxGrid({
                width           : '100%',   
                columnsresize   : true,
                theme           : "energyblue",
                autoheight      : true,
                altrows         : true,
                filterable      : true,
                showfilterrow   : true,
                pageable        : true,
                sortable        : true,
                source          : jsonPresensiRapot,
                columns         : [
                    { text: 'Kelas', datafield: 'kelas', width: '8%', ellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '20%', align: 'center' },
                    { text: 'No Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Semester', datafield: 'semester', width: '10%', cellsalign: 'center', align: 'center'},	
                    { text: 'TAPEL', datafield: 'tapel', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Total Nilai', datafield: 'total', width: '10%', cellsalign: 'right', align: 'center' },
                    { text: 'Rata-Rata', datafield: 'ratarata', width: '10%', cellsalign: 'right', align: 'center' },
                    { text: 'Rangking', datafield: 'rangking', width: '8%', cellsalign: 'center', align: 'center' },
                    { text: 'Link', cellsrenderer: linkrapotgenerator, width: '7%', cellsalign: 'center', align: 'center' },
                    { text: 'Edit', columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
						return "Edit";
						}, buttonclick: function (row) {
							editrow         = row;
							var offset 		= $("#gridriwayatrapot").offset();
							var dataRecord 	= $("#gridriwayatrapot").jqxGrid('getrowdata', editrow);
							$('#rapot_id').val(dataRecord.id);
							$('#rapot_nama').val(dataRecord.nama);
                            $('#rapot_tanggal').val(dataRecord.tanggal);
                            $('#rapot_sakit').val(dataRecord.sakit);
                            $('#rapot_ijin').val(dataRecord.ijin);
                            $('#rapot_alpha').val(dataRecord.alpha);
                            $('#rapot_indikator01').val(dataRecord.k01);
                            $('#rapot_perkembangan01').val(dataRecord.k02);
                            CKEDITOR.instances['rapot_deskripsi01'].setData(dataRecord.k03)
                            $('#rapot_indikator02').val(dataRecord.k04);
                            $('#rapot_perkembangan02').val(dataRecord.k05);
                            CKEDITOR.instances['rapot_deskripsi02'].setData(dataRecord.k06)
                            $('#rapot_indikator03').val(dataRecord.k07);
                            $('#rapot_perkembangan03').val(dataRecord.k08);
                            CKEDITOR.instances['rapot_deskripsi03'].setData(dataRecord.k09)
                            $('#rapot_indikator04').val(dataRecord.k10);
                            $('#rapot_perkembangan04').val(dataRecord.k11);
                            CKEDITOR.instances['rapot_deskripsi04'].setData(dataRecord.k12)
                            $('.hasilpencarian').hide();
                            $('#diveditor').show();
						}
					},
                ],
            });
            $('#divriwayatumum').show();
        });
        $('#btnsimpanrapot').click(function () {
            var set01=document.getElementById('rapot_id').value;
            var set02='editrapot';
            var set03='editrapot';
            var set04='editrapot';
            var set05='editrapot';
            var set06='editrapot';
            var set07=CKEDITOR.instances['rapot_deskripsi01'].getData()
            var set08=CKEDITOR.instances['rapot_deskripsi02'].getData()
            var set09=CKEDITOR.instances['rapot_deskripsi03'].getData()
            var set10=CKEDITOR.instances['rapot_deskripsi04'].getData()
            var set11=document.getElementById('rapot_tanggal').value;
            var set12=document.getElementById('rapot_sakit').value;
            var set13=document.getElementById('rapot_ijin').value;
            var set14=document.getElementById('rapot_alpha').value;
            if (set05 == '' || set06 == '' || set07 == '' || set08 == '' || set09 == '' || set10 == '' || set11 == '' || set12 == '' || set13 == '' || set14 == ''){ 
                swal({
                    title: 'Stop',
                    text: 'Form Isian Wajib di Isi Semua, Adapun Ada Data Yang Tidak di Ketahui Mohon di Beri Tanda 0 (nol) atau - (strip)',
                    type: 'warning',
                })
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData($('#forminputnilaiafektif')[0]);
                    formdata.set('nama',set01);
                    formdata.set('kelas',set02);
                    formdata.set('noinduk',set03);
                    formdata.set('nisn',set04);
                    formdata.set('tapel',set05);
                    formdata.set('semester',set06);
                    formdata.set('deskripsi01',set07);
                    formdata.set('deskripsi02',set08);
                    formdata.set('deskripsi03',set09);
                    formdata.set('deskripsi04',set10);
                    formdata.set('tanggal',set11);
                    formdata.set('sakit',set12);
                    formdata.set('ijin',set13);
                    formdata.set('alpha',set14);
                    formdata.set('val01','editorrapottpq');
                    formdata.set('_token', '{{ csrf_token() }}');
                url='{{ route("ctkBiodatarapot") }}';
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
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title: textStatus,
                            text:  jqXHR.responseText,
                            type: 'info',
                        });
                    }
                });
            }
        });
    });
</script>
@endpush