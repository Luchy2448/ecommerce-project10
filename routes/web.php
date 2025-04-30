<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
   // login
   Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('admin.login');
   
   Route::group(['middleware' => ['admin']], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::match(['get', 'post'], 'update_password', [AdminController::class, 'updatePassword'])->name('admin.update.password');
    Route::post('check-current-password', [AdminController::class, 'checkCurrentPassword'])->name('admin.check.current.password');
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');

   }); 
});
