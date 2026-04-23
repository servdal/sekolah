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

    $(document).ready(function () {
        $('.hasilpencarian').hide();
        $(".btnboxrefresh").click(function(){
            var uri = window.location.href.split("#")[0];
            window.location=uri
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
                    { text: 'Kelas', datafield: 'kelas', width: '10%', ellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '20%', align: 'center' },
                    { text: 'No Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Semester', datafield: 'semester', width: '10%', cellsalign: 'center', align: 'center'},	
                    { text: 'TAPEL', datafield: 'tapel', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Total Nilai', datafield: 'total', width: '10%', cellsalign: 'right', align: 'center' },
                    { text: 'Rata-Rata', datafield: 'ratarata', width: '10%', cellsalign: 'right', align: 'center' },
                    { text: 'Rangking', datafield: 'rangking', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Link Rapot', cellsrenderer: linkrapotgenerator, width: '10%', cellsalign: 'center', align: 'center' },
                ],
            });
            $('#divriwayatumum').show();
        });
    });
</script>
@endpush