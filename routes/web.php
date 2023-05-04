<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    if (Auth::check()) {
      return view('welcome');
    }else{
        return view('auth.login');
    } 
  })->name('wel.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('type');

Route::match(['get','post'],'index_admin',[App\Http\Controllers\AdminController::class, 'index_admin'])->name('admin.index_admin')->middleware('type');// admin 
Route::match(['get','post'],'index_user',[App\Http\Controllers\AdminController::class, 'index_user'])->name('user.index_user')->middleware('type');// user 
 
Route::middleware(['type'])->group(function(){ 

    Route::match(['get','post'],'manage_dashboard',[App\Http\Controllers\ManagerController::class, 'manage_dashboard'])->name('manage.manage_dashboard');// manage
    Route::match(['get','post'],'index_manage',[App\Http\Controllers\ManagerController::class, 'index_manage'])->name('manage.index_manage');// manage

    Route::match(['get','post'],'manage_pullacc',[App\Http\Controllers\ManagerController::class, 'manage_pullacc'])->name('manage.manage_pullacc');// manage
    Route::match(['get','post'],'manage_pullaccsave',[App\Http\Controllers\ManagerController::class, 'manage_pullaccsave'])->name('manage.manage_pullaccsave');// manage
    Route::match(['get','post'],'manage_heck_sit',[App\Http\Controllers\ManagerController::class, 'manage_heck_sit'])->name('manage.manage_heck_sit');// manage

    Route::match(['get','post'],'manage_setting',[App\Http\Controllers\ManagerController::class, 'manage_setting'])->name('manage.manage_setting');// manage
    Route::match(['get','post'],'manage_setting_edit/{pttype}',[App\Http\Controllers\ManagerController::class, 'manage_setting_edit'])->name('manage.manage_setting_edit');// 
    Route::match(['get','post'],'manage_setting_update',[App\Http\Controllers\ManagerController::class, 'manage_setting_update'])->name('manage.manage_setting_update');// manage
});