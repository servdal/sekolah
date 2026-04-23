@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Ujian Lisan Kelas {{ $setidkelas }}</h1>
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
            <div class="row">
                <div class="col-md-3 sectionujian">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Pilih Peserta Ujian</h3>
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
                                            @if ($smt == '1')
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
                        <div class="card-footer">
                            <div id="gridsantri"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9" id="divkertasujian">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Lembar Penilaian</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="ujian_nama">Nama</label>
                                        <input type="text" class="form-control" id="ujian_nama" name="ujian_nama" readonly>
                                    </div> 
                                    <div class="col-lg-2">
                                        <label for="ujian_kelas">Kelas</label>
                                        <input type="text" class="form-control" id="ujian_kelas" name="ujian_kelas" readonly>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="ujian_noinduk">No Induk</label>
                                        <input type="text" class="form-control" id="ujian_noinduk" name="ujian_noinduk" readonly>
                                        <input type="hidden" id="ujian_ttl" name="ujian_ttl">
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="ujian_semester">Semester</label>
                                        <input type="text" class="form-control" id="ujian_semester" name="ujian_semester" value="{{$smt}}" readonly>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="ujian_tapel">Tapel</label>
                                        <input type="text" class="form-control" id="ujian_tapel" name="ujian_tapel" value="{{$tapel}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="openpilihanujian">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="small-box bg-danger">
                                            <div class="inner">
                                                <h3>Materi Ujian</h3>
                                                <p>English</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-language"></i>
                                            </div>
                                            <a href="javascript:void(0)" onClick="selectasmateri('english')"class="small-box-footer">
                                                Click Me <i class="fa fa-mouse-pointer"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="small-box bg-primary">
                                            <div class="inner">
                                                <h3>Materi Ujian</h3>
                                                <p class="text-right">العبادة</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <a href="javascript:void(0)" onClick="selectasmateri('ibadah')"class="small-box-footer">
                                                Click Me <i class="fa fa-mouse-pointer"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>Materi Ujian</h3>
                                                <p class="text-right">اللغة العربية</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-gg"></i>
                                            </div>
                                            <a href="javascript:void(0)" onClick="selectasmateri('lugot')"class="small-box-footer">
                                                Click Me <i class="fa fa-mouse-pointer"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="openpilihan">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="small-box bg-success">
                                                    <div class="inner">
                                                        <h3>Penguji 1</h3>
                                                        <p id="tekspenguji1">Slot Tersedia</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-user-times"></i>
                                                    </div>
                                                    <a href="javascript:void(0)" onClick="selectasvalue('pengguji1')"class="small-box-footer">
                                                        Ambil Kursi Ini <i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="small-box bg-info">
                                                    <div class="inner">
                                                        <h3>Penguji 2</h3>
                                                        <p id="tekspenguji2">Slot Tersedia</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-user-times"></i>
                                                    </div>
                                                    <a href="javascript:void(0)" onClick="selectasvalue('pengguji2')"class="small-box-footer">
                                                        Ambil Kursi Ini <i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="small-box bg-warning">
                                                    <div class="inner">
                                                        <h3>Penguji 3</h3>
                                                        <p id="tekspenguji3">Slot Tersedia</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-user-times"></i>
                                                    </div>
                                                    <a href="javascript:void(0)" onClick="selectasvalue('pengguji3')"class="small-box-footer">
                                                        Ambil Kursi Ini <i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="card card-success shadow">
                                            <div class="card-body">
                                                <div class="card-body table-responsive p-0">
                                                    <div id="tabelreportdetail"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group openlembarpenilaian" id="openlembarpenilaianenglish">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">English</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center; vertical-align:middle">SUBJECT</th>
                                                    <th style="text-align:center; vertical-align:middle">SCORE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Manner</td>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="inggris1" id="inggris1"></td>
                                                </tr>
                                                <tr>
                                                    <td>Conversation</td>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="inggris2" id="inggris2"></td>
                                                </tr>
                                                <tr>
                                                    <td>English Lesson</td>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="inggris3" id="inggris3"></td>
                                                </tr>
                                                <tr>
                                                    <td>Dictation</td>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="inggris4" id="inggris4"></td>
                                                </tr>
                                                <tr>
                                                    <td>Translation</td>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="inggris5" id="inggris5"></td>
                                                </tr>
                                                <tr>
                                                    <td>Composition</td>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="inggris6" id="inggris6"></td>
                                                </tr>
                                                <tr>
                                                    <td>Grammar</td>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="inggris7" id="inggris7"></td>
                                                </tr>
                                                <tr>
                                                    <td>AVERAGE</td>
                                                    <td style="text-align:right"><span class="badge badge-primary" id="jumlahinggris">n/a</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary btnsimpanpenilaian">
                                            <i class="fa fa-save"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group openlembarpenilaian" id="openlembarpenilaianibadah">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="text-right">العبادة</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:right; vertical-align:middle">الدرجة</th>
                                                    <th style="text-align:right; vertical-align:middle">المواد الدراسية</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="ibadah1" id="ibadah1"></td>
                                                    <td style="text-align:right">الأدب</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="ibadah2" id="ibadah2"></td>
                                                    <td style="text-align:right">العبادة القولية</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="ibadah3" id="ibadah3"></td>
                                                    <td style="text-align:right">العبادة الفعلية</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="ibadah4" id="ibadah4"></td>
                                                    <td style="text-align:right">التجويد</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="ibadah5" id="ibadah5"></td>
                                                    <td style="text-align:right">قراءة القرآن</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right"><span class="badge badge-primary" id="jumlahibadah">n/a</span></td>
                                                    <td style="text-align:right">المعدل التراكمي</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary btnsimpanpenilaian">
                                            <i class="fa fa-save"></i> يحفظ
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group openlembarpenilaian" id="openlembarpenilaianlugot">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="text-right">اللغة العربية</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped table-bordered" cellpadding="1" cellspacing="1">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center; vertical-align:middle">الدرجة</th>
                                                    <th style="text-align:center; vertical-align:middle">المواد الدراسية</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="lugot1" id="lugot1"></td>
                                                    <td style="text-align:right">الأدب</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="lugot2" id="lugot2"></td>
                                                    <td style="text-align:right">المحادثة</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="lugot3" id="lugot3"></td>
                                                    <td style="text-align:right">اللغة العربية</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="lugot4" id="lugot4"></td>
                                                    <td style="text-align:right">الإملاء</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="lugot5" id="lugot5"></td>
                                                    <td style="text-align:right">الترجمة</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="lugot6" id="lugot6"></td>
                                                    <td style="text-align:right">النحو</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right"><span class="badge badge-primary" id="jumlahlugot">n/a</span></td>
                                                    <td style="text-align:right">المعدل التراكمي</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary btnsimpanpenilaian">
                                            <i class="fa fa-save"></i> يحفظ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9" id="divriwayat">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Penilaian</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btnexport"><i class="fa fa-file-excel-o"></i></button>
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
                </div>
            </div>
		</div>
	</section>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
    <tr>
        <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="lugot7" id="lugot7"></td>
        <td style="text-align:right">الصرف</td>
    </tr>
    <tr>
        <td style="text-align:right"><input type="text" class="form-control inputnilai"  komponen="lugot8" id="lugot8"></td>
        <td style="text-align:right">المحفوظات</td>
    </tr>
