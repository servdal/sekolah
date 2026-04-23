@extends('adminlte3.layout')
@section('content')    
    <div class="wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Edit Ujian: {{ $exam->nama_ujian }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/')}}/ujian"><i class="fa fa-dashboard"></i> Kembali</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <form method="POST" action="{{ route('exam.update',$exam) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                Informasi Ujian
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Judul</label>
                                        <input type="text" name="judul" class="form-control" value="{{ $exam->nama_ujian }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Password Ujian</label>
                                        <input type="text" name="password" class="form-control" readonly value="{{ $exam->exam_password }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Mapel</label>
                                        <select name="mapel" class="form-control">
                                            @foreach($matpels as $m)
                                            <option value="{{ $m->muatan }}"
                                                {{ $exam->mapel==$m->muatan?'selected':'' }}>
                                                {{ $m->muatan }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Kelas</label>
                                        <select name="kelas" id="kelas" class="form-control">
                                            @foreach($kelas as $k)
                                            <option value="{{ $k->klspos }}"
                                                {{ $exam->kelas==$k->klspos?'selected':'' }}>
                                                Kelas {{ $k->klspos }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <label>Mulai</label>
                                        <input type="datetime-local" name="mulai"
                                            value="{{ date('Y-m-d\TH:i', strtotime($exam->tanggal_mulai)) }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        <label>Durasi (menit)</label>
                                        <input type="number" name="durasi" class="form-control"
                                            value="{{ $exam->durasi_menit }}">
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <label>Status Ujian</label>
                                        <select name="status" class="form-control">
                                            <option value="draft"   {{ $exam->status=='draft'?'selected':'' }}>Draft</option>
                                            <option value="aktif"   {{ $exam->status=='aktif'?'selected':'' }}>Aktif</option>
                                            <option value="selesai" {{ $exam->status=='selesai'?'selected':'' }}>Selesai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mt-3">
                            <div class="card-header bg-primary">Peserta Ujian</div>
                            <div class="card-body">
                                <div id="peserta-box">
                                    @include('exam.partials.peserta_selected', ['peserta'=>$peserta])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>Soal Ujian</strong>
                                <button type="button" class="btn btn-primary btn-sm float-right"
                                        data-toggle="modal" data-target="#modalSoal">
                                    <i class="fa fa-plus"></i> Tambah Soal
                                </button>
                            </div>

                            <div class="card-body">

                                <ul class="todo-list" id="sortable-soal" data-widget="todo-list">

                                    @foreach($examQuestions as $i => $q)
                                    <li data-id="{{ $q->question_bank_id }}">
                                        <span class="handle">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>

                                        <span class="badge badge-info nomor-urut mr-2">{{ $i+1 }}</span>

                                        <span class="text">
                                            <b>[{{ strtoupper($q->questionBank->tipe) }}]</b>
                                            {!! Str::limit(strip_tags($q->questionBank->pertanyaan), 50, '...') !!}
                                        </span>

                                        <input type="hidden" name="soals[]" value="{{ $q->question_bank_id }}">
                                        <input type="number" name="bobot[{{ $q->question_bank_id }}]"
                                                class="form-control form-control-sm d-inline-block ml-2"
                                                value="{{ $q->bobot ?? 1 }}"
                                                min="0" max="100"
                                                style="width:80px; display:inline-block;">
                                        <div class="tools">
                                            <i class="fa fa-trash remove-soal" style="cursor:pointer;color:red;"></i>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-success mt-3">
                            <i class="fa fa-save"></i> Update Ujian
                        </button>

                    </div>
                </div>
                </form>
            </div>
        </section>
    </div>
    <input class="form-control" type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="modal fade" id="modalSoal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

            <div class="modal-header bg-primary">
                <h4 class="modal-title">Pilih Soal dari Bank Soal</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <div class="modal-body">

                <table id="tabel-bank-soal" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th width="5%"></th>
                            <th>Preview</th>
                            <th>Mapel</th>
                            <th>Kelas</th>
                            <th>Tipe</th>
                        </tr>
                    </thead>
                </table>

            </div>

            <div class="modal-footer">
                <button type="button" id="tambah-soal-terpilih" class="btn btn-success">
                    <i class="fa fa-check"></i> Tambahkan
                </button>
            </div>

            </div>
        </div>
    </div>
@endsection
@push('script')

<script>
$(function(){

    /* =============================
       DATATABLES BANK SOAL (MODAL)
       ============================= */
    let table = $('#tabel-bank-soal').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url("/ujian/data-soal/".$exam->id) }}',
        columns: [
            { data:'cek', orderable:false, searchable:false },
            { data:'preview', name:'pertanyaan' },
            { data:'mapel' },
            { data:'kelas' },
            { data:'tipe' },
        ]
    });


    /* =============================
       TAMBAHKAN SOAL KE LIST
       ============================= */
    $('#tambah-soal-terpilih').click(function(){

        $('#tabel-bank-soal input[type=checkbox]:checked').each(function(){

            let id = $(this).val();
            let text = $(this).data('text');

            // CEK kalau sudah ada → skip
            if($("#sortable-soal li[data-id='"+id+"']").length > 0){
                return;
            }

            // INSERT
            $("#sortable-soal").append(`
                <li data-id="${id}" class="highlight-new">

                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>

                    <span class="badge badge-info nomor-urut mr-2"></span>
                    <span class="text">
                        <b>[${$(this).data('tipe')}]</b> ${text}
                    </span>
                    <input type="hidden" name="soals[]" value="${id}">
                    <input type="number" name="bobot[${id}]" 
                        class="form-control form-control-sm ml-2"
                        style="width:80px; display:inline-block;"
                        value="1" min="0" max="100">
                    <div class="tools">
                        <i class="fa fa-trash remove-soal"
                           style="cursor:pointer;color:red;"></i>
                    </div>

                </li>
            `);
        });

        updateUrut();
        $('#tabel-bank-soal').DataTable().ajax.reload(null, false);
        $('#modalSoal').modal('hide');

        // HILANGKAN highlight setelah 1 detik
        setTimeout(()=>{
            $('.highlight-new').removeClass('highlight-new');
        }, 1000);
    });


    /* =============================
       DRAG & DROP
       ============================= */
    $('#sortable-soal').sortable({
        handle: '.handle',
        update: function(){ updateUrut() }
    });


    /* =============================
       HAPUS SOAL
       ============================= */
    $(document).on('click','.remove-soal',function(){
        $(this).closest('li').remove();
        updateUrut();
    });


    /* =============================
       UPDATE NOMOR URUT
       ============================= */
    function updateUrut(){
        $('#sortable-soal li').each(function(i){
            $(this).find('.nomor-urut').text(i+1);
        });
    }
    

});
</script>

<style>
.highlight-new {
    background: #d4f6d4 !important;
    transition: background 1s ease;
}
</style>
@endpush