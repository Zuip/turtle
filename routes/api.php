<?php

Route::get('/articles', 'ArticlesController@get');
Route::get('/articles/{urlName}', 'ArticleController@get');
Route::get('/cities', 'CitiesController@get');
Route::get('/user', 'SessionController@getCurrentUser');
Route::get('/users', 'UsersController@get');
Route::post('/login', 'SessionController@login');
Route::post('/logout', 'SessionController@logout');
