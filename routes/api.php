<?php

Route::get('/articles', 'ArticlesController@get');
Route::get('/cities', 'Cities\\CitiesController@get');
Route::get('/countries/{countryUrlName}', 'Cities\\CountryController@get');
Route::get('/countries/{countryUrlName}/articles', 'Cities\\CountryArticlesController@get');
Route::get('/countries/{countryUrlName}/cities/{cityUrlName}', 'Cities\\CityController@get');
Route::get('/countries/{countryUrlName}/cities/{cityUrlName}/articles', 'Cities\\CityArticlesController@get');
Route::get('/trips/{tripUrlName}', 'Trips\\TripController@get');
Route::get('/trips/{tripUrlName}/articles', 'Trips\\TripArticlesController@get');
Route::get('/trips/{tripUrlName}/{countryUrlName}/{cityUrlName}/{cityVisitIndex}/article', 'ArticleController@get');
Route::get('/trips/{tripUrlName}/{countryUrlName}/{cityUrlName}/{cityVisitIndex}/article/previous', 'ArticleController@getPrevious');
Route::get('/trips/{tripUrlName}/{countryUrlName}/{cityUrlName}/{cityVisitIndex}/article/next', 'ArticleController@getNext');
Route::get('/user', 'SessionController@getCurrentUser');
Route::get('/users', 'UsersController@get');
Route::get('/users/{userId}/articles', 'UserArticlesController@get');
Route::get('/users/{userId}/trips', 'TripsController@get');

Route::post('/login', 'SessionController@login');
Route::post('/logout', 'SessionController@logout');
