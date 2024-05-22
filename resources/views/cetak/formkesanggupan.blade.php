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
		<table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-image: url('{{asset('dist/img/logo-gray.jpg')}}'); background-repeat: no-repeat; background-position: center;">
		  <tr>
			<td colspan="3" rowspan="9" align="left" valign="top" style="border-bottom:double"><img src="{!! $logo !!}" width="120" height="120" /></td>
			<td colspan="6">&nbsp;</td>
			<td colspan="2" rowspan="2" align="center" valign="middle" style="border-bottom:double; border-top:double; border-left:double; border-right:double;"><strong>{!! $datapsb->kodependaf !!}</strong></td>
		  </tr>
		  <tr>
			<td colspan="6">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="8" align="center"><b>{!! $yayasan !!}</b></td>
		  </tr>
		  <tr>
			<td colspan="8" align="center"><b>{!! $sekolah !!}</b></td>
		  </tr>
		  <tr>
			<td colspan="8" align="center"><strong>PANITIA PENERIMAAN PESERTA  DIDIK BARU (P2DB)</strong></td>
		  </tr>
		  <tr>
			<td colspan="8" align="center">{!! config('global.nomerinduksekolah') !!}</td>
		  </tr>
		  <tr>
			<td colspan="8" align="center"><strong>{!! $alamat !!}</strong></td>
		  </tr>
		  <tr>
			<td colspan="8" align="center">{!! config('global.email') !!}</td>
		  </tr>
		  <tr>
			<td width="21" style="border-bottom:double">&nbsp;</td>
			<td width="33" style="border-bottom:double">&nbsp;</td>
			<td width="56" style="border-bottom:double">&nbsp;</td>
			<td width="22" style="border-bottom:double">&nbsp;</td>
			<td width="25" style="border-bottom:double">&nbsp;</td>
			<td width="198" style="border-bottom:double">&nbsp;</td>
			<td width="39" style="border-bottom:double">&nbsp;</td>
			<td width="129" style="border-bottom:double">&nbsp;</td>
		  </tr>
		  <tr>
			<td width="22">&nbsp;</td>
			<td width="44">&nbsp;</td>
			<td width="211">&nbsp;</td>
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
			 <td colspan="11"><p align="center"><strong><u>SURAT</u></strong><strong><u> PERNYATAAN KESANGGUPAN</u></strong></p></td>
		   </tr>
		   <tr>
			 <td colspan="11" align="center"><strong>P2DB Tahun Pelajaran {!! $datapsb->tamasuk !!}</strong></td>
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
			 <td colspan="11"><p>Yang bertanda tangan di bawah ini : </p></td>
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
			 <td colspan="3" valign="top">Nama Murid</td>
			 <td valign="top">:</td>
			 <td colspan="6" valign="top">{!! $datapsb->nama !!}</td>
		   </tr>
		   <tr>
			 <td>&nbsp;</td>
			 <td colspan="3" valign="top">Orang tua/Wali Murid</td>
			 <td valign="top">:</td>
			 <td colspan="6" valign="top">{!! $datapsb->namaayah !!} / {!! $datapsb->namaibu !!}</td>
		   </tr>
		   <tr>
			 <td >&nbsp;</td>
			 <td colspan="3">Alamat</td>
			 <td>:</td>
			 <td colspan="6">{!! $datapsb->alamatortu !!}</td>
		   </tr>
		   <tr>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td colspan="2">RT / RW</td>
			 <td>: </td>
			 <td colspan="3">{!! $datapsb->erte !!} / {!! $datapsb->erwe !!}</td>
		   </tr>
		   <tr>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td colspan="2">Kelurahan</td>
			 <td>:</td>
			 <td colspan="3">{!! $datapsb->kelurahan !!}</td>
		   </tr>
		   <tr>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td colspan="2">Kecamatan </td>
			 <td>:</td>
			 <td colspan="3">{!! $datapsb->kecamatan !!}</td>
		   </tr>
		   <tr>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td colspan="2">Kota</td>
			 <td>:</td>
			 <td colspan="3">{!! $datapsb->kota !!} {!! $datapsb->kodepos !!}</td>
		   </tr>
		   <tr>
			 <td>&nbsp;</td>
			 <td colspan="3">No. Telepon / H.P.</td>
			 <td>:</td>
			 <td colspan="6">{!! $datapsb->telpon !!} / {!! $datapsb->hape !!}</td>
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
			 <td colspan="11">Menyatakan dengan sesungguhnya, sebagai rasa syukur kehadirat Allah  SWT, atas diterimanya Putra / Putri kami  di {!! $sekolah !!} {!! config('global.kota') !!} dan dengan  ucapan <em>Bismillahirrahmanirrahim<strong>, </strong></em>secara tulus ikhlas, kami bersedia memberikan Infaq sebagai amal jariyah kami, sebesar </td>
		   </tr>
		   <tr>
			 <td>1.</td>
			 <td colspan="2">Iuran Bulanan *</td>
			 <td>:</td>
			 <td style="border-bottom:double; border-top:double; border-left:double; border-right:double;">&nbsp;</td>
			 <td colspan="6">&nbsp;&nbsp;1. Rp. {!! $byrspp1 !!},-</td>
		   </tr>
		   <tr>
			 <td>&nbsp;</td>
			 <td colspan="2">&nbsp;</td>
			 <td>:</td>
			 <td style="border-bottom:double; border-top:double; border-left:double; border-right:double;">&nbsp;</td>
			 <td colspan="6">&nbsp;&nbsp;2. Rp. {!! $byrspp2 !!},-</td>
		   </tr>
		   <tr>
			 <td>&nbsp;</td>
			 <td colspan="2">&nbsp;</td>
			 <td>:</td>
			 <td style="border-bottom:double; border-top:double; border-left:double; border-right:double;">&nbsp;</td>
			 <td colspan="6">&nbsp;&nbsp;3. Rp. {!! $byrspp3 !!},-</td>
		   </tr>
		   <tr>
			 <td>&nbsp;</td>
			 <td colspan="2">&nbsp;</td>
			 <td>:</td>
			 <td style="border-bottom:double; border-top:double; border-left:double; border-right:double;">&nbsp;</td>
			 <td colspan="6">&nbsp;&nbsp;4. Rp. .................................................... [ &gt;  Rp. {!! $byrspp3 !!},-  ]</td>
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
			 <td>2.</td>
			 <td colspan="2">Dana Pengembangan Pendidikan *</td>
			 <td>:</td>
			 <td style="border-bottom:double; border-top:double; border-left:double; border-right:double;">&nbsp;</td>
			 <td colspan="6">&nbsp;&nbsp;1. Rp. {!! $byrdpp1 !!},-</td>
		   </tr>
		   <tr>
			 <td>&nbsp;</td>
			 <td colspan="2">&nbsp;</td>
			 <td>:</td>
			 <td style="border-bottom:double; border-top:double; border-left:double; border-right:double;">&nbsp;</td>
			 <td colspan="6">&nbsp;&nbsp;2. Rp. {!! $byrdpp2 !!},-</td>
		   </tr>
		   <tr>
			 <td>&nbsp;</td>
			 <td colspan="2">&nbsp;</td>
			 <td>:</td>
			 <td style="border-bottom:double; border-top:double; border-left:double; border-right:double;">&nbsp;</td>
			 <td colspan="6">&nbsp;&nbsp;3. Rp. .................................................... [ &gt; Rp. {!! $byrdpp2 !!},-  ]</td>
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
			 <td colspan="11">Sumbangan pembangunan tersebut kami bayar pada saat daftar ulang.</td>
		   </tr>
		   <tr>
			 <td colspan="11"><p>Demikian pernyataan kami, mudah-mudahan membawa berkah bagi pendidikan anak kami.</p>
			 <em>Amin ya robbal&rsquo;alamin.</em>.</td>
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
			 <td colspan="5">Mengetahui,</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td colspan="4">{!! config('global.kota') !!}, ......................................... {!! $tahun !!}</td>
		   </tr>
		   <tr>
			 <td colspan="5">Kepala Sekolah</td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td colspan="4">Yang menyatakan,</td>
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
			 <td colspan="5"><strong>{!! $kepalasekolah !!}</strong></td>
			 <td>&nbsp;</td>
			 <td>&nbsp;</td>
			 <td colspan="4">.................................................................</td>
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
			 <td colspan="11" align="center">Menyetujui,</td>
		   </tr>
		   <tr>
			 <td colspan="11" align="center">{!! $jabketyayasan !!},</td>
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
			 <td colspan="11" align="center"><strong><u>{!! $ketuayayasan !!}</u></strong></td>
		   </tr>
		   <tr>
			 <td colspan="5">*Diberi tanda centang ( &#10004;  )</td>
			 <td colspan="6" align="right">{!! $periode !!}</td>
		   </tr>
		</table>
	</body>
</html>