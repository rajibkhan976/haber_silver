<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::any('/', function () {

    return redirect('web/html');
});

Route::get('/home', function () {
    return view('welcome');
});


Route::any('/login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@index'
]);

Route::any('post-login', [
    'as' => 'post-login',
    'uses' => 'Auth\LoginController@post_login'
]);

