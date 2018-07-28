<?php namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;

class ArticleLanguageVersion extends Model implements IArticleLanguageVersion {

  // The database table used by the model
  protected $table = 'translated_article';

  // The attributes that are mass assignable
  protected $fillable = ['id', 'topic', 'summary', 'text', 'url_name', 'language_id', 'article_id', 'published'];
  
  // No default timestamps
  public $timestamps = false;
  
  // The attributes excluded from the model's JSON form
  protected $hidden = [];
  
  public function article() {
    return $this->belongsTo('\\App\\Models\\Articles\\Article', 'article_id');
  }
  
  public function language() {
    return $this->belongsTo('\\App\\Models\\Language', 'language_id');
  }
}