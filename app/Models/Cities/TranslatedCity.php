<?php namespace App\Models\Cities;

use Illuminate\Database\Eloquent\Model;

class TranslatedCity extends Model {

	// The database table used by the model
	protected $table = 'translated_city';

	// The attributes that are mass assignable
	protected $fillable = ['name'];

	// The attributes excluded from the model's JSON form
	protected $hidden = ['id'];
  
  // No default timestamps
  public $timestamps = false;
  
  public function base() {
    return $this->belongsTo('\\App\\Models\\Cities\\City', 'city_id');
  }
  
  public function language() {
    return $this->belongsTo('\\App\\Models\\Language', 'language_id');
  }
}