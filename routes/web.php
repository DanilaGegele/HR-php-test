<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::get('/weather', 'WeatherController@index');

Route::get('/orders', 'OrderController@index');

Route::get('/order/{id}/edit', 'OrderController@edit');

Route::post('/order/{id}/update', 'OrderController@store');

Route::get('/products','ProductController@index');

Route::get('/products/price-edit', 'ProductController@priceEdit');