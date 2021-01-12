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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
  //  return $request->user();
//});

Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('register', 'App\Http\Controllers\AuthController@register'); 
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::get('/user/verify/{token}', 'App\Http\Controllers\AuthController@verifyUser');
  
  });

Route::get('items/user/{id}/page/{page}',  'App\Http\Controllers\ItemController@index');
Route::get('items/user/{id}/all',  'App\Http\Controllers\ItemController@countall');
Route::prefix('/item')->group( function(){
    Route::post('/store','App\Http\Controllers\ItemController@store');
    Route::put('/{id}', 'App\Http\Controllers\ItemController@update');
    Route::get('/{id}', 'App\Http\Controllers\ItemController@show');
    Route::delete('/{id}', 'App\Http\Controllers\ItemController@destroy');
});
