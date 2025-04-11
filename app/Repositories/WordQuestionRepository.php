<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterfaces\WordQuestionRepositoryInterface;
use App\Models\WordQuestion;

class WordQuestionRepository implements WordQuestionRepositoryInterface
{
    public function getQuestions(int $lesson_id, int $language_id)
    {
        return WordQuestion::select('id', 'word')
        ->where('lesson_id', $lesson_id)
        ->where('language_id', $language_id)
        ->where('deleted_at', null)
        ->orderBy('id', 'asc')
        ->get();
    }
}
