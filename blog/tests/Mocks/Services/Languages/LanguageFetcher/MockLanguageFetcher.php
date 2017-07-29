<?php namespace Tests\Mocks\Services\Languages\LanguageFetcher;

use App\Services\Languages\ILanguageFetcher;
use Tests\Mocks\Models\Language\MockLanguage;

class MockLanguageFetcher implements ILanguageFetcher {
  
  public function getWithCode($languageCode) { }
  
  public function getWithId($languageId) {
    $mockLanguage = new MockLanguage();
    $mockLanguage->setId($languageId);
    return $mockLanguage;
  }
}