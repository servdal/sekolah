@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-7">
                    <h1 class="m-0"> Laporan Keuangan</h1>
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
            <div id="loading">
                <img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
            </div>
            <div class="row" id="divutama">
                <div class="col-md-4">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Laporan Keuangan Sekolah</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group"> 
                                <div class="row">
                                    <div class="col-md-7">
                                        <label>Bulan</label>
                                        <select id="id_bulan" name="id_bulan" class="form-control">
                                            <option value=""></option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label>Tahun</label>
                                        <input type="number" class="form-control" id="id_tahun" >					
                                    </div>				  
                                </div>			  
                            </div>
                            <div class="form-group">
                                <label>Pilih POS</label>
                                <select id="id_pos" name="id_pos" class="form-control" >
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Tanggal Mulai</label>
                                        <input type="text" class="form-control" id="id_tglmulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tanggal Laporan</label>
                                        <input type="text" class="form-control" id="id_tgllaporan" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />					
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#" id="btncarilaporan" class="btn btn-block btn-social btn-primary">
                                <i class="fa fa-search"></i> Tampilkan
                            </a>
                        </div>
                    </div>
                    <div class="card card-warning shadow">
						<div class="card-header">
							<h3 class="card-title">Rekap Data Keuangan</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label>Range Bulan dan Tahun</label>
								<div class="row">
									<div class="col-lg-6">
										<select id="lap_bulan1" class="form-control">
											<option value=""></option>
											<option value="1">01</option>
											<option value="2">02</option>
											<option value="3">03</option>
											<option value="4">04</option>
											<option value="5">05</option>
											<option value="6">06</option>
											<option value="7">07</option>
											<option value="8">08</option>
											<option value="9">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
										</select>
									</div> 
									<div class="col-lg-6">
										<select id="lap_bulan2" class="form-control">
											<option value=""></option>
											<option value="1">01</option>
											<option value="2">02</option>
											<option value="3">03</option>
											<option value="4">04</option>
											<option value="5">05</option>
											<option value="6">06</option>
											<option value="7">07</option>
											<option value="8">08</option>
											<option value="9">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="number" id="lap_tahun" name="lap_tahun" class="form-control">		
							</div>
						</div>
						<div class="card-footer">
							<button type="button" class="btn btn-info btn-block" id="btnviewrekapbulanan">Lihat Bulanan</button>
							<button type="button" class="btn btn-warning btn-block" id="btnviewrekapharian">Lihat Harian</button>
							<button type="button" class="btn btn-danger btn-block" id="btnviewrekaplengkap">Lihat Bulanan Lengkap</button>
							<button type="button" class="btn btn-success btn-block" id="btnviewrekaplengkapjenis">Lihat Bulanan PerJenis</button>
						</div>
					</div>
                    <div class="card card-info shadow">
						<div class="card-header">
							<h3 class="card-title">Rekap Tunggakan Insidental</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<div class="row">
									<div class="col-lg-6">
										<label>Insidental</label>
										<select id="lap_insidental" name="lap_insidental" class="form-control" >
											<option value=""></option>
											<option value="dpp">DPP</option>
											@foreach($insidentalaktif as $rekstra)
												<option value="{{ $rekstra['id'] }}">{{ $rekstra['deskripsi'] }}</option>
											@endforeach
										</select>
									</div>
									<div class="col-lg-6">
										<label>Kelas</label>
										<select id="lap_inskelas" name="lap_inskelas" class="form-control" >
											<option value=""></option>
											<option value="1">Kelas 1</option>
											<option value="2">Kelas 2</option>
											<option value="3">Kelas 3</option>
											<option value="4">Kelas 4</option>
											<option value="5">Kelas 5</option>
											<option value="6">Kelas 6</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="button" class="btn btn-warning" id="btnviewrekapinsidental">Lihat</button>
						</div>
					</div>
					<div class="card card-success shadow">
						<div class="card-header">
							<h3 class="card-title">Rekap Per Kelas</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label>Range Bulan dan Tahun</label>
								<div class="row">
									<div class="col-lg-6">
										<input type="text" id="lap_tunggbln1" value="Juli" class="form-control" disabled="disable">
									</div> 
									<div class="col-lg-6">
										<select id="lap_tunggbln2" class="form-control">
											<option value="1">Agustus</option>
											<option value="2">September</option>
											<option value="3">Oktober</option>
											<option value="4">November</option>
											<option value="5">Desember</option>
											<option value="6">Januari Thn Depan</option>
											<option value="7">Februari Thn Depan</option>
											<option value="8">Maret Thn Depan</option>
											<option value="9">April Thn Depan</option>
											<option value="10">Mei Thn Depan</option>
											<option value="11">Juni Thn Depan</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-lg-6">
										<label>Pilih Kelas</label>
										<select id="lap_tunggkelas" name="lap_tunggkelas" class="form-control" >
											<option value=""></option>
											<option value="1">Kelas 1</option>
											<option value="2">Kelas 2</option>
											<option value="3">Kelas 3</option>
											<option value="4">Kelas 4</option>
											<option value="5">Kelas 5</option>
											<option value="6">Kelas 6</option>
										</select>
									</div>
									<div class="col-lg-6">
										<label>Pilih Tapel</label>
										<select id="lap_tunggtapel" name="lap_tunggtapel" class="form-control" >
											<option value="{{$tapel1}}">{{$tapel1}}</option>
											<option value="{{$tapel2}}">{{$tapel2}}</option>
											<option value="{{$tapel3}}">{{$tapel3}}</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="button" class="btn btn-danger" id="btnviewrekapperkelas">Lihat</button>
						</div>
					</div>
				</div>
				<div class="col-md-8">
                	<div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title">Report</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" title="Refresh" id="btnkembali"><i class="fa fa-close"></i></button>
                            	<button type="button" class="btn btn-tool kelompokdiv divawal" title="Eksport" id="btndownlaporan"><i class="fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-tool kelompokdiv divawal" title="Cetak" id="btncetaklaporan"><i class="fa fa-print"></i></button>
                                <button type="button" class="btn btn-tool kelompokdiv divlapbulanan" title="Eksport" id="btndownlapbulanan"><i class="fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-tool kelompokdiv divlapharian" title="Cetak" id="btnctkrekapharian"><i class="fa fa-print"></i></button>
                                <button type="button" class="btn btn-tool kelompokdiv divrincianlapharian" title="Refresh" id="btnkembalidrrincianharian"><i class="fa fa-close"></i></button>
                            	<button type="button" class="btn btn-tool kelompokdiv divrincianlapharian" title="Cetak" id="btnctkdetailharian"><i class="fa fa-print"></i></button>
                                <button type="button" class="btn btn-tool kelompokdiv divrekaplengkap" title="Eksport" id="btnctkrekaplengkap"><i class="fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-tool kelompokdiv divviewrekaplengkapjenis" title="Eksport" id="btnctkrekapperjenis"><i class="fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-tool kelompokdiv divviewrekapinsidental" title="Eksport" id="btnexportrekapinsidental"><i class="fa fa-file-excel-o"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body kelompokdiv divawal">
                            <div id="tabelnya"></div>
                        </div>
                        <div class="card-footer">
                            <div class="divlaporanbyr kelompokdiv">
								<div id="griddatabayar"></div>
							</div>
                            <div class="divlapbulanan kelompokdiv">
								<div id="gridlapbulanan"></div>
							</div>
                            <div class="divlapharian kelompokdiv">
								<div id="gridlapharian"></div>
							</div>
                            <div class="divrincianlapharian kelompokdiv">
								<div id="gridrincianlapharian"></div>
							</div>
                            <div class="divrekaplengkap kelompokdiv">
								<div id="gridrekaplengkap"></div>
							</div>
                            <div class="divviewrekaplengkapjenis kelompokdiv">
								<div id="gridviewrekaplengkapjenis"></div>
							</div>
                            <div class="divviewrekapinsidental kelompokdiv">
								<div id="gridviewrekapinsidental"></div>
							</div>
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
        $('#id_tgllaporan').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('#id_tglmulai').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
    });
    $(document).ready(function () {
        $('#loading').hide();
        $('.kelompokdiv').hide();
        var token = document.getElementById('token').value;
        $('#btncarilaporan').click(function () {
            $('#loading').show();
            $('#divutama').hide();
            $('.kelompokdiv').hide();
            $('.divawal').show();
            var set01 = document.getElementById('id_bulan').value;
            var set02 = document.getElementById('id_tahun').value;
            var set03 = document.getElementById('id_pos').value;
            var set04 = document.getElementById('id_tglmulai').value;
            var source= {
                datatype: "json",
                datafields: [
                    { name: 'no',type: 'text'},
                    { name: 'tanggal',type: 'text'},
                    { name: 'deskripsi',type: 'text'},
                    { name: 'pemasukan',type: 'text'},
                    { name: 'pengeluaran',type: 'text'},
                    { name: 'saldo',type: 'text'},
                ],
                type: 'POST',
                data: { val01:set01, val02:set02, val03:set03, val04:set04, _token: '{{ csrf_token() }}' },
                url : '{{ route("getLaporanbulanan") }}'
            };
            $('#loading').hide();
            $('#divutama').show();
            var dataAdapter = new $.jqx.dataAdapter(source);
            var editrow     = -1;
            $("#tabelnya").jqxGrid({
                width           : '100%',
                pageable        : false,
                source          : dataAdapter,
                columnsresize   : true,
                theme           : "energyblue",
                selectionmode   : 'multiplecellsextended',
                columns         : [
                    { text: 'No', datafield: 'no', width: '7%', cellsalign: 'center', align: 'center'  },
                    { text: 'TGL', datafield: 'tanggal', width: '7%', cellsalign: 'center', align: 'center'  },
                    { text: 'Uraian', datafield: 'deskripsi', width: '41%', cellsalign: 'left', align: 'center'  },
                    { text: 'Penerimaan', datafield: 'pemasukan', width: '15%', align: 'center', cellsalign: 'right'},
                    { text: 'Pengeluaran', datafield: 'pengeluaran', width: '15%', cellsalign: 'right', align: 'center' },
                    { text: 'Saldo', datafield: 'saldo', width: '15%', cellsalign: 'right', align: 'center' },							
                ]
            });
        });
        $('#btncetaklaporan').click(function () {
            $('#loading').show();
            $('#divutama').hide();
            var set01=document.getElementById('id_bulan').value;
            var set02=document.getElementById('id_tahun').value;
            var set03=document.getElementById('id_pos').value;
            var set04=document.getElementById('id_tglmulai').value;
            var set05=document.getElementById('id_tgllaporan').value;
            $.post('{{ route("exLaporanbulanan") }}', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, _token: '{{ csrf_token() }}' }, function(data){
                $('#loading').hide();
                $('#divutama').show();
                var newWindow = window.open('', '', 'width=800, height=500'),
                    document = newWindow.document.open(),
                            pageContent =
                                '<!DOCTYPE html>\n' +
                                '<html>\n' +
                                '<head>\n' +
                                '<meta charset="utf-8" />\n' +
                                '<title>Laporan Bulanan Keuangan</title>\n' +
                                '</head>\n' +
                                '<body>' + data + '</body>\n</html>';
                    document.write(pageContent);
                    document.close();
                    newWindow.print();
            });		
        });
        $("#btndownlaporan").click(function () {
            var gridContent = $("#tabelnya").jqxGrid('exportdata', 'html');
            $('#tabel_cetak').html(gridContent);		
            $("#tabel_cetak").btechco_excelexport({
                containerid: "tabel_cetak"
                , datatype: $datatype.Table
            });
        });
        $("#btnkembali").click(function () {
            $('.kelompokdiv').hide();
            $('.divawal').show();
        });
        $('#btnviewrekapbulanan').click(function () {
            var set01	= document.getElementById('lap_bulan1').value;
            var set02	= document.getElementById('lap_bulan2').value;
            var set03	= document.getElementById('lap_tahun').value;
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'nama', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'periode', type: 'text'},
                    { name: 'tspp', type: 'text'},
                    { name: 'bspp', type: 'text'},
                    { name: 'tpaguyuban', type: 'text'},
                    { name: 'bpaguyuban', type: 'text'},
                    { name: 'teks1', type: 'text'},
                    { name: 'beks1', type: 'text'},
                    { name: 'teks2', type: 'text'},
                    { name: 'beks2', type: 'text'},
                    { name: 'teks3', type: 'text'},
                    { name: 'beks3', type: 'text'},
                    { name: 'teks4', type: 'text'},
                    { name: 'beks4', type: 'text'},
                    { name: 'teks5', type: 'text'},
                    { name: 'beks5', type: 'text'},
                    { name: 'teks6', type: 'text'},
                    { name: 'beks6', type: 'text'},
                    { name: 'keterangan', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:set03, _token: '{{ csrf_token() }}'},
                url: '{{ route("jsonLapbulanan") }}'
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('.kelompokdiv').hide(); 
            $('.divlapbulanan').show(); 
            $("#gridlapbulanan").jqxGrid({
                width               : '100%',
                showfilterrow       : true,		
                filterable          : true,                
                columnsresize       : true,
                autoshowfiltericon  : true,
                pageable            : true,
                autoheight          : true,
                theme               : "energyblue",
                source              : dataAdapter,
                selectionmode       : 'multiplecellsextended',
                columns             : [
                    { text: 'No', datafield: 'id', width: 30, cellsalign: 'left', align: 'center' },
                    { text: 'KLS', datafield: 'kelas', width: 30, cellsalign: 'left', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'Periode', datafield: 'periode', width: 100, cellsalign: 'center', align: 'center' },				
                    { text: 'SPP', columngroup: 'tagihan', datafield: 'tspp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Paguyuban', columngroup: 'tagihan', datafield: 'tpaguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', columngroup: 'tagihan', datafield: 'teks1', width: 100, align: 'center' },
                    { text: 'Ekskul 2', columngroup: 'tagihan', datafield: 'teks2', width: 100, align: 'center' },
                    { text: 'Ekskul 3', columngroup: 'tagihan', datafield: 'teks3', width: 100, align: 'center' },
                    { text: 'Ekskul 4', columngroup: 'tagihan', datafield: 'teks4', width: 100, align: 'center' },
                    { text: 'Ekskul 5', columngroup: 'tagihan', datafield: 'teks5', width: 100, align: 'center' },	
                    { text: 'SPP', columngroup: 'pembayaran', datafield: 'bspp', width: 100, cellsalign: 'left', align: 'center' },
                    { text: 'Paguyuban', columngroup: 'pembayaran', datafield: 'bpaguyuban', width: 100, cellsalign: 'left', align: 'center' },	
                    { text: 'Ekskul 1', columngroup: 'pembayaran', datafield: 'beks1', width: 100, align: 'center' },
                    { text: 'Ekskul 2', columngroup: 'pembayaran', datafield: 'beks2', width: 100, align: 'center' },
                    { text: 'Ekskul 3', columngroup: 'pembayaran', datafield: 'beks3', width: 100, align: 'center' },
                    { text: 'Ekskul 4', columngroup: 'pembayaran', datafield: 'beks4', width: 100, align: 'center' },
                    { text: 'Ekskul 5', columngroup: 'pembayaran', datafield: 'beks5', width: 100, align: 'center' },	
                    { text: 'Keterangan', datafield: 'keterangan', width: 200, cellsalign: 'left', align: 'center' },
                ],
                columngroups: [
                    { text: 'Tagihan', align: 'center', name: 'tagihan' },
                    { text: 'Jumlah Bayar', align: 'center', name: 'pembayaran' }                 
                ]
            });
        });
        $("#btndownlapbulanan").click(function () {
            var gridContent = $("#gridlapbulanan").jqxGrid('exportdata', 'html');
            $('#tabel_cetak').html(gridContent);		
            $("#tabel_cetak").btechco_excelexport({
                containerid: "tabel_cetak"
                , datatype: $datatype.Table
            });
        });
        $('#btnviewrekapharian').click(function () {
            var set01	= document.getElementById('lap_bulan1').value;
            var set02	= document.getElementById('lap_bulan2').value;
            var set03	= document.getElementById('lap_tahun').value;
            var source 	= {
                datatype: "json",
                datafields: [
                    { name: 'tanggaltrans', type: 'text'},
                    { name: 'jumlahtrans', type: 'text'},
                    { name: 'verifiedtrans', type: 'text'},
                    { name: 'unverifiedtrans', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:set03, _token: '{{ csrf_token() }}'},
                url: '{{ route("jsoRekapharian") }}'
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('.kelompokdiv').hide();
            $('.divlapharian').show(); 
            $("#gridlapharian").jqxGrid({
                width               : '100%',
                showfilterrow       : true,
                filterable          : true,
                columnsresize       : true,
                autoshowfiltericon  : true,
                pageable            : true,
                autoheight          : true,
                theme               : "energyblue",
                source              : dataAdapter,
                selectionmode       : 'multiplecellsextended',
                columns             : [
                    { text: 'Tanggal Transaksi', datafield: 'tanggaltrans', width: '25%', cellsalign: 'right', align: 'center' },
                    { text: 'Jmlh.Transaksi', datafield: 'jumlahtrans', width: '15%', cellsalign: 'left', align: 'center' },
                    { text: 'Transaksi Tervalidasi', datafield: 'verifiedtrans', width: '25%', cellsalign: 'left', align: 'center' },
                    { text: 'Transaksi Belum Validasi', datafield: 'unverifiedtrans', width: '25%', cellsalign: 'center', align: 'center' },
                    { text: 'Detail', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', align: 'center', cellsrenderer: function () {
                        return "Detail";
                        }, buttonclick: function (row) {
                            editrow = row;
                            var offset 				= $("#gridlapharian").offset();
                            var dataRecord 			= $("#gridlapharian").jqxGrid('getrowdata', editrow);
                            var goook				= dataRecord.tanggaltrans;
                            var sourcerincianharian = {
                                datatype: "json",
                                datafields: [
                                    { name: 'id',type: 'text'},	
                                    { name: 'nama',type: 'text'},
                                    { name: 'noinduk',type: 'text'},
                                    { name: 'rutin',type: 'text'},
                                    { name: 'verifi',type: 'text'},
                                    { name: 'biaya',type: 'text'},
                                    { name: 'marking',type: 'text'},
                                    { name: 'tanggal',type: 'text'},
                                    { name: 'jenis',type: 'text'},
                                    ],
                                    type: 'POST',
                                    data: {	val01:goook, _token: '{{ csrf_token() }}' },
                                    url: '{{ route("jsoRincianharian") }}',
                            };
                            var datarincianharian = new $.jqx.dataAdapter(sourcerincianharian);
                            $('.kelompokdiv').hide();
                            $('.divrincianlapharian').show();
                            $("#gridrincianlapharian").jqxGrid({
                                width           : '100%',
                                source          : datarincianharian,
                                autoheight      : true,
                                filterable      : true,
                                showfilterrow   : true,
                                theme           : "orange",
                                columnsresize   : true,
                                selectionmode   : 'multiplecellsextended',
                                columns         : [
                                    { text: 'Nama', datafield: 'nama', width: '30%', align: 'center' },
                                    { text: 'No.Induk', datafield: 'noinduk', width: '10%', align: 'center' },
                                    { text: 'Tagihan', datafield: 'rutin', width: '15%', align: 'center' },
                                    { text: 'Biaya', datafield: 'biaya', width: '10%', cellsalign: 'center', align: 'center' },
                                    { text: 'Tgl.Bayar', datafield: 'tanggal', width: '15%', cellsalign: 'center', align: 'center' },
                                    { text: 'Jenis', datafield: 'jenis', width: '10%', cellsalign: 'left', align: 'center' },
                                    { text: 'Verifikasi', datafield: 'verifi', width: '10%', cellsalign: 'left', align: 'center' },
                                ]
                            });
                        }
                    },
                ],
            });
        });
        $("#btnctkrekapharian").click(function () {
            var gridContent = $("#gridlapharian").jqxGrid('exportdata', 'json');
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
        $("#btnkembalidrrincianharian").click(function () {
            $('.kelompokdiv').hide();
            $('.divlapharian').show();
        });
        $("#btnctkdetailharian").click(function () {
            var gridContent = $("#gridrincianlapharian").jqxGrid('exportdata', 'json');
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
        $('#btnviewrekaplengkap').click(function () {
            var set01	= document.getElementById('lap_bulan1').value;
            var set02	= document.getElementById('lap_bulan2').value;
            var set03	= document.getElementById('lap_tahun').value;
            var source	= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'nama', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'periode', type: 'text'},
                    { name: 'tspp', type: 'text'},
                    { name: 'tpaguyuban', type: 'text'},
                    { name: 'teks1', type: 'text'},
                    { name: 'beks1', type: 'text'},
                    { name: 'teks2', type: 'text'},
                    { name: 'beks2', type: 'text'},
                    { name: 'teks3', type: 'text'},
                    { name: 'beks3', type: 'text'},
                    { name: 'teks4', type: 'text'},
                    { name: 'beks4', type: 'text'},
                    { name: 'teks5', type: 'text'},
                    { name: 'beks5', type: 'text'},
                    { name: 'teks6', type: 'text'},
                    { name: 'beks6', type: 'text'},
                    { name: 'keterangan', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:set03, _token: '{{ csrf_token() }}'},
                url : '{{ route("jsonLaplengkap") }}'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('.kelompokdiv').hide();
            $('.divrekaplengkap').show(); 
            $("#gridrekaplengkap").jqxGrid({
                width               : '100%',
                showfilterrow       : true,		
                filterable          : true,                
                columnsresize       : true,
                autoshowfiltericon  : true,
                pageable            : true,
                autoheight          : true,
                theme               : "energyblue",
                source              : dataAdapter,
                selectionmode       : 'multiplecellsextended',
                columns             : [
                    { text: 'No', datafield: 'id', width: 30, cellsalign: 'left', align: 'center' },
                    { text: 'KLS', datafield: 'kelas', width: 30, cellsalign: 'left', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: 200, cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: 100, cellsalign: 'center', align: 'center' },
                    { text: 'Periode', datafield: 'periode', width: 100, cellsalign: 'center', align: 'center' },				
                    { text: 'SPP',  datafield: 'tspp', width: 100, cellsalign: 'right', align: 'center' },
                    { text: 'Paguyuban', datafield: 'tpaguyuban', width: 100, cellsalign: 'right', align: 'center' },	
                    { text: 'Ekskul 1', columngroup: 'ektrakulikuler', datafield: 'teks1', width: 100, cellsalign: 'right', align: 'center' },
                    { text: 'Ekskul 2', columngroup: 'ektrakulikuler', datafield: 'teks2', width: 100, cellsalign: 'right', align: 'center' },
                    { text: 'Ekskul 3', columngroup: 'ektrakulikuler', datafield: 'teks3', width: 100, cellsalign: 'right', align: 'center' },
                    { text: 'Ekskul 4', columngroup: 'ektrakulikuler', datafield: 'teks4', width: 100, cellsalign: 'right', align: 'center' },	
                    { text: 'Ekskul 5', columngroup: 'ektrakulikuler', datafield: 'teks5', width: 100, cellsalign: 'right', align: 'center' },
                    { text: 'Insidental 1', columngroup: 'insidental', datafield: 'beks1', width: 100, cellsalign: 'right', align: 'center' },
                    { text: 'Insidental 2', columngroup: 'insidental', datafield: 'beks2', width: 100, cellsalign: 'right', align: 'center' },
                    { text: 'Insidental 3', columngroup: 'insidental', datafield: 'beks3', width: 100, cellsalign: 'right', align: 'center' },
                    { text: 'Insidental 4', columngroup: 'insidental', datafield: 'beks4', width: 100, cellsalign: 'right', align: 'center' },
                    { text: 'Insidental 5', columngroup: 'insidental', datafield: 'beks5', width: 100, cellsalign: 'right', align: 'center' },
                    { text: 'Total', datafield: 'keterangan', width: 200, cellsalign: 'right', align: 'center' },
                ],
                columngroups: [
                    { text: 'Ektrakulikuler', align: 'center', name: 'ektrakulikuler' },
                    { text: 'Insidental', align: 'center', name: 'insidental' }                 
                ]
            });
        });
        $("#btnctkrekaplengkap").click(function () {
            var gridContent = $("#gridrekaplengkap").jqxGrid('exportdata', 'json');
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
        $('#btnviewrekaplengkapjenis').click(function () {
            var set01   = document.getElementById('lap_bulan1').value;
            var set02   = document.getElementById('lap_bulan2').value;
            var set03   = document.getElementById('lap_tahun').value;
            var source  = {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'nama', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'tglverifikasi', type: 'text'},
                    { name: 'keterangan', type: 'text'},
                    { name: 'nominal', type: 'text'},
                    { name: 'petugas', type: 'text'},
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, val03:set03, _token: '{{ csrf_token() }}'},
                url : '{{ route("jsonLaplengkapperjenis") }}'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('.kelompokdiv').hide();
            $('.divviewrekaplengkapjenis').show(); 
            $("#gridviewrekaplengkapjenis").jqxGrid({
                width               : '100%',
                showfilterrow       : true,
                filterable          : true,                
                columnsresize       : true,
                autoshowfiltericon  : true,
                pageable            : true,
                autoheight          : true,
                theme               : "energyblue",
                source              : dataAdapter,
                selectionmode       : 'multiplecellsextended',
                columns             : [
                    { text: 'KLS', datafield: 'kelas', width: '10%', cellsalign: 'left', align: 'center' },
                    { text: 'Nama', datafield: 'nama', width: '30%', cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Tgl. Verifikasi', datafield: 'tglverifikasi', width: '15%', cellsalign: 'center', align: 'center' },				
                    { text: 'Jenis Pembayaran',  datafield: 'keterangan', width: '15%', cellsalign: 'right', align: 'center' },
                    { text: 'Nominal', datafield: 'nominal', width: '10%', cellsalign: 'right', align: 'center' },
                    { text: 'Petugas', datafield: 'petugas', width: '10%', cellsalign: 'right', align: 'center' },
                ]
            });
        });
        $("#btnctkrekapperjenis").click(function () {
            var gridContent = $("#gridviewrekaplengkapjenis").jqxGrid('exportdata', 'json');
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
        $('#btnviewrekapinsidental').click(function () {
            var set01 = document.getElementById('lap_insidental').value;
            var set02 = document.getElementById('lap_inskelas').value;
            var source= {
                datatype: "json",
                datafields: [
                    { name: 'id'},	
                    { name: 'noinduk', type: 'text'},
                    { name: 'nama', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'tagihan', type: 'text'},
                    { name: 'bayar', type: 'text'},
                    { name: 'keterangan', type: 'text'},					
                ],
                type: 'POST',
                data: {val01:set01, val02:set02, _token: '{{ csrf_token() }}' },
                url : '{{ route("jsonLapinsidental") }}'
            };			
            var dataAdapter = new $.jqx.dataAdapter(source);
            $('.kelompokdiv').hide();
            $('.divviewrekapinsidental').show(); 
            $("#gridviewrekapinsidental").jqxGrid({
                width               : '100%',
                showfilterrow       : true,
                filterable          : true,
                columnsresize       : true,
                autoshowfiltericon  : true,
                pageable            : true,
                autoheight          : true,
                theme               : "energyblue",
                source              : dataAdapter,
                selectionmode       : 'multiplecellsextended',
                columns             : [
                    { text: 'Nama', datafield: 'nama', width: '30%', cellsalign: 'left', align: 'center' },
                    { text: 'No.Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Tagihan', datafield: 'tagihan', width: '15%', cellsalign: 'left', align: 'center' },
                    { text: 'Bayar', datafield: 'bayar', width: '15%', cellsalign: 'left', align: 'center' },
                    { text: 'Keterangan', datafield: 'keterangan', width: '30%', cellsalign: 'left', align: 'center' },				
                ]
            });
        });
        $("#btnexportrekapinsidental").click(function () {
            var gridContent = $("#gridviewrekapinsidental").jqxGrid('exportdata', 'json');
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
        $('#btnviewrekapperkelas').click(function () {
            var set01=document.getElementById('lap_tunggkelas').value;
            var set02=document.getElementById('lap_tunggtapel').value;
            var set03=document.getElementById('lap_tunggbln1').value;
            var set04=document.getElementById('lap_tunggbln2').value;
            if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'TAPEL Tidak Boleh Kosong',
                    type: 'warning',
                })
            } else if (set01 == ''){
                swal({
                    title: 'Stop',
                    text: 'Kelas Tidak Boleh Kosong',
                    type: 'warning',
                })
            } else if (set03 == ''){
                swal({
                    title: 'Stop',
                    text: 'Bulan 1 Tidak Boleh Kosong',
                    type: 'warning',
                })
            } else if (set04 == ''){
                swal({
                    title: 'Stop',
                    text: 'Bulan 2 Tidak Boleh Kosong',
                    type: 'warning',
                })
            } else {
                $('#loading').show();
                $('#divutama').hide();
                $.post('{{ route("exRekaptunggakankelas") }}', { val01: set01, val02: set02, val03: set03, val04: set04, _token: '{{ csrf_token() }}' },
                function(data){
                    $('#loading').hide();
                    $('#divutama').show();
                    var newWindow = window.open('', '', 'width=800, height=500'),
                        document = newWindow.document.open(),
                        pageContent =
                            '<!DOCTYPE html>\n' +
                            '<html>\n' +
                            '<head>\n' +
                            '<meta charset="utf-8" />\n' +
                            '<title>Laporan Keuangan</title>\n' +
                            '</head>\n' +
                            '<body> <h2>laporan Keuangan</h2> <br /> Kelas : ' + set01 + '\n' + data + '\n</body>\n</html>';
                        document.write(pageContent);
                        document.close();
                    return false;
                });
            }
        });
    });
</script>
@endpush