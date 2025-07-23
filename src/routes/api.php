<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnimeApiController;
Route::prefix('animes')->group(function () {
    Route::get('/', [AnimeApiController::class, 'index']);
    Route::post('/', [AnimeApiController::class, 'store']);
    Route::get('/{id}', [AnimeApiController::class, 'show']);
    Route::delete('/{id}', [AnimeApiController::class, 'destroy']);
});


