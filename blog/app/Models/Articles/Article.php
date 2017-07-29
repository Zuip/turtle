<?php namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;

class Article extends Model implements IArticle {

	// The database table used by the model
	protected $table = 'article';

	// The attributes that are mass assignable
	protected $fillable = ['id', 'category_id', 'user_id', 'timestamp'];

	// The attributes excluded from the model's JSON form
	protected $hidden = [];
  
  // No default timestamps
  public $timestamps = false;
  
  // Returns article's language versions
  public function languageVersions() {
    return $this->hasMany('\\App\\Models\\Articles\\ArticleLanguageVersion', 'article_id');
  }
  
  //Returns the writer of the article
  public function writer() {
    return $this->belongsTo('\\App\\User', 'user_id');
  }
  
  //Returns the category of the article
  public function category() {
    return $this->belongsTo('\\App\\Models\\Categories\\Category', 'category_id');
  }
}