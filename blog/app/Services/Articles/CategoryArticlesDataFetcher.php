<?php namespace App\Services\Articles;

use App\Models\Categories\ICategory;
use App\Services\Articles\IArticleLanguageVersionFetcher;
use App\Services\Articles\IArticleDataFetcher;
use App\Services\Articles\ICategoryArticlesFetcher;

class CategoryArticlesDataFetcher {
  
  private $amountToFetch;
  private $offset;
  private $articleLanguageVersionFetcher;
  private $articleDataFetcher;
  private $categoryArticlesFetcher;
  
  public function __construct() {
    $this->amountToFetch = null;
    $this->offset = 0;
  }
  
  public function setAmountToFetch($amountToFetch) {
    $this->amountToFetch = $amountToFetch;
  }
  
  public function setOffset($offset) {
    $this->offset = $offset;
  }
  
  public function setArticleLanguageVersionFetcher(IArticleLanguageVersionFetcher $articleLanguageVersionFetcher) {
    $this->articleLanguageVersionFetcher = $articleLanguageVersionFetcher;
  }
  
  public function setArticleDataFetcher(IArticleDataFetcher $articleDataFetcher) {
    $this->articleDataFetcher = $articleDataFetcher;
  }
  
  public function setCategoryArticlesFetcher(ICategoryArticlesFetcher $categoryArticlesFetcher) {
    $this->categoryArticlesFetcher = $categoryArticlesFetcher;
  }
  
  public function getData(ICategory $category, $languageId, $limitToAttributes) {
    
    $loopedArticlesCount = 0;
    $selectedArticlesCount = 0;
    $articleLanguageVersions = array();
    
    foreach($this->categoryArticlesFetcher->getArticles($category) as $article) {
      
      // Fetching correct article language version
      $this->articleLanguageVersionFetcher->setThrowExceptionOnNotFound(false);
      $articleLanguageVersion = $this->articleLanguageVersionFetcher->getWithArticleAndLanguageId(
        $article,
        $languageId
      );
      if($articleLanguageVersion === null) {
        continue;
      }
      
      // Handle pagination
      ++$loopedArticlesCount;
      if($this->offset >= $loopedArticlesCount) {
        continue;
      }
      ++$selectedArticlesCount;
      
      // Get the data for one article
      $this->articleDataFetcher->limitToAttributes($limitToAttributes);
      $articleData = $this->articleDataFetcher->getArticleData($articleLanguageVersion);
      
      if(in_array("offset", $limitToAttributes)) {
        $articleData["offset"] = $loopedArticlesCount - 1;
      }

      $articleLanguageVersions[] = $articleData;
      
      // If fetching articles with pagination, end fetching if already found enough articles
      if(isset($this->amountToFetch) && $this->amountToFetch <= $selectedArticlesCount) {
        break;
      }
    }
    
    return $articleLanguageVersions;
  }
}