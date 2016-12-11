<?php

Route::group(['middleware' => 'checkLocale'], function()
{
  Route::get('/api/{language}/views/home', function($language)
  {
    $frontpageArticles = App\Http\Controllers\ArticleController::getFrontpageArticlesData($language);
    if(isset($frontpageArticles['error'])) {
      return $frontpageArticles;
    }
    
    return \Response::json(array(
      "texts" => array(
        "introduction" => \Lang::get('views.home.introduction', array(), $language),
        "continueReading" => \Lang::get('views.category.continueReading', array(), $language)
      ),
      "articles" => $frontpageArticles
    ));
  });
  
  Route::get('/api/{language}/views/about', function($language)
  {
    return \Response::json(array(
      "texts" => array(
        "topic" => \Lang::get('views.about.topic', array(), $language),
        "aboutWriter" => \Lang::get('views.about.aboutWriter', array(), $language),
        "placesVisited" => \Lang::get('views.about.placesVisited', array(), $language)
      )
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
  
  Route::get('/api/{language}/views/categories/{category}', function($language, $categoryURLName)
  {
    $categoryLanguageVersion = App\Http\Controllers\CategoryController::findCategoryLanguageWithURLName($categoryURLName, $language, false);
    
    if(is_array($categoryLanguageVersion) && isset($categoryLanguageVersion['error'])) {
      return \Response::json(array("error" => $categoryLanguageVersion['error']), 404);
    }
    
    $articles = App\Http\Controllers\ArticleController::getCategoryArticlesData(
      $categoryLanguageVersion->category->id,
      $language,
      false,
      array('id', 'topic', 'textsummary', 'timestamp', 'publishtime', 'urlname', 'offset', 'previous'),
      array('amount' => 10, 'offset' => 0),
      true
    );
      
    return \Response::json(array(
      "texts" => array(
        "continueReading" => \Lang::get('views.category.continueReading', array(), $language)
      ),
      "category" => $categoryLanguageVersion,
      "articles" => $articles
    ));
  });
  
  Route::get('/api/{language}/views/articles/{article}', function($language, $articleURLName)
  {
    $article = App\Http\Controllers\ArticleController::getArticleDataByURLName($articleURLName, $language, false);
    
    if(is_array($article) && isset($article['error'])) {
      return \Response::json(array("error" => $article['error']), 404);
    }
      
    return \Response::json(array(
      "texts" => array(
        "previousPage" => \Lang::get('views.article.previousPage', array(), $language),
        "nextPage" => \Lang::get('views.article.nextPage', array(), $language)
      ),
      "article"           => array(
        "topic"           => $article["topic"],
        "text"            => str_replace("[summary]", "", $article["text"]),
        "publishtime"     => $article["publishtime"],
        "path"            => $article["path"],
        "previousArticle" => $article["previousArticle"],
        "nextArticle"     => $article["nextArticle"]
      )
    ));
  });
  
  // Admin operations
  Route::group(['middleware' => 'adminPermission'], function()
  {
    require __DIR__ . '/AdminApiRoutes.php';
  });
});

require __DIR__ . '/SessionApiRoutes.php';
require __DIR__ . '/404ApiRoutes.php';