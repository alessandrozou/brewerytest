<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\Api\BreweryController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/breweries', [BreweryController::class, 'index']);
    Route::get('/breweries/{id}', [BreweryController::class, 'show']);
});


