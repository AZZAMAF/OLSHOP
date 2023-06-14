<?php

use App\Http\Controllers\MyTransactionController;
use App\Http\Controllers\WEB\CategoryController;
use App\Http\Controllers\WEB\FrontEndController;
use App\Http\Controllers\WEB\ProductController;
use App\Http\Controllers\WEB\ProductGalleryController;
use App\Http\Controllers\WEB\TransactionController;
use App\Http\Controllers\WEB\UserController;
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

Route::get('/',[FrontEndController::class, 'index']);
Route::get('/detail-product/{slug}',[FrontEndController::class, 'detailsProduct'])->name('detailsProduct');
Route::middleware(['auth','verified'])->group(function(){
    Route::get('/cart/',[FrontEndController::class, 'cart'])->name('cart');
    Route::post('/cart/{id}',[FrontEndController::class, 'cartStore'])->name('cart-store');
    Route::delete('/cart/{id}',[FrontEndController::class, 'cartDelete'])->name('cart-Delete');
    Route::post('/chekout',[FrontEndController::class, 'checkout'])->name('checkout');
});
Route::get('/detail-category/{slug}',[FrontEndController::class, 'detailCategory'])->name('detailsCategory');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->name('dashboard.')
    ->prefix('dashboard')->group(function () {
        Route::resource('/my-transaction',MyTransactionController::class);
        // 127.0.0.1:8000/dashboard/category => setelah ada prefix('dashboard')
        // 127.0.0.1:8000/category => sebelum ada prefix('dashboard')
        // category.index => sebelum ada name route('dashboard.')
        // dashboard.category.index => setelah ada name route('dashboard.')

        Route::middleware(['admin'])->group(function () {
            //Route yang ada didalam middleware admin maka
            // yang bisa mengakses hanya admin
            Route::resource('/category', CategoryController::class);
            Route::resource('/product', ProductController::class);
            Route::resource('/product.gallery', ProductGalleryController::class)->only([
                'index', 'create', 'store', 'destroy'
            ]);
            Route::resource('/transaction', TransactionController::class)->only([
                'index', 'update', 'show','edit'
            ]);
            Route::resource('/user', UserController::class)->only(
                'index',
                'edit',
                'update',
                'destroy'
            );

        });
    });
