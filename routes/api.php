<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('salas','SalasController@getSalas');
Route::get('salas/{numero}','SalasController@getSala');
Route::post('salas','SalasController@addSala');
Route::put('salas','SalasController@updateSala');
Route::delete('salas/{numero}','SalasController@deleteSala');
