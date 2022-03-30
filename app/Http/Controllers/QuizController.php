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
            $newChoice = $quiz->choices()->create($choice);
            if ($newChoice->number == intval($request->correct_choice_number)) {
                $quiz->update(['correct_choice_id' => $newChoice->id]);
            }
        }
        foreach ($request->tags as $tag) {
            $codingLanguageAndFramework = CodingLanguageAndFramework::where('name', $tag['name'])->firstOrFail();
            $newTag = $codingLanguageAndFramework->tags()->create();
            $newTag->update(['quiz_id' => $quiz->id]);
        }
        return response()->json($quiz, 202);
    }

    public function update(StoreQuiz $request, Quiz $quiz)
    {
        $this->authorize('update', $quiz);

        $quiz->update($request->quiz);

        foreach ($request->choices as $choice) {
            $editChoice = $quiz->choices()->where('number', $choice['number'])->first();
            $editChoice->update($choice);
            if ($editChoice->number == intval($request->correct_choice_number)) {
                $quiz->update(['correct_choice_id' => $editChoice->id]);
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
