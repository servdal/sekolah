@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Setting dan Laporan PPDB</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">S Id : {{Session('sekolah_id_sekolah')}}</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div id="status"></div>
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Setting PPDB</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>TAPEL PPDB</label>
                                        <input type="text" id="id_tapel" name="id_tapel" class="form-control" value="{!! $pendaftaran !!}">
                                    </div> 
                                    <div class="col-lg-4">
                                        <label>Set Status</label>
                                        <select id="id_status" name="id_status" class="form-control" >
                                            <option value=""></option>
                                            @if ($statppdb == 'buka')
                                                <option value="buka" selected>Di Buka</option>
                                            @else 
                                                <option value="buka">Di Buka</option>
                                            @endif
                                            @if ($statppdb == 'umum')
                                                <option value="umum" selected>Di Umumkan</option>
                                            @else 
                                                <option value="umum">Di Umumkan</option>
                                            @endif
                                            @if ($statppdb == 'tutup')
                                                <option value="tutup" selected>Di Tutup</option>
                                            @else 
                                                <option value="tutup">Di Tutup</option>
                                            @endif									 
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Tgl.Pengumumannya</label>
                                        <input type="text" id="id_tglpengumuman" name="id_tglpengumuman" class="form-control">
                                    </div>
                                </div>			  			  
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Periode PSB</label>
                                        <input type="text" id="id_periodepsb" name="id_periodepsb" class="form-control" value="{!! $periode !!}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Nama Bank</label>
                                        <input type="text" id="id_namabank" name="id_namabank" class="form-control" value="{!! $namabank !!}">
                                    </div> 
                                    <div class="col-lg-4">
                                        <label>Norek</label>
                                        <input type="text" id="id_norek" name="id_norek" class="form-control" value="{!! $norek !!}">
                                    </div>
                                </div>
                                <p class="help-block">Tertulis pada kode pendataran adalah <b>[KodeBaru/Pindahan]-No.Urut</b></p>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Set Kode Baru</label>
                                        <input type="text" id="id_kodebaru" name="id_kodebaru" class="form-control" value="{!! $kodebaru !!}">
                                    </div> 
                                    <div class="col-lg-4">
                                        <label>Set Kode Pindahan</label>
                                        <input type="text" id="id_kodepindahan" name="id_kodepindahan" class="form-control" value="{!! $kodepindahan !!}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Set Harga Formulir</label>
                                        <input type="text" id="id_hargaformulir" name="id_hargaformulir" class="form-control" value="{!! $hargaformulir !!}">
                                    </div>
                                </div>
                                <p class="help-block">Tertulis pada kode pendataran adalah <b>[KodeBaru/Pindahan]-No.Urut</b></p>
                            </div>
                            <div class="form-group">
                                <label>Pengumumannya</label>
                                <textarea id="id_pengumuman" style="width: 100%; height: 200px; font-size: 12px; line-height: 12px; border: 1px solid #dddddd; padding: 10px;">{!! $pengumuman !!}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success" type="button" id="btnsavesetting">Simpan</button>
						</div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Pembelian Formulir</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                                <div id="divtombolkembali">
                                    <button type="button" class="btn btn-tool" id="btnkembalidrdetail"><i class="fa fa-close"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-warning" type="button" id="btnbuyform">Pembelian Formulir</button>
							<div id="griddatapembelianform"></div>
						</div>
                        <div class="card-footer">
                        	<div id="divdetailpembelianform">
								<div id="griddatadetailpembelianform"></div>
							</div>
                        </div>
                    </div>
                    <div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Data Jadwal Ujian</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-danger" type="button" id="btntambahdataujian">Tambah Data</button>
                            <div id="griddataujian"></div>
                        </div>
                    </div>
                    <div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Setting SPP / DPP</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
								<label>Pilihan SPP Ke 1</label>
								<input type="text" id="id_spp1" name="id_spp1" class="form-control" value="{!! $setspp1 !!}">
							</div>
							<div class="form-group">
								<label>Pilihan SPP Ke 2</label>
								<input type="text" id="id_spp2" name="id_spp2" class="form-control" value="{!! $setspp2 !!}">
							</div>
							<div class="form-group">
								<label>Pilihan SPP Ke 3</label>
								<input type="text" id="id_spp3" name="id_spp3" class="form-control" value="{!! $setspp3 !!}">
							</div>
							<div class="form-group">
								<label>Pilihan DPP Ke 1</label>
								<input type="text" id="id_dpp1" name="id_dpp1" class="form-control" value="{!! $setdpp1 !!}">
							</div>
							<div class="form-group">
								<label>Pilihan DPP Ke 2</label>
								<input type="text" id="id_dpp2" name="id_dpp2" class="form-control" value="{!! $setdpp2 !!}">
							</div>
                        </div>
                        <div class="card-footer">
                        <button class="btn btn-success" type="button" id="btnsimpansetsppdpp">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-success shadow">
                        <div class="card-header">
                            <h3 class="card-title">Data Pendaftar</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ url('ppdb') }}/?id={{Session('sekolah_id_sekolah')}}"><button class="btn btn-danger btn-md" type="button">Input Data Baru</button></a>
                                    <button class="btn btn-info btn-md" type="button" id="exportgrid">Export To Excell</button>
                                </div>
                                <div class="col-md-3">
                                    <div id="message"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <form name="import" action="{{ url('admin/uploadkeuanganppdb') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <label for="FileExcel">Upload Data SPP, DPP, Deadline</label>
                                                    <input type="file" name="FileExcel">
                                                </div>
                                                <div class="col-lg-4">
                                                    <input class="btn btn-xs btn-block btn-primary" type="submit" name="unggah" value="Unggah" />
                                                    <a href="format/formathasilppdb.xlsx"><button class="btn btn-xs btn-block btn-warning" type="button">Format Excell</button></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    @if(Session::has('message'))
                                        <div class="alert {{ Session::get('alert-class') }} alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h4><i class="icon fa fa-check"></i> {{ Session::get('status') }}</h4>
                                                {!! Session::get('message') !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        <div id="griddatappdb"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<div class="modal fade" id="modaltambahdataujian">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Ujian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Jenis Ujian *)</label>
                    <input type="text" id="ujian_nama" name="ujian_nama" class="form-control">
                </div>
                <div class="form-group">
                    <label>Hari, Tanggal dan Jam Ujian *)</label>
                    <div class="row">
                        <div class="col-lg-4">
                            <select id="ujian_hari" name="ujian_hari" class="form-control" >
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div> 
                        <div class="col-lg-4">
                            <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="ujian_tanggal" name="ujian_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" id="ujian_jam" class="form-control" placeholder="Jam">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ruang</label>
                    <input type="text" id="ujian_ruang" class="form-control" placeholder="Ruang Ujian">
                </div>
                <div class="form-group">
                    <label>Materi</label>
                    <input type="text" id="ujian_materi" class="form-control" placeholder="Materi">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="ujian_idne">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" id="btnsimpandataujian">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editdatainduk">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Setting PPDB</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>TAPEL Diterima *)</label>
                            <input type="text" id="edit_tahun" name="edit_tahun" class="form-control" placeholder="2015-2016">
                        </div> 
                        <div class="col-lg-6">
                            <label>di Kelas</label>
                            <select id="edit_kelas" name="edit_kelas" class="form-control" >
                                <option value=""></option>
                                @if(Session('sekolah_level') == 1)
                                    <option value="KB1">KB1</option>
                                    <option value="KB2">KB2</option>
                                    <option value="KB3">KB3</option>
                                    <option value="TA1">TA1</option>
                                    <option value="TA2">TA2</option>
                                    <option value="TA3">TA3</option>
                                @elseif (Session('sekolah_level') == 2)
                                    <option value="1A">1A</option>
                                    <option value="1B">1B</option>
                                    <option value="1C">1C</option>
                                @elseif (Session('sekolah_level') == 3)
                                    <option value="7A">7A</option>
                                    <option value="7B">7B</option>
                                    <option value="7C">7C</option>
                                    <option value="7D">7D</option>
                                    <option value="7E">7E</option>
                                    <option value="7F">7F</option>
                                    <option value="7G">7G</option>
                                    <option value="7H">7H</option>
                                    <option value="7I">7I</option>
                                @else
                                    <option value="10A">10A</option>
                                    <option value="10B">10B</option>
                                    <option value="10C">10C</option>
                                    <option value="10D">10D</option>
                                    <option value="10E">10E</option>
                                    <option value="10F">10F</option>
                                    <option value="10G">10G</option>
                                    <option value="10H">10H</option>
                                    <option value="10I">10I</option>
                                @endif
                            </select>					
                        </div>				 
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Siswa *)</label>
                    <input type="text" id="edit_nama" name="edit_nama" class="form-control">			  
                </div>	
                <div class="form-group">
                    <label>Tempat dan Tanggal lahir *)</label>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" id="edit_tmplahir" name="edit_tmplahir" class="form-control" placeholder="Tempat Lahir">
                        </div> 
                        <div class="col-lg-6">
                            <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="edit_tgllahir" name="edit_tgllahir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                        </div>				 
                    </div>			  
                </div>
                <div class="form-group">
                    <label>Kelamin/Tinggi Badan/Berat Badan</label>
                    <div class="row">
                        <div class="col-lg-3">
                            <select id="edit_kelamin" name="edit_kelamin" class="form-control" >
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                        </div> 
                        <div class="col-lg-3">
                            <input type="text" id="edit_tinggi" name="edit_tinggi" class="form-control" placeholder="Tinggi Badan">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" id="edit_berat" name="edit_berat" class="form-control" placeholder="Berat Badan">
                        </div>
                        <div class="col-lg-3">
                            <select id="edit_darah" name="edit_darah" class="form-control" >
                                <option value=""></option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div> 
                    </div>			  
                </div>
                <div class="form-group">
                    <label>Nama Ayah / Ibu *)</label>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" id="edit_ayah" name="edit_ayah" class="form-control" placeholder="Ayah">
                        </div> 
                        <div class="col-lg-6">
                            <input type="text" id="edit_ibu" name="edit_ibu" class="form-control" placeholder="Ibu">
                        </div>				 
                    </div>			  
                </div>	
                <div class="form-group">
                    <label>Pekerjaan Ayah/Ibu</label>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" id="edit_kayah" name="edit_kayah" class="form-control" placeholder="Pekerjaan Ayah">
                        </div> 
                        <div class="col-lg-6">
                            <input type="text" id="edit_kibu" name="edit_kibu" class="form-control" placeholder="Pekerjaan Ibu">
                        </div>				 
                    </div>			  
                </div>
                <div class="form-group">
                    <label>Nama Wali</label>
                    <input type="text" id="edit_wali" name="edit_wali" class="form-control" placeholder="Wali (bila ada)">		  
                </div>
                <div class="form-group">
                    <label>Pekerjaan Wali</label>
                    <input type="text" id="edit_kwali" name="edit_kwali" class="form-control">		  
                </div>
                <div class="form-group">
                    <label>Alamat Orang Tua/Wali *)</label>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" id="edit_alamat" name="edit_alamat" class="form-control" placeholder="Alamat">	
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
                    <label>Asal TK/TA/RA</label>
                    <input type="text" id="edit_asal" name="edit_asal" class="form-control">		  
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="edit_idne" name="edit_idne" class="form-control">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" id="updatedatainduk">UPDATE</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalbuyform">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pembelian Formulir</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Siswa *)</label>
                    <input type="text" id="buy_nama" name="buy_nama" class="form-control">			  
                </div>
                <div class="form-group">
                    <label>Nomor Pendaftaran *)</label>
                    <div class="row">
                        <div class="col-lg-5">
                            <select id="buy_jenis" name="buy_jenis" class="form-control" >
                                <option value="Reguler">Reguler</option>
                                <option value="Pindahan">Pindahan</option>
                            </select>
                        </div> 
                        <div class="col-lg-7">
                            <input type="text" id="buy_nomor" class="form-control" placeholder="Cukup Ketik Angkanya Saja">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nominal *)</label>
                    <input type="text" id="buy_nominal" name="buy_nominal" class="form-control" value="150000">		  
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" id="btncetakbuyform">Cetak</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="formpenentuan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hasil Observasi PPDB</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Data Diri</label>
                    <div class="row">
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="set_nama" disabled="disable">
                        </div> 
                        <div class="col-lg-3">
                            <input type="text" id="set_kelamin" class="form-control" disabled="disable">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="set_tmtlahir" disabled="disable">
                        </div> 
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="set_tgllahir" disabled="disable">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="set_ayah" disabled="disable">
                        </div> 
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="set_ibu" disabled="disable">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="set_alamat" disabled="disable">
                        </div> 
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="set_kelurahan" disabled="disable">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="set_kecamatan" disabled="disable">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><font color=red>DINYATAKAN</font></label>
                    <select id="set_status" name="set_status" class="form-control" >
                        <option value=""></option>
                        <option value="DITERIMA">DITERIMA</option>
                        <option value="BELUM DITERIMA">BELUM DITERIMA</option>
                        <option value="CADANGAN 1">CADANGAN 1</option>
                        <option value="CADANGAN 2">CADANGAN 2</option>
                        <option value="CADANGAN 3">CADANGAN 3</option>
                        <option value="CADANGAN 4">CADANGAN 4</option>
                        <option value="CADANGAN 5">CADANGAN 5</option>
                        <option value="CADANGAN 6">CADANGAN 6</option>
                        <option value="CADANGAN 7">CADANGAN 7</option>
                        <option value="CADANGAN 8">CADANGAN 8</option>
                        <option value="CADANGAN 9">CADANGAN 9</option>
                        <option value="CADANGAN 10">CADANGAN 10</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>No. Surat (Bila Diterima)</label>
                    <input type="text" class="form-control" id="set_nomer">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-3">
                            <label>Seragam+ATK</label>
                            <input type="text" class="form-control" id="set_seragam">
                        </div> 
                        <div class="col-lg-3">
                            <label>Pengembangan</label>
                            <input type="text" class="form-control" id="set_pengembangan">
                        </div>
                        <div class="col-lg-3">
                            <label>SPP</label>
                            <input type="text" class="form-control" id="set_spp">
                        </div>
                        <div class="col-lg-3">
                            <label>Kegiatan</label>
                            <input type="text" class="form-control" id="set_kegiatan">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">				  
                        <div class="col-lg-6">
                            <label>Batas Bayar SPP</label>
                            <input type="text" class="form-control" id="set_deadline" placeholder="18 Februari 2018">
                        </div> 
                        <div class="col-lg-6">
                            <label>Batas Daftar Ulang</label>
                            <input type="text" class="form-control" id="set_akhirpengumuman" placeholder="Kamis, 1 Februari 2018 Pukul 13:00">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="set_idne" name="set_idne" class="form-control">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" id="updatedatastatus">SIMPAN</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="formpenilaian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nilai Observasi PPDB</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>KOGNITIF</label>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="row">
                                <table class="table">
                                    <tr>
                                        <td style="width: 65%;"><input type="text" class="form-control" value="Membaca" disabled="disable"></td>
                                        <td style="width: 35%;"><input type="text" id="id_n1" name="id_n1" class="form-control"></td>
                                    </tr>
                                </table>
                            </div>
                        </div> 
                        <div class="col-lg-4">
                            <div class="row">
                                <table class="table">
                                    <tr>
                                        <td style="width: 65%;"><input type="text" class="form-control" value="Menulis" disabled="disable"></td>
                                        <td style="width: 35%;"><input type="text" id="id_n2" name="id_n2" class="form-control"></td>
                                    </tr>
                                </table>						
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <table class="table">
                                    <tr>
                                        <td style="width: 65%;"><input type="text" class="form-control" value="Berhitung" disabled="disable"></td>
                                        <td style="width: 35%;"><input type="text" id="id_n3" name="id_n3" class="form-control"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>			 
                </div>
                <div class="form-group">
                    <label>KEMAMPUAN AGAMA ISLAM</label>
                    <div class="row">
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="Mengaji/Membaca" disabled="disable">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" id="id_n7" name="id_n7" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="Menulis" disabled="disable">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" id="id_n8" name="id_n8" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="3 Surat Juz Amma" disabled="disable">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" id="id_n9" name="id_n9" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="3 Doa Harian" disabled="disable">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" id="id_n10" name="id_n10" class="form-control">
                        </div>
                    </div>
                </div>
                <!-- 
                <div class="form-group">
                    <label>PSIKOTES</label>
                    <div class="row">
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="Teliti Dalam Bertindak" disabled="disable">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" id="id_n11" name="id_n11" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="Memahami Bentuk dan Jumlah Benda" disabled="disable">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" id="id_n12" name="id_n12" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="Memahami Pola Gambar" disabled="disable">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" id="id_n13" name="id_n13" class="form-control">
                        </div>
                    </div>
                </div>
                -->
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="id_nilai" name="id_nilai" class="form-control">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" id="updatedatanilai">SIMPAN</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalverifikasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Validasi Berkas Pendaftaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Data Diri</label>
                    <div class="row">
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="daftar_nama" disabled="disable">
                        </div> 
                        <div class="col-lg-3">
                            <input type="text" id="daftar_nik" class="form-control" disabled="disable">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="daftar_tmplahir" disabled="disable">
                        </div> 
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="daftar_tgllahir" disabled="disable">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="daftar_status" disabled="disable">
                        </div>
                    </div>			  
                </div>
                <div class="form-group">
                    <label><font color=red>Verifikasi</font></label>
                    <select id="daftar_verifikasi" name="daftar_verifikasi" class="form-control" >
                        <option value=""></option>
                        <option value="verified">Disetujui</option>
                        <option value="unverified">Tidak di Setujui</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="daftar_idne" name="daftar_idne" class="form-control">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" id="btnsimpanverifikasi">SIMPAN</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="formdataarsip">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Masukkan Ke Data Induk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Data Diri</label>
                    <div class="row">
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="arsip_nama" disabled="disable">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" id="arsip_kelamin" class="form-control" disabled="disable">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="arsip_tmplahir" disabled="disable">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="arsip_tgllahir" disabled="disable">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="arsip_status" disabled="disable">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label><font color=red>Masuk Kelas</font></label>
                            <select id="arsip_kelas" name="arsip_kelas" class="form-control" >
                                <option value=""></option>
                                <option value="1A">1A</option>
                                <option value="1B">1B</option>
                                <option value="1C">1C</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label>No.Induk</label>
                            <input type="text" class="form-control" id="arsip_induk">
                        </div>
                        <div class="col-lg-4">
                            <label>NISN</label>
                            <input type="text" class="form-control" id="arsip_nisn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" id="arsip_idne" name="arsip_idne" class="form-control">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" id="btnsimpanarsip">SIMPAN</button>
            </div>
        </div>
    </div>
