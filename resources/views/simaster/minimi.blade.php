@extends('adminlte3.layout')
@section('content')
<div class="wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Perpustakaan</h1>
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
                <div class="col-md-12">
                    <div id="message"></div>
                    <div class="card card-danger shadow" id="divawal">
                        <div class="card-header">
                            <h3 class="card-title">All List</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
								<div class="col-lg-12">
									<a href='#' id="btnshowall" class="btn btn-app bg-red">
										<span class="badge bg-yellow">{{$totalbuku}}</span>
										<i class="fa fa-book"></i> Total Buku
									</a>
									<a href='#' id="btnpeminjaman" class="btn btn-app bg-green">
										{!! $totalbukudipinjam !!}
										<i class="fa fa-binoculars"></i> Buku di Pinjam
									</a>
									<a href='#' id="btnbukurusak" class="btn btn-app bg-blue">
										{!! $totalbukurusak !!}
										<i class="fa fa-recycle"></i> Buku Rusak
									</a>
									<a href='#' id="btnbukuhilang" class="btn btn-app bg-orange">
										{!! $totalbukuhilang !!}
										<i class="fa fa-trash"></i> Buku Hilang/Musnah
									</a>
									<a href='#' id="btntambahbuku" class="btn btn-app bg-purple">
										<i class="fa fa-tags"></i> Tambah Buku
									</a>
								</div>
							</div>
                        </div>
                        <div class="card-footer">
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-valign-middle" id="tabelperpustakaan">
                                    <thead>
                                        <tr>
                                            <th>List Buku</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary shadow" id="divlaporan">
                        <div class="card-header">
                            <h3 class="card-title">Report</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="btnexport"><i class="fa fa-print"></i></button>
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group" id="divcontrolpeminjaman">
								<div class="row">
									<div class="col-lg-6">
										<label for="lap_bulanan">Laporan Bulan</label>
										<select id="lap_bulanan" name="lap_bulanan" class="form-control" >
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
											<option value="ALL">ALL</option>
										</select>
									</div>
									<div class="col-lg-6">
										<div class="input-group margin">
											<input type="text" class="form-control" id="lap_tahunan" value="{{ $tahunne }}">
											<span class="input-group-btn">
											<button class="btn btn-warning btn-flat" type="button" id="btnviewdata">View</button>
											</span>				
										</div><!-- /input-group -->
									</div>
								</div>
							</div>
                        </div>
                        <div class="card-footer">
                        <div id="gridlaporan"></div>
                        </div>
                    </div>
                    <div class="card card-warning shadow" id="divpeminjaman">
                        <div class="card-header">
                            <h3 class="card-title">Form Peminjaman</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btnkembali"><i class="fa fa-close"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
								<div class="col-lg-4">
									<img id="previewbuku" style="margin:2px; margin-left: 10px;" width="100%" src="logo.png">
								</div>
								<div class="col-lg-8">
									<div class="form-group">
										<label for="pinjam_judul">Judul Buku</label>
										<input type="text" id="pinjam_judul" name="pinjam_judul" class="form-control"  disabled="disable">
									</div>
									<div class="form-group">
										<label for="pinjam_pengarang">Pengarang</label>
										<input type="text" id="pinjam_pengarang" name="pinjam_pengarang" class="form-control" disabled="disable">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6">
												<label for="pinjam_kode">Kode Buku</label>
												<input type="text" id="pinjam_kode" name="pinjam_kode" class="form-control" disabled="disable">
											</div>
											<div class="col-lg-6">
												<label for="pinjam_rak">Rak Buku</label>
												<input type="text" id="pinjam_rak" name="pinjam_rak" class="form-control" disabled="disable">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="pinjam_peminjam">Peminjam</label>
										<select id="pinjam_peminjam" name="pinjam_peminjam" class="form-control select2" >
											<option value="">Pilih salah satu</option>
											@foreach($datasiswa as $rsiswa)
												<option value="{{ $rsiswa['noinduk'] }}">{{ $rsiswa['nama'] }} ( {{ $rsiswa['klspos'] }} No. Induk {{ $rsiswa['noinduk'] }} )</option>
											@endforeach			  
										</select>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6">
												<label for="pinjam_tglpinjam">Tgl. Pinjam</label>
                                                <input type="text" class="form-control tanggal" id="pinjam_tglpinjam" name="pinjam_tglpinjam" value="{{$tanggal}}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
											</div>
											<div class="col-lg-6">
												<label for="pinjam_tglkembali">Tgl. Kembali</label>
                                                <input type="text" class="form-control tanggal" id="pinjam_tglkembali" name="pinjam_tglkembali" value="{{$kembali}}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-3">
												<label for="pinjam_hari">Selama (Hari)</label>
												<select id="pinjam_hari" name="pinjam_hari" class="form-control" >
													<option value="1">1 Hari</option>
													<option value="2">2 Hari</option>
													<option value="3">3 Hari</option>
													<option value="4">4 Hari</option>
													<option value="5">5 Hari</option>
													<option value="6">6 Hari</option>
													<option value="7">7 Hari</option>
													<option value="8">8 Hari</option>
													<option value="9">9 Hari</option>
													<option value="10">10 Hari</option>
												</select>
											</div>
											<div class="col-lg-3">
												<label for="pinjam_tarif">Tarif Sewa</label>
												<input type="text" id="pinjam_tarif" name="pinjam_tarif" class="form-control" value="0">	
											</div>
											<div class="col-lg-3">
												<label for="pinjam_denda">Tarif Denda</label>
												<input type="text" id="pinjam_denda" name="pinjam_denda" class="form-control" value="0">	
											</div>
											<div class="col-lg-3">
												<label for="pinjam_status">Status</label>
												<select id="pinjam_status" name="pinjam_status" class="form-control" >
													<option value="1">Aktif</option>
													<option value="0">Telah di Kembalikan</option>
													<option value="2">Hilang/Tidak di Kembalikan</option>
												</select>
											</div>
										</div>
									</div>
									
								</div>
							</div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="#" class="btn btn-block btn-social btn-google btnkembali">
                                            <i class="fa fa-reply-all"></i>Cancel
                                        </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="hidden" id="pinjam_idne">
                                        <input type="hidden" id="pinjam_idbuku">
                                        <a href="#" class="btn btn-block btn-social btn-twitter" id="btnsimpanajuan">
                                            <i class="fa fa-book"></i>Simpan
                                        </a>
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
<div class="modal fade" id="modaltambahbuku">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Buku</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id_judul">Judul Buku *)</label>
                    <input type="text" class="form-control" id="id_judul">
                </div>
                <div class="form-group">
                    <label for="id_pengarang">Pengarang *)</label>
                    <input type="text" class="form-control" id="id_pengarang">
                </div>
                <div class="form-group">
                    <label for="id_penerbit">Penerbit *)</label>
                    <input type="text" class="form-control" id="id_penerbit">
                </div>
                <div class="form-group">
                    <div class="row">			  
                    <div class="col-lg-3">
                        <label for="id_cetakan">Cetakan</label>
                        <select id="id_cetakan" class="form-control" >	
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                            <option value="VI">VI</option>
                            <option value="VII">VII</option>
                            <option value="VIII">VIII</option>
                            <option value="IX">IX</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                            <option value="XIII">XIII</option>
                        </select>
                    </div>			  
                    <div class="col-lg-3">
                        <label for="id_kota">Kota *)</label>
                        <input type="text" class="form-control" id="id_kota">
                    </div>
                    <div class="col-lg-3">
                        <label for="id_tahun">Tahun Terbit *)</label>
                        <input type="text" class="form-control" id="id_tahun" value="{{$tahunne}}">
                    </div>
                    <div class="col-lg-3">
                        <label for="id_ilustrasi">Ilus</label>
                        <input type="text" class="form-control" id="id_ilustrasi" placeholder="14.5 X 21">
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                    <div class="col-lg-4">
                        <label for="id_kodebuku">Kode Buku *)</label>
                        <input type="text" class="form-control" id="id_kodebuku">
                    </div>
                    <div class="col-lg-4">
                        <label for="id_rakbuku">Rak Buku *)</label>
                        <input type="text" class="form-control" id="id_rakbuku">
                    </div>
                    <div class="col-lg-4">
                        <label for="id_kategori">Kategori *)</label>
                        <select id="id_kategori" class="form-control" >	
                            <option value="E-Book">E-Book</option>
                            <option value="Novel">Novel</option>
                            <option value="Cergam">Cergam</option>
                            <option value="Komik">Komik</option>
                            <option value="Ensiklopedi">Ensiklopedi</option>
                            <option value="Nomik">Nomik</option>
                            <option value="Antologi">Antologi</option>
                            <option value="Dongeng">Dongeng</option>
                            <option value="Biografi">Biografi</option>
                            <option value="Jurnal">Jurnal</option>
                            <option value="Novelet">Novelet</option>
                            <option value="Fotografi">Fotografi</option>
                            <option value="Karya ilmiah">Karya ilmiah</option>
                            <option value="Tafsir">Tafsir</option>
                            <option value="Kamus">Kamus</option>
                            <option value="Panduan">Panduan</option>
                            <option value="Atlas">Atlas</option>
                            <option value="Teks">Teks</option>
                            <option value="Mewarnai">Mewarnai</option>
                            <option value="FIKSI">FIKSI</option>
                            <option value="NON FIKSI">NON FIKSI</option>
                        </select>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">			  
                    <div class="col-lg-4">
                        <label for="id_tglmasuk">Tgl. Masuk Perpus *)</label>
                        <input value="{{date('Y-m-d')}}" type="text" class="form-control tanggal" id="id_tglmasuk" name="id_tglmasuk" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                    </div>			 
                    <div class="col-lg-4">
                        <label for="id_halaman">Halaman</label>
                        <input type="text" class="form-control" id="id_halaman">
                    </div>			 
                    <div class="col-lg-4">
                        <label for="id_isbn">ISBN *)</label>
                        <input type="text" class="form-control" id="id_isbn">
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">			  
                    <div class="col-lg-6">
                        <label for="id_jenis">Jenis Perolehan *)</label>
                        <select id="id_jenis" class="form-control" >	
                            <option value="TEMPAT">TEMPAT</option>
                            <option value="BELI">BELI</option>
                            <option value="HADIAH">HADIAH</option>
                            <option value="BANTUAN">BANTUAN</option>
                        </select>
                    </div>			 
                    <div class="col-lg-6">
                        <label for="id_kondisi">Kondisi *)</label>
                        <select id="id_kondisi" class="form-control" >	
                            <option value="BAIK">BAIK</option>
                            <option value="RUSAK">RUSAK</option>
                            <option value="HILANG">HILANG</option>
                            <option value="MUSNAH">MUSNAH</option>
                        </select>
                    </div>			 
                </div>
                <div class="form-group">
                    <label for="id_link">URL / Link Download</label>
                    <input type="text" class="form-control" id="id_link">
                </div>
                <div class="form-group">
                    <label for="id_cover">File Cover</label>
                    <input type="file" id="id_cover">
                    <p class="help-block">File diperbolehkan hanya JPG / JPEG / PNG</p>
                </div>
                <div class="form-group">
                    <img id="preview" src="dist/img/takadagambar.png" width="150px" height="150px"/>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" class="form-control" id="id_idne">
                <button type="button" class="btn btn-success pull-right" id="btnsimpanbuku">SIMPAN</button>
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>	
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
		$('.tanggal').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
	});
	$('#id_cover').change(function () {
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
                $('#preview').attr('src', e.target.result);
            };
        }
    }
    function btncetaklabel(id){
        var url 	    = "{{URL::to("/")}}/labelbuku/"+id;
        var windowName 	= 'Label Buku ID '+id;
        var windowSize 	= "width=800,height=800";
        window.open(url, windowName, windowSize);
        event.preventDefault();
        return false;
    }
    function btnaddpeminjaman(id){
        var valid		= id;
        $.post('json/jsonbukucari', { val01: 'perid', val02: valid, _token: '{{ csrf_token() }}' },function(data){
            var valfoto		= data.gambar;
            var valjudul	= data.judul;
            var valpengarang= data.pengarang;
            var valkodebuku	= data.kodebuku;
            var valrakbuku	= data.rakbuku;
            $('#previewbuku').attr('src', valfoto);
            $("#pinjam_judul").val(valjudul);
            $("#pinjam_pengarang").val(valpengarang);
            $("#pinjam_kode").val(valkodebuku);
            $("#pinjam_rak").val(valrakbuku);
            $("#pinjam_idbuku").val(valid);
            $("#pinjam_idne").val('new');
            $('#divlaporan').hide();
            $('#divpeminjaman').show();
            $('#divawal').hide();
        });
        
    }
    $(document).ready(function () {
        $('#divlaporan').hide();
        $('#divpeminjaman').hide();
        $('#divcontrolpeminjaman').hide();
        $('.btnkembali').click(function () {
            $('#divcontrolpeminjaman').hide();
            $('#divlaporan').hide();
            $('#divpeminjaman').hide();
            $('#divawal').show();
        });
        $("#btntambahbuku").click(function(){
            $("#modaltambahbuku").modal('show');
            $("#id_idne").val('new');
            $("#id_cover").val('');
            $('#preview').attr('src', 'dist/img/takadagambar.png');
        });
        $("#btnsimpanbuku").click(function(){
            var val01	= document.getElementById('id_judul').value;
            var val02	= document.getElementById('id_pengarang').value;
            var val03	= document.getElementById('id_penerbit').value;
            var val04	= document.getElementById('id_cetakan').value;
            var val05	= document.getElementById('id_kota').value;
            var val06	= document.getElementById('id_tahun').value;
            var val07	= document.getElementById('id_ilustrasi').value;
            var val08	= document.getElementById('id_kodebuku').value;
            var val09	= document.getElementById('id_rakbuku').value;
            var val10	= document.getElementById('id_kategori').value;
            var val11	= document.getElementById('id_tglmasuk').value;
            var val12	= document.getElementById('id_halaman').value;
            var val13	= document.getElementById('id_isbn').value;
            var val14	= document.getElementById('id_jenis').value;
            var val15	= document.getElementById('id_kondisi').value;
            var val16	= document.getElementById('id_link').value;
            var val17	= document.getElementById('id_idne').value;
            var val18	= document.getElementById('id_cover');
            var form_data = new FormData();
                form_data.append('file', val18.files[0]);
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
                form_data.append('set14', val14);
                form_data.append('set15', val15);
                form_data.append('set16', val16);
                form_data.append('set17', val17);
                form_data.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: 'admin/exsavebuku',
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
                        loaderBg: data.warna,
                        icon: data.icon,
                        hideAfter: 5000,
                        stack: 1
                    });
                    $("#modaltambahbuku").modal('hide');
                    if (val17 == 'new'){
                        window.setTimeout('location.reload()', 3000);
                    } else {
                        $("#gridlaporan").jqxGrid("updatebounddata","filter");
                    }
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
        $('.select2').select2({
            width: '100%'
        });
        $("#pinjam_hari").on('change', function () {
            var set01	= document.getElementById('pinjam_tglpinjam').value;
            var set02	= '+'+document.getElementById('pinjam_hari').value;
            var tglan 	= moment(set01).add(set02, 'days');
            var newtgl	= moment(tglan).format('YYYY-MM-DD');
            $("#pinjam_tglkembali").val(newtgl);
        });
        $("#pinjam_tarif").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#pinjam_denda").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $('#btnsimpanajuan').click(function () {
            var set01=document.getElementById('pinjam_idne').value;
            var set02=document.getElementById('pinjam_idbuku').value;
            var set03=document.getElementById('pinjam_judul').value;
            var set04=document.getElementById('pinjam_pengarang').value;
            var set05=document.getElementById('pinjam_kode').value;
            var set06=document.getElementById('pinjam_rak').value;
            var set07=document.getElementById('pinjam_peminjam').value;
            var set08=document.getElementById('pinjam_tglpinjam').value;
            var set09=document.getElementById('pinjam_tglkembali').value;
            var set10=document.getElementById('pinjam_hari').value;
            var set11=document.getElementById('pinjam_tarif').value;
            var set12=document.getElementById('pinjam_status').value;
            var set13=document.getElementById('pinjam_denda').value;
            var token=document.getElementById('token').value;
            $.post('admin/expeminjaman', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, val08: set08, val09: set09, val10: set10, val11:set11, val12: set12, val13: set13, _token: token },
            function(data){
                var status  = data.status;
                var message = data.message;
                $.toast({
                    heading: status,
                    text: message,
                    position: 'top-right',
                    loaderBg: data.warna,
                    icon: data.icon,
                    hideAfter: 5000,
                    stack: 1
                });
                $('#divcontrolpeminjaman').hide();
                $('#divlaporan').hide();
                $('#divpeminjaman').hide();
                $('#divawal').show();
                return false;
            });
        });
        $('#btnexport').click(function () {
            var gridContent = $("#gridlaporan").jqxGrid('exportdata', 'json');
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
        $('#btnshowall').click(function () {
            var set01 	= 'all';
            var token 	= document.getElementById('token').value;
            var sourcedetail 	= {
                datatype: "json",
                datafields: [
                    { name: 'idne', type: 'text'},
                    { name: 'judul', type: 'text'},
                    { name: 'gambar', type: 'text'},
                    { name: 'link', type: 'text'},
                    { name: 'kodebuku', type: 'text'},
                    { name: 'pengarang', type: 'text'},
                    { name: 'cetakan', type: 'text'},
                    { name: 'kota', type: 'text'},
                    { name: 'penerbit', type: 'text'},
                    { name: 'tahun', type: 'text'},
                    { name: 'ilustrasi', type: 'text'},
                    { name: 'halaman', type: 'text'},
                    { name: 'id_sekolah', type: 'text'},
                    { name: 'jumlah', type: 'text'},
                    { name: 'isbn', type: 'text'},
                    { name: 'tglmasuk', type: 'text'},
                    { name: 'tahunperolehan', type: 'text'},
                    { name: 'jenisperolehan', type: 'text'},
                    { name: 'rakbuku', type: 'text'},
                    { name: 'kondisi', type: 'text'},
                    { name: 'kategori', type: 'text'},
                    { name: 'inputor', type: 'text'},
                ],
                type: 'POST',
                data: {	val01:set01, _token: token },
                url: 'json/jsonbukucari',
            };
            $('#divlaporan').show();
            $('#divpeminjaman').hide();
            $('#divawal').hide();
            var datadetail = new $.jqx.dataAdapter(sourcedetail);
            $("#gridlaporan").jqxGrid({
                width           : '100%',
                pageable        : true,
                autoheight      : true,
                rowsheight      : 35,
                filterable      : true,
                filtermode      : 'excel',
                source          : datadetail,
                theme           : "energyblue",
                selectionmode   : 'singlecell',
                columns         : [
                    { text: 'EDIT', editable: false, sortable: false, filterable: false, width: '4%', align: 'center', columntype: 'button', cellsrenderer: function () {
                        return "EDIT";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset = $("#gridlaporan").offset();
                            var dataRecord = $("#gridlaporan").jqxGrid('getrowdata', editrow);
                            $("#id_judul").val(dataRecord.judul);
                            $("#id_pengarang").val(dataRecord.pengarang);
                            $("#id_penerbit").val(dataRecord.penerbit);
                            $("#id_cetakan").val(dataRecord.cetakan);
                            $("#id_kota").val(dataRecord.kota);
                            $("#id_tahun").val(dataRecord.tahun);
                            $("#id_ilustrasi").val(dataRecord.ilustrasi);
                            $("#id_kodebuku").val(dataRecord.kodebuku);
                            $("#id_rakbuku").val(dataRecord.rakbuku);
                            $("#id_kategori").val(dataRecord.kategori);
                            $("#id_tglmasuk").val(dataRecord.tglmasuk);
                            $("#id_halaman").val(dataRecord.halaman);
                            $("#id_isbn").val(dataRecord.isbn);
                            $("#id_jenis").val(dataRecord.jenisperolehan);
                            $("#id_kondisi").val(dataRecord.kondisi);
                            $("#id_link").val(dataRecord.link);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_cover").val('');
                            $('#preview').attr('src', 'dist/img/takadagambar.png');
                            $("#modaltambahbuku").modal('show');
                        }
                    },
                    { text: 'Cover', datafield: 'gambar', editable: false, width: '4%', cellsalign: 'center', align: 'center' },
                    { text: 'Kode', datafield: 'kodebuku', editable: false, width: '6%', cellsalign: 'center', align: 'center' },
                    { text: 'Judul', datafield: 'judul', editable: false, width: '18%', cellsalign: 'left', align: 'center' },
                    { text: 'Pengarang', datafield: 'pengarang', editable: false, width: '14%', cellsalign: 'left', align: 'center' },
                    { text: 'CET', datafield: 'cetakan', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Kota', datafield: 'kota', width: '7%', cellsalign: 'center', align: 'center'},
                    { text: 'Penerbit', datafield: 'penerbit', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Tahun', datafield: 'tahun', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Ilus', datafield: 'ilustrasi', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Hal', datafield: 'halaman', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'ISBN', datafield: 'isbn', width: '8%', cellsalign: 'left', align: 'center'},
                    { text: 'Tgl. Masuk', datafield: 'tglmasuk', width: '7%', cellsalign: 'center', align: 'center'},
                    { text: 'Tahun Perolehan', datafield: 'tahunperolehan', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Jenis Perolehan', datafield: 'jenisperolehan', width: '7%', cellsalign: 'center', align: 'center'},
                    { text: 'Rak Buku', datafield: 'rakbuku', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Kondisi', datafield: 'kondisi', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Kategori', datafield: 'kategori', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Download link', datafield: 'link', width: '10%', cellsalign: 'center', align: 'center'},
                ]
            });
        });
        $('#btnbukurusak').click(function () {
            var set01 	= 'rusak';
            var token 	= document.getElementById('token').value;
            var sourcedetail 	= {
                datatype: "json",
                datafields: [
                    { name: 'idne', type: 'text'},
                    { name: 'judul', type: 'text'},
                    { name: 'gambar', type: 'text'},
                    { name: 'link', type: 'text'},
                    { name: 'kodebuku', type: 'text'},
                    { name: 'pengarang', type: 'text'},
                    { name: 'cetakan', type: 'text'},
                    { name: 'kota', type: 'text'},
                    { name: 'penerbit', type: 'text'},
                    { name: 'tahun', type: 'text'},
                    { name: 'ilustrasi', type: 'text'},
                    { name: 'halaman', type: 'text'},
                    { name: 'id_sekolah', type: 'text'},
                    { name: 'jumlah', type: 'text'},
                    { name: 'isbn', type: 'text'},
                    { name: 'tglmasuk', type: 'text'},
                    { name: 'tahunperolehan', type: 'text'},
                    { name: 'jenisperolehan', type: 'text'},
                    { name: 'rakbuku', type: 'text'},
                    { name: 'kondisi', type: 'text'},
                    { name: 'kategori', type: 'text'},
                    { name: 'inputor', type: 'text'},
                ],
                type: 'POST',
                data: {	val01:set01, _token: token },
                url: 'json/jsonbukucari',
            };
            $('#divlaporan').show();
            $('#divpeminjaman').hide();
            $('#divawal').hide();
            var datadetail = new $.jqx.dataAdapter(sourcedetail);
            $("#gridlaporan").jqxGrid({
                width: '100%',
                pageable: true,
                rowsheight: 35,
                filterable: true,
                filtermode: 'excel',
                source: datadetail,
                theme: "energyblue",
                selectionmode: 'singlecell',
                columns: [
                    { text: 'EDIT', editable: false, sortable: false, filterable: false, width: '4%', align: 'center', columntype: 'button', cellsrenderer: function () {
                        return "EDIT";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset = $("#gridlaporan").offset();
                            var dataRecord = $("#gridlaporan").jqxGrid('getrowdata', editrow);
                            $("#id_judul").val(dataRecord.judul);
                            $("#id_pengarang").val(dataRecord.pengarang);
                            $("#id_penerbit").val(dataRecord.penerbit);
                            $("#id_cetakan").val(dataRecord.cetakan);
                            $("#id_kota").val(dataRecord.kota);
                            $("#id_tahun").val(dataRecord.tahun);
                            $("#id_ilustrasi").val(dataRecord.ilustrasi);
                            $("#id_kodebuku").val(dataRecord.kodebuku);
                            $("#id_rakbuku").val(dataRecord.rakbuku);
                            $("#id_kategori").val(dataRecord.kategori);
                            $("#id_tglmasuk").val(dataRecord.tglmasuk);
                            $("#id_halaman").val(dataRecord.halaman);
                            $("#id_isbn").val(dataRecord.isbn);
                            $("#id_jenis").val(dataRecord.jenisperolehan);
                            $("#id_kondisi").val(dataRecord.kondisi);
                            $("#id_link").val(dataRecord.link);
                            $("#id_idne").val(dataRecord.idne);
                            
                            $("#id_cover").val('');
                            $('#preview').attr('src', 'dist/img/takadagambar.png');
                            $("#modaltambahbuku").modal('show');
                        }
                    },
                    { text: 'Cover', datafield: 'gambar', editable: false, width: '4%', cellsalign: 'center', align: 'center' },
                    { text: 'Kode', datafield: 'kodebuku', editable: false, width: '6%', cellsalign: 'center', align: 'center' },
                    { text: 'Judul', datafield: 'judul', editable: false, width: '18%', cellsalign: 'left', align: 'center' },
                    { text: 'Pengarang', datafield: 'pengarang', editable: false, width: '14%', cellsalign: 'left', align: 'center' },
                    { text: 'CET', datafield: 'cetakan', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Kota', datafield: 'kota', width: '7%', cellsalign: 'center', align: 'center'},
                    { text: 'Penerbit', datafield: 'penerbit', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Tahun', datafield: 'tahun', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Ilus', datafield: 'ilustrasi', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Hal', datafield: 'halaman', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'ISBN', datafield: 'isbn', width: '8%', cellsalign: 'left', align: 'center'},
                    { text: 'Tgl. Masuk', datafield: 'tglmasuk', width: '7%', cellsalign: 'center', align: 'center'},
                    { text: 'Tahun Perolehan', datafield: 'tahunperolehan', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Jenis Perolehan', datafield: 'jenisperolehan', width: '7%', cellsalign: 'center', align: 'center'},
                    { text: 'Rak Buku', datafield: 'rakbuku', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Kondisi', datafield: 'kondisi', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Kategori', datafield: 'kategori', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Download link', datafield: 'link', width: '10%', cellsalign: 'center', align: 'center'},
                ]
            });
        });
        $('#btnbukuhilang').click(function () {
            var set01 	= 'hilang';
            var token 	= document.getElementById('token').value;
            var sourcedetail 	= {
                datatype: "json",
                datafields: [
                    { name: 'idne', type: 'text'},
                    { name: 'judul', type: 'text'},
                    { name: 'gambar', type: 'text'},
                    { name: 'link', type: 'text'},
                    { name: 'kodebuku', type: 'text'},
                    { name: 'pengarang', type: 'text'},
                    { name: 'cetakan', type: 'text'},
                    { name: 'kota', type: 'text'},
                    { name: 'penerbit', type: 'text'},
                    { name: 'tahun', type: 'text'},
                    { name: 'ilustrasi', type: 'text'},
                    { name: 'halaman', type: 'text'},
                    { name: 'id_sekolah', type: 'text'},
                    { name: 'jumlah', type: 'text'},
                    { name: 'isbn', type: 'text'},
                    { name: 'tglmasuk', type: 'text'},
                    { name: 'tahunperolehan', type: 'text'},
                    { name: 'jenisperolehan', type: 'text'},
                    { name: 'rakbuku', type: 'text'},
                    { name: 'kondisi', type: 'text'},
                    { name: 'kategori', type: 'text'},
                    { name: 'inputor', type: 'text'},
                ],
                type: 'POST',
                data: {	val01:set01, _token: token },
                url: 'json/jsonbukucari',
            };
            $('#divlaporan').show();
            $('#divpeminjaman').hide();
            $('#divawal').hide();
            var datadetail = new $.jqx.dataAdapter(sourcedetail);
            $("#gridlaporan").jqxGrid({
                width: '100%',
                pageable: true,
                rowsheight: 35,
                filterable: true,
                filtermode: 'excel',
                source: datadetail,
                theme: "energyblue",
                selectionmode: 'singlecell',
                columns: [
                    { text: 'EDIT', editable: false, sortable: false, filterable: false, width: '4%', align: 'center', columntype: 'button', cellsrenderer: function () {
                        return "EDIT";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset = $("#gridlaporan").offset();
                            var dataRecord = $("#gridlaporan").jqxGrid('getrowdata', editrow);
                            $("#id_judul").val(dataRecord.judul);
                            $("#id_pengarang").val(dataRecord.pengarang);
                            $("#id_penerbit").val(dataRecord.penerbit);
                            $("#id_cetakan").val(dataRecord.cetakan);
                            $("#id_kota").val(dataRecord.kota);
                            $("#id_tahun").val(dataRecord.tahun);
                            $("#id_ilustrasi").val(dataRecord.ilustrasi);
                            $("#id_kodebuku").val(dataRecord.kodebuku);
                            $("#id_rakbuku").val(dataRecord.rakbuku);
                            $("#id_kategori").val(dataRecord.kategori);
                            $("#id_tglmasuk").val(dataRecord.tglmasuk);
                            $("#id_halaman").val(dataRecord.halaman);
                            $("#id_isbn").val(dataRecord.isbn);
                            $("#id_jenis").val(dataRecord.jenisperolehan);
                            $("#id_kondisi").val(dataRecord.kondisi);
                            $("#id_link").val(dataRecord.link);
                            $("#id_idne").val(dataRecord.idne);
                            $("#id_cover").val('');
                            $('#preview').attr('src', 'dist/img/takadagambar.png');
                            $("#modaltambahbuku").modal('show');
                        }
                    },
                    { text: 'Cover', datafield: 'gambar', editable: false, width: '4%', cellsalign: 'center', align: 'center' },
                    { text: 'Kode', datafield: 'kodebuku', editable: false, width: '6%', cellsalign: 'center', align: 'center' },
                    { text: 'Judul', datafield: 'judul', editable: false, width: '18%', cellsalign: 'left', align: 'center' },
                    { text: 'Pengarang', datafield: 'pengarang', editable: false, width: '14%', cellsalign: 'left', align: 'center' },
                    { text: 'CET', datafield: 'cetakan', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Kota', datafield: 'kota', width: '7%', cellsalign: 'center', align: 'center'},
                    { text: 'Penerbit', datafield: 'penerbit', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Tahun', datafield: 'tahun', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Ilus', datafield: 'ilustrasi', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Hal', datafield: 'halaman', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'ISBN', datafield: 'isbn', width: '8%', cellsalign: 'left', align: 'center'},
                    { text: 'Tgl. Masuk', datafield: 'tglmasuk', width: '7%', cellsalign: 'center', align: 'center'},
                    { text: 'Tahun Perolehan', datafield: 'tahunperolehan', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Jenis Perolehan', datafield: 'jenisperolehan', width: '7%', cellsalign: 'center', align: 'center'},
                    { text: 'Rak Buku', datafield: 'rakbuku', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Kondisi', datafield: 'kondisi', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Kategori', datafield: 'kategori', width: '5%', cellsalign: 'center', align: 'center'},
                    { text: 'Download link', datafield: 'link', width: '10%', cellsalign: 'center', align: 'center'},
                ]
            });
        });
        $('#btnpeminjaman').click(function () {
            var set01 	= 'aktif';
            var set02 	= 'pinjam';
            var token 	= document.getElementById('token').value;
            var sourcedetail 	= {
                datatype: "json",
                datafields: [
                    { name: 'idne', type: 'text'},
                    { name: 'foto', type: 'text'},
                    { name: 'gambar', type: 'text'},
                    { name: 'judul', type: 'text'},
                    { name: 'link', type: 'text'},
                    { name: 'kodebuku', type: 'text'},
                    { name: 'idbuku', type: 'text'},
                    { name: 'pengarang', type: 'text'},
                    { name: 'kota', type: 'text'},
                    { name: 'penerbit', type: 'text'},
                    { name: 'id_sekolah', type: 'text'},
                    { name: 'isbn', type: 'text'},
                    { name: 'tglpinjam', type: 'text'},
                    { name: 'tglkembali', type: 'text'},
                    { name: 'rakbuku', type: 'text'},
                    { name: 'hari', type: 'text'},
                    { name: 'biaya', type: 'text'},
                    { name: 'denda', type: 'text'},
                    { name: 'peminjam', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'status', type: 'text'},
                    { name: 'inputor', type: 'text'},
                    { name: 'tlsstatus', type: 'text'},
                ],
                type: 'POST',
                data: {	val01:set01, val02: '', _token: token },
                url: 'json/jsonpeminjamanbuku',
            };
            $('#divlaporan').show();
            $('#divcontrolpeminjaman').show();
            $('#divpeminjaman').hide();
            $('#divawal').hide();
            var datadetail = new $.jqx.dataAdapter(sourcedetail);
            $("#gridlaporan").jqxGrid({
                width           : '100%',
                pageable        : true,
                rowsheight      : 35,
                filterable      : true,
                filtermode      : 'excel',
                source          : datadetail,
                theme           : "energyblue",
                selectionmode   : 'singlecell',
                columns         : [
                    { text: 'Pengembalian', editable: false, sortable: false, filterable: false, width: '5%', align: 'center', columntype: 'button', cellsrenderer: function () {
                        return "Pengembalian";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset = $("#gridlaporan").offset();
                            var dataRecord = $("#gridlaporan").jqxGrid('getrowdata', editrow);
                            $('#preview').attr('src', dataRecord.gambar);
                            $("#pinjam_judul").val(dataRecord.judul);
                            $("#pinjam_pengarang").val(dataRecord.pengarang);
                            $("#pinjam_kode").val(dataRecord.kodebuku);
                            $("#pinjam_rak").val(dataRecord.rakbuku);
                            $("#pinjam_idbuku").val(dataRecord.idbuku);
                            $("#pinjam_idne").val(dataRecord.idne);
                            $("#pinjam_peminjam").val(dataRecord.noinduk).select2().trigger('change');
                            $("#pinjam_tglpinjam").val(dataRecord.tglpinjam);
                            $("#pinjam_tglkembali").val(dataRecord.tglkembali);
                            $("#pinjam_hari").val(dataRecord.hari);
                            $("#pinjam_tarif").val(dataRecord.biaya);
                            $("#pinjam_status").val(dataRecord.status);
                            $("#pinjam_denda").val(dataRecord.denda);
                            $('#divlaporan').hide();
                            $('#divpeminjaman').show();
                            $('#divawal').hide();
                        }
                    },
                    { text: 'STATUS', datafield: 'tlsstatus', editable: false, width: '8%', cellsalign: 'center', align: 'center' },
                    { text: 'Foto', datafield: 'foto', editable: false, width: '8%', cellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'peminjam', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'No.Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Tgl. Pinjam', datafield: 'tglpinjam', width: '12%', cellsalign: 'center', align: 'center'},
                    { text: 'Tgl. Kembali', datafield: 'tglkembali', width: '12%', cellsalign: 'center', align: 'center'},
                    { text: 'Cover', datafield: 'gambar', editable: false, width: '4%', cellsalign: 'center', align: 'center' },
                    { text: 'Kode', datafield: 'kodebuku', editable: false, width: '6%', cellsalign: 'center', align: 'center' },
                    { text: 'Judul', datafield: 'judul', editable: false, width: '18%', cellsalign: 'left', align: 'center' },
                    { text: 'Pengarang', datafield: 'pengarang', editable: false, width: '14%', cellsalign: 'left', align: 'center' },
                    { text: 'Penerbit', datafield: 'penerbit', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'ISBN', datafield: 'isbn', width: '8%', cellsalign: 'left', align: 'center'},
                    { text: 'Biaya', datafield: 'biaya', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Denda', datafield: 'denda', width: '10%', cellsalign: 'center', align: 'center'},
                ]
            });
        });
        $('#btnviewdata').click(function () {
            var set01 	= document.getElementById('lap_bulanan').value;
            var set02 	= document.getElementById('lap_tahunan').value;
            var token 	= document.getElementById('token').value;
            var sourcedetail 	= {
                datatype: "json",
                datafields: [
                    { name: 'idne', type: 'text'},
                    { name: 'foto', type: 'text'},
                    { name: 'gambar', type: 'text'},
                    { name: 'judul', type: 'text'},
                    { name: 'link', type: 'text'},
                    { name: 'kodebuku', type: 'text'},
                    { name: 'pengarang', type: 'text'},
                    { name: 'kota', type: 'text'},
                    { name: 'penerbit', type: 'text'},
                    { name: 'id_sekolah', type: 'text'},
                    { name: 'isbn', type: 'text'},
                    { name: 'tglpinjam', type: 'text'},
                    { name: 'tglkembali', type: 'text'},
                    { name: 'rakbuku', type: 'text'},
                    { name: 'biaya', type: 'text'},
                    { name: 'denda', type: 'text'},
                    { name: 'peminjam', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'status', type: 'text'},
                    { name: 'inputor', type: 'text'},
                    { name: 'tlsstatus', type: 'text'},
                ],
                type: 'POST',
                data: {	val01:set01, val02: '', val03: '', _token: token },
                url: 'json/jsonpeminjamanbuku',
            };
            $('#divlaporan').show();	
            $('#divcontrolpeminjaman').show();
            $('#divpeminjaman').hide();
            $('#divawal').hide();
            var datadetail = new $.jqx.dataAdapter(sourcedetail);
            $("#gridlaporan").jqxGrid({
                width: '100%',
                pageable: true,
                rowsheight: 35,
                filterable: true,
                filtermode: 'excel',
                source: datadetail,
                theme: "energyblue",
                selectionmode: 'singlecell',
                columns: [
                    { text: 'STATUS', datafield: 'tlsstatus', editable: false, width: '8%', cellsalign: 'center', align: 'center' },
                    { text: 'Foto', datafield: 'foto', editable: false, width: '8%', cellsalign: 'center', align: 'center' },
                    { text: 'Nama', datafield: 'peminjam', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'No.Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Tgl. Pinjam', datafield: 'tglpinjam', width: '12%', cellsalign: 'center', align: 'center'},
                    { text: 'Tgl. Kembali', datafield: 'tglkembali', width: '12%', cellsalign: 'center', align: 'center'},
                    { text: 'Cover', datafield: 'gambar', editable: false, width: '4%', cellsalign: 'center', align: 'center' },
                    { text: 'Kode', datafield: 'kodebuku', editable: false, width: '6%', cellsalign: 'center', align: 'center' },
                    { text: 'Judul', datafield: 'judul', editable: false, width: '18%', cellsalign: 'left', align: 'center' },
                    { text: 'Pengarang', datafield: 'pengarang', editable: false, width: '14%', cellsalign: 'left', align: 'center' },
                    { text: 'ISBN', datafield: 'isbn', width: '8%', cellsalign: 'left', align: 'center'},
                    { text: 'Biaya', datafield: 'biaya', width: '10%', cellsalign: 'center', align: 'center'},
                    { text: 'Denda', datafield: 'denda', width: '10%', cellsalign: 'center', align: 'center'},
                ]
            });
        });
        $('#tabelperpustakaan').DataTable({
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonBuku") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						search          : data.search.value,
						_token			: '{{ csrf_token() }}'
					},
					type: "POST",
					success: function(res) {
						callback({
							recordsTotal    : res.total,
							recordsFiltered : res.total,
							data            : res.data
						});
					},
				})
			},
			searching	: true,
            autoWidth	: false,
            serverSide  : true,
			columnDefs	: [
                {
					targets				: 0,
					responsivePriority	: 4,
					render		: function (data, type, full, meta) {
                        stateNum    = Math.floor(Math.random() * 6);
                        states 		= ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
						state 		= states[stateNum];
                        var jenis   = full['kategori'];
                        var id      = full['id'];
                        if (jenis == 'E-Book'){
                            var tombol = '<a href="'+full['link']+'" class="btn btn-'+state+'"><i class="fa fa-download"></i> DOWNLOAD</a>';
                        } else {
                            var tombol = '<a href="#" class="btn btn-'+state+'" onClick="btnaddpeminjaman('+id+')"><i class="fa fa-book"></i>Peminjaman</a>';
                        }
                        if (stateNum == '5'){
                            var stateNum = 0;
                        } else {
                            var stateNum = stateNum + 1;
                        }
                        state 		= states[stateNum];
                        var tombolcetak = '<a href="#" class="btn btn-'+state+'" onClick="btncetaklabel('+id+')"><i class="fa fa-print"></i> Cetak Label</a>';
                        var tombollist  = '<div class="btn-group-vertical">'+tombolcetak+tombol+'</div>';
                        var rawData = '<div class="list-group-item">'+
                                        '<div class="row">'+
                                            '<div class="col-auto bg-'+state+'">'+
                                                '<img class="img-fluid" src="'+full['gambar']+'" alt="Photo" style="max-height: 160px;">'+
                                            '</div>'+
                                            '<div class="col px-4">'+
                                                '<div>'+
                                                    '<div class="float-right">'+full['created_at']+'</div>'+
                                                    '<h3>'+full['judul']+'</h3>'+
                                                    '<div class="row"><div class="col-lg-8"><p class="mb-0">Pengarang : '+full['pengarang']+'</p>'+
                                                    '<p class="mb-0">Penerbit : '+full['penerbit']+'</p>'+
                                                    '<p class="mb-0">ISBN : '+full['isbn']+'</p>'+
                                                    '<p class="mb-0">Kode Buku : '+full['kodebuku']+'</p>'+
                                                    '<p class="mb-0">Rak Buku : '+full['rakbuku']+'</p></div><div class="col-lg-4">'+tombollist+'</div></div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
						return rawData;
					}
				},
                
			],
            order       : [[ 0, "desc" ]],
      		dom			: 	'<"row d-flex justify-content-between align-items-center m-1"' +
        						'<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-end text-lg-start text-lg-end text-start "B>>' +
       							'<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>t' +
        					'<"d-flex justify-content-between mx-2 row"' +
        						'<"col-sm-12 col-md-6"i>' +
        						'<"col-sm-12 col-md-6"p>' +
        					'>',
            language: {
                'lengthMenu': 'Display _MENU_',
            },
      		responsive: {
				details: {
					display	: $.fn.dataTable.Responsive.display.modal({
						header: function (row) {
							var data = row.data();
							return 'Details of ' + data['matpel'];
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
			initComplete: function () {
			},
			drawCallback: function () {
			}
		});
    });
</script>
@endpush