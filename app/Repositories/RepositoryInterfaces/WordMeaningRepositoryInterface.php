<?php

namespace App\Repositories\RepositoryInterfaces;

interface WordMeaningRepositoryInterface
{
    public function getWordMeaning(int $lesson_id, int $language_id);
    public function getCorrectdMeaning(int $lesson_id, int $language_id);
}
