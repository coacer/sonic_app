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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/recruits/finish', 'RecruitsController@finish')->name('recruits.finish');
Route::group(['middleware' => ['web']], function () {
    Route::get('recruits/analysis', 'RecruitsController@analysis')->name('recruits.analysis');
    Route::post('recruits/confirm', 'RecruitsController@confirm')->name('recruits.confirm');
    Route::put('recruits/is_completed/{recruit}', 'RecruitsController@isCompleted')->name('recruits.is_completed');
    Route::resource('recruits', 'RecruitsController');
});
