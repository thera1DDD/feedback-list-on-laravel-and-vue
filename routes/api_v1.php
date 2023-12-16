<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(\App\Http\Controllers\API\V1\Auth\AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::group(['prefix'=>'feedback'],function (){
    Route::get('/get',[\App\Http\Controllers\API\V1\Feedback\FeedbackController::class,'getFeedback'])->name('feedback.get');
    Route::post('/post',[\App\Http\Controllers\API\V1\Feedback\FeedbackController::class,'postFeedback'])->name('feedback.post');
    Route::put('/answer/{id}',[\App\Http\Controllers\API\V1\Feedback\FeedbackController::class,'answerFeedback'])->name('feedback.answer');
    Route::get('/filter',[\App\Http\Controllers\API\V1\Feedback\FeedbackController::class,'filter'])->name('feedback.filter');
});

