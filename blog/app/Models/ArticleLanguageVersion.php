<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleLanguageVersion extends Model {

	// The database table used by the model
	protected $table = 'articleText';

	// The attributes that are mass assignable
	protected $fillable = ['id', 'text', 'topic', 'urlname', 'languageId', 'articleId', 'published'];
  
  // No default timestamps
  public $timestamps = false;
  
	// The attributes excluded from the model's JSON form
	protected $hidden = [];
  
  //Returns base article of the language version
  public function article() {
    return $this->belongsTo('\\App\\Models\\Article', 'articleId');
  }
}