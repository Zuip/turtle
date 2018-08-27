<?php

Route::get('/articles', 'Articles\\ArticlesController@get');
Route::get('/cities', 'Cities\\CitiesController@get');
Route::get('/countries', 'Cities\\CountriesController@get');
Route::get('/countries/{countryUrlName}', 'Cities\\CountryController@get');
Route::get('/countries/{countryUrlName}/articles', 'Cities\\CountryArticlesController@get');
Route::get('/countries/{countryUrlName}/cities', 'Cities\\CitiesController@get');
Route::get('/countries/{countryUrlName}/cities/{cityUrlName}', 'Cities\\CityController@get');
Route::get('/countries/{countryUrlName}/cities/{cityUrlName}/articles', 'Cities\\CityArticlesController@get');
Route::get('/countries/{countryUrlName}/cities/{cityUrlName}/translations', 'Cities\\CityTranslationsController@get');
Route::get('/countries/{countryUrlName}/translations', 'Cities\\CountryTranslationsController@get');
Route::get('/trips/{tripUrlName}', 'Trips\\TripController@get');
Route::get('/trips/{tripUrlName}/articles', 'Trips\\TripArticlesController@get');
Route::get('/trips/{tripUrlName}/translations', 'Trips\\TripTranslationsController@get');
Route::get('/trips/{tripUrlName}/{countryUrlName}/{cityUrlName}/{cityVisitIndex}/article', 'Articles\\ArticleController@get');
Route::get('/trips/{tripUrlName}/{countryUrlName}/{cityUrlName}/{cityVisitIndex}/article/previous', 'Articles\\ArticleController@getPrevious');
Route::get('/trips/{tripUrlName}/{countryUrlName}/{cityUrlName}/{cityVisitIndex}/article/next', 'Articles\\ArticleController@getNext');
Route::get('/trips/{tripUrlName}/{countryUrlName}/{cityUrlName}/{cityVisitIndex}/article/translations', 'Articles\\ArticleTranslationsController@get');
Route::get('/user', 'SessionController@getCurrentUser');
Route::get('/users', 'UsersController@get');
Route::get('/users/{userId}/articles', 'Articles\\UserArticlesController@get');
Route::get('/users/{userId}/trips', 'Trips\\TripsController@get');

Route::post('/login', 'SessionController@login');
Route::post('/logout', 'SessionController@logout');
