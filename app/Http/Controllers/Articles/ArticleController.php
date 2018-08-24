<?php namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Services\Articles\ArticleFetcher;
use App\Services\Articles\ArticleLanguageVersionFetcher;
use App\Services\Articles\ArticleLanguageVersionsFetcher;
use App\Services\Cities\CityDataFetcher;
use App\Services\Trips\TripDataFetcher;
use Illuminate\Http\Request;
use Response;

class ArticleController extends Controller {
  
  public function get(Request $request) {
    
    $translatedArticle = $this->getTranslatedArticle($request);

    $this->validateArticle($translatedArticle);
    
    $articleFetcher = new ArticleFetcher();
    $article = $articleFetcher->getWithId($translatedArticle["article_id"]);

    $city = $this->getCity($translatedArticle);
    $trip = $this->getTrip($translatedArticle);

    return Response::json([
      "language" => $translatedArticle->language,
      "summary" => $translatedArticle->summary,
      "text" => $translatedArticle->text,
      "city" => $city,
      "trip" => $trip,
      "publishTime" => $article->timestamp
    ]);
  }

  public function getPrevious(Request $request) {
    
    $translatedArticle = $this->getTranslatedArticle($request);

    $this->validateArticle($translatedArticle);

    $articleLanguageVersionsFetcher = new ArticleLanguageVersionsFetcher();
    $articleLanguageVersionsFetcher->setTripUrlName($request->route("tripUrlName"));
    $articleLanguageVersionsFetcher->setLanguage($request->input('language'));
    $translatedArticles = $articleLanguageVersionsFetcher->get();

    $index = $this->getArticleArrayIndex($translatedArticle, $translatedArticles);

    if($index === 0) {
      throw new \App\Exceptions\ModelNotFoundException(
        'There is no previous article'
      );
    }

    $previousArticle = $translatedArticles[$index - 1];

    $previousArticleCityVisitIndex = $this->getArticleCityVisitIndex(
      $previousArticle,
      $translatedArticles
    );

    $trip = $this->getTrip($previousArticle);
    $city = $this->getCity($previousArticle);
    $city["visit"] = [];
    $city["visit"]["index"] = $previousArticleCityVisitIndex;

    return [
      "city" => $city,
      "trip" => $trip
    ];
  }

  public function getNext(Request $request) {
    
    $translatedArticle = $this->getTranslatedArticle($request);

    $this->validateArticle($translatedArticle);

    $articleLanguageVersionsFetcher = new ArticleLanguageVersionsFetcher();
    $articleLanguageVersionsFetcher->setTripUrlName($request->route("tripUrlName"));
    $articleLanguageVersionsFetcher->setLanguage($request->input('language'));
    $translatedArticles = $articleLanguageVersionsFetcher->get();

    $index = $this->getArticleArrayIndex($translatedArticle, $translatedArticles);

    if($index === count($translatedArticles) - 1) {
      throw new \App\Exceptions\ModelNotFoundException(
        'There is no next article'
      );
    }

    $nextArticle = $translatedArticles[$index + 1];

    $nextArticleCityVisitIndex = $this->getArticleCityVisitIndex(
      $nextArticle,
      $translatedArticles
    );

    $trip = $this->getTrip($nextArticle);
    $city = $this->getCity($nextArticle);
    $city["visit"] = [];
    $city["visit"]["index"] = $nextArticleCityVisitIndex;

    return [
      "city" => $city,
      "trip" => $trip
    ];
  }

  private function getArticleArrayIndex($articleToSearch, $articles) {

    foreach($articles as $key => $article) {
      if($article->article->id === $articleToSearch->article->id) {
        return $key;
      }
    }

    return null;
  }

  private function getCity($article) {
    $cityDataFetcher = new CityDataFetcher();
    return $cityDataFetcher->getWithArticleLanguageVersion(
      $article
    );
  }

  private function getTrip($article) {
    $tripDataFetcher = new TripDataFetcher();
    return $tripDataFetcher->getwithArticleLanguageVersion(
      $article
    );
  }

  private function getArticleCityVisitIndex($articleToSearch, $articles) {

    $articleCityVisitIndex = 1;

    foreach($articles as $article) {

      if($article->id === $articleToSearch->id) {
        break;
      }

      if($article->article->visit->city_id === $articleToSearch->article->visit->city_id) {
        ++$articleCityVisitIndex;
      }
    }

    return $articleCityVisitIndex;
  }

  private function getTranslatedArticle(Request $request) {
    $articleLanguageVersionFetcher = new ArticleLanguageVersionFetcher();
    $articleLanguageVersionFetcher->setTripUrlName($request->route("tripUrlName"));
    $articleLanguageVersionFetcher->setCountryUrlName($request->route("countryUrlName"));
    $articleLanguageVersionFetcher->setCityUrlName($request->route("cityUrlName"));
    $articleLanguageVersionFetcher->setLanguage($request->input('language'));
    return $articleLanguageVersionFetcher->get(
      $request->route("cityVisitIndex")
    );
  }

  private function validateArticle($articleLanguageVersion) {
    if($articleLanguageVersion == null) {
      throw new \App\Exceptions\ModelNotFoundException(
        'Article language version does not exist!'
      );
    }
  }
}