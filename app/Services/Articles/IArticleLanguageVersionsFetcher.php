<?php namespace App\Services\Articles;

use App\Models\Articles\IArticle;

interface IArticleLanguageVersionsFetcher {
  public function setCityUrlName($cityUrlName);
  public function setCountryUrlName($countryUrlName);
  public function setLanguage($language);
  public function setTripUrlName($tripUrlName);
  public function get();
}