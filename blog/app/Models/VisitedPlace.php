<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitedPlace extends Model {

	// The database table used by the model
	protected $table = 'visitedplace';

	// The attributes that are mass assignable
	protected $fillable = ['id', 'locationname', 'lat', 'lng'];

	// The attributes excluded from the model's JSON form
	protected $hidden = [];
  
  // No default timestamps
  public $timestamps = false;
}