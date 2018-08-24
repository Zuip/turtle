<?php namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Services\Articles\ArticleDataFetcher;
use App\Services\Articles\ArticleListParams;
use App\Services\Articles\FormattedArticlesArrayDataFetcher;
use App\Services\Articles\LanguageVersionsFetcher;
use Illuminate\Http\Request;

class UserArticlesController extends Controller {
  
  public function get(Request $request) {
    
    $listParams = new ArticleListParams();
    
    $offset = $listParams->parseOffset(
      $request->input('offset')
    );
    
    $limit = $listParams->parseLimit(
      $request->input('limit')
    );

    $userId = $request->route('userId');
    
    $languageVersionsFetcher = new LanguageVersionsFetcher();
    $languageVersionsFetcher->setLimit($limit);
    $languageVersionsFetcher->setOffset($offset);
    $languageVersionsFetcher->setUserId($userId);
    $articles = $languageVersionsFetcher->getWithLanguage(
      $request->input('language')
    );

    $formattedArticlesArrayDataFetcher = new FormattedArticlesArrayDataFetcher();
    $arrayArticles = $formattedArticlesArrayDataFetcher->getData(
      $articles,
      $request->input("language")
    );
    
    return \Response::json($arrayArticles);
  }
}
