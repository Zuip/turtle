<?php namespace App\Http\Controllers\Cities;

use App\Http\Controllers\Controller;
use App\Services\Cities\CitiesDataFetcher;
use Illuminate\Http\Request;
use Response;

class CitiesController extends Controller {
  
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

    $citiesDataFetcher = new CitiesDataFetcher();

    if($request->route("countryUrlName") === null) {
      $cities = $citiesDataFetcher->getWithLanguage(
        $request->input("language")
      );
    } else {
      $cities = $citiesDataFetcher->getWithCountryUrlNameAndLanguage(
        $request->route("countryUrlName"),
        $request->input("language")
      );
    }
    
    return \Response::json($cities);
  }
}