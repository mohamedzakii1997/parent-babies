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

Route::namespace('App\Http\Controllers')->middleware(['api'])->group(function () {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    Route::middleware('auth:api')->group(function () {
        Route::get('logout', 'AuthController@logout');


        //parent babies
        Route::prefix('babies')->group(function () {
            Route::get('/', 'BabyController@list');
            Route::post('store', 'BabyController@store');
            Route::get('show', 'BabyController@show');
            Route::post('update', 'BabyController@update');
            Route::post('delete', 'BabyController@destroy');
            Route::post('add/partner', 'BabyController@addPartner');
            Route::get('list/all/parents', 'BabyController@listAllParents');
            Route::get('show/partner', 'BabyController@showPartner');
            Route::get('remove/partner', 'BabyController@removePartner');

        });

    });
});
