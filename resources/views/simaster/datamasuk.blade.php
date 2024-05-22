@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-7">
                    <h1 class="m-0"> Keuangan Sekolah</h1>
                </div>
                <div class="col-sm-5">
                    <div class="btn-group">
                        <a class="btn btn-app btn-primary" href="{{url('/')}}/lapbayar" data-bs-toggle="tooltip" data-bs-placement="top" title="Seragam, Kegiatan, Peralatan, Buku, SPP, Ekskul, Makan"><i class="fa fa-calculator"></i> SPP</a>
                        <a class="btn btn-app btn-success" href="{{url('/')}}/datakeuhptmasuk" data-bs-toggle="tooltip" data-bs-placement="top" title="Keuangan Sekolah"><i class="fa fa-pencil"></i> Sekolah</a>
                        <a class="btn btn-app btn-info" href="{{url('/')}}/lapamil" data-bs-toggle="tooltip" data-bs-placement="top" title="Zakat, Infaq dan Sedekah"><i class="fa fa-bank"></i> Lazis</a>
                        <a class="btn btn-app btn-warning" href="{{url('/')}}/laptabungan" data-bs-toggle="tooltip" data-bs-placement="top" title="Tabungan"><i class="fa fa-book"></i> Tabungan</a>
                        <a class="btn btn-app btn-danger" href="{{url('/')}}/laporankeuhpt" data-bs-toggle="tooltip" data-bs-placement="top" title="Laporan Keuangan"><i class="fa fa-file-excel-o"></i> Laporan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row" >
                <div class="col-md-9">
                    <div id="loading"><img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo"></div>
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#depan" data-toggle="tab">Data Masuk Bulan Ini</a></li>
                                <li class="nav-item"><a class="nav-link" href="#formonline" data-toggle="tab">Pinjaman Aktif</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="depan">
                                    <div id="divawal">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-6">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-download"></i></span>
                                                    <div class="info-box-content">
                                                        <a href="#" id="topbtnpemasukan"><span class="info-box-text">Input Penerimaan</span></a>
                                                        <span class="info-box-number">{{$danaterkumpul}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-6">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-external-link-square"></i></span>
                                                    <div class="info-box-content">
                                                        <a href="#" id="topbtnpengeluaran"><span class="info-box-text">Input Pengeluaran</span></a>
                                                        <span class="info-box-number">{{$danaterserap}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div id="gridreportblnini"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-success" id="modalpemasukan">
                                        <div class="card-header">
                                            <h3 class="card-title">Input Data Penerimaan</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool btnkembali" title="Close"><i class="fa fa-ban"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="in_tanggal">Tanggal</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input value="{{date('Y-m-d')}}" type="text" class="form-control" id="in_tanggal" name="in_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Termasuk Dalam POS</label>
                                                <select id="in_pos" name="in_pos" class="form-control" >
                                                    @if (Session('previlage') == 'ortu')
                                                    <option value="Paguyuban">Paguyuban</option>
                                                        <option value="Sedekah Rutin">Sedekah Rutin</option>
                                                        <option value="DanSosOp">DanSosOp</option>
                                                        <option value="Bazar">Bazar</option>
                                                        <option value="Rihlah">Rihlah</option>
                                                        <option value="Tahsin">Tahsin</option>
                                                        <option value="Dana Kesiswaan">Dana Kesiswaan</option>
                                                    @else
                                                        <option value="pendaftaran">1. PENDAFTARAN</option>
                                                        <option value="spp">2. SPP</option>
                                                        <option value="makan">3. UANG MAKAN</option>
                                                        <option value="ekstrakurikuler">4. EKSTRAKULIKULER</option>
                                                        <option value="kegiatan">5. KEGIATAN</option>
                                                        <option value="peralatan">6. PERALATAN</option>
                                                        <option value="bos">7. BOS</option>
                                                        <option value="pembangunan">8. INFAQ PEMBEBASAN LAHAN DAN PEMBANGUNAN</option>
                                                        <option value="seragam">9. SERAGAM</option>
                                                        <option value="buku">10. BUKU</option>
                                                        <option value="jariyah">11. JARIYAH</option>
                                                        <option value="lainlain">12. LAIN-LAIN</option>
                                                    @endif
                                                </select>			  
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <input type="text" id="in_deskripsi" name="in_deskripsi" class="form-control">			  
                                            </div>
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" id="in_total" name="in_total" class="form-control">			  
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-danger pull-right btnkembali">Batalkan</button>
                                            <button type="button" class="btn btn-primary" id="btnsimpanpemasukan">SIMPAN</button>
                                        </div>
                                    </div>
                                    <div class="card card-success" id="modalpengeluaran">
                                        <div class="card-header">
                                            <h3 class="card-title">Input Data Pengeluaran</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool btnkembali" title="Close"><i class="fa fa-ban"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="out_tanggal">Tanggal</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input value="{{date('Y-m-d')}}" type="text" class="form-control" id="out_tanggal" name="out_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Termasuk Dalam POS</label>
                                                <select id="out_pos" name="out_pos" class="form-control" >
                                                    <option value="">Pilih Salah Satu</option>
                                                    @if (Session('previlage') == 'ortu')
                                                        <option value="Paguyuban">Paguyuban</option>
                                                        <option value="Sedekah Rutin">Sedekah Rutin</option>
                                                        <option value="DanSosOp">DanSosOp</option>
                                                        <option value="Bazar">Bazar</option>
                                                        <option value="Rihlah">Rihlah</option>
                                                        <option value="Tahsin">Tahsin</option>
                                                        <option value="Dana Kesiswaan">Dana Kesiswaan</option>
                                                    @else
                                                        <option value="pendaftaran">1. PENDAFTARAN</option>
                                                        <option value="spp">2. SPP</option>
                                                        <option value="makan">3. UANG MAKAN</option>
                                                        <option value="ekstrakurikuler">4. EKSTRAKULIKULER</option>
                                                        <option value="kegiatan">5. KEGIATAN</option>
                                                        <option value="peralatan">6. PERALATAN</option>
                                                        <option value="bos">7. BOS</option>
                                                        <option value="pembangunan">8. INFAQ PEMBEBASAN LAHAN DAN PEMBANGUNAN</option>
                                                        <option value="seragam">9. SERAGAM</option>
                                                        <option value="buku">10. BUKU</option>
                                                        <option value="jariyah">11. JARIYAH</option>
                                                        <option value="lainlain">12. LAIN-LAIN</option>
                                                    @endif
                                                </select>			  
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <input type="text" id="out_deskripsi" name="out_deskripsi" class="form-control">			  
                                            </div>
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" id="out_total" name="out_total" class="form-control">			  
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-danger pull-right btnkembali">Batalkan</button>
                                            <button type="button" class="btn btn-primary" id="btnsimpanpengeluaran">SIMPAN</button>
                                        </div>
                                    </div>
                                    <div class="card card-success" id="modaleditor">
                                        <div class="card-header">
                                            <h3 class="card-title">Editor Data</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool btnkembali" title="Close"><i class="fa fa-ban"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="edit_tanggal">Tanggal</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input value="{{date('Y-m-d')}}" type="text" class="form-control" id="edit_tanggal" name="edit_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Termasuk Dalam POS</label>
                                                <select id="edit_pos" name="edit_pos" class="form-control" >
                                                    <option value="">Pilih Salah Satu</option>
                                                    @if (Session('previlage') == 'ortu')
                                                        <option value="Paguyuban">Paguyuban</option>
                                                        <option value="Sedekah Rutin">Sedekah Rutin</option>
                                                        <option value="DanSosOp">DanSosOp</option>
                                                        <option value="Bazar">Bazar</option>
                                                        <option value="Rihlah">Rihlah</option>
                                                        <option value="Tahsin">Tahsin</option>
                                                        <option value="Dana Kesiswaan">Dana Kesiswaan</option>
                                                    @else
                                                        <option value="pendaftaran">1. PENDAFTARAN</option>
                                                        <option value="spp">2. SPP</option>
                                                        <option value="makan">3. UANG MAKAN</option>
                                                        <option value="ekstrakurikuler">4. EKSTRAKULIKULER</option>
                                                        <option value="kegiatan">5. KEGIATAN</option>
                                                        <option value="peralatan">6. PERALATAN</option>
                                                        <option value="bos">7. BOS</option>
                                                        <option value="pembangunan">8. INFAQ PEMBEBASAN LAHAN DAN PEMBANGUNAN</option>
                                                        <option value="seragam">9. SERAGAM</option>
                                                        <option value="buku">10. BUKU</option>
                                                        <option value="jariyah">11. JARIYAH</option>
                                                        <option value="lainlain">12. LAIN-LAIN</option>
                                                    @endif
                                                </select>			  
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <input type="text" id="edit_deskripsi" name="edit_deskripsi" class="form-control">			  
                                            </div>
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" id="edit_total" name="edit_total" class="form-control">			  
                                            </div>
                                            <div class="form-group">
                                                <label>Alasan Di Edit / Di Hapus</label>
                                                <input type="text" id="edit_alasan" name="edit_alasan" class="form-control">			  
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <input type="hidden" id="edit_id" name="edit_id" class="form-control">
                                            <input type="hidden" id="edit_nama" name="edit_nama" class="form-control" value="{{ Session('email') }}">
                                            <button type="button" class="btn btn-danger pull-right btnkembali">Batalkan</button>
                                            <button type="button" class="btn btn-primary" id="btnsimpanedit">Simpan Perubahan</button>
                                            <button type="button" class="btn btn-danger" id="btnsimpanhapus">Hapus Data</button>
                                        </div>
                                    </div>
                                    <div class="card card-success" id="modalvalidasi">
                                        <div class="card-header">
                                            <h3 class="card-title">Validasi Data</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool btnkembali" title="Close"><i class="fa fa-ban"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="validasi_tanggal">Tanggal</label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" id="validasi_tanggal" name="validasi_tanggal" disabled="disable"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Termasuk Dalam POS</label>
                                                <select id="validasi_pos" name="validasi_pos" class="form-control" disabled="disable" />
                                                    <option value="">Pilih Salah Satu</option>
                                                    @if (Session('previlage') == 'ortu')
                                                        <option value="Paguyuban">Paguyuban</option>
                                                        <option value="Sedekah Rutin">Sedekah Rutin</option>
                                                        <option value="DanSosOp">DanSosOp</option>
                                                        <option value="Bazar">Bazar</option>
                                                        <option value="Rihlah">Rihlah</option>
                                                        <option value="Tahsin">Tahsin</option>
                                                        <option value="Dana Kesiswaan">Dana Kesiswaan</option>
                                                    @else
                                                        <option value="pendaftaran">1. PENDAFTARAN</option>
                                                        <option value="spp">2. SPP</option>
                                                        <option value="makan">3. UANG MAKAN</option>
                                                        <option value="ekstrakurikuler">4. EKSTRAKULIKULER</option>
                                                        <option value="kegiatan">5. KEGIATAN</option>
                                                        <option value="peralatan">6. PERALATAN</option>
                                                        <option value="bos">7. BOS</option>
                                                        <option value="pembangunan">8. INFAQ PEMBEBASAN LAHAN DAN PEMBANGUNAN</option>
                                                        <option value="seragam">9. SERAGAM</option>
                                                        <option value="buku">10. BUKU</option>
                                                        <option value="jariyah">11. JARIYAH</option>
                                                        <option value="lainlain">12. LAIN-LAIN</option>
                                                    @endif
                                                </select>			  
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <input type="text" id="validasi_deskripsi" name="validasi_deskripsi" class="form-control" readonly />
                                            </div>
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" id="validasi_total" name="validasi_total" class="form-control" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Penandatangan Kwitansi</label>
                                                <select id="validasi_nama" name="validasi_nama" class="form-control" />
                                                    <option value="">Pilih Salah Satu</option>
                                                    @if(isset($pegawais) && !empty($pegawais))
                                                        @foreach($pegawais as $jpegub)
                                                            <option value="{{ $jpegub->id }}">{{ $jpegub->nama }} ( {{ $jpegub->email }} )</option>
                                                        @endforeach
                                                    @endif
                                                </select>	
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4">
                                                        <input type="hidden" id="validasi_id" name="validasi_id" class="form-control">
                                                        <button type="button" class="btn btn-primary" id="btnctkkwitansi">Cetak Kwitansi</button>
                                                        <button type="button" class="btn btn-info" id="btnkirimpermohonan">Minta Tandatangan</button>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                        <div class="input-group">
                                                            <input type="text" id="validasi_nomor" name="validasi_nomor" class="form-control" placeholder="Nomor Penerima Kwitansi">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><a href="#" id="btnkirimkwitansi"><i class="fa fa-whatsapp"></i></a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4">
                                                        <button type="button" class="btn btn-danger pull-right btnkembali">Batalkan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="formonline">
                                    <div class="card card-success" id="divawalpeminjaman">
                                        <div class="card-header">
                                            <h3 class="card-title">Data Peminjaman Uang Paguyuban</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" title="Tambah Data Peminjaman" id="topbtnpinjaman"><i class="fa fa-plus"></i> Tambah Data</button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="gridpinjaman"></div>
                                        </div>
                                    </div>
                                    <div class="card card-success" id="modalbyrhutang">
                                        <div class="card-header">
                                            <h3 class="card-title">Input Data Pelunasan</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool btnkembalikepeminjaman" title="Close"><i class="fa fa-ban"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="byr_tanggal">Tanggal</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input value="{{date('Y-m-d')}}" type="text" class="form-control" id="byr_tanggal" name="byr_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <input type="text" id="byr_deskripsi" name="byr_deskripsi" class="form-control">			  
                                            </div>
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" id="byr_total" name="byr_total" class="form-control">			  
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <input type="hidden" id="byr_id" name="byr_id" class="form-control">
                                            <button type="button" class="btn btn-danger pull-left btnkembalikepeminjaman">Batalkan</button>
                                            <button type="button" class="btn btn-primary" id="btnsimpanpelunasan">SIMPAN</button>
                                        </div>
                                    </div>
                                    <div class="card card-success" id="modalpinjaman">
                                        <div class="card-header">
                                            <h3 class="card-title">Input Data Pinjaman</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool btnkembalikepeminjaman" title="Close"><i class="fa fa-ban"></i></button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="pjm_tanggal">Tanggal</label>
                                                <div class="input-group date" data-target-input="nearest">
                                                    <input value="{{date('Y-m-d')}}" type="text" class="form-control" id="pjm_tanggal" name="pjm_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Pinjam Dari POS</label>
                                                <select id="pjm_pos" name="pjm_pos" class="form-control" >
                                                    <option value="">Pilih Salah Satu</option>
                                                    @if (Session('previlage') == 'ortu')
                                                        <option value="Paguyuban">Paguyuban</option>
                                                        <option value="Sedekah Rutin">Sedekah Rutin</option>
                                                        <option value="DanSosOp">DanSosOp</option>
                                                        <option value="Bazar">Bazar</option>
                                                        <option value="Rihlah">Rihlah</option>
                                                        <option value="Tahsin">Tahsin</option>
                                                        <option value="Dana Kesiswaan">Dana Kesiswaan</option>
                                                    @else
                                                        <option value="pendaftaran">1. PENDAFTARAN</option>
                                                        <option value="spp">2. SPP</option>
                                                        <option value="makan">3. UANG MAKAN</option>
                                                        <option value="ekstrakurikuler">4. EKSTRAKULIKULER</option>
                                                        <option value="kegiatan">5. KEGIATAN</option>
                                                        <option value="peralatan">6. PERALATAN</option>
                                                        <option value="bos">7. BOS</option>
                                                        <option value="pembangunan">8. INFAQ PEMBEBASAN LAHAN DAN PEMBANGUNAN</option>
                                                        <option value="seragam">9. SERAGAM</option>
                                                        <option value="buku">10. BUKU</option>
                                                        <option value="jariyah">11. JARIYAH</option>
                                                        <option value="lainlain">12. LAIN-LAIN</option>
                                                    @endif
                                                </select>			  
                                            </div>
                                            <div class="form-group">
                                                <label>Dimasukkan Dalam POS</label>
                                                <select id="pjm_postujuan" name="pjm_postujuan" class="form-control" >
                                                    <option value="">Pilih Salah Satu</option>
                                                    @if (Session('previlage') == 'ortu')
                                                        <option value="Paguyuban">Paguyuban</option>
                                                        <option value="Sedekah Rutin">Sedekah Rutin</option>
                                                        <option value="DanSosOp">DanSosOp</option>
                                                        <option value="Bazar">Bazar</option>
                                                        <option value="Rihlah">Rihlah</option>
                                                        <option value="Tahsin">Tahsin</option>
                                                        <option value="Dana Kesiswaan">Dana Kesiswaan</option>
                                                    @else
                                                        <option value="pendaftaran">1. PENDAFTARAN</option>
                                                        <option value="spp">2. SPP</option>
                                                        <option value="makan">3. UANG MAKAN</option>
                                                        <option value="ekstrakurikuler">4. EKSTRAKULIKULER</option>
                                                        <option value="kegiatan">5. KEGIATAN</option>
                                                        <option value="peralatan">6. PERALATAN</option>
                                                        <option value="bos">7. BOS</option>
                                                        <option value="pembangunan">8. INFAQ PEMBEBASAN LAHAN DAN PEMBANGUNAN</option>
                                                        <option value="seragam">9. SERAGAM</option>
                                                        <option value="buku">10. BUKU</option>
                                                        <option value="jariyah">11. JARIYAH</option>
                                                        <option value="lainlain">12. LAIN-LAIN</option>
                                                    @endif
                                                </select>			  
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <input type="text" id="pjm_deskripsi" name="pjm_deskripsi" class="form-control">			  
                                            </div>
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" id="pjm_total" name="pjm_total" class="form-control">			  
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-danger pull-left btnkembalikepeminjaman">Batalkan</button>
                                            <button type="button" class="btn btn-primary" id="btnsimpanpinjaman">SIMPAN</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div id="message"></div>
                    <div class="card card-primary card-outline" >
                        <div class="card-body box-profile bg-primary">
                            <div class="text-center">
                                <img src="{{ url('/').'/'.session('sekolah_frontpage') }}" class="user-image" alt="User Image" width="100%">
                            </div>
                        </div>
                        <div class="card-body text-center" >
                            <strong>SALDO TIAP POS</strong>
                        </div>
                        <div class="card-footer">
                            <div id="gridsaldotiappos"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script>
$(function () {
    $('#in_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
    $('#out_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
    $('#pjm_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
    $('#edit_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
    $('#byr_tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
});
$(document).ready(function () {
    $("#loading").hide();
	$("#modalpemasukan").hide();
	$("#modalpengeluaran").hide();
	$("#modaleditor").hide();
	$("#modalpinjaman").hide();
	$("#modalbyrhutang").hide();
	$("#modalvalidasi").hide();
	$("#in_total").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#out_total").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#pjm_total").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#edit_total").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	$("#byr_total").autoNumeric(
		'init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'}
	);
	var sourcekeuangan = {
		datatype: "json",
		datafields: [
			{ name: 'id',type: 'text'},	
			{ name: 'tanggal',type: 'text'},
			{ name: 'bulan',type: 'text'},
			{ name: 'tahun',type: 'text'},
			{ name: 'deskripsi',type: 'text'},
			{ name: 'pemasukan',type: 'text'},
			{ name: 'pengeluaran',type: 'text'},
			{ name: 'jenis',type: 'text'},
			{ name: 'keterangan',type: 'text'},
			{ name: 'tgllengkap',type: 'text'},
			{ name: 'total',type: 'text'},
			{ name: 'kunci',type: 'text'},
		],
		url: 'json/keuangan',
		cache: false,
	};
	var datakeuangan = new $.jqx.dataAdapter(sourcekeuangan);
	var editrow = -1;
	$("#gridreportblnini").jqxGrid({
		width: '100%',
		showfilterrow: true,
		filterable: true,
		columnsresize: true,
		autoshowfiltericon: true,
		pageable: true,
		autoheight: true,
		theme: "energyblue",
		source: datakeuangan,
		selectionmode: 'multiplecellsextended',
		columns: [
			{ text: 'dd', columngroup: 'tglinput', filtertype: 'checkedlist', datafield: 'tanggal', width: '6%', cellsalign: 'center', align: 'center' },
			{ text: 'mm', columngroup: 'tglinput', filtertype: 'checkedlist', datafield: 'bulan', width: '6%', cellsalign: 'center', align: 'center' },
			{ text: 'yy', columngroup: 'tglinput', filtertype: 'checkedlist', datafield: 'tahun', width: '8%', cellsalign: 'center', align: 'center' },
			{ text: 'Jenis', datafield: 'jenis', filtertype: 'checkedlist', width: '12%', cellsalign: 'center', align: 'center' },
			{ text: 'Deskripsi', datafield: 'deskripsi', width: '15%', cellsalign: 'left', align: 'center' },
			{ text: 'DEBET', datafield: 'pemasukan', width: '12%', cellsalign: 'right', align: 'center' },
			{ text: 'KREDIT', datafield: 'pengeluaran', width: '12%', cellsalign: 'right', align: 'center' },
			{ text: 'Keterangan', datafield: 'keterangan', width: '14%', cellsalign: 'right', align: 'center' },
			{ text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', cellsrenderer: function () {
				return "Edit";
				}, buttonclick: function (row) {	
                    editrow = row;	
                    var offset 		= $("#gridreportblnini").offset();		
                    var dataRecord 	= $("#gridreportblnini").jqxGrid('getrowdata', editrow);
                    var kunci       = dataRecord.kunci;
                    if (kunci == 'yes'){
                        swal({
                            title: 'Stop',
                            text: 'Data yang telah di validasi tidak bisa diubah kembali',
                            type: 'warning',
                        })
                    } else {
                        $("#edit_deskripsi").val(dataRecord.deskripsi);
                        $("#edit_id").val(dataRecord.id);
                        $("#edit_pos").val(dataRecord.jenis);
                        $("#edit_total").val(dataRecord.total);
                        $("#edit_tanggal").val(dataRecord.tgllengkap);
                        $("#modalvalidasi").hide();
                        $("#modalpemasukan").hide();
                        $("#modalpengeluaran").hide();
                        $("#modaleditor").show();
                        $("#modalpinjaman").hide();
                        $("#modalbyrhutang").hide();
                        $("#divawal").hide();
                    }
				}
			},	
			{ text: 'Kwitansi', editable: false, sortable: false, filterable: false, columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
				return "Validasi";
				}, buttonclick: function (row) {		
                    editrow = row;	
                    var offset 		= $("#gridreportblnini").offset();		
                    var dataRecord 	= $("#gridreportblnini").jqxGrid('getrowdata', editrow);						
                    var goook		= dataRecord.id;
                    $("#validasi_deskripsi").val(dataRecord.deskripsi);
                    $("#validasi_id").val(dataRecord.id);
                    $("#validasi_pos").val(dataRecord.jenis);
                    $("#validasi_total").val(dataRecord.total);
                    $("#validasi_tanggal").val(dataRecord.tgllengkap);
                    $("#modalvalidasi").show();
                    $("#modalpemasukan").hide();
                    $("#modalpengeluaran").hide();
                    $("#modaleditor").hide();
                    $("#modalpinjaman").hide();
                    $("#modalbyrhutang").hide();
                    $("#divawal").hide();					 
				}
			},
		],
		columngroups: 
		[
			{ text: 'Tanggal', align: 'center', name: 'tglinput' },                
		]
	});
	var sourcerekap = {
		datatype: "json",
		datafields: [
			{ name: 'id',type: 'text'},	
			{ name: 'tlsjenis',type: 'text'},
			{ name: 'buku',type: 'text'},
			{ name: 'saldo',type: 'text'},
			{ name: 'tahun',type: 'text'},	
		],
		url: 'json/rekapsaldo',
		cache: false,
	};
	var datasaldo = new $.jqx.dataAdapter(sourcerekap);
	var editrow = -1;
	$("#gridsaldotiappos").jqxGrid({
		width: '100%',		            
		columnsresize: true,		
		pageable: false,
		sortable: true,
		autoheight: true,
		theme: "energyblue",
		source: datasaldo,
		ready: function () {
			$("#gridsaldotiappos").jqxGrid('sortby', 'tlsjenis', 'asc');
		},
		columns: [			
			{ text: 'Tahun', datafield: 'tahun', width: '20%', cellsalign: 'center', align: 'center' },
			{ text: 'Jenis', datafield: 'tlsjenis', width: '45%', cellsalign: 'left', align: 'center' },
			{ text: 'Saldo', datafield: 'saldo', width: '35%', cellsalign: 'right', align: 'center' },			
		],
	});
	var sourcehutang = {
		datatype: "json",
		datafields: [
			{ name: 'id',type: 'text'},	
			{ name: 'tanggal',type: 'text'},
			{ name: 'deskripsi',type: 'text'},
			{ name: 'jumlah',type: 'text'},	
		],
		url: 'json/rekaphutang',
		cache: false,
	};
	var datahutang = new $.jqx.dataAdapter(sourcehutang);
	var editrow = -1;
	$("#gridpinjaman").jqxGrid({
		width: '100%',		            
		columnsresize: true,		
		pageable: true,
		autoheight: true,
		theme: "energyblue",
		source: datahutang,
		selectionmode: 'multiplecellsextended',
		columns: [			
			{ text: 'Tanggal', datafield: 'tanggal', width: '10%', cellsalign: 'center', align: 'center' },
			{ text: 'Keterangan', datafield: 'deskripsi', width: '50%', cellsalign: 'left', align: 'center' },
			{ text: 'Jumlah', datafield: 'jumlah', width: '30%', cellsalign: 'right', align: 'center' },
			{ text: 'Lunasi', columntype: 'button', width: '10%', cellsrenderer: function () {
				return "Bayar";
				}, buttonclick: function (row) {	
                    editrow = row;	
                    var offset 		= $("#gridpinjaman").offset();		
                    var dataRecord 	= $("#gridpinjaman").jqxGrid('getrowdata', editrow);
                    $("#byr_deskripsi").val(dataRecord.deskripsi);
                    $("#byr_id").val(dataRecord.id);
                    $("#byr_total").val(dataRecord.total);
                    $("#loading").hide();
                    $("#modalvalidasi").hide();
                    $("#modalpemasukan").hide();
                    $("#modalpengeluaran").hide();
                    $("#modaleditor").hide();
                    $("#modalpinjaman").hide();
                    $("#modalbyrhutang").show();
                    $("#divawal").hide();
                    $("#divawalpeminjaman").hide();
				}
			},
		],
	});
	$("#topbtnpemasukan").click(function(){ 
        $("#loading").hide();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").show();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
        $("#divawal").hide();
        $("#divawalpeminjaman").hide();
    });
	$("#topbtnpengeluaran").click(function(){ 
        $("#loading").hide();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").show();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
        $("#divawal").hide();
        $("#divawalpeminjaman").hide();
    });
	$("#topbtnpinjaman").click(function(){ 
        $("#loading").hide();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").show();
        $("#modalbyrhutang").hide();
        $("#divawal").hide();
        $("#divawalpeminjaman").hide();
    });
    $(".btnkembalikepeminjaman").click(function(){ 
        $("#loading").hide();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
        $("#divawal").show();
        $("#divawalpeminjaman").show();
    });
    $(".btnkembali").click(function(){ 
        $("#loading").hide();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
        $("#divawal").show();
        $("#divawalpeminjaman").show();
    });
	$("#btnctkkwitansi").click(function(){
		var val01       = document.getElementById('validasi_id').value;
        var url	        = '{{URL::to("/")}}/ctkkwt/'+val01;
        var windowName 	= 'Kwitansi';
        var windowSize 	= "width=800,height=800";
        window.open(url, windowName, windowSize);
	});
    $('#btnkirimkwitansi').on('click', function (){		
		var set01=document.getElementById('validasi_id').value;
		var set02=document.getElementById('validasi_nomor').value;
		var token=document.getElementById('token').value;
		if (set02 == ''){
			swal({
				title: 'Stop',
				text: 'Mohon Isi Nomor HP Penerima Kwitansi Ini',
				type: 'warning',
			})
		} else {
			$.post('{{ route("exValidasiKwitansi") }}', { val01: set01, val02: set02, jenis: 'kirimkwitansi', _token: token },
			function(data){
				var status  = data.status;
				var message = data.message;
				var warna 	= data.warna;
				var icon 	= data.icon;
				if (icon == 'success'){
					var windowName 	= 'Send WA';
					var windowSize 	= "width=800,height=800";
					window.open(data.message, windowName, windowSize);
				} else {
                    swal({
                        title   : status,
                        text    : message,
                        type    : 'warning',
                    })
                }
				return false;
			});	
		}
	});
    $('#btnkirimpermohonan').on('click', function (){		
		var set01=document.getElementById('validasi_id').value;
		var set02=document.getElementById('validasi_nama').value;
		var token=document.getElementById('token').value;
		if (set02 == ''){
			swal({
				title: 'Stop',
				text: 'Mohon Set Penerima Surat Ini',
				type: 'warning',
			})
		} else {
			$("#loading").show();
            $("#modalvalidasi").hide();
            $("#modalpemasukan").hide();
            $("#modalpengeluaran").hide();
            $("#modaleditor").hide();
            $("#modalpinjaman").hide();
            $("#modalbyrhutang").hide();
            $.post('{{ route("exValidasiKwitansi") }}', { val01: set01, val02: set02, jenis: 'validasikwitansi', _token: token },
			function(data){
				$("#gridreportblnini").jqxGrid('updatebounddata', 'filter');
				var status  = data.status;
				var message = data.message;
				var warna 	= data.warna;
				var icon 	= data.icon;
				if (icon == 'success'){
					var windowName 	= 'Send WA';
					var windowSize 	= "width=800,height=800";
					window.open(data.message, windowName, windowSize);
				}
				$.toast({
					heading: status,
					text: message,
					position: 'top-right',
					loaderBg: warna,
					icon: icon,
					hideAfter: 5000,
					stack: 1
				});
				$("#loading").hide();
                $("#divawal").show();
                $("#divawalpeminjaman").show();
				return false;
			});	
		}
	});
    $("#btnsimpanpelunasan").click(function(){
        $("#loading").show();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
		var val01=document.getElementById('byr_deskripsi').value;
		var val02=document.getElementById('byr_id').value;	
		var val03=document.getElementById('byr_tanggal').value;
		var val04=document.getElementById('byr_total').value;
		var val05='pelunasan';
		var val06='';
		var val07='';
		var val08='';
		var token=document.getElementById('token').value;
		$.post('excutor/simpantransaksi', { _token: token, set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08 },
		function(data){
            $("#loading").hide();
            $("#divawal").show();
            $("#divawalpeminjaman").show();
			$("#message").html(data);
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$("#gridreportblnini").jqxGrid('updatebounddata');
			$("#gridsaldotiappos").jqxGrid('updatebounddata', 'filter');
			$("#gridpinjaman").jqxGrid('updatebounddata');
			return false;
		});	
	});
	$("#btnsimpanpemasukan").click(function(){
		$("#loading").show();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
		var val01=document.getElementById('in_deskripsi').value;
		var val02=document.getElementById('in_pos').value;	
		var val03=document.getElementById('in_tanggal').value;
		var val04=document.getElementById('in_total').value;
		var val05='pemasukan';
		var val06='';
		var val07='';
		var val08='';
		var token=document.getElementById('token').value;
		$.post('excutor/simpantransaksi', { _token: token, set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08 },
		function(data){
            $("#loading").hide();
			$("#divawal").show();
            $("#divawalpeminjaman").show();
			$("#message").html(data);	
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$("#gridreportblnini").jqxGrid('updatebounddata');
			$("#gridsaldotiappos").jqxGrid('updatebounddata', 'filter');
			return false;
		});	
	});
	$("#btnsimpanpengeluaran").click(function(){
		$("#loading").show();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
		var val01=document.getElementById('out_deskripsi').value;
		var val02=document.getElementById('out_pos').value;	
		var val03=document.getElementById('out_tanggal').value;
		var val04=document.getElementById('out_total').value;
		var val05='pengeluaran';
		var val06='';
		var val07='';
		var val08='';
		var token=document.getElementById('token').value;
		$.post('excutor/simpantransaksi', { _token: token, set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08 },
		function(data){		
			$("#loading").hide();
			$("#divawal").show();
            $("#divawalpeminjaman").show();
			$("#message").html(data);
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$("#gridreportblnini").jqxGrid('updatebounddata');
			$("#gridsaldotiappos").jqxGrid('updatebounddata', 'filter');
			return false;
		});	
	});
	$("#btnsimpanpinjaman").click(function(){
		$("#loading").show();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
		var val01=document.getElementById('pjm_deskripsi').value;
		var val02=document.getElementById('pjm_pos').value;	
		var val03=document.getElementById('pjm_tanggal').value;
		var val04=document.getElementById('pjm_total').value;
		var val05='pinjaman';
		var val06=document.getElementById('pjm_postujuan').value;
		var val07='';
		var val08='';
		var token=document.getElementById('token').value;
		$.post('excutor/simpantransaksi', { _token: token, set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08 },
		function(data){
            $("#loading").hide();
			$("#divawal").show();
            $("#divawalpeminjaman").show();
			$("#message").html(data);
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$("#gridreportblnini").jqxGrid('updatebounddata');
			$("#gridsaldotiappos").jqxGrid('updatebounddata', 'filter');
			$("#gridpinjaman").jqxGrid('updatebounddata');
			return false;
		});	
	});
	$("#btnsimpanedit").click(function(){
		$("#loading").show();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
		var val01=document.getElementById('edit_deskripsi').value;
		var val02=document.getElementById('edit_pos').value;	
		var val03=document.getElementById('edit_tanggal').value;
		var val04=document.getElementById('edit_total').value;
		var val05='editor';
		var val06=document.getElementById('edit_id').value;
		var val07=document.getElementById('edit_alasan').value;
		var val08=document.getElementById('edit_nama').value;
		var token=document.getElementById('token').value;
		$.post('excutor/simpantransaksi', { _token: token, set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08 },
		function(data){
            $("#loading").hide();
			$("#divawal").show();
            $("#divawalpeminjaman").show();
			$("#message").html(data);
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$("#gridreportblnini").jqxGrid('updatebounddata');
			$("#gridsaldotiappos").jqxGrid('updatebounddata', 'filter');
			$("#gridpinjaman").jqxGrid('updatebounddata');
			return false;
		});	
	});
	$("#btnsimpanhapus").click(function(){
		$("#loading").show();
        $("#modalvalidasi").hide();
        $("#modalpemasukan").hide();
        $("#modalpengeluaran").hide();
        $("#modaleditor").hide();
        $("#modalpinjaman").hide();
        $("#modalbyrhutang").hide();
		var val01=document.getElementById('edit_deskripsi').value;
		var val02=document.getElementById('edit_pos').value;	
		var val03=document.getElementById('edit_tanggal').value;
		var val04=document.getElementById('edit_total').value;
		var val05='hapus';
		var val06=document.getElementById('edit_id').value;
		var val07=document.getElementById('edit_alasan').value;
		var val08=document.getElementById('edit_nama').value;
		var token=document.getElementById('token').value;
		$.post('excutor/simpantransaksi', { _token: token, set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08 },
		function(data){
            $("#loading").hide();
			$("#divawal").show();
            $("#divawalpeminjaman").show();
			$("#message").html(data);
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$("#gridreportblnini").jqxGrid('updatebounddata');
			$("#gridsaldotiappos").jqxGrid('updatebounddata', 'filter');
			$("#gridpinjaman").jqxGrid('updatebounddata');
			return false;
		});	
	});
});
</script>
@endpush