@extends('adminlte3.layout')
@section('content')
<div class="wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1>Tambah Soal Bank</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">

                <div class="card-header">
                    <h3 class="card-title">Form Soal</h3>
                </div>

                <form method="POST" action="{{ route('bank-soal.store') }}">
                    @csrf

                    <div class="card-body">

                        @include('bank_soal.partials.form-meta')

                        <hr>

                        <div id="formTipe">
                            <p class="text-muted">Silakan pilih tipe soal.</p>
                        </div>

                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-success">
                            <i class="fa fa-save"></i> Simpan Soal
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
    <script>
        CKEDITOR.replace('stimulusEditor', { height: 150 });
        CKEDITOR.replace('pertanyaanEditor', { height: 200 });
    </script>
    <script type="text/javascript">
        document.getElementById('tipeSoal').addEventListener('change', function () {
            let tipe = this.value;
            let container = document.getElementById('formTipe');

            fetch(`/bank-soal/form/${tipe}`)
            .then(res => res.text())
            .then(html => container.innerHTML = html);
        });
        
    </script>
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
        addPgk(); addPgk(); addPgk(); addPgk();
        @endif
    </script>
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
@endpush