<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\CodingLanguageAndFramework;


class CodingLanguageAndFrameworkSearchByNameIndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setup(): void {

        parent::setup();

        $coding_language_and_framework_names = ['Java', 'PHP', 'Laravel', 'JavaScript', 'Vue', 'C', 'C++', 'Python', 'Django', 'Ruby', 'Ruby on Rails'];

        foreach ($coding_language_and_framework_names as $cf) {
            CodingLanguageAndFramework::factory()->create([
                'name' => $cf
            ]);
        }

    }

    public function testSuccess() 
    {
        $response = $this->json('GET', 'api/coding_language_and_frameworks/search-by-name/Ja');
        
        $response->assertJson([
            [
                "id" => 1,
                "name" => "Java"
            ],
            [
                "id" => 4,
                "name" => "JavaScript"
            ]
        ]);
    }
}
