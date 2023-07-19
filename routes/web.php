<?php

use App\Http\Controllers\admin\BookListController;
use App\Http\Controllers\admin\Category\CategoryController;
use App\Http\Controllers\admin\Category\categorySubController;
use App\Http\Controllers\admin\Category\categorySubSubController;
use App\Http\Controllers\admin\Role\PermissionController;
use App\Http\Controllers\admin\Role\RoleController;
use App\Http\Controllers\admin\Role\RolePermissionController;
use App\Http\Controllers\admin\Role\RoleUserController;
use App\Http\Controllers\admin\variants\VariantsController;
use App\Http\Controllers\admin\variants\VariantTypeController;
use App\Http\Controllers\front\BookDetailPageController;
use App\Http\Controllers\front\CartListController;
use App\Http\Controllers\front\CheckOutPageController;
use App\Http\Controllers\front\HomePageController;
use App\Http\Controllers\front\OrderListController;
use App\Http\Controllers\front\PlaceOrderController;
use App\Http\Controllers\front\PaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//use of middlewares
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;



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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//User Routes
//Middleware for User

Route::middleware([UserMiddleware::class])->group(function () {

    // route for home-page and detail-page
    Route::get('/home-page',[HomePageController::class,'viewHomePage'])->name('view.homePage');
    Route::get('/book-detail-page/{id}',[BookDetailPageController::class,'bookDetail'])->name('view.bookDetail');

    //routes for cart
    Route::resource('/cart',CartListController::class);
    Route::get('/cart-view/{id}',[CartListController::class,'cartView'])->name('view-cart');

    //routes for check out
    Route::get('/check-out',[CheckOutPageController::class,'checkOut'])->name('view-checkOut');
    Route::post('/check-out-store',[CheckOutPageController::class,'store'])->name('checkOut.store');
    Route::post('/check-out-update',[CheckOutPageController::class, 'update'])->name('checkOut.update');
    Route::get('/check-out-create',[CheckOutPageController::class,'createEdit'])->name('checkOut.create');
    Route::get('/check-out-edit/{id}',[CheckOutPageController::class,'createEdit'])->name('checkOut.edit');
    Route::get('/deliever-address',[CheckOutPageController::class,'delieverAddress'])->name('deliever.address');

    //routes for place order
    Route::get('/place-order/{id}',[PlaceOrderController::class,'placeOrder'])->name('view-place-order');
    Route::post('/place-order-store',[PlaceOrderController::class, 'store'])->name('checkOut.store');

    //routes for Order Listing page
    Route::get('/order-list',[OrderListController::class,'orders'])->name('order.view');
    Route::get('/order-detail/{id}',[OrderListController::class,'orderDetail'])->name('order.detail');

    //routes for payment gateway
    Route::get('/payment-success',[PaymentController::class,'success'])->name('payment.success');
    Route::get('/payment-cancel',[PaymentController::class,'cancel'])->name('payment.cancel');

});

////Admin Routes

Route::group(['prefix' => 'admin'], function(){

    //Middleware for admin
    Route::middleware([AdminMiddleware::class])->group(function () {

        Route::resource('/books', BookListController::class);
        Route::post('/delete-image/{id}',[BookListController::class,'deleteImage'])->name('books.delete.image');
        Route::post('/fetch-category',[BookListController::class,'fetchCategory'])->name('fetchCategory');
        // Route::post('/fetch-sub-category',[BookListController::class,'fetchSubCategory'])->name('fetchSubCategory');
        // Route::post('/fetch-sub-sub-category',[BookListController::class,'fetchSubSubCategory'])->name('fetchSubSubCategory');

        //routes for variants
        Route::resource('/variants', VariantsController::class);

        //routes for variant type
        Route::resource('/variant-type',VariantTypeController::class);
        Route::post('/delete-variant-type/{id}',[BookListController::class,'deleteVariantType'])->name('books.delete.variant');

        //routes for categories
        Route::resource('/categories',CategoryController::class);

        //routes for sub categories
        Route::resource('/sub-categories',categorySubController::class);

        //route for sub sub category
        Route::resource('/sub-sub-categories',categorySubSubController::class);
        // Route::post('/fetch-category',[categorySubSubController::class,'fetchCategory'])->name('fetchCategory');

        //routes for role and role user
        Route::resource('/roles',RoleController::class);
        Route::resource('/role-user',RoleUserController::class);

        //routes for permissions and role permissions
        Route::resource('/permissions',PermissionController::class);
        Route::resource('/role-permission',RolePermissionController::class);
    });
});






