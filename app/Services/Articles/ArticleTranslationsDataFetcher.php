<?php

namespace App\Services\Articles;

use App\Models\Articles\ArticleLanguageVersion;

class ArticleTranslationsDataFetcher {

  public function getWithId($articleId) {

    $translatedArticles = ArticleLanguageVersion::where(
      'article_id',
      $articleId
    )->get();

    $result = [];

    foreach($translatedArticles as $translatedArticle) {
      $result[] = [
        "id" => $translatedArticle->article->id,
        "language" => $translatedArticle->language,
        "tripId" => $translatedArticle->article->visit->trip_id,
        "cityId" => $translatedArticle->article->visit->city_id
      ];
    }

    return $result;
  }
}