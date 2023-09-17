<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::prefix('v1.0')
	->group(function() {
		Route::controller(AuthController::class)
			->prefix('auth')
			->group(function() {
				Route::post('/login', 'login');
			});

		Route::controller(ProductController::class)
			->prefix('products')
			->group(function() {
				Route::get('/', 'getAllProducts');

        Route::middleware(['auth:sanctum', 'ability:admin'])
          ->group(function() {
            Route::post('/new', 'addNewProduct');
            Route::put('/{id}/update', 'updateProduct');
            Route::delete('/{id}/delete', 'destroy');
          });
			});
	});
