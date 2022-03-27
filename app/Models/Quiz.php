<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CodingLanguageAndFramework;
use App\Models\Choice;
use App\Models\Tag;
use App\Models\User;


class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'query', 'explanation', 'correct_choice_id'];

    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function correct_choice()
    {
        return $this->belongsTo(Choice::class, 'correct_choice_id');
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function coding_language_and_frameworks()
    {
        return $this->belongsToMany(CodingLanguageAndFramework::class, 'tags');
    }

    public function scopeWithStocks($builder, $loginUserStocks)
    {
        return $builder->with(['user', 'correct_choice', 'choices', 'coding_language_and_frameworks'])->leftJoinSub($loginUserStocks, 'login_user_stocks', function ($join) {
            $join->on('quizzes.id', '=', 'login_user_stocks.stock_flag');
        });
    }
}
