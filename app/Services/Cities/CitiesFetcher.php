<?php namespace App\Services\Cities;

use App\Models\Cities\TranslatedCity;

class CitiesFetcher {
  
  public function getWithLanguageCode($languageCode) {
    $cities = TranslatedCity::with([
      'base',
      'base.country',
      'base.country.languageVersions' => function($query) use ($languageCode) {
        $query->whereHas('language', function($query) use ($languageCode) {
          $query->where('code', $languageCode);
        });
      }
    ])->whereHas('language', function($query) use ($languageCode) {
      $query->where('code', $languageCode);
    })->get();
    
    $citiesByCountry = [];
    foreach($cities as $city) {
      
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
