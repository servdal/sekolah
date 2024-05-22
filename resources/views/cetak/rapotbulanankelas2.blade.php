<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
	<title></title>
	<meta name="generator" content="LibreOffice 5.4.7.2 (Linux)"/>
	<meta name="author" content="Microsoft Office User"/>
	<meta name="created" content="2020-10-23T01:29:33"/>
	<meta name="changedby" content="Microsoft Office User"/>
	<meta name="changed" content="2020-10-23T06:10:46"/>
	<meta name="AppVersion" content="16.0300"/>
	<meta name="DocSecurity" content="0"/>
	<meta name="HyperlinksChanged" content="false"/>
	<meta name="LinksUpToDate" content="false"/>
	<meta name="ScaleCrop" content="false"/>
	<meta name="ShareDoc" content="false"/>
	
	<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Times"; font-size:small }
		a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  } 
		a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  } 
		comment { display:none;  } 
	</style>
</head>
<body style="background-image: url('{{asset('bgrpt.jpg')}}'); background-repeat: no-repeat; background-size:cover;">
<table width="1024" cellspacing="0" border="0">
    <tr><td colspan="7" width="1024">&nbsp;</td></tr>
	<tr><td colspan="7" width="1024">&nbsp;</td></tr>
	<tr><td colspan="7" width="1024">&nbsp;</td></tr>
	<tr><td colspan="7" width="1024">&nbsp;</td></tr>
	<tr><td colspan="7" width="1024">&nbsp;</td></tr>
	<tr><td colspan="7" width="1024">&nbsp;</td></tr>
    <tr><td colspan="7" width="1024">&nbsp;</td></tr>
    <tr><td colspan="7" width="1024">&nbsp;</td></tr>
    <tr>
		<td colspan="7" align="center" valign="middle"><b>LAPORAN CAPAIAN BULANAN</b></td>
	</tr>
	<tr>
		<td colspan="7" align="center" valign="middle"><b>Tahun Ajaran {{$rapot->tapel}}</b></td>
	</tr>
    <tr><td colspan="7" width="1024">&nbsp;</td></tr>
	<tr><td colspan="7" width="1024">&nbsp;</td></tr>
	<tr>
		<td width="70" colspan="2" align="left" valign="top">Nama </td>
		<td width="230" colspan="2" align="left" valign="top"><b> : {!! $rapot->nama !!}</b></td>
		<td width="200" align="left" valign="top">Kelas</td>
		<td width="20" align="center" valign="top">:</td>
		<td width="200" align="left" valign="top">{!! $rapot->kelas !!}</td>
	</tr>
	<tr>
		<td colspan="2" align="left" valign="top">NIS</td>
		<td colspan="2" align="left" valign="top">: {!! $rapot->nis !!}</td>
		<td align="left" valign="top">Semester</td>
		<td align="left" align="center" valign="top">:</td>
		<td align="left" valign="top">{!! $rapot->semester !!}</td>
	</tr>
	<tr>
		<td colspan="2" align="left" valign="top">Alamat Sekolah</td>
		<td colspan="2" align="left" valign="top">: {!! $rapot->alamat !!}</td>
		<td align="left" valign="top">Fase</td>
		<td align="left" align="center" valign="top">:</td>
		<td align="left" valign="top">{!! $rapot->fase !!}</td>
	</tr>
	<tr><td colspan="7" width="1024">&nbsp;</td></tr>
	<tr>
		<td colspan="7" width="1024">
            <table width="1020" border="1" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" width="30"><strong>NO</strong></td>
                    <td colspan="7" align="center" width="990"><strong>PENILAIAN FORMATIF BULAN {!! $rapot->bulan !!}</strong></td>
                </tr>
                <tr>
                    <td align="center" width="30"><strong>A</strong></td>
                    <td align="left" valign="middle" width="200"><strong>MUATAN NASIONAL</strong></td>
                    <td align="center" valign="middle" width="70"><strong>RERATA TUGAS</strong></td>
                    <td align="center" valign="middle" width="110"><strong>KELENGKAPAN TUGAS</strong></td>
                    <td align="center" valign="middle" width="70"><strong>RERATA ULANGAN</strong></td>
                    <td align="center" valign="middle" width="110"><strong>KELENGKAPAN ULANGAN</strong></td>
                </tr>
                <tr>
                    <td align="center" width="30">1</td>
                    <td align="left" valign="middle" width="200">Pendidikan Agama Islam dan Budi Pekerti</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->paitgs }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->paitgsket }}</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->paiuh }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->paiuhket }}</td>
                </tr>
                <tr>
                    <td align="center" width="30">2</td>
                    <td align="left" valign="middle" width="200">Pendidikan Pancasila</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->pptgs }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->pptgsket }}</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->ppuh }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->ppuhket }}</td>
                </tr>
                <tr>
                    <td align="center" width="30">3</td>
                    <td align="left" valign="middle" width="200">Bahasa Indonesia</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->bitgs }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->bitgsket }}</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->biuh }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->biuhket }}</td>
                </tr>
                <tr>
                    <td align="center" width="30">4</td>
                    <td align="left" valign="middle" width="200">Matematika</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->mtktgs }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->mtktgsket }}</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->mtkuh }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->mtkuhket }}</td>
                </tr>
                <tr>
                    <td align="center" width="30">5</td>
                    <td align="left" valign="middle" width="200">Seni Rupa</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->sbdptgs }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->sbdptgsket }}</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->sbdpuh }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->sbdpuhket }}</td>
                </tr>
                <tr>
                    <td align="center" width="30">6</td>
                    <td align="left" valign="middle" width="200">Pendidikan Jasmani, Olahraga dan Kesehatan</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->pjoktgs }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->pjoktgsket }}</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->pjokuh }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->pjokuhket }}</td>
                </tr>
                <tr>
                    <td align="center" width="30">7</td>
                    <td align="left" valign="middle" width="200">Bahasa Inggris</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->bingtgs }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->bingtgsket }}</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->binguh }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->binguhket }}</td>
                </tr>
                <tr>
                    <td align="center" width="30"><strong>B</strong></td>
                    <td align="center" width="200"><strong>MUATAN LOKAL</strong></td>
                    <td colspan="4" align="center" width="540">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center" width="30">8</td>
                    <td align="left" valign="middle" width="200">Bahasa Jawa</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->bjtgs }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->bjtgsket }}</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->bjuh }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->bjuhket }}</td>
                </tr>
                <tr>
                    <td align="center" width="30">9</td>
                    <td align="left" valign="middle" width="200">Bahasa Arab</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->bartgs }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->bartgsket }}</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->baruh }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->baruhket }}</td>
                </tr>
                <tr>
                    <td align="center" width="30">10</td>
                    <td align="left" valign="middle" width="200">Teknologi Informasi dan Teknologi</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->tiktgs }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->tiktgsket }}</td>
                    <td align="center" valign="middle" width="70">{{ $rapot->tikuh }}</td>
                    <td align="center" valign="middle" width="110">{{ $rapot->tikuhket }}</td>
                </tr>
                <tr>
                    <td colspan="6" align="left" width="1020"><strong><i>Note : Bagi siswa yang belum lengkap nilainya, diharapkan secara mandiri dapat konfirmasi melalui wali kelas masing-masing.</i></strong></td>
                </tr>
            </table>
        </td>
	</tr>
    <tr><td colspan="7" width="1024">&nbsp;</td></tr>
    <tr>
		<td width="300" colspan="4" align="left" valign="top">&nbsp;</td>
		<td width="420" colspan="3" align="left" valign="top">{{$rapot->tanggal}}</td>
	</tr>
    <tr>
		<td width="300" colspan="4" align="left" valign="top">Kepala Sekolah</td>
		<td width="420" colspan="3" align="left" valign="top">Wali Kelas {{$rapot->kelas}}</td>
	</tr>
    <tr>
		<td width="300" colspan="4" align="left" valign="top">
        {!! $qrcode !!}
        </td>
		<td width="420" colspan="3" align="left" valign="top">
        {!! $qrcode !!}
        </td>
	</tr>
    <tr>
		<td width="300" colspan="4" align="left" valign="top"><strong><u>{{$rapot->kepsek}}</u></strong></td>
		<td width="420" colspan="3" align="left" valign="top"><strong><u>{{$rapot->walas}}</u></strong></td>
	</tr>
    <tr>
		<td width="300" colspan="4" align="left" valign="top">{{$rapot->niy}}</td>
		<td width="420" colspan="3" align="left" valign="top">{{$rapot->niywalas}}</td>
	</tr>
</table>
</body>
</html>
