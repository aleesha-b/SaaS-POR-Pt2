<?php

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

Route::resource('users', UserAPIController::class);
Route::resource('publishers', PublisherAPIController::class);
Route::resource('genres', GenreAPIController::class);
