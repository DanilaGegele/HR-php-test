<?php

use Illuminate\Container\Container;
use Illuminate\Http\Request;
use App\Container\OrderContainer;

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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => '/v1', 'as' => 'api.*', 'namespace' => 'Api\v1'], function () {
    // Вывод списка "Просроченные заказы"
    Route::get('/loadOrderOverdue', [
        'as' => 'loadOrderOverdue',
        'uses' => 'OrderController@loadOrderOverdue',
    ]);

    // Вывод списка "Текущие заказы"
    Route::get('/loadOrderCurrent', [
        'as' => 'loadOrderCurrent',
        'uses' => 'OrderController@loadOrderCurrent',
    ]);

    // Вывод списка "Новые заказы"
    Route::get('/loadOrderNew', [
        'as' => 'loadOrderNew',
        'uses' => 'OrderController@loadOrderNew',
    ]);

    // Вывод списка "Выполненные заказы"
    Route::get('/loadOrderFulfilled', [
        'as' => 'loadOrderFulfilled',
        'uses' => 'OrderController@loadOrderFulfilled',
    ]);

    // Вывод данных по определенному заказу
    Route::get('/getOrder/{id}', [
        'as' => 'getOrder',
        'uses' => 'OrderController@getOrder',
    ]);


    // Вывод списка партнеров
    Route::get('/getPartnersList', [
        'as' => 'getPartnersList',
        'uses' => 'PartnersController@getPartnersList',
    ]);

    // Вывод списка товаров
    Route::get('/getProductList', [
        'as' => 'getProductList',
        'uses' => 'ProductController@getProductList',
    ]);

    // Обновить данные заказа
    Route::post('/updateOrder/{id}', [
        'as' => 'updateOrder',
        'uses' => 'OrderController@updateOrder',
    ]);

    // Обновить цену у продукта
    Route::post('/updateProduct/{id}', [
        'as' => 'updateProduct',
        'uses' => 'ProductController@updateProduct',
    ]);

    // Вывести погоду в Брянске
    Route::get('/getWeather', [
        'as' => 'getWeather',
        'uses' => 'WeatherController@index',
    ]);

});