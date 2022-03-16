<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Choice;
use App\Models\CodingLanguageAndFramework;
use App\Models\Stock;
use Tests\TestCase;

class IndexStockedQuizzesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();


        $this->quiz = Quiz::factory()
            ->for($this->user)
            ->create();


        for ($i = 1; $i <= 4; $i++) {
            $choice = Choice::factory()
                ->for($this->quiz)
                ->create(
                    ['number' => $i]
                );

            if ($i == 1) {
                $this->quiz->update(['correct_choice_id' => $choice->id]);
            }
        }

        $coding_language_and_framework_names = ['Java', 'PHP', 'Laravel', 'JavaScript', 'Vue', 'C', 'C++', 'Python', 'Django', 'Ruby', 'Ruby on Rails'];

        foreach ($coding_language_and_framework_names as $cf) {
            CodingLanguageAndFramework::factory()->create([
                'name' => $cf
            ]);
        }

        $this->stock = Stock::create(['quiz_id' => $this->quiz->id, 'user_id' => $this->user->id]);
    }

    public function testWithNoSignInUser()
    {
        $response = $this->json('GET', 'api/stocked-quizzes');
        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'ログインをしてください'
        ]);
    }
}
