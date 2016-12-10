<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	// The database table used by the model
	protected $table = 'article';

	// The attributes that are mass assignable
	protected $fillable = ['id', 'categoryId', 'userId', 'timestamp'];

	// The attributes excluded from the model's JSON form
	protected $hidden = [];
  
  // No default timestamps
  public $timestamps = false;
  
  // Returns article's language versions
  public function languageVersions() {
    return $this->hasMany('\\App\\Models\\ArticleLanguageVersion', 'articleId');
  }
  
  //Returns the writer of the article
  public function writer() {
    return $this->belongsTo('\\App\\User', 'userId');
  }
  
  //Returns the category of the article
  public function category() {
    return $this->belongsTo('\\App\\Models\\Category', 'categoryId');
  }
}