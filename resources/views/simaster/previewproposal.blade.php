@extends('adminlte3.layoutstandart')
@section('content')
<div class="content-wrapper" >
    <div class="content-header">
      <div class="container">
        
      </div>
    </div>
    <div class="content" >
        <div class="container-fluid">
            <div class="row" >
                <div class="col-md-8">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-success">
                            <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{!! $fotoks !!}" alt="User Avatar">
                            </div>
                            <h3 class="widget-user-username">Laporan Kegiatan</h3>
                            <h5 class="widget-user-desc">{{$datakegiatan->namakegiatan}}</h5>
                        </div>
                    </div>
                    <div class="card card-body">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link navlinkother" href="#depan" data-toggle="tab">Teks Proposal</a></li>
                                    <li class="nav-item"><a class="nav-link navlinkother" href="#formonline" data-toggle="tab">RAB</a></li>
                                    <li class="nav-item"><a class="nav-link navlinkother" href="#laporankeuangan" data-toggle="tab">Laporan Keuangan</a></li>
                                    <li class="nav-item"><a class="nav-link navlinkother active" href="#telemedicine" data-toggle="tab">Identitas Proposal</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane" id="depan">
                                        <div class="card">
                                            <div class="card-body p-0">
                                            {!! $teksproposal !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="formonline">
                                        <div class="card">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-striped table-valign-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>Deskripsi</th>
                                                            <th class="text-truncate">Anggaran di Ajukan</th>
                                                            <th class="text-truncate">Angggaran di Setujui</th>
                                                            <th class="text-truncate">Bendahara</th>
                                                            <th class="text-truncate">Catatan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(isset($markingteksrab) && !empty($markingteksrab))
                                                            @php 
                                                            $total = 0;
                                                            @endphp
                                                            @foreach($markingteksrab as $rows)
                                                                <tr>
                                                                    <td>{{ $rows['deskripsi'] }}</td>
                                                                    <td align="right">
                                                                        @php
                                                                            $anggaran = $rows['anggaran'];
                                                                            $anggaran = number_format( $anggaran , 0 , '.' , ',' );
                                                                            echo $anggaran;
                                                                        @endphp
                                                                    </td>
                                                                    <td align="right">
                                                                        @php
                                                                            $disetujui  = $rows['disetujui'];
                                                                            $total      = $total + $disetujui;
                                                                            $disetujui  = number_format( $disetujui , 0 , '.' , ',' );
                                                                            echo $disetujui;
                                                                        @endphp
                                                                    </td>
                                                                    <td>{{ $rows['bendahara'] }}</td>
                                                                    <td>{{ $rows['keterangan'] }}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                    <td colspan="2"><strong>TOTAL YANG DI SETUJUI</strong></td>
                                                                    <td align="right">
                                                                        @php
                                                                            $total  = number_format( $total , 0 , '.' , ',' );
                                                                            echo $total;
                                                                        @endphp
                                                                    </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="laporankeuangan">
                                        <div class="card">
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-striped table-valign-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>Tanggal</th>
                                                            <th>Deskripsi</th>
                                                            <th>Penerima</th>
                                                            <th class="text-truncate">Pemasukan</th>
                                                            <th class="text-truncate">Pengeluaran</th>
                                                            <th class="text-truncate">Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(isset($datakeuangan) && !empty($datakeuangan))
                                                            @php 
                                                            $total      = 0;
                                                            $sumpemasukan  = 0;
                                                            $sumpengeluaran= 0;
                                                            @endphp
                                                            @foreach($datakeuangan as $rows)
                                                                <tr>
                                                                    <td>{{ $rows['tanggal'] }}</td>
                                                                    <td>{{ $rows['deskripsi'] }}</td>
                                                                    <td>{{ $rows['penerima'] }}</td>
                                                                    <td align="right">
                                                                        @php
                                                                            $pemasukan      = $rows['pemasukan'];
                                                                            $sumpemasukan   = $sumpemasukan + $pemasukan;
                                                                            $pemasukan      = number_format( $pemasukan , 0 , '.' , ',' );
                                                                            echo $pemasukan;
                                                                        @endphp
                                                                    </td>
                                                                    <td align="right">
                                                                        @php
                                                                            $pengeluaran    = $rows['pengeluaran'];
                                                                            $sumpengeluaran = $sumpengeluaran + $pengeluaran;
                                                                            $pengeluaran    = number_format( $pengeluaran , 0 , '.' , ',' );
                                                                            echo $pengeluaran;
                                                                        @endphp
                                                                    </td>
                                                                    <td>{{ $rows['keterangan'] }}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                    <td colspan="3"><strong>TOTAL </strong></td>
                                                                    <td align="right">
                                                                        @php
                                                                            $total = $sumpemasukan - $sumpengeluaran;
                                                                            $sumpemasukan  = number_format( $sumpemasukan , 0 , '.' , ',' );
                                                                            echo $sumpemasukan;
                                                                        @endphp
                                                                    </td>
                                                                    <td align="right">
                                                                        @php
                                                                            $sumpengeluaran  = number_format( $sumpengeluaran , 0 , '.' , ',' );
                                                                            echo $sumpengeluaran;
                                                                        @endphp
                                                                    </td>
                                                                    <td align="right">
                                                                        @php
                                                                            $total  = number_format( $total , 0 , '.' , ',' );
                                                                            echo $total;
                                                                        @endphp
                                                                    </td>
                                                                </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="active tab-pane" id="telemedicine">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nama Kegiatan:</label>
                                                    <div class="col-sm-8">
                                                        {{$datakegiatan->namakegiatan}}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Deskripsi:</label>
                                                    <div class="col-sm-8">
                                                        {{$datakegiatan->deskripsi}}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">PJ Kegiatan:</label>
                                                    <div class="col-sm-8">
                                                        {{$datakegiatan->penanggunggjawab}}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Catatan Bendahara:</label>
                                                    <div class="col-sm-8">
                                                        {{$datakegiatan->bendahara}}<br />{{$datakegiatan->catatanbendahara}}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Pelaksanaan:</label>
                                                    <div class="col-sm-8">
                                                        {{$datakegiatan->mulai}} s/d {{$datakegiatan->akhir}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Persetujuan KS</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="timeline-body">
                                <img src="{!! $ttdks !!}" width="100%"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection

