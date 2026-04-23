
<h5 class="mb-3">Pilihan Ganda</h5>

<div id="pg-box">

@if(isset($soal))
    {{-- MODE EDIT --}}
    @foreach($soal->options as $opt)
    <div class="card p-2 mb-2">
        <strong>{{ $opt->label }}</strong>

        <input type="text"
               name="options[{{ $opt->label }}][teks]"
               value="{{ $opt->teks }}"
               class="form-control mb-1"
               required>

        <div class="form-check">
            <input type="radio"
                   name="options_benar"
                   value="{{ $opt->label }}"
                   {{ $opt->is_correct ? 'checked' : '' }}>
            <label>Jawaban benar</label>
        </div>

        <button type="button"
                onclick="this.parentElement.remove()"
                class="btn btn-xs btn-danger mt-1">
            Hapus
        </button>
    </div>
    @endforeach

@else
    <h5>Opsi Jawaban</h5>

    @foreach(['A','B','C','D'] as $opt)
    <div class="form-group">
        <label>Opsi {{ $opt }}</label>
        <input type="text" name="options[{{ $opt }}][teks]" class="form-control">
        <div class="form-check mt-1">
            <input type="radio" name="options_benar" value="{{ $opt }}">
            <label>Jawaban Benar</label>
        </div>
    </div>
    @endforeach
@endif

</div>

<button type="button" onclick="addPg()" class="btn btn-success btn-sm">
➕ Tambah Opsi
</button>


