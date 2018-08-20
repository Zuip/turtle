<?php namespace App\Http\Controllers\Cities;

use App\Http\Controllers\Controller;
use App\Services\Cities\CountriesDataFetcher;
use Illuminate\Http\Request;
use Response;

class CountriesController extends Controller {
  
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
    
    $countriesDataFetcher = new CountriesDataFetcher();

    $countriesData = $countriesDataFetcher->getWithLanguage(
      $request->input("language")
    );
    
    foreach(array_keys($countriesData) as $key) {
      unset($countriesData[$key]["id"]);
    }

    return \Response::json($countriesData);
  }
}