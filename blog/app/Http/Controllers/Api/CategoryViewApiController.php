<?php namespace App\Http\Controllers\Api;

class CategoryViewApiController {

  public function get($categoryURLName, $language, $page = 1) {
    
    $categoryLanguageVersion = \App\Http\Controllers\CategoryController::findCategoryLanguageWithURLName($categoryURLName, $language, false);
    if(is_array($categoryLanguageVersion) && isset($categoryLanguageVersion['error'])) {
      return \Response::json(array("error" => $categoryLanguageVersion['error']), 404);
    }

    $articles = $this->getCategoryArticlesData($categoryLanguageVersion->category->id, $language, $page);

    return \Response::json(array(
      "texts" => array(
        "continueReading" => \Lang::get('views.category.continueReading', array(), $language)
      ),
      "category" => array(
        "id" => $categoryLanguageVersion->category->id,
        "description" => $categoryLanguageVersion->description,
        "name" => $categoryLanguageVersion->name,
        "urlname" => $categoryLanguageVersion->urlname,
        "published" => $categoryLanguageVersion->published,
        "amountOfArticles" => $this->getCategoryPublishedArticlesCount($categoryLanguageVersion->category->id),
        "articles" => $articles
      )
    ));
  }
  
  private function getCategoryArticlesData($categoryId, $language, $page) {
    return \App\Http\Controllers\ArticleController::getCategoryArticlesData(
      $categoryId,
      $language,
      false,
      array('id', 'topic', 'textsummary', 'timestamp', 'publishtime', 'urlname', 'offset', 'previous'),
      array('amount' => 10, 'offset' => ($page - 1) * 10),
      true
    );
  }
  
  private function getCategoryPublishedArticlesCount($categoryId) {
    return \DB::table('category')
    ->join('article', 'category.id', '=', 'article.category_id')
    ->join('articletext', 'article.id', '=', 'articletext.article_id')
    ->select('article.*')
    ->where('category_id', $categoryId)
    ->where('articletext.published', '1')
    ->count();
  }
}