<?php

use App\Http\Controllers\CharacterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\QuoteController;

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

Route::group(['middleware' => ['throttle:20']], function () {
    Route::group(['prefix' => 'episodes'], function () {
        Route::get('/', [EpisodeController::class, 'index']);
        Route::get('{id}', [EpisodeController::class, 'show']);
    });

    Route::group(['prefix' => 'characters'], function () {
        Route::get('/', [CharacterController::class, 'index']);
        Route::get('random', [CharacterController::class, 'random']);
    });

    Route::group(['prefix' => 'quotes'], function () {
        Route::get('/', [QuoteController::class, 'index']);
        Route::get('random', [QuoteController::class, 'random']);
    });
});
