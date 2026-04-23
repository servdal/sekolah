@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Induk Siswa</h1>
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
                    <div class="card card-primary direct-chat direct-chat-warning shadow" id="divawal">
                        <div class="card-header">
                            <h3 class="card-title">Siswa Aktif</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btntambahsiswa"><i class="fa fa-plus"></i> Tambah Siswa</button>
                                <button type="button" class="btn btn-tool" id="btnviewbukuinduk"><i class="fa fa-book"></i> View as "Buku Induk"</button>
                                <button type="button" class="btn btn-tool" id="exportgrid"><i class="fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-tool" id="btnprintgrid"><i class="fa fa-print"></i></button>

                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="griddatainduk"></div>
                        </div>
                        <div class="card-footer">
                            <div class="col-lg-3">
                                <div style="margin-top: 20px" id="jqxlistbox"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-warning direct-chat direct-chat-warning shadow" id="divbukuinduk">
                        <div class="card-header">
                            <h3 class="card-title">Buku Induk</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btncetakbukuinduk"><i class="fa fa-print"></i></button>
                                <button type="button" class="btn btn-tool" id="btnboxkembali"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" id="tabelawal">
                            <table border="0" width="950" style="table-layout: fixed; background-image: url('{{asset('dist/img/bgdatainduk.png')}}'); background-repeat: no-repeat; background-position: top; background-size: 100% 100%;">
								<tr>
									<td width="100">&nbsp;</td>
									<td width="100">&nbsp;</td>
									<td width="20">&nbsp;</td>
									<td width="250">&nbsp;</td>
									<td width="20">&nbsp;</td>
									<td width="250">&nbsp;</td>
									<td width="60">&nbsp;</td>
									<td width="100">&nbsp;</td>
								</tr>
								<tr><td colspan="8" height="29">&nbsp;</td></tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									<td rowspan="4" colspan="3"><strong>Mengacu pada Panduan Kerja Tenaga Administrasi Sekolah/Madrasah Direktorat Pembinaan Tenaga Kependidikan, Pendidikan Dasar dan Menengah, Dirjen Guru dan Tenaga Kependidikan, Kementerian Pendidikan dan Kebudayaan 2017</strong></td>
									<td colspan="3" align="center"><strong>Nomor Statistik Sekolah (NSS)</strong></td>
								</tr>
								<tr>
								<td colspan="2">&nbsp;</td>
									<td colspan="3" align="center">102056104009</td>
								</tr>
								<tr>
								<td colspan="2">&nbsp;</td>
									<td colspan="3" align="center"><strong>Nomor Pokok Sekolah Nasional (NPSN)</strong></td>
								</tr>
								<tr>
								<td colspan="2">&nbsp;</td>
									<td colspan="3" align="center">70036690</td>
								</tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8" align="center"><font size="+5"><strong>BUKU INDUK SISWA</strong></font></td></tr>
								<tr><td colspan="8" align="center"><font size="+3"><strong>SEKOLAH DASAR / MADRASAH IBTIDAIYAH</strong></font></td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td colspan="2">TAHUN PELAJARAN</td>
									<td>:</td>
									<td>
										<select id="induk_angkatan" name="induk_angkatan" class="form-control" >
											@foreach($angkatans as $rows)
												<option value="{{ $rows['tamasuk'] }}">{{ $rows['tamasuk'] }}</option>
											@endforeach
										</select>
									</td>
									<td><button class="btn btn-success" id="btnviewperangkatan"><i class="fa fa-search"></i></button></td>
									<td>&nbsp;</td>
								</tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td colspan="2">NAMA SEKOLAH</td><td align="center">:</td><td><input type="text" class="form-control" value="{!! $sekolah !!}" readonly></td><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td colspan="2">STATUS SEKOLAH</td><td align="center">:</td><td><input type="text" class="form-control" value="SWASTA" readonly></td><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td colspan="2">ALAMAT SEKOLAH</td><td align="center">:</td><td><input type="text" class="form-control" value="{!! $alamat !!}" readonly></td><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td colspan="2">DESA/KELURAHAN</td><td align="center">:</td><td><input type="text" class="form-control" value="ASRIKATON" readonly></td><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td colspan="2">KECAMATAN</td><td align="center">:</td><td><input type="text" class="form-control" value="KEC. PAKIS" readonly></td><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td colspan="2">KABUPATEN/KOTA</td><td align="center">:</td><td><input type="text" class="form-control" value="{!! config('global.kota') !!}" readonly></td><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td colspan="2">PROVINSI</td><td align="center">:</td><td><input type="text" class="form-control" value="JAWA TIMUR" readonly></td><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
								<tr><td colspan="8">&nbsp;</td></tr>
							</table>
                        </div>
                        <div class="card-footer" id="tabelsiswa">
                            <div id="gridtabelsiswa"></div>
                        </div>
                    </div>
                    <div class="card card-info shadow" id="divediting">
                        <div class="card-header">
                            <h3 class="card-title">Add/Edit Data Siswa</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                            </div>
                        </div>
                        <form id="kt_form" enctype="multipart/form-data">
						<div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label>TAPEL Diterima *)</label>
                                        <div class="input-group">
                                            <input type="text" id="edit_tahun" name="edit_tahun" class="form-control" value="{{$tapel}}">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-tags"></i></div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-2">
                                        <label>Kelas Umum</label>
                                        <div class="input-group">
                                            <select id="edit_kelas" name="edit_kelas" class="form-control select2" >
                                                @if(Session('sekolah_level') == 1)
                                                    <option value="1A">Tahap 1-A</option>
                                                    <option value="1B">Tahap 1-B</option>
                                                    <option value="1C">Tahap 1-C</option>
                                                    <option value="2A">Tahap 2-A</option>
                                                    <option value="2B">Tahap 2-B</option>
                                                    <option value="2C">Tahap 2-C</option>
                                                    <!--
                                                    <option value="kba">Kelompok Belajar (KB) A</option>
                                                    <option value="kbb">Kelompok Belajar (KB) B</option>
                                                    <option value="kbc">Kelompok Belajar (KB) C</option>
                                                    <option value="TA-A.1">Tarbiyatul Athfal A.1(TA/TK)</option>
                                                    <option value="TA-A.2">Tarbiyatul Athfal A.2(TA/TK)</option>
                                                    <option value="TA-A.3">Tarbiyatul Athfal A.3(TA/TK)</option>
                                                    <option value="TA-B.1">Tarbiyatul Athfal B.1(TA/TK)</option>
                                                    <option value="TA-B.2">Tarbiyatul Athfal B.2(TA/TK)</option>
                                                    <option value="TA-B.3">Tarbiyatul Athfal B.3(TA/TK)</option>
                                                    -->
                                                @elseif (Session('sekolah_level') == 2)
                                                    <option value="1A">1 A</option>
                                                    <option value="1B">1 B</option>
                                                    <option value="1C">1 C</option>
                                                    <option value="2A">2 A</option>
                                                    <option value="2B">2 B</option>
                                                    <option value="2C">2 C</option>
                                                    <option value="3A">3 A</option>
                                                    <option value="3B">3 B</option>
                                                    <option value="3C">3 C</option>
                                                    <option value="4A">4 A</option>
                                                    <option value="4B">4 B</option>
                                                    <option value="4C">4 C</option>
                                                    <option value="5A">5 A</option>
                                                    <option value="5B">5 B</option>
                                                    <option value="5C">5 C</option>
                                                    <option value="6A">6 A</option>
                                                    <option value="6B">6 B</option>
                                                    <option value="6C">6 C</option>
                                                @elseif (Session('sekolah_level') == 3)
                                                    <option value="7A">7 A</option>
                                                    <option value="7B">7 B</option>
                                                    <option value="7C">7 C</option>
                                                    <option value="7D">7 D</option>
                                                    <option value="7E">7 E</option>
                                                    <option value="7F">7 F</option>
                                                    <option value="7G">7 G</option>
                                                    <option value="7H">7 H</option>
                                                    <option value="7I">7 I</option>
                                                    <option value="8A">8 A</option>
                                                    <option value="8B">8 B</option>
                                                    <option value="8C">8 C</option>
                                                    <option value="8D">8 D</option>
                                                    <option value="8E">8 E</option>
                                                    <option value="8F">8 F</option>
                                                    <option value="8G">8 G</option>
                                                    <option value="8H">8 H</option>
                                                    <option value="8I">8 I</option>
                                                    <option value="9A">9 A</option>
                                                    <option value="9B">9 B</option>
                                                    <option value="9C">9 C</option>
                                                    <option value="9D">9 D</option>
                                                    <option value="9E">9 E</option>
                                                    <option value="9F">9 F</option>
                                                    <option value="9G">9 G</option>
                                                    <option value="9H">9 H</option>
                                                    <option value="9I">9 I</option>
                                                @else
                                                    <option value="10A">10 A</option>
                                                    <option value="10B">10 B</option>
                                                    <option value="10C">10 C</option>
                                                    <option value="10D">10 D</option>
                                                    <option value="10E">10 E</option>
                                                    <option value="10F">10 F</option>
                                                    <option value="10G">10 G</option>
                                                    <option value="10H">10 H</option>
                                                    <option value="10I">10 I</option>
                                                    <option value="11A">11 A</option>
                                                    <option value="11B">11 B</option>
                                                    <option value="11C">11 C</option>
                                                    <option value="11D">11 D</option>
                                                    <option value="11E">11 E</option>
                                                    <option value="11F">11 F</option>
                                                    <option value="11G">11 G</option>
                                                    <option value="11H">11 H</option>
                                                    <option value="11I">11 I</option>
                                                    <option value="12A">12 A</option>
                                                    <option value="12B">12 B</option>
                                                    <option value="12C">12 C</option>
                                                    <option value="12D">12 D</option>
                                                    <option value="12E">12 E</option>
                                                    <option value="12F">12 F</option>
                                                    <option value="12G">12 G</option>
                                                    <option value="12H">12 H</option>
                                                    <option value="12I">12 I</option>
                                                @endif
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-star"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Kelas Al Quran</label>
                                        <div class="input-group">
                                            <select id="edit_jilid" name="edit_jilid" class="form-control">
                                                <option value="">Pilih Salah Satu</option>
                                                @if(isset($kelasrpa) && !empty($kelasrpa))
                                                    @foreach($kelasrpa as $rows)
                                                        <option value="{{$rows['kelas']}}">{{$rows['kelas']}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-line-chart"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="edit_nama">Nama Siswa *)</label>
                                        <div class="input-group">
                                            <input type="text" id="edit_nama" name="edit_nama" class="form-control">			  
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="edit_kelamin">Panggilan</label>
                                        <div class="input-group">
                                            <input type="text" id="edit_panggilan" name="edit_panggilan" class="form-control" placeholder="Nama Panggilan">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-microphone"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="edit_karakter">Karakter Anak</label>
                                        <div class="input-group">
                                            <input type="text" id="edit_karakter" name="edit_karakter" class="form-control" placeholder="Bila diketahui">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-smile-o"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="edit_gayabelajar">Gaya Belajar</label>
                                        <div class="input-group">
                                            <select id="edit_gayabelajar" name="edit_gayabelajar" class="form-control" >
                                                <option value="Auditorial">Auditorial</option>
                                                <option value="Visual">Visual</option>
                                                <option value="Kinestetik">Kinestetik</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-pencil-square-o"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Tinggi Badan</label>
                                        <div class="input-group">
                                            <input type="text" id="edit_tinggi" name="edit_tinggi" class="form-control" placeholder="dalam CM">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-arrows-v"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Berat Badan</label>
                                        <div class="input-group">
                                            <input type="text" id="edit_berat" name="edit_berat" class="form-control" placeholder="dalam Kg">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-balance-scale"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Golongan Darah</label>
                                        <div class="input-group">
                                            <select id="edit_darah" name="edit_darah" class="form-control" >
                                                <option value="-">Tidak Tahu</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-heartbeat"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Agama *)</label>
                                        <div class="input-group">
                                            <select id="id_agama" name="id_agama" class="form-control" >
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katholik">Katholik</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Konghuchu">Konghuchu</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-mouse-pointer"></i></div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label>NIK Siswa *)</label>
                                        <div class="input-group">
                                            <input type="text" id="edit_nik" name="edit_nik" class="form-control">			  
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-pencil-square-o"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="edit_tmplahir">Tempat lahir</label>
                                        <div class="input-group">
                                            <input type="text" id="edit_tmplahir" name="edit_tmplahir" class="form-control">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-university"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="edit_tgllahir">Tgl.Lahir</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input value="{{date('Y-m-d')}}" type="text" class="form-control" id="edit_tgllahir" name="tanggallahir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="edit_kelamin">Kelamin</label>
                                        <div class="input-group">
                                            <select id="edit_kelamin" name="edit_kelamin" class="form-control">
                                                <option value="L">Laki-Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-venus-mars"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>No.Induk *)</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" id="edit_noinduk" name="edit_noinduk" class="form-control" placeholder="No. Induk">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-laptop"></i></div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-2">
                                        <label>No.NISN</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" id="edit_nisn" name="edit_nisn" class="form-control" placeholder="No. NISN" >
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-hdd-o"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label>Nama Ayah *)</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" id="edit_ayah" name="edit_ayah" class="form-control" placeholder="Ayah">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-user-secret"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Pendidikan Terakhir Ayah</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <select id="id_payah" name="id_payah" class="form-control" >
                                                <option value="">Tidak/Belum Sekolah</option>
                                                <option value="S3">S3</option>
                                                <option value="S2">S2</option>
                                                <option value="S1">S1</option>
                                                <option value="DIII">DIII</option>
                                                <option value="DII">DII</option>
                                                <option value="DI">DI</option>
                                                <option value="SMA dan Sederajatnya">SMA dan Sederajatnya</option>
                                                <option value="SMP dan Sederajatnya">SMP dan Sederajatnya</option>
                                                <option value="SD dan Sederajatnya">SD dan Sederajatnya</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-graduation-cap"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Pekerjaan Ayah</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <select id="edit_kayahopsi" name="edit_kayahopsi" class="form-control" >
                                                <option value="12 Tidak bekerja">Tidak bekerja</option>
                                                <option value="01 Buruh">Buruh</option>
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
                                                <option value="13 Tidak dapat diterapkan">Tidak dapat diterapkan</option>
                                                <option value="14 Wiraswasta">Wiraswasta</option>
                                                <option value="15 Wirausaha">Wirausaha</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                            <input type="text" id="edit_kayahteks" name="edit_kayahteks" class="form-control">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-black-tie"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Penghasilan Perbulan Ayah</label>
                                        <div class="input-group" data-target-input="nearest">
                                            <select id="id_gayah" name="id_gayah" class="form-control" >
                                                <option value="rangegaji1">&lt; Rp. 500.000,00 </option>
                                                <option value="rangegaji2">Rp. 500.000,00 - Rp. 999.999,00</option>
                                                <option value="rangegaji3">Rp. 1.000.000,00 - Rp. 1.999.999,00</option>
                                                <option value="rangegaji4">Rp. 2.000.000,00 - Rp. 4.999.999,00</option>
                                                <option value="rangegaji5">Rp. 5.000.000,00 - Rp. 20Jt</option>
                                                <option value="rangegaji6">&gt; Rp. 20.000.000,00</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-money"></i></div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>	
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label>Nama Ibu *)</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" id="edit_ibu" name="edit_ibu" class="form-control" placeholder="Ibu">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-female"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Pendidikan Terakhir Ibu</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <select id="id_pibu" name="id_pibu" class="form-control" >
                                                <option value="">Tidak/Belum Sekolah</option>
                                                <option value="S3">S3</option>
                                                <option value="S2">S2</option>
                                                <option value="S1">S1</option>
                                                <option value="DIII">DIII</option>
                                                <option value="DII">DII</option>
                                                <option value="DI">DI</option>
                                                <option value="SMA dan Sederajatnya">SMA dan Sederajatnya</option>
                                                <option value="SMP dan Sederajatnya">SMP dan Sederajatnya</option>
                                                <option value="SD dan Sederajatnya">SD dan Sederajatnya</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-graduation-cap"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Pekerjaan Ibu</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <select id="edit_kibuopsi" name="edit_kibuopsi" class="form-control" >
                                                <option value="12 Tidak bekerja">Tidak bekerja</option>
                                                <option value="01 Buruh">Buruh</option>
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
                                                <option value="13 Tidak dapat diterapkan">Tidak dapat diterapkan</option>
                                                <option value="14 Wiraswasta">Wiraswasta</option>
                                                <option value="15 Wirausaha">Wirausaha</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                            <input type="text" id="edit_kibuteks" name="edit_kibuteks" class="form-control">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-black-tie"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Penghasilan Perbulan Ibu</label>
                                        <div class="input-group" data-target-input="nearest">
                                            <select id="id_gibu" name="id_gibu" class="form-control" >
                                                <option value="rangegaji1">&lt; Rp. 500.000,00 </option>
                                                <option value="rangegaji2">Rp. 500.000,00 - Rp. 999.999,00</option>
                                                <option value="rangegaji3">Rp. 1.000.000,00 - Rp. 1.999.999,00</option>
                                                <option value="rangegaji4">Rp. 2.000.000,00 - Rp. 4.999.999,00</option>
                                                <option value="rangegaji5">Rp. 5.000.000,00 - Rp. 20Jt</option>
                                                <option value="rangegaji6">&gt; Rp. 20.000.000,00</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-money"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label>Nama Wali </label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" id="edit_wali" name="edit_wali" class="form-control" placeholder="Bila ada">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-users"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Pekerjaan Wali</label>
                                        <div class="input-group" data-target-input="nearest">
                                            <select id="edit_kwali" name="edit_kwali" class="form-control" >
                                                <option value="12 Tidak bekerja">Tidak bekerja</option>
                                                <option value="01 Buruh">Buruh</option>
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
                                                <option value="13 Tidak dapat diterapkan">Tidak dapat diterapkan</option>
                                                <option value="14 Wiraswasta">Wiraswasta</option>
                                                <option value="15 Wirausaha">Wirausaha</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-black-tie"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>No.HP Orang Tua/Wali *)</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input type="text" id="edit_hape" name="edit_hape" class="form-control" placeholder="No. HP">		  
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-phone"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Set Sebagai Anak Asuh.?</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <select id="edit_isasuh" name="edit_isasuh" class="form-control">
                                                <option value="0">Tidak</option>
                                                <option value="1">Ya</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-wechat"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <span class="badge badge-primary">Alamat Sesuai KK *)</span>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label>Jalan, Gang, Blok</label>
                                                    <input type="text" id="edit_alamat" name="edit_alamat" class="form-control" placeholder="Nama Jalan dan Nomer Rumah">	
                                                </div>
                                            </div> 
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>RT</label>
                                                    <input type="text" id="edit_rt" name="edit_rt" class="form-control" placeholder="RT">
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>RW</label>
                                                    <input type="text" id="edit_rw" name="edit_rw" class="form-control" placeholder="RW">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Desa/Kelurahan</label>
                                                    <input type="text" id="edit_kel" name="edit_kel" class="form-control">
                                                </div>
                                            </div> 
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Kecamatan</label>
                                                    <input type="text" id="edit_kec" name="edit_kec" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Kota/Kab</label>
                                                    <input type="text" id="edit_kota" name="edit_kota" class="form-control">
                                                </div>
                                            </div>				  
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>KodePOS</label>
                                                    <input type="text" id="edit_kodepos" name="edit_kodepos" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="badge badge-warning">Alamat Saat Ini</span>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label>Jalan, Gang, Blok</label>
                                                    <input type="text" id="edit_alamatsaatini" name="edit_alamatsaatini" class="form-control" placeholder="Nama Jalan dan Nomer Rumah">	
                                                </div>
                                            </div> 
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>RT</label>
                                                    <input type="text" id="edit_rtsaatini" name="edit_rtsaatini" class="form-control" placeholder="RT">
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>RW</label>
                                                    <input type="text" id="edit_rwsaatini" name="edit_rwsaatini" class="form-control" placeholder="RW">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Desa/Kelurahan</label>
                                                    <input type="text" id="edit_kelsaatini" name="edit_kelsaatini" class="form-control">
                                                </div>
                                            </div> 
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Kecamatan</label>
                                                    <input type="text" id="edit_kecsaatini" name="edit_kecsaatini" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Kota/Kab</label>
                                                    <input type="text" id="edit_kotasaatini" name="edit_kotasaatini" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>KodePOS</label>
                                                    <input type="text" id="edit_kodepossaatini" name="edit_kodepossaatini" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <span class="badge badge-warning">Foto Siswa</span><br />
                                        <img id="preview" src="{{asset('dist/img/takadagambar.png')}}" width="150px" height="150px"/><br />
                                        <p><a href="javascript:removeImage()" class="btn btn-danger"><i class="fa fa-trash"></i> Clear Image</a></p>
                                        <input type="file" id="edit_foto" name="edit_foto" >
                                    </div> 
                                    <div class="col-lg-9">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="daftar_nama" class="col-sm-4 col-form-label">Asal TK/TA/RA </label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="edit_asal" name="edit_asal" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="daftar_nama" class="col-sm-4 col-form-label">Asal SD (Bila Mutasi)</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="edit_mutasi" name="edit_mutasi" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="daftar_nama" class="col-sm-4 col-form-label">No Ijasah (bila lulus)</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="edit_nokelulusan" name="edit_nokelulusan" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="daftar_nama" class="col-sm-4 col-form-label">Melanjutkan Ke</label>
                                                <div class="col-sm-8">
                                                    <select id="id_melanjutkankeopsi" name="id_melanjutkankeopsi" class="form-control" >
                                                        <option value="">Masih Studi</option>
                                                        @if(Session('sekolah_level') == 1)
                                                            <option value="SDTQ Daarul Ukhuwwah">SDTQ Daarul Ukhuwwah (Set Data ke PPDB)</option>
                                                        @elseif (Session('sekolah_level') == 2)
                                                            <option value="MTs Pondok Pesantren Daarul Ukhuwwah Putra Malang">MTs Pondok Pesantren Daarul Ukhuwwah Putra Malang</option>
                                                            <option value="MTs Pondok Pesantren Daarul Ukhuwwah Putra Rembang">MTs Pondok Pesantren Daarul Ukhuwwah Putra Rembang</option>
                                                            <option value="MTs Pondok Pesantren Daarul Ukhuwwah Putri 1">MTs Pondok Pesantren Daarul Ukhuwwah Putri 1</option>
                                                            <option value="MTs Pondok Pesantren Daarul Ukhuwwah Putri 2">MTs Pondok Pesantren Daarul Ukhuwwah Putri 2</option>
                                                        @elseif (Session('sekolah_level') == 3)
                                                            <option value="MA Pondok Pesantren Daarul Ukhuwwah Putra Malang">MA Pondok Pesantren Daarul Ukhuwwah Putra Malang</option>
                                                            <option value="MA Pondok Pesantren Daarul Ukhuwwah Putra Rembang">MA Pondok Pesantren Daarul Ukhuwwah Putra Rembang</option>
                                                            <option value="MA Pondok Pesantren Daarul Ukhuwwah Putri 1">MA Pondok Pesantren Daarul Ukhuwwah Putri 1</option>
                                                            <option value="MA Pondok Pesantren Daarul Ukhuwwah Putri 2">MA Pondok Pesantren Daarul Ukhuwwah Putri 2</option>
                                                        @else
                                                            <option value="Universitas Daarul Ukhuwwah">Universitas Daarul Ukhuwwah</option>
                                                        @endif
                                                        <option value="Tidak Melanjutkan">Tidak Melanjutkan</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                    <input type="text" id="id_melanjutkanketeks" name="id_melanjutkanketeks" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="card-footer">
                            <input type="hidden" id="edit_idne" name="edit_idne">		  
                            <button type="button" class="btn btn-danger pull-left btnkembali">Cancel</button>
							<button type="button" class="btn btn-primary pull-right" id="btnsimpansiswa">Simpan</button>
						</div>
						</form>
                    </div>
                    <div class="card card-warning direct-chat direct-chat-warning shadow" id="detailsiswa">
                        <div class="card-header">
                            <h3 class="card-title" id="titelnama">Profil Siswa</h3>
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
                </div>
            </div>
        </div>
    </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
    <div id="tabel_cetak"></div>		
