<?php

Route::get("/sitemap", "SitemapController@get");

Route::any('/{any}', "IndexController@get")->where('any', '.*');
