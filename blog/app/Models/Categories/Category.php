<?php namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class Category extends Model implements ICategory {

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
    return $this->hasMany('\\App\\Models\\Categories\\CategoryLanguageVersion', 'category_id');
  }
  
  /**
   * Returns category's child categories
   */
  public function children() {
    return $this->hasMany('\\App\\Models\\Categories\\Category', 'parent_id')->orderBy('menu_weight');
  }
  
  /**
   * Returns category's articles
   */
  public function articles() {
    return $this->hasMany('\\App\\Models\\Articles\\Article', 'category_id');
  }
  
  public function parentCategory() {
    return $this->belongsTo('\\App\\Models\\Categories\\Category', 'parent_id');
  }
}
