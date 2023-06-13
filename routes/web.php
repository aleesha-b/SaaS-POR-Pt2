<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

Route::get('/', [StaticPageController::class, 'home'])->name('home');

Route::group(['middleware'=>['auth']], function () {
    Route::resource('books', BookController::class);
    Route::get('/books/{book}/delete', [BookController::class, 'delete'])->name("books.delete");
    Route::resource('genres', GenreController::class);
    Route::get('/genres/{genre}/delete', [GenreController::class, 'delete'])->name("genres.delete");
    Route::get('logout', function ()
    {
        auth()->logout();
        Session()->flush();

        return Redirect::to('/');
    })->name('logout');
});

require __DIR__.'/auth.php';
