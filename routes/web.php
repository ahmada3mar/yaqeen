<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/500', 'LoginController@throError')->name('portal');
// Route::get('/{id}', 'LoginController@index')->name('login');
Auth::routes();

Route::group(['middleware' => 'auth'] , function(){
Route::get('/', 'PortalController@index')->name('portal');
# policy
Route::get('/policy', 'PolicyController@index')->name('policy');
Route::get('/krooka', 'PolicyController@krooka')->name('krooka');
Route::post('/getkrooka', 'PolicyController@getkrooka')->name('getkrooka');
Route::get('/pending-policy', 'PolicyController@pending')->name('pending-policy');
Route::get('/policy/{policy}', 'PolicyController@edit')->name('edit-policy');
Route::get('/create-policy', 'PolicyController@create')->name('create-policy');
Route::post('/store-policy', 'PolicyController@store')->name('store-policy');
## branches
Route::get('/branches', 'BranchController@index')->name('branches');
Route::get('/branches/create', 'BranchController@create')->name('create-branches');
Route::get('/branches/store', 'BranchController@store')->name('store-branches');
Route::get('/branches/{branch}', 'BranchController@edit')->name('edit-branches');
Route::get('/privacy', 'BranchController@privacy');
Route::get('/logout', 'Api\ApiLoginController@logout')->name('logout');
});
