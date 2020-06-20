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
    return view('welcome');
});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('category')->name('category.')->group(function() {
   Route::get('/', 'CategoryController@index')->name('index');
   Route::post('/', 'CategoryController@store')->name('store');
   Route::get('/{id}', 'CategoryController@edit')->name('edit');
   Route::post('/{id}', 'CategoryController@update')->name('update');
   Route::delete('/{id}', 'CategoryController@destroy')->name('delete');
});

Route::prefix('ingredient')->name('ingredient.')->group(function() {
    Route::get('/', 'IngredientController@index')->name('index');
    Route::post('/', 'IngredientController@store')->name('store');
    Route::get('/{id}', 'IngredientController@edit')->name('edit');
    Route::post('/{id}', 'IngredientController@update')->name('update');
    Route::delete('/{id}', 'IngredientController@destroy')->name('delete');
});

Route::prefix('cook')->name('cook.')->group(function() {
    Route::get('/', 'CookController@index')->name('index');
    Route::post('/', 'CookController@store')->name('store');
    Route::get('/{id}', 'CookController@edit')->name('edit');
    Route::post('/{id}', 'CookController@update')->name('update');
    Route::delete('/{id}', 'CookController@destroy')->name('delete');
});
