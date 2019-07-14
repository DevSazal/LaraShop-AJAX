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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'DefaultController@index');
Route::get('/single', 'DefaultController@singleProduct');
Route::get('/shop', 'DefaultController@shop');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/autocomplete/fetch', 'DefaultController@fetch')->name('autocomplete.fetch');
