@if ($id_sekolah == '1')
<table cellpadding="0" cellspacing="0" width="720" id="tabelrapotalquran" style="background-image: url('{{asset('logo/bgrapotsdtq.png')}}'); background-size: contain; resize: both; overflow: scroll;">
@else
<table cellpadding="0" cellspacing="0" width="720" id="tabelrapotalquran" style="background-image: url('{{asset('logo/bgrapotmataba.png')}}'); background-size: contain; resize: both; overflow: scroll;">
@endif
@php 
    $getdata1 	= \App\Dataindukstaff::where('niy', $niykasek)->first();
    $kelamin1 	= $getdata1->kelamin ?? 'L';
    if ($kelamin1 == 'L'){
        $kasek = 'Al Ustadz '.$kasek;
    } else {
        $kasek = 'Al Ustadzah '.$kasek;
    }
    $getdata2 	= \App\Dataindukstaff::where('niy', $niywaka)->first();
    $kelamin2 	= $getdata2->kelamin ?? 'L';
    if ($kelamin2 == 'L'){
        $waka = 'Al Ustadz '.$waka;
    } else {
        $waka = 'Al Ustadzah '.$waka;
    }
    $namaguru   = str_replace('Al Ustadz ', '', $namaguru);
    $namaguru   = str_replace('Al Ustadzah ', '', $namaguru);
    $getdata3 	= \App\Dataindukstaff::where('nama', $namaguru)->first();
    $kelamin3 	= $getdata3->kelamin ?? 'L';
    if ($kelamin3 == 'P'){
        $namaguru = 'Al Ustadzah '.$namaguru;
    } else {
        $namaguru = 'Al Ustadz '.$namaguru;
    }
