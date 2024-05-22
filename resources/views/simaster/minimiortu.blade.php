@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Perpustakaan Mini</h1>
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
                        <div id="gridperpustakaan"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        var sourcebuku = {
            datatype: "json",
            datafields: [
                { name: 'idne', type: 'text'},
                { name: 'judul', type: 'text'},
                { name: 'gambar', type: 'text'},
                { name: 'link', type: 'text'},
            ],
            url: 'json/jsonbuku',
            cache: false
        };
        var databuku = new $.jqx.dataAdapter(sourcebuku);
        var photorenderer = function (row, column, value) {
            var name = $('#gridperpustakaan').jqxGrid('getrowdata', row).gambar;	
            var img = '<div style="background: white;"><img style="margin:2px; margin-left: 10px;" width="40" height="40" src="' + name + '"></div>';
            return img;
        }
        var linkrenderer = function (row, column, value) {
            if (value.indexOf('#') != -1) {
                value = value.substring(0, value.indexOf('#'));
            }
            var format = { target: '"_blank"' };
            var html = $.jqx.dataFormat.formatlink(value, format);
            return html;
        }
        $("#gridperpustakaan").jqxGrid({
            width: '100%',
            rowsheight: 50,
            filterable: true,  
            autoheight: true,
            source: databuku,
            theme: "energyblue",
            selectionmode: 'multiplecellsextended',
            columns: [			
                { text: 'Cover', width: '10%', cellsalign: 'center', cellsrenderer: photorenderer },
                { text: 'Judul', datafield: 'judul', width: '40%', align: 'center' },
                { text: 'Link', datafield: 'link', width: '50%', align: 'center', cellsrenderer: linkrenderer },
            ]
        });
    });
</script>
@endpush