<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordMeaning extends Model
{
    use HasFactory;

    protected $table = 'dtb_word_meanings';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'word_id',
        'language_id',
        'meaning',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function WordQuestion()
    {
        return $this->belongsTo(WordQuestion::class, 'word_id', 'id');
    }

    // public function language()
    // {
    //     return $this->belongsTo(Language::class);
    // }
}
