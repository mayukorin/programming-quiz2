<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Stock;
use App\Models\Choice;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreQuiz;
use App\Models\CodingLanguageAndFramework;

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
        $loginUserId = auth()->check() ? auth()->user()->id : 0;
        $loginUserStocks = Stock::SelectStocksOfLoginUser($loginUserId);
        $quizzes = Quiz::withStocks($loginUserStocks)->get();
        return response()->json($quizzes, 200);
    }

    public function show($id)
    {
        $loginUserId = auth()->check() ? auth()->user()->id : 0;
        $loginUserStocks = Stock::SelectStocksOfLoginUser($loginUserId);
        $quiz = Quiz::withStocks($loginUserStocks)->findOrFail($id);
        return response()->json($quiz, 200);
    }

    public function store(StoreQuiz $request)
    {

        $quiz = auth()->user()->quizzes()->create($request->quiz);
        # create_many
        foreach ($request->choices as $choice) {
            $new_choice = $quiz->choices()->create($choice);
            if ($new_choice->number == intval($request->correct_choice_number)) {
                $quiz->update(['correct_choice_id' => $new_choice->id]);
            }
        }
        foreach ($request->tags as $tag) {
            $coding_language_and_framework = CodingLanguageAndFramework::where('name', $tag['name'])->firstOrFail();
            $new_tag = $coding_language_and_framework->tags()->create();
            $new_tag->update(['quiz_id' => $quiz->id]);
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
        return response()->json(null, 204);
    }
}
