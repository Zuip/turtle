<?php namespace App\Services\CRUD;

class ApiGet {
  
  private $code;
  private $data;
  private $rootPath;
  
  public function __construct($rootPath) {
    $this->code = null;
    $this->data = null;
    $this->rootPath = $rootPath;
  }
  
  public function callGet($url) {
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $this->rootPath . $url);
    
    $result = curl_exec($ch);
    
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    
    $this->code = $httpCode;
    $this->data = $result;
  }
  
  public function getCode() {
    return $this->code;
  }
  
  public function getData() {
    return json_decode(
      $this->data,
      true
    );
  }
}
