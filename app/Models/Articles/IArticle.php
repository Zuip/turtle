<?php namespace App\Models\Articles;

interface IArticle {
  public function languageVersions();
  public function writer();
}