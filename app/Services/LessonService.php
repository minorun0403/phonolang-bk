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
            $question_id = 1;
        }
        else {
            $question_id = session('question_no') + 1;
        }
        session(['lesson_id' => $question_id]);
        return $question_id;
    }

    public function getQuestionWord(int $lesson_id, int $question_no)
    {
        // 質問のIDを取得
        $language_id = 1;

        $questions = $this->word_question_repo->getQuestions($lesson_id, $language_id);
        $question = $questions[$question_no - 1];
        $question_id = $question->id;
        $question_word = $question->word;
        $lesson_id = $question->lesson_id;
        return [$question_id, $question_word, $lesson_id];
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

    public function getQuestionWordMeaning(int $lesson_id, int $user_language_id)
    {
        $meanig = $this->word_meaning_repo->getWordMeaning($lesson_id, $user_language_id);
        return $meanig;
    }
}
