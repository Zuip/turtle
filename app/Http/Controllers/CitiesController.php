<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Cities\CitiesFetcher;
use Illuminate\Http\Request;
use Response;

class CitiesController extends Controller {
  
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
    
    $citiesFetcher = new CitiesFetcher();
    $cities = $citiesFetcher->getWithLanguageCode(
      $request->input('language')
    );
    
    return \Response::json($cities);
  }
}