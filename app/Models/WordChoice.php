<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordChoice extends Model
{
    use HasFactory;

    protected $table = 'dtb_word_choices';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'word_question_id',
        'text',
        'is_correct',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function lesson()
    {
        return $this->belongsTo(WordQuestion::class);
    }
}
