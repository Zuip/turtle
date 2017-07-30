<?php namespace App\Services\Categories;

use App\Models\Categories\Category;
use App\Models\Categories\ICategory;
use App\Services\Languages\LanguageFetcher;
use App\Services\Categories\LanguageVersionFetcher;
use App\Services\Articles\CategoryArticlesDataFetcher;

/*
 * Data fetching for the page with category's information and
 * the category's articles
 */
class CategoryDataFetcher {

  public function getData($categoryURLName, $languageId, $page = 1) {
    
    $languageFetcher = new LanguageFetcher();
    $language = $languageFetcher->getWithId($languageId);

    $categoryLanguageVersionFetcher = new LanguageVersionFetcher();
    $categoryLanguageVersion = $categoryLanguageVersionFetcher->findWithURLName(
      $categoryURLName,
      $language,
      false
    );

    return [
      "id"  => $categoryLanguageVersion->category->id,
      "description" => $categoryLanguageVersion->description,
      "name" => $categoryLanguageVersion->name,
      "urlname" => $categoryLanguageVersion->urlname,
      "published" => $categoryLanguageVersion->published,
      "amountOfArticles" => $this->getCategoryPublishedArticlesCount(
        $categoryLanguageVersion->category->id
      ),
      "articles" => $this->getArticles($categoryLanguageVersion->category, $languageId, $page)
    ];
  }
  
  private function getArticles(ICategory $category, $languageId, $page) {
    
    $categoryArticlesDataFetcher = new CategoryArticlesDataFetcher();
    $categoryArticlesDataFetcher->setAmountToFetch(10);
    $categoryArticlesDataFetcher->setOffset(($page - 1) * 10);
    
    $categoryArticlesDataFetcher->setArticleLanguageVersionFetcher(
      new \App\Services\Articles\ArticleLanguageVersionFetcher()
    );
    
    $categoryArticlesDataFetcher->setArticleDataFetcher(
      new \App\Services\Articles\ArticleDataFetcher()
    );
    
    $categoryArticlesFetcher = new \App\Services\Articles\CategoryArticlesFetcher();
    $categoryArticlesFetcher->setOrderByTimestamp(true);
    $categoryArticlesDataFetcher->setCategoryArticlesFetcher($categoryArticlesFetcher);
    
    return $categoryArticlesDataFetcher->getData(
      $category,
      $languageId,
      ['id', 'topic', 'textSummary', 'timestamp', 'publishtime', 'URLName', 'offset']
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