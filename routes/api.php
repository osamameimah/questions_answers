<?php

use App\Http\Controllers\Api\AnswersController;
use App\Http\Controllers\Api\AuthenticationTokensController;
use App\Http\Controllers\Api\QuestionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('qquestions',QuestionsController::class)->middleware('auth:sanctum');
Route::apiResource('aanswers',AnswersController::class);

Route::post('auth/tokens', [AuthenticationTokensController::class, 'store']);
Route::delete('auth/tokens/{token?}', [AuthenticationTokensController::class, 'destroy'])->middleware('auth:sanctum');;
