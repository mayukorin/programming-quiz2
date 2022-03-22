<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::where('name', 'test')->first();
        $quiz = Quiz::where('title', 'phpの基本問題')->first();
        $param = [
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
        ];
        DB::table('stocks')->insert($param);
    }
}
