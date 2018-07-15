<?php namespace App\Http\Controllers;

use App\Services\Articles\ArticleCreator;
use App\Services\Articles\ArticleFetcher;
use App\Services\Articles\ArticlePathFetcher;
use \App\Services\Articles\ArticleLanguageVersionFetcher;
use App\Services\Categories\CategoryFetcher;
use App\Services\Categories\LanguageVersionFetcher;
use App\Services\Languages\LanguageFetcher;
use Illuminate\Http\Request;
use Response;

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
    $articleCreator->setPublishTime(\Input::get('publishTime'));
    
    $articleCreator->createArticle();

    return \Response::json(
      array(
        "articleId" => $articleCreator->getCreatedArticle()->id
      )
    );
  }
  
  public function get(Request $request, $urlName) {
    
    $articleLanguageVersionFetcher = new ArticleLanguageVersionFetcher();
    $translatedArticle = $articleLanguageVersionFetcher->getWithURLName($urlName);
    
    $articleFetcher = new ArticleFetcher();
    $article = $articleFetcher->getWithId($translatedArticle["article_id"]);
    
    $articlePathFetcher = new ArticlePathFetcher();
    $articlePathFetcher->setCategoryLanguageVersionFetcher(new LanguageVersionFetcher());
    $articlePathFetcher->setLanguageFetcher(new LanguageFetcher());
    
    return Response::json([
      "languageId" => $translatedArticle["language_id"],
      "topic" =>  $translatedArticle["topic"],
      "summary" => $translatedArticle["summary"],
      "text" => $translatedArticle["text"],
      "path" => $articlePathFetcher->getArticlePath($translatedArticle),
      "publishTime" => $article["timestamp"]
    ]);
  }
}