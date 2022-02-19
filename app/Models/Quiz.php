<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    
    public static $rules = array(
        'user_id' => 'required',
        'title' => 'required',
        'query' => 'required',
        'explanation' => 'required'
    );

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
