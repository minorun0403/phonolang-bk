<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RepositoryInterfaces\QuestionRepositoryInterface;

class LessonController extends Controller
{

    protected $questionRepo;

    public function __construct(QuestionRepositoryInterface $questionRepo)
    {
        $this->questionRepo = $questionRepo;
    }

    public function entryPoint()
    {
        $total_questions = 12;
        $lesson_id = 1;
        $question_no = 1;

        return view("lesson.lesson", compact('lesson_id', 'question_no'));
    }

    // 2問目以降用
    // public function next($lesson_id, $question_no)
    // {
    //     $total_questions = 9;

    //     if ($question_no >= $total_questions) {
    //         return response()->json(['status' => 'complete']);
    //     }

    //     // 次の問題のHTMLを返す
    //     $next_question_no = $question_no + 1;
    //     $view = ($next_question_no >= 4 && $next_question_no <= 7) ? 'lesson.part2' : 'lesson.part1';
        
    //     $html = view($view, compact('lesson_id', 'next_question_no', 'total_questions'))->render();

    //     return response()->json(['status' => 'success', 'html' => $html]);
    // }

    public function answer(Request $request, $lesson_id, $question_no)
    {
        // Lessonモデルから該当のレッスンを取得
        // $lesson = Lesson::find($lesson_id);

        // if (!$lesson || $lesson->isFinished()) {
        //     return response()->json(['finished' => true]);
        // }

        // 答え合わせ部分の質問のHTMLを返す
        // return response()->json([
        //     'finished' => false,
        //     'html' => view('lesson.partial.answer')->render()
        // ]);

        $userAnswer = $request->input('answer');
    
        return response()->json([
            'finished' => false,
            'html' => view('lesson.partial.answer', [
                'correct' => false,
                'userAnswer' => $userAnswer
            ])->render()
        ]);
    }
}
