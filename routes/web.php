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

Route::get('/', "PagesController@index");

Auth::routes();

Route::get('/upload', "PostsController@upload");
Route::post('/image', 'PostsController@store');
Route::get('/image/{post}', 'PostsController@show');
Route::get('/image/{post}/edit', 'PostsController@edit')->name('image.edit');
Route::patch('/image/{post}', 'PostsController@update')->name('image.update');
Route::delete('/image/{post}', 'PostsController@destroy')->name('image.destroy');

Route::get('/user/{user}', 'ProfilesController@index')->name('user.user');
Route::get('/user/{user}/edit-profile', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/user/{user}', 'ProfilesController@update')->name('user.update');
Route::delete('/user/{user}', 'ProfilesController@destroy')->name('user.destroy');

Route::get('/about', 'PagesController@about');
Route::get('/aboutlevi', 'PagesController@aboutlevi');

Route::get('/search', 'SearchController@index')->name('search');