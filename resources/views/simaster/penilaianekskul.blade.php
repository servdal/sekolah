@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Penilaian Ekstrakulikuler</h1>
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
            <div class="row">
                <div class="col-md-12">
                    <div id="message"></div>
                    <div class="card card-danger shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Tabel</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="gridekskul"></div>
						</div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div id="tempatctk" style="overflow: hidden; display: none;">
	<div id="tabel_cetak"></div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        var sourceeksul = {
            datatype: "json",
            datafields: [
                { name: 'id'},
                { name: 'namaeksul', type: 'text'},
                { name: 'biaya', type: 'text'},
                { name: 'peminat', type: 'text'},
            ],
            updaterow: function (rowid, rowdata, commit) {
                commit(true);
            },
            url: 'json/ekskul',
            cache: false
        };
        var dataekskul = new $.jqx.dataAdapter(sourceeksul);
        $("#gridekskul").jqxGrid({
            width           : '100%',
            autoheight      : true,
            source          : dataekskul,
            theme           : "energyblue",
            selectionmode   : 'multiplecellsextended',
            columns         : [
                { text: 'Nama Ekskul', datafield: 'namaeksul', width: '50%', align: 'center', cellsalign: 'left'},
                { text: 'Peminat', datafield: 'peminat', width: '30%', align: 'center', cellsalign: 'left'},
                { text: 'Set', editable: false, sortable: false, filterable: false, align: 'center',  columntype: 'button', width: '20%', cellsrenderer: function () {
                    return "Presensi dan Nilai";
                    }, buttonclick: function (row) {
                        editrow = row;
                        var offset 		= $("#gridekskul").offset();
                        var dataRecord 	= $("#gridekskul").jqxGrid('getrowdata', editrow);
                        var url 		= "{{URL::to("/")}}/nilekskul/"+dataRecord.id;
                        window.location.replace(url);
                    }
                },
            ]
        });
    });
</script>
@endpush