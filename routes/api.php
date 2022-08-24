<?php

use App\Http\Controllers\Api\SurveyController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('/home', [SurveyController::class, 'home']);

Route::get('/survey-by-slug/{survey:slug}', [SurveyController::class, 'entry']);
Route::post('/survey/{survey}/answer', [SurveyController::class, 'storeAnswer']);

Route::get('/entries', [SurveyController::class, 'entries']);
Route::delete('/entries/{entry}', [SurveyController::class, 'destroyEntry']);

Route::apiResource('surveys', SurveyController::class);

