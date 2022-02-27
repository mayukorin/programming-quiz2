<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use App\Models\Choice;
use App\Models\User;

class AddCorrectChoiceIdSeeder extends Seeder
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
        $choice = Choice::where('content', 'print')->first();
        $user = User::where('name', 'test')->first();
        $updatedParams = [
            'id' => $quiz->id, 
            'title' => 'phpの基本問題',
            'correct_choice_id' => $choice->id,
            'query' => '文字列を出力したいときどうする？',
            'explanation' => 'print を使います',
            'user_id' => $user->id
        ];

        Quiz::upsert($updatedParams, ['id'], ['correct_choice_id']);
    }
}
