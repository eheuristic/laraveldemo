<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::model('user', 'User');
Route::get('/', 'HomeController@showWelcome');
Route::any('/sendmail', 'HomeController@sendmail1');
Route::any('/history', 'HomeController@mailhistory');
Route::controller('user', 'UserController');

