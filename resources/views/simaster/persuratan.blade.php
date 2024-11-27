
@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
	<section class="content-header">
	    <div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"> Persuratan</h1>
				</div>
				<div class="col-sm-6">
                    <div class="btn-group">
                        <a class="btn btn-app btn-primary" id="topbtnsuratkeluar" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Surat Keluar"><i class="fa fa-cloud-upload"></i> KELUAR</a>
                        <a class="btn btn-app btn-success" id="topbtnsuratmasuk" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Surat Masuk"><i class="fa fa-cloud-download"></i> MASUK</a>
                    </div>
				</div>
			</div>
		</div>
    </section>
	<section class="content">
        <div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
                    <div class="card card-success shadow" id="divsuratkeluar">
                        <div class="card-header">
                            <h3 class="card-title" id="judulsuratkeluar"> Nomor Tahun {{date('Y')}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool"  title="Export" id="btnexport"><i class="fa fa-print"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <select id="surat_tahun" name="surat_tahun"  class="form-control">
                                                @php 
                                                    $tahunini       = date('Y');
                                                    $tahunmundur1   = $tahunini - 1;
                                                    $tahunmundur2   = $tahunini - 2;
                                                    $tahunmundur3   = $tahunini - 3;
                                                    $tahunmundur4   = $tahunini - 4;
                                                    $tahunmundur5   = $tahunini - 5;
                                                    echo '<option value="'.$tahunini.'" selected>'.$tahunini.'</option>';
                                                    echo '<option value="'.$tahunmundur1.'">'.$tahunmundur1.'</option>';
                                                    echo '<option value="'.$tahunmundur2.'">'.$tahunmundur2.'</option>';
                                                    echo '<option value="'.$tahunmundur3.'">'.$tahunmundur3.'</option>';
                                                    echo '<option value="'.$tahunmundur4.'">'.$tahunmundur4.'</option>';
                                                    echo '<option value="'.$tahunmundur5.'">'.$tahunmundur5.'</option>';
                                                @endphp
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-caret-square-o-down"></i></div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <select id="surat_filter" name="surat_filter"  class="form-control">
                                                <option value="all">Tampilkan Seluruh Data</option>
                                                <option value="File Uploaded, Signed">Telah tertandatangani</option>
                                                <option value="File Uploaded, Not Signed">Belum  ditandatangani</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-check-square-o"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-primary btn-block" title="Tambah Nomor Baru" id="btnnomorbaru"><i class="fa fa-envelope"></i> Tambah Nomor</button>
                                    </div>
                                    <div class="col-lg-6">
                                        <div id="keterangan"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <table class="table table-bordered table-striped products-list product-list-in-card pl-2 pr-2" id="tabellistnomor">
                                <thead>
                                    <tr>
                                        <th>List</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="card card-success shadow" id="divsuratmasuk">
                        <div class="card-header">
                            <h3 class="card-title" id="judulsuratmasuk"> Nomor Tahun {{date('Y')}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool"  title="Export" id="btnexportsuratmasuk"><i class="fa fa-print"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <select id="suratmasuk_tahun" name="suratmasuk_tahun"  class="form-control">
                                                @php 
                                                    $tahunini       = date('Y');
                                                    $tahunmundur1   = $tahunini - 1;
                                                    $tahunmundur2   = $tahunini - 2;
                                                    $tahunmundur3   = $tahunini - 3;
                                                    $tahunmundur4   = $tahunini - 4;
                                                    $tahunmundur5   = $tahunini - 5;
                                                    echo '<option value="'.$tahunini.'" selected>'.$tahunini.'</option>';
                                                    echo '<option value="'.$tahunmundur1.'">'.$tahunmundur1.'</option>';
                                                    echo '<option value="'.$tahunmundur2.'">'.$tahunmundur2.'</option>';
                                                    echo '<option value="'.$tahunmundur3.'">'.$tahunmundur3.'</option>';
                                                    echo '<option value="'.$tahunmundur4.'">'.$tahunmundur4.'</option>';
                                                    echo '<option value="'.$tahunmundur5.'">'.$tahunmundur5.'</option>';
                                                @endphp
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-caret-square-o-down"></i></div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-primary btn-block" title="Tambah Surat Masuk Baru" id="btnsuratbaru"><i class="fa fa-envelope"></i> Tambah Surat</button>
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="keteranganmasuk"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <table class="table table-bordered table-striped products-list product-list-in-card pl-2 pr-2" id="tabellistsurat">
                                <thead>
                                    <tr>
                                        <th>List</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</section>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
    <button id="downloadQR">Download QR Code</button>                    

</div>
<div class="modal fade" id="modalqrcode">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Save This</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="qrcode"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalarsip">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Arsiparis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-2">
                            <label>No.Surat</label>
                            <input type="text" class="form-control out_nomor" readonly="readonly">
                        </div>
                        <div class="col-lg-2">
                            <label>Tgl.Surat</label>
                            <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput out_tanggal" name="out_tanggal" id="out_tanggalarsip" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask  readonly="readonly"/>
                        </div>
                        <div class="col-lg-8">
                            <label>Perihal</label>
                            <input type="text" class="form-control out_perihal">
                        </div>	
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Ruang Arsip</label>
                            <input type="text" class="form-control" id="out_ruang">
                        </div>
                        <div class="col-lg-4">
                            <label>Ordner</label>
                            <input type="text" class="form-control" id="out_ordner">
                        </div>
                        <div class="col-lg-4">
                            <label>Lemari</label>
                            <input type="text" class="form-control" id="out_lemari">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div id="pdfRenderer"></div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpanarsipkan">Simpan</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltandatangan">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Permohonan Tandatangan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-2">
                            <label>No.Surat</label>
                            <input type="text" class="form-control out_nomor" readonly="readonly">
                        </div>
                        <div class="col-lg-2">
                            <label>Tgl.Surat</label>
                            <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput out_tanggal" id="out_tanggaltte" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                        </div>
                        <div class="col-lg-8">
                            <label>Perihal</label>
                            <input type="text" class="form-control out_perihal" id="out_perihal">
                        </div>	
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Tujuan Surat</label>
                            <input type="text" class="form-control" id="out_kepada">
                        </div>
                        <div class="col-lg-4">
                            <label>Alamat Tujuan</label>
                            <input type="text" class="form-control" id="out_alamat">
                        </div>
                        <div class="col-lg-4">
                            <label>Jenis Surat</label>
                            <select id="out_jenissrt" name="out_jenissrt" size="1" class="form-control select2">
                                <option value="">Pilih Salah Satu</option>
                                <optgroup label="Surat Dinas">
                                    <option value="S">Surat Dinas</option>
                                    <option value="ND">Nota Dinas</option>
                                    <option value="MO">Memo</option>
                                    <option value="SK">Surat Keterangan</option>
                                    <option value="SPY">Surat Pernyataan</option>
                                    <option value="SPO">Surat Purchase Order</option>
                                    <option value="PERM">Surat Permohonan</option>
                                    <option value="NK">Nota Kesepahaman</option>
                                    <option value="NR">Notula Rapat</option>
                                    <option value="LL">Lain-lain</option>
                                    <option value="PEMB">Pemberitahuan</option>
                                    <option value="USUL">Usulan</option>
                                    <option value="IJIN">Surat Ijin</option>
                                    <option value="PENGJ">Surat Pengajuan</option>
                                </optgroup>
                                <optgroup label="Laporan dan Formulir">
                                    <option value="LAP">Laporan</option>
                                    <option value="LHA">Laporan Hasil Audit</option>
                                    <option value="LHAI">Laporan Hasil Audit Investigatif</option>
                                    <option value="LHE">Laporan Hasil Evaluasi</option>
                                    <option value="LA">Laporan Asistensi</option>
                                    <option value="LAA">Laporan Analisis Hasil Audit</option>
                                    <option value="LHT">Laporan Hasil Penelitian</option>
                                    <option value="TS">Telaahan Staf</option>
                                    <option value="LD">Lembar Disposisi</option>
                                    <option value="SPB">Surat Permintaan Barang</option>
                                    <option value="SPMB">Surat Perintah Mengeluarkan Barang</option>
                                    <option value="SPBI">Surat Permintaan Barang Inventaris</option>
                                    <option value="SPMI">Surat Perintah Mengeluarkan Barang Inventaris</option>
                                </optgroup>
                                <optgroup label="Naskah Dinas Bimbingan">
                                    <option value="PDM">Pedoman</option>
                                    <option value="JUK">Petunjuk</option>
                                    <option value="PEM">Pemberitahuan</option>
                                </optgroup>
                                <optgroup label="Naskah Dinas Elektronik">
                                    <option value="FAKS">Faksimile</option>
                                    <option value="TLP">Telepon</option>
                                    <option value="ETR">E-Mail</option>
                                    <option value="TLG">Telegram</option>
                                    <option value="TLK">Teleks</option>
                                </optgroup>
                                <optgroup label="Naskah Dinas Khusus">
                                    <option value="SKU">Surat Kuasa</option>
                                    <option value="KET">Surat Keterangan</option>
                                    <option value="MoU">Memorandum of Understanding</option>
                                    <option value="PRJ">Surat Perjanjian</option>
                                    <option value="BA">Berita Acara</option>
                                    <option value="BAPS">Berita Acara Pengangkatan Sumpah</option>
                                    <option value="UND">Surat Undangan</option>
                                    <option value="SP">Surat Pengantar</option>
                                    <option value="PRT">Surat Peringatan</option>
                                    <option value="SKP">Surat Keterangan Perjalanan</option>
                                    <option value="SI">Surat Ijin</option>
                                    <option value="SPMT">Surat Pernyataan Melaksanakan Tugas</option>
                                    <option value="SPMJ">Surat Pernyataan Menduduki Jabatan</option>
                                    <option value="SPL">Surat Pernyataan Pelantikan</option>
                                    <option value="NST">Naskah Serah Terima Jabatan</option>
                                </optgroup>
                                <optgroup label="Naskah Dinas Pengaturan">
                                    <option value="NS">Instruksi</option>
                                    <option value="KEP">Keputusan</option>
                                    <option value="SE">Surat Edaran </option>
                                    <option value="JLK">Petunjuk Pelaksanaan</option>
                                    <option value="PROT">Prosedur Operasional Standar</option>
                                    <option value="PENG">Pengumuman</option>
                                    <option value="HK">Peraturan</option>
                                </optgroup>
                                <optgroup label="Naskah Dinas Penugasan">
                                    <option value="ST">Surat Tugas</option>
                                    <option value="PRIN">Surat Perintah</option>
                                    <option value="SPPL">Surat Pengukuhan Perintah Lisan</option>
                                    <option value="SPPD">Surat Perintah Perjalanan Dinas</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-7">
                            <select id="out_penandatangan" name="out_penandatangan" class="form-control select2">
                                <option value="0">Pilih Penandatangan</option>
                                @if(isset($karyawans) && !empty($karyawans))
                                    @foreach($karyawans as $jpegub)
                                        <option value="{{ $jpegub->id }}">{{ $jpegub->nama }} ( {{ $jpegub->jabatan }} )</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg-5">
                            <label for="file" class="col-form-label">File Upload</label><br />
							<input type="file" id="out_file" name="out_file" class="btn-light">
                        </div>	
                    </div>
                </div>
                <div class="form-group">
                    
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnkirimkepenadatangan">Simpan</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalsuratmasuk">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Surat Masuk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-2 col-md-2">
                            <label for="id_tglmasuk">Tgl.Masuk</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="id_tglmasuk" name="id_tglmasuk" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <label for="id_tglsurat">Tgl.Surat</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="id_tglsurat" name="id_tglsurat" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <label for="id_nosurat">No. Surat</label>
                            <input type="text" class="form-control" id="id_nosurat" name="id_nosurat">
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <label for="id_jenissurat">Jenis Surat</label>
                            <select id="id_jenissurat" name="id_jenissurat" size="1" class="form-control select2">
                                <option value="">Pilih Salah Satu</option>
                                <optgroup label="Surat Dinas">
                                    <option value="S">Surat Dinas</option>
                                    <option value="ND">Nota Dinas</option>
                                    <option value="MO">Memo</option>
                                    <option value="SK">Surat Keterangan</option>
                                    <option value="SPY">Surat Pernyataan</option>
                                    <option value="SPO">Surat Purchase Order</option>
                                    <option value="PERM">Surat Permohonan</option>
                                    <option value="NK">Nota Kesepahaman</option>
                                    <option value="NR">Notula Rapat</option>
                                    <option value="LL">Lain-lain</option>
                                    <option value="PEMB">Pemberitahuan</option>
                                    <option value="USUL">Usulan</option>
                                    <option value="IJIN">Surat Ijin</option>
                                    <option value="PENGJ">Surat Pengajuan</option>
                                </optgroup>
                                <optgroup label="Laporan dan Formulir">
                                    <option value="LAP">Laporan</option>
                                    <option value="LHA">Laporan Hasil Audit</option>
                                    <option value="LHAI">Laporan Hasil Audit Investigatif</option>
                                    <option value="LHE">Laporan Hasil Evaluasi</option>
                                    <option value="LA">Laporan Asistensi</option>
                                    <option value="LAA">Laporan Analisis Hasil Audit</option>
                                    <option value="LHT">Laporan Hasil Penelitian</option>
                                    <option value="TS">Telaahan Staf</option>
                                    <option value="LD">Lembar Disposisi</option>
                                    <option value="SPB">Surat Permintaan Barang</option>
                                    <option value="SPMB">Surat Perintah Mengeluarkan Barang</option>
                                    <option value="SPBI">Surat Permintaan Barang Inventaris</option>
                                    <option value="SPMI">Surat Perintah Mengeluarkan Barang Inventaris</option>
                                </optgroup>
                                <optgroup label="Naskah Dinas Bimbingan">
                                    <option value="PDM">Pedoman</option>
                                    <option value="JUK">Petunjuk</option>
                                    <option value="PEM">Pemberitahuan</option>
                                </optgroup>
                                <optgroup label="Naskah Dinas Elektronik">
                                    <option value="FAKS">Faksimile</option>
                                    <option value="TLP">Telepon</option>
                                    <option value="ETR">E-Mail</option>
                                    <option value="TLG">Telegram</option>
                                    <option value="TLK">Teleks</option>
                                </optgroup>
                                <optgroup label="Naskah Dinas Khusus">
                                    <option value="SKU">Surat Kuasa</option>
                                    <option value="KET">Surat Keterangan</option>
                                    <option value="MoU">Memorandum of Understanding</option>
                                    <option value="PRJ">Surat Perjanjian</option>
                                    <option value="BA">Berita Acara</option>
                                    <option value="BAPS">Berita Acara Pengangkatan Sumpah</option>
                                    <option value="UND">Surat Undangan</option>
                                    <option value="SP">Surat Pengantar</option>
                                    <option value="PRT">Surat Peringatan</option>
                                    <option value="SKP">Surat Keterangan Perjalanan</option>
                                    <option value="SI">Surat Ijin</option>
                                    <option value="SPMT">Surat Pernyataan Melaksanakan Tugas</option>
                                    <option value="SPMJ">Surat Pernyataan Menduduki Jabatan</option>
                                    <option value="SPL">Surat Pernyataan Pelantikan</option>
                                    <option value="NST">Naskah Serah Terima Jabatan</option>
                                </optgroup>
                                <optgroup label="Naskah Dinas Pengaturan">
                                    <option value="NS">Instruksi</option>
                                    <option value="KEP">Keputusan</option>
                                    <option value="SE">Surat Edaran </option>
                                    <option value="JLK">Petunjuk Pelaksanaan</option>
                                    <option value="PROT">Prosedur Operasional Standar</option>
                                    <option value="PENG">Pengumuman</option>
                                    <option value="HK">Peraturan</option>
                                </optgroup>
                                <optgroup label="Naskah Dinas Penugasan">
                                    <option value="ST">Surat Tugas</option>
                                    <option value="PRIN">Surat Perintah</option>
                                    <option value="SPPL">Surat Pengukuhan Perintah Lisan</option>
                                    <option value="SPPD">Surat Perintah Perjalanan Dinas</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <label for="id_asalsurat">Asal Surat</label>
                            <input type="text" class="form-control" id="id_asalsurat" name="id_asalsurat">
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <label>Perihal</label>
                            <input type="text" class="form-control" id="id_perihal" name="id_perihal">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="set_kepada">Kepada</label>
                    <select id="set_kepada" name="set_kepada[]" class="form-control select2" multiple="multiple" data-placeholder="Boleh pilih lebih dari satu" style="width: 100%;">
                        @foreach($karyawans as $rpejabats)
                            <option value="{{ $rpejabats['nama'] }}">{{ $rpejabats['nama'] }} ( {{ $rpejabats['jabatan'] }} )</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <label for="id_ringkasan">Ringkasan Surat</label>
                            <input type="text" class="form-control" id="id_ringkasan" name="id_ringkasan">
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <label for="id_bentuk">Bentuk</label>
                            <select id="id_bentuk" name="id_bentuk" size="1" class="form-control">
                                <option value="Surat Asli">Surat Asli</option>
                                <option value="Fotocopy">Fotocopy</option>
                                <option value="Softfile">Softfile</option>
                                <option value="Facsimile">Facsimile</option>
                                <option value="Email">Email</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <label for="file" class="col-form-label">File Upload</label><br />
                            <input type="file" id="file" name="file" class="btn-light">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="simpansuratmsk">Simpan</button>	
            </div>
        </div>
    </div>
</div>
<input type="hidden" class="form-control" id="out_idsurat">
<input type="hidden" class="form-control" id="id_idsurat">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
    $(function () {
        $('.select2').select2({width: '100%'});
        $('.datemaskinput').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        bsCustomFileInput.init();
	});
    function getQrCode(id){
        $("#qrcode").empty();
        var url         = '{{url('/')}}/trackingid/srtklr-'+id;
        var qrcode      = new QRCode("qrcode");
        qrcode.makeCode(url);
        $("#modalqrcode").modal('show');
    }
	function selectasvalue(id){
        var url = '{{url('/')}}/trackingid/srtklr-'+id;
        window.location.href = url;
        return false;
    }
    function btnarsipkan(id){
        $("#out_idsurat").val(id);
        var url	        = '{{URL::to("/")}}/trackingid/srtklr-'+id;
        $.post('{{ route("exPersuratanFunc") }}', { val01:id, workcode: 'getdatasurat', _token: '{{ csrf_token() }}' },
        function(data){
            $(".out_nomor").val(data.nomor);
            $(".out_perihal").val(data.perihal);
            $(".out_tanggal").val(data.tglsurat);
            $("#out_ruang").val(data.ruangarsip);
            $("#out_lemari").val(data.lemariarsip);
            $("#out_ordner").val(data.ordnerarsip);
            var iframe = '<iframe src="'+url+'" width="100%" height="780" style="border: none;" id="document-preview"></iframe>';
            $("#pdfRenderer").empty();
            $('#pdfRenderer').html(iframe);
            $("#modalarsip").modal('show');
			return false;
        });
    }
    function btnajuantte(id){
        $("#out_idsurat").val(id);
        $.post('{{ route("exPersuratanFunc") }}', { val01:id, workcode: 'getdatasurat', _token: '{{ csrf_token() }}' },
        function(data){
            var status = data.status;
            if (status == 'File Uploaded, Signed'){
                swal({
                    title	: 'Mohon lengkapi',
                    text	: 'Surat yang telah di tandatangani tidak bisa diubah',
                    type	: 'info',
                });
            } else {
                $(".out_nomor").val(data.nomor);
                $(".out_perihal").val(data.perihal);
                $(".out_tanggal").val(data.tglsurat);
                $("#out_kepada").val(data.kepada);
                $("#out_alamat").val(data.alamat);
                $("#out_file").val('');
                $("#out_penandatangan").val(data.idpejabat).select2().trigger('change');
                $("#modaltandatangan").modal('show');
                return false;
            }
        });
    }
    function btndelete(id){
        swal({
            title			    : "Konfirmasi",
            text			    : "Data yang akan dihapus tidak bisa di kembalikan lagi (undo). Apakah anda yakin.?",
            type			    : 'warning',
            showCancelButton    : true,
            confirmButtonClass  : 'btn btn-confirm mt-2',
            cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
            confirmButtonText   : 'Yes, Delete'
        }).then(function () {
            $.ajax({
                type		: 'ajax',
                url			: '{{ route("exPersuratanFunc") }}',
                method		: 'post',
                data		: {workcode:'deletesrtkeluar', val01:id,  _token: '{{ csrf_token() }}'},
                dataType	: 'json',
                success: function(response, status, xhr) {
                    swal({
                        title	: response.status,
                        text	: response.message,
                        type	: response.icon,
                    });
                    $("#tabellistnomor").DataTable().ajax.reload();
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
    function btndeletesuratmasuk(id){
        swal({
            title			    : "Konfirmasi",
            text			    : "Data yang akan dihapus tidak bisa di kembalikan lagi (undo). Apakah anda yakin.?",
            type			    : 'warning',
            showCancelButton    : true,
            confirmButtonClass  : 'btn btn-confirm mt-2',
            cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
            confirmButtonText   : 'Yes, Delete'
        }).then(function () {
            $.ajax({
                type		: 'ajax',
                url			: '{{ route("exPersuratanFunc") }}',
                method		: 'post',
                data		: {workcode:'deletesrtmasuk', val01:id,  _token: '{{ csrf_token() }}'},
                dataType	: 'json',
                success: function(response, status, xhr) {
                    swal({
                        title	: response.status,
                        text	: response.message,
                        type	: response.icon,
                    });
                    $("#tabellistsurat").DataTable().ajax.reload();
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
    function btneditsrtmasuk(id){
        $("#id_idsurat").val(id);
        $.post('{{ route("exPersuratanFunc") }}', { val01:id, workcode: 'getdatasuratmasuk', _token: '{{ csrf_token() }}' },
        function(data){
            var set02	= document.getElementById('id_tglmasuk').value;
			var set03	= document.getElementById('id_tglsurat').value;
			var set04	= document.getElementById('id_nosurat').value;
			var set05	= document.getElementById('id_jenissurat').value;
			var set06	= document.getElementById('id_asalsurat').value;
			var set07	= document.getElementById('id_perihal').value;
			var set08	= document.getElementById('id_ringkasan').value;
			var set09	= document.getElementById('id_bentuk').value;
			var set10	= document.getElementById('id_idsurat').value;
            $("#id_tglmasuk").val(data.kepada);
            $("#id_tglsurat").val(data.tglsurat);
            $("#id_nosurat").val(data.nosurat);
            $("#id_jenissurat").val(data.jenissurat);
            $("#id_asalsurat").val(data.asalsurat);
            $("#id_perihal").val(data.perihal);
            $("#id_ringkasan").val(data.ringkasan);
            $("#id_bentuk").val(data.bentuk);
            $("#file").val('');
            $("#modalsuratmasuk").modal('show');
            return false;
        });
    }
	$(document).ready(function () {
        $('#divsuratmasuk').hide();
        $('#divsuratkeluar').show();
		$('#tabellistnomor').DataTable({
			responsive: {
				details: {
					display	: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							return 'Details of ' + data['id'];
						}
					}),
					type	: 'column',
					renderer: function (api, rowIdx, columns) {
						var data = $.map(columns, function (col, i) {
						return col.columnIndex !== 2
							? '<tr data-dt-row="' + col.rowIdx +'" data-dt-column="' + col.columnIndex +'">' +
								'<td>' +col.title + ':' + '</td> ' +
								'<td>' +col.data +'</td>' +
								'</tr>'
							: '';
						}).join('');
						return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
					}
				}
			},
			ordering	: true,
			autoWidth	: false,
            serverSide  : true,
            searching	: true,
			dom			: 	'<"row d-flex justify-content-between align-items-center m-1"' +
        						'<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start ">>' +
       							'<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>'+
                            '<"d-flex justify-content-between row"' +
        						'<"col-sm-12 col-md-12"p>' +
        					'>',
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonDataSurat") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						tahun           : document.getElementById('surat_tahun').value,
						jenis           : document.getElementById('surat_filter').value,
                        search          : data.search.value,
                        cari            : 'list',
						_token			: '{{ csrf_token() }}'
					},
					type    : "POST",
					success : function(res) {
						callback({
							recordsTotal    : res.total,
							recordsFiltered : res.total,
							data            : res.data
						});
					},
				})
			},
			columns: [	
				{
					"data": {
						idate       : "id",
						marking     : "marking",
						jenissrt    : "jenissrt",
						nomor       : "nomor",
						tglsurat    : "tglsurat",
                        daysrt      : "daysrt",
                        monsrt      : "monsrt",
                        yersrt      : "yersrt",
                        kepada      : "kepada",
                        alamat      : "alamat",
                        perihal     : "perihal",
                        idpejabat   : "idpejabat",
                        pejabat     : "pejabat",
                        namapejabat : "namapejabat",
                        sifat       : "sifat",
                        klasifikasi : "klasifikasi",
                        pembuat     : "pembuat",
                        status      : "status",
                        tandatangan : "tandatangan",
                        ruangarsip  : "ruangarsip",
                        ordnerarsip : "ordnerarsip",
                        lemariarsip : "lemariarsip",

					},
					"orderable" : false,
					"render" 	: function(data,type,full,meta){
                        stateNum    = Math.floor(Math.random() * 6);
                        states 		= ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
						state 		= states[stateNum];
                        var ceksurat= data.klasifikasi;
                        var sifat   = data.sifat;
                        if (ceksurat == '' || ceksurat == null){
                            var tombol = '<span class="badge badge-danger float-right">File Belum di Unggah</span>';
                            var btn_download= '<a class="btn btn-app btn-primary" onClick="selectasvalue('+data.id+')" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Download"><i class="fa fa-ban"></i> Download</a>';
                        } else {
                            var btn_download= '<a class="btn btn-app btn-primary" onClick="selectasvalue('+data.id+')" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Download"><i class="fa fa-download"></i> Download</a>';
                            if (data.status == 'File Uploaded, Signed' || data.sifat == 'TTE'){
                                var tombol = '<span class="badge badge-success float-right">Signed</span>';
                            } else if (data.status == 'File Uploaded, Not Signed'){
                                var tombol = '<span class="badge badge-warning float-right">Menunggu TTE</span>';
                            } else {
                                var tombol = '<span class="badge badge-info float-right" onClick="btnajuantte('+data.id+')">Mohonkan Tanda Tangan</span>';
                            }
                        }
                        
                        var btn_arsip   = '<a class="btn btn-app btn-primary" onClick="btnarsipkan('+data.id+')" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Arsipkan"><i class="fa fa-folder"></i> Arsip</a>';
                        var btn_mohontte= '<a class="btn btn-app btn-primary" onClick="btnajuantte('+data.id+')" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajukan TTE"><i class="fa fa-edit"></i> Tandatangan</a>';
                        var btn_delete  = '<a class="btn btn-app btn-primary" onClick="btndelete('+data.id+')" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="fa fa-trash"></i> Hapus</a>';
                        var $rowOutput 	= '<div class="item"><div class="product-img">'+
                                            '<div class="time-label"><button class="btn btn-'+state+'" onClick="getQrCode('+data.id+')">'+data.nomor+'</button></div></div><div class="product-info"><div class="row"><div class="col-lg-12">'+
                                            '<a href="javascript:void(0)" onClick="selectasvalue('+data.id+')" class="product-title">'+data.perihal+'</a>'+tombol+
                                            '</div><div class="col-lg-6"><span class="product-description">Ruang Arsip : '+data.ruangarsip+' ('+data.lemariarsip+') </span>'+
                                            '<span class="product-description">Ordner : '+data.ordnerarsip+'</span>'+
                                            '<span class="product-description">Klasifikasi : '+data.klasifikasi+'</span></div><div class="col-lg-6"><div class="btn-group">'+btn_mohontte+btn_download+btn_arsip+btn_delete+'</div></div></div>'+
                                        '</div></div>';
						return $rowOutput;
					}
				}
			],
		});
        $("#surat_tahun").on('change', function () {
            var tahun = document.getElementById('surat_tahun').value;
            $("#judulsuratkeluar").html('Nomor Tahun '+tahun);
            $("#tabellistnomor").DataTable().ajax.reload();
        });
        $("#surat_filter").on('change', function () {
            $("#tabellistnomor").DataTable().ajax.reload();
        });
        $('#btnexport').click(function () {
            var set01   = document.getElementById('surat_tahun').value;
            var set02   = document.getElementById('surat_filter').value;
            if (set01 == '' || set02 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Pilih Tahun dan Jenis Terlebih Dahulu',
                    type	: 'error',
                });
            } else {
                $.post('{{ route("jsonDataSurat") }}', { cari:'export', tahun:set01, jenis:set02, _token: '{{ csrf_token() }}' },
                function(data){
                    data = $.parseJSON(data);
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
                                if (isi == null){
                                    td.innerHTML = '';
                                } else {
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
                                    } else {
                                        var res = isi2.replace(/,/g, "");
                                        td.innerHTML = res;
                                    }
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
            }
        });
        $('#btnnomorbaru').click(function () {
            var set01=document.getElementById('surat_tahun').value;
            if (set01 == ''){
                swal({
                    title	: 'Mohon lengkapi',
                    text	: 'Field Tahun Belum di Isi',
                    type	: 'info',
                });
            } else {
                var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData();
                    formdata.set('tahun', set01);
                    formdata.set('workcode', 'newnomor');
                    formdata.set('_token','{{ csrf_token() }}');
                url='{{ route("exPersuratanFunc") }}';
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
                        $("#tabellistnomor").DataTable().ajax.reload();
                        return false;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title	: textStatus,
                            text	:  jqXHR.responseText,
                            type	: 'info',
                        });
                    }
                });
            }
        });
        $('#btnkirimkepenadatangan').click(function () {
            var set01=document.getElementById('out_idsurat').value;
            var set02=document.getElementById('out_perihal').value;
            var set03=document.getElementById('out_kepada').value;
            var set04=document.getElementById('out_alamat').value;
            var set05=document.getElementById('out_penandatangan').value;
            var set06=document.getElementById('out_file');
            var set07=document.getElementById('out_jenissrt').value;
            var set08=document.getElementById('out_tanggaltte').value;
            if ($('#out_file').val() == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Upload Filenya terlebih dahulu',
					type	: 'warning',
				})
			} else if (set02 == '' || set03 == '' || set04 == '' || set05 == '' || set07 == '' || set08 == ''){
                swal({
                    title	: 'Mohon lengkapi',
                    text	: 'Field Wajib di Isi, Apabila ada yang tidak diketahui mohon diberi tanda strip (-)',
                    type	: 'info',
                });
            } else {
                var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData();
                    formdata.append('file', set06.files[0]);
                    formdata.set('val01', set01);
                    formdata.set('val02', set02);
                    formdata.set('val03', set03);
                    formdata.set('val04', set04);
                    formdata.set('val05', set05);
                    formdata.set('val06', set07);
                    formdata.set('val08', set08);
                    formdata.set('workcode', 'tandatangan');
                    formdata.set('_token','{{ csrf_token() }}');
                url='{{ route("exPersuratanFunc") }}';
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
                        $("#modaltandatangan").modal('hide');
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        var status      = response.status;
                        var message     = response.message;
                        var warna 	    = response.warna;
                        var icon 	    = response.icon;
                        var keterangan 	= response.keterangan;
                        $.toast({
                            heading     : status,
                            text        : message,
                            position    : 'top-right',
                            loaderBg    : warna,
                            icon        : icon,
                            hideAfter   : 5000,
                            stack       : 1
                        });
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $("#keterangan").html(keterangan);
                        $("#tabellistnomor").DataTable().ajax.reload();
                        return false;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $("#modaltandatangan").modal('hide');
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title	: textStatus,
                            text	:  jqXHR.responseText,
                            type	: 'info',
                        });
                    }
                });
            }
        });
        $('#btnsimpanarsipkan').click(function () {
            var set01=document.getElementById('out_idsurat').value;
            var set02=document.getElementById('out_ruang').value;
            var set03=document.getElementById('out_ordner').value;
            var set04=document.getElementById('out_lemari').value;
            var set05=document.getElementById('out_tanggalarsip').value;

            if (set02 == '' || set03 == '' || set04 == '' || set05 == ''){
                swal({
                    title	: 'Mohon lengkapi',
                    text	: 'Field Wajib di Isi, Apabila ada yang tidak diketahui mohon diberi tanda strip (-)',
                    type	: 'info',
                });
            } else {
                var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData();
                    formdata.set('val01', set01);
                    formdata.set('val02', set02);
                    formdata.set('val03', set03);
                    formdata.set('val04', set04);
                    formdata.set('workcode', 'arsipkan');
                    formdata.set('_token','{{ csrf_token() }}');
                url='{{ route("exPersuratanFunc") }}';
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
                        $("#modalarsip").modal('hide');
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
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
                        $("#tabellistnomor").DataTable().ajax.reload();
                        return false;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $("#modalarsip").modal('hide');
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title	: textStatus,
                            text	:  jqXHR.responseText,
                            type	: 'info',
                        });
                    }
                });
            }
        });
        $('#topbtnsuratkeluar').click(function () {
            $('#divsuratmasuk').hide();
            $('#divsuratkeluar').show();
        });
        $('#topbtnsuratmasuk').click(function () {
            $('#divsuratmasuk').show();
            $('#divsuratkeluar').hide();
        });
        $('#btnexportsuratmasuk').click(function () {
            var set01   = document.getElementById('suratmasuk_tahun').value;
            if (set01 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Pilih Tahun dan Jenis Terlebih Dahulu',
                    type	: 'error',
                });
            } else {
                $.post('{{ route("jsonDataSurat") }}', { cari:'exportsuratmasuk', tahun:set01, _token: '{{ csrf_token() }}' },
                function(data){
                    data = $.parseJSON(data);
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
                                if (isi == null){
                                    td.innerHTML = '';
                                } else {
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
                                    } else {
                                        var res = isi2.replace(/,/g, "");
                                        td.innerHTML = res;
                                    }
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
            }
        });
        $('#tabellistsurat').DataTable({
			responsive: {
				details: {
					display	: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							return 'Details of ' + data['id'];
						}
					}),
					type	: 'column',
					renderer: function (api, rowIdx, columns) {
						var data = $.map(columns, function (col, i) {
						return col.columnIndex !== 2
							? '<tr data-dt-row="' + col.rowIdx +'" data-dt-column="' + col.columnIndex +'">' +
								'<td>' +col.title + ':' + '</td> ' +
								'<td>' +col.data +'</td>' +
								'</tr>'
							: '';
						}).join('');
						return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
					}
				}
			},
			ordering	: true,
			autoWidth	: false,
            serverSide  : true,
            searching	: true,
			dom			: 	'<"row d-flex justify-content-between align-items-center m-1"' +
        						'<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start ">>' +
       							'<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>'+
                            '<"d-flex justify-content-between row"' +
        						'<"col-sm-12 col-md-12"p>' +
        					'>',
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonDataSurat") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						tahun           : document.getElementById('suratmasuk_tahun').value,
                        search          : data.search.value,
                        cari            : 'listsuratmasuk',
						_token			: '{{ csrf_token() }}'
					},
					type    : "POST",
					success : function(res) {
						callback({
							recordsTotal    : res.total,
							recordsFiltered : res.total,
							data            : res.data
						});
					},
				})
			},
			columns: [	
				{
					"data": {
						idate       : "id",
						marking     : "marking",
						noagenda    : "noagenda",
						tglmasuk    : "tglmasuk",
						tglsurat    : "tglsurat",
                        daysrt      : "daysrt",
                        monsrt      : "monsrt",
                        yersrt      : "yersrt",
                        jenissurat  : "jenissurat",
                        nosurat     : "nosurat",
                        asalsurat   : "asalsurat",
                        kepada      : "kepada",
                        perihal     : "perihal",
                        ringkasan   : "ringkasan",
                        scansurat   : "scansurat",
                        bentuk      : "bentuk",
                        pembuat     : "pembuat",
                        status      : "status",
                        tandatangan : "tandatangan",
                        ruangarsip  : "ruangarsip",
                        ordnerarsip : "ordnerarsip",
                        lemariarsip : "lemariarsip",

					},
					"orderable" : false,
					"render" 	: function(data,type,full,meta){
                        stateNum    = Math.floor(Math.random() * 6);
                        states 		= ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
						state 		= states[stateNum];
                        var tombol  = '<span class="badge badge-'+state+' float-right">'+data.jenissurat+'</span>';
                        var btn_download= '<a class="btn btn-app btn-primary" href="'+data.scansurat+'" data-bs-toggle="tooltip" data-bs-placement="top" title="Download"><i class="fa fa-download"></i> Download</a>';
                        var btn_edit    = '<a class="btn btn-app btn-warning" onClick="btneditsrtmasuk('+data.id+')" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-edit"></i> Edit</a>';
                        var btn_delete  = '<a class="btn btn-app btn-danger" onClick="btndeletesuratmasuk('+data.id+')" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="fa fa-trash"></i> Hapus</a>';
                        var $rowOutput 	= '<div class="item"><div class="product-img">'+
                                            '<div class="time-label"><button class="btn btn-'+state+'">'+data.noagenda+'</button></div></div><div class="product-info"><div class="row"><div class="col-lg-12">'+
                                            '<a href="javascript:void(0)" class="product-title">Dari '+data.asalsurat+' Kepada '+data.kepada+'</a>'+tombol+
                                            '</div><div class="col-lg-8">'+
                                            '<span class="product-description">Perihal : '+data.perihal+'</span>'+
                                            '<span class="product-description">Ruang Arsip : '+data.ruangarsip+' Order : '+data.ordnerarsip+' ('+data.lemariarsip+') </span>'+
                                            '<span class="product-description">Nomor / Tangggal Surat : '+data.nosurat+' '+data.tglsurat+'</span>'+
                                            '<span class="product-description">Ringkasan : '+data.ringkasan+'</span></div><div class="col-lg-4"><div class="btn-group">'+btn_download+btn_edit+btn_delete+'</div></div></div>'+
                                        '</div></div>';
						return $rowOutput;
					}
				}
			],
		});
        $('#btnsuratbaru').click(function () {
            $('#divsuratmasuk').show();
            $('#divsuratkeluar').hide();
            $("#id_idsurat").val('new');
            $("#file").val('');
            $("#modalsuratmasuk").modal('show');
        });
        $("#simpansuratmsk").click(function(){
			var set01 	= document.getElementById('file');
			var set02	= document.getElementById('id_tglmasuk').value;
			var set03	= document.getElementById('id_tglsurat').value;
			var set04	= document.getElementById('id_nosurat').value;
			var set05	= document.getElementById('id_jenissurat').value;
			var set06	= document.getElementById('id_asalsurat').value;
			var set07	= document.getElementById('id_perihal').value;
			var set08	= document.getElementById('id_ringkasan').value;
			var set09	= document.getElementById('id_bentuk').value;
			var set10	= document.getElementById('id_idsurat').value;
            var set13	= document.getElementById('suratmasuk_tahun').value;
			var set11	= $('#set_kepada').val();
			if ($('#file').val() == '' && set10 == 'new'){
				swal({
					title	: 'Stop',
					text	: 'Mohon Pilih File Scannya terlebih dahulu '+set17,
					type	: 'warning',
				})
			} else if (set02 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Tulis Tanggal Surat Masuknya',
					type	: 'warning',
				})
			} else if (set03 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Tulis Tanggal Suratnya',
					type	: 'warning',
				})
			} else if (set06 == ''){
				swal({
					title	: 'Stop',
					text	: 'Mohon Tulis Asal Suratnya / Pengirim',
					type	: 'warning',
				})
			} else {
				var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var form_data = new FormData();
					form_data.append('file', set01.files[0]);
					form_data.set('id_tglmasuk', set02);
					form_data.set('id_tglsurat', set03);
					form_data.set('id_nosurat', set04);
					form_data.set('id_jenissurat', set05);
					form_data.set('id_asalsurat', set06);
					form_data.set('id_perihal', set07);
					form_data.set('id_ringkasan', set08);
					form_data.set('id_bentuk', set09);
					form_data.set('id_idsurat', set10);
					form_data.set('id_kepada', set11);
                    form_data.set('tahun', set13);
                    form_data.set('workcode', 'suratmasuk');
					form_data.set('_token', '{{csrf_token()}}');
				$.ajax({
					url: '{{ route("exPersuratanFunc") }}',
					data: form_data,
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
						$("#modalsuratmasuk").modal('hide');
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $("#tabellistsurat").DataTable().ajax.reload();
						return false;
					},
					error: function (xhr, status, error) {
						$("#modalsuratmasuk").modal('hide');
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title	: textStatus,
                            text	:  jqXHR.responseText,
                            type	: 'info',
                        });
					}
				});
			}
		});
	});
</script>
@endpush