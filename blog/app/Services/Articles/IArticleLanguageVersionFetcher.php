<?php namespace App\Services\Articles;

use App\Models\Articles\IArticle;

interface IArticleLanguageVersionFetcher {
  public function allowUnpublished($allowUnpublished);
  public function setThrowExceptionOnNotFound($throwExceptionOnNotFound);
  public function getWithArticleAndLanguageId(IArticle $article, $languageId);
  public function getWithURLName($URLName);
}