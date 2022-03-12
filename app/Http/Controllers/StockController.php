<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreStock;
use App\Models\Stock;

class StockController extends Controller
{
    //

    public function store(StoreStock $request)
    {
        $stock = Stock::create($request->all());
        return response()->json($stock, 202);
    }
}
