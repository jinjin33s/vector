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

// List All People 
Route::get('persons', 'PersonController@index');

// Show single Person
Route::get('person/{id}', 'PersonController@show');

// Create new Person
Route::post('person', 'PersonController@store');

// Update Person
Route::put('person', 'PersonController@store');

// Delete Person
Route::delete('person/{id}', 'PersonController@destroy');