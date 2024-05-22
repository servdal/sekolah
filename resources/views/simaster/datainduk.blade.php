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
                                <button type="button" class="btn btn-tool" id="exportgrid"><i class="fa fa-print"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="griddatainduk"></div>
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
									<td colspan="3" align="center">20533897</td>
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
								<tr><td colspan="2">&nbsp;</td><td  colspan="2">NAMA SEKOLAH</td><td align="center">:</td><td><input type="text" class="form-control" value="{!! $sekolah !!}" readonly></td><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td  colspan="2">STATUS SEKOLAH</td><td align="center">:</td><td><input type="text" class="form-control" value="SWASTA" readonly></td><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td  colspan="2">ALAMAT SEKOLAH</td><td align="center">:</td><td><input type="text" class="form-control" value="{!! $alamat !!}" readonly></td><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td  colspan="2">DESA/KELURAHAN</td><td align="center">:</td><td><input type="text" class="form-control" value="LOWOKWARU" readonly></td><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td  colspan="2">KECAMATAN</td><td align="center">:</td><td><input type="text" class="form-control" value="LOWOKWARU" readonly></td><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td  colspan="2">KABUPATEN/KOTA</td><td align="center">:</td><td><input type="text" class="form-control" value="{!! config('global.kota') !!}" readonly></td><td colspan="2">&nbsp;</td></tr>
								<tr><td colspan="2">&nbsp;</td><td  colspan="2">PROVINSI</td><td align="center">:</td><td><input type="text" class="form-control" value="JAWA TIMUR" readonly></td><td colspan="2">&nbsp;</td></tr>
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
                                    <div class="col-lg-4">
                                        <label>TAPEL Diterima *)</label>
                                        <input type="text" id="edit_tahun" name="edit_tahun" class="form-control" value="{{$tapel}}">
                                    </div> 
                                    <div class="col-lg-4">
                                        <label>Kelas Umum</label>
                                        <input type="number" min="1" max="12" id="edit_kelas" name="edit_kelas" class="form-control">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Kelas Al Quran</label>
                                        <input type="number" min="1" max="7" id="edit_jilid" name="edit_jilid" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <label for="edit_nama">Nama Siswa *)</label>
                                        <div class="input-group">
                                            <input type="text" id="edit_nama" name="edit_nama" class="form-control">			  
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
                                            <input type="text" id="edit_karakter" name="edit_karakter" class="form-control" placeholder="Bila diketahui">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-smile-o"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
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
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>NIK Siswa *)</label>
                                        <input type="text" id="edit_nik" name="edit_nik" class="form-control">			  
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="edit_tmplahir">Tempat lahir</label>
                                        <input type="text" id="edit_tmplahir" name="edit_tmplahir" class="form-control">
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <label for="edit_tgllahir">Tgl.Lahir</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <input value="{{date('Y-m-d')}}" type="text" class="form-control" id="edit_tgllahir" name="tanggallahir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <label for="edit_kelamin">Kelamin</label>
                                        <div class="input-group">
                                            <select id="edit_kelamin" name="edit_kelamin" class="form-control">
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
                                        <input type="text" id="edit_ayah" name="edit_ayah" class="form-control" placeholder="Ayah">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Pendidikan Terakhir Ayah</label>
                                        <input type="text" id="id_payah" name="id_payah" class="form-control" placeholder="Pendidikan Ayah">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Pekerjaan Ayah</label>
                                        <select id="edit_kayah" name="edit_kayah" class="form-control" >
                                            <option value="12 Tidak bekerja">Tidak bekerja</option>
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
										  	<option value="13 Pedagang">Tidak dapat diterapkan</option>
										  	<option value="14 Wiraswasta">Wiraswasta</option>
										  	<option value="15 Wirausaha">Wirausaha</option>
										</select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Penghasilan Perbulan Ayah</label>
                                        <select id="id_gayah" name="id_gayah" class="form-control" >
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
                                       <input type="text" id="edit_ibu" name="edit_ibu" class="form-control" placeholder="Ibu">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Pendidikan Terakhir Ibu</label>
                                        <input type="text" id="id_pibu" name="id_pibu" class="form-control" placeholder="Pendidikan Ibu">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Pekerjaan Ibu</label>
                                        <select id="edit_kibu" name="edit_kibu" class="form-control" >
                                            <option value="12 Tidak bekerja">Tidak bekerja</option>
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
										  	<option value="13 Pedagang">Tidak dapat diterapkan</option>
										  	<option value="14 Wiraswasta">Wiraswasta</option>
										  	<option value="15 Wirausaha">Wirausaha</option>
										</select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Penghasilan Perbulan Ibu</label>
                                        <select id="id_gibu" name="id_gibu" class="form-control">
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
                                        <img id="preview" src="{{asset('dist/img/takadagambar.png')}}" width="150px" height="150px"/>
                                        <a href="javascript:removeImage()" class="btn btn-xs btn-danger pull-right">
                                            <i class="fa fa-trash"></i> Clear Image
                                        </a>
                                    </div>				 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>No.Induk *)</label>
                                        <input type="text" id="edit_noinduk" name="edit_noinduk" class="form-control" placeholder="No. Induk">
                                    </div> 
                                    <div class="col-lg-4">
                                        <label>No.NISN</label>
                                        <input type="text" id="edit_nisn" name="edit_nisn" class="form-control" placeholder="No. NISN" >
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Set Sebagai Anak Asuh.?</label>
                                        <select id="edit_isasuh" name="edit_isasuh" class="form-control">
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Asal TK/TA/RA</label>
                                <input type="text" id="edit_asal" name="edit_asal" class="form-control">		  
                            </div>
                            <div class="form-group">
                                <label>Asal SD (Bila Mutasi)</label>
                                <input type="text" id="edit_mutasi" name="edit_mutasi" class="form-control">		  
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
                </div>
            </div>
        </div>
    </section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
    <div class="tabel_cetak"></div>		
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
                        <div class="col-xs-6">
                            <label>TAPEL Mutasi *)</label>
                            <input type="text" id="mut_tahun" name="mut_tahun" class="form-control" value="{{$tapel}}">
                        </div> 
                        <div class="col-xs-6">
                            <label>Tanggal Mutasi</label>
                            <input type="text" id="mut_tgl" name="mut_tgl" class="form-control">
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
<input type="hidden" name="makhir" id="makhir" value="now">
<input type="hidden" name="valcari" id="valcari">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="idsurat" id="idsurat" value="">
@endsection

