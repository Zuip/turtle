<?php

Route::get('/api/visitedplaces', function() {
  $visitedPlaceApiController = new App\Http\Controllers\Api\VisitedPlaceApiController();
  return $visitedPlaceApiController->getVisitedPlaces();
});

Route::group(['middleware' => 'checkLocale'], function()
{
  Route::get('/api/{language}/translations', function($language) {
    if(\Auth::check() && \Auth::user()->permissionlevel == "admin") {
      $languageData = \Lang::get('views', array(), $language);
      $languageData['admin'] = \Lang::get('admin', array(), $language);
      return \Response::json($languageData);
    } else {
      return \Response::json(\Lang::get('views', array(), $language));
    }
  });
  
  Route::get('/api/{language}/views/home', function($language)
  {
    try {
      $frontpageArticles = App\Http\Controllers\ArticleController::getFrontpageArticlesData($language);
    } catch(App\Exceptions\ModelNotFoundException $e) {
      return \Response::json(array("error" => $e->getMessage()), 404);
    }
    
    return \Response::json(array(
      "texts" => array(
        "introduction" => \Lang::get('views.home.introduction', array(), $language),
        "continueReading" => \Lang::get('views.category.continueReading', array(), $language)
      ),
      "articles" => $frontpageArticles
    ));
  });
  
  Route::get('/api/{language}/views/login', function($language)
  {
    return \Response::json(array(
      "texts" => array(
        "topic" => \Lang::get('views.login.topic', array(), $language),
        "username" => \Lang::get('views.login.username', array(), $language),
        "password" => \Lang::get('views.login.password', array(), $language),
        "loginButton" => \Lang::get('views.login.topic', array(), $language),
        "alreadySignedIn" => \Lang::get('views.login.alreadySignedIn', array(), $language),
      ),
      "csrf" => csrf_token()
    ));
  });
  
  Route::get('/api/{language}/views/category', function($language)
  {
    return \Response::json(array(
      "texts" => array(
        "path" => \Lang::get('views.common.path', array(), $language)
      )
    ));
  });
  
  Route::get('/api/{language}/views/404', function($language)
  {
    return \Response::json(array(
      "texts" => array(
        "topic" => \Lang::get('views.404.topic', array(), $language),
        "text" => \Lang::get('views.404.text', array(), $language)
      )
    ));
  });
  
  Route::get('/api/{language}/views/categories/{category}/page/{page}', function($language, $categoryURLName, $page) {
    $categoryViewApiController = new App\Http\Controllers\Api\CategoryViewApiController();
    return $categoryViewApiController->get($categoryURLName, $language, intval($page));
  });
  
  Route::get('/api/{language}/views/articles/{article}', function($languageCode, $articleURLName)
  {
    try {
      
      $articleLanguageVersionFetcher = new \App\Services\Articles\ArticleLanguageVersionFetcher();
      $articleLanguageVersionFetcher->allowUnpublished(false);
      $articleLanguageVersion = $articleLanguageVersionFetcher->getWithURLName($articleURLName);
      
      $articleDataFetcher = new App\Services\Articles\ArticleDataFetcher();
      $articleData = $articleDataFetcher->getArticleData($articleLanguageVersion);
      
    } catch(App\Exceptions\ModelNotFoundException $e) {
      return \Response::json(array("error" => $e->getMessage()), 404);
    }
      
    return \Response::json(array(
      "texts" => array(
        "previousPage" => \Lang::get('views.article.previousPage', array(), $languageCode),
        "nextPage" => \Lang::get('views.article.nextPage', array(), $languageCode)
      ),
      "article"           => array(
        "topic"           => $articleData["topic"],
        "text"            => str_replace("[summary]", "", $articleData["text"]),
        "publishtime"     => $articleData["publishtime"],
        "path"            => $articleData["path"],
        "previousArticle" => $articleData["previousArticle"],
        "nextArticle"     => $articleData["nextArticle"]
      )
    ));
  });
});

// Admin operations
Route::group(['middleware' => 'adminPermission'], function() {
  require __DIR__ . '/AdminApiRoutes.php';
});

require __DIR__ . '/SessionApiRoutes.php';
require __DIR__ . '/404ApiRoutes.php';