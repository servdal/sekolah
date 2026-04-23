<table cellpadding="0" cellspacing="0" width="720" id="tabelrapotkhas" style="background-image: url('{{asset('logo/bgrapotmataba.png')}}'); background-size: contain; resize: both; overflow: scroll;">
	<tr><td colspan="8"><img src="{{$kopsurat}}" width="100%"></td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8" align="center"><h2>PENILAIAN SEMESTER {!! $datarapot->semester !!}</h2></td></tr>
	<tr>
		<td width="300" colspan="2" align="left" valign="top">Nama Santri</td>
		<td width="30" align="left" valign="top">:</td>
		<td width="390" colspan="5" align="left" valign="top">{!! $datarapot->nama !!}</td>
	</tr>
	<tr>
		<td colspan="2" align="left" valign="top">Tempat, Tanggal Lahir</td>
		<td align="left" valign="top">:</td>
		<td align="left" colspan="5" valign="top"> 
			@if ($datarapot->alamat == '' OR $datarapot->alamat == null)
				@php 
					function tgl_indo($tanggal) {
						$bulan = array (
							1 => 'Januari',
							2 => 'Februari',
							3 => 'Maret',
							4 => 'April',
							5 => 'Mei',
							6 => 'Juni',
							7 => 'Juli',
							8 => 'Agustus',
							9 => 'September',
							10 => 'Oktober',
							11 => 'November',
							12 => 'Desember'
						);
						$pecahkan = explode('-', $tanggal);
						if (isset($pecahkan[2])) {
							return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
						} else {
							return $tanggal;
						}
					}
					$noinduk 	= $datarapot->noinduk;
					$id_sekolah = $datarapot->id_sekolah;
					$getdata 	= \App\Datainduk::where('noinduk', $noinduk)->where('id_sekolah', $id_sekolah)->first();
					$tmplahir 	= $getdata->tmplahir ?? '';
					$tgllahir 	= $getdata->tgllahir ?? '';
					echo $tmplahir . ', ' . tgl_indo($tgllahir);
					$tanggal 	= tgl_indo($tanggal);
				@endphp
			@else 
				{!! $datarapot->alamat !!}
			@endif
		</td>
	</tr>
    <tr>
		<td colspan="2" align="left" valign="top">Level / Kelas</td>
		<td align="left" valign="top">:</td>
		<td align="left" colspan="5" valign="top"> {!! $datarapot->kelas !!}</td>
	</tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="180">&nbsp;</td>
		<td width="30">&nbsp;</td>
		<td width="150">&nbsp;</td>
		<td width="50">&nbsp;</td>
		<td width="120">&nbsp;</td>
		<td width="20">&nbsp;</td>
		<td width="150">&nbsp;</td>
	</tr>
    <tr>
		<td width="20">&nbsp;</td>
		<td colspan="7">
			<table cellspacing="0" border="1" width="100%">
				<tr>
					<td width="10%" rowspan="2" align="center" bgcolor="#F2F2F2"><strong>No</strong></td>
					<td width="20%" rowspan="2" align="center" bgcolor="#F2F2F2"><strong>Bidang</strong></td>
					<td width="25%" rowspan="2" align="center" bgcolor="#F2F2F2"><strong>Indikator</strong></td>
					<td width="20%" colspan="4" align="center" bgcolor="#F2F2F2"><strong>Perkembangan</strong></td>
					<td width="25%" rowspan="2" align="center" bgcolor="#F2F2F2"><strong>Deskripsi</strong></td>
				</tr>
                <tr>
					<td align="center" width="5%" bgcolor="#F2F2F2">BB</td>
                    <td align="center" width="5%" bgcolor="#F2F2F2">MB</td>
                    <td align="center" width="5%" bgcolor="#F2F2F2">BSH</td>
                    <td align="center" width="5%" bgcolor="#F2F2F2">BSB</td>
				</tr>
				<tr>
					<td valign="top" align="center">1</td>
					<td valign="top">AL-ISLAM</td>
					<td valign="top">{!!$datarapot->k01!!}</td>
                    @php
                        if ($datarapot->k02 == 'BB'){
                            echo '<td valign="top">&#10004;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td>';
                        } else if ($datarapot->k02 == 'MB'){
                            echo '<td valign="top">&nbsp;</td><td valign="top">&#10004;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td>';
                        } else if ($datarapot->k02 == 'BSH'){
                            echo '<td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&#10004;</td><td valign="top">&nbsp;</td>';
                        } else if ($datarapot->k02 == 'BSB'){
                            echo '<td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&#10004;</td>';
                        } else {
                            echo '<td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td>';
                        }
                    @endphp
					<td valign="top">{!!$datarapot->k03!!}</td>
				</tr>
				<tr>
					<td valign="top" align="center">2</td>
					<td valign="top">KOGNITIF</td>
					<td valign="top">{!!$datarapot->k04!!}</td>
                    @php
                        if ($datarapot->k05 == 'BB'){
                            echo '<td valign="top">&#10004;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td>';
                        } else if ($datarapot->k05 == 'MB'){
                            echo '<td valign="top">&nbsp;</td><td valign="top">&#10004;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td>';
                        } else if ($datarapot->k05 == 'BSH'){
                            echo '<td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&#10004;</td><td valign="top">&nbsp;</td>';
                        } else if ($datarapot->k05 == 'BSB'){
                            echo '<td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&#10004;</td>';
                        } else {
                            echo '<td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td>';
                        }
                    @endphp
					<td valign="top">{!!$datarapot->k06!!}</td>
				</tr>
				<tr>
					<td valign="top" align="center">3</td>
					<td valign="top">BAHASA</td>
					<td valign="top">{!!$datarapot->k07!!}</td>
                    @php
                        if ($datarapot->k08 == 'BB'){
                            echo '<td valign="top">&#10004;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td>';
                        } else if ($datarapot->k08 == 'MB'){
                            echo '<td valign="top">&nbsp;</td><td valign="top">&#10004;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td>';
                        } else if ($datarapot->k08 == 'BSH'){
                            echo '<td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&#10004;</td><td valign="top">&nbsp;</td>';
                        } else if ($datarapot->k08 == 'BSB'){
                            echo '<td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&#10004;</td>';
                        } else {
                            echo '<td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td>';
                        }
                    @endphp
					<td valign="top">{!!$datarapot->k09!!}</td>
				</tr>
                <tr>
					<td valign="top" align="center">4</td>
					<td valign="top">FISIK MOTORIK</td>
					<td valign="top">{!!$datarapot->k10!!}</td>
                    @php
                        if ($datarapot->k11 == 'BB'){
                            echo '<td valign="top">&#10004;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td>';
                        } else if ($datarapot->k11 == 'MB'){
                            echo '<td valign="top">&nbsp;</td><td valign="top">&#10004;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td>';
                        } else if ($datarapot->k11 == 'BSH'){
                            echo '<td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&#10004;</td><td valign="top">&nbsp;</td>';
                        } else if ($datarapot->k11 == 'BSB'){
                            echo '<td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&#10004;</td>';
                        } else {
                            echo '<td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td><td valign="top">&nbsp;</td>';
                        }
                    @endphp
					<td valign="top">{!!$datarapot->k12!!}</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
        <td width="20">&nbsp;</td>
        <td colspan="7">BB : Belum Berkembang</td>
    </tr>
    <tr>
        <td width="20">&nbsp;</td>
        <td colspan="7">MB : Mulai Berkembang</td>
    </tr>
    <tr>
        <td width="20">&nbsp;</td>
        <td colspan="7">BSH : Berkembang Sesuai Harapan</td>
    </tr>
    <tr>
        <td width="20">&nbsp;</td>
        <td colspan="7">BSB: Berkembang Sangat Baik </td>
    </tr>
	<tr>
		<td colspan="5" align="left" valign="top">&nbsp;</td>
		<td colspan="3" align="center" valign="top">Malang, {{$tanggal}}</td>
	</tr>
	<tr>
		<td colspan="5" align="left" valign="top">Direktur TPQ Mataba Daarul Ukhuwwah </td>
		<td colspan="3" align="center" valign="top">Waka Kurikulum TPQ Mataba Daarul Ukhuwwah </td>
	</tr>
	<tr>
		<td colspan="5" align="left" valign="top">{!! $ttdkasek !!}</td>
		<td colspan="3" align="center" valign="top">{!! $ttdguru !!}</td>
	</tr>
	<tr>
		<td colspan="5" align="left" valign="top">{!! $datarapot->namakepalasekolah !!}</td>
		<td colspan="3" align="center" valign="top">{!! $datarapot->namaguru !!}</td>
	</tr>
    <tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>


</table>