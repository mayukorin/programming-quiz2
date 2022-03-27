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
        $loginUserStocks = Stock::SelectStocksOfLoginUser($loginUserId);
        $stockedQuizzes = Quiz::withStocks($loginUserStocks)->whereNotNull('stock_id')->get();
        return response()->json($stockedQuizzes, 200);
    }
}
