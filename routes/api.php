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
Route::get("/v1/bet-details",[App\Http\Controllers\Api\BetController::class,'betDetail']);
Route::get("/v1/get-date",[App\Http\Controllers\Api\BetDateController::class,'getDate']);

Route::middleware('auth:api')->group(function () {
    Route::post('/v1/insert', [App\Http\Controllers\Api\BetController::class, 'insert']); 
    Route::post("/v1/delete-token",[App\Http\Controllers\Api\BetController::class,'deleteToken']);
    Route::post("/v1/delete-all-data",[App\Http\Controllers\Api\BetController::class,'deleteAllData']);
    Route::post("/v1/delete-date",[App\Http\Controllers\Api\BetDateController::class,'deleteDate']);

});
