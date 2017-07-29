<?php

Route::group(['middleware' => 'checkLocale'], function() {

  Route::get('/api/{language}/views/admin', function($languageCode)
  {
    try {
      
      $categoryHierarchyArrayCreator = new \App\Services\Categories\CategoryHierarchyArrayCreator(
        $languageCode,
        true
      );
    
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
        "categories" => $categoryHierarchyArrayCreator->getCategories()
      ));
      
    } catch(App\Exceptions\ModelNotFoundException $e) {
      return \Response::json(array("error" => $e->getMessage()), 404);
    }
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
    try {
      $categoryName = App\Http\Controllers\CategoryController::getCategoryNameByIdAndLanguage($categoryId, $languageCode);
    } catch(App\Exceptions\ModelNotFoundException $e) {
      return \Response::json(array("error" => $e->getMessage()), 404);
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
    try {
      $result = App\Http\Controllers\ArticleController::createArticle(
        $categoryId,
        $languageCode,
        \Input::get('topic'),
        \Input::get('text'),
        \Input::get('URLName'),
        \Input::get('published'),
        \Input::get('publishtime')
      );
    } catch(App\Exceptions\ModelNotFoundException $e) {
      return \Response::json(array("error" => $e->getMessage()), 404);
    }

    return \Response::json(array("articleId" => $result['articleId']));
  });

  Route::put('/api/{language}/articles/{article}', function($languageCode, $articleId)
  {
    try {
      App\Http\Controllers\ArticleController::editArticle(
        $articleId,
        $languageCode,
        \Input::get('topic'),
        \Input::get('text'),
        \Input::get('URLName'),
        \Input::get('published'),
        \Input::get('publishtime')
      );
    } catch(App\Exceptions\ModelNotFoundException $e) {
      return \Response::json(array("error" => $e->getMessage()), 404);
    }

    return \Response::json(array("success" => true));
  });

  Route::get('/api/{language}/views/admin/articles/{article}', function($languageCode, $articleId)
  {
    try {

      $languageId = \App\Http\Controllers\LanguageController::getLocaleIdByCode($languageCode);

      $articleFetcher = new \App\Services\Articles\ArticleFetcher();
      $article = $articleFetcher->getWithId($articleId);
      
      $articleLanguageVersionFetcher = new \App\Services\Articles\ArticleLanguageVersionFetcher();
      $articleLanguageVersionFetcher->allowUnpublished(true);
      $articleLanguageVersionFetcher->getWithArticleAndLanguageId($article, $languageId);
      
      $articleDataFetcher = new App\Services\Articles\ArticleDataFetcher();
      $articleData = $articleDataFetcher->getArticleData($articleLanguageVersionFetcher);
      
    } catch(App\Exceptions\ModelNotFoundException $e) {
      return \Response::json(array("error" => $e->getMessage()), 404);
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
      "article" => $articleData
    ));
  });

  Route::get('/api/{language}/views/admin/categories/{category}', function($languageCode, $categoryId)
  {
    
    try {
      $categoryName = App\Http\Controllers\CategoryController::getCategoryNameByIdAndLanguage(
        $categoryId,
        $languageCode
      );
      $articles = App\Http\Controllers\ArticleController::getCategoryArticlesData(
        $categoryId,
        $languageCode,
        true,
        ['id', 'topic', 'published', 'timestamp']
      );
    } catch(App\Exceptions\ModelNotFoundException $e) {
      return \Response::json(array("error" => $e->getMessage()), 404);
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
    $categoryController = new \App\Http\Controllers\CategoryController();
    return $categoryController->categoryPOST();
  });

  Route::put('/api/{language}/categories/{category}/publish', function($languageCode, $categoryId) {
    try {
      $categoryPublishedHandler = new \App\Services\Categories\PublishedHandler();
      $categoryPublishedHandler->publishCategory($categoryId, $languageCode);
      return \Response::json(array("OK" => true));
    } catch(App\Exceptions\ModelNotFoundException $e) {
      return \Response::json(array("error" => $e->getMessage()), 404);
    }
  });

  Route::put('/api/{language}/categories/{categoryId}/unpublish', function($languageCode, $categoryId) {
    try {
      $categoryPublishedHandler = new \App\Services\Categories\PublishedHandler();
      $categoryPublishedHandler->unpublishCategory($categoryId, $languageCode);
    } catch(App\Exceptions\ModelNotFoundException $e) {
      return \Response::json(array("error" => $e->getMessage()), 404);
    }
  });
});