</div>
<div class="modal fade" id="formmutasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Mutasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Siswa *)</label>
                    <input type="text" id="mut_nama" name="mut_nama" class="form-control" disabled="disable">			  
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>TAPEL Mutasi *)</label>
                            <input type="text" id="mut_tahun" name="mut_tahun" class="form-control" value="{{$tapel}}">
                        </div> 
                        <div class="col-lg-6">
                            <label>Tanggal Mutasi</label>
                            <input value="{{date('Y-m-d')}}" type="text" class="form-control" id="mut_tgl" name="mut_tgl" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Mutasi Ke</label>
                    <input type="text" id="mut_tujuan" name="mut_tujuan" class="form-control">
                </div>
                <div class="form-group">
                    <label>Alamat SD Yang Dituju</label>
                    <input type="text" id="mut_almtsd" name="mut_almtsd" class="form-control">
                </div>
                <div class="form-group">
                    <label>Alasan</label>
                    <input type="text" id="mut_alasan" name="mut_alasan" class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
		        <button type="button" class="btn btn-success" id="simpanmutasi">Simpan</button>
	        </div>
        </div>
    </div>
</div>
<div class="modal fade" id="formdatappdb">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Pelengkapan PPDB</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formpelengkappsb" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Nama Siswa</label>
                            <input type="text" id="ppdb_nama" name="ppdb_nama" class="form-control" disabled="disable">			  
                        </div> 
                        <div class="col-lg-3">
                            <label>NIK</label>
                            <input type="text" id="ppdb_nik" name="niksiswa" class="form-control" readonly="readonly">
                        </div>
                        <div class="col-lg-3">
                            <label>Panggilan</label>
                            <input type="text" id="ppdb_panggilan" name="panggilan" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Agama</label>
                    <select id="ppdb_agama" name="agama" class="form-control" >
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katholik">Katholik</option>
                        <option value="Budha">Budha</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Konghuchu">Konghuchu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kewarganegaraan</label>
                    <select id="ppdb_warga" name="warga" class="form-control" >
                        <option value="WNI">WNI</option>
                        <option value="WNA">WNA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Bahasa Sehari - Hari</label>
                    <input type="text" id="ppdb_bahasa" name="bahasa" class="form-control">
                </div>
                <div class="form-group">
                    <label>Penyakit yang pernah di derita</label>
                    <input type="text" id="ppdb_penyakit" name="penyakit" class="form-control">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>Anak Ke</label>
                            <input type="number" id="ppdb_anakke" name="anakke" class="form-control">			  
                        </div> 
                        <div class="col-lg-3">
                            <label>Saudara Kandung</label>
                            <input type="number" id="ppdb_kandung" name="kandung" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Saudara Tiri</label>
                            <input type="number" id="ppdb_tiri" name="tiri" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Saudara Angkat</label>
                            <input type="number" id="ppdb_angkat" name="angkat" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Jarak tempat tinggal ke sekolah (KM)</label>
                    <input type="text" id="ppdb_jarak" name="jarak" class="form-control">
                </div>
                <div class="form-group">
                    <label>No. Telpon Rumah</label>
                    <input type="text" id="ppdb_telpon" name="telpon" class="form-control">
                </div>
                <div class="form-group">
                    <label>Bertempat tinggal bersama</label>
                    <input type="text" id="ppdb_bersama" name="bersama" class="form-control">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>Pekerjaan Ayah</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="ppdb_payah" name="payah" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-black-tie"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Penghasilan Perbulan Ayah</label>
                            <div class="input-group" data-target-input="nearest">
                                <select id="ppdb_gayah" name="gayah" class="form-control" >
                                    <option value="rangegaji1">&lt; Rp. 500.000,00 </option>
                                    <option value="rangegaji2">Rp. 500.000,00 - Rp. 999.999,00</option>
                                    <option value="rangegaji3">Rp. 1.000.000,00 - Rp. 1.999.999,00</option>
                                    <option value="rangegaji4">Rp. 2.000.000,00 - Rp. 4.999.999,00</option>
                                    <option value="rangegaji5">Rp. 5.000.000,00 - Rp. 20Jt</option>
                                    <option value="rangegaji6">&gt; Rp. 20.000.000,00</option>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-money"></i></div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-3">
                            <label>No.HP Ayah</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="ppdb_hayah" name="hayah" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-whatsapp"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Alamat Ayah (bila tidak serumah)</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="ppdb_aayah" name="aayah" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>Pekerjaan Ibu</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="ppdb_pibu" name="pibu" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-black-tie"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Penghasilan Perbulan Ibu</label>
                            <div class="input-group" data-target-input="nearest">
                                <select id="ppdb_gibu" name="gibu" class="form-control" >
                                    <option value="rangegaji1">&lt; Rp. 500.000,00 </option>
                                    <option value="rangegaji2">Rp. 500.000,00 - Rp. 999.999,00</option>
                                    <option value="rangegaji3">Rp. 1.000.000,00 - Rp. 1.999.999,00</option>
                                    <option value="rangegaji4">Rp. 2.000.000,00 - Rp. 4.999.999,00</option>
                                    <option value="rangegaji5">Rp. 5.000.000,00 - Rp. 20Jt</option>
                                    <option value="rangegaji6">&gt; Rp. 20.000.000,00</option>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-money"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>No.HP Ibu</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="ppdb_hibu" name="hibu" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-whatsapp"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Alamat Ibu (bila tidak serumah)</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="ppdb_aaibu" name="aaibu" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>Agama Wali</label>
                            <select id="ppdb_agamawali" name="agamawali" class="form-control" >
                                <option value="">Pilih Salah Satu</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Budha">Budha</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Konghuchu">Konghuchu</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label>Pekerjaan Wali</label>
                            <div class="input-group" data-target-input="nearest">
                                <input type="text" id="ppdb_kwali" name="kwali" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-money"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>No.HP Wali</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="ppdb_hwali" name="hwali" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-whatsapp"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Hubungan dengan Wali</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="text" id="ppdb_hubwali" name="hubwali" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-map-marker"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat Sekolah Sebelumnya</label>
                    <input type="text" id="ppdb_alamattk" name="alamattk" class="form-control" placeholder="Alamat Sekolah Sebelumnya">
                </div>
                <span class="label label-danger bg-danger">Bila Pindahan</span>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>Sekolah Asal</label>
                            <input type="text" id="ppdb_pindahasal" name="pindahasal" class="form-control" placeholder="Nama Sekolah Asal">
                        </div> 
                        <div class="col-lg-3">
                            <label>Dari Tingkat</label>
                            <select id="ppdb_pindahkelas" name="pindahkelas" class="form-control" >
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label>Tanggal Mendaftar</label>
                            <input type="text" id="ppdb_pindahtgl" name="pindahtgl" class="form-control" placeholder="Tanggal Pindah">
                        </div> 
                        <div class="col-lg-3">
                            <label>di Tingkat</label>
                            <select id="ppdb_pindahkekls" name="pindahkekls" class="form-control" >
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="semester1" id="ppdb_semester1" value="">
                <input type="hidden" name="semester2" id="ppdb_semester2" value="">
                <input type="hidden" name="semester3" id="ppdb_semester3" value="">
                <input type="hidden" name="semester4" id="ppdb_semester4" value="">
                <input type="hidden" name="semester5" id="ppdb_semester5" value="">
                <input type="hidden" name="sumberinfo" id="ppdb_sumberinfo" value="">
                <input type="hidden" name="prestasi1" id="ppdb_prestasi1" value="">
                <input type="hidden" name="prestasi2" id="ppdb_prestasi2" value="">
                <input type="hidden" name="prestasi3" id="ppdb_prestasi3" value="">
                <input type="hidden" name="prestasi4" id="ppdb_prestasi4" value="">
                <input type="hidden" name="scanakta" id="ppdb_scanakta" value="">
                <input type="hidden" name="scanfoto" id="ppdb_scanfoto" value="">
                <input type="hidden" name="scankk" id="ppdb_scankk" value="">
                <input type="hidden" name="scanket" id="ppdb_scanket" value="">
                <input type="hidden" name="scanbukti" id="ppdb_scanbukti" value="">
                <input type="hidden" name="marking" id="ppdb_marking" value="">
                <input type="hidden" name="id_sekolah" id="ppdb_id_sekolah" value="{{Session('sekolah_id_sekolah')}}">
                <div class="form-group">
                    <label>Kesulitan dalam Belajar</label>
                    <input type="text" id="ppdb_kesulitan" name="kesulitan" class="form-control">
                </div>
                <div class="form-group">
                    <label>Jumlah Anggota Keluarga dalam 1 rumah</label>
                    <input type="text" id="ppdb_anggotarumah" name="anggotarumah" class="form-control">
                </div>
                <div class="form-group">
                    <label>Kegiatan yang sudah bisa dilakukan sendiri :</label>
                    <input type="text" id="ppdb_kegiatansendiri" name="kegiatansendiri" class="form-control">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>Penglihatan</label>
                            <select id="ppdb_mata" name="mata" class="form-control" >
                                <option value="Normal">Normal</option>
                                <option value="Berkacama Minus">Berkacama Minus</option>					 
                            </select>
                        </div> 
                        <div class="col-lg-3">
                            <label>Pendengaran</label>
                            <select id="ppdb_telinga" name="telinga" class="form-control" >
                                <option value="Normal">Normal</option>
                                <option value="Kurang Tanggap Terhadap Suara">Kurang Tanggap Terhadap Suara</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label>Penampilan</label>
                            <select id="ppdb_wajah" name="wajah" class="form-control">
                                <option value="Normal">Normal</option>
                                <option value="Gagap">Gagap</option>
                                <option value="Koordinasi gerakan kurang terkendali">Koordinasi gerakan kurang terkendali</option>
                            </select>
                        </div> 
                        <div class="col-lg-3">
                            <label>Gaya belajar calon siswa (jika diketahui)</label>
                            <select id="ppdb_gybljr" name="gybljr" class="form-control" >
                                <option value="Auditorial">Auditorial</option>
                                <option value="Visual">Visual</option>
                                <option value="Kinestetik">Kinestetik</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Bakat Khusus yang Menonjol</label>
                    <input type="text" id="ppdb_bakat" name="bakat" class="form-control" placeholder="Bakat Khusus yang Menonjol">		  
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>Saudara di sekolah</label>
                            <select id="ppdb_adasaudara" name="adasaudara" class="form-control" >
                                <option value="">Tidak Ada</option>
                                <option value="Ada">Ada</option>
                            </select>
                        </div> 
                        <div class="col-lg-3">
                            <label>Jika ada, Hubungan dengan calon siswa</label>
                            <input type="text" id="ppdb_hubsaudara" name="hubsaudara" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Nama Saudara di Sekolah yang sama</label>
                            <input type="text" id="ppdb_namasaudara" name="namasaudara" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Kelas Saudaranya</label>
                            <input type="text" id="ppdb_kelassaudara" name="kelassaudara" class="form-control">
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
		        <button type="button" class="btn btn-success" id="btnsimpandatappdb">Simpan</button>
	        </div>
        </div>
    </div>
