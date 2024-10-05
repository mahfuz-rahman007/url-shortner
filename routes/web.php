<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlShortenerController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Url Routes
    Route::get('/shortener-url/list', [UrlShortenerController::class, 'shortenerUrlList'])->name('url.list');

    Route::post('/shortener-url/form', [UrlShortenerController::class, 'store'])->name('url.form');

    Route::post('/shortener-url/store', [UrlShortenerController::class, 'store'])->name('url.store');

    Route::get('/shortener-url/{urlShortener}/edit', [UrlShortenerController::class, 'edit'])->name('url.edit');
    Route::put('/shortener-url/{urlShortener}/update', [UrlShortenerController::class, 'update'])->name('url.update');
    Route::delete('/shortener-url/{urlShortener}/destroy', [UrlShortenerController::class, 'destroy'])->name('url.destroy');


});

require __DIR__.'/auth.php';

// Redirect to original URL when accessing shortened URL
Route::get('/{urlShortener:slug}', [UrlShortenerController::class, 'redirectUrl'])->name('url.redirect');