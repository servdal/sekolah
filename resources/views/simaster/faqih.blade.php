@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kelas Al Quran</h1>
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
                <div id="loading">
                    <img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
                </div>
                <div class="col-lg-4 col-md-4 sectiontahfid">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">List Santri</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body  table-responsive p-0" id="divawalperkemsantri">
                            @if(isset($listanak) && !empty($listanak))
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach($listanak as $rows)
                                    <li class="item">
                                        <div class="product-img">
                                            <a href="#" class="btn btn-sm btn-primary btnstatistik" id="{{$rows['id']}}" noinduk="{{$rows['noinduk']}}" nama="{{$rows['nama']}}" kelas="{{$rows['jilid']}}">
                                                <img src="{{ $rows['foto'] }}" alt="{{ $rows['nama'] }}" class="img-circle img-size-32 mr-2">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-title btnpill" id="{{$rows['id']}}" noinduk="{{$rows['noinduk']}}" nama="{{$rows['nama']}}" kelas="{{$rows['jilid']}}">{{$rows['nama']}}
                                            <span class="badge badge-warning float-right"><i class="fa fa-search"></i> Detail</span></a>
                                            <span class="product-description">
                                                Data Terakhir {{$rows['tanggal']}}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 sectionsetoran">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title" id="juduldetailalquran">Data Halaqoh</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="formtambahsetoran" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="id_nama" class="col-sm-4 col-form-label">Nama :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nama" id="id_nama" readonly />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mas_noinduk" class="col-sm-4 col-form-label">No Induk :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="noinduk" id="mas_noinduk" readonly />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mas_kelas" class="col-sm-4 col-form-label">Kelas Halaqoh :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="kelas" id="mas_kelas" readonly />
                                       
                                    </div>
                                </div>
                                <div style="overflow: hidden; display: none;">
                                    <input type="text" name="tekspersiapanhafalanbesok" id="mas_persiapanhafalanbesok" />
                                    <input type="text" name="teksmurojaahsabtuahad" id="mas_murojaahsabtuahad" />
                                    <input type="text" name="teksmurojaahdirumah" id="mas_murojaahdirumah" />
                                    <input type="text" name="tekstilawah" id="mas_tilawah" />
                                </div>
                                <div class="form-group row">
                                    <label for="id_tanggal" class="col-sm-4 col-form-label"><font color="red">Tanggal (Pastikan sesuai dengan Tgl lapor)</font> <span class="text-danger">*</span> :</label>
                                    <div class="col-sm-8">
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control" value="{{date('Y-m-d')}}" id="id_tanggal" name="tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="card-body">
                                <ul class="todo-list" data-widget="todo-list">
                                    <li>
                                        <span class="handle">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value name="lap_tilawah" id="lap_tilawah">
                                            <label for="lap_tilawah"></label>
                                        </div>
                                        <small class="badge badge-danger">Tilawah</small>
                                        <span class="text" id="rpa_tilawah">-</span>
                                    </li>
                                    <li>
                                        <span class="handle">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value name="lap_murojaahdirumah" id="lap_murojaahdirumah">
                                            <label for="lap_murojaahdirumah"></label>
                                        </div>
                                        <small class="badge badge-success">Voice Note di Rumah</small>
                                        <span class="text" id="rpa_murojaahdirumah">-</span>
                                    </li>
                                    <li>
                                        <span class="handle">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value name="lap_murojaahsabtuahad" id="lap_murojaahsabtuahad">
                                            <label for="lap_murojaahsabtuahad"></label>
                                        </div>
                                        <small class="badge badge-warning">Murojaah di Rumah</small>
                                        <span class="text" id="rpa_murojaahsabtuahad">-</span>
                                    </li>
                                    <li>
                                        <span class="handle">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value name="persiapanhafalanbesok" id="lap_persiapanhafalanbesok">
                                            <label for="lap_persiapanhafalanbesok"></label>
                                        </div>
                                        <small class="badge badge-info">Persipan Hafalan Besok</small>
                                        <span class="text" id="rpa_persiapanhafalanbesok">-</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-sm btn-warning float-right" id="btnsimpandata"><i class="fa fa-save"></i> Simpan</a>
                            </div>
                        </div>
                        <div class="card-footer p-0">
                            <div id="tabelriwayat"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 sectionstatistik">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title" id="judulstatistik">Statistik</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnboxrefresh"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div id="tabelstatistik"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 sectionisisetoran">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title" id="judullaporan">Pelaporan Setoran</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btntutupsetoran"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                       
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>PR Murojaah Mulai</label>
                                            <select id="rpa_ziyadahsurahawal" name="ziyadahsurahawal" class="form-control" readonly>
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($mushaflist as $rows)
                                                    @php
                                                        $akhir = $rows->jumlah;
                                                        $akhir = $akhir+2;
                                                        for ($i = 1; $i < $akhir; $i++){
                                                            echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                        }
                                                    @endphp
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>PR Murojaah Akhir</label>
                                            <select id="rpa_ziyadahsurahakhir" name="ziyadahsurahakhir" class="form-control" readonly>
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($mushaflist as $rows)
                                                    @php
                                                        $akhir = $rows->jumlah;
                                                        $akhir = $akhir+2;
                                                        for ($i = 1; $i < $akhir; $i++){
                                                            echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                        }
                                                    @endphp
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Voice Note Mulai</label>
                                            <select id="setoran_murojaah_mulaiayat" name="murojaah_mulaiayat" class="form-control select2">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($mushaflist as $rows)
                                                    @php
                                                        $akhir = $rows->jumlah;
                                                        $akhir = $akhir+2;
                                                        for ($i = 1; $i < $akhir; $i++){
                                                            echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                        }
                                                    @endphp
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Voice Note Akhir</label>
                                            <select id="setoran_murojaah_akhirayat" name="murojaah_akhirayat" class="form-control select2">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($mushaflist as $rows)
                                                    @php
                                                        $akhir = $rows->jumlah;
                                                        $akhir = $akhir+2;
                                                        for ($i = 1; $i < $akhir; $i++){
                                                            echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                        }
                                                    @endphp
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Ziyadah di Rumah Mulai</label>
                                            <select id="setoran_ziyadah_mulaiayat" name="ziyadah_mulaiayat" class="form-control select2">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($mushaflist as $rows)
                                                    @php
                                                        $akhir = $rows->jumlah;
                                                        $akhir = $akhir+2;
                                                        for ($i = 1; $i < $akhir; $i++){
                                                            echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                        }
                                                    @endphp
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Ziyadah di Rumah Akhir</label>
                                            <select id="setoran_ziyadah_akhirayat" name="ziyadah_akhirayat" class="form-control select2">
                                                <option value="">Pilih Salah Satu</option>
                                                @foreach($mushaflist as $rows)
                                                    @php
                                                        $akhir = $rows->jumlah;
                                                        $akhir = $akhir+2;
                                                        for ($i = 1; $i < $akhir; $i++){
                                                            echo '<option value="'.$rows->id.'.'.$i.'">'.$rows->id.'.'.$i.' ('.$rows->surah.' Ayat '.$i.')</option>';
                                                        }
                                                    @endphp
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" id="mas_semester" name="mas_semester" value="{{ $semester }}">
<input type="hidden" id="mas_tapel" name="mas_tapel" value="{{ $tapel }}">

