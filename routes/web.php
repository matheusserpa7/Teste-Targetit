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

// Rotas para Login

  Route::get('/login',['uses'=>'Controller@fazerLogin']);

  Route::post('/login',['as'=>'user.login','uses'=>'DeashboardController@auth']);
  Route::get('/deashboard',['as'=>'user.deashboard','uses'=>'DeashboardController@index']);
