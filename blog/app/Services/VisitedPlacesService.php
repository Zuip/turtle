<?php namespace App\Services;

class VisitedPlacesService {
  
  public function getVisitedPlaces() {
    
    $visitedPlaces = \App\Models\VisitedPlace::all();
    
    return $visitedPlaces;
  }
  
}