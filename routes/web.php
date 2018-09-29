<?php

Route::get("/sitemap", "SitemapController@get");

Route::any('/{any}', function () {
    return view('layout/body');
})->where('any', '.*');
