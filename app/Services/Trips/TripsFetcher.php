<?php namespace App\Services\Trips;

use App\Models\Trips\TranslatedTrip;
use App\Services\Cities\CitiesByCountryGrouper;
use App\Services\Cities\CitiesDataFetcher;

class TripsFetcher {
  
  public function getWithUserIdAndLanguage($userId, $language) {
 
    $trips = TranslatedTrip::with([
      'base',
      'base.visits',
    ])
    ->whereHas('base.users', function($query) use ($userId) {
      $query->where('user_id', $userId);
    })
    ->where('language', $language)
    ->get();
    
    $citiesDataFetcher = new CitiesDataFetcher();
    $cities = $citiesDataFetcher->getWithIdsAndLanguage(
      $this->getCityIds($trips),
      $language
    );
    
    $formattedTrips = [];
    foreach($trips as $trip) {
      $formattedTrips[] = $this->getFormattedTrip($trip, $cities);
    }

    return $formattedTrips;
  }

  private function getCityIds($trips) {

    $cityIds = [];

    foreach($trips as $trip) {
      foreach($trip->base->visits as $visit) {
        $cityIds[] = $visit->city_id;
      }
    }

    return $cityIds;
  }

  private function getFormattedTrip($trip, $cities) {

    $formattedVisits = [];
    foreach($trip->base->visits as $visit) {
      $formattedVisits[] = $this->getFormattedVisit($visit, $cities);
    }

    return [
      "id" => $trip->base->id,
      "name" => $trip->name,
      "urlName" => $trip->url_name,
      "visits" => $formattedVisits
    ];
  }

  private function getFormattedVisit($visit, $cities) {

    $city = $cities[$visit->city_id];

    return [
      "start" => $visit->visit_start,
      "end" => $visit->visit_end,
      "article" => [
        "id" => $visit->article_id
      ],
      "city" => [
        "country" => [
          "name" => $city["country"]["name"]
        ],
        "latitude" => $city["latitude"],
        "longitude" => $city["longitude"],
        "name" => $city["name"]
      ]
    ];
  }
}