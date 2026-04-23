@extends('adminlte3.layout')
@section('content')
<div class="content-header">
    <h3>Kelola Soal – {{ $exam->nama_ujian }}</h3>
</div>

<div class="row">

{{-- KOLOM KIRI: BANK SOAL --}}
<div class="col-md-5">
    <div class="card">
        <div class="card-header bg-info">Bank Soal</div>
        <div class="card-body">
            <form method="POST" action="{{ route('exam.questions.add',$exam) }}">
                @csrf
                <select name="question_bank_id" class="form-control mb-2">
                    @foreach($bankSoals as $s)
                        <option value="{{ $s->id }}">
                            {{ $s->mapel }} - {{ strtoupper($s->tipe) }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-success btn-sm w-100">
                    ➕ Tambahkan ke Ujian
                </button>
            </form>
        </div>
    </div>
</div>

{{-- KOLOM KANAN: SOAL UJIAN --}}
<div class="col-md-7">
    <div class="card">
        <div class="card-header bg-success">
            Soal Ujian (Drag untuk urutkan)
        </div>

        <ul class="list-group" id="sortable">
            @foreach($examQuestions as $q)
            <li class="list-group-item d-flex justify-content-between"
                data-id="{{ $q->id }}">
                <span>
                    <b>{{ $q->nomor }}.</b>
                    {{ Str::limit(strip_tags($q->question->pertanyaan),50) }}
                </span>

                <form method="POST"
                    action="{{ route('exam.questions.remove',[$exam,$q]) }}">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-xs">✖</button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>
</div>

</div>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
new Sortable(document.getElementById('sortable'), {
    animation: 150,
    onEnd: function () {
        let order = [];
        document.querySelectorAll('#sortable li')
            .forEach(li => order.push(li.dataset.id));

        fetch('{{ route('exam.questions.reorder',$exam) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.getElementById('token').value,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({order})
        });
    }
});
</script>
@endpush
