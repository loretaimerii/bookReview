<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books',BookController::class)
    ->only(['index','show']);

Route::resource('books.reviews',ReviewController::class)
    ->scoped(['review'=>'book'])
    ->only(['create','store']);

Route::middleware(['throttle:review-limit'])->post('/books/{book}/reviews', [ReviewController::class, 'store'])
     ->name('books.reviews.store');
