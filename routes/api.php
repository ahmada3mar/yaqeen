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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'LoginController@login');

Route::group(['middleware' => 'auth:sanctum'] , function(){


Route::post('/BackID', 'LoginController@BackID');
Route::post('/FrontID', 'LoginController@FrontID');
Route::post('/checkKroka', 'LoginController@checkKroka');

// CRUD
Route::post('/store-policy', 'PolicyController@store');
Route::get('/get-policy', 'PolicyController@getPolicy');

});

