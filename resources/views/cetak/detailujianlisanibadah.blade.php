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
                    @if ($getdata->namapengujiibadah1 == '' OR $getdata->namapengujiibadah1 == null)
                        Belum Ada Penguji
                    @else 
                        {{$getdata->namapengujiibadah1}}
                        @php 
                            $jumlahpenguji++;
                        @endphp
                    @endif
                </strong>
            </td>
            <td style="text-align:center; vertical-align:middle">
                <strong>
                    @if ($getdata->namapengujiibadah2 == '' OR $getdata->namapengujiibadah2 == null)
                        Belum Ada Penguji
                    @else 
                        {{$getdata->namapengujiibadah2}}
                        @php 
                            $jumlahpenguji++;
                        @endphp
                    @endif
                </strong>
            </td>
            <td style="text-align:center; vertical-align:middle">
                <strong>
                    @if ($getdata->namapengujiibadah3 == '' OR $getdata->namapengujiibadah3 == null)
                        Belum Ada Penguji
                    @else 
                        {{$getdata->namapengujiibadah3}}
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
            <td style="text-align:right">{{$getdata->pengguji1ibadah1}}</td>
            <td style="text-align:right">{{$getdata->pengguji2ibadah1}}</td>
            <td style="text-align:right">{{$getdata->pengguji3ibadah1}}</td>
            <td style="text-align:right">
                @php 
                    $total          = 0;
                    $pembagi        = 0;
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1ibadah1 AND $getdata->pengguji1ibadah1 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1ibadah1;
                    }
                    if ($getdata->pengguji2ibadah1 AND $getdata->pengguji2ibadah1 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2ibadah1;
                    }
                    if ($getdata->pengguji3ibadah1 AND $getdata->pengguji3ibadah1 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3ibadah1;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'allibadah1'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->allibadah1;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td style="text-align:right">العبادة القولية</td>
            <td style="text-align:right">{{$getdata->pengguji1ibadah2}}</td>
            <td style="text-align:right">{{$getdata->pengguji2ibadah2}}</td>
            <td style="text-align:right">{{$getdata->pengguji3ibadah2}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1ibadah2 AND $getdata->pengguji1ibadah2 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1ibadah2;
                    }
                    if ($getdata->pengguji2ibadah2 AND $getdata->pengguji2ibadah2 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2ibadah2;
                    }
                    if ($getdata->pengguji3ibadah2 AND $getdata->pengguji3ibadah2 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3ibadah2;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'allibadah2'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->allibadah2;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td style="text-align:right">العبادة الفعلية</td>
            <td style="text-align:right">{{$getdata->pengguji1ibadah3}}</td>
            <td style="text-align:right">{{$getdata->pengguji2ibadah3}}</td>
            <td style="text-align:right">{{$getdata->pengguji3ibadah3}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1ibadah3 AND $getdata->pengguji1ibadah3 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1ibadah3;
                    }
                    if ($getdata->pengguji2ibadah3 AND $getdata->pengguji2ibadah3 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2ibadah3;
                    }
                    if ($getdata->pengguji3ibadah3 AND $getdata->pengguji3ibadah3 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3ibadah3;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'allibadah3'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->allibadah3;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td style="text-align:right">التجويد</td>
            <td style="text-align:right">{{$getdata->pengguji1ibadah4}}</td>
            <td style="text-align:right">{{$getdata->pengguji2ibadah4}}</td>
            <td style="text-align:right">{{$getdata->pengguji3ibadah4}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1ibadah4 AND $getdata->pengguji1ibadah4 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1ibadah4;
                    }
                    if ($getdata->pengguji2ibadah4 AND $getdata->pengguji2ibadah4 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2ibadah4;
                    }
                    if ($getdata->pengguji3ibadah4 AND $getdata->pengguji3ibadah4 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3ibadah4;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'allibadah4'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->allibadah4;
                    }
                @endphp
            </td>
        </tr>
        <tr>
            <td style="text-align:right">قراءة القرآن</td>
            <td style="text-align:right">{{$getdata->pengguji1ibadah5}}</td>
            <td style="text-align:right">{{$getdata->pengguji2ibadah5}}</td>
            <td style="text-align:right">{{$getdata->pengguji3ibadah5}}</td>
            <td style="text-align:right">
                @php 
                    $totalperbaris  = 0;
                    if ($getdata->pengguji1ibadah5 AND $getdata->pengguji1ibadah5 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji1ibadah5;
                    }
                    if ($getdata->pengguji2ibadah5 AND $getdata->pengguji2ibadah5 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji2ibadah5;
                    }
                    if ($getdata->pengguji3ibadah5 AND $getdata->pengguji3ibadah5 !== 0.00){
                        $totalperbaris = $totalperbaris + $getdata->pengguji3ibadah5;
                    }
                    if ($jumlahpenguji != 0 AND $totalperbaris != 0){
                        $ratapernilai   = round(($totalperbaris / $jumlahpenguji), 2);
                        $total          = $total + $ratapernilai;
                        $pembagi++;
                        DB::table('mushaf_ujianlisan')->where('id', $getdata->id)->update([
                            'allibadah5'    => $ratapernilai,
                        ]);
                        echo $ratapernilai;
                    } else {
                        echo $getdata->allibadah5;
                    }
                @endphp
            </td>
        </tr>
        @php 
            $jumlahibadah1  = 0;
            $pembagiibadah1 = 0;
            if ($getdata->pengguji1ibadah1 !== null){
                $jumlahibadah1 = $jumlahibadah1 + $getdata->pengguji1ibadah1;
                $pembagiibadah1++;
            }
            if ($getdata->pengguji1ibadah2 !== null){
                $jumlahibadah1 = $jumlahibadah1 + $getdata->pengguji1ibadah2;
                $pembagiibadah1++;
            }
            if ($getdata->pengguji1ibadah3 !== null){
                $jumlahibadah1 = $jumlahibadah1 + $getdata->pengguji1ibadah3;
                $pembagiibadah1++;
            }
            if ($getdata->pengguji1ibadah4 !== null){
                $jumlahibadah1 = $jumlahibadah1 + $getdata->pengguji1ibadah4;
                $pembagiibadah1++;
            }
            if ($getdata->pengguji1ibadah5 !== null){
                $jumlahibadah1 = $jumlahibadah1 + $getdata->pengguji1ibadah5;
                $pembagiibadah1++;
            }
            $jumlahibadah2  = 0;
            $pembagiibadah2 = 0;
            if ($getdata->pengguji2ibadah1 !== null){
                $jumlahibadah2 = $jumlahibadah2 + $getdata->pengguji2ibadah1;
                $pembagiibadah2++;
            }
            if ($getdata->pengguji2ibadah2 !== null){
                $jumlahibadah2 = $jumlahibadah2 + $getdata->pengguji2ibadah2;
                $pembagiibadah2++;
            }
            if ($getdata->pengguji2ibadah3 !== null){
                $jumlahibadah2 = $jumlahibadah2 + $getdata->pengguji2ibadah3;
                $pembagiibadah2++;
            }
            if ($getdata->pengguji2ibadah4 !== null){
                $jumlahibadah2 = $jumlahibadah2 + $getdata->pengguji2ibadah4;
                $pembagiibadah2++;
            }
            if ($getdata->pengguji2ibadah5 !== null){
                $jumlahibadah2 = $jumlahibadah2 + $getdata->pengguji2ibadah5;
                $pembagiibadah2++;
            }
            $jumlahibadah3  = 0;
            $pembagiibadah3 = 0;
            if ($getdata->pengguji3ibadah1 !== null){
                $jumlahibadah3 = $jumlahibadah3 + $getdata->pengguji3ibadah1;
                $pembagiibadah3++;
            }
            if ($getdata->pengguji3ibadah2 !== null){
                $jumlahibadah3 = $jumlahibadah3 + $getdata->pengguji3ibadah2;
                $pembagiibadah3++;
            }
            if ($getdata->pengguji3ibadah3 !== null){
                $jumlahibadah3 = $jumlahibadah3 + $getdata->pengguji3ibadah3;
                $pembagiibadah3++;
            }
            if ($getdata->pengguji3ibadah4 !== null){
                $jumlahibadah3 = $jumlahibadah3 + $getdata->pengguji3ibadah4;
                $pembagiibadah3++;
            }
            if ($getdata->pengguji3ibadah5 !== null){
                $jumlahibadah3 = $jumlahibadah3 + $getdata->pengguji3ibadah5;
                $pembagiibadah3++;
            }
            if ($jumlahibadah1 != 0 AND $pembagiibadah1 != 0){
                $jumlahibadah1 = round(($jumlahibadah1 / $pembagiibadah1), 2);
            }
            if ($jumlahibadah2 != 0 AND $pembagiibadah2 != 0){
                $jumlahibadah2 = round(($jumlahibadah2 / $pembagiibadah2), 2);
            }
            if ($jumlahibadah3 != 0 AND $pembagiibadah3 != 0){
                $jumlahibadah3 = round(($jumlahibadah3 / $pembagiibadah3), 2);
            }
            $ibadah         = $jumlahibadah1 + $jumlahibadah2 + $jumlahibadah3;
            
            if ($ibadah != 0 AND $jumlahpenguji != 0){
				$ibadah     = round((($ibadah) / $jumlahpenguji), 2);
            }
            

        @endphp
        <tr>
            <td style="text-align:right">المعدل التراكمي</td>
            <td style="text-align:right">{{$jumlahibadah1}}</td>
            <td style="text-align:right">{{$jumlahibadah2}}</td>
            <td style="text-align:right">{{$jumlahibadah3}}</td>
            <td style="text-align:right">{{$ibadah}}</td>
        </tr>
    </tbody>
</table>