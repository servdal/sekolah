<table class="table table-bordered">
    <thead>
        <tr>
            <th width="5%"></th>
            <th>No Induk</th>
            <th>Nama</th>
            <th>Kelas</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peserta as $p)
        <tr>
            <td>
                <input type="checkbox"
                       name="peserta[]"
                       value="{{ $p->student_id }}"
                       checked>
            </td>
            <td>{{ $p->noinduk }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->kelas }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($peserta->count() == 0)
    <div class="alert alert-warning mt-2">
        Belum ada peserta untuk ujian ini. Silakan pilih kelas untuk memuat peserta.
    </div>
@endif
