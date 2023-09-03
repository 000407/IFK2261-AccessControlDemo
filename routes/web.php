<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
	->name('home')
	->middleware(['auth.authorize']);

Route::controller(App\Http\Controllers\AdministrationController::class)
	->prefix('admin')
	->middleware(['auth.authorize:admin,root'])
	->group(function() {
		Route::get('/home', function() {
			return view("admin.dashboard");
		});
	});

Route::controller(App\Http\Controllers\PaymentsController::class)
	->prefix('payments')
	->group(function() {
		Route::post('/confirm', 'process')
			->name('process_payment');
	});

Route::get('/order/checkout', function () {
    return view('orders.checkout');
});
