<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordMeaning extends Model
{
    use HasFactory;

    // 対応するテーブル名
    protected $table = 'dtb_word_meanings';
    // 主キー
    protected $primaryKey = 'id';
    // タイムスタンプの自動管理
    public $timestamps = true;

    // ホワイトリスト形式で、代入を許可するカラム
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
