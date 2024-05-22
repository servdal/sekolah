@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
        </div>
      </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row" >
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link navlinkother active" href="#depan" data-toggle="tab">Latest News</a></li>
                                <li class="nav-item"><a class="nav-link navlinkother" href="#formonline" data-toggle="tab">Pendaftaran</a></li>
                                <li class="nav-item"><a class="nav-link navlinkother" href="#telemedicine" data-toggle="tab">Login</a></li>
                                <li class="nav-item"><a class="nav-link navlinkbukutamu" href="#aboutme" data-toggle="tab">Buku Tamu</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="loading">
								<img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
							</div>
                            <div class="tab-content" id="divawal">
                                <div class="active tab-pane" id="depan">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card-body box-profile bg-danger">
                                                <div class="text-center">
                                                    <a href="ppdb?id=1" target="_blank"><img src="ppdb-sdtq.png" alt="User profile picture" width="100%" height="60"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card-body box-profile bg-success">
                                                <div class="text-center">
                                                    <a href="https://mataba.sdtq-daarulukhuwwah.sch.id" target="_blank"><img src="https://mataba.sdtq-daarulukhuwwah.sch.id/header.png" alt="User profile picture" width="100%"  height="60"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card-body box-profile bg-info">
                                                <div class="text-center">
                                                    <a href="https://sdtq-daarulukhuwwah.sch.id:2096/cpsess2051834714/3rdparty/roundcube/" target="_blank"><img src="https://sdtq-daarulukhuwwah.sch.id:2096/cPanel_magic_revision_1705947650/unprotected/cpanel/images/webmail-logo.svg" alt="User profile picture" width="100%"  height="60"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="timeline">
                                                @if(isset($pengumumans) && !empty($pengumumans))
                                                    @foreach($pengumumans as $pengumuman)
                                                        <div class="time-label">
                                                            <span class="bg-{{ $pengumuman['urutanwerno'] }}"> {!! $pengumuman['tanggal'] !!}</span>
                                                        </div>
                                                        <div>
                                                            <i class="{{ $pengumuman['jenis'] }} bg-{{ $pengumuman['urutanwerno'] }}"></i>
                                                            <div class="timeline-item">
                                                                <span class="time"><i class="fa fa-clock"></i> {{ $pengumuman['kapan'] }}</span>
                                                                <h3 class="timeline-header">{!! $pengumuman['siapa'] !!}</h3>
                                                                <div class="timeline-body">
                                                                    {!! $pengumuman['pengumuman'] !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="time-label">
                                                        <span class="bg-primary"> {{ date("Y-m-d H:i:s") }}</span>
                                                    </div>
                                                    <div>
                                                        <i class="fa fa-android bg-primary"></i>
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fa fa-clock"></i> now</span>
                                                            <h3 class="timeline-header">Welcome to</h3>
                                                            <div class="timeline-body">
                                                                <h2>{{ config('global.Title2') }}</h2>
                                                                <h5>{{ config('global.sekolah') }}</h5>
                                                                <strong>{{ config('global.alamat') }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div>
                                                    <i class="fa fa-clock-o bg-gray"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="formonline">
                                    <div class="form-horizontal" id="divisian">
                                        <p class="login-box-msg">
                                            <b><font color="blue" size="+2"> Lengkapi formulir berikut untuk mendaftar</font></b>
                                        </p>
                                        <div class="form-group row">
                                            <label for="daftar_nama" class="col-sm-4 col-form-label">Nama <span class="text-danger">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="daftar_nama" name="daftar_nama">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="daftar_ktp" class="col-sm-4 col-form-label">No.KTP<span class="text-danger">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="daftar_ktp" name="daftar_ktp">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="id_universitas" class="col-sm-4 col-form-label">Alamat<span class="text-danger">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="id_universitas"  id="id_universitas" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="daftar_email" class="col-sm-4 col-form-label">Email <span class="text-danger">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="email" name="daftar_email"  id="daftar_email" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="daftar_hape" class="col-sm-4 col-form-label">No Telp / HP (WA) <span class="text-danger">*</span>:</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="daftar_hape"  id="daftar_hape" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="social-auth-links text-center">
                                            <input type="hidden" id="daftar_idne" value="new">
                                            <input type="hidden" id="id_fakultas" value="{!!$kode_sekolah!!}">
                                            <input type="hidden" id="id_fakpanjang" value="{!!$nama_sekolah!!}">
                                            <a id="btn-pendaftaranortu" href="#" class="btn btn-social btn-primary pull-right">
                                                <i class="fa fa-unlock-alt"></i> Daftarkan
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-horizontal" id="divterimakasih">
                                        <div class="card card-danger">
                                            <div class="card-header">
                                                <h3 class="card-title" id="status">Terkini</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" id="btncloseterimakasi">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <span id="pesan"><font color="blue">Silahkan Melanjutkan ke Email Anda Untuk Aktivasi</font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="telemedicine">
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-4 col-form-label">Email <span class="text-danger">*</span>:</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="username" id="username" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="login_password"  class="col-md-4 col-lg-4 col-form-label">Password <span class="text-danger">*</span>:</label>
                                        <div class="col-lg-8 col-md-8">
                                            <input type="password" name="password" id="login_password" class="form-control" onkeyup="submitForm(event)" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a id="btnlupapassword" href="#" class="btn btn-social btn-danger pull-left">
                                            <i class="fa fa-refresh"></i> I Forgot My Password
                                        </a>
                                        <a id="btnlogin" href="#" class="btn btn-social btn-primary pull-right">
                                            <i class="fa fa-unlock-alt"></i> Sign In
                                        </a>
                                    </div>
                                    <div class="form-horizontal" id="divlupapassword">
                                        <div class="card card-danger">
                                            <div class="card-header">
                                                <h3 class="card-title">Tuliskan Email Yang Telah di Daftarkan</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label for="lupa_email" class="col-sm-4 col-form-label">Email <span class="text-danger">*</span>:</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" name="lupa_email" id="lupa_email" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a id="btnkelogin" href="#" class="btn btn-social btn-danger pull-left">
                                                    <i class="fa fa-refresh"></i> Kembali ke laman login
                                                </a>
                                                <a id="btnkirimemail" href="#" class="btn btn-social btn-primary pull-right">
                                                    <i class="fa fa-unlock-alt"></i> Kirim Password ke Email
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="aboutme">
                                    <div class="card card-widget widget-user-2">
                                        <div class="widget-user-header bg-primary">
                                            <div class="widget-user-image">
                                                <img class="img-circle elevation-2" src="mascot.png" alt="User Avatar">
                                            </div>
                                            <h3 class="widget-user-username">Silahkan Bapak/Ibu Mengisi Buku Tamu</h3>
                                            <h5 class="widget-user-desc">{{ $nama_sekolah }}</h5>
                                        </div>
                                    </div>
                                    <div class="card card-info shadow" id="divawalbukutamu">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="#" class="btn btn-block btn-social btn-danger" id="btnisibukutamu">
                                                    <i class="fa fa-users"></i>Isi Buku Tamu
                                                </a>
                                                <div id="griddaftartamu"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-primary shadow" id="divpencarian">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <a href="#" class="btn btn-block btn-social btn-danger" id="btnkembalidrlaporan">
                                                                <i class="fa fa-reply-all"></i>Tutup
                                                            </a>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a href="#" class="btn btn-block btn-social btn-success" id="btnexport">
                                                                <i class="fa fa-save"></i> Export
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="gridpencarian"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-warning shadow" id="divlihat">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <img id="lihat_img" style="margin:2px; margin-left: 10px;" width="100%" src="logo.png">
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label for="lihat_nama">Nama Lengkap:</label>
                                                        <input type="text" id="lihat_nama" name="lihat_nama" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lihat_instansi">Asal Unit Kerja / Instansi :</label>
                                                        <input type="text" id="lihat_instansi" name="lihat_instansi" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lihat_pejabat">Menemui</label>
                                                        <input type="text" id="lihat_pejabat" name="lihat_pejabat" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lihat_keperluan">Keperluan :</label>
                                                        <textarea id="lihat_keperluan" name="lihat_keperluan" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <label for="lihat_email">Email :</label>
                                                            <input type="text" id="lihat_email" name="lihat_email" class="form-control">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="lihat_hape">HP :</label>
                                                            <input type="text" id="lihat_hape" name="lihat_hape" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <input type="hidden" id="lihat_tombol">
                                                            <a href="#" class="btn btn-block btn-social btn-info btnkembalidrlihat">
                                                                <i class="fa fa-reply-all"></i>Tutup
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-success shadow" id="divisi">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="bk_nama">Nama Lengkap:</label>
                                                <input type="text" id="bk_nama" name="bk_nama" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="bk_instansi">Asal Unit Kerja / Instansi / Alamat:</label>
                                                <input type="text" id="bk_instansi" name="bk_instansi" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="bk_pejabat">Menemui</label>
                                                <input type="text" id="bk_pejabat" name="bk_pejabat" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="bk_keperluan">Keperluan :</label>
                                                <textarea id="bk_keperluan" name="bk_keperluan" style="width: 100%; height: 200px; font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="bk_email">Email :</label>
                                                    <input type="text" id="bk_email" name="bk_email" class="form-control">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="bk_hape">HP :</label>
                                                    <input type="text" id="bk_hape" name="bk_hape" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <a href="#" class="btn btn-block btn-social btn-info btnkembalidrlihat">
                                                        <i class="fa fa-reply-all"></i>Cancel
                                                    </a>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a href="#" class="btn btn-block btn-social btn-primary" id="btnsimpanbukutamu">
                                                        <i class="fa fa-calendar-plus-o"></i>Isi Buku Tamu
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-primary card-outline nonbukutamu">
                        <div class="card-body box-profile bg-primary">
                            <div class="text-center">
                                <img src="{{ url('').'/'.$frontpage }}" alt="User profile picture" width="100%">
                            </div>
                        </div>
                        <div class="card-body">
                            <strong><i class="fa fa-book mr-1"></i> Website</strong>
                            <p class="text-muted"><a href="{!! $domain !!}" target="_blank">{!! $domain !!}</a></p>
                            <hr>
                            <strong><i class="fa fa-phone mr-1"></i> Alamat</strong>
                            <p class="text-muted"> {!! $alamat !!}</p>
                            <hr>
                            <strong><i class="fa fa-envelope mr-1"></i> Email</strong>
                            <p class="text-muted">{!! $email !!}</p>
                        </div>
                        @if (isset($qrcode))
                        <div class="card-body">
                            <img src="data:image/png;base64,{!! $qrcode !!}" width="100%" />
                        </div>
                        @endif
                    </div>
                    <div class="card card-danger card-outline bukutamu">
                        <div class="card-body box-profile bg-primary">
                            <div class="text-center">
                                <img src="{{ url('').'/'.$frontpage }}" alt="User profile picture" width="100%">
                            </div>
                        </div>
                        <div class="card-body">
                            <h3 class="box-title">Generate Report</h3>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <select id="cekbln" class="form-control">
                                            <option value="ALL">ALL</option>
                                            <option value="01">Jan</option>
                                            <option value="02">Feb</option>
                                            <option value="03">Mar</option>
                                            <option value="04">Apr</option>
                                            <option value="05">May</option>
                                            <option value="06">Jun</option>
                                            <option value="07">Jul</option>
                                            <option value="08">Aug</option>
                                            <option value="09">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="cekthn" value="{{ date('Y') }}">
                                    </div>
                                    <div class="col-lg-3">
                                        <button class="btn btn-warning btn-flat" type="button" id="btnviewdata">View</button>
                                    </div>	
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h3 class="box-title">Statistik Hari Ini</h3>
                            <div class="text-center">
                                <div id="timeremaining"></div>
                            </div>
                            <a href="bukutamuadmin" class="btn btn-block btn-social btn-warning">
                                <i class="fa fa-globe"></i> Refresh
                            </a>
                            <div id="gridrekap"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
    <input type="text" name="id_fakultasasal"  id="id_fakultasasal" class="form-control" value="-"/>
    <img id="preview" style="margin:2px; margin-left: 10px;" width="100%" src="logo.png">
    <input type="file" id="addfile" style="display: none;"/>
    <a href="#" class="btn btn-block btn-social btn-twitter" id="btnambilfoto">
        <i class="fa fa-file-image-o"></i>Ambil Foto
    </a>
    <input type="hidden" name="id_sekolah" id="id_sekolah" value="{{$id_sekolah}}">
    <input type="hidden" name="firebaseid" id="firebaseid" value="{{$firebaseid}}">

</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
        $('.select2').select2({width: '100%'});
        CKEDITOR.env.isCompatible = true;
        CKEDITOR.replace( 'bk_keperluan', {
            toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
            removeButtons: 'Strike',
            width: '100%',
            height: 45	
        });
        CKEDITOR.replace( 'lihat_keperluan', {
            toolbarGroups: [{"name":"basicstyles","groups":["basicstyles"]}],
            removeButtons: 'Strike',
            width: '100%',
            height: 45	
        });
    });
    function submitForm(e) {
        var keyCode = e.keyCode ? e.keyCode : e.which;
        if (keyCode == 13){
            $('#btnlogin').click();
        }
    }
    $(document).ready(function() {
        $('#loading').hide();
        $('#divlupapassword').hide();
        $('#divterimakasih').hide();
        $('.rujukan').hide();
        $('.nonbukutamu').show();
        $('.bukutamu').hide();
        $('.navlinkother').click(function () {
            $('.nonbukutamu').show();
            $('.bukutamu').hide();
        });
        $('.navlinkbukutamu').click(function () {
            $('.nonbukutamu').hide();
            $('.bukutamu').show();
            $('#divawalbukutamu').show();
            $('#divisi').hide();
            $('#divpencarian').hide();
            $('#divlihat').hide();
            var set01=document.getElementById('id_sekolah').value;
            var token=document.getElementById('token').value;
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'pejabat', type: 'text'},	
                    { name: 'jumlah', type: 'text'},
                ],
                type: 'POST',
                data: {val01: set01, _token: token},
                url: 'tamu/rekaptamu',
            };
            var datajrekap = new $.jqx.dataAdapter(source);
            $("#gridrekap").jqxGrid({
                width: '100%',
                columnsresize: true,
                autoheight: true,
                sortable: true,
                pageable: true,
                source: datajrekap,
                theme: "orange",
                columns: [
                    { text: 'Pejabat', datafield: 'pejabat', width: '80%', cellsalign: 'left', align: 'center'},
                    { text: 'Jumlah', datafield: 'jumlah', width: '20%', cellsalign: 'center', align: 'center'},
                ],
            });
            var sourcetamu = {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'nama'},
                    { name: 'instansi', type: 'text'},
                    { name: 'pejabat', type: 'text'},
                    { name: 'keperluan', type: 'text'},
                    { name: 'hape', type: 'text'},
                    { name: 'email', type: 'text'},
                    { name: 'tanggal', type: 'text'},
                    { name: 'foto', type: 'text'},
                ],
                type: 'POST',
                data: {val01: set01, _token: token},
                url: 'tamu/bukutamu',
            };
            var datajtamu = new $.jqx.dataAdapter(sourcetamu);
            var photorenderer = function (row, column, value) {
                var foto 		= $('#griddaftartamu').jqxGrid('getrowdata', row).foto;
                var nama 		= $('#griddaftartamu').jqxGrid('getrowdata', row).nama;
                var instansi 	= $('#griddaftartamu').jqxGrid('getrowdata', row).instansi;
                var pejabat 	= $('#griddaftartamu').jqxGrid('getrowdata', row).pejabat;
                var keperluan 	= $('#griddaftartamu').jqxGrid('getrowdata', row).keperluan;
                var hape 		= $('#griddaftartamu').jqxGrid('getrowdata', row).hape;
                var email 		= $('#griddaftartamu').jqxGrid('getrowdata', row).email;
                
                if (foto == ''){
                    var foto = 'logo.png';					
                }
                var img = '<div style="background: white;"><a href="#" id1="'+foto+'" id2="'+nama+'" id3="'+instansi+'"  id4="'+pejabat+'" id5="'+keperluan+'" id6="'+hape+'" id7="'+email+'" class="lihat"><img style="margin:2px; margin-left: 10px;" width="50" height="50" src="' + foto + '"></a></div>';
                        
                return img;
            }
            $("#griddaftartamu").jqxGrid({
                width: '100%',
                height: '600',
                rowsheight: 50,
                filterable: true,
                showfilterrow: true,
                columnsresize: true,
                pageable: false,
                source: datajtamu,
                theme: "energyblue",
                rendered: function () {
                    $( ".lihat" ).click( function () {
                        var valfoto			= $(this).attr('id1');
                        var valnama			= $(this).attr('id2');
                        var valinstansi		= $(this).attr('id3');
                        var valpejabat		= $(this).attr('id4');
                        var valkeperluan	= $(this).attr('id5');
                        var valhape			= $(this).attr('id6');
                        var valemail		= $(this).attr('id7');
                        $('#lihat_img').attr('src',valfoto);
                        $("#lihat_nama").val(valnama);
                        $("#lihat_instansi").val(valinstansi);
                        $("#lihat_email").val(valemail);
                        $("#lihat_hape").val(valhape);
                        $("#lihat_pejabat").val(valpejabat);
                        $("#lihat_tombol").val('awal');
                        CKEDITOR.instances['lihat_keperluan'].setData(valkeperluan)
                        $('#divisi').hide();
                        $('#divpencarian').hide();
                        $('#divawal').hide();
                        $('#divlihat').show();
                    });
                },
                columns: [					
                    { text: 'Photo', editable: false, sortable: false, filterable: false,  width: '8%', cellsrenderer: photorenderer },
                    { text: 'Tanggal', datafield: 'tanggal', filtertype: 'checkedlist', width: '15%', cellsalign: 'left', align: 'center'  },
                    { text: 'Menemui', filtertype: 'checkedlist', datafield: 'pejabat', width: '17%', cellsalign: 'left', align: 'center'  },
                    { text: 'Keperluan', datafield: 'keperluan', width: '20%', cellsalign: 'left', align: 'center'  },
                    { text: 'Nama', datafield: 'nama', width: '20%', cellsalign: 'left', align: 'center'  },
                    { text: 'Asal Unit Kerja / Instansi', datafield: 'instansi', width: '20%', cellsalign: 'left', align: 'center'  },
                ],
            });
        });
        $('#btnviewdata').click(function () {
            var set01=document.getElementById('cekthn').value;
            var set02=document.getElementById('cekbln').value;
            var set03=document.getElementById('id_sekolah').value;
            var token=document.getElementById('token').value;
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'id'},
                    { name: 'nama'},
                    { name: 'instansi', type: 'text'},
                    { name: 'pejabat', type: 'text'},
                    { name: 'keperluan', type: 'text'},
                    { name: 'hape', type: 'text'},
                    { name: 'email', type: 'text'},
                    { name: 'tanggal', type: 'text'},
                    { name: 'foto', type: 'text'},
                ],
                type: 'POST',
                data: {val01: set01, val02: set02, val03: set03, _token: token},
                url: 'tamu/carilaptamu',
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            var gambartamu = function (row, column, value) {
                var foto 		= $('#gridpencarian').jqxGrid('getrowdata', row).foto;
                var nama 		= $('#gridpencarian').jqxGrid('getrowdata', row).nama;
                var instansi 	= $('#gridpencarian').jqxGrid('getrowdata', row).instansi;
                var pejabat 	= $('#gridpencarian').jqxGrid('getrowdata', row).pejabat;
                var keperluan 	= $('#gridpencarian').jqxGrid('getrowdata', row).keperluan;
                var hape 		= $('#gridpencarian').jqxGrid('getrowdata', row).hape;
                var email 		= $('#gridpencarian').jqxGrid('getrowdata', row).email;
                if (foto == ''){
                    var foto = 'logo.png';
                }
                var img = '<div style="background: white;"><a href="#" id1="'+foto+'" id2="'+nama+'" id3="'+instansi+'"  id4="'+pejabat+'" id5="'+keperluan+'" id6="'+hape+'" id7="'+email+'" class="lihat"><img style="margin:2px; margin-left: 10px;" width="50" height="50" src="' + foto + '"></a></div>';
                        
                return img;
            }
            $('#divpencarian').show();
            $('#divisi').hide();
            $('#divlihat').hide();
            $("#gridpencarian").jqxGrid({
                width: '100%',
                height: 480,
                rowsheight: 50,
                pageable: false,
                autoheight: true,
                filterable: true,
                source: dataAdapter,
                columnsresize: true,
                showfilterrow: true,
                theme: "energyblue",
                altrows: true,
                sortable: true,
                selectionmode: 'singlecell',
                rendered: function () {
                    $( ".lihat" ).click( function () {
                        var valfoto			= $(this).attr('id1');
                        var valnama			= $(this).attr('id2');
                        var valinstansi		= $(this).attr('id3');
                        var valpejabat		= $(this).attr('id4');
                        var valkeperluan	= $(this).attr('id5');
                        var valhape			= $(this).attr('id6');
                        var valemail		= $(this).attr('id7');
                        $('#lihat_img').attr('src',valfoto);
                        $("#lihat_nama").val(valnama);
                        $("#lihat_instansi").val(valinstansi);
                        $("#lihat_email").val(valemail);
                        $("#lihat_hape").val(valhape);
                        $("#lihat_pejabat").val(valpejabat);
                        $("#lihat_tombol").val('cari');
                        CKEDITOR.instances['lihat_keperluan'].setData(valkeperluan)
                        $('#divisi').hide();
                        $('#divpencarian').hide();
                        $('#divawal').hide();
                        $('#divlihat').show();
                    });
                },
                columns: [					
                    { text: 'Photo', editable: false, sortable: false, filterable: false,  width: '10%', cellsrenderer: gambartamu },
                    { text: 'Tanggal', datafield: 'tanggal', filtertype: 'checkedlist', width: '15%', cellsalign: 'left', align: 'center'  },
                    { text: 'Menemui', filtertype: 'checkedlist', datafield: 'pejabat', width: '25%', cellsalign: 'left', align: 'center'  },
                    { text: 'Keperluan', datafield: 'keperluan', width: '20%', cellsalign: 'left', align: 'center'  },
                    { text: 'Nama', datafield: 'nama', width: '25%', cellsalign: 'left', align: 'center'  },
                    { text: 'Asal Unit Kerja / Instansi', datafield: 'instansi', width: '15%', cellsalign: 'left', align: 'center'  },
                    { text: 'Email', datafield: 'email', width: '10%', cellsalign: 'left', align: 'center'  },
                    { text: 'Handphone', datafield: 'hape', width: '10%', cellsalign: 'left', align: 'center'  },				
                ],
            });
        });
        $('#btnisibukutamu').click(function () {
            $('#divawalbukutamu').hide();
            $('#divpencarian').hide();
            $('#divisi').show();
            $('#divlihat').hide();
        });
        $('.btnkembalidrlihat').click(function () {
            var set01=document.getElementById('lihat_tombol').value;
            if (set01 == 'cari'){
                $('#divawalbukutamu').hide();
                $('#divpencarian').show();
            } else {
                $('#divawalbukutamu').show();
                $('#divpencarian').hide();
            }
            $('#divisi').hide();
            $('#divlihat').hide();
        });
        $("#btnsimpanbukutamu").click(function(){
            var set01 	= document.getElementById('addfile');
            var set02	= document.getElementById('bk_nama').value;
            var set03	= document.getElementById('bk_instansi').value;
            var set04	= document.getElementById('bk_pejabat').value;
            var set05	= CKEDITOR.instances['bk_keperluan'].getData();
            var set06	= document.getElementById('bk_email').value;
            var set07	= document.getElementById('bk_hape').value;				
            var set08	= document.getElementById('id_sekolah').value;				
            var token 	= document.getElementById('token').value;
            if (set02 == ''){ 
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Nama Lengkap Wajib di Isi',
                    type: 'info',
                });
            }
            else if (set03 == ''){ 
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Unit / Fakultas / Instansi Pemohon Belum Terisi',
                    type: 'info',
                });
            }
            else if (set04 == ''){ 
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Pejabat Yang Akan di Temui',
                    type: 'info',
                });
            }
            else if (set05 == ''){ 
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Keperluan Wajib di Isi',
                    type: 'info',
                });
            }
            else if (set07 == ''){ 
                swal({
                    title: 'Mohon lengkapi',
                    text: 'No. HP Wajib di Isi',
                    type: 'info',
                });
            }
            else {
                $('#divisi').hide();
                var form_data = new FormData();
                form_data.append('file', set01.files[0]);
                form_data.append('val02', set02);
                form_data.append('val03', set03);
                form_data.append('val04', set04);
                form_data.append('val05', set05);
                form_data.append('val06', set06);
                form_data.append('val07', set07);
                form_data.append('val08', set08);
                form_data.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: '{{ route("exbukutamu") }}',
                    data: form_data,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        var status  = data.status;
                        var message = data.message;
                        var warna 	= data.warna;
                        var icon 	= data.icon;
                        $('#divawalbukutamu').show();
                        $("#gridrekap").jqxGrid('updatebounddata');
                        $("#griddaftartamu").jqxGrid('updatebounddata');
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
                    },
                    error: function (xhr, status, error) {
                        swal({
                            title: 'Error..!!!',
                            text: xhr.responseText,
                            type: 'info',
                        });
                    }
                });
            }
        });
        $('#btnexport').click(function(){
            var gridContent = $("#gridpencarian").jqxGrid('exportdata', 'json');
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
        $('#btncloseterimakasi').click(function () {
            $('#divisian').show();
            $('#divterimakasih').hide();
        });
        $('#btnkelogin').click(function () {
            $('#formisitelemedi').show();
            $('#divlupapassword').hide();
        });
        $('#btnlupapassword').click(function () {
            $('#formisitelemedi').hide();
            $('#divlupapassword').show();
        });
        $('#btn-pendaftaranortu').click(function () {
            var set01=document.getElementById('daftar_nama').value;
            var set02=document.getElementById('daftar_ktp').value;
            var set03=document.getElementById('daftar_email').value;
            var set04=document.getElementById('daftar_hape').value;
            var set05=document.getElementById('id_sekolah').value;
            var set06=document.getElementById('id_fakpanjang').value;
            var set07=document.getElementById('firebaseid').value;
            var set08=document.getElementById('id_sekolah').value;
            var token=document.getElementById('token').value;
            if (set01 == ''){ 
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Nama Lengkap Wajib di Isi',
                    type: 'info',
                });
            } else if (set02 == ''){ 
                swal({
                    title: 'Mohon lengkapi',
                    text: 'KTP Belum Terisi',
                    type: 'info',
                });
            } else if (set03 == ''){
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Email Aktif Wajib di Isi',
                    type: 'info',
                });
            } else if (set04 == ''){ 
                swal({
                    title: 'Mohon lengkapi',
                    text: 'No. HP Wajib di Isi',
                    type: 'info',
                });
            } else {
                $('#loading').show();
                $('#divawal').hide();
                var formdata = new FormData();
                    formdata.set('val01',set01);
				    formdata.set('val02',set02);
				    formdata.set('val03',set03);
				    formdata.set('val04',set04);
					formdata.set('val05',set05);
					formdata.set('val06',set06);
					formdata.set('val07',set07);
					formdata.set('firebaseid',set07);
					formdata.set('_token',token);
                url='{{ route("exDaftarBaru") }}';
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
                        var pesan = response.message;
                        if (pesan == null || pesan == ''){
                            $('#pesan').html('Silahkan Melanjutkan ke Email Anda Untuk Aktivasi');
                        } else {
                            $('#pesan').html(response.message);
                        }
                        $('#status').html(response.status);
                        $('#divisian').hide();
                        $('#divterimakasih').show();
                        $('#loading').hide();
                        $('#divawal').show();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loading').hide();
                        $('#divawal').show();
                        swal({
                            title: textStatus,
                            text:  jqXHR.responseText,
                            type: 'info',
                        });
                    }
                });
            }
        });
        $('#btnkirimemail').click(function () {
            var set01=document.getElementById('lupa_email').value;
            var token=document.getElementById('token').value;
            if (set01 == ''){
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Email Aktif Wajib di Isi',
                    type: 'info',
                });
            } else {
                $('#loading').show();
                $('#divawal').hide();
                
                var formdata = new FormData();
                    formdata.set('val01',set01);
				    formdata.set('val02','resetpassword');
				    formdata.set('val03','');
				    formdata.set('val04','');
					formdata.set('_token',token);
                url='{{ route("exResetPassword") }}';
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
                        $('#divawal').show();
                        swal({
                            title: 'Info',
                            text:  response.message,
                            type: 'info',
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loading').hide();
                        $('#divawal').show();
                        swal({
                            title: textStatus,
                            text:  jqXHR.responseText,
                            type: 'info',
                        });
                    }
                });
            }
        });
        $('#btnlogin').click(function () {
            var set01=document.getElementById('username').value;
            var set02=document.getElementById('login_password').value;
            var set04=document.getElementById('id_fakultas').value;
            var set05=document.getElementById('firebaseid').value;
            var set06=document.getElementById('id_sekolah').value;
            var token=document.getElementById('token').value;
            if (set01 == ''){
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Email Aktif Wajib di Isi',
                    type: 'info',
                });
            } else if (set02 == ''){
                swal({
                    title: 'Mohon lengkapi',
                    text: 'Password Wajib di Isi',
                    type: 'info',
                });
            } else {
                $('#loading').show();
                $('#divawal').hide();
                var formdata = new FormData();
                    formdata.set('email',set01);
				    formdata.set('password',set02);
					formdata.set('remember','1');
                    formdata.set('fakultas',set04);
                    formdata.set('firebaseid',set05);
                    formdata.set('id_sekolah',set06);
                    formdata.set('_token',token);
                url='{{ route("exLogin") }}';
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
                        $('#divawal').show();
                        swal({
                            title: 'Success',
                            text:  'Welcome '+response.user.nama,
                            type: 'info',
                        });
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#loading').hide();
                        $('#divawal').show();
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