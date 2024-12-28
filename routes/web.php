<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProductController;

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

// Route::get('/', function () {
//     return view('welcome'); 
// });

Route::controller(AuthController::class)->group(function()
{
    Route::get('/','index')->name('login');
    Route::post('/','auth');
}
);

Route::controller(AdminController::class)->group(function()
{
    Route::get('/admin','index')->name('admin')->middleware('can:is_admin');
}
);

Route::controller(OrderController::class)->group(function()
{
    Route::get('/order','index')->name('order')->middleware('auth');
}
);
