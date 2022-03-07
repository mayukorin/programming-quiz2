<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Choice;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreQuiz;

class QuizController extends Controller
{
    //

    public function __construct()
    {
        // $this->middleware('can:update, quiz')->only('update');
        // $this->authorizeResource(Quiz::class, 'quiz');
    }

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
        foreach ($request->choices as $choice) {
            $new_choice = $quiz->choices()->create($choice);
            if ($new_choice->number == intval($request->correct_choice_number)) {
                $quiz->update(['correct_choice_id' => $new_choice->id]);
            }
        }
        return response()->json($quiz, 202);
    }

    public function update(StoreQuiz $request, Quiz $quiz)
    {
        $this->authorize('update', $quiz);

        $quiz->update($request->quiz);

        foreach ($request->choices as $choice) {
            $edit_choice = $quiz->choices()->where('number', $choice['number'])->first();
            $edit_choice->update($choice);
            if ($edit_choice->number == intval($request->correct_choice_number)) {
                $quiz->update(['correct_choice_id' => $edit_choice->id]);
            }
        }
        return response()->json($quiz, 200);
    }

    public function destroy(Quiz $quiz)
    {
        $this->authorize('destroy', $quiz);
        $quiz->delete();
        return response()->json(204);
    }
}
