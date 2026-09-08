<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // gender列(1,2,3の数値)を日本語ラベルに変換するアクセサ
    // $contact->gender_label でアクセスできる(データベースに同名の列は無い)
    public function getGenderLabelAttribute(): string
    {
        $labels = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        return $labels[$this->gender] ?? '';
    }
}
