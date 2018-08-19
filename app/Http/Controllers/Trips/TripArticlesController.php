<?php namespace App\Http\Controllers\Trips;

use App\Http\Controllers\Controller;
use App\Services\Articles\ArticleDataFetcher;
use App\Services\Articles\ArticleListParams;
use App\Services\Articles\FormattedArticlesArrayDataFetcher;
use App\Services\Articles\LanguageVersionsFetcher;
use App\Services\Trips\TripFetcher;
use Illuminate\Http\Request;

class TripArticlesController extends Controller {
  
  public function get(Request $request) {
    
    $listParams = new ArticleListParams();
    
    $offset = $listParams->parseOffset(
      $request->input('offset')
    );
    
    $limit = $listParams->parseLimit(
      $request->input('limit')
    );

    $tripFetcher = new TripFetcher();
    $trip = $tripFetcher->getWithUrlNameAndLanguage(
      $request->route("tripUrlName"),
      $request->input("language")
    );
    
    $languageVersionsFetcher = new LanguageVersionsFetcher();
    $languageVersionsFetcher->setLimit($limit);
    $languageVersionsFetcher->setOffset($offset);
    $languageVersionsFetcher->setTripId($trip->base->id);
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
