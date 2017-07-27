<?php namespace App\Http\Controllers\Api;

class CategoryApiController {
  
  public function postCategory() {
    $categoryController = new \App\Http\Controllers\CategoryController();
    return $categoryController->categoryPOST();
  }
  
  public function publishCategory($categoryId, $languageCode) {
    
    $categoryPublishedHandler = new \App\Services\Categories\PublishedHandler();
    $result = $categoryPublishedHandler->publishCategory($categoryId, $languageCode);

    if($result) {
      return \Response::json(array("OK" => true));
    } else {
      return \Response::json(
        array("error" => "Language version of the category does not exist!"),
        404
      );
    }

    return \Response::json(array("error" => "Unknown error"), 404);
  }
  
  public function unpublishCategory($categoryId, $languageCode) {
    
    $categoryPublishedHandler = new \App\Services\Categories\PublishedHandler();
    $result = $categoryPublishedHandler->unpublishCategory($categoryId, $languageCode);

    if($result === true) {
      return \Response::json(array("OK" => true));
    } else {
      return \Response::json(
        array("error" => "Language version of the category does not exist!"),
        404
      );
    }

    return \Response::json(array("error" => "Unknown error"), 404);
  }
}