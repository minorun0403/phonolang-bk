<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterfaces\WordMeaningRepositoryInterface;
use App\Models\WordMeaning;
use League\Flysystem\UnableToGeneratePublicUrl;

class WordMeaningRepository implements WordMeaningRepositoryInterface
{
    public function getWordMeaning(int $lesson_id, int $user_language_id)
    {
        return WordMeaning::select('dtb_word_meanings.meaning')
        ->leftJoin('dtb_word_questions', function ($join) use ($lesson_id) {
            $join->on('dtb_word_meanings.word_id', '=', 'dtb_word_questions.id')
                ->where('dtb_word_questions.lesson_id', '=', $lesson_id);
        })
        ->where('dtb_word_meanings.language_id', $user_language_id)
        ->pluck('meaning')
        ->toArray();

        // SELECT 
        //     meaning
        // FROM
        //     phonolang.dtb_word_meanings
        //         LEFT JOIN
        //     phonolang.dtb_word_questions 
        //         ON 
        //             dtb_word_meanings.word_id = dtb_word_questions.id
        //         AND 
        //             dtb_word_questions.lesson_id = [レッスンID]
        // WHERE
        //     dtb_word_meanings.language_id = [意味の言語ID];
    }

    public function getCorrectdMeaning(int $lesson_id, int $user_language_id)
    {
        return WordMeaning::select('dtb_word_meanings.meaning')
        ->leftJoin('dtb_word_questions', function ($join) use ($lesson_id) {
            $join->on('dtb_word_meanings.word_id', '=', 'dtb_word_questions.id')
                ->where('dtb_word_questions.lesson_id', '=', $lesson_id);
        })
        ->where('dtb_word_meanings.language_id', $user_language_id)
        ->value('meaning');
    }
}
