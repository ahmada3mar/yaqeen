<?php

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

Route::get('/portal', 'LoginController@portal')->name('portal');
// Route::get('/{id}', 'LoginController@index')->name('login');

# policy
Route::get('/policy', 'PolicyController@index')->name('policy');
Route::get('/pending-policy', 'PolicyController@pending')->name('pending-policy');
Route::get('/create-policy', 'PolicyController@create')->name('create-policy');
## branches
Route::get('/branches', 'BranchController@index')->name('branches');
Route::get('/branches/create', 'BranchController@create')->name('create-branches');
Route::get('/branches/store', 'BranchController@store')->name('store-branches');
Route::get('/branches/{branch}', 'BranchController@edit')->name('edit-branches');
