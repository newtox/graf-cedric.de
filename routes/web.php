<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false,
]);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::controller(GameController::class)
    ->group(function () {
        Route::get('/games', 'index')->name('games.index');
        Route::get('/games/{game}', 'show')->name('games.show');
    });

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::prefix('games')->name('games.')->controller(AdminGameController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{game}/edit', 'edit')->name('edit');
        Route::put('/{game}', 'update')->name('update');
        Route::delete('/{game}', 'destroy')->name('destroy');
    });

    Route::prefix('tags')->name('tags.')->controller(TagController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{tag}/edit', 'edit')->name('edit');
        Route::put('/{tag}', 'update')->name('update');
        Route::delete('/{tag}', 'destroy')->name('destroy');
    });

    Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{user}/edit', 'edit')->name('edit');
        Route::put('/{user}', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('destroy');
    });
});
