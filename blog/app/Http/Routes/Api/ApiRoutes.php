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
    $category = App\Http\Controllers\CategoryController::findCategoryLanguageWithURLName($categoryURLName, $language, false);
    
    if(is_array($category) && isset($category['error'])) {
      return \Response::json(array("error" => $category['error']), 404);
    }
    
    $articles = App\Http\Controllers\ArticleController::getCategoryArticlesData(
      $category->id,
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
      "category" => $category,
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
    Route::get('/api/{language}/views/admin', function($languageCode)
    {
      return \Response::json(array(
        "texts" => array(
          "topic" => \Lang::get('admin.menuTopic', array(), $languageCode),
          "text" => "",
          "categories" => \Lang::get('admin.categories.topic', array(), $languageCode),
          "published" => \Lang::get('admin.categories.published', array(), $languageCode),
          "notPublished" => \Lang::get('admin.categories.notPublished', array(), $languageCode),
          "add" => \Lang::get('views.common.form.add', array(), $languageCode),
          "addSubCategory" => \Lang::get('admin.categories.addSubCategory', array(), $languageCode)
        ),
        "categories" => App\Http\Controllers\CategoryController::getCategories($languageCode, true)
      ));
    });
    
    Route::get('/api/{language}/views/admin/categoryeditor', function($languageCode)
    {
      return \Response::json(array(
        "texts" => array(
          "addTopic" => \Lang::get('admin.categories.add.topic', array(), $languageCode),
          "editTopic" => \Lang::get('admin.categories.edit.topic', array(), $languageCode),
          "cancel" => \Lang::get('views.common.form.cancel', array(), $languageCode),
          "save" => \Lang::get('views.common.form.save', array(), $languageCode),
          "categoryName" => \Lang::get('admin.categories.categoryName', array(), $languageCode),
          "categoryURLName" => \Lang::get('admin.categories.categoryURLName', array(), $languageCode),
          "categoryDescription" => \Lang::get('admin.categories.categoryDescription', array(), $languageCode),
        ),
      ));
    });
    
    Route::get('/api/{language}/views/admin/categories/{category}/articles/new', function($languageCode, $categoryId)
    { 
      $categoryName = App\Http\Controllers\CategoryController::getCategoryNameByIdAndLanguage($categoryId, $languageCode);
      
      if(is_array($categoryName) && isset($categoryName['error'])) {
        return \Response::json(array("error" => $categoryName['error']), 404);
      }
      
      return \Response::json(array(
        "texts" => array(
          "topic" => \Lang::get('admin.article.topicNew', array(), $languageCode),
          "path" => \Lang::get('views.common.path', array(), $languageCode),
          "articleTopic" => \Lang::get('admin.article.articleTopic', array(), $languageCode),
          "URLName" => \Lang::get('admin.article.URLName', array(), $languageCode),
          "text" => \Lang::get('admin.article.text', array(), $languageCode),
          "published" => \Lang::get('admin.article.published', array(), $languageCode),
          "notPublished" => \Lang::get('admin.article.notPublished', array(), $languageCode),
          "publishTime" => \Lang::get('admin.article.publishTime', array(), $languageCode),
          "save" => \Lang::get('views.common.form.save', array(), $languageCode),
          "savingSucceeded" => \Lang::get('admin.article.savingSucceeded', array(), $languageCode),
          "savingFailed" => \Lang::get('admin.article.savingFailed', array(), $languageCode),
          "returnToCategory" => \Lang::get('admin.article.returnToCategory', array(), $languageCode),
          "continueEditing" => \Lang::get('admin.article.continueEditing', array(), $languageCode),
          "errorMessage" => \Lang::get('admin.article.errorMessage', array(), $languageCode),
        ),
        "categoryName" => $categoryName
      ));
    });
    
    Route::post('/api/{language}/categories/{category}/articles/new', function($languageCode, $categoryId)
    {
      $result = App\Http\Controllers\ArticleController::createArticle(
        $categoryId,
        $languageCode,
        \Input::get('topic'),
        \Input::get('text'),
        \Input::get('URLName'),
        \Input::get('published'),
        \Input::get('publishtime')
      );

      if(isset($result['error'])) {
        return \Response::json(array("error" => $result['error']), 404);
      }
      
      return \Response::json(array("articleId" => $result['articleId']));
    });
    
    Route::put('/api/{language}/articles/{article}', function($languageCode, $articleId)
    {
      $result = App\Http\Controllers\ArticleController::editArticle(
        $articleId,
        $languageCode,
        \Input::get('topic'),
        \Input::get('text'),
        \Input::get('URLName'),
        \Input::get('published'),
        \Input::get('publishtime')
      );

      if(isset($result['error'])) {
        return \Response::json(array("error" => $result['error']), 404);
      }
      
      return \Response::json(array("success" => true));
    });
    
    Route::get('/api/{language}/views/admin/articles/{article}', function($languageCode, $articleId)
    {
      $article = App\Http\Controllers\ArticleController::getArticleData($articleId, $languageCode);
      if(isset($article['error'])) {
        return \Response::json(array("error" => $article['error']), 404);
      }
      
      return \Response::json(array(
        "texts" => array(
          "topic" => \Lang::get('admin.article.topicEdit', array(), $languageCode),
          "path" => \Lang::get('views.common.path', array(), $languageCode),
          "articleTopic" => \Lang::get('admin.article.articleTopic', array(), $languageCode),
          "URLName" => \Lang::get('admin.article.URLName', array(), $languageCode),
          "text" => \Lang::get('admin.article.text', array(), $languageCode),
          "published" => \Lang::get('admin.article.published', array(), $languageCode),
          "notPublished" => \Lang::get('admin.article.notPublished', array(), $languageCode),
          "publishTime" => \Lang::get('admin.article.publishTime', array(), $languageCode),
          "save" => \Lang::get('views.common.form.save', array(), $languageCode),
          "savingSucceeded" => \Lang::get('admin.article.savingSucceeded', array(), $languageCode),
          "savingFailed" => \Lang::get('admin.article.savingFailed', array(), $languageCode),
          "returnToCategory" => \Lang::get('admin.article.returnToCategory', array(), $languageCode),
          "continueEditing" => \Lang::get('admin.article.continueEditing', array(), $languageCode),
          "errorMessage" => \Lang::get('admin.article.errorMessage', array(), $languageCode),
        ),
        "article" => $article
      ));
    });
    
    Route::get('/api/{language}/views/admin/categories/{category}', function($languageCode, $categoryId)
    {
      $categoryName = App\Http\Controllers\CategoryController::getCategoryNameByIdAndLanguage($categoryId, $languageCode);
      if(is_array($categoryName) && isset($categoryName['error'])) {
        return \Response::json(array("error" => $categoryName['error']), 404);
      }
      
      $articles = App\Http\Controllers\ArticleController::getCategoryArticlesData($categoryId, $languageCode, true, ['id', 'topic', 'published', 'timestamp']);
      if(is_array($articles) && isset($articles['error'])) {
        return \Response::json(array("error" => $articles['error']), 404);
      }
      
      return \Response::json(array(
        "texts" => array(
          "topic" => \Lang::get('admin.category.topic', array(), $languageCode),
          "categoryName" => $categoryName,
          "path" => \Lang::get('views.common.path', array(), $languageCode),
          "article" => \Lang::get('admin.category.article', array(), $languageCode),
          "published" => \Lang::get('admin.category.published', array(), $languageCode),
          "add" => \Lang::get('views.common.form.add', array(), $languageCode)
        ),
        "articles" => $articles
      ));
    });

    Route::post('/api/{language}/categories', function($languageCode) {
      $categoryApiController = new App\Http\Controllers\Api\CategoryApiController();
      return $categoryApiController->postCategory();
    });
    
    Route::put('/api/{language}/categories/{category}/publish', function($languageCode, $categoryId) {
      $categoryApiController = new App\Http\Controllers\Api\CategoryApiController();
      return $categoryApiController->publishCategory($categoryId, $languageCode);
    });

    Route::put('/api/{language}/categories/{categoryId}/unpublish', function($languageCode, $categoryId) {
      $categoryApiController = new App\Http\Controllers\Api\CategoryApiController();
      return $categoryApiController->unpublishCategory($categoryId, $languageCode);
    });
  });
});

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