<?php

Route::get("/articles", "Articles\\ArticlesController@get");
Route::get("/countries/{countryUrlName}/articles", "Cities\\CountryArticlesController@get");
Route::get("/countries/{countryUrlName}/cities/{cityUrlName}/articles", "Cities\\CityArticlesController@get");
Route::get("/countries/{countryUrlName}/cities/{cityUrlName}/users", "Cities\\CityUsersController@get");
Route::get("/trips/{tripUrlName}", "Trips\\TripController@get");
Route::get("/trips/{tripUrlName}/articles", "Trips\\TripArticlesController@get");
Route::get("/trips/{tripUrlName}/translations", "Trips\\TripTranslationsController@get");
Route::get("/trips/{tripUrlName}/{countryUrlName}/{cityUrlName}/{cityVisitIndex}/article", "Articles\\ArticleController@get");
Route::get("/trips/{tripUrlName}/{countryUrlName}/{cityUrlName}/{cityVisitIndex}/article/previous", "Articles\\ArticleController@getPrevious");
Route::get("/trips/{tripUrlName}/{countryUrlName}/{cityUrlName}/{cityVisitIndex}/article/next", "Articles\\ArticleController@getNext");
Route::get("/trips/{tripUrlName}/{countryUrlName}/{cityUrlName}/{cityVisitIndex}/article/translations", "Articles\\ArticleTranslationsController@get");
Route::get("/users", "UsersController@get");
Route::get("/users/{userId}/articles", "Articles\\UserArticlesController@get");
Route::get("/users/{userId}/trips", "Trips\\TripsController@get");

Route::post("/error/log", "ErrorLogController@post");

Route::put("/user/language", "Users\\UserLanguageController@put");
