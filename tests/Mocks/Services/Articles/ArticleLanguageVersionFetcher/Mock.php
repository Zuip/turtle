<?php namespace Tests\Mocks\Services\Articles\ArticleLanguageVersionFetcher;

use App\Models\Articles\IArticle;
use App\Services\Articles\IArticleLanguageVersionFetcher;

class Mock implements IArticleLanguageVersionFetcher {
  public function getWithUrlNamesAndCityVisitIndexAndLanguage($tripUrlName, $countryUrlName, $cityUrlName, $cityVisitIndex, $language) {

  }
}
