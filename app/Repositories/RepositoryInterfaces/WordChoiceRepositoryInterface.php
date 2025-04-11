<?php

namespace App\Repositories\RepositoryInterfaces;

interface WordChoiceRepositoryInterface
{
    public function getChoices(int $word_question_id);
}
