<?php

namespace App\Services\Trips;

use App\Models\Articles\IArticleLanguageVersion;
use App\Models\Trips\TranslatedTrip;
use App\Services\Trips\TripDataFetcher;

class VisitDataFetcher {

  public function getWithArticleLanguageVersion(IArticleLanguageVersion $articleLanguageVersion) {
    
    $tripDataFetcher = new TripDataFetcher();
    $trip = $tripDataFetcher->getWithArticleLanguageVersion($articleLanguageVersion);

    $visit = $articleLanguageVersion->article->visit;

    return [
      "start" => $this->getVisitStart($visit),
      "end" => $this->getVisitEnd($visit),
      "trip" => $trip
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

  private function getVisitStart($visit) {
    return $visit->visit_start_year
         . "-"
         . $visit->visit_start_month
         . "-"
         . $visit->visit_start_day;
  }

  private function getVisitEnd($visit) {
    return $visit->visit_end_year
         . "-"
         . $visit->visit_end_month
         . "-"
         . $visit->visit_end_day;
  }
}