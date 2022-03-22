<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CodingLanguageAndFramework;

class CodingLanguageAndFrameworkController extends Controller
{
    //
    public function show($id)
    {
        $coding_language_and_framework = CodingLanguageAndFramework::WithQuizzes()->findOrFail($id);
        return response()->json($coding_language_and_framework, 200);
    }
}
