<?php namespace App\Models\Categories;

interface ICategory {
  public function languageVersions();
  public function children();
  public function articles();
  public function parentCategory();
}