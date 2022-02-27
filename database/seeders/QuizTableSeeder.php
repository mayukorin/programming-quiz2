<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class QuizTableSeeder extends Seeder
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
        $param = [
            'title' => 'phpの基本問題',
            'query' => '文字列を出力したいときどうする？',
            'explanation' => 'print を使います',
            'user_id' => $user->id
        ];
        DB::table('quizzes')->insert($param);
    }
}
