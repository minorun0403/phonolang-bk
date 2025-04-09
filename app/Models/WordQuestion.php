<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordQuestion extends Model
{
    use HasFactory;

    protected $table = 'dtb_word_questions';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'language_id',
        'lesson_id',
        'word',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // 例：Lessonとのリレーション（belongsTo）
    // public function lesson()
    // {
    //     return $this->belongsTo(Lesson::class);
    // }

    // public function language()
    // {
    //     return $this->belongsTo(Language::class);
    // }
}
