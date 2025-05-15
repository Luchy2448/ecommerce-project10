<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsPageController;

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
    Route::match(['get', 'post'], 'update-details', [AdminController::class, 'updateDetails'])->name('admin.update.details');
    Route::post('check-current-password', [AdminController::class, 'checkCurrentPassword'])->name('admin.check.current.password');
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');


    // Display CMS Pages (CRUD)
    Route::get('cms_pages', [CmsPageController::class, 'index'])->name('admin.cms_pages.index');
    Route::post('update-cms-page-status', [CmsPageController::class, 'update'])->name('admin.cms_pages.update');
    // Route::get('add-edit-cms-page/{id?}', [CmsPageController::class, 'create'])->name('admin.cms_pages.create');
    // Route::post('add-edit-cms-page/{id?}', [CmsPageController::class, 'store'])->name('admin.cms_pages.store');
    
    // Route::get('view-cms-page/{id}', [CmsPageController::class, 'show'])->name('admin.cms_pages.show');
    Route::match(['get', 'post'],'add-edit-cms-page/{id?}' , [CmsPageController::class, 'edit'])->name('admin.cms_pages.edit');
    Route::get('delete-cms-page/{id}', [CmsPageController::class, 'destroy'])->name('admin.cms_pages.destroy');
}); 
});
