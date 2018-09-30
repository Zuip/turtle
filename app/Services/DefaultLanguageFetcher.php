<?php

namespace App\Services;

class DefaultLanguageFetcher {

  private $httpAcceptLanguage;
  private $sessionLanguage;

  public function __construct() {
    $this->httpAcceptLanguage = null;
    $this->sessionLanguage = null;
  }

  public function setHttpAcceptLanguage($httpAcceptLanguage) {
    $this->httpAcceptLanguage = $httpAcceptLanguage;
  }

  public function setSessionLanguage($sessionLanguage) {
    $this->sessionLanguage = $sessionLanguage;
  }

  public function getDefaultLanguage() {

    if($this->sessionLanguage !== null) {
      return $this->sessionLanguage;
    }

    if($this->httpAcceptLanguage === null) {
      return 'en';
    }

    $browserLanguage = 'en';
    $supportedLanguages = [
      'en' => ['en', 'en-US', 'en-GB'],
      'fi' => ['fi', 'fi-FI']
    ];
    $languages = explode(',', $this->httpAcceptLanguage);
    $languageFound = false;

    foreach($languages as $languageWithQ) {

      $languageAndQ = explode(';', $languageWithQ);
      $language = $languageAndQ[0];
      
      foreach($supportedLanguages as $languageCode => $browserLanguageCodes) {
        foreach($browserLanguageCodes as $browserLocaleCode) {
          if(strtolower($browserLocaleCode) === strtolower($language)) {
            return $languageCode;
          }
        }
      }
    }

    return 'en';
  }
}