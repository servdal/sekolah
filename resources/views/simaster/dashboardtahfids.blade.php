@extends('adminlte3.layout')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0"> Tentukan Semester dan Tahun Pelajaran</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-briefcase"></i> Setting</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>TAPEL</label>
                                <input type="text" name="tapel" id="tapel" class="form-control" value="{{$tapel}}" placeholder="gunakan dash sebegai pemisah, ex: xxxx-xxxx">
                                <input type="hidden" name="id_kelas" id="id_kelas" class="form-control" value="{{$setidkelas}}">
                            </div>
                            <div class="form-group">
                                <label>Semester</label>
                                <select id="id_semester" name="id_semester" class="form-control" >
                                    <option value=""></option>
                                    @if ($smt == '1')
                                        <option value="1" selected>Ganjil</option>
                                        <option value="2">Genap</option>
                                    @else
                                        <option value="1">Ganjil</option>
                                        <option value="2" selected>Genap</option>
                                    @endif
                                </select>
                            </div>
						</div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-success" id="simpansetguru">Set Data Anda</button>
					    </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card card-info shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-soccer"></i> Pilih Kelas {{ $tapel }} Semester {{ $smt }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle" id="tabelrps">
                                    <thead>
                                        <tr>
                                            <th>Kelas</th>
                                            <th>Jumlah Peserta</th>
                                            <th>Jumlah Kegiatan</th>
                                            <th>Pendamping Terakhir</th>
                                            <th>Tanggal Terakhir</th>
                                            <th class="cell-fit">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($listkelas) && !empty($listkelas))
                                            @foreach($listkelas as $rows)
                                            <tr>
                                                <td>{{ $rows['klspos'] }}</td>
                                                <td>{{ $rows['peserta'] }}</td>
                                                <td>{{ $rows['kegiatan'] }}</td>
                                                <td>{{ $rows['inputor'] }}</td>
                                                <td>{{ $rows['tanggal'] }}</td>
                                                <td><a href="#" class="btn btn-xs btn-primary pull-right" onClick="gotoPagge('grade{{ $rows['klspos']}}')"><i class="fa fa-plus"></i> Tambah Data</a></td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>-</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>No Data</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
						</div>
                        <div class="card-footer">
                            
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
<input type="hidden" id="mas_semester" name="mas_semester" value="{{ $smt }}">
<input type="hidden" id="mas_tapel" name="mas_tapel" value="{{ $tapel }}">
<input type="hidden" id="mas_niyguru" name="mas_niyguru" value="{{ Session('id') }}">
<input type="hidden" name="idekskul" id="idekskul" value="{{ $masterkls }}">

@endsection
@push('script')
<script>
    function gotoPagge(id) {
        var set01=document.getElementById('id_semester').value;
        var set02=document.getElementById('tapel').value;
        if (set01 == '' || set02 == ''){
            swal({
                title   : 'Stop',
                text    : 'Simpa Semester dan Tapel Terlebih Dahulu',
                type    : 'warning',
            })
        } else {
            var uri = 'tahfidz/'+id;
            window.location=uri
        }
    }
    $(document).ready(function () {
        $('#simpansetguru').click(function () {
            var set01=document.getElementById('id_semester').value;
            var set02=document.getElementById('id_kelas').value;
            var set03='';
            var set04=document.getElementById('tapel').value;
            if (set01 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom Semester Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set02 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom Kelas Terlebih Dahulu',
                    type: 'warning',
                })
            } else if (set04 == ''){
                swal({
                    title: 'Stop',
                    text: 'Isi Kolom TAPEL Terlebih Dahulu',
                    type: 'warning',
                })
            } else {
                $.post('{{ route("exSavesetguru") }}', { val01: set01, val02: set02, val03: set03, val04: set04, _token: token },
                function(data){
                    var uri = window.location.href.split("#")[0];
                    window.location=uri
                });
            }
        });
    });
</script>
@endpush