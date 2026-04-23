@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Welcome {{ Session('nama') }}</h1>
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
                <div class="col-lg-4">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-success">
                            <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ url('').'/'.session('sekolah_logo') }}" alt="User Avatar">
                            </div>
                            <h3 class="widget-user-username">{!! session('sekolah_nama_yayasan') !!}</h3>
                            <h5 class="widget-user-desc">{!! session('sekolah_nama_sekolah') !!} {!! session('sekolah_kota') !!}</h5>
                        </div>
                    </div>
                    <div class="card card-warning direct-chat direct-chat-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Lounge</h3>
                            <div class="card-tools">
                                <div id="timeremaining"></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="direct-chat-messages">
                                <div id="chatbody"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="input-group">
                                <input type="text" name="message" id="kirimpsn" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-success" id="sendpesan">Send</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Kalender Pendidikan</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="card bg-gradient-info">
                                        <div class="card-header">
                                            <h3 class="card-title"><i class="fa fa-clipboard mr-1"></i>Bulan dan Tahun</h3>
                                            <div class="card-tools">
                                                <div class="btn-group">
                                                    <select id="bulan" name="bulan" class="form-control">
                                                        <option value="latest">Pilih Bulan</option>
                                                        <option value="01">Januari</option>
                                                        <option value="02">Februari</option>
                                                        <option value="03">Maret</option>
                                                        <option value="04">April</option>
                                                        <option value="05">Mei</option>
                                                        <option value="06">Juni</option>
                                                        <option value="07">Juli</option>
                                                        <option value="08">Agustus</option>
                                                        <option value="09">September</option>
                                                        <option value="10">Oktober</option>
                                                        <option value="11">November</option>
                                                        <option value="12">Desember</option>
                                                    </select>
                                                    <select id="tahun" name="tahun" size="1" class="form-control">
                                                        @php
                                                            $tahun = date('Y');
                                                            $limtahunlalu = $tahun - 5;
                                                            while ($limtahunlalu != $tahun){
                                                                echo '<option value="'.$limtahunlalu.'">'.$limtahunlalu.'</option>';
                                                                $limtahunlalu++;
                                                            }
                                                            echo '<option value="'.$tahun.'" selected>'.$tahun.'</option>';
                                                        @endphp
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body table-responsive p-0">
                                            <div id="tabelkalender"></div>
                                        </div>
                                    </div>
                                    <div class="card card-danger shadow">
                                        <div class="card-header">
                                            <h3 class="card-title">Data Hari Libur Nasional / Lokal</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" title="Tambah Data Libur Nasional" id="btntambahdataliburnas"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="gridhariliburnasional"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title" id="judul"></h3>
                                        </div>
                                        <div class="card-body">
                                            <div id="gridjadwalharian"></div>
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
<div class="modal fade" id="modaltambahliburnasional">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Libur Nasional</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Mulai </label>
                            <div class="input-group date" data-target-input="nearest">
                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="id_perkiraanpelaksanaanmulai" name="mulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-flag"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Akhir </label>
                            <div class="input-group date" data-target-input="nearest">
                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="id_perkiraanpelaksanaanakhir" name="akhir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-flag-checkered"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_namaharilibur">Nama Hari Libur</label>
                    <input type="text" class="form-control" id="id_namaharilibur" name="id_namaharilibur">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="id_idne">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpanharilibur">Simpan</button>	
                
            </div>
        </div>
    </div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
    <div class="tabel_cetak"></div>		
</div>
<!-- TOKEN -->
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

@endsection

