@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Laporan Penilaian Harian Siswa</h1>
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
            <div class="row" >
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-body">
                            <div id="message"></div>
                            <div id="divawal">
                                <div id="gridnilaianak"></div>
                            </div>
                            <div id="divpermohonanremidi">
                                <div class="form-group"> 
                                    <label>Pilih Nama Siswa</label>
                                    <select id="id_siswa" name="id_siswa" class="form-control" >
                                        <option value="">Pilih Siswa</option>
                                        @foreach($datasiswa as $rsiswa)
                                            <option value="{{ $rsiswa['noinduk'] }}">{{ $rsiswa['nama'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Jenis Nilai</label>
                                            <input type="text" id="id_jenis" class="form-control" disabled="disable">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Mata Pelajaran</label>
                                            <input type="text" id="id_matpel" class="form-control" disabled="disable">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label>Memohon dengan hormat adanya remidi nilai anak kami, dengan pertimbangan sebagai berikut :</label>
                                    <textarea id="id_alasan" rows="10" cols="80"></textarea>
                                </div>
                                <div class="form-group"> 
                                    <label>Pemohon</label>
                                    <input type="text" id="id_pemohon" class="form-control" placeholder="Nama Lengkap Orang Tua/Wali" value="{!! Session('nama') !!}">
                                </div>
                                <div class="form-group"> 
                                    <label>Tanda Tangan Orang Tua</label>
                                </div>
                                <div class="kotakttd">
                                    <img src="dist/img/boxed-bg.jpg" width=320 height=200 />	
                                    <canvas id="id_ttd" class="signature-pad" width=320 height=200></canvas>
                                    <canvas id="id_ttdblank" class="signature-pad" width=320 height=200 style='display:none'></canvas>
                                    <button type="button" class="btn btn-info" id="btnclearttd">Clear</button>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="id_idne" class="form-control" disabled="disable">
                                    <button type="button" class="btn btn-success pull-right" id="btnsimpanttd">Simpan</button>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
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
@endsection
@push('script')
<script src="{{ asset('plugins/signature_pad/signature_pad.js') }}"></script>
<script type="text/javascript">
    $(function () {
		CKEDITOR.env.isCompatible = true;
		CKEDITOR.replace( 'id_alasan', {
			toolbarGroups: [{"name":"paragraph","groups":["list"]}],
			removeButtons: 'Strike',
			width: '100%',
			height: 90	
		});
	});
    $(document).ready(function () {
        $('.overlay').hide();
        $('#divpermohonanremidi').hide();
            var ttdPad = new SignaturePad(document.getElementById('id_ttd'), {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 0)'
        });
        $('#btnsimpanttd').on('click', function (){		
            var set01 = ttdPad.toDataURL('image/png');
            if (set01 == document.getElementById('id_ttdblank').toDataURL()){ set01 = ''; }
            var set02 = '';
            var set03 = document.getElementById('id_siswa').value;
            var set04 = document.getElementById('id_jenis').value;
            var set05 = document.getElementById('id_idne').value;
            var set06 = CKEDITOR.instances['id_alasan'].getData()
            var set07 = document.getElementById('id_pemohon').value;
            var token = document.getElementById('token').value;
            if (set01 == ''){
                swal({
                    title: 'Stop',
                    text: 'Mohon Tanda Tangani Surat Anda',
                    type: 'warning',
                })
            }
            else if (set03 == ''){
                swal({
                    title: 'Stop',
                    text: 'Mohon Pilih Siswa Terlebih Dahulu',
                    type: 'warning',
                })
            }		
            else if (set06 == ''){ 
                swal({
                    title: 'Stop',
                    text: 'Alasan Permohonan Remidi Wajib di Cantumkan',
                    type: 'warning',
                })
            }
            else if (set07 == ''){ 
                swal({
                    title: 'Stop',
                    text: 'Nama Lengkap Pemohon Wajib di Cantumkan',
                    type: 'warning',
                })
            }
            else {
                $.post('ortu/exsimpanmhnremidi', { val01: set01, val02: set02, val03: set03, val04: set04, val05: set05, val06: set06, val07: set07, _token: token },
                function(data){
                    $('#message').html(data);
                    ttdPad.clear();
                    $('#divpermohonanremidi').hide();
                    $('#divawal').show();
                    return false;       
                });
            }
        });
        $('#btnclearttd').on('click', function (){		
            ttdPad.clear();
        });
        var sourcenilai = {
            datatype: "json",
            datafields: [
                { name: 'id',type: 'text'},	
                { name: 'nama',type: 'text'},
                { name: 'noinduk',type: 'text'},
                { name: 'kelas',type: 'text'},	
                { name: 'tapel',type: 'text'},
                { name: 'semester',type: 'text'},
                { name: 'tema',type: 'text'},
                { name: 'subtema',type: 'text'},
                { name: 'kodekd',type: 'text'},
                { name: 'matpel',type: 'text'},
                { name: 'nilai',type: 'text'},
                { name: 'ratakelas',type: 'text'},
                { name: 'guru',type: 'text'},
                { name: 'tanggal',type: 'text'},
                { name: 'jennilai',type: 'text'},
            ],
            url: 'ortu/nilaisiswa',
            cache: false,
        };
        var datanilai = new $.jqx.dataAdapter(sourcenilai);
        $("#gridnilaianak").jqxGrid({
            width           : '100%',
            columnsresize   : true,
            theme           : "energyblue",
            autoheight      : true,
            altrows         : true,
            filterable      : true,
            filtermode      : 'excel',
            source          : datanilai,
            selectionmode   : 'singlecell',
            columns         : [
                { text: 'Permohonan', columntype: 'button', width: '8%', cellsrenderer: function () {
                    return "REMIDI";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridnilaianak").offset();
                        var dataRecord 	= $("#gridnilaianak").jqxGrid('getrowdata', editrow);
                        $("#id_idne").val(dataRecord.id);
                        $("#id_siswa").val(dataRecord.noinduk);
                        $("#id_jenis").val(dataRecord.jennilai);
                        $("#id_matpel").val(dataRecord.matpel);
                        $('#divpermohonanremidi').show();
                        $('#divawal').hide();
                    }
                },
                { text: 'Tanggal', datafield: 'tanggal', width: '7%', align: 'center' },
                { text: 'Nama', datafield: 'nama', width: '15%', align: 'center' },
                { text: 'TAPEL', datafield: 'tapel', width: '8%', cellsalign: 'right', align: 'center'},
                { text: 'KELAS', datafield: 'kelas', width: '7%', cellsalign: 'center', align: 'center'},
                { text: 'SMT', datafield: 'semester', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'TEMA', datafield: 'tema', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'SUBTEMA', datafield: 'subtema', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'MATPEL', datafield: 'matpel', width: '10%', cellsalign: 'left', align: 'center'},
                { text: 'JENIS', datafield: 'jennilai', width: '10%', cellsalign: 'center', align: 'center'},
                { text: 'NILAI', datafield: 'nilai', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'RATAKELAS', datafield: 'ratakelas', width: '5%', cellsalign: 'center', align: 'center'},
                { text: 'GURU', datafield: 'guru', width: '10%', cellsalign: 'center', align: 'center'},
            ],
        });
    });
</script>
@endpush