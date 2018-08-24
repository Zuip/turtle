<?php namespace App\Http\Controllers\Trips;

use App\Http\Controllers\Controller;
use App\Services\Trips\TripDataFetcher;
use App\Services\Trips\TripTranslationsDataFetcher;
use Illuminate\Http\Request;
use Response;

class TripTranslationsController extends Controller {
  
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
    
    $tripDataFetcher = new TripDataFetcher();
    $tripData = $tripDataFetcher->getWithUrlNameAndLanguage(
      $request->route("tripUrlName"),
      $request->input("language")
    );
    
    $tripTranslationsDataFetcher = new TripTranslationsDataFetcher();
    $tripTranslationsData = $tripTranslationsDataFetcher->getWithId(
      $tripData["id"]
    );

    foreach($tripTranslationsData as $key => $tripTranslationData) {
      unset($tripTranslationsData[$key]["id"]);
    }

    return \Response::json($tripTranslationsData);
  }
}