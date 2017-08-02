<?php

Route::group(['middleware' => 'checkLocale'], function() {

  Route::get('/api/{language}/views/admin', function($languageCode)
  {
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
    $languageFetcher = new \App\Services\Languages\LanguageFetcher();
    $language = $languageFetcher->getWithCode($languageCode);

    $categoryFetcher = new \App\Services\Categories\CategoryFetcher();
    $category = $categoryFetcher->getWithId($categoryId);

    $categoryLanguageVersionFetcher = new \App\Services\Categories\CategoryLanguageVersionFetcher();
    $categoryLanguageVersion = $categoryLanguageVersionFetcher->getWithCategoryAndLanguageId($category, $language->id);
    $categoryName = $categoryLanguageVersion->name;

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
    $articleController = new \App\Http\Controllers\ArticleController();
    $result = $articleController->createArticle(
      $categoryId,
      $languageCode,
      \Input::get('topic'),
      \Input::get('text'),
      \Input::get('URLName'),
      \Input::get('published'),
      \Input::get('publishtime')
    );

    return \Response::json(array("articleId" => $result['articleId']));
  });

  Route::put('/api/{language}/articles/{article}', function($languageCode, $articleId)
  {
    $articleController = new \App\Http\Controllers\ArticleController();
    $articleController->editArticle(
      $articleId,
      $languageCode,
      \Input::get('topic'),
      \Input::get('text'),
      \Input::get('URLName'),
      \Input::get('published'),
      \Input::get('publishtime')
    );

    return \Response::json(array("success" => true));
  });

  Route::get('/api/{language}/views/admin/articles/{article}', function($languageCode, $articleId)
  {

    $languageFetcher = new \App\Services\Languages\LanguageFetcher();
    $language = $languageFetcher->getWithCode($languageCode);

    $articleFetcher = new \App\Services\Articles\ArticleFetcher();
    $article = $articleFetcher->getWithId($articleId);

    $articleLanguageVersionFetcher = new \App\Services\Articles\ArticleLanguageVersionFetcher();
    $articleLanguageVersionFetcher->allowUnpublished(true);
    $articleLanguageVersionFetcher->getWithArticleAndLanguageId($article, $language->id);

    $articleDataFetcher = new App\Services\Articles\ArticleDataFetcher();
    $articleDataFetcher->limitToAttributes(
      array(
        "id", "topic", "URLName", "text", "published", "path",
        "publishtime", "previousArticle", "nextArticle"
      )
    );
    $articleData = $articleDataFetcher->getArticleData($articleLanguageVersionFetcher);

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
    
    $languageFetcher = new \App\Services\Languages\LanguageFetcher();
    $language = $languageFetcher->getWithCode($languageCode);

    $categoryFetcher = new \App\Services\Categories\CategoryFetcher();
    $category = $categoryFetcher->getWithId($categoryId);

    $categoryLanguageVersionFetcher = new \App\Services\Categories\CategoryLanguageVersionFetcher();
    $categoryLanguageVersion = $categoryLanguageVersionFetcher->getWithCategoryAndLanguageId($category, $language->id);
    $categoryName = $categoryLanguageVersion->name;

    $articleLanguageVersionFetcher = new \App\Services\Articles\ArticleLanguageVersionFetcher();
    $articleLanguageVersionFetcher->allowUnpublished(true);
    
    $categoryArticlesFetcher = new \App\Services\Articles\CategoryArticlesFetcher();
    $categoryArticlesFetcher->setOrderByTimestamp(true);

    $categoryArticlesDataFetcher = new \App\Services\Articles\CategoryArticlesDataFetcher();
    $categoryArticlesDataFetcher->setArticleLanguageVersionFetcher($articleLanguageVersionFetcher);
    $categoryArticlesDataFetcher->setArticleDataFetcher(new App\Services\Articles\ArticleDataFetcher());
    $categoryArticlesDataFetcher->setCategoryArticlesFetcher($categoryArticlesFetcher);
    $articles = $categoryArticlesDataFetcher->getData(
      $category,
      $language->id,
      ['id', 'topic', 'published', 'timestamp']
    );

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
    $categoryPublishedHandler = new \App\Services\Categories\PublishedHandler();
    $categoryPublishedHandler->publishCategory($categoryId, $languageCode);
    return \Response::json(array("OK" => true));
  });

  Route::put('/api/{language}/categories/{categoryId}/unpublish', function($languageCode, $categoryId) {
    $categoryPublishedHandler = new \App\Services\Categories\PublishedHandler();
    $categoryPublishedHandler->unpublishCategory($categoryId, $languageCode);
  });
});