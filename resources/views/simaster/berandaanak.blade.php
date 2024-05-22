@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Beranda Anak</h1>
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
                <div class="col-md-12">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-success">
                            <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ url('').'/'.session('sekolah_logo') }}" alt="User Avatar">
                            </div>
                            <h3 class="widget-user-username">{!! session('sekolah_nama_yayasan') !!}</h3>
                            <h5 class="widget-user-desc">{!! session('sekolah_nama_sekolah') !!} {!! session('sekolah_kota') !!}</h5>
                        </div>
                    </div>
                    <div class="card card-primary direct-chat direct-chat-warning shadow" id="divawal">
                        <div class="card-header">
                            <h3 class="card-title">Siswa Yang Terhubung Dengan Anda</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btntambah"><i class="fa fa-plus"></i> Tambah Data Siswa</button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(Session::has('message'))
                                <div class="alert {{ Session::get('alert-class') }} alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-check"></i> {{ Session::get('status') }}</h4>
                                        {!! Session::get('message') !!}
                                </div>
                            @endif
                            <div id="griddatainduk"></div>
                        </div>
                        <div class="card-footer">
                            <div class="row pengumuman">
                                <div class="col-md-4">
                                    <div class="card card-info card-outline" >
                                        <div class="card-body box-profile bg-info">
                                            <div class="text-center"><strong><h1>Program Orangtua Asuh</h1></strong></div>
                                        </div>
                                        <div class="card-footer box-profile bg-info">
                                            Program orangtua asuh anak tidak mampu dan reward anak berprestasi adalah cara yang mudah dan efektif untuk membantu mewujudkan masa depan anak-anak sholeh dan sholehah yang lebih baik. 
                                            Mari investasikan sebagian kelapangan rezeki yang Allah berikan dengan berdonasi sebagai orangtua asuh anak sholeh dan sholehah.
                                        </div>
                                        <div class="card-footer box-profile bg-info">
                                        Dengan menjadi seorang orangtua asuh anak sholeh dan sholehah, Anda turut berkontribusi terhadap pengembangan jangka panjang untuk membantu anak sholeh dan sholehah melalui program pendidikan.
                                        </div>
                                        <div class="card-footer box-profile bg-info">
                                        Anda dapat melakukan donasi mulai dari Rp. 100.000,- per bulan. Donasi yang Anda berikan tidak kami berikan langsung secara tunai kepada anak, namun kami kemas dalam bentuk program pendidikan anak.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-warning card-outline" >
                                        <div class="card-body box-profile bg-warning">
                                            <div class="text-center"><strong><h1>Bagaimana cara menjadi orangtua asuh</h1></strong></div>
                                        </div>
                                        <div class="card-footer box-profile bg-warning">
                                            <ol>
                                                <li>Pada layar di samping, terdapat list anak-anak tidak mampu yang belum memiliki orang tua asuh. Silahkan pilih anak-anak yang ingin Bapak/Ibu bantu</li>
                                                <li>Tombol Profil, berguna bagi bapak ibu yang ingin melihat sepintas terkait perkembangan studinya di {!! session('sekolah_nama_sekolah') !!} </li>
                                                <li>Apabila Bapak/Ibu telah menentukan anak yang akan di bantu, silahkan klik tombol ajukan permohonan</li>
                                                <li>Pihak admin akan melakukan klarifikasi dan menghubungi Bapak/Ibu</li>
                                                <li>Anak yang telah dipilih Bapak/Ibu akan muncul di tabel diatas sebagai bagian dari Tanggung Jawab Bapak/Ibu dalam hal pendidikan Anak tersebut di {!! session('sekolah_nama_sekolah') !!}</li>
                                                <li>Apabila Bapak/Ibu suatu saat tidak lagi ingin meneruskan program ini, silahkan ajukan pembatalan di tabel di atas</li>
                                                <li>Pihak admin akan mengubungi Bapak/Ibu untuk klarfikasi</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-success shadow" >
                                        <div class="card-body row" id="timeline">
                                            <div class="col-md-12">
                                                <!-- The time line -->
                                                <div class="timeline">
                                                    <div class="time-label">
                                                        <span class="bg-primary"> Daftar Anak Asuh</span>
                                                    </div>
                                                    <div>
                                                        @if(isset($anakasuh) && !empty($anakasuh))
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach($anakasuh as $rows)
                                                                    <i class="fa fa-plane bg-primary"></i>
                                                                    <div class="timeline-item">
                                                                        <span class="time"><i class="fa fa-clock"></i> {{ $rows['tamasuk'] }}</span>
                                                                        <h3 class="timeline-header">{!! $rows['nama'] !!}</h3>
                                                                        <div class="timeline-body">
                                                                            <div class="card-body">
                                                                                <div class="attachment-block clearfix">
                                                                                    @if ($rows['foto'] == '')
                                                                                        <img class="attachment-img" src="dist/img/foto/{{$rows['foto']}}" alt="Attachment Image">
                                                                                    @else
                                                                                        <img class="attachment-img" src="mascot.png" alt="Attachment Image">
                                                                                    @endif
                                                                                    <div class="attachment-pushed">
                                                                                        <h4 class="attachment-heading"><a class="btnprofil" href="javascript:;" data-id="{{$rows['noinduk']}}" data-foto="{{$rows['foto']}}">Profil</a></h4>
                                                                                        <div class="attachment-text">
                                                                                            <font size="1">{!! $rows['tmplahir'] !!}, {!! $rows['tgllahir'] !!} ( {!! $rows['kelamin'] !!} )<br />
                                                                                            {!! $rows['alamatortu'] !!}<br />
                                                                                            Ayah : {!! $rows['namaayah'] !!} ( {!! $rows['kerjaayah'] !!} )<br />
                                                                                            Ibu : {!! $rows['namaibu'] !!} ( {!! $rows['kerjaibu'] !!} )</font>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <button type="button" class="btn btn-default btn-sm"><a class="btnpengajuan" href="javascript:;" data-noinduk="{{$rows['noinduk']}}" data-id="{{$rows['id']}}"><i class="text-danger fa fa-heart"></i> Ajukan Permohonan Orang Tua Asuh</a></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            @endforeach
                                                        @else
                                                            <i class="fa fa-plane bg-primary"></i>
                                                            <div class="timeline-item">
                                                                <span class="time"><i class="fa fa-clock"></i> now</span>
                                                                <h3 class="timeline-header">Alhamdulillah</h3>
                                                                <div class="timeline-body">
                                                                    Semua anak asuh telah memiliki orang tua asuh, Bapak/Ibu silahkan mengikuti program-program kami yang lain
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <i class="fa fa-clock-o bg-gray"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="formtambah">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>No.Induk *)</label>
                                        <input type="text" id="add_noinduk" name="add_noinduk" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="edit_tgllahir">Tgl.Lahir</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input value="{{date('Y-m-d')}}" type="text" class="form-control" id="add_tgllahir" name="add_tgllahir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>		  
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="button" class="btn btn-primary btn-lg btn-block" id="btnsimpandata">Simpan</button>
						            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-info shadow" id="divediting">
                        <div class="card-header">
                            <h3 class="card-title">Editor Data Siswa</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <form id="kt_form" enctype="multipart/form-data">
						<div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>TAPEL Diterima *)</label>
                                        <input type="text" id="edit_tahun" name="edit_tahun" class="form-control" readonly="readonly">
                                    </div> 
                                    <div class="col-lg-4">
                                        <label>Kelas Umum</label>
                                        <input type="number" min="1" max="12" id="edit_kelas" name="edit_kelas" class="form-control" readonly="readonly">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Kelas Al Quran</label>
                                        <input type="number" min="1" max="7" id="edit_jilid" name="edit_jilid" class="form-control" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <label for="edit_nama">Nama Siswa *)</label>
                                        <div class="input-group">
                                            <input type="text" id="edit_nama" name="edit_nama" class="form-control" readonly="readonly">			  
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-user-plus"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <label for="edit_kelamin">Panggilan</label>
                                        <div class="input-group">
                                            <input type="text" id="edit_panggilan" name="edit_panggilan" class="form-control" placeholder="Nama Panggilan">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-microphone"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <label for="edit_karakter">Karakter Anak</label>
                                        <div class="input-group">
                                            <input type="text" id="edit_karakter" name="edit_karakter" class="form-control" readonly="readonly">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-smile-o"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <label for="edit_gayabelajar">Gaya Belajar</label>
                                        <div class="input-group">
                                            <select id="edit_gayabelajar" name="edit_gayabelajar" class="form-control" readonly="readonly">
                                                <option value="Auditorial">Auditorial</option>
                                                <option value="Visual">Visual</option>
                                                <option value="Kinestetik">Kinestetik</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-pencil-square-o"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>NIK Siswa *)</label>
                                        <input type="text" id="edit_nik" name="edit_nik" class="form-control" readonly="readonly">			  
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="edit_tmplahir">Tempat lahir</label>
                                        <input type="text" id="edit_tmplahir" name="edit_tmplahir" class="form-control" readonly="readonly">
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <label for="edit_tgllahir">Tgl.Lahir</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input value="{{date('Y-m-d')}}" type="text" class="form-control" id="edit_tgllahir" name="tanggallahir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask readonly="readonly"/>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <label for="edit_kelamin">Kelamin</label>
                                        <div class="input-group">
                                            <select id="edit_kelamin" name="edit_kelamin" class="form-control" readonly="readonly">
                                                <option value="L">Laki-Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-users"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label>Tinggi Badan</label>
                                        <input type="text" id="edit_tinggi" name="edit_tinggi" class="form-control" placeholder="Tinggi Badan">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Berat Badan</label>
                                        <input type="text" id="edit_berat" name="edit_berat" class="form-control" placeholder="Berat Badan">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Golongan Darah</label>
                                        <select id="edit_darah" name="edit_darah" class="form-control" >
                                            <option value="-">Tidak Tahu</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                            <option value="O">O</option>
										</select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Agama *)</label>
                                        <select id="id_agama" name="id_agama" class="form-control" >
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katholik">Katholik</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Konghuchu">Konghuchu</option>
                                        </select>
                                    </div>
                                </div>			  
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label>Nama Ayah *)</label>
                                        <input type="text" id="edit_ayah" name="edit_ayah" class="form-control" placeholder="Ayah"  readonly="readonly">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Pendidikan Terakhir Ayah</label>
                                        <input type="text" id="id_payah" name="id_payah" class="form-control" placeholder="Pendidikan Ayah" readonly="readonly">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Pekerjaan Ayah</label>
                                        <select id="edit_kayah" name="edit_kayah" class="form-control" >
										 	<option value="Tidak Bekerja">Tidak Bekerja</option>
											<option value="01 Pedagang">Buruh</option>
											<option value="02 Karyawan Swasta">Karyawan Swasta</option>
											<option value="03 Nelayan">Nelayan</option>
											<option value="04 Pedagang Besar">Pedagang Besar</option>
										  	<option value="05 Pedagang Kecil">Pedagang Kecil</option>
											<option value="06 Pensiunan">Pensiunan</option>
											<option value="07 Petani">Petani</option>
											<option value="08 Peternak">Peternak</option>
											<option value="09 PNS/TNI/Polri">PNS/TNI/POLRI</option>
											<option value="10 Sudah Meninggal">Sudah Meninggal</option>
											<option value="11 Tenaga Kerja Indonesia">Tenaga Kerja Indonesia</option>
										  	<option value="12 Tidak bekerja">Tidak bekerja</option>
											<option value="13 Pedagang">Tidak dapat diterapkan</option>
										  	<option value="14 Wiraswasta">07 Wiraswasta</option>
										  	<option value="15 Wirausaha">07 Wirausaha</option>
										</select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Penghasilan Perbulan Ayah</label>
                                        <select id="id_gayah" name="id_gayah" class="form-control" readonly="readonly" >
                                            <option value="rangegaji1">&lt; Rp. 500.000,00 </option>
                                            <option value="rangegaji2">Rp. 500.000,00 - Rp. 999.999,00</option>
                                            <option value="rangegaji3">Rp. 1.000.000,00 - Rp. 1.999.999,00</option>
                                            <option value="rangegaji4">Rp. 2.000.000,00 - Rp. 4.999.999,00</option>
                                            <option value="rangegaji5">Rp. 5.000.000,00 - Rp. 20Jt</option>
                                            <option value="rangegaji6">&gt; Rp. 20.000.000,00</option>
                                        </select>
                                    </div> 
                                </div>
                            </div>	
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label>Nama Ibu *)</label>
                                       <input type="text" id="edit_ibu" name="edit_ibu" class="form-control" placeholder="Ibu" readonly="readonly">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Pendidikan Terakhir Ibu</label>
                                        <input type="text" id="id_pibu" name="id_pibu" class="form-control" placeholder="Pendidikan Ibu" readonly="readonly">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Pekerjaan Ibu</label>
                                        <select id="edit_kibu" name="edit_kibu" class="form-control"  readonly="readonly">
										 	<option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
											<option value="01 Pedagang">Buruh</option>
											<option value="02 Karyawan Swasta">Karyawan Swasta</option>
											<option value="03 Nelayan">Nelayan</option>
											<option value="04 Pedagang Besar">Pedagang Besar</option>
										  	<option value="05 Pedagang Kecil">Pedagang Kecil</option>
											<option value="06 Pensiunan">Pensiunan</option>
											<option value="07 Petani">Petani</option>
											<option value="08 Peternak">Peternak</option>
											<option value="09 PNS/TNI/Polri">PNS/TNI/POLRI</option>
											<option value="10 Sudah Meninggal">Sudah Meninggal</option>
											<option value="11 Tenaga Kerja Indonesia">Tenaga Kerja Indonesia</option>
										  	<option value="12 Tidak bekerja">Tidak bekerja</option>
											<option value="13 Pedagang">Tidak dapat diterapkan</option>
										  	<option value="14 Wiraswasta">07 Wiraswasta</option>
										  	<option value="15 Wirausaha">07 Wirausaha</option>
										</select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Penghasilan Perbulan Ibu</label>
                                        <select id="id_gibu" name="id_gibu" class="form-control" readonly="readonly">
                                            <option value="rangegaji1">&lt; Rp. 500.000,00 </option>
                                            <option value="rangegaji2">Rp. 500.000,00 - Rp. 999.999,00</option>
                                            <option value="rangegaji3">Rp. 1.000.000,00 - Rp. 1.999.999,00</option>
                                            <option value="rangegaji4">Rp. 2.000.000,00 - Rp. 4.999.999,00</option>
                                            <option value="rangegaji5">Rp. 5.000.000,00 - Rp. 20Jt</option>
                                            <option value="rangegaji6">&gt; Rp. 20.000.000,00</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama dan Pekerjaan Wali (Bila ada)</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" id="edit_wali" name="edit_wali" class="form-control" placeholder="Wali (bila ada)">		  
                                    </div> 
                                    <div class="col-lg-6">
                                        <select id="edit_kwali" name="edit_kwali" class="form-control" >
										 	<option value=" ">Pilih Salah Satu</option>
											<option value="01 Pedagang">Buruh</option>
											<option value="02 Karyawan Swasta">Karyawan Swasta</option>
											<option value="03 Nelayan">Nelayan</option>
											<option value="04 Pedagang Besar">Pedagang Besar</option>
										  	<option value="05 Pedagang Kecil">Pedagang Kecil</option>
											<option value="06 Pensiunan">Pensiunan</option>
											<option value="07 Petani">Petani</option>
											<option value="08 Peternak">Peternak</option>
											<option value="09 PNS/TNI/Polri">PNS/TNI/POLRI</option>
											<option value="10 Sudah Meninggal">Sudah Meninggal</option>
											<option value="11 Tenaga Kerja Indonesia">Tenaga Kerja Indonesia</option>
										  	<option value="12 Tidak bekerja">Tidak bekerja</option>
											<option value="13 Pedagang">Tidak dapat diterapkan</option>
										  	<option value="14 Wiraswasta">07 Wiraswasta</option>
										  	<option value="15 Wirausaha">07 Wirausaha</option>
										</select>	  
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat Orang Tua/Wali *)</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" id="edit_alamat" name="edit_alamat" class="form-control" placeholder="Nama Jalan dan Nomer Rumah">	
                                    </div> 
                                    <div class="col-lg-3">
                                        <input type="text" id="edit_rt" name="edit_rt" class="form-control" placeholder="RT">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" id="edit_rw" name="edit_rw" class="form-control" placeholder="RW">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" id="edit_kel" name="edit_kel" class="form-control" placeholder="Kelurahan">	
                                    </div> 
                                    <div class="col-lg-6">
                                        <input type="text" id="edit_kec" name="edit_kec" class="form-control" placeholder="Kecamatan">
                                    </div>				
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <input type="text" id="edit_kota" name="edit_kota" class="form-control" placeholder="Kota">	
                                    </div>				  
                                    <div class="col-lg-4">
                                        <input type="text" id="edit_kodepos" name="edit_kodepos" class="form-control" placeholder="Kode POS">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>No.HP Orang Tua/Wali *)</label>
                                <input type="text" id="edit_hape" name="edit_hape" class="form-control" placeholder="No. HP">		  
                            </div>
                            <div class="form-group">
                                <label>Foto Siswa</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="file" id="edit_foto" name="edit_foto" >
                                    </div> 
                                    <div class="col-lg-6">
                                        <img id="preview" src="{{asset('dist/img/takadagambar.jpg')}}" width="150px" height="150px"/>
                                        <a href="javascript:removeImage()" class="btn btn-xs btn-facebook pull-right">
                                            <i class="glyphicon glyphicon-trash"></i> Clear Image
                                        </a>
                                    </div>				 
                                </div>			  
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>No.Induk *)</label>
                                        <input type="text" id="edit_noinduk" name="edit_noinduk" class="form-control" placeholder="No. Induk" readonly="readonly">
                                    </div> 
                                    <div class="col-lg-4">
                                        <label>No.NISN</label>
                                        <input type="text" id="edit_nisn" name="edit_nisn" class="form-control" placeholder="No. NISN" readonly="readonly">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Set Sebagai Anak Asuh.?</label>
                                        <select id="edit_isasuh" name="edit_isasuh" class="form-control" readonly="readonly">
											<option value="0">Tidak</option>
											<option value="1">Ya</option>
										</select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Asal TK/TA/RA</label>
                                <input type="text" id="edit_asal" name="edit_asal" class="form-control" readonly="readonly">		  
                            </div>
                            <div class="form-group">
                                <label>Asal SD (Bila Mutasi)</label>
                                <input type="text" id="edit_mutasi" name="edit_mutasi" class="form-control" readonly="readonly">		  
                            </div>
						</div>
						<div class="card-footer">		
                        <input type="hidden" id="edit_idne" name="edit_idne">
                            <button type="button" class="btn btn-outline pull-left btnkembali">Cancel</button>
							<button type="button" class="btn btn-primary pull-right" id="btnsimpansiswa">Simpan</button>
						</div>
						</form>
                    </div>
                    <div class="card card-warning direct-chat direct-chat-warning shadow" id="detailsiswa">
                        <div class="card-header">
                            <h3 class="card-title">Profil Siswa</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                                <a href="#" id="btncetakbiodata"><button class="btn btn-box-tool"><i class="fa fa-print"></i></button></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-primary card-outline" >
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img src="" width="100%" id="picprofile" alt="User profile picture" width="100%"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-success card-outline" >
                                        <div class="card-body box-profile bg-success">
                                            <div class="text-center">Statistik KI3 dan KI4</div>
                                        </div>
                                        <div class="card-body">
                                            <div id='grafiksebaran' style="width:100%; height:320px;"></div>
                                        </div>
                                    </div>
                                    <div class="card card-danger card-outline" >
                                        <div class="card-body box-profile bg-danger">
                                            <div class="text-center">Statistik Matpel</div>
                                        </div>
                                        <div class="card-body">
                                            <div id='grafiksebaranperjenis' style="width:100%; height:320px;"></div>
                                        </div>
                                    </div>
                                    <div class="card card-info card-outline" >
                                        <div class="card-body box-profile bg-info">
                                            <div class="text-center">Statistik Kehadiran</div>
                                        </div>
                                        <div class="card-body">
                                            <div id='grafikkehadiran' style="width:100%; height:320px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card card-outline shadow">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <select id="induk_dataview" name="induk_dataview" class="form-control" >
                                                    <option value="1">Data Siswa</option>
                                                    <option value="2">Ayah Kandung</option>
                                                    <option value="3">Ibu Kandung</option>
                                                    <option value="4">Wali Siswa</option>
                                                    <option value="27">Orang Tua Asuh</option>
                                                    <option value="5">Keadaan Jasmani</option>
                                                    <option value="6">Beasiswa</option>
                                                    <option value="7">Pendidikan Sebelumnya</option>
                                                    <option value="8">Meninggalkan Sekolah</option>
                                                    <option value="10">Perilaku Siswa</option>
                                                    <option value="11">Laporan Prestasi Siswa</option>
                                                    <option value="28">Laporan Alquran</option>
                                                    <option value="12">Prestasi Belajar Kelas KB</option>
                                                    <option value="13">Prestasi Belajar Kelas TK A</option>
                                                    <option value="14">Prestasi Belajar Kelas TK B</option>
                                                    <option value="15">Prestasi Belajar Kelas 1</option>
                                                    <option value="16">Prestasi Belajar Kelas 2</option>
                                                    <option value="17">Prestasi Belajar Kelas 3</option>
                                                    <option value="18">Prestasi Belajar Kelas 4</option>
                                                    <option value="19">Prestasi Belajar Kelas 5</option>
                                                    <option value="20">Prestasi Belajar Kelas 6</option>
                                                    <option value="21">Prestasi Belajar Kelas 7 (SMP)</option>
                                                    <option value="22">Prestasi Belajar Kelas 8 (SMP)</option>
                                                    <option value="23">Prestasi Belajar Kelas 9 (SMP)</option>
                                                    <option value="24">Prestasi Belajar Kelas 10 (SMA)</option>
                                                    <option value="25">Prestasi Belajar Kelas 11 (SMA)</option>
                                                    <option value="26">Prestasi Belajar Kelas 12 (SMA)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div style="overflow-y: auto; height:460px; ">
                                                <div id="divdataview"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-success direct-chat direct-chat-warning shadow" id="pengajuan">
                        <div class="card-header">
                            <h3 class="card-title">Permohonan Menjadi Orang Tua Asu</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-success card-outline" >
                                        <div class="card-body box-profile bg-success">
                                            <div class="text-center">Profil Siswa Yang di Pilih</div>
                                        </div>
                                        <div class="card-body">
                                            <div id='kesediaan_profil'></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-outline shadow">
                                        <div class="card card-footer">
                                            <div class="form-group">
                                                Dengan Menyebut Nama Allah, Tuhan Yang Maha Esa Pemilik Semesta Alam.<br />Dengan menandatangani Form Pengajuan ini, saya menyatakan bahwa saya berkomitmen menjadi orang tua asuh dari anak yang telah saya pilih dan saya berkomitmen untuk membantu anak tersebut setiap bulannya sejumlah Rp.100.000,-. Semoga Allah Tuhan Pemilik Semesta Alam meridho i keputusan saya. Aamiin.
                                            </div>
                                            <div class="form-row kotakttd">
                                                <div class="col-lg-4 col-md-4"></div>
                                                <div class="col-lg-4 col-md-4">
                                                    <canvas id="signature-pad" class="signature-pad" width=320 height=200></canvas>
                                                    <canvas id="signature-blank" width=320 height=200 style='display:none'></canvas>
                                                    <img src="{{ asset('boxed-bg.jpg') }}" width=320 height=200 />
                                                </div>
                                                <div class="col-lg-4 col-md-4"></div>
                                            </div>
                                            <div class="form-group">
                                                <button id="btnclearttd" class="btn btn-warning btn-xs">Bersihkan Kotak Tanda Tangan</button>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="form-group">
                                                <a href="#" class="btn btn-xs btn-info pull-left" id="btnsetuju">
                                                    <i class="fa fa-save"></i>  Simpan
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
        </div>
    </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
    <div class="tabel_cetak"></div>		
