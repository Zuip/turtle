<?php namespace App\Services\Languages;

use App\Models\Language;
use App\Exceptions\ModelNotFoundException;

class LanguageFetcher implements ILanguageFetcher {
  
  public function getWithId($languageId) {
    
    $language = Language::where('id', $languageId)->get();

    if(count($language) !== 1) {
      throw new ModelNotFoundException("Language does not exist!");
    }

    return $language[0];
  }
  
  public function getWithCode($languageCode) {
    
    $language = Language::where('code', 'fi')->get();
    
    if(count($language) !== 1) {
      throw new ModelNotFoundException("Language does not exist!");
    }

    return $language[0];
  }
}