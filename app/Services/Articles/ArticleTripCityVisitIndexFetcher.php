<?php namespace App\Services\Articles;

use App\Services\Articles\ArticleLanguageVersionsFetcher;

class ArticleTripCityVisitIndexFetcher {

  public function getIndex($article, $language) {

    $articleLanguageVersionsFetcher = new ArticleLanguageVersionsFetcher();

    $articleLanguageVersionsFetcher->setTripUrlName($article["visit"]["trip"]["urlName"]);
    $articleLanguageVersionsFetcher->setCountryUrlName($article["city"]["country"]["urlName"]);
    $articleLanguageVersionsFetcher->setCityUrlName($article["city"]["urlName"]);
    $articleLanguageVersionsFetcher->setLanguage($language);
    $articleLanguageVersions = $articleLanguageVersionsFetcher->get();
    
    foreach($articleLanguageVersions as $key => $articleLanguageVersion) {
      if($articleLanguageVersion->id === $article["id"]) {
        return $key + 1;
      }
    }

    return null;
  }
}