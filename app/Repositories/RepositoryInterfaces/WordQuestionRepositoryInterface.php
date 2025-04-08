<?php

namespace App\Repositories\RepositoryInterfaces;

interface WordQuestionRepositoryInterface
{
    public function getQuestions(int $lesson_id, int $language_id);
}
