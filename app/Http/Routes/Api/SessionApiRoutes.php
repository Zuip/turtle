<?php

Route::post('/api/login', function()
{
  if(!\Input::has('username') || !\Input::has('password')) {
    return \Response::json(array('error' => \Lang::get('views.common.forms.missingFields', array(), \Session::get('language'))), 404);
  }

  if(\Auth::attempt(['name' => \Input::get('username'), 'password' => \Input::get('password')])) {
    return \Response::json(array('success' => \Lang::get('views.login.signingSucceeded', array(), \Session::get('language')),
                                 'username' => \Input::get('username'),
                                 'permissionLevel' => \Auth::user()->permissionlevel));
  }

  return \Response::json(array('error' => \Lang::get('views.login.incorrectPassword', array(), \Session::get('language'))), 404);
});

Route::post('/api/logout', function()
{
  if(!\Auth::check()) {
    return \Response::json(array('error' => \Lang::get('views.logout.notSignedIn', array(), \Session::get('language'))), 404);
  }
  
  Auth::logout();
  
  return \Response::json(array('success' => \Lang::get('views.logout.signingOutSucceeded', array(), \Session::get('language'))));
});