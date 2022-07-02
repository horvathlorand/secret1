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

/**
 * Public routes without authentication.
 */
Route::prefix('secret')->group(function() {
    Route::get('{hash}', 'App\Http\Controllers\SecretController@getSecretByHash');
    Route::post('/save', 'App\Http\Controllers\SecretController@save');
});
