@extends('adminlte3.layoutstandart')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Dashboard</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ url('/') }}/test">Home</a></li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
        <div class="col-5">
            <div class="card card-widget" id="divawal">
                <div class="card-header">
                    <div class="user-block">
                        <img class="img-circle" src="{{ asset('logo.png') }}" alt="User Image">
                        <span class="username"><a href="#">Kartu Peserta</a></span>
                    </div>
                    <div class="card-tools">
                    <div id="timeremaining" class="pull-right"></div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="invoice p-3 mb-3">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" id="printiki">
                            <tr><td colspan="3">&nbsp;</td></tr>
                            <tr>
                                <td width="10%">&nbsp;</td>
                                <td width="80%">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td colspan="10" align="left" valign="middle"><font size="+2">KARTU PESERTA UJIAN</font></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" align="left" valign="middle" rowspan="3"><img src="{{Session('sekolah_frontpage')}}" height="50"/></td>
                                            <td align="center">&nbsp;</td>
                                            <td rowspan="5" align="right" valign="top"><img src="{!! Session('avatar') !!}" width="100"/></td>
                                        </tr>
                                        <tr>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" align="left" valign="middle" style="border-bottom:double">&nbsp;</td>
                                            <td align="center" style="border-bottom:double">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="9" align="left" valign="middle"><b>{!! Session('nama') !!}</b><br /><b>Nomor Peserta :</b><br /><b>{{Session('marking')}}</b></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="10%">&nbsp;</td>
                            </tr>
                            <tr><td colspan="3">&nbsp;</td></tr>
                        </table>
                    </div>
                </div>
                <div class="card-footer table-responsive p-0">
                    <div id="listujian"></div>
                </div>
            </div>
            <div class="card card-widget" id="divmulai">
                <div class="card-header">
                    <div class="user-block">
                        <img class="img-circle" src="{{ asset('logo.png') }}" alt="User Image">
                        <span class="username"><a href="#">Kartu Peserta</a></span>
                    </div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" id="btnkembali"><i class="fa fa-close"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">  
                        <div class="row">
                            <div class="col-md-4">
                                <label for="setwaktumulai">Waktu Saat Ini</label>
                                <input type="text" class="form-control" id="setwaktumulai" disabled="disable">
                            </div>
                            <div class="col-md-4">
                                <label for="setdurasimulai">Waktu Ujian (Menit)</label>
                                <input type="text" id="setdurasimulai" class="form-control" disabled="disable">
                            </div>
                            <div class="col-md-4">
                                <label for="tambahanwaktu">Tambahan Waktu</label>
                                <input type="text" id="tambahanwaktu" class="form-control" value="3 Menit" disabled="disable">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <label for="setwaktubutton">Waktu ini akan kami set sebagai waktu mulai ujian anda dengan durasi yang tertera diatas. Dan apabila waktu mulai anda setelah ditambahkan durasi melebihi waktu akhir dari ujian ini. maka durasi akan dikurangi dan waktu akhir tetap sesuai jadwal.</label>
                        <input type="hidden" id="setmarkingmulai">
                        <button type="button" class="btn btn-success" id="setwaktubutton">Mulai Ujian Sekarang.?</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="callout callout-info">
                <h5><i class="fa fa-info"></i> Perhatian:</h5>
                Gunakan Komputer dengan Jaringan Internet yang handal dan kuat. Bila mewajibkan menggunakan zoom, pastikan aplikasi Zoom sudah diupgrade ke versi terbaru.!
            </div>
            <div class="card card-widget">
                <div class="card-header">
                    <div class="user-block">
                        <img class="img-circle" src="{{ asset('logo.png') }}" alt="User Image">
                        <span class="username"><a href="#">Perhatian</a></span>
                        <span class="description"> Pengumuman Terkait Ujian</span>
                    </div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    {!! $pengumumanujian !!}
                </div>
            </div>
        </div>
    </div>
  </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
    <input type="text" id="edit_jenjang" class="form-control"  disabled="disable"/>
    <div id="gridtest"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="set_noinduk" id="set_noinduk" value="{{Session('noinduk')}}">
<input type="hidden" name="set_marking" id="set_marking" value="{{Session('marking')}}">

