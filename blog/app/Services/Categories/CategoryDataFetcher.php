<?php namespace App\Services\Categories;

use App\Models\Categories\Category;
use App\Services\Languages\LanguageFetcher;
use App\Services\Categories\LanguageVersionFetcher;

/*
 * Data fetching for the page with category's information and
 * the category's articles
 */
class CategoryDataFetcher {

  public function getData($categoryURLName, $languageCode, $page = 1) {
    
    $languageFetcher = new LanguageFetcher();
    $language = $languageFetcher->getWithCode($languageCode);

    $categoryLanguageVersionFetcher = new LanguageVersionFetcher();
    $categoryLanguageVersion = $categoryLanguageVersionFetcher->findWithURLName(
      $categoryURLName,
      $language,
      false
    );

    $articles = $this->getCategoryArticlesData(
      $categoryLanguageVersion->category->id,
      $languageCode,
      $page
    );

    return array(
      "id" => $categoryLanguageVersion->category->id,
      "description" => $categoryLanguageVersion->description,
      "name" => $categoryLanguageVersion->name,
      "urlname" => $categoryLanguageVersion->urlname,
      "published" => $categoryLanguageVersion->published,
      "amountOfArticles" => $this->getCategoryPublishedArticlesCount(
        $categoryLanguageVersion->category->id
      ),
      "articles" => $articles
    );
  }
  
  private function getCategoryArticlesData($categoryId, $language, $page) {
    $articleController = new \App\Http\Controllers\ArticleController();
    return $articleController->getCategoryArticlesData(
      $categoryId,
      $language,
      false,
      array(
        'id',
        'topic',
        'textsummary',
        'timestamp',
        'publishtime',
        'urlname',
        'offset',
        'previous'
      ),
      array(
        'amount' => 10,
        'offset' => ($page - 1) * 10
      ),
      true
    );
  }
  
  private function getCategoryPublishedArticlesCount($categoryId) {
    return Category::join('article', 'category.id', '=', 'article.category_id')
    ->join('articletext', 'article.id', '=', 'articletext.article_id')
    ->select('article.*')
    ->where('category_id', $categoryId)
    ->where('articletext.published', '1')
    ->count();
  }
}