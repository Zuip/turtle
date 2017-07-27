<?php namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryLanguageVersion;
use App\Models\Language;

class CategoryController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
    
	}
  
  /*
   * Finds categories and returns their data in array with hierarchy
   */
  public static function getCategories($languageCode = 'fi', $unpublished = false, $parent = null) {
    
    // A variable where the function result is placed
    $categoryHierarchy = array();
    
    // We need the id for the language code to make queries
    $localeId = LanguageController::getLocaleIdByCode($languageCode);
    
    // Fetch all categories with chosen parent id
    $categories = Category::where('parent_id', $parent)->get();
    
    // Loop through all category and fetch the needed information for them
    foreach($categories as $category) {
      
      // Fetch the language information
      if($unpublished) {
        $categoryLanguageVersions = CategoryLanguageVersion::where('category_id', $category->id)->where('language_id', $localeId)->get();
      } else {
        $categoryLanguageVersions = CategoryLanguageVersion::where('category_id', $category->id)->where('language_id', $localeId)->where('published', true)->get();
      }
      
      // If matching language version was not found, skip to next phase of the loop
      if($categoryLanguageVersions->isEmpty()) {
        continue;
      }
      
      $categoryLanguageVersion = $categoryLanguageVersions->first();
      
      // Add category to the array
      $categoryId = $category->id;
      $categoryHierarchy[$categoryId] = array();
      $categoryHierarchy[$categoryId]['name'] = $categoryLanguageVersion->name;
      $categoryHierarchy[$categoryId]['id'] = $category->id;
      $categoryHierarchy[$categoryId]['description'] = $categoryLanguageVersion->description;
      $categoryHierarchy[$categoryId]['urlname'] = $categoryLanguageVersion->urlname;
      $categoryHierarchy[$categoryId]['languageVersionId'] = $categoryLanguageVersion->id;
      
      if($unpublished) {
        $categoryHierarchy[$categoryId]['published'] = $categoryLanguageVersion->published;
      }
      
      // Fetch children
      $categoryHierarchy[$categoryId]['children'] = self::getCategories($languageCode, $unpublished, $categoryId);
    }
    
    return $categoryHierarchy;
  }
  
  // Finding category's name by category id and language code
  public static function getCategoryNameByIdAndLanguage($categoryId, $languageCode) {
    
    $languageId = LanguageController::getLocaleIdByCode($languageCode);
    if($languageId === false) {
      return array('error' => 'Language version does not exist!');
    }
    
    $category = Category::where('id', intval($categoryId))->first();
    if($category == NULL) {
      return array('error' => 'Category does not exist!');
    }
    
    $categoryName = $category->languageVersions()->where('language_id', $languageId)->first()->name;
    if($categoryName == NULL) {
      return array('error' => 'Language version of category does not exist!');
    }
    
    return $categoryName;
  }
  
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
      return \Response::json(array('error' => 'Chosen parent does not exist!'), 400);
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
    
    $categoryLanguageVersionFetcher = new \App\Services\Categories\LanguageVersionFetcher();
    $categoryLanguage = $categoryLanguageVersionFetcher->findWithCategoryId(
      $id,
      $languageCode
    );
    
    // Check if there was errors with finding the language version of category
    if(!isset($categoryLanguage)) {
      return \Response::json(array("error", "Language version of the category does not exist!"));
    }
    
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
  
  // Function for publishing a category
  public function publishCategory($categoryId, $languageCode) {
    
    // Search the category language object
    $categoryLanguageVersionFetcher = new \App\Services\Categories\LanguageVersionFetcher();
    $categoryLanguage = $categoryLanguageVersionFetcher->findWithCategoryId(
      $categoryId,
      $languageCode
    );
    
    // Check if there was an error and if there was, return it
    if(!isset($categoryLanguage)) {
      return false;
    }
    
    // Publish the chosen language version of the category
    $categoryLanguage->published = true;
    $categoryLanguage->save();
    
    return true;
  }
  
  // Function for unpuiblishing a category
  public function unpublishCategory($categoryId, $languageCode)
  {    
    // Search the category language object
    $categoryLanguageVersionFetcher = new \App\Services\Categories\LanguageVersionFetcher();
    $categoryLanguage = $categoryLanguageVersionFetcher->findWithCategoryId(
      $categoryId,
      $languageCode
    );
    
    // Check if there was an error and if there was, return it
    if(!isset($categoryLanguage)) {
      return false;
    }
    
    // Publish the chosen language version of the category
    $categoryLanguage->published = false;
    $categoryLanguage->save();
    
    return true;
  }
}