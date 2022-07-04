<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReguserController;

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


Route::get('/', [adminController::class,'adminLogin']);
Route::post('/login/auth', [adminController::class,'adminAuth'])->name('admin.adminauth');

Route::get('/loginuser', [ReguserController::class,'loginuser']);
Route::post('/loginuser/auth', [ReguserController::class,'userAuth'])->name('reguser.adminauth');

Route::group(['middleware'=>'admin_auth'],function(){
    Route::get('/admin', [adminController::class,'adminpage']);
    Route::post('/admin/addqus', [QuestionController::class,'addqustion'])->name('addqustions');
});

Route::group(['middleware'=>'user_auth'],function(){
    Route::get('/home', [ReguserController::class,'homepage']);
    Route::post('/home/ansqus', [ReguserController::class,'checkans'])->name('homepage.ansqus');
    Route::get('/home/ansqus/tryagain', [ReguserController::class,'tryagian']);
});

Route::get('/logout/admin', function () {
    session()->forget('ADMIN_LOGIN');
    session()->forget('ADMIN_ID');
    session()->forget('ADMIN_NAME');
    return redirect('/');   
});
Route::get('/logout/user', function () {
    session()->forget('USER_LOGIN');
    session()->forget('USER_ID');
    session()->forget('USER_NAME');
    return redirect('/loginuser');   
});