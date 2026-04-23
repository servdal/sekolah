<h5 class="mb-3">Soal Menjodohkan</h5>
    <div class="row">
        <div class="col-md-6">
            <h6>Pernyataan</h6>
            <div id="left-box">
                @if(isset($soal))
                    @foreach($soal->matchingLefts as $l)
                    <div class="mb-2">
                        <input type="text"
                            name="left[{{ $l->label }}]"
                            value="{{ $l->teks }}"
                            class="form-control">
                    </div>
                    @endforeach
                @else 
                    @for($i=1;$i<=3;$i++)
                    <div class="mb-2"><input type="text" name="left[{{ $i }}]" class="form-control" placeholder="Pernyataan {{ $i }}"></div>
                    @endfor
                @endif
            </div>
            <button type="button" onclick="addLeft()" class="btn btn-success btn-sm mt-2">➕ Tambah Pernyataan</button>
        </div>
        <div class="col-md-6">
            <h6>Jawaban</h6>
            <div id="right-box">

                @if(isset($soal))
                    @foreach($soal->matchingRights as $r)
                    <div class="mb-2">
                        <input type="text"
                            name="right[{{ $r->label }}]"
                            value="{{ $r->teks }}"
                            class="form-control">
                    </div>
                    @endforeach
                @else 
                    @foreach(['A','B','C'] as $opt)
                        <div class="mb-2"><input type="text" name="right[{{ $opt }}]" class="form-control" placeholder="Jawaban {{ $opt }}"></div>
                    @endforeach
                @endif
            </div>
            <button type="button" onclick="addRight()" class="btn btn-success btn-sm mt-2">➕ Tambah Jawaban</button>
        </div>
    </div>
    <hr>
    <h6>Kunci Pasangan</h6>
    <div id="key-box">

        @if(isset($soal))
            @foreach($soal->matchingLefts as $l)
            <div class="mb-2">
                <label>{{ $l->label }}</label>
                <select name="keys[{{ $l->label }}]" class="form-control">
                    <option value="">Pilih pasangan</option>
                    @foreach($soal->matchingRights as $r)
                    <option value="{{ $r->label }}"
                        {{ optional($l->keys)->firstWhere('right_id',$r->id) ? 'selected' : '' }}>
                        {{ $r->label }}
                    </option>
                    @endforeach
                </select>
            </div>
            @endforeach
        @else 
            @for($i=1;$i<=3;$i++)
            <div class="mb-2">
                <select name="keys[{{ $i }}]" class="form-control">
                    <option value="">Pilih</option>
                    @foreach(['A','B','C'] as $opt)
                        <option value="{{ $opt }}">{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
            @endfor
        @endif
    </div>
</div>
