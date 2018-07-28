<?php namespace App\Models\Trips;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model {

	// The database table used by the model
	protected $table = 'trip';

	// The attributes that are mass assignable
	protected $fillable = ['id'];

	// The attributes excluded from the model's JSON form
	protected $hidden = [];
  
  // No default timestamps
  public $timestamps = false;
  
  public function languageVersions() {
    return $this->hasMany('\\App\\Models\\Trips\\TranslatedTrip', 'trip_id');
	}
	
	public function visits() {
    return $this->hasMany('\\App\\Models\\Trips\\Visit', 'trip_id');
	}
	
	public function users() {
    return $this->hasMany('\\App\\Models\\Trips\\TripUser', 'trip_id');
  }
}