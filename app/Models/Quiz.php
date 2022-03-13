<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