</div>
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="getnama" id="getnama" value="{{Session('nama')}}">
@endsection
@push('script')
<script>
	$(function () {
        $('.datemaskinput').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
		$("#id_tglpengumuman").daterangepicker();
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace('id_pengumuman');	
	});
    $(document).ready(function () {
        var token=document.getElementById('token').value;	
        $('#exportgrid').click(function(){
            var gridContent = $("#griddatappdb").jqxGrid('exportdata', 'json');
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
        $("#id_spp1").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#id_spp2").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#id_spp3").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#id_dpp1").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#id_dpp2").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#id_dpp3").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#id_hargaformulir").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#set_kegiatan").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#set_spp").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#set_pengembangan").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#set_seragam").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#buy_nominal").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $('#divtombolkembali').hide();
        $("#btntambahdataujian").click(function(){
            $("#ujian_idne").val('new');
            $("#modaltambahdataujian").modal('show');
        });
        $("#btnbuyform").click(function(){ $("#modalbuyform").modal('show'); });
        $("#btnkembalidrdetail").click(function(){ $('#divtombolkembali').hide(); $('#divdetailpembelianform').hide();$('#griddatapembelianform').show(); });
        $('#btnsimpandataujian').click(function () {
            var set01=document.getElementById('ujian_idne').value;
            var set02=document.getElementById('ujian_hari').value;
            var set03=document.getElementById('ujian_jam').value;
            var set04=document.getElementById('ujian_materi').value;
            var set05=document.getElementById('ujian_nama').value;
            var set06=document.getElementById('ujian_tanggal').value;
            var set07=document.getElementById('ujian_ruang').value;
            $("#modaltambahdataujian").modal('hide');
            $.post('admin/exsimpandataujian', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, _token: token },
            function(data){
                $("#griddataujian").jqxGrid("updatebounddata");
                $('#status').html(data);	
                return false;
            });
        });
        $('#updatedatastatus').click(function () {
            var set01=document.getElementById('set_idne').value;
            var set02=document.getElementById('set_status').value;
            var set03=document.getElementById('set_nomer').value;
            var set04=document.getElementById('set_seragam').value;
            var set05=document.getElementById('set_pengembangan').value;
            var set06=document.getElementById('set_spp').value;
            var set07=document.getElementById('set_kegiatan').value;
            var set08=document.getElementById('set_deadline').value;
            var set09=document.getElementById('set_akhirpengumuman').value;
            $("#formpenentuan").modal('hide');
            $.post('admin/simpanhasilppdb', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, _token: token },
            function(data){
                $("#griddatappdb").jqxGrid("updatebounddata");
                $('#message').html(data);	
                return false;
            });
        });
        $('#updatedatainduk').click(function () {
            var set01=document.getElementById('edit_tahun').value;
            var set02=document.getElementById('edit_kelas').value;
            var set03=document.getElementById('edit_nama').value;
            var set04=document.getElementById('edit_tmplahir').value;
            var set05=document.getElementById('edit_tgllahir').value;
            var set06=document.getElementById('edit_kelamin').value;
            var set07=document.getElementById('edit_tinggi').value;
            var set08=document.getElementById('edit_berat').value;
            var set09=document.getElementById('edit_ayah').value;
            var set10=document.getElementById('edit_ibu').value;
            var set11=document.getElementById('edit_kayah').value;
            var set12=document.getElementById('edit_kibu').value;
            var set13=document.getElementById('edit_wali').value;
            var set14=document.getElementById('edit_kwali').value;
            var set15=document.getElementById('edit_alamat').value;
            var set16=document.getElementById('edit_rt').value;
            var set17=document.getElementById('edit_rw').value;
            var set18=document.getElementById('edit_kel').value;
            var set19=document.getElementById('edit_kec').value;
            var set20=document.getElementById('edit_kodepos').value;
            var set21=document.getElementById('edit_hape').value;
            var set22=document.getElementById('edit_asal').value;
            var set23=document.getElementById('edit_kota').value;
            var set24=document.getElementById('edit_idne').value;
            var set25=document.getElementById('edit_darah').value;
            $("#editdatainduk").modal('hide');
            $.post('admin/saveupdateppdb', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06,val07: set07, val08: set08, val09: set09, val10: set10, val11: set11, val12: set12, val13: set13, val14: set14, val15: set15, val16: set16, val17: set17, val18: set18, val19: set19, val20: set20, val21: set21, val22: set22, val23: set23, val24: set24, val25: set25, _token: token },
            function(data){
                $("#griddatappdb").jqxGrid("updatebounddata");		
                $('#message').html(data);	
                return false;
            });
        });
        $('#btncetakbuyform').click(function () {
            var set01=document.getElementById('buy_jenis').value;
            var set02=document.getElementById('buy_nama').value;
            var set03=document.getElementById('buy_nominal').value;
            var set04=document.getElementById('buy_nomor').value;
            var set05=document.getElementById('getnama').value;
            $.post('cetak/kwitansipsb', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: '', val07: '', _token: token },
            function(data){
                $("#modalbuyform").modal('hide');
                $("#griddatapembelianform").jqxGrid("updatebounddata");
                var newWindow = window.open('', '', 'width=880, height=500'),
                    document = newWindow.document.open(),
                    pageContent =
                        '<!DOCTYPE html>\n' +
                        '<html>\n' +
                        '<head>\n' +
                        '<meta charset="utf-8" />\n' +
                        '<title>Kwitansi PSB</title>\n' +
                        '</head>\n' +
                        '<body>' + data + '</body>\n</html>';
                    document.write(pageContent);
                    document.close();	
                    newWindow.print();									
                return false;
            });
        });
        $('#btnsimpanarsip').click(function () {
            var set01=document.getElementById('arsip_idne').value;
            var set02=document.getElementById('arsip_kelas').value;
            var set03=document.getElementById('arsip_induk').value;
            var set04=document.getElementById('arsip_nisn').value;
            $("#formdataarsip").modal('hide');
            $.post('admin/savearsipppdb', { val01: set01, val02: set02, val03: set03, val04: set04, _token: token },
            function(data){
                $("#griddatappdb").jqxGrid("updatebounddata");		
                $('#message').html(data);
                return false;
            });
        });
        $('#btnsimpanverifikasi').click(function () {
            var set01=document.getElementById('daftar_idne').value;
            var set02=document.getElementById('daftar_verifikasi').value;
            $("#modalverifikasi").modal('hide');
            $.post('admin/saveverifikasipsb', { val01: set01, val02: set02, _token:token },
            function(data){
                $("#griddatappdb").jqxGrid("updatebounddata");		
                $('#message').html(data);
                return false;
            });
        });
        $('#btnsimpansetsppdpp').click(function () {
            var set01=document.getElementById('id_spp1').value;
            var set02=document.getElementById('id_spp2').value;
            var set03=document.getElementById('id_spp3').value;
            var set04=document.getElementById('id_dpp1').value;
            var set05=document.getElementById('id_dpp2').value;
            $.post('admin/savesettingssppdpp', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, _token: token },
            function(data){	
                $('#message').html(data);
                return false;
            });
        });
        $('#btnsavesetting').click(function () {
            var set01=document.getElementById('id_tapel').value;
            var set02=document.getElementById('id_status').value;
            var set03=CKEDITOR.instances['id_pengumuman'].getData()
            var set04=document.getElementById('id_kodebaru').value;
            var set05=document.getElementById('id_kodepindahan').value;
            var set06=document.getElementById('id_tglpengumuman').value;
            var set07=document.getElementById('id_hargaformulir').value;
            var set08=document.getElementById('id_namabank').value;
            var set09=document.getElementById('id_norek').value;
            var set10=document.getElementById('id_periodepsb').value;
            $.post('admin/savesettingppdb', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, _token: token },
            function(data){
                $("#griddatappdb").jqxGrid("updatebounddata");		
                $('#status').html(data);
                $("html, body").animate({ scrollTop: 0 }, "slow");		
                return false;
            });
        });
        $('#updatedatanilai').click(function () {
            var set01=document.getElementById('id_nilai').value;
            var set02=document.getElementById('id_n1').value;
            var set03=document.getElementById('id_n2').value;
            var set04=document.getElementById('id_n3').value;
            var set05=document.getElementById('id_n7').value;
            var set06=document.getElementById('id_n8').value;
            var set07=document.getElementById('id_n9').value;
            var set08=document.getElementById('id_n10').value;
            $.post('admin/savenilaippdb', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06,val07: set07, val08: set08, _token: token },
            function(data){
                $("#griddatappdb").jqxGrid("updatebounddata");		
                $('#message').html(data);
                $("#formpenilaian").modal('hide');
                return false;
            });
        });
        var sumberujian = {
            datatype: "json",
            datafields: [
                { name: 'idne',type: 'text'},
                { name: 'hari',type: 'text'},
                { name: 'jam',type: 'text'},
                { name: 'materi',type: 'text'},
                { name: 'nama',type: 'text'},
                { name: 'ruang',type: 'text'},
                { name: 'tanggal',type: 'text'},
                { name: 'tlstanggal',type: 'text'},
            ],
            url: 'json/jjadwalujianppdb',
            cache: false,
        };
        var dataujian = new $.jqx.dataAdapter(sumberujian);
        $("#griddataujian").jqxGrid({
            width: '100%',   
            columnsresize: true,
            theme: "orange",
            autoheight: true,
            source: dataujian,
            selectionmode: 'singlecell',
            columns: [		
                { text: 'Edit', columntype: 'button', width: '10%', align: 'center', cellsalign: 'center', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#griddataujian").offset();
                        var dataRecord 	= $("#griddataujian").jqxGrid('getrowdata', editrow);
                        $("#ujian_hari").val(dataRecord.hari);
                        $("#ujian_idne").val(dataRecord.idne);
                        $("#ujian_jam").val(dataRecord.jam);
                        $("#ujian_materi").val(dataRecord.materi);
                        $("#ujian_nama").val(dataRecord.nama);
                        $("#ujian_ruang").val(dataRecord.ruang);
                        $("#ujian_tanggal").val(dataRecord.tanggal);
                        $("#modaltambahdataujian").modal('show');	
                    }
                },
                { text: 'Jenis', datafield: 'nama', width: '10%', align: 'center', cellsalign: 'center'},
                { text: 'Hari', datafield: 'hari', width: '10%', align: 'center', cellsalign: 'center'},
                { text: 'Tanggal', datafield: 'tlstanggal', width: '15%', align: 'center', cellsalign: 'left' },
                { text: 'Jam', datafield: 'jam', width: '10%', align: 'center', cellsalign: 'left' },
                { text: 'Ruang', datafield: 'ruang', width: '20%', align: 'center', cellsalign: 'left' },
                { text: 'Materi', datafield: 'materi', width: '25%', align: 'center', cellsalign: 'left' },
            ],
        });
        var sourcerekapform = {
            datatype: "json",
            datafields: [
                { name: 'tapel',type: 'text'},
                { name: 'jenis',type: 'text'},
                { name: 'jumlah',type: 'text'},
                { name: 'nominal',type: 'text'},
            ],
            url: 'json/datapembelianform',
            cache: false,
        };
        var datapembform = new $.jqx.dataAdapter(sourcerekapform);
        $("#griddatapembelianform").jqxGrid({
            width: '100%',   
            columnsresize: true,
            theme: "energyblue",
            autoheight: true,
            source: datapembform,
            selectionmode: 'singlecell',
            columns: [		
                { text: 'Jenis', datafield: 'jenis', width: '25%', align: 'center', cellsalign: 'center'},
                { text: 'Jumlah', datafield: 'jumlah', width: '25%', align: 'center', cellsalign: 'center'},
                { text: 'Nominal', datafield: 'nominal', width: '25%', align: 'center', cellsalign: 'right' },
                { text: 'Detail', columntype: 'button', width: '25%', align: 'center', cellsrenderer: function () {
                    return "Detail";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#griddatapembelianform").offset();		
                        var dataRecord 	= $("#griddatapembelianform").jqxGrid('getrowdata', editrow);
                        var set01		= dataRecord.tapel;
                        var set02		= dataRecord.jenis;
                        var sumberpencarianpembeli = {
                            datatype: "json",
                            datafields: [
                                { name: 'id',type: 'text'},	
                                { name: 'tanggal',type: 'text'},
                                { name: 'jenis',type: 'text'},
                                { name: 'nomor',type: 'text'},
                                { name: 'nama',type: 'text'},
                                { name: 'nominal',type: 'text'},
                                { name: 'tanggal',type: 'text'},
                                { name: 'costumid',type: 'text'},
                                { name: 'tapel',type: 'text'},
                            ],
                            type: 'POST',
                            data: {	val01:set01, val02:set02, _token: token },
                            url: 'json/detailpembeli',
                        };
                        var datadetpembeliform = new $.jqx.dataAdapter(sumberpencarianpembeli);
                        var editrow = -1;
                        $('#divdetailpembelianform').show();
                        $('#griddatapembelianform').hide();
                        $('#divtombolkembali').show();
                        $("#griddatadetailpembelianform").jqxGrid({
                            width: '100%',
                            filterable: true,
                            columnsresize: true,
                            filtermode: 'excel',
                            theme: "orange",
                            sortable: true,
                            autoheight: true,
                            source: datadetpembeliform,
                            selectionmode: 'multiplecellsextended',
                            columns: [
                                { text: 'Tanggal', datafield: 'tanggal', width: '20%', cellsalign: 'center', align: 'center' },
                                { text: 'Nomor', datafield: 'costumid', width: '15%', cellsalign: 'center', align: 'center' },
                                { text: 'Nama Siswa', datafield: 'nama', width: '40%', cellsalign: 'left', align: 'center' },
                                { text: 'Nominal', datafield: 'nominal', width: '15%', cellsalign: 'right', align: 'center' },
                                { text: 'KW', columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
                                    return "CTK";
                                    }, buttonclick: function (row) {		
                                        editrow         = row;	
                                        var offset 		= $("#griddatadetailpembelianform").offset();		
                                        var dataRecord 	= $("#griddatadetailpembelianform").jqxGrid('getrowdata', editrow);
                                        var url         = '{{url('/')}}/kwitansipsb/'+dataRecord.id;
                                        var windowName 	= dataRecord.costumid;
                                        var windowSize 	= "width=800,height=800";
                                        window.open(url, windowName, windowSize);
                                        event.preventDefault();
                                    }
                                },
                            ],
                        });
                    }
                },
            ],
        });
        var source = {
            datatype: "json",
            datafields: [
                { name: 'id',type: 'text'},
                { name: 'nextid',type: 'text'},
                { name: 'nama',type: 'text'},
                { name: 'kodependaf',type: 'text'},
                { name: 'kelamin',type: 'text'},
                { name: 'tmplahir',type: 'text'},
                { name: 'tgllahir',type: 'text'},
                { name: 'darah',type: 'text'},
                { name: 'tinggi',type: 'text'},
                { name: 'berat',type: 'text'},
                { name: 'namaayah',type: 'text'},
                { name: 'namaibu',type: 'text'},
                { name: 'kerjaayah',type: 'text'},
                { name: 'kerjaibu',type: 'text'},
                { name: 'wali',type: 'text'},
                { name: 'pekerjaanwali',type: 'text'},
                { name: 'alamatortu',type: 'text'},			
                { name: 'foto',type: 'text'},
                { name: 'tamasuk',type: 'text'},
                { name: 'hape',type: 'text'},
                { name: 'asal',type: 'text'},
                { name: 'erte',type: 'text'},
                { name: 'erwe',type: 'text'},
                { name: 'kelurahan',type: 'text'},
                { name: 'kecamatan',type: 'text'},
                { name: 'kota',type: 'text'},
                { name: 'kodepos',type: 'text'},
                { name: 'telpon',type: 'text'},
                { name: 'n1',type: 'text'},
                { name: 'n2',type: 'text'},
                { name: 'n3',type: 'text'},
                { name: 'n4',type: 'text'},
                { name: 'n5',type: 'text'},
                { name: 'n6',type: 'text'},
                { name: 'n7',type: 'text'},
                { name: 'n8',type: 'text'},
                { name: 'n9',type: 'text'},
                { name: 'n10',type: 'text'},
                { name: 'n11',type: 'text'},
                { name: 'n12',type: 'text'},
                { name: 'n13',type: 'text'},
                { name: 'total',type: 'text'},
                { name: 'rata',type: 'text'},
                { name: 'hasil',type: 'text'},
                { name: 'nosurat',type: 'text'},
                { name: 'dana1',type: 'text'},
                { name: 'dana2',type: 'text'},
                { name: 'dana3',type: 'text'},
                { name: 'dana4',type: 'text'},
                { name: 'nik',type: 'text'},
                { name: 'persenselesai',type: 'text'},
            ],
            url: 'json/datappdb',
            cache: false,
        };
        var dataAdapter = new $.jqx.dataAdapter(source, { async: false, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
        $("#griddatappdb").jqxGrid({
            width: '100%',
            showfilterrow: true,		
            filterable: true,                
            columnsresize: true,
            autoshowfiltericon: true,
            pageable: true,
            autoheight: true,
            theme: "energyblue",
            source: dataAdapter,
            selectionmode: 'multiplecellsextended',
            columns: [
                { text: 'Kwitansi', columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
                    return "View";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#griddatappdb").offset();
                        var dataRecord 	= $("#griddatappdb").jqxGrid('getrowdata', editrow);
                        var goook		= dataRecord.id;
                        var staff		= document.getElementById('getnama').value;
                        $.post('cetak/kwitansipsb', { val01: '', val02: '', val03: '', val04: '', val05: '', val06: '', val07: '', valkirim: goook, jeneng: staff, _token:token },
                        function(data){		
                            var newWindow = window.open('', '', 'width=880, height=500'),
                                document = newWindow.document.open(),
                                pageContent =
                                    '<!DOCTYPE html>\n' +
                                    '<html>\n' +
                                    '<head>\n' +
                                    '<meta charset="utf-8" />\n' +
                                    '<title>Kwitansi PSB</title>\n' +
                                    '</head>\n' +
                                    '<body>' + data + '</body>\n</html>';
                                document.write(pageContent);
                                document.close();	
                                newWindow.print();									
                                return false;
                        });						 
                    }
                },
                { text: 'Form Kesanggupan', columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
                    return "Print";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#griddatappdb").offset();
                        var dataRecord 	= $("#griddatappdb").jqxGrid('getrowdata', editrow);
                        var url 		= "{{URL::to("/")}}/formkesanggupan/"+dataRecord.id;
                        var windowName 	= dataRecord.kodependaf;
                        var windowSize 	= "width=800,height=800";
                        window.open(url, windowName, windowSize);
                        event.preventDefault();
                        return false;
                    }
                },
                { text: 'Kartu Peserta', columntype: 'button', width: '8%', align: 'center', cellsrenderer: function () {
                    return "Print";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#griddatappdb").offset();
                        var dataRecord 	= $("#griddatappdb").jqxGrid('getrowdata', editrow);
                        var url 		= "{{URL::to("/")}}/karpes/"+dataRecord.id;
                        var windowName 	= dataRecord.kodependaf;
                        var windowSize 	= "width=800,height=800";
                        window.open(url, windowName, windowSize);
                        event.preventDefault();
                        return false;
                    }
                },
                { text: 'Verifikasi', columntype: 'button', width: 50, cellsrenderer: function () {
                    return "Verifikasi";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#griddatappdb").offset();
                        var dataRecord 	= $("#griddatappdb").jqxGrid('getrowdata', editrow);
                        $("#daftar_idne").val(dataRecord.id);
                        $("#daftar_nama").val(dataRecord.nama);
                        $("#daftar_nik").val(dataRecord.nik);
                        $("#daftar_tgllahir").val(dataRecord.tgllahir);
                        $("#daftar_tmplahir").val(dataRecord.tmplahir);
                        $("#daftar_status").val(dataRecord.persenselesai);
                        $("#modalverifikasi").modal('show');
                    }
                },
                { text: 'Edit', columntype: 'button', width: 50, cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#griddatappdb").offset();
                        var dataRecord 	= $("#griddatappdb").jqxGrid('getrowdata', editrow);
                        $("#edit_nama").val(dataRecord.nama);
                        $("#edit_kelamin").val(dataRecord.kelamin);
                        $("#edit_darah").val(dataRecord.darah);
                        $("#edit_tinggi").val(dataRecord.tinggi);
                        $("#edit_berat").val(dataRecord.berat);
                        $("#edit_tmplahir").val(dataRecord.tmplahir);
                        $("#edit_tgllahir").val(dataRecord.tgllahir);
                        $("#edit_ayah").val(dataRecord.namaayah);
                        $("#edit_ibu").val(dataRecord.namaibu);
                        $("#edit_kayah").val(dataRecord.kerjaayah);
                        $("#edit_kibu").val(dataRecord.kerjaibu);
                        $("#edit_wali").val(dataRecord.wali);
                        $("#edit_kwali").val(dataRecord.pekerjaanwali);
                        $("#edit_alamat").val(dataRecord.alamatortu);
                        $("#edit_rt").val(dataRecord.erte);
                        $("#edit_rw").val(dataRecord.erwe);
                        $("#edit_kel").val(dataRecord.kelurahan);
                        $("#edit_kec").val(dataRecord.kecamatan);
                        $("#edit_kodepos").val(dataRecord.kodepos);
                        $("#edit_kota").val(dataRecord.kota);
                        $("#edit_hape").val(dataRecord.hape);
                        $("#edit_tahun").val(dataRecord.tamasuk);
                        $("#edit_asal").val(dataRecord.asal);
                        $("#edit_idne").val(dataRecord.id);
                        $("#editdatainduk").modal('show');	
                    }
                },
                { text: 'Nilai', columntype: 'button', width: 50, cellsrenderer: function () {
                    return "Nilai";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#griddatappdb").offset();
                        var dataRecord 	= $("#griddatappdb").jqxGrid('getrowdata', editrow);
                        $("#id_nilai").val(dataRecord.id);
                        $("#id_n1").val(dataRecord.n1);
                        $("#id_n2").val(dataRecord.n2);
                        $("#id_n3").val(dataRecord.n3);
                        $("#id_n4").val(dataRecord.n4);
                        $("#id_n5").val(dataRecord.n5);
                        $("#id_n6").val(dataRecord.n6);
                        $("#id_n7").val(dataRecord.n7);
                        $("#id_n8").val(dataRecord.n8);
                        $("#id_n9").val(dataRecord.n9);
                        $("#id_n10").val(dataRecord.n10);
                        $("#id_n11").val(dataRecord.n11);
                        $("#id_n12").val(dataRecord.n12);
                        $("#id_n13").val(dataRecord.n13);
                        $("#formpenilaian").modal('show');	
                    }
                },
                { text: 'Hasil', columntype: 'button', width: 50, cellsrenderer: function () {
                    return "Hasil";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#griddatappdb").offset();
                        var dataRecord 	= $("#griddatappdb").jqxGrid('getrowdata', editrow);
                        $("#set_idne").val(dataRecord.id);
                        $("#set_alamat").val(dataRecord.alamatortu);
                        $("#set_ayah").val(dataRecord.namaayah);
                        $("#set_ibu").val(dataRecord.namaibu);
                        $("#set_kecamatan").val(dataRecord.kecamatan);
                        $("#set_kelamin").val(dataRecord.kelamin);
                        $("#set_kelurahan").val(dataRecord.kelurahan);
                        $("#set_nama").val(dataRecord.nama);
                        $("#set_tgllahir").val(dataRecord.tgllahir);
                        $("#set_tmtlahir").val(dataRecord.tmplahir);
                        $("#set_seragam").val(dataRecord.dana1);
                        $("#set_pengembangan").val(dataRecord.dana2);
                        $("#set_spp").val(dataRecord.dana3);
                        $("#set_kegiatan").val(dataRecord.dana4);
                        $("#set_nomer").val(dataRecord.nosurat);
                        $("#set_status").val(dataRecord.hasil);
                        $("#formpenentuan").modal('show');	
                    }
                },
                { text: 'Cetak', columntype: 'button', width: 50, cellsrenderer: function () {
                    return "Cetak";
                    }, buttonclick: function (row) {	
                        editrow = row;	
                        var offset 		= $("#griddatappdb").offset();		
                        var dataRecord 	= $("#griddatappdb").jqxGrid('getrowdata', editrow);
                        var url 		= "{{URL::to("/")}}/observasi/"+dataRecord.id;
                        var windowName 	= dataRecord.kodependaf;
                        var windowSize 	= "width=800,height=800";
                        window.open(url, windowName, windowSize);
                        event.preventDefault();
                        return false;
                    }
                },
                { text: 'View Biodata', columntype: 'button', width: '8%', cellsrenderer: function () {
                    return "Biodata";
                    }, buttonclick: function (row) {		
                        editrow = row;	
                        var offset 		= $("#griddatappdb").offset();		
                        var dataRecord 	= $("#griddatappdb").jqxGrid('getrowdata', editrow);
                        var url 		= "{{URL::to("/")}}/biodatapsb/"+dataRecord.id;
                        var windowName 	= dataRecord.kodependaf;
                        var windowSize 	= "width=800,height=800";
                        window.open(url, windowName, windowSize);
                        event.preventDefault();
                        return false;
                    }
                },
                { text: 'ARSIP', columntype: 'button', width: 50, cellsrenderer: function () {
                    return "ARSIP";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#griddatappdb").offset();
                        var dataRecord 	= $("#griddatappdb").jqxGrid('getrowdata', editrow);
                        $("#arsip_idne").val(dataRecord.id);
                        $("#arsip_nama").val(dataRecord.nama);
                        $("#arsip_kelamin").val(dataRecord.kelamin);
                        $("#arsip_tgllahir").val(dataRecord.tgllahir);
                        $("#arsip_tmplahir").val(dataRecord.tmplahir);
                        $("#arsip_induk").val(dataRecord.nextid);
                        $("#arsip_status").val(dataRecord.hasil);
                        $("#formdataarsip").modal('show');
                    }
                },
                { text: 'ID', datafield: 'id', width: 30, cellsalign: 'center', align: 'center' },
                { text: 'Complet', datafield: 'persenselesai', width: 70, align: 'center' },
                { text: 'TA.Masuk', datafield: 'tamasuk', width: 70, align: 'center' },
                { text: 'Kode', datafield: 'kodependaf', width: 70, align: 'center'},
                { text: 'Nama Siswa', datafield: 'nama', width: 150, align: 'center' },
                { text: 'L/P', datafield: 'kelamin', width: 30, cellsalign: 'center', align: 'center' },			
                { text: 'Nama Ayah',  datafield: 'namaayah', width: 150, cellsalign: 'center', align: 'center' },
                { text: 'Nama Ibu',  datafield: 'namaibu', width: 150, cellsalign: 'center', align: 'center' },
                { text: 'Pekerjaan Ayah',  datafield: 'kerjaayah', width: 150, cellsalign: 'center', align: 'center' },
                { text: 'Pekerjaan Ibu',  datafield: 'kerjaibu', width: 150, cellsalign: 'center', align: 'center' },
                { text: 'Nama Wali',  datafield: 'wali', width: 80, cellsalign: 'center', align: 'center' },
                { text: 'Pekerjaan Wali',  datafield: 'pekerjaanwali', width: 80, cellsalign: 'center', align: 'center' },
                { text: 'No.HP Ortu/Wali',  datafield: 'hape', width: 110, cellsalign: 'center', align: 'center' },
                { text: 'Alamat Ortu/Wali',  datafield: 'alamatortu', width: 180, cellsalign: 'center', align: 'center' },
                { text: 'Total', datafield: 'total', width: 40, cellsalign: 'center', align: 'center' },
                { text: 'Rata', datafield: 'rata', width: 40, cellsalign: 'center', align: 'center' },
                { text: 'Status',  datafield: 'hasil', width: 100, cellsalign: 'center', align: 'center' },			
            ],                
        });
    });
</script>
@endpush