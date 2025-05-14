<?php

namespace App\Services;

use App\Repositories\RepositoryInterfaces\WordQuestionRepositoryInterface;
use App\Repositories\RepositoryInterfaces\WordChoiceRepositoryInterface;
use App\Repositories\RepositoryInterfaces\WordMeaningRepositoryInterface;
use Illuminate\Validation\Rules\In;

class LessonService
{
    protected WordQuestionRepositoryInterface $word_question_repo;
    protected WordChoiceRepositoryInterface $word_choice_repo;
    protected WordMeaningRepositoryInterface $word_meaning_repo;

    public function __construct(
        WordQuestionRepositoryInterface $word_question_repo,
        WordChoiceRepositoryInterface $word_choice_repo,
        WordMeaningRepositoryInterface $word_meaning_repo
    ) {
        $this->word_question_repo = $word_question_repo;
        $this->word_choice_repo = $word_choice_repo;
        $this->word_meaning_repo = $word_meaning_repo;
    }


    public function getQuestionNo()
    {
        if (session('question_no') == null) {
            $question_no = 1;
        }
        else {
            $question_no = session('question_no') + 1;
        }
        session(['question_no' => $question_no]);
        return $question_no;
    }

    public function getQuestionWord(int $lesson_id, int $question_no)
    {
        // 質問のIDを取得
        $language_id = 1;

        $questions = $this->word_question_repo->getQuestions($lesson_id, $language_id);
        $word_question_ids = $questions->pluck('id')->toArray();
        $question = $questions[$question_no - 1];
        $word_question_id = $question->id;
        $question_word = $question->word;
        return [$word_question_ids, $word_question_id, $question_word];
    }

    public function getQuestionChoices(int $question_id)
    {
        $choices = $this->word_choice_repo
        ->getChoices($question_id)
        ->pluck('text')
        ->values()
        ->toArray();
        return $choices;
    }

    public function getQuestionWordMeaning($word_question_ids, int $lesson_id, int $user_language_id)
    {
        $meanigs = $this->word_meaning_repo->getWordMeaning($word_question_ids, $lesson_id, $user_language_id);
        return $meanigs;
    }

    public function getCorrectdMeaning(int $lesson_id, int $user_language_id)
    {
        $correct_meaning = $this->word_meaning_repo->getCorrectdMeaning($lesson_id, $user_language_id);
        return $correct_meaning;
    }

    public function checkCorrect($user_answer, $correct)
    {
        $true = 1;
        $false = 0;
        if ($user_answer == $correct) {
            $is_correct = $true;
        } else {
            $is_correct = $false;
        }
        return $is_correct;
    }

    public function getQuestionWordRev(int $lesson_id)
    {
        // 質問のIDを取得
        $language_id = 1;

        $questions = $this->word_question_repo->getQuestions($lesson_id, $language_id);
        $questions = $questions->pluck('word', 'id')->toArray();
        return $questions;
    }

    public function getWordMeaningRev($choices, int $question_no)
    {
        $user_language_id = 2;
        $word_id = array_keys($choices)[$question_no - 5];
        $question = $this->word_meaning_repo->getWordMeaningById($word_id, $user_language_id)->meaning;
        return [$question, $word_id];
    }
}
