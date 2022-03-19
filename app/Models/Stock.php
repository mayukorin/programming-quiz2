<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'user_id'];

    public function scopeSelectStocksOfLoginUser($builder, $loginUserId)
    {
        return $builder->select('quiz_id as stock_flag', 'id as stock_id')->where('user_id', $loginUserId);
    }
}
