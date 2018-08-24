<?php namespace App\Http\Controllers\Cities;

use App\Http\Controllers\Controller;
use App\Services\Cities\CityDataFetcher;
use App\Services\Cities\CityTranslationsDataFetcher;
use Illuminate\Http\Request;
use Response;

class CityTranslationsController extends Controller {
  
  public function get(Request $request) {
    
    if(!$request->has("language")) {
      return Response::json(
        [
          "success" => false,
          "message" => "Missing language parameter"
        ],
        404
      );
    }
    
    $cityDataFetcher = new CityDataFetcher();
    $cityData = $cityDataFetcher->getWithCountryUrlNameAndCityUrlNameAndLanguage(
      $request->route("countryUrlName"),
      $request->route("cityUrlName"),
      $request->input("language")
    );

    $cityTranslationsDataFetcher = new CityTranslationsDataFetcher();
    $cityTranslationsData = $cityTranslationsDataFetcher->getWithId(
      $cityData["id"]
    );

    return \Response::json($cityTranslationsData);
  }
}