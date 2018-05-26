<?php namespace App\Services\Articles;

use App\Models\Articles\IArticleLanguageVersion;

interface IArticleNavigation {
  public function setCurrentArticle(IArticleLanguageVersion $articleLanguageVersion);
  public function getPreviousArticle();
  public function getNextArticle();
}
