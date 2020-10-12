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
    echo phpinfo();
});
Route::prefix('user')->group(function(){
    Route::get('/add','User@add');
    Route::get('/regist','User@regist');
    Route::post('/registDo','User@registDo');
    Route::get('/login','User@login');
    Route::post('/loginDo','User@loginDo');
    Route::post('/stoe','User@stoe');
    Route::get('/index','User@index');
    Route::any('delete/{id}','User@delete');
    Route::any('edit/{id}','User@edit');
    Route::any('/update/{id}','Uses@update');
});



Route::prefix('goods')->group(function(){

    Route::get('/create','Goods@create');
    Route::get('/index','Goods@index');
});

Route::prefix('admin')->group(function(){
//用户添加
    Route::get('/create','AdminController@create');
    Route::post('/insert','AdminController@insert');
    Route::get('/index','AdminController@index');
    Route::any('delete/{id}','AdminController@delete');
    Route::get('edit/{id}','AdminController@edit');
    Route::post('/update/{id}','AdminController@update');
    Route::get('/login','AdminController@login');
    Route::post('/logindo','AdminController@logindo');
});