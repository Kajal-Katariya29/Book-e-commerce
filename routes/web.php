<?php

use App\Http\Controllers\admin\BookListController;
use App\Http\Controllers\admin\Category\CategoryController;
use App\Http\Controllers\admin\Role\PermissionController;
use App\Http\Controllers\admin\Role\RoleController;
use App\Http\Controllers\admin\Role\RolePermissionController;
use App\Http\Controllers\admin\Role\RoleUserController;
use App\Http\Controllers\admin\variants\VariantsController;
use App\Http\Controllers\admin\variants\VariantTypeController;
use App\Http\Controllers\front\HomePageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return view('welcome');
});

Route::resource('/books', BookListController::class);
Route::post('/delete-variant-type/{id}',[BookListController::class,'deleteVariantType'])->name('books.delete.variant');
Route::post('/delete-image/{id}',[BookListController::class,'deleteImage'])->name('books.delete.image');
Route::resource('/variants', VariantsController::class);
Route::resource('/variant-type',VariantTypeController::class);
Route::resource('/categories',CategoryController::class);
Route::post('/fetch-category',[BookListController::class,'fetchCategory'])->name('fetchCategory');
Route::resource('/roles',RoleController::class);
Route::resource('/permissions',PermissionController::class);
Route::resource('/role-permission',RolePermissionController::class);
Route::resource('/role-user',RoleUserController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home-page',[HomePageController::class,'viewHomePage'])->name('view.homePage');
