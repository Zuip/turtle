<?php

namespace App\Services\Articles;

use App\Models\Articles\IArticleLanguageVersion;
use App\Services\Categories\ILanguageVersionFetcher;
use App\Services\Languages\ILanguageFetcher;

interface IArticlePathFetcher {
  public function setLanguageFetcher(ILanguageFetcher $languageFetcher);
  public function setCategoryLanguageVersionFetcher(ILanguageVersionFetcher $categoryLanguageVersionFetcher);
  public function getArticlePath(IArticleLanguageVersion $articleLanguageVersion);
}