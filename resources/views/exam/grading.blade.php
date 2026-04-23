@extends('adminlte3.layout')

@section('content')
<div class="content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Koreksi & Penilaian</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('exam.result.index', $exam->id) }}" class="btn btn-secondary float-right">
                        <i class="fa fa-arrow-left"></i> Kembali ke Rekap
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            {{-- INFO PESERTA --}}
            <div class="card card-widget widget-user-2 shadow-sm">
                <div class="widget-user-header bg-primary">
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="https://ui-avatars.com/api/?name={{ urlencode($participant->nama) }}&background=fff&color=007bff">
                    </div>
                    <h3 class="widget-user-username">{{ $participant->nama }}</h3>
                    <h5 class="widget-user-desc">{{ $participant->noinduk }} | Kelas {{ $participant->kelas }}</h5>
                </div>
            </div>


            <form action="{{ route('exam.grading.store') }}" method="POST">
                @csrf

                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                <input type="hidden" name="student_id" value="{{ $participant->student_id }}">
                <input type="hidden" name="noinduk" value="{{ $participant->noinduk }}">
                <input type="hidden" name="nama" value="{{ $participant->nama }}">
                <input type="hidden" name="kelas" value="{{ $participant->kelas }}">

                <div class="card">
                    
                    <div class="card-body p-0">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-light">
                                    <tr class="text-center">
                                        <th width="50px">No</th>
                                        <th width="40%">Pertanyaan & Kunci Jawaban</th>
                                        <th width="40%">Jawaban Peserta</th>
                                        <th width="100px">Nilai</th>
                                    </tr>
                                </thead>

                                <tbody>

                                @foreach($questions as $index => $q)

                                    @php
                                        $normalizeTF = function($val) {
                                            $val = strtolower(trim($val));
                                            if (in_array($val, ['true', '1', 'benar'])) return 'benar';
                                            if (in_array($val, ['false', '0', 'salah'])) return 'salah';
                                            return null;
                                        };
                                        $soal      = $q->questionBank;
                                        $tipe      = $soal->tipe;

                                        $ansObj    = $gradingData[$soal->id]['ans_obj'];
                                        $studentAns= $gradingData[$soal->id]['decoded'];
                                        $score     = $gradingData[$soal->id]['score'];
                                        $bobot     = $gradingData[$soal->id]['bobot'];

                                        // ====================== HITUNG BENAR/SALAH ======================
                                        $isCorrect = false;

                                        if ($studentAns !== null) {

                                            if ($tipe == 'pg') {
                                                $correctId = $soal->options->where('is_correct', 1)->first()->id ?? null;
                                                $isCorrect = ($studentAns == $correctId);
                                            }

                                            if ($tipe == 'benar_salah') {
                                                $isCorrect = true;
                                                foreach ($soal->options as $opt) {
                                                    $kunci = $opt->is_correct ? 'benar' : 'salah';
                                                    $jawab = $studentAns[$opt->id] ?? null;
                                                    $jawab = $normalizeTF($jawab);
                                                    if ($jawab !== $kunci) {
                                                        $isCorrect = false;
                                                        break;
                                                    }
                                                }
                                            }

                                            if ($tipe == 'pg_kompleks') {
                                                $correctIds = $soal->options->where('is_correct', 1)->pluck('id')->toArray();
                                                $userIds    = is_array($studentAns) ? $studentAns : [];

                                                sort($correctIds);
                                                sort($userIds);
                                                $isCorrect = ($correctIds == $userIds);
                                            }

                                            if ($tipe == 'menjodohkan') {
                                                $correct = 0;
                                                foreach ($soal->matchingLefts as $left) {
                                                    $right = optional($left->key)->right;
                                                    if (isset($studentAns[$left->id]) && $studentAns[$left->id] == ($right->id ?? null)) {
                                                        $correct++;
                                                    }
                                                }
                                                $isCorrect = ($correct == $soal->matchingLefts->count());
                                            }

                                            if ($tipe == 'esai') {
                                                // Tidak otomatis
                                                $isCorrect = null;
                                            }
                                        }
                                        if ($isCorrect) {
                                            $score = $bobot;
                                        } else {
                                            $score = 0;
                                        }
                                    @endphp


                                    <tr data-qid="{{ $soal->id }}" data-tipe="{{ $tipe }}">

                                        {{-- ===================== NOMOR ===================== --}}
                                        <td class="text-center font-weight-bold">{{ $index + 1 }}</td>

                                        {{-- ===================== PERTANYAAN + KUNCI ===================== --}}
                                        <td style="vertical-align: top;">
                                            <div class="mb-3">{!! $soal->pertanyaan !!}</div>

                                            <div class="alert alert-secondary p-2 mb-0" style="font-size: 0.9em; border-left: 4px solid #28a745;">
                                                <strong class="text-success"><i class="fa fa-key"></i> KUNCI JAWABAN</strong>

                                                <div class="mt-1 pl-3">
                                                    @if($tipe == 'pg')
                                                        @php $kunci = $soal->options->where('is_correct', 1)->first(); @endphp
                                                        {{ $kunci ? strip_tags($kunci->teks) : '-' }}

                                                    @elseif($tipe == 'benar_salah')
                                                        <ul class="mb-0 pl-3">
                                                            @foreach($soal->options as $opt)
                                                                <li>
                                                                    {!! $opt->teks !!} 
                                                                    → <b class="text-success">{{ $opt->is_correct ? 'Benar' : 'Salah' }}</b>
                                                                </li>
                                                            @endforeach
                                                        </ul>

                                                    @elseif($tipe == 'pg_kompleks')
                                                        <ul class="mb-0 pl-3">
                                                            @foreach($soal->options->where('is_correct', 1) as $opt)
                                                                <li>{{ strip_tags($opt->teks) }}</li>
                                                            @endforeach
                                                        </ul>

                                                    @elseif($tipe == 'menjodohkan')
                                                        <ul class="mb-0 pl-3">
                                                            @foreach($soal->matchingLefts as $left)
                                                                @php
                                                                    $right = optional($left->key)->right;
                                                                @endphp
                                                                <li>
                                                                    {{ $left->teks }} 
                                                                    <i class="fa fa-arrow-right text-success"></i> 
                                                                    <b>{{ $right->teks ?? '?' }}</b>
                                                                </li>
                                                            @endforeach
                                                        </ul>

                                                    @elseif($tipe == 'esai')
                                                        <span class="text-muted font-italic">Penilaian manual</span>
                                                    @endif
                                                </div>

                                            </div>
                                        </td>


                                        {{-- ===================== JAWABAN PESERTA ===================== --}}
                                        <td style="vertical-align: top;">

                                            @if($studentAns === null)
                                                <span class="badge badge-danger">Tidak menjawab</span>

                                            @elseif($tipe == 'pg')
                                                @php $opt = $soal->options->where('id', $studentAns)->first(); @endphp
                                                <div class="p-2 border rounded {{ $isCorrect ? 'bg-success-light border-success' : 'bg-danger-light border-danger' }}">
                                                    {!! $opt->teks ?? 'Jawaban tidak valid' !!}
                                                </div>

                                            @elseif($tipe == 'benar_salah')
                                                <table class="table table-sm table-bordered">
                                                    @foreach($soal->options as $opt)
                                                        <tr>
                                                            <td width="70%">{!! $opt->teks !!}</td>
                                                            <td class="text-center">
                                                                {{ $studentAns[$opt->id] ?? '-' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>

                                            @elseif($tipe == 'pg_kompleks')
                                                <ul class="pl-3">
                                                    @foreach($studentAns as $sid)
                                                        @php $opt = $soal->options->where('id', $sid)->first(); @endphp
                                                        <li>{!! $opt->teks ?? $sid !!}</li>
                                                    @endforeach
                                                </ul>

                                            @elseif($tipe == 'menjodohkan')
                                                <ul class="pl-3">
                                                    @foreach($studentAns as $left => $right)
                                                        @php 
                                                            $l = $soal->matchingLefts->where('id', $left)->first();
                                                            $r = $soal->matchingRights->where('id', $right)->first();
                                                        @endphp
                                                        <li>
                                                            {{ $l->teks ?? '?' }} 
                                                            <i class="fa fa-arrow-right text-primary"></i>
                                                            <b>{{ $r->teks ?? '?' }}</b>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                            @elseif($tipe == 'esai')
                                                <div class="p-3 border rounded bg-light" style="white-space: pre-wrap;">
                                                    {{ is_string($studentAns) ? $studentAns : json_encode($studentAns) }}
                                                </div>
                                            @endif

                                            @if($tipe !== 'esai')
                                                <div class="mt-2">
                                                    @if($isCorrect)
                                                        <span class="badge badge-success"><i class="fa fa-check"></i> BENAR</span>
                                                    @else
                                                        <span class="badge badge-danger"><i class="fa fa-times"></i> SALAH</span>
                                                    @endif
                                                </div>
                                            @endif

                                        </td>


                                        {{-- ===================== NILAI ===================== --}}
                                        <td style="vertical-align: top;">
                                            @if($tipe == 'esai')
                                                <input type="number" step="0.1" 
                                                    name="score[{{ $soal->id }}]" 
                                                    value="{{ $ansObj->nilai ?? 0 }}" 
                                                    class="form-control text-center border-warning font-weight-bold">

                                            @else
                                                <input type="text" 
                                                    name="score[{{ $soal->id }}]" 
                                                    value="{{ $score }}" 
                                                    readonly
                                                    class="form-control text-center bg-light">
                                            @endif
                                        </td>

                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                            <div class="p-3 bg-light border-top">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5>Total Nilai PG: <span id="total-pg">0</span></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Total Nilai Esai: <span id="total-esai">0</span></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="text-primary font-weight-bold">TOTAL NILAI: <span id="total-all">0</span></h5>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer bg-white">
                        <button type="submit" class="btn btn-success btn-lg float-right">
                            <i class="fa fa-save mr-2"></i> SIMPAN PENILAIAN
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </section>
</div>

<style>
    .bg-success-light { background-color: #d4edda !important; }
    .bg-danger-light  { background-color: #f8d7da !important; }
</style>

@endsection
@push('script')

<script>
    function hitungTotal() {
        let totalPg   = 0;
        let totalEsai = 0;

        // Loop semua field skor
        document.querySelectorAll("input[name^='score']").forEach(el => {
            let val = parseFloat(el.value) || 0;

            let qId = el.name.replace(/[^0-9]/g, ''); // ambil ID soal

            // Cari tipe soal melalui atribut HTML
            let tipe = document.querySelector(`[data-qid='${qId}']`)?.dataset?.tipe;

            if (tipe === 'esai') totalEsai += val;
            else totalPg += val;
        });

        // Update UI
        document.getElementById('total-pg').innerText   = totalPg.toFixed(2);
        document.getElementById('total-esai').innerText = totalEsai.toFixed(2);
        document.getElementById('total-all').innerText  = (totalPg + totalEsai).toFixed(2);
    }

    // Auto Kalkulasi Saat Input Berubah
    document.addEventListener("input", function(e){
        if(e.target.name && e.target.name.startsWith("score[")) {
            hitungTotal();
        }
    });

    // Jalankan saat page load
    window.onload = hitungTotal;
</script>
@endpush