<?php

namespace App\Repositories\Question;

interface QuestionRepositoryInterface
{
    public function getByLessonAndQuestionNo(int $lessonId, int $questionNo);
}
