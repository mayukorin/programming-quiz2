<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreQuiz;

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
        $quiz = Quiz::with(['user', 'correct_choice', 'choices'])->findOrFail($id);
        return response()->json($quiz, 200);
    }

    public function store(StoreQuiz $request)
    {

        $quiz = auth()->user()->quizzes()->create($request->quiz);
        foreach($request->choices as $choice) {
            $choice = $quiz->choices()->create($choice);
            if ($choice->number == intval($request->correct_choice_number)) {
                $quiz->update(['correct_choice_id' => $choice->id]);
            }
        }
        return response()->json($quiz, 202);
    }
}
