<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CodingLanguageAndFramework;
use App\Models\Quiz;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'coding_language_and_framework_id'];

    public function codingLanguageAndFramework()
    {
        return $this->belongsTo(CodingLanguageAndFramework::class, 'coding_language_and_framework_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
