<?php

/*
 * Not found, 404 answer
 */
Route::get('/api/{all}', function($uri){
  return \Response::json(array('error' => 'Resource does not exist'), 404);
})->where('all', '.*');

Route::post('/api/{all}', function($uri){
  return \Response::json(array('error' => 'Resource does not exist'), 404);
})->where('all', '.*');

Route::put('/api/{all}', function($uri){
  return \Response::json(array('error' => 'Resource does not exist'), 404);
})->where('all', '.*');

Route::delete('/api/{all}', function($uri){
  return \Response::json(array('error' => 'Resource does not exist'), 404);
})->where('all', '.*');