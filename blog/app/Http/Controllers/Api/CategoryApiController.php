<?php namespace App\Http\Controllers\Api;

class CategoryApiController {
  
  public function postCategory() {
    $categoryController = new \App\Http\Controllers\CategoryController();
    return $categoryController->categoryPOST();
  }
  
  public function publishCategory($categoryId, $languageCode) {
    
    $categoryController = new \App\Http\Controllers\CategoryController();
    $result = $categoryController->publishCategory($categoryId, $languageCode);

    if($result === true) {
      return \Response::json(array("OK" => true));
    }

    if(is_array($result) && isset($result['error'])) {
      return \Response::json(array("error" => $result['error']), 404);
    }

    return \Response::json(array("error" => "Unknown error"), 404);
  }
  
  public function unpublishCategory($categoryId, $languageCode) {
    
    $categoryController = new \App\Http\Controllers\CategoryController();
    $result = $categoryController->unpublishCategory($categoryId, $languageCode);

    if($result === true) {
      return \Response::json(array("OK" => true));
    }

    if(is_array($result) && isset($result['error'])) {
      return \Response::json(array("error" => $result['error']), 404);
    }

    return \Response::json(array("error" => "Unknown error"), 404);
  }
}