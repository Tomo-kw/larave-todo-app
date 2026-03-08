<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /**
     * 変更可能な属性
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'status',
        'priority',
        'due_date',
    ];

    /**
     * 日付キャスト
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date',
    ];

    /**
     * Todo を作成したユーザー
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
