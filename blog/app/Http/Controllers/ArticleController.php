<?php namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Categories\Category;
use App\Models\Articles\Article;
use App\Models\Articles\ArticleLanguageVersion;
use App\Http\Controllers\LanguageController;

class ArticleController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
    
	}
  
  public function createArticle($categoryId, $languageCode, $topic, $text, $URLName, $published, $publishtime) {
    
    // Find language id by language code
    $languageId = LanguageController::getLocaleIdByCode($languageCode);
    
    // Find category
    $category = Category::where('id', intval($categoryId))->first();
    if($category == NULL) {
      throw new \App\Exceptions\ModelNotFoundException('Category does not exist!');
    }
    
    // Find language version of category
    $categoryLanguageVersion = $category->languageVersions()->first();
    if($categoryLanguageVersion == NULL) {
      throw new \App\Exceptions\ModelNotFoundException('Language version of the category does not exist!');
    }
    
    // Check that the URL name is not already used
    if(ArticleLanguageVersion::where('urlname', $URLName)->first() != NULL) {
      throw new \App\Exceptions\ModelNotFoundException('URL name already in use!');
    }
    
    // Create article
    $article = new Article;
    $article->category_id = $category->id;
    $article->user_id = \Auth::user()->id;
    
    $date = \DateTime::createFromFormat('d.m.Y', $publishtime);
    if($date) {
      $article->timestamp = $date;
    }
    
    $article->save();
    
    // Create language versions for all languages, only accept publishing for chosen language
    foreach(Language::all() as $language) {
    
      // Create article language version
      $articleLanguageVersion = new ArticleLanguageVersion;
      $articleLanguageVersion->topic = $topic;
      $articleLanguageVersion->urlname = $URLName;
      $articleLanguageVersion->text = $text;
      $articleLanguageVersion->language_id = $language->id;
      $articleLanguageVersion->article_id = $article->id;

      // Publish the article if chosen language id and user wants to publish it
      if($published == "1" && $language->id == $languageId) {
        $articleLanguageVersion->published = true;
      } else {
        $articleLanguageVersion->published = false;
      }

      $articleLanguageVersion->save();
    }
    
    // Creating article succeeded, return article id
    return array("articleId" => $article->id);
  }
  
  public function editArticle($articleId, $languageCode, $topic, $text, $URLName, $published, $publishtime) {
    
    // Find language id by language code
    $languageId = LanguageController::getLocaleIdByCode($languageCode);
    
    // Find article
    $articleFetcher = new \App\Services\Articles\ArticleFetcher();
    $article = $articleFetcher->getWithId($articleId);
    
    $date = \DateTime::createFromFormat('d.m.Y', $publishtime);
    if($date) {
      $article->timestamp = $date;
      $article->save();
    }
    
    // Find language version of article
    $articleLanguageVersion = $article->languageVersions()->first();
    if($articleLanguageVersion == NULL) {
      throw new \App\Exceptions\ModelNotFoundException('Language version of the article does not exist!');
    }
    
    // Edit article language version
    $articleLanguageVersion->topic = $topic;
    $articleLanguageVersion->urlname = $URLName;
    $articleLanguageVersion->text = $text;
    if($published == "1") {
      $articleLanguageVersion->published = true;
    } else {
      $articleLanguageVersion->published = false;
    }
    
    $articleLanguageVersion->save();
    
    return true;
  }
}