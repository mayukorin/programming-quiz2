<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    //
    public function index()
    {
        $quizzes = Quiz::all();
        return response()->json($quizzes, 200);
    }

    public function show($id)
    {
        $quiz = Quiz::with(['user', 'correct_choice', 'choices'])->find($id);
        return response()->json($quiz, 200);
    }
}
