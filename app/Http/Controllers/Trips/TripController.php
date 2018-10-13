<?php namespace App\Http\Controllers\Trips;

use App\Http\Controllers\Controller;
use App\Services\Trips\TripFetcher;
use App\Services\Trips\TripDataFetcher;
use Illuminate\Http\Request;
use Response;

class TripController extends Controller {
  
  public function get(Request $request) {
    
    if(!$request->has('language')) {
      return Response::json(
        [
          "success" => false,
          "message" => "Missing language parameter"
        ],
        404
      );
    }
    
    $tripFetcher = new TripFetcher();
    $trip = $tripFetcher->getWithUrlNameAndLanguage(
      $request->route('tripUrlName'),
      $request->input('language')
    );
    
    $tripDataFetcher = new TripDataFetcher();
    $tripData = $tripDataFetcher->getWithTranslatedTrip($trip);
    
    return \Response::json($tripData);
  }
}