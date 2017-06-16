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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Rotas que somente administradores tem acesso
Route::middleware(['can:admin'])->group(function () {
    Route::resource('car','CarController');
    Route::get('report','CarController@report');
    Route::get('/modelos', 'ModelCarController@listModels');
    Route::resource('/model/car','ModelCarController');

});
