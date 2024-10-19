<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication routes provided by Breeze
require __DIR__.'/auth.php';

Route::get('/about', [AboutController::class, 'index'])->name('about.index');


// Test route for debugging
Route::get('test', function () {
    return 'Test route is working!';
});

// Public routes (guests can access the game list and view)
Route::get('games', [GameController::class, 'index'])->name('games.index');
Route::get('games/{game}', [GameController::class, 'show'])->name('games.show');

// Authenticated routes (only logged-in users can access)
Route::middleware(['auth'])->group(function () {
    // Games management
    Route::get('games/new/create', [GameController::class, 'create'])->name('games.create');
    Route::post('games', [GameController::class, 'store'])->name('games.store');
    Route::get('games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('games/{game}', [GameController::class, 'update'])->name('games.update');
    Route::delete('games/{game}', [GameController::class, 'destroy'])->name('games.destroy');

    // Routes for Profile (only for authenticated users)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tags management (only authenticated users can see and manage tags)
    Route::get('tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('tags/{tag}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
});
