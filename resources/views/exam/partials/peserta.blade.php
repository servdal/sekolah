<table class="table table-bordered">
    <thead>
        <tr>
            <th width="5%"><input type="checkbox" id="check-all-peserta"></th>
            <th>No Induk</th>
            <th>Nama</th>
            <th>Kelas</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($siswa) && count($siswa) > 0)
            @foreach($siswa as $s)
            <tr>
                <td>
                    <input type="checkbox" name="peserta[]" value="{{ $s->id }}">
                </td>
                <td>{{ $s->noinduk }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->klspos }}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
