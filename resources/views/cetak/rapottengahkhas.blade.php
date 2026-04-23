<table cellspacing="0" border="0" width="800" id="tabelrapotdinas">
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
	<tr><td colspan="8"><strong>B. KETIDAKHADIRAN</strong></td></tr>
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
	<tr><td colspan="8"><strong>C. CATATAN WALI KELAS</strong></td></tr>
	<tr>
		<td width="50">&nbsp;</td>
		<td colspan="7" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000">
			<p>&nbsp;</p>
			{!!$saran!!}
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
		<td colspan="5" align="left" valign="top"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></td>
		<td colspan="3" align="center" valign="top"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></td>
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
	<tr><td colspan="8" align="center"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p></td></tr>
	<tr><td colspan="8" align="center" valign="top"><u>{!! $datarapot->namakepalasekolah !!}</u></td></tr>
	<tr><td colspan="8" align="center" valign="top">{!! $datarapot->nipkepalasekolah !!} </td></tr>
</table>