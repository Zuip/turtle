<?php namespace App\Models\Trips;

use Illuminate\Database\Eloquent\Model;

class VisitUser extends Model {

	// The database table used by the model
	protected $table = 'city_visit_user';

	// The attributes that are mass assignable
	protected $fillable = ['id'];

	// The attributes excluded from the model's JSON form
	protected $hidden = [];
  
  // No default timestamps
  public $timestamps = false;
	
	public function visit() {
    return $this->belongsTo('\\App\\Models\\Trips\\Visit', 'visit_id');
  }
}