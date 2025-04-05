<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // 対応するテーブル名
    protected $table = 'dtb_word_questions';
    // 主キー
    protected $primaryKey = 'id';
    // タイムスタンプの自動管理
    public $timestamps = true;

    // ホワイトリスト形式で、代入を許可するカラム
    protected $fillable = [
        'id',
        'language_id',
        'lesson_id',
        'word',
        'created_at',
        'updated_at',
        'deleted_at',
        // 他にカラムがあれば追加
    ];

    // 例：Lessonとのリレーション（belongsTo）
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
