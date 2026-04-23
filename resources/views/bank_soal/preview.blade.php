@extends('adminlte3.layout')

@section('content')
<div class="wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title text-white">
                        <i class="fa fa-eye"></i> Preview Soal (Mode ANBK)
                    </h3>
                </div>

                <div class="card-body" style="font-size:16px">

                    {{-- STIMULUS --}}
                    @if($bank_soal->stimulus)
                        <div class="alert alert-secondary">
                            {!! $bank_soal->stimulus !!}
                        </div>
                    @endif

                    {{-- PERTANYAAN --}}
                        <div class="mb-3 font-weight-bold">
                            {!! $bank_soal->pertanyaan !!}
                        </div>

                    {{-- ============ PILIHAN GANDA ============ --}}
                    @if($bank_soal->tipe == 'pg')
                        @foreach($bank_soal->options as $opt)
                            <div class="border rounded p-2 mb-2">
                                <label>
                                    <input type="radio" disabled> {!! $opt->teks !!}
                                </label>
                            </div>
                        @endforeach
                    @endif

                    {{-- ============ PG KOMPLEKS ============ --}}
                    @if($bank_soal->tipe == 'pg_kompleks')
                        @foreach($bank_soal->options as $opt)
                        <div class="border rounded p-2 mb-2">
                            <label>
                                <input type="checkbox" disabled> {!! $opt->teks !!}
                            </label>
                        </div>
                        @endforeach
                    @endif

                    {{-- ============ MENJODOHKAN ============ --}}
                    @if($bank_soal->tipe == 'menjodohkan')
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr class="bg-light"><th>Pernyataan</th></tr>
                                    @foreach($bank_soal->matchingLefts as $l)
                                    <tr><td>{{ $l->label }}. {!! $l->teks !!}</td></tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr class="bg-light"><th>Jawaban</th></tr>
                                    @foreach($bank_soal->matchingRights as $r)
                                    <tr><td>{{ $r->label }}. {!! $r->teks !!}</td></tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <p class="text-muted mt-2">Peserta akan memasangkan pernyataan dengan jawaban.</p>
                    @endif

                    {{-- ============ BENAR / SALAH ============ --}}
                    @if($bank_soal->tipe == 'benar_salah')
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th width="70%">Pernyataan</th>
                                    <th class="text-center">Benar</th>
                                    <th class="text-center">Salah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bank_soal->options as $opt)
                                <tr>
                                    <td>{!! $opt->teks !!}</td>
                                    <td class="text-center"><input type="radio" disabled></td>
                                    <td class="text-center"><input type="radio" disabled></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    {{-- ============ ESAI ============ --}}
                    @if($bank_soal->tipe == 'esai')
                        <textarea class="form-control" rows="5" disabled placeholder="Jawaban peserta..."></textarea>
                    @endif
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('bank-soal.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
