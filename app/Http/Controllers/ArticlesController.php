<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Articles\ArticleDataFetcher;
use App\Services\Articles\ArticleListParams;
use App\Services\Articles\ArticleLanguageVersionsFetcher;
use App\Services\Articles\LanguageVersionsFetcher;
use Illuminate\Http\Request;

class ArticlesController extends Controller {
  
  public function get(Request $request) {
    
    $listParams = new ArticleListParams();
    
    $offset = $listParams->parseOffset(
      $request->input('offset')
    );
    
    $limit = $listParams->parseLimit(
      $request->input('limit')
    );
    
    $languageVersionsFetcher = new LanguageVersionsFetcher();
    $languageVersionsFetcher->setLimit($limit);
    $languageVersionsFetcher->setOffset($offset);
    $articles = $languageVersionsFetcher->getWithLanguage(
      $request->input('language')
    );

    $arrayArticles = $this->getArrayFormArticles($articles);

    $articleLanguageVersionsFetcher = new ArticleLanguageVersionsFetcher();
    
    foreach($arrayArticles as $articleKey => $article) {
      
      $articleLanguageVersionsFetcher->setTripUrlName($article["trip"]["urlName"]);
      $articleLanguageVersionsFetcher->setCountryUrlName($article["city"]["country"]["urlName"]);
      $articleLanguageVersionsFetcher->setCityUrlName($article["city"]["urlName"]);
      $articleLanguageVersionsFetcher->setLanguage($request->input("language"));
      $articleLanguageVersions = $articleLanguageVersionsFetcher->get();
      
      foreach($articleLanguageVersions as $key => $articleLanguageVersion) {
        if($articleLanguageVersion->id === $article["id"]) {
          $arrayArticles[$articleKey]["city"]["visit"]["index"] = $key + 1;
        }
      }

      unset($arrayArticles[$articleKey]["id"]);
      unset($arrayArticles[$articleKey]["city"]["id"]);
    }
    
    return \Response::json($arrayArticles);
  }
  
  private function getArrayFormArticles($articles) {
  
    $arrayFormArticles = [];
    
    foreach($articles as $article) {
      
      $articleDataFetcher = new ArticleDataFetcher();
      $articleDataFetcher->limitToAttributes([
        "id", "publishTime", "summary", "city", "trip"
      ]);
      
      $arrayFormArticles[] = $articleDataFetcher->getArticleData(
        $article
      );
    }
    
    return $arrayFormArticles;
  }
}
