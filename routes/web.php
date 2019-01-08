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

Route::get('/', 'WelcomeController@index');

Route::post('/create-author' , 'AuthorController@store');
Route::get('/get-all-author', 'AuthorController@getAllAuthor');

Route::post('/create-book' , 'BookController@store');
Route::get('/get-all-book', 'BookController@getAllBook');
