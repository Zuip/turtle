<?php namespace App\Models\Trips;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model {

	// The database table used by the model
	protected $table = 'city_visit';

	// The attributes that are mass assignable
	protected $fillable = ['id'];

	// The attributes excluded from the model's JSON form
	protected $hidden = [];
  
  // No default timestamps
  public $timestamps = false;
  
  public function city() {
    return $this->belongsTo('\\App\\Models\\Cities\\City', 'city_id');
  }
}