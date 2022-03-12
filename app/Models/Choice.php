<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $hidden = array('id', 'quiz_id', 'created_at', 'updated_at');

    protected $fillable = ['quiz_id', 'content', 'number'];

    public static $rules = array(
        'quiz_id' => 'required',
        'content' => 'required',
        'number' => 'required',
    );

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz');
    }
}
