<?php namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Category;
use App\Models\Article;
use App\Models\ArticleLanguageVersion;
use App\Http\Controllers\LanguageController;

class ArticleController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
    
	}
  
  public static function createArticle($categoryId, $languageCode, $topic, $text, $URLName, $published, $publishtime) {
    
    // Find language id by language code
    $languageId = LanguageController::getLocaleIdByCode($languageCode);
    if($languageId === false) {
      return array('error' => 'Language version does not exist!');
    }
    
    // Find category
    $category = Category::where('id', intval($categoryId))->first();
    if($category == NULL) {
      return array('error' => 'Category does not exist!');
    }
    
    // Find language version of category
    $categoryLanguageVersion = $category->languageVersions()->first();
    if($categoryLanguageVersion == NULL) {
      return array('error' => 'Language version of the category does not exist!');
    }
    
    // Check that the URL name is not already used
    if(ArticleLanguageVersion::where('urlname', $URLName)->first() != NULL) {
      return array('error' => 'URL name already in use!');
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
  
  public static function editArticle($articleId, $languageCode, $topic, $text, $URLName, $published, $publishtime) {
    
    // Find language id by language code
    $languageId = LanguageController::getLocaleIdByCode($languageCode);
    if($languageId === false) {
      return array('error' => 'Language version does not exist!');
    }
    
    // Find article
    $article = Article::where('id', intval($articleId))->first();
    if($article == NULL) {
      return array('error' => 'Article does not exist!');
    }
    
    $date = \DateTime::createFromFormat('d.m.Y', $publishtime);
    if($date) {
      $article->timestamp = $date;
      $article->save();
    }
    
    // Find language version of article
    $articleLanguageVersion = $article->languageVersions()->first();
    if($articleLanguageVersion == NULL) {
      return array('error' => 'Language version of the article does not exist!');
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
  
  public static function getCategoryArticlesData($categoryId, $languageCode, $includeUnpublished = false, $attributes = NULL, $articlesInterval = NULL) {
    
    // Find language id
    $languageId = LanguageController::getLocaleIdByCode($languageCode);
    if($languageId === false) {
      return array('error' => 'Language version does not exist!');
    }
    
    // Find category
    $category = Category::where('id', intval($categoryId))->first();
    if($category == NULL) {
      return array('error' => 'Category does not exist!');
    }
    
    // Find articles
    $articles = $category->articles()->orderBy('timestamp');
    
    // Variables needed for getting chosen articles
    $articleLoopCount = 0;
    $selectedArticlesCount = 0;
    
    // Find article language versions
    $articleLanguageVersions = array();
    foreach($articles->get() as $article) {
      
      $languageVersion = $article->languageVersions()->where('language_id', $languageId)->first();
      
      // If correct language version was not found, skip
      if($languageVersion == NULL) {
        continue;
      }
      
      // Check if the unpublished should be included in the list
      if(!$languageVersion->published && !$includeUnpublished) {
        continue;
      }
      
      // If articles interval is chosen, heighten the counters and check if the
      // article should be returned
      if($articlesInterval != NULL) {
        
        ++$articleLoopCount;
        
        if($articlesInterval["offset"] >= $articleLoopCount) {
          continue;
        }
        
        ++$selectedArticlesCount;
      }
      
      // Assign selected attributes of the article to the result array
      $tempArticle = array();
      if($attributes == NULL || in_array('id',          $attributes)) { $tempArticle['id']          = $article->id;                                             }
      if($attributes == NULL || in_array('topic',       $attributes)) { $tempArticle['topic']       = $languageVersion->topic;                                  }
      if($attributes == NULL || in_array('urlname',     $attributes)) { $tempArticle['urlname']     = $languageVersion->urlname;                                }
      if($attributes == NULL || in_array('published',   $attributes)) { $tempArticle['published']   = intval($languageVersion->published) === 1 ? true : false; }
      if($attributes == NULL || in_array('timestamp',   $attributes)) { $tempArticle['timestamp']   = $article->timestamp;                                      }
      if($attributes == NULL || in_array('text',        $attributes)) { $tempArticle['text']        = $languageVersion->text;                                   }
      if($attributes == NULL || in_array('textsummary', $attributes)) {
        $tempArticle['textsummary'] = explode("[summary]", $languageVersion->text)[0];
      }
      if($attributes == NULL || in_array('publishtime', $attributes)) {
        $tempArticle['publishtime'] = date("j.n.Y", strtotime($article->timestamp));
      }
      
      if($articlesInterval != NULL && in_array('offset', $attributes)) {
        $tempArticle['offset'] = $articleLoopCount - 1;
      }

      $articleLanguageVersions[$article->id] = $tempArticle;
      
      if($articlesInterval != NULL && $articlesInterval["amount"] <= $selectedArticlesCount) {
        break;
      }
    }
    
    return $articleLanguageVersions;
  }
  
  public static function getFrontpageArticlesData($languageCode) {
    
    $frontpageArticlesData = array();
    
    // Find language id
    $languageId = LanguageController::getLocaleIdByCode($languageCode);
    if($languageId === false) {
      return array('error' => 'Language version does not exist!');
    }
    
    // Find latest article
    $latestArticle = Article::orderBy('timestamp', 'DESC')
                     ->join('articletext', 'articletext.article_id', '=', 'article.id')
                     ->where('articletext.language_id', $languageId)
                     ->where('articletext.published', true)
                     ->first();
    
    if($latestArticle === NULL) {
      return array('error' => 'No articles exists!');
    }

    $latestArticleData = self::getArticleData($latestArticle->article_id, $languageCode);
    $latestArticleData['textSummary'] = explode("[summary]", $latestArticleData['text'])[0];
    $latestArticleData['boxTopic'] = \Lang::get('views.home.latestArticle', array(), $languageCode);
    
    // Find first article
    $firstArticle = Article::orderBy('timestamp')
                    ->join('articletext', 'articletext.article_id', '=', 'article.id')
                    ->where('articletext.language_id', $languageId)
                    ->where('articletext.published', true)
                    ->first();
    
    if($firstArticle === NULL) {
      return array('error' => 'No articles exists!');
    }
    $firstArticleData = self::getArticleData($firstArticle->article_id, $languageCode);
    $firstArticleData['textSummary'] = explode("[summary]", $firstArticleData['text'])[0];
    $firstArticleData['boxTopic'] = \Lang::get('views.home.startFromBeginning', array(), $languageCode);
    
    $frontpageArticlesData['latestArticle'] = $latestArticleData;
    $frontpageArticlesData['firstArticle'] = $firstArticleData;
    
    foreach($frontpageArticlesData as $articleClass => $frontpageArticleData) {
      foreach($frontpageArticleData as $key => $articleField) {
        if(!in_array($key, array("boxTopic", "topic", "URLName", "publishtime", "textSummary"))) {
          unset($frontpageArticlesData[$articleClass][$key]);
        }
      }
    }
    
    return $frontpageArticlesData;
  }
  
  public static function getArticlePath($article, $languageId) {
    
    $articlePath = array();
      
    $currentCategory = $article->category;

    while(true) {
      
      // Find data of this category
      $languageVersion = $currentCategory->languageVersions()->where('language_id', $languageId)->first();
      if($languageVersion == NULL) {
        return array('error' => 'Chosen language version of the category does not exist!');
      }

      $categoryData = array('id' => $currentCategory->id, 'name' => $languageVersion->name, 'URLName' => $languageVersion->urlname);
      array_unshift($articlePath , $categoryData);
      
      // Find deeper category path if it exists
      if($currentCategory->parentCategory === NULL) {
        break;
      } else {
        $currentCategory = $currentCategory->parentCategory;
      }
    }
    
    return $articlePath;
  }
  
  public static function getArticleDataByURLName($articleURLName, $languageCode, $allowUnpublished = false) {
    
    // Find article language version
    if($allowUnpublished) {
      $articleLanguageVersion = ArticleLanguageVersion::where('urlname', $articleURLName)->first();
    } else {
      $articleLanguageVersion = ArticleLanguageVersion::where('published', 1)->where('urlname', $articleURLName)->first();
    }
    
    // Check that the article language version was found
    if($articleLanguageVersion == NULL) {
      return array('error' => 'Article language version does not exist!');
    }
    
    return self::getArticleData($articleLanguageVersion->article_id, $languageCode);
  }
  
  public static function getArticleData($articleId, $languageCode) {
    
    // Find language id
    $languageId = LanguageController::getLocaleIdByCode($languageCode);
    if($languageId === false) {
      return array('error' => 'Language version does not exist!');
    }
    
    // Find article
    $article = Article::where('id', intval($articleId))->first();
    if($article === NULL) {
      return array('error' => 'Article does not exist!');
    }
    
    // Find correct language version of the article
    $articleLanguageVersion = $article->languageVersions()->where('language_id', $languageId)->first();
    if($articleLanguageVersion === NULL) {
      return array('error' => 'Chosen language version of the article does not exist!');
    }

    // Find article's category path
    $articlePath = self::getArticlePath($article, $languageId);
    if(isset($articlePath['error'])) {
      return $articlePath;
    }
    
    // Find previous article
    $previousArticle = Article::orderBy('timestamp', 'DESC')
                       ->join('articletext', 'articletext.article_id', '=', 'article.id')
                       ->where('article.timestamp', '<', $article->timestamp)
                       ->where('articletext.language_id', $languageId)
                       ->where('articletext.published', true)
                       ->first();
    
    $previousArticleUrlName = NULL;
    if($previousArticle !== NULL) {
      $previousArticleUrlName = $previousArticle->urlname;
    }
    
    // Find next article
    $nextArticle = Article::orderBy('timestamp')
                   ->join('articletext', 'articletext.article_id', '=', 'article.id')
                   ->where('article.timestamp', '>', $article->timestamp)
                   ->where('articletext.language_id', $languageId)
                   ->where('articletext.published', true)
                   ->first();
    
    $nextArticleUrlName = NULL;
    if($nextArticle !== NULL) {
      $nextArticleUrlName = $nextArticle->urlname;
    }
    
    return array(
      "id"              => $article->id,
      "topic"           => $articleLanguageVersion->topic,
      "URLName"         => $articleLanguageVersion->urlname,
      "text"            => $articleLanguageVersion->text,
      "published"       => $articleLanguageVersion->published,
      "path"            => $articlePath,
      "publishtime"     => date("j.n.Y", strtotime($article->timestamp)),
      "previousArticle" => $previousArticleUrlName,
      "nextArticle"     => $nextArticleUrlName
    );
  }
}