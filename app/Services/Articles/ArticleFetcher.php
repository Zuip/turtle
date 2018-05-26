<?php namespace App\Services\Articles;

use App\Models\Articles\Article;

class ArticleFetcher {
  
  public function getWithId($articleId) {
    
    $article = Article::where('id', intval($articleId))->first();
    
    if($article === null) {
      throw new \App\Exceptions\ModelNotFoundException('Article does not exist!');
    }
    
    return $article;
  }
  
}
