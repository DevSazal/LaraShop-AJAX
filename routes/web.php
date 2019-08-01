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
Route::get('/scraper', 'DefaultController@scraperView');
Route::get('/picker', 'DefaultController@scraperFetch');
Route::get('/jsonpicker', 'JsonPickerController@json');
Route::get('/get-json-item-price', 'JsonPickerController@getProductPrice');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/autocomplete/fetch', 'DefaultController@fetch')->name('autocomplete.fetch');

// Live Search Shop Page
Route::get('/live', 'LiveSearchController@liveshop')->name('liveshop');
Route::get('/live/fetch', 'LiveSearchController@fetch')->name('LiveSearch.action');
