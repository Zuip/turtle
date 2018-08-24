<?php namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Services\Articles\ArticleLanguageVersionFetcher;
use App\Services\Articles\ArticleTranslationsDataFetcher;
use App\Services\Cities\CityDataFetcher;
use App\Services\Trips\TripDataFetcher;
use Illuminate\Http\Request;
use Response;

class ArticleTranslationsController extends Controller {
  
  public function get(Request $request) {
    
    if(!$request->has("language")) {
      return Response::json(
        [
          "success" => false,
          "message" => "Missing language parameter"
        ],
        404
      );
    }

    $translatedArticle = $this->getTranslatedArticle($request);

    $this->validateArticle($translatedArticle);

    $articleTranslationsDataFetcher = new ArticleTranslationsDataFetcher();
    $articleTranslations = $articleTranslationsDataFetcher->getWithId(
      $translatedArticle->id
    );
  
    foreach($articleTranslations as $key => $articleTranslation) {

      $articleTranslations[$key]["city"] = $this->getCity(
        $articleTranslation["cityId"],
        $articleTranslation["language"]
      );

      $articleTranslations[$key]["trip"] = $this->getTrip(
        $articleTranslation["tripId"],
        $articleTranslation["language"]
      );

      unset($articleTranslations[$key]["id"]);
      unset($articleTranslations[$key]["cityId"]);
      unset($articleTranslations[$key]["city"]["id"]);
      unset($articleTranslations[$key]["city"]["country"]["id"]);
      unset($articleTranslations[$key]["tripId"]);
      unset($articleTranslations[$key]["trip"]["id"]);
    }

    return \Response::json($articleTranslations);
  }

  private function getTranslatedArticle(Request $request) {
    $articleLanguageVersionFetcher = new ArticleLanguageVersionFetcher();
    $articleLanguageVersionFetcher->setTripUrlName($request->route("tripUrlName"));
    $articleLanguageVersionFetcher->setCountryUrlName($request->route("countryUrlName"));
    $articleLanguageVersionFetcher->setCityUrlName($request->route("cityUrlName"));
    $articleLanguageVersionFetcher->setLanguage($request->input('language'));
    return $articleLanguageVersionFetcher->get(
      $request->route("cityVisitIndex")
    );
  }

  private function validateArticle($articleLanguageVersion) {
    if($articleLanguageVersion == null) {
      throw new \App\Exceptions\ModelNotFoundException(
        'Article language version does not exist!'
      );
    }
  }

  private function getCity($cityId, $language) {
    $cityDataFetcher = new CityDataFetcher();
    return $cityDataFetcher->getWithIdAndLanguage(
      $cityId,
      $language
    );
  }

  private function getTrip($tripId, $language) {
    $tripDataFetcher = new TripDataFetcher();
    return $tripDataFetcher->getWithIdAndLanguage(
      $tripId,
      $language
    );
  }
}