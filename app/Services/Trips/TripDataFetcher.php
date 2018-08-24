<?php

namespace App\Services\Trips;

use App\Models\Articles\IArticleLanguageVersion;
use App\Models\Trips\TranslatedTrip;

class TripDataFetcher {

  public function getWithArticleLanguageVersion(IArticleLanguageVersion $articleLanguageVersion) {
    
    $language = $articleLanguageVersion->language;
    $trip = $articleLanguageVersion->article->visit->trip;

    $translatedTrip = null;
    foreach($trip->languageVersions as $languageVersion) {
      if($languageVersion->language === $language) {
        $translatedTrip = $languageVersion;
        break;
      }
    }

    return [
      "name" => $translatedTrip->name,
      "urlName" => $translatedTrip->url_name
    ];
  }

  public function getWithUrlNameAndLanguage($tripUrlName, $language) {
    
    $trip = TranslatedTrip::where('url_name', $tripUrlName)
                          ->where('language', $language)
                          ->first();

    return [
      "id" => $trip->base->id,
      "name" => $trip->name,
      "urlName" => $trip->url_name
    ];
  }

  public function getWithIdAndLanguage($tripId, $language) {
    
    $trip = TranslatedTrip::where('trip_id', $tripId)
                          ->where('language', $language)
                          ->first();

    return [
      "id" => $trip->base->id,
      "name" => $trip->name,
      "urlName" => $trip->url_name
    ];
  }
}