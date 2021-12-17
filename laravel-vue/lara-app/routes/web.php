<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index'])->name('author');
Route::get('/books', [App\Http\Controllers\BookController::class, 'index'])->name('book');
Route::get('/catalogs', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');
Route::get('/publishers', [App\Http\Controllers\PublisherController::class, 'index'])->name('publisher');
Route::get('/members', [App\Http\Controllers\MemberController::class, 'index'])->name('member');
Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction');
Route::get('/detail_transactions', [App\Http\Controllers\DetailTransactionController::class, 'index'])->name('detail_transaction');

