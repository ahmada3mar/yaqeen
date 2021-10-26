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

Route::get('/login', 'Api\ApiLoginController@loginAPI');

Route::group(['middleware' => 'auth:sanctum'] , function(){


Route::post('/BackID', 'PolicyController@BackID');
Route::post('/FrontID', 'PolicyController@FrontID');
Route::post('/checkKroka', 'PolicyController@checkKroka');

// CRUD
Route::post('/store-policy', 'PolicyController@store');
Route::get('/get-policy', 'PolicyController@getPolicy');

});

