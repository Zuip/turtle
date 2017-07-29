<?php namespace App\Services\Categories;

use App\Models\Categories\ICategory;
use App\Models\ILanguage;

interface ILanguageVersionFetcher {
  public function findWithURLName($categoryURLName, ILanguage $language, $includeUnpublished = true);
  public function findWithCategoryId($categoryId, ILanguage $language, $includeUnpublished = true);
  public function findWithCategory(ICategory $category, ILanguage $language, $includeUnpublished = true);
}