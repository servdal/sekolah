<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            Daftar Soal Ujian
        </h3>
    </div>

    <div class="card-body">
        <ul class="todo-list" id="sortable-soal" data-widget="todo-list">

            @foreach($examQuestions as $i => $q)
                <li data-id="{{ $q->question_bank_id }}">
                    
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>

                    <!-- nomor urut -->
                    <span class="badge badge-info mr-2 nomor-urut">
                        {{ $i+1 }}
                    </span>

                    <!-- text soal -->
                    <span class="text">
                        {!! Str::limit(strip_tags($q->bank->pertanyaan), 80, '...') !!}
                    </span>

                    <!-- hidden input, nanti urutannya diupdate via JS -->
                    <input type="hidden" name="soals[]" value="{{ $q->question_bank_id }}">

                    <!-- tombol remove -->
                    <div class="tools">
                        <i class="fas fa-trash remove-soal" style="cursor:pointer;color:red;"></i>
                    </div>
                </li>
            @endforeach

        </ul>
    </div>
</div>
