<?php namespace Tests\Mocks\Models\Language;

use App\Models\ILanguage;

class MockLanguage implements ILanguage {
  
  public $id;
  
  /*
   * Mock methods
   */
  
  public function setId($id) {
    $this->id = $id;
  }
}