@push('script')
<script type="text/javascript">
    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = $('.isi-notifications');
    if (notificationsCount <= 0) {
        notificationsWrapper.hide();
    }
    var pusher = new Pusher('461fe095afe037987c11', {
        encrypted   : true,
        cluster     : 'ap1'
    });
    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        console.log(data);
        var existingNotifications   = notifications.html();
        var newNotificationHtml     = `<a href="#" class="dropdown-item"><i class="fa fa-commenting-o mr-2"></i>`+data.message+`</a><div class="dropdown-divider"></div>`;
        notifications.html(newNotificationHtml + existingNotifications);
        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
    });
    function openedpage( jQuery ){
		var token=document.getElementById('token').value;
		$.post('{{ route("chatGetlist") }}', { _token: token},
		function(data){
			$('#chatbody').html(data);
		});
	}
    function generateKalender( jQuery ){
		var bulan=document.getElementById('bulan').value;
        var tahun=document.getElementById('tahun').value;
        var token=document.getElementById('token').value;
        $('#judul').html(bulan+' '+tahun);
		$.post('{{ route("viewTabelBulan") }}', { month: bulan, year: tahun, bentuk: 'kalender', _token: token},
		function(data){
			$('#tabelkalender').html(data);
		});
        $.post('{{ route("viewTabelBulan") }}', { month: bulan, year: tahun, bentuk: 'listkalender', _token: token},
		function(data){
			$('#gridjadwalharian').html(data);
		});
        var sourceTanggal    = {
            datatype: "json",
            datafields: [
                { name: 'id' },
                { name: 'tanggal', type: 'string' },
                { name: 'mulai', type: 'string' },
                { name: 'akhir', type: 'string' },
                { name: 'marking', type: 'string' },
                { name: 'namaharilibur', type: 'string' },
                { name: 'id_sekolah', type: 'string' },
            ],
            type: 'POST',
            data: {bentuk: 'hariliburnasional', year: tahun, _token: '{{ csrf_token() }}'},
            url : '{{ route("viewTabelBulan") }}',
        };
        var datajsonTanggal = new $.jqx.dataAdapter(sourceTanggal);
        $("#gridhariliburnasional").jqxGrid({
            width           : '100%',
            pageable        : true,
            autoheight      : true,
            filterable      : true,
            showfilterrow   : true,
            columnsresize   : true,
            source          : datajsonTanggal,
            sortable        : true,
            altrows         : true,
            theme           : "energyblue",
            columns         : [
                { text: 'Tanggal', datafield: 'marking', width: '30%', cellsalign: 'left', align: 'center' },
                { text: 'Nama', datafield: 'namaharilibur', width: '50%', cellsalign: 'left', align: 'center' },
                { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '20%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow         = row;
                        var offset 		= $("#gridhariliburnasional").offset();
                        var dataRecord 	= $("#gridhariliburnasional").jqxGrid('getrowdata', editrow);
                        $('#id_idne').val(dataRecord.marking);
                        $('#id_perkiraanpelaksanaanmulai').val(dataRecord.mulai);
                        $('#id_perkiraanpelaksanaanakhir').val(dataRecord.akhir);
                        $('#id_namaharilibur').val(dataRecord.namaharilibur);
                        $("#modaltambahliburnasional").modal('show');
                    }
                }
            ],
        });
	}
    
	setTimeout(function () { 
      openedpage();
    }, 60 * 10000);
    var start = new Date();
    CountDownTimer(start, 'timeremaining');
    function CountDownTimer(dt, id)
    {
        var end 	= new Date(dt.getTime() + 10000);
        var _second = 1000;
        var _minute = _second * 60;
        var _hour 	= _minute * 60;
        var _day 	= _hour * 24;
        var timer;
        function showRemaining() {
            var now = new Date();
            var distance = end - now;
            if (distance < 0) {
                clearInterval(timer);
                var start = new Date();
                CountDownTimer(start, 'timeremaining');
                openedpage();
                return;
            }
            var days = Math.floor(distance / _day);
            var hours = Math.floor((distance % _day) / _hour);
            var minutes = Math.floor((distance % _hour) / _minute);
            var seconds = Math.floor((distance % _minute) / _second);
            document.getElementById(id).innerHTML ='Refresh in ';
            document.getElementById(id).innerHTML += seconds + 'secs';
        }
        timer = setInterval(showRemaining, 1000);
    }
    function btnkegiatanselesai(id){
        swal({
            title			    : "Konfirmasi",
            text			    : "Data yang akan ditandai Selesai, Maka Bapak/Ibu tidak lagi bisa menambah data SPJ. Apakah Bapak/Ibu Yakin",
            type			    : 'warning',
            showCancelButton    : true,
            confirmButtonClass  : 'btn btn-confirm mt-2',
            cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
            confirmButtonText   : 'Yes'
        }).then(function () {
            $.ajax({
                type		: 'ajax',
                url			: '{{ route("exSimpanRK") }}',
                method		: 'post',
                data		: {workcode:'arsipkan', id:id,  _token: '{{ csrf_token() }}'},
                dataType	: 'json',
                success: function(response, status, xhr) {
                    swal({
                        title	: response.status,
                        text	: response.message,
                        type	: response.icon,
                    });
                    $('#btnubahtahun').click();
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
    $(function () {
        $('.datemaskinput').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
    });
    $(document).ready(function () {
        $("#bulan").on('change', function () {
            generateKalender();
        });
        $("#tahun").on('change', function () {
            generateKalender();
        });
        $('#sendpesan').on('click', function (){
            var kirim   = document.getElementById('kirimpsn').value;
            var nama    = '';
            var foto    = '';
            var token   = document.getElementById('token').value;
            var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
            $.post('surat/catting', { val01: kirim, val02: nama, val03: foto, _token: token },
            function(data){
                $('#kirimpsn').val('');
                btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                $('#chatbody').html(data);
            });
        });
        $('#btntambahdataliburnas').on('click', function (){
            $('#id_idne').val('new');
            $("#modaltambahliburnasional").modal('show');
        });
        $('#btnsimpanharilibur').on('click', function (){
            var mulai   = document.getElementById('id_perkiraanpelaksanaanmulai').value;
            var akhir   = document.getElementById('id_perkiraanpelaksanaanakhir').value;
            var nama    = document.getElementById('id_namaharilibur').value;
            var idne    = document.getElementById('id_idne').value;
            $("#modaltambahliburnasional").modal('hide');
            $.post('{{ route("viewTabelBulan") }}', { bentuk: 'inputhariliburnasional', val01: mulai, val02: akhir, val03: nama, val04: idne, _token: '{{ csrf_token() }}' },
            function(data){
                generateKalender();
            });
        });
        openedpage();
        generateKalender();
	});
</script>
@endpush