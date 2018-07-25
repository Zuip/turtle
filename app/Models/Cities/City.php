<?php namespace App\Models\Cities;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

	// The database table used by the model
	protected $table = 'city';

	// The attributes that are mass assignable
	protected $fillable = ['id'];

	// The attributes excluded from the model's JSON form
	protected $hidden = [];
  
  // No default timestamps
  public $timestamps = false;
  
  // Returns city's language versions
  public function languageVersions() {
    return $this->hasMany('\\App\\Models\\Cities\\TranslatedCity', 'city_id');
  }
  
  // Returns the country the city belongs to
  public function country() {
    return $this->belongsTo('\\App\\Models\\Cities\\Country', 'country_id');
  }
}