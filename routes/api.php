<?php

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

Route::get('/articles', 'GetArticlesController@get');
Route::get('/articles/{urlName}', 'ArticleController@get');
Route::get('/user', 'SessionController@getCurrentUser');
Route::post('/login', 'SessionController@login');
Route::post('/logout', 'SessionController@logout');
