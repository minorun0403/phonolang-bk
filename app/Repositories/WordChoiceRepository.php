<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterfaces\WordChoiceRepositoryInterface;
use App\Models\WordChoice;

class WordChoiceRepository implements WordChoiceRepositoryInterface
{
    public function getChoices(int $word_question_id)
    {
        return WordChoice::select('text', 'is_correct', 'word_question_id')
                        ->where('word_question_id', $word_question_id)
                        ->where('deleted_at', null)
                        ->get();
    }
}
