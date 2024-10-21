<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;



Route::post('/shorten', [UrlController::class, 'store']);

Route::get('/shorten/{shortCode}', [UrlController::class, 'show']);

Route::put('/shorten/{shortCode}', [UrlController::class, 'update']);

Route::delete('/shorten/{shortCode}', [UrlController::class, 'destroy']);

Route::get('/shorten/{shortCode}/stats', [UrlController::class, 'stats']);

