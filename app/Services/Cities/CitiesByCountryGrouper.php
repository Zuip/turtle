<?php namespace App\Services\Cities;

class CitiesByCountryGrouper {
  
  private $cities;

  public function __construct() {
    $this->cities = [];
  }

  public function setCities($cities) {
    $this->cities = $cities;
  }

  public function getCitiesGroupedByCountries() {
    
    $citiesByCountry = [];

    foreach($this->cities as $city) {
      
      $country = $this->getCountryOfCity($city);
      
      if(!$this->countryExistsInArray($citiesByCountry, $country)) {
        $citiesByCountry[$country->id] = $this->buildNewCountry($country);
      }
      
      $citiesByCountry[$country->id]["cities"][] = [
        "id" => $city->base->id,
        "name" => $city->name
      ];
    }
    
    return $citiesByCountry;
  }
  
  private function getCountryOfCity($city) {
    return $city->base->country;
  }
  
  private function countryExistsInArray($citiesByCountry, $country) {
    return isset($citiesByCountry[$country->id]);
  }
  
  private function buildNewCountry($country) {
    return [
      "cities" => [],
      "name" => $country->languageVersions->first()->name,
    ];
  }
}