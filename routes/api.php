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



Route::prefix("events")->group(function () {
    Route::get('/', 'App\Http\Controllers\EventController@index')->name("events.index");
    Route::post('/', 'App\Http\Controllers\EventController@store')->name("events.store");
});


Route::prefix("promo_codes")->group(function () {
    Route::get('/', 'App\Http\Controllers\PromoCodeController@index')->name("promo_codes.index");
    Route::post('/', 'App\Http\Controllers\PromoCodeController@store')->name("promo_codes.store");
    Route::get('/active', 'App\Http\Controllers\PromoCodeController@getActivePromoCode')->name("promo_codes.getActivePromoCode");
    Route::get('/inActive', 'App\Http\Controllers\PromoCodeController@getInActivePromoCode')->name("promo_codes.getInActivePromoCode");
    Route::put('/{promoCode}/active', 'App\Http\Controllers\PromoCodeController@active')->name("promo_codes.active");
    Route::put('/{promoCode}/inActive', 'App\Http\Controllers\PromoCodeController@inActive')->name("promo_codes.inActive");

});