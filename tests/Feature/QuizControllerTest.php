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
        $this->user2 = User::factory()->create();


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
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testShowWithExistQuizId()
    {
        $response = $this->json('GET', 'api/quizzes/' . strval($this->quiz->id));
        $response->assertStatus(200);
    }

    public function testShowWithNonExistQuizId()
    {
        $response = $this->json('GET', 'api/quizzes/' . strval($this->quiz->id + 2));
        $response->assertStatus(404);
        $response->assertJson([
            'message' => '該当のものが存在しません'
        ]);
    }

    public function testStoreSuccess()
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
        $this->assertSame(Quiz::count(), 1 + 1);
        $this->assertSame(Choice::count(), 4 + 4);
    }

    public function testUpdateWithWrongUser()
    {
        $response = $this->actingAs($this->user2)->json('PATCH', '/api/quizzes/' . strval($this->quiz->id), [
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

        $response->assertStatus(403);
        $response->assertJson([
            'message' => '不正なアクセスです'
        ]);
    }

    public function testUpdateSuccess()
    {

        $response = $this->actingAs($this->user)->json('PATCH', '/api/quizzes/' . strval($this->quiz->id), [
            'quiz' => [
                'title' => 'bbb',
                'query' => 'bbb',
                'explanation' => 'ccc',
            ],
            'choices' => [
                [
                    'content' => 'cc1',
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
            'correct_choice_number' => '2'
        ]);
        $response->assertStatus(200);
        $this->quiz->refresh();
        $this->assertSame($this->quiz->title, 'bbb');
        $this->assertSame($this->quiz->choices()->where('number', 1)->first()->content, 'cc1');
        // $this->assertSame($this->quiz->correct_choice_id, $this->quiz->choices()->where('number', 2)->first()->id);   
        $this->assertSame($this->quiz->correct_choice->id, $this->quiz->choices()->where('number', 2)->first()->id);
    }

    public function testUpdateWithWrongQuizId()
    {

        $response = $this->actingAs($this->user)->json('PATCH', '/api/quizzes/' . strval($this->quiz->id + 20), [
            'quiz' => [
                'title' => 'bbb',
                'query' => 'bbb',
                'explanation' => 'ccc',
            ],
            'choices' => [
                [
                    'content' => 'cc1',
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
            'correct_choice_number' => '2'
        ]);
        $response->assertStatus(404);
        $response->assertJson([
            'message' => '該当のものが存在しません'
        ]);
    }

    public function testDestroySuccess()
    {
        $quiz_id = $this->quiz->id;
        $response = $this->actingAs($this->user)->json('DELETE', '/api/quizzes/' . strval($quiz_id));
        $response->assertStatus(204);
        $this->assertFalse(Quiz::where('id', $quiz_id)->exists());
    }

    public function testDestroyWithWrongUser()
    {
        $response = $this->actingAs($this->user2)->json('DELETE', '/api/quizzes/' . strval($this->quiz->id));

        $response->assertStatus(403);
        $response->assertJson([
            'message' => '不正なアクセスです'
        ]);
    }

    public function testDestroyWithWrongQuizId()
    {

        $response = $this->actingAs($this->user)->json('DELETE', '/api/quizzes/' . strval($this->quiz->id + 20));
        $response->assertStatus(404);
        $response->assertJson([
            'message' => '該当のものが存在しません'
        ]);
    }
}
