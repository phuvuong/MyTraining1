<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiHomeController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiUserController;

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


Route::resource('home' , ApiHomeController::class)->only(['index','']);
Route::prefix('home')->group(function () {
    Route::controller(ApiHomeController::class)->group(function () {
        Route::get('/danh-muc-san-pham/{category_id}', 'getProductsWithCategories')->name('api.show.categoryHome');
        Route::get('results/', 'searchProduct')->name('api.product.search');
    });
});
Route::resource('products',ApiProductController::class)
->names([  'create' => 'api.add.product',
            'store' => 'api.save.product',
            'show' => 'api.show.product',
            'update' => 'api.update.product',
            'destroy' => 'api.delete.product'])
->parameters([
    'products' => 'product_id'
]);
Route::post('/login', [ApiUserController::class, 'login'])->name('api.login');
Route::middleware(['auth:api'])->group(function ()  {
    Route::controller(ApiUserController::class)->group(function () {
        Route::post('/logout', 'logout')->name('api.logout')->middleware('api');       
    });
});