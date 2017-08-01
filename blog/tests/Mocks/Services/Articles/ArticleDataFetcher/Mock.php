<?php namespace Tests\Mocks\Services\Articles\ArticleDataFetcher;

use App\Models\Articles\IArticleLanguageVersion;
use App\Services\Articles\IArticleDataFetcher;

class Mock implements IArticleDataFetcher {
  
  private $limitToAttributes;
  
  public function __construct() {
    $this->limitToAttributes = array(
      "id", "topic", "URLName", "text", "published"
    );
  }
  
  public function limitToAttributes($limitToAttributes) {
    $this->limitToAttributes = $limitToAttributes;
  }
  
  public function getArticleData(IArticleLanguageVersion $articleLanguageVersion) {

    $articleData = array();
    if($this->chosen("id"         )) { $articleData["id"]          = $articleLanguageVersion->article->id;           }
    if($this->chosen("topic"      )) { $articleData["topic"]       = $articleLanguageVersion->topic;                 }
    if($this->chosen("URLName"    )) { $articleData["URLName"]     = $articleLanguageVersion->urlname;               }
    if($this->chosen("timestamp"  )) { $articleData["timestamp"]   = $articleLanguageVersion->article->timestamp;    }
    if($this->chosen("publishtime")) { $articleData["publishtime"] = $this->getPublishTime($articleLanguageVersion); }
    if($this->chosen("published"  )) { $articleData["published"]   = $articleLanguageVersion->published;             }
    if($this->chosen("text"       )) { $articleData["text"]        = $articleLanguageVersion->text;                  }
    if($this->chosen("textSummary")) { $articleData["textSummary"] = $this->getTextSummary($articleLanguageVersion); }
    if($this->chosen("path"       )) { $articleData["path"]        = "path";                                         }

    if($this->chosen("previousArticle")) { $articleData["previousArticle"] = "previous_article"; }
    if($this->chosen("nextArticle"))     { $articleData["nextArticle"]     = "next_article";     }
    
    return $articleData;
  }
  
  private function getPublishTime(IArticleLanguageVersion $articleLanguageVersion) {
    return date("j.n.Y", strtotime($articleLanguageVersion->article->timestamp));
  }
  
  private function getTextSummary(IArticleLanguageVersion $articleLanguageVersion) {
    return explode("[summary]", $articleLanguageVersion->text)[0];
  }
  
  private function chosen($attribute) {
    return in_array($attribute, $this->limitToAttributes);
  }
}