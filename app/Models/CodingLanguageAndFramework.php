<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;

class CodingLanguageAndFramework extends Model
{
    use HasFactory;

    protected $table = 'coding_languages_and_frameworks';

    protected $fillable = ['name'];

    public function tags()
    {
        return $this->hasMany('App\Models\Tag', 'coding_language_and_framework_id');
    }
}
