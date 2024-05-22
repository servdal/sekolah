<!DOCTYPE HTML>
<html>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style type="text/css" media="print">
	.isi {
		font-family: "Comic Sans MS", cursive;
		font-size: 14px;
	}
	.kotak {
		border: thin solid #000;
	}
	table.background { 
		background: url("dist/img/logo-gray.jpg") no-repeat;	
		background-position:center;		
	}
	</style>
	</head>
	<body>
		@if ($status != 'verified')
		<table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-image: url('{{asset('dist/img/logo-gray.jpg')}}'); background-repeat: no-repeat; background-position: center;">
		  <tr>
			<td colspan="3" rowspan="7" align="center" valign="middle" style="border-bottom:double"><img src="{!! $logo !!}" width="98" height="75" /></td>
			<td colspan="8"><b>{!! $yayasan !!}</b></td>
		  </tr>
		  <tr>
			<td colspan="8"><b>{!! $sekolah !!}</b></td>
		  </tr>
		  <tr>
			<td colspan="8"><b>Terakreditasi A</b></td>
		  </tr>
		  <tr>
			<td colspan="8">{!! config('global.nomerinduksekolah') !!}</td>
		  </tr>
		  <tr>
			<td colspan="8">{!! $alamat !!}</td>
		  </tr>
		  <tr>
			<td colspan="8">{!! config('global.email') !!}</td>
		  </tr>
		  <tr>
			<td width="157" style="border-bottom:double">&nbsp;</td>
			<td width="26" style="border-bottom:double">&nbsp;</td>
			<td width="87" style="border-bottom:double">&nbsp;</td>
			<td width="22" style="border-bottom:double">&nbsp;</td>
			<td width="25" style="border-bottom:double">&nbsp;</td>
			<td width="198" style="border-bottom:double">&nbsp;</td>
			<td width="39" style="border-bottom:double">&nbsp;</td>
			<td width="129" style="border-bottom:double">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="11" style="border-bottom:double; border-top:double; border-left:double; border-right:double;"><font size="+2" color="red">MOHON MAAF, DATA ANDA MASIH MENUNGGU VERIFIKASI DARI ADMIN SEKOLAH, MOHON BERSABAR SEJENAK</font></td>
		  </tr>
		</table>';
		@else
		<table width="800" border="0" cellpadding="0" cellspacing="0" class="background" id="printiki">
		  <tr>
			<td colspan="8" align="left" valign="middle"><font size="+2" color="#0000FF">E-CARD / KARTU ELEKTRONIK</font></td>
			<td>&nbsp;</td>
			<td align="left" valign="middle">&nbsp;</td>
			<td rowspan="8" align="left" valign="middle"><img src="../dist/img/berkas/{!! $scanfoto !!}" width="100%"/></td>
		  </tr>
		  <tr>
			<td colspan="8" align="left" valign="middle">Peserta Ujian Seleksi Masuk Siswa Baru</td>
			<td>&nbsp;</td>
			<td align="left" valign="middle">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="8" align="left" valign="middle"><b>{!! $yayasan !!}</b></td>
			<td align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="8" align="left" valign="middle"><b>{!! $sekolah !!}</b></td>
			<td align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="8" align="left" valign="middle"><strong>P2DB Tahun Pelajaran {!! $datapsb->tamasuk !!}</strong></td>
			<td align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="6" rowspan="3" align="center" valign="middle"><img src="{{asset('ppdb-sdtq.png')}}" width="340" height="70" /></td>
			<td colspan="4" align="center"><strong><font color="#0000FF">{!! $datapsb->nama !!}</font></strong></td>
		  </tr>
		  <tr>
			<td colspan="4" align="center">No. Peserta</td>
		  </tr>
		  <tr>
			<td colspan="4" align="center"><strong><font color="#0000FF">{!! $datapsb->kodependaf !!}</font></strong></td>
		  </tr>
		   <tr>
			<td colspan="3" align="center" valign="middle"><strong>{!! $periodepsb !!}</strong></td>
			<td align="left" valign="middle">&nbsp;</td>
			<td align="left" valign="middle">&nbsp;</td>
			<td align="left" valign="middle">&nbsp;</td>
			<td colspan="4" align="center" valign="middle">&nbsp;</td>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="3" align="center" valign="middle">{!! $kodepsb !!}</td>
			<td align="left" valign="middle">&nbsp;</td>
			<td align="left" valign="middle">&nbsp;</td>
			<td align="left" valign="middle">&nbsp;</td>
			<td colspan="4" align="center" valign="middle">&nbsp;</td>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="3" rowspan="4" align="center" valign="middle">{!! $qrcode !!}</td>
			<td align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td colspan="4" align="center" valign="middle">&nbsp;</td>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="5" rowspan="3" align="center"style="border-bottom:double; border-top:double; border-left:double; border-right:double;"><font color="#999999">ttd<br />Penguji</font></td>
			<td align="center">&nbsp;</td>
			<td colspan="2" rowspan="3" align="center"style="border-bottom:double; border-top:double; border-left:double; border-right:double;"><font color="#999999">ttd<br />Peserta</font></td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="3" align="center" valign="middle" style="border-bottom:double">&nbsp;</td>
			<td width="21" style="border-bottom:double">&nbsp;</td>
			<td width="33" style="border-bottom:double">&nbsp;</td>
			<td width="17" style="border-bottom:double">&nbsp;</td>
			<td width="61" style="border-bottom:double">&nbsp;</td>
			<td width="60" style="border-bottom:double">&nbsp;</td>
			<td width="92" style="border-bottom:double">&nbsp;</td>
			<td width="79" style="border-bottom:double">&nbsp;</td>
			<td width="160" style="border-bottom:double">&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="11" style="border-bottom:double" align="center"><strong>JADWAL UJIAN</strong></td>
		  </tr>
		  <tr>
			<td colspan="11">
			{!! $jadwalujian !!}
			</td>
		</tr>
		</table>
		@endif
	</body>
</html>