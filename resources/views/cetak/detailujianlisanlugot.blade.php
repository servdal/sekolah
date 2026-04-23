@php 
use Illuminate\Support\Facades\DB;
@endphp
<table class="table table-striped table-valign-middle isi">
    <thead>
        <tr>
            <td rowspan="2" style="text-align:right; vertical-align:middle">المواد الدراسية</td>
            <td style="text-align:center; vertical-align:middle">
                <strong>
                    @php 
                        $jumlahpenguji = 0;
                    @endphp
                    @if ($getdata->namapengujilugot1 == '' OR $getdata->namapengujilugot1 == null)
                        Belum Ada Penguji
                    @else 
                        {{$getdata->namapengujilugot1}}
                        @php 
                            $jumlahpenguji++;
                        @endphp
                    @endif
                </strong>
            </td>
            <td style="text-align:center; vertical-align:middle">
                <strong>
                    @if ($getdata->namapengujilugot2 == '' OR $getdata->namapengujilugot2 == null)
                        Belum Ada Penguji
                    @else 
                        {{$getdata->namapengujilugot2}}
                        @php 
                            $jumlahpenguji++;
                        @endphp
                    @endif
                </strong>
            </td>
            <td style="text-align:center; vertical-align:middle">
                <strong>
                    @if ($getdata->namapengujilugot3 == '' OR $getdata->namapengujilugot3 == null)
                        Belum Ada Penguji
                    @else 
                        {{$getdata->namapengujilugot3}}
                        @php 
                            $jumlahpenguji++;
                        @endphp
                    @endif
                </strong>
            </td>
            <td rowspan="2" style="text-align:center; vertical-align:middle"><strong>Nilai Akhir</strong></td>
        </tr>
        <tr>
            <td style="text-align:center; vertical-align:middle">الدرجة</td>
            <td style="text-align:center; vertical-align:middle">الدرجة</td>
            <td style="text-align:center; vertical-align:middle">الدرجة</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align:right">الأدب</td>
            <td style="text-align:right">{{$getdata->pengguji1lugot1}}</td>
            <td style="text-align:right">{{$getdata->pengguji2lugot1}}</td>
            <td style="text-align:right">{{$getdata->pengguji3lugot1}}</td>
            <td style="text-align:right">
                @php 
                    $total          = 0;
                    $pembagi        = 0;
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1lugot1 AND $getdata->pengguji1lugot1 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1lugot1;
                    }
                    if ($getdata->pengguji2lugot1 AND $getdata->pengguji2lugot1 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2lugot1;
                    }
                    if ($getdata->pengguji3lugot1 AND $getdata->pengguji3lugot1 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3lugot1;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'alllugot1'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->alllugot1;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td style="text-align:right">المحادثة</td>
            <td style="text-align:right">{{$getdata->pengguji1lugot2}}</td>
            <td style="text-align:right">{{$getdata->pengguji2lugot2}}</td>
            <td style="text-align:right">{{$getdata->pengguji3lugot2}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1lugot2 AND $getdata->pengguji1lugot2 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1lugot2;
                    }
                    if ($getdata->pengguji2lugot2 AND $getdata->pengguji2lugot2 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2lugot2;
                    }
                    if ($getdata->pengguji3lugot2 AND $getdata->pengguji3lugot2 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3lugot2;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'alllugot2'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->alllugot2;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td style="text-align:right">اللغة العربية</td>
            <td style="text-align:right">{{$getdata->pengguji1lugot3}}</td>
            <td style="text-align:right">{{$getdata->pengguji2lugot3}}</td>
            <td style="text-align:right">{{$getdata->pengguji3lugot3}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1lugot3 AND $getdata->pengguji1lugot3 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1lugot3;
                    }
                    if ($getdata->pengguji2lugot3 AND $getdata->pengguji2lugot3 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2lugot3;
                    }
                    if ($getdata->pengguji3lugot3 AND $getdata->pengguji3lugot3 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3lugot3;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'alllugot3'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->alllugot3;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td style="text-align:right">الإملاء</td>
            <td style="text-align:right">{{$getdata->pengguji1lugot4}}</td>
            <td style="text-align:right">{{$getdata->pengguji2lugot4}}</td>
            <td style="text-align:right">{{$getdata->pengguji3lugot4}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1lugot4 AND $getdata->pengguji1lugot4 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1lugot4;
                    }
                    if ($getdata->pengguji2lugot4 AND $getdata->pengguji2lugot4 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2lugot4;
                    }
                    if ($getdata->pengguji3lugot4 AND $getdata->pengguji3lugot4 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3lugot4;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'alllugot4'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->alllugot4;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td style="text-align:right">الترجمة</td>
            <td style="text-align:right">{{$getdata->pengguji1lugot5}}</td>
            <td style="text-align:right">{{$getdata->pengguji2lugot5}}</td>
            <td style="text-align:right">{{$getdata->pengguji3lugot5}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1lugot5 AND $getdata->pengguji1lugot5 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1lugot5;
                    }
                    if ($getdata->pengguji2lugot5 AND $getdata->pengguji2lugot5 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2lugot5;
                    }
                    if ($getdata->pengguji3lugot5 AND $getdata->pengguji3lugot5 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3lugot5;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'alllugot5'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->alllugot5;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td style="text-align:right">النحو</td>
            <td style="text-align:right">{{$getdata->pengguji1lugot6}}</td>
            <td style="text-align:right">{{$getdata->pengguji2lugot6}}</td>
            <td style="text-align:right">{{$getdata->pengguji3lugot6}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1lugot6 AND $getdata->pengguji1lugot6 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1lugot6;
                    }
                    if ($getdata->pengguji2lugot6 AND $getdata->pengguji2lugot6 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2lugot6;
                    }
                    if ($getdata->pengguji3lugot6 AND $getdata->pengguji3lugot6 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3lugot6;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'alllugot6'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->alllugot6;
                    }
                @endphp
            </td>
        </tr>
        @php
            $jumlahlugot1  = 0;
            $pembagilugot1 = 0;
            if ($getdata->pengguji1lugot1 !== null){
                $jumlahlugot1 = $jumlahlugot1 + $getdata->pengguji1lugot1;
                $pembagilugot1++;
            }
            if ($getdata->pengguji1lugot2 !== null){
                $jumlahlugot1 = $jumlahlugot1 + $getdata->pengguji1lugot2;
                $pembagilugot1++;
            }
            if ($getdata->pengguji1lugot3 !== null){
                $jumlahlugot1 = $jumlahlugot1 + $getdata->pengguji1lugot3;
                $pembagilugot1++;
            }
            if ($getdata->pengguji1lugot4 !== null){
                $jumlahlugot1 = $jumlahlugot1 + $getdata->pengguji1lugot4;
                $pembagilugot1++;
            }
            if ($getdata->pengguji1lugot5 !== null){
                $jumlahlugot1 = $jumlahlugot1 + $getdata->pengguji1lugot5;
                $pembagilugot1++;
            }
            if ($getdata->pengguji1lugot6 !== null){
                $jumlahlugot1 = $jumlahlugot1 + $getdata->pengguji1lugot6;
                $pembagilugot1++;
            }
            if ($jumlahlugot1 != 0 AND $pembagilugot1 != 0){
                $jumlahlugot1 = round(($jumlahlugot1 / $pembagilugot1), 2);
            }
            $jumlahlugot2  = 0;
            $pembagilugot2 = 0;
            if ($getdata->pengguji2lugot1 !== null){
                $jumlahlugot2 = $jumlahlugot2 + $getdata->pengguji2lugot1;
                $pembagilugot2++;
            }
            if ($getdata->pengguji2lugot2 !== null){
                $jumlahlugot2 = $jumlahlugot2 + $getdata->pengguji2lugot2;
                $pembagilugot2++;
            }
            if ($getdata->pengguji2lugot3 !== null){
                $jumlahlugot2 = $jumlahlugot2 + $getdata->pengguji2lugot3;
                $pembagilugot2++;
            }
            if ($getdata->pengguji2lugot4 !== null){
                $jumlahlugot2 = $jumlahlugot2 + $getdata->pengguji2lugot4;
                $pembagilugot2++;
            }
            if ($getdata->pengguji2lugot5 !== null){
                $jumlahlugot2 = $jumlahlugot2 + $getdata->pengguji2lugot5;
                $pembagilugot2++;
            }
            if ($getdata->pengguji2lugot6 !== null){
                $jumlahlugot2 = $jumlahlugot2 + $getdata->pengguji2lugot6;
                $pembagilugot2++;
            }
            if ($jumlahlugot2 != 0 AND $pembagilugot2 != 0){
                $jumlahlugot2 = round(($jumlahlugot2 / $pembagilugot2), 2);
            }
            $jumlahlugot3  = 0;
            $pembagilugot3 = 0;
            if ($getdata->pengguji3lugot1 !== null){
                $jumlahlugot3 = $jumlahlugot3 + $getdata->pengguji3lugot1;
                $pembagilugot3++;
            }
            if ($getdata->pengguji3lugot2 !== null){
                $jumlahlugot3 = $jumlahlugot3 + $getdata->pengguji3lugot2;
                $pembagilugot3++;
            }
            if ($getdata->pengguji3lugot3 !== null){
                $jumlahlugot3 = $jumlahlugot3 + $getdata->pengguji3lugot3;
                $pembagilugot3++;
            }
            if ($getdata->pengguji3lugot4 !== null){
                $jumlahlugot3 = $jumlahlugot3 + $getdata->pengguji3lugot4;
                $pembagilugot3++;
            }
            if ($getdata->pengguji3lugot5 !== null){
                $jumlahlugot3 = $jumlahlugot3 + $getdata->pengguji3lugot5;
                $pembagilugot3++;
            }
            if ($getdata->pengguji3lugot6 !== null){
                $jumlahlugot3 = $jumlahlugot3 + $getdata->pengguji3lugot6;
                $pembagilugot3++;
            }
            if ($jumlahlugot3 != 0 AND $pembagilugot2 != 0){
                $jumlahlugot3 = round(($jumlahlugot3 / $pembagilugot2), 2);
            }
            $lugot          = $jumlahlugot1 + $jumlahlugot2 + $jumlahlugot3;
			if ($lugot != 0 AND $jumlahpenguji != 0){
				$lugot		= round((($lugot) / $jumlahpenguji), 2);
            }
        @endphp
        <tr>
            <td style="text-align:right">المعدل التراكمي</td>
            <td style="text-align:right">{{$jumlahlugot1}}</td>
            <td style="text-align:right">{{$jumlahlugot2}}</td>
            <td style="text-align:right">{{$jumlahlugot3}}</td>
            <td style="text-align:right">{{$lugot}}</td>
        </tr>
    </tbody>
</table>