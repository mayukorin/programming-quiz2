<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Choice;
use Illuminate\Support\Facades\Log;

class QuizControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();


        $this->quiz = Quiz::factory()
            ->for(User::factory()->create())
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

        
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testShowWithExistQuizId()
    {
        $response = $this->json('GET', 'api/quizzes/'.strval($this->quiz->id));
        $response->assertStatus(200);
    }

    public function testShowWithNonExistQuizId()
    {
        $response = $this->json('GET', 'api/quizzes/'.strval($this->quiz->id+1));
        $response->assertStatus(404);
        $response->assertJson([
            'message' => '該当のものが存在しません'
        ]);
        
    }

    public function testStore()
    {
        $response = $this->actingAs($this->user)->json('POST', '/api/quizzes/', [
            'quiz' => [
                'title' => 'aaa',
                'query' => 'bbb',
                'explanation' => 'ccc',
            ],
            'choices' => [
                [
                    'content' => 'c1',
                    'number' => '1',
                ],
                [
                    'content' => 'c2',
                    'number' => '2',
                ],
                [
                    'content' => 'c3',
                    'number' => '3',
                ],
                [
                    'content' => 'c4',
                    'number' => '4',
                ]
            ],
            'correct_choice_number' => '1'
        ]);

        // $response->assertStatus(202);
        $response->assertJson([
            'title' => 'aaa',
            'query' => 'bbb',
            'explanation' => 'ccc',
        ]);
        $this->assertSame(Quiz::count(), 1+1);
        $this->assertSame(Choice::count(), 4+4);

    }
}
