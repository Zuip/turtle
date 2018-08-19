<?php namespace App\Http\Controllers\Cities;

use App\Http\Controllers\Controller;
use App\Services\Articles\ArticleDataFetcher;
use App\Services\Articles\ArticleListParams;
use App\Services\Articles\FormattedArticlesArrayDataFetcher;
use App\Services\Articles\LanguageVersionsFetcher;
use App\Services\Cities\CityDataFetcher;
use Illuminate\Http\Request;

class CityArticlesController extends Controller {
  
  public function get(Request $request) {
    
    $listParams = new ArticleListParams();
    
    $offset = $listParams->parseOffset(
      $request->input('offset')
    );
    
    $limit = $listParams->parseLimit(
      $request->input('limit')
    );
    
    $cityDataFetcher = new CityDataFetcher();
    $city = $cityDataFetcher->getWithCountryUrlNameAndCityUrlNameAndLanguage(
      $request->route("countryUrlName"),
      $request->route("cityUrlName"),
      $request->input("language")
    );

    $languageVersionsFetcher = new LanguageVersionsFetcher();
    $languageVersionsFetcher->setLimit($limit);
    $languageVersionsFetcher->setOffset($offset);
    $languageVersionsFetcher->setCityIds([$city["id"]]);
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
