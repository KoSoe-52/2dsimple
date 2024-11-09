<?php

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
Route::post('/v1/loginUser', [App\Http\Controllers\Api\LoginController::class, 'loginUser']); 
Route::get("/v1/three-numbers",[App\Http\Controllers\Api\ThreeNumberController::class,'threeNumber']);


Route::middleware('auth:api')->group(function () {
    Route::post('/v1/insert', [App\Http\Controllers\Api\BetController::class, 'insert']); 
});
