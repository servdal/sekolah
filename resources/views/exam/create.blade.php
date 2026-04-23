@extends('adminlte3.layout')
@section('content')

<div class="content-header">
    <h3>Buat Ujian</h3>
</div>

<form method="POST" action="{{ route('exam.store') }}" id="form-ujian">
@csrf

<div class="card">
    <div class="card-body">

        {{-- =================== FORM INFO UJIAN =================== --}}
        <div class="row">
            <div class="col-md-4">
                <label>Judul Ujian</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="col-md-2">
                <label>Password Ujian</label>
                <input type="text" value="otomatis" readonly class="form-control">
            </div>

            <div class="col-md-2">
                <label>Mapel</label>
                <select name="mapel" id="mapel" class="form-control">
                    @foreach($matpels as $m)
                    <option value="{{ $m->matpel }}">{{ $m->muatan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label>Kelas</label>
                <select name="kelas" id="kelas" class="form-control">
                    @foreach($kelas as $k)
                    <option value="{{ $k->klspos }}">Kelas {{ $k->klspos }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label>Mulai</label>
                <input type="datetime-local" name="mulai" class="form-control">
            </div>

            <div class="col-md-2">
                <label>Durasi (menit)</label>
                <input type="number" name="durasi" class="form-control">
            </div>
            <div class="col-md-2">
                <label>Status Ujian</label>
                <select name="status" class="form-control">
                    <option value="draft">Draft</option>
                    <option value="aktif">Aktif</option>
                </select>
            </div>
        </div>

        <hr>

        {{-- =================== PESERTA =================== --}}
        <h5>Peserta Ujian</h5>
        <div id="peserta-box">
            @include('exam.partials.peserta', ['data' => collect() ])
        </div>

        
        <hr>

        {{-- =================== TABEL SOAL DATATABLE =================== --}}
        <h5>Pilih Soal</h5>

        <table class="table table-bordered" id="tabel-soal">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>Mapel</th>
                    <th>Kelas</th>
                    <th>Jenis</th>
                    <th>Preview</th>
                </tr>
            </thead>
        </table>
        

        <hr>

        {{-- =================== LIST SOAL TERPILIH =================== --}}
        <h5>Soal Terpilih</h5>
        <ul id="selected-list" class="list-group"></ul>
        

        <button class="btn btn-success mt-4"><i class="fa fa-save"></i> Simpan Ujian</button>

    </div>
</div>

</form>

@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.getElementById('kelas').addEventListener('change', refreshPeserta);

    function refreshPeserta(){
        fetch('/ujian/peserta/' + document.getElementById('kelas').value)
            .then(r => r.text())
            .then(html => document.getElementById('peserta-box').innerHTML = html);
    }

    refreshPeserta(); // load awal
    $(document).on('change', '#check-all-peserta', function() {
        // Ambil status checked dari tombol induk
        const isChecked = $(this).prop('checked');
        
        // Cari semua checkbox dengan name="peserta[]" di dalam #peserta-box dan samakan statusnya
        $('#peserta-box input[name="peserta[]"]').prop('checked', isChecked);
    });
</script>

<script>
    let tabelSoal;

    function loadSoal() {
        if (tabelSoal) tabelSoal.destroy();

        tabelSoal = $('#tabel-soal').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("exam.soal.json") }}',
                data: function(d){
                    d.mapel = $('#mapel').val();
                    d.kelas = $('#kelas').val();
                }
            },
            columns: [
            { 
                data: 'checkbox',
                orderable:false,
                searchable:false,
                title: '<input type="checkbox" id="check-all-soal">',
            },
            { data: 'mapel' },
            { data: 'kelas' },
            { data: 'tipe' },
            { data: 'preview' }
            ]
        });
    }

    $('#mapel,#kelas').change(loadSoal);
    
    loadSoal();
    $(document).on('change', '#check-all-soal', function() {
        const isChecked = $(this).prop('checked');

        // Loop semua checkbox soal yang ada di halaman aktif
        $('.soal-check').each(function() {
            // Hanya trigger jika statusnya berbeda (untuk menghindari duplikasi proses)
            if ($(this).prop('checked') !== isChecked) {
                $(this).prop('checked', isChecked).trigger('change');
            }
        });
    });
</script>
<script>
    const selectedList = document.getElementById("selected-list");
    const selectedSoals = new Set();
    function highlightItem(el) {
        el.style.boxShadow = "0 0 8px 2px #ffe27a";
        el.style.transition = "box-shadow 1.2s ease";

        setTimeout(() => {
            el.style.boxShadow = "none";
        }, 1200);
    }

    $(document).on('change', '.soal-check', function(){
        const id = $(this).val();
        const row = $(this).closest('tr');
        const tipe = row.find('td:eq(3)').text();
        const preview = row.find('td:eq(4)').text();
        if (this.checked) {
            selectedSoals.add(id);
            addSelected(id, tipe, preview);
        } else {
            selectedSoals.delete(id);
            removeSelected(id);
        }
    });
    

    function addSelected(id, tipe, preview){
        let item = document.createElement("li");
        item.classList.add("list-group-item");
        item.setAttribute("data-id", id);
        item.innerHTML = `
            <div class="d-flex justify-content-between">
                
                <div>
                    <b>${tipe}</b> — ${preview}
                    <input type="hidden" name="soals[]" value="${id}">
                </div>

                <div>
                    <input type="number" name="bobot[${id}]" 
                        class="form-control form-control-sm d-inline-block"
                        value="1" 
                        min="0" max="100"
                        style="width:80px; display:inline-block;">

                    <button type="button" 
                            class="btn btn-danger btn-sm remove-item">
                        Hapus
                    </button>
                </div>

            </div>
        `;
        selectedList.appendChild(item);
        highlightItem(item);
    }

    function removeSelected(id){
        document.querySelector(`#selected-list li[data-id="${id}"]`)?.remove();
    }
    


    $(document).on('click','.remove-item',function(){
        const li = this.closest("li");
        const id = li.dataset.id;
        selectedSoals.delete(id);
        li.remove();
    });

    new Sortable(selectedList, { animation:150 });
</script>
@endpush