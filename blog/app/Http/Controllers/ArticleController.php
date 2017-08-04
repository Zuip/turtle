<?php namespace App\Http\Controllers;

use App\Services\Articles\ArticleCreator;
use App\Services\Articles\ArticleEditor;
use App\Services\Articles\ArticleFetcher;
use App\Services\Categories\CategoryFetcher;
use App\Services\Languages\LanguageFetcher;

class ArticleController extends Controller {

  public function createArticle($categoryId, $languageCode) {
    
    // Find category model
    $categoryFetcher = new CategoryFetcher();
    $category = $categoryFetcher->getWithId($categoryId);
    
    // Find language model
    $languageFetcher = new LanguageFetcher();
    $language = $languageFetcher->getWithCode($languageCode);
    
    // Create article with post data
    $articleCreator = new ArticleCreator();
    $articleCreator->setCategory($category);
    $articleCreator->setLanguage($language);
    $articleCreator->setTopic(\Input::get('topic'));
    $articleCreator->setText(\Input::get('text'));
    $articleCreator->setURLName(\Input::get('URLName'));
    $articleCreator->setPublished(\Input::get('published'));
    $articleCreator->setPublishTime(\Input::get('publishtime'));
    
    $articleCreator->createArticle();

    return \Response::json(
      array(
        "articleId" => $articleCreator->getCreatedArticle()->id
      )
    );
  }
  
  public function editArticle($articleId, $languageCode) {
    
    // Find article model
    $articleFetcher = new ArticleFetcher();
    $article = $articleFetcher->getWithId($articleId);
    
    // Find language model
    $languageFetcher = new LanguageFetcher();
    $language = $languageFetcher->getWithCode($languageCode);
    
    // Edit article with post data
    $articleEditor = new ArticleEditor();
    $articleEditor->setArticle($article);
    $articleEditor->setLanguage($language);
    $articleEditor->setTopic(\Input::get('topic'));
    $articleEditor->setText(\Input::get('text'));
    $articleEditor->setURLName(\Input::get('URLName'));
    $articleEditor->setPublished(\Input::get('published'));
    $articleEditor->setPublishTime(\Input::get('publishtime'));
    
    $articleEditor->editArticle();
    
    return \Response::json(
      array(
        "success" => true
      )
    );
  }
}