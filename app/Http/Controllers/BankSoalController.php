<?php
namespace App\Http\Controllers;

use App\Models\{Exam, ExamQuestion, Question, StudentAnswer, ExamParticipant, QuestionBank, QuestionBankOption, User, MatchingLeft, MatchingRight, MatchingKey};
use App\Services\ExamScoringService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Datakkm;
use App\Datainduk;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class BankSoalController extends Controller
{
    public function viewUjian()
    {
        $exams = Exam::where('created_by', auth()->id())->latest()->get();
        return view('exam.index', compact('exams'));
    }
    public function manageQuestions(Exam $exam)
    {
        abort_if($exam->created_by !== auth()->id(), 403);

        $usedIds = $exam->questions()->pluck('question_bank_id');

        $bankSoals = QuestionBank::where('created_by', auth()->id())
            ->whereNotIn('id', $usedIds)
            ->get();

        $examQuestions = $exam->questions()
            ->with('question')
            ->orderBy('nomor')
            ->get();

        return view('exam.questions', compact(
            'exam',
            'bankSoals',
            'examQuestions'
        ));
    }
    public function addQuestion(Request $request, Exam $exam)
    {
        $request->validate([
            'question_bank_id' => 'required|exists:question_banks,id'
        ]);

        $next = $exam->questions()->max('nomor') + 1;

        ExamQuestion::create([
            'exam_id' => $exam->id,
            'question_bank_id' => $request->question_bank_id,
            'nomor' => $next
        ]);

        return back()->with('success','Soal ditambahkan');
    }
    public function removeQuestion(Exam $exam, ExamQuestion $question)
    {
        abort_if($exam->created_by !== auth()->id(), 403);

        $question->delete();

        return back()->with('success','Soal dihapus dari ujian');
    }
    public function reorderQuestions(Request $request, Exam $exam)
    {
        foreach ($request->order as $i => $id) {
            ExamQuestion::where('id',$id)
                ->update(['nomor' => $i + 1]);
        }

        return response()->json(['status'=>'ok']);
    }
    public function createUjian()
    {
        $kelas      = Datainduk::where('id_sekolah',session('sekolah_id_sekolah'))->where('nokelulusan', '')->select('klspos')->distinct()->get();
        $matpels  	= Datakkm::where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('muatan')->get();
        $soals      = QuestionBank::where('created_by',auth()->id())->get();
        return view('exam.create', compact('kelas','soals', 'matpels'));
    }
    public function editUjian(Exam $exam)
    {
        // data mapel dan kelas
        $matpels    = Datakkm::where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('muatan')->get();
        $kelas      = Datainduk::where('id_sekolah',session('sekolah_id_sekolah'))->where('nokelulusan', '')->select('klspos')->distinct()->get();
        $soals      = QuestionBank::where('created_by', auth()->id())->get();
        // soal yang sudah dipilih
        $examQuestions = ExamQuestion::where('exam_id', $exam->id)
            ->orderBy('nomor')
            ->get();

        // peserta yang sudah dipilih
        $peserta = ExamParticipant::where('exam_id', $exam->id)->get();
        return view('exam.edit', compact(
            'exam',
            'matpels',
            'kelas',
            'soals',
            'examQuestions',
            'peserta'
        ));
    }
    public function dataSoalExam(Exam $exam)
    {
        $selected = ExamQuestion::where('exam_id',$exam->id)
                    ->pluck('question_bank_id')->toArray();

        $query = QuestionBank::where('created_by', auth()->id())
                    ->whereNotIn('id',$selected);

        return DataTables::of($query)
            ->addColumn('cek', function($row){
                $text = Str::limit(strip_tags($row->pertanyaan), 80);
                return '
                    <input type="checkbox"
                        value="'.$row->id.'"
                        data-text="'.e($text).'">
                ';
            })
            ->addColumn('tipe', function($row){
                return strtoupper($row->tipe);
            })
            ->addColumn('preview', function($row){
                return Str::limit(strip_tags($row->pertanyaan),120);
            })
            ->rawColumns(['cek'])
            ->make(true);
    }
	public function destroyUjian(Exam $exam)
    {
        if ($exam->created_by != auth()->id()) {
            return back()->with('error','Yang berhak menghapus hanya pembuat soal');
        }
        $exam->delete();

        return back()->with('success','Ujian dihapus');
    }
    public function updateUjian(Request $request, Exam $exam)
    {
        DB::transaction(function() use ($request, $exam) {

            $exam->update([
                'nama_ujian'    => $request->judul,
                'mapel'         => $request->mapel,
                'tanggal_mulai' => $request->mulai,
                'tanggal_selesai' => now()->parse($request->mulai)
                                        ->addMinutes($request->durasi),
                'durasi_menit'  => $request->durasi,
                'status'        => $request->status,
            ]);

            // Update peserta
            ExamParticipant::where('exam_id',$exam->id)->delete();

            foreach($request->peserta ?? [] as $p){
                $s = Datainduk::find($p);

                ExamParticipant::create([
                    'exam_id'       => $exam->id,
                    'student_id'    => $s->id,
                    'noinduk'       => $s->noinduk,
                    'nama'          => $s->nama,
                    'kelas'         => $s->klspos
                ]);
            }

            // Update soal
            $bobot = $request->bobot;
            ExamQuestion::where('exam_id',$exam->id)->delete();

            foreach($request->soals as $i=>$id){
                ExamQuestion::create([
                    'exam_id'           =>$exam->id,
                    'question_bank_id'  =>$id,
                    'nomor'             =>$i+1,
                    'bobot'             => $bobot[$id] ?? 1,
                ]);
            }
        });

        return redirect()->route('exam.index')->with('success','Ujian berhasil diupdate');
    }
    public function loadPeserta($kelas)
    {
        $siswa = DB::table('db_datainduk')->where('klspos',$kelas)->where('nokelulusan', '')->where('id_sekolah',session('sekolah_id_sekolah'))->get();

        return view('exam.partials.peserta',compact('siswa'));
    }
    private function generateUniquePassword($length = 8)
    {
        do {
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $password = '';
            for ($i=0; $i < $length; $i++) {
                $password .= $chars[random_int(0, strlen($chars)-1)];
            }
            $exists = Exam::where('exam_password', $password)->exists();
        } while ($exists);

        return $password;
    }
    public function getSoalData(Request $r)
    {
        $q = QuestionBank::query()
            ->where('created_by', auth()->id());

        if ($r->mapel) {
            $q->where('mapel', $r->mapel);
        }

        if ($r->kelas) {
            $kelas = substr($r->kelas, 0, -1);
            $q->where('kelas', $kelas);
        }

        return datatables()->of($q)
            ->addColumn('preview', function($s){
                return '<div style="font-size:12px; max-width:300px;">'
                    . Str::limit(strip_tags($s->pertanyaan), 80)
                    . '</div>';
            })
            ->addColumn('tipe', function($s){
                return strtoupper($s->tipe);
            })
            ->addColumn('cek', function($q){
                return '<input type="checkbox" class="pilih-soal"
                        value="'.$q->id.'" 
                        data-text="'.strip_tags(Str::limit($q->pertanyaan,60)).'"
                        data-tipe="'.strtoupper($q->tipe).'">';
            })
            ->addColumn('checkbox', function($s){
                return '<input type="checkbox" class="soal-check" value="'.$s->id.'">';
            })
            ->rawColumns(['preview','checkbox'])
            ->make(true);
    }
    public function storeUjian(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'mapel' => 'required',
            'kelas' => 'required',
            'mulai' => 'required|date',
            'durasi' => 'required|integer',
            'soals' => 'required|array'
        ]);

        DB::transaction(function () use ($request) {

            $exam = Exam::create([
                'kode_ujian'      => 'UJ-' . now()->format('YmdHis'),
                'nama_ujian'      => $request->judul,
                'mapel'           => $request->mapel,
                'jenjang'         => Session('sekolah_kode_sekolah') ?? 'SD',
                'durasi_menit'    => $request->durasi,
                'tanggal_mulai'   => $request->mulai,
                'tanggal_selesai' => now()->parse($request->mulai)
                                        ->addMinutes($request->durasi),
                'exam_password'   => $this->generateUniquePassword(),
                'created_by'      => auth()->id(),
                'status'          => $request->status ?? 'draft',
            ]);

            // SIMPAN SOAL
            $bobot = $request->bobot;
            foreach ($request->soals as $i => $id) {
                ExamQuestion::updateOrCreate(
                    [
                        'exam_id'          => $exam->id,
                        'question_bank_id' => $id,
                    ],
                    [
                        'nomor'            => $i + 1,
                        'bobot'            => $bobot[$i] ?? 1,
                    ]
                );
            }

            // SIMPAN PESERTA
            $siswas = $request->peserta;

            foreach ($siswas as $s) {
                $datainduk = Datainduk::find($s);
                ExamParticipant::create([
                    'exam_id'    => $exam->id,
                    'student_id' => $datainduk->id,
                    'noinduk'    => $datainduk->noinduk,
                    'nama'       => $datainduk->nama,
                    'kelas'      => $datainduk->klspos,
                    'status'     => 'belum'
                ]);
            }
        });

        return redirect()->route('exam.index')
            ->with('success', 'Ujian berhasil dibuat');
    }
    public function index()
    {
            
        $soals = QuestionBank::where('created_by', auth()->id())
            ->latest()->paginate(10);

        return view('bank_soal.index', compact('soals'));
    }
    public function create()
    {
        $matpels  	= Datakkm::where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('muatan')->get();
        
        return view('bank_soal.create', compact('matpels'));
    }
    public function show(QuestionBank $bank_soal)
    {
        $bank_soal->load(['options','matchingLefts','matchingRights']);
        return view('bank_soal.preview', compact('bank_soal'));
    }
    public function edit(QuestionBank $bank_soal)
    {
        if ($bank_soal->created_by != auth()->id()) {
            abort(403);
        }
        $matpels  	= Datakkm::where('id_sekolah', Session('sekolah_id_sekolah'))->groupBy('muatan')->get();
        return view('bank_soal.edit', compact('bank_soal', 'matpels'));
    }
    public function destroy(QuestionBank $bank_soal)
    {
        if ($bank_soal->created_by != auth()->id()) {
            return back()->with('error','Yang berhak menghapus hanya pembuat soal');
        }
        $bank_soal->delete();

        return back()->with('success','Soal dihapus');
    }
    public function store(Request $request)
    {
        $soal = QuestionBank::create([
            'created_by' => auth()->id(),
            'mapel' => $request->mapel,
            'kelas' => $request->kelas,
            'tipe' => $request->tipe,
            'stimulus' => $request->stimulus,
            'pertanyaan' => $request->pertanyaan,
            'bobot' => 1
        ]);
        if (in_array($request->tipe, ['pg','pg_kompleks'])) {
            foreach ($request->options as $label => $opt) {
                QuestionBankOption::create([
                    'question_bank_id' => $soal->id,
                    'label' => $label,
                    'teks' => $opt['teks'],
                    'is_correct' =>
                        $request->tipe === 'pg'
                            ? $label === $request->options_benar
                            : isset($opt['benar'])
                ]);
            }
        }
        if ($request->tipe == 'benar_salah') {
            foreach ($request->statements as $label => $text) {
                $soal->options()->create([
                    'label' => $label,
                    'teks' => $text,
                    'is_correct' => $request->answers[$label] ?? 0
                ]);
            }
        }
        if ($request->tipe == 'menjodohkan') {

            $lefts = [];
            $rights = [];

            foreach ($request->left as $i => $text) {
                $lefts[$i] = MatchingLeft::create([
                    'question_bank_id' => $soal->id,
                    'label' => $i,
                    'teks' => $text
                ]);
            }

            foreach ($request->right as $label => $text) {
                $rights[$label] = MatchingRight::create([
                    'question_bank_id' => $soal->id,
                    'label' => $label,
                    'teks' => $text
                ]);
            }

            foreach ($request->keys as $leftLabel => $rightLabel) {
                if (isset($lefts[$leftLabel]) && isset($rights[$rightLabel])) {
                    MatchingKey::create([
                        'left_id' => $lefts[$leftLabel]->id,
                        'right_id' => $rights[$rightLabel]->id
                    ]);
                }
            }
        }


        return redirect()->route('bank-soal.index')
            ->with('success','Soal berhasil disimpan');
    }
    public function formEdit($tipe, $id)
    {
        $soal = QuestionBank::with(['options','matchingLefts','matchingRights'])
            ->findOrFail($id);

        return view("bank_soal.partials.$tipe", compact('soal'));
    } 
    public function update(Request $request, QuestionBank $bank_soal)
    {
        if ($bank_soal->created_by != auth()->id()) {
            abort(403);
        }

        DB::transaction(function () use ($request, $bank_soal) {

            // ========================
            // UPDATE SOAL UTAMA
            // ========================
            $bank_soal->update([
                'mapel' => $request->mapel,
                'kelas' => $request->kelas,
                'stimulus' => $request->stimulus,
                'pertanyaan' => $request->pertanyaan,
                'bobot' => $request->bobot ?? 1
            ]);

            // ========================
            // BERSIHKAN DATA LAMA
            // ========================
            $bank_soal->options()->delete();
            $bank_soal->matchingLefts()->delete();
            $bank_soal->matchingRights()->delete();

            // ========================
            // PILIHAN GANDA & KOMPLEKS
            // ========================
            if (in_array($bank_soal->tipe, ['pg','pg_kompleks'])) {

                foreach ($request->options as $label => $opt) {
                    $bank_soal->options()->create([
                        'label' => $label,
                        'teks' => $opt['teks'],
                        'is_correct' =>
                            $bank_soal->tipe === 'pg'
                                ? ($label === $request->options_benar)
                                : isset($opt['benar'])
                    ]);
                }
            }

            // ========================
            // BENAR / SALAH
            // ========================
            if ($bank_soal->tipe == 'benar_salah') {

                foreach ($request->statements as $key => $text) {
                    $bank_soal->options()->create([
                        'label' => is_numeric($key) ? chr(64+$key) : $key,
                        'teks' => $text,
                        'is_correct' => $request->answers[$key] ?? 0
                    ]);
                }
            }

            // ========================
            // MENJODOHKAN
            // ========================
            if ($bank_soal->tipe == 'menjodohkan') {

                $lefts = [];
                $rights = [];

                foreach ($request->left as $i => $text) {
                    $lefts[$i] = MatchingLeft::create([
                        'question_bank_id' => $bank_soal->id,
                        'label' => $i,
                        'teks' => $text
                    ]);
                }

                foreach ($request->right as $label => $text) {
                    $rights[$label] = MatchingRight::create([
                        'question_bank_id' => $bank_soal->id,
                        'label' => $label,
                        'teks' => $text
                    ]);
                }

                foreach ($request->keys as $leftLabel => $rightLabel) {
                    if (isset($lefts[$leftLabel]) && isset($rights[$rightLabel])) {
                        MatchingKey::create([
                            'left_id' => $lefts[$leftLabel]->id,
                            'right_id' => $rights[$rightLabel]->id
                        ]);
                    }
                }
            }

            // ========================
            // ESAI → tidak ada detail
            // ========================
        });

        return redirect()->route('bank-soal.index')
            ->with('success','Soal berhasil diperbarui');
    }


}
