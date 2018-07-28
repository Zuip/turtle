<?php namespace App\Http\Controllers;

use App\Models\Language;
use App\Services\Articles\ArticleFetcher;
use App\Services\Articles\ArticleLanguageVersionFetcher;
use App\Services\Cities\CityDataFetcher;
use App\Services\Trips\TripDataFetcher;
use Illuminate\Http\Request;
use Response;

class ArticleController extends Controller {
  
  public function get(Request $request, $urlName) {
    
    $language = Language::where('code', $request->input('language'))->first();

    $articleLanguageVersionFetcher = new ArticleLanguageVersionFetcher();
    $translatedArticle = $articleLanguageVersionFetcher->getWithUrlNamesAndLanguageId(
      $request->route("tripUrlName"),
      $request->route("countryUrlName"),
      $request->route("cityUrlName"),
      $language->id
    );
    
    $articleFetcher = new ArticleFetcher();
    $article = $articleFetcher->getWithId($translatedArticle["article_id"]);

    $cityDataFetcher = new CityDataFetcher();
    $city = $cityDataFetcher->getWithArticleLanguageVersion(
      $translatedArticle
    );

    $tripDataFetcher = new TripDataFetcher();
    $trip = $tripDataFetcher->getwithArticleLanguageVersion(
      $translatedArticle
    );

    return Response::json([
      "languageId" => $translatedArticle->language_id,
      "summary" => $translatedArticle->summary,
      "text" => $translatedArticle->text,
      "city" => $city,
      "trip" => $trip,
      "publishTime" => $article->timestamp
    ]);
  }
}