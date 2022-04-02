<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;

class CodingLanguageAndFramework extends Model
{
    use HasFactory;

    protected $table = 'coding_languages_and_frameworks';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['name'];

    public function tags()
    {
        return $this->hasMany('App\Models\Tag', 'coding_language_and_framework_id');
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'tags');
    }
   
    public function scopeWithQuizzes($builder)
    {
        return $builder->with(['quizzes.user', 'quizzes.correct_choice', 'quizzes.choices', 'quizzes.coding_language_and_frameworks']);
    }
}
