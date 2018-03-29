<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

	 protected $fillable = [
			'name',
			'date',
			'time',
			'price',
			'location_id',
			'imageUrl',
			'onlineUrl',
	];

	public function sessions()
 	{
		return $this->hasMany('App\Models\Session');
	}

	public function location()
	{
	return $this->belongsTo('App\Models\Location');
	}


}
