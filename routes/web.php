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
    Route::match(['get','post'],'manage_pull_pttype',[App\Http\Controllers\ManagerController::class, 'manage_pull_pttype'])->name('manage.manage_pull_pttype');// manage

    Route::match(['get','post'],'add_opd_new',[App\Http\Controllers\ManagerController::class, 'add_opd_new'])->name('manage.add_opd_new');//
    Route::match(['get','post'],'add_ipd_new',[App\Http\Controllers\ManagerController::class, 'add_ipd_new'])->name('manage.add_ipd_new');//

    Route::match(['get','post'],'authencode_auto',[App\Http\Controllers\AuthenautoController::class,'authencode_auto'])->name('authencode_auto');
    Route::match(['get','post'],'authencode_auto_detail',[App\Http\Controllers\AuthenautoController::class,'authencode_auto_detail'])->name('authencode_auto_detail');
    Route::match(['get','post'],'authencode_auto_save',[App\Http\Controllers\AuthenautoController::class,'authencode_auto_save'])->name('authencode_auto_save');
    Route::match(['get','post'],'getsmartcard_authencode',[App\Http\Controllers\AuthenautoController::class,'getsmartcard_authencode'])->name('getsmartcard_authencode');
    Route::match(['get','post'],'smartcard_authencode_save',[App\Http\Controllers\AUTHENCHECKController::class,'smartcard_authencode_save'])->name('smartcard_authencode_save');

    Route::match(['get','post'],'pullauthencode_auto',[App\Http\Controllers\AuthenautoController::class,'pullauthencode_auto'])->name('pullauthencode_auto');


});
