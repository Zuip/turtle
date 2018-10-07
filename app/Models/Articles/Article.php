<?php namespace App\Models\Articles;

use Illuminate\Database\Eloquent\Model;

class Article extends Model implements IArticle {

	// The database table used by the model
	protected $table = 'article';

	// The attributes that are mass assignable
	protected $fillable = ['id', 'user_id', 'latitude', 'longitude'];

	// The attributes excluded from the model's JSON form
	protected $hidden = [];
  
  // No default timestamps
  public $timestamps = false;
  
  public function languageVersions() {
    return $this->hasMany('\\App\\Models\\Articles\\ArticleLanguageVersion', 'article_id');
  }
  
  public function writer() {
    return $this->belongsTo('\\App\\User', 'user_id');
  }

  public function visit() {
    return $this->hasOne('\\App\\Models\\Trips\\Visit', 'article_id');
  }
}