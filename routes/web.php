<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
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
// Route::get('/hash', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::get('/home',function(){
    Auth::logout();
    return view("auth.login");
});
//2d ဒိုင်ဖြစ်သညါ
Route::group(['middleware'=>['Admin','auth']],function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('users',[AdminController::class,'showUsers'])->name('admin.showUsers');
    Route::post('users',[AdminController::class,'storeUsers'])->name('admin.storeUsers');
    Route::get('users/{id}',[AdminController::class, 'editUsers'])->name('admin.userEdit');
    Route::post('users/{id}',[AdminController::class, 'updateUsers'])->name('admin.userUpdate');   
    Route::get('twodrecords',[AdminController::class, 'twodrecords'])->name('admin.twodrecords');  

    Route::get('twodrecords/{id}/delete',[AdminController::class, 'record_delete']);

    Route::get('twodList/{sort?}',[AdminController::class, 'twodList'])->name("twodList");   
    Route::get('twodList/{number?}/terminate',[AdminController::class, 'terminate']);   
    Route::get('twodList/{number?}/open',[AdminController::class, 'open']);   
    //dubai
    Route::get('dubaitwodrecords',[App\Http\Controllers\DubiaLuckyRecordController::class, 'twodrecords']);
    Route::get('dubaitwodrecords/{id}/delete',[App\Http\Controllers\DubiaLuckyRecordController::class, 'dubaitwodrecords_delete']);
    Route::get('dubaitwodList/{sort?}',[App\Http\Controllers\DubiaLuckyRecordController::class, 'twodList']);   
    Route::get('dubaitwodList/{number?}/terminate',[App\Http\Controllers\DubiaLuckyRecordController::class, 'terminate']);   
    Route::get('dubaitwodList/{number?}/open',[App\Http\Controllers\DubiaLuckyRecordController::class, 'open']);  
    // three D
    Route::get("3dList",[App\Http\Controllers\ThreedLuckyRecordController::class,'index'])->name('admin.3dLists');
    Route::get("3d/{sort?}",[App\Http\Controllers\ThreedListController::class,'index'])->name('admin.3d');

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
    Route::get("logout",[LoginController::class,'logout']);
    //dubai
    Route::get('dubai2d',[App\Http\Controllers\DubaiModeratorController::class,'index']);
    Route::post("dubai2d",[App\Http\Controllers\DubaiModeratorController::class,'store']);
    Route::get("dubaihistory",[App\Http\Controllers\DubaiModeratorController::class,'history']);
    Route::get("dubaihistory/{id}",[App\Http\Controllers\DubaiModeratorController::class,'vouncher']);
    Route::get('histories',[App\Http\Controllers\DubaiModeratorController::class,'create']);

    //three D
    Route::get('threed',[App\Http\Controllers\ThreedModeratorController::class,'index']);
    Route::post('threed',[App\Http\Controllers\ThreedModeratorController::class,'store']);
    Route::get("3dhistory",[App\Http\Controllers\ThreedModeratorController::class,'history']);
    Route::get("3dhistory/{id}",[App\Http\Controllers\ThreedModeratorController::class,'vouncher']);

});
