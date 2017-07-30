<?php namespace App\Http\Controllers;

use App\Models\Categories\Category;
use App\Models\Categories\CategoryLanguageVersion;
use App\Models\Language;

class CategoryController extends Controller {
  
  // REST api POST operation handling
  public function categoryPOST() {
    
    // Retrieve the needed parameters
    if(\Input::has('name') && \Input::has('description') && \Input::has('URLName') && \Input::has('parentId')) {
      $name = \Input::get('name');
      $description = \Input::get('description');
      $URLName = \Input::get('URLName');
      $parentId = \Input::get('parentId');
    } else {
      return \Response::json(array('error' => 'Missing POST parameters'), 404);
    }
    
    // Create category
    $category = new Category;
    $category->menu_weight = Category::max('menu_weight') + 1;
    
    // Set parent id to the category
    if($parentId === "root") {
      $category->parent_id = NULL;
    } elseif(Category::where('id', intval($parentId))->count() > 0) {
      $category->parent_id = intval($parentId);
    } else {
      throw new \App\Exceptions\ModelNotFoundException('Chosen parent does not exist!');
    }
    
    $category->save();
    
    // Add language versions of the category
    foreach(Language::all() as $language) {
      $categoryLanguage = new CategoryLanguageVersion;
      $categoryLanguage->name = $name;
      $categoryLanguage->description = $description;
      $categoryLanguage->urlname = $URLName;
      $categoryLanguage->published = false;
      $categoryLanguage->language_id = $language->id;
      $categoryLanguage->category_id = $category->id;
      $categoryLanguage->save();
    }
    
    return \Response::json(array('success' => 'Creating a category succeeded!'));
  }
  
  public function categoryPUT() {
    
    // Retrieve the needed parameters
    if(\Input::has('id') && \Input::has('name') && \Input::has('description') && \Input::has('urlname') && \Input::has('language')) {
      $id = \Input::get('id');
      $name = \Input::get('name');
      $description = \Input::get('description');
      $URLName = \Input::get('urlname');
      $languageCode = \Input::get('language');
    } else {
      return \Response::json(array('error' => 'Missing PUT parameters'), 404);
    }
    
    $languageFetcher = new \App\Services\Languages\LanguageFetcher();
    $language = $languageFetcher->getWithCode($languageCode);

    $categoryLanguageVersionFetcher = new \App\Services\Categories\LanguageVersionFetcher();
    $categoryLanguage = $categoryLanguageVersionFetcher->findWithCategoryId(
      $id,
      $language
    );
    
    // Check that the URL name is not in use for other categories
    if(CategoryLanguageVersion::where('urlname', $URLName)->where('category_id', '!=', $categoryLanguage->category_id)->count() > 0) {
      return \Response::json(array('error' => 'URL name is already in use.'));
    }
    
    $categoryLanguage->name = $name;
    $categoryLanguage->description = $description;
    $categoryLanguage->urlname = $URLName;
    $categoryLanguage->save();
    
    return \Response::json(array('success' => 'Editing a category language version succeeded!'));
  }
}