<?php

use App\Http\Controllers\admin\BookListController;
use App\Http\Controllers\admin\variants\VariantsController;
use App\Http\Controllers\admin\variants\VariantTypeController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/books', BookListController::class);
Route::post('/delete-image/{id}',[BookListController::class,'deleteImage'])->name('books.delete.image');
Route::resource('/variants', VariantsController::class);
Route::resource('/variant-type',VariantTypeController::class);
