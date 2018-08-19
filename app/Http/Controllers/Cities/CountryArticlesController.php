<?php namespace App\Http\Controllers\Cities;

use App\Http\Controllers\Controller;
use App\Services\Articles\ArticleDataFetcher;
use App\Services\Articles\ArticleListParams;
use App\Services\Articles\FormattedArticlesArrayDataFetcher;
use App\Services\Articles\LanguageVersionsFetcher;
use App\Services\Cities\CitiesDataFetcher;
use Illuminate\Http\Request;

class CountryArticlesController extends Controller {
  
  public function get(Request $request) {
    
    $listParams = new ArticleListParams();
    
    $offset = $listParams->parseOffset(
      $request->input('offset')
    );
    
    $limit = $listParams->parseLimit(
      $request->input('limit')
    );

    $citiesDataFetcher = new CitiesDataFetcher();
    $cities = $citiesDataFetcher->getWithCountryUrlNameAndLanguage(
      $request->route("countryUrlName"),
      $request->input("language")
    );

    $cityIds = [];
    foreach($cities as $key => $city) {
      $cityIds[] = $city["id"];
    }
    
    $languageVersionsFetcher = new LanguageVersionsFetcher();
    $languageVersionsFetcher->setLimit($limit);
    $languageVersionsFetcher->setOffset($offset);
    $languageVersionsFetcher->setCityIds($cityIds);
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
