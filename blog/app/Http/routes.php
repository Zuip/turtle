<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

// Redirect api interface routing to their own file
if (Request::is('api/*'))
{
  require __DIR__.'/Routes/Api/ApiRoutes.php';
}

// Redirect view routing to AngularJS
Route::get('/en', function()
{
  $page = new \App\Http\Controllers\ViewController('en');
  return $page->renderPage();
});

Route::get('/en/{all}', function($uri)
{
  $page = new \App\Http\Controllers\ViewController('en');
  return $page->renderPage();
})->where('all', '.*');

Route::get('{all}', function($uri)
{
  $page = new \App\Http\Controllers\ViewController();
  return $page->renderPage();
})->where('all', '.*');