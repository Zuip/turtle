<?php namespace Tests\TestCases\Services\Articles;

use PHPUnit\Framework\TestCase;
use App\Services\Articles\CategoryArticlesDataFetcher;
use Tests\Mocks\Models\Articles\Article\MockArticle;
use Tests\Mocks\Models\Articles\ArticleLanguageVersion\MockArticleLanguageVersion;
use Tests\Mocks\Models\Categories\Category\MockCategory;
use Tests\Mocks\Services\Articles\ArticleLanguageVersionFetcher\Mock as MockArticleLanguageVersionFetcher;
use Tests\Mocks\Services\Articles\ArticleDataFetcher\Mock as MockArticleDataFetcher;
use Tests\Mocks\Services\Articles\CategoryArticlesFetcher\Mock as MockCategoryArticlesFetcher;

class CategoryArticlesDataFetcherTests extends TestCase {
  
  public function testArticlesDataGeneration() {
    $this->withoutPagination();
    $this->firstPageWithPagination();
    $this->secondPageWithPagination();
  }
  
  // This tests that all the twelve articles datas are fetched correctly
  // when not using pagination
  private function withoutPagination() {
    
    $categoryArticlesDataFetcher = new CategoryArticlesDataFetcher();
    $categoryArticlesDataFetcher->setArticleDataFetcher(
      new MockArticleDataFetcher()
    );
    $categoryArticlesDataFetcher->setArticleLanguageVersionFetcher(
      new MockArticleLanguageVersionFetcher()
    );
    $categoryArticlesDataFetcher->setCategoryArticlesFetcher(
      new MockCategoryArticlesFetcher()
    );
    
    $data = $categoryArticlesDataFetcher->getData($this->createMockCategory(), 1, ["id"]);
    
    $expectedResult = [
      ["id" => 1], ["id" => 2], ["id" => 3], ["id" => 4], ["id" => 5],
      ["id" => 6], ["id" => 7], ["id" => 8], ["id" => 9], ["id" => 10],
      ["id" => 11], ["id" => 12]
    ];
    
    $this->assertTrue($expectedResult === $data);
  }
  
  // Test that when using pagination, on the first page there is ten first
  // articles
  private function firstPageWithPagination() {
    
    $categoryArticlesDataFetcher = new CategoryArticlesDataFetcher();
    $categoryArticlesDataFetcher->setAmountToFetch(10);
    $categoryArticlesDataFetcher->setOffset(0);
    $categoryArticlesDataFetcher->setArticleDataFetcher(
      new MockArticleDataFetcher()
    );
    $categoryArticlesDataFetcher->setArticleLanguageVersionFetcher(
      new MockArticleLanguageVersionFetcher()
    );
    $categoryArticlesDataFetcher->setCategoryArticlesFetcher(
      new MockCategoryArticlesFetcher()
    );
    
    $data = $categoryArticlesDataFetcher->getData($this->createMockCategory(), 1, ["id"]);
    
    $expectedResult = [
      ["id" => 1], ["id" => 2], ["id" => 3], ["id" => 4], ["id" => 5],
      ["id" => 6], ["id" => 7], ["id" => 8], ["id" => 9], ["id" => 10]
    ];
    
    $this->assertTrue($expectedResult === $data);
  }
  
  // Test that when using pagination, on the second page there is only two
  // articles when there is twelve articles on the category
  private function secondPageWithPagination() {
    
    $categoryArticlesDataFetcher = new CategoryArticlesDataFetcher();
    $categoryArticlesDataFetcher->setArticleDataFetcher(
      new MockArticleDataFetcher()
    );
    $categoryArticlesDataFetcher->setArticleLanguageVersionFetcher(
      new MockArticleLanguageVersionFetcher()
    );
    $categoryArticlesDataFetcher->setCategoryArticlesFetcher(
      new MockCategoryArticlesFetcher()
    );
    $categoryArticlesDataFetcher->setAmountToFetch(10);
    $categoryArticlesDataFetcher->setOffset(10);
    
    $data = $categoryArticlesDataFetcher->getData($this->createMockCategory(), 1, ["id"]);
    
    $expectedResult = [
      ["id" => 11], ["id" => 12]
    ];
    
    $this->assertTrue($expectedResult === $data);
  }
  
  private function createMockCategory() {
    $category = new MockCategory();
    $category->addArticle($this->createMockArticle(1));
    $category->addArticle($this->createMockArticle(2));
    $category->addArticle($this->createMockArticle(3));
    $category->addArticle($this->createMockArticle(4));
    $category->addArticle($this->createMockArticle(5));
    $category->addArticle($this->createMockArticle(6));
    $category->addArticle($this->createMockArticle(7));
    $category->addArticle($this->createMockArticle(8));
    $category->addArticle($this->createMockArticle(9));
    $category->addArticle($this->createMockArticle(10));
    $category->addArticle($this->createMockArticle(11));
    $category->addArticle($this->createMockArticle(12));
    return $category;
  }
  
  private function createMockArticle($id) {
    
    $articleLanguageVersion = new MockArticleLanguageVersion();
    $articleLanguageVersion->setLanguageId(1);
    
    $article = new MockArticle();
    $article->setId($id);
    $article->addLanguageVersion($articleLanguageVersion);
    
    $articleLanguageVersion->setArticle($article);
    
    return $article;
  }
}