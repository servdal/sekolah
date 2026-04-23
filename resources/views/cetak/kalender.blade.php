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
            <tr>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
                <th>Sun</th>
            </tr>
            <tr>
            @php
                $daysBefore = $startDate->dayOfWeek - 1;
                $cellCount = 0;
            @endphp
            @for ($i = 0; $i < $daysBefore; $i++)
                <td></td>
                @php
                    $cellCount++;
                @endphp
            @endfor
                @foreach ($dates as $date => $data)
                    @if ($cellCount % 7 == 0)
                        </tr><tr>
                    @endif
                    @php
                        $gettglsaja = explode('-', $date);
                        $tglsaja    = (int)$gettglsaja[2];
                    @endphp
                    @if($data['jumlah_kegiatan'] == 0)
                        <td>
                            {{ $tglsaja }}
                        </td>
                    @elseif($data['is_holiday'] > 0)
                        <td style="background-color: #D6EEEE;">
                            <font color="yellow">{{ $tglsaja }}</font>
                        </td>
                    @else 
                        <td style="background-color: #D6EEEE;">
                            <font color="yellow">{{ $tglsaja }}</font>
                        </td>
                    @endif
                    @php
                        $cellCount++;
                    @endphp
                @endforeach
                @for ($i = $cellCount; $i % 7 != 0; $i++)
                    <td></td>
                @endfor
            </tr>
        </table>
	</body>
</html>