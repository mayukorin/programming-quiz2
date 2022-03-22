<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'coding_language_and_framework_id'];

    public function codingLanguageAndFramework()
    {
        return $this->belongsTo('App\Models\CodingLanguagesAndFramework', 'coding_language_and_framework_id');
    }

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz');
    }
}
