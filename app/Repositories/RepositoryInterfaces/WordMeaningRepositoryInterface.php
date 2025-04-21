<?php

namespace App\Repositories\RepositoryInterfaces;

interface WordMeaningRepositoryInterface
{
    public function getWordMeaning($word_question_ids, int $lesson_id, int $language_id);
    public function getCorrectdMeaning(int $lesson_id, int $language_id);
}
