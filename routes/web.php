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
Route::get('/add','User@add');
Route::post('/user/stoe','User@stoe');
Route::get('/index','User@index');
Route::any('delete/{id}','User@delete');
Route::any('edit/{id}','User@edit');
Route::any('/user/update/{id}','Uses@update');



Route::get('/create','Goods@create');
