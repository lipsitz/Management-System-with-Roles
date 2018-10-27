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

Route::get('/','PagesController@index');
Route::get('/admin','PagesController@admin');
Route::resource('courses','CoursesController');
Route::resource('students','StudentsController');
Route::resource('users','UsersController');

Auth::routes();
Route::post('users', 'Auth\RegisterController@register_me')->name('register_me');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/register', 'PagesController@index');
