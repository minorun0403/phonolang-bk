<?php

namespace App\Repositories\Question;

use App\Models\Question;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function getByLessonAndQuestionNo(int $lesson_id, int $question_id)
    {
        return Question::where('lesson_id', $lesson_id)
                        ->where('question_id', $question_id)
                        ->first();
    }
}
