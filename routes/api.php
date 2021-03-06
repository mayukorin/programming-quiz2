<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\IndexStockedQuizzes;
use App\Http\Controllers\CodingLanguageAndFrameworkController;
use App\Http\Controllers\CodingLanguageAndFrameworkSearchByNameIndex;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::resource('users', UserController::class);

Route::resource('quizzes', QuizController::class);

Route::resource('stocks', StockController::class);

Route::resource('coding_language_and_frameworks', CodingLanguageAndFrameworkController::class);

Route::middleware('auth:api')->get('/stocked-quizzes', IndexStockedQuizzes::class);

Route::get('coding_language_and_frameworks/search-by-name/{name}', CodingLanguageAndFrameworkSearchByNameIndex::class);

Route::group([
    'prefix' => 'auth',
    'middleware' => 'auth:api'
], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});
