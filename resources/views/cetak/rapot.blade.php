<table cellspacing="0" border="0" style="background-image: url('{{ $background }}'); background-repeat: no-repeat; background-position: center;">
	<colgroup width="85"></colgroup>
	<colgroup width="329"></colgroup>
	<colgroup width="87"></colgroup>
	<colgroup span="2" width="85"></colgroup>
	<colgroup width="112"></colgroup>
	<colgroup width="61"></colgroup>
	<colgroup width="146"></colgroup>
	<tr><td colspan="8">{!! $kopsurat !!}</td></tr>
	<tr>
		<td colspan=8 height="24" align="center" valign="middle"><b>RAPOR DAN PROFIL PESERTA DIDIK</b></td>
	</tr>
	<tr>
		<td height="21" align="left" valign="middle">Nama </td>
		<td colspan=4 align="left" valign="middle"><b> : {!! $rapot->nama !!}</b></td>
		<td align="left" valign="middle">Kelas</td>
		<td align="left" valign="middle">:</td>
		<td align="left" valign="middle" colspan="3">{!! $rapot->kelas !!}</td>
	</tr>
	<tr>
		<td height="21" align="left" valign="middle">NISN/NIS</td>
		<td colspan=4 align="left" valign="middle">: {!! $rapot->nisn !!}</td>
		<td align="left" valign="middle">Semester</td>
		<td align="left" valign="middle">:</td>
		<td align="left" valign="middle">{!! $rapot->semester !!}</td>
	</tr>
	<tr>
		<td height="21" align="left" valign="middle">Nama Sekolah</td>
		<td colspan=4 align="left" valign="middle">: {!! $sekolah !!}</td>
		<td align="left" valign="middle">Tahun Pelajaran</td>
		<td align="left" valign="middle">:</td>
		<td align="left" valign="middle">{!! $rapot->tapel !!}</td>
	</tr>
	<tr>
		<td height="21" align="left" valign="middle">Alamat Sekolah</td>
		<td colspan=7 align="left" valign="middle">: {!! $alamat !!}</td>
		</tr>
	<tr>
		<td height="21" align="justify" valign="middle">&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="45" align="center" valign="middle" bgcolor="#F2F2F2"><b>No</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#F2F2F2" colspan="3"><b>Mata Pelajaran</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#F2F2F2"><b>Nilai Akhir</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#F2F2F2" colspan="3"><b>Capaian Kompetensi</b></td>
	</tr>
	<tr>
		<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" height="47" align="center" valign="middle" sdval="1">1</td>
		<td style="border-right: 1px solid #000000" align="left" valign="middle" colspan="3">{!! $rapot->h01 !!}</td>
		<td style="border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->n01 !!}</td>
		<td style="border-right: 1px solid #000000" align="left" valign="middle" colspan="3">{!! $rapot->k01 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign="middle" >2</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="3">{!! $rapot->h02 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->n02 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->k02 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign="middle" >3</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="3">{!! $rapot->h03 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->n03 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->k03 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign="middle" >4</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="3">{!! $rapot->h04 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->n04 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->k04 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign="middle" >5</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="3">{!! $rapot->h05 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->n05 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->k05 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign="middle" >6</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="3">{!! $rapot->h06 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->n06 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->k06 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign="middle" >7</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="3">{!! $rapot->h07 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->n07 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->k07 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign="middle" >8</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="3">{!! $rapot->h08 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->n08 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->k08 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;" height="23" align="left" valign="middle" bgcolor="#F2F2F2" colspan="8">Muatan Lokal</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign="middle" >&nbsp;</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="3">a. Bahasa Jawa</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->n30 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->k30 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="left" valign="middle" >&nbsp;</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="3">b. Bahasa Inggris</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->n29 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->k29 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign="middle" >&nbsp;</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="3">c. Bahasa Arab</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->n28 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->k28 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="left" valign="middle" >&nbsp;</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="3">d. Teknologi </td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->n27 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->k27 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="45" align="center" valign="middle" bgcolor="#F2F2F2"><b>No</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#F2F2F2" colspan="4"><b>Ekstrakulikuler</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#F2F2F2" colspan="3"><b>Keterangan</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="left" valign="middle" >1</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="4">{!! $rapot->ekstrakulikuler1 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->nildeskripsieks1 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="left" valign="middle">2</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="4">{!! $rapot->ekstrakulikuler2 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->nildeskripsieks2 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="left" valign="middle" >3</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="4">{!! $rapot->ekstrakulikuler3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->nildeskripsieks3 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="left" valign="middle" >4</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="4">{!! $rapot->ekstrakulikuler4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->nildeskripsieks4 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="left" valign="middle" >5</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="4">{!! $rapot->ekstrakulikuler5 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" colspan="3">{!! $rapot->nildeskripsieks5 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign="middle" bgcolor="#F2F2F2" colspan="8">Catatan Guru</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign="middle" >&nbsp;</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" colspan="7">{!! $rapot->saran !!}</td>
	</tr>
	<tr>
		<td height="21" align="left" valign="middle" >&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign="middle">&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000" colspan=4 height="23" align="left" valign="middle"><b>E.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tinggi dan Berat Badan</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style=" border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 height="45" align="center" valign="middle" bgcolor="#F2F2F2"><b>No</b></td>
		<td style=" border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign="middle" bgcolor="#F2F2F2"><b>Kegiatan Fisik</b></td>
		<td style=" border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign="middle" bgcolor="#F2F2F2"><b>Semester</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#F2F2F2" sdval="1" sdnum="1033;"><b>1</b></td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#F2F2F2" sdval="2" sdnum="1033;"><b>2</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign="middle" >1</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle">Tinggi Badan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->tbs1 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->tbs2 !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign="middle" >2</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle">Berat Badan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->bbs1 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle">{!! $rapot->bbs2 !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="justify" valign="middle">&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="justify" valign="middle">&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=4 height="23" align="left" valign="middle"><b>F.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kondisi Kesehatan</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign="middle" bgcolor="#F2F2F2"><b>No</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#F2F2F2"><b>Aspek Kesehatan</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign="middle" bgcolor="#F2F2F2"><b>Keterangan</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign="middle" >1</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle">Pendengaran</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign="middle">{!! $rapot->pendengaran !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign="middle" >2</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle">Penglihatan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign="middle">{!! $rapot->penglihatan !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign="middle">3</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle">Gigi</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign="middle">{!! $rapot->gigi !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign="middle">4</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle">Lainnya</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign="middle">{!! $rapot->kesehatanlain !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign="middle">&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign="middle">&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign="middle">&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=4 height="23" align="left" valign="middle"><b>G.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Prestasi</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="39" align="center" valign="middle" bgcolor="#F2F2F2"><b>No</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="middle" bgcolor="#F2F2F2"><b>Jenis Prestasi</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign="middle" bgcolor="#F2F2F2"><b>Keterangan</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign="middle" >1</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle">{!! $rapot->prestasi1 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign="middle">{!! $rapot->ketprestasi1 !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign="middle" >2</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle">{!! $rapot->prestasi2 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign="middle">{!! $rapot->ketprestasi2 !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign="middle">3</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle">{!! $rapot->prestasi3 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign="middle">{!! $rapot->ketprestasi3 !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="center" valign="middle">4</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle">{!! $rapot->prestasi4 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign="middle">{!! $rapot->ketprestasi4 !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign="middle">&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign="middle">&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=4 height="23" align="left" valign="middle"><b>H.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ketidakhadiran</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="23" align="center" valign="middle" bgcolor="#F2F2F2"><b>Ketidakhadiran</b></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-left: 1px solid #000000" height="37" align="left" valign="middle">Sakit</td>
		<td style="border-right: 1px solid #000000" align="left" valign="middle">:  {!! $rapot->sakit !!}  hari</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-left: 1px solid #000000" height="37" align="left" valign="middle">Izin</td>
		<td style="border-right: 1px solid #000000" align="left" valign="middle">:  {!! $rapot->ijin !!}  hari</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" height="57" align="left" valign="middle">Tanpa Keterangan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle">:  {!! $rapot->alpha !!}  hari</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign="middle">Mengetahui :</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign="middle">Orang Tua / Wali</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td colspan=3 align="center" valign=bottom>Guru Kelas</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td style="border-bottom: 1px solid #000000" colspan=3 align="center" valign=bottom>{!! $rapot->namaguru !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="center" valign=bottom>(Tanda tangan dan Nama Terang)</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td style="border-top: 1px solid #000000" colspan=3 align="center" valign=bottom>NIY. {{$rapot->nipguru}}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=6 height="21" align="center" valign=bottom>{!! $rapot->tanggal !!}</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=6 height="21" align="center" valign=bottom>Kepala Sekolah</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td height="21" align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=6 height="21" align="center" valign=bottom><u>{!! $rapot->namakepalasekolah !!}</u></td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
	<tr>
		<td colspan=6 height="21" align="center" valign=bottom>{!! $rapot->nipkepalasekolah !!} </td>
		<td align="left" valign=bottom>&nbsp;</td>
		<td align="left" valign=bottom>&nbsp;</td>
	</tr>
</table>