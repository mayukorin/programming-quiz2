<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Choice;

class StockControllerTest extends TestCase
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
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreSuccess()
    {
        $response = $this->actingAs($this->user)->json('POST', '/api/stocks/', [
            'quiz_id' => $this->quiz->id
        ]);
        $response->assertStatus(202);
        $this->assertSame($this->user->stockQuizzes()->count(), 1);
    }
}
