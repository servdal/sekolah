<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $isPreview ? '[PREVIEW]' : '' }} {{ $exam->nama_ujian }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">

    <style>
        body { background-color: #f4f6f9; overflow-x: hidden; }
        
        /* Header Warna Beda untuk Preview */
        .navbar-exam { 
            background-color: {{ $isPreview ? '#e0a800' : '#2c3b41' }}; /* Kuning utk Preview, Gelap utk Ujian */
            color: white; border-bottom: 3px solid #007bff; 
        }
        
        .timer-box { background: #000; padding: 5px 15px; border-radius: 4px; font-family: monospace; font-size: 1.2rem; font-weight: bold; color: #00ff00; border: 1px solid #555; }
        
        /* Navigasi & Soal Layout */
        .nav-card { position: sticky; top: 20px; max-height: 85vh; overflow-y: auto; }
        .nomor-soal-box { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; padding: 10px; }
        .btn-nomor {
            width: 45px; height: 45px; border: 1px solid #ccc; background: #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; cursor: pointer; border-radius: 4px; transition: all 0.2s;
        }
        .btn-nomor.active { background-color: #007bff; color: white; }
        .btn-nomor.answered { background-color: #28a745; color: white; }
        .btn-nomor.ragu { background-color: #ffc107; color: black; }
        
        .option-item { border: 1px solid #e9ecef; padding: 10px 15px; margin-bottom: 10px; border-radius: 5px; cursor: pointer; display: flex; align-items: center; }
        .option-item:hover { background-color: #f8f9fa; }
        .option-item.selected { background-color: #e3f2fd; border-color: #007bff; }
        .opt-label { width: 30px; height: 30px; background: #ddd; color: #333; display: flex; align-items: center; justify-content: center; border-radius: 50%; margin-right: 15px; font-weight: bold;}
        .option-item.selected .opt-label { background: #007bff; color: white; }
        
        .hidden-q { display: none; }
        /* Font size helper */
        .fs-small .soal-text { font-size: 14px; }
        .fs-medium .soal-text { font-size: 16px; }
        .fs-large .soal-text { font-size: 20px; }
        

    </style>
</head>
<body class="layout-top-nav fs-medium">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand-md navbar-exam border-bottom-0 elevation-2">
        <div class="container-fluid">
            <span class="navbar-brand">
                <span class="brand-text font-weight-bold">
                    @if($isPreview) <i class="fas fa-eye"></i> MODE PREVIEW @else CBT SYSTEM @endif
                </span>
            </span>

            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><span class="nav-link text-white font-weight-bold">{{ $exam->nama_ujian }}</span></li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-flex align-items-center">
                    <div class="user-info text-right mr-3 d-none d-md-block" style="line-height: 1.2;">
                        <span class="d-block font-weight-bold">{{ $participant->nama }}</span>
                        <small>{{ $participant->kelas }}</small>
                    </div>
                    <div class="timer-box shadow" id="timer-display">--:--:--</div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="content pt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-outline card-primary elevation-2" style="min-height: 70vh;">
                            <div class="card-header bg-white d-flex justify-content-between">
                                <h5 class="m-0 font-weight-bold text-primary">SOAL NO. <span id="display-no">1</span></h5>
                                <div>
                                    <button class="btn btn-xs btn-default border" onclick="$('body').removeClass('fs-medium fs-large').addClass('fs-small')">A-</button>
                                    <button class="btn btn-xs btn-default border" onclick="$('body').removeClass('fs-small fs-large').addClass('fs-medium')">A</button>
                                    <button class="btn btn-xs btn-default border" onclick="$('body').removeClass('fs-small fs-medium').addClass('fs-large')">A+</button>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach($exam->questions as $index => $q)
                                    @php 
                                        $soal = $q->questionBank;
                                        // Jika preview, jawaban kosong. Jika siswa, load jawaban db
                                        $ans = (!$isPreview && isset($existingAnswers[$soal->id])) ? json_decode($existingAnswers[$soal->id]->jawaban, true) : null;
                                    @endphp
                                    
                                    <div class="question-box hidden-q" id="q-{{ $index }}" data-id="{{ $soal->id }}">
                                        @if($soal->stimulus) <div class="alert alert-light border">{!! $soal->stimulus !!}</div> @endif
                                        <div class="soal-text mb-4">{!! $soal->pertanyaan !!}</div>

                                        <form id="form-{{ $index }}">
                                            {{-- TIPE PG (Pilihan Ganda) --}}
                                            @if($soal->tipe == 'pg')
                                                @foreach($soal->options as $idxOpt => $opt)
                                                    @php $selected = ($ans == $opt->id); @endphp
                                                    <div class="option-item {{ $selected ? 'selected' : '' }}" 
                                                        onclick="pilihPg('{{ $index }}', '{{ $opt->id }}')">

                                                        <div class="opt-label">{{ chr(65+$idxOpt) }}</div>
                                                        <div>{!! $opt->teks !!}</div>

                                                        <input type="radio" name="ans" value="{{ $opt->id }}" class="d-none" {{ $selected ? 'checked' : '' }}>
                                                    </div>
                                                @endforeach

                                            {{-- TIPE BENAR/SALAH --}}
                                            @elseif($soal->tipe == 'benar_salah')
                                                <table class="table table-bordered table-sm">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th width="70%">Pernyataan</th>
                                                            <th class="text-center">Benar</th>
                                                            <th class="text-center">Salah</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($soal->options as $opt)
                                                        @php
                                                            // Jawaban sebelumnya (jika ada)
                                                            $checked = isset($ans[$opt->id]) ? $ans[$opt->id] : null;
                                                        @endphp
                                                        <tr>
                                                            <td>{!! $opt->teks !!}</td>

                                                            <td class="text-center">
                                                                <input type="radio"
                                                                    name="ans[{{ $opt->id }}]"
                                                                    value="benar"
                                                                    {{ $checked == 'benar' ? 'checked' : '' }}
                                                                    onchange="simpan({{ $index }})">
                                                            </td>

                                                            <td class="text-center">
                                                                <input type="radio"
                                                                    name="ans[{{ $opt->id }}]"
                                                                    value="salah"
                                                                    {{ $checked == 'salah' ? 'checked' : '' }}
                                                                    onchange="simpan({{ $index }})">
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            {{-- TIPE PG KOMPLEKS --}}
                                            @elseif($soal->tipe == 'pg_kompleks')
                                                @foreach($soal->options as $opt)
                                                    @php $checked = (is_array($ans) && in_array($opt->id, $ans)); @endphp
                                                    <div class="icheck-primary mb-2">
                                                        <input type="checkbox" id="c-{{$opt->id}}" name="ans[]" value="{{ $opt->id }}" {{ $checked ? 'checked' : '' }} onchange="simpan({{ $index }})">
                                                        <label for="c-{{$opt->id}}">{!! $opt->teks !!}</label>
                                                    </div>
                                                @endforeach
                                            
                                            {{-- TIPE MENJODOHKAN --}}
                                            @elseif($soal->tipe == 'menjodohkan')
                                                <table class="table table-sm table-bordered">
                                                    @foreach($soal->matchingLefts as $left)
                                                    <tr>
                                                        <td width="50%">{{ $left->teks }}</td>
                                                        <td>
                                                            <select name="ans[{{ $left->id }}]" class="form-control form-control-sm" onchange="simpan({{ $index }})">
                                                                <option value="">Pilih...</option>
                                                                @foreach($soal->matchingRights as $right)
                                                                    <option value="{{ $right->id }}" {{ (isset($ans[$left->id]) && $ans[$left->id] == $right->id) ? 'selected' : '' }}>{{ $right->teks }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>

                                            {{-- TIPE ESAI --}}
                                            @elseif($soal->tipe == 'esai')
                                                <textarea name="ans" class="form-control" rows="4" onblur="simpan({{ $index }})">{{ $ans }}</textarea>
                                            @endif
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <button class="btn btn-secondary" id="btn-prev" onclick="nav(-1)">Kembali</button>
                                <div class="custom-control custom-checkbox pt-2">
                                    <input type="checkbox" class="custom-control-input" id="ragu-check" onchange="toggleRagu()">
                                    <label class="custom-control-label text-warning font-weight-bold" for="ragu-check">Ragu-ragu</label>
                                </div>
                                <button class="btn btn-primary" id="btn-next" onclick="nav(1)">Selanjutnya</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-outline {{ $isPreview ? 'card-warning' : 'card-success' }} nav-card elevation-2">
                            <div class="card-header">
                                <h3 class="card-title">Navigasi Soal</h3>
                            </div>
                            <div class="card-body">
                                <div class="nomor-soal-box">
                                    @foreach($exam->questions as $index => $q)
                                        @php 
                                            $soalId = $q->questionBank->id;
                                            $sudahJawab = (!$isPreview && isset($existingAnswers[$soalId])); 
                                        @endphp
                                        <div class="btn-nomor {{ $sudahJawab ? 'answered' : '' }}" id="nav-{{ $index }}" onclick="showSoal({{ $index }})">{{ $index + 1 }}</div>
                                    @endforeach
                                </div>
                                <hr>
                                @if($isPreview)
                                    <a href="{{ url()->previous() }}" class="btn btn-warning btn-block font-weight-bold">
                                        <i class="fas fa-arrow-left"></i> KEMBALI KE PANEL
                                    </a>
                                @else
                                    <button onclick="konfirmasiSelesai()" class="btn btn-success btn-block font-weight-bold">
                                        <i class="fas fa-check"></i> SELESAI UJIAN
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL SELESAI (Hanya untuk Siswa) --}}
@if(!$isPreview)
<div class="modal fade" id="modal-selesai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white"><h5>Konfirmasi Selesai</h5></div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengakhiri ujian? Jawaban tidak bisa diubah lagi.
                <div id="alert-belum" class="alert alert-warning mt-2 d-none">Masih ada soal yang belum dijawab!</div>
            </div>
            <div class="modal-footer justify-content-between">
                <button class="btn btn-default" data-dismiss="modal">Batal</button>
                <form action="{{ route('tryout.finish') }}" method="POST">
                    @csrf
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                    <button class="btn btn-success">Ya, Selesai</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // === CONFIGURATION ===
    const isPreview = @json($isPreview); // Boolean dari controller
    const totalSoal = {{ count($exam->questions) }};
    const examId = {{ $exam->id }};
    let currentIdx = 0;

    $(document).ready(function(){
        showSoal(0);
        if(!isPreview) runTimer(); // Timer hanya jalan jika bukan preview (atau preview dummy timer)
        else $('#timer-display').text("PREVIEW");
    });

    // === NAVIGATION LOGIC ===
    function showSoal(idx) {
        $('.question-box').addClass('hidden-q');
        $(`#q-${idx}`).removeClass('hidden-q');
        
        $('.btn-nomor').removeClass('active');
        $(`#nav-${idx}`).addClass('active');
        
        $('#display-no').text(idx + 1);
        $('#btn-prev').prop('disabled', idx === 0);
        
        if(idx === totalSoal - 1) {
            $('#btn-next').text('Selesai').removeClass('btn-primary').addClass('btn-success')
                .attr('onclick', isPreview ? "alert('Ini hanya preview')" : "konfirmasiSelesai()");
        } else {
            $('#btn-next').text('Selanjutnya').removeClass('btn-success').addClass('btn-primary')
                .attr('onclick', 'nav(1)');
        }

        // Load status ragu
        $('#ragu-check').prop('checked', $(`#nav-${idx}`).hasClass('ragu'));
        currentIdx = idx;
    }

    function nav(step) {
        let next = currentIdx + step;
        if(next >= 0 && next < totalSoal) showSoal(next);
    }

    // === ANSWER LOGIC ===
    function pilihBenarSalah(idx, val) {
        // UI highlight
        let box = $(`#q-${idx}`);

        box.find('.bs-option').removeClass('selected');
        box.find(`input[value="${val}"]`).closest('.bs-option').addClass('selected');
        box.find(`input[value="${val}"]`).prop('checked', true);

        simpan(idx);
    }

    function pilihPg(idx, val) {
        // UI Effect
        $(`#q-${idx} .option-item`).removeClass('selected');
        $(`#q-${idx} input[value="${val}"]`).closest('.option-item').addClass('selected');
        $(`#q-${idx} input[value="${val}"]`).prop('checked', true);
        simpan(idx);
    }

    function toggleRagu() {
        if($('#ragu-check').is(':checked')) $(`#nav-${currentIdx}`).addClass('ragu');
        else $(`#nav-${currentIdx}`).removeClass('ragu');
    }

    function simpan(idx) {
        // === 1) Ambil form dan semua field di dalamnya ===
        let form = $(`#form-${idx}`);
        let raw = form.serializeArray();

        // result jawaban final
        let finalAnswer = {};

        // === 2) Parsing untuk semua tipe soal ===
        raw.forEach(item => {
            let name = item.name;
            let value = item.value;

            // ------ CASE: ans[ID] → benar/salah OR matching ------
            let match = name.match(/^ans\[(.+)\]$/);
            if (match) {
                let key = match[1];

                // Jika nilai benar/salah → convert ke boolean
                if (value === "benar")       finalAnswer[key] = true;
                else if (value === "salah")  finalAnswer[key] = false;
                else finalAnswer[key] = value; // kemungkinan untuk matching (ID right)
                
                return;
            }

            // ------ CASE: ans[] → PG kompleks (checkbox) ------
            if (name === "ans[]") {
                if (!Array.isArray(finalAnswer['multi'])) {
                    finalAnswer['multi'] = [];
                }
                finalAnswer['multi'].push(value);
                return;
            }

            // ------ CASE: ans → PG atau Esai ------
            if (name === "ans") {
                finalAnswer["single"] = value;
                return;
            }
        });


        // === 3) Tentukan mana hasil final yang benar untuk server ===
        // PG
        if (finalAnswer.single !== undefined) {
            finalAnswer = finalAnswer.single;
        }

        // PG KOMPLEKS
        else if (finalAnswer.multi !== undefined) {
            finalAnswer = finalAnswer.multi;
        }

        // BENAR/SALAH atau MENJODOHKAN → finalAnswer sudah berbentuk object
        else {
            // tetap object
        }


        // === 4) Tandai navigasi answered (warna hijau) ===
        let hasIsi = false;

        if (typeof finalAnswer === "string" && finalAnswer.trim() !== "") hasIsi = true;
        else if (Array.isArray(finalAnswer) && finalAnswer.length > 0) hasIsi = true;
        else if (typeof finalAnswer === "object" && Object.keys(finalAnswer).length > 0) hasIsi = true;

        if (hasIsi) $(`#nav-${idx}`).addClass('answered');
        else $(`#nav-${idx}`).removeClass('answered');


        // === 5) Jika PREVIEW → tidak kirim ke server ===
        if (isPreview) {
            console.log("PREVIEW MODE — Tidak dikirim", finalAnswer);
            return;
        }


        // === 6) Kirim AJAX ke server (sesuai Controller tryout.save) ===
        $.post("{{ route('tryout.save') }}", {
            _token: $('meta[name="csrf-token"]').attr('content'),
            exam_id: examId,
            question_id: $(`#q-${idx}`).data('id'),
            jawaban: finalAnswer
        }).fail(function(err){
            console.error("Gagal simpan jawaban!", err.responseText);
        });
    }


    // === TIMER & FINISH LOGIC (SISWA ONLY) ===
    let timeLeft = {{ $sisaDetik }}; 

    function runTimer() {
        // Interval check setiap 1 detik
        const timerInterval = setInterval(() => {
            // Jika waktu habis
            if(timeLeft <= 0) { 
                clearInterval(timerInterval);
                $('#timer-display').text("00:00:00").addClass('text-danger');
                
                // Cek isPreview agar guru tidak auto submit
                if(!isPreview) {
                    alert("Waktu Ujian Telah Habis! Jawaban akan disimpan.");
                    // Submit Form Finish
                    $('form[action*="finish"]').submit();
                }
                return;
            }
            
            // Konversi detik ke Jam:Menit:Detik
            let h = Math.floor(timeLeft / 3600);
            let m = Math.floor((timeLeft % 3600) / 60);
            let s = Math.floor(timeLeft % 60);

            // Format string 00:00:00
            let hStr = h < 10 ? "0" + h : h;
            let mStr = m < 10 ? "0" + m : m;
            let sStr = s < 10 ? "0" + s : s;

            $('#timer-display').text(`${hStr}:${mStr}:${sStr}`);
            
            // Kurangi 1 detik
            timeLeft--;

        }, 1000);
    }

    function konfirmasiSelesai() {
        let belum = 0;
        $('.btn-nomor').each(function() { if(!$(this).hasClass('answered')) belum++; });
        
        if(belum > 0) $('#alert-belum').removeClass('d-none').text(`Ada ${belum} soal belum dijawab!`);
        else $('#alert-belum').addClass('d-none');
        
        $('#modal-selesai').modal('show');
    }
</script>
</body>
</html>