@push('script')
<script type="text/javascript">
    $(function () {
		$('#edit_tgllahir').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
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
    });
    $('.btnpengajuan').on('click', function (){
        var set01		= $(this).attr('data-id');
        var set02		= $(this).attr('data-noinduk');
        $("#idsurat").val(set01);
        $('#divawal').hide();
        $('#pengajuan').show();
        $.post('{{ route("jsonViewDatainduk") }}', { val01: '1', val02: set02, _token: '{{ csrf_token() }}' },
        function(data){
            $('#kesediaan_profil').html(data);
            return false;
        });
    });
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
            $("#edit_idne").val('new');
            $("#edit_isasuh").val('0');
            $('#divediting').show();
            $('#divawal').hide();
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
                    if (icon == 'error'){
                        swal({
                            title   : status,
                            text    : message,
                            type    : icon,
                        })
                    } else {
                        $.toast({
                            heading: status,
                            text: message,
                            position: 'top-right',
                            loaderBg: warna,
                            icon: icon,
                            hideAfter: 5000,
                            stack: 1
                        });
                        $('#divediting').hide();
                        $('#divawal').show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $("#griddatainduk").jqxGrid("updatebounddata");
                    }
                    return false;
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
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
                            $("#induk_dataview").val('1');
                            $('#picprofile').attr('src', dataRecord.foto);
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
                { name: 'id',type: 'text'},
                { name: 'panggilan',type: 'text'},
                { name: 'agama',type: 'text'},
                { name: 'bakat',type: 'text'},
                { name: 'gybljr',type: 'text'},
                { name: 'gayah',type: 'text'},
                { name: 'gibu',type: 'text'},
                { name: 'payah',type: 'text'},
                { name: 'pibu',type: 'text'},
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
            url     : '{{ route("jsonDatainduk") }}',
            cache   : false,
            pager   : function (pagenum, pagesize, oldpagenum) {}
        };
        var dataAdapter = new $.jqx.dataAdapter(source, { async: false, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
        var editrow = -1;
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
            selectionmode       : 'multiplecellsextended',
            columns             : [
                { text: 'Edit', editable: false, sortable: false, filterable: false,  columntype: 'button', width: 50, cellsrenderer: function () {
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
				{ text: 'TA.Masuk',  editable: false, sortable: false, filterable: false, datafield: 'tamasuk', width: 100, cellsalign: 'center', align: 'center' },
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
                { text: 'No.HP Ortu/Wali',  datafield: 'hape', width: 120, cellsalign: 'center', align: 'center' },
                { text: 'Alamat Ortu/Wali',  datafield: 'alamatortu', width: 200, cellsalign: 'left', align: 'center' },
                { text: 'Status Lulus/Mutasi',  datafield: 'nokelulusan', width: 180, cellsalign: 'center', align: 'center' },
                { text: 'Mutasi', editable: false, sortable: false, filterable: false,  columntype: 'button', width: 50, cellsrenderer: function () {
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
                $("#griddatainduk").jqxGrid("updatebounddata");
                $('#status').html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");
                return false;
            });
        });
	});
</script>
@endpush