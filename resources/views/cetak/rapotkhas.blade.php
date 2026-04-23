@if ($datarapot->id_sekolah == '1')
<table cellpadding="0" cellspacing="0" width="800" id="tabelrapotkhas" style="background-image: url('{{asset('logo/bgrapotsdtq.png')}}'); background-size: contain; resize: both; overflow: scroll;">
@else
<table cellpadding="0" cellspacing="0" width="800" id="tabelrapotkhas" style="background-image: url('{{asset('logo/bgrapotmataba.png')}}'); background-size: contain; resize: both; overflow: scroll;">
@endif
	<tr><td colspan="8"><img src="{{$kopsurat}}" width="100%"></td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr>
		<td width="120" colspan="2" align="left" valign="top">Nama Peserta Didik</td>
		<td width="310" colspan="3" align="left" valign="top"><b> : {!! $datarapot->nama !!}</b></td>
		<td width="120" align="left" valign="top">Kelas</td>
		<td width="20" align="left" valign="top">:</td>
		<td width="150" align="left" valign="top">{!! $datarapot->kelas !!}</td>
	</tr>
	<tr>
		<td colspan="2" align="left" valign="top">No. Induk Siswa</td>
		<td colspan="3" align="left" valign="top">: {!! $datarapot->noinduk !!}</td>
		<td align="left" valign="top">Semester</td>
		<td align="left" valign="top">:</td>
		<td align="left" valign="top">{!! $datarapot->semester !!}</td>
	</tr>
	<tr>
		<td colspan="2" align="left" valign="top">NISN</td>
		<td colspan="3" align="left" valign="top">: {!! $datarapot->nisn !!}</td>
		<td align="left" valign="top">Tahun Pelajaran</td>
		<td align="left" valign="top">:</td>
		<td align="left" valign="top">{!! $datarapot->tapel !!}</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="100">&nbsp;</td>
		<td width="210">&nbsp;</td>
		<td width="50">&nbsp;</td>
		<td width="50">&nbsp;</td>
		<td width="120">&nbsp;</td>
		<td width="20">&nbsp;</td>
		<td width="150">&nbsp;</td>
	</tr>
	<tr><td colspan="8"><strong>A. NILAI MATA PELAJARAN</strong></td></tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td colspan="7">
			<table cellspacing="0" border="1" width="100%">
				<tr>
					<td width="10%" rowspan="3" align="center" bgcolor="#F2F2F2"><strong>No</strong></td>
					<td width="40%" rowspan="3" align="center" bgcolor="#F2F2F2"><strong>Mata Pelajaran</strong></td>
					<td width="10%" rowspan="3" align="center" bgcolor="#F2F2F2"><strong>KKM</strong></td>
					<td width="40%" colspan="3" align="center" bgcolor="#F2F2F2"><strong>Nilai Hasil Belajar</strong></td>
				</tr>
				<tr>
					<td width="60%" colspan="2" align="center" bgcolor="#F2F2F2"><strong>Kognitif</strong></td>
					<td width="40%" align="center" bgcolor="#F2F2F2"><strong>Afektif</strong></td>
				</tr>
				<tr>
					<td width="10%" align="center" bgcolor="#F2F2F2"><strong>Angka</strong></td>
					<td width="60%" align="center" bgcolor="#F2F2F2"><strong>Huruf</strong></td>
					<td width="30%" align="center" bgcolor="#F2F2F2"><strong>Predikat</strong></td>
				</tr>
				@php 
					$total 		= 0;
					$pembagi 	= 0;
				@endphp
				@if(isset($tabelatas) && !empty($tabelatas))
					@foreach($tabelatas as $rows)
						<tr>
							<td align="center">{{$rows['nomor']}}</td>
							<td>{{$rows['matpel']}}</td>
							<td align="center">{{$rows['kkm']}}</td>
							<td align="center">{{$rows['angka']}}</td>
							<td>{{$rows['terbilang']}}</td>
							<td align="center">{{$rows['afektif']}}</td>
						</tr>
						@php
							$total = $total + $rows['angka'];
							$pembagi++;
						@endphp
					@endforeach
					<tr>
						<td align="center" colspan="3"><strong>TOTAL</strong></td>
						<td align="center">{{$totalsum}}</td>
						<td colspan="2">{{$terbilang}}</td>
					</tr>
					<tr>
						<td align="center" colspan="3"><strong>Rata-Rata</strong></td>
						<td align="center" colspan="3">{{$rataakhir}}</td>
					</tr>
				@endif
			</table>
		</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8"><strong>B. AKHLAK MULIA DAN KARAKTER</strong></td></tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td colspan="7">
			{!! $rapotakhlak !!}
		</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8"><strong>C. PENGEMBANGAN DIRI</strong></td></tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td colspan="7">
			<table cellspacing="0" border="1" width="100%">
				<tr>
					<td width="10%" align="center" bgcolor="#F2F2F2"><strong>No</strong></td>
					<td width="50%" align="center" bgcolor="#F2F2F2"><strong>Jenis Kegiatan</strong></td>
					<td width="40%" align="center" bgcolor="#F2F2F2"><strong>Nilai</strong></td>
				</tr>
				<tr>
					<td valign="top" align="center">1</td>
					<td align="left" valign="top">{{$datarapot->ekstrakulikuler1}}</td>
					<td align="left" valign="top">{{$datarapot->nildeskripsieks1}}</td>
				</tr>
				<tr>
					<td valign="top" align="center">2</td>
					<td align="left" valign="top">{{$datarapot->ekstrakulikuler2}}</td>
					<td align="left" valign="top">{{$datarapot->nildeskripsieks2}}</td>
				</tr>
				<tr>
					<td align="center" valign="top">3</td>
					<td align="left" valign="top">{{$datarapot->ekstrakulikuler3}}</td>
					<td align="left" valign="top">{{$datarapot->nildeskripsieks3}}</td>
				</tr>
				<tr>
					<td align="center" valign="top">4</td>
					<td align="left" valign="top">{{$datarapot->ekstrakulikuler4}}</td>
					<td align="left" valign="top">{{$datarapot->nildeskripsieks4}}</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8"><strong>D. TINGGI, BERAT BADAN, DAN KONDISI KESEHATAN</strong></td></tr>
	<tr>
		<td width="50">&nbsp;</td>
		<td colspan="7">
			<table cellspacing="0" border="1" width="100%">
				<tr>
					<td width="10%" align="center" bgcolor="#F2F2F2" rowspan="2"><strong>No</strong></td>
					<td width="50%" align="center" bgcolor="#F2F2F2" rowspan="2"><strong>Jenis Kegiatan</strong></td>
					<td width="40%" align="center" bgcolor="#F2F2F2" colspan="2"><strong>Semester</strong></td>
				</tr>
				<tr>
					<td align="center" bgcolor="#F2F2F2"><strong>I</strong></td>
					<td align="center" bgcolor="#F2F2F2"><strong>II</strong></td>
				</tr>
				@if ($datarapot->semester == '1' OR $datarapot->semester == '1.1' OR $datarapot->semester == '1.2')
					<tr>
						<td align="center">1</td>
						<td>Tinggi Badan</td>
						<td align="center">{{$datarapot->tbs1}} cm</td>
						<td align="center">&nbsp;</td>
					</tr>
					<tr>
						<td align="center">2</td>
						<td>Berat Badan</td>
						<td align="center">{{$datarapot->bbs1}} kg</td>
						<td align="center">&nbsp;</td>
					</tr>
				@else 
					<tr>
						<td align="center">1</td>
						<td>Tinggi Badan</td>
						<td align="center">{{$datarapot->tbs1}} cm</td>
						<td align="center">{{$datarapot->tbs2}} cm</td>
					</tr>
					<tr>
						<td align="center">2</td>
						<td>Berat Badan</td>
						<td align="center">{{$datarapot->bbs1}} kg</td>
						<td align="center">{{$datarapot->bbs1}} kg</td>
					</tr>
				@endif
				<tr>
					<td align="center">3</td>
					<td>Pendengaran</td>
					<td colspan="2">{{$datarapot->pendengaran}}</td>
				</tr>
				<tr>
					<td align="center">4</td>
					<td>Penglihatan</td>
					<td colspan="2">{{$datarapot->penglihatan}}</td>
				</tr>
				<tr>
					<td align="center">5</td>
					<td>Gigi</td>
					<td colspan="2">{{$datarapot->gigi}}</td>
				</tr>
				<tr>
					<td align="center">6</td>
					<td>Lainnya</td>
					<td colspan="2">{{$datarapot->kesehatanlain}}</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8"><strong>E. CATATAN PRESTASI</strong></td></tr>
	<tr>
		<td width="50">&nbsp;</td>
		<td colspan="7">
			<table cellspacing="0" border="1" width="100%">
				<tr>
					<td width="10%" align="center" bgcolor="#F2F2F2"><strong>No</strong></td>
					<td width="50%" align="center" bgcolor="#F2F2F2"><strong>Jenis Kegiatan</strong></td>
					<td width="40%" align="center" bgcolor="#F2F2F2"><strong>Keterangan</strong></td>
				</tr>
				<tr>
					<td valign="top" align="center">1</td>
					<td valign="top">{{$datarapot->prestasi1}}</td>
					<td valign="top">{{$datarapot->ketprestasi1}}</td>
				</tr>
				<tr>
					<td valign="top" align="center">2</td>
					<td valign="top">{{$datarapot->prestasi2}}</td>
					<td valign="top">{{$datarapot->ketprestasi2}}</td>
				</tr>
				<tr>
					<td valign="top" align="center">3</td>
					<td valign="top">{{$datarapot->prestasi3}}</td>
					<td valign="top">{{$datarapot->ketprestasi3}}</td>
				</tr>
				<tr>
					<td valign="top" align="center">4</td>
					<td valign="top">{{$datarapot->prestasi4}}</td>
					<td valign="top">{{$datarapot->ketprestasi4}}</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8"><strong>F. KETIDAKHADIRAN</strong></td></tr>
	<tr>
		<td width="50">&nbsp;</td>
		<td colspan="3">
			<table cellspacing="0" border="1" width="100%">
				<tr>
					<td width="50%"><strong>Sakit</strong></td>
					<td width="50%">{{$datarapot->sakit}} hari</td>
				</tr>
				<tr>
					<td width="50%"><strong>Ijin</strong></td>
					<td width="60%">{{$datarapot->ijin}} hari</td>
				</tr>
				<tr>
					<td width="50%"><strong>Tanpa Keterangan</strong></td>
					<td width="50%">{{$datarapot->alpha}} hari</td>
				</tr>
			</table>
		</td>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8"><strong>F. CATATAN WALI KELAS</strong></td></tr>
	<tr>
		<td width="50">&nbsp;</td>
		<td colspan="7" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000">
			<p>&nbsp;</p>
			{!!$saran!!}
			<p>&nbsp;</p>
		</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8"><strong>F.TANGGAPAN ORANG TUA/ WALI SISWA</strong></td></tr>
	<tr>
		<td width="50">&nbsp;</td>
		<td colspan="7" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000">
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
		</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr>
		<td colspan="5" align="left" valign="top">&nbsp;</td>
		<td colspan="3" align="center" valign="top">Diberikan di {{$sekolah}}</td>
	</tr>
	<tr>
		<td colspan="5" align="left" valign="top">&nbsp;</td>
		<td colspan="3" align="center" valign="top">Malang, {{$tanggal}}</td>
	</tr>
	<tr>
		<td colspan="5" align="left" valign="top">Orang Tua / Wali</td>
		<td colspan="3" align="center" valign="top">Guru Kelas</td>
	</tr>
	<tr>
		<td colspan="5" align="left" valign="top">{!! $ttdortu !!}</td>
		<td colspan="3" align="center" valign="top">{!! $ttdguru !!}</td>
	</tr>
	<tr>
		<td colspan="5" align="left" valign="top">(Tanda tangan dan Nama Terang)</td>
		<td colspan="3" align="center" valign="top">{!! $datarapot->namaguru !!}</td>
	</tr>
	<tr>
		<td colspan="5" align="left" valign="top">&nbsp;</td>
		<td colspan="3" align="center" valign="top">{!! $datarapot->nipguru !!}</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8" align="center">Mengetahui :</td></tr>
	<tr>
		<td colspan="8" align="center" valign="top">Kepala Sekolah</td>
	</tr>
	<tr><td colspan="8" align="center">{!! $ttdkasek !!}</td></tr>
	<tr><td colspan="8" align="center" valign="top"><u>{!! $datarapot->namakepalasekolah !!}</u></td></tr>
	<tr><td colspan="8" align="center" valign="top">{!! $datarapot->nipkepalasekolah !!} </td></tr>
</table>