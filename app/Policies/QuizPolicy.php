<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class QuizPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Quiz $quiz)
    {
        return $user->id === $quiz->user_id;
    }

    public function delete(User $user, Quiz $quiz)
    {
        return $user->id === $quiz->user_id;
    }
}
