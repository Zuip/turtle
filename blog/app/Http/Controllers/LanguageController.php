<?php namespace App\Http\Controllers;

class LanguageController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
    
	}
  
  public function setLocale() {
    if(\Session::get('language') == 'en') {
      \App::setLocale('en');
    } else {
      \App::setLocale('fi');
    }
  }

	/**
	 * Change locale to chosen language
	 *
	 * @return void
	 */
	public function changeLocale($languageCode) {
    
    // Accepted languages
    $acceptedLanguages = array('fi', 'en');
    
    // Check that the chosen language is allowed
    if(in_array($languageCode, $acceptedLanguages)) {
      \Session::put('language', $languageCode);
      return true;
    }
    
    return false;
	}
  
  /*
   * Return current language's id
   */
  static public function getCurrentLocaleId() {
    return \App\Models\Language::where('code', \Session::get('language'))->first()->id;
  }

  /* 
   * Returns locale's id
   */
  static public function getLocaleIdByCode($languageCode) {
    
    $language = \App\Models\Language::where('code', $languageCode)->first();
    if($language == NULL) {
      return false;
    }
    
    return $language->id;
  }
  
  /*
   * Returns the information of does the selected language exist
   */
  static public function localeExists($locale) {
    return array_key_exists($locale, \Config::get('app.locales'));
  }
}