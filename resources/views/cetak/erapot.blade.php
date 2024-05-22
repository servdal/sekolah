<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>{!! config('global.Title') !!}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta content="{!! config('global.sekolah') !!}" name="description" />
        <meta content="{!! config('global.kota') !!}" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="icon" type="image/ico" href="{!! config('global.logoapss') !!}">
        @include('base.partials.css')
    </head>
	<body class="hold-transition skin-purple layout-top-nav" style="background-image: url('{{asset('dist/img/mrin/bgimage.png')}}'); background-repeat: no-repeat; background-position: center;">
		<div class="wrapper" >
			<div class="content-wrapper">
				<section class="content" >
					<div class="row">
						<div class="col-md-12">
							<div class="box box-widget widget-user">
								<div class="widget-user-header bg-black" style="background: url('{{asset('dist/img/mrin/bgimage.png')}}') center center;">
								  <h3 class="widget-user-username">ELektronik Rapot</h3>
								  <a href="/"><h5 class="widget-user-desc">{!! config('global.sekolah') !!}</h5></a>
								</div>
								<div class="widget-user-image">
									<img class="img-circle" src="{{asset('dist/img/logo.png')}}" alt="{!! config('global.sekolah') !!}">
								</div>
								<div class="box-footer">
									<div class="row invoice-info">
										<div class="col-sm-6 invoice-col">
										  <strong>{!! $rapot->NAMA !!}</strong>
										  <address>
											<p><strong>{!! $rapot->NISN !!}</strong></p>
										  </address>
										</div>
										<div class="col-sm-6 invoice-col">
										  {!! $rapot->JENIS !!} KELAS {{$rapot->KELAS}}
										  <address>
											<p><strong> {!! $rapot->SEMESTER !!} {!! $rapot->TAPEL !!}</strong></p>
										  </address>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
                        <div id="divawal">
                            <div class="col-md-4">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <i class="fa fa-pie-chart"></i>
                                        <h3 class="box-title">Statistik KI3 dan KI4</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="box-body">
                                            <div id='grafiksebaran' style="width:100%; height:320px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                        <i class="fa fa-bar-chart"></i>
                                        <h3 class="box-title">Statistik Matpel</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="box-body">
                                            <div id='grafiksebaranperjenis' style="width:100%; height:320px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                        <i class="fa fa-clipboard"></i>
                                        <h3 class="box-title">Report</h3>
                                        <div class="box-tools pull-right">
                                            <a href="{{$alamatcetak}}"><button class="btn btn-box-tool"><i class="fa fa-print"></i></button></a>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div style="overflow-y: auto; height:460px; ">
                                            <table cellspacing="0" border="0" class="table table-stripped" width="100%">
                                                <colgroup width="85"></colgroup>
                                                <colgroup width="329"></colgroup>
                                                <colgroup width="87"></colgroup>
                                                <colgroup span="2" width="85"></colgroup>
                                                <colgroup width="112"></colgroup>
                                                <colgroup width="61"></colgroup>
                                                <colgroup width="146"></colgroup>
                                                <tr>
                                                    <td colspan=8 height="21" align="left" valign=middle><b>A.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kompetensi Sikap</b></td>
                                                    </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="21" align="center" valign=middle bgcolor="#F2F2F2"><b>Aspek</b></td>
                                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#F2F2F2"><b>Predikat</b></td>
                                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=middle bgcolor="#F2F2F2"><b>Deskripsi</b></td>
                                                    </tr>
                                                <tr>
                                                    <td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="39" align="left" valign=middle>1.&nbsp;&nbsp; Sikap Spiritual</td>
                                                    <td style="border-right: 1px solid #000000" colspan=2 align="center" valign=middle>{!! $rapot->SSP !!}</td>
                                                    <td style="border-right: 1px solid #000000" colspan=4 align="left" valign=middle>{!! $rapot->DES !!}</td>
                                                    </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="39" align="left" valign=middle>2.&nbsp;&nbsp; Sikap Sosial</td>
                                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle>{!! $rapot->SS !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="left" valign=middle>{!! $rapot->DES2 !!}</td>
                                                    </tr>
                                                <tr>
                                                    <td height="21" align="left" valign=middle><b>&nbsp;</b></td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan=8 height="23" align="left" valign=middle><b>B.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kompetensi Pengetahuan dan Keterampilan</b></td>
                                                    </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 height="45" align="center" valign=middle bgcolor="#F2F2F2"><b>No</b></td>
                                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#F2F2F2"><b>Muatan Pelajaran</b></td>
                                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#F2F2F2"><b>Pengetahuan</b></td>
                                                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#F2F2F2"><b>Keterampilan</b></td>
                                                    </tr>
                                                <tr>
                                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Nilai</td>
                                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Predikat</td>
                                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Deskripsi</td>
                                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Nilai</td>
                                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Predikat</td>
                                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Deskripsi</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-left: 1px solid #000000; border-right: 1px solid #000000" height="47" align="center" valign=middle sdval="1" >1</td>
                                                    <td style="border-right: 1px solid #000000" align="left" valign=middle>Pendidikan Agama Islam dan Budi Pekerti</td>
                                                    <td style="border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->PAI3 !!}</td>
                                                    <td style="border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H !!}</td>
                                                    <td style="border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D !!}</td>
                                                    <td style="border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->PAI4 !!}</td>
                                                    <td style="border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H2 !!}</td>
                                                    <td style="border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D2 !!}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign=middle >2</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Pendidikan Pancasila dan Kewarganegaraan</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->PPKN3 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H3 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D3 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->PPKN4 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H4 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D4 !!}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle >3</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Bahasa Indonesia</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BI3 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H5 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D5 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BI4 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H6 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D6 !!}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign=middle >4</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Matematika</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->MAT3 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H7 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D7 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->MAT4 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H8 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D8 !!}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle >5</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Ilmu Pengetahuan Alam</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->IPA3 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H9 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D9 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->IPA4 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H10 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D10 !!}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle >6</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Ilmu Pengetahuan Sosial</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->IPS3 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H11 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D11 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->IPS4 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H12 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D12 !!}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle >7</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Seni Budaya dan Prakarya</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->SBDP3 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H13 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D13 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->SBDP4 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H14 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D14 !!}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign=middle >8</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>Pendidikan Jasmani, Olahraga dan Kesehatan</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->PJOK3 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H15 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D15 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->PJOK4 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H16 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D16 !!}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign=middle bgcolor="#F2F2F2" >9</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#F2F2F2">Muatan Lokal</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Nilai</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Predikat</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Deskripsi</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Nilai</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Predikat</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F2F2F2">Deskripsi</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle >&nbsp;</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>a. Bahasa Jawa</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BJ3 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H17 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D17 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BJ4 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H18 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D18 !!}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="left" valign=middle >&nbsp;</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>b. Bahasa Inggris</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BING3 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H19 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D19 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BING4 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H20 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D20 !!}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle >&nbsp;</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>c. Bahasa Arab</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BA3 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H21 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D21 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->BA4 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H22 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D22 !!}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="left" valign=middle >&nbsp;</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>d. Teknologi </td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->TIK3 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H23 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D23 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->TIK4 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle>{!! $rapot->H24 !!}</td>
                                                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>{!! $rapot->D24 !!}</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle >&nbsp;</td>
                                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=top>&nbsp;</td>
                                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>&nbsp;</td>
                                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>&nbsp;</td>
                                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>&nbsp;</td>
                                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>&nbsp;</td>
                                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>&nbsp;</td>
                                                    <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="21" align="left" valign=middle >&nbsp;</td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                    <td align="left" valign=bottom>&nbsp;</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="divrincian">
                            <div class="col-md-12">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <i class="fa fa-tasks"></i>
                                        <h3 class="box-title">Tabel Detail Data Penilaian Siswa</h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" id="btnkembali"><i class="fa fa-close"></i></button>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body no-padding">
                                        <div class="box-body">
                                            <div id="griddetail"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</section>
			</div>
			<footer class="main-footer">
                <div class="pull-right hidden-xs">
                <b>{!! config('global.namaapps') !!}</b>
                </div>
                <strong>Copyright &copy; 2019 <a href="{!! config('global.homeweb') !!}">{!! config('global.sekolah') !!}</a>.</strong> All rights reserved.
            </footer>
		</div>
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <input type="hidden" name="setidrapot" id="setidrapot" value="{{$idrapot}}">
		@include('base.partials.js')
        <script>
            function openedpage( jQuery ){
                var set01=document.getElementById('setidrapot').value;
                var token=document.getElementById('token').value;
                var sourcegrafik = {
                    datatype: "json",
                    datafields: [
                        { name: 'jenis' },				
		            	{ name: 'jumlah' },
                    ],
                    type: 'POST',
                    data: {val01: set01, _token: token},
                    url: '../rapot/getstatkd',
                };
                var datajrekap		= new $.jqx.dataAdapter(sourcegrafik);
                var settinggrafik 	= {
                    title: "Statistik",
                    description: "KI3 vs KI4",
                    enableAnimations: true,		
                    showBorderLine: true,
                    colorScheme: 'scheme03',
                    padding: { left: 5, top: 5, right: 5, bottom: 5 },
                    titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },		
                    source: datajrekap,
                    seriesGroups:
                    [
                        {
                            type: 'pie',
                            showLabels: true,
                            series:
                            [
                                {
                                    dataField: 'jumlah',
                                    displayText: 'jenis',
                                    labelRadius: 100,
                                    initialAngle: 15,
                                    radius: 90,
                                    centerOffset: 0,
                                    formatSettings: { decimalPlaces: 1 }
                                }
                            ]
                        }
                    ]
                };
                $('#grafiksebaran').jqxChart(settinggrafik);

                var source2 = {
                    datatype: "json",
                    datafields: [
                        { name: 'jenis' },				
		            	{ name: 'jumlah3' },
                        { name: 'jumlah4' },
                    ],
                    type: 'POST',
                    data: {val01: set01, _token: token},
                    url: '../rapot/getstatpermuatan',
                };
                var datajrekap2		= new $.jqx.dataAdapter(source2);
                var settinggrafik2 = {
                    title: "Statistik",
                    description: "Per Matapelajar",		
                    enableAnimations: true,		
                    titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
                    source: datajrekap2,
                    xAxis:
                        {
                            dataField: 'jenis',
                            displayText: 'Matapelajaran',
                            gridLines: { visible: true },
                            valuesOnTicks: false
                        },
                    colorScheme: 'scheme01',
                    columnSeriesOverlap: false,
                    seriesGroups:
                        [
                            {
                                type: 'column',
                                valueAxis:
                                {
                                    visible: true,
                                    title: { text: 'Nilai<br>' }
                                },
                                series: [
                                        { dataField: 'jumlah3', displayText: 'Rata-Rata KI3' },	
                                        { dataField: 'jumlah4', displayText: 'Rata-Rata KI4' },							
                                    ]
                            }				
                        ]
                };
                $('#grafiksebaranperjenis').jqxChart(settinggrafik2);
                
            }
            $(window).load(openedpage);
            $(document).ready(function() {
                $('#divrincian').hide();
                $('#btnkembali').click(function () {
                    $('#divawal').show();
                    $('#divrincian').hide();
                });
                
            });
        </script>
	</body>
</html>
