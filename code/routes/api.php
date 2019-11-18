<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;

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

Route::get('users', 'UsersController@getAllUsers');
Route::get('users/{id}', 'UsersController@getUser');
Route::post('users', 'UsersController@createuser');
Route::put('users/{id}', 'UsersController@updateUser');
Route::delete('users/{id}','UsersController@deleteUser');
