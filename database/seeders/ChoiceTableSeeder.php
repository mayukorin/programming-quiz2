<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;

class ChoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $quiz = Quiz::where('title', 'phpの基本問題')->first();
        $param = [
            'content' => 'print',
            'number' => 1,
            'quiz_id' => $quiz->id
        ];
        DB::table('choices')->insert($param);
        $param = [
            'content' => 'puts',
            'number' => 2,
            'quiz_id' => $quiz->id
        ];
        DB::table('choices')->insert($param);
        $param = [
            'content' => 'console.log',
            'number' => 3,
            'quiz_id' => $quiz->id
        ];
        DB::table('choices')->insert($param);
        $param = [
            'content' => 'System.out.println',
            'number' => 4,
            'quiz_id' => $quiz->id
        ];
        DB::table('choices')->insert($param);
    }
}
