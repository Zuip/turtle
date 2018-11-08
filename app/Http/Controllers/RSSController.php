<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

use App\Services\Articles\FormattedArticlesArrayDataFetcher;
use App\Services\Articles\LanguageVersionsFetcher;

class RSSController extends Controller {
  
  public function getEN(Request $request) {

    $languageVersionsFetcher = new LanguageVersionsFetcher();

    $formattedArticlesArrayDataFetcher = new FormattedArticlesArrayDataFetcher();
    $articles = $formattedArticlesArrayDataFetcher->getData(
      $languageVersionsFetcher->getWithLanguage('en'),
      'en'
    );

    return view(
      'layout/rss',
      [
        "articles" => $articles,
        "description" => "Travel Stories & Ideas. Destination Comparisons."
      ]
    );
  }

  public function getFI(Request $request) {

    $languageVersionsFetcher = new LanguageVersionsFetcher();

    $formattedArticlesArrayDataFetcher = new FormattedArticlesArrayDataFetcher();
    $articles = $formattedArticlesArrayDataFetcher->getData(
      $languageVersionsFetcher->getWithLanguage('fi'),
      'fi'
    );

    return view(
      'layout/rss',
      [
        "articles" => $articles,
        "description" => "Matkakertomuksia ja -ideoita. Kohdevertailuja."
      ]
    );
  }
}
