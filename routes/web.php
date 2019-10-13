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



// Rotas para Login
  //Route::get('/',['as'=>'login','uses'=>'Controller@fazerLogin']);
  Route::get('/login',['as'=>'login','uses'=>'Controller@fazerLogin']);
  Route::post('/login',['as'=>'user.login','uses'=>'DeashboardController@auth']);



Route::group(['middleware'=>['auth']],function (){
    //rotas usuario
      Route::get('/usuario/agendamento',['as'=>'user.agendamento','uses'=>'UsersController@index_usuario']);
      Route::post('/usuario/agendamento',['as'=>'user.agendamento','uses'=>'SchedulingsController@add']);

      //update passord
      Route::get('/usuario/password',['as'=>'user.password','uses'=>'UsersController@passowrd_usuario']);
      Route::post('/usuario/password',['as'=>'password.update','uses'=>'UsersController@passowrd_update']);


    //rotas adm
    Route::get('/admin/usuario',['middleware'=>'admin','as'=>'user.admin','uses'=>'UsersController@index']);
    Route::post('/admin/usuario',['as'=>'user.add','uses'=>'UsersController@add']);
    Route::post('/admin/usuario/destroy',['as'=>'user.delete','uses'=>'UsersController@deleta']);

    Route::get('/admin/setor',['middleware'=>'admin','as'=>'sector.admin','uses'=>'SectorsController@index']);
    Route::post('/admin/setor',['as'=>'sector.add','uses'=>'SectorsController@add']);

    Route::get('/admin/salas',['middleware'=>'admin','as'=>'room.admin','uses'=>'RoomsController@index']);
    Route::post('/admin/salas',['as'=>'room.add','uses'=>'RoomsController@add']);

});
//rota para logout
Route::get('logout', ['uses'=>'DeashboardController@logout']);
