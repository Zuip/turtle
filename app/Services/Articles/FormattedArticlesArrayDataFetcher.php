<?php namespace App\Services\Articles;

class FormattedArticlesArrayDataFetcher {

  public function getData($articles, $language) {

    $arrayArticles = $this->getArrayFormArticles($articles);

    foreach($arrayArticles as $articleKey => $article) {
      
      $articleTripCityVisitIndexFetcher = new ArticleTripCityVisitIndexFetcher();
      $index = $articleTripCityVisitIndexFetcher->getIndex($article, $language);
      $arrayArticles[$articleKey]["city"]["visit"]["index"] = $index;

      unset($arrayArticles[$articleKey]["id"]);
      unset($arrayArticles[$articleKey]["city"]["id"]);
    }

    return $arrayArticles;
  }

  private function getArrayFormArticles($articles) {
  
    $arrayFormArticles = [];
    
    foreach($articles as $article) {
      
      $articleDataFetcher = new ArticleDataFetcher();
      $articleDataFetcher->limitToAttributes([
        "id", "publishTime", "summary", "city", "visit"
      ]);
      
      $arrayFormArticles[] = $articleDataFetcher->getArticleData(
        $article
      );
    }
    
    return $arrayFormArticles;
  }
}