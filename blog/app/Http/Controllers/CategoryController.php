<?php namespace App\Http\Controllers;

use App\Models\Categories\Category;
use App\Models\Categories\CategoryLanguageVersion;
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
  
  // Finding category's name by category id and language code
  public static function getCategoryNameByIdAndLanguage($categoryId, $languageCode) {
    
    $languageId = LanguageController::getLocaleIdByCode($languageCode);
    
    $category = Category::where('id', intval($categoryId))->first();
    if($category == NULL) {
      throw new \App\Exceptions\ModelNotFoundException('Category does not exist!');
    }
    
    $categoryName = $category->languageVersions()->where('language_id', $languageId)->first()->name;
    if($categoryName == NULL) {
      throw new \App\Exceptions\ModelNotFoundException('Language version of category does not exist!');
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
    
    
    try {
      
      $languageFetcher = new \App\Services\Languages\LanguageFetcher();
      $language = $languageFetcher->getWithCode($languageCode);
      
      $categoryLanguageVersionFetcher = new \App\Services\Categories\LanguageVersionFetcher();
      $categoryLanguage = $categoryLanguageVersionFetcher->findWithCategoryId(
        $id,
        $language
      );
    } catch(\App\Exceptions\ModelNotFoundException $e) {
      return \Response::json(array("error", $e->getMessage()), 404);
    }
    
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
}