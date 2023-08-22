<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [\App\Http\Controllers\UserController::class, 'prijava']);
Route::post('register', [\App\Http\Controllers\UserController::class, 'registracija']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('tipovi', \App\Http\Controllers\TipController::class);
    Route::resource('ukusi', \App\Http\Controllers\UkusController::class);
    Route::resource('proizvodi', \App\Http\Controllers\ProizvodController::class);
});

