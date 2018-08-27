<?php namespace App\Http\Controllers\Trips;

use App\Http\Controllers\Controller;
use App\Services\Trips\TripsFetcher;
use Illuminate\Http\Request;
use Response;

class TripsController extends Controller {
  
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
    
    $tripsFetcher = new TripsFetcher();
    $trips = $tripsFetcher->getWithUserIdAndLanguage(
      $request->route('userId'),
      $request->input('language')
    );
    
    return \Response::json($trips);
  }
}