<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	// The database table used by the model.
	protected $table = 'category';

	// The attributes that are mass assignable.
	protected $fillable = ['id', 'menuWeight', 'parentId'];

	// The attributes excluded from the model's JSON form.
	protected $hidden = [];
  
  // No default timestamps
  public $timestamps = false;
  
  /**
   * Returns category's language versions
   */
  public function languageVersions() {
    return $this->hasMany('\\App\\Models\\CategoryLanguageVersion', 'categoryId');
  }
  
  /**
   * Returns category's child categories
   */
  public function children() {
    return $this->hasMany('\\App\\Models\\Category', 'parentId')->orderBy('menuWeight');
  }
  
  /**
   * Returns category's articles
   */
  public function articles() {
    return $this->hasMany('\\App\\Models\\Article', 'categoryId');
  }
  
  public function parentCategory() {
    return $this->hasOne('\\App\\Models\\Category', 'parentId');
  }
}
