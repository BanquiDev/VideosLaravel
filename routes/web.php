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

Route::get('/', 'HomeController@index')->name('home');

// Videos

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

Route::get('/miniatura/{filename}', array(
  'as' => 'imageVideo',
  'uses' => 'VideoController@getImage'
));

Route::get('/video/{video_id}', array(
    'as' => 'detailVideo',
    'uses' => 'VideoController@getVideoDetail'
));

Route::get('video-file/{filename}', array(
  'as' => 'fileVideo',
  'uses' => 'VideoController@getVideo'
));

Route::get('/delete-video/{video_id}', array(
  'as' => 'videoDelete',
  'middleware' => 'auth',
  'uses' => 'VideoController@delete'
));

Route::get('/editar-video/{video_id}', array(
  'as' => 'videoEdit',
  'middleware' => 'auth',
  'uses' => 'VideoController@edit'
));

Route::post('/update-video/{video_id}', array(
  'as' => 'updateVideo',
  'middleware' => 'auth',
  'uses' => 'VideoController@update'
));

Route::get('/buscar/{search?}/{filter?}', [
  'as' => 'videoSearch',
  'uses' => 'VideoController@search',
]);

// Comentarios

Route::post('/comment', array(
  'as' => 'comment',
  'middleware' => 'auth',
  'uses' => 'CommentController@store',
));

Route::get('/delete-comment/{comment_id}', array(
  'as' => 'commentDelete',
  'middleware' => 'auth',
  'uses' => 'CommentController@delete',
));

// Usuarios

Route::get('/canal/{user_id}', array(
  'as' => 'channel',
  'uses' => 'UserController@channel'
));

 //Cache

 Route::get('/clear-cache', function(){
   $code = Artisan::call('cache:clear');
 });
