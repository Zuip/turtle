<?php

Route::get("/en.turtle.travel.rss", "RSSController@getEN");
Route::get("/fi.turtle.travel.rss", "RSSController@getFI");
Route::get("/sitemap", "SitemapController@get");

Route::any('/{any}', "IndexController@get")->where('any', '.*');
