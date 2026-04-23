@if ($getdata->id_sekolah == '1')
<table cellpadding="1" cellspacing="1" width="800" id="tabelhasilujianlisan" style="background-image: url('{{asset('logo/bgrapotsdtq.png')}}'); background-size: contain; resize: both; overflow: scroll;">
@else
<table cellpadding="1" cellspacing="1" width="800" id="tabelhasilujianlisan" style="background-image: url('{{asset('logo/bgrapotmataba.png')}}'); background-size: contain; resize: both; overflow: scroll;">
@endif
	<thead>
        <tr>
			<td colspan="8"><img src="{{$kopsurat}}" width="100%"></td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">
				<h1><strong>كشف الدرجات الامتحان الشفهي</strong></h1>
			</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align:right; vertical-align:middle">{{$getdata->tapel}}</td>
			<td style="text-align:right; vertical-align:middle">العام الدراسي</td>
			<td style="text-align:center; vertical-align:middle">&nbsp;</td>
			<td colspan="4" rowspan="1" style="text-align:right; vertical-align:middle">{{$getdata->kelas}}:</td>
			<td style="text-align:right; vertical-align:middle">المستوي</td>
		</tr>
		<tr>
			<td style="text-align:right; vertical-align:middle">{{$getdata->semester}}</td>
			<td style="text-align:right; vertical-align:middle">الفصل الدراسي</td>
			<td style="text-align:center; vertical-align:middle">&nbsp;</td>
			<td colspan="4" rowspan="1" style="text-align:right; vertical-align:middle">{{$getdata->nama}}:</td>
			<td style="text-align:right; vertical-align:middle">اسم الطالب</td>
		</tr>
		<tr>
			<td style="text-align:center; vertical-align:middle">&nbsp;</td>
			<td style="text-align:center; vertical-align:middle">&nbsp;</td>
			<td style="text-align:center; vertical-align:middle">&nbsp;</td>
			<td colspan="4" rowspan="1" style="text-align:right; vertical-align:middle">{{$getdata->noinduk}}:</td>
			<td style="text-align:right; vertical-align:middle">رقم دفتر القيد</td>
		</tr>
		<tr>
			<td style="text-align:center; vertical-align:middle">&nbsp;</td>
			<td style="text-align:center; vertical-align:middle">&nbsp;</td>
			<td style="text-align:center; vertical-align:middle">&nbsp;</td>
			<td style="text-align:center; vertical-align:middle">&nbsp;</td>
			<td style="text-align:center; vertical-align:middle">&nbsp;</td>
			<td style="text-align:center; vertical-align:middle">&nbsp;</td>
			<td style="text-align:center; vertical-align:middle">&nbsp;</td>
			<td style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="1" style="background-color:grey; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center; vertical-align:middle">ENGLISH</td>
			<td rowspan="1">&nbsp;</td>
			<td colspan="2" rowspan="1" style="background-color:grey; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center; vertical-align:middle">العبادة</td>
			<td rowspan="1">&nbsp;</td>
			<td colspan="2" rowspan="1" style="background-color:grey; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center; vertical-align:middle">اللغة العربية</td>
		</tr>
		<tr>
			<td style="background-color:grey; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center; vertical-align:middle">SUBJECT</td>
			<td style="background-color:grey; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center; vertical-align:middle">SCORE</td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td style="background-color:grey; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right; vertical-align:middle">الدرجة</td>
			<td style="background-color:grey; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right; vertical-align:middle">المواد الدراسية</td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td style="background-color:grey; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center; vertical-align:middle">الدرجة</td>
			<td style="background-color:grey; border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center; vertical-align:middle">المواد الدراسية</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">Manner</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->allinggris1}}</td>
			<td>&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->allibadah1}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">الأدب</td>
			<td>&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->alllugot1}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">الأدب</td>
		</tr>
		<tr>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">Conversation</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->allinggris2}}</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->allibadah2}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">العبادة القولية</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->alllugot2}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">المحادثة</td>
		</tr>
		<tr>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">English Lesson</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->allinggris3}}</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->allibadah3}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">العبادة الفعلية</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->alllugot3}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">اللغة العربية</td>
		</tr>
		<tr>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">Dictation</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->allinggris4}}</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->allibadah4}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">التجويد</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->alllugot4}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">الإملاء</td>
		</tr>
		<tr>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">Translation</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->allinggris5}}</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->allibadah5}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">قراءة القرآن</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->alllugot5}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">الترجمة</td>
		</tr>
		<tr>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">Composition</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->allinggris6}}</td>
			<td style="text-align:right">&nbsp;</td>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">&nbsp;</td>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">&nbsp;</td>
			<td>&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->alllugot6}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">النحو</td>
		</tr>
		<tr>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">Grammar</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->allinggris7}}</td>
			<td style="text-align:right">&nbsp;</td>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">&nbsp;</td>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">&nbsp;</td>
			<td>&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->alllugot7}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">الصرف</td>
		</tr>
		<tr>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">&nbsp;</td>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">&nbsp;</td>
			<td>&nbsp;</td>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">&nbsp;</td>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">&nbsp;</td>
			<td>&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$getdata->alllugot8}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">المحفوظات</td>
		</tr>
        @php
	// fungsi
	function hitungRataRata($datarows, $prefix, $jenis) {

		$nilai = [];
		for ($i = 1; $i <= 8; $i++) {
			$field = $prefix . $jenis . $i;
			$nilai[] = $datarows->$field ?? null;
		}

		// ambil hanya nilai valid
		$nilai = array_filter($nilai, function($v) {
			return $v !== null && $v !== '' && floatval($v) != 0;
		});

		return count($nilai) > 0 ? round(array_sum($nilai) / count($nilai), 2) : 0;
	}

	$pembagiinggris = 0;
	$pembagiinggris += $getdata->niy1 !== null ? 1 : 0;
	$pembagiinggris += $getdata->niy2 !== null ? 1 : 0;
	$pembagiinggris += $getdata->niy3 !== null ? 1 : 0;

	$pembagiibadah = 0;
	$pembagiibadah += $getdata->niypengujiibadah1 !== null ? 1 : 0;
	$pembagiibadah += $getdata->niypengujiibadah2 !== null ? 1 : 0;
	$pembagiibadah += $getdata->niypengujiibadah3 !== null ? 1 : 0;

	$pembagilugot = 0;
	$pembagilugot += $getdata->niypengujilugot1 !== null ? 1 : 0;
	$pembagilugot += $getdata->niypengujilugot2 !== null ? 1 : 0;
	$pembagilugot += $getdata->niypengujilugot3 !== null ? 1 : 0;


	// PERHITUNGAN BENAR
	$jumlahinggris1 = hitungRataRata($getdata, 'pengguji1', 'inggris');
	$jumlahinggris2 = hitungRataRata($getdata, 'pengguji2', 'inggris');
	$jumlahinggris3 = hitungRataRata($getdata, 'pengguji3', 'inggris');

	$inggris = $jumlahinggris1 + $jumlahinggris2 + $jumlahinggris3;
	$inggris = ($pembagiinggris>0) ? round($inggris / $pembagiinggris, 2) : 0;


	$jumlahibadah1 = hitungRataRata($getdata, 'pengguji1', 'ibadah');
	$jumlahibadah2 = hitungRataRata($getdata, 'pengguji2', 'ibadah');
	$jumlahibadah3 = hitungRataRata($getdata, 'pengguji3', 'ibadah');

	$ibadah = $jumlahibadah1 + $jumlahibadah2 + $jumlahibadah3;
	$ibadah = ($pembagiibadah>0) ? round($ibadah / $pembagiibadah, 2) : 0;


	$jumlahlugot1 = hitungRataRata($getdata, 'pengguji1', 'lugot');
	$jumlahlugot2 = hitungRataRata($getdata, 'pengguji2', 'lugot');
	$jumlahlugot3 = hitungRataRata($getdata, 'pengguji3', 'lugot');

	$lugot = $jumlahlugot1 + $jumlahlugot2 + $jumlahlugot3;
	$lugot = ($pembagilugot>0) ? round($lugot / $pembagilugot, 2) : 0;


	$akhir = round(($inggris + $ibadah + $lugot) / 3, 2);

	if ($akhir >= 90) $predikat = "ممتاز";
	else if ($akhir >= 80) $predikat = "جيد جدا";
	else if ($akhir >= 70) $predikat = "جيد";
	else if ($akhir >= 50) $predikat = "مقبول";
	else $predikat = "راسب";
