<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\AuthorAPIController;
use App\Http\Controllers\API\BookAPIController;
use App\Http\Controllers\API\GenreAPIController;
use App\Http\Controllers\API\PublisherAPIController;
use App\Http\Controllers\API\UserAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('login', [AuthAPIController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('users', UserAPIController::class);
    Route::resource('publishers', PublisherAPIController::class);
    Route::resource('genres', GenreAPIController::class);
    Route::resource('authors', AuthorAPIController::class);
    Route::resource('books', BookAPIController::class);
    /* Logout a logged-in user */
    Route::post('/logout', [AuthAPIController::class, 'logout']);
});