</div>
<input type="hidden" name="makhir" id="makhir" value="now">
<input type="hidden" name="valcari" id="valcari">
<input type="hidden" name="mut_noinduk" id="mut_noinduk">
<input type="hidden" name="mut_nisn" id="mut_nisn">

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="idsurat" id="idsurat" value="">
@endsection

@push('script')
<script type="text/javascript">
    $(function () {
		$('#edit_tgllahir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#mut_tgl').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });

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
    $(document).ready(function () {
        $('.btnkembali').click(function () {
            $('#divawal').show(); 
            $('#divediting').hide(); 
            $('#detailsiswa').hide();
            $('#pengajuan').hide();
            $('#divbukuinduk').hide();
        });
        $('#btntambahsiswa').click(function () {
            $("#edit_nama").val('');
            $("#edit_nik").val('');
            $("#edit_kelamin").val('');
            $("#edit_darah").val('');
            $("#edit_tinggi").val('');
            $("#edit_berat").val('');
            $("#edit_tmplahir").val('');
            $("#edit_tgllahir").val('');
            $("#edit_noinduk").val('');
            $("#edit_nisn").val('');
            $("#edit_ayah").val('');
            $("#edit_ibu").val('');
            $("#edit_kayah").val('');
            $("#edit_kibu").val('');
            $("#edit_wali").val('');
            $("#edit_kwali").val('');
            $("#edit_alamat").val('');
            $("#edit_kel").val('');
            $("#edit_kec").val('');
            $("#edit_rt").val('');
            $("#edit_rw").val('');
            $("#edit_kota").val('');
            $("#edit_kodepos").val('');
            $("#edit_hape").val('');
            $("#edit_kelas").val('');
            $("#edit_mutasi").val('');
            $("#edit_asal").val('');
            $("#edit_alamatsaatini").val('');
            $("#edit_kelsaatini").val('');
            $("#edit_kecsaatini").val('');
            $("#edit_rtsaatini").val('');
            $("#edit_rwsaatini").val('');
            $("#edit_kotasaatini").val('');
            $("#edit_kodepossaatini").val('');
            $("#edit_nokelulusan").val('');
            $("#id_melanjutkankeopsi").val('');
            $("#id_melanjutkanketeks").val('');
            $("#edit_kibuteks").val('');
            $("#edit_kayahteks").val('');
            $("#edit_idne").val('new');
            $("#edit_isasuh").val('0');
            $('#divediting').show();
            $('#divawal').hide();
            $('#edit_kayahopsi').show();
            $('#edit_kibuopsi').show();
            $('#id_melanjutkankeopsi').show();
            $('#id_melanjutkanketeks').hide();
            $('#edit_kibuteks').hide();
            $('#edit_kayahteks').hide();
            $('#edit_foto').val('');
            $('#preview').attr('src', 'dist/img/takadagambar.jpg');
        });
        $('#btnviewbukuinduk').click(function () {
            $('#detailsiswa').hide();
            $('#tabelsiswa').hide();
            $('#btncetakbukuinduk').hide();
            $('#divbukuinduk').show();
            $('#tabelawal').show();
            $('#divawal').hide();
        });
        $('#btnsimpansiswa').click(function () {
            var formdata = new FormData($('#kt_form')[0]);
                formdata.set('_token', '{{ csrf_token() }}');
            var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
            $.ajax({
                url         : '{{ route("exupdDatainduk") }}',
                data        : formdata,
                type        : 'POST',
                contentType : false,
                processData : false,
                success     : function (data) {
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
                    $('#divediting').hide();
                    $('#divawal').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $("#griddatainduk").jqxGrid('updatebounddata', 'filter');
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
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
        });
        $('#btnsimpandatappdb').click(function () {
            var formdata = new FormData($('#formpelengkappsb')[0]);
                formdata.set('_token', '{{ csrf_token() }}');
            var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
            $.ajax({
                url         : '{{ route("exupdDataPSB") }}',
                data        : formdata,
                type        : 'POST',
                contentType : false,
                processData : false,
                success     : function (data) {
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
                    $("#formdatappdb").modal('hide');
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $("#griddatainduk").jqxGrid('updatebounddata', 'filter');
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
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
        });
        $('#btnboxkembali').click(function () {
            $('#divbukuinduk').hide();
            $('#divawal').show();
        });
        $('#btnboxkembalidrdetail').click(function () {
            $('#detailsiswa').hide();
            $('#divbukuinduk').show();
        });
        $('#btncetakbiodata').click(function () {
            var set01	= document.getElementById('induk_dataview').value;
            var set02	= document.getElementById('valcari').value;
            $.post('{{ route("jsonViewDatainduk") }}', { val01: set01, val02: set02, _token: '{{ csrf_token() }}' },
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
        $('#btnviewperangkatan').click(function () {
            var set01	= 'angkatan';
            var set02	= document.getElementById('induk_angkatan').value;
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id',type: 'text'},	
                    { name: 'foto',type: 'text'},	
                    { name: 'nomor',type: 'text'},	
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
                    { name: 'is_asuh',type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, _token: '{{ csrf_token() }}'},
                url : '{{ route("jsonCariDatainduk") }}',
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('#tabelsiswa').show();
            $('#btncetakbukuinduk').show();
            $('#tabelawal').hide();
            $('#detailsiswa').hide();
            $("#gridtabelsiswa").jqxGrid({
                width: '100%',
                pageable: false,
                autoheight: true,
                rowsheight: 35,
                source: dataAdapter,
                theme: "energyblue",
                selectionmode: 'singlecell',
                columns: [
                    { text: 'VIEW', columntype: 'button', width: '7%', cellsrenderer: function () {
                        return "VIEW";
                        }, buttonclick: function (row) {
                            editrow 		= row;
                            var offset 		= $("#gridtabelsiswa").offset();
                            var dataRecord 	= $("#gridtabelsiswa").jqxGrid('getrowdata', editrow);
                            var set01		= dataRecord.id;
                            var foto		= dataRecord.foto;
                            $("#induk_dataview").val('1');
                            if (foto == '' || foto == null){
                                var foto   = 'mascot.png';
                            } else {
                                var foto   = '/dist/img/foto/'+foto;
                            }
                            $('#picprofile').attr('src', foto);
                            $("#titelnama").html('Profil '+dataRecord.nama);
                            $("#valcari").val(dataRecord.id);
                            $('#divbukuinduk').hide();
                            $('#detailsiswa').show();
                            var sourcegrafik = {
                                datatype: "json",
                                datafields: [
                                    { name: 'jenis' },
                                    { name: 'jumlah' },
                                ],
                                type: 'POST',
                                data: {val01: set01, _token: '{{ csrf_token() }}'},
                                url : '{{ route("jsonStatistikDatakd") }}',
                            };
                            var datajrekap		= new $.jqx.dataAdapter(sourcegrafik);
                            var settinggrafik 	= {
                                title: "Statistik",
                                description: "Penilaian vs Evaluasi",
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
                                url : '{{ route("jsonStatDatapermuatan") }}',
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
                                                { dataField : 'jumlah3', displayText: 'Rata-Rata P-E' },
                                                { dataField : 'jumlah4', displayText: 'Rata-Rata PTS-PAS' },
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
                                url : '{{ route("jsonStatDatakehadiran") }}',
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
                            $.post('{{ route("jsonViewDatainduk") }}', { val01: '1', val02: set01, _token: '{{ csrf_token() }}' },
                            function(data){
                                $('#divdataview').html(data);
                                return false;
                            });
                        }
                    },
                    { text: 'No. Urut', editable: false, sortable: false, filterable: false, datafield: 'nomor', width: '8%', cellsalign: 'center', align: 'center' },
                    { text: 'Photo', editable: false, sortable: false, filterable: false, datafield: 'lampiran', width: '6%', cellsalign: 'center', align: 'center' },
                    { text: 'No. Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'No. NISN',  datafield: 'nisn', width: '12%', cellsalign: 'center', align: 'center' },
                    { text: 'Nama Siswa', datafield: 'nama', width: '35%', align: 'center' },
                    { text: 'L/P', datafield: 'kelamin', width: '7%', cellsalign: 'center', align: 'center' },
                    { text: 'Keterangan', datafield: 'nokelulusan', width: '15%', cellsalign: 'left', align: 'center' },
                ]
            });
        });
        $("#induk_dataview").on('change', function () {
            var set01	= $(this).find('option:selected').attr('value');
            var set02	= document.getElementById('valcari').value;
            $.post('{{ route("jsonViewDatainduk") }}', { val01: set01, val02: set02, _token: '{{ csrf_token() }}' },
            function(data){
                $('#divdataview').html(data);
                return false;
            });
        });
        $('#btncetakbukuinduk').click(function(){
            var gridContent = $("#gridtabelsiswa").jqxGrid('exportdata', 'json');
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
        $('#pengajuan').hide();
        $('#divediting').hide();
        $('#detailsiswa').hide(); 
        $('#divbukuinduk').hide();
        var source = {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'panggilan', type: 'text'},
                { name: 'agama', type: 'text'},
                { name: 'bakat', type: 'text'},
                { name: 'gybljr', type: 'text'},
                { name: 'gayah', type: 'text'},
                { name: 'gibu', type: 'text'},
                { name: 'payah', type: 'text'},
                { name: 'pibu', type: 'text'},
                { name: 'nama', type: 'text'},
                { name: 'nik', type: 'text'},
                { name: 'kelamin', type: 'text'},
                { name: 'tmplahir', type: 'text'},
                { name: 'tgllahir', type: 'text'},
                { name: 'noinduk', type: 'integer'},
                { name: 'nisn', type: 'text'},
                { name: 'tinggi', type: 'text'},
                { name: 'berat', type: 'text'},
                { name: 'namaayah', type: 'text'},
                { name: 'namaibu', type: 'text'},
                { name: 'kerjaayah', type: 'text'},
                { name: 'kerjaibu', type: 'text'},
                { name: 'wali', type: 'text'},
                { name: 'pekerjaanwali', type: 'text'},
                { name: 'alamatortu', type: 'text'},
                { name: 'erte', type: 'text'},
                { name: 'erwe', type: 'text'},
                { name: 'kelurahan', type: 'text'},
                { name: 'kecamatan', type: 'text'},
                { name: 'kota', type: 'text'},
                { name: 'kodepos', type: 'text'},
                { name: 'jalansaatini', type: 'text'},
                { name: 'rtsaatini', type: 'text'},
                { name: 'rwsaatini', type: 'text'},
                { name: 'desasaatini', type: 'text'},
                { name: 'kecamatansaatini', type: 'text'},
                { name: 'kotasaatini', type: 'text'},
                { name: 'kodepossaatini', type: 'text'},
                { name: 'darah', type: 'text'},			
                { name: 'klspos', type: 'text'},
                { name: 'foto', type: 'text'},
                { name: 'tamasuk', type: 'text'},
                { name: 'lampiran', type: 'text'},
                { name: 'hape', type: 'text'},
                { name: 'mutasi', type: 'text'},
                { name: 'asal', type: 'text'},
                { name: 'nokelulusan', type: 'text'},
                { name: 'melanjutkanke', type: 'text'},
                { name: 'jilid', type: 'text'},
                { name: 'is_asuh'},
            ],
            url     : '{{ route("jsonDatainduk") }}',
            cache   : false,
        };
        var listSource = [
			{ label: 'TA.Masuk', value: 'tamasuk', checked: true },
			{ label: 'No Induk', value: 'noinduk', checked: true},
			{ label: 'NISN', value: 'nisn', checked: true},
			{ label: 'Photo', value: 'photorenderer', checked: true },
			{ label: 'NIK', value: 'nik', checked: true},
			{ label: 'Nama Siswa', value: 'nama', checked: true },
			{ label: 'Panggilan', value: 'panggilan', checked: true},
			{ label: 'Kelamin', value: 'kelamin', checked: true },
			{ label: 'Kelas Umum', value: 'klspos', checked: true},
			{ label: 'Kelas Quran', value: 'jilid', checked: true},
			{ label: 'Tinggi', value: 'tinggi', checked: true},
			{ label: 'Berat', value: 'berat', checked: true},
			{ label: 'Tempat Lahir', value: 'tmplahir', checked: true},
			{ label: 'Tanggal Lahir', value: 'tgllahir', checked: true},
			{ label: 'Ayah', value: 'namaayah', checked: true},
			{ label: 'Ibu', value: 'namaibu', checked: true},
			{ label: 'Pekerjaan Ayah', value: 'kerjaayah', checked: true},
			{ label: 'Pekerjaan Ibu', value: 'kerjaibu', checked: true},
			{ label: 'Gaji Ayah', value: 'gayah', checked: true},
			{ label: 'Gaji Ibu', value: 'gibu', checked: true},
			{ label: 'Nama Wali', value: 'wali', checked: true},
            { label: 'Pekerjaan Wali', value: 'pekerjaanwali', checked: true},
            { label: 'Nomor HP', value: 'hape', checked: true},
            { label: 'Jalan Sesuai KK', value: 'alamatortu', checked: true},
            { label: 'RT Sesuai KK', value: 'erte', checked: true},
            { label: 'RW Sesuai KK', value: 'erwe', checked: true},
            { label: 'Desa Sesuai KK', value: 'kelurahan', checked: true},
            { label: 'Kecamatan Sesuai KK', value: 'kecamatan', checked: true},
            { label: 'Kabupaten Sesuai KK', value: 'kota', checked: true},
            { label: 'KodePOS Sesuai KK', value: 'kodepos', checked: true},
            { label: 'Jalan Saat Ini', value: 'jalansaatini', checked: true},
            { label: 'RT Saat Ini', value: 'rtsaatini', checked: true},
            { label: 'RW Saat Ini', value: 'rwsaatini', checked: true},
            { label: 'Desa Saat Ini', value: 'desasaatini', checked: true},
            { label: 'Kecamatan Saat Ini', value: 'kecamatansaatini', checked: true},
            { label: 'Kabupaten Saat Ini', value: 'kotasaatini', checked: true},
            { label: 'KodePOS Saat Ini', value: 'kodepossaatini', checked: true},
            { label: 'Status', value: 'nokelulusan', checked: true},
            { label: 'Lanjut Ke', value: 'melanjutkanke', checked: true},
		];
        $("#jqxlistbox").jqxListBox({ source: listSource, width: '100%', height: 800,  checkboxes: true });
		$("#jqxlistbox").on('checkChange', function (event) {
			$("#griddatainduk").jqxGrid('beginupdate');
			if (event.args.checked) {
				$("#griddatainduk").jqxGrid('showcolumn', event.args.value);
			} else {
				$("#griddatainduk").jqxGrid('hidecolumn', event.args.value);
			}
			$("#griddatainduk").jqxGrid('endupdate');
		});
        var photorenderer = function (row, column, value) {
            var name = $('#griddatainduk').jqxGrid('getrowdata', row).lampiran;
            var img = '<div style="background: white;"><img style="margin:2px; margin-left: 10px;" width="32" height="32" src="' + name + '"></div>';
            return img;
        }
        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#griddatainduk").jqxGrid({
            width               : '100%',
            showfilterrow       : true,
            rowsheight          : 45,
            filterable          : true,                
            columnsresize       : true,
            autoshowfiltericon  : true,
            pageable            : true,
            autoheight          : true,
            theme               : "energyblue",
            source              : dataAdapter,
            sortable            : true,
            ready: function () {
                $("#griddatainduk").jqxGrid('sortby', 'noinduk', 'asc');
            },
            columns             : [
                { text: 'Edit', cellsalign: 'center', align: 'center', editable: false, sortable: false, filterable: false,  columntype: 'button', width: 50, cellsrenderer: function () {
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
                        $("#edit_alamatsaatini").val(dataRecord.jalansaatini);
                        $("#edit_kelsaatini").val(dataRecord.desasaatini);
                        $("#edit_kecsaatini").val(dataRecord.kecamatansaatini);
                        $("#edit_rtsaatini").val(dataRecord.rtsaatini);
                        $("#edit_rwsaatini").val(dataRecord.rwsaatini);
                        $("#edit_kotasaatini").val(dataRecord.kotasaatini);
                        $("#edit_kodepossaatini").val(dataRecord.kodepossaatini);
                        $("#edit_hape").val(dataRecord.hape);
                        $("#edit_tahun").val(dataRecord.tamasuk);
                        $("#edit_kelas").val(dataRecord.klspos);
                        $("#edit_mutasi").val(dataRecord.mutasi);
                        $("#edit_asal").val(dataRecord.asal);
                        $("#edit_isasuh").val(dataRecord.is_asuh);
                        $("#edit_nokelulusan").val(dataRecord.nokelulusan);
                        $("#id_melanjutkankeopsi").val(dataRecord.melanjutkanke);
                        $('#edit_foto').val('');
                        $('#preview').attr('src', dataRecord.lampiran);
                        $('#divediting').show();
                        $('#divawal').hide();
                        $('#edit_kayahopsi').show();
                        $('#edit_kibuopsi').show();
                        $('#id_melanjutkankeopsi').show();
                        $('#id_melanjutkanketeks').hide();
                        $('#edit_kibuteks').hide();
                        $('#edit_kayahteks').hide();
                    }
                },
                { text: 'VIEW', cellsalign: 'center', align: 'center', editable: false, sortable: false, filterable: false, columntype: 'button', width: 70, cellsrenderer: function () {
					return "VIEW";
					}, buttonclick: function (row) {
						editrow 		= row;
						var offset 		= $("#griddatainduk").offset();
						var dataRecord 	= $("#griddatainduk").jqxGrid('getrowdata', editrow);
						var set01		= dataRecord.id;
						var set02		= dataRecord.foto;
						if (set02 == '' || set02 == null){
                            var set02   = 'mascot.png';
                        } else {
                            var set02   = '/dist/img/foto/'+set02;
                        }
                        $("#induk_dataview").val('1');
                        $("#titelnama").html('Profil '+dataRecord.nama);
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
							url : '{{ route("jsonStatistikDatakd") }}',
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
							url: '{{ route("jsonStatDatapermuatan") }}',
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
							url: '{{ route("jsonStatDatakehadiran") }}',
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
						$.post('{{ route("jsonViewDatainduk") }}', { val01: '1', val02: set01, _token: '{{ csrf_token() }}' },
						function(data){
							$('#divdataview').html(data);
							return false;
						});
					}
				},
                { text: 'Data PPDB', cellsalign: 'center', align: 'center', editable: false, sortable: false, filterable: false,  columntype: 'button', width: 70, cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow         = row;
                        var offset 		= $("#griddatainduk").offset();
                        var dataRecord 	= $("#griddatainduk").jqxGrid('getrowdata', editrow);
                        var niksiswa    = dataRecord.nik;
                        var scanakta    = niksiswa+'-Akte';
                        var scankk      = niksiswa+'-KSK';
                        var scanket     = niksiswa+'-SKL';
                        var scanfoto    = niksiswa+'-Foto';
                        var scanbukti   = niksiswa+'-BuktiBayar';
                        $("#ppdb_marking").val(dataRecord.id);
                        $("#ppdb_nama").val(dataRecord.nama);
                        $("#ppdb_nik").val(dataRecord.nik);
                        $("#ppdb_panggilan").val(dataRecord.panggilan);
                        $("#ppdb_scanakta").val(scanakta);
                        $("#ppdb_scankk").val(scankk);
                        $("#ppdb_scanket").val(scanket);
                        $("#ppdb_scanfoto").val(scanfoto);
                        $("#ppdb_scanbukti").val(scanbukti);
                        $.post('{{ route("jsonCariDatainduk") }}', { val01: 'datapelengkapsiswa', val02: dataRecord.id, val03: dataRecord.nik, val04: dataRecord.panggilan, val05: dataRecord.nama, _token: '{{ csrf_token() }}' },
                        function(data){
                            var data = JSON.parse(data);
                            if (typeof data === 'object' && data !== null) {
                                Object.keys(data).forEach(function(key) {
                                    var propertyName = String(key);
                                    var inputField = $('#ppdb_' + propertyName);
                                    if (inputField.length) {
                                        inputField.val(data[key]);
                                        console.log(data[key]);
                                    }
                                });
                            }
                            $("#formdatappdb").modal('show');
                            return false;
                        });
                    }
                },
				{ text: 'TA.Masuk', filtertype: 'checkedlist', datafield: 'tamasuk', width: 100, cellsalign: 'center', align: 'center' },
                { text: 'No. Induk',  datafield: 'noinduk', width: 80, cellsalign: 'center', align: 'center' },
                { text: 'No. NISN',  datafield: 'nisn', width: 100, cellsalign: 'left', align: 'center' },
                { text: 'Photo',  editable: false, sortable: false, filterable: false, cellsrenderer: photorenderer, width: 50, cellsalign: 'center', align: 'center' },
                { text: 'NIK',  datafield: 'nik', width: 180, cellsalign: 'left', align: 'center' },
                { text: 'Nama Siswa', datafield: 'nama', width: 150, align: 'center' },
                { text: 'Nama Panggilan', datafield: 'panggilan', width: 80, align: 'center' },
                { text: 'L/P', filtertype: 'checkedlist', datafield: 'kelamin', width: 40, cellsalign: 'center', align: 'center' },
                { text: 'Kelas Umum', filtertype: 'checkedlist', datafield: 'klspos', width: 50, cellsalign: 'center', align: 'center' },
                { text: 'Kelas Quran', filtertype: 'checkedlist', datafield: 'jilid', width: 50, cellsalign: 'center', align: 'center' },
                { text: 'Tinggi Badan', datafield: 'tinggi', width: 50, cellsalign: 'center', align: 'center' },
                { text: 'Berat Badan', datafield: 'berat', width: 50, cellsalign: 'center', align: 'center' },
                { text: 'Tempat Lahir', datafield: 'tmplahir', width: 100, cellsalign: 'center', align: 'center' },
                { text: 'Tanggal lahir', datafield: 'tgllahir', width: 100, cellsalign: 'center', align: 'center' },
                { text: 'Nama Ayah',  datafield: 'namaayah', width: 150, cellsalign: 'left', align: 'center' },
                { text: 'Nama Ibu',  datafield: 'namaibu', width: 150, cellsalign: 'left', align: 'center' },
                { text: 'Pekerjaan Ayah', datafield: 'kerjaayah', width: 100, cellsalign: 'left', align: 'center' },
                { text: 'Pekerjaan Ibu', datafield: 'kerjaibu', width: 100, cellsalign: 'left', align: 'center' },
                { text: 'Gaji Ayah', filtertype: 'checkedlist', datafield: 'gayah', width: 100, cellsalign: 'left', align: 'center' },
                { text: 'Gaji Ibu', filtertype: 'checkedlist', datafield: 'gibu', width: 100, cellsalign: 'left', align: 'center' },
                { text: 'Nama Wali',  datafield: 'wali', width: 150, cellsalign: 'left', align: 'center' },
                { text: 'Pekerjaan Wali',  datafield: 'pekerjaanwali', width: 100, cellsalign: 'left', align: 'center' },
                { text: 'No.HP Ortu/Wali',  datafield: 'hape', width: 120, cellsalign: 'left', align: 'center' },
                { text: 'Jalan',  columngroup: 'kelompok01', datafield: 'alamatortu', width: 200, cellsalign: 'left', align: 'center' },
                { text: 'RT',  columngroup: 'kelompok01', datafield: 'erte', width: 70, cellsalign: 'left', align: 'center' },
                { text: 'RW',  columngroup: 'kelompok01', datafield: 'erwe', width: 70, cellsalign: 'left', align: 'center' },
                { text: 'Kelurahan/Desa',  columngroup: 'kelompok01', datafield: 'kelurahan', width: 100, cellsalign: 'left', align: 'center' },
                { text: 'Kecamatan',  columngroup: 'kelompok01', datafield: 'kecamatan', width: 100, cellsalign: 'left', align: 'center' },
                { text: 'Kota/Kab',  columngroup: 'kelompok01', datafield: 'kota', width: 100, cellsalign: 'left', align: 'center' },
                { text: 'KodePOS',  columngroup: 'kelompok01', datafield: 'kodepos', width: 70, cellsalign: 'left', align: 'center' },
                { text: 'Jalan Saat Ini',  columngroup: 'kelompok02', datafield: 'jalansaatini', width: 200, cellsalign: 'left', align: 'center' },
                { text: 'RT Saat Ini',  columngroup: 'kelompok02', datafield: 'rtsaatini', width: 70, cellsalign: 'left', align: 'center' },
                { text: 'RW Saat Ini',  columngroup: 'kelompok02', datafield: 'rwsaatini', width: 70, cellsalign: 'left', align: 'center' },
                { text: 'Kelurahan/Desa  Saat Ini',  columngroup: 'kelompok02', datafield: 'desasaatini', width: 100, cellsalign: 'left', align: 'center' },
                { text: 'Kecamatan  Saat Ini',  columngroup: 'kelompok02', datafield: 'kecamatansaatini', width: 100, cellsalign: 'left', align: 'center' },
                { text: 'Kota/Kab  Saat Ini',  columngroup: 'kelompok02', datafield: 'kotasaatini', width: 100, cellsalign: 'left', align: 'center' },
                { text: 'KodePOS  Saat Ini',  columngroup: 'kelompok02', datafield: 'kodepossaatini', width: 70, cellsalign: 'left', align: 'center' },
                { text: 'Status Lulus/Mutasi',  datafield: 'nokelulusan', width: 180, cellsalign: 'left', align: 'center' },
                { text: 'Melanjutkan Ke',  datafield: 'melanjutkanke', width: 180, cellsalign: 'left', align: 'center' },
                { text: 'Mutasi', cellsalign: 'center', align: 'center', editable: false, sortable: false, filterable: false,  columntype: 'button', width: 50, cellsrenderer: function () {
                    return "Mutasi";
                    }, buttonclick: function (row) {
                        editrow         = row;
                        var offset 		= $("#griddatainduk").offset();
                        var dataRecord 	= $("#griddatainduk").jqxGrid('getrowdata', editrow);
                        $("#mut_nama").val(dataRecord.nama);
                        $("#mut_noinduk").val(dataRecord.noinduk);
                        $("#mut_nisn").val(dataRecord.nisn);
                        $("#formmutasi").modal('show');
                    }
                },
            ],
            columngroups: 
            [
                { text: 'Alamat Sesuai KK', align: 'center', name: 'kelompok01' },
                { text: 'Alamat Saat Ini', align: 'center', name: 'kelompok02' },
            ]
        });
        $("#induk_dataview").on('change', function () {
            var set01	= $(this).find('option:selected').attr('value');
            var set02	= document.getElementById('valcari').value;
            $.post('{{ route("jsonViewDatainduk") }}', { val01: set01, val02: set02, _token: '{{ csrf_token() }}' },
            function(data){
                $('#divdataview').html(data);
                return false;
            });
        });
        $("#edit_kibuopsi").on('change', function () {
            var set01	= $(this).find('option:selected').attr('value');
            if (set01 == 'Lainnya'){
                $('#edit_kibuopsi').hide();
                $('#edit_kibuteks').show();
            }
        });
        $("#edit_kayahopsi").on('change', function () {
            var set01	= $(this).find('option:selected').attr('value');
            if (set01 == 'Lainnya'){
                $('#edit_kayahopsi').hide();
                $('#edit_kayahteks').show();
            }
        });
        $("#id_melanjutkankeopsi").on('change', function () {
            var set01	= $(this).find('option:selected').attr('value');
            if (set01 == 'Lainnya'){
                $('#id_melanjutkankeopsi').hide();
                $('#id_melanjutkanketeks').show();
            }
        });
        $('#simpanmutasi').click(function () {
            var set01=document.getElementById('mut_nama').value;
            var set02=document.getElementById('mut_noinduk').value;
            var set03=document.getElementById('mut_nisn').value;
            var set04=document.getElementById('mut_tahun').value;
            var set05=document.getElementById('mut_tgl').value;
            var set06=document.getElementById('mut_tujuan').value;
            var set07=document.getElementById('mut_almtsd').value;
            var set08=document.getElementById('mut_alasan').value;
            var token=document.getElementById('token').value;
            $.post('{{ route("exSimpanmutasi") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, _token: token },
            function(data){	
                $("#formmutasi").modal('hide');
                $("#griddatainduk").jqxGrid('updatebounddata', 'filter');
                $('#status').html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");
                return false;
            });
        });
        $("#exportgrid").click(function () {
            var gridContent = $("#griddatainduk").jqxGrid('exportdata', 'json');
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
                            td.setAttribute('style', 'mso-number-format: "\@";');
                            td.innerHTML = isi2;
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
        $("#btnprintgrid").click(function () {
            var gridContent = $("#griddatainduk").jqxGrid('exportdata', 'html');
            var tglcetak    = '<?php echo date("j F Y"); ?>';
            var newWindow   = window.open('', '', 'width=800, height=500'),
                document    = newWindow.document.open(),
                pageContent =
                    '<!DOCTYPE html>\n' +
                    '<html>\n' +
                    '<head>\n' +
                    '<meta charset="utf-8" />\n' +
                    '<title>Laporan Keuangan</title>\n' +
                    '</head>\n' +
                    '<body> <h2>Data Induk</h2> <br /> Dicetak Pada Tanggal : ' + tglcetak + '\n' + gridContent + '\n</body>\n</html>';
                document.write(pageContent);
                document.close();
                newWindow.print();
            return false;
        });
	});
</script>
@endpush