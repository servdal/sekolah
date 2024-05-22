@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Pendaftaran Ekstrakulikuler</h1>
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
                <div class="col-md-8">
                    <div id="message"></div>
                    <div class="error-page">
                        <h2 class="headline text-danger"><i class="fa fa-expeditedssl"></i></h2>
                        <div class="error-content">
                            <h3><strong>Mohon Perhatian</strong></h3>
                            <p></p>
                            Pendaftaran Ekstrakulikuler Siswa Hanya Akan dibuka saat awal semester saja, dan setelah pendaftaran online ditutup wali murid tidak lagi bisa melakukan perubahan terhadap pemilihan ekstrakulikuler dan berlaku 1 tahun ajaran. 
                        </div>
                    </div>
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Rekapitulasi</h3>
                        </div>
                        <div class="card-body">
                            <div id="gridrekapekskul"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title">Daftarkan</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group"> 
                                <label>Pilih Nama Siswa</label>
                                <select id="id_siswa" name="id_siswa" class="form-control" >
                                    <option value="">Pilih salah satu</option>
                                    @foreach($datasiswa as $rsiswa)
                                        <option value="{{ $rsiswa['noinduk'] }}">{{ $rsiswa['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>	
                            <div class="form-group"> 
                                <label>Pilih Ekstrakulikuler</label>
                                <select id="id_ekskul" name="id_ekskul" class="form-control" >
                                    <option value="">Pilih salah satu</option>
                                    @foreach($ekskul as $rekskul)
                                        <option value="{{ $rekskul['nama'] }}">{{ $rekskul['nama'] }} ( Biaya Rp. {{ number_format($rekskul['biaya'], 0 , '.' , ',' ) }} )</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                        <button type="button" class="btn btn-info" id="tambahekskul">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<input type="hidden" id="getaktif" value="{!! $ijin !!}">
<input type="hidden" id="getfoto">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
    function openedpage( jQuery ){
        var set01=document.getElementById('getaktif').value;
        if (set01 == ''){
            var token=document.getElementById('token').value;
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'dot', type: 'text'},
                    { name: 'nama', type: 'text'},
                    { name: 'kelas', type: 'text'},
                    { name: 'noinduk', type: 'text'},
                    { name: 'namaekskul', type: 'text'},
                    { name: 'biaya', type: 'text'},
                    { name: 'kode', type: 'text'},
                ],
                type: 'POST',
                data: {val01: set01, _token: token},
                url: 'json/daftarekskul',
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#gridrekapekskul").jqxGrid({
                width: '100%',
                pageable: true,
                autoheight: true,
                filterable: true,
                sortable: true,
                source: dataAdapter,
                columnsresize: true,
                showfilterrow: true,
                theme: "energyblue",
                altrows: true,
                columns: [
                    { text: 'Nama Siswa', datafield: 'nama', width: '40%', align: 'center' },					
                    { text: 'No.Induk', datafield: 'noinduk', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Kelas', datafield: 'kelas', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Ekstrakulikuler', datafield: 'namaekskul', width: '20%', cellsalign: 'left', align: 'center' },					
                    { text: 'Biaya', datafield: 'biaya', width: '10%', cellsalign: 'center', align: 'center' },
                    { text: 'Batalkan', editable: false, sortable: false, filterable: false, columntype: 'button', width: '10%', cellsrenderer: function () {
                        return "Batalkan";
                        }, buttonclick: function (row) {
                            editrow = row;	
                            var offset 		= $("#gridrekapekskul").offset();		
                            var dataRecord 	= $("#gridrekapekskul").jqxGrid('getrowdata', editrow);
                            swal({
                                title: 'Apakah anda yakin ?',
                                text: "Perhatian, data yang sudah di hapus tidak bisa di Undo, apakah anda yakin ingin menghapus",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonClass: 'btn btn-confirm mt-2',
                                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                                confirmButtonText: 'Yes'
                            }).then(function () {
                                var set01		= dataRecord.dot;
                                var set02		= 'ekstrakulikuler';
                                var set03		= dataRecord.noinduk;
                                $.post('admin/destroyer', { val01: set01, val02: set02, val03: set03, _token: token },
                                    function(data){
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
                                        $("#gridrekapekskul").jqxGrid('updatebounddata');
                                        return false;
                                });
                            });
                        }
                    },
                ]
            });
        } else {
            $(".shadow").hide();
        }
    }
    window.onload = openedpage;
    $(document).ready(function () {
        $("#tambahekskul").click(function(){
            var val01=document.getElementById('id_ekskul').value;
            var val02=document.getElementById('id_siswa').value;
            var token=document.getElementById('token').value;
            $.post('ortu/daftarekskul', { set01: val01, set02: val02, _token: token },
            function(data){
                $("#message").html(data);
                openedpage();
                return false;
            });	
        });	
    });
</script>
@endpush