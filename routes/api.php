<?php

Route::get('/articles', 'GetArticlesController@get');
Route::get('/articles/{urlName}', 'ArticleController@get');
Route::get('/cities', 'CitiesController@get');
Route::get('/user', 'SessionController@getCurrentUser');
Route::post('/login', 'SessionController@login');
Route::post('/logout', 'SessionController@logout');
