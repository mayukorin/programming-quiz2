<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $hidden = ['id', 'quiz_id', 'created_at', 'updated_at'];

    protected $fillable = ['quiz_id', 'content', 'number'];

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz');
    }
}
