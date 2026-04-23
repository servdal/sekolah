<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label>Mapel</label>
            <select name="mapel" class="form-control" required>
                <option value="">- Pilih -</option>
                @if(isset($matpels))
                    @foreach($matpels as $m)
                        <option value="{{ $m->matpel }}">{{ $m->matpel }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Kelas</label>
            <select name="kelas" class="form-control" required>
                <option value="">- Pilih -</option>
                @if(Session('sekolah_level') == 1)
                    <option value="1">Tahap 1</option>
                    <option value="2">Tahap 2</option>
                @elseif (Session('sekolah_level') == 2)
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                @elseif (Session('sekolah_level') == 3)
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                @else
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                @endif
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Tipe Soal</label>
            <select name="tipe" id="tipeSoal" class="form-control" required>
                <option value="">- Pilih Tipe -</option>
                <option value="pg">Pilihan Ganda</option>
                <option value="pg_kompleks">PG Kompleks</option>
                <option value="menjodohkan">Menjodohkan</option>
                <option value="benar_salah">Benar / Salah</option>
                <option value="esai">Esai</option>
            </select>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Bobot Soal</label>
            <input type="number" name="bobot" value="1" step="0.1" min="0" class="form-control">
        </div>
    </div>

</div>

<hr>

<div class="form-group">
    <label>Stimulus / Bacaan (opsional)</label>
    <textarea name="stimulus" id="stimulusEditor" class="form-control"></textarea>
</div>

<div class="form-group">
    <label>Pertanyaan</label>
    <textarea name="pertanyaan" id="pertanyaanEditor" class="form-control" required></textarea>
</div>
