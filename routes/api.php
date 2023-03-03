<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiHomeController;
use App\Http\Controllers\Api\ApiProductController;

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

Route::resource('home' , ApiHomeController::class)->only(['index', 'show','update','delete','store']);
Route::resource('products',ApiProductController::class)
->names([  'create' => 'api.add.product',
            'store' => 'api.save.product',
            'show' => 'api.show.product',
            'update' => 'api.update.product',
            'destroy' => 'api.delete.product'])
->parameters([
    'products' => 'product_id'
]);