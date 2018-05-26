<?php namespace Tests\TestCases\Services\Articles;

use PHPUnit\Framework\TestCase;
use Tests\Mocks\Models\Articles\Article\MockArticle;
use Tests\Mocks\Models\Articles\ArticleLanguageVersion\MockArticleLanguageVersion;
use Tests\Mocks\Models\Categories\Category\MockCategory;
use Tests\Mocks\Models\Categories\CategoryLanguageVersion\MockCategoryLanguageVersion;
use Tests\Mocks\Services\Languages\LanguageFetcher\MockLanguageFetcher;
use Tests\Mocks\Services\Categories\LanguageVersionFetcher\Mock as MockCategoryLanguageVersionFetcher;

class ArticlePathFetcherTests extends TestCase {
  
  public function testArticlePathGeneration() {
    
    $articlePathFetcher = new \App\Services\Articles\ArticlePathFetcher();
    
    $articlePathFetcher->setLanguageFetcher(
      new MockLanguageFetcher()
    );
    
    $articlePathFetcher->setCategoryLanguageVersionFetcher(
      $this->generateCategoryLanguageVersionFetcher()
    );
    
    $articlePath = $articlePathFetcher->getArticlePath(
      $this->generateArticleLanguageVersion()
    );

    $this->assertTrue($articlePath === $this->expectedArticlePath());
  }
  
  private function expectedArticlePath() {
    return array(
      array(
        'id' => 1,
        'name' => 'Mock category 1',
        'URLName' => 'mock-category-1'
      ),
      array(
        'id' => 2,
        'name' => 'Mock category 2',
        'URLName' => 'mock-category-2'
      ),
      array(
        'id' => 3,
        'name' => 'Mock category 3',
        'URLName' => 'mock-category-3'
      )
    );
  }
  
  private function generateArticleLanguageVersion() {
    
    $mockCategory1 = new MockCategory();
    $mockCategory1->setId(1);
    
    $mockCategory2 = new MockCategory();
    $mockCategory2->setId(2);
    $mockCategory2->setParentCategory($mockCategory1);
    
    $mockCategory3 = new MockCategory();
    $mockCategory3->setId(3);
    $mockCategory3->setParentCategory($mockCategory2);
    
    $mockArticle = new MockArticle();
    $mockArticle->setCategory($mockCategory3);
    
    $mockArticleLanguageVersion = new MockArticleLanguageVersion();
    $mockArticleLanguageVersion->setLanguageId(1);
    $mockArticleLanguageVersion->setArticle($mockArticle);
    
    return $mockArticleLanguageVersion;
  }
  
  private function generateCategoryLanguageVersionFetcher() {
    
    $mockCategoryLanguageVersion1 = new MockCategoryLanguageVersion();
    $mockCategoryLanguageVersion1->setName("Mock category 1");
    $mockCategoryLanguageVersion1->setURLName("mock-category-1");
    $mockCategoryLanguageVersion1->setCategoryId(1);
    
    $mockCategoryLanguageVersion2 = new MockCategoryLanguageVersion();
    $mockCategoryLanguageVersion2->setName("Mock category 2");
    $mockCategoryLanguageVersion2->setURLName("mock-category-2");
    $mockCategoryLanguageVersion2->setCategoryId(2);
    
    $mockCategoryLanguageVersion3 = new MockCategoryLanguageVersion();
    $mockCategoryLanguageVersion3->setName("Mock category 3");
    $mockCategoryLanguageVersion3->setURLName("mock-category-3");
    $mockCategoryLanguageVersion3->setCategoryId(3);
    
    $mockCategoryLanguageVersionFetcher = new MockCategoryLanguageVersionFetcher();
    $mockCategoryLanguageVersionFetcher->addCategorylanguageVersion($mockCategoryLanguageVersion1);
    $mockCategoryLanguageVersionFetcher->addCategorylanguageVersion($mockCategoryLanguageVersion2);
    $mockCategoryLanguageVersionFetcher->addCategorylanguageVersion($mockCategoryLanguageVersion3);
    return $mockCategoryLanguageVersionFetcher;
  }

}
