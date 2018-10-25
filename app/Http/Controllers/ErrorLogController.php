<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class ErrorLogController extends Controller {

  private $filename;
  private $maxRows;

  public function __construct() {
    $this->filename = "../storage/logs/frontend_errors.txt";
    $this->maxRows = 100;
  }

  public function post(Request $request) {

    // Log erros and keep the last 100 lines of the log

    $filesize = filesize($this->filename);
    
    $rows = [];

    if($filesize > 0) {
      $fpr = fopen($this->filename, "r");
      $contents = fread($fpr, $filesize);
      $rows = explode("\n", $contents);
      fclose($fpr);
    }
    
    $newContent = $this->getNewContent($request->input('errorText'));

    $newContentRows = explode("\n", $newContent);

    foreach($newContentRows as $newContentRow) {
      $rows[] = $newContentRow;
    }

    $fpw = fopen($this->filename, "w");
    fwrite($fpw, $this->getCombinedFileContent($rows));
    fclose($fpw);

    return Response::json([]);
  }

  private function getCombinedFileContent($rows) {

    $finalRows = [];

    for($i = count($rows) - $this->maxRows; $i < count($rows); $i++) {

      if(!isset($rows[$i])) {
        continue;
      }

      $finalRows[] = $rows[$i];
    }

    return implode("\n", $finalRows);
  }

  private function getNewContent($errorText) {
    return "\n"
      . "\n"
      . date("Y-m-d h:i", time()) . ":\n"
      . $errorText;
  }
}