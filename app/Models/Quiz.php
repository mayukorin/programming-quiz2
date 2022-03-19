<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CodingLanguageAndFramework;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'query', 'explanation', 'correct_choice_id'];

    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function correct_choice()
    {
        return $this->belongsTo('App\Models\Choice', 'correct_choice_id');
    }

    public function choices()
    {
        return $this->hasMany('App\Models\Choice');
    }

    public function tags()
    {
        return $this->hasMany('App\Models\Tag');
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