@endsection
@push('script')
    <script type="text/javascript">
        var start = new Date();
        CountDownTimer(start, 'timeremaining');
        function CountDownTimer(dt, id){
            function timer() {
                var a_p = "";
                var today = new Date();
                var curr_hour = today.getHours();
                var curr_minute = today.getMinutes();
                var curr_second = today.getSeconds();
                curr_hour = checkTime(curr_hour);
                curr_minute = checkTime(curr_minute);
                curr_second = checkTime(curr_second);
                document.getElementById(id).innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second;
                $('#setwaktumulai').val(curr_hour + ":" + curr_minute + ":" + curr_second);
            }
            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
            timer = setInterval(timer, 1000);
        }
        function openedpage( jQuery ){
            var noinduk = document.getElementById('set_noinduk').value;
            var marking	= document.getElementById('set_marking').value;
            var formdata= new FormData();
                formdata.set('set01', noinduk);
                formdata.set('set02', 'cariujian');
                formdata.set('set03', marking);
                formdata.set('_token', '{{ csrf_token() }}');
            $.ajax({
                url         : '{{ route("jsonaktiftest") }}',
                data        : formdata,
                type        : 'POST',
                contentType : false,
                processData : false,
                success: function (data) {
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    generatelist        = '<ul class="products-list product-list-in-card pl-2 pr-2">';
                    states              = ['info', 'primary', 'warning', 'info', 'primary', 'secondary'];
                    if (data.data){
                        for(i=0;i<data.data.length;i++){
                            stateNum    = Math.floor(Math.random() * 6);
                            state       = states[stateNum];
                            status      = data.data[i].status;
                            id          = data.data[i].id;
                            mulai       = data.data[i].mulai;
                            akhir       = data.data[i].akhir;
                            timer       = data.data[i].timer;
                            jennilai    = data.data[i].jennilai;
                            matpel      = data.data[i].matpel;
                            if (status == '1' || status == '9'){
                                var btnmulai    = '<a class="product-title" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Mulai Ujian" onClick="btnmulaiUjian('+id+')">'+matpel+'<span class="badge badge-success float-right"><i class="fa fa-flag-checkered"></i> Mulai</span></a>';
                            } else {
                                var btnmulai    = '<a class="product-title" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Mulai Ujian">'+matpel+'<span class="badge badge-danger float-right"><i class="fa fa-flag"></i> Selesai</span></a>';
                            }
                            generatelist = generatelist+'<li class="item">'+
                                    '<div class="product-img"><img src="mascot.png" alt="Profil" class="img-circle img-size-32 mr-2"></div>'+
                                    '<div class="product-info">'+btnmulai+
                                        '<span class="product-description">'+
                                            'Terjadwal Mulai '+mulai+' s/d '+akhir+'<br />'+
                                            'Waktu : '+timer+' menit'+
                                        '</span>'+
                                    '</div>'+
                                '</li>';
                        }
                        
                    }
                    generatelist = generatelist+'</ul>';
                    $('#listujian').html(generatelist);
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
        function btnmulaiUjian(id){
            var noinduk = document.getElementById('set_noinduk').value;
            $("html, body").animate({ scrollTop: 0 }, "slow");
            var formdata = new FormData();
                formdata.set('noinduk',noinduk);
                formdata.set('val01',id);
                formdata.set('val02','cekmulai');
                formdata.set('_token', '{{ csrf_token() }}');
            url='{{ route("aktifet") }}';
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
                    var status       = response.status;
                    if (status == 'OK'){
                        $('#setdurasimulai').val(response.timer);
                        $('#setmarkingmulai').val(response.marking);
                        $('#divawal').hide();
                        $('#divmulai').show();
                    } else if (status == 'LANGSUNGSTART'){

                    } else if (status == 'KELEWAT'){
                        swal({
                            title   : 'Ujian Di Tutup',
                            text    : 'Ujian yang sudah di selesaikan dan di stop pengawas tidak bisa dibuka kembali',
                            type    : 'info',
                        });
                    } else {
                        swal({
                            title   : 'STOP',
                            text    : 'Ujian dengan ID '+id+' Tidak di Temukan',
                            type    : 'error',
                        });
                    }
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
        $(document).ready(function () {
            openedpage();
            $('#divawal').show();
            $('#divmulai').hide();
            $("#setwaktubutton").click(function(){ 
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData();
                    formdata.set('val03', document.getElementById('setwaktumulai').value);
                    formdata.set('val01', document.getElementById('setmarkingmulai').value);
                    formdata.set('val02','setwaktuujianmandiri');
                    formdata.set('_token', '{{ csrf_token() }}');
                url='{{ route("aktifet") }}';
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
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        var set03	= 'ujiancbt';
                        setTimeout(function () { 
                            window.location.href = set03;
                        }, 2000);
                        swal({
                            title	: 'Preaparing....',
                            text	: response.message,
                            type	: 'info',
                        })
                        return false;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title: textStatus,
                            text:  jqXHR.responseText,
                            type: 'danger',
                        });
                    }
                });
            });
        });
    </script>
@endpush