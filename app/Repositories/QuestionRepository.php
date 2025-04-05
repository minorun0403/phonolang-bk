<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterfaces\QuestionRepositoryInterface;
use App\Models\WordQuestion;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function getQuestionsByLessonIdAndQuestionId(int $lesson_id, int $language_id)
    {
        return WordQuestion::where('lesson_id', $lesson_id)
                            ->where('language_id', $language_id)
                            ->where('deleted_at', null)
                            ->orderBy('id', 'asc')
                            ->get();
    }
}