<input type="hidden" name="set_tanggal" id="set_tanggal" value="{{ date('Y-m-d') }}">
@endsection

@push('script')
<script type="text/javascript">
    $(function () {
        $('.select2').select2({width: '100%'});
		CKEDITOR.env.isCompatible = true;
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
		$('#id_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#divawalperkemsantri').on('click', '.btnpill', function () {
            var id          = $(this).attr('id');
            var noinduk     = $(this).attr('noinduk');
            var nama        = $(this).attr('nama');
            var kelas       = $(this).attr('kelas');
            var judul       = 'Data Halaqoh an. '+nama;
            $('#juduldetailalquran').html(judul);
            $('#id_nama').val(nama);
            $('#mas_noinduk').val(noinduk);
            $('#mas_kelas').val(kelas);
            $('.sectiontahfid').show();
            $('.sectionstatistik').hide();
            $('.sectionisisetoran').hide();
            openedpage();
            getPR();
            $('.sectionsetoran').show();
        });
        $('#divawalperkemsantri').on('click', '.btnstatistik', function () {
            var id          = $(this).attr('id');
            var noinduk     = $(this).attr('noinduk');
            var nama        = $(this).attr('nama');
            var kelas       = $(this).attr('kelas');
            var judul       = 'Data Statistik an. '+nama;
            $('#judulstatistik').html(judul);
            var tapel	    = document.getElementById('mas_tapel').value;
            var semester    = document.getElementById('mas_semester').value;
            $("html, body").animate({ scrollTop: 0 }, "slow");
            var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
            var formdata = new FormData();
                formdata.set('val01', noinduk);
                formdata.set('tapel', tapel);
                formdata.set('semester', semester);
                formdata.set('workcode','getstatistikbyid');
                formdata.set('_token', '{{ csrf_token() }}');
            url='{{ route("jsonDataRPA") }}';
            $('#loading').show();
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
                    $('#loading').hide();
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    $('.sectiontahfid').hide();
                    $('.sectionsetoran').hide();
                    $('.sectionisisetoran').hide();
                    $('.sectionstatistik').show();
                    $('#tabelstatistik').html(response.generatesurat);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#loading').hide();
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    swal({
                        title: textStatus,
                        text:  jqXHR.responseText,
                        type: 'info',
                    });
                }
            });
        });
	});
    function openedpage( jQuery ){
        var tapel	    = document.getElementById('mas_tapel').value;
        var semester	= document.getElementById('mas_semester').value;
        var noinduk	    = document.getElementById('mas_noinduk').value;
        var kelas	    = document.getElementById('mas_kelas').value;
        var formdata = new FormData();
            formdata.set('workcode', 'dataperanakallday');
            formdata.set('tapel', tapel);
            formdata.set('semester', semester);
            formdata.set('noinduk', noinduk);
            formdata.set('kelas', kelas);
            formdata.set('_token', '{{ csrf_token() }}');
        $.ajax({
            url         : '{{ route("jsonDataRPA") }}',
            data        : formdata,
            type        : 'POST',
            contentType : false,
            processData : false,
            success: function (data) {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                timelinetekssekolah = '';
                timelineteksrumah   = '';
                dtruang             = '';
                states              = ['info', 'primary', 'warning', 'info', 'primary', 'secondary'];
                if (data.data){
                    for(i=0;i<data.data.length;i++){
                        stateNum            = Math.floor(Math.random() * 6);
                        state1 		        = states[stateNum];
                        stateNum            = Math.floor(Math.random() * 6);
                        state2 		        = states[stateNum];
                        zsn                 = data.data[i].zsn;
                        msn                 = data.data[i].msn;
                        tsn                 = data.data[i].tsn;
                        tasn                = data.data[i].tasn;
                        catatan             = data.data[i].catatan;

                        mrn                 = data.data[i].mrn;
                        tarn                = data.data[i].tarn;
                        trn                 = data.data[i].trn;
                        zrn                 = data.data[i].zrn;
                        catrumah            = data.data[i].catrumah;

                        timelinetekssekolah = timelinetekssekolah+'<div class="timeline"><div class="time-label"><span class="bg-'+state1+'"><i class="fa fa-building"></i> Setoran di Sekolah Tgl. '+data.data[i].tanggal+'</span></div>';
                        if (zsn == '' || zsn  == '0' || zsn == null){
                            timelinetekssekolah = timelinetekssekolah+'<div><i class="fa fa-ban bg-danger"></i><div class="timeline-item"><h3 class="timeline-header">Ziyadah</h3></div></div>';
                        } else {
                            timelinetekssekolah = timelinetekssekolah+'<div><i class="fa fa-check bg-success"></i><div class="timeline-item"><h3 class="timeline-header">Ziyadah</h3><div class="timeline-body">'+ data.data[i].zsm+' <span class="badge badge-'+state1+'">s/d</span> '+data.data[i].zsa+' ('+data.data[i].zsn+')</div></div></div>';
                        }
                        if (msn == '' || msn  == '0' || msn == null){
                            timelinetekssekolah = timelinetekssekolah+'<div><i class="fa fa-ban bg-danger"></i><div class="timeline-item"><h3 class="timeline-header">Murojaah</h3></div></div>';
                        } else {
                            timelinetekssekolah = timelinetekssekolah+'<div><i class="fa fa-check bg-success"></i><div class="timeline-item"><h3 class="timeline-header">Murojaah</h3><div class="timeline-body">'+ data.data[i].msm+' <span class="badge badge-'+state2+'">s/d</span> '+data.data[i].msa+' ('+data.data[i].msn+')</div></div></div>';
                        }
                        if (tsn == '' || tsn  == '0' || tsn == null){
                            timelinetekssekolah = timelinetekssekolah+'<div><i class="fa fa-ban bg-danger"></i><div class="timeline-item"><h3 class="timeline-header">Tilawah</h3></div></div>';
                        } else {
                            timelinetekssekolah = timelinetekssekolah+'<div><i class="fa fa-check bg-success"></i><div class="timeline-item"><h3 class="timeline-header">Tilawah</h3><div class="timeline-body">'+ data.data[i].tsm+' <span class="badge badge-'+state1+'">s/d</span> '+data.data[i].tsa+' ('+data.data[i].tsn+')</div></div></div>';
                        }
                        if (tasn == '' || tasn  == '0' || tasn == null){
                            timelinetekssekolah = timelinetekssekolah+'<div><i class="fa fa-ban bg-danger"></i><div class="timeline-item"><h3 class="timeline-header">Tahsin</h3></div></div>';
                        } else {
                            timelinetekssekolah = timelinetekssekolah+'<div><i class="fa fa-check bg-success"></i><div class="timeline-item"><h3 class="timeline-header">Tahsin</h3><div class="timeline-body">'+ data.data[i].tast+'  ('+data.data[i].tasn+')</div></div></div>';
                        }
                        if (catatan == '' || catatan  == '0' || catatan == null){
                        } else {
                            timelinetekssekolah = timelinetekssekolah+'<div class="time-label"><span class="bg-primary">Catatan</span></div>';
                            timelinetekssekolah = timelinetekssekolah+'<div><i class="fa fa-book bg-info"></i><div class="timeline-item"><h3 class="timeline-header">Catatan</h3><div class="timeline-body">'+ data.data[i].catatan+'</div></div></div>';
                        }
                        timelinetekssekolah = timelinetekssekolah+'</div>';

                        timelineteksrumah = timelineteksrumah+'<div class="timeline"><div class="time-label"><span class="bg-'+state2+'"><i class="fa fa-bank"></i> Setoran di Rumah Tgl. '+data.data[i].tanggal+'</span></div>';
                        if (mrn == '' || mrn  == '0' || mrn == null){
                            timelineteksrumah = timelineteksrumah+'<div><i class="fa fa-ban bg-danger"></i><div class="timeline-item"><h3 class="timeline-header">Voice Note</h3></div></div>';
                        } else {
                            timelineteksrumah = timelineteksrumah+'<div><i class="fa fa-check bg-success"></i><div class="timeline-item"><h3 class="timeline-header">Voice Note</h3><div class="timeline-body">'+ data.data[i].mrm+'</div></div></div>';
                        }
                        if (tarn == '' || tarn  == '0' || tarn == null){
                            timelineteksrumah = timelineteksrumah+'<div><i class="fa fa-ban bg-danger"></i><div class="timeline-item"><h3 class="timeline-header">Murojaah di Rumah</h3></div></div>';
                        } else {
                            timelineteksrumah = timelineteksrumah+'<div><i class="fa fa-check bg-success"></i><div class="timeline-item"><h3 class="timeline-header">Murojaah di Rumah</h3><div class="timeline-body">'+ data.data[i].tart+'</div></div></div>';
                        }
                        if (trn == '' || trn  == '0' || trn == null){
                            timelineteksrumah = timelineteksrumah+'<div><i class="fa fa-ban bg-danger"></i><div class="timeline-item"><h3 class="timeline-header">Tilawah</h3></div></div>';
                        } else {
                            timelineteksrumah = timelineteksrumah+'<div><i class="fa fa-check bg-success"></i><div class="timeline-item"><h3 class="timeline-header">Tilawah</h3><div class="timeline-body">'+ data.data[i].trm+'</div></div></div>';
                        }
                        if (zrn == '' || zrn  == '0' || zrn == null){
                            timelineteksrumah = timelineteksrumah+'<div><i class="fa fa-ban bg-danger"></i><div class="timeline-item"><h3 class="timeline-header">Persipan Hafalan Besok</h3></div></div>';
                        } else {
                            timelineteksrumah = timelineteksrumah+'<div><i class="fa fa-check bg-success"></i><div class="timeline-item"><h3 class="timeline-header">Persipan Hafalan Besok</h3><div class="timeline-body">'+ data.data[i].zrm+'</div></div></div>';
                        }
                        if (catrumah == '' || catrumah  == '0' || catrumah == null){
                        } else {
                            timelineteksrumah = timelineteksrumah+'<div class="time-label"><span class="bg-primary">Catatan</span></div>';
                            timelineteksrumah = timelineteksrumah+'<div><i class="fa fa-book bg-info"></i><div class="timeline-item"><h3 class="timeline-header">Catatan'+ data.data[i].catrumah+'</h3></div></div>';
                        }
                        timelineteksrumah = timelineteksrumah+'</div>';
                        
                    }
                    
                }
                dtruang = dtruang +'<div class="card shadow">'+
                                                '<div class="card-header">'+
                                                    '<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button><button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button></div>'+
                                                '</div>'+
                                                '<div class="card-body">'+
                                                    '<div class="row">'+
                                                        '<div class="col-lg-6 col-md-6"><div class="card card-'+state1+' shadow"><div class="card-header"><div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button><button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button></div></div><div class="card-body">'+timelinetekssekolah+'</div></div></div>'+
                                                        '<div class="col-lg-6 col-md-6"><div class="card card-'+state2+' shadow"><div class="card-header"><div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button><button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button></div></div><div class="card-body">'+timelineteksrumah+'</div></div></div>'+
                                                    '</div></div></div>';
                $('#tabelriwayat').html(dtruang);
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
    function btnisikandata(id){
        $("html, body").animate({ scrollTop: 0 }, "slow");
        var formdata = new FormData();
            formdata.set('val01',id);
            formdata.set('workcode','getdatabyid');
            formdata.set('_token', '{{ csrf_token() }}');
        url='{{ route("jsonDataRPA") }}';
        $('#loading').show();
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
                $('#loading').hide();
                $('.sectiontahfid').hide();
                $('.sectionsetoran').hide();
                $('.sectionisisetoran').show();
                $('.sectionstatistik').hide();
                var judul       = 'Peloporan Setoran an. '+response.nama;
                $('#judullaporan').html(judul);
                $('#id_tanggal').val(response.tanggal);
                $('#rpa_mendengaraudio').html(response.mendengaraudio);
                $('#rpa_persiapanhafalanbesok').html(response.persiapanhafalanbesok);
                $('#rpa_ziyadahsurahawal').val(response.murojaahdirumaha);
                $('#rpa_ziyadahsurahakhir').val(response.murojaahdirumahb);
                $('#setoran_murojaah_mulaiayat').val(response.murojaah_mulaiayat).select2().trigger('change');
                $('#setoran_murojaah_akhirayat').val(response.murojaah_akhirayat).select2().trigger('change');
                $('#setoran_ziyadah_mulaiayat').val(response.ziyadah_mulaiayat).select2().trigger('change');
                $('#setoran_ziyadah_akhirayat').val(response.ziyadah_akhirayat).select2().trigger('change');
                $('#id_nama').val(response.nama);
                $('#id_noinduk').val(response.noinduk);
                $('#id_kelas').val(response.kelas);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#loading').hide();
                swal({
                    title: textStatus,
                    text:  jqXHR.responseText,
                    type: 'info',
                });
            }
        });
    }
    function getPR( jQuery ){
        var tapel	    = document.getElementById('mas_tapel').value;
        var semester	= document.getElementById('mas_semester').value;
        var noinduk	    = document.getElementById('mas_noinduk').value;
        var kelas	    = document.getElementById('mas_kelas').value;
        var tanggal	    = document.getElementById('id_tanggal').value;
        var formdata = new FormData();
            formdata.set('noinduk', noinduk);
            formdata.set('kelas', kelas);
            formdata.set('tanggal', tanggal);
            formdata.set('tapel', tapel);
            formdata.set('semester', semester);
            formdata.set('workcode','getdatabynoinduktgl');
            formdata.set('_token', '{{ csrf_token() }}');
        url='{{ route("jsonDataRPA") }}';
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
                $('#rpa_persiapanhafalanbesok').html(response.persiapanhafalanbesok);
                $('#rpa_murojaahsabtuahad').html(response.murojaahsabtuahad);
                $('#rpa_murojaahdirumah').html(response.murojaahdirumah);
                $('#rpa_tilawah').html(response.tilawah);
                $('#mas_persiapanhafalanbesok').val(response.persiapanhafalanbesok);
                $('#mas_murojaahsabtuahad').val(response.murojaahsabtuahad);
                $('#mas_murojaahdirumah').val(response.murojaahdirumah);
                $('#mas_tilawah').val(response.tilawah);
                var ziyadah = response.ziyadah_nilai;
                var murojaah= response.murojaah_nilai;
                var tilawah = response.tilawah_nilai;
                var tahsin  = response.tahsin_nilai;
                if (ziyadah == '' || ziyadah == null){
                    $('#lap_persiapanhafalanbesok').prop('checked', false);
                } else {
                    $('#lap_persiapanhafalanbesok').prop('checked', true);
                }
                if (murojaah == '' || murojaah == null){
                    $('#lap_murojaahdirumah').prop('checked', false);
                } else {
                    $('#lap_murojaahdirumah').prop('checked', true);
                }
                if (tilawah == '' || tilawah == null){
                    $('#lap_tilawah').prop('checked', false);
                } else {
                    $('#lap_tilawah').prop('checked', true);
                }
                if (tahsin == '' || tahsin == null){
                    $('#lap_murojaahsabtuahad').prop('checked', false);
                } else {
                    $('#lap_murojaahsabtuahad').prop('checked', true);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal({
                    title: textStatus,
                    text:  jqXHR.responseText,
                    type: 'info',
                });
            }
        });
    }
    $(document).ready(function () {
        $('.sectiontahfid').show();
        $('.sectionsetoran').hide();
        $('.sectionstatistik').hide();
        $('.sectionisisetoran').hide();
        $('#loading').hide();
        var token = document.getElementById('token').value;
        $('.btnboxrefresh').click(function () {
            var uri = window.location.href.split("#")[0];
            window.location=uri
        });
        $('#btntutupsetoran').click(function () {
            $('.sectionsetoran').show();
            $('.sectionstatistik').hide();
            $('.sectionisisetoran').hide();
            openedpage();
            $('.sectionsetoran').show();
        });
        $('#btnsimpandata').click(function () {
            var tapel	    = document.getElementById('mas_tapel').value;
            var semester	= document.getElementById('mas_semester').value;
            var checkbox01  = document.getElementById("lap_tilawah");
            if (checkbox01.checked) {
                var tilawah = 1;
            } else {
                var tilawah = 0;
            }
            var checkbox02  = document.getElementById("lap_murojaahdirumah");
            if (checkbox02.checked) {
                var murojaahdirumah = 1;
            } else {
                var murojaahdirumah = 0;
            }
            var checkbox03  = document.getElementById("lap_murojaahsabtuahad");
            if (checkbox03.checked) {
                var murojaahsabtuahad = 1;
            } else {
                var murojaahsabtuahad = 0;
            }
            var checkbox04  = document.getElementById("lap_persiapanhafalanbesok");
            if (checkbox04.checked) {
                var persiapanhafalanbesok = 1;
            } else {
                var persiapanhafalanbesok = 0;
            }
            var total = Number(tilawah) + Number(murojaahdirumah) + Number(murojaahsabtuahad) + Number(persiapanhafalanbesok);
            if (total == 0){
                swal({
                    title: 'Peringatan',
                    text: 'Data Yang di Centang Tidak Ada',
                    type: 'info',
                });
            } else if (tapel == '' || tapel == null || semester == '' || semester == null) {
                swal({
                    title: 'Gagal',
                    text: 'Session Invalid, Refresh Laman Ini Sebelum Mengulang Kembali',
                    type: 'error',
                });
            } else {
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData($('#formtambahsetoran')[0]);
                    formdata.set('workcode', 'laporprharian');
                    formdata.set('tapel', tapel);
                    formdata.set('semester', semester);
                    formdata.set('tilawah', tilawah);
                    formdata.set('murojaahdirumah', murojaahdirumah);
                    formdata.set('murojaahsabtuahad', murojaahsabtuahad);
                    formdata.set('persiapanhafalanbesok', persiapanhafalanbesok);
                    formdata.set('_token', '{{ csrf_token() }}');
                $.ajax({
                    url         : '{{ route("jsonDataRPA") }}',
                    data        : formdata,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success: function (data) {
                        var status  = data.status;
                        var message = data.message;
                        var warna 	= data.warna;
                        var icon 	= data.icon;
                        $.toast({
                            heading     : status,
                            text        : message,
                            position    : 'top-right',
                            loaderBg    : warna,
                            icon        : icon,
                            hideAfter   : 5000,
                            stack       : 1
                        });
                        $('.sectionsetoran').show();
                        $('.sectionstatistik').hide();
                        $('.sectionisisetoran').hide();
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        openedpage();
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        $('.sectionsetoran').show();
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
        $("#id_tanggal").on('change', function () {
            getPR();
        });
    });
</script>
@endpush