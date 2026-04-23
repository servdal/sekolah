<!DOCTYPE HTML>
<html>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style type="text/css" media="print">
	.isi {
		font-family: "Comic Sans MS", cursive;
		font-size: 14px;
	}
	</style>
	</head>
	<body>
        <table class="table table-striped table-valign-middle isi">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kegiatan</th>
                    <th>Penanggungg Jawab</th>
                </tr>
            </thead>
            <tbody>
            @if(isset($result) && !empty($result))
                @foreach($result as $rows)
                <tr>
                    <td>{{$rows['mulai']}}</td>
                    <td>{{$rows['namakegiatan']}}</td>
                    <td>{{$rows['penanggunggjawab']}}</td>
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
	</body>
</html>