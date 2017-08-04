<?php namespace App\Http\Controllers;

use App\Services\Articles\ArticleCreator;
use App\Services\Categories\CategoryFetcher;
use App\Services\Languages\LanguageFetcher;

class ArticleController extends Controller {

  public function createArticle($categoryId, $languageCode) {
    
    $categoryFetcher = new CategoryFetcher();
    $category = $categoryFetcher->getWithId($categoryId);
    
    $languageFetcher = new LanguageFetcher();
    $language = $languageFetcher->getWithCode($languageCode);
    
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
        "articleId" => $articleCreator->getCreatedArticleId()
      )
    );
  }
  
  public function editArticle($articleId, $languageCode, $topic, $text, $URLName, $published, $publishtime) {
    
    // Find article
    $articleFetcher = new \App\Services\Articles\ArticleFetcher();
    $article = $articleFetcher->getWithId($articleId);
    
    $date = \DateTime::createFromFormat('d.m.Y', $publishtime);
    if($date) {
      $article->timestamp = $date;
      $article->save();
    }
    
    // Find language version of article
    $articleLanguageVersion = $article->languageVersions()->first();
    if($articleLanguageVersion == NULL) {
      throw new \App\Exceptions\ModelNotFoundException(
        'Language version of the article does not exist!'
      );
    }
    
    // Edit article language version
    $articleLanguageVersion->topic = $topic;
    $articleLanguageVersion->urlname = $URLName;
    $articleLanguageVersion->text = $text;
    if($published == "1") {
      $articleLanguageVersion->published = true;
    } else {
      $articleLanguageVersion->published = false;
    }
    
    $articleLanguageVersion->save();
    
    return true;
  }
}