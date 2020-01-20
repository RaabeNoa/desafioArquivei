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
    return view('index');
});
Route::get('/nfes/list', 'NFeController@index');
Route::get('/nfes', 'NFeController@redirectToIndex');
Route::post('/nfes', 'NFeController@store');
Route::post('/nfes/list', 'NFeController@search');
