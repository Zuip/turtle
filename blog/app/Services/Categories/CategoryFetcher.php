<?php namespace App\Services\Categories;

use App\Models\Categories\Category;

class CategoryFetcher {
  
  public function getWithId($categoryId) {
    
    $category = Category::where('id', intval($categoryId))->first();
    
    if($category == null) {
      throw new \App\Exceptions\ModelNotFoundException(
        'Category does not exist!'
      );
    }
    
    return $category;
  }
}