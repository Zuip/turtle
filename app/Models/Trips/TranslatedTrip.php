<?php namespace App\Models\Trips;

use Illuminate\Database\Eloquent\Model;

class TranslatedTrip extends Model {

  // The database table used by the model
  protected $table = 'translated_trip';

  // The attributes that are mass assignable
  protected $fillable = ['id', 'name', 'url_name', 'language'];
  
  // No default timestamps
  public $timestamps = false;
  
  // The attributes excluded from the model's JSON form
  protected $hidden = [];
  
  public function base() {
    return $this->belongsTo('\\App\\Models\\Trips\\Trip', 'trip_id');
  }
}