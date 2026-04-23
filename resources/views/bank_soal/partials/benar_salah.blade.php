<h5 class="mb-3">Soal Benar / Salah</h5>

<div id="tf-box">

@if(isset($soal))
    {{-- MODE EDIT --}}
    @foreach($soal->options as $opt)
    <div class="card p-2 mb-2">
        <strong>{{ $opt->label }}</strong>

        <input type="text"
               name="statements[{{ $opt->id }}]"
               value="{{ $opt->teks }}"
               class="form-control mb-2">

        <div>
            <label class="mr-3">
                <input type="radio"
                       name="answers[{{ $opt->id }}]"
                       value="1" {{ $opt->is_correct ? 'checked' : '' }}>
                Benar
            </label>

            <label>
                <input type="radio"
                       name="answers[{{ $opt->id }}]"
                       value="0" {{ !$opt->is_correct ? 'checked' : '' }}>
                Salah
            </label>
        </div>
    </div>
    @endforeach

@else
    {{-- MODE CREATE --}}
    <div class="card p-2 mb-2">
        <strong>A</strong>
        <input type="text" name="statements[A]" class="form-control mb-2">

        <label><input type="radio" name="answers[A]" value="1" checked> Benar</label>
        <label><input type="radio" name="answers[A]" value="0"> Salah</label>
    </div>
@endif

</div>

<button type="button" onclick="addTF()" class="btn btn-success btn-sm">➕ Tambah</button>
