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
Route::get('/hash', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//2d ဒိုင်ဖြစ်သညါ
Route::group(['middleware'=>['Admin','auth']],function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('users',[AdminController::class,'showUsers'])->name('admin.showUsers');
    Route::post('users',[AdminController::class,'storeUsers'])->name('admin.storeUsers');
    Route::get('users/{id}',[AdminController::class, 'editUsers'])->name('admin.userEdit');
    Route::post('users/{id}',[AdminController::class, 'updateUsers'])->name('admin.userUpdate');   
    Route::get('twodrecords',[AdminController::class, 'twodrecords'])->name('admin.twodrecords');   

});
//superadmin သည်  system admin ဖြစ်သညါ
Route::group(['prefix'=>'SuperAdmin','middleware'=>['SuperAdmin','auth']],function(){
    Route::get('dashboard',[SuperAdminController::class,'index'])->name('super.dashboard');

    

});

Route::group(['middleware'=>['Moderator','auth']],function(){
    Route::get('2d',[ModeratorController::class,'index'])->name('moderator.dashboard');
    Route::post("2d",[ModeratorController::class,'store']);
    Route::get("history",[ModeratorController::class,'history']);
    Route::get("history/{id}",[ModeratorController::class,'vouncher'])->name("history.vouncher");
});
