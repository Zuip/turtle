<?php namespace App\Http\Controllers\Cities;

use App\Http\Controllers\Controller;
use App\Services\Cities\CountryDataFetcher;
use App\Services\Cities\CountryTranslationsDataFetcher;
use Illuminate\Http\Request;
use Response;

class CountryTranslationsController extends Controller {
  
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
    
    $countryDataFetcher = new CountryDataFetcher();
    $countryData = $countryDataFetcher->getWithUrlNameAndLanguage(
      $request->route("countryUrlName"),
      $request->input("language")
    );
    
    $countryTranslationsDataFetcher = new CountryTranslationsDataFetcher();
    $countryTranslationsData = $countryTranslationsDataFetcher->getWithId(
      $countryData["id"]
    );

    return \Response::json($countryTranslationsData);
  }
}