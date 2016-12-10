<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	// The database table used by the model.
	protected $table = 'category';

	// The attributes that are mass assignable.
	protected $fillable = ['id', 'menu_weight', 'parent_id'];

	// The attributes excluded from the model's JSON form.
	protected $hidden = [];
  
  // No default timestamps
  public $timestamps = false;
  
  /**
   * Returns category's language versions
   */
  public function languageVersions() {
    return $this->hasMany('\\App\\Models\\CategoryLanguageVersion', 'category_id');
  }
  
  /**
   * Returns category's child categories
   */
  public function children() {
    return $this->hasMany('\\App\\Models\\Category', 'parent_id')->orderBy('menu_weight');
  }
  
  /**
   * Returns category's articles
   */
  public function articles() {
    return $this->hasMany('\\App\\Models\\Article', 'category_id');
  }
  
  public function parentCategory() {
    return $this->belongsTo('\\App\\Models\\Category', 'parent_id');
  }
}
