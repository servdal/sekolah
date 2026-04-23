<!DOCTYPE HTML>
<html>
	<head>
        <title>Cetak Soal</title>
	</head>
	<body>
		<div class="portrait">
        @if(isset($tabel) && !empty($tabel))
            @foreach($tabel as $rows)
                {!! $rows['kode'] !!} {{ $rows['gambar'] }}{!! $rows['soal'] !!}<br />A. {!! $rows['opsia'] !!}<br />B. {!! $rows['opsib'] !!}<br />C. {!! $rows['opsic'] !!}<br />D. {!! $rows['opsid'] !!}<br />E. {!! $rows['opsie'] !!}<br />ANSWER: {!! $rows['kunci'] !!}<br />
			@endforeach
        @endif
        </div>
	</body>
</html>