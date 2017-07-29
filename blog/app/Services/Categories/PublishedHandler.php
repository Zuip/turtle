<?php namespace App\Services\Categories;

class PublishedHandler {

  public function publishCategory($categoryId, $languageCode) {
    return $this->changePublishedState($categoryId, $languageCode, true);
  }
  
  public function unpublishCategory($categoryId, $languageCode) {
    return $this->changePublishedState($categoryId, $languageCode, false);
  }
  
  /*
   * Changes the publish state
   * Returns true or false depending on did the state change succeed
   */
  private function changePublishedState($categoryId, $languageCode, $published) {
    
    $languageFetcher = new \App\Services\Languages\LanguageFetcher();
    $language = $languageFetcher->getWithCode($languageCode);

    $categoryLanguageVersionFetcher = new \App\Services\Categories\LanguageVersionFetcher();
    $categoryLanguage = $categoryLanguageVersionFetcher->findWithCategoryId(
      $categoryId,
      $language
    );

    $categoryLanguage->published = $published;
    $categoryLanguage->save();
    
    return true;
  }
}