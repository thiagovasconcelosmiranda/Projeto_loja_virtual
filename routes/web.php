<?php

use App\Http\Controllers\Auth\SigninController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('auth')->group(function () {
  Route::get('/signin', [SigninController::class, 'index'])
  ->name('login');
  Route::post('/signin', [SigninController::class, 'find'])
  ->name('login.post');

  Route::get('/signup', [SignUpController::class, 'index']);
  Route::post('/signup', [SignUpController::class, 'create'])
  ->name('auth.create');
  Route::post('/logout', [SignUpController::class, 'logout'])
  ->middleware('auth:sanctum');
});


Route::get('/vendas', [SaleController::class, 'index'])->name('sales')
->middleware('auth:sanctum');

Route::get('/ajax/vendas/{search}', [SaleController::class, 'searchSale'])
->middleware('auth:sanctum');

Route::post('/ajax/venda/create', [SaleController::class, 'createItem'])
->middleware('auth:sanctum');

Route::get('/venda/edit/{id}', [SaleController::class, 'indexEdit'])
->middleware('auth:sanctum');
Route::post('/venda/edit/{id}', [SaleController::class, 'updateItem'])
->middleware('auth:sanctum');

Route::get('/venda/delete/{id}', [SaleController::class, 'deleteItem'])
->middleware('auth:sanctum');

Route::get('/produto/{id}', [ProductController::class, 'index']);

Route::get('/ajax/produto/{id}', [ProductController::class, 'ajaxProduct']);




