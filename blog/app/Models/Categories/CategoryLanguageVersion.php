<?php namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class CategoryLanguageVersion extends Model {

	// The database table used by the model.
	protected $table = 'translated_category';

	// The attributes that are mass assignable.
	protected $fillable = ['id', 'name', 'description', 'urlname', 'published', 'language_id', 'category_id'];

	// The attributes excluded from the model's JSON form.
	protected $hidden = [];
  
  // No default timestamps
  public $timestamps = false;
  
  // Returns the category the language version belongs to
  public function category() {
    return $this->belongsTo('\\App\\Models\\Categories\\Category', 'category_id');
  }
}