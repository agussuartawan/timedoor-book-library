<?php

use App\Http\Controllers\BookController;
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

Route::get('/', function() {
    return to_route('books');
});

Route::get('/books', [BookController::class, 'books'])->name('books');
Route::get('/authors', [BookController::class, 'authors'])->name('authors');
Route::get('/rating', [BookController::class, 'rating'])->name('ratings');
Route::post('/rating', [BookController::class, 'storeRating'])->name('ratings.store');
