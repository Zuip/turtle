<?php namespace App\Models\Cities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

	// The database table used by the model
	protected $table = 'country';

	// The attributes that are mass assignable
	protected $fillable = ['id'];

	// The attributes excluded from the model's JSON form
	protected $hidden = [];
  
  // No default timestamps
  public $timestamps = false;
  
  // Returns country's language versions
  public function languageVersions() {
    return $this->hasMany('\\App\\Models\\Cities\\TranslatedCountry', 'country_id');
  }
}