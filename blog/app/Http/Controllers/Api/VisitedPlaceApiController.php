<?php namespace App\Http\Controllers\Api;

class VisitedPlaceApiController {
  
  public function getVisitedPlaces() {
    
    $visitedPlacesService = new \App\Services\VisitedPlacesService();
    
    $visitedPlaces = $visitedPlacesService->getVisitedPlaces();
    
    $visitedPlacesArray = array();
    
    foreach($visitedPlaces as $visitedPlace) {
      $visitedPlacesArray[] = array(
        "name" => $visitedPlace->locationname,
        "lat" => floatval($visitedPlace->lat),
        "lng" => floatval($visitedPlace->lng)
      );
    }
    
    return \Response::json(array(
      "visitedPlaces" => $visitedPlacesArray
    ));
  }
  
  public function addVisitedPlace() {
    
  }
  
  public function updateVisitedPlace() {
    
  }
  
  public function removeVisitedPlace() {
    
  }
}