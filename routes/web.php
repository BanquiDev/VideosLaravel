<?php

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

Route::get('/createVideo', 'VideoController@createvideo', array(
  'as' => 'createVideo',
  'middleware' => 'auth',
  'uses' => 'VideoController@createvideo'
));
Route::post('/guardar-video', 'VideoController@saveVideo', array(
  'as' => 'saveVideo',
  'middleware' => 'auth',
  'uses' => 'VideoController@saveVideo'
));
