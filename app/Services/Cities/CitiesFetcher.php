<?php namespace App\Services\Cities;

use App\Models\Cities\TranslatedCity;
use App\Services\Cities\CitiesByCountryGrouper;

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

    $citiesByCountryGrouper = new CitiesByCountryGrouper();
    $citiesByCountryGrouper->setCities($cities);
    return $citiesByCountryGrouper->getCitiesGroupedByCountries;
  }
}
