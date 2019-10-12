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

  Route::get('/login',['as'=>'login','uses'=>'Controller@fazerLogin']);
  Route::post('/login',['as'=>'user.login','uses'=>'DeashboardController@auth']);

//rotas com autenticação
Route::group(['middleware'=>['auth']],function (){

    Route::get('/admin/usuario',['middleware'=>'admin','as'=>'user.admin','uses'=>'UsersController@admin']);
    Route::get('/admin/setor',['middleware'=>'admin','as'=>'sector.admin','uses'=>'SectorsController@admin']);
    Route::get('/admin/salas',['middleware'=>'admin','as'=>'room.admin','uses'=>'RoomsController@admin']);

});
//rota para logout
Route::get('logout', ['uses'=>'DeashboardController@logout']);
