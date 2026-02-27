<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;;
use App\Http\Controllers\SyncController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class,'index']);

Route::get('/sync', [MovieController::class,'sync'])
->name('movies.sync');

Route::post('sync/movies', [SyncController::class,'syncMovies'])
->name('sync.movies');

Route::resource('movies', MovieController::class);