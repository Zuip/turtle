<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

	/**
	 * The database table used by the model.
	 */
	protected $table = 'language';

	/**
	 * The attributes that are mass assignable.
	 */
	protected $fillable = ['id', 'name', 'code'];

	/**
	 * The attributes excluded from the model's JSON form.
	 */
	protected $hidden = [];
}