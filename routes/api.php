<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//clientes
Route::get('/clients', 'App\Http\Controllers\ClientController@index');
Route::get('/clients/{client}', 'App\Http\Controllers\ClientController@show');
Route::post('/clients', 'App\Http\Controllers\ClientController@store');
Route::put('/clients/{client}', 'App\Http\Controllers\ClientController@update');
Route::delete('/clients/{client}', 'App\Http\Controllers\ClientController@destroy');
Route::post('/clients/service', 'App\Http\Controllers\ClientController@attach');
Route::post('/clients/service/detach', 'App\Http\Controllers\ClientController@detach');

//servicios
Route::get('/services', 'App\Http\Controllers\ServiceController@index');
Route::get('/services/{service}', 'App\Http\Controllers\ServiceController@show');
Route::post('/services', 'App\Http\Controllers\ServiceController@store');
Route::put('/services/{service}', 'App\Http\Controllers\ServiceController@update');
Route::delete('/services/{service}', 'App\Http\Controllers\ServiceController@destroy');
Route::post('/services/clients', 'App\Http\Controllers\ServiceController@client');


//usuarios
Route::post('/users/register', 'App\Http\Controllers\UserController@store'); //endpoint para el registro de usuarios
Route::get('/users/login', 'App\Http\Controllers\UserController@login'); //endpoint para el login de usuarios