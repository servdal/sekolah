@extends('adminlte3.layout')

@section('content')
<div class="wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Soal Bank</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('bank-soal.index') }}">Bank Soal</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Soal</h3>
                </div>

                <form method="POST" action="{{ route('bank-soal.update',$bank_soal) }}">
                    @csrf
                    @method('PUT')

                <div class="card-body">

                {{-- META --}}
                <div class="row">
                    <div class="col-md-3">
                        <label>Mapel</label>
                        <select name="mapel" class="form-control">
                            @if(isset($matpels))
                                @foreach($matpels as $m)
                                    <option value="{{ $m->matpel }}" {{ $bank_soal->mapel==$m->matpel?'selected':'' }}>{{ $m->matpel }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Kelas</label>
                        <select name="kelas" class="form-control">
                            @if(Session('sekolah_level') == 1)
                                <option value="1" {{ $bank_soal->kelas=='1'?'selected':'' }}>Tahap 1</option>
                                <option value="2" {{ $bank_soal->kelas=='2'?'selected':'' }}>Tahap 2</option>
                            @elseif (Session('sekolah_level') == 2)
                                <option value="1" {{ $bank_soal->kelas=='1'?'selected':'' }}>1</option>
                                <option value="2" {{ $bank_soal->kelas=='2'?'selected':'' }}>2</option>
                                <option value="3" {{ $bank_soal->kelas=='3'?'selected':'' }}>3</option>
                                <option value="4" {{ $bank_soal->kelas=='4'?'selected':'' }}>4</option>
                                <option value="5" {{ $bank_soal->kelas=='5'?'selected':'' }}>5</option>
                                <option value="6" {{ $bank_soal->kelas=='6'?'selected':'' }}>6</option>
                            @elseif (Session('sekolah_level') == 3)
                                <option value="7" {{ $bank_soal->kelas=='7'?'selected':'' }}>7</option>
                                <option value="8" {{ $bank_soal->kelas=='8'?'selected':'' }}>8</option>
                                <option value="9" {{ $bank_soal->kelas=='9'?'selected':'' }}>9</option>
                            @else
                                <option value="10" {{ $bank_soal->kelas=='10'?'selected':'' }}>10</option>
                                <option value="11" {{ $bank_soal->kelas=='11'?'selected':'' }}>11</option>
                                <option value="12" {{ $bank_soal->kelas=='12'?'selected':'' }}>12</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Tipe</label>
                        <input type="text" class="form-control" value="{{ strtoupper($bank_soal->tipe) }}" readonly>
                    </div>

                    <div class="col-md-3">
                        <label>Bobot</label>
                        <input type="number" name="bobot" class="form-control" value="{{ $bank_soal->bobot }}">
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <label>Stimulus</label>
                    <textarea name="stimulus" id="stimulusEditor" class="form-control">
                        {!! $bank_soal->stimulus !!}
                    </textarea>
                </div>

                <div class="form-group">
                    <label>Pertanyaan</label>
                    <textarea name="pertanyaan" id="pertanyaanEditor" class="form-control" required>
                    {!! $bank_soal->pertanyaan !!}
                    </textarea>
                </div>

                <hr>

                {{-- FORM DETAIL --}}
                <div id="formEdit">
                    <div class="text-muted">Memuat form soal...</div>
                </div>

                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('bank-soal.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <button class="btn btn-success">
                        <i class="fa fa-save"></i> Update Soal
                    </button>
                </div>

                </form>
            </div>

        </div>
    </section>
</div>
@endsection

@push('script')

{{-- CKEDITOR --}}
<script>
    CKEDITOR.replace('stimulusEditor', { height: 150 });
    CKEDITOR.replace('pertanyaanEditor', { height: 200 });
    
</script>

{{-- LOAD PARTIAL EDIT --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/bank-soal/form-edit/{{ $bank_soal->tipe }}/{{ $bank_soal->id }}')
            .then(res => res.text())
            .then(html => {
                document.getElementById('formEdit').innerHTML = html;
            });
    });
</script>
@if ($bank_soal->tipe == 'benar_salah')
<script>
    let tfIndex = {{ isset($soal) ? $soal->options->count() + 1 : 66 }};

    function addTF(){
        let label = 'NEW_'+tfIndex;

        document.getElementById('tf-box').insertAdjacentHTML('beforeend', `
        <div class="card p-2 mb-2">
            <strong>Baru</strong>
            <input type="text" name="statements[${label}]" class="form-control mb-2">
            <label><input type="radio" name="answers[${label}]" value="1" checked> Benar</label>
            <label><input type="radio" name="answers[${label}]" value="0"> Salah</label>
        </div>
        `);

        tfIndex++;
    }
</script>
@endif
@if ($bank_soal->tipe == 'pg')
<script>
    let pgIndex = {{ isset($soal) ? count($soal->options) : 0 }};

    function addPg(){
        let label = String.fromCharCode(65 + pgIndex);

        document.getElementById('pg-box').insertAdjacentHTML('beforeend', `
        <div class="card p-2 mb-2">
            <strong>${label}</strong>
            <input type="text"
                name="options[${label}][teks]"
                class="form-control mb-1"
                required>

            <div class="form-check">
                <input type="radio" name="options_benar" value="${label}">
                <label>Jawaban benar</label>
            </div>

            <button type="button"
                    onclick="this.parentElement.remove()"
                    class="btn btn-xs btn-danger mt-1">
                Hapus
            </button>
        </div>
        `);

        pgIndex++;
    }

    // default create
    @if(!isset($soal))
    addPg();
    addPg();
    addPg();
    addPg();
    @endif
</script>
@endif
@if ($bank_soal->tipe == 'pg_kompleks')
<script>
    let pgkIndex = {{ isset($soal) ? count($soal->options) : 0 }};

    function addPgk(){
        let label = String.fromCharCode(65 + pgkIndex);

        document.getElementById('pgk-box').insertAdjacentHTML('beforeend', `
        <div class="card p-2 mb-2">
            <strong>${label}</strong>

            <input type="text"
                name="options[${label}][teks]"
                class="form-control mb-1"
                required>

            <div class="form-check">
                <input type="checkbox" name="options[${label}][benar]" value="1">
                <label>Jawaban benar</label>
            </div>

            <button type="button"
                    onclick="this.parentElement.remove()"
                    class="btn btn-xs btn-danger mt-1">
                Hapus
            </button>
        </div>
        `);

        pgkIndex++;
    }

    // default create
    @if(!isset($soal))
        addPgk();
        addPgk();
        addPgk();
        addPgk();
    @endif
</script>
@endif
@if ($bank_soal->tipe == 'menjodohkan')
<script>
    let leftIndex = {{ isset($soal) ? count($soal->matchingLefts)+1 : 1 }};
    let rightIndex = {{ isset($soal) ? 65 + count($soal->matchingRights) : 65 }};

    function syncKeyOptions() {
        let rightInputs = document.querySelectorAll('#right-box input');
        let selects = document.querySelectorAll('#key-box select');

        selects.forEach(select => {
            let current = select.value;

            select.innerHTML = `<option value="">Pilih pasangan</option>`;

            rightInputs.forEach(input => {
                let label = input.name.match(/\[(.*?)\]/)[1];
                let opt = document.createElement('option');
                opt.value = label;
                opt.textContent = label;

                if (label === current) opt.selected = true;

                select.appendChild(opt);
            });
        });
    }
    function addKeyRow(label) {
        let box = document.getElementById('key-box');
        let div = document.createElement('div');
        div.classList.add('mb-2');
        let options = `<option value="">Pilih pasangan</option>`;
        document.querySelectorAll('#right-box input').forEach(input => {
            let l = input.name.match(/\[(.*?)\]/)[1];
            options += `<option value="${l}">${l}</option>`;
        });

        div.innerHTML = `
            <label>${label}</label>
            <select name="keys[${label}]" class="form-control">
                ${options}
            </select>
        `;

        box.appendChild(div);
    }
    function addLeft() {
        let box = document.getElementById('left-box');
        let count = box.children.length + 1;
        let div = document.createElement('div');
        div.classList.add('mb-2');
        div.innerHTML = `
            <input type="text"
                name="left[${count}]"
                class="form-control"
                placeholder="Pernyataan ${count}">
        `;
        box.appendChild(div);
        addKeyRow(count);
    }
    function addRight() {
        let box     = document.getElementById('right-box');
        let count   = box.children.length;
        let label   = String.fromCharCode(65 + count);
        let div     = document.createElement('div');
        div.classList.add('mb-2');

        div.innerHTML = `
            <input type="text"
                name="right[${label}]"
                class="form-control"
                placeholder="Jawaban ${label}">
        `;

        box.appendChild(div);

        syncKeyOptions();
    }

    // default create
    @if(!isset($soal))
        addLeft();
        addLeft();
        addRight();
        addRight();
    @endif
</script>
@endif
@endpush
