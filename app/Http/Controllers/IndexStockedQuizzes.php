<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Stock;

class IndexStockedQuizzes extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        $loginUserId = auth()->check() ? auth()->user()->id : 0;
        $loginUserStocks = Stock::select('quiz_id as stock_flag', 'id as stock_id')->where('user_id', $loginUserId);
        $stockedQuizzes = Quiz::with(['user', 'correct_choice', 'choices', 'coding_language_and_frameworks'])->joinSub($loginUserStocks, 'login_user_stocks', function ($join) {
            $join->on('quizzes.id', '=', 'login_user_stocks.stock_flag');
        })->get();
        return response()->json($stockedQuizzes, 200);
    }
}
