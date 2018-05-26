<?php namespace App\Services\Languages;

interface ILanguageFetcher {
  public function getWithId($languageId);
  public function getWithCode($languageCode);
}