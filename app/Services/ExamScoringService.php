<?php
namespace App\Services;

use App\Models\ExamQuestion;
use App\Models\QuestionBank;
use App\Models\StudentAnswer;

class ExamScoringService
{
    /**
     * Hitung nilai 1 soal untuk siswa
     */
    public function scoreQuestionWithWeight(int $questionBankId, $rawAnswer, float $bobot): float
    {
        $question = QuestionBank::with([
            'options', 
            'matchingLefts.keys.right',
            'matchingRights'
        ])->findOrFail($questionBankId);

        // Bungkus jawaban menjadi object StudentsAnswer palsu
        $fake = new StudentAnswer();
        $fake->jawaban = json_encode($rawAnswer);
        $fake->decoded = $rawAnswer;

        // Hitung sesuai tipe
        $baseScore = match ($question->tipe) {
            'pg'            => $this->scorePG($question, $fake, $bobot),
            'pg_kompleks'   => $this->scorePGKompleks($question, $fake, $bobot),
            'menjodohkan'   => $this->scoreMatching($question, $fake, $bobot),
            'benar_salah'   => $this->scoreBenarSalah($question, $fake, $bobot),
            default         => 0, // esai tidak otomatis
        };

        // Sesuaikan bobot (override bobot question if needed)
        return round($baseScore * $bobot, 2);
    }

    public function scoreQuestion(ExamQuestion $examQuestion, StudentAnswer $answer): float
    {
        $question = $examQuestion->questionBank;
        $tipe = $question->tipe;
        $bobot = $examQuestion->bobot ?? 1;

        return match($tipe) {
            'pg'           => $this->scorePG($question, $answer, $bobot),
            'benar_salah'  => $this->scoreBenarSalah($question, $answer, $bobot),
            'pg_kompleks'  => $this->scorePGKompleks($question, $answer, $bobot),
            'menjodohkan'  => $this->scoreMatching($question, $answer, $bobot),
            default        => 0 // Esai manual
        };
    }


    /** ===============================
     *  TIPE 1: PILIHAN GANDA (PG)
     *  Jawaban = {"ans":"option_id"}
     *  =============================== */
    protected function scorePG(QuestionBank $question, StudentAnswer $answer, float $bobot): float
    {
        $student = json_decode($answer->jawaban, true);
        $ans = $student['ans'] ?? null;

        $correctId = $question->options()->where('is_correct', 1)->value('id');

        return $ans == $correctId ? $bobot : 0;
    }


    /** =================================
     *  TIPE 2: BENAR / SALAH
     *  Format baru sama dengan PG → {"ans":"option_id"}
     *  ================================= */
    protected function scoreBenarSalah(QuestionBank $question, StudentAnswer $answer, float $bobot): float
    {
        $student = json_decode($answer->jawaban, true);
        $pairs = $student['ans'] ?? [];

        if (!is_array($pairs)) return 0;

        // Ambil kunci benar/salah dari database
        // format: [option_id => true/false]
        $correct = $question->options()
            ->pluck('is_correct', 'id')
            ->map(fn($v) => (bool)$v)
            ->toArray();

        $total = count($correct);
        $benar = 0;

        foreach ($correct as $optionId => $nilaiBenar) {
            $nilaiSiswa = $pairs[$optionId] ?? null;
            if ($nilaiSiswa === $nilaiBenar) {
                $benar++;
            }
        }

        return $benar === $total ? $bobot : 0;
    }



    /** =================================
     *  TIPE 3: PG KOMPLEKS (Checkbox)
     *  contoh jawaban:
     *  {"ans":["12","14","15"]}
     *  ================================= */
    protected function scorePGKompleks(QuestionBank $question, StudentAnswer $answer, float $bobot): float
    {
        $student = json_decode($answer->jawaban, true);
        $studentIds = $student['ans'] ?? [];

        if (!is_array($studentIds)) {
            $studentIds = [$studentIds];
        }

        $correctIds = $question->options()
            ->where('is_correct', 1)
            ->pluck('id')
            ->toArray();

        sort($studentIds);
        sort($correctIds);

        return ($studentIds == $correctIds) ? $bobot : 0;
    }


    /** =================================
     *  TIPE 4: MENJODOHKAN
     *  contoh jawaban:
     *  {"ans":{"3":"B","4":"A"}}
     *  ================================= */
    protected function scoreMatching(QuestionBank $question, StudentAnswer $answer, float $bobot): float
    {
        $student = json_decode($answer->jawaban, true);
        $pairs = $student['ans'] ?? [];

        if (!is_array($pairs)) return 0;

        $keys = $question->matchingLefts()->with('keys')->get();

        $total = $keys->count();
        $correct = 0;

        foreach ($keys as $left) {
            $rightId = $left->keys->first()->right_id ?? null;
            $studentRight = $pairs[$left->id] ?? null;

            if ($studentRight == $rightId) {
                $correct++;
            }
        }

        return $correct == $total ? $bobot : 0;
    }


    /** ==================
     * HITUNG NILAI UJIAN
     * ================== */
    public function scoreExam(int $examId, int $studentId): float
    {
        $answers = StudentAnswer::where('exam_id', $examId)
            ->where('student_id', $studentId)
            ->with(['examQuestion', 'examQuestion.questionBank'])
            ->get();

        $total = 0;

        foreach ($answers as $answer) {
            $examQuestion = $answer->examQuestion;

            if (!$examQuestion) continue;

            $nilai = $this->scoreQuestion($examQuestion, $answer);

            $answer->update(['nilai' => $nilai]);

            $total += $nilai;
        }

        return round($total, 2);
    }
}
