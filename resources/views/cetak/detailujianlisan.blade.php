@php 
    $inggris        = 0;
    $pembagiinggris = 0;
    $ibadah         = 0;
    $pembagiibadah  = 0;
    $lugot          = 0;
    $pembagilugot   = 0;
    $jumlahinggris1 = 0;
    $jumlahinggris2 = 0;
    $jumlahinggris3 = 0;
    $jumlahibadah1  = 0;
    $jumlahibadah2  = 0;
    $jumlahibadah3  = 0;
    $jumlahlugot1   = 0;
    $jumlahlugot2   = 0;
    $jumlahlugot3   = 0;
@endphp
<table cellpadding="1" cellspacing="1" border="1">
    <thead>
        <tr>
            <td colspan="6" rowspan="1" style="text-align:center; vertical-align:middle"><strong>{{$getdata->nama1}}</strong></td>
            <td colspan="6" rowspan="1" style="text-align:center; vertical-align:middle"><strong>{{$getdata->nama2}}</strong></td>
            <td colspan="6" rowspan="1" style="text-align:center; vertical-align:middle"><strong>{{$getdata->nama3}}</strong></td>
            <td colspan="3" rowspan="1" style="text-align:center; vertical-align:middle"><strong>Nilai Akhir</strong></td>
        </tr>
        <tr>
            <td colspan="2" rowspan="1" style="text-align:center; vertical-align:middle">ENGLISH</td>
            <td colspan="2" rowspan="1" style="text-align:center; vertical-align:middle">العبادة</td>
            <td colspan="2" rowspan="1" style="text-align:center; vertical-align:middle">اللغة العربية</td>
            <td colspan="2" rowspan="1" style="text-align:center; vertical-align:middle">ENGLISH</td>
            <td colspan="2" rowspan="1" style="text-align:center; vertical-align:middle">العبادة</td>
            <td colspan="2" rowspan="1" style="text-align:center; vertical-align:middle">اللغة العربية</td>
            <td colspan="2" rowspan="1" style="text-align:center; vertical-align:middle">ENGLISH</td>
            <td colspan="2" rowspan="1" style="text-align:center; vertical-align:middle">العبادة</td>
            <td colspan="2" rowspan="1" style="text-align:center; vertical-align:middle">اللغة العربية</td>
            <td rowspan="1" style="text-align:center; vertical-align:middle">ENGLISH</td>
            <td rowspan="1" style="text-align:center; vertical-align:middle">العبادة</td>
            <td rowspan="1" style="text-align:center; vertical-align:middle">اللغة العربية</td>
        </tr>
        <tr>
            <td style="text-align:center; vertical-align:middle">SUBJECT</td>
            <td style="text-align:center; vertical-align:middle">SCORE</td>
            <td style="text-align:right; vertical-align:middle">الدرجة</td>
            <td style="text-align:right; vertical-align:middle">المواد الدراسية</td>
            <td style="text-align:center; vertical-align:middle">الدرجة</td>
            <td style="text-align:center; vertical-align:middle">المواد الدراسية</td>
            <td style="text-align:center; vertical-align:middle">SUBJECT</td>
            <td style="text-align:center; vertical-align:middle">SCORE</td>
            <td style="text-align:right; vertical-align:middle">الدرجة</td>
            <td style="text-align:right; vertical-align:middle">المواد الدراسية</td>
            <td style="text-align:center; vertical-align:middle">الدرجة</td>
            <td style="text-align:center; vertical-align:middle">المواد الدراسية</td>
            <td style="text-align:center; vertical-align:middle">SUBJECT</td>
            <td style="text-align:center; vertical-align:middle">SCORE</td>
            <td style="text-align:right; vertical-align:middle">الدرجة</td>
            <td style="text-align:right; vertical-align:middle">المواد الدراسية</td>
            <td style="text-align:center; vertical-align:middle">الدرجة</td>
            <td style="text-align:center; vertical-align:middle">المواد الدراسية</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Manner</td>
            <td style="text-align:right">
                @if($getdata->pengguji1inggris1 && $getdata->pengguji1inggris1 != 0.00)
                    {{ $getdata->pengguji1inggris1 }}
                    @php
                        $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris1;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji1ibadah1 && $getdata->pengguji1ibadah1 != 0.00)
                    {{ $getdata->pengguji1ibadah1 }}
                    @php
                        $jumlahibadah1 = $jumlahibadah1 + $getdata->pengguji1ibadah1;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">الأدب</td>
            <td style="text-align:right">
                @if($getdata->pengguji1lugot1 && $getdata->pengguji1lugot1 != 0.00)
                    {{ $getdata->pengguji1lugot1 }}
                    @php 
                        $jumlahlugot1 = $jumlahlugot1 + $getdata->pengguji1lugot1;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">الأدب</td>
            <td>Manner</td>
            <td style="text-align:right">
                @if($getdata->pengguji2inggris1 && $getdata->pengguji2inggris1 != 0.00)
                    {{ $getdata->pengguji2inggris1 }}
                    @php 
                        $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris1;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji2ibadah1 && $getdata->pengguji2ibadah1 != 0.00)
                    {{ $getdata->pengguji2ibadah1 }}
                    @php 
                        $jumlahibadah2 = $jumlahibadah2 + $getdata->pengguji2ibadah1;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">الأدب</td>
            <td style="text-align:right">
                @if($getdata->pengguji2lugot1 && $getdata->pengguji2lugot1 != 0.00)
                    {{ $getdata->pengguji2lugot1 }}
                    @php 
                        $jumlahlugot2 = $jumlahlugot2 + $getdata->pengguji2lugot1;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">الأدب</td>
            <td>Manner</td>
            <td style="text-align:right">
                @if($getdata->pengguji3inggris1 && $getdata->pengguji3inggris1 != 0.00)
                    {{ $getdata->pengguji3inggris1 }}
                    @php 
                        $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris1;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji3ibadah1 && $getdata->pengguji3ibadah1 != 0.00)
                    {{ $getdata->pengguji3ibadah1 }}
                    @php 
                        $jumlahibadah3 = $jumlahibadah3 + $getdata->pengguji3ibadah1;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">الأدب</td>
            <td style="text-align:right">
                @if($getdata->pengguji3lugot1 && $getdata->pengguji3lugot1 != 0.00)
                    {{ $getdata->pengguji3lugot1 }}
                    @php 
                        $jumlahlugot3 = $jumlahlugot3 + $getdata->pengguji3lugot1;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">الأدب</td>
            <td style="text-align:right">
                @if($getdata->allinggris1 && $getdata->allinggris1 != 0.00)
                    {{ $getdata->allinggris1 }}
                    @php 
                        $inggris = $inggris + $getdata->allinggris1;
                        $pembagiinggris++;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->allibadah1 && $getdata->allibadah1 != 0.00)
                    {{ $getdata->allibadah1 }}
                    @php 
                        $ibadah = $ibadah + $getdata->allibadah1;
                        $pembagiibadah++;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->alllugot1 && $getdata->alllugot1 != 0.00)
                    {{ $getdata->alllugot1 }}
                    @php 
                        $lugot = $lugot + $getdata->alllugot1;
                        $pembagilugot++;
                    @endphp
                @endif
            </td>
        </tr>
        <tr>
            <td>Conversation</td>
            <td style="text-align:right">
                @if($getdata->pengguji1inggris2 && $getdata->pengguji1inggris2 != 0.00)
                    {{ $getdata->pengguji1inggris2 }}
                    @php 
                        $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris2;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji1ibadah2 && $getdata->pengguji1ibadah2 != 0.00)
                    {{ $getdata->pengguji1ibadah2 }}
                    @php 
                        $jumlahibadah1 = $jumlahibadah1 + $getdata->pengguji1ibadah2;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">العبادة القولية</td>
            <td style="text-align:right">
                @if($getdata->pengguji1lugot2 && $getdata->pengguji1lugot2 != 0.00)
                    {{ $getdata->pengguji1lugot2 }}
                    @php 
                        $jumlahlugot1 = $jumlahlugot1 + $getdata->pengguji1lugot2;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">المحادثة</td>
            <td>Conversation</td>
            <td style="text-align:right">
                @if($getdata->pengguji2inggris2 && $getdata->pengguji2inggris2 != 0.00)
                    {{ $getdata->pengguji2inggris2 }}
                    @php
                        $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris2;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji2ibadah2 && $getdata->pengguji2ibadah2 != 0.00)
                    {{ $getdata->pengguji2ibadah2 }}
                    @php
                        $jumlahibadah2 = $jumlahibadah2 + $getdata->pengguji2ibadah2;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">العبادة القولية</td>
            <td style="text-align:right">
                @if($getdata->pengguji2lugot2 && $getdata->pengguji2lugot2 != 0.00)
                    {{ $getdata->pengguji2lugot2 }}
                    @php
                        $jumlahlugot2 = $jumlahlugot2 + $getdata->pengguji2lugot2;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">المحادثة</td>
            <td>Conversation</td>
            <td style="text-align:right">
                @if($getdata->pengguji3inggris2 && $getdata->pengguji3inggris2 != 0.00)
                    {{ $getdata->pengguji3inggris2 }}
                    @php
                        $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris2;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji3ibadah2 && $getdata->pengguji3ibadah2 != 0.00)
                    {{ $getdata->pengguji3ibadah2 }}
                    @php
                        $jumlahibadah3 = $jumlahibadah3 + $getdata->pengguji3ibadah2;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">العبادة القولية</td>
            <td style="text-align:right">
                @if($getdata->pengguji3lugot2 && $getdata->pengguji3lugot2 != 0.00)
                    {{ $getdata->pengguji3lugot2 }}
                    @php 
                        $jumlahlugot3 = $jumlahlugot3 + $getdata->pengguji3lugot2;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">المحادثة</td>
            <td style="text-align:right">
                @if($getdata->allinggris2 && $getdata->allinggris2 != 0.00)
                    {{ $getdata->allinggris2 }}
                    @php 
                        $inggris = $inggris + $getdata->allinggris2;
                        $pembagiinggris++;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->allibadah2 && $getdata->allibadah2 != 0.00)
                    {{ $getdata->allibadah2 }}
                    @php 
                        $ibadah = $ibadah + $getdata->allibadah2;
                        $pembagiibadah++;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->alllugot2 && $getdata->alllugot2 != 0.00)
                    {{ $getdata->alllugot2 }}
                    @php 
                        $lugot = $lugot + $getdata->alllugot2;
                        $pembagilugot++;
                    @endphp
                @endif
            </td>
        </tr>
        <tr>
            <td>English Lesson</td>
            <td style="text-align:right">
                @if($getdata->pengguji1inggris3 && $getdata->pengguji1inggris3 != 0.00)
                    {{ $getdata->pengguji1inggris3 }}
                    @php 
                        $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris3;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji1ibadah3 && $getdata->pengguji1ibadah3 != 0.00)
                    {{ $getdata->pengguji1ibadah3 }}
                    @php 
                        $jumlahibadah1 = $jumlahibadah1 + $getdata->pengguji1ibadah3;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">العبادة الفعلية</td>
            <td style="text-align:right">
                @if($getdata->pengguji1lugot3 && $getdata->pengguji1lugot3 != 0.00)
                    {{ $getdata->pengguji1lugot3 }}
                    @php
                        $jumlahlugot1 = $jumlahlugot1 + $getdata->pengguji1lugot3;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">اللغة العربية</td>
            <td>English Lesson</td>
            <td style="text-align:right">
                @if($getdata->pengguji2inggris3 && $getdata->pengguji2inggris3 != 0.00)
                    {{ $getdata->pengguji2inggris3 }}
                    @php 
                        $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris3;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji2ibadah3 && $getdata->pengguji2ibadah3 != 0.00)
                    {{ $getdata->pengguji2ibadah3 }}
                    @php 
                        $jumlahibadah2 = $jumlahibadah2 + $getdata->pengguji2ibadah3;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">العبادة الفعلية</td>
            <td style="text-align:right">
                @if($getdata->pengguji2lugot3 && $getdata->pengguji2lugot3 != 0.00)
                    {{ $getdata->pengguji2lugot3 }}
                    @php
                        $jumlahlugot2 = $jumlahlugot2 + $getdata->pengguji2lugot3;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">اللغة العربية</td>
            <td>English Lesson</td>
            <td style="text-align:right">
                @if($getdata->pengguji3inggris3 && $getdata->pengguji3inggris3 != 0.00)
                    {{ $getdata->pengguji3inggris3 }}
                    @php 
                        $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris3;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji3ibadah3 && $getdata->pengguji3ibadah3 != 0.00)
                    {{ $getdata->pengguji3ibadah3 }}
                    @php 
                        $jumlahibadah3 = $jumlahibadah3 + $getdata->pengguji3ibadah3;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">العبادة الفعلية</td>
            <td style="text-align:right">
                @if($getdata->pengguji3lugot3 && $getdata->pengguji3lugot3 != 0.00)
                    {{ $getdata->pengguji3lugot3 }}
                    @php
                        $jumlahlugot3 = $jumlahlugot3 + $getdata->pengguji3lugot3;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">اللغة العربية</td>
            <td style="text-align:right">
                @if($getdata->allinggris3 && $getdata->allinggris3 != 0.00)
                    {{ $getdata->allinggris3 }}
                    @php 
                        $inggris = $inggris + $getdata->allinggris3;
                        $pembagiinggris++;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->allibadah3 && $getdata->allibadah3 != 0.00)
                    {{ $getdata->allibadah3 }}
                    @php 
                        $ibadah = $ibadah + $getdata->allibadah3;
                        $pembagiibadah++;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->alllugot3 && $getdata->alllugot3 != 0.00)
                    {{ $getdata->alllugot3 }}
                    @php 
                        $lugot = $lugot + $getdata->alllugot3;
                        $pembagilugot++;
                    @endphp
                @endif
            </td>
        </tr>
        <tr>
            <td>Dictation</td>
            <td style="text-align:right">
                @if($getdata->pengguji1inggris4 && $getdata->pengguji1inggris4 != 0.00)
                    {{ $getdata->pengguji1inggris4 }}
                    @php 
                        $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris4;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji1ibadah4 && $getdata->pengguji1ibadah4 != 0.00)
                    {{ $getdata->pengguji1ibadah4 }}
                    @php 
                        $jumlahibadah1 = $jumlahibadah1 + $getdata->pengguji1ibadah4;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">التجويد</td>
            <td style="text-align:right">
                @if($getdata->pengguji1lugot4 && $getdata->pengguji1lugot4 != 0.00)
                    {{ $getdata->pengguji1lugot4 }}
                    @php
                        $jumlahlugot1 = $jumlahlugot1 + $getdata->pengguji1lugot4;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">الإملاء</td>
            <td>Dictation</td>
            <td style="text-align:right">
                @if($getdata->pengguji2inggris4 && $getdata->pengguji2inggris4 != 0.00)
                    {{ $getdata->pengguji2inggris4 }}
                    @php 
                        $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris4;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji2ibadah4 && $getdata->pengguji2ibadah4 != 0.00)
                    {{ $getdata->pengguji2ibadah4 }}
                    @php
                        $jumlahibadah2 = $jumlahibadah2 + $getdata->pengguji2ibadah4;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">التجويد</td>
            <td style="text-align:right">
                @if($getdata->pengguji2lugot4 && $getdata->pengguji2lugot4 != 0.00)
                    {{ $getdata->pengguji2lugot4 }}
                    @php
                        $jumlahlugot2 = $jumlahlugot2 + $getdata->pengguji2lugot4;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">الإملاء</td>
            <td>Dictation</td>
            <td style="text-align:right">
                @if($getdata->pengguji3inggris4 && $getdata->pengguji3inggris4 != 0.00)
                    {{ $getdata->pengguji3inggris4 }}
                    @php
                        $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris4;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji3ibadah4 && $getdata->pengguji3ibadah4 != 0.00)
                    {{ $getdata->pengguji3ibadah4 }}
                    @php
                        $jumlahibadah3 = $jumlahibadah3 + $getdata->pengguji3ibadah4;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">التجويد</td>
            <td style="text-align:right">
                @if($getdata->pengguji3lugot4 && $getdata->pengguji3lugot4 != 0.00)
                    {{ $getdata->pengguji3lugot4 }}
                    @php
                        $jumlahlugot3 = $jumlahlugot3 + $getdata->pengguji3lugot4;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">الإملاء</td>
            <td style="text-align:right">
                @if($getdata->allinggris4 && $getdata->allinggris4 != 0.00)
                    {{ $getdata->allinggris4 }}
                    @php 
                        $inggris = $inggris + $getdata->allinggris4;
                        $pembagiinggris++;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->allibadah4 && $getdata->allibadah4 != 0.00)
                    {{ $getdata->allibadah4 }}
                    @php 
                        $ibadah = $ibadah + $getdata->allibadah4;
                        $pembagiibadah++;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->alllugot4 && $getdata->alllugot4 != 0.00)
                    {{ $getdata->alllugot4 }}
                    @php 
                        $lugot = $lugot + $getdata->alllugot4;
                        $pembagilugot++;
                    @endphp
                @endif
            </td>
        
        </tr>
        <tr>
            <td>Translation</td>
            <td style="text-align:right">
                @if($getdata->pengguji1inggris5 && $getdata->pengguji1inggris5 != 0.00)
                    {{ $getdata->pengguji1inggris5 }}
                    @php
                        $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris5;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji1ibadah5 && $getdata->pengguji1ibadah5 != 0.00)
                    {{ $getdata->pengguji1ibadah5 }}
                    @php
                        $jumlahibadah1 = $jumlahibadah1 + $getdata->pengguji1ibadah5;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">قراءة القرآن</td>
            <td style="text-align:right">
                @if($getdata->pengguji1lugot5 && $getdata->pengguji1lugot5 != 0.00)
                    {{ $getdata->pengguji1lugot5 }}
                    @php
                        $jumlahlugot1 = $jumlahlugot1 + $getdata->pengguji1lugot5;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">الترجمة</td>
            <td>Translation</td>
            <td style="text-align:right">
                @if($getdata->pengguji2inggris5 && $getdata->pengguji2inggris5 != 0.00)
                    {{ $getdata->pengguji2inggris5 }}
                    @php
                        $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris5;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji2ibadah5 && $getdata->pengguji2ibadah5 != 0.00)
                    {{ $getdata->pengguji2ibadah5 }}
                    @php
                        $jumlahibadah2 = $jumlahibadah2 + $getdata->pengguji2ibadah5;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">قراءة القرآن</td>
            <td style="text-align:right">
                @if($getdata->pengguji2lugot5 && $getdata->pengguji2lugot5 != 0.00)
                    {{ $getdata->pengguji2lugot5 }}
                    @php
                        $jumlahlugot2 = $jumlahlugot2 + $getdata->pengguji2lugot5;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">الترجمة</td>
            <td>Translation</td>
            <td style="text-align:right">
                @if($getdata->pengguji3inggris5 && $getdata->pengguji3inggris5 != 0.00)
                    {{ $getdata->pengguji3inggris5 }}
                    @php
                        $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris5;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->pengguji3ibadah5 && $getdata->pengguji3ibadah5 != 0.00)
                    {{ $getdata->pengguji3ibadah5 }}
                    @php
                        $jumlahibadah3 = $jumlahibadah3 + $getdata->pengguji3ibadah5;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">قراءة القرآن</td>
            <td style="text-align:right">
                @if($getdata->pengguji3lugot5 && $getdata->pengguji3lugot5 != 0.00)
                    {{ $getdata->pengguji3lugot5 }}
                    @php
                        $jumlahlugot3 = $jumlahlugot3 + $getdata->pengguji3lugot5;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">الترجمة</td>
            <td style="text-align:right">
                @if($getdata->allinggris5 && $getdata->allinggris5 != 0.00)
                    {{ $getdata->allinggris5 }}
                    @php 
                        $inggris = $inggris + $getdata->allinggris5;
                        $pembagiinggris++;
                    @endphp 
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->allibadah5 && $getdata->allibadah5 != 0.00)
                    {{ $getdata->allibadah5 }}
                    @php 
                        $ibadah = $ibadah + $getdata->allibadah5;
                        $pembagiibadah++;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">
                @if($getdata->alllugot5 && $getdata->alllugot5 != 0.00)
                    {{ $getdata->alllugot5 }}
                    @php 
                        $lugot = $lugot + $getdata->alllugot5;
                        $pembagilugot++;
                    @endphp
                @endif
            </td>
        </tr>
        <tr>
            <td>Composition</td>
            <td style="text-align:right">
                @if($getdata->pengguji1inggris6 && $getdata->pengguji1inggris6 != 0.00)
                    {{ $getdata->pengguji1inggris6 }}
                    @php
                        $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris6;
                    @endphp 
                @endif
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="text-align:right">
                @if($getdata->pengguji1lugot6 && $getdata->pengguji1lugot6 != 0.00)
                    {{ $getdata->pengguji1lugot6 }}
                    @php
                        $jumlahlugot1 = $jumlahlugot1 + $getdata->pengguji1lugot6;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">النحو</td>
            <td>Composition</td>
            <td style="text-align:right">
                @if($getdata->pengguji2inggris6 && $getdata->pengguji2inggris6 != 0.00)
                    {{ $getdata->pengguji2inggris6 }}
                    @php
                        $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris6;
                    @endphp 
                @endif
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="text-align:right">
                @if($getdata->pengguji2lugot6 && $getdata->pengguji2lugot6 != 0.00)
                    {{ $getdata->pengguji2lugot6 }}
                    @php
                        $jumlahlugot2 = $jumlahlugot2 + $getdata->pengguji2lugot6;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">النحو</td>
            <td>Composition</td>
            <td style="text-align:right">
                @if($getdata->pengguji3inggris6 && $getdata->pengguji3inggris6 != 0.00)
                    {{ $getdata->pengguji3inggris6 }}
                    @php
                        $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris6;
                    @endphp 
                @endif
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="text-align:right">
                @if($getdata->pengguji3lugot6 && $getdata->pengguji3lugot6 != 0.00)
                    {{ $getdata->pengguji3lugot6 }}
                    @php
                        $jumlahlugot3 = $jumlahlugot3 + $getdata->pengguji3lugot6;
                    @endphp
                @endif
            </td>
            <td style="text-align:right">النحو</td>
            <td style="text-align:right">
                @if($getdata->allinggris6 && $getdata->allinggris6 != 0.00)
                    {{ $getdata->allinggris6 }}
                    @php 
                        $inggris = $inggris + $getdata->allinggris6;
                        $pembagiinggris++;
                    @endphp 
                @endif
            </td>
            <td>&nbsp;</td>
            <td style="text-align:right">
                @if($getdata->alllugot6 && $getdata->alllugot6 != 0.00)
                    {{ $getdata->alllugot6 }}
                    @php 
                        $lugot = $lugot + $getdata->alllugot6;
                        $pembagilugot++;
                    @endphp
                @endif
            </td>
        </tr>
        <tr>
            <td>Grammar</td>
            <td style="text-align:right">
                @if($getdata->pengguji1inggris7 && $getdata->pengguji1inggris7 != 0.00)
                    {{ $getdata->pengguji1inggris7 }}
                    @php
                        $jumlahinggris1 = $jumlahinggris1 + $getdata->pengguji1inggris7;
                    @endphp 
                @endif
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="text-align:right">&nbsp;</td>
            <td style="text-align:right">&nbsp;</td>
            <td>Grammar</td>
            <td style="text-align:right">
                @if($getdata->pengguji2inggris7 && $getdata->pengguji2inggris7 != 0.00)
                    {{ $getdata->pengguji2inggris7 }}
                    @php
                        $jumlahinggris2 = $jumlahinggris2 + $getdata->pengguji2inggris7;
                    @endphp 
                @endif
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="text-align:right">&nbsp;</td>
            <td style="text-align:right">&nbsp;</td>
            <td>Grammar</td>
            <td style="text-align:right">
                @if($getdata->pengguji3inggris7 && $getdata->pengguji3inggris7 != 0.00)
                    {{ $getdata->pengguji3inggris7 }}
                    @php
                        $jumlahinggris3 = $jumlahinggris3 + $getdata->pengguji3inggris7;
                    @endphp 
                @endif
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="text-align:right">&nbsp;</td>
            <td style="text-align:right">&nbsp;</td>
            <td style="text-align:right">
                @if($getdata->allinggris7 && $getdata->allinggris7 != 0.00)
                    {{ $getdata->allinggris7 }}
                    @php 
                        $inggris = $inggris + $getdata->allinggris7;
                        $pembagiinggris++;
                    @endphp 
                @endif
            </td>
            <td>&nbsp;</td>
            <td style="text-align:right">&nbsp;</td>
        </tr>
        @php
            $total      = 0;
            if ($inggris != 0 AND $pembagiinggris != 0){
                $inggris    = round(($inggris / $pembagiinggris), 2);
                $total      = $total + $inggris;
            }
            if ($ibadah != 0 AND $pembagiibadah != 0){
                $ibadah    = round(($ibadah / $pembagiibadah), 2);
                $total      = $total + $ibadah;
            }
            if ($lugot != 0 AND $pembagilugot != 0){
                $lugot    = round(($lugot / $pembagilugot), 2);
                $total      = $total + $lugot;
            }
            if ($jumlahinggris1 != 0 AND $pembagiinggris != 0){
                $jumlahinggris1    = round(($jumlahinggris1 / $pembagiinggris), 2);
            }
            if ($jumlahibadah1 != 0 AND $pembagiibadah != 0){
                $jumlahibadah1    = round(($jumlahibadah1 / $pembagiibadah), 2);
            }
            if ($jumlahlugot1 != 0 AND $pembagilugot != 0){
                $jumlahlugot1    = round(($jumlahlugot1 / $pembagilugot), 2);
            }
            if ($jumlahinggris2 != 0 AND $pembagiinggris != 0){
                $jumlahinggris2    = round(($jumlahinggris2 / $pembagiinggris), 2);
            }
            if ($jumlahibadah2 != 0 AND $pembagiibadah != 0){
                $jumlahibadah2    = round(($jumlahibadah2 / $pembagiibadah), 2);
            }
            if ($jumlahlugot2 != 0 AND $pembagilugot != 0){
                $jumlahlugot2    = round(($jumlahlugot2 / $pembagilugot), 2);
            }
            if ($jumlahinggris3 != 0 AND $pembagiinggris != 0){
                $jumlahinggris3    = round(($jumlahinggris3 / $pembagiinggris), 2);
            }
            if ($jumlahibadah3 != 0 AND $pembagiibadah != 0){
                $jumlahibadah3    = round(($jumlahibadah3 / $pembagiibadah), 2);
            }
            if ($jumlahlugot3 != 0 AND $pembagilugot != 0){
                $jumlahlugot3    = round(($jumlahlugot3 / $pembagilugot), 2);
            }
            if ($total != 0){
                $akhir          = round((($inggris + $ibadah + $lugot) / 3), 2);
                if ($akhir >= 90){
                    $predikat = "ممتاز";
                } else if ($akhir >= 80){
                    $predikat = "جيد جدا";
                } else if ($akhir >= 70){
                    $predikat = "جيد";
                } else if ($akhir >= 60){
                    $predikat = "مقبول";
                } else {
                    $predikat = "راسب";
                }
            } else {
                $akhir      = 'n/a';
                $predikat   = 'n/a';
            }
        @endphp
        <tr>
            <td>AVERAGE</td>
            <td style="text-align:right">{{$jumlahinggris1}}</td>
            <td style="text-align:right">{{$jumlahibadah1}}</td>
            <td style="text-align:right">المعدل التراكمي</td>
            <td style="text-align:right">{{$jumlahlugot1}}</td>
            <td style="text-align:right">المعدل التراكمي</td>
            <td>AVERAGE</td>
            <td style="text-align:right">{{$jumlahinggris2}}</td>
            <td style="text-align:right">{{$jumlahibadah2}}</td>
            <td style="text-align:right">المعدل التراكمي</td>
            <td style="text-align:right">{{$jumlahlugot2}}</td>
            <td style="text-align:right">المعدل التراكمي</td>
            <td>AVERAGE</td>
            <td style="text-align:right">{{$jumlahinggris3}}</td>
            <td style="text-align:right">{{$jumlahibadah3}}</td>
            <td style="text-align:right">المعدل التراكمي</td>
            <td style="text-align:right">{{$jumlahlugot3}}</td>
            <td style="text-align:right">المعدل التراكمي</td>
            <td style="text-align:right">{{$inggris}}</td>
            <td style="text-align:right">{{$ibadah}}</td>
            <td style="text-align:right">{{$lugot}}</td>
        </tr>
        <tr><td colspan="21">&nbsp;</td></tr>
        <tr><td colspan="6">&nbsp;</td><td colspan="6"  style="text-align:center; font-weight: bold;">{{$akhir}}</td><td>&nbsp;</td><td colspan="8" style="text-align:center; font-weight: bold;">المعدل التراكمي</td></tr>
        <tr><td colspan="21">&nbsp;</td></tr>
        <tr><td colspan="2">90 - 100</td><td colspan="2">ممتاز</td><td colspan="2">89- 80</td><td colspan="2">جيد جدا</td><td colspan="2">70 - 79</td><td colspan="2">جيد</td><td colspan="2">50 - 69</td><td colspan="2">مقبول </td><td colspan="2">0 - 49</td><td>راسب</td><td  colspan="3" style="text-align:right; font-weight: bold;">التقدير</td></tr>
        <tr><td colspan="21">&nbsp;</td></tr>
        <tr><td colspan="6">&nbsp;</td><td colspan="6"  style="text-align:center; font-weight: bold;">{{$predikat}}</td><td>&nbsp;</td><td colspan="8" style="text-align:center; font-weight: bold;">التقدير العام</td></tr>
        <tr><td colspan="21">&nbsp;</td></tr>
        <tr><td colspan="6">&nbsp;</td><td colspan="6"  style="text-align:center; font-weight: bold;">&nbsp;</td><td>&nbsp;</td><td colspan="8" style="text-align:center; font-weight: bold;">تحريرا في مالانج </td></tr>
        <tr><td colspan="6">&nbsp;</td><td colspan="6"  style="text-align:center; font-weight: bold;">&nbsp;</td><td>&nbsp;</td><td colspan="8" style="text-align:center; font-weight: bold;">رئيس المدرسة</td></tr>
        <tr><td colspan="6">&nbsp;</td><td colspan="6"  style="text-align:center; font-weight: bold;">&nbsp;</td><td>&nbsp;</td><td colspan="8" style="text-align:center; font-weight: bold;">[ttdks]</td></tr>
        <tr><td colspan="6">&nbsp;</td><td colspan="6"  style="text-align:center; font-weight: bold;">&nbsp;</td><td>&nbsp;</td><td colspan="8" style="text-align:center; font-weight: bold;">الأستاذ ديان أحمد جفريح</td></tr>
    </tbody>
</table>