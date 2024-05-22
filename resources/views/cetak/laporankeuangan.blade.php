<!DOCTYPE HTML>
<html>
	<head>
        <title>{{$tulisanne}}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td valign="top" colspan="9" align="center"><h2>{!! $tulisanne !!}</h2></td>
            </tr>
            <tr>
                <td valign="top" width="5%" align="center" style="border-bottom:double; border-top:thin; border-left:thin; border-right:thin;"><b>No.</b></td>
                <td valign="top" width="5%" align="center" style="border-bottom:double; border-top:thin; border-right:thin;"><b>Tgl.</b></td>
                <td valign="top" width="18%" align="center" style="border-bottom:double; border-top:thin; border-right:thin;"><b>Uraian</b></td>
                <td valign="top" colspan="2" align="center" style="border-bottom:double; border-top:thin; border-right:thin;"><b>Penerimaan</b></td>
                <td valign="top" colspan="2" align="center" style="border-bottom:double; border-top:thin; border-right:thin;"><b>Pengeluaran</b></td>
                <td valign="top" colspan="2" align="center" style="border-bottom:double; border-top:thin; border-right:thin;"><b>Saldo</b></td>
            </tr>
            <tr>
				<td valign="top" style="border-left:thin; border-right:thin;">&nbsp;</td>
				<td valign="top" style="border-right:thin;">&nbsp;</td>
				<td valign="top" style="border-right:thin;">&nbsp;</td>
				<td valign="top" width="8%">&nbsp;</td>
				<td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
				<td valign="top" width="8%">&nbsp;</td>
				<td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
				<td valign="top" width="8%">&nbsp;</td>
				<td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
            </tr>
            <tr>
				<td valign="top" style="border-left:thin; border-right:thin;" align="center">1</td>
				<td valign="top" style="border-right:thin;" align="center">{{$dino}}</td>
				<td valign="top" style="border-right:thin;">Saldo Awal</td>
				<td valign="top" width="8%" align="center" align="center">Rp.</td>
				<td valign="top" width="16%" style="border-right:thin;" align="right">{{$tulisan1}}</td>
				<td valign="top" width="8%" align="center" align="center">Rp.</td>
				<td valign="top" width="16%" style="border-right:thin;"  align="right">{{$tulisan2}}</td>
				<td valign="top" width="8%" align="center" align="center">Rp.</td>
				<td valign="top" width="16%" style="border-right:thin;"  align="right">{{$tulisan3}}</td>
			</tr>
            @php 
                $itung      = 0;
                $halaman    = 0;
                $i          = 0;
            @endphp
            @if(isset($tabele) && !empty($tabele))
                @foreach($tabele as $rtabel)
                @php
                if ($itung == 16){
					$itung 	= 0;
					$y 		= $i + 1;
					$halaman++;
                @endphp
					<tr>
						<td valign="top" style="border-left:thin; border-right:thin;">&nbsp;</td>
						<td valign="top" style="border-right:thin;">&nbsp;</td>
						<td valign="top" style="border-right:thin;">&nbsp;</td>
						<td valign="top" width="2%">&nbsp;</td>
						<td valign="top" width="17%" style="border-right:thin;">&nbsp;</td>
						<td valign="top" width="2%">&nbsp;</td>
						<td valign="top" width="17%" style="border-right:thin;">&nbsp;</td>
						<td valign="top" width="3%">&nbsp;</td>
						<td valign="top" width="27%" style="border-right:thin;">&nbsp;</td>
                    </tr>
                    <tr>
						<td valign="top" style="border-left:thin; border-right:thin;" align="center">{{$rtabel['i']}}</td>
						<td valign="top" style="border-right:thin;" align="center">{{$rtabel['tanggal']}}</td>
						<td valign="top" style="border-right:thin;">{{$rtabel['deskripsi']}}</td>
						<td valign="top" width="8%" align="center">Rp.</td>
						<td valign="top" width="16%" style="border-right:thin;" align="right">{{$rtabel['tulisan4']}}</td>
						<td valign="top" width="8%" align="center">Rp.</td>
						<td valign="top" width="16%" style="border-right:thin;" align="right">{{$rtabel['tulisan5']}}</td>
						<td valign="top" width="8%" align="center">Rp.</td>
						<td valign="top" width="16%" style="border-right:thin;" align="right">{{$rtabel['tulisan6']}}</td>
                    </tr>
                    <tr>
						<td valign="top" style="border-left:thin; border-right:thin;">&nbsp;</td>
						<td valign="top" style="border-right:thin;">&nbsp;</td>
						<td valign="top" style="border-right:thin;">&nbsp;</td>
						<td valign="top" width="8%">&nbsp;</td>
						<td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
						<td valign="top" width="8%">&nbsp;</td>
						<td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
						<td valign="top" width="8%">&nbsp;</td>
						<td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
                    </tr>
                    <tr>
						<td valign="top" colspan="3" style="border-bottom:double; border-top:double; border-left:thin; border-right:thin;"><b>TOTAL</b></td>			
						<td valign="top" width="2%" style="border-bottom:double; border-top:double; border-right:thin;" align="center">Rp.</td>
						<td valign="top" width="17%" style="border-bottom:double; border-top:double; border-right:thin;" align="right">{{$rtabel['tulisan7']}}</td>
						<td valign="top" width="2%" style="border-bottom:double; border-top:double; border-right:thin;" align="center">Rp.</td>
						<td valign="top" width="17%" style="border-bottom:double; border-top:double; border-right:thin;" align="right">{{$rtabel['tulisan8']}}</td>
						<td valign="top" width="3%" style="border-bottom:double; border-top:double; border-right:thin;" align="center">Rp.</td>
						<td valign="top" width="27%" style="border-bottom:double; border-top:double; border-right:thin;" align="right">{{$rtabel['tulisan6']}}</td>
					</tr>
                </table>
                <div style="page-break-before: always">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td valign="top" width="8%" align="center" style="border-bottom:double; border-top:thin; border-left:thin; border-right:thin;"><b>No.</b></td>
                        <td valign="top" width="8%" align="center" style="border-bottom:double; border-top:thin; border-right:thin;"><b>Tgl.</b></td>
                        <td valign="top" width="16%" align="center" style="border-bottom:double; border-top:thin; border-right:thin;"><b>Uraian</b></td>
                        <td valign="top" colspan="2" align="center" style="border-bottom:double; border-top:thin; border-right:thin;"><b>Penerimaan</b></td>
                        <td valign="top" colspan="2" align="center" style="border-bottom:double; border-top:thin; border-right:thin;"><b>Pengeluaran</b></td>
                        <td valign="top" colspan="2" align="center" style="border-bottom:double; border-top:thin; border-right:thin;"><b>Saldo</b></td>
                    </tr>
                    <tr>
                        <td valign="top" style="border-left:thin; border-right:thin;">&nbsp;</td>
                        <td valign="top" style="border-right:thin;">&nbsp;</td>
                        <td valign="top" style="border-right:thin;">&nbsp;</td>
                        <td valign="top" width="8%">&nbsp;</td>
                        <td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
                        <td valign="top" width="8%">&nbsp;</td>
                        <td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
                        <td valign="top" width="8%">&nbsp;</td>
                        <td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td valign="top" style="border-left:thin; border-right:thin;" align="center">{{$y}}</td>
                        <td valign="top" style="border-right:thin;" align="center">{{$rtabel['tanggal']}}</td>
                        <td valign="top" style="border-right:thin;">Saldo Pindahan Halaman {{$halaman}}</td>
                        <td valign="top" width="8%" align="center">Rp.</td>
                        <td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
                        <td valign="top" width="8%" align="center">Rp.</td>
                        <td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
                        <td valign="top" width="8%" align="center">Rp.</td>
                        <td valign="top" width="16%" style="border-right:thin;" align="right">{{$rtabel['tulisan6']}}</td>
                    </tr>		  
                    @php
						$i = $i++;
				} else {
                    @endphp
                    <tr>
                        <td valign="top" style="border-left:thin; border-right:thin;">&nbsp;</td>
                        <td valign="top" style="border-right:thin;">&nbsp;</td>
                        <td valign="top" style="border-right:thin;">&nbsp;</td>
                        <td valign="top" width="8%">&nbsp;</td>
                        <td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
                        <td valign="top" width="8%">&nbsp;</td>
                        <td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
                        <td valign="top" width="8%">&nbsp;</td>
                        <td valign="top" width="16%" style="border-right:thin;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td valign="top" style="border-left:thin; border-right:thin;" align="center">{{$rtabel['i']}}</td>
                        <td valign="top" style="border-right:thin;" align="center">{{$rtabel['tanggal']}}</td>
                        <td valign="top" style="border-right:thin;">{{$rtabel['deskripsi']}}</td>
                        <td valign="top" width="8%" align="center">Rp.</td>
                        <td valign="top" width="16%" style="border-right:thin;" align="right">{{$rtabel['tulisan4']}}</td>
                        <td valign="top" width="8%" align="center">Rp.</td>
                        <td valign="top" width="16%" style="border-right:thin;" align="right">{{$rtabel['tulisan5']}}</td>
                        <td valign="top" width="8%" align="center">Rp.</td>
                        <td valign="top" width="16%" style="border-right:thin;" align="right">{{$rtabel['tulisan6']}}</td>
                    </tr>
                @php
				}
				$i++;
				$itung++;
                @endphp
                @endforeach
            @endif
            <tr>
                <td valign="top" style="border-left:thin; border-right:thin;">&nbsp;</td>
                <td valign="top" style="border-right:thin;">&nbsp;</td>
                <td valign="top" style="border-right:thin;">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top" style="border-right:thin;">&nbsp;</td>
                <td valign="top" >&nbsp;</td>
                <td valign="top" style="border-right:thin;">&nbsp;</td>
                <td valign="top" >&nbsp;</td>
                <td valign="top" style="border-right:thin;">&nbsp;</td>
            </tr>
            <tr>
                <td valign="top" colspan="3" style="border-bottom:double; border-top:double; border-left:thin; border-right:thin;"><b>TOTAL</b></td>			
                <td valign="top" width="2%" style="border-bottom:double; border-top:double;" align="center">Rp.</td>
                <td valign="top" width="17%" style="border-bottom:double; border-top:double; border-right:thin;" align="right">{{$tulisan10}}</td>
                <td valign="top" width="2%" style="border-bottom:double; border-top:double;" align="center">Rp.</td>
                <td valign="top" width="17%" style="border-bottom:double; border-top:double; border-right:thin;" align="right">{{$tulisan11}}</td>
                <td valign="top" width="3%" style="border-bottom:double; border-top:double;" align="center">Rp.</td>
                <td valign="top" width="27%" style="border-bottom:double; border-top:double; border-right:thin;" align="right">{{$tulisan9}}</td>
            </tr>
            <tr>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
            </tr>
            <tr>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top" colspan="3">Malang, {{$tgllaporan}}</td>
            </tr>
            <tr>
                <td valign="top" colspan="4">Mengetahui,</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
            </tr>
            <tr>
                <td valign="top" colspan="5">{{$jabkajur}}</td>
                <td valign="top">&nbsp;</td>
                <td valign="top" colspan="3">{{$jabbendahara}}</td>
            </tr>
            <tr>
                <td valign="top" colspan="5">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top" colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td valign="top" colspan="5">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top" colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td valign="top" colspan="5">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top" colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td valign="top" colspan="5">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top" colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td valign="top" colspan="5">{{$namakajur}}</td>
                <td valign="top">&nbsp;</td>
                <td valign="top" colspan="3">{{$namabendahara}}</td>
            </tr>
            <tr>
                <td valign="top" colspan="5">{{$nipkajur}}</td>
                <td valign="top">&nbsp;</td>
                <td valign="top" colspan="3">{{$nipbendahara}}</td>
            </tr>
        </table>
    </body>
</html>