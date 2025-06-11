<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsPageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

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
    Route::match(['get', 'post'], 'update_password', [AdminController::class, 'updatePassword'])->name('admin.update.password')->middleware('admin');
    Route::match(['get', 'post'], 'update-details', [AdminController::class, 'updateDetails'])->name('admin.update.details')->middleware('admin');
    Route::post('check-current-password', [AdminController::class, 'checkCurrentPassword'])->name('admin.check.current.password');
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');


    // Display CMS Pages (CRUD)
    Route::get('cms_pages', [CmsPageController::class, 'index'])->name('admin.cms_pages.index');
    Route::post('update-cms-page-status', [CmsPageController::class, 'update'])->name('admin.cms_pages.update')->middleware('admin');
    Route::match(['get', 'post'],'add-edit-cms-page/{id?}' , [CmsPageController::class, 'edit'])->name('admin.cms_pages.edit')->middleware('admin');
    Route::get('delete-cms-page/{id}', [CmsPageController::class, 'destroy'])->name('admin.cms_pages.destroy');


    // subadmin
    Route::get('subadmins', [AdminController::class, 'subadmins'])->name('admin.subadmins.index');
    Route::post('update-subadmin-status', [AdminController::class, 'updateSubadminStatus'])->name('admin.subadmins.update')->middleware('admin');
    Route::match(['get', 'post'],'add-edit-subadmin/{id?}', [AdminController::class, 'addEditSubadmin'])->name('admin.add.edit.subadmin')->middleware('admin');
    Route::get('delete-subadmin/{id}', [AdminController::class, 'deleteSubadmin'])->name('admin.delete.subadmin');

    // Categories
    Route::get('categories', [CategoryController::class, 'categories'])->name('admin.categories.index');
    Route::post('update-category-status', [CategoryController::class, 'updateCategoryStatus'])->name('admin.categories.update')->middleware('admin');
    Route::match(['get', 'post'],'add-edit-category/{id?}' , [CategoryController::class, 'addEditCategory'])->name('admin.categories.edit')->middleware('admin');
    Route::get('delete-category/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
     Route::get('delete-category-image/{id}', [CategoryController::class, 'destroyImage'])->name('admin.categories.destroy-image');

      // Products
    Route::get('products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::post('update-product-status', [ProductController::class, 'updateProductStatus'])->name('admin.products.update')->middleware('admin');
    Route::match(['get', 'post'],'add-edit-product/{id?}' , [ProductController::class, 'addEditProduct'])->name('admin.products.edit')->middleware('admin');
    Route::get('delete-product/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
     Route::get('delete-product-image/{id}', [ProductController::class, 'destroyImage'])->name('admin.products.destroy-image');
    // Admins Roles
    Route::match(['get', 'post'], 'update-role/{id}', [AdminController::class, 'updateRole'])->name('admin.update.role')->middleware('admin');
}); 
});
