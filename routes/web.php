<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParserController;
use App\Http\Controllers\ParserCastController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ParserController::class, 'index']);
Route::get('/rating', [MovieController::class, 'index'])->name('rating');
Route::get('/upload', [ParserController::class, 'create'])->name('import');
Route::post('/upload', [ParserController::class, 'upload'])->name('importmovies');
Route::post('/upload-casts', [ParserCastController::class, 'upload'])->name('importcasts');
