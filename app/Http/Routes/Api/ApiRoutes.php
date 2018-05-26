<?php

Route::get('/api/visitedplaces', function() {
  $visitedPlacesService = new App\Services\VisitedPlacesService();
  return \Response::json(array(
    "visitedPlaces" => $visitedPlacesService->getVisitedPlaces()
  ));
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
  
  Route::get('/api/frontpage/articles/{language}', function($language) {
    $frontpageArticlesDataFetcher = new App\Services\Articles\FrontpageArticlesDataFetcher();
    $frontpageArticles = $frontpageArticlesDataFetcher->getData($language);
    return \Response::json(array("articles" => $frontpageArticles));
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
  
  Route::get('/api/categories/{category}/pages/{page}/{language}', function($categoryURLName, $page, $languageCode) {
    $languageFetcher = new \App\Services\Languages\LanguageFetcher();
    $language = $languageFetcher->getWithCode($languageCode);
    $categoryDataFetcher = new App\Services\Categories\CategoryDataFetcher();
    return \Response::json(
      $categoryDataFetcher->getData($categoryURLName, $language->id, intval($page))
    );
  });
  
  Route::get('/api/articles/{article}/{language}', function($articleURLName, $languageCode) {
 
    $articleLanguageVersionFetcher = new \App\Services\Articles\ArticleLanguageVersionFetcher();
    $articleLanguageVersionFetcher->allowUnpublished(false);
    $articleLanguageVersion = $articleLanguageVersionFetcher->getWithURLName($articleURLName);

    $articleDataFetcher = new App\Services\Articles\ArticleDataFetcher();
    $articleDataFetcher->limitToAttributes(
      array(
        "topic", "text", "path", "publishTime", "previousArticle", "nextArticle"
      )
    );
    $articleData = $articleDataFetcher->getArticleData($articleLanguageVersion);
      
    return \Response::json(array(
      "topic"           => $articleData["topic"],
      "text"            => str_replace("[summary]", "", $articleData["text"]),
      "publishTime"     => $articleData["publishTime"],
      "path"            => $articleData["path"],
      "previousArticle" => $articleData["previousArticle"],
      "nextArticle"     => $articleData["nextArticle"]
    ));
  });
});

// Admin operations
Route::group(['middleware' => 'adminPermission'], function() {
  require __DIR__ . '/AdminApiRoutes.php';
});

require __DIR__ . '/SessionApiRoutes.php';
require __DIR__ . '/404ApiRoutes.php';