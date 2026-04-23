@extends('adminlte3.layouttop')
@section('content')
<div class="wrapper">
    <div class="content-wrapper secrencanakegiatan kanban" id="kanban">
        <section class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Rencana Kegiatan</h1>
                    </div>
                    <div class="col-sm-6 pull-right">
                        Saldo Sekolah Buku Kegiatan: {{$saldoakhir}}
                    </div>
                </div>
            </div>
        </section>
        <section class="content secrencanakegiatan pb-3 awal">
            <div class="container-fluid h-100">
                <div class="card card-row card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-soccer"></i> Perencanaan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" id="btntambahdata"><i class="fa fa-plus"></i> Tambah Data</button>
                            <button type="button" class="btn btn-tool" id="btnexportdata"><i class="fa fa-file-excel-o"></i> Export</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-group date" data-target-input="nearest">
                                        <select id="id_mastertahun" name="id_mastertahun" size="1" class="form-control">
                                            @php
                                                $tahun = date('Y');
                                                $limtahunlalu = $tahun - 5;
                                                while ($limtahunlalu != $tahun){
                                                    echo '<option value="'.$limtahunlalu.'">'.$limtahunlalu.'</option>';
                                                    $limtahunlalu++;
                                                }
                                                echo '<option value="'.$tahun.'" selected>'.$tahun.'</option>';
                                            @endphp
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <button type="button" class="btn btn-primary btn-block" title="Ubah Tahun" id="btnubahtahun"><i class="fa fa-refresh"></i> Ubah Tahun</button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <table class="table table-bordered table-striped products-list product-list-in-card pl-2 pr-2" id="tabelrencana">
                                <thead>
                                    <tr>
                                        <th>List Kegiatan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card">
                            Total Anggaran Yang di Rencanakan :<br />
                            {!! $nilaitotalperencanaan !!}
                        </div>
                    </div>
                </div>
                <div class="card card-row card-warning shadow">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-soccer"></i> Pengajuan</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped products-list product-list-in-card pl-2 pr-2" id="tabelpengajuan">
                            <thead>
                                <tr>
                                    <th>List Kegiatan</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="card">
                            Total Anggaran Kegiatan di Tahap Pengajuan:<br />
                            {!! $nilaitotalpengajuan !!}
                        </div>
                    </div>
                </div>
                <div class="card card-row card-info shadow">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-soccer"></i> Progres</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped products-list product-list-in-card pl-2 pr-2" id="tabelprogres">
                            <thead>
                                <tr>
                                    <th>List Progres</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="card">
                            Total Anggaran Kegiatan di Tahap Progress:<br />
                            {!! $nilaitotalprogress !!}
                        </div>
                    </div>
                </div>
                <div class="card card-row card-danger shadow">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-soccer"></i> Selesai</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped products-list product-list-in-card pl-2 pr-2" id="tabelselesai">
                            <thead>
                                <tr>
                                    <th>List Progres</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="card">
                            Sisa Saldo Tahun {{date('Y')}}:<br />
                            {!! $nilaitotalselesai !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="content-wrapper" id="nonkanban">
        <section class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Rencana Kegiatan</h1>
                    </div>
                    <div class="col-sm-6 pull-right">
                        Saldo Sekolah Buku Kegiatan: {{$saldoakhir}}
                    </div>
                </div>
            </div>
        </section>
        <section class="content secrencanakegiatan sectionproposal">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Form Pengajuan Proposal</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                        <div class="step" data-target="#part1">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="part1" id="part1-trigger">
                                                <span class="bs-stepper-circle">1</span>
                                                <span class="bs-stepper-label">Proposal</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#part2">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="part2" id="part2-trigger">
                                                <span class="bs-stepper-circle">2</span>
                                                <span class="bs-stepper-label">Rencana Anggaran Belanja</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <div id="part1" class="content" role="tabpanel" aria-labelledby="part1-trigger">
                                            <div class="form-group">
                                                <label>Penanggungg Jawab Kegiatan / Ketua</label>
                                                <select id="rab_penanggungjawab" name="rab_penanggungjawab" class="form-control select2" >
                                                    <option value="">Pilih salah satu</option>
                                                    @foreach($pegawais as $rpeg)
                                                        <option value="{{ $rpeg['niy'] }}">{{ $rpeg['nama'] }} ( {{ $rpeg['jabatan'] }} )</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Sekretaris Panitia</label>
                                                <select id="rab_sekretaris" name="rab_sekretaris" class="form-control select2" >
                                                    <option value="">Pilih salah satu</option>
                                                    @foreach($pegawais as $rpeg)
                                                        <option value="{{ $rpeg['niy'] }}">{{ $rpeg['nama'] }} ( {{ $rpeg['jabatan'] }} )</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Bendahara Kegiatan</label>
                                                <select id="rab_bendahara" name="rab_bendahara" class="form-control select2" >
                                                    <option value="">Pilih salah satu</option>
                                                    @foreach($pegawais as $rpeg)
                                                        <option value="{{ $rpeg['niy'] }}">{{ $rpeg['nama'] }} ( {{ $rpeg['jabatan'] }} )</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label>Mulai </label>
                                                        <div class="input-group date" data-target-input="nearest">
                                                            <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="rab_mulai" name="rab_mulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fa fa-flag"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label>Akhir </label>
                                                        <div class="input-group date" data-target-input="nearest">
                                                            <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="rab_akhir" name="rab_akhir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                                            <div class="input-group-append">
                                                                <div class="input-group-text"><i class="fa fa-flag-checkered"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>Nama Kegiatan</label>
                                                        <input type="text" class="form-control" id="rab_namakegiatan" name="rab_namakegiatan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                Link Surat Permohonan, SK Kepanitian, dan Proposal
                                                <textarea id="teksproposal"></textarea>
                                            </div>
                                            <button class="btn btn-primary" id="btnsimpan1">Next</button>
                                        </div>
                                        <div id="part2" class="content" role="tabpanel" aria-labelledby="part2-trigger">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool btntambahrab"><i class="fa fa-plus"></i></button>
                                                        <button type="button" class="btn btn-tool btnexportrab"><i class="fa fa-print"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="btn-grgoup">
                                                        <button type="button" class="btn btn-primary btntambahrab"><i class="fa fa-plus"></i> Tambah Data</button>
                                                        <button type="button" class="btn btn-warning btnexportrab"><i class="fa fa-print"></i> Export</button>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div id="gridrab"></div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                                            <button class="btn btn-primary" id="btnkirimajuankebendahara">Kirim ke Bendahara</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content secrencanakegiatan sectionpengiriman">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Form Pengajuan Proposal</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="loading">
                                    <img src="{{ asset('dist/img/loading.gif') }}" class="img-responsive" alt="Photo">
                                </div>
                                <div id="pesan"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content secrencanakegiatan sectionpenggisianspj">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card card-warning shadow">
                            <div class="card-header">
                                <h3 class="card-title">Rencana Anggaran</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="gridrencanarab"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card card-danger shadow">
                            <div class="card-header">
                                <h3 class="card-title">Realisasi Anggaran</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" id="btntambahdatarealisasi">
                                        <i class="fa fa-plus"></i> Tambah Data
                                    </button>
                                    <button type="button" class="btn btn-tool btnkembali">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="gridlaporanspj"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" name="id_rencana" id="id_rencana">

<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<div class="modal fade" id="modaltambahanrencana">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Rencana Kegiatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formtambahperencanaa" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id_nama">Nama Kegiatan</label>
                        <input type="text" class="form-control" id="id_nama" name="namakegiatan">
                    </div>
                    <div class="form-group">
                        <label for="id_deskripsi">Deskripsi Kegiatan</label>
                        <input type="text" class="form-control" id="id_deskripsi" name="deskripsi">
                    </div>
                    <div class="form-group">
                        <label for="id_perkiraanpelaksanaan">Perkiraan Pelaksanaan</label>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Mulai </label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="id_perkiraanpelaksanaanmulai" name="mulai" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-flag"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Akhir </label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="id_perkiraanpelaksanaanakhir" name="akhir" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-flag-checkered"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_pengajuan">Perkiraan Biaya</label>
                        <input type="text" class="form-control" id="id_pengajuan" name="pengajuan">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger pull-left" id="btnhapusdata">Hapus</button>
                <button type="button" class="btn btn-success" id="btnsimpandatabaru">Simpan</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltambahanrab">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Rencana Kegiatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="rab_deskripsi">Deskripsi *)</label>
                    <input type="text" class="form-control" id="rab_deskripsi" name="rab_deskripsi">
                </div>
                <div class="form-group">
                    <label for="rab_angggaran">Anggaran *)</label>
                    <input type="text" class="form-control" id="rab_angggaran" name="rab_angggaran">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" name="id_rab" id="id_rab">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpanrab">Simpan</button>	
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalinputdatarealisasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Realisasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="realisasi_deskripsi">Deskripsi</label>
                    <input type="text" class="form-control" id="realisasi_deskripsi" name="realisasi_deskripsi">
                </div>
                <div class="form-group">
                    <label for="realisasi_penerima">Nama Penerima</label>
                    <input type="text" class="form-control" id="realisasi_penerima" name="realisasi_penerima">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Jenis </label>
                            <select id="realisasi_jenis" name="realisasi_jenis" class="form-control" >
                                <option value="pengeluaran">Pengeluaran</option>
                                <option value="pemasukan">Pemasukan</option>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label>Tanggal </label>
                            <div class="input-group date" data-target-input="nearest">
                                <input value="{{date('Y-m-d')}}" type="text" class="form-control datemaskinput" id="realisasi_tanggal" name="realisasi_tanggal" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask/>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>Nominal</label>
                            <input type="text" class="form-control" id="realisasi_nominal" name="realisasi_nominal">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <input type="hidden" name="realisasi_id" id="realisasi_id">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id="btnsimpandatarealisasi">Simpan</button>	
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })
    $(function () {
        CKEDITOR.env.isCompatible = true;
        CKEDITOR.replace('teksproposal');
        $('.select2').select2({width: '100%'});
        $('.datemaskinput').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
    });
    function openrabkegiatan( jQuery ){
        var set01=document.getElementById('id_rencana').value;
        $.post('{{ route("jsonRencanaKegiatan") }}', { jenis: 'getrabkegiatan', tahun: set01, _token: '{{ csrf_token() }}' }, function(data){
            var sourceRABKeg    = {
                datatype: "json",
                datafields: [
                    { name: 'id' },
                    { name: 'deskripsi', type: 'string' },
                    { name: 'anggaran', type: 'string' },
                    { name: 'disetujui', type: 'string' },
                    { name: 'bendahara', type: 'string' },
                    { name: 'keterangan', type: 'string' },
                    { name: 'marking', type: 'string' }
                ],
                localData	: data.datarab
            };
            var datajsonRAB = new $.jqx.dataAdapter(sourceRABKeg);
            $("#gridrab").jqxGrid({
                width           : '100%',
                pageable        : true,
                autoheight      : true,
                filterable      : true,
                showfilterrow   : true,
                columnsresize   : true,
                source          : datajsonRAB,
                sortable        : true,
                altrows         : true,
                theme           : "energyblue",
                columns         : [
                    { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                        return "Edit";
                        }, buttonclick: function (row) {
                            editrow         = row;
                            var offset 		= $("#gridrab").offset();
                            var dataRecord 	= $("#gridrab").jqxGrid('getrowdata', editrow);
                            var set04       = document.getElementById('rab_penanggungjawab').value;
                            var set05       = document.getElementById('rab_sekretaris').value;
                            var set06       = document.getElementById('rab_bendahara').value;
                            var sesi        = "{{Session('previlage')}}";
                            var niye        = "{{Session('nip')}}";
                            var acckeu      = dataRecord.disetujui;
                            if (acckeu == '' || acckeu == 0 || acckeu == null){
                                if (sesi == 'Waka Kesiswaan' || sesi == 'level1' || niye == set04 || niye == set05 || niye == set06){
                                    $('#id_rab').val(dataRecord.id);
                                    $('#rab_deskripsi').val(dataRecord.deskripsi);
                                    $('#rab_angggaran').val(dataRecord.anggaran);
                                    $("#modaltambahanrab").modal('show');
                                } else {
                                    swal({
                                        title	: 'Warning',
                                        text	: 'Akses Terbatas Untuk Waka Kurikulum',
                                        type	: 'error',
                                    });
                                }
                            } else {
                                swal({
                                    title	: 'Stop',
                                    text	: 'Ajuan yang sudah diverifikasi Bendahara Tidak Boleh di Rubah',
                                    type	: 'error',
                                });
                            }
                        }
                    },
                    { text: 'Deskripsi', datafield: 'deskripsi', width: '25%', cellsalign: 'left', align: 'center'  },
                    { text: 'Angggaran', cellsformat: 'n', datafield: 'anggaran', width: '10%', cellsalign: 'right', align: 'center'  },
                    { text: 'Acc Keuangan', columngroup: 'groupkeuangan', cellsformat: 'n', datafield: 'disetujui', width: '10%', cellsalign: 'right', align: 'center' },
                    { text: 'Bendahara', columngroup: 'groupkeuangan', datafield: 'bendahara', width: '15%', cellsalign: 'left', align: 'center' },
                    { text: 'Keterangan', columngroup: 'groupkeuangan', datafield: 'keterangan', width: '30%', cellsalign: 'left', align: 'center'  },
                    { text: 'Delete', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                        return "Delete";
                        }, buttonclick: function (row) {
                            editrow         = row;	
                            var offset 		= $("#gridrab").offset();
                            var dataRecord 	= $("#gridrab").jqxGrid('getrowdata', editrow);
                            var set04       = document.getElementById('rab_penanggungjawab').value;
                            var set05       = document.getElementById('rab_sekretaris').value;
                            var set06       = document.getElementById('rab_bendahara').value;
                            var sesi        = "{{Session('previlage')}}";
                            var niye        = "{{Session('nip')}}";
                            if (sesi == 'Waka Kesiswaan' || sesi == 'level1' || niye == set04 || niye == set05 || niye == set06){
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
                                        url			: '{{ route("exSimpanRK") }}',
                                        method		: 'post',
                                        data		: {workcode:'hapusdatarab', val02:dataRecord.id,  _token: '{{ csrf_token() }}'},
                                        dataType	: 'json',
                                        success: function(response, status, xhr) {
                                            swal({
                                                title	: response.status,
                                                text	: response.message,
                                                type	: response.icon,
                                            });
                                            openrabkegiatan();
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
                            } else {
                                swal({
                                    title	: 'Warning',
                                    text	: 'Akses Terbatas Untuk Waka Kurikulum',
                                    type	: 'error',
                                });
                            }
                        }
                    },
                ],
                columngroups: 
                [
                    { text: 'Verifikasi Keuangan', align: 'center', name: 'groupkeuangan' }                 
                ]
            });
            return false;
        });
    }
    function btneditdata(id){
        $('#id_rencana').val(id);
        $.post('{{ route("jsonRencanaKegiatan") }}', { jenis: 'finddatakegiatan', tahun: id, _token: '{{ csrf_token() }}' }, function(data){
            $("#id_nama").val(data.namakegiatan);
            $("#id_deskripsi").val(data.deskripsi);
            $("#id_perkiraanpelaksanaanmulai").val(data.mulai);
            $("#id_perkiraanpelaksanaanakhir").val(data.akhir);
            $("#id_pengajuan").val(data.pengajuan);
            $("#modaltambahanrencana").modal('show');
        });
    }
    function btnajukan(id){
        $('#id_rencana').val(id);
        $.post('{{ route("jsonRencanaKegiatan") }}', { jenis: 'getrabkegiatan', tahun: id, _token: '{{ csrf_token() }}' }, function(data){
            var bendahara    = data.bendahara;
            $(".secrencanakegiatan").hide();
            $(".sectionproposal").show();
            $("#kanban").hide();
            $("#nonkanban").show();
            openrabkegiatan();
            $("#rab_mulai").val(data.mulai);
            $("#rab_akhir").val(data.akhir);
            $("#rab_namakegiatan").val(data.namakegiatan);
            $("#rab_penanggungjawab").val(data.niypj).select2().trigger('change');
            $("#rab_sekretaris").val(data.niysekretaris).select2().trigger('change');
            $("#rab_bendahara").val(data.niybendaharakegiatan).select2().trigger('change');
            CKEDITOR.instances['teksproposal'].setData(data.teksproposal)
            return false;
        });
    }
    function btnbuatpengajuan(id){
        $('#id_rencana').val(id);
        $.post('{{ route("exSimpanRK") }}', { workcode: 'kirimkeks', id: id, _token: '{{ csrf_token() }}' }, function(data){
            var status      = data.status;
            var message     = data.message;
            var warna 	    = data.warna;
            var icon 	    = data.icon;
            if (icon == 'error'){
                swal({
                    title   : status,
                    text    : message,
                    type    : icon,
                })
            } else {
                $(".secrencanakegiatan").hide();
                $(".sectionpengiriman").show();
                $("#kanban").hide();
                $("#nonkanban").show();
                $("#loading").show();
                $("#pesan").hide();
                $("#loading").hide();
                $("#pesan").show();
                $.toast({
                    heading     : status,
                    text        : message,
                    position    : 'top-right',
                    loaderBg    : warna,
                    icon        : icon,
                    hideAfter   : 5000,
                    stack       : 1
                });
                $("#pesan").html(data.keterangan);
                var windowName 	= 'Send WA';
                var windowSize 	= "width=800,height=800";
                window.open(data.keteranganwa, windowName, windowSize);
            }
            
        });
    }
    function btnviewspj(id){
        $('#id_rencana').val(id);
        $(".secrencanakegiatan").hide();
        $(".sectionpenggisianspj").show();
        $("#kanban").hide();
        $("#nonkanban").show();
        var sourceRencRABKeg    = {
            datatype    : "json",
            datafields  : [
                { name: 'id' },
                { name: 'deskripsi', type: 'string' },
                { name: 'anggaran', type: 'string' },
                { name: 'disetujui', type: 'string' },
                { name: 'bendahara', type: 'string' },
                { name: 'keterangan', type: 'string' },
                { name: 'marking', type: 'string' }
            ],
            type: 'POST',
            data: {jenis: 'isirabkegiatan', tahun: id, _token:  '{{ csrf_token() }}'},
            url : '{{ route("jsonRencanaKegiatan") }}',
        };
        var datajsonRenRAB = new $.jqx.dataAdapter(sourceRencRABKeg);
        $("#gridrencanarab").jqxGrid({
            width           : '100%',
            autoheight      : true,
            columnsresize   : true,
            source          : datajsonRenRAB,
            sortable        : true,
            altrows         : true,
            theme           : "energyblue",
            columns         : [
                { text: 'Deskripsi', datafield: 'deskripsi', width: '60%', cellsalign: 'left', align: 'center'  },
                { text: 'Anggaran', cellsformat: 'n2', datafield: 'disetujui', width: '40%', cellsalign: 'right', align: 'center' },
            ]
        });
        var sourceRABRealisasi    = {
            datatype: "json",
            datafields: [
                { name: 'id' },
                { name: 'tanggal', type: 'string' },
                { name: 'deskripsi', type: 'string' },
                { name: 'pemasukan', type: 'string' },
                { name: 'pengeluaran', type: 'string' },
                { name: 'realnominal', type: 'string' },
                { name: 'realjenis', type: 'string' },
                { name: 'penerima', type: 'string' },
                { name: 'keterangan', type: 'string' },
                { name: 'marking', type: 'string' },
                { name: 'id_sekolah', type: 'string' },
                { name: 'created_by', type: 'string' },
            ],
            type: 'POST',
            data: {jenis: 'realisasikeuangan', tahun: id, _token:  '{{ csrf_token() }}'},
            url : '{{ route("jsonRencanaKegiatan") }}',
        };
        var datajsonRealisasiRAB = new $.jqx.dataAdapter(sourceRABRealisasi);
        $("#gridlaporanspj").jqxGrid({
            width           : '100%',
            pageable        : true,
            autoheight      : true,
            filterable      : true,
            showfilterrow   : true,
            columnsresize   : true,
            source          : datajsonRealisasiRAB,
            sortable        : true,
            altrows         : true,
            theme           : "energyblue",
            columns         : [
                { text: 'Tanggal', filtertype: 'checkedlist', datafield: 'tanggal', width: '15%', cellsalign: 'left', align: 'center' },
                { text: 'Penerima', datafield: 'penerima', width: '15%', cellsalign: 'left', align: 'center' },
                { text: 'Deskripsi', datafield: 'deskripsi', width: '30%', cellsalign: 'left', align: 'center' },
                { text: 'Pemasukan', datafield: 'pemasukan', cellsformat: 'n2', width: '10%', cellsalign: 'right', align: 'center' },
                { text: 'Pengeluaran', datafield: 'pengeluaran', cellsformat: 'n2', width: '10%', cellsalign: 'right', align: 'center' },
                { text: 'Keterangan', datafield: 'keterangan', width: '15%', cellsalign: 'right', align: 'center' },
                { text: 'Edit', editable: false, sortable: false, filterable: false, columntype: 'button', width: '5%', cellsrenderer: function () {
                    return "Edit";
                    }, buttonclick: function (row) {
                        editrow         = row;
                        var offset 		= $("#gridlaporanspj").offset();
                        var dataRecord 	= $("#gridlaporanspj").jqxGrid('getrowdata', editrow);
                        var created_by  = dataRecord.created_by;
                        if (created_by == "{{Session('nip')}}"){
                            var pemasukan   = dataRecord.pemasukan;
                            var pengeluaran = dataRecord.pengeluaran;
                            if (pengeluaran == 0 || pengeluaran == ''){
                                var jenis   = 'pemasukan';
                                var nominal = pemasukan;
                            } else {
                                var jenis   = 'pengeluaran';
                                var nominal = pengeluaran;
                            }
                            $('#realisasi_deskripsi').val(dataRecord.deskripsi);
                            $('#realisasi_penerima').val(dataRecord.penerima);
                            $('#realisasi_jenis').val(jenis);
                            $('#realisasi_tanggal').val(dataRecord.tanggal);
                            $('#realisasi_nominal').val(nominal);
                            $('#realisasi_id').val(dataRecord.id);
                            $("#modalinputdatarealisasi").modal('show');
                        } else {
                            swal({
                                title	: 'Stop',
                                text	: 'Access Denied',
                                type	: 'info',
                            });
                        }
                        
                    }
                }
            ],
        });
    }
    function btnkegiatanselesai(id){
        swal({
            title			    : "Konfirmasi",
            text			    : "Data yang akan ditandai Selesai, Maka Bapak/Ibu tidak lagi bisa menambah data SPJ. Apakah Bapak/Ibu Yakin",
            type			    : 'warning',
            showCancelButton    : true,
            confirmButtonClass  : 'btn btn-confirm mt-2',
            cancelButtonClass   : 'btn btn-cancel ml-2 mt-2',
            confirmButtonText   : 'Yes'
        }).then(function () {
            $.ajax({
                type		: 'ajax',
                url			: '{{ route("exSimpanRK") }}',
                method		: 'post',
                data		: {workcode:'arsipkan', id:id,  _token: '{{ csrf_token() }}'},
                dataType	: 'json',
                success: function(response, status, xhr) {
                    swal({
                        title	: response.status,
                        text	: response.message,
                        type	: response.icon,
                    });
                    $('#btnubahtahun').click();
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
    function btncetaklaporan(id){
        var uri = '{{url('/')}}/laporankegiatan/'+id;
        window.location=uri
    }
    $(document).ready(function () {
        $(".secrencanakegiatan").hide();
        $(".awal").show();
        $("#kanban").show();
        $("#nonkanban").hide();
        $("#realisasi_nominal").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#id_pengajuan").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $("#rab_angggaran").autoNumeric('init', {aSep: ',', mDec: '0', vMax: '99999999999999999999999999'});
        $('#btnubahtahun').click(function () {
            var set01   = document.getElementById('id_mastertahun').value;
            if (set01 == '' || set01 == null){
                swal({
                    title	: 'Warning',
                    text	: 'Pilih Tahun Terlebih Dahulu',
                    type	: 'error',
                });
            } else {
                $(".secrencanakegiatan").hide();
                $(".awal").show();
                $("#kanban").show();
                $("#nonkanban").hide();
                $("#tabelrencana").DataTable().ajax.reload();
                $("#tabelpengajuan").DataTable().ajax.reload();
                $("#tabelprogres").DataTable().ajax.reload();
                $("#tabelselesai").DataTable().ajax.reload();
            }
        });
        $('.btnkembali').click(function () {
            $(".secrencanakegiatan").hide();
            $(".awal").show();
            $("#kanban").show();
            $("#nonkanban").hide();
            $("#tabelrencana").DataTable().ajax.reload();
            $("#tabelpengajuan").DataTable().ajax.reload();
            $("#tabelprogres").DataTable().ajax.reload();
            $("#tabelselesai").DataTable().ajax.reload();
        });
        $('#tabelrencana').DataTable({
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
			dom			: '<"row d-flex justify-content-between align-items-center m-1"' +
                            '<"col-lg-2 d-flex align-items-center">' +
                            '<"col-lg-8 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
                        '>',
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonRencanaKegiatan") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						tahun           : document.getElementById('id_mastertahun').value,
						jenis           : 'rencana',
                        search          : data.search.value,
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
						id 						: "id",
						tahun 					: "tahun",
						perkiraanpelaksanaan    : "perkiraanpelaksanaan",
						namakegiatan 			: "namakegiatan",
						deskripsi 				: "deskripsi",
                        pengajuan 				: "pengajuan",
                        aprovalkeuangan 		: "aprovalkeuangan",
                        saldoakhir 				: "saldoakhir",
                        penanggunggjawab 		: "penanggunggjawab",
                        mulai 				    : "mulai",
					    akhir 				    : "akhir",
					    niypj 				    : "niypj",
					    status 				    : "status",
					    created_by 				: "created_by",
					},
					"orderable" : false,
					"render" 	: function(data,type,full,meta){
                        stateNum            = Math.floor(Math.random() * 6);
                        states 		        = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
						state 		        = states[stateNum];
                        var angka           = data.pengajuan;
                        var formattedAngka  = angka.toLocaleString('id-ID');
                        var $rowOutput 	= '<div>'+
                                            '<a href="javascript:void(0)" onClick="btneditdata('+data.id+')" class="product-title">'+data.namakegiatan+'<span class="badge badge-'+state+' float-right">Edit</span></a>'+
                                            '<span class="product-description">Rencana Pelaksanaan : '+data.perkiraanpelaksanaan+'</span>'+
                                            '<span class="product-description">Perkiraan Angggaran : <span class="badge badge-'+state+' float-right">'+formattedAngka+'</span></span>'+
                                            '<a href="javascript:void(0)" onClick="btnajukan('+data.id+')" class="btn btn-'+state+' btn-block">Buat Proposal</a>'+
                                        '</div>';
						return $rowOutput;
					}
				}
			],
		});
        $('#tabelpengajuan').DataTable({
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
			dom			: '<"row d-flex justify-content-between align-items-center m-1"' +
                            '<"col-lg-2 d-flex align-items-center">' +
                            '<"col-lg-8 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
                        '>',
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonRencanaKegiatan") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						tahun           : document.getElementById('id_mastertahun').value,
						jenis           : 'pengajuan',
                        search          : data.search.value,
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
						id 						: "id",
						tahun 					: "tahun",
						perkiraanpelaksanaan    : "perkiraanpelaksanaan",
						namakegiatan 			: "namakegiatan",
						deskripsi 				: "deskripsi",
                        pengajuan 				: "pengajuan",
                        aprovalkeuangan 		: "aprovalkeuangan",
                        catatanbendahara 		: "catatanbendahara",
                        bendahara 		        : "bendahara",
                        mulai 				    : "mulai",
					    akhir 				    : "akhir",
					    niypj 				    : "niypj",
					    status 				    : "status",
					    created_by 				: "created_by",
					},
					"orderable" : false,
					"render" 	: function(data,type,full,meta){
                        stateNum            = Math.floor(Math.random() * 6);
                        states 		        = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
						state 		        = states[stateNum];
                        var pengajuan       = data.pengajuan;
                        var pengajuan       = pengajuan.toLocaleString('id-ID');
                        var aprovalkeuangan = data.aprovalkeuangan;
                        var aprovalkeuangan = aprovalkeuangan.toLocaleString('id-ID');
                        
                        var $rowOutput 	= '<div>'+
                                            '<a href="javascript:void(0)" onClick="btnajukan('+data.id+')" class="product-title">'+data.namakegiatan+'<span class="badge badge-'+state+' float-right">Edit</span></a>'+
                                            '<span class="product-description">Anggaran Yang di Ajukan : '+pengajuan+'</span>'+
                                            '<span class="product-description">ACC Keuangan :'+aprovalkeuangan+'</span>'+
                                            '<span class="product-description">Catatan Bendahara :'+data.bendahara+', '+data.catatanbendahara+'</span>'+
                                            '<a href="javascript:void(0)" onClick="btnbuatpengajuan('+data.id+')" class="btn btn-'+state+' btn-block"> <i class="fa fa-fax"></i> Kirim ke Kepala Sekolah</a>'+
                                        '</div>';
						return $rowOutput;
					}
				}
			],
		});
        $('#tabelprogres').DataTable({
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
        						'<"col-lg-2 d-flex align-items-center">' +
       							'<"col-lg-8 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>',
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonRencanaKegiatan") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						tahun           : document.getElementById('id_mastertahun').value,
						jenis           : 'progress',
                        search          : data.search.value,
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
						id 						: "id",
						tahun 					: "tahun",
						perkiraanpelaksanaan    : "perkiraanpelaksanaan",
						namakegiatan 			: "namakegiatan",
						deskripsi 				: "deskripsi",
                        pengajuan 				: "pengajuan",
                        aprovalkeuangan 		: "aprovalkeuangan",
                        saldoakhir 				: "saldoakhir",
                        penanggunggjawab 		: "penanggunggjawab",
                        mulai 				    : "mulai",
					    akhir 				    : "akhir",
					    niypj 				    : "niypj",
					    status 				    : "status",
					    created_by 				: "created_by",
					},
					"orderable" : false,
					"render" 	: function(data,type,full,meta){
                        stateNum                = Math.floor(Math.random() * 6);
                        states 		            = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
                        var aprovalkeuangan     = data.aprovalkeuangan;
                        var aprovalkeuangan     = aprovalkeuangan.toLocaleString('id-ID');
						state 		            = states[stateNum];
                        var $rowOutput 	= '<div>'+
                                            '<a href="javascript:void(0)" onClick="btnbuatpengajuan('+data.id+')" class="product-title">'+data.namakegiatan+'<span class="badge badge-'+state+' float-right">Kirim ke KS</span></a>'+
                                            '<span class="product-description">Pelaksanaan : '+data.mulai+' s/d '+data.akhir+'</span>'+
                                            '<span class="product-description">PIC :'+data.penanggunggjawab+'</span>'+
                                            '<span class="product-description">ACC Keuangan :'+aprovalkeuangan+'</span>'+
                                            '<span class="product-description">Catatan Bendahara :'+data.bendahara+', '+data.catatanbendahara+'</span>'+
                                            '<a href="javascript:void(0)" onClick="btnviewspj('+data.id+')" class="btn btn-warning btn-block"> <i class="fa fa-newspaper-o"></i> Isi SPJ</a>'+
                                            '<a href="javascript:void(0)" onClick="btnkegiatanselesai('+data.id+')" class="btn btn-danger btn-block"> <i class="fa fa-flag-checkered"></i> Tandai Kegiatan Selesai</a>'+
                                        '</div>';
						return $rowOutput;
					}
				}
			],
		});
        $('#tabelselesai').DataTable({
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
        						'<"col-lg-2 d-flex align-items-center">' +
       							'<"col-lg-8 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pe-lg-1 p-0"f<"invoice_status ms-sm-2">>' +
        					'>',
			ajax		: function(data, callback, settings) {
				$.ajax({
					url: '{{ route("jsonRencanaKegiatan") }}',
					data: {
						limit           : settings._iDisplayLength,
						page            : Math.ceil(settings._iDisplayStart / settings._iDisplayLength) + 1,
						tahun           : document.getElementById('id_mastertahun').value,
						jenis           : 'selesai',
                        search          : data.search.value,
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
						id 						: "id",
						tahun 					: "tahun",
						perkiraanpelaksanaan    : "perkiraanpelaksanaan",
						namakegiatan 			: "namakegiatan",
						deskripsi 				: "deskripsi",
                        pengajuan 				: "pengajuan",
                        aprovalkeuangan 		: "aprovalkeuangan",
                        saldoakhir 				: "saldoakhir",
                        penanggunggjawab 		: "penanggunggjawab",
                        mulai 				    : "mulai",
					    akhir 				    : "akhir",
					    niypj 				    : "niypj",
					    status 				    : "status",
					    created_by 				: "created_by",
					},
					"orderable" : false,
					"render" 	: function(data,type,full,meta){
                        stateNum    = Math.floor(Math.random() * 6);
                        states 		= ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
						state 		= states[stateNum];
                        angka 		= data.saldoakhir;
                        var formattedAngka  = angka.toLocaleString('id-ID');
                        var $rowOutput 	= '<div>'+
                                            '<a href="javascript:void(0)"" class="product-title" onClick="btncetaklaporan('+data.id+')">'+data.namakegiatan+'<span class="badge badge-'+state+' float-right"><i class="fa fa-print"></i></span></a>'+
                                            '<span class="product-description">Angggaran : '+data.aprovalkeuangan+'</span>'+
                                            '<span class="product-description">Saldo : '+formattedAngka+'</span>'+
                                        '</div>';
						return $rowOutput;
					}
				}
			],
		});
        $('#btnexportdata').click(function () {
            var set01   = document.getElementById('id_mastertahun').value;
            if (set01 == '' || set01 == null){
                swal({
                    title	: 'Warning',
                    text	: 'Pilih Tahun Terlebih Dahulu',
                    type	: 'error',
                });
            } else {
                $.post('{{ route("jsonRencanaKegiatan") }}', { tahun:set01, jenis:'exportkegiatan', _token: '{{ csrf_token() }}' },
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
        $('#btntambahdata').click(function () {
            var set01   = document.getElementById('id_mastertahun').value;
            if (set01 == '' || set01 == null){
                swal({
                    title	: 'Warning',
                    text	: 'Pilih Tahun Terlebih Dahulu',
                    type	: 'error',
                });
            } else {
                $('#id_rencana').val('new');
                $("#modaltambahanrencana").modal('show');
            }
        });
        $('#btnhapusdata').click(function () {
            var set05=document.getElementById('id_rencana').value;
            if (set05 == 'new'){
                swal({
                    title	: 'Warning',
                    text	: 'Bukan untuk data baru',
                    type	: 'error',
                });
            } else {
                var formdata = new FormData($('#formtambahperencanaa')[0]);
                    formdata.set('id', set05);
                    formdata.set('workcode', 'hapusrencana');
                    formdata.set('_token', '{{ csrf_token() }}');
                    $("#modaltambahanrencana").modal('hide');
                $.ajax({
                    url         : '{{ route("exSimpanRK") }}',
                    data        : formdata,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success: function (data) {
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
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        return false;
                    },
                    error: function (xhr, status, error) {
                        swal({
                            title	: 'Stop',
                            text	: xhr.responseText,
                            type	: 'warning',
                        })
                    }
                });
            }
        });
        $('#btnsimpandatabaru').click(function () {
            var set01=document.getElementById('id_nama').value;
            var set02=document.getElementById('id_deskripsi').value;
            var set03=document.getElementById('id_perkiraanpelaksanaanmulai').value;
            var set04=document.getElementById('id_pengajuan').value;
            var set05=document.getElementById('id_rencana').value;
            var set06=document.getElementById('id_mastertahun').value;
            var set07=document.getElementById('id_perkiraanpelaksanaanakhir').value;
            if (set01 == '' || set02 == '' || set03 == '' || set04 == '' || set05 == '' || set07 == ''){
                swal({
                    title	: 'Warning',
                    text	: 'Lengkapi semua isian pada field yang bertanda bintang, apabila ada data yang memang tidak ada mohon memberikan tanda 0 (nol) atau - (strip)',
                    type	: 'error',
                });
            } else {
                var formdata = new FormData($('#formtambahperencanaa')[0]);
                    formdata.set('id', set05);
                    formdata.set('tahun', set06);
                    formdata.set('workcode', 'tambahdata');
                    formdata.set('_token', '{{ csrf_token() }}');
                    $("#modaltambahanrencana").modal('hide');
                $.ajax({
                    url         : '{{ route("exSimpanRK") }}',
                    data        : formdata,
                    type        : 'POST',
                    contentType : false,
                    processData : false,
                    success: function (data) {
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
                        $("#tabelrencana").DataTable().ajax.reload();
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        return false;
                    },
                    error: function (xhr, status, error) {
                        swal({
                            title	: 'Stop',
                            text	: xhr.responseText,
                            type	: 'warning',
                        })
                    }
                });
            }
        });
        $('.btntambahrab').click(function () {
            $('#id_rab').val('new');
            $("#modaltambahanrab").modal('show');
        });
        $('#btnsimpanrab').click(function () {
            var set01=document.getElementById('rab_deskripsi').value;
            var set02=document.getElementById('rab_angggaran').value;
            var set03=document.getElementById('id_rencana').value;
            var set04=document.getElementById('rab_penanggungjawab').value;
            var set05=document.getElementById('rab_sekretaris').value;
            var set06=document.getElementById('rab_bendahara').value;
            var set07=document.getElementById('id_rab').value;
            var sesi ="{{Session('previlage')}}";
            var niye ="{{Session('nip')}}";
            if (sesi == 'Waka Kesiswaan' || sesi == 'level1' || niye == set04 || niye == set06 || niye == set05){
                if (set01 == '' || set02 == ''){
                    swal({
                        title	: 'Warning',
                        text	: 'Lengkapi semua isian pada field yang bertanda bintang, apabila ada data yang memang tidak ada mohon memberikan tanda 0 (nol) atau - (strip)',
                        type	: 'error',
                    });
                } else {
                    var formdata = new FormData();
                        formdata.set('id', set07);
                        formdata.set('deskripsi', set01);
                        formdata.set('pengajuan', set02);
                        formdata.set('idkegiatan', set03);
                        formdata.set('workcode', 'tambahdatarab');
                        formdata.set('_token', '{{ csrf_token() }}');
                        $("#modaltambahanrab").modal('hide');
                    $.ajax({
                        url         : '{{ route("exSimpanRK") }}',
                        data        : formdata,
                        type        : 'POST',
                        contentType : false,
                        processData : false,
                        success: function (data) {
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
                            openrabkegiatan();
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                            return false;
                        },
                        error: function (xhr, status, error) {
                            swal({
                                title	: 'Stop',
                                text	: xhr.responseText,
                                type	: 'warning',
                            })
                        }
                    });
                }
            } else {
                swal({
                    title	: 'Warning',
                    text	: 'Akses Terbatas Untuk Waka Kesiswaan dan PJ Kegiatan',
                    type	: 'error',
                });
            }
        });
        $('#btnsimpan1').click(function () {
            var set01=document.getElementById('rab_penanggungjawab').value;
            var set02=CKEDITOR.instances['teksproposal'].getData()
            var set03=document.getElementById('id_rencana').value;
            var set04=document.getElementById('rab_mulai').value;
            var set05=document.getElementById('rab_akhir').value;
            var set06=document.getElementById('rab_namakegiatan').value;
            var set07=document.getElementById('rab_sekretaris').value;
            var set08=document.getElementById('rab_bendahara').value;
            var sesi ="{{Session('previlage')}}";
            var niye ="{{Session('nip')}}";
            if (sesi == 'Waka Kesiswaan' || sesi == 'level1' || niye == set04){
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData();
                    formdata.set('penanggungjawab',set01);
				    formdata.set('teksproposal',set02);
				    formdata.set('id',set03);
					formdata.set('mulai',set04);
				    formdata.set('akhir',set05);
				    formdata.set('namakegiatan',set06);
				    formdata.set('sekretaris',set07);
				    formdata.set('bendaharakegiatan',set08);
				    formdata.set('workcode','simpanpengajuan1');
					formdata.set('_token', '{{ csrf_token() }}');
                url='{{ route("exSimpanRK") }}';
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
                        stepper.next()
                        var idne    = response.idne;
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
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title: textStatus,
                            text:  jqXHR.responseText,
                            type: 'info',
                        });
                    }
                });
            } else {
                swal({
                    title	: 'Warning',
                    text	: 'Akses Terbatas Untuk Waka Kesiswaan dan PJ Kegiatan',
                    type	: 'error',
                });
            }
        });
        $('#btnkirimajuankebendahara').click(function () {
            var set01=document.getElementById('rab_penanggungjawab').value;
            var set02=CKEDITOR.instances['teksproposal'].getData()
            var set03=document.getElementById('id_rencana').value;
            var sesi ="{{Session('previlage')}}";
            var niye ="{{Session('nip')}}";
            if (sesi == 'Waka Kesiswaan' || sesi == 'level1' || niye == set04){
                var btn = $(this);
                    btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
                var formdata = new FormData();
                    formdata.set('penanggungjawab',set01);
				    formdata.set('teksproposal',set02);
				    formdata.set('id',set03);
					formdata.set('workcode','simpanpengajuan2');
					formdata.set('_token', '{{ csrf_token() }}');
                url='{{ route("exSimpanRK") }}';
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
                        var idne    = response.idne;
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
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        $("#tabelrencana").DataTable().ajax.reload();
                        $("#tabelpengajuan").DataTable().ajax.reload();
                        $('#btnubahtahun').click();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                        swal({
                            title: textStatus,
                            text:  jqXHR.responseText,
                            type: 'info',
                        });
                    }
                });
            } else {
                swal({
                    title	: 'Warning',
                    text	: 'Akses Terbatas Untuk Waka Kesiswaan dan PJ Kegiatan',
                    type	: 'error',
                });
            }
        });
        $('#btntambahdatarealisasi').click(function () {
            $('#realisasi_id').val('new');
            $("#modalinputdatarealisasi").modal('show');
        });
        $('#btnsimpandatarealisasi').click(function () {
            var set01=document.getElementById('realisasi_id').value;
            var set02=document.getElementById('realisasi_penerima').value;
            var set03=document.getElementById('realisasi_deskripsi').value;
            var set04=document.getElementById('realisasi_tanggal').value;
            var set05=document.getElementById('realisasi_nominal').value;
            var set06=document.getElementById('realisasi_jenis').value;
            var set07=document.getElementById('id_rencana').value;
            var btn = $(this);
                btn.addClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', true);
            var formdata = new FormData();
                formdata.set('id',set01);
                formdata.set('penerima',set02);
                formdata.set('deskripsi',set03);
                formdata.set('tanggal',set04);
                formdata.set('nominal',set05);
                formdata.set('jenis',set06);
                formdata.set('idkegiatan',set07);
                formdata.set('workcode','simpanrealisasi');
                formdata.set('_token', '{{ csrf_token() }}');
            url='{{ route("exSimpanRK") }}';
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
                    var idne    = response.idne;
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
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    $("#modalinputdatarealisasi").modal('hide');
                    $("#gridlaporanspj").jqxGrid("updatebounddata");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    btn.removeClass('fa fa-spinner fa-spin orange bigger-125').attr('disabled', false);
                    swal({
                        title: textStatus,
                        text:  jqXHR.responseText,
                        type: 'info',
                    });
                }
            });
        });
    });
</script>
@endpush