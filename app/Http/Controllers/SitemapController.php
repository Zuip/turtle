<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

use App\Services\Articles\FormattedArticlesArrayDataFetcher;
use App\Services\Articles\LanguageVersionsFetcher;

class SitemapController extends Controller {
  
  public function get(Request $request) {

    $languageVersionsFetcher = new LanguageVersionsFetcher();

    $formattedArticlesArrayDataFetcher = new FormattedArticlesArrayDataFetcher();
    $fiArticles = $formattedArticlesArrayDataFetcher->getData(
      $languageVersionsFetcher->getWithLanguage('fi'),
      'fi'
    );

    $formattedArticlesArrayDataFetcher = new FormattedArticlesArrayDataFetcher();
    $enArticles = $formattedArticlesArrayDataFetcher->getData(
      $languageVersionsFetcher->getWithLanguage('en'),
      'en'
    );

    return view(
      'layout/sitemap',
      [
        "fiArticles" => $fiArticles,
        "enArticles" => $enArticles
      ]
    );
  }
}
