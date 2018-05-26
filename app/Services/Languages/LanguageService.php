<?php namespace App\Services\Languages;

use App\Models\Language;

class LanguageService {
  
	/**
	 * Set locale to chosen language
	 */
	static public function setLocale($languageCode) {
    
    // Accepted languages
    $acceptedLanguages = array('fi', 'en');
    
    // Check that the chosen language is allowed
    if(in_array($languageCode, $acceptedLanguages)) {
      \Session::put('language', $languageCode);
    }
    
    if(\Session::get('language') == 'en') {
      \App::setLocale('en');
    } else {
      \App::setLocale('fi');
    }
	}
  
  /*
   * Return current language's id
   */
  static public function getCurrentLocaleId() {
    return Language::where('code', \Session::get('language'))->first()->id;
  }
  
  /*
   * Returns the information of does the selected language exist
   */
  static public function localeExists($locale) {
    return array_key_exists($locale, \Config::get('app.locales'));
  }
}