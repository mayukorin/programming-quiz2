<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CodingLanguageAndFramework;
use Illuminate\Support\Facades\Log;

class CodingLanguageAndFrameworkSearchByNameIndex extends Controller
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
        Log::debug($request->name);
        $coding_language_and_frameworks = CodingLanguageAndFramework::where('name', 'LIKE', "$request->name%")->get();
        Log::debug(gettype($coding_language_and_frameworks));
        return response()->json($coding_language_and_frameworks, 200);
    }
}