</div>
<!-- TOKEN -->
<input type="hidden" name="makhir" id="makhir" value="now">
<input type="hidden" name="valcari" id="valcari">
<style>
    .kotakttd {
        position: relative;
        width: 320px;
        height: 200px;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: solid 1px #ddd;
        margin: 10px 0px;
    }
    .signature-pad {
        position: absolute;
        left: 0;
        top: 0;
        width:320px;
        height:200px;
    }
</style>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="idsurat" id="idsurat" value="">
@endsection

@push('script')
<script src="{{ asset('plugins/signature_pad/signature_pad.js') }}"></script>

<script type="text/javascript">
    $(function () {
		$('#add_tgllahir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
    $('#edit_foto').change(function () {
        if(this.files[0].size > 700000){
			swal({
                title: 'Stop',
                text: 'Hanya File JPG / JPEG / PNG saja yang diperbolehkan dan maksimal 7Mb',
                type: 'warning',
            })
            this.value = "";
        } else {
            var imgPath = this.value;
			var ukfile 	= this.files[0].size;
            var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
			if(ext == "jpg" || ext == "jpeg" || ext == "png") {
                readURL(this);
            } else {
				swal({
					title: 'Stop',
					text: 'Hanya File JPG / JPEG / PNG saja yang diperbolehkan',
					type: 'warning',
				})
            }
        }
    });
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            };
        }
    }
	function removeImage() {
		$('#edit_foto').val('');
        $('#preview').attr('src', 'dist/img/takadagambar.jpg');
    }
    $('.btnprofil').on('click', function (){
        var set01		= $(this).attr('data-id');
        var set02		= $(this).attr('data-foto');
        if (set02 == '' || set02 == null){
            var set02   = 'mascot.png';
        } else {
            var set02   = '/dist/img/foto/'+set02;
        }
        $("#induk_dataview").val('1');
        $('#picprofile').attr('src', set02);
        $("#valcari").val(set01);
        $('#divawal').hide();
        $('#detailsiswa').show();
        var sourcegrafik = {
            datatype: "json",
            datafields: [
                { name: 'jenis' },
                { name: 'jumlah' },
            ],
            type: 'POST',
            data: {val01: set01, _token: '{{ csrf_token() }}'},
            url: 'json/getstatdatakd',
        };
        var datajrekap		= new $.jqx.dataAdapter(sourcegrafik);
        var settinggrafik 	= {
            title: "Statistik",
            description: "KI3 vs KI4",
            enableAnimations: true,		
            showBorderLine: true,
            colorScheme: 'scheme03',
            padding: { left: 5, top: 5, right: 5, bottom: 5 },
            titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
            source: datajrekap,
            seriesGroups:
            [
                {
                    type: 'pie',
                    showLabels: true,
                    series:
                    [
                        {
                            dataField: 'jumlah',
                            displayText: 'jenis',
                            labelRadius: 100,
                            initialAngle: 15,
                            radius: 90,
                            centerOffset: 0,
                            formatSettings: { decimalPlaces: 1 }
                        }
                    ]
                }
            ]
        };
        $('#grafiksebaran').jqxChart(settinggrafik);
        var source2 = {
            datatype: "json",
            datafields: [
                { name: 'jenis' },
                { name: 'jumlah3' },
                { name: 'jumlah4' },
            ],
            type: 'POST',
            data: {val01: set01, _token: '{{ csrf_token() }}'},
            url: 'json/getstatdatapermuatan',
        };
        var datajrekap2		= new $.jqx.dataAdapter(source2);
        var settinggrafik2 = {
            title: "Statistik",
            description: "Per Matapelajar",
            enableAnimations: true,
            titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
            source: datajrekap2,
            xAxis:
                {
                    dataField: 'jenis',
                    displayText: 'Matapelajaran',
                    gridLines: { visible: true },
                    valuesOnTicks: false
                },
            colorScheme: 'scheme02',
            columnSeriesOverlap: false,
            seriesGroups:
                [
                    {
                        type: 'column',
                        valueAxis:
                        {
                            visible: true,
                            title: { text: 'Nilai<br>' }
                        },
                        series: [
                                { dataField: 'jumlah3', displayText: 'Rata-Rata KI3' },	
                                { dataField: 'jumlah4', displayText: 'Rata-Rata KI4' },
                            ]
                    }
                ]
        };
        $('#grafiksebaranperjenis').jqxChart(settinggrafik2);
        var source3 = {
            datatype: "json",
            datafields: [
                { name: 'jenis' },
                { name: 'jumlah' },
            ],
            type: 'POST',
            data: {val01: set01, _token: '{{ csrf_token() }}'},
            url: 'json/getstatdatakehadiran',
        };
        var datajrekap3		= new $.jqx.dataAdapter(source3);
        var settinggrafik3 = {
            title: "Statistik",
            description: "Kehadiran Siswa",
            enableAnimations: true,
            titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
            source: datajrekap3,
            xAxis:
                {
                    dataField: 'jenis',
                    displayText: 'Status',
                    gridLines: { visible: true },
                    valuesOnTicks: false
                },
            colorScheme: 'scheme03',
            columnSeriesOverlap: false,
            seriesGroups:
                [
                    {
                        type: 'column',
                        series: [
                            { dataField: 'jumlah', displayText: 'Jumlah' },
                        ]
                    }
                ]
        };
        $('#grafikkehadiran').jqxChart(settinggrafik3);
        $.post('json/viewdatainduk', { val01: '1', val02: set01, _token: '{{ csrf_token() }}' },
        function(data){
            $('#divdataview').html(data);
            return false;
        });
    });
    $('.btnpengajuan').on('click', function (){
        var set01		= $(this).attr('data-id');
        var set02		= $(this).attr('data-noinduk');
        $("#idsurat").val(set01);
        $('#divawal').hide();
        $('#pengajuan').show();
        $.post('json/viewdatainduk', { val01: '1', val02: set02, _token: '{{ csrf_token() }}' },
        function(data){
            $('#kesediaan_profil').html(data);
            return false;
        });
    });
    $(document).ready(function () {
        $('#formtambah').hide();
        $('#btntambah').click(function () { 
            $('#formtambah').show();
            $('.pengumuman').hide(); 
        });
        $("#btnsimpandata").click(function(){
            var val01	= document.getElementById('add_noinduk').value;
            var val02	= document.getElementById('add_tgllahir').value;
            var val03   = 'TAMBAHSISWA';
            var val04	= '-';
            var val05	= '-';
            var token	= document.getElementById('token').value;
            $.post('{{route("expersetujuanBerkas")}}', { set01: val01, set02: val02, set03: val03, set04: val04, set05: 'TAMBAH DATA SISWA', _token: token },
            function(data){
                var status  = data.status;
                var message = data.message;
                $.toast({
                    heading: status,
                    text: message,
                    position: 'top-right',
                    loaderBg: '#bf441d',
                    icon: 'info',
                    hideAfter: 1000,
                    stack: 1
                });
                $("#griddatainduk").jqxGrid('updatebounddata');
                return false;
            });
        });
        $('#btnsimpansiswa').click(function () {
            $('#divediting').hide();
            var formdata = new FormData($('#kt_form')[0]);
                formdata.set('_token', '{{ csrf_token() }}');
            $.ajax({
                url: '{{ route("exupdDatainduk") }}',
                data: formdata,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
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
                    $('#divawal').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#pengajuan').hide();
                    $('#detailsiswa').hide();
                    $("#griddatainduk").jqxGrid("updatebounddata");
                    return false;
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });
        $('.btnkembali').click(function () { 
            $('#divawal').show(); 
            $('#divediting').hide(); 
            $('#detailsiswa').hide();
            $('#pengajuan').hide(); 
        });
        $('#btncetakbiodata').click(function () {
            var set01	= document.getElementById('induk_dataview').value;
            var set02	= document.getElementById('valcari').value;
            $.post('json/viewdatainduk', { val01: set01, val02: set02, _token: '{{ csrf_token() }}' },
            function(data){
                var newWindow = window.open('', '', 'width=800, height=500'),
				document = newWindow.document.open(),
					pageContent =
						'<!DOCTYPE html>\n' +
						'<html>\n' +
						'<head>\n' +
						'<meta charset="utf-8" />\n' +
						'<title>Data Induk '+set01+'</title>\n' +
						'</head>\n' +
						'<body>' + data + '</body>\n</html>';
				document.write(pageContent);
				document.close();
                return false;
            });
        });
        $('#pengajuan').hide();
        $('#divediting').hide();
        $('#detailsiswa').hide(); 
        var source = {
            datatype: "json",
            datafields: [
                { name: 'id',type: 'text'},	
                { name: 'panggilan',type: 'text'},
                { name: 'agama',type: 'text'},
                { name: 'bakat',type: 'text'},
                { name: 'gybljr',type: 'text'},
                { name: 'gayah',type: 'text'},
                { name: 'gibu',type: 'text'},
                { name: 'payah',type: 'text'},
                { name: 'pibu',type: 'text'},
                { name: 'panggilan',type: 'text'},	
                { name: 'agama',type: 'text'},	
                { name: 'nama',type: 'text'},
                { name: 'nik',type: 'text'},
                { name: 'kelamin',type: 'text'},
                { name: 'tmplahir',type: 'text'},
                { name: 'tgllahir',type: 'text'},
                { name: 'noinduk',type: 'text'},
                { name: 'nisn',type: 'text'},
                { name: 'tinggi',type: 'text'},
                { name: 'berat',type: 'text'},
                { name: 'namaayah',type: 'text'},
                { name: 'namaibu',type: 'text'},
                { name: 'kerjaayah',type: 'text'},
                { name: 'kerjaibu',type: 'text'},
                { name: 'wali',type: 'text'},
                { name: 'pekerjaanwali',type: 'text'},
                { name: 'alamatortu',type: 'text'},
                { name: 'erte',type: 'text'},
                { name: 'erwe',type: 'text'},
                { name: 'kelurahan',type: 'text'},
                { name: 'kecamatan',type: 'text'},
                { name: 'kota',type: 'text'},
                { name: 'kodepos',type: 'text'},
                { name: 'darah',type: 'text'},			
                { name: 'klspos',type: 'text'},
                { name: 'foto',type: 'text'},
                { name: 'tamasuk',type: 'text'},
                { name: 'lampiran',type: 'text'},
                { name: 'hape',type: 'text'},
                { name: 'mutasi',type: 'text'},
                { name: 'asal',type: 'text'},
                { name: 'nokelulusan',type: 'text'},
                { name: 'jilid',type: 'text'},
                { name: 'is_asuh',type: 'text'},
            ],
            url: 'json/datainduk',
            cache: false,
            pager: function (pagenum, pagesize, oldpagenum) {}
        };
        var dataAdapter = new $.jqx.dataAdapter(source, { async: false, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
        var editrow = -1;
        $("#griddatainduk").jqxGrid({
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
                { text: 'VIEW', cellsalign: 'center', align: 'center', editable: false, sortable: false, filterable: false, columntype: 'button', width: 70, cellsrenderer: function () {
					return "VIEW";
					}, buttonclick: function (row) {
						editrow 		= row;
						var offset 		= $("#griddatainduk").offset();
						var dataRecord 	= $("#griddatainduk").jqxGrid('getrowdata', editrow);
						var set01		= dataRecord.noinduk;
						var set02		= dataRecord.foto;
						if (set02 == '' || set02 == null){
                            var set02   = 'mascot.png';
                        } else {
                            var set02   = '/dist/img/foto/'+set02;
                        }
                        $("#induk_dataview").val('1');
						$('#picprofile').attr('src', set02);
						$("#valcari").val(dataRecord.id);
                        $('#divawal').hide();
						$('#detailsiswa').show();
						var sourcegrafik = {
							datatype: "json",
							datafields: [
								{ name: 'jenis' },
								{ name: 'jumlah' },
							],
							type: 'POST',
							data: {val01: set01, _token: '{{ csrf_token() }}'},
							url: 'json/getstatdatakd',
						};
						var datajrekap		= new $.jqx.dataAdapter(sourcegrafik);
						var settinggrafik 	= {
							title: "Statistik",
							description: "KI3 vs KI4",
							enableAnimations: true,		
							showBorderLine: true,
							colorScheme: 'scheme03',
							padding: { left: 5, top: 5, right: 5, bottom: 5 },
							titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
							source: datajrekap,
							seriesGroups:
							[
								{
									type: 'pie',
									showLabels: true,
									series:
									[
										{
											dataField: 'jumlah',
											displayText: 'jenis',
											labelRadius: 100,
											initialAngle: 15,
											radius: 90,
											centerOffset: 0,
											formatSettings: { decimalPlaces: 1 }
										}
									]
								}
							]
						};
						$('#grafiksebaran').jqxChart(settinggrafik);
						var source2 = {
							datatype: "json",
							datafields: [
								{ name: 'jenis' },
								{ name: 'jumlah3' },
								{ name: 'jumlah4' },
							],
							type: 'POST',
							data: {val01: set01, _token: '{{ csrf_token() }}'},
							url: 'json/getstatdatapermuatan',
						};
						var datajrekap2		= new $.jqx.dataAdapter(source2);
						var settinggrafik2 = {
							title: "Statistik",
							description: "Per Matapelajar",
							enableAnimations: true,
							titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
							source: datajrekap2,
							xAxis:
								{
									dataField: 'jenis',
									displayText: 'Matapelajaran',
									gridLines: { visible: true },
									valuesOnTicks: false
								},
							colorScheme: 'scheme02',
							columnSeriesOverlap: false,
							seriesGroups:
								[
									{
										type: 'column',
										valueAxis:
										{
											visible: true,
											title: { text: 'Nilai<br>' }
										},
										series: [
												{ dataField: 'jumlah3', displayText: 'Rata-Rata KI3' },	
												{ dataField: 'jumlah4', displayText: 'Rata-Rata KI4' },
											]
									}
								]
						};
						$('#grafiksebaranperjenis').jqxChart(settinggrafik2);
						var source3 = {
							datatype: "json",
							datafields: [
								{ name: 'jenis' },
								{ name: 'jumlah' },
							],
							type: 'POST',
							data: {val01: set01, _token: '{{ csrf_token() }}'},
							url: 'json/getstatdatakehadiran',
						};
						var datajrekap3		= new $.jqx.dataAdapter(source3);
						var settinggrafik3 = {
							title: "Statistik",
							description: "Kehadiran Siswa",
							enableAnimations: true,
							titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
							source: datajrekap3,
							xAxis:
								{
									dataField: 'jenis',
									displayText: 'Status',
									gridLines: { visible: true },
									valuesOnTicks: false
								},
							colorScheme: 'scheme03',
							columnSeriesOverlap: false,
							seriesGroups:
								[
									{
										type: 'column',
										series: [
											{ dataField: 'jumlah', displayText: 'Jumlah' },
										]
									}
								]
						};
						$('#grafikkehadiran').jqxChart(settinggrafik3);
						$.post('json/viewdatainduk', { val01: '1', val02: set01, _token: '{{ csrf_token() }}' },
						function(data){
							$('#divdataview').html(data);
							return false;
						});
					}
				},
				{ text: 'TA.Masuk',  editable: false, sortable: false, filterable: false, datafield: 'tamasuk', width: 70, cellsalign: 'center', align: 'center' },
                { text: 'Photo',  editable: false, sortable: false, filterable: false, datafield: 'lampiran', width: 50, cellsalign: 'center', align: 'center' },
                { text: 'Nama Siswa', datafield: 'nama', width: 150, align: 'center' },
                { text: 'L/P', datafield: 'kelamin', width: 40, cellsalign: 'center', align: 'center' },
                { text: 'Kls', datafield: 'klspos', width: 40, cellsalign: 'center', align: 'center' },
                { text: 'Tinggi Badan', datafield: 'tinggi', width: 50, cellsalign: 'center', align: 'center' },
                { text: 'Berat Badan', datafield: 'berat', width: 50, cellsalign: 'center', align: 'center' },
                { text: 'Tempat Lahir', datafield: 'tmplahir', width: 100, cellsalign: 'center', align: 'center' },
                { text: 'Tanggal lahir', datafield: 'tgllahir', width: 100, cellsalign: 'center', align: 'center' },
                { text: 'No. Induk',  datafield: 'noinduk', width: 80, cellsalign: 'center', align: 'center' },
                { text: 'NIK',  datafield: 'nik', width: 180, cellsalign: 'left', align: 'center' },
                { text: 'No. NISN',  datafield: 'nisn', width: 100, cellsalign: 'center', align: 'center' },
                { text: 'Nama Ayah',  datafield: 'namaayah', width: 150, cellsalign: 'center', align: 'center' },
                { text: 'Nama Ibu',  datafield: 'namaibu', width: 150, cellsalign: 'center', align: 'center' },
                { text: 'Pekerjaan Ayah',  datafield: 'kerjaayah', width: 150, cellsalign: 'center', align: 'center' },
                { text: 'Pekerjaan Ibu',  datafield: 'kerjaibu', width: 150, cellsalign: 'center', align: 'center' },
                { text: 'Nama Wali',  datafield: 'wali', width: 150, cellsalign: 'center', align: 'center' },
                { text: 'Pekerjaan Wali',  datafield: 'pekerjaanwali', width: 150, cellsalign: 'center', align: 'center' },
                { text: 'No.HP Ortu/Wali',  datafield: 'hape', width: 80, cellsalign: 'center', align: 'center' },
                { text: 'Alamat Ortu/Wali',  datafield: 'alamatortu', width: 180, cellsalign: 'left', align: 'center' },
                { text: 'Status Lulus/Mutasi',  datafield: 'nokelulusan', width: 180, cellsalign: 'center', align: 'center' },
                { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: 50, cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {	
                        editrow = row;	
                        var offset 		= $("#griddatainduk").offset();		
                        var dataRecord 	= $("#griddatainduk").jqxGrid('getrowdata', editrow);
                        $("#id_gayah").val(dataRecord.gayah);
                        $("#id_gibu").val(dataRecord.gibu);
                        $("#id_payah").val(dataRecord.pibu);
                        $("#id_pibu").val(dataRecord.payah);
                        $("#id_agama").val(dataRecord.agama);
                        $("#edit_panggilan").val(dataRecord.panggilan);
                        $("#edit_gayabelajar").val(dataRecord.gybljr);
                        $("#edit_karakter").val(dataRecord.bakat);
                        $("#edit_jilid").val(dataRecord.jilid);
                        $("#edit_idne").val(dataRecord.id);
                        $("#edit_nama").val(dataRecord.nama);
                        $("#edit_nik").val(dataRecord.nik);
                        $("#edit_kelamin").val(dataRecord.kelamin);
                        $("#edit_darah").val(dataRecord.darah);
                        $("#edit_tinggi").val(dataRecord.tinggi);
                        $("#edit_berat").val(dataRecord.berat);
                        $("#edit_tmplahir").val(dataRecord.tmplahir);
                        $("#edit_tgllahir").val(dataRecord.tgllahir);
                        $("#edit_noinduk").val(dataRecord.noinduk);
                        $("#edit_nisn").val(dataRecord.nisn);
                        $("#edit_ayah").val(dataRecord.namaayah);
                        $("#edit_ibu").val(dataRecord.namaibu);
                        $("#edit_kayah").val(dataRecord.kerjaayah);
                        $("#edit_kibu").val(dataRecord.kerjaibu);
                        $("#edit_wali").val(dataRecord.wali);
                        $("#edit_kwali").val(dataRecord.pekerjaanwali);
                        $("#edit_alamat").val(dataRecord.alamatortu);
                        $("#edit_kel").val(dataRecord.kelurahan);
                        $("#edit_kec").val(dataRecord.kecamatan);
                        $("#edit_rt").val(dataRecord.erte);
                        $("#edit_rw").val(dataRecord.erwe);
                        $("#edit_kota").val(dataRecord.kota);
                        $("#edit_kodepos").val(dataRecord.kodepos);
                        $("#edit_hape").val(dataRecord.hape);
                        $("#edit_tahun").val(dataRecord.tamasuk);
                        $("#edit_kelas").val(dataRecord.klspos);
                        $("#edit_mutasi").val(dataRecord.mutasi);
                        $("#edit_asal").val(dataRecord.asal);
                        $("#edit_isasuh").val(dataRecord.is_asuh);
                        $('#divediting').show(); 
                        $('#divawal').hide(); 
                    }
                },
                
            ],                
        });
        $("#induk_dataview").on('change', function () {
            var set01	= $(this).find('option:selected').attr('value');
            var set02	= document.getElementById('valcari').value;
            $.post('json/viewdatainduk', { val01: set01, val02: set02, _token: '{{ csrf_token() }}' },
            function(data){
                $('#divdataview').html(data);
                return false;
            });
        });
        $("#btnsetuju").click(function(){
            var val01	= document.getElementById('idsurat').value;
            var val02 	= signaturePad.toDataURL('image/png');
            if (val02 == document.getElementById('signature-blank').toDataURL()){ val02 = ''; }
            var val03   = 'SETUJU';
            if (val02 == '') { alert("Mohon Membubuhkan Tanda Tangan Anda"); }
            var val04	= '-';
            var val05	= '-';
            var token	= document.getElementById('token').value;
            $.post('{{route("expersetujuanBerkas")}}', { set01: val01, set02: val02, set03: val03, set04: val04, set05: 'Orang Tua Asuh', _token: token },
            function(data){
                var status  = data.status;
                var message = data.message;
                $.toast({
                    heading: status,
                    text: message,
                    position: 'top-right',
                    loaderBg: '#bf441d',
                    icon: 'info',
                    hideAfter: 1000,
                    stack: 1
                });
                if (status == 'Sukses'){
                    $('#divawal').show(); 
                    $('#divediting').hide();
                    $('#detailsiswa').hide();
                    $('#pengajuan').hide();
                    $("#griddatainduk").jqxGrid('updatebounddata');
                }
                return false;
            });
        });
        $('#btnclearttd').click(function () {signaturePad.clear();});
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(0, 0, 0, 0)',
            penColor: 'rgb(0, 0, 0)'
        });
	});
</script>
@endpush