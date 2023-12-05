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

Route::apiResource('/todo',\App\Http\Controllers\API\V1\ToDoController::class);



Route::controller(\App\Http\Controllers\API\V1\Auth\AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});

Route::group(['prefix'=>'seed'],function (){
    Route::post('/launch',[\App\Http\Controllers\API\V1\SeedController::class,'runSeeder'])->name('seeder.launch');
});

