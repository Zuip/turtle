<?php namespace App\Models\Cities;

use Illuminate\Database\Eloquent\Model;

class TranslatedCountry extends Model {

	// The database table used by the model
	protected $table = 'translated_country';

	// The attributes that are mass assignable
	protected $fillable = ['name'];

	// The attributes excluded from the model's JSON form
	protected $hidden = ['id'];
  
  // No default timestamps
  public $timestamps = false;
  
  // Returns base of the country
  public function base() {
    return $this->belongsTo('\\App\\Models\\Cities\\Country', 'country_id');
  }
  
  public function language() {
    return $this->belongsTo('\\App\\Models\\Language', 'language_id');
  }
}