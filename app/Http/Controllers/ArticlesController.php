<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Articles\ArticleDataFetcher;
use App\Services\Articles\LanguageVersionsFetcher;
use Illuminate\Http\Request;

class ArticlesController extends Controller {
  
  private $defaultResults;
  private $maxResults;
  
  public function __construct() {
    $this->defaultResults = 5;
    $this->maxResults = 10;
  }
  
  public function get(Request $request) {
    
    $offset = $this->parseOffset(
      $request->input('offset')
    );
    
    $limit = $this->parseLimit(
      $request->input('limit')
    );
    
    $languageVersionsFetcher = new LanguageVersionsFetcher();
    $languageVersionsFetcher->setLimit($limit);
    $languageVersionsFetcher->setOffset($offset);
    $articles = $languageVersionsFetcher->getWithLanguageCode(
      $request->input('language')
    );
    
    return \Response::json($this->getArrayFormArticles($articles));
  }
  
  private function getArrayFormArticles($articles) {
  
    $arrayFormArticles = [];
    
    foreach($articles as $article) {
      
      $articleDataFetcher = new ArticleDataFetcher();
      $articleDataFetcher->limitToAttributes([
        "publishTime", "summary", "city", "trip"
      ]);
      
      $arrayFormArticles[] = $articleDataFetcher->getArticleData(
        $article
      );
    }
    
    return $arrayFormArticles;
  }
  
  private function parseLimit($rawLimit) {
    
    if($rawLimit === null) {
      return $this->defaultResults;
    }
    
    $limit = abs((int)$rawLimit);
    
    if($limit > $this->maxResults) {
      return $this->maxResults;
    }
    
    return $limit;
  }
  
  private function parseOffset($offset) {
    
    if($offset === null) {
      return 0;
    }
    
    return abs((int)$offset);
  }
}