</div>
<input type="hidden" id="mas_semester" name="mas_semester" value="{{ $smt }}">
<input type="hidden" id="mas_tapel" name="mas_tapel" value="{{ $tapel }}">
<input type="hidden" id="mas_kelas" name="mas_kelas" value="{{$setidkelas}}">
<input type="hidden" name="set_tanggal" id="set_tanggal" value="{{ date('Y-m-d') }}">
<input type="hidden" name="idrapotujianlisan" id="idrapotujianlisan">
<input type="hidden" name="jenispenguji" id="jenispenguji">
<input type="hidden" name="jenismateri" id="jenismateri">

@endsection
@push('script')
<script>
	$(function () {
        $('.select2').select2({width: '100%'});
		CKEDITOR.env.isCompatible = true;
	});
    function jQueryOpenRPA(){
        var set01	= document.getElementById('mas_kelas').value;
        var set02	= document.getElementById('mas_tapel').value;
        var set03	= document.getElementById('mas_semester').value;
        var source 	= {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'noinduk', type: 'text'},
                { name: 'nama', type: 'text'},
                { name: 'jilid', type: 'text'},
                { name: 'kelas', type: 'text'},
                { name: 'foto', type: 'text'},
                { name: 'tmplahir', type: 'text'},
                { name: 'tgllahir', type: 'text'},
                { name: 'tapel', type: 'text'},
                { name: 'tanggal', type: 'text'},
            ],
            type: 'POST',
            data: {val01:set01, val02:set02, val03:'semuakelasujianlisan', val04:set03, _token: '{{ csrf_token() }}'},
            url: '{{ route("jsonSetoranTahfid") }}',
        };
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#gridsantri").jqxGrid({
            width           : '100%',
            pageable        : false,
            rowsheight      : 45,
            autoheight      : true,
            filterable      : true,
            source          : dataAdapter,
            theme           : "energyblue",
            selectionmode   : 'singlecell',
            columns         : [
                { text: 'Photo', datafield: 'foto', editable: false, filterable: false, width: '10%', cellsalign: 'center', align: 'center' },
                { text: 'Nama', datafield: 'nama', width: '70%', cellsalign: 'left', align: 'center' },
                { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'left', align: 'center' },
                { text: 'Pilih', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
                    return "Pilih";
                    }, buttonclick: function (row) {
                        editrow         = row;
                        var offset 		= $("#gridsantri").offset();
                        var dataRecord 	= $("#gridsantri").jqxGrid('getrowdata', editrow);
                        var set01       = document.getElementById('arsip_tapel').value;
                        var set02       = document.getElementById('arsip_semester').value;
                        $("#ujian_nama").val(dataRecord.nama);
                        $("#ujian_kelas").val(dataRecord.kelas);
                        $("#ujian_noinduk").val(dataRecord.noinduk);
                        $("#ujian_semester").val(dataRecord.set02);
                        $("#ujian_tapel").val(dataRecord.set01);
                        $("#ujian_ttl").val(dataRecord.tmplahir+', '+dataRecord.tgllahir);
                        var formdata = new FormData();
                            formdata.set('_token', '{{ csrf_token() }}');
                            formdata.set('nama', dataRecord.nama);
                            formdata.set('kelas', dataRecord.kelas);
                            formdata.set('noinduk', dataRecord.noinduk);
                            formdata.set('tapel', set01);
                            formdata.set('semester', set02);
                            formdata.set('workcode', 'openpesertaujianlisan');
                        $.ajax({
                            url         : '{{ route("exInputnilaiUA") }}',
                            data        : formdata,
                            type        : 'POST',
                            contentType : false,
                            processData : false,
                            success     : function (data) {
                                $("#idrapotujianlisan").val(data.idrapotujianlisan);
                                $('#divkertasujian').show();
                                $('#openpilihanujian').show();
                                $('#openpilihan').hide();
                                $('.openlembarpenilaian').hide();
                                return false;
                            },
                            error: function (xhr, status, error) {
                                swal({
                                    title	: 'Stop',
                                    text	: xhr.responseText,
                                    type	: 'warning',
                                })
                            }
                        });
                    }
                },
            ],
        });
    }
    function selectasvalue(id){
        var set03=document.getElementById('idrapotujianlisan').value;
        var set04=document.getElementById('jenismateri').value;
        var formdata = new FormData();
            formdata.set('_token', '{{ csrf_token() }}');
            formdata.set('val02', id);
            formdata.set('val03', set03);
            formdata.set('val04', set04);
            formdata.set('workcode', 'setpenguji');
        $.ajax({
            url         : '{{ route("exInputnilaiUA") }}',
            data        : formdata,
            type        : 'POST',
            contentType : false,
            processData : false,
            success     : function (data) {
                var datacek     = data.openpaper;
                var setpenguji  = data.setpenguji;
                var dataujian   = JSON.parse(data.dataujian);
                if (datacek == 'YES'){
                    $('#openpilihan').hide();
                    $('.openlembarpenilaian').hide();
                    $("#jenispenguji").val(data.setpenguji);
                    if(set04 == 'english'){
                        var pengujiIndex = {
                            'pengguji1': 'pengguji1inggris',
                            'pengguji2': 'pengguji2inggris',
                            'pengguji3': 'pengguji3inggris'
                        };
                        var pengujiKey      = pengujiIndex[setpenguji] || 'pengguji1inggris';
                        var jumlahinggris   = 0;
                        for (var i = 1; i <= 8; i++) {
                            var nilai = dataujian[pengujiKey + i];
                            $("#inggris" + i).val(nilai);
                            if (nilai != null) {
                                jumlahinggris += parseFloat(nilai);
                            }
                        }
                        $("#jumlahinggris").html(jumlahinggris);
                        $('#openlembarpenilaianenglish').show();
                    } else if(set04 == 'ibadah'){
                        var pengujiIndex = {
                            'pengguji1': 'pengguji1ibadah',
                            'pengguji2': 'pengguji2ibadah',
                            'pengguji3': 'pengguji3ibadah'
                        };
                        var pengujiKey      = pengujiIndex[setpenguji] || 'pengguji1ibadah';  // Default ke pengguji1 jika tidak ditemukan
                        var jumlahibadah   = 0;
                        for (var i = 1; i <= 8; i++) {
                            var nilai = dataujian[pengujiKey + i];
                            $("#ibadah" + i).val(nilai);
                            if (nilai != null) {
                                jumlahibadah += parseFloat(nilai);
                            }
                        }
                        $("#jumlahibadah").html(jumlahibadah);
                        
                        $('#openlembarpenilaianibadah').show();
                    } else {
                        var pengujiIndex = {
                            'pengguji1': 'pengguji1lugot',
                            'pengguji2': 'pengguji2lugot',
                            'pengguji3': 'pengguji3lugot'
                        };
                        var pengujiKey      = pengujiIndex[setpenguji] || 'pengguji1lugot';  // Default ke pengguji1 jika tidak ditemukan
                        var jumlahlugot     = 0;
                        for (var i = 1; i <= 8; i++) {
                            var nilai = dataujian[pengujiKey + i];
                            $("#ibadah" + i).val(nilai);
                            if (nilai != null) {
                                jumlahlugot += parseFloat(nilai);
                            }
                        }
                        $("#jumlahibadah").html(jumlahibadah);
                        $('#openlembarpenilaianlugot').show();
                    }
                } else {
                    swal({
                        title	: 'Stop',
                        text	: data.generatesurat,
                        type	: 'error',
                    })
                }
                return false;
            },
            error: function (xhr, status, error) {
                swal({
                    title	: 'Stop',
                    text	: xhr.responseText,
                    type	: 'warning',
                })
            }
        });
    }
    function selectasmateri(id){
        $("#jenismateri").val(id);
        var set03   = document.getElementById('idrapotujianlisan').value;
        var formdata= new FormData();
            formdata.set('_token', '{{ csrf_token() }}');
            formdata.set('val02', id);
            formdata.set('val03', set03);
            formdata.set('workcode', 'openriwayatujianlisan');
        $.ajax({
            url         : '{{ route("exInputnilaiUA") }}',
            data        : formdata,
            type        : 'POST',
            contentType : false,
            processData : false,
            success     : function (data) {
                $("#idrapotujianlisan").val(data.idrapotujianlisan);
                $("#tekspenguji1").html(data.penguji1);
                $("#tekspenguji2").html(data.penguji2);
                $("#tekspenguji3").html(data.penguji3);
                $("#tabelreportdetail").html(data.generatesurat);
                $('#divkertasujian').show();
                $('#openpilihan').show();
                $('#openpilihanujian').hide();
                $('.openlembarpenilaian').hide();
                $('#divriwayat').hide();
                return false;
            },
            error: function (xhr, status, error) {
                swal({
                    title	: 'Stop',
                    text	: xhr.responseText,
                    type	: 'warning',
                })
            }
        });
    }
    $(document).ready(function () {
        $('#divkertasujian').hide();
        $('#divriwayat').hide();
        $('#openpilihan').hide();
        $('.sectionujian').show();
        $('.btnboxrefresh').click(function () {
            var uri = window.location.href.split("#")[0];
            window.location=uri
        });
        $('.inputnilai').on('change', function () {
            var set01 = document.getElementById('idrapotujianlisan').value;
            var set02 = document.getElementById('jenispenguji').value;
            var set03 = $(this).attr('komponen');
            var set04 = $(this).val();
            var formdata = new FormData();
                formdata.set('_token', '{{ csrf_token() }}');
                formdata.set('id', set01);
                formdata.set('jenis', set02);
                formdata.set('komponen', set03);
                formdata.set('nilai', set04);
                formdata.set('workcode', 'inputnilai');
            $.ajax({
                url         : '{{ route("exInputnilaiUA") }}',
                data        : formdata,
                type        : 'POST',
                contentType : false,
                processData : false,
                success     : function (data) {
                    var namajumlah  = data.namajumlah;
                    var status      = data.status;
                    var message     = data.message;
                    var warna 	    = data.warna;
                    var icon 	    = data.icon;
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
                error: function (xhr, status, error) {
                    swal({
                        title	: 'Stop',
                        text	: xhr.responseText,
                        type	: 'warning',
                    })
                }
            });
        });
        jQueryOpenRPA();
        $('.btnsimpanpenilaian').click(function () {
            var set01=document.getElementById('idrapotujianlisan').value;
            var set02=document.getElementById('jenispenguji').value;
            var set03=document.getElementById('jenismateri').value;
            $('.openlembarpenilaian').hide();
            var formdata = new FormData();
                formdata.set('_token', '{{ csrf_token() }}');
                formdata.set('id', set01);
                formdata.set('jenis', set02);
                formdata.set('materi', set03);
                formdata.set('workcode', 'finalperpenguji');
            $.ajax({
                url         : '{{ route("exInputnilaiUA") }}',
                data        : formdata,
                type        : 'POST',
                contentType : false,
                processData : false,
                success     : function (data) {
                    $("#tekspenguji1").html(data.penguji1);
                    $("#tekspenguji2").html(data.penguji2);
                    $("#tekspenguji3").html(data.penguji3);
                    $("#tabelreportdetail").html(data.generatesurat);
                    $('#divkertasujian').show();
                    $('#openpilihan').show();
                    $('#openpilihanujian').hide();
                    $('#divriwayat').hide();
                    return false;
                },
                error: function (xhr, status, error) {
                    swal({
                        title	: 'Stop',
                        text	: xhr.responseText,
                        type	: 'warning',
                    })
                }
            });
        });
        $('#btnviewarsip').click(function () {
            var set01   = document.getElementById('arsip_tapel').value;
            var set02   = document.getElementById('arsip_semester').value;
            var set04	= document.getElementById('mas_kelas').value;

            var sourcearsip 	= {
                datatype: "json",
                datafields: [
                    { name: 'id' },
                    { name: 'nama', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'tapel', type: 'text'},
                    { name: 'semester', type: 'text'},
                    { name: 'nama1', type: 'text'},
                    { name: 'nama2', type: 'text'},
                    { name: 'nama3', type: 'text'},
                    { name: 'allinggris1', type: 'text'},
                    { name: 'allinggris2', type: 'text'},
                    { name: 'allinggris3', type: 'text'},
                    { name: 'allinggris4', type: 'text'},
                    { name: 'allinggris5', type: 'text'},
                    { name: 'allinggris6', type: 'text'},
                    { name: 'allinggris7', type: 'text'},
                    { name: 'allibadah1', type: 'text'},
                    { name: 'allibadah2', type: 'text'},
                    { name: 'allibadah3', type: 'text'},
                    { name: 'allibadah4', type: 'text'},
                    { name: 'allibadah5', type: 'text'},
                    { name: 'alllugot1', type: 'text'},
                    { name: 'alllugot2', type: 'text'},
                    { name: 'alllugot3', type: 'text'},
                    { name: 'alllugot4', type: 'text'},
                    { name: 'alllugot5', type: 'text'},
                    { name: 'alllugot6', type: 'text'},
                    { name: 'alllugot7', type: 'text'},
                    { name: 'alllugot8', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:'arsipujianlisann', val04:set04,  _token: '{{ csrf_token() }}'},
                url: '{{ route("jsonSetoranTahfid") }}',
            };
            var dataAdapterArsip = new $.jqx.dataAdapter(sourcearsip);
            var linkrapotgenerator = function (row, column, value) {
                var id      = $('#gridriwayat').jqxGrid('getrowdata', row).id;
                var url     = '<a href="{{url("/")}}/hasilujianlisan/'+id+'" target="_blank"><span class="badge badge-primary">View</span></a>';
                return url;
            }
            $("#gridriwayat").jqxGrid({
                width           : '100%',
                pageable        : false,
                autoheight      : true,
                filterable      : true,
                source          : dataAdapterArsip,
                theme           : "energyblue",
                selectionmode   : 'singlecell',
                columns         : [
                    { text: 'View', cellsrenderer: linkrapotgenerator, width: '5%', cellsalign: 'center', align: 'center' },
                    { text: 'Kelas', datafield: 'kelas', width: '5%', ellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '10%', align: 'center' },
                    { text: 'No Induk', datafield: 'noinduk', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Semester', datafield: 'semester', width: '5%', cellsalign: 'center', align: 'center'},	
                    { text: 'TAPEL', datafield: 'tapel', width: '5%', cellsalign: 'center', align: 'center' },
                    { text: 'e.1', columngroup: 'inggris', datafield: 'allinggris1', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'e.2', columngroup: 'inggris', datafield: 'allinggris2', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'e.3', columngroup: 'inggris', datafield: 'allinggris3', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'e.4', columngroup: 'inggris', datafield: 'allinggris4', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'e.5', columngroup: 'inggris', datafield: 'allinggris5', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'e.6', columngroup: 'inggris', datafield: 'allinggris6', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'e.7', columngroup: 'inggris', datafield: 'allinggris7', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'i.1', columngroup: 'ibadah', datafield: 'allibadah1', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'i.2', columngroup: 'ibadah', datafield: 'allibadah2', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'i.3', columngroup: 'ibadah', datafield: 'allibadah3', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'i.4', columngroup: 'ibadah', datafield: 'allibadah4', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'i.5', columngroup: 'ibadah', datafield: 'allibadah5', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'l.1', columngroup: 'lugot', datafield: 'alllugot1', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'l.2', columngroup: 'lugot', datafield: 'alllugot2', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'l.3', columngroup: 'lugot', datafield: 'alllugot3', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'l.4', columngroup: 'lugot', datafield: 'alllugot4', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'l.5', columngroup: 'lugot', datafield: 'alllugot5', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'l.6', columngroup: 'lugot', datafield: 'alllugot6', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'l.7', columngroup: 'lugot', datafield: 'alllugot7', width: '4%', cellsalign: 'right', align: 'center' },
                    { text: 'l.8', columngroup: 'lugot', datafield: 'alllugot8', width: '4%', cellsalign: 'right', align: 'center' },
                ],
                columngroups:
                [
                    { text: 'Inggris', align: 'center', name: 'inggris' },
                    { text: 'العبادة', align: 'center', name: 'ibadah' },
                    { text: 'اللغة العربية', align: 'center', name: 'lugot' }                
                ]
            });
            $('#divkertasujian').hide();
            $('.sectionujian').show();
            $('#divriwayat').show();
        });
        $('#btnexport').click(function(){
            var gridContent = $("#gridriwayat").jqxGrid('exportdata', 'json');
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
                        var res     = isi2;
                            td.setAttribute('style', 'mso-number-format: "\@";');
                            td.innerHTML = res;
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
</script>
@endpush