@endphp
	<tr><td colspan="8"><img src="{{$kopsurat}}" width="100%"></td></tr>
	<tr>
		<td colspan="8" align="center" valign="top"><b>PENILAIAN AL QURAN {{$semester}}</b></td>
	</tr>
	<tr>
		<td width="200" align="left" valign="top">Nama </td>
		<td width="20" align="left" valign="top">:</td>
		<td width="500" colspan="6" align="left" valign="top"><b>{{ $nama }}</b></td>
	</tr>
	<tr>
		<td align="left" valign="top">Tempat Tanggal Lahir</td>
		<td align="left" valign="top">:</td>
		<td colspan="6" align="left" valign="top">{{ $foto }}</td>
	</tr>
	<tr>
		<td align="left" valign="top">Kelas</td>
		<td align="left" valign="top">:</td>
		<td colspan="6" align="left" valign="top">{{ $kelas }} / {{ $jilid }}</td>
	</tr>
	<tr>
		<td align="left" valign="top">Materi Ujian</td>
		<td align="left" valign="top">:</td>
		<td colspan="6" align="left" valign="top">
            @php
                usort($juznumber, function($a, $b) {
                    return intval(str_replace("Juz ", "", $a)) <=> intval(str_replace("Juz ", "", $b));
                });

                // Buat teks materi
                $teksmateri = 'Juz : ';
                $arr = [];

                foreach ($juznumber as $juz) {
                    $arr[] = intval(str_replace("Juz ", "", $juz));
                }

                $teksmateri .= implode(', ', $arr);

                echo $teksmateri;

                $totalnilai     = 0;
                $totalpembagi   = 0;
            @endphp
        </td>
	</tr>
    <tr>
		<td align="left" valign="top">Penguji</td>
		<td align="left" valign="top">:</td>
		<td colspan="6" align="left" valign="top">{{ $namaguru }}</td>
	</tr>
    @if(isset($perjuz) && !empty($perjuz))
        @php
            $keys           = array_keys($perjuz);
            for($i = 0; $i < count($perjuz); $i++) {
                $nomor = 1;
        @endphp
            <tr><td colspan="8" align="center"><strong>{{ $juznumber[$i] }}</strong></td></tr>
            <tr><td colspan="8">
                <table cellspacing="0" border="1" width="720">
                    <thead>
                        <tr>
                            <th width="54">No</th>
                            <th width="120">Nama Surah</th>
                            <th width="61">Halaman</th>
                            <th width="61">Jumlah Kata</th>
                            <th width="61">Nilai Maksimal</th>
                            <th width="91">Jumlah Kesalahan</th>
                            <th width="91">Nilai Kesalahan</th>
                            <th width="91">Nilai Persurat / Perhalaman</th>
                            <th width="90">Predikat</th>
                        </tr>
                    </thead>
                    <tbody>
                @php
                    $nilaiperjuz    = 0;
                    $pembagiperjuz  = 0;
                    foreach($perjuz[$keys[$i]] as $key => $value) {
                        $nilaipersurat = $value['nilaipersurat'];
                        if ($nilaipersurat < 0){
                            $nilaipersurat = 0;
                        }
                        $pembagiperjuz++;
                        if ($nilaipersurat == '' OR $nilaipersurat == null){
                            $nilaiperjuz    = $nilaiperjuz + 0;
                        } else {
                            $nilaiperjuz    = $nilaiperjuz + $nilaipersurat;
                        }
                @endphp
                    <tr>
                        <td align="center">{{$nomor}}</td>
                        <td>{{ $value['namasurah'] }}</td>
                        <td align="center">{{ $value['halaman'] }}</td>
                        <td align="center">{{ $value['jumlahkata'] }}</td>
                        <td align="center">100</td>
                        <td align="center">{{ $value['jumlahkesalahan'] }}</td>
                        <td align="right">{{ $value['nilaikesalahan'] }}</td>
                        <td align="right">{{ $nilaipersurat }}</td>
                        <td align="right">{{ $value['predikat'] }}</td>
                    </tr>
                @php
                        $nomor++;
                    }
                @endphp
                @php
                    if ($nilaiperjuz != 0 AND $pembagiperjuz != 0){
                        $nilaiperjuz     = round(($nilaiperjuz / $pembagiperjuz), 2);
                    }
                    if ($nilaiperjuz == '' OR $nilaiperjuz == null OR $nilaiperjuz == '0' OR $nilaiperjuz == '0.00'){
                        $predikatperjuz = "راسب";
                        $totalpembagi++;
                    } else {
                        $totalnilai     = $totalnilai + $nilaiperjuz;
                        $totalpembagi++;
                        if ($nilaiperjuz >= 90){
                            $predikatperjuz = "ممتاز";
                        } else if ($nilaiperjuz >= 80){
                            $predikatperjuz = "جيد جدا";
                        } else if ($nilaiperjuz >= 70){
                            $predikatperjuz = "جيد";
                        } else if ($nilaiperjuz >= 60){
                            $predikatperjuz = "مقبول";
                        } else {
                            $predikatperjuz = "راسب";
                        }
                    }
                @endphp
                    <tr>
                        <td colspan="7"><strong>Nilai Rata-Rata {{ $juznumber[$i] }}</strong></td>
                        <td align="right"><strong>{{$nilaiperjuz}}</strong></td>
                        <td align="right"><strong>{{$predikatperjuz}}</strong></td>
                    </tr>
                    </tbody>
                </table>
                </td>
            </tr>
            <tr><td colspan="8" align="center">&nbsp;</td></tr>
        @php
        }
        @endphp
    @endif
    <tr><td colspan="8" align="center">
        @php
            if ($totalnilai == '' OR $totalnilai == null OR $totalnilai == '0' OR $totalnilai == '0.00'){
                $predikat   = 'n/a';
                $rata       = 0;
            } else {
                $rata     = round(($totalnilai / $totalpembagi), 2);
                if ($rata >= 90){
                    $predikat = "ممتاز";
                } else if ($rata >= 80){
                    $predikat = "جيد جدا";
                } else if ($rata >= 70){
                    $predikat = "جيد";
                } else if ($rata >= 60){
                    $predikat = "مقبول";
                } else {
                    $predikat = "راسب";
                }
            }
        @endphp
        <table cellspacing="0" border="1" width="720">
            <tr>
                <td width="580" align="center"><strong>Nilai Rata-Rata Keseluruhan</strong></td>
                <td width="85" align="right"><strong>{{$rata}}</strong></td>
                <td width="85" align="right"><strong>{{$predikat}}</strong></td>
            </tr>
        </table>
        </td>
    </tr>    
    <tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
    <tr>
        <td colspan="2">
            <table cellspacing="0" border="1" width="100%">
                <tr><td colspan="2">Kehadiran</td></tr>
                <tr>
                    <td width="40%">Sakit</td>
                    <td width="60%">: {{$sakit}} Hari</td>
                </tr>
                <tr>
                    <td>Ijin</td>
                    <td>: {{$ijin}} Hari</td>
                </tr>
                <tr>
                    <td>Alpha</td>
                    <td>: {{$alpha}} Hari</td>
                </tr>
            </table>
        </td>
        <td colspan="4">&nbsp;</td>
        <td colspan="2">
            @php 
                $cekarray1 = explode(';', $harisetorsekolah);
                $cekarray2 = explode(';', $harisetorrumah);
                if (isset($cekarray1[1])){
                    $persenzydsekolah   = 0;
                    $persenmrjsekolah   = 0;
                    $persenzydrumah     = 0;
                    $persenmrjrumah     = 0;

                    $prszydsekolah      = (int)$cekarray1[0];
                    $prsmrjsekolah      = (int)$cekarray1[1];
                    $prszydrumah        = (int)$cekarray2[0] ?? 0;
                    $prsmrjrumah        = (int)$cekarray2[1] ?? 0;
                    if ($hariefektif == 0 OR $hariefektif == '' OR $hariefektif == null){

                    } else {
                        $hariefektif      = (int)$hariefektif;
                        if ($prszydsekolah != 0){
                            $persenzydsekolah   = round((($prszydsekolah / $hariefektif) * 100), 0);
                        }
                        if ($prsmrjsekolah != 0){
                            $persenmrjsekolah   = round((($prsmrjsekolah / $hariefektif) * 100), 0);
                        }
                        if ($prszydrumah != 0){
                            $persenzydrumah     = round((($prszydrumah / $hariefektif) * 100), 0);
                        }
                        if ($prsmrjrumah != 0){
                            $persenmrjrumah     = round((($prsmrjrumah / $hariefektif) * 100), 0);
                        }
                    }
                   
            @endphp
                <table cellspacing="0" border="1" width="100%"><thead><tr><th colspan="5" width="100%"><strong>Disiplin Setoran AlQuran</strong></th></tr></thead><tbody><tr><td colspan="2" width="40%" align="center">Deskripsi</td><td width="20%" align="center">Hari Efektif</td><td width="20%" align="center">Setoran</td><td width="20%" align="center">Prosentase</td></tr>
                    <tr>
                        <td rowspan="2" width="25%">Sekolah</td>
                        <td width="20%">Ziyadah</td>
                        <td align="center"  width="15%">{{$hariefektif}}</td>
                        <td align="center"  width="15%">{{$prszydsekolah}}</td>
                        <td align="center" bgcolor="#F2F2F2"  width="15%">{{$persenzydsekolah}} %</td>
                    </tr>
                	<tr>
                        <td>Murojaah</td>
                        <td align="center">{{$hariefektif}}</td>
                        <td align="center">{{$prsmrjsekolah}}</td>
                        <td align="center" bgcolor="#F2F2F2">{{$persenmrjsekolah}} %</td>
                    </tr>
                    <tr>
                        <td rowspan="2" width="30%">Rumah</td>
                        <td>Voice Note</td>
                        <td align="center">{{$hariefektif}}</td>
                        <td align="center">{{$prszydrumah}}</td>
                        <td align="center" bgcolor="#F2F2F2">{{$persenzydrumah}} %</td>
                    </tr>
                    <tr>
                        <td>Murojaah</td>
                        <td align="center">{{$hariefektif}}</td>
                        <td align="center">{{$prsmrjrumah}}</td>
                        <td align="center" bgcolor="#F2F2F2">{{$persenmrjrumah}} %</td>
                    </tr>
                </table>
            @php
                } else {
                    $persensekolah  = '';
                    $persenrumah    = '';
                    
                    if ($hariefektif == 0 OR $hariefektif == '' OR $hariefektif == null){
                        
                    } else {
                        $harisetorsekolah = (int)$harisetorsekolah;
                        $harisetorrumah   = (int)$harisetorrumah;
                        $hariefektif      = (int)$hariefektif;
                        if ($harisetorsekolah == 0 OR $harisetorsekolah == '' OR $harisetorsekolah == null){
                        } else {
                            $persensekolah = ($harisetorsekolah/$hariefektif) * 100;
                        }
                        if ($harisetorrumah == 0 OR $harisetorrumah == '' OR $harisetorrumah == null){
                        } else {
                            $persenrumah = ($harisetorrumah/$hariefektif) * 100;
                        }
                    }
            @endphp
                <table cellspacing="0" border="1" width="100%">
                    <tr><td colspan="4">Disiplin Setoran Al Quran</td></tr>
                    <tr>
                        <td width="40%">&nbsp;</td>
                        <td width="20%" align="center"><strong>Hari Efektif</strong></td>
                        <td width="20%" align="center"><strong>Setoran</strong></td>
                        <td width="20%" align="center"><strong>Persen</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Sekolah</strong></td>
                        <td align="center">{{$hariefektif}}</td>
                        <td align="center">{{$harisetorsekolah}}</td>
                        <td align="center" bgcolor="#F2F2F2">{{$persensekolah}} %</td>
                    </tr>
                    <tr>
                        <td><strong>Rumah</strong></td>
                        <td align="center">{{$hariefektif}}</td>
                        <td align="center">{{$harisetorrumah}}</td>
                        <td align="center" bgcolor="#F2F2F2">{{$persenrumah}} %</td>
                    </tr>
                </table>
            @php
                }
            @endphp
        </td>
    </tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
	<tr>
		<td colspan="5" align="left" valign="top">&nbsp;</td>
		<td colspan="3" align="center" valign="top">Malang, {{$tanggal}}</td>
	</tr>
	<tr>
    @if ($id_sekolah == '1')
		<td colspan="5" align="center" valign="top">Kepala Sekolah</td>
    @else 
        <td colspan="5" align="center" valign="top">Direktur</td>
    @endif
		<td colspan="3" align="center" valign="top">
            @if ($id_sekolah == '1')
                Waka Al Quran
            @else
                Wadir Al Quran
            @endif
            
        </td>
	</tr>
    <tr>
		<td colspan="5" align="center" valign="top">{!! $ttdkasek !!}</td>
		<td colspan="3" align="center" valign="top">{!! $ttdwaka !!}</td>
	</tr>
	<tr>
        <td colspan="5" align="center" valign="top">{{$kasek}}<br />{{$niykasek}}</td>
		<td colspan="3" align="center" valign="top">{{$waka}}<br />{{$niywaka}}</td>
	</tr>
    <tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
    <tr><td colspan="8">&nbsp;</td></tr>
	<tr><td colspan="8">&nbsp;</td></tr>
</table>