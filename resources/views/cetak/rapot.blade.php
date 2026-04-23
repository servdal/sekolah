<table cellspacing="0" border="0" width="720" id="tabelrapotdinas">
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr>
		<td colspan="8" align="center" valign="top"><b>RAPOR DAN PROFIL PESERTA DIDIK</b></td>
	</tr>
	<tr>
		<td width="100" align="left" valign="top">Nama </td>
		<td width="250" colspan="4" align="left" valign="top"><b> : {!! $rapot->nama !!}</b></td>
		<td width="100" align="left" valign="top">Kelas</td>
		<td width="20" align="left" valign="top">:</td>
		<td width="250" align="left" valign="top" colspan="3">{!! $rapot->kelas !!}</td>
	</tr>
	<tr>
		<td align="left" valign="top">NISN/NIS</td>
		<td colspan="4" align="left" valign="top">: {!! $rapot->nisn !!}</td>
		<td align="left" valign="top">Semester</td>
		<td align="left" valign="top">:</td>
		<td align="left" valign="top">{!! $rapot->semester !!}</td>
	</tr>
	<tr>
		<td align="left" valign="top">Nama Sekolah</td>
		<td colspan="4" align="left" valign="top">: 
			@php 
				if ($sekolah == '' OR is_null($sekolah)){
					echo 'SD Tahfidz Al Quran Daarul Ukhuwwah';
				} else {
					echo $sekolah;
				}

			@endphp
		</td>
		<td align="left" valign="top">Tahun Pelajaran</td>
		<td align="left" valign="top">:</td>
		<td align="left" valign="top">{!! $rapot->tapel !!}</td>
	</tr>
	<tr>
		<td align="left" valign="top">Alamat Sekolah</td>
		<td colspan="7" align="left" valign="top">:
			@php 
				if ($alamat == '' OR is_null($alamat)){
					echo 'Jl. Jagung RT. 03 RW. 05 Dusun Bamban Desa Asrikaton Kecamatan Pakis';
				} else {
					echo $alamat;
				}

			@endphp
		</td>
		</tr>
	<tr>
		<td width="100">&nbsp;</td>
		<td width="20">&nbsp;</td>
		<td width="130">&nbsp;</td>
		<td width="100">&nbsp;</td>
		<td width="20">&nbsp;</td>
		<td width="115">&nbsp;</td>
		<td width="20">&nbsp;</td>
		<td width="115">&nbsp;</td>
	</tr>
	<tr>
		<td width="20" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" bgcolor="#F2F2F2"><b>No</b></td>
		<td width="200" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" bgcolor="#F2F2F2" colspan="3"><b>Mata Pelajaran</b></td>
		<td width="100" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" bgcolor="#F2F2F2"><b>Nilai Akhir</b></td>
		<td width="400" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" bgcolor="#F2F2F2" colspan="3"><b>Capaian Kompetensi</b></td>
	</tr>
	{!! $tabelatas !!}
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" bgcolor="#F2F2F2"><b>No</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" bgcolor="#F2F2F2" colspan="4"><b>Ekstrakulikuler</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" bgcolor="#F2F2F2" colspan="3"><b>Keterangan</b></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" >1</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" colspan="4">{!! $rapot->ekstrakulikuler1 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" colspan="3">{!! $rapot->nildeskripsieks1 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top">2</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" colspan="4">{!! $rapot->ekstrakulikuler2 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" colspan="3">{!! $rapot->nildeskripsieks2 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" >3</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" colspan="4">{!! $rapot->ekstrakulikuler3 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" colspan="3">{!! $rapot->nildeskripsieks3 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" >4</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" colspan="4">{!! $rapot->ekstrakulikuler4 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" colspan="3">{!! $rapot->nildeskripsieks4 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" >5</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" colspan="4">{!! $rapot->ekstrakulikuler5 !!}</td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" colspan="3">{!! $rapot->nildeskripsieks5 !!}</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" bgcolor="#F2F2F2" colspan="8">Catatan Guru :</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000;" align="left" valign="top" >&nbsp;</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="top" colspan="7">{!! $rapot->saran !!}<p>&nbsp;</p></td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr>
		<td style="border-bottom: 1px solid #000000" colspan="4" align="left" valign="top"><b>E.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tinggi dan Berat Badan</b></td>
		<td style="border-bottom: 1px solid #000000" align="left" valign="top">&nbsp;</td>
		<td style="border-bottom: 1px solid #000000" align="left" valign="top">&nbsp;</td>
		<td style="border-bottom: 1px solid #000000" align="left" valign="top">&nbsp;</td>
		<td style="border-bottom: 1px solid #000000" align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td style=" border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan="2" align="center" valign="top" bgcolor="#F2F2F2"><b>No</b></td>
		<td style=" border-bottom: 1px solid #000000; border-right: 1px solid #000000" rowspan="2" colspan="4" align="center" valign="top" bgcolor="#F2F2F2"><b>Kegiatan Fisik</b></td>
		<td style=" border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="3" align="center" valign="top" bgcolor="#F2F2F2"><b>Semester</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" bgcolor="#F2F2F2"><b>1</b></td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" bgcolor="#F2F2F2" colspan="2"><b>2</b></td>
	</tr>
	@if ($rapot->semester == '1' OR $rapot->semester == '1.1' OR $rapot->semester == '1.2')
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" >1</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" colspan="4" valign="top">Tinggi Badan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top">{!! $rapot->tbs1 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" >2</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" colspan="4"  valign="top">Berat Badan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top">{!! $rapot->bbs1 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" colspan="2">&nbsp;</td>
	</tr>
	@else 
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" >1</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" colspan="4" valign="top">Tinggi Badan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top">{!! $rapot->tbs1 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" colspan="2">{!! $rapot->tbs2 !!}</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" >2</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" colspan="4"  valign="top">Berat Badan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top">{!! $rapot->bbs1 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" colspan="2">{!! $rapot->bbs2 !!}</td>
	</tr>
	@endif
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr>
		<td colspan="4" align="left" valign="top"><b>F.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kondisi Kesehatan</b></td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" bgcolor="#F2F2F2"><b>No</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="3" align="center" valign="top" bgcolor="#F2F2F2"><b>Aspek Kesehatan</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="4" align="center" valign="top" bgcolor="#F2F2F2"><b>Keterangan</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" >1</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="3" align="left" valign="top">Pendengaran</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="4" align="center" valign="top">{!! $rapot->pendengaran !!}</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" >2</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="3" align="left" valign="top">Penglihatan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="4" align="center" valign="top">{!! $rapot->penglihatan !!}</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top">3</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="3" align="left" valign="top">Gigi</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="4" align="center" valign="top">{!! $rapot->gigi !!}</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top">4</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="3" align="left" valign="top">Lainnya</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="4" align="center" valign="top">{!! $rapot->kesehatanlain !!}</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr>
		<td colspan="4" align="left" valign="top"><b>G.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Prestasi</b></td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" bgcolor="#F2F2F2"><b>No</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="3" align="center" valign="top" bgcolor="#F2F2F2"><b>Jenis Prestasi</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="4" align="center" valign="top" bgcolor="#F2F2F2"><b>Keterangan</b></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" >1</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="3" align="left" valign="top">{!! $rapot->prestasi1 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="4" align="center" valign="top">{!! $rapot->ketprestasi1 !!}</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top" >2</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="3" align="left" valign="top">{!! $rapot->prestasi2 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="4" align="center" valign="top">{!! $rapot->ketprestasi2 !!}</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top">3</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="3" align="left" valign="top">{!! $rapot->prestasi3 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="4" align="center" valign="top">{!! $rapot->ketprestasi3 !!}</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign="top">4</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="3" align="left" valign="top">{!! $rapot->prestasi4 !!}</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan="4" align="center" valign="top">{!! $rapot->ketprestasi4 !!}</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr>
		<td colspan="4" align="left" valign="top"><b>H.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ketidakhadiran</b></td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan="4" align="center" valign="top" bgcolor="#F2F2F2"><b>Ketidakhadiran</b></td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-left: 1px solid #000000" align="left" valign="top">Sakit</td>
		<td style="border-right: 1px solid #000000" align="left" valign="top" colspan="3">:  {!! $rapot->sakit !!}  hari</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-left: 1px solid #000000" align="left" valign="top">Izin</td>
		<td style="border-right: 1px solid #000000" align="left" valign="top"  colspan="3">:  {!! $rapot->ijin !!}  hari</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="left" valign="top">Tanpa Keterangan</td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000"  colspan="3" align="left" valign="top">:  {!! $rapot->alpha !!}  hari</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8" align="center">Mengetahui :</td></tr>
	<tr>
		<td colspan="5" align="left" valign="top">Orang Tua / Wali</td>
		<td colspan="3" align="center" valign="top">Guru Kelas</td>
	</tr>
	<tr>
		<td colspan="5" align="left" valign="top"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></td>
		<td colspan="3" align="center" valign="top"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></td>
	</tr>
	<tr>
		<td colspan="5" align="left" valign="top">(Tanda tangan dan Nama Terang)</td>
		<td colspan="3" align="center" valign="top">{!! $rapot->namaguru !!}</td>
	</tr>
	<tr>
		<td colspan="5" align="left" valign="top">&nbsp;</td>
		<td colspan="3" align="center" valign="top">{!! $rapot->nipguru !!}</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr>
		<td colspan="8" align="center" valign="top">{!! $rapot->tanggal !!}</td>
	</tr>
	<tr>
		<td colspan="8" align="center" valign="top">Kepala Sekolah</td>
	</tr>
	<tr><td colspan="8" align="center"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></td></tr>
	<tr><td colspan="8" align="center" valign="top"><u>{!! $rapot->namakepalasekolah !!}</u></td></tr>
	<tr><td colspan="8" align="center" valign="top">{!! $rapot->nipkepalasekolah !!} </td></tr>
</table>