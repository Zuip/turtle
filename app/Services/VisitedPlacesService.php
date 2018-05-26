<?php namespace App\Services;

use App\Models\VisitedPlace;

class VisitedPlacesService {
  
  public function getVisitedPlaces() {
    
    $visitedPlaces = VisitedPlace::all();
    
    $visitedPlacesArray = array();
    
    foreach($visitedPlaces as $visitedPlace) {
      $visitedPlacesArray[] = array(
        "name" => $visitedPlace->locationname,
        "lat" => floatval($visitedPlace->lat),
        "lng" => floatval($visitedPlace->lng)
      );
    }
    
    return $visitedPlacesArray;
  }
}