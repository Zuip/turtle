<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Articles\ArticleDataFetcher;
use App\Services\Articles\ArticleListParams;
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
}
