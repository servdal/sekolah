<!DOCTYPE HTML>
<html>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style type="text/css" media="print">
	.isi {
		font-family: "Comic Sans MS", cursive;
		font-size: 14px;
	}
	</style>
	</head>
	<body>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-image: url('{{asset('dist/img/logo-gray.jpg')}}'); background-repeat: no-repeat; background-position: center;">
		  <tr>
			<td colspan="3" rowspan="4" align="center" valign="middle" style="border-bottom:double">
				<img src="{{asset('logo.png')}}" width="98" height="75" />
			</td>
			<td colspan="8">{!! $yayasan !!}</td>
		  </tr>
		  <tr>
			<td colspan="8">{!! $sekolah !!}</td>
		  </tr>
		  <tr>
			<td colspan="8">{!! $alamat !!}</td>
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
		  <tr height="20">
			<td colspan="3"><span class="isi">Terima dari </span></td>
			<td colspan="6" style="border-bottom:dotted"><span class="isi">: {!! $nama !!}</span></td>
			<td><span class="isi">Kelas</span></td>
			<td style="border-bottom:dotted"><span class="isi">: {{$kelas}}</span></td>
		  </tr>
		  <tr height="20">
			<td colspan="3"><span class="isi">Uang Sebesar</span></td>
			<td colspan="8" style="border-bottom:dotted"><span class="isi">: {!!$y!!}</span></td>
		  </tr>
		  <tr height="20">
			<td colspan="3"><span class="isi">Bulan Bayar </span></td>
			<td colspan="8" style="border-bottom:dotted"><span class="isi">: {!! $tlsbulan !!}</span></td>
		  </tr>
		  <tr height="20">
			<td><span class="isi">1.</span></td>
			<td colspan="3" align="left"><span class="isi">SPP</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tbiayaspp !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">5.</span></td>
			<td><span class="isi">Buku Tulis</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tbukutulis !!}</td>
		  </tr>
		  <tr height="20">
			<td><span class="isi">2.</span></td>
			<td colspan="3" align="left"><span class="isi">Kegiatan</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tkegiatan !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">6.</span></td>
			<td><span class="isi">Buku Paket</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tbukupaket !!}</td>
		  </tr>
		  <tr height="20">
			<td><span class="isi">3.</span></td>
			<td colspan="3" align="left"><span class="isi">DPP ke</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tbiayadpp !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">7.</span></td>
			<td><span class="isi">Paguyuban</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tpaguyuban !!}</td>
		  </tr>
		  <tr height="20">
			<td><span class="isi">4.</span></td>
			<td width="71" align="left"><span class="isi">Ekskul</span></td>
			<td width="21"><span class="isi">a.</span></td>
			<td style="border-bottom:dotted"><span class="isi">{!! $ekskula !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tekskula2 !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">8.</span></td>
			<td><span class="isi">{!! $lain1 !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tlain1a !!}</td>
		  </tr>
		  <tr height="20">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><span class="isi">b.</span></td>
			<td style="border-bottom:dotted"><span class="isi">{!! $ekskulb !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tekskulb2 !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">9.</span></td>
			<td><span class="isi">{!! $lain2 !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tlain2a !!}</td>
		  </tr>
		  <tr height="20">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><span class="isi">c.</span></td>
			<td style="border-bottom:dotted" ><span class="isi">{!! $ekskulc !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tekskulc2 !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">10.</span></td>
			<td ><span class="isi">{!! $lain3 !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tlain3a !!}</td>
		  </tr>
		  <tr height="20">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><span class="isi">d.</span></td>
			<td style="border-bottom:dotted" ><span class="isi">{!! $ekskuld !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tekskuld2 !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">11.</span></td>
			<td ><span class="isi">{!! $lain4 !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tlain4a !!}</td>
		  </tr>
		  <tr height="20">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><span class="isi">e.</span></td>
			<td style="border-bottom:dotted" ><span class="isi">{!! $ekskule !!}</span></td>
			<td><span class="isi">Rp.</span></td>
			<td style="border-bottom:dotted" align="right">{!! $tekskule2 !!}</td>
			<td>&nbsp;</td>
			<td><span class="isi">&nbsp;</span></td>
			<td ><span class="isi">&nbsp;</span></td>
			<td><span class="isi">&nbsp;</span></td>
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
			<td colspan="3" align="center"><span class="isi">{!! $tanggalctk !!}</span></td>
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
			<td colspan="3" align="center"><span class="isi">Penerima</span></td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td colspan="3" rowspan="2" style="border-bottom:double; border-top:double; border-left:double; border-right:double;" valign="middle" align="center"><span class="isi"><b>Rp. <u>{!! $tulisan !!}</u></b></span></td>
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
		  </tr>
		  <tr>
			<td colspan="6"><span class="isi">{!! $mutiara !!}</span></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="3" style="border-bottom:dotted" align="center"><span class="isi">{!! $asline !!}</span></td>
		  </tr>
		  <tr>
			<td colspan="8"><span class="isi">Mohon Simpan Kwitansi Ini, Sebagai Bukti Fisik Pembayaran.</span></td>
		  </tr>
		</table>
	</body>
</html>