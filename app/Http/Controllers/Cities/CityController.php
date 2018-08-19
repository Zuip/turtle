<?php namespace App\Http\Controllers\Cities;

use App\Http\Controllers\Controller;
use App\Services\Cities\CityDataFetcher;
use Illuminate\Http\Request;
use Response;

class CityController extends Controller {
  
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
    $city = $cityDataFetcher->getWithCountryUrlNameAndCityUrlNameAndLanguage(
      $request->route("countryUrlName"),
      $request->route("cityUrlName"),
      $request->input("language")
    );

    unset($city["id"]);
    unset($city["country"]["id"]);
    
    return \Response::json($city);
  }
}