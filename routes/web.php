<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlShortenerController;

Route::get('/', function () {
    return view('shortener-url.form');
});

Route::get('/dashboard', function () {
    return redirect('/shortener-url/list');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Url Routes
    Route::get('/shortener-url/list', [UrlShortenerController::class, 'shortenerUrlList'])->name('url.list');
    
    Route::get('/shortener-url/all', [UrlShortenerController::class, 'allShortenerUrlList'])->name('url.all');

    Route::delete('/shortener-url/{urlShortener}/destroy', [UrlShortenerController::class, 'destroy'])->name('url.destroy');
});

require __DIR__.'/auth.php';

// Store Shortened URL
Route::post('/shortener-url/store', [UrlShortenerController::class, 'store'])->name('url.store');

// Redirect to original URL when accessing shortened URL
Route::get('/{urlShortener:slug}', [UrlShortenerController::class, 'redirectUrl'])->name('url.redirect');