<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/show_cart', );


Route::get('/redirect', [HomeController::class, 'redirect']);
Route::get('/product_details/{id}', [HomeController::class, 'product_details']);
// Route::get('/addto_cart/{id}', [HomeController::class, 'addto_cart']);
Route::get('/show_cart', [HomeController::class, 'show_cart']);
Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
Route::get('/cash_order', [HomeController::class, 'cash_order']);
Route::get('/stripe/{totalprice}', [HomeController::class, 'stripe']);
Route::post('/stripe/{totalprice}', [HomeController::class, 'stripepost'])->name('stripe.post');






Route::get('/view_catagory', [AdminController::class, 'view_catagory']);
Route::post('/add_catagory', [AdminController::class, 'add_catagory']);
Route::get('/delete_catagory/{id}', [AdminController::class, 'delete_catagory']);
Route::get('/view_product', [AdminController::class, 'view_product']);
Route::post('/add_product', [AdminController::class, 'add_product']);
Route::get('/show_product', [AdminController::class, 'show_product']);
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
Route::get('/update_product/{id}', [AdminController::class, 'update_product']);
Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);
Route::get('/order', [AdminController::class, 'order']);
Route::get('/update_delivery_status/{id}', [AdminController::class, 'update_delivery_status']);