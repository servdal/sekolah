@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Sarana dan Prasarana</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row" id="divutama">
                <div class="col-md-12">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Ruang</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btnnewruang" title="Tambah Data Gedung"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-tool" id="export" title="Cetak Tabel Ruang"><i class="fa fa-print"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
							<div id="message"></div>
							<div id="gridk1"></div>
                        </div>
                    </div>
					<div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Kendaraan</h3>
                            <div class="card-tools">
								<button type="button" class="btn btn-tool" id="topbtnviewbbm" title="View BBM"><i class="fa fa-automobile"></i></button>
								<button type="button" class="btn btn-tool" id="topbtnviewservice" title="View Service"><i class="fa fa-ambulance"></i></button>
								<button type="button" class="btn btn-tool" id="topbtnviewtol" title="View TOL"><i class="fa fa-bus"></i></button>
								<button type="button" class="btn btn-tool" id="btnnewkendaraan" title="Tambah Data Kendaraan"><i class="fa fa-plus"></i></button>
								<button type="button" class="btn btn-tool" id="exportkendaraan" title="Cetak Tabel Kendaraan"><i class="fa fa-print"></i></button>							
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
							<div id="gridkkendaraan"></div>
                        </div>
                    </div>
				</div>
				<div class="col-md-6">
                	<div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Gedung</h3>
                            <div class="card-tools">
								<button type="button" class="btn btn-tool" id="btnnewgedung" title="Tambah Data Gedung"><i class="fa fa-plus"></i></button>
								<button type="button" class="btn btn-tool" id="exportgedung" title="Cetak Tabel Gedung"><i class="fa fa-print"></i></button>
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
							<div id="gridgedung"></div>
                        </div>
                    </div>
                </div>
				<div class="col-md-6">
                	<div class="card card-warning shadow">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Garasi</h3>
                            <div class="card-tools">
								<button class="btn btn-box-tool" id="btnnewgarasi" title="Tambah Data Garasi"><i class="fa fa-plus"></i></button>
								<button class="btn btn-box-tool" id="exportgarasi" title="Cetak Tabel Garasi"><i class="fa fa-print"></i></button>							
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
							<div id="gridgarasi"></div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="row" id="divviewdetail">
				<div class="col-md-4">
                	<div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Rekap Inventaris</h3>
                            <div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
							<div id="griddir"></div>
                        </div>
                    </div>
                </div>
				<div class="col-md-8">
                	<div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Fasilitas Ruang</h3>
                            <div class="card-tools">
								<button type="button" class="btn btn-tool" title="Tambah Fasilitas/Iventaris" id="btntambahfasilitas"><i class="fa fa-plus"></i></button>
								<button type="button" class="btn btn-tool" title="Report Fasilitas/Iventaris" id="btncetakfasilitas"><i class="fa fa-print"></i></button>
								<button type="button" class="btn btn-tool" id="btnkembalidrview"><i class="fa fa-times"></i></button>
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
							<div id="pesan"></div>
							<div id="divview"></div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="row" id="divlaporan">
				<div class="col-md-12">
                	<div class="card card-primary shadow">
                        <div class="card-header">
                            <h3 class="card-title">Laporan Penggunaan</h3>
                            <div class="card-tools">
								<button type="button" class="btn btn-tool" id="exportlaporan" title="Export Data ke Excel"><i class="fa fa-print"></i></button>
								<button type="button" class="btn btn-tool" id="btnkembalidarilaporan"><i class="fa fa-times"></i></button>
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
							<div id="gridlaporan"></div>
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
<div class="modal fade" id="modaladdgedung">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Add Data Gedung</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-6">
							<label for="addnmgedung">Nama Gedung</label>
							<input type="text" class="form-control" id="addnmgedung">
						</div>			 
						<div class="col-lg-6">
							<label for="addkodegedung">Kode Gedung</label>
							<input type="text" class="form-control" id="addkodegedung">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">			  
						<div class="col-lg-5">
							<label for="addtarifgedung">Tarif Sewa Perhari</label>
							<input type="text" class="form-control" id="addtarifgedung">
						</div>			 
						<div class="col-lg-7">
							<label for="addstatusgedung">Status Sewa</label>
							<select id="addstatusgedung" class="form-control" >
								<option value="Tidak di Sewa/Pinjamkan">Tidak di Sewa/Pinjamkan</option>
								<option value="Di Sewa/Pinjamkan untuk kalangan internal">Di Sewa/Pinjamkan untuk kalangan internal</option>
								<option value="Di Sewa/Pinjamkan untuk umum">Di Sewa/Pinjamkan untuk umum</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="addpjgedung">Permohonan Sewa / Pinjam di tujukan ke:</label>
					<input type="text" class="form-control" id="addpjgedung">
				</div>
				<div class="form-group">
					<label for="addfotogedung">File Foto Gedung</label>
					<input type="file" id="addfotogedung">
					<p class="help-block">File diperbolehkan hanya JPG / JPEG / PNG</p>
				</div>
				<div class="form-group">
					<img id="previewgedung" src="dist/img/takadagambar.png" width="150px" height="150px"/>
				</div>
            </div>
            <div class="modal-footer justify-content-between">
				<input type="hidden" class="form-control" id="addidgedung">
				<button type="button" class="btn btn-warning pull-right" id="btnaddgedung">Add Gedung</button>
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalhapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Hapus Data Ruang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-6">
							<label for="delnamarg">Nama Ruang</label>
							<input type="text" class="form-control" id="delnamarg" disabled="disable">
						</div>			 
						<div class="col-lg-6">
							<label for="delnamamgd">Nama Gedung</label>
							<input type="text" class="form-control" id="delnamamgd" disabled="disable">
						</div>
					</div>
				</div>
				<div class="form-group">
					<strong>Apakah Anda Yakin Ingin Menghapus Data Ruang Ini.?</strong>
				</div>
            </div>
            <div class="modal-footer justify-content-between">
				<input type="hidden" class="form-control" id="delidnya">
				<button type="button" class="btn btn-danger pull-right" id="btndelete">Hapus</button>
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaladdruang">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Tambah Data Ruang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-3">
							<label for="namarg">Nama Ruang</label>
							<input type="text" class="form-control" id="namarg">
						</div>
						<div class="col-lg-3">
							<label for="koderg">Kode Ruang</label>
							<input type="text" class="form-control" id="koderg">
						</div>
						<div class="col-lg-3">
							<label for="luas">Luas</label>
							<input type="text" class="form-control" id="luas">
						</div>
						<div class="col-lg-3">
							<label for="kapasitas">Kapasitas</label>
							<input type="text" class="form-control" id="kapasitas">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-6">
							<label for="namagd">Gedung</label>
							<select id="namagd" class="form-control" >
								<option value="">Pilih Salah Satu</option>
								@foreach($gedunge as $rgedung)
									<option value="{{ $rgedung->namagd }}">{{ $rgedung->namagd }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-lg-6">
							<label for="petugas">Petugas</label>
							<input type="text" class="form-control" id="petugas">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="status">Jenis</label>
							<select id="status" class="form-control" >	
								<option value="kuliah">Ruang Kuliah</option>
								<option value="ujian">Ruang Ujian</option>
								<option value="rapat">Ruang Rapat</option>
								<option value="dosen">Ruang Dosen</option>
								<option value="pimpinan">Ruang Pimpinan</option>
								<option value="serbaguna">Ruang Serbaguna</option>
							</select>
						</div>
						<div class="col-lg-4">
							<label for="id_kondisi">Kondisi</label>
							<select id="id_kondisi" class="form-control" >	
								<option value="Terawat">Terawat</option>
								<option value="Tidak Terawat">Tidak Terawat</option>
							</select>
						</div>
						<div class="col-lg-4">
							<label for="id_utilitas">Utilitas (Jam / Minggu)</label>
							<input type="text" class="form-control" id="id_utilitas">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">			  
						<div class="col-lg-5">
							<label for="id_tarif">Tarif Sewa Perhari</label>
							<input type="text" class="form-control" id="id_tarif">
						</div>
						<div class="col-lg-7">
							<label for="id_statussewa">Status Sewa</label>
							<select id="id_statussewa" class="form-control" >
								<option value="Tidak di Sewa/Pinjamkan">Tidak di Sewa/Pinjamkan</option>
								<option value="Di Sewa/Pinjamkan untuk kalangan internal">Di Sewa/Pinjamkan untuk kalangan internal</option>
								<option value="Di Sewa/Pinjamkan untuk umum">Di Sewa/Pinjamkan untuk umum</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="id_pjruang">Permohonan Sewa / Pinjam di tujukan ke:</label>
					<input type="text" class="form-control" id="id_pjruang">
				</div>
				<div class="form-group">
					<label for="id_fotoruang">File Foto Ruangan</label>
					<input type="file" id="id_fotoruang">
					<p class="help-block">File diperbolehkan hanya JPG / JPEG / PNG</p>
				</div>
				<div class="form-group">
					<img id="previewruang" src="dist/img/takadagambar.png" width="150px" height="150px"/>
				</div>
            </div>
            <div class="modal-footer justify-content-between">
				<input type="hidden" class="form-control" id="idnya">
				<button type="button" class="btn btn-success pull-right" id="btntambah">Tambahkan</button>
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaladdfasilitas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Tambah Fasilitas Ruang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-3">
							<label for="fas_ruang">Nama Ruang</label>
							<input type="text" class="form-control" id="fas_ruang" disabled="disable">
						</div>
						<div class="col-lg-9">
							<label for="fas_namabrg">Nama Barang</label>
							<input type="text" class="form-control" id="fas_namabrg">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">			  
						<div class="col-lg-3">
							<label for="fas_jenis">Jenis</label>
							<select id="fas_jenis" class="form-control" >	
								<option value="Mebeller">Mebeller</option>
								<option value="Elektronik">Elektronik</option>
								<option value="Pecah Belah">Pecah Belah</option>
								<option value="Rumah Tangga">Rumah Tangga</option>
								<option value="Lain-Lain">Lain-Lain</option>
							</select>
						</div>
						<div class="col-lg-3">
							<label for="fas_merk">Merk</label>
							<input type="text" class="form-control" id="fas_merk">
						</div>
						<div class="col-lg-3">
							<label for="fas_tahun">Tahun Terima</label>
							<input type="text" class="form-control" id="fas_tahun" value="{{date("Y")}}">
						</div>
						<div class="col-lg-3">
							<label for="fas_jumlah">Satuan Barang</label>
							<input type="text" class="form-control" id="fas_jumlah" value="unit">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="fas_kodefasruang">Kode Barang</label>
							<input type="text" class="form-control" id="fas_kodefasruang">
						</div>
						<div class="col-lg-4">
							<label for="fas_sumber">Sumber Dana</label>
							<select id="fas_sumber" class="form-control">	
								<option value="PNPBP">PNPBP</option>
								<option value="BOPTN">BOPTN</option>
								<option value="LAINNYA">LAINNYA</option>
							</select>
						</div>
						<div class="col-lg-4">
							<label for="fas_kondisi">Kondisi</label>
							<select id="fas_kondisi" class="form-control" >	
								<option value="BAIK">BAIK</option>
								<option value="Perlu Perawatan">Perlu Perawatan</option>
								<option value="RUSAK">RUSAK</option>
								<option value="HILANG">HILANG</option>
							</select>
						</div>
					</div>
				</div>
            </div>
            <div class="modal-footer justify-content-between">
				<input type="hidden" class="form-control" id="fas_idne">
				<input type="hidden" class="form-control" id="fas_idruang">
				<button type="button" class="btn btn-success pull-right" id="btnaddfasilitas">Tambahkan</button>
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaladdaktifitas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Add Aktifitas Kendaraan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="aktif_nama">Nama Kendaraan</label>
							<input type="text" class="form-control" id="aktif_nama" disabled="disable">
						</div>
						<div class="col-lg-4">
							<label for="aktif_garasi">Garasi</label>
							<input type="text" class="form-control" id="aktif_garasi" disabled="disable">
						</div>
						<div class="col-lg-4">
							<label for="aktif_nopol">NOPOL</label>
							<input type="text" class="form-control" id="aktif_nopol" disabled="disable">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-6">
							<label for="aktif_jenis">Jenis</label>
							<select id="aktif_jenis" class="form-control">
								<option value="BBM">BBM</option>
								<option value="SERVICE">SERVICE</option>
								<option value="TOL">TOL</option>
							</select>
						</div>
						<div class="col-lg-6">
							<label for="aktif_nominal">Nominal</label>
							<input type="text" class="form-control" id="aktif_nominal">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="aktif_tanggal">Tanggal Pelaksanaan</label>
					<input type="text" class="form-control" id="aktif_tanggal">
				</div>
				<div class="form-group">
					<label for="aktif_driver">Penanggung Jawab / Driver</label>
					<input type="text" class="form-control" id="aktif_driver">
				</div>
				<div class="form-group">
					<label for="aktif_keterangan">Keterangan</label>
					<textarea id="aktif_keterangan" name="aktif_keterangan" rows="10" cols="80"></textarea>
				</div>
            </div>
            <div class="modal-footer justify-content-between">
				<input type="hidden" class="form-control" id="aktif_idkendaraan">
				<input type="hidden" class="form-control" id="aktif_idne">
				<button type="button" class="btn btn-warning pull-right" id="btnsimpanaktifitas">Simpan</button>
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaladdgarasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Add Data Garasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-6">
							<label for="addnmgarasi">Nama Garasi</label>
							<input type="text" class="form-control" id="addnmgarasi">
						</div>
						<div class="col-lg-6">
							<label for="addkodegarasi">Kode Garasi</label>
							<input type="text" class="form-control" id="addkodegarasi">
						</div>
					</div>
				</div>
            </div>
            <div class="modal-footer justify-content-between">
				<input type="hidden" class="form-control" id="addidgarasi">
				<button type="button" class="btn btn-warning pull-right" id="btnaddgarasi">Add Garasi</button>
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaladdkendaraan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Tambah Data Kendaraan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-3">
							<label for="namarg2">Nama Kendaraan</label>
							<input type="text" class="form-control" id="namarg2">
						</div>
						<div class="col-lg-3">
							<label for="koderg2">Kode Kendaraan</label>
							<input type="text" class="form-control" id="koderg2">
						</div>
						<div class="col-lg-3">
							<label for="luas2">NOPOL</label>
							<input type="text" class="form-control" id="luas2">
						</div>
						<div class="col-lg-3">
							<label for="kapasitas2">Kapasitas</label>
							<input type="text" class="form-control" id="kapasitas2">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">			  
						<div class="col-lg-6">
							<label for="namagd2">Garasi</label>
							<select id="namagd2" class="form-control" >
								<option value="">Pilih Salah Satu</option>
								@foreach($garasine as $rgedung)
									<option value="{{ $rgedung->namagd }}">{{ $rgedung->namagd }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-lg-6">
							<label for="petugas2">Petugas/Driver</label>
							<input type="text" class="form-control" id="petugas2">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="status2">Status</label>
							<select id="status2" class="form-control" >	
								<option value="OK">Di Gunakan</option>
								<option value="">Tidak Digunakan</option>
							</select>
						</div>
						<div class="col-lg-4">
							<label for="id_kondisi2">Kondisi</label>
							<select id="id_kondisi2" class="form-control" >	
								<option value="Terawat">Terawat</option>
								<option value="Tidak Terawat">Tidak Terawat</option>
							</select>
						</div>
						<div class="col-lg-4">
							<label for="id_utilitas2">Utilitas (Jam / Minggu)</label>
							<input type="text" class="form-control" id="id_utilitas2" value="40">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-5">
							<label for="id_tarif2">Tarif Sewa Perhari</label>
							<input type="text" class="form-control" id="id_tarif2">
						</div>
						<div class="col-lg-7">
							<label for="id_statussewa2">Status Sewa</label>
							<select id="id_statussewa2" class="form-control" >
								<option value="Tidak di Sewa/Pinjamkan">Tidak di Sewa/Pinjamkan</option>
								<option value="Di Sewa/Pinjamkan untuk kalangan internal">Di Sewa/Pinjamkan untuk kalangan internal</option>
								<option value="Di Sewa/Pinjamkan untuk umum">Di Sewa/Pinjamkan untuk umum</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="id_pjruang2">Permohonan Sewa / Pinjam di tujukan ke:</label>
					<input type="text" class="form-control" id="id_pjruang2">
				</div>
				<div class="form-group">
					<label for="id_fotoruang2">File Foto Ruangan</label>
					<input type="file" id="id_fotoruang2">
					<p class="help-block">File diperbolehkan hanya JPG / JPEG / PNG</p>
				</div>
				<div class="form-group">
					<img id="previewkendaraan" src="dist/img/takadagambar.png" width="150px" height="150px"/>
				</div>
            </div>
            <div class="modal-footer justify-content-between">
				<input type="hidden" class="form-control" id="idnya2">
				<button type="button" class="btn btn-success pull-right" id="btntambahkendaraan">Tambahkan</button>
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>	
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="judulpage" id="judulpage" value=" config('global.Title')">
<input type="hidden" name="getnama" id="getnama" value="{{Session('nama')}}">
@endsection
@push('script')
<script type="text/javascript">
	$('#addfotogedung').change(function () {
        if(this.files[0].size > 700000){
            swal({
				title: 'Stop',
				text: 'Maksimum File 7 Mb',
				type: 'warning',
			})
            this.value = "";
        } else {
            var imgPath = this.value;
			var ukfile 	= this.files[0].size;
            var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
			if(ext == "jpg" || ext == "jpeg" || ext == "png") {
                readURLgedung(this);
            } else {
				swal({
					title: 'Stop',
					text: 'Please select image file (jpg, jpeg, png).',
					type: 'warning',
				})
            }
        }
    });
	function readURLgedung(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#previewgedung').attr('src', e.target.result);
            };
        }
    }
	$('#id_fotoruang').change(function () {
        if(this.files[0].size > 700000){
            swal({
				title: 'Stop',
				text: 'Maksimum File 7 Mb',
				type: 'warning',
			})
            this.value = "";
        } else {
            var imgPath = this.value;
			var ukfile 	= this.files[0].size;
            var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
			if(ext == "jpg" || ext == "jpeg" || ext == "png") {
                readURLruang(this);
            } else {
				swal({
					title: 'Stop',
					text: 'Please select image file (jpg, jpeg, png).',
					type: 'warning',
				})
            }
        }
    });
	function readURLruang(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#previewruang').attr('src', e.target.result);
            };
        }
    }
    $('#id_fotoruang2').change(function () {
        if(this.files[0].size > 700000){
            swal({
				title: 'Stop',
				text: 'Maksimum File 7 Mb',
				type: 'warning',
			})
            this.value = "";
        } else {
            var imgPath = this.value;
			var ukfile 	= this.files[0].size;
            var ext 	= imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
			if(ext == "jpg" || ext == "jpeg" || ext == "png") {
                readURLkendaraan(this);
            } else {
				swal({
					title: 'Stop',
					text: 'Please select image file (jpg, jpeg, png).',
					type: 'warning',
				})
            }
        }
    });
	function readURLkendaraan(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#previewkendaraan').attr('src', e.target.result);
            };
        }
    }
	$(function () {
		$("#aktif_tanggal").datepicker({format: 'yyyy-mm-dd'});
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace( 'aktif_keterangan', {
			toolbarGroups: [{"name":"basicstyles","groups":["basicstyles", "list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
	});
	$(document).ready(function () {
		$("#aktif_nominal").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
		$("#btncetakfasilitas").click(function () {
			var gridContent = $("#divview").jqxGrid('exportdata', 'html');	
			var newWindow = window.open('', '', 'width=800, height=500'),
			document 	= newWindow.document.open(),
			pageContent =
				'<!DOCTYPE html>\n' +
				'<html>\n' +
				'<head>\n' +
				'<meta charset="utf-8" />\n' +
				'<title>Tabel Ruang</title>\n' +
				'</head>\n' +
				'<body>' + gridContent + '</body>\n</html>';
			document.write(pageContent);
			document.close();
		});
		$("#export").click(function () {
			var gridContent = $("#gridk1").jqxGrid('exportdata', 'html');	
			var newWindow = window.open('', '', 'width=800, height=500'),
			document 	= newWindow.document.open(),
			pageContent =
				'<!DOCTYPE html>\n' +
				'<html>\n' +
				'<head>\n' +
				'<meta charset="utf-8" />\n' +
				'<title>Tabel Ruang</title>\n' +
				'</head>\n' +
				'<body>' + gridContent + '</body>\n</html>';
			document.write(pageContent);
			document.close();
		});
		$("#exportgedung").click(function () {
			var gridContent = $("#gridgedung").jqxGrid('exportdata', 'html');	
			var newWindow = window.open('', '', 'width=800, height=500'),
			document 	= newWindow.document.open(),
			pageContent =
				'<!DOCTYPE html>\n' +
				'<html>\n' +
				'<head>\n' +
				'<meta charset="utf-8" />\n' +
				'<title>Tabel Gedung</title>\n' +
				'</head>\n' +
				'<body>' + gridContent + '</body>\n</html>';
			document.write(pageContent);
			document.close();
		});
		$('#divviewdetail').hide();
		$('#divlaporan').hide();
		$('#btnkembalidrview').click(function () {
			$('#divviewdetail').hide();
			$('#divlaporan').hide();
			$('#divutama').show();
		});
		$('#btnkembalidarilaporan').click(function () {
			$('#divviewdetail').hide();
			$('#divlaporan').hide();
			$('#divutama').show();
		});
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'dot'},
				{ name: 'namarg', type: 'text'},
				{ name: 'namagd', type: 'text'},
				{ name: 'kodegd', type: 'text'},
				{ name: 'koderg', type: 'text'},
				{ name: 'petugas', type: 'text'},
				{ name: 'marking', type: 'text'},
				{ name: 'luas', type: 'text'},	
				{ name: 'kapasitas', type: 'text'},
				{ name: 'kondisi', type: 'text'},
				{ name: 'utilitas', type: 'text'},
				{ name: 'pjgedung', type: 'text'},
				{ name: 'pejabat', type: 'text'},
				{ name: 'pinjam', type: 'text'},
				{ name: 'statpinjam', type: 'text'},
				{ name: 'tarif', type: 'text'},
				{ name: 'fakpanjang', type: 'text'},	
				{ name: 'fakultas', type: 'text'},
				{ name: 'inputor', type: 'text'},
				{ name: 'foto', type: 'text'},
			],
			url: 'umum/allruang',
			cache: false
		};		
		var dataAdapter = new $.jqx.dataAdapter(source);
		var photoruang = function (row, column, value) {
			var name = $('#gridk1').jqxGrid('getrowdata', row).foto;
			if (name != ''){
				var img = '<div style="background: white;"><img style="margin:2px; margin-left: 10px;" width="50" height="50" src="images/ruang/' + name + '"></div>';
				
			} else {
				var img = '<div style="background: white;"></div>';
			}			
			return img;
		}
		$("#gridk1").jqxGrid({
			width: '100%',
			pageable: true,
			filterable: true,
			showfilterrow: true,
			autoheight: true,
			altrows: true,
			rowsheight: 50,
			columnsresize: true,
			source: dataAdapter,
			theme: "energyblue",
			columns: [
				{ text: 'Foto', editable: false, sortable: false, filterable: false, width: '5%', cellsrenderer: photoruang },
				{ text: 'DIR', editable: false, sortable: false, filterable: false, align: 'center', columntype: 'button', width: '8%', cellsrenderer: function () {
					return "Cetak";
					}, buttonclick: function (row) {		
					editrow = row;	
					var offset 		= $("#gridk1").offset();		
					var dataRecord 	= $("#gridk1").jqxGrid('getrowdata', editrow);						
					var goook		= dataRecord.dot;
					var token 		= document.getElementById('token').value;
					$.post('umum/ctkdir', { valkirim: goook, _token: token },
					function(data){
						var newWindow = window.open('', '', 'width=800, height=500'),
							document = newWindow.document.open(),
							pageContent =
								'<!DOCTYPE html>\n' +
								'<html>\n' +
								'<head>\n' +
								'<meta charset="utf-8" />\n' +
								'<title>Daftar Inventaris Ruang '+dataRecord.namarg+'</title>\n' +
								'</head>\n' +
								'<body>' + data + '</body>\n</html>';
							document.write(pageContent);
							document.close();
							newWindow.print();
							return false;
						});
					}
				},
				{ text: 'Fasilitas', editable: false, sortable: false, filterable: false, columntype: 'button', width: 70, align: 'center', cellsrenderer: function () {
					return "Fasilitas";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset 		= $("#gridk1").offset();
						var dataRecord 	= $("#gridk1").jqxGrid('getrowdata', editrow);
						var set01		= dataRecord.dot;
						var set02		= dataRecord.namarg;
						$("#fas_idruang").val(dataRecord.dot);
						$("#fas_ruang").val(dataRecord.namarg);
						var token = document.getElementById('token').value;
						var sourcedetail = {
							datatype: "json",
							datafields: [
								{ name: 'idne'},
								{ name: 'idruang',type: 'text'},
								{ name: 'namarg',type: 'text'},
								{ name: 'namabrg',type: 'text'},
								{ name: 'jenis',type: 'text'},
								{ name: 'merek',type: 'text'},
								{ name: 'tahunterima',type: 'text'},
								{ name: 'jumlah',type: 'text'},
								{ name: 'sumberdana',type: 'text'},
								{ name: 'keterangan',type: 'text'},
								{ name: 'kondisi',type: 'text'},
								{ name: 'timestamp',type: 'text'},
							],
							type: 'POST',
							data: {	val01:set01, val02:set02, _token: token },
							url: '{{ url("umum/getdetailruang") }}',
						};
						var datadetail = new $.jqx.dataAdapter(sourcedetail);
						$('#divviewdetail').show();
						$('#divutama').hide();
						$("#divview").jqxGrid({
							width: '100%',
							pageable: true,
							filterable: true,
							showfilterrow: true,
							autoheight: true,
							altrows: true,
							columnsresize: true,
							source: datadetail,
							theme: "energyblue",
							columns: [
								{ text: 'Nama Ruang', datafield: 'namarg', width: 150, cellsalign: 'left', align: 'center' },
								{ text: 'Nama Barang', datafield: 'namabrg', width: 150, cellsalign: 'left', align: 'center' },
								{ text: 'Jenis', datafield: 'jenis', width: 100, cellsalign: 'left', align: 'center' },
								{ text: 'Merk', datafield: 'merek', width: 100, cellsalign: 'left', align: 'center' },
								{ text: 'Tahun', datafield: 'tahunterima', width: 100, cellsalign: 'left', align: 'center' },
								{ text: 'Satuan', datafield: 'jumlah', width: 100, cellsalign: 'left', align: 'center' },
								{ text: 'Kondisi', datafield: 'kondisi', width: 100, cellsalign: 'left', align: 'center' },
								{ text: 'Keterangan', datafield: 'keterangan', width: 250, cellsalign: 'left', align: 'center' },
								{ text: 'Edit', datafield: 'Edit', width: 50, align: 'center', columntype: 'button', cellsrenderer: function () {
									return "Edit";
									}, buttonclick: function (row) {
									editrow = row;	
									var offset = $("#divview").offset();
									var dataRecord = $("#divview").jqxGrid('getrowdata', editrow);
									$("#fas_idne").val(dataRecord.idne);
									$("#fas_idruang").val(dataRecord.idruang);
									$("#fas_jenis").val(dataRecord.jenis);
									$("#fas_jumlah").val(dataRecord.jumlah);
									$("#fas_kondisi").val(dataRecord.kondisi);
									$("#fas_merk").val(dataRecord.merek);
									$("#fas_namabrg").val(dataRecord.namabrg);
									$("#fas_ruang").val(dataRecord.namaruang);
									$("#fas_sumber").val(dataRecord.sumberdana);
									$("#fas_tahun").val(dataRecord.tahunterima);
									$("#modaladdfasilitas").modal('show');
									}
								},
							],
						});
						var sourcerekapdetail = {
							datatype: "json",
							datafields: [
								{ name: 'namabrg',type: 'text'},
								{ name: 'jenis',type: 'text'},
								{ name: 'jumlah',type: 'text'},
								{ name: 'kondisi',type: 'text'},
							],
							type: 'POST',
							data: {	val01:set01, val02:set02, _token: token },
							url: '{{ url("umum/getrekapdetailruang") }}',
						};
						var datarekapdetail = new $.jqx.dataAdapter(sourcerekapdetail);
						$("#griddir").jqxGrid({
							width: '100%',
							filterable: true,
							columnsresize: true,
							filtermode: 'excel',
							theme: "orange",
							autoheight: true,
							source: datarekapdetail,
							selectionmode: 'multiplecellsextended',
							columns: [
								{ text: 'Nama Barang', datafield: 'namabrg', width: 150, cellsalign: 'left', align: 'center' },
								{ text: 'Jenis', datafield: 'jenis', width: 100, cellsalign: 'left', align: 'center' },
								{ text: 'Jumlah', datafield: 'jumlah', width: 100, cellsalign: 'left', align: 'center' },
								{ text: 'Kondisi', datafield: 'kondisi', width: 100, cellsalign: 'left', align: 'center' },
							],
						});
					}
				},
				{ text: 'Edit', editable: false, sortable: false, filterable: false, datafield: 'Edit', width: 50, align: 'center', columntype: 'button', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {
					editrow = row;	
					var offset = $("#gridk1").offset();
					var dataRecord = $("#gridk1").jqxGrid('getrowdata', editrow);
					$("#namarg").val(dataRecord.namarg);
					$("#namagd").val(dataRecord.namagd);
					$("#koderg").val(dataRecord.koderg);
					$("#petugas").val(dataRecord.petugas);
					$("#luas").val(dataRecord.luas);
					$("#kapasitas").val(dataRecord.kapasitas);
					$("#status").val(dataRecord.marking);
					$("#id_kondisi").val(dataRecord.kondisi);
					$("#id_utilitas").val(dataRecord.utilitas);
					$("#idnya").val(dataRecord.dot);
					$("#modaladdruang").modal('show');
					}
				},
				{ text: 'Nama Ruang', datafield: 'namarg', width: 120, cellsalign: 'left', align: 'center'  },
				{ text: 'Nama Gedung', filtertype: 'checkedlist', datafield: 'namagd', width: 150, cellsalign: 'left', align: 'center'  },
				{ text: 'Kode Ruang', datafield: 'koderg', width: 100, align: 'center',  cellsalign: 'left'},
				{ text: 'Petugas', datafield: 'petugas', width: 120, cellsalign: 'left', align: 'center' },
				{ text: 'Pinjam di ajukan kepada', datafield: 'pejabat', width: '25%', cellsalign: 'left', align: 'center' },
				{ text: 'Status', filtertype: 'checkedlist', datafield: 'statpinjam', width: '15%', align: 'center',  cellsalign: 'left'  },
				{ text: 'Tarif Perhari', cellsformat: 'n', datafield: 'tarif', width: '10%', align: 'center',  cellsalign: 'right'  },
				{ text: 'Luas', datafield: 'luas', width: 70, align: 'center',  cellsalign: 'left'  },
				{ text: 'Kondisi', filtertype: 'checkedlist', datafield: 'kondisi', width: 70, align: 'center',  cellsalign: 'left'  },
				{ text: 'Kapasitas', datafield: 'kapasitas', width: 70, align: 'center',  cellsalign: 'left'  },
				{ text: 'Utilitas(Jam/Minggu)', datafield: 'utilitas', width: 70, align: 'center',  cellsalign: 'left'  },
				{ text: 'Inputor', datafield: 'inputor', width: '15%', align: 'center',  cellsalign: 'left'  },
				{ text: 'Hapus', columntype: 'button', editable: false, sortable: false, filterable: false, width: '7%', cellsrenderer: function () {
					return "Hapus";
					}, buttonclick: function (row) {    
					editrow = row;  
					var offset      = $("#gridk1").offset();        
					var dataRecord  = $("#gridk1").jqxGrid('getrowdata', editrow);
					var token   	=   document.getElementById('token').value;
					var val01		= 'hapus';
					var val02		= '';
					var val03		= '';
					var val04		= '';
					var val05		= '';
					var val06		= '';
					var val07		= '';
					var val08		= dataRecord.dot;
					var val09		= '';
					var val10		= '';
					var val11		= '';
					var val12		= '';
					var val13		= '';
					swal({
							title: 'Perhatian?',
							text: "Mohon pastikan data di fasilitas / inventaris ruangan ini telah kosong. Bila masih terdapat data inventaris ruang maka ruangan ini tidak bisa di hapus.!!",
							type: 'warning',
							showCancelButton: true,
							confirmButtonClass: 'btn btn-confirm mt-2',
							cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
							confirmButtonText: 'Delete'
						}).then(function () {
							$.post('umum/exruang', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, _token: token },
								function(data){
									var status  = data.status;
									var message = data.message;									
									swal({
										title: status,
										text: message,
										type: 'success',
										timer: 2000
									}).then(
										function () {
										},
										function (dismiss) {
											if (dismiss === 'timer') {
												
											}
										}
									)
									$("html, body").animate({ scrollTop: 0 }, "slow");
									$("#gridk1").jqxGrid('updatebounddata');
									return false;
							});
						});
					}
				},
			]
		});
		var sourcegedung = {
			datatype: "json",
			datafields: [
				{ name: 'dot'},
				{ name: 'namagd', type: 'text'},
				{ name: 'singgd', type: 'text'},
				{ name: 'kodegd', type: 'text'},
				{ name: 'pejabat', type: 'text'},
				{ name: 'pjgedung', type: 'text'},
				{ name: 'statpinjam', type: 'text'},
				{ name: 'tarif', type: 'text'},
				{ name: 'fakpanjang', type: 'text'},	
				{ name: 'fakultas', type: 'text'},
				{ name: 'inputor', type: 'text'},
				{ name: 'foto', type: 'text'},
			],
			url: 'umum/allgedung',
			cache: false
		};		
		var jsonGedung = new $.jqx.dataAdapter(sourcegedung);
		var photogedung = function (row, column, value) {
			var name = $('#gridgedung').jqxGrid('getrowdata', row).foto;
			if (name != ''){
				var img = '<div style="background: white;"><img style="margin:2px; margin-left: 10px;" width="50" height="50" src="images/gedung/' + name + '"></div>';
				
			} else {
				var img = '<div style="background: white;"></div>';
			}			
			return img;
		}
		$("#gridgedung").jqxGrid({
			width: '100%',
			pageable: true,
			rowsheight: 50,
			filterable: true,
			showfilterrow: true,
			autoheight: true,
			altrows: true,
			columnsresize: true,
			source: jsonGedung,
			theme: "energyblue",
			columns: [
				{ text: 'Foto', editable: false, sortable: false, filterable: false, width: '5%', cellsrenderer: photogedung },
				{ text: 'Nama Gedung', datafield: 'namagd', width: '15%', cellsalign: 'left', align: 'center'  },
				{ text: 'Kode', datafield: 'kodegd', width: '10%', align: 'center',  cellsalign: 'left'},
				{ text: 'Pinjam di ajukan kepada', datafield: 'pejabat', width: '25%', cellsalign: 'left', align: 'center' },
				{ text: 'Status', filtertype: 'checkedlist', datafield: 'statpinjam', width: '15%', align: 'center',  cellsalign: 'left'  },
				{ text: 'Tarif Perhari', cellsformat: 'n', datafield: 'tarif', width: '10%', align: 'center',  cellsalign: 'right'  },
				{ text: 'Inputor', datafield: 'inputor', width: '15%', align: 'center',  cellsalign: 'left'  },
				{ text: 'Edit', editable: false, sortable: false, filterable: false, datafield: 'Edit', width: '5%', align: 'center', columntype: 'button', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {
					editrow = row;	
					var offset = $("#gridgedung").offset();
					var dataRecord = $("#gridgedung").jqxGrid('getrowdata', editrow);
					$("#addnmgedung").val(dataRecord.namagd);
					$("#addkodegedung").val(dataRecord.kodegd);
					$("#addpjgedung").val(dataRecord.pjgedung);
					$("#addstatusgedung").val(dataRecord.statpinjam);
					$("#addtarifgedung").val(dataRecord.tarif);
					$("#addidgedung").val(dataRecord.dot);
					$("#modaladdgedung").modal('show');
					}
				},
				{ text: 'Hapus', columntype: 'button', editable: false, sortable: false, filterable: false, width: '7%', cellsrenderer: function () {
					return "Hapus";
					}, buttonclick: function (row) {    
					editrow = row;  
					var offset      = $("#gridgedung").offset();        
					var dataRecord  = $("#gridgedung").jqxGrid('getrowdata', editrow);
					var token   	=   document.getElementById('token').value;
					var val01		= 'hapusgedung';
					var val02		= '';
					var val03		= '';
					var val04		= '';
					var val05		= '';
					var val06		= '';
					var val07		= '';
					var val08		= dataRecord.dot;
					var val09		= '';
					var val10		= '';
					var val11		= '';
					var val12		= '';
					var val13		= '';
					swal({
							title: 'Perhatian?',
							text: "Mohon pastikan data ruangan di Gedung ini telah kosong. Bila masih terdapat data ruangan maka Gedung ini tidak bisa di hapus.!!",
							type: 'warning',
							showCancelButton: true,
							confirmButtonClass: 'btn btn-confirm mt-2',
							cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
							confirmButtonText: 'Delete'
						}).then(function () {
							$.post('umum/exruang', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, _token: token },
								function(data){
									var status  = data.status;
									var message = data.message;									
									swal({
										title: status,
										text: message,
										type: 'success',
										timer: 2000
									}).then(
										function () {
										},
										function (dismiss) {
											if (dismiss === 'timer') {
												
											}
										}
									)
									$("html, body").animate({ scrollTop: 0 }, "slow");
									$("#gridgedung").jqxGrid('updatebounddata');
									return false;
							});
						});
					}
				},
			]
		});
		var sourcegarasi = {
			datatype: "json",
			datafields: [
				{ name: 'dot'},
				{ name: 'namagd', type: 'text'},
				{ name: 'singgd', type: 'text'},
				{ name: 'kodegd', type: 'text'},
				{ name: 'fakpanjang', type: 'text'},	
				{ name: 'fakultas', type: 'text'},
				{ name: 'inputor', type: 'text'},
			],
			url: 'umum/allgarasi',
			cache: false
		};		
		var jsonGarasi = new $.jqx.dataAdapter(sourcegarasi);
		$("#gridgarasi").jqxGrid({
			width: '100%',
			pageable: true,
			filterable: true,
			showfilterrow: true,
			autoheight: true,
			altrows: true,
			columnsresize: true,
			source: jsonGarasi,
			theme: "energyblue",
			columns: [
				{ text: 'Nama Gedung', datafield: 'namagd', width: '25%', cellsalign: 'left', align: 'center'  },
				{ text: 'Kode', datafield: 'kodegd', width: '20%', align: 'center',  cellsalign: 'left'},
				{ text: 'Inputor', datafield: 'inputor', width: '25%', align: 'center',  cellsalign: 'left'  },
				{ text: 'Edit', editable: false, sortable: false, filterable: false, datafield: 'Edit', width: '15%', align: 'center', columntype: 'button', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset = $("#gridgarasi").offset();
						var dataRecord = $("#gridgarasi").jqxGrid('getrowdata', editrow);
						$("#addnmgarasi").val(dataRecord.namagd);
						$("#addkodegarasi").val(dataRecord.kodegd);
						$("#addidgarasi").val(dataRecord.dot);
						$("#modaladdgarasi").modal('show');
					}
				},
				{ text: 'Hapus', columntype: 'button', editable: false, sortable: false, filterable: false, width: '15%', cellsrenderer: function () {
					return "Hapus";
					}, buttonclick: function (row) {    
					editrow = row;  
					var offset      = $("#gridgarasi").offset();        
					var dataRecord  = $("#gridgarasi").jqxGrid('getrowdata', editrow);
					var token   	=   document.getElementById('token').value;
					var val01		= 'hapusgarasi';
					var val02		= '';
					var val03		= '';
					var val04		= '';
					var val05		= '';
					var val06		= '';
					var val07		= '';
					var val08		= dataRecord.dot;
					var val09		= '';
					var val10		= '';
					var val11		= '';
					var val12		= '';
					var val13		= '';
					swal({
							title: 'Perhatian?',
							text: "Mohon pastikan data ruangan di Gedung ini telah kosong. Bila masih terdapat data ruangan maka Gedung ini tidak bisa di hapus.!!",
							type: 'warning',
							showCancelButton: true,
							confirmButtonClass: 'btn btn-confirm mt-2',
							cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
							confirmButtonText: 'Delete'
						}).then(function () {
							$.post('umum/exkendaraan', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, _token: token },
								function(data){
									var status  = data.status;
									var message = data.message;									
									swal({
										title: status,
										text: message,
										type: 'success',
										timer: 2000
									}).then(
										function () {
										},
										function (dismiss) {
											if (dismiss === 'timer') {
												
											}
										}
									)
									$("html, body").animate({ scrollTop: 0 }, "slow");
									$("#gridgarasi").jqxGrid('updatebounddata');
									return false;
							});
						});
					}
				},
			]
		});
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'dot'},
				{ name: 'merek', type: 'text'},
				{ name: 'garasi', type: 'text'},
				{ name: 'kodegarasi', type: 'text'},
				{ name: 'kodekendaraan', type: 'text'},
				{ name: 'driver', type: 'text'},
				{ name: 'marking', type: 'text'},
				{ name: 'nopol', type: 'text'},	
				{ name: 'kapasitas', type: 'text'},
				{ name: 'kondisi', type: 'text'},
				{ name: 'utilitas', type: 'text'},
				{ name: 'pjgedung', type: 'text'},
				{ name: 'pejabat', type: 'text'},
				{ name: 'pinjam', type: 'text'},
				{ name: 'statpinjam', type: 'text'},
				{ name: 'tarif', type: 'text'},
				{ name: 'fakpanjang', type: 'text'},	
				{ name: 'fakultas', type: 'text'},
				{ name: 'inputor', type: 'text'},
				{ name: 'foto', type: 'text'},
			],
			url: 'umum/allkendaraan',
			cache: false
		};		
		var dataAdapter = new $.jqx.dataAdapter(source);
		var photoruang = function (row, column, value) {
			var name = $('#gridkkendaraan').jqxGrid('getrowdata', row).foto;
			if (name != ''){
				var img = '<div style="background: white;"><img style="margin:2px; margin-left: 10px;" width="50" height="50" src="images/kendaraan/' + name + '"></div>';
				
			} else {
				var img = '<div style="background: white;"></div>';
			}			
			return img;
		}
		$("#gridkkendaraan").jqxGrid({
			width: '100%',
			pageable: true,
			filterable: true,
			showfilterrow: true,
			autoheight: true,
			altrows: true,
			rowsheight: 50,
			columnsresize: true,
			source: dataAdapter,
			theme: "energyblue",
			columns: [
				{ text: 'Foto', editable: false, sortable: false, filterable: false, width: '10%', cellsrenderer: photoruang },
				{ text: 'Tambah', editable: false, sortable: false, filterable: false, width: '10%', align: 'center', columntype: 'button', cellsrenderer: function () {
					return "Aktifitas";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset = $("#gridkkendaraan").offset();
						var dataRecord = $("#gridkkendaraan").jqxGrid('getrowdata', editrow);
						$("#aktif_nama").val(dataRecord.merek);
						$("#aktif_garasi").val(dataRecord.garasi);
						$("#aktif_nopol").val(dataRecord.nopol);
						$("#aktif_jenis").val('');
						$("#aktif_nominal").val('');
						$("#aktif_driver").val(dataRecord.driver);
						$("#aktif_idne").val('new');
						$("#aktif_idkendaraan").val(dataRecord.dot);
						CKEDITOR.instances['aktif_keterangan'].setData('')
						$("#modaladdaktifitas").modal('show');
					}
				},
				{ text: 'Nama Kendaraan', datafield: 'merek', width: 120, cellsalign: 'left', align: 'center'  },
				{ text: 'Nama Garasi', filtertype: 'checkedlist', datafield: 'garasi', width: 150, cellsalign: 'left', align: 'center'  },
				{ text: 'Kode Kendaraan', datafield: 'kodekendaraan', width: 100, align: 'center',  cellsalign: 'left'},
				{ text: 'Petugas', datafield: 'driver', width: 120, cellsalign: 'left', align: 'center' },
				{ text: 'NOPOL', datafield: 'nopol', width: 70, align: 'center',  cellsalign: 'left'  },
				{ text: 'Kondisi', datafield: 'kondisi', width: 70, align: 'center',  cellsalign: 'left'  },
				{ text: 'Kapasitas', datafield: 'kapasitas', width: 70, align: 'center',  cellsalign: 'left'  },
				{ text: 'Pinjam di ajukan kepada', datafield: 'pejabat', width: '25%', cellsalign: 'left', align: 'center' },
				{ text: 'Status', filtertype: 'checkedlist', datafield: 'statpinjam', width: '15%', align: 'center',  cellsalign: 'left'  },
				{ text: 'Tarif Perhari', cellsformat: 'n', datafield: 'tarif', width: '10%', align: 'center',  cellsalign: 'right'  },
				{ text: 'Utilitas(Jam/Minggu)', datafield: 'utilitas', width: 70, align: 'center',  cellsalign: 'left'  },
				{ text: 'Edit', editable: false, sortable: false, filterable: false, datafield: 'Edit', width: 50, align: 'center', columntype: 'button', cellsrenderer: function () {
					return "Edit";
					}, buttonclick: function (row) {
						editrow = row;	
						var offset = $("#gridkkendaraan").offset();
						var dataRecord = $("#gridkkendaraan").jqxGrid('getrowdata', editrow);
						$("#namarg2").val(dataRecord.merek);
						$("#namagd2").val(dataRecord.garasi);
						$("#koderg2").val(dataRecord.kodekendaraan);
						$("#petugas2").val(dataRecord.driver);
						$("#luas2").val(dataRecord.nopol);
						$("#kapasitas2").val(dataRecord.kapasitas);
						$("#status2").val(dataRecord.marking);
						$("#id_kondisi2").val(dataRecord.kondisi);
						$("#id_utilitas2").val(dataRecord.utilitas);
						$("#idnya2").val(dataRecord.dot);
						$("#modaladdkendaraan").modal('show');
					}
				},
				{ text: 'Hapus', columntype: 'button', editable: false, sortable: false, filterable: false, width: '7%', cellsrenderer: function () {
					return "Hapus";
					}, buttonclick: function (row) {    
					editrow = row;  
					var offset      = $("#gridkkendaraan").offset();        
					var dataRecord  = $("#gridkkendaraan").jqxGrid('getrowdata', editrow);
					var token   	=   document.getElementById('token').value;
					var val01		= 'hapus';
					var val02		= '';
					var val03		= '';
					var val04		= '';
					var val05		= '';
					var val06		= '';
					var val07		= '';
					var val08		= dataRecord.dot;
					var val09		= '';
					var val10		= '';
					var val11		= '';
					var val12		= '';
					var val13		= '';
					swal({
							title: 'Perhatian?',
							text: "Perintah ini tidak bisa di UNDO, apakah anda masih mau menghapus.?",
							type: 'warning',
							showCancelButton: true,
							confirmButtonClass: 'btn btn-confirm mt-2',
							cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
							confirmButtonText: 'Delete'
						}).then(function () {
							$.post('umum/exkendaraan', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, _token: token },
								function(data){
									var status  = data.status;
									var message = data.message;									
									swal({
										title: status,
										text: message,
										type: 'success',
										timer: 2000
									}).then(
										function () {
										},
										function (dismiss) {
											if (dismiss === 'timer') {
												
											}
										}
									)
									$("html, body").animate({ scrollTop: 0 }, "slow");
									$("#gridkkendaraan").jqxGrid('updatebounddata');
									return false;
							});
						});
					}
				},
			]
		});
		$("#btnnewgarasi").click(function(){
			$("#modaladdgarasi").modal('show');
			$("#addidgarasi").val('new');
		});	
		$("#btnnewkendaraan").click(function(){
			$("#modaladdkendaraan").modal('show');
			$("#idnya2").val('new');
		});
		$("#btnnewgedung").click(function(){
			$("#modaladdgedung").modal('show');
			$("#addidgedung").val('new');
			$("#addfotogedung").val('');
			$('#previewgedung').attr('src', 'dist/img/takadagambar.png');
		});	
		$("#btnnewruang").click(function(){
			$("#modaladdruang").modal('show');
			$("#idnya").val('new');
			$("#id_tarif").val('0');
			$("#id_fotoruang").val('');
			$('#previewruang').attr('src', 'dist/img/takadagambar.png');
		});
		$("#btntambahfasilitas").click(function(){
			$("#modaladdfasilitas").modal('show');
			$("#fas_idne").val('new');
		});
		$("#btnaddfasilitas").click(function(){
			var val01	= document.getElementById('fas_idne').value;
			var val02	= document.getElementById('fas_jenis').value;
			var val03	= document.getElementById('fas_jumlah').value;
			var val04	= document.getElementById('fas_kondisi').value;
			var val05	= document.getElementById('fas_merk').value;
			var val06	= document.getElementById('fas_namabrg').value;
			var val07	= document.getElementById('fas_idruang').value;
			var val08	= document.getElementById('fas_sumber').value;
			var val09	= document.getElementById('fas_tahun').value;
			var val10	= document.getElementById('fas_ruang').value;
			var val11	= document.getElementById('fas_kodefasruang').value;
			var token 	= document.getElementById('token').value;
			$.post('umum/exfasruang', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, _token : token },
			function(data){
				var status  = data.status;
				var message = data.message;
				$.toast({
					heading: status,
					text: message,
					position: 'top-right',
					loaderBg: '#bf441d',
					icon: 'info',
					hideAfter: 5000,
					stack: 1
				});
				$("#modaladdfasilitas").modal('hide');
				$("#griddir").jqxGrid('updatebounddata');
				$("#divview").jqxGrid('updatebounddata');
				return false;
			});				
		});
		$("#btntambah").click(function(){
			var val01	= document.getElementById('namarg').value;
			var val02	= document.getElementById('koderg').value;
			var val03	= document.getElementById('luas').value;
			var val04	= document.getElementById('kapasitas').value;
			var val05	= document.getElementById('namagd').value;
			var val06	= document.getElementById('petugas').value;
			var val07	= document.getElementById('status').value;
			var val08	= document.getElementById('idnya').value;
			var val09	= document.getElementById('id_kondisi').value;
			var val10	= document.getElementById('id_utilitas').value;
			var val11	= document.getElementById('id_pjruang').value;
			var val12	= document.getElementById('id_statussewa').value;
			var val13	= document.getElementById('id_tarif').value;
			var val14	= document.getElementById('id_fotoruang');
			var form_data = new FormData();
				form_data.append('file', val14.files[0]);
				form_data.append('set01', val01);
				form_data.append('set02', val02);
				form_data.append('set03', val03);
				form_data.append('set04', val04);
				form_data.append('set05', val05);
				form_data.append('set06', val06);
				form_data.append('set07', val07);
				form_data.append('set08', val08);
				form_data.append('set09', val09);
				form_data.append('set10', val10);
				form_data.append('set11', val11);
				form_data.append('set12', val12);
				form_data.append('set13', val13);
				form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url: 'umum/exruang',
				data: form_data,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					var status  = data.status;
					var message = data.message;
					$.toast({
						heading: status,
						text: message,
						position: 'top-right',
						loaderBg: '#bf441d',
						icon: 'info',
						hideAfter: 5000,
						stack: 1
					});
					$("#modaladdruang").modal('hide');
					window.setTimeout('location.reload()', 3000);				
					return false;
				},
				error: function (xhr, status, error) {
					swal({
						title: 'Stop',
						text: xhr.responseText,
						type: 'warning',
					})
				}
			});			
		});
		$("#btnaddgedung").click(function(){
			var val01	= 'gedung';
			var val02	= document.getElementById('addnmgedung').value;
			var val03	= document.getElementById('addkodegedung').value;
			var val04	= document.getElementById('addidgedung').value;
			var val05	= document.getElementById('addpjgedung').value;
			var val06	= document.getElementById('addstatusgedung').value;
			var val07	= document.getElementById('addtarifgedung').value;
			var val08	= '';
			var val09	= '';
			var val10	= '';
			var val11	= '';
			var val12	= '';
			var val13	= '';
			var val14	= document.getElementById('addfotogedung');
			var form_data = new FormData();
				form_data.append('file', val14.files[0]);
				form_data.append('set01', val01);
				form_data.append('set02', val02);
				form_data.append('set03', val03);
				form_data.append('set04', val04);
				form_data.append('set05', val05);
				form_data.append('set06', val06);
				form_data.append('set07', val07);
				form_data.append('set08', val08);
				form_data.append('set09', val09);
				form_data.append('set10', val10);
				form_data.append('set11', val11);
				form_data.append('set12', val12);
				form_data.append('set13', val13);
				form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url: 'umum/exruang',
				data: form_data,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					var status  = data.status;
					var message = data.message;
					$.toast({
						heading: status,
						text: message,
						position: 'top-right',
						loaderBg: '#bf441d',
						icon: 'info',
						hideAfter: 5000,
						stack: 1
					});
					$("#modaladdgedung").modal('hide');
					window.setTimeout('location.reload()', 3000);
					return false;
				},
				error: function (xhr, status, error) {
					swal({
						title: 'Stop',
						text: xhr.responseText,
						type: 'warning',
					})
				}
			});
		});
		$("#btndelete").click(function(){
			var val01	= 'hapus';
			var val02	= '';
			var val03	= '';
			var val04	= '';
			var val05	= '';
			var val06	= '';
			var val07	= '';
			var val08	= document.getElementById('delidnya').value;
			var val09	= '';
			var val10	= '';
			var val11	= '';
			var val12	= '';
			var val13	= '';
			var token 	= document.getElementById('token').value;
			$.post('umum/exruang', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, _token: token },
			function(data){
				var status  = data.status;
				var message = data.message;
				$.toast({
					heading: status,
					text: message,
					position: 'top-right',
					loaderBg: '#bf441d',
					icon: 'info',
					hideAfter: 5000,
					stack: 1
				});
				$("#modalhapus").modal('hide');
				$("#gridk1").jqxGrid('updatebounddata');
				return false;
			});
		});	
		$("#btntambahkendaraan").click(function(){
			var val01	= document.getElementById('namarg2').value;
			var val02	= document.getElementById('koderg2').value;
			var val03	= document.getElementById('luas2').value;
			var val04	= document.getElementById('kapasitas2').value;
			var val05	= document.getElementById('namagd2').value;
			var val06	= document.getElementById('petugas2').value;
			var val07	= document.getElementById('status2').value;
			var val08	= document.getElementById('idnya2').value;
			var val09	= document.getElementById('id_kondisi2').value;
			var val10	= document.getElementById('id_utilitas2').value;
			var val11	= document.getElementById('id_pjruang2').value;
			var val12	= document.getElementById('id_statussewa2').value;
			var val13	= document.getElementById('id_tarif2').value;
			var val14	= document.getElementById('id_fotoruang2');
			var form_data = new FormData();
				form_data.append('file', val14.files[0]);
				form_data.append('set01', val01);
				form_data.append('set02', val02);
				form_data.append('set03', val03);
				form_data.append('set04', val04);
				form_data.append('set05', val05);
				form_data.append('set06', val06);
				form_data.append('set07', val07);
				form_data.append('set08', val08);
				form_data.append('set09', val09);
				form_data.append('set10', val10);
				form_data.append('set11', val11);
				form_data.append('set12', val12);
				form_data.append('set13', val13);
				form_data.append('_token', '{{csrf_token()}}');
			$.ajax({
				url: 'umum/exkendaraan',
				data: form_data,
				type: 'POST',
				contentType: false,
				processData: false,
				success: function (data) {
					var status  = data.status;
					var message = data.message;
					$.toast({
						heading: status,
						text: message,
						position: 'top-right',
						loaderBg: '#bf441d',
						icon: 'info',
						hideAfter: 5000,
						stack: 1
					});
					$("#modaladdkendaraan").modal('hide');
					window.setTimeout('location.reload()', 3000);				
					return false;
				},
				error: function (xhr, status, error) {
					swal({
						title: 'Stop',
						text: xhr.responseText,
						type: 'warning',
					})
				}
			});
		});
		$("#btnaddgarasi").click(function(){
			var val01	= 'gedung';
			var val02	= document.getElementById('addnmgedung').value;
			var val03	= document.getElementById('addkodegedung').value;
			var val04	= '';
			var val05	= '';
			var val06	= '';
			var val07	= '';
			var val08	= document.getElementById('addidgedung').value;
			var val09	= '';
			var val10	= '';
			var val11	= '';
			var val12	= '';
			var val13	= '';
			var token 	= document.getElementById('token').value;
			$.post('umum/exkendaraan', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, _token: token },
			function(data){
				var status  = data.status;
				var message = data.message;
				$.toast({
					heading: status,
					text: message,
					position: 'top-right',
					loaderBg: '#bf441d',
					icon: 'info',
					hideAfter: 5000,
					stack: 1
				});
				$("#modaladdgarasi").modal('hide');
				window.setTimeout('window.location=window.location', 3000);
				return false;
			});
		});
		$("#btnsimpanaktifitas").click(function(){
			var val01	= 'aktifitaskendaraan';
			var val02	= document.getElementById('aktif_nama').value;
			var val03	= document.getElementById('aktif_garasi').value;
			var val04	= document.getElementById('aktif_nopol').value;
			var val05	= document.getElementById('aktif_jenis').value;
			var val06	= document.getElementById('aktif_nominal').value;
			var val07	= document.getElementById('aktif_driver').value;
			var val08	= CKEDITOR.instances['aktif_keterangan'].getData();
			var val09	= document.getElementById('aktif_idkendaraan').value;
			var val10	= document.getElementById('aktif_idne').value;
			var val11	= document.getElementById('aktif_tanggal').value;
			var val12	= '';
			var val13	= '';
			var token 	= document.getElementById('token').value;
			$.post('umum/exkendaraan', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, _token: token },
			function(data){
				var status  = data.status;
				var message = data.message;
				$.toast({
					heading: status,
					text: message,
					position: 'top-right',
					loaderBg: '#bf441d',
					icon: 'info',
					hideAfter: 5000,
					stack: 1
				});
				$("#modaladdaktifitas").modal('hide');
				return false;
			});
		});
		$('#topbtnviewbbm').click(function () {
			var set01='BBM';
			var set02='INI';
			var set03='INI';
			var token=document.getElementById('token').value;
			var source = {
				datatype: "json",
				datafields: [
					{ name: 'idne'},
					{ name: 'idkendaraan', type: 'text'},
					{ name: 'merek', type: 'text'},
					{ name: 'garasi', type: 'text'},
					{ name: 'driver', type: 'text'},
					{ name: 'nopol', type: 'text'},
					{ name: 'jenis', type: 'text'},
					{ name: 'tanggal', type: 'text'},
					{ name: 'nominal', type: 'text'},
					{ name: 'keterangan', type: 'text'},
					{ name: 'inputor', type: 'text'}
				],
				type: 'POST',
				data: {val01: set01, val02: set02, val03: set03, _token: token},
				url: 'umum/getaktifitaskendaraan',
			};
			$('#divlaporan').show();
			$('#divutama').hide();
			var dataAdapter = new $.jqx.dataAdapter(source);
			$("#gridlaporan").jqxGrid({
				width: '100%',
				pageable: true,
				autoheight: true,
				filterable: true,
				source: dataAdapter,
				columnsresize: true,
				showfilterrow: true,
				theme: "energyblue",
				columns: [
					{ text: 'EDIT', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
						return "EDIT";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#gridlaporan").offset();
							var dataRecord 	= $("#gridlaporan").jqxGrid('getrowdata', editrow);
							$("#aktif_nama").val(dataRecord.merek);
							$("#aktif_garasi").val(dataRecord.garasi);
							$("#aktif_nopol").val(dataRecord.nopol);
							$("#aktif_jenis").val(dataRecord.jenis);
							$("#aktif_nominal").val(dataRecord.nominal);
							$("#aktif_driver").val(dataRecord.driver);
							$("#aktif_idne").val(dataRecord.idne);
							$("#aktif_idkendaraan").val(dataRecord.idkendaraan);
							CKEDITOR.instances['aktif_keterangan'].setData(dataRecord.keterangan)
							$("#modaladdaktifitas").modal('show');
						}
					},
					{ text: 'Kendaraan', datafield: 'merek', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Nama Garasi', filtertype: 'checkedlist', datafield: 'garasi', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Petugas', datafield: 'driver', width: '15%', cellsalign: 'left', align: 'center' },
					{ text: 'NOPOL', datafield: 'nopol', width: '15%', align: 'center',  cellsalign: 'left'  },
					{ text: 'Jenis', filtertype: 'checkedlist', datafield: 'jenis', width: '10%', align: 'center',  cellsalign: 'left'  },
					{ text: 'Tanggal', datafield: 'tanggal', width: '15%', align: 'center',  cellsalign: 'left'  },
					{ text: 'Nominal', cellsformat: 'n', datafield: 'nominal', width: '12%', align: 'center',  cellsalign: 'right'  },
					{ text: 'Keterangan', datafield: 'keterangan', width: '25%', cellsalign: 'left', align: 'center' },
					{ text: 'Hapus', columntype: 'button', editable: false, sortable: false, filterable: false, width: '8%', cellsrenderer: function () {
						return "Hapus";
						}, buttonclick: function (row) {    
						editrow = row;  
						var offset      = $("#gridlaporan").offset();        
						var dataRecord  = $("#gridlaporan").jqxGrid('getrowdata', editrow);
						var token   	= document.getElementById('token').value;
						var val01		= 'hapusaktifitas';
						var val02		= '';
						var val03		= '';
						var val04		= '';
						var val05		= '';
						var val06		= '';
						var val07		= '';
						var val08		= dataRecord.idne;
						var val09		= '';
						var val10		= '';
						var val11		= '';
						var val12		= '';
						var val13		= '';
						swal({
								title: 'Perhatian?',
								text: "Perintah ini tidak bisa di UNDO, apakah anda masih mau menghapus.?",
								type: 'warning',
								showCancelButton: true,
								confirmButtonClass: 'btn btn-confirm mt-2',
								cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
								confirmButtonText: 'Delete'
							}).then(function () {
								$.post('umum/exkendaraan', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, _token: token },
									function(data){
										var status  = data.status;
										var message = data.message;									
										swal({
											title: status,
											text: message,
											type: 'success',
											timer: 2000
										}).then(
											function () {
											},
											function (dismiss) {
												if (dismiss === 'timer') {
													
												}
											}
										)
										$("html, body").animate({ scrollTop: 0 }, "slow");
										$("#gridlaporan").jqxGrid('updatebounddata');
										return false;
								});
							});
						}
					},
				]
			});
		});
		$('#topbtnviewservice').click(function () {
			var set01='SERVICE';
			var set02='INI';
			var set03='INI';
			var token=document.getElementById('token').value;
			var source = {
				datatype: "json",
				datafields: [
					{ name: 'idne'},
					{ name: 'idkendaraan', type: 'text'},
					{ name: 'merek', type: 'text'},
					{ name: 'garasi', type: 'text'},
					{ name: 'driver', type: 'text'},
					{ name: 'nopol', type: 'text'},
					{ name: 'jenis', type: 'text'},
					{ name: 'tanggal', type: 'text'},
					{ name: 'nominal', type: 'text'},
					{ name: 'keterangan', type: 'text'},
					{ name: 'inputor', type: 'text'}
				],
				type: 'POST',
				data: {val01: set01, val02: set02, val03: set03, _token: token},
				url: 'umum/getaktifitaskendaraan',
			};
			$('#divlaporan').show();
			$('#divutama').hide();
			
			var dataAdapter = new $.jqx.dataAdapter(source);
			$("#gridlaporan").jqxGrid({
				width: '100%',
				pageable: true,
				autoheight: true,
				filterable: true,
				source: dataAdapter,
				columnsresize: true,
				showfilterrow: true,
				theme: "energyblue",
				columns: [
					{ text: 'EDIT', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
						return "EDIT";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#gridlaporan").offset();
							var dataRecord 	= $("#gridlaporan").jqxGrid('getrowdata', editrow);
							$("#aktif_nama").val(dataRecord.merek);
							$("#aktif_garasi").val(dataRecord.garasi);
							$("#aktif_nopol").val(dataRecord.nopol);
							$("#aktif_jenis").val(dataRecord.jenis);
							$("#aktif_nominal").val(dataRecord.nominal);
							$("#aktif_driver").val(dataRecord.driver);
							$("#aktif_idne").val(dataRecord.idne);
							$("#aktif_idkendaraan").val(dataRecord.idkendaraan);
							CKEDITOR.instances['aktif_keterangan'].setData(dataRecord.keterangan)
							$("#modaladdaktifitas").modal('show');
						}
					},
					{ text: 'Kendaraan', datafield: 'merek', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Nama Garasi', filtertype: 'checkedlist', datafield: 'garasi', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Petugas', datafield: 'driver', width: '15%', cellsalign: 'left', align: 'center' },
					{ text: 'NOPOL', datafield: 'nopol', width: '15%', align: 'center',  cellsalign: 'left'  },
					{ text: 'Jenis', filtertype: 'checkedlist', datafield: 'jenis', width: '10%', align: 'center',  cellsalign: 'left'  },
					{ text: 'Tanggal', datafield: 'tanggal', width: '15%', align: 'center',  cellsalign: 'left'  },
					{ text: 'Nominal', cellsformat: 'n', datafield: 'nominal', width: '12%', align: 'center',  cellsalign: 'right'  },
					{ text: 'Keterangan', datafield: 'keterangan', width: '25%', cellsalign: 'left', align: 'center' },
					{ text: 'Hapus', columntype: 'button', editable: false, sortable: false, filterable: false, width: '8%', cellsrenderer: function () {
						return "Hapus";
						}, buttonclick: function (row) {    
						editrow = row;  
						var offset      = $("#gridlaporan").offset();        
						var dataRecord  = $("#gridlaporan").jqxGrid('getrowdata', editrow);
						var token   	= document.getElementById('token').value;
						var val01		= 'hapusaktifitas';
						var val02		= '';
						var val03		= '';
						var val04		= '';
						var val05		= '';
						var val06		= '';
						var val07		= '';
						var val08		= dataRecord.idne;
						var val09		= '';
						var val10		= '';
						var val11		= '';
						var val12		= '';
						var val13		= '';
						swal({
								title: 'Perhatian?',
								text: "Perintah ini tidak bisa di UNDO, apakah anda masih mau menghapus.?",
								type: 'warning',
								showCancelButton: true,
								confirmButtonClass: 'btn btn-confirm mt-2',
								cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
								confirmButtonText: 'Delete'
							}).then(function () {
								$.post('umum/exkendaraan', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, _token: token },
									function(data){
										var status  = data.status;
										var message = data.message;									
										swal({
											title: status,
											text: message,
											type: 'success',
											timer: 2000
										}).then(
											function () {
											},
											function (dismiss) {
												if (dismiss === 'timer') {
													
												}
											}
										)
										$("html, body").animate({ scrollTop: 0 }, "slow");
										$("#gridlaporan").jqxGrid('updatebounddata');
										return false;
								});
							});
						}
					},
				]
			});
		});
		$('#topbtnviewtol').click(function () {
			var set01='TOL';
			var set02='INI';
			var set03='INI';
			var token=document.getElementById('token').value;
			var source = {
				datatype: "json",
				datafields: [
					{ name: 'idne'},
					{ name: 'idkendaraan', type: 'text'},
					{ name: 'merek', type: 'text'},
					{ name: 'garasi', type: 'text'},
					{ name: 'driver', type: 'text'},
					{ name: 'nopol', type: 'text'},
					{ name: 'jenis', type: 'text'},
					{ name: 'tanggal', type: 'text'},
					{ name: 'nominal', type: 'text'},
					{ name: 'keterangan', type: 'text'},
					{ name: 'inputor', type: 'text'}
				],
				type: 'POST',
				data: {val01: set01, val02: set02, val03: set03, _token: token},
				url: 'umum/getaktifitaskendaraan',
			};
			$('#divlaporan').show();
			$('#divutama').hide();
			
			var dataAdapter = new $.jqx.dataAdapter(source);
			$("#gridlaporan").jqxGrid({
				width: '100%',
				pageable: true,
				autoheight: true,
				filterable: true,
				source: dataAdapter,
				columnsresize: true,
				showfilterrow: true,
				theme: "energyblue",
				columns: [
					{ text: 'EDIT', editable: false, sortable: false, filterable: false, columntype: 'button', width: '7%', align: 'center', cellsrenderer: function () {
						return "EDIT";
						}, buttonclick: function (row) {
							editrow = row;	
							var offset 		= $("#gridlaporan").offset();
							var dataRecord 	= $("#gridlaporan").jqxGrid('getrowdata', editrow);
							$("#aktif_nama").val(dataRecord.merek);
							$("#aktif_garasi").val(dataRecord.garasi);
							$("#aktif_nopol").val(dataRecord.nopol);
							$("#aktif_jenis").val(dataRecord.jenis);
							$("#aktif_nominal").val(dataRecord.nominal);
							$("#aktif_driver").val(dataRecord.driver);
							$("#aktif_idne").val(dataRecord.idne);
							$("#aktif_idkendaraan").val(dataRecord.idkendaraan);
							CKEDITOR.instances['aktif_keterangan'].setData(dataRecord.keterangan)
							$("#modaladdaktifitas").modal('show');
						}
					},
					{ text: 'Kendaraan', datafield: 'merek', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Nama Garasi', filtertype: 'checkedlist', datafield: 'garasi', width: '15%', cellsalign: 'left', align: 'center'  },
					{ text: 'Petugas', datafield: 'driver', width: '15%', cellsalign: 'left', align: 'center' },
					{ text: 'NOPOL', datafield: 'nopol', width: '15%', align: 'center',  cellsalign: 'left'  },
					{ text: 'Jenis', filtertype: 'checkedlist', datafield: 'jenis', width: '10%', align: 'center',  cellsalign: 'left'  },
					{ text: 'Tanggal', datafield: 'tanggal', width: '15%', align: 'center',  cellsalign: 'left'  },
					{ text: 'Nominal', cellsformat: 'n', datafield: 'nominal', width: '12%', align: 'center',  cellsalign: 'right'  },
					{ text: 'Keterangan', datafield: 'keterangan', width: '25%', cellsalign: 'left', align: 'center' },
					{ text: 'Hapus', columntype: 'button', editable: false, sortable: false, filterable: false, width: '8%', cellsrenderer: function () {
						return "Hapus";
						}, buttonclick: function (row) {    
						editrow = row;  
						var offset      = $("#gridlaporan").offset();        
						var dataRecord  = $("#gridlaporan").jqxGrid('getrowdata', editrow);
						var token   	= document.getElementById('token').value;
						var val01		= 'hapusaktifitas';
						var val02		= '';
						var val03		= '';
						var val04		= '';
						var val05		= '';
						var val06		= '';
						var val07		= '';
						var val08		= dataRecord.idne;
						var val09		= '';
						var val10		= '';
						var val11		= '';
						var val12		= '';
						var val13		= '';
						swal({
								title: 'Perhatian?',
								text: "Perintah ini tidak bisa di UNDO, apakah anda masih mau menghapus.?",
								type: 'warning',
								showCancelButton: true,
								confirmButtonClass: 'btn btn-confirm mt-2',
								cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
								confirmButtonText: 'Delete'
							}).then(function () {
								$.post('umum/exkendaraan', { set01: val01, set02: val02, set03: val03, set04: val04, set05: val05, set06: val06, set07: val07, set08: val08, set09: val09, set10: val10, set11: val11, set12: val12, set13: val13, _token: token },
									function(data){
										var status  = data.status;
										var message = data.message;									
										swal({
											title: status,
											text: message,
											type: 'success',
											timer: 2000
										}).then(
											function () {
											},
											function (dismiss) {
												if (dismiss === 'timer') {
													
												}
											}
										)
										$("html, body").animate({ scrollTop: 0 }, "slow");
										$("#gridlaporan").jqxGrid('updatebounddata');
										return false;
								});
							});
						}
					},
				]
			});
		});
	});
</script>
@endpush