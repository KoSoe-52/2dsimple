<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ModeratorController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'Admin','middleware'=>['Admin','auth']],function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');

    

});

Route::group(['prefix'=>'SuperAdmin','middleware'=>['SuperAdmin','auth']],function(){
    Route::get('dashboard',[SuperAdminController::class,'index'])->name('super.dashboard');

    

});

Route::group(['prefix'=>'Moderator','middleware'=>['Moderator','auth']],function(){
    Route::get('dashboard',[ModeratorController::class,'index'])->name('moderator.dashboard');

    

});
