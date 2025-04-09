<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LessonService;
use App\Repositories\RepositoryInterfaces\WordQuestionRepositoryInterface;
use App\Repositories\RepositoryInterfaces\WordChoiceRepositoryInterface;

class LessonController extends Controller
{

    protected $word_question_repo;
    protected $word_choice_repo;
    protected $lesson_service;

    public function __construct(LessonService $lesson_service, WordQuestionRepositoryInterface $word_question_repo, WordChoiceRepositoryInterface $word_choice_repo)
    {
        $this->lesson_service = $lesson_service;
        $this->word_question_repo = $word_question_repo;
        $this->word_choice_repo = $word_choice_repo;
    }

    public function entryPoint()
    {
        $lesson_id = 1;
        $user_language_id = 2;
        $progress = 30;

        $question_no = $this->lesson_service->getQuestionNo(); //問題番号
        [$word_question_id, $question_word] = $this->lesson_service->getQuestionWord($lesson_id, $question_no);//単語問題ID, 問題単語, レッスンID
        $question_word_meanings =  $this->lesson_service->getQuestionWordMeaning($lesson_id, $user_language_id);//単語問題の意味
        // $question_choices =  $this->lesson_service->getQuestionChoices($word_question_id);//選択肢

        return view("lesson.lesson", compact('question_word' , 'question_word_meanings', 'question_no', 'lesson_id', 'word_question_id', 'progress'));
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
    // }l

    public function answer(Request $request, $lesson_id, $question_no)
    {

        $user_language_id = 2;
        $userAnswer = $request->input('answer');
        $question_word_meanings =  $this->lesson_service->getQuestionWordMeaning($lesson_id, $user_language_id);//単語問題の意味
        // $question_choices =  $this->lesson_service->getQuestionChoices($question_id);//選択肢

        return response()->json([
            'finished' => false,
            'html' => view('lesson.partial.answer', [
                'correct' => false,
                'userAnswer' => $userAnswer,
                'question_word_meanings' => $question_word_meanings,
                'lesson_id' => $lesson_id,
            ])->render()
        ]);
    }
}
