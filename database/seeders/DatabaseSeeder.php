<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(QuizTableSeeder::class);
        $this->call(ChoiceTableSeeder::class);
        $this->call(AddCorrectChoiceIdSeeder::class);
    }
}
