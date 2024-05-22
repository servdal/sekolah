<style type="text/css">
/*
 * Component: Timeline
 * -------------------
 */
.timeline {
  position: relative;
  margin: 0 0 30px 0;
  padding: 0;
  list-style: none;
}
.timeline:before {
  content: '';
  position: absolute;
  top: 0px;
  bottom: 0;
  width: 4px;
  background: #ddd;
  left: 31px;
  margin: 0;
  border-radius: 2px;
}
.timeline > li {
  position: relative;
  margin-right: 10px;
  margin-bottom: 15px;
}
.timeline > li:before,
.timeline > li:after {
  content: " ";
  display: table;
}
.timeline > li:after {
  clear: both;
}
.timeline > li > .timeline-item {
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  border-radius: 3px;
  margin-top: 0px;
  background: #fff;
  color: #444;
  margin-left: 60px;
  margin-right: 15px;
  padding: 0;
  position: relative;
}
.timeline > li > .timeline-item > .time {
  color: #999;
  float: right;
  padding: 10px;
  font-size: 12px;
}
.timeline > li > .timeline-item > .timeline-header {
  margin: 0;
  color: #555;
  border-bottom: 1px solid #f4f4f4;
  padding: 10px;
  font-size: 16px;
  line-height: 1.1;
}
.timeline > li > .timeline-item > .timeline-header > a {
  font-weight: 600;
}
.timeline > li > .timeline-item > .timeline-body,
.timeline > li > .timeline-item > .timeline-footer {
  padding: 10px;
}
.timeline > li.time-label > span {
  font-weight: 600;
  padding: 5px;
  display: inline-block;
  background-color: #fff;
  border-radius: 4px;
}
.timeline > li > .fa,
.timeline > li > .glyphicon,
.timeline > li > .ion {
  width: 30px;
  height: 30px;
  font-size: 15px;
  line-height: 30px;
  position: absolute;
  color: #666;
  background: #d2d6de;
  border-radius: 50%;
  text-align: center;
  left: 18px;
  top: 0;
}

.pojokkananatas {
	border-top-width: thin;
	border-left-width: thin;	
	border-top-style: solid;
	border-left-style: solid;		
	border-top-color: #000;
	border-left-color: #000;	
}
.atas {
	border-top-width: thin;
	border-top-style: solid;
	border-top-color: #000;
}
.pojokkanan {
	border-top-width: thin;
	border-right-width: thin;
	border-top-style: solid;
	border-right-style: solid;
	border-top-color: #000;
	border-right-color: #000;
}
.fullkotak {
	border: thin solid #000;
}
.kiri {
	border-left-width: thin;
	border-left-style: solid;
	border-left-color: #000;
}
.kanan {
	border-right-width: thin;
	border-right-style: solid;
	border-right-color: #000;
}
.bawah {
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #000;
}
</style>
<table width="800" border="0" cellpadding="0" cellspacing="0" class="table table-stripped" style='background: url("{!! $logo_grey !!}") no-repeat; background-position:center;'>
  <tr>
    <td colspan="3" rowspan="4" align="center" valign="middle" style="border-bottom:double"><img src="{!! $logo !!}" width="98" height="75" /></td>
    <td colspan="8">{!! $rsetting->nama_yayasan !!}</td>
  </tr>
  <tr>
    <td colspan="8">{!! $rsetting->nama_sekolah !!}</td>
  </tr>
  <tr>
    <td colspan="8">{!! $rsetting->alamat !!}</td>
  </tr>
  <tr>
    <td width="113" style="border-bottom:double">&nbsp;</td>
    <td width="114" style="border-bottom:double">&nbsp;</td>
    <td width="74" style="border-bottom:double">&nbsp;</td>
    <td width="15" style="border-bottom:double">&nbsp;</td>
    <td width="69" style="border-bottom:double">&nbsp;</td>
    <td width="31" style="border-bottom:double">&nbsp;</td>
    <td width="51" style="border-bottom:double">&nbsp;</td>
    <td width="165" style="border-bottom:double">&nbsp;</td>
  </tr>
  <tr height="20">
    <td colspan="3"><span class="isi">Nama Siswa</span></td>
    <td colspan="6" style="border-bottom:dotted"><span class="isi">: {{$nama}}</span></td>
    <td><span class="isi">Kelas</span></td>
    <td style="border-bottom:dotted"><span class="isi">: {{$kelas}}</span></td>
  </tr>
  <tr height="20">
    <td colspan="3"><span class="isi">Nama Orang Tua/Wali</span></td>
    <td colspan="8" style="border-bottom:dotted"><span class="isi">: {{$namawali}}</span></td>
  </tr>
  <tr height="20">
	<td width="40"><span class="isi">1.</span></td>
	<td colspan="6" align="left"><span class="isi">Zakat Fitrah ( {{$jeniszakat}} ) Untuk {{$orang}} Orang @ {{ $satuan }}</span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>Rp</td>
	<td style="border-bottom:dotted" align="right">{{$nominal}}</td>
  </tr>
  <tr height="20">
    <td>2.</td>
    <td colspan="8">Zakat Maal</td>
    <td>Rp.</td>
    <td style="border-bottom:dotted" align="right">{{$zakatmaal}}</td>
  </tr>
  <tr height="20">
    <td>3. </td>
    <td colspan="8">Donasi</td>
    <td>Rp.</td>
    <td style="border-bottom:dotted" align="right">{{$donasi}}</td>
  </tr>
  <tr height="20">
    <td>&nbsp;</td>
    <td colspan="8">&nbsp;</td>
    <td>&nbsp;</td>
    <td style="border-bottom:dotted" align="right">&nbsp;</td>
  </tr>
  <tr height="20">
    <td>&nbsp;</td>
    <td colspan="8">&nbsp;</td>
    <td>&nbsp;</td>
    <td style="border-bottom:dotted" align="right">&nbsp;</td>
  </tr>
  <tr height="20">
    <td>&nbsp;</td>
    <td colspan="8">Total</td>
    <td>Rp.</td>
    <td style="border-bottom:dotted" align="right">{{$total}}</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4" rowspan="3">Terbilang : <br /><b>{{$terbilang}}</b></td>
    <td colspan="3" rowspan="8">{!!$qrcode!!}</td>
    <td colspan="3" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" align="center"><span class="isi">{{$tglvalidasi}}</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3" align="center"><span class="isi">Penerima</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" rowspan="2" style="border-bottom:double; border-top:double; border-left:double; border-right:double;" valign="middle" align="center"><span class="isi"><b><u>Rp. {{$total}}</u></b></span></td>
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
  </tr>
  <tr>
    <td colspan="5" align="center"class="isi">{!! $rsetting->slogan !!}<td>
    <td colspan="3" style="border-bottom:dotted" align="center" class="isi">{{$validator}}</td>
  </tr>
  <tr>
    <td colspan="5" class="isi" align="center">Mohon Simpan Kwitansi Ini, Sebagai Bukti Fisik Pembayaran.</td>
  </tr>
</table>