<?php namespace App\Services\Articles;

use App\Models\Articles\IArticle;

interface IArticleLanguageVersionFetcher {
  public function setThrowExceptionOnNotFound($throwExceptionOnNotFound);
  public function getWithArticleAndLanguage(IArticle $article, $language);
  public function getWithUrlNamesAndLanguage($tripUrlName, $countryUrlName, $cityUrlName, $language);
}