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
Route::get('/users/{user}', 'App\Http\Controllers\UserController@show'); //endpoint para obtener toda la info de un usuario
Route::put('/users/{user}', 'App\Http\Controllers\UserController@update'); //endpoint para actualizar toda la info de un usuario
Route::post('/users/uploadImg', 'App\Http\Controllers\UserController@upload'); //endpoint para actualizar toda la info de un usuario
Route::get('/users/test', 'App\Http\Controllers\UserController@test');

Route::post('/auth/register', 'App\Http\Controllers\AuthController@createUser');
//Route::post('/auth/login', [AuthController::class, 'loginUser']);

//categorias
Route::get('/categories', 'App\Http\Controllers\Categoriescontroller@index');
Route::get('/categories/{categories}', 'App\Http\Controllers\Categoriescontroller@show');

//POSTS
Route::post('/posts/new', 'App\Http\Controllers\PostsController@store');
Route::get('/posts', 'App\Http\Controllers\PostsController@index');
Route::get('/posts/{post}', 'App\Http\Controllers\PostsController@show');
Route::put('/posts/{post}', 'App\Http\Controllers\PostsController@update');

//SUBIR IMAGEN