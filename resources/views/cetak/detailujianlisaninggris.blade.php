@php 
use Illuminate\Support\Facades\DB;
@endphp
<table class="table table-striped table-valign-middle isi">
    <thead>
        <tr>
            <td rowspan="2" style="text-align:center; vertical-align:middle">SUBJECT</td>
            <td style="text-align:center; vertical-align:middle">
                <strong>
                    @php 
                        $jumlahpenguji = 0;
                    @endphp
                    @if ($getdata->nama1 == '' OR $getdata->nama1 == null)
                        Belum Ada Penguji
                    @else 
                        {{$getdata->nama1}}
                        @php 
                            $jumlahpenguji++;
                        @endphp
                    @endif
                </strong>
            </td>
            <td style="text-align:center; vertical-align:middle">
                <strong>
                    @if ($getdata->nama2 == '' OR $getdata->nama2 == null)
                        Belum Ada Penguji
                    @else 
                        {{$getdata->nama2}}
                        @php 
                            $jumlahpenguji++;
                        @endphp
                    @endif
                </strong>
            </td>
            <td style="text-align:center; vertical-align:middle">
                <strong>
                    @if ($getdata->nama3 == '' OR $getdata->nama3 == null)
                        Belum Ada Penguji
                    @else 
                        {{$getdata->nama3}}
                        @php 
                            $jumlahpenguji++;
                        @endphp
                    @endif
                </strong>
            </td>
            <td rowspan="2" style="text-align:center; vertical-align:middle"><strong>Nilai Akhir</strong></td>
        </tr>
        <tr>
            <td style="text-align:center; vertical-align:middle">SCORE</td>
            <td style="text-align:center; vertical-align:middle">SCORE</td>
            <td style="text-align:center; vertical-align:middle">SCORE</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Manner</td>
            <td style="text-align:right">{{$getdata->pengguji1inggris1}}</td>
            <td style="text-align:right">{{$getdata->pengguji2inggris1}}</td>
            <td style="text-align:right">{{$getdata->pengguji3inggris1}}</td>
            <td style="text-align:right">
                @php 
                    $total          = 0;
                    $pembagi        = 0;
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1inggris1 AND $getdata->pengguji1inggris1 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1inggris1;
                    }
                    if ($getdata->pengguji2inggris1 AND $getdata->pengguji2inggris1 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2inggris1;
                    }
                    if ($getdata->pengguji3inggris1 AND $getdata->pengguji3inggris1 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3inggris1;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'allinggris1'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->allinggris1;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td>Conversation</td>
            <td style="text-align:right">{{$getdata->pengguji1inggris2}}</td>
            <td style="text-align:right">{{$getdata->pengguji2inggris2}}</td>
            <td style="text-align:right">{{$getdata->pengguji3inggris2}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1inggris2 AND $getdata->pengguji1inggris2 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1inggris2;
                    }
                    if ($getdata->pengguji2inggris2 AND $getdata->pengguji2inggris2 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2inggris2;
                    }
                    if ($getdata->pengguji3inggris2 AND $getdata->pengguji3inggris2 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3inggris2;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'allinggris2'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->allinggris2;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td>English Lesson</td>
            <td style="text-align:right">{{$getdata->pengguji1inggris3}}</td>
            <td style="text-align:right">{{$getdata->pengguji2inggris3}}</td>
            <td style="text-align:right">{{$getdata->pengguji3inggris3}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1inggris3 AND $getdata->pengguji1inggris3 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1inggris3;
                    }
                    if ($getdata->pengguji2inggris3 AND $getdata->pengguji2inggris3 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2inggris3;
                    }
                    if ($getdata->pengguji3inggris3 AND $getdata->pengguji3inggris3 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3inggris3;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'allinggris3'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->allinggris3;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td>Dictation</td>
            <td style="text-align:right">{{$getdata->pengguji1inggris4}}</td>
            <td style="text-align:right">{{$getdata->pengguji2inggris4}}</td>
            <td style="text-align:right">{{$getdata->pengguji3inggris4}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1inggris4 AND $getdata->pengguji1inggris4 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1inggris4;
                    }
                    if ($getdata->pengguji2inggris4 AND $getdata->pengguji2inggris4 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2inggris4;
                    }
                    if ($getdata->pengguji3inggris4 AND $getdata->pengguji3inggris4 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3inggris4;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'allinggris4'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->allinggris4;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td>Translation</td>
            <td style="text-align:right">{{$getdata->pengguji1inggris5}}</td>
            <td style="text-align:right">{{$getdata->pengguji2inggris5}}</td>
            <td style="text-align:right">{{$getdata->pengguji3inggris5}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1inggris5 AND $getdata->pengguji1inggris5 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1inggris5;
                    }
                    if ($getdata->pengguji2inggris5 AND $getdata->pengguji2inggris5 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2inggris5;
                    }
                    if ($getdata->pengguji3inggris5 AND $getdata->pengguji3inggris5 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3inggris5;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'allinggris5'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->allinggris5;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td>Composition</td>
            <td style="text-align:right">{{$getdata->pengguji1inggris6}}</td>
            <td style="text-align:right">{{$getdata->pengguji2inggris6}}</td>
            <td style="text-align:right">{{$getdata->pengguji3inggris6}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1inggris6 AND $getdata->pengguji1inggris6 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1inggris6;
                    }
                    if ($getdata->pengguji2inggris6 AND $getdata->pengguji2inggris6 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2inggris6;
                    }
                    if ($getdata->pengguji3inggris6 AND $getdata->pengguji3inggris6 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3inggris6;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'allinggris6'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->allinggris6;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td>Grammar</td>
            <td style="text-align:right">{{$getdata->pengguji1inggris7}}</td>
            <td style="text-align:right">{{$getdata->pengguji2inggris7}}</td>
            <td style="text-align:right">{{$getdata->pengguji3inggris7}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1inggris7 AND $getdata->pengguji1inggris7 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1inggris7;
                    }
                    if ($getdata->pengguji2inggris7 AND $getdata->pengguji2inggris7 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2inggris7;
                    }
                    if ($getdata->pengguji3inggris7 AND $getdata->pengguji3inggris7 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3inggris7;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'allinggris7'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->allinggris7;
                    }
                @endphp
            </td>
        </tr>
        @php
            $jumlahinggris1  = 0;
            $pembagiinggris1 = 0;
            if ($getdata->pengguji1inggris1 !== null){
                $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris1;
                $pembagiinggris1++;
            }
            if ($getdata->pengguji1inggris2 !== null){
                $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris2;
                $pembagiinggris1++;
            }
            if ($getdata->pengguji1inggris3 !== null){
                $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris3;
                $pembagiinggris1++;
            }
            if ($getdata->pengguji1inggris4 !== null){
                $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris4;
                $pembagiinggris1++;
            }
            if ($getdata->pengguji1inggris5 !== null){
                $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris5;
                $pembagiinggris1++;
            }
            if ($getdata->pengguji1inggris6 !== null){
                $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris6;
                $pembagiinggris1++;
            }
            if ($getdata->pengguji1inggris7 !== null){
                $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris7;
                $pembagiinggris1++;
            }
            if ($jumlahinggris1 != 0 AND $pembagiinggris1 != 0){
                $jumlahinggris1 = round(($jumlahinggris1 / $pembagiinggris1), 2);
            }
            $jumlahinggris2  = 0;
            $pembagiinggris2 = 0;
            if ($getdata->pengguji2inggris1 !== null){
                $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris1;
                $pembagiinggris2++;
            }
            if ($getdata->pengguji2inggris2 !== null){
                $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris2;
                $pembagiinggris2++;
            }
            if ($getdata->pengguji2inggris3 !== null){
                $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris3;
                $pembagiinggris2++;
            }
            if ($getdata->pengguji2inggris4 !== null){
                $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris4;
                $pembagiinggris2++;
            }
            if ($getdata->pengguji2inggris5 !== null){
                $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris5;
                $pembagiinggris2++;
            }
            if ($getdata->pengguji2inggris6 !== null){
                $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris6;
                $pembagiinggris2++;
            }
            if ($getdata->pengguji2inggris7 !== null){
                $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris7;
                $pembagiinggris2++;
            }
            if ($jumlahinggris2 != 0 AND $pembagiinggris2 != 0){
                $jumlahinggris2 = round(($jumlahinggris2 / $pembagiinggris2), 2);
            }
            $jumlahinggris3  = 0;
            $pembagiinggris3 = 0;
            if ($getdata->pengguji3inggris1 !== null){
                $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris1;
                $pembagiinggris3++;
            }
            if ($getdata->pengguji3inggris2 !== null){
                $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris2;
                $pembagiinggris3++;
            }
            if ($getdata->pengguji3inggris3 !== null){
                $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris3;
                $pembagiinggris3++;
            }
            if ($getdata->pengguji3inggris4 !== null){
                $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris4;
                $pembagiinggris3++;
            }
            if ($getdata->pengguji3inggris5 !== null){
                $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris5;
                $pembagiinggris3++;
            }
            if ($getdata->pengguji3inggris6 !== null){
                $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris6;
                $pembagiinggris3++;
            }
            if ($getdata->pengguji3inggris7 !== null){
                $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris7;
                $pembagiinggris3++;
            }
            if ($jumlahinggris3 != 0 AND $pembagiinggris3 != 0){
                $jumlahinggris3 = round(($jumlahinggris3 / $pembagiinggris3), 2);
            }
            $inggris        = $jumlahinggris1 + $jumlahinggris2 + $jumlahinggris3;
			if ($inggris != 0 AND $jumlahpenguji != 0){
				$inggris    = round((($inggris) / $jumlahpenguji), 2);
			}

        @endphp
        <tr>
            <td>AVERAGE</td>
            <td style="text-align:right">{{$jumlahinggris1}}</td>
            <td style="text-align:right">{{$jumlahinggris2}}</td>
            <td style="text-align:right">{{$jumlahinggris3}}</td>
            <td style="text-align:right">{{$inggris}}</td>
        </tr>
    </tbody>
</table>