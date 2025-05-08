<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LessonService;
// use Illuminate\Support\Facades\Redis;
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

    public function entrypoint()
    {
        // session(['question_no' => 0]); //開発用！！！本番は消すこと
        $this->lesson_service->getQuestionNo();
        if (empty(session('question_no')) || session('question_no') < 5) {
            return redirect(route('lesson.word'));
        } elseif (session('question_no') < 9) {
            return redirect(route('lesson.word.rev'));
        } else {
            return redirect(route(''));//リスニング用
        }


    }

    public function wordQuestion()
    {
        $lesson_id = 1;
        $user_language_id = 2;
        $progress = 30;

        $question_no = session('question_no') ?? 1; //１問目はセッションが空なので、1を代入
        [$word_question_ids, $word_question_id, $question_word] = $this->lesson_service->getQuestionWord($lesson_id, $question_no);//単語問題ID, 問題単語, レッスンID
        $meanings =  $this->lesson_service->getQuestionWordMeaning($word_question_ids, $lesson_id, $user_language_id)->pluck('meaning', 'word_id')->toArray();;//単語問題の意味
        // $question_choices =  $this->lesson_service->getQuestionChoices($word_question_id);//選択肢

        return view("lesson.lesson", compact('question_word' , 'meanings', 'question_no', 'word_question_id', 'progress'));
    }


    public function answer(Request $request)
    {
        $user_answer = $request->input('answer');
        $meanings =$request->input('meanings');
        $is_correct = $this->lesson_service->checkCorrect($user_answer, $request->input('correct'));

        return response()->json([
            'finished' => false,
            'html' => view('lesson.partial.answer', [
                'is_correct' => $is_correct,
                'user_answer' => $user_answer,
                'meanings' => $meanings,
            ])->render()
        ]);
    }

    public function wordQuestionRev()
    {
        $lesson_id = 1;
        $user_language_id = 2;
        $progress = 30;
        $correct_rate = 0;
        $question_no = session('question_no');

        $choices = $this->lesson_service->getQuestionWordRev($lesson_id);
        [$question, $word_id] =  $this->lesson_service->getWordMeaningRev($choices, $question_no);

        return view("lesson.word_rev", compact('choices' , 'question', 'correct_rate', 'question_no', 'progress', 'word_id'));
    }

    public function answerRev(Request $request)
    {
        $correct = $request->input('word_id');
        $user_answer = $request->input('user_answer');
        $choices = $request->input('choices');
        $is_correct = $this->lesson_service->checkCorrect($user_answer, $correct);

        return response()->json([
            'finished' => false,
            'html' => view('lesson.partial.answer_rev', [
                'is_correct' => $is_correct,
                'user_answer' => $user_answer,
                'choices' => $choices,
            ])->render()
        ]);
    }
}
