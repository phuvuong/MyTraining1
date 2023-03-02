<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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
//     return view('pages.home');
// });


Route::resource('products',ProductController::class)
->names([  'create' => 'add.product',
            'store' => 'save.product',
            'show' => 'show.product',
            'update' => 'update.product',
            'destroy' => 'delete.product'])
->parameters([
    'products' => 'product_id'
]);
Route::middleware('auth:api')->group(function () {
    Route::controller(HomeController::class)->group(function () { 
        Route::get('/', 'index')->name('home');
    });
    Route::prefix('home')->group(function () {
        Route::controller(HomeController::class)->group(function () {
            Route::get('/', 'index')->name('home');
            Route::get('/danh-muc-san-pham/{category_id}', 'getProductsWithCategories')->name('show.categoryHome');
            Route::get('results/', 'searchProduct')->name('product.search');
        });
    });
        Route::controller(UserController::class)->group(function () {
        Route::get('/logout', 'logout')->name('logout');    
    });
});

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'getLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
});