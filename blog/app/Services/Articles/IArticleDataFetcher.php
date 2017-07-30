<?php namespace App\Services\Articles;

use App\Models\Articles\IArticleLanguageVersion;

interface IArticleDataFetcher {
  public function limitToAttributes($limitToAttributes);
  public function getArticleData(IArticleLanguageVersion $articleLanguageVersion);
}