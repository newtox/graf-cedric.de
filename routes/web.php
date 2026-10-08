<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::redirect('/home', '/', 301);
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::controller(GameController::class)
    ->group(function () {
        Route::get('/games', 'index')->name('games.index');
        Route::get('/games/{game:slug}', 'show')
            ->name('games.show')
            ->missing(function (Request $request) {
                $value = $request->route('game');

                if (ctype_digit((string) $value) && $game = Game::find($value)) {
                    return redirect()->route('games.show', $game, 301);
                }

                abort(404);
            });
    });

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::prefix('companies')->name('companies.')->controller(CompanyController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{company}/edit', 'edit')->name('edit');
        Route::put('/{company}', 'update')->name('update');
        Route::delete('/{company}', 'destroy')->name('destroy');
    });

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

require __DIR__ . '/auth.php';