@endphp


		<tr>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">AVERAGE</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$inggris}}</td>
			<td>&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$ibadah}}</td>
			<td style=" border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">المعدل التراكمي</td>
			<td>&nbsp;</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">{{$lugot}}</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right">المعدل التراكمي</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="text-align:right">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2" rowspan="1" style="text-align:center"><strong>{{$akhir}}</strong></td>
			<td>&nbsp;</td>
			<td colspan="2" rowspan="1" style="text-align:center"><strong>المعدل التراكمي</strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="text-align:right">&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align:right">ممتاز 90 - 100</td>
			<td style="text-align:right">جيد جدا 80 - 89</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="text-align:right">جيد 70 - 79</td>
			<td style="text-align:right">مقبول 50 - 69</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="text-align:right">راسب 0 - 49</td>
			<td style="text-align:right">التقدير</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="text-align:right">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2" rowspan="1" style="text-align:center"><strong>{{$predikat}}</strong></td>
			<td>&nbsp;</td>
			<td colspan="2" rowspan="1" style="text-align:right"><strong>التقدير العام</strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="text-align:right">&nbsp;</td>
			<td style="text-align:right">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="4" rowspan="1" style="text-align:center">{!! $tanggal !!}</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="4" rowspan="1" style="text-align:center">رئيس المدرسة</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="4" rowspan="1" style="text-align:center">{!! $ttdks !!}</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="4" rowspan="1" style="text-align:center"><strong>الأستاذ ديان أحمد جفريح</strong></td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="8" style="text-align:center; vertical-align:middle">&nbsp;</td>
		</tr>
	</tbody>
</table>
