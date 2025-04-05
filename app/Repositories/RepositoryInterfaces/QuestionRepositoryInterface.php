<?php

namespace App\Repositories\RepositoryInterfaces;

interface QuestionRepositoryInterface
{
    public function getQuestionsByLessonIdAndQuestionId(int $lesson_id, int $language_id);
}
