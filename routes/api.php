<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// rotte pubbliche
Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

// rotte protette
Route::middleware('auth:sanctum')->group(function () {

    Route::get('todolists', 'TodolistController@index');
    Route::post('todolists', 'TodolistController@store');
    Route::delete('todolists/{todolist}', 'TodolistController@destroy');

    Route::get('{todolist}/todos', 'TodoController@index');
    Route::post('{todolist}/todos', 'TodoController@store');
    Route::delete('todos/{todo}', 'TodoController@destroy');

    Route::get('user', 'UserController@index');
    Route::post('logout', 'AuthController@logout');

});

