<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/hello', [TestController::class, 'testView']);
Route::get('/categories',[CategoryController::class, 'index'])->name('categories.list');



Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('', [ProductController::class, 'store'])->name('store');
    Route::get('show', [ProductController::class, 'show'])->name('show');


});

Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
    Route::get('/create',[CategoryController::class, 'create'])->name('create');
    Route::post('', [CategoryController::class, 'store'])->name('store');

});

Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/categories/{category}/products', [ProductController::class, 'list'])->name('products.list');

require __DIR__.'/auth.php';
