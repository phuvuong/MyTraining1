<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', [UserController::class, 'login'])->name('api.login');
Route::middleware(['auth.api'])->group(function () {
    Route::resource('home', HomeController::class)->only(['index', '']);
    Route::prefix('home')->group(function () {
        Route::controller(HomeController::class)->group(function () {
            Route::get('/product-with-category/{categoryId}', 'getProductsWithCategories')->name('api.show.categoryHome');
            Route::get('results/', 'searchProduct')->name('api.product.search');
        });
    });
    Route::resource('products', ProductController::class)->parameters(['products' => 'productId'])
        ->names(['create' => 'api.add.product',
            'store' => 'api.save.product',
            'show' => 'api.show.product',
            'update' => 'api.update.product',
            'destroy' => 'api.delete.product']);

    Route::controller(UserController::class)->group(function () {
        Route::post('/logout', 'logout')->name('api.logout');
    });
});
