<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodingLanguageAndFrameworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $coding_language_and_framework_names = ['Java', 'PHP', 'Laravel', 'JavaScript', 'Vue', 'C', 'C++', 'Python', 'Django', 'Ruby', 'Ruby on Rails'];

        foreach ($coding_language_and_framework_names as $cf) {
            DB::table('coding_languages_and_frameworks')->insert([
                'name' => $cf,
            ]);
        }
    }
}
