<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordChoice extends Model
{
    use HasFactory;

    // 対応するテーブル名
    protected $table = 'dtb_word_choices';
    // 主キー
    protected $primaryKey = 'id';
    // タイムスタンプの自動管理
    public $timestamps = true;

    // ホワイトリスト形式で、代入を許可するカラム
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
